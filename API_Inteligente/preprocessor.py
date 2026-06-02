"""
preprocessor.py
===============
Feature engineering pipeline that replicates exactly what was done
during model training (car_sales_engineered.csv generation).

Pipeline steps per training notebook:
  1.  log_income          = log1p(annual_income)
  2.  gender_enc          = LabelEncoder(['Female','Male'])
  3.  is_dohc             = 0  (constant in training data — fixed)
  4.  color_enc           = LabelEncoder(['Black','Pale White','Red'])
  5.  dealer_region_enc   = LabelEncoder(['Aurora',...,'Scottsdale'])
  6.  region_cluster      = KMeans-3 lookup (hard-coded from training)
  7.  month               = as provided
  8.  quarter             = (month-1)//3 + 1
  9.  season_enc          = LabelEncoder(['Fall','Spring','Summer','Winter'])
  10. is_weekend          = 0/1
  11. brand_tier_enc      = LabelEncoder(['Economy_Brand','Luxury_Brand','Mid_Brand'])
  12. region_avg_price    = lookup from training aggregation
  13. region_luxury_rate  = lookup from training aggregation
  14. price               = as provided
  15. price_to_income     = price / annual_income
"""

from __future__ import annotations
import numpy as np
import pandas as pd
from config import (
    FEATURE_COLS,
    REGION_CLUSTER_MAP,
    REGION_STATS,
    COMPANY_BRAND_TIER,
    MONTH_TO_SEASON,
    BRAND_TIER_Q33,
    BRAND_TIER_Q66,
)


def _infer_brand_tier(company: str | None, price: float) -> str:
    """
    Map company name → brand_tier using the training dataset's empirical mapping.
    Falls back to price-quartile rule for unseen companies.

    NOTE: tiers are NOT conventional brand prestige — they are price-quartile
    assignments specific to this dataset (Q33=$22,001 / Q66=$24,000).
    """
    if company and company in COMPANY_BRAND_TIER:
        return COMPANY_BRAND_TIER[company]
    # Fallback: use price thresholds from training metadata
    if price <= BRAND_TIER_Q33:
        return "Economy_Brand"
    if price <= BRAND_TIER_Q66:
        return "Mid_Brand"
    return "Luxury_Brand"


def _label_encode(value: str, classes: list[str]) -> int:
    """
    Replicates sklearn LabelEncoder.transform for a single value.
    Returns 0 for unseen values (safe fallback; warns are handled by API layer).
    """
    try:
        return classes.index(value)
    except ValueError:
        return 0  # fallback: most frequent class index


def build_feature_vector(
    annual_income: float,
    price: float,
    gender: str,
    dealer_region: str,
    color_preference: str,
    company_interest: str | None,
    month: int,
    is_weekend: bool,
    # encoder classes (injected from loaded pickle to stay consistent)
    gender_classes: list[str],
    color_classes: list[str],
    dealer_region_classes: list[str],
    season_classes: list[str],
    brand_tier_classes: list[str],
) -> pd.DataFrame:
    """
    Build the 15-feature DataFrame expected by the LightGBM model.
    Column order must match FEATURE_COLS exactly.

    Returns a single-row DataFrame.
    """

    # ── Derived scalars ───────────────────────────────────────────────────────
    log_income      = float(np.log1p(annual_income))
    price_to_income = round(price / annual_income, 6) if annual_income > 0 else 0.0
    quarter         = (month - 1) // 3 + 1
    season          = MONTH_TO_SEASON.get(month, "Fall")
    brand_tier      = _infer_brand_tier(company_interest, price)
    region_stats    = REGION_STATS.get(dealer_region, REGION_STATS["Austin"])
    region_cluster  = REGION_CLUSTER_MAP.get(dealer_region, 2)

    # ── Encoded categoricals ──────────────────────────────────────────────────
    gender_enc        = _label_encode(gender,        gender_classes)
    color_enc         = _label_encode(color_preference, color_classes)
    dealer_region_enc = _label_encode(dealer_region, dealer_region_classes)
    season_enc        = _label_encode(season,         season_classes)
    brand_tier_enc    = _label_encode(brand_tier,     brand_tier_classes)

    # ── Assemble feature dict (order matches FEATURE_COLS) ────────────────────
    features = {
        "log_income"          : log_income,
        "gender_enc"          : gender_enc,
        "is_dohc"             : 0,               # zero-variance in training data
        "color_enc"           : color_enc,
        "dealer_region_enc"   : dealer_region_enc,
        "region_cluster"      : region_cluster,
        "month"               : month,
        "quarter"             : quarter,
        "season_enc"          : season_enc,
        "is_weekend"          : int(is_weekend),
        "brand_tier_enc"      : brand_tier_enc,
        "region_avg_price"    : region_stats["region_avg_price"],
        "region_luxury_rate"  : region_stats["region_luxury_rate"],
        "price"               : price,
        "price_to_income"     : price_to_income,
    }

    # Validate column order is exact
    assert list(features.keys()) == FEATURE_COLS, (
        f"Feature order mismatch. Expected: {FEATURE_COLS}, "
        f"Got: {list(features.keys())}"
    )

    return pd.DataFrame([features])


def get_intermediate_values(
    annual_income: float,
    price: float,
    gender: str,
    dealer_region: str,
    color_preference: str,
    company_interest: str | None,
    month: int,
    is_weekend: bool,
) -> dict:
    """
    Returns human-readable intermediate computed values for /explain endpoint.
    Useful for debugging and academic transparency.
    """
    season      = MONTH_TO_SEASON.get(month, "Fall")
    brand_tier  = _infer_brand_tier(company_interest, price)
    region_cl   = REGION_CLUSTER_MAP.get(dealer_region, 2)
    region_stat = REGION_STATS.get(dealer_region, REGION_STATS["Austin"])

    return {
        "log_income"         : round(float(np.log1p(annual_income)), 4),
        "price_to_income"    : round(price / annual_income, 4) if annual_income > 0 else 0,
        "quarter"            : (month - 1) // 3 + 1,
        "season"             : season,
        "brand_tier_inferred": brand_tier,
        "region_cluster"     : region_cl,
        "region_avg_price"   : region_stat["region_avg_price"],
        "region_luxury_rate" : region_stat["region_luxury_rate"],
        "is_dohc_note"       : "Fixed to 0 — zero-variance feature in training data",
    }

