<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


function Yonlendirme2($URL)
{
    header("Refresh:2;  URL = $URL ");
    die();
}


 
 
function getAnnouncement(){  
	global $baglanti; 
   $sonuc=mysqli_query($baglanti,"select * from static_content WHERE page_name='announcement'");
	
	return	$sonuc;		
			
}	


function replace_mail_content2($text)
{
    include("./app/connect.php");
    	  	// echo  $journalName."<hr>".$text."<hr>";
			 $text = str_replace("[[journalName]]", $journalName, $text );
			 $text = str_replace("[[journalShortName]]",$journalShortName,$text );
			 $text = str_replace("[[journalEditorChef]]",$journalEditorChef,$text );
		     $text = str_replace("[[journalISSN]]",$journalISSN,$text );
		     $text = str_replace("[[journalDomain]]",$journalDomain,$text );
			 $text = str_replace("[[journalMail]]",$journalMail,$text );
			 $text = str_replace("[[jEditorChefMail]]",$jEditorChefMail,$text );
			 $text = str_replace("[[paperIDstart]]",$paperIDstart,$text );
			
		 
			 return $text;
}


function get_icerik($page){
   
	global $baglanti; 
		if (!isset($page)) $page="home";
    $content ="";
	$sql = 'SELECT * FROM `static_content` WHERE `page_name`="'.$page.'" AND state= 1';

	$query = mysqli_query($baglanti,$sql);
	if ($query) {
		$tmp = mysqli_fetch_array($query);
		$content = $tmp["content"];
 	  $content = replace_mail_content2($content);
	
	} else {
		return "Veritabanı Hatası...".$page;
	}
	return $content;

} 
		


function get_pageName($page){
	global $baglanti; 
	 
                if ((!isset($page)) || ($page == "home")) return 'Home';
                if ($page == "aim_scope") return 'Aim & Scope';
                if ($page == "editorial_board") return 'Editorial Board';
                if ($page == "content") return 'Current Issue';
                if ($page == "submission") return 'Login';
                if ($page == "guide_for_authors") return 'Guide for Authors';
                if ($page == "policy") return 'Publication Ethics';   
                if ($page == "pppolicy") return 'Policies';
                if ($page == "archive") return 'Archive';
                if ($page == "index") return 'Index';                
                if ($page == "contact") return 'Contact';
                if ($page == "earlyview") return 'Early View';
                if ($page == "supplements") return 'Supplements';
                if ($page == "copyright_and_licensing") return 'Copyright and Licensing';
                if ($page == "announce") return 'Announcements';
                if ($page == "login") return 'Submission and Manuscript Tracking';
                if ($page == "signup") return 'Create Account';
				if ($page == "detail") return 'Article Detail';
				if ($page == "reset_pass") return 'Reset Password';
				
             
}		
		


function getStatistics(){  
				global $baglanti; 
			 


            include "./app/get_scholare_statistics.php";
            $sql0="select * from statisticsTable WHERE year='".date("Y")."'";
   			if($sql_score=mysqli_query($baglanti,$sql0)){
              while ($data=mysqli_fetch_array($sql_score)){
              $totalCite= $data["totalCite"];
              $hIndexScore=$data["hIndexScore"];
              $i10IndexScore=$data["i10IndexScore"];
               }
              }
            
            $sql_str = "SELECT count(id) AS value_sum FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1";
				$row = $row = mysqli_fetch_assoc(mysqli_query($baglanti,$sql_str));			
				$TotalArticles = $row['value_sum'];
				 
           
            $sql_str = "SELECT sum(view) AS value_sum FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1";
				$row = $row = mysqli_fetch_assoc(mysqli_query($baglanti,$sql_str));			
				$TotalArticlesview = $row['value_sum'];
			 
				$sql_str = "SELECT sum(download) AS value_sum FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1";
				$row = $row = mysqli_fetch_assoc(mysqli_query($baglanti,$sql_str));			
				$TotalArticlesdownload = $row['value_sum'];
								 
				$data["TotalArticlesdownload"]=$TotalArticlesdownload;
				$data["TotalArticlesview"]=$TotalArticlesview;
				$data["TotalArticles"]=$TotalArticles;
				$data["totalCite"]=$totalCite;
				$data["hIndexScore"]=$hIndexScore;
				$data["i10IndexScore"]=$i10IndexScore;
				  return $data;
		
}				


