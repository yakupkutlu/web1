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
$s_user = $_SESSION["user"];
if(!isset($s_user)){
	  echo $_POST["s_user"];
	  MesajGoster("Error.  please contact Management Editor of Journal .");
	  exit();
	 
}



MesajGoster("Please Wait .... ");

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

$all_authors_email = $_POST["all_authors_email"];  //tes
$all_authors_namesurname = implode(",", $_POST["name_author"]);  //test
$all_authors_orcid= $_POST["all_authors_orcid"]; //text 
$all_authors_institution= $_POST["all_authors_institution"];  //text 

$all_authors_country= $_POST["all_authors_country"];  //text 

/*
echo $all_authors_institution;
echo "<hr>";
echo $all_authors_country;
echo "<hr>";
echo $all_authors_orcid;
echo "<hr>";
echo $all_authors_namesurname;
echo "<hr>";
echo $all_authors_email;
*/



$corname = $_POST["cur_author"]; 



$name1 = $_POST["name_author"];
$mail2 = $_POST["author_email_tmp"];

$all_authors_orcid_tmp= $_POST["all_authors_orcid_tmp"]; //array



 /* 

echo "start";
echo $name_author."  -->    name_author <br>";
echo $all_authors_email."-->    all_authors_email <br>";
echo $all_authors_institution."-->    all_authors_institution <br>";
echo $all_authors_orcid."-->    all_authors_orcid <br>";

print_r($all_authors_orcid_tmp);
echo "... all_authors_orcid_tmp ......... 1<hr>";
print_r($name1);
echo "... name1 ............2<hr>";
print_r($mail2);
echo "... mail2 ............3<hr> ";
print_r($corname);
echo "... corname ............4<hr>";

 


Array ( [0] => aa bb [1] => aa bb [2] => dd ff )
Array ( [0] => yakupkutlu@yahoo.com [1] => yakupkutlu@gmail.com [2] => yakupkutlu@yahoo.com [3] => yakupkutlu@yahoo.com )
Yakup Kutlu 

*/



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
        $correspond_yazar_indis=$i;
        }
} 


 


$name_author=implode(", ", $yazarlar);       
$all_authors_email= implode(",", $all_email); 
$all_authors_arcid2= implode(",", $all_authors_orcid); 

/*
echo $name_author;
echo "... name_author ......... 1<hr>";

echo $all_authors_email;
echo "... all_authors_email ............2<hr>";

echo $all_authors_arcid2;
echo "... all_authors_arcid2 ............3<hr> ";

*/

//echo "................1................................<hr>";
//die();





function generateNewID($id) {
			 
				$newid="";

				for ($i=1; $i<=4; $i++)
				{
				   $newid.=rand(0,9);
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




//echo "................2................................<hr>";


$allowed = array('doc', 'docx','odt','pdf');
$new_name = "-";


$generatedPaperId=generateNewID(son_kayit_ID_getir());

if (isset($_FILES['my_file']) && $_FILES['my_file']['error'] == 0) {

    $extension = pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension), $allowed)) {
        echo '{"Error......":"541"}';
       // header("Refresh:0;  URL = index.php?page=add_paper_not_success&rnb=4&m_id=19 ");
       Yonlendirme("index.php?page=add_paper_not_success&rnb=4&m_id=19");
        exit;
    }

     
//echo "................3................................<hr>";
		 

    $new_name = '../uploadfiles/'.$journalShortName.'_' . $generatedPaperId.'.'.$extension;
    
    if (move_uploaded_file($_FILES["my_file"]["tmp_name"], $new_name)) {
        //echo '{"status":"success"}';
        $log_state="Makale Dosyası Seçildi";
        
        
         
               echo '<script type="text/javascript">',
         'document.getElementsByClassName("message-info")[0].innerHTML =document.getElementsByClassName("message-info")[0].innerHTML+   "<br> > Manuscript file has been uploaded";',
         '</script>'; 

        log_all($s_user,$log_state);

    }
} else {
    //echo $_FILES['my_file']['error'];
    $log_state="HATA -> Makale Dosyası Sisteme Tanıtılmadı----Add Submission--".$_FILES['my_file']['error'].$_FILES["my_file"]["tmp_name"].$_FILES['my_file']['name'];
    log_all($s_user,$log_state);
      echo '<script type="text/javascript">',
         'document.getElementById("message-info").innerHTML = "<br> > Manuscript file could not   be uploaded ..... X ERROR X";',
         '</script>';
          
                    echo '<script type="text/javascript">',
         'document.getElementsByClassName("message-info")[0].innerHTML =document.getElementsByClassName("message-info")[0].innerHTML+  "<br> > Manuscript file could not   be uploaded ..... X ERROR X";',
         '</script>'; 
}


