<?php
/*
$sunucu = "localhost";
$kullanici = "root";
$sifre = "";
*/


$sunucu = "localhost";
$kullanici = "nescienc";
$sifre = "c7YdBG2Z";

$db = "nescienc_dergi";

//$baglanti = @mysql_connect($sunucu,$kullanici,$sifre);
//mysql_set_charset('utf8',$baglanti);
//$vt = @mysql_select_db($db,$baglanti);

$baglanti = @mysqli_connect($sunucu,$kullanici,$sifre,$db);
mysqli_set_charset('utf8',$baglanti);
//$vt = @mysql_select_db($db,$baglanti);

?>