function Yonlendirme($url)
{

    $delay = 3; // 3 saniye gecikme
    if (!headers_sent()) {    
        header("Refresh: $delay; URL=$url");
        exit;
    } else {
        echo '<script type="text/javascript">';
        echo 'setTimeout(function(){ window.location.href="'.$url.'"; }, '.($delay*1000).');'; // delay değerini milisaniye cinsine çeviriyoruz
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="'.$delay.';url='.$url.'" />';
        echo '</noscript>';
        exit;
    }

  
}



function MesajGoster($message)
{

    include("message.php");
}

function _get($DEGER)
{
    return temizle($_GET[$DEGER]);
}

function _post($DEGER)
{
    return temizle($_POST[$DEGER]);
}

function temizle($DEGER)
{

    $ZARALI = array('>', '<', '!', '\'');
    $ZARARSIZ = array('', '', '', '');
    $DEGER = str_replace($ZARALI, $ZARARSIZ, $DEGER);
    return $DEGER;
}

function log_all($user,$log_state){
    include("app/connect.php");
    $sql_log="INSERT INTO `log_all`(`user_name`, `state`) VALUES ('$user','$log_state')";
    mysqli_query($baglanti,$sql_log);
}

function LogIn()
{
    include("app/connect.php");
    $user = _post('user');
    $pass = _post('pass');
    $pass_md5 = md5(md5($pass));
 
 
  $sql = "SELECT * FROM users WHERE user_name= '$user' and state=1 AND pass= '$pass_md5'";


    if (mysqli_num_rows(mysqli_query($baglanti,$sql))) {
        
        
        ob_start();
        $_SESSION["user"] = $user;
        $_SESSION["pass"] = $pass_md5;
        $sql_review="update users set new_user=0 WHERE user_name= '$user' AND pass= '$pass_md5' and state=1";
        mysqli_query($baglanti,$sql_review);

        $log_state="Sisteme Giriş Yaptı";
        log_all($user,$log_state);
        MesajGoster("Your Session Is Start ... [OK]");
        Yonlendirme('user/index.php');
    } 
    else{
        $log_state="Hata -> Hatalı Giriş! user_name = ".$user."Pass =".$pass;
        log_all($user,$log_state);
        MesajGoster("The user is not registered.!");
        Yonlendirme('index.php?page=login');
    }

}

function LogOut()
{
    global $baglanti;
    $user=$_SESSION["user"];
    $log_state="Sistemden Çıkış Yaptı";
    log_all($user,$log_state);
    session_destroy();
    MesajGoster("Your Session Is Close");
    Yonlendirme("index.php");



}

