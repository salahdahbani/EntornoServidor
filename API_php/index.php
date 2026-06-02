<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarMatch AI | Prediction Service</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-4xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">

        <div class="md:w-1/3 bg-indigo-700 p-10 text-white flex flex-col justify-center">
            <h1 class="text-4xl font-extrabold mb-6 tracking-tight">CarMatch AI</h1>
            <p class="text-indigo-100 text-lg leading-relaxed mb-8">Identify the ideal car body style using our advanced Machine Learning engine.</p>
            <div class="space-y-4">
                <div class="flex items-center text-sm font-medium">
                    <div class="bg-indigo-500 p-2 rounded-lg mr-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    Real-time Analysis
                </div>
            </div>
        </div>

        <div class="md:w-2/3 p-10">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = [
                    "annual_income"    => (float)$_POST['ingresos'],
                    "price"            => (float)$_POST['precio'],
                    "gender"           => $_POST['genero'],
                    "dealer_region"    => $_POST['region'],
                    "color_preference" => $_POST['color'],
                    "company_interest" => $_POST['marca'],
                    "month"            => (int)$_POST['mes'],
                    "is_weekend"       => isset($_POST['finde']) ? true : false
                ];

                $url = "http://127.0.0.1:8000/predict";
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

                $response = curl_exec($ch);
                $resData = json_decode($response, true);
                curl_close($ch);

                // --- VALIDACIÓN DE LA RESPUESTA ---
                if (is_array($resData) && isset($resData['predicted_body_style'])) {
                    $style = htmlspecialchars($resData['predicted_body_style']);
                    $conf = number_format($resData['confidence'] * 100, 2);

                    echo "
                    <div class='mb-8 p-6 bg-emerald-50 border-b-4 border-emerald-500 rounded-2xl'>
                        <span class='text-emerald-600 text-xs font-bold uppercase tracking-widest'>Recommendation</span>
                        <h3 class='text-emerald-900 text-3xl font-black mb-1'>{$style}</h3>
                        <p class='text-emerald-700 text-sm'>Confidence Score: <strong>{$conf}%</strong></p>
                    </div>";
                } else {
                    // Si falla, mostramos el error sin intentar imprimir el Array completo
                    $errorMsg = is_array($resData) && isset($resData['detail']) ? $resData['detail'] : "The AI Brain is offline.";
                    echo "
                    <div class='mb-8 p-6 bg-rose-50 border-b-4 border-rose-500 rounded-2xl'>
                        <h3 class='text-rose-800 font-bold'>System Alert</h3>
                        <p class='text-rose-700 text-sm'>Error: " . htmlspecialchars(print_r($errorMsg, true)) . "</p>
                    </div>";
                }
            }
            ?>

            <form method="POST" class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Annual Income ($)</label>
                        <input type="number" name="ingresos" step="1" placeholder="55000" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Vehicle Price ($)</label>
                        <input type="number" name="precio" step="1" placeholder="28000" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 outline-none">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Gender Identity</label>
                        <select name="genero" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Region</label>
                        <select name="region" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
                            <option value="Aurora">Aurora</option>
                            <option value="Austin">Austin</option>
                            <option value="Greenville">Greenville</option>
                            <option value="Janesville">Janesville</option>
                            <option value="Middletown">Middletown</option>
                            <option value="Pasco">Pasco</option>
                            <option value="Scottsdale">Scottsdale</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Car Color</label>
                        <select name="color" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="Black">Black</option>
                            <option value="Pale White">Pale White</option>
                            <option value="Red">Red</option>
                        </select>
                    </div>
                    <div>
    <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Favorite Brand</label>
    <select name="marca" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500 bg-white">
        <option value="Acura">Acura</option>
        <option value="Audi">Audi</option>
        <option value="BMW">BMW</option>
        <option value="Buick">Buick</option>
        <option value="Cadillac">Cadillac</option>
        <option value="Chevrolet">Chevrolet</option>
        <option value="Chrysler">Chrysler</option>
        <option value="Dodge">Dodge</option>
        <option value="Ford">Ford</option>
        <option value="Honda">Honda</option>
        <option value="Hyundai">Hyundai</option>
        <option value="Infiniti">Infiniti</option>
        <option value="Jaguar">Jaguar</option>
        <option value="Jeep">Jeep</option>
        <option value="Lexus">Lexus</option>
        <option value="Lincoln">Lincoln</option>
        <option value="Mazda">Mazda</option>
        <option value="Mercedes-B">Mercedes-Benz</option>
        <option value="Mercury">Mercury</option>
        <option value="Mitsubishi">Mitsubishi</option>
        <option value="Nissan">Nissan</option>
        <option value="Oldsmobile">Oldsmobile</option>
        <option value="Plymouth">Plymouth</option>
        <option value="Pontiac">Pontiac</option>
        <option value="Porsche">Porsche</option>
        <option value="Saab">Saab</option>
        <option value="Saturn">Saturn</option>
        <option value="Subaru">Subaru</option>
        <option value="Toyota">Toyota</option>
        <option value="Volkswagen">Volkswagen</option>
        <option value="Volvo">Volvo</option>
    </select>
</div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Purchase Month</label>
                        <input type="number" name="mes" min="1" max="12" placeholder="5" required class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="flex items-center pt-6">
                        <input type="checkbox" name="finde" id="finde" class="w-5 h-5 text-indigo-600 rounded">
                        <label for="finde" class="ml-3 text-sm text-slate-600 font-medium">Buying on Weekend?</label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-800 text-white font-bold py-4 rounded-2xl shadow-lg transition-all transform hover:-translate-y-1">
                    Generate AI Prediction
                </button>
            </form>
        </div>
    </div>
</body>

</html>