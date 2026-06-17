<?php
session_start();
ob_start();
include("../app/connect.php");
include("../system.php");
include("function.php");

$email="yakupkutlu@gmail.com";
$title="test123";
$currespond_message="test test test";
$head1="From:".$email;
 $retval = mail($email, $title, $currespond_message,$head1);
 echo  $retval;


 $retval = mail_gonder($email, $title, $currespond_message);
 echo  $retval;

?>