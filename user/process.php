<style>
    #captcha span {
        padding: 8px;
        padding-bottom: 13px;
        font-size: 25px;
        font-family: "Comic Sans MS";
        font-weight: bold;
        border: solid 3px;
        border-color: #73879C;
        color: #90111A;

    }

    .btn.btn-app {
        color: #73879C;
    }

    #captcha a:hover {
        color: #3a599c;
    }

    .form-horizontal .control-label {
        text-align: left !important;
    }

    .div_captcha {
        padding-top: 6%;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<?php



$process = @$_GET['process'];
switch ($process) {

    case "delete_not_comp":
        delete_not_comp();
        break;

    case "send_review":
        send_review();
        break;

    case "send_back_author":
        send_back_author();
        break;
 
 	case "send_back_author_in_revised":
        send_back_author_in_revised();
        break;
        
   case "add_similarityrate":
        add_similarityrate();
        break;

    case "send_review_request_revision_page":
        send_review_request_revision_page();
        break;

    default:

        break;
}




/*
function Yonlendirme($URL)
{
    header("Refresh:2;  URL = $URL ");
    die();
}
*/
/*
function MesajGoster($message)
{

    include("message.php");
}
*/
function delete_not_comp()
{
	  
    include "../app/connect.php";
    include("../system.php");
    include("function.php");
    
    $id = $_GET["id"];
    $sql = "delete from submission_list_temp where id='$id'";
    if (mysqli_query($baglanti,$sql)) {
        MesajGoster(" Submission  Deleted ");
        Yonlendirme("index.php?page=not_completed&rnb=4");
    }
}

function send_review()
{
    include("../app/connect.php");
    
    
    $id = $_GET["id"];
    $m_id = $_GET["m_id"];
    $pQuery = mysqli_query($baglanti,"SELECT * FROM submission_list WHERE id='$id'");
    $pQuery_obj = mysqli_fetch_object($pQuery);
    $title = $pQuery_obj->title;
    $paper_id = $pQuery_obj->paperID;
    /*$a = rand(1, 10);
    $b = rand(1, 100);
    $answer = $a + $b;*/
    $s_user = $_SESSION["user"];
    $editor_name = mysqli_fetch_object(mysqli_query($baglanti,"select name_surname from users where user_name='$s_user'"))->name_surname;
    $tQuery = mysqli_query($baglanti,"SELECT text FROM mail_text WHERE type='review'");
    $rText = mysqli_fetch_object($tQuery)->text;
    $rQuery = mysqli_query($baglanti,"SELECT * FROM users WHERE state=1 and (role=3 or role=2 or role=1)");
    $url_back = "index.php?page=process-process=send_review-rnb=2-m_id=9-id=" . $id;

    echo '<div class="x_panel">
            <div style="width: 80%;  margin-left: auto; margin-right: auto">';

    echo '<div class="mail">
                        <div class="mail-input-name-input" style="text-align: center;">
                            <p>
                                <h2>' . $title . '</h2>
                            </p>
                        </div>
                    </div></br>';
    /*----------------------------------------------------------------------------------------*/
    if (mysqli_num_rows(mysqli_query($baglanti,"select * from author_review_requests where paperID='$id'")) > 0) {
        echo '<div class="x_panel">
                  <div class="x_title">
                    <h2 style="color: red">Author\'s Reviewer Suggestion</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name Surname</th>
                          <th>Paper ID</th>
                          <th>Review E-Mail</th>
                          <th>Workarea</th>
                        </tr>
                      </thead>
                      <tbody>';
        $query = mysqli_query($baglanti,"select * from author_review_requests where paperID='$id'");
        $sayi = 1;

        while ($data = mysqli_fetch_array($query)) {
            $rID = $data["reviewerID"];
            $rQuery2 = mysqli_fetch_object(mysqli_query($baglanti,"select * from users where id='$rID'"));
            $name_surname = $rQuery2->name_surname;
            $r_email = $rQuery2->email;
            $r_workarea = $rQuery2->work_area;
            echo '<tr>
                          <td>' . $sayi . '</td>                          
                          <td>' . $name_surname . '</td>
                          <td>' . $paper_id . '</td>
                          <td>' . $r_email . '</td>
                          <td>' . $r_workarea . '</td>
                        </tr>';
            $sayi++;
        }
        echo '</tbody> </table></div> </div></br></br>';
    }

    /*----------------------------------------------------------------------------------------*/
    if (mysqli_num_rows(mysqli_query($baglanti,"select * from review_requests where paperid='$id' AND review_status!=0 ")) > 0) {
        echo '<div class="x_panel">
                  <div class="x_title">
                    <h2 style="color: red">Old Request Reviewer</h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name Surname</th>
                          <th>Paper ID</th>
                          <th>Review Request Date</th>
                          <th>Review Request Status</th>
                          <th>Review Status</th>
                          <th>Revised MS request</th>
                        </tr>
                      </thead>
                      <tbody>';
        $query = mysqli_query($baglanti,"select * from review_requests where paperid='$id' AND review_status!=0 ");
        $sayi = 1;

        while ($data = mysqli_fetch_array($query)) {
            $request_id = $data['id'];
            $rID = $data["reviewerid"];
            $revision_status = $data["revizion_status"];
            $rQuery2 = mysqli_fetch_object(mysqli_query($baglanti,"select * from users where id='$rID'"));
            $name_surname = $rQuery2->name_surname;
            $r_name = $rQuery2->user_name;
            $rRequest = $data["request_date"];
            $rStatus = $data["review_status"];//hakemliği kabul etme durumu
            $rAcceptanceValue = $data["acceptance_status"];//makalenin kabul edilebilme durumu
            $rAcceptance = mysqli_fetch_object(mysqli_query($baglanti,"select * from review_decision where `value`= '$rAcceptanceValue' "))->decision;
            $rReport = $data["paper_report"];
            $rMessage = $data["editor_comment"];
            if ($rAcceptanceValue == 3 || $rAcceptanceValue == 4) {
                if ($revision_status == 0)
                    $state_again = '<a href="index.php?page=process&process=send_review_request_revision_page&rnb=2&m_id=9&request_id=' . $request_id . '&id=' . $id . '&r_name=' . $r_name . '"><img src="../images/icon/replay.png" height="28px" style="padding-right:10px;" title="Send Review"></a> ';
                if ($revision_status == 1) $state_again = '<img src="../images/icon/ok-513.ico" height="28px" style="padding-right:10px;" title="Revision Sent">';
            } else
                $state_again = "";
            echo '<tr>
                          <td>' . $sayi . '</td>                          
                          <td>' . $name_surname . '</td>
                          <td>' . $paper_id . '</td>
                          <td>' . $rRequest . '</td>
                          <td>' . $rStatus . '</td>
                          <td>' . $rAcceptance . '</td>
                          <td>' . $state_again . '</td>
                        </tr>';
            $sayi++;
        }
        echo '</tbody> </table></div> </div></br></br>';
    }


    echo '<table id="reviewer_checked_table" class="display" cellspacing="0" width="100%">';

    echo '<thead>
                        <tr>
                          <th>Name and Surname</th>
                          <th>User Name</th>
                          <th>E-Mail</th>
                          <th>Work Area</th>
                        </tr>
                      </thead>


                      <tbody>';
    while ($data = mysqli_fetch_array($rQuery)) {
        echo "<tr onclick='myFunction(this)'>";
        //echo "<td><input type=\"checkbox\" class=\"flat\" name=\"table_records\" value='" . $data["user_name"] . "'></td>";
        //echo "<td><input type=\"checkbox\" class=\"flat\" ></td>";
        echo "<td>" . $data["name_surname"] . "</td>";
        echo "<td>" . $data["user_name"] . "</td>";
        echo "<td>" . $data["email"] . "</td>";
        echo "<td>" . $data["work_area"] . "</td>";


        echo "</tr>";
    }


    echo '</tbody>
                    </table>';
    echo '<form method="post" action="send_review_request.php?m_id=' . $m_id . '" id="contactForm">';
    echo '<input id="text_selected" name="text_selected" type="hidden"></textarea>';
    echo '<div class="mail">
                        <div class="mail-input-name"><p>Message</p></div>
                        <div class="mail-input-name-input" style="border: 1px solid; padding-left:5px; padding-right:5px;">
                                <p>
                               ' . $rText . '
                                </p>
                        </div>
                    </div>

                    <div class="mail">
                        <div class="mail-input-name"><p><br>Managing Editor\'s Name and Surname</p></div>
                        <div class="mail-input-name-input" style="padding-top:17px; padding-bottom:17px;"><p><input type="text" class="contact"  name="editor" value="' . $editor_name . '" readonly/></p>
                        </div>
                    </div>
                    
                    <div class="mail">
                        <span id="captcha" ></span>
                        <div class="answer"><p><br>Please enter the numbers in image (to prevent spam)</p></div>
					    <div class="mail-input-name-input" style="padding-top:0px;"><p><input type="text" class="contact"  id="captcha_txt" placeholder="Enter captcha code"/></p>
                        <input type="hidden" name="id" value="' . $id . '"/></p>
                        </div>	
                    </div>


                     <div class="button_div">

                        <div class="formBody">
                            <input type="submit" value="Send" name="contact_submitted" id="Send" class="button_dynamic"/>
                        </div>
                    </div>';
    echo "</form></div></div>";


    echo '<script src="js/jquery/jquery.min.js"></script>';
    echo '<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>';
    echo '<script src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>';
    echo '<script>
              var Top1,Top2;  
              function captchaCode() {
                      var Numb1, Numb2, Numb3, Numb4, Code;     
                      Numb1 = (Math.ceil(Math.random() * 10)-1).toString();
                      Numb2 = (Math.ceil(Math.random() * 10)-1).toString();
                      Numb3 = (Math.ceil(Math.random() * 10)-1).toString();
                      Top1=Numb1 + Numb2;
                      Top2=Numb3;
                      Code = Top1 + "+" +Top2;
                      $("#captcha span").remove();
                      $("#captcha input").remove();
                      $("#captcha a").remove();
                      $("#captcha").append("<span id=\'code\'>" + Code + "</span><a class=\'btn btn-app\' onclick=\'captchaCode();\'> <i class=\'fa fa-refresh\'></i> Refresh</a>");
                    }
                    
                    $(function() {
                      captchaCode();
                      
                      $(\'#contactForm\').submit(function(){
                        var captchaCode = $("#captcha_txt").val();   
                        var answer=parseInt(Top1)+parseInt(Top2);
                        if (answer != captchaCode) {
                          alert("Please enter the numbers in image (to prevent spam)");
                          //alert("answer ="+answer+" --Top1="+parseInt(Top1)+"--Top2="+parseInt(Top2));
                          return false;
                        }
                        if (answer == captchaCode) {                          
                          return true;
                        }
                      });       
                    });
              </script>';

    echo ' <script>
      function myFunction(x) {
          var txt=document.getElementById("text_selected").value;
          var eklenen=x.cells[1].innerHTML+",";
          var aranan=new RegExp(eklenen,\'g\');
          if (txt.match(aranan)){
              txt=txt.replace(eklenen,"");

          }
          else {txt=txt+eklenen;}

          document.getElementById("text_selected").value=txt;
      }
      </script>';


}


function send_back_author()
{

    $s_user = $_SESSION["user"];
    include("../app/connect.php");
  
    $id = $_GET["id"];
    $m_id = $_GET["m_id"];

    $pSql = mysqli_query($baglanti,"SELECT * FROM submission_list WHERE id='$id'");
    $pQuery = mysqli_fetch_object($pSql);
    $title = $pQuery->title;
    $similarityrate = $pQuery->similarityrate;
    $author = $pQuery->name_surname;
    
    
    $editor_name = mysqli_fetch_object(mysqli_query($baglanti,"Select name_surname from users where user_name='$s_user'"))->name_surname;
   
   
    $journalFormat=mysqli_fetch_object(mysqli_query($baglanti,"Select text from mailTable where id=12"))->text;
    $outOfScop=mysqli_fetch_object(mysqli_query($baglanti,"Select text from mailTable where id=11"))->text;
	$similaritytext=mysqli_fetch_object(mysqli_query($baglanti,"Select text from mailTable where id=14"))->text;

    $outOfScop=str_replace('[title]',$title,$outOfScop);
    $outOfScop=replace_mail_content($outOfScop);
    
    $similaritytext=str_replace('[MSTitle]',$title,$similaritytext);
   
    
	 $similaritytext=str_replace('[Simrate]',$similarityrate,$similaritytext);
	 $similaritytext=replace_mail_content($similaritytext);
	 
	 
	  $journalFormat=str_replace('[MSTitle]',$title,$journalFormat);
	  $journalFormat=replace_mail_content($journalFormat);
	
    /*$a = rand(1, 10);
    $b = rand(1, 100);
    $answer = $a + $b;*/


    echo '<div class="x_panel">
<div style="width: 60%;  margin-left: auto; margin-right: auto">
                 <input id="journalFormatInput" value="'.$journalFormat.'" type="hidden" >   
                 <input id="outOfScopInput" value="'.$outOfScop.'" type="hidden"> 
 					<input id="similarityrateInput" value="'.$similaritytext.'" type="hidden">    
                 <form method="post" action="send_back_author.php?rnb=2&m_id=' . $m_id . '" id="contactForm" class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Manuscript Title</label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">' . $title . '</label>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Manuscript Author</label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">' . $author . '</label>
                    </div>
                    <div class="form-group">
                    <table border="0" class="col-md-12 col-sm-12 col-xs-12">
                    <tr>
                        <td class="col-md-3 col-sm-3 col-xs-12" valign="center">
                            <label class="control-label">M&S-Editor Decision</label>
                        </td>
                        <td class="col-md-9 col-sm-9 col-xs-12">                                                       
                                <input type="radio"  name="editorDecision" id="journalFormat" onclick="changeArea(1)" value="Rejected by Editor because of journal format " checked="" required />  Rejected by Editor because of journal format<br>
                                <input type="radio"  name="editorDecision" id="outOfScop" onclick="changeArea(2)" value="Rejected by Editor because of out of scop " />Rejected by Editor because of out of scop<br>
                              <input type="radio"  name="editorDecision" id="similarityrate" onclick="changeArea(3)" value="Rejected by Editor because of similarity rate " />Rejected by Editor because of similarity rate ( '.$similarityrate.'%)<br>
                             
                        </td>
                    </tr>                                        
                    </table>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Managing Editor\'s Message</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea class="form-control" rows="3" name="editor_message" id="editor_message" value="">'.$journalFormat.'</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Managing Editor\'s Name and Surname</label>
                        <div class="col-md-9 col-sm-9 col-xs-12"><input type="text" class="form-control" readonly name="editor" value="' . $editor_name . '"/>
                        </div>
                    </div>
                    
                    <div class="div_captcha">
                        <div class="mail">
                            <span id="captcha" ></span>
                            <div class="answer"><p><br>Please enter the numbers in image (to prevent spam)</p></div>
                            <div class="mail-input-name-input" style="padding-top:0px;"><p><input type="text" class="contact"  id="captcha_txt" placeholder="Enter captcha code"/></p>
                            <input type="hidden" name="id" value="' . $id . '"/></p>
                            </div>	
                        </div>
    
    
                         <div class="button_div">
    
                            <div class="formBody">
                                <input type="submit" value="Send" name="contact_submitted" id="Send" class="button_dynamic"/>
                            </div>
                        </div>
                    </div>
			    </form>
			    </div>
              </div>  
              
              
              <script src="js/jquery/jquery.min.js"></script>
              <script>
              function changeArea(value) {
                if(value==1){
                    document.getElementById("editor_message").value=document.getElementById("journalFormatInput").value;
                }
                if(value==2){
                    document.getElementById("editor_message").value=document.getElementById("outOfScopInput").value;
                }
                if(value==3){
                    document.getElementById("editor_message").value=document.getElementById("similarityrateInput").value;
                }
              }
              
              var Top1,Top2;  
              function captchaCode() {
                      var Numb1, Numb2, Numb3, Numb4, Code;     
                      Numb1 = (Math.ceil(Math.random() * 10)-1).toString();
                      Numb2 = (Math.ceil(Math.random() * 10)-1).toString();
                      Numb3 = (Math.ceil(Math.random() * 10)-1).toString();
                      Numb4 = (Math.ceil(Math.random() * 10)-1).toString();
                      Top1=Numb1 + Numb2;
                      Top2=Numb3 + Numb4;
                      Code = Top1 + "+" +Top2;
                      $("#captcha span").remove();
                      $("#captcha input").remove();
                      $("#captcha a").remove();
                      $("#captcha").append("<span id=\'code\'>" + Code + "</span><a class=\'btn btn-app\' onclick=\'captchaCode();\'> <i class=\'fa fa-refresh\'></i> Refresh</a>");
                    }
                    
                    $(function() {
                      captchaCode();
                      
                      $(\'#contactForm\').submit(function(){
                        var captchaCode = $("#captcha_txt").val();   
                        var answer=parseInt(Top1)+parseInt(Top2);
                        if (answer != captchaCode) {
                          alert("Please enter the numbers in image (to prevent spam)");
                          //alert("answer ="+answer+" --Top1="+parseInt(Top1)+"--Top2="+parseInt(Top2));
                          return false;
                        }
                        if (answer == captchaCode) {                          
                          return true;
                        }
                      });       
                    });
              </script>';


}




