<?php
include('../app/connect.php');
include("function.php");
include("../system.php");
session_start();
ob_start();

$s_user = $_SESSION["user"] ?? "";

$reviewer = $_GET['r_name'] ?? "";
$editor_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select * from users where user_name='$s_user'"));
$editor = $editor_obj ? $editor_obj->name_surname : "";
$sub_id = $_GET["id"] ?? "";
$url_back = $_GET["url_back"] ?? "";
$request_id = $_GET['request_id'] ?? "";

$url_back_link=str_replace('-','&',$url_back);

$date = date("Y-m-d");
$revizion_query="update review_requests set revizion_status=1 where id='$request_id'";
mysqli_query($baglanti,$revizion_query);

$paper = mysqli_fetch_array(mysqli_query($baglanti,"SELECT * FROM submission_list WHERE id='$sub_id'"));
$msno = "MS No: " . strtoupper($paper["paperID"] ?? "") . "<br>";
$subject = ($journalShortName ?? "")." your Requested Revision " . strtoupper($paper["paperID"] ?? "");
$title = "Title: " . ($paper["title"] ?? "") . "<br><br>";


$rQuery = mysqli_query($baglanti,"Select * from users where user_name='$reviewer'");
$reviewer_Query = mysqli_fetch_object($rQuery);
$reviewer_id = $reviewer_Query ? $reviewer_Query->id : "";
$reviewer_user_name = $reviewer_Query ? $reviewer_Query->user_name : "";
$reviewer_mail = $reviewer_Query ? $reviewer_Query->email : "";
$rName = $reviewer_Query ? $reviewer_Query->name_surname : "";
$rNewUser = $reviewer_Query ? $reviewer_Query->new_user : "";
// request_state hakemlik isteği 0 beklemede 1 kabul

$message = mail_sablonu("hakem_revizyon_talebi", $rName . "||" . $title . "||" . ($journalName ?? "") . "||" . ($journalShortName ?? "") . "||" . ($journalDomain ?? "") . "||" . $editor);

$sendQuery = "insert into review_requests (paperid,reviewerid,request_date,editor_name,review_status)
                        values ('$sub_id','$reviewer_id','$date','$editor',1)";
if (mysqli_query($baglanti,$sendQuery)) {
    $log_state = $paper["paperID"] . " ID li Makale Dosyası için " . $reviewer . "  hakemlik talebi gönderildi";
    log_all($s_user, $log_state);
} else {
    $log_state = "HATA ->" . $paper["paperID"] . " ID li Makale Dosyası için " . $reviewer . "  hakemlik talebi gönderilemedi,VERİTABANI HATASI" . mysqli_error($baglanti);
    log_all($s_user, $log_state);
}


if (mail_gonder($reviewer_mail, $subject, $message)) {
    $log_state = $paper["paperID"] . " ID li Makale Dosyası için " . $reviewer . "  hakemlik talebi MAİL gönderildi";
    log_all($s_user, $log_state);
} else {
    $log_state = "HATA ->" . $paper["paperID"] . " ID li Makale Dosyası için " . $reviewer . "  hakemlik talebi MAİL HATASI";
    log_all($s_user, $log_state);
}

if (mysqli_query($baglanti,"update submission_list set reviever_state=1,accept_status=-1 where id='$sub_id'")) {
    $log_state = $paper["paperID"] . " ID li Makale Dosyası için hakemlik TALEPLERİ gönderildi";
    log_all($s_user, $log_state);
} else {
    $log_state = "HATA ->" . $paper["paperID"] . " ID li Makale Dosyası için hakemlik TALEPLERİ VERİTABANI HATASI";
    log_all($s_user, $log_state);
}
MesajGoster("Send Requested Revision");
header("Refresh:2;  URL = $url_back_link");


?>

