<style>
    .author_table {
        position: relative;
    }

    .author_table th {
        background-color: #2A3F54;
        color: #FFFFFF;
    }

    .author_table td.icon {
        width: 5%;
    }

    .author_table td.name {
        padding-left: 10%;
        width: 80%;
        font-size: 17px;
    }

    .author_table td.updown {
        width: 10%;
        font-size: 17px;
    }

    .table-up, .table-down {
        cursor: pointer;
    }

    .author_table i {
        font-size: 20px;
        cursor: pointer;
    }

    .btn-authors {
        background-color: #2A3F54;
        color: #FFFFFF !important;
    }

    .btn-authors:hover {
        color: #FFFFFF;
    }

    .uyari {
        color: #a94442;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        line-height: 1.42857143;
        display: none;
    }

    .anahtar {
        color: #a94442;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        line-height: 1.42857143;

    }


</style>
<style>
    /* Full-width input fields */
    .modal input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .container1 {
        padding: 16px;
    }

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 99999; /* Sit on top */
        left: 0;
        top: 0;
        /*width: 100%; /* Full width */
        /*height: 100%; /* Full height */
        /* overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 10% auto 20% 45%; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 50%; /* Could be more or less, depending on screen size */
    }

    /* The Close Button (x) */
    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }

    .author_name {
        width: 100%;
        padding: 0px 0px;
        margin: 0;
        display: inline-block;
        border: 0px solid #ccc;
        box-sizing: border-box;
    }

 
	
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

