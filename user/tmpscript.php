<?php
include('../app/connect.php');


$tmp = mysqli_query($baglanti,"select * from users");
while($dt = mysqli_fetch_array($tmp)){
	$email = $dt["email"];
	$id = $dt["id"];
	// echo $id."- ".$email."<br>";
	//mysqli_query($baglanti,"update users set user_name = '$email' where id = $id");
	
	try {
	  $conn = mysqli_query($baglanti,"update users set user_name = '$email' where id = $id");
	  if (!$conn) throw new Exception("mysql Error");
	} catch(Exception $e) {
	  echo $id."  #".$e->getMessage()."- ".mysql_errno()."<br>";
	}
}
?>