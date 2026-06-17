<?php
include("../app/connect.php");
include("../system.php");
include("function.php");

$id=$_GET['id'];
$query1=mysqli_query($baglanti,"DELETE FROM author_review_requests WHERE paperID='$id'");
$query2=mysqli_query($baglanti,"DELETE FROM cited_table WHERE sub_id='$id'");
$query3=mysqli_query($baglanti,"DELETE FROM review_requests WHERE paperid='$id'");
$query4=mysqli_query($baglanti,"DELETE FROM send_back_author WHERE paper_id='$id'");
$query5=mysqli_query($baglanti,"DELETE FROM submission_list WHERE id='$id'");
$query6=mysqli_query($baglanti,"DELETE FROM submission_revision WHERE sub_id='$id'");

//header("Refresh:2;  URL = index.php?page=deletePaper&m_id=36&rnb=2 ");
MesajGoster("Please Wait ....");
Yonlendirme("index.php?page=deletePaper&m_id=36&rnb=1");

?>