<?php
if (yetki_kontrol($role_number, "add_paper")) {

// ORCID kontrol)
 
//kullanıcı bilgileri getir
$profilInfo = BilgileriGetir();  // özellikle 1 geliyor  /home2/yakupkut/web.nesciences.com/system.php içinde fonksiyon
BilgileriGetir


    ?>
    <div class="x_panel">
        <!--
        <a class="btn btn-app" href="index.php?page=add_paper&rnb=<?php echo $role_number; ?>">
            <i class="fa fa-plus"></i> Submit New Manuscript
        </a>
        <a class="btn btn-app" href="index.php?page=not_completed&rnb=<?php echo $role_number; ?>">
            <i class="fa fa-edit"></i> Submissions Not Completed


    </a> 
<div class="loading" id="someHiddenDiv" style="display: none;" > <h1><img src="loading.gif" />  </h1> </div>
    
-->
        <span id="ncp_id" style="display: none"><?php echo $ncp_id; ?></span>
        <div class="x_content">
        

          
<?php

// orcid no yok ise form gorunmeyecek
//if   ($profilInfo['orcid_no']==0){
if(orcidKontrol()){
     $mesaj1= "ORCID number is missing, Please update your profile  .. ..".$profilInfo['orcid_no'];
     MesajGoster($mesaj1);
     // Yonlendirme("user/index.php?page=profile");
}else{


    ?>
 <form action="add_submission.php" id="add_sub_form" role="form" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                   <h1 style="text-align:center">New Submission</h1>
                <table width ="50%" align="center" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                        
                        
                           <h2 class="StepTitle">Enter Title Of Manuscript* :</h2>
                            <input type="text" class="form-control" name="title" id="title"  placeholder="Enter Title of Manuscript" 
pattern=".{3,1000}" title="Please enter valid Title"  required>
                                           
                            <span class="anahtar">*required</span> <br>
                                    <span id="uyari" class="uyari">Please fill this field!</span>
                                    <br> 
                                    <h2 class="StepTitle">Type Of
                                        Manuscript :</h2>
                                    <label class="control-label " for="type">*Optional</label><br>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select name="type" id="type" class="select2_single form-control">
                                            <option value="NULL">Type Of Manuscript</option>
                                            <option value="Research Article">Research Article</option>
                                            <option value="Review Article">Review Article</option>
                                            <option value="Technical Notes">Technical Notes</option>
                                            <option value="Short Communications">Short Communications</option>
                                            <option value="Technical Notes">Selected Paper (Conference)  </option>
                                        </select>
                                    </div>
                                    <br><br> <br>
                                    
                                    <h2 class="StepTitle">Add Abstract*:</h2>
                                    <textarea class="form-control" name="abstract" id="abstract" rows="3"   title="Please enter Abstract"  placeholder="Write abstract..." required ></textarea>
                                    <span id="uyari4" class="uyari"> Please fill in this field!</span>
                                      <span class="anahtar">*required</span>
                                    
                                       <br><br>
                                    
                                     <h2 class="StepTitle">Enter Keywords*:</h2>
                                    <textarea class="form-control" name="key_words" id="key_words" rows="3"
                                              placeholder="Write key words..." pattern=".{3, 40}" title="Please enter valid Keywords" required></textarea>
                                    <span class="anahtar">Please Keywords Separate with commas (,) !!!</span>
                                    <br> <span class="anahtar">*required</span>
                                    
                                       <br><br>

                                      <fieldset>
                                        <legend>Select Work Area*:</legend>
                                    <input type="radio" id="male" name="workarea" value="Natural Science" required>
                                    <label for="male">Natural Science</label><br>
                                    <input type="radio" id="female" name="workarea" value="Engineering Science" >
                                    <label for="female">Engineering Science</label> 
                                    <br> 
<hr><span class="anahtar">*required</span>
                                    </fieldset>


                                       <br><br>
                                    
 													<h2 class="StepTitle">Your Message:</h2>
                                    <textarea class="form-control" name="message" id="message" rows="3"
                                              placeholder="Write your message..."></textarea>
                                    <br><br>
                                    <h2 class="StepTitle">Please suggest three referees* :<br> at least one referee must be out of your country </h2>

                                    <input type="text" placeholder="Reviewer's Name Surname" name="reviewName1" pattern=".{3, 40}" title="Please enter valid name"
                                           id="reviewName1" class="form-control"  style="width: 27%!important; display: inline-block!important;" required>
                                    <input type="text" placeholder="Reviewer's E-Mail" name="reviewMail1" pattern="[A-z0-9\-_\.]+@[A-z0-9\-]+\.[A-z0-9\-\.]+"
                                           id="reviewMail1" class="form-control " style="width: 27%!important;display: inline-block!important;" required>
                                    <input type="text" placeholder="Affiliation (University/Enstitu)" name="affiliation1" pattern=".{3, 40}" title="Please enter valid name"
                                           id="affiliation1"  class="form-control "  style="width: 27%!important;display: inline-block!important;" required>
                                    <br>
                                    <input type="text" placeholder="Reviewer's Name Surname" name="reviewName2" pattern=".{3, 40}" title="Please enter valid name"
                                           id="reviewName2"  class="form-control "  style="width: 27%!important; display: inline-block!important;" required>
                                    <input type="text" placeholder="Reviewer's E-Mail" name="reviewMail2" pattern="[A-z0-9\-_\.]+@[A-z0-9\-]+\.[A-z0-9\-\.]+" title="Please enter valid mail adress"
                                           id="reviewMail2"  class="form-control "  style="width: 27%!important;display: inline-block!important;" required>
                                    <input type="text" placeholder="Affiliation (University/Enstitu)" name="affiliation2"
                                           id="affiliation2"  class="form-control "  style="width: 27%!important;display: inline-block!important;" required>
                                    <br>
                                    <input type="text" placeholder="Reviewer's Name Surname" name="reviewName3" pattern=".{3, 40}" title="Please enter valid name"
                                           id="reviewName3"  class="form-control "  style="width: 27%!important; display: inline-block!important;" required>
                                    <input type="text" placeholder="Reviewer's E-Mail" name="reviewMail3" pattern="[A-z0-9\-_\.]+@[A-z0-9\-]+\.[A-z0-9\-\.]+"
                                           id="reviewMail3"  class="form-control "  style="width: 27%!important;display: inline-block!important;" required>
                                    <input type="text" placeholder="Affiliation (University/Enstitu)" name="affiliation3" pattern=".{3, 40}" title="Please enter valid name"
                                           id="affiliation3" class="form-control "   style="width: 27%!important;display: inline-block!important;" required>
                                           
                                           <br> <span class="anahtar">*required</span> <br>  <br> 


                                <h2 class="StepTitle"> Being Reviewer: </h2>
                                  <h4>   <input type = "checkbox" class="icon" name="bereviewer" id="bereviewer"  required> I am  accepting to be a Reviewer in NESciences</h4> 

														 <div class="help-block with-errors"> </div>   
														 
														  <br> <br>
														 
														 <fieldset>  
														 
														 <legend></legend> 
														  <h2 class="StepTitle">Please Add, Edit or Remove Authors</h2>


                                    <input type="text" name="all_authors" id="all_authors" style="display:none ">
                                    <input type="text" name="all_authors_email" id="all_authors_email" style="display:none ">
                                    <input type="text" name="all_authors_affilation" id="all_authors_affilation" style="display:none ">
                                    <input type="text" name="all_authors_orcid" id="all_authors_orcid" style="display:none ">

                                    <div id="author_table" class="author_table">
                                        <table class="table" id="my_author_table">
                                            <tr>
                                                <th colspan="4">Current Author List</th>
                                            </tr>

                                            <tr class="hide" id="tr_hide">
                                                <td contenteditable="true" class="icon"><i class="fa fa-pencil-square-o"
                                                                                           aria-hidden="true"
                                                                                           onclick="editAuthor(this)">
                                                </td>
                                                <td contenteditable="true" class="icon"><i class="fa fa-trash-o"
                                                                                           aria-hidden="true"
                                                                                           onclick="deleteRow(this)"></i>
                                                </td>
                                                <td class="name" id="td_name_author" onclick="showLine(this)">
                                                    <input type="text" id="name_author" name="name_author[]"
                                                           class="author_name" readonly>
                                                    <input type="text" id="author_email_tmp" name="author_email_tmp[]"
                                                           class="author_name" readonly>
                                                </td>

                                                <td class="updown">
                                                <!-- yazarları aşagı yukarı kaydırma işlemi degiştirildii js uyumlu
                                                    <span class="table-up glyphicon glyphicon-arrow-up"></span>
                                                    <span class="table-down glyphicon glyphicon-arrow-down"></span>
-->                                                
                                                </td>

                                            </tr>

                                            <tr>
                                                <?php
                                                include("../app/connect.php");
                                                $user_name = $_SESSION["user"];
                                                $sql = "SELECT * FROM users WHERE user_name='$user_name'";
                                                $name_surname = mysqli_fetch_object(mysqli_query($baglanti,$sql))->name_surname;
                                                ?>
                                                <td id="td_name_author" class="name" colspan="3"
                                                    style="padding-left: 20%"><input type="text" id="correspond_author"
                                                                                     name="name_author"
                                                                                     class="author_name"
                                                                                     value="<?php echo $name_surname; ?>"
                                                                                     readonly>
                                                <td class="updown">
                                                   <!-- 
                                                    <span class="table-up glyphicon glyphicon-arrow-up"></span>
                                                    <span class="table-down glyphicon glyphicon-arrow-down"></span>
                                                    -->
                                                </td>

                                            </tr>


                                        </table>


                                    </div>
                                    <span id="uyari2" class="uyari"> Please fill in this field!</span>
                                    <a href="#" onclick="document.getElementById('id01').style.display='block'"
                                       class="btn btn-authors"><i class="fa fa-plus"></i>Add Another Authors
                                    </a>

                                    <div class="form-group" style="padding-top: 5px;">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Choose Corresponding
                                            Author</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                            <select name="cur_author" id="cur_author"
                                                    class="select2_single form-control select2-hidden-accessible"
                                                    tabindex="-1" aria-hidden="true">
                                                <option value="<?php echo $name_surname; ?>"><?php echo $name_surname; ?></option>
                                            </select>
                                        </div>
                                    </div>                                 
                                    
                                    
                                    </fieldset>
                                    <hr>
                                       <br><br>
                                    
                                    <div id="ragionfile">
                                    <h2 class="StepTitle">Upload Manuscript File* : <output id="list"></output></h2>
                                   
                                      
                                        <div id="cross1" style = "display:none">
                                        <i class="fa fa-times  " style="font-size:48px;color:red"></i>  The file size size is greater than 5MB 
                                        
                                        </div>
                                        
                                        <div id="ok1" style = "display:none">
                                        <i class="fa fa-check" style="font-size:48px;color:green">   </i>  The file size is acceptable
                                        </div>
                                   
                                  <!--  <input type="file" name="my_file"   id="myFile"  accept=".odt, .doc, .docx, .pdf " class="rsform-upload-box" required onchange="myFunction()">
                                    --> 
                                   
                                     <input type="file" name="my_file"   id="myFile"  accept=".odt, .doc, .docx, .pdf " class="rsform-upload-box" required onchange="myFunction()">
                                    
                                     <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
                                        <span class="anahtar">*required</span> 
 									 	<span class="anahtar">(Upto 5 MB  word file can be uploaded)</span><br>
 								 </div>
<hr><br>
 
    
    
    
                                            
                                        <p id="textyaz"></p>
                                    
    
 
 												
<hr><br>
                        </div>

                                      <fieldset>
                                        <legend>“Compliance with Ethical Standards” Please declare whether the results of the study involve human and/or animal rights.
 *:</legend>
                                    <input type="radio" onclick="javascript:yesnoCheck();"  id="yes" name="my_Approval" value="YES" required>
                                    <label for="male">YES</label> &nbsp;  &nbsp;  &nbsp;  
                                    <input type="radio" onclick="javascript:yesnoCheck();" id="no" name="my_Approval" value="NO" >
                                    <label for="female">NO</label> <br>
<span class="anahtar">*required</span>
    
                                     
<hr>                                </fieldset>

 
  <div id="ragionfile1" style = "visibility: hidden" >
                                    <h2 class="StepTitle">If "YES", Please fill Statement for the Ethics Committee Approval Form and attach it below**: <output id="list"></output></h2>
                                        <div id="cross2" style = "display:none">
                                        <i class="fa fa-times  " style="font-size:48px;color:red"></i>  The file size size is greater than 5MB 
                                        
                                        </div>
                                        
                                        <div id="ok2" style = "display:none">
                                        <i class="fa fa-check" style="font-size:48px;color:green">   </i>  The file size is acceptable
                                        </div>
                                        
                                    <input type="file" name="my_file_Approval" id="my_file_Approval"  accept=" .pdf" class="rsform-upload-box"  onchange="myFunction2()" >
                                     <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
                                        <span class="anahtar"> **</span> 
 								 <span class="anahtar">(Upto 5 MB  only pdf file can be uploaded)</span><br>
 													
<hr><br>

                                   
                                          
                                           <p id="textyaz2"></p>
                                    
    
 
 												
<hr><br>
                                   




 </div>











<!--  dosya kontrol      add_sub_form   -->




<script>
function myFunction(){
  var x = document.getElementById("myFile");
  var txt = "";
  if ('files' in x) {
    if (x.files.length == 0) {
      txt = "Select one or more files.";
    } else {
      for (var i = 0; i < x.files.length; i++) {
        txt += "<br><strong>" +  "The file information</strong><br>";
        var file = x.files[i];
        if ('name' in file) {
          txt += "File name : " + file.name + "<br>";
        }
        if ('size' in file) {
       
           txt += "File size: " +  Math.round(file.size/1000)/1000 + " MB <br>"; 
          
            if (file.size > 5000000){
            document.getElementById("cross1").style.display = "block" 
            document.getElementById("ok1").style.display = "none"
            document.getElementById("mybutton").disabled = true;


       

          }else{
            
             document.getElementById("ok1").style.display = "block"
               document.getElementById("cross1").style.display = "none" 
            document.getElementById("mybutton").disabled = false;

          }
          
        }
      }
    }
  } 
  else {
    if (x.value == "") {
      txt += "Select one or more files.";
    } else {
      txt += "The files property is not supported by your browser!";
      txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead. 
    }
  }
  document.getElementById("textyaz").innerHTML = txt;
}
</script>


 




<script>
function myFunction2(){
  var x = document.getElementById("my_file_Approval");
  var txt = "";
  if ('files' in x) {
    if (x.files.length == 0) {
      txt = "Select one or more files.";
    } else {
      for (var i = 0; i < x.files.length; i++) {
        txt += "<br><strong>" +  "The file information</strong><br>";
        var file = x.files[i];
        if ('name' in file) {
          txt += "File name : " + file.name + "<br>";
        }
        if ('size' in file) {
       
           txt += "File size: " +  Math.round(file.size/1000)/1000 + " MB <br>"; 
          
            if (file.size > 5000000){
            document.getElementById("cross2").style.display = "block" 
            document.getElementById("ok2").style.display = "none"
           


       

          }else{
            
             document.getElementById("ok2").style.display = "block"
               document.getElementById("cross2").style.display = "none" 

          }
          
        }
      }
    }
  } 
  else {
    if (x.value == "") {
      txt += "Select one or more files.";
    } else {
      txt += "The files property is not supported by your browser!";
      txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead. 
    }
  }
  document.getElementById("textyaz2").innerHTML = txt;
}
</script>




<script> 
function yesnoCheck() {
if (document.getElementById('yes').checked) {
        document.getElementById('ragionfile1').style.visibility = 'visible';
    } else {
        document.getElementById('ragionfile1').style.visibility = 'hidden';
    }

}

function Visibility() {
  document.getElementById("ragionfile").style.visibility = "none";
}

function Visibility2() {
  document.getElementById("ragionfile").style.visibility = "visible";
}
</script>





 
 

<script>
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push( 'file size:   ',
                  f.size, ' bytes   ');
           var boyut=f.size;       
    } 
    if(boyut>5000000){
    	boyut=Math.round(boyut/1000000);
    	 alert('File size '+boyut + ' MB. The size is over requirement (max 5MB) ' );
   
 		} 
  }

  document.getElementById('my_file').addEventListener('change', 'Uploding File Name : '+handleFileSelect, false);
  
  
  
  
