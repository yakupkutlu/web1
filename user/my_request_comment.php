<?php
include ("../app/connect.php");
include("../system.php");
include("function.php");
session_start();
ob_start();

$s_user = $_SESSION["user"];
$id=$_GET['id'];
$process=$_GET['process'];
$paperID=mysqli_fetch_object(mysqli_query($baglanti,"select * from review_requests WHERE id='$id'"))->paperid;

if ($process=="0"){
    mysqli_query($baglanti,"update review_requests set review_status=0 where id='$id'");
    $countPaper=mysqli_fetch_object(mysqli_query($baglanti,"select count(id) as toplam from review_requests where paperid='$paperID' and (review_status=-1 or review_status=1)"))->toplam;
    if ($countPaper=='0') mysqli_query($baglanti,"update submission_list set reviever_state=0 WHERE id='$paperID'");

    $log_state=$paperID." ID li Makale Dosyası için hakemlik talebi RED edildi";
    log_all($s_user,$log_state);
	MesajGoster( " Thank You for a member of journal.");
    Yonlendirme("index.php?page=comment_request&m_id=18&rnb=3");
   // header("Refresh:1;  URL = index.php?page=my_request&rnb=3&m_id=14");

}
if ($process=="1"){
    $log_state=$paperID." ID li Makale Dosyası için hakemlik talebi KABUL edildi";
    log_all($s_user,$log_state);
    mysqli_query($baglanti,"update review_requests set review_status=1 where id='$id'");
	
	MesajGoster( " You can review the MS in Reviewer Paper Section ");
    Yonlendirme("index.php?page=comment_request&m_id=18&rnb=3");

	
    //header("Refresh:1;  URL = index.php?page=my_request&rnb=3&m_id=14 ");
}