//echo "................4................................<hr>";

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

//echo "................5................................<hr>";

    $new_name2 = '../uploadfiles/Approval_'.$generatedPaperId.'.'.$extension;
    
    if (move_uploaded_file($_FILES["my_file_Approval"]["tmp_name"], $new_name2)) {
        //echo '{"status":"success"}';
        $log_state="Makale Approval Dosyası Seçildi";
        log_all($s_user,$log_state);
         
         
                      echo '<script type="text/javascript">',
         'document.getElementsByClassName("message-info")[0].innerHTML =document.getElementsByClassName("message-info")[0].innerHTML+   "<br> > Approval file has been uploaded";',
         '</script>'; 


    }
    
} else {
    //echo $_FILES['my_file']['error'];
    $log_state="HATA -> Makale Approval Dosyası Sisteme Tanıtılmadı - Add Submission -".$_FILES['my_file_Approval']['error'];
    log_all($s_user,$log_state); 
    
         
              echo '<script type="text/javascript">',
         'document.getElementsByClassName("message-info")[0].innerHTML =document.getElementsByClassName("message-info")[0].innerHTML+  "<br> > Approval file could not  be uploaded ..... X ERROR X";',
         '</script>';   
         
        
    }
// end comitee approval


//echo "................6................................<hr>";

// abstract image upload  --------------------