function NewUser()
{
    include("app/connect.php");
    $name = _post('name');
    $surname = _post('surname');
    $name_surname = $name." ".$surname;
    $user_name = _post('email');
    $email = _post('email');
    $pass = _post('pass');
    $pass_again=_post('pass_again');
    $pass_md5 = md5(md5($pass));
    $adress=_post('adress');
    $instition=_post('instition');
    $phone=_post('phone');
    $work_area=_post('work_area');
    $unvan=_post('unvan');
    $orcid_no=_post('orcid_no');

    if ($pass!=$pass_again){
        MesajGoster("Check Your Password!!!");
        Yonlendirme("index.php?page=login");
    }
    else {


    // user kontrol et kayıtlı mı mail adresi 
        $email = mysqli_real_escape_string($baglanti, $email); // SQL Injection saldırılarından korunmak için gerekli

        $check_query = "SELECT COUNT(*) AS count FROM users WHERE email = '$email'";
        $result = mysqli_query($baglanti, $check_query);
        $row = mysqli_fetch_assoc($result);
        
        if ($row['count'] > 0) {
            // Eğer e-posta adresi zaten kayıtlıysa, kullanıcıya hata mesajı gösterin ve kayıt işlemini gerçekleştirmeyin
            MesajGoster("This email address is already registered. Please  request new password ");
            Yonlendirme("index.php?page=login");
        } else {
            // Eğer e-posta adresi daha önce kayıtlı değilse, yeni kullanıcı kaydını gerçekleştirin
            $sql = "INSERT INTO users (user_name, name_surname, pass, email, orcid_no, role, state, adress, instition, phone, work_area, unvan) 
                    VALUES ('$user_name', '$name_surname', '$pass_md5', '$email', '$orcid_no', 3, 1, '$adress', '$instition', '$phone', '$work_area', '$unvan')";
            if (mysqli_query($baglanti, $sql)) {
                MesajGoster("Congratulations... Your registration has been completed.");
                Yonlendirme("index.php?page=login");
            } else {
                MesajGoster("Error: Your registration has not been completed.");
                Yonlendirme("index.php?page=singup");
            }
        }
        




        $sql = "insert into users (user_name,name_surname,pass,email,orcid_no,role,state,adress,instition,phone,work_area,unvan) 
values('$user_name','$name_surname','$pass_md5','$email','$orcid_no',3,1,'$adress','$instition','$phone','$work_area','$unvan')";
        if (mysqli_query($baglanti,$sql)) {
            MesajGoster("Congratulations...  Your registration has been completed.");
            Yonlendirme("index.php?page=login");
        } else {
            MesajGoster("  <b> !!!   Error ..... </b>  Your registration has not been completed. !!!");
            Yonlendirme("index.php?page=singup");
        }
    }


}

function rasgeleSifre()
{
    $sifre = ""; //başlangıç değeri boş olarak ayarlanıyor.
 for($i=0;$i<7;$i++)
 {
     switch(rand(1,3))
     {
         case 1: $sifre.=chr(rand(48,57));  break; //0-9
         case 2: $sifre.=chr(rand(65,90));  break; //A-Z
         case 3: $sifre.=chr(rand(97,122)); break; //a-z
     }
 }
 return $sifre;
}

function BilgileriGetir(){
    global $baglanti;
    $user=$_SESSION["user"];
    $sql = "SELECT * FROM users WHERE user_name='$user'";
	$getInfo = mysqli_fetch_array(mysqli_query($baglanti,$sql), MYSQLI_ASSOC);
	//$name_surname = $getInfo["name_surname"];
	$user_orcid = $getInfo["orcid_no"];

    // return $getInfo;
    return 0;
}


function orcidKontrol(){

    global $baglanti;
    $user=$_SESSION["user"];
    $sql = "SELECT * FROM users WHERE user_name='$user'";
	$getInfo = mysqli_fetch_array(mysqli_query($baglanti,$sql), MYSQLI_ASSOC);
	//print_r($getInfo);
	//$name_surname = $getInfo["name_surname"];
	$user_orcid = $getInfo["orcid_no"];

    // return $user_orcid;
    return 0;
}


