<?php
$paperID=$_GET["id"];
$pQuery="Select * from submission_list where id=$paperID";
$paperProp=mysqli_fetch_object(mysqli_query($baglanti,$pQuery));
$paperCode=$paperProp->paperID;
$paperTitle=$paperProp->title;
$authors=$paperProp->authors;
$keywords=$paperProp->keyword;
$abstract=$paperProp->abstract;

$coverImage=$paperProp->coverImage; 

?>

<form class="form-horizontal form-label-left" enctype="multipart/form-data" method="post" action="add_revision.php">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Manuscript Code <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="paperCode" required="required" class="form-control col-md-7 col-xs-12" value="<?php  echo $paperCode;?>" readonly>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Manuscript Title <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="paperTitle" required="required" class="form-control col-md-7 col-xs-12" value="<?php  echo $paperTitle;?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Authors <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="authors" required="required" class="form-control col-md-7 col-xs-12" value="<?php  echo $authors;?>" >
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keywords <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" name="keywords"  required="required" class="form-control col-md-7 col-xs-12" value="<?php  echo $keywords;?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Abstract <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea name="abstract"  class="form-control" rows="3"><?php  echo $abstract;?></textarea>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Response to Reviewer's Comments  <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea class="form-control" name="message"  rows="6" >Please respond to each Reviewer's corrections:&#10;&#10;Reviewer 1:&#10;&#10;Reviewer 2:&#10;&#10;Reviewer 3:&#10;&#10;</textarea>
        </div>
    </div>


<br>
<br>


                               




    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Upload Response to Reviewer Comments File (rtf, doc, docx) <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            
              <div id="cross1" style = "display:none">
                                        <i class="fa fa-times  " style="font-size:48px;color:red"> ... </i>  The file size is greater than 5MB or Invalid name ..... Please check your file information!"
                                        
                                        </div>
                                        
             <div id="ok1" style = "display:none">
                                        <i class="fa fa-check" style="font-size:48px;color:green">   </i>  The file size is acceptable
               </div>
                                   
            
            
            <input type="hidden" name="MAX_FILE_SIZE" value="50000000"/>
            <input type="file" name="my_file_reviewer" id="my_file_reviewer"  accept=".odt, .doc, .docx " onchange="myFunction()" required
                   class="rsform-upload-box"/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Upload Revised MS File (zip, rtf, doc, rar, docx) <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            
              <div id="cross2" style = "display:none">
                                        <i class="fa fa-times  " style="font-size:48px;color:red"> ... </i>  The file size is greater than 5MB or Invalid name ..... Please check your file information!"
                                        
                                        </div>
                                        
             <div id="ok2" style = "display:none">
                                        <i class="fa fa-check" style="font-size:48px;color:green">   </i>  The file size is acceptable
               </div>
                               
            
            <input type="hidden" name="MAX_FILE_SIZE" value="50000000"/>
            <input type="file" name="my_file" id="my_file_Revised"  accept=".odt, .doc, .docx " onchange="myFunction2()"  required
                   class="rsform-upload-box"/>
        </div>
    </div>

<br>
 <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Upload COPYRIGHT FORM (zip, rtf, doc, rar, docx, pdf)<span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
             <div id="cross3" style = "display:none">
                                        <i class="fa fa-times  " style="font-size:48px;color:red"> ... </i>  The file size is greater than 5MB or Invalid name ..... Please check your file information!"
                                        
                                        </div>
                                        
             <div id="ok3" style = "display:none">
                                        <i class="fa fa-check" style="font-size:48px;color:green">   </i>  The file size is acceptable
               </div>
                          
            
           
            <input type="file" name="my_file_COPYRIGHT" id="my_file_COPYRIGHT" accept=".odt, .doc, .docx, .pdf, .png, .jpg" onchange="myFunction3()" required
                   class="rsform-upload-box"/>
        </div>
    </div>


  <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Present Graphical Abstract<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
               <img width='300px' src='<?php echo $coverImage; ?>' alt ="<?php echo $coverImage; ?>" >
            </div>
        </div>




 <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">New Graphical Abstract<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
         
         
         
         
         
         
         <fieldset>
                             <legend>Do you want to change  Graphical Abstract image ?  *:</legend>
                         <table>           
                         <tr><td  width ="25%">
                        
                                 
                                    
                                    
                                    <input type="radio" onclick="javascript:yesnoCheck();"  id="yes" name="my_Approval" value="YES" required>
                                    <label for="male">YES</label> <br>
                                    <input type="radio" onclick="javascript:yesnoCheck();" id="no" name="my_Approval" value="NO" checked >
                                    <label for="female">NO</label> <br>
