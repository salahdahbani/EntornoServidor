<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<?php
//Ejercicio1
function esCapicua($n) {
for ($i = 2; $i < $n; $i++) {
if ($n % $i == 0) {
return false;
}
}
// El 0 y el 1 no se consideran primos
if (($n == 0) || ($n == 1)) {
return false;
}
return true;
}

function esPrimo($n) {
for ($i = 2; $i < $n; $i++) {
if ($n % $i == 0) {
return false;
}
}
// El 0 y el 1 no se consideran primos
if (($n == 0) || ($n == 1)) {
return false;
}
return true;
}
?>
</body>
</html>