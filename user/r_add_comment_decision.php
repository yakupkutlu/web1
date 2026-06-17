<?php

include ("../app/connect.php");
include ("function.php");
include("../system.php");
session_start();
ob_start();

   MesajGoster("Please Wait..... ");

$s_user = $_SESSION["user"];
if (isset($_POST["editor_decision"]))
    $editorDecision=$_POST["editor_decision"];
else $editorDecision=0;
$paper_id=$_GET["paper_id"];
$decision_value_gelem=explode('-',$_POST["iCheck"]);
$decision_value=$decision_value_gelem[0];
$state=$_GET["state"];
$reviewers[]=$_POST["reviewers"];
$message_editor=tirnak_replace($_POST["message"]);
$edQuery=mysqli_query($baglanti,"select * from review_decision where `value`='$decision_value'");
$editor_decision=mysqli_fetch_object($edQuery)->decision;
$ptQuery=mysqli_query($baglanti,"select * from submission_list where id='$paper_id'");
$paper_prop=mysqli_fetch_object($ptQuery);
$accepted_paper_type=$editorDecision;
$paper_title=$paper_prop->title;
$pID=$paper_prop->paperID;
$to=$paper_prop->user_name;
$mailQuery="select * from users where user_name='$to'";
$author_mail=mysqli_fetch_object(mysqli_query($baglanti,$mailQuery))->email;
/*
for ($i=0;$i<count($reviewers[0]);$i++){
    $info_r=explode("table_id=",$reviewers[0][$i]);
    echo $i." . bilgi=".$info_r[0]."</br>";
    echo $i." . id=".$info_r[1]."</br>";
    echo "--------------------------</br>";
    
The Manuscript titled deneme is accepted as Acceptable as it stands and Accepted as it standsReviewer's Decisions :Reviewer 1Reviewer's Decision:Major revisions are required; return the manuscript to me upon resubmission
Message To Author:kotu
Review Comment File: tes-376-21-04-18-958.docxReviewer Comment Reviewed MS File: tes-376-21-04-18-958_2.docxReviewed Paper File  



Dear [isim],

The Manuscript titled $paper_title can be $editor_decision. 


after revising the M&S according to the Reviewers evaluations given below:



Reviewers Decisions : 


Reviewer $i:

$info_r


Editor comment to Author :$message_editor
    
}
*/


 
$date=date('Y-m-d');

