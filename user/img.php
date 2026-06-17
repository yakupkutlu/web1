<?php
session_start();
/* Olusturulan kodu diger sayfalara tasiyabilmemiz icin oturum baslatiyoruz.
  0-999 araliginda bir sayi olusturup bunu md5 ile sifreliyoruz.
 */
//$md5yap = md5(rand(100000, 999999));

//md5 ile sifrelenen sayimizin uzunlugu 32 karakter olacaktir. Biz 6 karakterli alacagiz.
//$dogrulamakodu = strtoupper(substr($md5yap, 8, 6));

$dogrulamakodu1 = rand(1000, 9999);

//Dogrulama icin kullanicak kodumuzu acilan oturuma kaydediyoruz.
$_SESSION["dogrulamakodu"] = $dogrulamakodu1;

//Resim boyutlari belirleniyor
$en = 75;
$boy = 25;

//Uzerinde calisacagimiz resim olusturuluyor.
$image = ImageCreate($en, $boy);

//Beyaz,Siyah ve Kirmizi renkler olusturuyoruz. Rakamlar renkleri ifade etmektedir.
$beyaz = ImageColorAllocate($image, 255, 255, 255);
$siyah = ImageColorAllocate($image, 0, 0, 0);

$kirmizi = ImageColorAllocate($image, 242, 0, 0);
$mavi = ImageColorAllocate($image, 0, 0, 240);

$cizgiRengi = ImageColorAllocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
//Arka plani beyaz yapiyoruz
ImageFill($image, 0, 0, $cizgiRengi);

$konumx=17;
$konumx=rand(7,47);
$konumy=12;


$renkyesil = imagecolorallocatealpha($image, 0, 176, 116, 1); 
$renkmavi    = imagecolorallocatealpha($image, 19, 99, 198, 1);
$cember1 = imagecolorallocatealpha($image, 0, 150, 150, 75); 
$cember2    = imagecolorallocatealpha($image, 20, 150, 150, 75);
//$cember3   = imagecolorallocatealpha($image, 20, 150, 150, 75);
imagefilledellipse($image, $konumx, 12, 23, 23, $cember1); 
imagefilledellipse($image, ($konumx+17), 12, 23, 23, $cember2);
//imagefilledellipse($image, 53, 12, 20, 23, $cember3);

$white = imagecolorallocate($im, 255, 255, 255);
imagefilledrectangle($image, 3, 3, 72, 22, $renkmavi);




//Olusturulan dogrulama kodunu resime yaziyoruz.
ImageString($image, 6, ($konumx-6), 5, $_SESSION["dogrulamakodu"], $siyah);

//Gorunumu biraz karistirmak icin cizgilerle gorunumu zorlastiriyoruz.
//Dilerseniz imageline() satirlarini kaldirarak cizgileri yok edebilirsiniz.
//imageline($image, 0, 2, $en, rand(1,25), $mavi);
//imageline($image, $en, $boy, 40, 0, $mavi);
//imageline($image, 0, 23, $en, 23, $kirmizi);

//imageline($image, rand(1,5), rand(1,25), rand(30,65), rand(1,25), $mavi);
///imageline($image, rand(1,5), rand(1,25), rand(15,65), rand(1,25), $mavi);
// Tarayiciya dosyamizin tipini yolluyoruz.
header("Content-Type: image/jpeg");

//Resmimizi Jpg formatinda basiyoruz.
ImageJpeg($image);

//Bir kereye mahsus kullanacagimiz icin siliyoruz.
ImageDestroy($image);
//exit();
?>