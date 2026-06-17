<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

include('../app/connect.php');
include("function.php");
include("../system.php");
 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
	ob_start();
}

$s_user = $_SESSION["user"];
if(!isset($s_user)){
	  echo $_POST["s_user"];
	  MesajGoster("Error.  please contact Management Editor of Journal .");
	  exit();
	 
}
  
$s_user = $_SESSION["user"];

echo "<br>";
$reviewer = $_POST["text_selected"];
$editor = $_POST["editor"];
$sub_id = $_POST["id"];
$date = date("Y-m-d");

$raw_text = mysqli_fetch_array(mysqli_query($baglanti,"SELECT `text` FROM mailTable WHERE `label`='review'"));



$paper = mysqli_fetch_array(mysqli_query($baglanti,"SELECT * FROM submission_list WHERE id=$sub_id"));
$msno = "MS No: " . strtoupper($paper["paperID"]) . "<br>";
$subject = $journalShortName."invitation to review artical " . strtoupper($paper["paperID"]);
$title = "Title: " . $paper["title"] . "<br><br>";
$abstract = $paper["abstract"];
$tmp = str_replace("[abstract]", $abstract, $raw_text);
$text = str_replace("[editor]", $editor, $tmp);

 $text = str_replace("[[journalName]]",$journalName,$text );
 $text = str_replace("[[journalDomain]]",$journalDomain,$text ); 
$m_id = $_GET["m_id"];


//------------------
  

	
//echo $message;

$reviewer_temp = explode(",", $reviewer);
 
if ($reviewer != "") 
{

//------------------



    foreach ($reviewer_temp as $selected_reviewer) 
	{
        if ($selected_reviewer != "") 
		{
            $rQuery = mysqli_query($baglanti,"Select * from users where user_name='$selected_reviewer'");
            $reviewer_Query = mysqli_fetch_object($rQuery);
            $reviewer_id = $reviewer_Query->id;
            $reviewer_user_name = $reviewer_Query->user_name;
            $reviewer_mail = $reviewer_Query->email;
            $rName = $reviewer_Query->name_surname;
            $rNewUser = $reviewer_Query->new_user;
            // request_state hakemlik isteği 0 beklemede 1 kabul

//-------------------

	  
	  
            $sendQuery = "SELECT * FROM review_requests WHERE  paperid='$sub_id' and reviewerid='$reviewer_id'"; 
     
	 
 
	         
            if (!($satir = mysqli_fetch_array(mysqli_query($baglanti,$sendQuery)))) 
			{
                  
//----------------

				$sendQuery = "insert into review_requests (paperid,reviewerid,request_date,editor_name)
							values ('$sub_id','$reviewer_id','$date','$editor')";
				if (mysqli_query($baglanti,$sendQuery)) {
					$log_state = $paper["paperID"] . ' ID li Makale Dosyası için ' . $selected_reviewer . '  hakemlik talebi gönderildi';
					log_all($s_user, $log_state);
				} else {
					$log_state = 'HATA ->' . $paper["paperID"] . ' ID li Makale Dosyası için ' . $selected_reviewer . '  hakemlik talebi gönderilemedi,VERİTABANI HATASI' . mysqli_error();
					log_all($s_user, $log_state);
				}
            
           } // hakem atanmışsa tekrar kaydetme 
            
	
			
            $tmpText1 = str_replace("[reviewer]", $rName, $text);
            $acceptance_link = '<br><a href="http://'.$journalDomain.'/index.php?page=login">Click to indicate an answer for reviewing this paper</a><br>';
            $acceptance_link .= "<br> Attention: If the link is not working please copy the below address and paste to the browsers adress bar in order to access the page";
            $acceptance_link .= '<br>https://'.$journalDomain.'/index.php?page=login';
            $acceptance_link .= "<br><br><font color=\'red\'>Your Username: ".$reviewer_user_name."</font>";
            $acceptance_link .= "<br>If you forget or don't know your password you can use the Reset Password form.</br>";
            $acceptance_link .= '<br><a href="https://'.$journalDomain.'/index.php?page=reset_pass">Click to access the Reset Password form</a><br>';
            $acceptance_link .= '<br> Attention: If the link is not working please copy the below address and paste to the browsers adress bar in order to access the page';
            $acceptance_link .= '<br>https://'.$journalDomain.'/index.php?page=reset_pass';


    
	  
	  
            $tmpText2 = str_replace("[acceptance_link]", $acceptance_link, $tmpText1);
            $message = $msno . $title . $tmpText2[0];
			
			
			

 // hata burada mail gönderilemiyor 
	  
	  
	  
	  
	  
            if (mail_gonder($reviewer_mail, $subject, $message)) {
                $log_state = $paper["paperID"] . ' ID li Makale Dosyası için ' . $selected_reviewer . '  hakemlik talebi MAİL gönderildi';
                log_all($s_user, $log_state);
            } else {
                $log_state = 'HATA ->' . $paper["paperID"] . ' ID li Makale Dosyası için ' . $selected_reviewer . '  hakemlik talebi MAIL HATASI';
                log_all($s_user, $log_state);
            }


        }
    }
	
	
    if (mysqli_query($baglanti,"update submission_list set reviever_state=1,accept_status=-1 where id='$sub_id'")) {
        $log_state = $paper["paperID"] . ' ID li Makale Dosyası için hakemlik TALEPLERİ gönderildi';
        log_all($s_user, $log_state);
    } else {
        $log_state = 'HATA ->' . $paper["paperID"] . ' ID li Makale Dosyası için hakemlik TALEPLERİ VERİTABANI HATASI';
        log_all($s_user, $log_state);
    }

    if ($m_id == 5) {
		$url="index.php?m_id=5&page=submission&rnb=2";
		MesajGoster("  Please Wait ... ");
		Yonlendirme($url);
		 
        //header("Refresh:1;  URL = index.php?m_id=5&page=submission&rnb=2 ");
    }
    if ($m_id == 7) {
		$url="index.php?m_id=7&page=reviewer&rnb=2 ";
		MesajGoster("  Please Wait ... ");
		Yonlendirme($url); 
        //header("Refresh:1;  URL = index.php?m_id=7&page=reviewer&rnb=2 ");
    }

    if ($m_id == 9) {
		$url="index.php?page=come_revision&m_id=9&rnb=2 ";
		MesajGoster("  Please Wait ... ");
		Yonlendirme($url);
 
        //header("Refresh:1;  URL = index.php?page=come_revision&m_id=9&rnb=2 ");
    }


} 
else 
{
    MesajGoster("You must select at least 1 reviewer.");
    if ($m_id == 5) {
		MesajGoster("  Please Wait ... ");
		$url="index.php?m_id=5&page=process&process=send_review&rnb=2&id=$sub_id";
		Yonlendirme($url);
        //header("Refresh:2;  URL = index.php?m_id=5&page=process&process=send_review&rnb=2&id=$sub_id");
    }
    if ($m_id == 7) {
		MesajGoster("  Please Wait ... ");
		$url="index.php?m_id=7&page=process&process=send_review&rnb=2&id=$sub_id";
		Yonlendirme($url);
		
        //header("Refresh:2;  URL = index.php?m_id=7&page=process&process=send_review&rnb=2&id=$sub_id");
    }
}


?>