if ($decision_value==1){
    $mQuery = "update submission_list set accept_status='$decision_value',msg_to_editor='$message_editor',accept=1,accept_date='$date',editorDecision='$editorDecision' WHERE id='$paper_id'";
    $log_state=$paper_id." ID li Makale Dosyası KABUL edildi";
    
 if (isset($state)){    

 //$message="Dear Author, <br> The Manuscript titled  ".$paper_title." has been ".$editor_decision." as ".$accepted_paper_type." for publication in ".$journalName.". We may get in touch with you in publication proccess.   <br>  ";
   //  $message='Dear Author, <br> The Manuscript titled  "[[title]]" has been [[editor_decision]] as [[accepted_paper_type]] for publication in [[journalName]]. We may get in touch with you in publication proccess.   <br>  ';
  	
			
			
			        $sql_sorgu="SELECT * FROM `mailTable` WHERE `label` = 'editor_decision'";	 
				    $message = mysqli_fetch_object(mysqli_query($baglanti, $sql_sorgu))->text;
					$subject = mysqli_fetch_object(mysqli_query($baglanti, $sql_sorgu))->subject;
			
				//------------- yazara mail 
				//	$text = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM `mailTable` WHERE `label` = 'editor_decision'"))->text;
				//	$subject = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM `mailTable` WHERE `label` = 'editor_decision'"))->subject;
					
				 	    $message = str_replace("[[title]]",$paper_title,$message );  
					    $message = str_replace("[[editor_decision]]",$editor_decision,$message ); 
					    $message = str_replace("[[accepted_paper_type]]",$accepted_paper_type,$message ); 
					    $message = str_replace("[[message_editor]]",$message_editor,$message );    
					    $message = str_replace("[[name_surname]]",$name_surname,$message ); 
					    $message=replace_mail_content($message);
					    
					  //  $retval = mail_gonder($email, $subject, $text);
			
 
  
  
  
 	
 	}else {
 	    
 	    
 	       $sql_sorgu="SELECT * FROM `mailTable` WHERE `label` = 'editor_desicion_revision'";	 
				 $message = mysqli_fetch_object(mysqli_query($baglanti, $sql_sorgu))->text;
					$subject = mysqli_fetch_object(mysqli_query($baglanti, $sql_sorgu))->subject;
 	    
 	    	//------------- yazara mail 
				//	$message = mysqli_fetch_object(mysqli_query($baglanti,$sql_sorgu))->text;
				//	$subject = mysqli_fetch_object(mysqli_query($baglanti,$sql_sorgu))->subject;
					
				 	    $message = str_replace("[[title]]",$paper_title,$message );  
					    $message = str_replace("[[editor_decision]]",$editor_decision,$message ); 
					    $message = str_replace("[[accepted_paper_type]]",$accepted_paper_type,$message ); 
					    $message = str_replace("[[message_editor]]",$message_editor,$message );    
					    $message = str_replace("[[name_surname]]",$name_surname,$message ); 
					    $message=replace_mail_content($message);
					    
					  //  $retval = mail_gonder($email, $subject, $text);
			
   // $message="Dear Author, <br> The Manuscript titled  ".$paper_title." can be ".$editor_decision." as ".$accepted_paper_type."  for publication in ".$journalName.". After revising the M&S according to the Reviewers evaluations given below. You should upload the corrected M&S with answering the reviewer comments.  <br>  ";
   // $message=" Dear Author, <br> The Manuscript titled  ".$paper_title." is accepted as ".$editor_decision."<br> and ".$decision_value_gelem[1];    
   
  }
  
 // echo "-------------1-------------</br>";
 
   
    
}
else if ($decision_value==0){
    $mQuery = "update submission_list set accept_status='$decision_value',msg_to_editor='$message_editor',editorDecision='$editorDecision' WHERE id='$paper_id'";
    $log_state=$paper_id." ID li Makale Dosyası RED edildi";
    
    
    
    
              $sql_sorgu="SELECT * FROM `mailTable` WHERE `label` = 'editor_decision_red'";	 
				 $message = mysqli_fetch_object(mysqli_query($baglanti, $sql_sorgu))->text;
					$subject = mysqli_fetch_object(mysqli_query($baglanti, $sql_sorgu))->subject;
    
 	//------------- yazara mail 
				//	$text = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM `mailTable` WHERE `label` = 'editor_decision_red'"))->text;
				//	$subject = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM `mailTable` WHERE `label` = 'editor_decision_red'"))->subject;
					
				 	    $message = str_replace("[[title]]",$paper_title,$message );  
					    $message = str_replace("[[editor_decision]]",$editor_decision,$message ); 
					    $message = str_replace("[[accepted_paper_type]]",$accepted_paper_type,$message ); 
					    $message = str_replace("[[message_editor]]",$message_editor,$message );    
					    $message = str_replace("[[name_surname]]",$name_surname,$message ); 
					    $message=replace_mail_content($message);
  //  $message="Dear Author, <br> I am regret to inform you that the Manuscript titled <b>  ".$paper_title." </b> has been ".$editor_decision." for publication in ".$journalShortName.". Please see below reviewers/editor evoluations.  <br>We thank you for your interest in the ".$journalShortName.". We look forward to your next submission and hope we will be able to render a more positive decision on future work.<br> ";
   // $message=" Dear Author, <br>The Manuscript titled  ".$paper_title." is accepted as ".$editor_decision."<br> and ".$decision_value_gelem[1];
    
//echo "------------0--------------</br>";
 
    
  
    
}
else {
    $mQuery = "update submission_list set accept_status='$decision_value',revision_status=1,msg_to_editor='$message_editor',editorDecision='$editorDecision' WHERE id='$paper_id'";
    $log_state=$paper_id." ID li Makale Dosyası REVİZYON edildi";
    
    	//------------- yazara mail 
                  $sql_sorgu="SELECT * FROM `mailTable` WHERE `label` = 'editor_desicion_revision'";	
 
 
				 $message = mysqli_fetch_object(mysqli_query($baglanti, $sql_sorgu))->text;
					$subject = mysqli_fetch_object(mysqli_query($baglanti, $sql_sorgu))->subject;
					
					 $message=replace_mail_content( $message);
				 	     $message = str_replace("[[title]]",$paper_title, $message );  
					     $message = str_replace("[[editor_decision]]",$editor_decision, $message ); 
					     $message = str_replace("[[accepted_paper_type]]",$accepted_paper_type, $message ); 
					     $message = str_replace("[[message_editor]]",$message_editor, $message );    
					     $message = str_replace("[[name_surname]]",$name_surname, $message ); 
					 
					    
    

    //  $message=" Dear Author, <br>The Manuscript titled  ".$paper_title." can be ".$editor_decision." given below for publication in ".$journalShortName.". After revising the M&S according to the Reviewers evaluations, you should upload the corrected M&S with answering the reviewer comments.  <br>  ";
  
  //echo "-------------else-------------</br>";

}
if (mysqli_query($baglanti,$mQuery)){
    log_all($s_user,$log_state);
    
  // echo "-------------else 2-------------</br>";  
   //  if (isset($state)){    

  // Eger revizyon kararı verilmiş ise hakem degerlendirme gidilmeyecek
 	 // 
 	//}else {
    
  
    // hakem degerlendirmeleri
     if (isset($reviewers)){
        $message.=" Reviewer's Decisions :<br>";
        for ($i=0;$i<count($reviewers[0]);$i++){
            $info_r=explode("table_id=",$reviewers[0][$i]);
            $message.=" Reviewer ".($i+1)."<br>".$info_r[0]."<br>";
            $review_request_id=$info_r[1];
				 
            $mQuery1 = 'UPDATE `review_requests` SET `visible`=1 WHERE `id`='.$review_request_id;
            
            mysqli_query($baglanti,$mQuery1);
        }
    }
    
    //editor degerlendirmeleri
    $message.="<br> Editor comment to Author  : ".$message_editor;
    
   // }
    
    $message.='<br /> Sincerely,<br /> Editor<br /><br /><br /><br /><br /><br /><br />
<p>_______________________________________________________________________</p>
<p><strong>'.$journalName.'</strong><br />(<a href="http://'.$journalDomain.'">'.$journalDomain.'</a>)</p>';    
     
     
     
     
     
    //echo 	 $message;
   // exit();
    
     
     
     
     
    
    send_message($message,$to,$journalShortName,4);
    $subject=" Editor decision of the manuscript  numbered  ".$pID.":";
    
  //  echo "-------------after send mesj -------------</br>";
   
   
    if (mail_gonder($author_mail,$subject,$message)){
        $log_state=$paper_id." ID li Makale Dosyası için Editor kararı mail gitti";
        log_all($s_user,$log_state);
    }
    else {
        $log_state="HATA ->".$paper_id." ID li Makale Dosyası için Editor kararı MAİL HATASI";
        log_all($s_user,$log_state);
    }
    header("Refresh:5;  URL = index.php?page=reviewer&rnb=2&m_id=7 ");
}
else {echo "Veri Tabanı Hatası !!!";}