function ResetPass(){
    include("app/connect.php");
    include "user/function.php";
    $email = _post('email');
    $tmp_pass=rasgeleSifre();
    $pass_md5 = md5(md5($tmp_pass));
    
    $sql = "SELECT * FROM users WHERE email='$email' and state=1";
	$getInfo = mysqli_fetch_array(mysqli_query($baglanti,$sql));
	
	$name_surname = $getInfo["name_surname"];
	$user_name = $getInfo["user_name"];
	
	$message = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM `mailTable` WHERE `label`='forgotpassword'"))->text;
	$message = str_replace("[[name_surname]]",$name_surname,$message );
	$message = str_replace("[[tmp_pass]]",$tmp_pass,$message );
	$message = str_replace("[[user_name]]",$user_name,$message );
	$message = str_replace("[[journalDomain]]",$journalDomain,$message );
	$message = str_replace("[[journalShortName]]",$journalShortName,$message );
	 
	
	//$message = "Dear ".$name_surname.",<br>Your password was changed according to your request. You can find your login information below.<br>";
	//$message .= "User name: ".$user_name."<br>Password: ".$tmp_pass;
	//$message .= "<br><a href='".$journalDomain."/index.php?page=login'> Click to login to ".$journalShortName."</a>";

    if (mysqli_num_rows(mysqli_query($baglanti,$sql))) {
        $log_state="Sifre sıfırlama";
        log_all($email,$log_state);
        $sql_tmp="update users set pass='$pass_md5' WHERE email='$email'";
        if (mysqli_query($baglanti,$sql_tmp)){
			
            mail_gonder($email,"Password Reset Request",$message);
            $log_state="Sifre sıfırlama";
            log_all($email,$log_state);
            MesajGoster("Your new password was sent to your e-mail address!");
            Yonlendirme('index.php?page=login');
        }


    } else {
        $log_state="Hata -> Hatalı Mail adresi! email = ".$email;
        log_all($email,$log_state);
        MesajGoster("There is not a user with this e-mail address!");
        Yonlendirme('index.php?page=login');
    }
}

function data_kaydet_contact($data)
{

    include("app/connect.php");
    $data[5] = date("y-m-d");
    $sql = "INSERT INTO `contact`(`name_surname`,`subject` ,`email`, `message`,`date`) VALUES ('$data[1]','$data[2]','$data[3]','$data[4]','$data[5]')";
    if (mysqli_query($baglanti,$sql)) {

        MesajGoster("Thank you.  Your message has been sent.");
    } else {
        MesajGoster("Error Database." . $sql->errno);
    }


}

function Contact()
{
   
        $data[1] = _post("your_name");
        $data[2] = _post("your_subject");
        $data[3] = _post("your_email");
        $data[4] = _post("your_message");


        //echo $_POST['your_name'].$_POST['your_email'].$_POST['your_message'].$_POST['answer'];
        data_kaydet_contact($data);
        Yonlendirme("index.php?page=contact");

}

