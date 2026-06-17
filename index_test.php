<?php
$conn = new mysqli(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_NAME"));
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
echo "MySQL bağlantısı başarılı!";
?>
