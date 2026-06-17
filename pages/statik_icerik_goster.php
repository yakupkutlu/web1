<?php


$sql = "SELECT content FROM static_content WHERE page_name= '$page' AND state= 1";

$query = mysqli_query($baglanti,$sql);
if ($query) {
    $tmp = mysqli_fetch_array($query);
    $content = $tmp["content"];
} else {
    echo "Veritabanı Hatası";
}
echo $content;
