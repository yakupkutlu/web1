<?php
/*
$sunucu = "localhost";
$kullanici = "root";
$sifre = "";
$db = "yakupkut_nesciences22";
*/
include("defination.php");

$sunucu = "localhost";
$kullanici = "tethysjournal_jner";
$sifre = "journal1ner*";

$db = "tethysjournal_jner";

//$baglanti = @mysql_connect($sunucu,$kullanici,$sifre);
//mysql_set_charset('utf8',$baglanti);
//$vt = @mysql_select_db($db,$baglanti);

$baglanti = @mysqli_connect($sunucu,$kullanici,$sifre,$db);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit;
  }else{
      
      //echo "ok";
  }

mysqli_set_charset($baglanti,'utf8');

//$vt = @mysql_select_db($db,$baglanti);





?>