function send_back_author_in_revised()
{

    $s_user = $_SESSION["user"];
    include("../app/connect.php");
  
    $id = $_GET["id"];
    $m_id = $_GET["m_id"];

    $pSql = mysqli_query($baglanti,"SELECT * FROM submission_list WHERE id='$id'");
    $pQuery = mysqli_fetch_object($pSql);
    $title = $pQuery->title;
    $similarityrate = $pQuery->similarityrate;
    $author = $pQuery->name_surname;
    $editor_name = mysqli_fetch_object(mysqli_query($baglanti,"Select name_surname from users where user_name='$s_user'"))->name_surname;
    $journalFormat=mysqli_fetch_object(mysqli_query($baglanti,"Select text from mailTable where id=12"))->text;
    $outOfScop=mysqli_fetch_object(mysqli_query($baglanti,"Select text from mailTable where id=11"))->text;
	 $similaritytext=mysqli_fetch_object(mysqli_query($baglanti,"Select text from mailTable where id=14"))->text;

    $outOfScop=str_replace('[title]',$title,$outOfScop);
    $similaritytext=str_replace('[MSTitle]',$title,$similaritytext);
	 $similaritytext=str_replace('[Simrate]',$similarityrate,$similaritytext);
    /*$a = rand(1, 10);
    $b = rand(1, 100);
    $answer = $a + $b;*/


    echo '<div class="x_panel">
<div style="width: 60%;  margin-left: auto; margin-right: auto">
                 <input id="journalFormatInput" value="'.$journalFormat.'" type="hidden" >   
                 <input id="outOfScopInput" value="'.$outOfScop.'" type="hidden"> 
 					<input id="similarityrateInput" value="'.$similaritytext.'" type="hidden">    
                 <form method="post" action="send_back_author_in_revised.php?rnb=2&m_id=' . $m_id . '" id="contactForm" class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Manuscript Title</label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">' . $title . '</label>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Manuscript Author</label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">' . $author . '</label>
                    </div>
                    <div class="form-group">
                    <table border="0" class="col-md-12 col-sm-12 col-xs-12">
                    <tr>
                        <td class="col-md-3 col-sm-3 col-xs-12" valign="center">
                            <label class="control-label">M&S-Editor Decision</label>
                        </td>
                        <td class="col-md-9 col-sm-9 col-xs-12">                                                       
                                <input type="radio"  name="editorDecision" id="journalFormat" onclick="changeArea(1)" value="Rejected by Editor because of journal format " checked="" required />  Rejected by Editor because of journal format<br>
                                <input type="radio"  name="editorDecision" id="outOfScop" onclick="changeArea(2)" value="Rejected by Editor because of out of scop " />Rejected by Editor because of out of scop<br>
                              <input type="radio"  name="editorDecision" id="similarityrate" onclick="changeArea(3)" value="Rejected by Editor because of similarity rate " />Rejected by Editor because of similarity rate ( '.$similarityrate.'%)<br>
                             
                        </td>
                    </tr>                                        
                    </table>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Managing Editor\'s Message</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                          <textarea class="form-control" rows="3" name="editor_message" id="editor_message" value="">'.$journalFormat.'</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Managing Editor\'s Name and Surname</label>
                        <div class="col-md-9 col-sm-9 col-xs-12"><input type="text" class="form-control" readonly name="editor" value="' . $editor_name . '"/>
                        </div>
                    </div>
                    
                    <div class="div_captcha">
                        <div class="mail">
                            <span id="captcha" ></span>
                            <div class="answer"><p><br>Please enter the numbers in image (to prevent spam)</p></div>
                            <div class="mail-input-name-input" style="padding-top:0px;"><p><input type="text" class="contact"  id="captcha_txt" placeholder="Enter captcha code"/></p>
                            <input type="hidden" name="id" value="' . $id . '"/></p>
                            </div>	
                        </div>
    
    
                         <div class="button_div">
    
                            <div class="formBody">
                                <input type="submit" value="Send" name="contact_submitted" id="Send" class="button_dynamic"/>
                            </div>
                        </div>
                    </div>
			    </form>
			    </div>
              </div>  
              
              
              <script src="js/jquery/jquery.min.js"></script>
              <script>
              function changeArea(value) {
                if(value==1){
                    document.getElementById("editor_message").value=document.getElementById("journalFormatInput").value;
                }
                if(value==2){
                    document.getElementById("editor_message").value=document.getElementById("outOfScopInput").value;
                }
                if(value==3){
                    document.getElementById("editor_message").value=document.getElementById("similarityrateInput").value;
                }
              }
              
              var Top1,Top2;  
              function captchaCode() {
                      var Numb1, Numb2, Numb3, Numb4, Code;     
                      Numb1 = (Math.ceil(Math.random() * 10)-1).toString();
                      Numb2 = (Math.ceil(Math.random() * 10)-1).toString();
                      Numb3 = (Math.ceil(Math.random() * 10)-1).toString();
                      Numb4 = (Math.ceil(Math.random() * 10)-1).toString();
                      Top1=Numb1 + Numb2;
                      Top2=Numb3 + Numb4;
                      Code = Top1 + "+" +Top2;
                      $("#captcha span").remove();
                      $("#captcha input").remove();
                      $("#captcha a").remove();
                      $("#captcha").append("<span id=\'code\'>" + Code + "</span><a class=\'btn btn-app\' onclick=\'captchaCode();\'> <i class=\'fa fa-refresh\'></i> Refresh</a>");
                    }
                    
                    $(function() {
                      captchaCode();
                      
                      $(\'#contactForm\').submit(function(){
                        var captchaCode = $("#captcha_txt").val();   
                        var answer=parseInt(Top1)+parseInt(Top2);
                        if (answer != captchaCode) {
                          alert("Please enter the numbers in image (to prevent spam)");
                          //alert("answer ="+answer+" --Top1="+parseInt(Top1)+"--Top2="+parseInt(Top2));
                          return false;
                        }
                        if (answer == captchaCode) {                          
                          return true;
                        }
                      });       
                    });
              </script>';


}



