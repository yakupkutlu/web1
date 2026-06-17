<Title> Upload File</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">

<div class="x_content">

    <?php
    session_start();
    ob_start();
    $new_name = $_SESSION["user"];

    $subID = $_GET["id"];
    if (isset($_GET["process"])) {
        $process = $_GET["process"];
    } else {
        $process = "";
    }
    if ($process == "upload") {
        include("../app/connect.php");
        include("function.php");
        include("../system.php");
        $subID=$_GET["id"];
        //echo "makale id si".$subID;

        $upload_date = date("Y-m-d");

        $rnQuery = "select * from submission_list where id='$subID'";
        $rnQuery_prop = mysqli_fetch_object(mysqli_query($baglanti,$rnQuery));
        $paperCode = $rnQuery_prop->paperID;
        $author_name=$rnQuery_prop->name_surname;


// A list of permitted file extensions
// C:\xampp\php\php.ini ayarları düzenle
        $allowed = array('zip', 'rtf', 'doc', 'rar', 'docx', 'pdf', 'odt');
        $new_name = "";
        if (isset($_FILES['my_file']) && $_FILES['my_file']['error'] == 0) {

            $extension = pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($extension), $allowed)) {
                //echo '{"Error":"541"}';
                //exit;
            }
           
            $new_name = '../uploadfiles/'.$journalShortName.'_' . $paperCode . '.' . $extension;
            if (move_uploaded_file($_FILES["my_file"]["tmp_name"], $new_name)) {
                //echo '{"status":"success"}'.'</br>';
                //echo $new_name;

            }
        } else {
            $hata = $_FILES['my_file']['error'];
            MesajGoster($hata);
        }


        $rQuery = "update submission_list set paperfile2='$new_name',word_format='$new_name',`date`='$upload_date' WHERE id='$subID'";


        if (mysqli_query($baglanti,$rQuery)) {
            $log_state = $paperCode . " Nolu Makaleyi PUBLISH İCİN YÜKLEDİ";
            log_all($name_surname, $log_state);
            MesajGoster("The Installation of the paper of ".strtoupper($author_name)." is COMPLETED ...");
             echo '<center><input type="button"   onclick="CloseAndRefresh()" value="Close this window" />';
           

        } else {
            echo "Veritabanı Hatası";
            $log_state = "HATA ->" . $paperCode . " Nolu Makaleyi PUBLISH İCİN YÜKLEYEMEDİ ->" . mysqli_error();
            log_all($name_surname, $log_state);
        }

    }

    if ($process == "pdf_upload") {
        include("../app/connect.php");
        include("function.php");
        include("../system.php");

        $subID=$_GET["id"];
        //echo "makale id si".$subID;

        $upload_date = date("Y-m-d");

        $rnQuery = "select * from submission_list where id='$subID'";
        $rnQuery_prop = mysqli_fetch_object(mysqli_query($baglanti,$rnQuery));
        $paperCode = $rnQuery_prop->paperID;
        $author_name=$rnQuery_prop->name_surname;
        $old_paperfile = $rnQuery_prop->paperfile1;
        $word_format = $rnQuery_prop->word_format;
        $pdf_state = 0;
        if ($word_format == "" || $word_format == "NULL") $pdf_state = 0;
        else $pdf_state = 1;


// A list of permitted file extensions
// C:\xampp\php\php.ini ayarları düzenle
        $allowed = array('pdf');
        $new_name = "";
        if (isset($_FILES['my_file']) && $_FILES['my_file']['error'] == 0) {

            $extension = pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($extension), $allowed)) {
                //echo '{"Error":"541"}';
                //exit;
                MesajGoster("Your file must PDF format !!!");

            }
        
            $new_name = '../uploadfiles/'.$journalShortName.'_' . $paperCode . '.' . $extension;
            if (move_uploaded_file($_FILES["my_file"]["tmp_name"], $new_name)) {
                //echo '{"status":"success"}'.'</br>';
                //echo $new_name;
                if ($pdf_state == 0) {
                    $rQuery = "update submission_list set paperfile1='$new_name',word_format='$old_paperfile',`date`='$upload_date' WHERE id='$subID'";

                } else {
                    $rQuery = "update submission_list set paperfile1='$new_name',`date`='$upload_date' WHERE id='$subID'";

                }


                if (mysqli_query($baglanti,$rQuery)) {
                    $log_state = $paperCode . " Nolu Makaleyi PDF FORMATI PUBLISH İCİN YÜKLEDİ";
                    log_all($name_surname, $log_state);
                    MesajGoster("The Installation of the paper of ".strtoupper($author_name)." is COMPLETED ...");
							
           echo '<center><input type="button"   onclick="CloseAndRefresh()" value="Close this window" />';
                } else {
                    echo "Veritabanı Hatası";
                    $log_state = "HATA ->" . $paperCode . " Nolu Makaleyi PDF FORMATI  PUBLISH İCİN YÜKLEYEMEDİ ->" . mysqli_error();
                    log_all($name_surname, $log_state);
                }
            }
        } else {
            $hata = $_FILES['my_file']['error'];
            MesajGoster($hata);
        }





    }

    
	
    if ($process == "image_upload") 
    {
        include("../app/connect.php");
        include("function.php");
        include("../system.php");

        $subID=$_GET["id"];
        //echo "makale id si".$subID;

        $upload_date = date("Y-m-d");

        $rnQuery = "select * from submission_list where id='$subID'";
        $rnQuery_prop = mysqli_fetch_object(mysqli_query($baglanti,$rnQuery));
        $paperCode = $rnQuery_prop->paperID;
        $author_name=$rnQuery_prop->name_surname;
        $old_paperfile = $rnQuery_prop->paperfile1;
        $word_format = $rnQuery_prop->word_format;
        $pdf_state = 0;
        


        // A list of permitted file extensions
            // C:\xampp\php\php.ini ayarları düzenle
        $allowed = array('jpg','png','jpeg','tiff');
        $new_name = "";
        if (isset($_FILES['my_file']) && $_FILES['my_file']['error'] == 0) {

            $extension = pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION);

            if (!in_array(strtolower($extension), $allowed)) {
                //echo '{"Error":"541"}';
                //exit;
                MesajGoster("Your file format must be jpg/png/tiff  !!!");

            }
        
            $new_name = '../paperimages/'.$journalShortName.'_' . $paperCode . '.' . $extension;
            if (move_uploaded_file($_FILES["my_file"]["tmp_name"], $new_name)) {
                 $rQuery = "update submission_list set coverImage='$new_name'WHERE id='$subID'";

              


                if (mysqli_query($baglanti,$rQuery)) {
                    $log_state = $paperCode . " Abstract image is uploaded";
                    log_all($name_surname, $log_state);
                    MesajGoster("The Abstract Image Installation of the paper of ".strtoupper($author_name)." is COMPLETED ...");
							
           echo '<center><input type="button"   onclick="CloseAndRefresh()" value="Close this window" />';
                } else {
                    echo "Veritabanı Hatası";
                    $log_state = "HATA ->" . $paperCode . " Abstract image is not uploaded ->" . mysqli_error();
                    log_all($name_surname, $log_state);
                }
            }
        } else {
            $hata = $_FILES['my_file']['error'];
            MesajGoster($hata);
        }





    }
 
 
 
	if ($process == "") { ?>
        <form class="form-horizontal form-label-left" enctype="multipart/form-data" method="post"
              action="upload_file.php?process=upload&id=<?php echo $subID; ?>">
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
                    <button type="submit" class="btn btn-primary">Upload File</button>
                </div>
            </div>
			
			
            <div class="form-group">

                    <div style="text-align: center">
                                
                           <b> <p id="textyaz2" style="color:red;"> ..... </p>  
                                 <p id="textyaz" style="color:white;"> ..... </p>  </b>
                                 
                </div> 
              </div>
         
        </form>
    
	
	

<?php }
?>



<?php 
 if ($process == "abstractimage") 
 { ?>
        <form class="form-horizontal form-label-left" enctype="multipart/form-data" method="post"
              action="upload_file.php?process=image_upload&id=<?php echo $subID; ?>">
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
                    <input type="file" name="my_file" id="my_file"  
                           class="rsform-upload-box"  onchange="myFunction()" />
                </div>
            </div>

            <div class="form-group">

                <div style="text-align: center">
                    <br>
                    <button type="submit" class="btn btn-primary">Upload File</button>
                </div> 
            </div>

         
            <div class="form-group">

                    <div style="text-align: center">
                                
                           <b> <p id="textyaz2" style="color:red;"> ..... </p>  
                                 <p id="textyaz" style="color:white;"> ..... </p>  </b>
                                 
                </div> 
              </div>
                               
        </form>
    <?php } ?>



<?php 
if ($process == "pdf") 
{ ?>
        <form class="form-horizontal form-label-left" enctype="multipart/form-data" method="post"
              action="upload_file.php?process=pdf_upload&id=<?php echo $subID; ?>">
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
                    <input type="file" name="my_file" id="my_file" accept="application/pdf"
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
    <?php } ?>

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
