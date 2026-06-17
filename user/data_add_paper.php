<?php

include("../app/connect.php");
include("../system.php");
include("function.php");
$s_user = $_SESSION["user"];
$name_surname = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM users where user_name='$s_user' "))->name_surname;
$email = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM users where user_name='$s_user' "))->email;
$title = $_POST["title"];

$name_author = $_POST["all_authors"];

$key_words = $_POST["key_words"];
$abstract = $_POST["abstract"];
$message = $_POST["message"];
$all_authors_email = $_POST["all_authors_email"];
$date_time = date('Y-m-d H:i:s');
if (isset($_POST["all_authors"])) 
	$type=$_POST["all_authors"];
else 
	$type=$name_surname;

$abstract=tirnak_replace($abstract);
$title=tirnak_replace($title);
$key_words=tirnak_replace($key_words);
$message=tirnak_replace($message);




//$ncp_id = $_GET['ncp_id'];
 
$s_user = $_SESSION["user"];
$name_surname = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM users where user_name='$s_user' "))->name_surname;
$email = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM users where user_name='$s_user' "))->email;

$title = $_POST["title"];

$name_author = $_POST["all_authors"];
$key_words = $_POST["key_words"];
$abstract = $_POST["abstract"];
$message = $_POST["message"];
$all_authors_email = $_POST["all_authors_email"];
$date_time = date('Y-m-d H:i:s');

if (isset($_POST["all_authors"])) 
	$type=$_POST["all_authors"];
else 
	$type=null;
	

$abstract=tirnak_replace($abstract);
$title=tirnak_replace($title);
$key_words=tirnak_replace($key_words);
$message=tirnak_replace($message);




$reviewMail1 = $_POST['reviewMail1'];
$reviewName1 = $_POST['reviewName1'];
$instition1 = $_POST['affiliation1'];

$reviewMail2=$_POST['reviewMail2'];
$reviewName2=$_POST['reviewName2'];
$instition2=$_POST['affiliation2'];

$reviewMail3=$_POST['reviewMail3'];
$reviewName3=$_POST['reviewName3'];
$instition3=$_POST['affiliation3'];
$myfile=$_FILES['my_file']['name'];


/// yazarları getir  
$corname = $_POST["cur_author"]; 
$name1 = $_POST["name_author"];
$name2 = $_POST["author_email_tmp"];

?>
<html>
<body>


<center><h1>Details of your Submission </h1></center>

                       
                                    
												<h2 class="StepTitle" id="title_baslik">Title* :</h2>
                                    <label id="prev_title" style="padding-left: 5px;"><?php echo $title;    ?></label>                                    
                                    
                                    
 												<h2 class="StepTitle" id="author_baslik">Author* :</h2>
                                    <label id="prev_author" style="padding-left: 5px;">
                                    
                                    <?php  
												
                                    			$yazarlar[0]=$name_surname;
                                    			for($i=0;$i<=count($name1);$i++){
                                    			
                                    					$yazarlar[$i+1]=$name1[$i];
                                    				
                                    			} 
                                    			
															for($i=0;$i<=count($yazarlar);$i++){
                                    			
                                    				if($corname == $yazarlar[$i]) {
                                    					$yazarlar[$i].="*";
                                    				}
                                    			} 
                                    			$all_authors1=implode(", ", $yazarlar);                                    			 
                                    			echo $all_authors1;
                                    				 ?> </label>

                                    
                                    
                                    <h2 class="StepTitle" id="keywords_baslik">Keywords* :</h2>
                                    <label id="prev_keyword" style="padding-left: 5px;"><?php echo $key_words;    ?></label>

                                    <h2 class="StepTitle" id="abstract_baslik">Abstract*</h2>
                                    <label id="prev_abstract" style="padding-left: 5px;"><?php echo $abstract;    ?></label>


                                    <h2 class="StepTitle" id="message_baslik">Your Message *:</h2>
                                    <label id="prev_message" style="padding-left: 5px;"><?php echo $message;    ?></label>
                                    </br>
                                     <h2 class="StepTitle" id="refere_baslik">Suggest three referees *:</h2>
                                      <label id="prev_reviewName1" style="padding-left: 5px;"><?php echo $reviewName1;    ?> </label>
                                    </br>
                                    <label id="prev_reviewName2" style="padding-left: 5px;"><?php echo $reviewName2;    ?></label>
                                    </br>
                                    <label id="prev_reviewName3" style="padding-left: 5px;"><?php echo $reviewName3;    ?></label>
                                    </br> </br>

                                    <label style="font-size: 16px;" id="file_baslik"><b>Your File* :</b></label>
                                    <label id="prev_upload" style="padding-left: 5px;"><?php echo $myfile;    ?></label>
                                     </br> </br>
												
												
												
											  <br> <span class="anahtar">*required <br>  Please fill required fields!</span>
<button> Approval </button>
                                  
 </body>
</html>

<?php

/*
if (preg_match("/'/", $abstract)) $abstract = str_replace("'", " ", $abstract);
include("../app/connect.php");

if ($query = mysqli_query($baglanti,"select * from submission_list_temp WHERE id='$ncp_id'")) {
    if (mysqli_num_rows($query)) {
        if (mysqli_query($baglanti,"update submission_list_temp  set title='$title',all_authors='$all_authors',key_words='$key_words',abstract='$abstract',message='$message' where id='$ncp_id'")) {
            $ncp_id = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM submission_list_temp where id='$ncp_id'"))->id;
        }
    } else {
        if (mysqli_query($baglanti,"insert into submission_list_temp (user_name,title,all_authors,key_words,abstract,message)
 VALUES ('$user_name','$title','$all_authors','$key_words','$abstract','$message')")) {
            $ncp_id = mysqli_fetch_object(mysqli_query($baglanti,"SELECT max(id) as max_id FROM submission_list_temp where user_name='$user_name'"))->max_id;

        }
    }
}
$data = $ncp_id;
echo json_encode($data);
*/
?>