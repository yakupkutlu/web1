<?php
session_start();

// CAPTCHA kodu (4 haneli)
$dogrulamakodu1 = rand(1000, 9999);
$_SESSION["dogrulamakodu"] = $dogrulamakodu1;

// Resim boyutları
$en = 75;
$boy = 25;

// Resim oluştur
$image = imagecreate($en, $boy);

// Renkler
$beyaz = imagecolorallocate($image, 255, 255, 255);
$siyah  = imagecolorallocate($image, 0, 0, 0);
$renkyesil = imagecolorallocate($image, 0, 176, 116);
$renkmavi  = imagecolorallocate($image, 19, 99, 198);

// Arka plan
imagefill($image, 0, 0, $beyaz);

// Çerçeve
imagerectangle($image, 3, 3, 72, 22, $siyah);
imagerectangle($image, 2, 2, 73, 23, $siyah);

// Yazı konumu
$konumx = rand(10, 45);
$konumy = 5;

// Kod yaz
imagestring($image, 5, $konumx, $konumy, $_SESSION["dogrulamakodu"], $renkmavi);

// Hafif çizgi karıştırma
for ($i = 0; $i < 3; $i++) {
    $cizgiRengi = imagecolorallocate($image, rand(150,255), rand(150,255), rand(150,255));
    imageline($image, rand(0,$en), rand(0,$boy), rand(0,$en), rand(0,$boy), $cizgiRengi);
}

// Header
header("Content-Type: image/jpeg");

// Çıktı
imagejpeg($image);

// Belleği temizle
imagedestroy($image);
