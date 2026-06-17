<?php


include("../app/connect.php");
include("function.php");
include("../system.php");
session_start();
ob_start();

$s_user = $_SESSION["user"];


$volume = $_POST["volume"];
$no = $_POST["number"];
$yayin_yili = $_POST["year"];


      //$pQuery ="INSERT INTO cover_files_path(year, volume, no, cover, front_matter, table_of_contents) VALUES ( '$yayin_yili' , '$volume','$no')";
   
    $pQuery ="INSERT INTO cover_files_path(year, volume, no) VALUES ( '$yayin_yili' , '$volume','$no')";
   // $pQuery = "update submission_list set `references`='$referans',title='$title',abstract='$abstract',authors='$authors',keyword='$keywords1', volume='$volume',`no`='$no',pp='$pp',start_page='$start_page', doi='$doi',`year`='$yayin_yili' where id='$p_id'";
    if (mysqli_query($baglanti,$pQuery)) {
        $log_state = " new cover info eklendi ";
        log_all($s_user, $log_state);
         MesajGoster("New Issue is added...");
        header("Refresh:1;  URL = index.php?page=coverpage_list&m_id=12&rnb=2");
    } else {
        //echo "Veritabanı Hatası";
        $log_state = "HATA -> ID li Makale CONTENT VERİTABANI HATASI";
        log_all($s_user, $log_state);
        echo "hata" . mysqli_error();
    }

 
?>
