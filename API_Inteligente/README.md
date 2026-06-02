# CarMatch Body Style Predictor — FastAPI

## Overview

Predicts the car **body style** (SUV / Sedan / Hatchback / MPV / Hardtop) a customer 
is most likely to purchase, given their profile.

| Item | Value |
|------|-------|
| Model | LightGBM |
| Target | `body_style` (5 classes) |
| Test accuracy | 50.0% |
| Baseline (majority class) | 26.7% |
| Gain vs baseline | +23.3 pp |
| Training records | 23,905 U.S. car sales (Jan 2022–Dec 2023) |

---

## Project structure

```
carmatch_api/
├── main.py            ← FastAPI application (endpoints, lifespan, NL response)
├── schemas.py         ← Pydantic v2 request/response models
├── preprocessor.py    ← Feature engineering pipeline (mirrors training)
├── config.py          ← All constants derived from encoders + CSV analysis
├── requirements.txt
├── README.md
├── carmatch_model.pkl     ← Place here (not included in repo)
└── carmatch_encoders.pkl  ← Place here (not included in repo)
```

---

## Setup

```bash
# 1. Create virtual environment
python -m venv venv
source venv/bin/activate        # Windows: venv\Scripts\activate

# 2. Install dependencies
pip install -r requirements.txt

# 3. Copy model artifacts into this folder
cp /path/to/carmatch_model.pkl    .
cp /path/to/carmatch_encoders.pkl .

# 4. Start the API
uvicorn main:app --reload --port 8000
```

---

## Endpoints

| Method | Path | Description |
|--------|------|-------------|
| `GET`  | `/health` | Model status + known data issues |
| `POST` | `/predict` | Main prediction endpoint |
| `GET`  | `/catalogue` | All 5 body style classes with descriptions |
| `GET`  | `/explain` | Feature engineering transparency |
| `GET`  | `/docs` | Interactive Swagger UI |
| `GET`  | `/redoc` | ReDoc documentation |

---

## Postman — example requests

### POST /predict (minimal)

```json
{
    "annual_income": 80000,
    "price": 25000,
    "gender": "Female",
    "dealer_region": "Austin"
}
```

### POST /predict (full)

```json
{
    "annual_income": 600000,
    "price": 55000,
    "gender": "Male",
    "dealer_region": "Scottsdale",
    "color_preference": "Black",
    "company_interest": "BMW",
    "month": 12,
    "is_weekend": true
}
```

### Expected response structure

```json
{
    "predicted_body_style": "SUV",
    "confidence": 0.3142,
    "natural_language_summary": "A man visiting a dealership in Scottsdale December on a weekend, with an annual income of $600,000, considering a $55,000 vehicle in black and interested in BMW, is most likely to purchase a SUV (31.4% confidence). ...",
    "all_probabilities": [
        {"body_style": "SUV",      "probability": 0.3142, "description": "..."},
        {"body_style": "Sedan",    "probability": 0.2184, "description": "..."},
        {"body_style": "Hatchback","probability": 0.1873, "description": "..."},
        {"body_style": "Hardtop",  "probability": 0.1529, "description": "..."},
        {"body_style": "MPV",      "probability": 0.1272, "description": "..."}
    ],
    "input_received": { ... },
    "model_accuracy": 0.4999,
    "model_name": "LightGBM",
    "disclaimer": "..."
}
```

---

## Academic notes & diagnostics

### 1. `is_dohc` is always 0
All 23,905 training records have `is_dohc = 0` (zero-variance feature).
The model includes it but it contributes no predictive signal.
The API fixes it to 0 and does not expose it as an input.

### 2. `brand_tier` is price-quartile-based
Tiers are computed from the **price distribution in this specific dataset**
(Q33 = $22,001 / Q66 = $24,000), not from conventional brand prestige.

| Brand | Training brand_tier | Conventional expectation |
|-------|---------------------|--------------------------|
| BMW   | Economy_Brand | Luxury |
| Mercedes-B | Economy_Brand | Luxury |
| Toyota | Luxury_Brand | Mass market |
| Lexus | Luxury_Brand | Luxury (aligns) |
| Ford  | Mid_Brand | Mass market |
| Porsche | Mid_Brand | Luxury |

This counter-intuitive mapping is a valid academic finding about **transaction 
price distribution** in this dataset, not a data error.

### 3. Weak income-price correlation (r ≈ 0.012)
Customer income has almost no linear correlation with car price in this dataset.
This means income is a weak predictor of body style when used alone.
The model compensates with interaction effects (price_to_income, region features).

### 4. Model accuracy interpretation
50% accuracy on a **5-class balanced problem** (26.7% baseline) corresponds to
roughly **1.87× better than random guessing**. This is a respectable result given:
- Only 8 raw inputs (dealer knowledge before the sale)
- Near-uniform class distribution
- No customer history or browsing data

---

## Environment variables

| Variable | Default | Description |
|----------|---------|-------------|
| `MODEL_PATH` | `carmatch_model.pkl` | Path to LightGBM pickle |
| `ENCODERS_PATH` | `carmatch_encoders.pkl` | Path to encoders pickle |
| `PORT` | `8000` | Port (set by uvicorn command) |

