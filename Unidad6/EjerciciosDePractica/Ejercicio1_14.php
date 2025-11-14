<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
</head>
<body>
<?php
/** potencia10: devuelve 10^n (n >= 0) usando bucle */
function potencia10(int $n): int {
    if ($n <= 0) return 1;
    $res = 1;
    for ($i = 0; $i < $n; $i++) $res *= 10;
    return $res;
}

/** absInt: valor absoluto (por claridad) */
function absInt(int $x): int {
    return $x < 0 ? -$x : $x;
}

function esCapicua(int $n): bool {
    $sign = $n < 0 ? -1 : 1;
    $x = absInt($n);
    $orig = $x;
    $rev = 0;
    while ($x > 0) {
        $rev = $rev * 10 + ($x % 10);
        $x = intdiv($x, 10);
    }
    return $rev === $orig;
}
function esPrimo($n) {
for ($i = 2; $i < $n; $i++) {
if ($n % $i == 0) {
return false;
}
}
if (($n == 0) || ($n == 1)) {
return false;
}
return true;
}
function siguientePrimo(int $n): int {
    $candidate = $n + 1;
    while (!esPrimo($candidate)) $candidate++;
    return $candidate;
}
function potencia($base, int $exponente) {
    if ($exponente === 0) return 1;
    $neg = $exponente < 0;
    $e = $neg ? -$exponente : $exponente;
    $res = 1.0;
    for ($i = 0; $i < $e; $i++) $res *= $base;
    if ($neg) return 1.0 / $res;
    if (is_float($res) && floor($res) == $res) return (int)$res;
    return $res;
}
function digitos(int $n): int {
    $x = absInt($n);
    if ($x === 0) return 1;
    $count = 0;
    while ($x > 0) {
        $x = intdiv($x, 10);
        $count++;
    }
    return $count;
}
function voltea(int $n): int {
    $sign = $n < 0 ? -1 : 1;
    $x = absInt($n);
    $rev = 0;
    while ($x > 0) {
        $rev = $rev * 10 + ($x % 10);
        $x = intdiv($x, 10);
    }
    return $sign * $rev;
}

function digitoN(int $n, int $pos): int {
    $x = absInt($n);
    $len = digitos($x);
    if ($pos < 0 || $pos >= $len) return -1;
    $div = potencia10($len - 1 - $pos);
    return intdiv($x, $div) % 10;
}
function posicionDeDigito(int $n, int $dig): int {
    if ($dig < 0 || $dig > 9) return -1;
    $x = absInt($n);
    $len = digitos($x);
    for ($pos = 0; $pos < $len; $pos++) {
        if (digitoN($x, $pos) === $dig) return $pos;
    }
    return -1;
}
function quitaPorDetras(int $n, int $cantidad): int {
    $sign = $n < 0 ? -1 : 1;
    $x = absInt($n);
    if ($cantidad <= 0) return $n;
    $div = potencia10($cantidad);
    return $sign * intdiv($x, $div);
}

function quitaPorDelante(int $n, int $cantidad): int {
    $sign = $n < 0 ? -1 : 1;
    $x = absInt($n);
    $len = digitos($x);
    if ($cantidad <= 0) return $n;
    if ($cantidad >= $len) return 0;
    $mod = potencia10($len - $cantidad);
    return $sign * ($x % $mod);
}

function pegaPorDetras(int $n, int $dig): int {
    $sign = $n < 0 ? -1 : 1;
    $a = absInt($n);
    $b = absInt($dig);
    $digB = digitos($b);
    $mul = potencia10($digB);
    return $sign * ($a * $mul + $b);
}

function pegaPorDelante(int $n, int $dig): int {
    $sign = $n < 0 ? -1 : 1;
    $a = absInt($n);
    $b = absInt($dig);
    $digA = digitos($a);
    $mul = potencia10($digA);
    return $sign * ($b * $mul + $a);
}
function trozoDeNumero(int $n, int $inicio, int $fin): int {
    $x = absInt($n);
    $len = digitos($x);
    if ($inicio < 0) $inicio = 0;
    if ($fin >= $len) $fin = $len - 1;
    if ($inicio > $fin) return 0;
    $suffixMod = potencia10($len - $inicio);
    $suf = $x % $suffixMod; 
    $quitarDetras = $len - 1 - $fin;
    if ($quitarDetras > 0) {
        $div = potencia10($quitarDetras);
        $suf = intdiv($suf, $div);
    }
    return $suf;
}
?>
</body>
</html>