function  add_similarityrate()
{

    $s_user = $_SESSION["user"];
    include("../app/connect.php");
  
    $id = $_GET["id"];
    $m_id = $_GET["m_id"];

    $pSql = mysqli_query($baglanti,"SELECT * FROM submission_list WHERE id='$id'");
    $pQuery = mysqli_fetch_object($pSql);
    $title = $pQuery->title;
    $similarityrate = $pQuery->similarityrate;
    $author = $pQuery->name_surname;
    $editor_name = mysqli_fetch_object(mysqli_query($baglanti,"Select name_surname from users where user_name='$s_user'"))->name_surname;
    
    
    $outOfScop=str_replace('$title',$title,$outOfScop);
    /*$a = rand(1, 10);
    $b = rand(1, 100);
    $answer = $a + $b;*/


    echo '<div class="x_panel">
<div style="width: 60%;  margin-left: auto; margin-right: auto">
              
                 <form method="post" action="add_similarityrate.php?rnb=2&m_id=' . $m_id . '" id="contactForm" class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Manuscript Title</label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">' . $title . '</label>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Manuscript Author</label>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">' . $author . '</label>
                    </div>
                    
                    
                    <div class="form-group">
                    <table border="0" class="col-md-12 col-sm-12 col-xs-12">
                    <tr>
                        <td class="col-md-3 col-sm-3 col-xs-12" valign="center">
                            <label class="control-label">M&S-Similarity Rate</label>
                        </td>
                        <td class="col-md-9 col-sm-9 col-xs-12">                                                       
                                <input type="text"  name="Similarityrate" id="Similarityrate"  value="'.$similarityrate.'" required />  
                        </td>
                    </tr>                                        
                    </table>
                    </div>
                    
                    <div class="div_captcha">
                        <div class="mail">
                            <span id="captcha" ></span>
                            <div class="answer"><p><br>Please enter the numbers in image (to prevent spam)</p></div>
                            <div class="mail-input-name-input" style="padding-top:0px;"><p><input type="text" class="contact"  id="captcha_txt" placeholder="Enter captcha code"/></p>
                            <input type="hidden" name="id" value="' . $id . '"/></p>
                            </div>	
                        </div>
    
    
                         <div class="button_div">
    
                            <div class="formBody">
                                <input type="submit" value="Send" name="contact_submitted" id="Send" class="button_dynamic"/>
                            </div>
                        </div>
                    </div>
			    </form>
			    </div>
              </div>  
              
              
              <script src="js/jquery/jquery.min.js"></script>
              <script>
                
              
              var Top1,Top2;  
              function captchaCode() {
                      var Numb1, Numb2, Numb3, Numb4, Code;     
                      Numb1 = (Math.ceil(Math.random() * 10)-1).toString();
                      Numb2 = (Math.ceil(Math.random() * 10)-1).toString();
                      Numb3 = (Math.ceil(Math.random() * 10)-1).toString();
                      Numb4 = (Math.ceil(Math.random() * 10)-1).toString();
                      Top1=Numb1 + Numb2;
                      Top2=Numb3 + Numb4;
                      Code = Top1 + "+" +Top2;
                      $("#captcha span").remove();
                      $("#captcha input").remove();
                      $("#captcha a").remove();
                      $("#captcha").append("<span id=\'code\'>" + Code + "</span><a class=\'btn btn-app\' onclick=\'captchaCode();\'> <i class=\'fa fa-refresh\'></i> Refresh</a>");
                    }
                    
                    $(function() {
                      captchaCode();
                      
                      $(\'#contactForm\').submit(function(){
                        var captchaCode = $("#captcha_txt").val();   
                        var answer=parseInt(Top1)+parseInt(Top2);
                        if (answer != captchaCode) {
                          alert("Please enter the numbers in image (to prevent spam)");
                          //alert("answer ="+answer+" --Top1="+parseInt(Top1)+"--Top2="+parseInt(Top2));
                          return false;
                        }
                        if (answer == captchaCode) {                          
                          return true;
                        }
                      });       
                    });
              </script>';


}


