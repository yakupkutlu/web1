<?php
$id = $_GET['id'];
include("../app/connect.php");
$data = array();
function change_str($str){
    $find=array("ü","ğ","ı","ş","ç","ö","Ü","Ğ","İ","Ş","Ç","Ö");
    $change=array("u","g","i","s","c","o","U","G","I","S","C","O");
    return str_replace($find,$change,$str);
}
$query = mysqli_query($baglanti,"SELECT * FROM submission_list_temp WHERE id='$id' and state=1");
    while ($oku = mysqli_fetch_array($query)) {
         array_push($data, change_str($oku['title']), change_str($oku['all_authors']), change_str($oku['key_words']), change_str($oku['abstract']), change_str( $oku['message']));
        //array_push($data, $oku['title'], $oku['all_authors'], $oku['key_words'],$oku['abstract'], $oku['message']);

    }

//echo json_encode($data,JSON_UNESCAPED_UNICODE);
echo json_encode($data);
?>