<?php

include('../system.php');

$link= $_SERVER['REQUEST_URI'];
//$link="https://tethysjournal.com/link/65/";


$parseLink=explode("/",$link);

// URL'den parametreleri al
$paperID = $parseLink[4]; // URL'de belirtilen paperID parametresini al

// Eğer paperID belirtilmemişse veya geçersizse, varsayılan bir değer atayabilirsiniz
if (!isset($paperID) || !is_numeric($paperID)) {
    $paperID = 65; // Varsayılan paperID
}

// Belirtilen paperID'ye göre URL oluşturma
$url = "https://[[journalDomain]]/index.php?page=detail&paperID=" . $paperID;

// Oluşturulan URL'yi göster
//echo "Gösterilen URL: " . $url;
yonlendirme($url);
?>