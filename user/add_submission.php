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

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//include("../app/connect.php");
//include("../system.php");
//include("function.php");

// PHP 8 Uyumluluğu: Session kontrolü
$s_user = $_SESSION["user"] ?? null;
if(!$s_user){
      echo $_POST["s_user"] ?? "";
      MesajGoster("Error.  please contact Management Editor of Journal .");
      exit();
}

MesajGoster("Please Wait .... ");

$user_obj = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM users where user_name='$s_user' "));
$name_surname = $user_obj->name_surname ?? "";
$email = $user_obj->email ?? "";

$title = tirnak_replace($_POST["title"] ?? "");
$key_words = tirnak_replace($_POST["key_words"] ?? "");
$abstract = tirnak_replace($_POST["abstract"] ?? "");
$message = tirnak_replace($_POST["message"] ?? "");
$workarea = $_POST["workarea"] ?? "";
$date_time = date('Y-m-d H:i:s');
$type = $_POST["type"] ?? null;

/// yazarları getir  
$name_author = $_POST["all_authors"] ?? "";

$all_authors_email = $_POST["all_authors_email"] ?? "";  
$all_authors_namesurname = isset($_POST["name_author"]) && is_array($_POST["name_author"]) ? implode(",", $_POST["name_author"]) : "";  
$all_authors_orcid = $_POST["all_authors_orcid"] ?? ""; 
$all_authors_institution = $_POST["all_authors_institution"] ?? "";  
$all_authors_country = $_POST["all_authors_country"] ?? "";  

$corname = $_POST["cur_author"] ?? ""; 
$name1 = $_POST["name_author"] ?? [];
$mail2 = $_POST["author_email_tmp"] ?? [];
$all_authors_orcid_tmp = $_POST["all_authors_orcid_tmp"] ?? []; 

$yazarlar = [];
$all_email = [];
$yazarlar[0] = $name_surname;
$correspond_yazar_indis = -1;

$name1_count = is_array($name1) ? count($name1) : 0;
for($i=0; $i < $name1_count; $i++){
   if(isset($name1[$i]) && strlen($name1[$i])>2) {
      $all_email[$i] = $mail2[$i+1] ?? "";                                        
      $yazarlar[$i+1] = $name1[$i];
   }                                                
} 

for($i=0; $i < count($yazarlar); $i++){
    if(isset($yazarlar[$i]) && $corname == $yazarlar[$i]) {
        $yazarlar[$i] .= "*";
        $correspond_yazar_indis = $i;
    }
} 

$name_author = implode(", ", $yazarlar);       
$all_authors_email = is_array($all_email) ? implode(",", $all_email) : ""; 
$all_authors_arcid2 = is_array($all_authors_orcid) ? implode(",", $all_authors_orcid) : $all_authors_orcid; 

function generateNewID($id) {
    $newid="";
    for ($i=1; $i<=4; $i++) {
       $newid .= rand(0,9);
    }
     
    if ($id < 10) {
        return '00' . $id.$newid;
    } 
    elseif ($id < 100) {
        return '0' . $id.$newid;
    } 
    else {
        return $id.$newid;
    } 
}

$allowed = array('doc', 'docx','odt','pdf');
$new_name = "-";

$generatedPaperId = generateNewID(son_kayit_ID_getir());

if (isset($_FILES['my_file']) && $_FILES['my_file']['error'] == 0) {

    $extension = pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension), $allowed)) {
        echo '{"Error......":"541"}';
       Yonlendirme("index.php?page=add_paper_not_success&rnb=4&m_id=19");
       exit;
    }

    $new_name = '../uploadfiles/'.($journalShortName ?? 'journal').'_' . $generatedPaperId.'.'.$extension;
    
    if (move_uploaded_file($_FILES["my_file"]["tmp_name"], $new_name)) {
        $log_state="Makale Dosyası Seçildi";
        echo '<script type="text/javascript">',
         'document.getElementsByClassName("message-info")[0].innerHTML =document.getElementsByClassName("message-info")[0].innerHTML+   "<br> > Manuscript file has been uploaded";',
         '</script>'; 
        log_all($s_user,$log_state);
    }
} else {
    $file_err = $_FILES['my_file']['error'] ?? "Unknown";
    $log_state="HATA -> Makale Dosyası Sisteme Tanıtılmadı----Add Submission--".$file_err;
    log_all($s_user,$log_state);
    
    echo '<script type="text/javascript">',
         'document.getElementById("message-info").innerHTML = "<br> > Manuscript file could not   be uploaded ..... X ERROR X";',
         '</script>';
    echo '<script type="text/javascript">',
         'document.getElementsByClassName("message-info")[0].innerHTML =document.getElementsByClassName("message-info")[0].innerHTML+  "<br> > Manuscript file could not   be uploaded ..... X ERROR X";',
         '</script>'; 
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

    $new_name2 = '../uploadfiles/Approval_'.$generatedPaperId.'.'.$extension;
    
    if (move_uploaded_file($_FILES["my_file_Approval"]["tmp_name"], $new_name2)) {
        $log_state="Makale Approval Dosyası Seçildi";
        log_all($s_user,$log_state);
        echo '<script type="text/javascript">',
         'document.getElementsByClassName("message-info")[0].innerHTML =document.getElementsByClassName("message-info")[0].innerHTML+   "<br> > Approval file has been uploaded";',
         '</script>'; 
    }
    
} else {
    $approval_err = $_FILES['my_file_Approval']['error'] ?? "Unknown";
    $log_state="HATA -> Makale Approval Dosyası Sisteme Tanıtılmadı - Add Submission -".$approval_err;
    log_all($s_user,$log_state); 
    echo '<script type="text/javascript">',
         'document.getElementsByClassName("message-info")[0].innerHTML =document.getElementsByClassName("message-info")[0].innerHTML+  "<br> > Approval file could not  be uploaded ..... X ERROR X";',
         '</script>';   
}
// end comitee approval

