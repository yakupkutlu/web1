<?php
session_start();
ob_start();
include("../app/connect.php");
include("function.php");
include("../system.php");

$s_user = $_SESSION["user"];
$decision = $_POST["iCheck"];
$message = $_POST["message"];
$editor_message = $_POST["editor_message"];
$paperID = $_POST["paperid"];
$requestID = $_POST["r_id"];
$tarih = date("d F Y");

$message=tirnak_replace($message);
$editor_message=tirnak_replace($editor_message);

$quality=$_POST["quality"];
$newness=$_POST["newness"];
$contribution=$_POST["contribution"];

// A list of permitted file extensions
// C:\xampp\php\php.ini ayarları düzenle

$allowed = array('doc', 'docx','odt');
$new_name = "NULL";

if (isset($_FILES['my_file']) && $_FILES['my_file']['error'] == 0) {

    $extension = pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension), $allowed)) {
        MesajGoster( "Please upload word file   !!!");        
       // echo 'Please upload word file   !!!';
        header("Refresh:1;  URL = index.php?page=review_add_comment&rnb=3&id=$requestID ");
        exit;
    }

    $new_name = '../reviewreports/' . $paperID . '-' . $requestID . '.' . $extension;
    
    if (move_uploaded_file($_FILES["my_file"]["tmp_name"], $new_name)) {
        //echo '{"status":"success"}';
        $log_state = $paperID." İçin Yorum 1 Dosyası Seçildi";
        log_all($s_user, $log_state);

    }
    
} else {
   // echo "Please contact journal admin for Error  ==>  Error NO:211 ";
    $log_state = "HATA -> ".$paperID." İçin Yorum 1 Dosyası Sisteme Tanıtılmadı" . $_FILES['my_file']['error'];
    log_all($s_user, $log_state);
}

$new_name2 = "NULL";

if (isset($_FILES['my_file_2']) && $_FILES['my_file_2']['error'] == 0) {

    $extension = pathinfo($_FILES['my_file_2']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension), $allowed)) {
 MesajGoster( "Please upload word file   !!!");        
// echo 'Please upload word file  !!!';
        header("Refresh:1;  URL = index.php?page=review_add_comment&rnb=3&id=$requestID ");
         exit;
    }
    $new_name2 = '../reviewreports/' . $paperID . '-' . $requestID . '_2.' . $extension;
    
    if (move_uploaded_file($_FILES["my_file_2"]["tmp_name"], $new_name2)) {
       //echo '{"status":"success"}';
       $log_state = $paperID." İçin Yorum 2 Dosyası Seçildi";
       log_all($s_user, $log_state);
    }
    
} else {

    //echo $_FILES['my_file']['error'];
    //MesajGoster( "Please contact journal admin for Error ==> Error NO:212");
    $log_state = "HATA -> ".$paperID." İçin Yorum 2 Dosyası Sisteme Tanıtılmadı" . $_FILES['my_file']['error'];
    log_all($s_user, $log_state);
    
}

$date = date("Y-m-d");
$reviewer = mysqli_fetch_object(mysqli_query($baglanti,"Select * from users where id=(Select reviewerid from review_requests WHERE id='$requestID')"))->name_surname;
$title = mysqli_fetch_object(mysqli_query($baglanti,"select * from submission_list where paperID='$paperID'"))->title;

$thank_file_name =  date("d-m-Y");
//$thank_file_name = $paperIDstart."-" . date("d-m-Y-h-i-s") . ".docx";
$rQuery = "update review_requests set quality='$quality',newness='$newness',contribution='$contribution', acceptance_status='$decision',`date`='$date',paper_report='$message',thank_file_name='$thank_file_name',editor_comment='$editor_message' ,report_file='$new_name',report_file_2='$new_name2' WHERE id='$requestID'";
$resulrquery=mysqli_query($baglanti,$rQuery);
 
/*
echo "decision - >".$decision."</br>";
echo "date - >".$date."</br>";
echo "message - >".$message."</br>";
echo "thank_file_name - >".$thank_file_name."</br>";
echo "editor_message - >".$editor_message."</br>";
echo "new_name - >".$new_name."</br>";
echo "new_name2 - >".$new_name2."</br>";
echo "requestID - >".$requestID."</br>";*/
 

if ($resulrquery) {
    $log_state=$paperID." İçin Hakem Yorumu Sisteme Yüklendi.Currespond Author a mail gönderildi";
    log_all($s_user,$log_state);
    
	
	MesajGoster( "Your reviewing is being sent.");
    Yonlendirme("index.php?page=my_request&rnb=3&m_id=14 ");
  
  
  //header("Refresh:1;  URL = index.php?page=my_request&rnb=3&m_id=14 ");
   /*  if(create_thank_text($tarih, $reviewer, $title, $thank_file_name, $paperID))
    {
      header("Refresh:1;  URL = index.php?page=my_request&rnb=3&m_id=14 ");
  	 }
    else 
    {
  		 header("Refresh:1;  URL = index.php?page=my_request&rnb=3&m_id=14 ");

   	}
   
     */
    
   
  //  header("Refresh:1;  URL = index.php?page=comment_request&m_id=18&rnb=3");
    // header("Location: index.php?page=comment_request&m_id=18&rnb=3");
      
    
     
} else {
 
    $log_state = "HATA -> Veritabanı Bağlantı Hatası";
    log_all($s_user, $log_state);
    $error_message="Database Error - >".mysqli_error();
    MesajGoster($error_message);
}
 
