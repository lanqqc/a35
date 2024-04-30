<?php
// Pobierz dane notowań z API lub z bazy danych
// Tutaj załóżmy, że mamy przykładowe dane
$labels = ["01.04", "02.04", "03.04", "04.04", "05.04", "06.04", "07.04", "08.04", "09.04", "10.04", "11.04", "12.04", "13.04", "14.04", "15.04", "16.04", "17.04", "18.04", "19.04", "20.04"];
$values = [3.80, 3.82, 3.78, 3.79, 3.81, 3.83, 3.85, 3.82, 3.84, 3.86, 3.88, 3.87, 3.89, 3.91, 3.90, 3.88, 3.86, 3.84, 3.82, 3.80];

// Utwórz obraz
$imageWidth = 800;
$imageHeight = 400;
$image = imagecreate($imageWidth, $imageHeight);

// Ustaw kolory
$backgroundColor = imagecolorallocate($image, 255, 255, 255);
$lineColor = imagecolorallocate($image, 0, 0, 0);
$pointColor = imagecolorallocate($image, 255, 0, 0);

// Rysuj tło
imagefilledrectangle($image, 0, 0, $imageWidth, $imageHeight, $backgroundColor);

// Rysuj linię wykresu
for ($i = 0; $i < count($values) - 1; $i++) {
    $x1 = ($imageWidth / (count($values) - 1)) * $i;
    $y1 = $imageHeight - (($values[$i] - min($values)) / (max($values) - min($values))) * $imageHeight;
    $x2 = ($imageWidth / (count($values) - 1)) * ($i + 1);
    $y2 = $imageHeight - (($values[$i + 1] - min($values)) / (max($values) - min($values))) * $imageHeight;

    imageline($image, $x1, $y1, $x2, $y2, $lineColor);
}

// Rysuj punkty na wykresie
foreach ($values as $key => $value) {
    $x = ($imageWidth / (count($values) - 1)) * $key;
    $y = $imageHeight - (($value - min($values)) / (max($values) - min($values))) * $imageHeight;
    imagefilledellipse($image, $x, $y, 5, 5, $pointColor);
}

// Wyślij nagłówek informujący o formacie obrazu
header('Content-Type: image/png');

// Wyślij obraz do przeglądarki
imagepng($image);

// Zwolnij zasoby pamięci
imagedestroy($image);
?>