function send_review_request_revision_page()
{
    $s_user = $_SESSION["user"];
    include("../app/connect.php");
    
    
    $id = $_GET["id"];
    $editor_name = mysqli_fetch_object(mysqli_query($baglanti,"Select name_surname from users where user_name='$s_user'"))->name_surname;
    $url_back = "index.php?page=process-process=send_review-rnb=2-m_id=9-id=" . $id;
    $r_name = $_GET['r_name'];
    $request_id = $_GET['request_id'];
    echo '<div class="x_panel">
    <div style="width: 80%;  margin-left: auto; margin-right: auto">
        <form method="post" action="send_review_request_revision.php?&request_id=' . $request_id . '&r_name=' . $r_name . '&id=' . $id . '&url_back=' . $url_back . '" id="contactForm">
            <input id="text_selected" name="text_selected" type="hidden"></textarea>
            <div class="mail">
                <div class="mail-input-name"><p>Message</p></div>
                <div class="mail-input-name-input" style="border: 1px solid; padding-left:5px; padding-right:5px;">
                    <p>
                        Dear [reviewer] ,<br>
                        Since you have requested to see the revision of the MS titled as [title] for a possible
                        publication in
                        '.$journalName.' ('.$journalShortName.'), we are sending you the revised MS by author and
                        author’s
                        correction list and file.<br>
                        Please send us your decision within 4 days,<br>

                        Please go to '.$journalShortName.' Editorial System :<a href="'.$journalDomain.'"> '.$journalShortName.'</a> and login as
                        Reviewer
                        to check the MS and send us your decision within 4 days,<br>
                        Sincerely,<br>
                        [editor]<br>
                        Editor
                    </p>
                </div>
            </div>

            <div class="mail">
                <div class="mail-input-name"><p><br>Managing Editor\'s Name and Surname</p></div>
                <div class="mail-input-name-input" style="padding-top:17px; padding-bottom:17px;"><p><input type="text"
                                                                                                            class="contact"
                                                                                                            name="editor"
                                                                                                            value="' . $editor_name . '"
                                                                                                            readonly/>
                    </p>
                </div>
            </div>

            <div class="mail">
                <span id="captcha"></span>
                <div class="answer"><p><br>Please enter the numbers in image (to prevent spam)</p></div>
                <div class="mail-input-name-input" style="padding-top:0px;"><p><input type="text" class="contact"
                                                                                      id="captcha_txt"
                                                                                      placeholder="Enter captcha code"/>
                    </p>
                    <input type="hidden" name="id" value="' . $id . '"/></p>
                </div>
            </div>


            <div class="button_div">

                <div class="formBody">
                    <input type="submit" value="Send" name="contact_submitted" id="Send" class="button_dynamic"/>
                </div>
            </div>
        </form>
    </div>
';
    echo '<script src="js/jquery/jquery.min.js"></script>
              <script>
              var Top1,Top2;  
              function captchaCode() {
                      var Numb1, Numb2, Numb3, Numb4, Code;     
                      Numb1 = (Math.ceil(Math.random() * 10)-1).toString();
                      Numb2 = (Math.ceil(Math.random() * 10)-1).toString();
                      Numb3 = (Math.ceil(Math.random() * 10)-1).toString();
                      Numb4 = (Math.ceil(Math.random() * 10)-1).toString();
                      Top1=Numb1 + Numb2;
                      Top2=Numb3 + Numb4;
                      Code = Top1 + "+" +Top2;
                      $("#captcha span").remove();
                      $("#captcha input").remove();
                      $("#captcha a").remove();
                      $("#captcha").append("<span id=\'code\'>" + Code + "</span><a class=\'btn btn-app\' onclick=\'captchaCode();\'> <i class=\'fa fa-refresh\'></i> Refresh</a>");
                    }
                    
                    $(function() {
                      captchaCode();
                      
                      $(\'#contactForm\').submit(function(){
                        var captchaCode = $("#captcha_txt").val();   
                        var answer=parseInt(Top1)+parseInt(Top2);
                        if (answer != captchaCode) {
                          alert("Please enter the numbers in image (to prevent spam)");
                          //alert("answer ="+answer+" --Top1="+parseInt(Top1)+"--Top2="+parseInt(Top2));
                          return false;
                        }
                        if (answer == captchaCode) {                          
                          return true;
                        }
                      });       
                    });
              </script>';
}

?>

