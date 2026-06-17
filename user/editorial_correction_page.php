<?php

function editorial_correction(){
    include("../app/connect.php");
    $m_id=$_GET["m_id"];
    $sub_id=$_GET["id"];
    $pQuery="Select * from submission_list where id=$sub_id";
    $paperProp=mysqli_fetch_object(mysqli_query($baglanti,$pQuery));
    $paperCode=$paperProp->paperID;
    $paperTitle=$paperProp->title;
    $authors=$paperProp->authors;
    $keywords=$paperProp->keyword;
    $abstract=$paperProp->abstract;

    echo "<form class=\"form-horizontal form-label-left\" enctype=\"multipart/form-data\" method=\"post\" action=\"editorial_correction_page.php?process=new_paper\">
    <div class=\"form-group\">
        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first-name\">Manuscript Code <span class=\"required\">*</span>
        </label>
        <div class=\"col-md-6 col-sm-6 col-xs-12\">
            <input type=\"text\" name=\"paperCode\" required=\"required\" class=\"form-control col-md-7 col-xs-12\" value=\"$paperCode\" readonly>
        </div>
    </div>

    <div class=\"form-group\">
        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first-name\">Manuscript Title <span class=\"required\">*</span>
        </label>
        <div class=\"col-md-6 col-sm-6 col-xs-12\">
            <input type=\"text\" name=\"paperTitle\" required=\"required\" class=\"form-control col-md-7 col-xs-12\" value=\"$paperTitle\">
        </div>
    </div>

    <div class=\"form-group\">
        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first-name\">Authors <span class=\"required\">*</span>
        </label>
        <div class=\"col-md-6 col-sm-6 col-xs-12\">
            <input type=\"text\" name=\"authors\" required=\"required\" class=\"form-control col-md-7 col-xs-12\" value=\" $authors\" >
        </div>
    </div>";

    echo "<div class=\"form-group\">
        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first-name\">Keywords <span class=\"required\">*</span>
        </label>
        <div class=\"col-md-6 col-sm-6 col-xs-12\">
            <input type=\"text\" name=\"keywords\"  required=\"required\" class=\"form-control col-md-7 col-xs-12\" value=\"$keywords\">
        </div>
    </div>

    <div class=\"form-group\">
        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first-name\">Abstract <span class=\"required\">*</span>
        </label>
        <div class=\"col-md-6 col-sm-6 col-xs-12\">
            <textarea name=\"abstract\"  class=\"form-control\" rows=\"3\">$abstract</textarea>
        </div>
    </div>

    <div class=\"form-group\">
        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first-name\">Message To Editor <span class=\"required\">*</span>
        </label>
        <div class=\"col-md-6 col-sm-6 col-xs-12\">
            <textarea class=\"form-control\" name=\"message\"  rows=\"3\"></textarea>
        </div>
    </div>

    <div class=\"form-group\">
        <label class=\"control-label col-md-3 col-sm-3 col-xs-12\" for=\"first-name\">Upload File <span class=\"required\">*</span>
        </label>
        <div class=\"col-md-6 col-sm-6 col-xs-12\">
            <input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"5000000\"/>
            <input type=\"file\" name=\"my_file\" id=\"my_file\"
                   class=\"rsform-upload-box\"/>
        </div>
    </div>

    <div class=\"form-group\">

        <div style=\"text-align: center\">
            <br>
            <button type=\"submit\" class=\"btn btn-primary\">Upload Paper</button>
        </div>
    </div>
</form>";

}


function new_paper(){
    include ("../app/connect.php");
    include ("function.php");
    include ("../system.php");
    $paperCode=$_POST["paperCode"];
    $paperTitle=$_POST["paperTitle"];
    $authors=$_POST["authors"];
    $keywords=$_POST["keywords"];
    $abstract=tirnak_replace($_POST["abstract"]);
    $message=tirnak_replace($_POST["message"]);
    $upload_date=date("Y-m-d");

    $rnQuery="select * from submission_list where paperID='$paperCode'";
    $rnQuery_prop=mysqli_fetch_object(mysqli_query($baglanti,$rnQuery));
    $subID=$rnQuery_prop->id;
    $name_surname=$rnQuery_prop->name_surname;
    $revised_number=$rnQuery_prop->revised_number;


// A list of permitted file extensions
// C:\xampp\php\php.ini ayarları düzenle
    $allowed = array('zip', 'rtf', 'doc', 'rar', 'docx', 'pdf','odt');
    $new_name = "";
    
   
    if (isset($_FILES['my_file']) && $_FILES['my_file']['error'] == 0) {

        $extension = pathinfo($_FILES['my_file']['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($extension), $allowed)) {
            echo '{"Error":"541"}';
            //exit;
        }

        $new_name = '../uploadfiles/'.$journalShortName.'_' . $paperCode. '.' . $extension;
        if (move_uploaded_file($_FILES["my_file"]["tmp_name"], $new_name)) {
            //echo '{"status":"success"}';

        }
    }
    else {
        echo $_FILES['my_file']['error'];
        header("Refresh:2;  URL = index.php?page=editorial_correction&m_id=21&rnb=4");
    }

    // accept_status u -1 yaparak yeni yükleme olduğunu belirledik
    if ($revised_number==0){
        $rQuery="update submission_list set title='$paperTitle',authors='$authors', keyword='$keywords' ,abstract='$abstract',	msg_to_editor='$message',
paperfile1='$new_name',paperID='$paperCode',`date`='$upload_date',accept_status=-1 WHERE id='$subID'";
    }
    else{
        $rQuery="update submission_list set title='$paperTitle',authors='$authors', keyword='$keywords' ,abstract='$abstract',	msg_to_editor='$message',
paperfile1='$new_name',paperID='$paperCode',`date`='$upload_date',accept_status=-2 WHERE id='$subID'";
    }

    if (mysqli_query($baglanti,$rQuery)){
        $log_state=$paperCode." Nolu Makaleyi YENİDEN YÜKLEDİ";
        log_all($name_surname,$log_state);
        $message=$name_surname." tarafından ".$paperCode." ID li makale yeniden yüklendi";
        send_message($message,2,$journalShortName,2);
        MesajGoster("Completed ...[OK]");
        header("Refresh:1;  URL = index.php?page=editorial_correction&m_id=21&rnb=4 ");
    }
    else
    {
        echo "Veritabanı Hatası";
        $log_state="HATA ->".$paperCode." Nolu Makaleyi YENİDEN YÜKLEYEMEDİ ->".mysqli_error();
        log_all($name_surname,$log_state);
    }


}

$process = @$_GET['process'];
switch ($process) {

    case "editorial_correction":
        editorial_correction();
        break;

    case "new_paper":
    echo '{"status":"success"}';
        new_paper();
        break;


    default:

        break;
}

