<?php
// 1) Tìm số lớn nhất và nhỏ nhất giữa 2 số
function max2($a, $b) {
    return ($a > $b) ? $a : $b;
}

function min2($a, $b) {
    return ($a < $b) ? $a : $b;
}

// 2) Kiểm tra số nguyên tố: trả về true/false
function isPrime(int $n): bool {
    if ($n < 2) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) return false;
    }
    return true;
}

// 3) Tính giai thừa: n >= 0 trả về giai thừa, n < 0 trả về null
function factorial(int $n) {
    if ($n < 0) return null;
    $fact = 1;
    for ($i = 1; $i <= $n; $i++) {
        $fact *= $i;
    }
    return $fact;
}

// 4) Tìm ước chung lớn nhất (UCLN) theo thuật toán Euclid
function gcd(int $a, int $b): int {
    $a = abs($a);
    $b = abs($b);
    while ($b != 0) {
        $temp = $a % $b;
        $a = $b;
        $b = $temp;
    }
    return $a;
}
?>