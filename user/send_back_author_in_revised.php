<?php
include('../app/connect.php');
include("function.php");
include("../system.php");
session_start();
ob_start();
$role_number=$_GET["rnb"];
if (yetki_kontrol($role_number, "sentBackToAuthor")) {
    $s_user = $_SESSION["user"];

    $editor = $_POST["editor"];
    $editor_message=$_POST["editor_message"]."</br></br>".$editor."</br>Editor";
    $editor_message=tirnak_replace($editor_message);
    $sub_id = $_POST["id"];
    $date = date("Y-m-d");

    $m_id = $_GET["m_id"];//menu id

    $sql = "select * from submission_list where id='$sub_id'";
    $paper = mysqli_fetch_array(mysqli_query($baglanti,$sql));

    $author_mail = $paper["email"];
    $title = "Title: " . $paper["title"];
    $subject = $journalShortName." M&S-Editor Decision";

if (mail_gonder($author_mail, $subject, $editor_message)){
    $send_back_sql = "update submission_list set accept_status=2, revision_status=1 where id='$sub_id'";
    if (mysqli_query($baglanti,$send_back_sql)) {
        $send_back_message="insert into send_back_author (paper_id,editor,message,return_date) VALUES ('$sub_id','$editor','$editor_message','$date')";
        mysqli_query($baglanti,$send_back_message);

        $log_state = $paper["paperID"] . " ID li Makale Dosyası" . $paper["name_surname"] . " adlı yazara GERİ GÖNDERİLDİ";
        log_all($s_user, $log_state);

        $message = $editor . " tarafından " . strtoupper($paper["paperID"]) . " ID li makaleniz geri gönderildi";
        send_message($message, $author_mail, $journalShortName, 2);

        $url = "index.php?page=submission&m_id=" . $m_id . "&rnb=2";
        MesajGoster("Sent Back To Author");
        Yonlendirme($url);
    } else {
        $log_state = "HATA - >" . $paper["paperID"] . " ID li Makale Dosyası" . $paper["name_surname"] . " adlı yazara MAİL GİTTİ - > VERİTABANI HATASI";
        log_all($s_user, $log_state);
        $url = "index.php?page=submission&m_id=" . $m_id . "&rnb=2";
        Yonlendirme($url);
    }

}

    else {
        $log_state = "HATA - >".$paper["paperID"] . " ID li Makale Dosyası" . $paper["name_surname"]. " adlı yazara GÖNDERİLEMEDİ - > MAİL HATASI";
        log_all($s_user, $log_state);
        $url="index.php?page=submission&m_id=".$m_id."&rnb=2";
            Yonlendirme($url);
    }
}else header("Refresh:0;  URL = 404.php ");
