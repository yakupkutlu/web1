<?php
/*
$sunucu = "localhost";
$kullanici = "root";
$sifre = "";
$db = "yakupkut_nesciences22";
*/
include("defination.php");
 

$sunucu = getenv("DB_HOST");
$kullanici = getenv("DB_USER");
$sifre = getenv("DB_PASSWORD");

$db = getenv("DB_NAME");

if (!$sunucu || !$kullanici || !$db) {
    // Fall back to local settings if environment variables are not configured.
    $sunucu = "localhost";
    $kullanici = "root";
    $sifre = "";
    $db = "yakupkut_nesciences22";
}

$baglanti = @mysqli_connect($sunucu,$kullanici,$sifre,$db);
if (!$baglanti) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

if (!mysqli_select_db($baglanti, $db)) {
    echo "Database selection failed: " . mysqli_error($baglanti);
    exit;
}

mysqli_set_charset($baglanti,'utf8');

//$vt = @mysql_select_db($db,$baglanti);





?>
