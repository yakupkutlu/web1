<?php

if(isset($_POST['aranacak'])){
  $gelen=$_POST['aranacak'];
 

header("Location: index.php?page=archive&genel_aranan=$gelen");
}else{

$gelen=$_POST['aranacak'];
/*
$gelen=$_POST['aranan'];
$page=$_GET["page"];
$volume=$_GET["volume"];
$no=$_GET["no"];
$year=$_GET["year"];
*/
$text1="Location: index.php?page=archive";
//echo "--".$_POST['aranan'];

if(isset($_POST['aranan'])){
	$gelen=$_POST['aranan'];
	$text1=$text1."&aranan=".$gelen;
}
if(isset($_GET['volume']))
	$text1.="&volume=".$_GET['volume'];
if(isset($_GET['no']))
	$text1.="&no=".$_GET['no'];
if(isset($_GET['year']))
	$text1.="&year=".$_GET['year'];


//echo $text1;
header($text1);
}
?>