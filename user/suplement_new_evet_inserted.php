<?php


include("../app/connect.php");
include("function.php");
include("../system.php");
session_start();
ob_start();

$s_user = $_SESSION["user"];

$eid=$_POST["eid"];
$volume = $_POST["volume"];
$year = $_POST["year"];
$event_short_name=$_POST["event_short_name"];
$event_cite_name=$_POST["event_cite_name"];
$supplamentTittle=$_POST["supplamentTittle"];
$SupplementNo=$_POST["SupplementNo"];
$published_paperIDs= $_POST["published_paperIDs"];
$yayin_turu= $_POST["yturu"];

if($_POST["eid"]) {
	 $pQuery ="update supplementary_events set `event_short_name`='$event_short_name', `event_cite_name`='$event_cite_name', `supplamentTittle`='$supplamentTittle', `SupplementNo`='$SupplementNo', `published_paperIDs`='$published_paperIDs', `yayin_turu`='$yayin_turu', `year`='$year', `volume`='$volume' where `id`='$eid'";
  
}else {
 $pQuery ="INSERT INTO `supplementary_events`(`event_short_name`, `event_cite_name`, `supplamentTittle`, `SupplementNo`, `published_paperIDs`, `yayin_turu`, `year`, `volume`)VALUES ($event_short_name, $event_cite_name,$supplamentTittle, $SupplementNo, $published_paperIDs, $yayin_turu, $year, $volume)";
  

}
 
      	//INSERT INTO `supplementary_events`( event_short_name, event_cite_name, supplamentTittle, 
      	//SupplementNo, published_paperIDs, yayin_turu, year, volume)`$suplementary_name`,
      	
      	//`$event_short_name`, `$event_cite_name`,`$supplamentTittle`, `$SupplementNo`, `$published_paperIDs`, `$yayin_turu`,
       // `$year`, `$volume`)
 // $pQuery ="INSERT INTO supplementary_events (event_short_name, event_cite_name, supplamentTittle, SupplementNo, published_paperIDs, yayin_turu, year, volume) VALUES ( `$event_short_name`, `$event_cite_name`,`$supplamentTittle`, `$SupplementNo`, `$published_paperIDs`, `$yayin_turu`, `$year`, `$volume`)";
 
   // $pQuery = "update submission_list set `references`='$referans',title='$title',abstract='$abstract',authors='$authors',keyword='$keywords1', volume='$volume',`no`='$no',pp='$pp',start_page='$start_page', doi='$doi',`year`='$yayin_yili' where id='$p_id'";
    if (mysqli_query($baglanti,$pQuery)) {
        $log_state = " new Supplement eklendi ";
        log_all($s_user, $log_state);
         MesajGoster("New Supplement is added...");
        header("Refresh:1;  URL = index.php?page=events&m_id=42&rnb=1");
    } else {
        //echo "Veritabanı Hatası";
        $log_state = "HATA -> ID li Makale CONTENT VERİTABANI HATASI";
        log_all($s_user, $log_state);
        echo "hata" . mysqli_error();
    }

 
?>
