<style>
    .loading {
     background:#ffff;
  position:absolute;
  color:#fff;
  top:50%;
  left:50%;
  padding:15px;
  -ms-transform: translateX(-50%) translateY(-50%);
  -webkit-transform: translate(-50%,-50%);
  transform: translate(-50%,-50%);
}
</style>
<!--
<div class ="loading"> <img  src="loading.gif" alt="processing"/> </div>
-->

<?php
session_start();
ob_start();
include("../app/connect.php");
include("../system.php");
include("function.php");

// PHP 8 Uyumluluğu: Session ve Post verileri için ?? eklendi
$s_user = $_SESSION["user"] ?? "";

$user_query = mysqli_query($baglanti,"SELECT * FROM users where user_name='$s_user' ");
$user_obj = mysqli_fetch_object($user_query);
$name_surname = $user_obj->name_surname ?? "";
$email = $user_obj->email ?? "";

$title = tirnak_replace($_POST["title"] ?? "");
$key_words = tirnak_replace($_POST["key_words"] ?? "");
$abstract = tirnak_replace($_POST["abstract"] ?? "");
$message = tirnak_replace($_POST["message"] ?? "");
$workarea = $_POST["workarea"] ?? "";
$date_time = date('Y-m-d H:i:s');
$type = $_POST["type"] ?? null;

$name_author = $_POST["all_authors"] ?? "";
$all_authors_email = $_POST["all_authors_email"] ?? "";
$corname = $_POST["cur_author"] ?? ""; 
$name1 = $_POST["name_author"] ?? [];
$mail2 = $_POST["author_email_tmp"] ?? [];
$all_authors_orcid = $_POST["all_authors_orcid"] ?? []; 

$yazarlar = [];
$all_email = [];
$yazarlar[0] = $name_surname;

// PHP 8: is_array ile dizi kontrolü yapıldı
$name1_count = is_array($name1) ? count($name1) : 0;
for($i=0; $i <= $name1_count; $i++){
   if(isset($name1[$i]) && strlen($name1[$i]) > 2) {
      $all_email[$i] = $mail2[$i+1] ?? "";                                        
      $yazarlar[$i+1] = $name1[$i];
   }                                                
} 

for($i=0; $i < count($yazarlar); $i++){
    if(isset($yazarlar[$i]) && $corname == $yazarlar[$i]) {
        $yazarlar[$i] .= "*";
    }
} 

$name_author = implode(", ", $yazarlar);       
$all_authors_email = implode(",", $all_email); 
$all_authors_arcid2 = is_array($all_authors_orcid) ? implode(",", $all_authors_orcid) : ""; 

$allowed = array('doc', 'docx','odt','pdf');
$new_name = "-";

if (isset($_FILES['my_file']) && $_FILES['my_file']['error'] == 0) {
    $extension = pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension), $allowed)) {
        echo '{"Error......":"541"}';
       Yonlendirme("index.php?page=add_paper_not_success&rnb=4&m_id=19");
       exit;
    }

    $new_name = '../uploadfiles/nesciences_' . son_kayit_ID_getir() . '_' . date("d_m_y") . '.' . $extension;
    
    if (move_uploaded_file($_FILES["my_file"]["tmp_name"], $new_name)) {
        $log_state="Makale Dosyası Seçildi";
        log_all($s_user,$log_state);
    }
} else {
    $file_error = $_FILES['my_file']['error'] ?? "Bilinmeyen Hata";
    $log_state="HATA -> Makale Dosyası Sisteme Tanıtılmadı----Add Submission--".$file_error;
    log_all($s_user,$log_state);
}

// comitee approval
$new_name2 = "-";
if (isset($_FILES['my_file_Approval']) && $_FILES['my_file_Approval']['error'] == 0) {
    $extension = pathinfo($_FILES['my_file_Approval']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension), $allowed)) {
        echo '{"Error......":"541"}';
        Yonlendirme("index.php?page=add_paper_not_success&rnb=4&m_id=19");
        exit;
    }

    $new_name2 = '../uploadfiles/Approval_' . son_kayit_ID_getir() . '_' . date("d_m_y") . '.' . $extension;
    
    if (move_uploaded_file($_FILES["my_file_Approval"]["tmp_name"], $new_name2)) {
        $log_state="Makale Approval Dosyası Seçildi";
        log_all($s_user,$log_state);
    }
} else {
    $file_approval_error = $_FILES['my_file_Approval']['error'] ?? "Bilinmeyen Hata";
    $log_state="HATA -> Makale Approval Dosyası Sisteme Tanıtılmadı - Add Submission -".$file_approval_error;
    log_all($s_user,$log_state);
}

