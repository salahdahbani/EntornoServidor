"""
config.py
=========
All constants derived directly from carmatch_encoders.pkl and
car_sales_engineered.csv analysis. Nothing invented.

Key findings documented here:
- brand_tier is based on price quartiles in THIS dataset (Q33=$22,001 / Q66=$24,000)
  NOT on conventional brand prestige. BMW/Mercedes appear as Economy_Brand because
  their median transaction price in this dataset falls below Q33.
- is_dohc = 0 for 100% of records → zero-variance feature, fixed to 0.
- region_cluster comes from KMeans(n_clusters=3) on regional stats.
"""

# ── Exact label encoder classes (from carmatch_encoders.pkl) ────────────────
# Order matters: LabelEncoder maps alphabetically → index = class position

GENDER_CLASSES        = ["Female", "Male"]          # Female=0, Male=1
COLOR_CLASSES         = ["Black", "Pale White", "Red"]  # 0,1,2
DEALER_REGION_CLASSES = ["Aurora", "Austin", "Greenville",
                          "Janesville", "Middletown", "Pasco", "Scottsdale"]
SEASON_CLASSES        = ["Fall", "Spring", "Summer", "Winter"]  # 0,1,2,3
BRAND_TIER_CLASSES    = ["Economy_Brand", "Luxury_Brand", "Mid_Brand"]  # 0,1,2

# ── Target classes (body_style) ──────────────────────────────────────────────
TARGET_CLASSES = ["Hardtop", "Hatchback", "MPV", "SUV", "Sedan"]

# ── region_cluster mapping (KMeans k=3 from training data) ───────────────────
# Cluster 0 = Austin (standalone tech-hub profile)
# Cluster 1 = Middletown, Scottsdale (similar regional economic profile)
# Cluster 2 = Aurora, Greenville, Janesville, Pasco (mid-market Midwest/Southeast)
REGION_CLUSTER_MAP: dict[str, int] = {
    "Austin"     : 0,
    "Middletown" : 1,
    "Scottsdale" : 1,
    "Aurora"     : 2,
    "Greenville" : 2,
    "Janesville" : 2,
    "Pasco"      : 2,
}

# ── Region aggregate stats (from car_sales_engineered.csv groupby) ───────────
REGION_STATS: dict[str, dict] = {
    "Aurora"    : {"region_avg_price": 28334.63, "region_luxury_rate": 0.3259},
    "Austin"    : {"region_avg_price": 28341.60, "region_luxury_rate": 0.3241},
    "Greenville": {"region_avg_price": 28180.82, "region_luxury_rate": 0.3363},
    "Janesville": {"region_avg_price": 27833.35, "region_luxury_rate": 0.3452},
    "Middletown": {"region_avg_price": 27856.34, "region_luxury_rate": 0.3347},
    "Pasco"     : {"region_avg_price": 28119.04, "region_luxury_rate": 0.3363},
    "Scottsdale": {"region_avg_price": 27951.16, "region_luxury_rate": 0.3566},
}

# ── brand_tier thresholds (from training metadata) ───────────────────────────
# IMPORTANT ACADEMIC NOTE: tiers are price-quartile-based in THIS dataset,
# NOT conventional prestige tiers. Q33=$22,001 / Q66=$24,000.
BRAND_TIER_Q33 = 22_001
BRAND_TIER_Q66 = 24_000

# Mapping: company → brand_tier (from car_sales_engineered.csv groupby)
# This is empirical from the data, not assumed from brand names.
COMPANY_BRAND_TIER: dict[str, str] = {
    # Economy_Brand (median price ≤ Q33=$22,001 in this dataset)
    "BMW"        : "Economy_Brand",
    "Chevrolet"  : "Economy_Brand",
    "Chrysler"   : "Economy_Brand",
    "Hyundai"    : "Economy_Brand",
    "Infiniti"   : "Economy_Brand",
    "Jaguar"     : "Economy_Brand",
    "Jeep"       : "Economy_Brand",
    "Mercedes-B" : "Economy_Brand",
    "Mitsubishi" : "Economy_Brand",
    "Nissan"     : "Economy_Brand",
    # Luxury_Brand (median price > Q66=$24,000 in this dataset)
    "Acura"      : "Luxury_Brand",
    "Audi"       : "Luxury_Brand",
    "Buick"      : "Luxury_Brand",
    "Cadillac"   : "Luxury_Brand",
    "Honda"      : "Luxury_Brand",
    "Lexus"      : "Luxury_Brand",
    "Lincoln"    : "Luxury_Brand",
    "Oldsmobile" : "Luxury_Brand",
    "Saab"       : "Luxury_Brand",
    "Saturn"     : "Luxury_Brand",
    "Toyota"     : "Luxury_Brand",
    "Volvo"      : "Luxury_Brand",
    # Mid_Brand (median between Q33 and Q66)
    "Dodge"      : "Mid_Brand",
    "Ford"       : "Mid_Brand",
    "Mercury"    : "Mid_Brand",
    "Plymouth"   : "Mid_Brand",
    "Pontiac"    : "Mid_Brand",
    "Porsche"    : "Mid_Brand",
    "Subaru"     : "Mid_Brand",
    "Volkswagen" : "Mid_Brand",
}

# ── Season from month ─────────────────────────────────────────────────────────
MONTH_TO_SEASON: dict[int, str] = {
    12: "Winter", 1: "Winter",  2: "Winter",
    3:  "Spring", 4: "Spring",  5: "Spring",
    6:  "Summer", 7: "Summer",  8: "Summer",
    9:  "Fall",   10: "Fall",   11: "Fall",
}

# ── Model performance metadata ────────────────────────────────────────────────
MODEL_METADATA = {
    "model_name"      : "LightGBM",
    "accuracy_test"   : 0.4999,
    "f1_weighted_test": 0.4997,
    "f1_macro_cv"     : 0.4957,
    "cv_accuracy"     : "0.4991 ± 0.0062",
    "baseline_accuracy": 0.2667,
    "gain_vs_baseline": "+23.32pp",
    "target"          : "body_style",
    "n_classes"       : 5,
    "classes"         : TARGET_CLASSES,
    "n_features"      : 15,
    "known_issues"    : [
        "is_dohc = 0 for 100% of training records (zero-variance feature, fixed to 0)",
        "brand_tier based on price quartiles in this dataset, not conventional brand prestige",
        "income-price correlation r≈0.012 (very weak — preference dominates over budget)",
    ],
}

# ── Feature column order (MUST match training) ───────────────────────────────
FEATURE_COLS = [
    "log_income",
    "gender_enc",
    "is_dohc",
    "color_enc",
    "dealer_region_enc",
    "region_cluster",
    "month",
    "quarter",
    "season_enc",
    "is_weekend",
    "brand_tier_enc",
    "region_avg_price",
    "region_luxury_rate",
    "price",
    "price_to_income",
]

# ── Body style descriptions (for natural language responses) ─────────────────
BODY_STYLE_DESCRIPTIONS: dict[str, str] = {
    "Sedan"   : "a traditional enclosed car with a separate trunk — practical, fuel-efficient, popular for commuting",
    "SUV"     : "a Sports Utility Vehicle with elevated seating and ample cargo space — family-friendly, versatile",
    "Hatchback": "a compact car with a rear door that opens upward — urban-friendly, fuel-efficient, easy to park",
    "MPV"     : "a Multi-Purpose Vehicle (minivan/people-carrier) — maximum passenger and cargo capacity",
    "Hardtop" : "a coupe or convertible with a fixed or retractable hard roof — sporty styling, premium feel",
}

