"""
schemas.py
==========
Pydantic v2 request and response models.

Input design rationale (academic note):
  The model requires 15 features. Several are derived internally
  (log_income, price_to_income, region_cluster, season, quarter, brand_tier).
  We expose only the 8 raw inputs a dealer realistically knows at the
  moment a customer walks in. Everything else is computed in preprocessor.py.

  'price' is required because it is a direct feature in the trained model
  (no leakage: target=body_style, price is not the target).
  Without price the prediction would require median imputation, reducing accuracy.
"""

from __future__ import annotations
from pydantic import BaseModel, Field, field_validator, model_validator
from typing import Literal, Optional
from datetime import datetime
from config import (
    GENDER_CLASSES, COLOR_CLASSES, DEALER_REGION_CLASSES,
    COMPANY_BRAND_TIER, TARGET_CLASSES, BODY_STYLE_DESCRIPTIONS,
    MODEL_METADATA,
)


# ── Input schema ─────────────────────────────────────────────────────────────

class PredictionRequest(BaseModel):
    """
    Customer profile required to predict body style preference.
    All fields correspond directly to features used by the trained LightGBM model.
    """

    annual_income: float = Field(
        ...,
        gt=0,
        description="Customer's annual income in USD. Used to compute log_income and price_to_income ratio.",
        examples=[80_000, 150_000, 600_000],
    )
    price: float = Field(
        ...,
        gt=0,
        le=200_000,
        description=(
            "Price (USD) of the vehicle the customer is considering. "
            "Required: price is a direct feature in the trained model. "
            "Range in training data: $1,200–$85,800."
        ),
        examples=[18_000, 28_000, 45_000],
    )
    gender: Literal["Male", "Female"] = Field(
        ...,
        description="Customer gender (case-insensitive, normalised internally).",
        examples=["Male", "Female"],
    )
    dealer_region: Literal[
        "Aurora", "Austin", "Greenville", "Janesville",
        "Middletown", "Pasco", "Scottsdale"
    ] = Field(
        ...,
        description="Dealer location — one of the 7 regions present in training data.",
        examples=["Austin", "Scottsdale"],
    )
    color_preference: Literal["Black", "Pale White", "Red"] = Field(
        default="Pale White",
        description=(
            "Customer's preferred exterior colour. "
            "Only 3 colour categories exist in the training data."
        ),
        examples=["Pale White", "Black", "Red"],
    )
    company_interest: Optional[str] = Field(
        default=None,
        description=(
            "Brand the customer is interested in (e.g. 'Toyota', 'BMW'). "
            "Used to compute brand_tier. If unknown, defaults to Mid_Brand "
            "(median price = $22,001–$24,000 in this dataset). "
            "NOTE: brand_tier is price-quartile-based in the training data, "
            "not conventional prestige — BMW is 'Economy_Brand' in this dataset."
        ),
        examples=["Toyota", "BMW", "Ford"],
    )
    month: int = Field(
        default_factory=lambda: datetime.now().month,
        ge=1,
        le=12,
        description="Month of the visit/purchase (1=January … 12=December). Defaults to current month.",
        examples=[1, 6, 12],
    )
    is_weekend: bool = Field(
        default=False,
        description="Whether the visit occurs on a Saturday or Sunday.",
        examples=[False, True],
    )

    @field_validator("gender", mode="before")
    @classmethod
    def normalise_gender(cls, v: str) -> str:
        """Accept any capitalisation: 'MALE', 'male', 'mALE' → 'Male'."""
        mapping = {"male": "Male", "female": "Female"}
        return mapping.get(str(v).lower().strip(), v)

    @field_validator("color_preference", mode="before")
    @classmethod
    def normalise_color(cls, v: str) -> str:
        """Accept 'pale white', 'PALE WHITE' → 'Pale White', etc."""
        return str(v).strip().title()

    @field_validator("company_interest", mode="before")
    @classmethod
    def normalise_company(cls, v):
        if v is None:
            return v
        return str(v).strip().title()


# ── Individual recommendation ─────────────────────────────────────────────────

class BodyStyleProbability(BaseModel):
    body_style: str
    probability: float = Field(..., ge=0, le=1)
    description: str


# ── Output schema ─────────────────────────────────────────────────────────────


class PredictionResponse(BaseModel):
    """Simplified response for prediction."""
    predicted_body_style: str = Field(description="The predicted car body style.")
    confidence: float = Field(description="Model confidence (0–1).")
   

# ── Health response ───────────────────────────────────────────────────────────

class HealthResponse(BaseModel):
    status: str
    model_name: str
    model_accuracy: float
    target: str
    classes: list[str]
    known_issues: list[str]
    api_version: str


# ── Segment info response ─────────────────────────────────────────────────────

class BodyStyleInfo(BaseModel):
    body_style: str
    description: str
    share_in_training_data: Optional[float] = None


class CatalogueResponse(BaseModel):
    body_styles: list[BodyStyleInfo]
    note: str