$date = date("Y-m-d");
$paperid = "NES-" . son_kayit_ID_getir() . '-' . date("d-m-y");
if ($new_name != "") {

    if ($new_name2 != "") {
        $sub_sql="insert into submission_list (name_surname,user_name,title,keyword,workarea,abstract,msg_to_editor,authors,`date`,date_time,paperID,paperID_first,paperfile1,file_approval,email,editorDecision,submission_date)
     VALUES ('$name_surname','$s_user','$title','$key_words','$workarea','$abstract','$message','$name_author','$date','$date_time','$paperid','$paperid','$new_name','$new_name2','$email','$type','$date')";
    } else {
        $sub_sql="insert into submission_list (name_surname,user_name,title,keyword,workarea,abstract,msg_to_editor,authors,`date`,date_time,paperID,paperID_first,paperfile1,email,editorDecision,submission_date)
     VALUES ('$name_surname','$s_user','$title','$key_words','$workarea','$abstract','$message','$name_author','$date','$date_time','$paperid','$paperid','$new_name','$email','$type','$date')";
    }

    if (mysqli_query($baglanti,$sub_sql)){
        $newPaperID_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from submission_list where paperID='$paperid'"));
        $newPaperID = $newPaperID_obj->id ?? ""; // PHP 8 Uyumluluk

        $reviewMail1 = $_POST['reviewMail1'] ?? '';
        if ($reviewMail1 != '') {
            $reviewName1 = $_POST['reviewName1'] ?? '';
            $instition1 = $_POST['affiliation1'] ?? '';
            $count1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail1'"));
            if ($count1>0){
                $countr1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail1' and role!='4'"));
                if($countr1>0){
                    $reviewerID1_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail1'"));
                    $reviewerID1 = $reviewerID1_obj->id ?? "";
                    mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID1')");
                }
                else{
                    $reviewerID1_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail1'"));
                    $reviewerID1 = $reviewerID1_obj->id ?? "";
                    mysqli_query($baglanti,"update users set role=3 where id='$reviewerID1'");
                    mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID1')");
                }
            }
            else{
                $pass = md5(md5($reviewMail1));
                mysqli_query($baglanti,"insert into users (user_name,name_surname,pass,email,role,new_user,instition) VALUES ('$reviewMail1','$reviewName1','$pass' ,'$reviewMail1','3','1','$instition1')");
                $reviewerID1_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail1'"));
                $reviewerID1 = $reviewerID1_obj->id ?? "";
                mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID1')");
            }
        }

        $reviewMail2 = $_POST['reviewMail2'] ?? '';
        if ($reviewMail2 != ''){
            $reviewName2 = $_POST['reviewName2'] ?? '';
            $instition2 = $_POST['affiliation2'] ?? '';
            $count1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail2'"));
            if ($count1>0){
                $countr1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail2' and role!='4'"));
                if($countr1>0){
                    $reviewerID2_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail2'"));
                    $reviewerID2 = $reviewerID2_obj->id ?? "";
                    mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID2')");
                }
                else{
                    $reviewerID2_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail2'"));
                    $reviewerID2 = $reviewerID2_obj->id ?? "";
                    mysqli_query($baglanti,"update users set role=3 where id='$reviewerID2'");
                    mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID2')");
                }
            }
            else{
                $pass = md5(md5($reviewMail2));
                mysqli_query($baglanti,"insert into users (user_name,name_surname,pass,email,role,new_user,instition) VALUES ('$reviewMail2','$reviewName2','$pass' ,'$reviewMail2','3','1','$instition2')");
                $reviewerID2_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail2'"));
                $reviewerID2 = $reviewerID2_obj->id ?? "";
                mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID2')");
            }
        }

        $reviewMail3 = $_POST['reviewMail3'] ?? '';
        if ($reviewMail3 != ''){
            $reviewName3 = $_POST['reviewName3'] ?? '';
            $instition3 = $_POST['affiliation3'] ?? '';
            $count1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail3'"));
            if ($count1>0){
                $countr1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail3' and role!='4'"));
                if($countr1>0){
                    $reviewerID3_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail3'"));
                    $reviewerID3 = $reviewerID3_obj->id ?? "";
                    mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID3')");
                }
                else{
                    $reviewerID3_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail3'"));
                    $reviewerID3 = $reviewerID3_obj->id ?? "";
                    mysqli_query($baglanti,"update users set role=3 where id='$reviewerID3'");
                    mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID3')");
                }
            }
            else{
                $pass = md5(md5($reviewMail3));
                mysqli_query($baglanti,"insert into users (user_name,name_surname,pass,email,role,new_user,instition) VALUES ('$reviewMail3','$reviewName3','$pass' ,'$reviewMail3','3','1','$instition3')");
                $reviewerID3_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail3'"));
                $reviewerID3 = $reviewerID3_obj->id ?? "";
                mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID3')");
            }
        }
        
        $log_state=$paperid." li Makale veritabanına Yüklendi";
        log_all($s_user,$log_state);
        
        // HOCANIN İSTEDİĞİ ŞABLON SİSTEMİ - YAZARA GİDEN MESAJ
        $currespond_message = mail_sablonu("makale_basvurusu_yazar", $title);
        $retval = mail_gonder($email, $title, $currespond_message);
        $log_state="Makale Sisteme Yüklendi.Currespond Author a mail gönderildi";
        log_all($s_user,$log_state);

        if (isset($all_authors_email) && $all_authors_email != "") {
            $authors_mail = explode(",", $all_authors_email);
            
            // HOCANIN İSTEDİĞİ ŞABLON SİSTEMİ - ORTAK YAZARA GİDEN MESAJ
            // Hem makale başlığı hem de ana yazarın adını göndermek için araya "||" işareti koydum
            $other_author_message = mail_sablonu("makale_basvurusu_ortak_yazar", $title . "||" . $name_surname);

            if (count($authors_mail) == 0) {
                $retval = mail_gonder($all_authors_email, $title, $other_author_message);
                $log_state="Makale Sisteme Yüklendi.Co-Author ".$all_authors_email." a mail gönderildi";
                log_all($s_user,$log_state);
            } else {
                for ($i = 0; $i < count($authors_mail); $i++) {
                    if (trim($authors_mail[$i]) != "") {
                        $retval = mail_gonder($authors_mail[$i], $title, $other_author_message);
                        $log_state="Makale Sisteme Yüklendi.Co-Author ".$authors_mail[$i]." a mail gönderildi";
                        log_all($s_user, $log_state);
                    }
                }
            }
        }

        $message = $name_surname . " tarafından yeni bir makale yüklendi";
        send_message($message, 2, "NESciences", 2);

        $n_id = $_GET["ncp_id"] ?? "";
        if ($n_id != "") {
            mysqli_query($baglanti,"delete from submission_list_temp where id='$n_id'");
        } else {
            $ncp_obj = mysqli_fetch_object(mysqli_query($baglanti,"SELECT max(id) as max_id FROM submission_list_temp where user_name='$s_user'"));
            $ncp_id = $ncp_obj->max_id ?? "";
            if ($ncp_id != "") {
                mysqli_query($baglanti,"update submission_list_temp  set state=0 where id='$ncp_id'");
            }
        }

        Yonlendirme("index.php?page=add_paper_success&rnb=4&m_id=19");
        
    } else {
        $log_state="HATA - > makale yükleme veri tabanı hatası".mysqli_error($baglanti);
        log_all($s_user,$log_state);
    }

} else {
    $log_state="Hata -> Makale Dosyası Seçilmedi";
    log_all($s_user,$log_state);
    Yonlendirme("index.php?page=add_paper_not_success&rnb=4&m_id=19");       
}
?>