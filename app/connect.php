<?php
/*
$sunucu = "localhost";
$kullanici = "root";
sifre = "";
db = "yakupkut_nesciences22";
*/
include(__DIR__ . "/defination.php");

$sunucu = getenv("DB_HOST");
$kullanici = getenv("DB_USER");
$sifre = getenv("DB_PASSWORD");
$db = getenv("DB_NAME");

echo "Database Host: $sunucu\n";
echo "Database User: $kullanici\n";
echo "Database Name: $db\n";
echo "Database Password: $sifre\n";
die("Debugging: Database connection parameters printed. Exiting for debugging purposes.");

if (!$sunucu || !$kullanici || !$db) {
    // Fall back to local settings if environment variables are not configured.
    $sunucu = "127.0.0.1";
    $kullanici = "root";
    $sifre = "";
    $db = "yakupkut_nesciences22";
} else {
    // If environment vars are set, prefer TCP rather than socket when possible.
    if ($sunucu === 'localhost') {
        $sunucu = '127.0.0.1';
    }
}

$baglanti = @mysqli_connect($sunucu, $kullanici, $sifre, $db);
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