// abstract image upload  --------------------
$allowed3 = array('jpg', 'jpeg','png','ppt','pptx','pdf');
$new_name3 = "-";
if (isset($_FILES['my_abstractimage']) && $_FILES['my_abstractimage']['error'] == 0) {

    $extension = pathinfo($_FILES['my_abstractimage']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension), $allowed3)) {
        echo '{"Error......":"217"}';
        Yonlendirme("index.php?page=add_paper_not_success&rnb=4&m_id=19");
        exit;
    }
     $_new_name3='image_'.$generatedPaperId.'.'.$extension;
    $new_name3 = '../paperimages/image_'.$generatedPaperId.'.'.$extension;
    
    if (move_uploaded_file($_FILES["my_abstractimage"]["tmp_name"], $new_name3)) {
        $log_state="abstract image dosyası yuklendi ";
        log_all($s_user,$log_state);
        echo '<script type="text/javascript">',
         'document.getElementsByClassName("message-info")[0].innerHTML =document.getElementsByClassName("message-info")[0].innerHTML+ "<br> > Abstract image  file han been uploaded  ";',
         '</script>';
    }
} else {
    $abstract_err = $_FILES['my_abstractimage']['error'] ?? "Unknown";
    $log_state="HATA -> Makale Abstract Image Sisteme Tanıtılmadı - Add Submission -".$abstract_err;
    log_all($s_user,$log_state);
    echo '<script type="text/javascript">',
         'document.getElementsByClassName("message-info")[0].innerHTML =document.getElementsByClassName("message-info")[0].innerHTML+  "<br> > Abstract image  file could not  be uploaded ..... X ERROR X";',
         '</script>';
}

$date = date("Y-m-d");
$paperIDstart = $paperIDstart ?? "NES";
$paperid =$paperIDstart. '-' . $generatedPaperId;

