<?php
//https://".$journalDomain.com."/user/index.php?page=process&process=send_back_author_forrevision&rnb=2&m_id=5&id=772

// form  action
//r_add_comment_decision.php?paper_id=   $paper_id; "

//send_back_author_forrevision&rnb=2&m_id=5&id=772

include ("../app/connect.php");
include ("function.php");
include("../system.php");
session_start();
ob_start();

$s_user = $_SESSION["user"] ?? "";

$paper_id = $_GET["paper_id"] ?? "";

$ptQuery = mysqli_query($baglanti,"select * from submission_list where id='$paper_id'");
$paper_prop = mysqli_fetch_object($ptQuery);

$paper_title = $paper_prop ? $paper_prop->title : "";
$pID = $paper_prop ? $paper_prop->paperID : "";
$to = $paper_prop ? $paper_prop->user_name : "";
$editorDecision = $paper_prop ? $paper_prop->editorDecision : "";
$decision_value = $paper_prop ? $paper_prop->accept_status : "";

$accepted_paper_type = $editorDecision;

$edQuery = mysqli_query($baglanti,"select * from review_decision where `value`='$decision_value'");
$edObj = mysqli_fetch_object($edQuery);
$editor_decision = $edObj ? $edObj->decision : "";

$mailQuery = "select * from users where user_name='$to'";
$authorObj = mysqli_fetch_object(mysqli_query($baglanti,$mailQuery));
$author_mail = $authorObj ? $authorObj->email : "";

$mailObj = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM `mailTable` WHERE `label` = 'editor_desicion_revision'"));
$message = $mailObj ? $mailObj->text : "";


$message=replace_mail_content($message);

$message=str_replace('[[title]]', $paper_title, $message);
$message=str_replace('[[editor_decision]]',$editor_decision,$message);
$message=str_replace('[[accepted_paper_type]]',$accepted_paper_type,$message);


/*

$message="Dear Author, <br> The Manuscript titled  ".$paper_title." can be ".$editor_decision." as ".$accepted_paper_type." 
for publication in ".$journalName.". After revising the M&S according to the Reviewers evaluations given below. 
You should upload the corrected M&S with answering the reviewer comments.  <br>  ";
  
 */
 
$date=date('Y-m-d');

 
 
     $message .= mail_sablonu("editor_imza", ($journalName ?? "") . "||" . ($journalDomain ?? ""));    
     
    

    
//$message.=" <br><br><br> Editor of ".$journalName." ";  






send_message($message,$to,$journalShortName,4);
$subject=" Editor decision of the manuscript  numbered  ".$pID.":";
 
if (mail_gonder($author_mail,$subject,$message)){
        $log_state=$paper_id." ID li Makale Dosyası için Editor kararı mail gitti";
        log_all($s_user,$log_state);
        
        MesajGoster("The request has been sent");
    }
else {
        $log_state="HATA ->".$paper_id." ID li Makale Dosyası için Editor kararı MAİL HATASI";
        log_all($s_user,$log_state);
         MesajGoster("The request can not send. Please inform Editor !");
    }
 
header("Refresh:3;  URL = index.php?page=revision&m_id=8&rnb=2");
 