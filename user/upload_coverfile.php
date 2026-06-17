<div class="x_content">

    <?php
    session_start();
    ob_start();
    $new_name = $_SESSION["user"];

    $subID = $_GET["id"];
    if (isset($_GET["process"])) {
        $process = $_GET["process"];
       // echo $process."<br>";
    } else {
        $process = "";
    }
    
    
    
		include("../app/connect.php");
        include("function.php");
        include("../system.php");
        $subID=$_GET["id"];
        //echo "makale id si".$subID;
        
        //INSERT INTO `cover_files_path`(`id`, `year`, `volume`, `no`, `cover`, `front_matter`, `table_of_contents`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])
		$rnQuery = "select * from cover_files_path where id='$subID'";
        $rnQuery_prop = mysqli_fetch_object(mysqli_query($baglanti,$rnQuery));
        $volume = $rnQuery_prop->volume;
        $no=$rnQuery_prop->no;
        $year=$rnQuery_prop->year;
        //2019_Vol4_no2_cover.pdf
        //2019_Vol4_no2_front_matter.pdf
        // 2019_Vol4_no2_table_of_contents.pdf
    
    $new_name = "";
    
	if ($process == "coverpdf")
    {
			  
			 $PageTitle = " Cover Page   "; 
    		 $new_name = '../cover_files/' . $year . '_Vol' . $volume. '_no' . $no. '_cover.pdf' ;
			 $rQuery = "update cover_files_path set cover='$new_name'   WHERE id='$subID'";
		//	 echo $PageTitle."<br>";

    }
    else if ($process == "matterpdf")
	{
			 $PageTitle = "   Front Matter   "; 
    		 $new_name = '../cover_files/' . $year . '_Vol' . $volume. '_no' . $no. '_front_matter.pdf' ;
			 $rQuery = "update cover_files_path set front_matter='$new_name'   WHERE id='$subID'";
    }
    else if ($process == "tableofpdf")
    {
		      $PageTitle = "   Table of Contents  "; 
    		 $new_name = '../cover_files/' . $year . '_Vol' . $volume. '_no' . $no. '_table_of_contents.pdf' ;
			 $rQuery = "update cover_files_path set table_of_contents='$new_name'   WHERE id='$subID'";
    }
    else 
		$new_name = "";
		
		
    
    if (isset($_FILES['my_file']) && $_FILES['my_file']['error'] == 0) { 




			// A list of permitted file extensions
           // C:\xampp\php\php.ini ayarları düzenle
        $allowed = array('pdf');
       // $new_name = "";
        

            $extension = pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($extension), $allowed)) {
                echo '{"Please upload pdf file :Error-541"}';
                exit;
            }
           
		if ($new_name != "") { 
          //  $new_name = '../cover_files/'.$journalShortName.'_' . $paperCode . '.' . $extension;
            if (move_uploaded_file($_FILES["my_file"]["tmp_name"], $new_name)) {
              //   echo '{"status":"success"}'.'</br>';
               MesajGoster($PageTitle. "File is uploaded ");

            }
        }


       // $rQuery = "update cover_files_path set paperfile1='$new_name',word_format='$new_name',`date`='$upload_date' WHERE id='$subID'";


        if (mysqli_query($baglanti,$rQuery)) {
            $log_state = $new_name . " cover file YÜKLEDİ";
            log_all($new_name, $log_state);
          //  MesajGoster("The Installation of the paper of ".strtoupper($author_name)." is COMPLETED ... [OK]");
           // Yonlendirme("index.php?page=edit_page&m_id=1&edit_page=content");
           // echo "File is uploaded as ".$new_name;
          
         // echo ' <br> <br> <input type="button" value="Close this window" onclick="self.close()">';
           echo '<center><input type="button"   onclick="CloseAndRefresh()" value="Close this window" />';
           
           

        } else {
            echo "Veritabanı Hatası";
            $log_state = "HATA ->" . $new_name . " Nolu Makaleyi PUBLISH İCİN YÜKLEYEMEDİ ->" . mysqli_error();
            log_all($new_name, $log_state);
        }

    }
    else 
    { ?>
		<br><br><center><a class='btn btn-round btn-warning inbox-title'>Upload  file for <?php  echo $PageTitle;  ?> </a></center>
       <br><br> <form class="form-horizontal form-label-left" enctype="multipart/form-data" method="post"
              action="upload_coverfile.php?process=<?php echo $process; ?>&id=<?php echo $subID; ?>">
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
                    <input type="file" name="my_file" id="my_file"
                           class="rsform-upload-box"/>
                </div>
            </div>

            <div class="form-group">

                <div style="text-align: center">
                    <br>
                    <button type="submit" class="btn btn-primary">Upload Paper</button>
                </div>
            </div>
        </form>
    <?php 
    } 
    
    ?>
    
    
    
    

</div>

<!-- /page content -->

<script>
    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
    };
    
    function closeWin() {
  myWindow.close();   // Closes the new window
}

//close popup window and refresh the parent window
function CloseAndRefresh()
{
    window.close();
    if (window.opener && !window.opener.closed) {
    window.opener.location.reload();
    }
}
</script>
