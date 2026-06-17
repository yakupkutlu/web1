<?php
include("../app/connect.php");
include ("../system.php");
include "function.php";
$paperCode=$_GET["id"];
$message=tirnak_replace($_POST["message"]);

$rnQuery="select * from submission_list where id='$paperCode'";
$rnQuery_prop=mysqli_fetch_object(mysqli_query($baglanti,$rnQuery));
$subID=$rnQuery_prop->id;
$name_surname=$rnQuery_prop->name_surname;

$rQuery="update submission_list set proof_state=1,msg_publishing='$message' WHERE id='$subID'";
if (mysqli_query($baglanti,$rQuery)){
    $log_state=$paperCode." Nolu Makaleyi ONAYLADI";
    log_all($name_surname,$log_state);
    $message=$name_surname." tarafından ".$paperCode." ID li makale onayladı";
    send_message($message,2,$journalShortName,2);
    MesajGoster("Sent Message...[OK]");
    header("Refresh:1;  URL = index.php?page=proof_correction&m_id=25&rnb=4 ");
}
else
{
    echo "Veritabanı Hatası";
    $log_state="HATA ->".$paperCode." Nolu Makaleyi ONAYLAYAMADI ->".mysqli_error();
    log_all($name_surname,$log_state);
}