if ($new_name != "-") 
{
    if ($new_name2 != "-") {
        $sub_sql="insert into submission_list (name_surname,user_name,title,keyword,workarea,abstract,msg_to_editor,authors,`date`,date_time,paperID,paperID_first,paperfile1,file_approval,email,editorDecision,submission_date,coverImage)
         VALUES ('$name_surname','$s_user','$title','$key_words','$workarea','$abstract','$message','$name_author','$date','$date_time','$paperid','$paperid','$new_name','$new_name2','$email','$type','$date', '$new_name3')";
    } else {
        $sub_sql="insert into submission_list (name_surname,user_name,title,keyword,workarea,abstract,msg_to_editor,authors,`date`,date_time,paperID,paperID_first,paperfile1,email,editorDecision,submission_date,coverImage)
         VALUES ('$name_surname','$s_user','$title','$key_words','$workarea','$abstract','$message','$name_author','$date','$date_time','$paperid','$paperid','$new_name','$email','$type','$date', '$new_name3')";
    }

if (mysqli_query($baglanti,$sub_sql)) {
        $newPaperID_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from submission_list where paperID='$paperid'"));
        $newPaperID = $newPaperID_obj->id ?? "";

        // INSERT INTO `authors_of_manuscript`
        $authors_emails = explode(",", $all_authors_email);
        $authors_namesurnames = explode(",", $all_authors_namesurname);   
        $authors_orcids = explode(",", $all_authors_orcid);  
        $authors_institution = explode(",", $all_authors_institution);   
        $authors_country = explode(",", $all_authors_country);   

        for ($i=0; $i<count($authors_emails);$i++) {
            if(trim($authors_emails[$i]) == "") continue;

            if($correspond_yazar_indis == ($i-1)) {
                $corr_yazar=1;
            } else {
                $corr_yazar=0;
            }
                        
            $authorMail = $authors_emails[$i] ?? "";
            $authorName = $authors_namesurnames[$i] ?? "";
            $authorInstition = $authors_institution[$i] ?? "";
            $authorOrcid = $authors_orcids[$i] ?? "";
            $authorCountry = $authors_country[$i] ?? "";
            
            $count1 = mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$authorMail'"));
            if ($count1>0) {
                $userID1_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$authorMail'"));
                $userID1 = $userID1_obj->id ?? "";
                mysqli_query($baglanti,"insert into authors_of_manuscript (paperID,userID,correspond) VALUES ('$newPaperID','$userID1',$corr_yazar)");
            } else {
                $pass = md5(md5($authorName));
                mysqli_query($baglanti,"insert into users (user_name,name_surname,pass,email,role,new_user,orcid_no,instition,country) VALUES ('$authorMail','$authorName','$pass' ,'$authorMail','3','1','$authorOrcid','$authorInstition','$authorCountry')");
            
                $userID2_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$authorMail'"));
                $userID2 = $userID2_obj->id ?? "";
                mysqli_query($baglanti,"insert into authors_of_manuscript (paperID,userID,correspond) VALUES ('$newPaperID','$userID2',$corr_yazar)");
            }
        }

        $userID1_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$s_user'"));
        $userID1 = $userID1_obj->id ?? "";
        mysqli_query($baglanti,"insert into authors_of_manuscript (paperID,userID) VALUES ('$newPaperID','$userID1')");
                
        // Hakem (Reviewer) Atama İşlemleri
        for($r=1; $r<=3; $r++) {
            $reviewMail = $_POST['reviewMail'.$r] ?? '';
            if ($reviewMail != '') {
                $reviewName = $_POST['reviewName'.$r] ?? '';
                $instition = $_POST['affiliation'.$r] ?? '';
                $count1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail'"));
                if ($count1>0) {
                    $countr1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail' and role!='4'"));
                    $revID_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail'"));
                    $reviewerID = $revID_obj->id ?? "";
                    
                    if($countr1>0) {
                        mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID')");
                    } else {
                        mysqli_query($baglanti,"update users set role=3 where id='$reviewerID'");
                        mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID')");
                    }
                } else {
                    $pass = md5(md5($reviewMail));
                    mysqli_query($baglanti,"insert into users (user_name,name_surname,pass,email,role,new_user,instition) VALUES ('$reviewMail','$reviewName','$pass' ,'$reviewMail','3','1','$instition')");
                    $revID_obj = mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail'"));
                    $reviewerID = $revID_obj->id ?? "";
                    mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID')");
                }
            }
        }

        $log_state=$paperid." li Makale veritabanına Yüklendi";
        log_all($s_user,$log_state);
                
        // HOCANIN İSTEDİĞİ ŞABLON SİSTEMİ - YAZARA GİDEN MESAJ
        $subject = "Manuscript Submission"; // Mail başlığı
        $currespond_message = mail_sablonu("makale_basvurusu_yazar", $title);
        $retval = mail_gonder($email, $subject, $currespond_message);
        $log_state="Makale Sisteme Yüklendi.Currespond Author a mail gönderildi sonuc gelen cevap :".$retval;
        log_all($s_user,$log_state);
         
        // HOCANIN İSTEDİĞİ ŞABLON SİSTEMİ - ORTAK YAZARA GİDEN MESAJ
        if (isset($all_authors_email) && $all_authors_email != "") {
            $authors_mail = explode(",", $all_authors_email);
            $other_author_message = mail_sablonu("makale_basvurusu_ortak_yazar", $title . "||" . $name_surname);

            if (count($authors_mail) == 0) {
                $retval = mail_gonder($all_authors_email, $subject, $other_author_message);
                $log_state="Makale Sisteme Yüklendi.Co-Author ".$all_authors_email." a mail gönderildi";
                log_all($s_user,$log_state);
            } else {
                for ($i = 0; $i < count($authors_mail); $i++) {
                    if(trim($authors_mail[$i]) != "") {
                        $retval = mail_gonder($authors_mail[$i], $subject, $other_author_message);
                        $log_state="Makale Sisteme Yüklendi.Co-Author ".$authors_mail[$i]." a mail gönderildi";
                        log_all($s_user, $log_state);
                    }
                }
            }
        }

        $message = $name_surname . " tarafından yeni bir makale yüklendi";
        send_message($message, 2, $journalShortName ?? "Journal", 2);

        $n_id = $_GET["ncp_id"] ?? "";
        if ($n_id != "") {
            mysqli_query($baglanti,"delete from submission_list_temp where id='$n_id'");
        } else {
            $ncp_obj = mysqli_fetch_object(mysqli_query($baglanti,"SELECT max(id) as max_id FROM submission_list_temp where user_name='$s_user'"));
            $ncp_id = $ncp_obj->max_id ?? "";
            if($ncp_id != "") {
                mysqli_query($baglanti,"update submission_list_temp  set state=0 where id='$ncp_id'");
            }
        }

        Yonlendirme("index.php?page=add_paper_success&rnb=4&m_id=19");

    } else {
        $log_state="HATA - > makale yükleme veri tabanı hatası".mysqli_error($baglanti);
        log_all($s_user,$log_state);
    }
} 
else 
{
    $log_state="Hata -> Makale Dosyası Seçilmedi";
    log_all($s_user,$log_state);
    Yonlendirme("index.php?page=add_paper_not_success&rnb=4&m_id=19");       
}
?>