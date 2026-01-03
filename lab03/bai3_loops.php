<?php
$n = isset($_GET["n"]) ? (int)$_GET["n"] : 0;

// B) Tính tổng chữ số của n (dùng while)
$tempN = abs($n);
$sum = 0;
while ($tempN > 0) {
    $sum += $tempN % 10;
    $tempN = (int)($tempN / 10);
}
echo "Tổng chữ số của $n là: $sum <br>";

// C) In ra các số lẻ từ 1..N
echo "Các số lẻ từ 1 đến $n (dừng nếu > 15): ";
for ($i = 1; $i <= $n; $i++) {
    if ($i % 2 == 0) {
        continue; // Bỏ qua số chẵn
    }
    if ($i > 15) {
        break; // Dừng sớm khi vượt 15
    }
    echo "$i ";
}
?>