</script>



 <!--
                                    <h2 class="StepTitle">Copyright Form*:
                                  
                                    
                                    <input type="file" name="copy_file" id="copy_file"
                                           class="rsform-upload-box"/></h2>
													<input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
                                     <span class="anahtar">*required</span> 
                                     <span class="anahtar">(Upto 5 MB  word file can be uploaded)</span><br><br>

                                    
    -->                     
                        
                          
                            <!-- End SmartWizard Content -->

                        </td>
                    </tr>
                    <tr><td>
                        
                          <!--  <input id="mybutton" type="submit" style="color:white;font-size : 20px;background:#006A68;width: 250px; height: 50px;" name="submit" value="Submit" onclick="myFunction3()" disabled >
                       -->
                         <input id="mybutton" type="submit" style="color:white;font-size : 20px;background:#006A68;width: 250px; height: 50px;" name="submit" value="Submit" onclick="myFunction13()" disabled >
                     </td></tr>
                </table>
            </form>

            <!-- End SmartWizard Content -->
            
           

         <div id="loading" style = "display:none">
                <hr>
                <center style="font-size:48px;color:blue">
                <i class="fa fa-refresh fa-spin fa-5x fa-fw"></i>
                <span class="sr-only">Loading...</span>
                </center>
                <hr>            
        </div>        
            
            
   
   
   
   
