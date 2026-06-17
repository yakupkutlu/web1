<?php


include("../app/connect.php");
include("function.php");
include("../system.php");
session_start();
ob_start();

$s_user = $_SESSION["user"];
$p_id = $_GET["id"];
$process = $_GET["process"];
 

$referans = $_POST["references"];

$volume = $_POST["volume"];
$no = $_POST["number"];
$pp = $_POST["pp"];
$start_page = $_POST["start_page"];
$yayin_yili = $_POST["year"];
$doi= $_POST["doi"];
$yturu= $_POST["yturu"];
$earlyview= $_POST["earlyview"];


$submission_date=$_POST["submission_date"];  
$accept_date=$_POST["accept_date"];  
$publish_date=$_POST["publish_date"];  
$available_date=$_POST["available_date"];  

 
 


$keywords1 = tirnak_replace($_POST["keywords1"]);
$abstract=tirnak_replace($_POST["abstract"]);
$referans = tirnak_replace($referans);

$referans=str_replace("</br>", "", $referans);
$referans=str_replace("<br>", "", $referans);

//echo "------------1 <br>";

if (preg_match_all("/\n/", $referans)) {
    $temp_referans = explode("\n", $referans);
    $referans = "";
    foreach ($temp_referans as $temp) {
        $referans .= "<br>" . $temp;
    }

//echo "------------2 <br>";
}

//echo "------------3 <br>";


if ($process == "content_save") {
    $title = tirnak_replace($_POST["title"]);
    
 //  echo "------------4 <br>";
    $authors = $_POST["authors"];
    $pQuery = "update submission_list set `references`='$referans',yayin_turu='$yturu', title='$title',abstract='$abstract',authors='$authors',keyword='$keywords1', volume='$volume',`no`='$no',pp='$pp',start_page='$start_page', doi='$doi',`year`='$yayin_yili',submission_date='$submission_date',   accept_date='$accept_date',  publish_date='$publish_date',  available_date='$available_date', `earlyview`='$earlyview' where id='$p_id'";
    if (mysqli_query($baglanti,$pQuery)) {
        $log_state = $p_id . " ID li Makale CONTENT düzenlendiI";
        log_all($s_user, $log_state);
        $URL = "index.php?page=edit_page&m_id=1&edit_page=content";
        Yonlendirme($URL);
       // header("Refresh:1;  URL = index.php?page=edit_page&m_id=1&edit_page=content ");
    } else {
        //echo "Veritabanı Hatası";
        $log_state = "HATA ->" . $p_id . " ID li Makale CONTENT VERİTABANI HATASI";
        log_all($s_user, $log_state);
        echo "hata" . mysqli_error();
    }

} else {
    
    //   echo "------------5 <br>";
    $title = tirnak_replace($_POST["title"]);
    $authors = $_POST["authors"];
    $pQuery = "update submission_list set publish=-1,title='$title',authors='$authors',yayin_turu='$yturu',abstract='$abstract',keyword='$keywords1',`references`='$referans',volume='$volume',`no`='$no',pp='$pp',start_page='$start_page', doi='$doi',`year`='$yayin_yili' , submission_date='$submission_date',   accept_date='$accept_date',  publish_date='$publish_date',  available_date='$available_date',`earlyview`='$earlyview'  where id='$p_id'";
    if (mysqli_query($baglanti,$pQuery)) {
        $log_state = $p_id . " ID li Makale Dosyası YAYINLANDI";
        log_all($s_user, $log_state);
        $URL = "index.php?page=publishing_papers&m_id=12&rnb=2";
       // header("Refresh:1;  URL = index.php?page=accepted_paper&rnb=2&m_id=11 ");
       Yonlendirme($URL);
          //header("Refresh:1;  URL = index.php?page=publishing_papers&m_id=12&rnb=2");
        
    } else {
     
    //   echo "------------6 <br>";
        //echo "Veritabanı Hatası";
        $log_state = "HATA ->" . $p_id . " ID li Makale Dosyası VERİTABANI HATASI";
        log_all($s_user, $log_state);
    }
}


     //  echo "------------7 <br>";