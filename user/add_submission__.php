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
$s_user = $_SESSION["user"];


$name_surname = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM users where user_name='$s_user' "))->name_surname;
$email = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM users where user_name='$s_user' "))->email;


$title = tirnak_replace($_POST["title"]);
$key_words = $_POST["key_words"];
$abstract = $_POST["abstract"];
$message = $_POST["message"];

$workarea = $_POST["workarea"];

$date_time = date('Y-m-d H:i:s');
if (isset($_POST["type"])) 
	$type=$_POST["type"];
else 
	$type=null;

$abstract=tirnak_replace($abstract);
$title=tirnak_replace($title);
$key_words=tirnak_replace($key_words);
$message=tirnak_replace($message);




/// yazarları getir  
$name_author = $_POST["all_authors"];
$all_authors_email = $_POST["all_authors_email"];






 



$corname = $_POST["cur_author"]; 
$name1 = $_POST["name_author"];
$mail2 = $_POST["author_email_tmp"];
$all_authors_orcid= $_POST["all_authors_orcid"]; 


 


$yazarlar[0]=$name_surname;



for($i=0;$i<=count($name1);$i++){
   if(strlen($name1[$i])>2) {
      $all_email[$i]= $mail2[$i+1];                               			
      $yazarlar[$i+1]=$name1[$i];
   }
                                    				
} 


 

for($i=0;$i<=count($yazarlar);$i++){
                                    			
    if($corname == $yazarlar[$i]) {
        $yazarlar[$i].="*";
        }
} 


 


$name_author=implode(", ", $yazarlar);       
                           			 
	
$all_authors_email= implode(",", $all_email); 
$all_authors_arcid2= implode(",", $all_authors_orcid); 











// A list of permitted file extensions
// C:\xampp\php\php.ini ayarları düzenle


$allowed = array('doc', 'docx','odt','pdf');
$new_name = "-";

if (isset($_FILES['my_file']) && $_FILES['my_file']['error'] == 0) {

    $extension = pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension), $allowed)) {
        echo '{"Error......":"541"}';
       // header("Refresh:0;  URL = index.php?page=add_paper_not_success&rnb=4&m_id=19 ");
       Yonlendirme("index.php?page=add_paper_not_success&rnb=4&m_id=19");
        exit;
    }

    $new_name = '../uploadfiles/nesciences_' . son_kayit_ID_getir() . '_' . date("d_m_y") . '.' . $extension;
    
    if (move_uploaded_file($_FILES["my_file"]["tmp_name"], $new_name)) {
        //echo '{"status":"success"}';
        $log_state="Makale Dosyası Seçildi";
        log_all($s_user,$log_state);

    }
} else {
    //echo $_FILES['my_file']['error'];
    $log_state="HATA -> Makale Dosyası Sisteme Tanıtılmadı----Add Submission--".$_FILES['my_file']['error'].$_FILES["my_file"]["tmp_name"].$_FILES['my_file']['name'];
    log_all($s_user,$log_state);
}


// comitee approval

$new_name2 = "-";
if (isset($_FILES['my_file_Approval']) && $_FILES['my_file_Approval']['error'] == 0) {

    $extension = pathinfo($_FILES['my_file_Approval']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension), $allowed)) {
        echo '{"Error......":"541"}';
        //header("Refresh:0;  URL = index.php?page=add_paper_not_success&rnb=4&m_id=19 ");
           Yonlendirme("index.php?page=add_paper_not_success&rnb=4&m_id=19");
           exit;
    }

    $new_name2 = '../uploadfiles/Approval_' . son_kayit_ID_getir() . '_' . date("d_m_y") . '.' . $extension;
    
    if (move_uploaded_file($_FILES["my_file_Approval"]["tmp_name"], $new_name2)) {
        //echo '{"status":"success"}';
        $log_state="Makale Approval Dosyası Seçildi";
        log_all($s_user,$log_state);

    }
} else {
    //echo $_FILES['my_file']['error'];
    $log_state="HATA -> Makale Approval Dosyası Sisteme Tanıtılmadı - Add Submission -".$_FILES['my_file_Approval']['error'];
    log_all($s_user,$log_state);
}
// end comitee approval