function UploadPhoto()
{
    $user_name=_get('user_name');
    $target_dir = "user/images/";
    $target_file = $target_dir . basename($_FILES["user_photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["user_photo"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
// Check if file already exists
    /*
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }*/
// Check file size
    if ($_FILES["user_photo"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "PNG"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
  // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        //Yükleme yapılıyor...
        if (move_uploaded_file($_FILES["user_photo"]["tmp_name"], $target_file)) {
            $dir = 'user/images';
            $files = scandir($dir);
            foreach ($files as $image) {
                if (preg_match("/" . $user_name . "/", $image))
                unlink("user/images/".$image);

            }
            $old="user/images/".basename($_FILES["user_photo"]["name"]) ;
            $new="user/images/".$user_name.".".$imageFileType;
            rename($old,$new);
            Yonlendirme("user/index.php?page=profile");
            //echo "The file " . basename($_FILES["user_photo"]["name"]) . " has been uploaded.";

        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

}

function UploadProfile()
{

     include("app/connect.php");
    $user_name = _get('user_name');
    $name = _post("name");
    $surname = _post("surname");
    $name_surname = $name." ".$surname;
    $user_name_form = _post('user_name_form');
    $email = _post('email');
    $adress = _post('adress');
    $instition = _post('instition');
    $phone = _post('phone');
    $user_work_area=_post('user_work_area');
    $user_orcidno=_post('orcid_no');
    $unvan=_post('unvan');
    $pass_gelen=_post('pass');
    //$pass_again=_post('pass_again');

    if ($pass_gelen=="") {
        MesajGoster("Şifrelerinizi Kontrol Ediniz!!!");
        Yonlendirme("user/index.php?page=profile");
        exit;    
        }

//
    $user = _post('user');
    $pass = _post('pass');
    $pass_md5 = md5(md5($pass_gelen));

    $sql = "SELECT * FROM users WHERE user_name= '$user_name' and state=1 AND pass= '$pass_md5'";


    if (mysqli_num_rows(mysqli_query($baglanti,$sql))) {

//

  

   
        $pass = md5(md5($pass_gelen));
        $sql = "update users set name_surname='$name_surname',adress='$adress',instition='$instition',
            phone='$phone',unvan='$unvan',orcid_no='$user_orcidno',work_area='$user_work_area' where user_name='$user_name' ";
        if (mysqli_query($baglanti,$sql)) {

            MesajGoster("Bilgileriniz Güncellendi");
           // session_start();
            ob_start();
            $_SESSION["user"] = $user_name;
            $_SESSION["pass"] = $pass;
            Yonlendirme("user/index.php?page=profile");

        } else {
            MesajGoster($sql);
            Yonlendirme("user/index.php?page=profile");
        }
    }else{
        
        MesajGoster("Bilgilerinizi Kontrol Ediniz!!!");
        Yonlendirme("user/index.php?page=profile");
        
        
    }
   

}


function UpdatePassword()
{

    include("app/connect.php");
    $user_name = _get('user_name');
    $pass_gelen=_post('pass');
    $pass_again=_post('pass_again');

    if ($pass_gelen=="") {
        MesajGoster($sql);
        Yonlendirme("user/index.php?page=profile");
    }

    if ($pass_gelen==$pass_again) {
        $pass = md5(md5($pass_gelen));
        $sql = "update users set pass='$pass'  where user_name='$user_name' ";
        if (mysqli_query($baglanti,$sql)) {

            MesajGoster("Bilgileriniz Güncellendi");
          //  session_start();
            ob_start();
            $_SESSION["user"] = $user_name_form;
            $_SESSION["pass"] = $pass;
            Yonlendirme("user/index.php");

        } else {
            MesajGoster("Bu Kullanıcı Adı Başka Bir Kullanıcı Tarafından Kullanılmaktadır!!!");
            Yonlendirme("user/index.php?page=profile");
        }
    }
    else {
        MesajGoster("Şifrelerinizi Kontrol Ediniz!!!");
        Yonlendirme("user/index.php?page=profile");
    }

}




function son_kayit_ID_getir()
{
    global $baglanti;
    // submission_list makalelerdeki son kayıt ID almak
    $last_id = "";
    include('app/connect.php');
    $sql = "SELECT * FROM submission_list  ORDER BY id DESC LIMIT 1";
    if (mysqli_query($baglanti,$sql)) {
        while ($data = mysqli_fetch_array(mysqli_query($baglanti,$sql))) {
            $last_id = $data["id"];

            break;
        }
    } else echo "Sorgu Hatası";
    if ($last_id == "") $last_id = 0;

    return ($last_id + 1);
}



//session_start();
if (!isset($_GET['user_name'])) $user_name = "";
else $user_name = $_GET['user_name'];


if (isset($_GET['system'])) {
    switch ($_GET['system']) {
        case 'login':
           if($_POST['kod'] == $_SESSION["dogrulamakodu"])
			{
                LogIn();
                break;
           
            }else {
                 MesajGoster( "incorrect code, please try again!");
                Yonlendirme('index.php?page=login');
                }

        case 'logout':
            LogOut();
            break;

        case 'contact':
               if($_POST['kod'] == $_SESSION["dogrulamakodu"])
                {
                   Contact();
                   break;
                    
                }else {
                   MesajGoster( "incorrect code, please try again!");
            
                    Yonlendirme("index.php?page=contact");
                 }
           

        case 'new_user':
                if($_POST['kod'] == $_SESSION["dogrulamakodu"])
			    {
                    NewUser();
                    break;
                            
                }else {
                    $mesaj1="Incorrect code, please try again!".$_SESSION["dogrulamakodu"]."--".$_POST['kod']."**";
                    MesajGoster($mesaj1);
                    die();
                    Yonlendirme('index.php?page=login');
                }

        case 'reset_pass':
            ResetPass();
            break;

        case 'upload_photo':
            UploadPhoto();
            break;

        case 'upload_profile':
            UploadProfile();
            break;

       case 'upload_password':
            UpdatePassword();
            break;

        default:
            # code...
            break;
    }
}

?>
