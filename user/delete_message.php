<?php
include("../app/connect.php");
include ("../system.php");
session_start();
ob_start();
$user_name=$_SESSION["user"];
$id=$_GET["id"];

$page=$_GET["page"];
if ($page=="systemm"){
	
		 
		 $sql="update contact set state=-1 WHERE id='$id'";

		if (mysqli_query($baglanti,$sql)){
			$log_state=$id." Nolu mesaj silindi";
			log_all($user_name,$log_state);
			header("Refresh:2;  URL = index.php?page=contact&m_id=2&rnb=1");
			die();
		}

		else {
			$log_state=" HATA - > Mesaj Silinemedi ".mysqli_error();
			log_all($user_name,$log_state);
			header("Refresh:2;  URL = index.php?page=contact&m_id=2&rnb=1");
			die();
		}
				
}
else{
			 
		$sql="update message_table set state=-1 WHERE id='$id'";

		if (mysqli_query($baglanti,$sql)){
			$log_state=$id." Nolu mesaj silindi";
			log_all($user_name,$log_state);
			header("Refresh:2;  URL = index.php?page=message ");
			die();
		}

		else {
			$log_state=" HATA - > Mesaj Silinemedi ".mysqli_error();
			log_all($user_name,$log_state);
			header("Refresh:2;  URL = index.php?page=message ");
			die();
		}
}