$date = date("Y-m-d");
$paperid = "NES-" . son_kayit_ID_getir() . '-' . date("d-m-y");
if ($new_name != "") {


// approval varsa ekle
if ($new_name2 != "") {

    $sub_sql="insert into submission_list (name_surname,user_name,title,keyword,workarea,abstract,msg_to_editor,authors,`date`,date_time,paperID,paperID_first,paperfile1,file_approval,email,editorDecision,submission_date)
 VALUES ('$name_surname','$s_user','$title','$key_words','$workarea','$abstract','$message','$name_author','$date','$date_time','$paperid','$paperid','$new_name','$new_name2','$email','$type','$date')";
   
}else{

    $sub_sql="insert into submission_list (name_surname,user_name,title,keyword,workarea,abstract,msg_to_editor,authors,`date`,date_time,paperID,paperID_first,paperfile1,email,editorDecision,submission_date)
 VALUES ('$name_surname','$s_user','$title','$key_words','$workarea','$abstract','$message','$name_author','$date','$date_time','$paperid','$paperid','$new_name','$email','$type','$date')";
   

}


 if (mysqli_query($baglanti,$sub_sql)){
//echo $paperid.'<br>';
        $newPaperID=mysqli_fetch_object(mysqli_query($baglanti,"Select id from submission_list where paperID='$paperid'"))->id;










       // echo $newPaperID.'<br>';
        if ($_POST['reviewMail1']!=''){
            //echo 'hakem1<br>';
            $reviewMail1=$_POST['reviewMail1'];
            $reviewName1=$_POST['reviewName1'];
            $instition1=$_POST['affiliation1'];
            $count1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail1'"));
            if ($count1>0){
                $countr1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail1' and role!='4'"));
                if($countr1>0){
                    $reviewerID1=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail1'"))->id;
                    mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID1')");
                    //echo 'hakem1 tamam<br>';
                }
                else{
                    $reviewerID1=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail1'"))->id;
                    mysqli_query($baglanti,"update users set role=3 where id='$reviewerID1'");
                    mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID1')");
                }

            }
            else{
                $name = $_POST["reviewName1"];
                $reviewName = $_POST["reviewMail1"];
                $user_name = $_POST["reviewMail1"];
                $pass = md5(md5($user_name));
                mysqli_query($baglanti,"insert into users (user_name,name_surname,pass,email,role,new_user,instition) VALUES ('$user_name','$name','$pass' ,'$reviewName','3','1','$instition1')");
                $reviewerID1=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail1'"))->id;
                mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID1')");
            }
        }

        if ($_POST['reviewMail2']!=''){
           // echo 'hakem2<br>';
            $reviewMail2=$_POST['reviewMail2'];
            $reviewName2=$_POST['reviewName2'];
            $instition2=$_POST['affiliation2'];
            $count1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail2'"));
            if ($count1>0){
                $countr1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail2' and role!='4'"));
                if($countr1>0){
                    $reviewerID2=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail2'"))->id;
                    mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID2')");
                   // echo 'hakem2 tamam<br>';
                }
                else{
                    $reviewerID2=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail2'"))->id;
                    mysqli_query($baglanti,"update users set role=3 where id='$reviewerID2'");
                    mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID2')");
                }

            }
            else{
                $name = $_POST["reviewName2"];
                $reviewName = $_POST["reviewMail2"];
                $user_name = $_POST["reviewMail2"];
                $pass = md5(md5($user_name));
                mysqli_query($baglanti,"insert into users (user_name,name_surname,pass,email,role,new_user,instition) VALUES ('$user_name','$name','$pass' ,'$reviewName','3','1','$instition2')");
                $reviewerID2=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail2'"))->id;
                mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID2')");
            }
        }

        if ($_POST['reviewMail3']!=''){
            //echo 'hakem3';
            $reviewMail3=$_POST['reviewMail3'];
            $reviewName3=$_POST['reviewName3'];
            $instition3=$_POST['affiliation3'];
            $count1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail3'"));
            if ($count1>0){
                $countr1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail3' and role!='4'"));
                if($countr1>0){
                    $reviewerID3=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail3'"))->id;
                    mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID3')");
                }
                else{
                    $reviewerID3=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail3'"))->id;
                    mysqli_query($baglanti,"update users set role=3 where id='$reviewerID3'");
                    mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID3')");
                }

            }
            else{
                $name = $_POST["reviewName3"];
                $reviewName = $_POST["reviewMail3"];
                $user_name = $_POST["reviewMail3"];
                $pass = md5(md5($user_name));
                mysqli_query($baglanti,"insert into users (user_name,name_surname,pass,email,role,new_user,instition) VALUES ('$user_name','$name','$pass' ,'$reviewName','3','1','$instition3')");
                $reviewerID3=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail3'"))->id;
                mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID3')");
            }
        }
        

        $log_state=$paperid." li Makale veritabanına Yüklendi";
        log_all($s_user,$log_state);
        //mesaj için
        $currespond_message = "Dear Author,<br><br>
The M&S titled as " . $title . " has been submitted to Natural and Engineering Sciences (NESciences) successfully.<br><br>
You can track the reviewing process by logging to NESciences (http://www.nesciences.com/login.php).<br><br>
Thanks for choosing NESciences.<br><br>
Yours sincerely,<br><br>
Dr. Cemal Turan<br>
Editor in Chief ";
        $retval = mail_gonder($email, $title, $currespond_message);
        $log_state="Makale Sisteme Yüklendi.Currespond Author a mail gönderildi";
        log_all($s_user,$log_state);

        if (isset($all_authors_email)) {
            $authors_mail = explode(",", $all_authors_email);
            $other_author_message = "Dear Co-Author,<br><br>
The M&S titled as " . $title . " has been submitted to Natural and Engineering Sciences (NESciences) by corresponding author " . $name_surname . "<br><br>
Thanks for choosing NESciences.<br><br>
Yours sincerely,<br><br>
Dr. Cemal Turan<br>
Editor in Chief";

            if (count($authors_mail) == 0) {
                $retval = mail_gonder($all_authors_email, $title, $other_author_message);
                $log_state="Makale Sisteme Yüklendi.Co-Author ".$all_authors_email." a mail gönderildi";
                log_all($s_user,$log_state);
            } else {
                for ($i = 0; $i < count($authors_mail); $i++) {
                    //echo $authors_mail[$i]."</br>";
                    $retval = mail_gonder($authors_mail[$i], $title, $other_author_message);
                    $log_state="Makale Sisteme Yüklendi.Co-Author ".$authors_mail[$i]." a mail gönderildi";
                }
            }


        }


        $message = $name_surname . " tarafından yeni bir makale yüklendi";
        send_message($message, 2, "NESciences", 2);

        if (isset($_GET["ncp_id"])) {
            $n_id = $_GET["ncp_id"];
            mysqli_query($baglanti,"delete from submission_list_temp where id='$n_id'");

        } else {
            $ncp_id = mysqli_fetch_object(mysqli_query($baglanti,"SELECT max(id) as max_id FROM submission_list_temp where user_name='$s_user'"))->max_id;
            mysqli_query($baglanti,"update submission_list_temp  set state=0 where id='$ncp_id'");
        }



        Yonlendirme("index.php?page=add_paper_success&rnb=4&m_id=19");
     
     
     
      
       //header("Refresh:0;  URL = index.php?page=add_paper_success&rnb=4&m_id=19 ");

    }else
    {
        $log_state="HATA - > makale yükleme veri tabanı hatası".mysqli_error();
        log_all($s_user,$log_state);
    }



} else {
    $log_state="Hata -> Makale Dosyası Seçilmedi";
    log_all($s_user,$log_state);
     Yonlendirme("index.php?page=add_paper_not_success&rnb=4&m_id=19");       
     
     
     
 /* header("Refresh:0;  URL = index.php?page=add_paper_not_success&rnb=4&m_id=19"); */
}


