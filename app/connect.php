<?php
/*
$sunucu = "localhost";
$kullanici = "root";
sifre = "";
db = "yakupkut_nesciences22";
*/
include(__DIR__ . "/defination.php");

$defaultHost = "127.0.0.1";
$defaultUser = "root";
$defaultPassword = "";
$defaultDb = "yakupkut_nesciences22";
$defaultPort = 3306;

$sunucu = getenv("DB_HOST") ?: getenv("MYSQL_HOST") ?: $defaultHost;
$kullanici = getenv("DB_USER") ?: getenv("MYSQL_USER") ?: $defaultUser;
$sifre = getenv("DB_PASSWORD") ?: getenv("MYSQL_PASSWORD") ?: $defaultPassword;
$db = getenv("DB_NAME") ?: getenv("MYSQL_DATABASE") ?: $defaultDb;
$port = getenv("DB_PORT") ?: getenv("MYSQL_PORT") ?: $defaultPort;

if ($sunucu === "localhost") {
    $sunucu = "127.0.0.1";
}

$baglanti = mysqli_connect($sunucu, $kullanici, $sifre, $db, $port);
if (!$baglanti) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

mysqli_set_charset($baglanti, 'utf8');

//$vt = @mysql_select_db($db,$baglanti);





?>