$allowed3 = array('jpg', 'jpeg','png','ppt','pptx','pdf');
$new_name3 = "-";
if (isset($_FILES['my_abstractimage']) && $_FILES['my_abstractimage']['error'] == 0) {

    $extension = pathinfo($_FILES['my_abstractimage']['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($extension), $allowed3)) {
        echo '{"Error......":"217"}';
        //header("Refresh:0;  URL = index.php?page=add_paper_not_success&rnb=4&m_id=19 ");
           Yonlendirme("index.php?page=add_paper_not_success&rnb=4&m_id=19");
           exit;
    }
     $_new_name3='image_'.$generatedPaperId.'.'.$extension;
    $new_name3 = '../paperimages/image_'.$generatedPaperId.'.'.$extension;
    
    if (move_uploaded_file($_FILES["my_abstractimage"]["tmp_name"], $new_name3)) {
        //echo '{"status":"success"}';
        $log_state="abstract image dosyası yuklendi ";
        log_all($s_user,$log_state);
        

          echo '<script type="text/javascript">',
         'document.getElementsByClassName("message-info")[0].innerHTML =document.getElementsByClassName("message-info")[0].innerHTML+ "<br> > Abstract image  file han been uploaded  ";',
         '</script>';

      

    }
} else {
    //echo $_FILES['my_file']['error'];
    $log_state="HATA -> Makale Approval Dosyası Sisteme Tanıtılmadı - Add Submission -".$_FILES['my_abstractimage']['error'];
    log_all($s_user,$log_state);
    // MesajGoster(" Abstract image  file has not been uploaded .... ");
  
         
         
         
          echo '<script type="text/javascript">',
         'document.getElementsByClassName("message-info")[0].innerHTML =document.getElementsByClassName("message-info")[0].innerHTML+  "<br> > Abstract image  file could not  be uploaded ..... X ERROR X";',
         '</script>';
}
// end comitee approval


// A list of permitted file extensions
// C:\xampp\php\php.ini ayarları düzenle


//echo "................7................................<hr>";













$date = date("Y-m-d");
$paperid =$paperIDstart. '-' . $generatedPaperId;
if ($new_name != "-") 
{
	
	


      		// approval varsa ekle
		if ($new_name2 != "-") 
		{

		 $sub_sql="insert into submission_list (name_surname,user_name,title,keyword,workarea,abstract,msg_to_editor,authors,`date`,date_time,paperID,paperID_first,paperfile1,file_approval,email,editorDecision,submission_date,coverImage)
		 VALUES ('$name_surname','$s_user','$title','$key_words','$workarea','$abstract','$message','$name_author','$date','$date_time','$paperid','$paperid','$new_name','$new_name2','$email','$type','$date', '$new_name3')";
		   
		}
		else
		{

			$sub_sql="insert into submission_list (name_surname,user_name,title,keyword,workarea,abstract,msg_to_editor,authors,`date`,date_time,paperID,paperID_first,paperfile1,email,editorDecision,submission_date,coverImage)
		 VALUES ('$name_surname','$s_user','$title','$key_words','$workarea','$abstract','$message','$name_author','$date','$date_time','$paperid','$paperid','$new_name','$email','$type','$date', '$new_name3')";
		   

		}



//echo "................8................................<hr>".$sub_sql;

		


if (mysqli_query($baglanti,$sub_sql)) 
  {
			///-----------
	 //echo "................9................................<hr>";

	 //echo $paperid.'<br>';
		
		
				$newPaperID=mysqli_fetch_object(mysqli_query($baglanti,"Select id from submission_list where paperID='$paperid'"))->id;
 //----------------------
		



// after manuscript insert , add authors to author_manuscript table
// INSERT INTO `authors_of_manuscript`(`id`, `userID`, `paperID`, `correspond`) VALUES (1,1,1,0)

echo $all_authors_email."<br>";
$authors_emails = explode(",",$all_authors_email); //text to array
$authors_namesurnames = explode(",",$all_authors_namesurname);   //test to array
$authors_orcids= explode(",",$all_authors_orcid);  //text  to array
$authors_institution= explode(",",$all_authors_institution);   //text  to array

$authors_country= explode(",",$all_authors_country);   //text  to array


 


 for ($i=0; $i<count($authors_emails);$i++)
 {
     
     if($correspond_yazar_indis ==  ($i-1)) {
        $corr_yazar=1;
         
        }else{
          $corr_yazar=0;
             
        }
					
					//echo 'yazar ekleme <br>';
					$authorMail=$authors_emails[$i];
					$authorName=$authors_namesurnames[$i];
					$authorInstition=$authors_institution[$i];
					$authorOrcid=$authors_orcids[$i];
					
					$authorCountry=$authors_country[$i];
					
					$count1 = mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$authorMail'"));
					if ($count1>0)
					{
					 
							$userID1=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$authorMail'"))->id;
							mysqli_query($baglanti,"insert into authors_of_manuscript (paperID,userID,correspond) VALUES ('$newPaperID','$userID1',$corr_yazar)");
						
							echo $userID1.' count1>0  <br>';
					        $userID1="";
                          // burada yukleyen yazarı da ekleyelim
					}
					else
					{
						 
						$pass = md5(md5($authorName));
						mysqli_query($baglanti,"insert into users (user_name,name_surname,pass,email,role,new_user,orcid_no,instition,country) VALUES ('$authorMail','$authorName','$pass' ,'$authorMail','3','1','$authorOrcid','$authorInstition','$authorCountry')");
					
						$userID2=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$authorMail'"))->id;
						mysqli_query($baglanti,"insert into authors_of_manuscript (paperID,userID,correspond) VALUES ('$newPaperID','$userID2',$corr_yazar)");
						
						echo $userID2.' else   <br>';
						$userID2="";
					}
 }










$userID1=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$s_user'"))->id;
mysqli_query($baglanti,"insert into authors_of_manuscript (paperID,userID) VALUES ('$newPaperID','$userID1')");
				










		
		
		
		
	  //echo $newPaperID.'<br>';
              if ($_POST['reviewMail1']!='')
				{
					//echo 'hakem1<br>';
					$reviewMail1=$_POST['reviewMail1'];
					$reviewName1=$_POST['reviewName1'];
					$instition1=$_POST['affiliation1'];
					$count1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail1'"));
					if ($count1>0)
					{
						$countr1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail1' and role!='4'"));
						if($countr1>0)
						{
							$reviewerID1=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail1'"))->id;
							mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID1')");
							//echo 'hakem1 tamam<br>';
						}
						else
						{
							$reviewerID1=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail1'"))->id;
							mysqli_query($baglanti,"update users set role=3 where id='$reviewerID1'");
							mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID1')");
						}

					}
					else
					{
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
					if ($count1>0)
					{
						$countr1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail2' and role!='4'"));
						if($countr1>0)
						{
							$reviewerID2=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail2'"))->id;
							mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID2')");
						   // echo 'hakem2 tamam<br>';
						}
						else
						{
							$reviewerID2=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail2'"))->id;
							mysqli_query($baglanti,"update users set role=3 where id='$reviewerID2'");
							mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID2')");
						}

					}
					else
					{
						$name = $_POST["reviewName2"];
						$reviewName = $_POST["reviewMail2"];
						$user_name = $_POST["reviewMail2"];
						$pass = md5(md5($user_name));
						mysqli_query($baglanti,"insert into users (user_name,name_surname,pass,email,role,new_user,instition) VALUES ('$user_name','$name','$pass' ,'$reviewName','3','1','$instition2')");
						$reviewerID2=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail2'"))->id;
						mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID2')");
					}
				}

				if ($_POST['reviewMail3']!='')
				{
					//echo 'hakem3';
					$reviewMail3=$_POST['reviewMail3'];
					$reviewName3=$_POST['reviewName3'];
					$instition3=$_POST['affiliation3'];
					$count1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail3'"));
					if ($count1>0)
					{
						$countr1=mysqli_num_rows(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail3' and role!='4'"));
						if($countr1>0)
						{
							$reviewerID3=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail3'"))->id;
							mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID3')");
						}
						else
						{
							$reviewerID3=mysqli_fetch_object(mysqli_query($baglanti,"Select id from users where user_name='$reviewMail3'"))->id;
							mysqli_query($baglanti,"update users set role=3 where id='$reviewerID3'");
							mysqli_query($baglanti,"insert into author_review_requests (paperID,reviewerID) VALUES ('$newPaperID','$reviewerID3')");
						}

					}
					else
					{
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
				
	//echo "................10................................<hr>";
				
				
				//------------- yazara mail 
					$currespond_message = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM `mailTable` WHERE `label` = 'author_message'"))->text;
					$subject = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM `mailTable` WHERE `label` = 'author_message'"))->subject;
				 	    $currespond_message = str_replace("[[title]]",$title,$currespond_message );
						$currespond_message = str_replace("[[journalName]]",$journalName,$currespond_message );
						$currespond_message = str_replace("[[journalShortName]]",$journalShortName,$currespond_message );
						$currespond_message = str_replace("[[journalEditorChef]]",$journalEditorChef,$currespond_message );
					    $currespond_message = str_replace("[[name_surname]]",$name_surname,$currespond_message );
					    $currespond_message = str_replace("[[journalDomain]]",$journalDomain,$currespond_message );
					
//-------------dikkat			
				
		//	echo 	"mail adreslerini veya göndermede problem var sorun var ";
		
		// çalışan 
		//mail_gonder($email,"Password Reset Request",$message);
				
				
		 
				//mesaj için
				
				/* $currespond_message = "Dear Author,<br><br> The M&S titled as ";
				
				$currespond_message.=$title;
				$currespond_message.=" has been submitted to ";
				
				$currespond_message.=$journalName;
				$currespond_message.=" ( ";
				$currespond_message.=$journalShortName;
				$currespond_message.=") successfully.<br> You can track the reviewing process by logging to ";
				$currespond_message.=$journalShortName;
				$currespond_message.=" (http://";
				$currespond_message.=$journalDomain;
				$currespond_message.="/index.php?page=login).<br> Thanks for choosing    ";
				$currespond_message.=$journalShortName;
				$currespond_message.=" .<br><br> Yours sincerely,<br><br>";
				$currespond_message.=$journalEditorChef;
				$currespond_message.="<br> Editor in Chief    ";
				
				
				
				
				
		*/		
				
				
				
				$retval = mail_gonder($email, $subject, $currespond_message);
				$log_state="Makale Sisteme Yüklendi.Currespond Author a mail gönderildi sonuc gelen cevap :".$retval;
				log_all($s_user,$log_state);
		 
		
	//-------------	
		
		
		
//-------------------
					if (isset($all_authors_email)) 
					{
						$authors_mail = explode(",", $all_authors_email);
						
					/* 	$other_author_message = "Dear Co-Author,<br><br>
							The M&S titled as [[title]]  has been submitted to [[journalName]] ([[journalShortName]]) 
							by corresponding author [[name_surname]].<br><br>
							Thanks for choosing [[journalShortName]].<br><br>
							Yours sincerely,<br><br>
							[[journalEditorChef]]<br>
							Editor in Chief"; */
							
							
							
							
							
                //------------------- diğer yazarlara mail						
						  
						$other_author_message = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM `mailTable` WHERE `label` = 'other_author_message'"))->text;
						$subject = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM `mailTable` WHERE `label` = 'other_author_message'"))->subject;
						
				
				
				
				
				
				   //	echo "<hr>  ---------- authors_mail------------- ";
				    //	print_r($authors_mail);
				   // echo $all_authors_email." --- <br> ---title <br> ----". $title." --- <br> ---mesaj <br> ----". $other_author_message." --- <br> ----";
				 	//die();
						
						
					
			//echo "................11................................<hr>";
				
					
						$other_author_message = str_replace("[[title]]",$title,$other_author_message );
						$other_author_message = str_replace("[[journalName]]",$journalName,$other_author_message );
						$other_author_message = str_replace("[[journalShortName]]",$journalShortName,$other_author_message );
						$other_author_message = str_replace("[[journalEditorChef]]",$journalEditorChef,$other_author_message );
					    $other_author_message = str_replace("[[name_surname]]",$name_surname,$other_author_message );
					    $other_author_message = str_replace("[[journalDomain]]",$journalDomain,$other_author_message );
						
						/* 
						$other_author_message = "Dear Co-Author,<br><br>
							The M&S titled as " . $title . " has been submitted to ".$journalName." (".$journalShortName.") by corresponding author " . $name_surname . "<br><br>
							Thanks for choosing ".$journalShortName.".<br><br>
							Yours sincerely,<br><br>
							".$journalEditorChef."<br>
							Editor in Chief"; */

						if (count($authors_mail) == 0)
						{
							$retval = mail_gonder($all_authors_email, $subject, $other_author_message);
							$log_state="Makale Sisteme Yüklendi.Co-Author ".$all_authors_email." a mail gönderildi";
							log_all($s_user,$log_state);
						} 
						else 
						{
							for ($i = 0; $i < count($authors_mail); $i++) 
							{
								//echo $authors_mail[$i]."</br>";
								$retval = mail_gonder($authors_mail[$i], $subject, $other_author_message);
								$log_state="Makale Sisteme Yüklendi.Co-Author ".$authors_mail[$i]." a mail gönderildi";
							}
						}


					}


				$message = $name_surname . " tarafından yeni bir makale yüklendi";
				send_message($message, 2, $journalShortName, 2);

				if (isset($_GET["ncp_id"])) 
				{
					$n_id = $_GET["ncp_id"];
					mysqli_query($baglanti,"delete from submission_list_temp where id='$n_id'");

				} 
				else 
				{
					$ncp_id = mysqli_fetch_object(mysqli_query($baglanti,"SELECT max(id) as max_id FROM submission_list_temp where user_name='$s_user'"))->max_id;
					mysqli_query($baglanti,"update submission_list_temp  set state=0 where id='$ncp_id'");
				}



               Yonlendirme("index.php?page=add_paper_success&rnb=4&m_id=19");
		
      //MesajGoster("finish ............................... .... ");

     
    ////------------

        }
	    else
        {
        $log_state="HATA - > makale yükleme veri tabanı hatası".mysqli_error();
        log_all($s_user,$log_state);
        //echo "................12...............................<hr>";

    }




//echo "................13................................<hr>";









//---
} 
else 
{
    $log_state="Hata -> Makale Dosyası Seçilmedi";
    log_all($s_user,$log_state);
    Yonlendirme("index.php?page=add_paper_not_success&rnb=4&m_id=19");       
     
     
     
 /* header("Refresh:0;  URL = index.php?page=add_paper_not_success&rnb=4&m_id=19"); */
}












 
 
?>