<script>
function myFunction3(){
  
             document.body.scrollTop = 0; // For Safari
             document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            document.getElementById("loading").style.display = "block" 
            document.getElementById("add_sub_form").style.display = "none"
            
           

}
</script>



   
            
<?php

 } // orcid end if 
?>

        </div>

        <div id="id01" class="modal">

            <div class="modal-content animate">
                <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close"
                      title="Close Modal">&times;</span>
                </div>

                <div class="container1">
                    <label><b>First Name</b></label>
                    <input type="text" placeholder="Enter First Name" id="first_name" required>

                    <label><b>Last Name</b></label>
                    <input type="text" placeholder="Enter Last Name" id="last_name" required>

                    <label><b>Email Address</b></label>
                    <input type="text" placeholder="Enter Email Address" id="authors_email" required>

                    <label><b>ORCID Number</b></label>
                    <input type="text" placeholder="Enter ORCID Number" id="authors_orcid" required>


                    <label><b>Institution</b></label>
                    <input type="text" placeholder="Enter Institution" id="authors_institution" required>


                    <button id="add-authors-btn" class="btn btn-authors">Kaydet</button>
                </div>

            </div>
        </div>

        <div id="id02" class="modal">

            <div class="modal-content animate">
                <div class="imgcontainer">
                <span onclick="document.getElementById('id02').style.display='none'" class="close"
                      title="Close Modal">&times;</span>
                </div>

                <div class="container1">
                    <input type="hidden" id="index">
                    <input type="hidden" id="index_cur">
                    <label><b>First Name</b></label>
                    <input type="text" placeholder="Enter First Name" id="first_name_2" required>

                    <label><b>Last Name</b></label>
                    <input type="text" placeholder="Enter Last Name" id="last_name_2" required>

                    <label><b>Email Address</b></label>
                    <input type="text" placeholder="Enter Email Address" id="authors_email_2" required>

                    <label><b>ORCID Number</b></label>
                    <input type="text" placeholder="Enter ORCID Number" id="authors_orcid_2" required>

                    <label><b>Institution</b></label>
                    <input type="text" placeholder="Enter Institution" id="authors_institution_2" required>


                    <button id="edit-authors-btn" class="btn btn-authors">Kaydet</button>
                </div>

            </div>
        </div>

    </div>
    <!-- jQuery -->
    <script src="js/jquery/jquery.min.js"></script>






