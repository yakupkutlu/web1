<?php
include ("../app/connect.php");
session_start();
ob_start();
$user_name=$_SESSION["user"];
$mQuery="update message_table set state=0 WHERE user_name='$user_name'";
if (mysqli_query($baglanti,$mQuery)){
    header("Refresh:1;  URL = index.php?page=message");
}
else echo "Database Error";