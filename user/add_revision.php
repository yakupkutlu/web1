<?php
session_start();
ob_start();
include("../app/connect.php");
include("function.php");
include("../system.php");

 MesajGoster("Please Wait.....");
 
 
$s_user = $_SESSION["user"];
$paperCode = $_POST["paperCode"];
$paperTitle = $_POST["paperTitle"];
$authors = $_POST["authors"];
$keywords = $_POST["keywords"];
$abstract = $_POST["abstract"];
$message = $_POST["message"];

$abstract = tirnak_replace($abstract);
$paperTitle = tirnak_replace($paperTitle);
$keywords = tirnak_replace($keywords);
$message = tirnak_replace($message);

$rnQuery = "select * from submission_list where paperID='$paperCode'";
$rnQuery_prop = mysqli_fetch_object(mysqli_query($baglanti,$rnQuery));
$revisedNumber = $rnQuery_prop->revised_number;
$subID = $rnQuery_prop->id;
$paperID_first = $rnQuery_prop->paperID_first;
$paperID = $rnQuery_prop->paperID;
$old_paperFile = $rnQuery_prop->paperfile1;
$name_surname = $rnQuery_prop->name_surname;
$new_rNumber = $revisedNumber + 1;
$new_paperID = $paperID_first . "-R" . $new_rNumber;
$upload_date = date("Y-m-d");

      


// A list of permitted file extensions
// C:\xampp\php\php.ini ayarları düzenle
$allowed = array('zip', 'rtf', 'doc',  'docx', 'pdf');
$new_name = "";
if (isset($_FILES['my_file']) && $_FILES['my_file']['error'] == 0) {

    $extension = pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension), $allowed)) {
        echo '{"Error":"551"}';
 MesajGoster("Error while Uploading File 1 !!! Please contact Editor");
          
header("Refresh:2;  URL = index.php?page=author_revision&m_id=24&rnb=4 ");
        exit;
    }


$new_name = '../uploadfiles/'.$journalShortName.'_' . $paperID_first . '-R' . $new_rNumber . '.' . $extension;
    if (move_uploaded_file($_FILES["my_file"]["tmp_name"], $new_name)) {
        //echo '{"status":"success"}';
        $log_state = "Selected Paper File..";
        log_all($s_user, $log_state);

    }
} else {
    echo $_FILES['my_file']['error'];
    $log_state = "Error  -> Paper File nor upload in system->" . $_FILES['my_file']['error'];
    log_all($s_user, $log_state);
    MesajGoster("Error while Uploading File 1 !!! Please contact Editor"); 
    header("Refresh:2;  URL = index.php?page=author_revision&rnb=4&m_id=24 ");
exit;
}





$new_name_2 = "";
if (isset($_FILES['my_file_reviewer']) && $_FILES['my_file_reviewer']['error'] == 0) {

    $extension_2 = pathinfo($_FILES['my_file_reviewer']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension_2), $allowed)) {
        echo '{"Error":"541"}';
         MesajGoster("Error while Uploading File 2 !!! Please contact Editor");
    header("Refresh:2;  URL = index.php?page=author_revision&rnb=4&m_id=24 ");
        exit;
        //exit;
    }

    $new_name_2 = '../reviewerCommentFile/'.$journalShortName.'_' . $paperID_first . '-R' . $new_rNumber . '.' . $extension_2;
    if (move_uploaded_file($_FILES["my_file_reviewer"]["tmp_name"], $new_name_2)) {
        //echo '{"status":"success"}';
        $log_state = "Reviewer comment file uploaded";
        log_all($s_user, $log_state);

    } else echo "hata" . $_FILES['my_file_reviewer']['error'];
}

else {
    echo $_FILES['my_file_reviewer']['error'];
    $log_state = "Error  -> Reviewer file did not upload->" . $_FILES['my_file_reviewer']['error'];
    log_all($s_user, $log_state);
       MesajGoster("Error while Uploading File 2 !!! Please contact Editor");
  
        header("Refresh:2;  URL = index.php?page=author_revision&rnb=4&m_id=24 ");
exit;
}


