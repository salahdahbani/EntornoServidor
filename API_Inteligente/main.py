from __future__ import annotations
import os
import pickle
import warnings
from contextlib import asynccontextmanager
from datetime import datetime
from pathlib import Path
from typing import Any

import numpy as np
import pandas as pd
from fastapi import FastAPI, HTTPException, status
from fastapi.responses import JSONResponse

# Importaciones de tus archivos locales
from config import (
    BODY_STYLE_DESCRIPTIONS,
    FEATURE_COLS,
    MODEL_METADATA,
    TARGET_CLASSES,
)
from preprocessor import build_feature_vector, get_intermediate_values
from schemas import (
    BodyStyleInfo,
    BodyStyleProbability,
    CatalogueResponse,
    HealthResponse,
    PredictionRequest,
    PredictionResponse,
)

warnings.filterwarnings("ignore", category=UserWarning)

# ── Global model state ────────────────────────────────────────────────────────
class ModelStore:
    model: Any = None
    encoders: dict = {}
    feature_cols: list[str] = []
    target_encoder: Any = None
    classes: list[str] = []

store = ModelStore()

# ── Startup / shutdown ────────────────────────────────────────────────────────
@asynccontextmanager
async def lifespan(app: FastAPI):
    model_path    = Path("carmatch_model.pkl")
    encoders_path = Path("carmatch_encoders.pkl")

    if not model_path.exists() or not encoders_path.exists():
        raise FileNotFoundError("No se encuentran los archivos .pkl en la carpeta.")

    with open(model_path, "rb") as f:
        store.model = pickle.load(f)
    with open(encoders_path, "rb") as f:
        artifacts = pickle.load(f)

    store.encoders       = artifacts["feature_encoders"]
    store.target_encoder = artifacts["target_encoder"]
    store.feature_cols   = artifacts["feature_cols"]
    store.classes        = list(artifacts["target_encoder"].classes_)

    print(f"✓ Model loaded")
    yield
    store.model = None

# ── App factory ───────────────────────────────────────────────────────────────
app = FastAPI(title="CarMatch API", lifespan=lifespan)

# ── Helper ────────────────────────────────────────────────────────────────────
def _get_encoder_classes(field: str) -> list[str]:
    le = store.encoders.get(field)
    return list(le.classes_) if le else []

# ── Endpoints ─────────────────────────────────────────────────────────────────
@app.get("/")
async def root():
    return {"message": "API activa. Ve a /docs para probarla."}

@app.post("/predict", response_model=PredictionResponse)
async def predict(request: PredictionRequest):
    if store.model is None:
        raise HTTPException(status_code=503, detail="Modelo no cargado.")

    try:
        X = build_feature_vector(
            annual_income      = request.annual_income,
            price              = request.price,
            gender             = request.gender,
            dealer_region      = request.dealer_region,
            color_preference   = request.color_preference,
            company_interest   = request.company_interest,
            month              = request.month,
            is_weekend         = request.is_weekend,
            gender_classes     = _get_encoder_classes("gender"),
            color_classes      = _get_encoder_classes("color"),
            dealer_region_classes = _get_encoder_classes("dealer_region"),
            season_classes     = _get_encoder_classes("season"),
            brand_tier_classes = _get_encoder_classes("brand_tier"),
        )
        
        pred_enc  = store.model.predict(X)[0]
        pred_proba = store.model.predict_proba(X)[0]
        
        predicted_class = store.target_encoder.inverse_transform([int(pred_enc)])[0]
        confidence      = float(pred_proba[int(pred_enc)])

        return PredictionResponse(
            predicted_body_style = predicted_class,
            confidence = round(confidence, 4)
        )
    except Exception as e:
        raise HTTPException(status_code=500, detail=str(e))