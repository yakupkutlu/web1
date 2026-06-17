<?php
error_reporting(0);
include('app/connect.php');

$gelen_id = $_GET['id'];


$download_str = "SELECT * FROM submission_list WHERE id = $gelen_id";
$download_sorgu = @mysqli_query($baglanti,$download_str);


while ($k = mysqli_fetch_array($download_sorgu)) {
    $paperID=$k['paperID'];
}

$dosya_adi="OAfile/".$paperID.".xsd";
$dosya=fopen($dosya_adi,"r");

header('Content-Type: text/xml');
header('Content-Disposition: attachment; filename='.basename($dosya_adi));
header('Expires: -1');
header('Cache-Control: private');
header('Pragma: public');
header('Content-Length: ' . filesize($dosya_adi));
readfile($dosya_adi);
exit;

// Dosyayı kapat. Başkaları da kullanabilsin...
fclose($dosya);

//header("Location: abstract_info.php?page=info&paperID=$gelen_id");
?>