<!-- jQuery BlockUI Plugin for wait affact animation


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
 

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>

<script src="js/blockUI/jquery.blockUI.js"></script>
<script src="js/blockUI/chili-1.7.pack.js"></script>-->

 
<script>
  function buttonclick(evt) {
    // $('#someHiddenDiv').show();
  }

  document.getElementById('mybutton').addEventListener('click', buttonclick, false);
  
  
  
  
</script>


<script>




$(function() {
    $('#checkfile5').submit(function() {
        // show a hidden div to indicate progression
        $('#someHiddenDiv').show();

        // kick off AJAX
        $.ajax({
            url: this.action,
            type: this.method,
            data: $(this).serialize(),
            success: function() {
                // AJAX request finished, handle the results and hide progress
                //$('#someHiddenDiv').hide();
            }
        });
        return false;
    });
    
    
    
});

 

</script>
 




    <script>
        var $TABLE = $('#author_table');
        var $BTN = $('#add-authors-btn');


        $('.table-remove').click(function () {
            $(this).parents('tr').detach();
        });

        function deleteRow(r) {
            var i = r.parentNode.parentNode.rowIndex;
            var tmp = document.getElementById("my_author_table").rows[i].cells[2].children[0].value;
            var res;
            var str = document.getElementById("all_authors").value;
            var res_tmp = str.split(",");
            if (res_tmp.length > 1) {
                var n = str.search(tmp);
                if (n == 0) res = str.replace(tmp + ",", '');
                else res = str.replace("," + tmp, '');
            }
            else res = str.replace(tmp, '');
            document.getElementById("all_authors").value = res;
            document.getElementById("my_author_table").deleteRow(i);
        }

        // Yazar Ekleme
        $BTN.click(function () {
            var author_first_name = document.getElementById("first_name").value;
            var author_last_name = document.getElementById("last_name").value;
            var author_name = author_first_name + " " + author_last_name;
            var all_authors_email = document.getElementById("all_authors_email").value;
             var authors_orcid = document.getElementById("authors_orcid").value;
            var cur_author = document.getElementById("cur_author");
            var option = document.createElement("option");
            option.text = author_name;
            option.value = author_name;
            cur_author.add(option);


            if (all_authors_email == "") all_authors_email = document.getElementById("authors_email").value;
            else all_authors_email += "," + document.getElementById("authors_email").value;

            if (all_authors_orcid == "") all_authors_orcid = document.getElementById("authors_orcid").value;
            else all_authors_orcid += "," + document.getElementById("authors_orcid").value;

            document.getElementById("all_authors_email").value = all_authors_email;

            document.getElementById("name_author").value = author_name;
            document.getElementById("author_email_tmp").value = document.getElementById("authors_email").value;
            var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
            $TABLE.find('table').append($clone);

            document.getElementById('id01').style.display = 'none';

            document.getElementById("first_name").value = "";
            document.getElementById("last_name").value = "";
            document.getElementById("authors_email").value = "";


        });
        // End:Yazar Ekleme
    </script>
    <script>
        var last_author_name = "";
        function editAuthor(r) {
            var s = r.parentNode.parentNode.rowIndex;
            var author_name = (document.getElementById("my_author_table").rows[s].cells[2].children[0].value).split(" ");
            last_author_name = document.getElementById("my_author_table").rows[s].cells[2].children[0].value;
            document.getElementById("first_name_2").value = author_name[0];
            document.getElementById("last_name_2").value = author_name[1];
            //email düzeltmesi yapılacak
            //document.getElementById("authors_email_2").value =document.getElementById("my_author_table").rows[s].cells[3].value;

            document.getElementById('id02').style.display = 'block';

            var index = r.parentNode.parentNode.rowIndex;
            document.getElementById("index").value = index;
            //select için cur_author
            var cur_author = author_name[0] + " " + author_name[1];
            var x = document.getElementById("cur_author");
            var txt = "";
            var i;
            for (i = 0; i < x.length; i++) {
                if (cur_author == x.options[i].text) document.getElementById("index_cur").value = i;
            }

        }
        $('#edit-authors-btn').click(function () {
            var silinen = document.getElementById("index").value;
            var silinen_cur = document.getElementById("index_cur").value;

            document.getElementById("my_author_table").deleteRow(silinen);
            var cur_author = document.getElementById("cur_author");
            cur_author.remove(silinen_cur);

            var author_first_name = document.getElementById("first_name_2").value;
            var author_last_name = document.getElementById("last_name_2").value;
            var author_name = author_first_name + " " + author_last_name;

            document.getElementById("name_author").value = author_name;
            var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
            $TABLE.find('table').append($clone);
            document.getElementById('id02').style.display = 'none';
            var str = document.getElementById("all_authors").value;
            var res = str.replace(last_author_name, author_name);
            document.getElementById("all_authors").value = res;

            var option = document.createElement("option");
            option.text = author_name;
            option.value = author_name;
            cur_author.add(option);

        });


        $('.table-up').click(function () {
            var $row = $(this).parents('tr');
            if ($row.index() === 2) return; // Don't go above the header
            $row.prev().before($row.get(0));
        });

        $('.table-down').click(function () {
            var $row = $(this).parents('tr');
            $row.next().after($row.get(0));
        });

 

    </script>
    <?php
} else header("Refresh:0;  URL = 404.php ");
?>