$new_name3 = "";
if (isset($_FILES['my_file_COPYRIGHT']) && $_FILES['my_file_COPYRIGHT']['error'] == 0) {

    $extension = pathinfo($_FILES['my_file_COPYRIGHT']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension), $allowed)) {
        echo '{"Error":"551"}';
 MesajGoster("Error while Uploading COPYRIGHT_File !!! Please contact Editor");
          
header("Refresh:2;  URL = index.php?page=author_revision&m_id=24&rnb=4 ");
        exit;
    }

    $new_name3 = '../uploadfiles/COPYRIGHT_' . $paperID_first . '-R' . $new_rNumber . '.' . $extension;
    if (move_uploaded_file($_FILES["my_file_COPYRIGHT"]["tmp_name"], $new_name3)) {
        //echo '{"status":"success"}';
        $log_state = "Makale COPYRIGHT_ Dosyası Seçildi";
        log_all($s_user, $log_state);

    }
} else {
    echo $_FILES['my_file_COPYRIGHT']['error'];
    $log_state = "HATA -> Makale COPYRIGHT_ Dosyası Sisteme Tanıtılmadı->" . $_FILES['my_file_COPYRIGHT']['error'];
    log_all($s_user, $log_state);
    MesajGoster("Error while Uploading COPYRIGHT_File !!! Please contact Editor"); 
    header("Refresh:2;  URL = index.php?page=author_revision&rnb=4&m_id=24 ");
exit;
}







// graphic abstract

$file_graph = $_POST["my_Approval"];
 
if($file_graph=="YES"){
$allowed = array('jpeg', 'ppt', 'pptx', 'jpg', 'png', 'pdf');
$new_name_4 = "";
if (isset($_FILES['my_file_graph']) && $_FILES['my_file_graph']['error'] == 0) {

    $extension_2 = pathinfo($_FILES['my_file_graph']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension_2), $allowed)) {
        echo '{"Error":"541"}';
         MesajGoster("Error while Uploading File 4 !!! Please contact Editor");
    header("Refresh:2;  URL = index.php?page=author_revision&rnb=4&m_id=24 ");
        exit;
        //exit;
    }



    $new_name_4 = '../paperimages/image_'.$paperID_first. '-R' . $new_rNumber . '.' . $extension_2;
    
    if (move_uploaded_file($_FILES["my_file_graph"]["tmp_name"], $new_name_4)) {
        //echo '{"status":"success"}';
        $log_state = "Reviewer comment file uploaded";
        log_all($s_user, $log_state);

    } else echo "hata" . $_FILES['my_file_graph']['error'];
}

else {
    echo $_FILES['my_file_graph']['error'];
    $log_state = "Error  -> Reviewer file did not upload->" . $_FILES['my_file_graph']['error'];
    log_all($s_user, $log_state);
       MesajGoster("Error while Uploading File 4 2 !!! Please contact Editor");
  
        header("Refresh:2;  URL = index.php?page=author_revision&rnb=4&m_id=24 ");
exit;
}


}








if ($new_name != "") {
// accept_status u -2 yaparak revize olduğunu belirledik
    $rQuery = "update submission_list set title='$paperTitle',authors='$authors', keyword='$keywords' ,abstract='$abstract',	msg_to_editor='$message',reviewer_comment_file='$new_name_2', file_copyright='$new_name3',
paperfile1='$new_name',paperfile2='$old_paperFile',coverImage= '$new_name_4'  , paperID='$new_paperID',revision_status=0,revised_number='$new_rNumber',accept_status=-2,reviever_state=0 WHERE id='$subID'";
    if (mysqli_query($baglanti,$rQuery)) {
        mysqli_query($baglanti,"update review_requests set state=0 where paperid='$subID'");
        mysqli_query($baglanti,"insert into submission_revision (sub_id,last_paperID,paper_file_old,paper_file_new,upload_date)
 VALUES ('$subID','$paperID','$old_paperFile','$new_name','$upload_date')");
        $message = $name_surname . " tarafından Revizyon makale yüklendi";
        log_all($name_surname, $message);

        send_message($message, 2, $journalShortName, 2);
        MesajGoster("Upload Revizion Completed .. [OK]");
        header("Refresh:2;  URL = index.php?page=author_revision&rnb=4&m_id=23 ");
    } else echo "Veritabanı Hatası";
} else {
    $log_state = "Hata -> Makale Dosyası Seçilmedi";
    log_all($s_user, $log_state);
    MesajGoster("Not Completed Upload File !!! </br>Select Manuscript File !!!");
    header("Refresh:2;  URL = index.php?page=author_revision&rnb=4&m_id=24 ");
exit;
}