<span class="anahtar">*required</span><br><br><br>
                                    
                                    <br><br><br>


     
                          
                          </td>
                          <td  width ="75%">
                        
                        
                        <div id="ragionfile1" style = "visibility: hidden" >
                                    <h2 class="StepTitle">If "YES", Select new Graphical Abstract image **: <output id="list"></output></h2>
                                        <div id="cross4" style = "display:none">
                                        <i class="fa fa-times  " style="font-size:48px;color:red">... </i>   The file size is greater than 5MB or Invalid name ..... Please check your file information!"
                                        
                                        
                                        </div>
                                        
                                        <div id="ok4" style = "display:none">
                                        <i class="fa fa-check" style="font-size:48px;color:green">   </i>  The file size is acceptable
                                        </div>
                                        
                                    <input type="file" name="my_file_graph" id="my_file_graph"  accept=".jpg, .ppt, .pptx, .pdf , .png" class="rsform-upload-box"  onchange="myFunction4()" >
                                     
                                        <span class="anahtar"> **</span> 
 								 <span class="anahtar">(Upto 5 MB  only pdf file can be uploaded)</span><br><br><br>
   

 </div>
                        
                                        

                          </td></tr>
                
                
                </table>
                                   
                                            </fieldset>
         
         
            </div>
        </div>


  



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
function myFunction(){
  var x = document.getElementById("my_file_reviewer");
  var txt = "";
   var isimhata=0;
  if ('files' in x) {
    if (x.files.length == 0) {
      txt = "Select one or more files.";
    } else {
      for (var i = 0; i < x.files.length; i++) {
        txt += "<br><strong>" +  "The file information</strong><br>";
        var file = x.files[i];
        
        
        
         // dosya isim kontrol Sadece izin verilen karakterleri kontrol etmek için regex
        var filename = file.name;
        var validFilenamePattern = /^[a-zA-Z0-9_\.\-]+$/;

        // Dosya adı kontrolü
        if (!validFilenamePattern.test(filename)) {
            alert('invalid file name. Please rename and try again. ...... Dont use special character !!!.');
             txt += "File name : " + file.name + "<br>    invalid file name.    Please rename and try again<br>";
             isimhata=1;
        }
        
        
        
        
        
        if ('name' in file) {
          txt += "File name : " + file.name + "<br>";
        }
        if ('size' in file) {
       
           txt += "File size: " +  Math.round(file.size/1000)/1000 + " MB <br>"; 
          
            if (file.size > 5000000 || isimhata==1){
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
      txt += "The files property is not supported by your browser!<br>";
      txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead. 
    }
  }
  document.getElementById("textyaz").innerHTML = txt;
}
</script>





<script>
function myFunction2(){
  var x = document.getElementById("my_file_Revised");
  var txt = "";
   var isimhata=0;
  if ('files' in x) {
    if (x.files.length == 0) {
      txt = "Select one or more files.";
    } else {
      for (var i = 0; i < x.files.length; i++) {
        txt += "<br><strong>" +  "The file information</strong><br>";
        var file = x.files[i];
        
        
        
         // dosya isim kontrol Sadece izin verilen karakterleri kontrol etmek için regex
        var filename = file.name;
        var validFilenamePattern = /^[a-zA-Z0-9_\.\-]+$/;

        // Dosya adı kontrolü
        if (!validFilenamePattern.test(filename)) {
            alert('invalid file name. Please rename and try again. ...... Dont use special character !!!.');
             txt += "File name : " + file.name + "<br>    invalid file name.    Please rename and try again<br>";
             isimhata=1;
        }
        
        
        
        
        
        if ('name' in file) {
          txt += "File name : " + file.name + "<br>";
        }
        if ('size' in file) {
       
           txt += "File size: " +  Math.round(file.size/1000)/1000 + " MB <br>"; 
          
            if (file.size > 5000000 || isimhata==1){
            document.getElementById("cross2").style.display = "block" 
            document.getElementById("ok2").style.display = "none"
            document.getElementById("mybutton").disabled = true;


       

          }else{
            
             document.getElementById("ok2").style.display = "block"
               document.getElementById("cross2").style.display = "none" 
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
      txt += "The files property is not supported by your browser!<br>";
      txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead. 
    }
  }
  document.getElementById("textyaz").innerHTML = txt;
}
</script>




<script>
function myFunction3(){
  var x = document.getElementById("my_file_COPYRIGHT");
  var txt = "";
   var isimhata=0;
  if ('files' in x) {
    if (x.files.length == 0) {
      txt = "Select one or more files.";
    } else {
      for (var i = 0; i < x.files.length; i++) {
        txt += "<br><strong>" +  "The file information</strong><br>";
        var file = x.files[i];
        
        
        
         // dosya isim kontrol Sadece izin verilen karakterleri kontrol etmek için regex
        var filename = file.name;
        var validFilenamePattern = /^[a-zA-Z0-9_\.\-]+$/;

        // Dosya adı kontrolü
        if (!validFilenamePattern.test(filename)) {
            alert('invalid file name. Please rename and try again. ...... Dont use special character !!!.');
             txt += "File name : " + file.name + "<br>    invalid file name.    Please rename and try again<br>";
             isimhata=1;
        }
        
        
        
        
        
        if ('name' in file) {
          txt += "File name : " + file.name + "<br>";
        }
        if ('size' in file) {
       
           txt += "File size: " +  Math.round(file.size/1000)/1000 + " MB <br>"; 
          
            if (file.size > 5000000 || isimhata==1){
            document.getElementById("cross3").style.display = "block" 
            document.getElementById("ok3").style.display = "none"
            document.getElementById("mybutton").disabled = true;


       

          }else{
            
             document.getElementById("ok3").style.display = "block"
               document.getElementById("cross3").style.display = "none" 
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
      txt += "The files property is not supported by your browser!<br>";
      txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead. 
    }
  }
  document.getElementById("textyaz").innerHTML = txt;
}
</script>




<script>
function myFunction4(){
  var x = document.getElementById("my_file_graph");
  var txt = "";
   var isimhata=0;
  if ('files' in x) {
    if (x.files.length == 0) {
      txt = "Select one or more files.";
    } else {
      for (var i = 0; i < x.files.length; i++) {
        txt += "<br><strong>" +  "The file information</strong><br>";
        var file = x.files[i];
        
        
        
         // dosya isim kontrol Sadece izin verilen karakterleri kontrol etmek için regex
        var filename = file.name;
        var validFilenamePattern = /^[a-zA-Z0-9_\.\-]+$/;

        // Dosya adı kontrolü
        if (!validFilenamePattern.test(filename)) {
            alert('invalid file name. Please rename and try again. ...... Dont use special character !!!.');
             txt += "File name : " + file.name + "<br>    invalid file name.    Please rename and try again<br>";
             isimhata=1;
        }
        
        
        
        
        
        if ('name' in file) {
          txt += "File name : " + file.name + "<br>";
        }
        if ('size' in file) {
       
           txt += "File size: " +  Math.round(file.size/1000)/1000 + " MB <br>"; 
          
            if (file.size > 5000000 || isimhata==1){
            document.getElementById("cross4").style.display = "block" 
            document.getElementById("ok4").style.display = "none"
            document.getElementById("mybutton").disabled = true;


       

          }else{
            
             document.getElementById("ok4").style.display = "block"
               document.getElementById("cross4").style.display = "none" 
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
      txt += "The files property is not supported by your browser!<br>";
      txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead. 
    }
  }
  document.getElementById("textyaz").innerHTML = txt;
}
</script>




    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" style="color: red">
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <label style="color: red">*: Must be filled  </label>
        </div>
    </div>
    
    
    
    
    
    

    <div class="form-group">

        <div style="text-align: center">
            <br>
            <button type="submit" id="mybutton" class="btn btn-primary">Upload Revision</button>
        </div>
    </div>
</form>
