<?php
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");
$id = $_GET['id'];
include("../app/connect.php");
$data = array();
$all_authors = "";
$manuscript_title = "";
$abstract = "";
$key_words = "";
$message = "";
if ($query = mysqli_query($baglanti,"SELECT * FROM submission_list_temp WHERE id='$id' and state=1")) {

    while ($oku = mysqli_fetch_array($query)) {
        array_push($data, $oku['title'], $oku['all_authors'], $oku['key_words'], $oku['abstract'],  $oku['message']);
    }

}


//array_push($data, $manuscript_title, $all_authors, $key_words, $abstract,  $message);
//var_dump($data);
echo json_encode($data, JSON_UNESCAPED_UNICODE);
?>