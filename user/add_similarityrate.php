<?php
include('../app/connect.php');
include("function.php");
include("../system.php");
session_start();
ob_start();
$role_number=$_GET["rnb"];
if (yetki_kontrol($role_number, "sentBackToAuthor")) {
    $s_user = $_SESSION["user"];

    $rate = $_POST["Similarityrate"];
    //$editor_message=$_POST["editor_message"]."</br></br>".$editor."</br>Editor";
    //$editor_message=tirnak_replace($editor_message);
    $sub_id = $_POST["id"];
    $date = date("Y-m-d");

    $m_id = $_GET["m_id"];//menu id

    $sql = "select * from submission_list where id='$sub_id'";
    $paper = mysqli_fetch_array(mysqli_query($baglanti,$sql));
   // $author_mail = $paper["email"];
    //$title = "Title: " . $paper["title"];
    //$subject = $journalShortName." M&S-Editor Decision";
    
    $add_rate_sql = "update submission_list set similarityrate='".$rate."' where id='".$sub_id."'";
   if (mysqli_query($baglanti,$add_rate_sql)){
    
     $log_state = $paper["paperID"] . " ID li papaer file for  " . $paper["name_surname"] . " Users   ".$s_user. " tarafından Similarity rate degeri girdi ";
     log_all($s_user, $log_state);
     
     
     $url = "index.php?page=submission&m_id=" . $m_id . "&rnb=2";
      MesajGoster("Similarity rate was added");
      Yonlendirme($url);
	}else{
	  $log_state = "HATA - >" . $paper["paperID"] . " ID li Makale Dosyası" . $paper["name_surname"] . " adlı makale için Similarity rate degeri girilemedi- > VERİTABANI HATASI";
        log_all($s_user, $log_state);
         MesajGoster("Similarity rate was not added. Error No:100222");
        $url = "index.php?page=submission&m_id=" . $m_id . "&rnb=2";
        Yonlendirme($url);
	}
 
 
 }
else header("Refresh:0;  URL = 404.php ");
