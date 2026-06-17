
<?php
header("Access-Control-Allow-Origin: *");
$ncp_id = $_GET["ncp_id"];
?>
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
        width: 70%;
        font-size: 17px;
    }

    .author_table td.current {
        width: 20%;
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

</style>
<div class="x_panel">
<div style="text-align:center">  
    <a class="btn btn-app" href="index.php?page=add_paper&rnb=<?php echo $role_number; ?>">
        <i class="fa fa-plus"></i> Submit New Manuscript
    </a>
    <a class="btn btn-app" href="index.php?page=not_completed&rnb=<?php echo $role_number; ?>">
        <i class="fa fa-edit"></i> Submissions Not Completed
    </a>
    </div>
    
    <hr>
    <span id="ncp_id" style="display: none"><?php echo $ncp_id; ?></span>
    <div class="x_content">
        <form action="add_submission.php?ncp_id=<?php echo $ncp_id; ?>" id="add_sub_form" role="form"
              data-toggle="validator" method="post"
              accept-charset="utf-8" enctype="multipart/form-data">
                <h1 style="text-align:center">Submissions Not Completed</h1>
             <table width ="50%" align="center" border="0" cellpadding="0" cellspacing="0">
                     <tr>
                    <td>
                       
                       
                       
                       <h2 class="StepTitle">Enter Title Of Manuscript* :</h2>
                                <input type="text" class="form-control" name="title" id="title"  placeholder="Enter Title of Manuscript" required>

                                 <span class="anahtar">*required</span> <br>
                                <span id="uyari" class="uyari">Please fill this field!</span>
                                <br>
                                <h2 class="StepTitle">Type Of
                                    Manuscript :</h2>
                                <label class="control-label " for="type">*Optional</label><br>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <select style="width:50%" name="type" id="type" class="select2_single form-control">
                                        <option value="NULL">Type Of Manuscript</option>
                                        <option value="Research Article">Research Article</option>
                                        <option value="Review Article">Review Article</option>
                                        <option value="Technical Notes">Technical Notes</option>
                                        <option value="Short Communications">Short Communications</option>
                                    </select>
                                </div>
                       <br><br>
                       
                       
                       
                        <h2 class="StepTitle">Enter Keywords*:</h2>
                                <textarea class="form-control" name="key_words" id="key_words" rows="3" placeholder="Write key words..." required></textarea>
                                <span class="anahtar">Please Keywords Separate with commas (,) !!!</span>
                                  <span class="anahtar">*required</span>

                         
                                <h2 class="StepTitle">Add Abstract*:</h2>
                                <textarea class="form-control" name="abstract" id="abstract" rows="3"  placeholder="Write abstract..." required></textarea>
                                <span id="uyari4" class="uyari"> Please fill in this field!</span>
                                 <span class="anahtar">*required</span>

                            
                                <h2 class="StepTitle">Your Message:</h2>
                                <textarea class="form-control" name="message" id="message" rows="3"  placeholder="Write your message..."></textarea>
                                <br><br>
                                <h2 class="StepTitle">Please suggest three referees *:</h2>

                                <input type="text" placeholder="Reviewer's Name Surname" name="reviewName1"
                                       id="reviewName1" class="form-control " style="width: 35%!important; display: inline-block!important;" required>
                                <input type="text" placeholder="Reviewer's E-Mail" name="reviewMail1"
                                       id="reviewMail1"  class="form-control " style="width: 35%!important;display: inline-block!important;" required>
                                <input type="text" placeholder="Affiliation (University/Enstitu)" name="affiliation1"
                                       id="affiliation1"  class="form-control "  style="width: 29%!important;display: inline-block!important;" required>
                                <br>
                                <input type="text" placeholder="Reviewer's Name Surname" name="reviewName2"
                                       id="reviewName2" class="form-control " style="width: 35%!important; display: inline-block!important;" required>
                                <input type="text" placeholder="Reviewer's E-Mail" name="reviewMail2"
                                       id="reviewMail2"  class="form-control "  style="width: 35%!important;display: inline-block!important;" required>
                                <input type="text" placeholder="Affiliation (University/Enstitu)" name="affiliation2"
                                       id="affiliation2"  class="form-control "  style="width: 29%!important;display: inline-block!important;" required>
                                <br>
                                <input type="text" placeholder="Reviewer's Name Surname" name="reviewName3"
                                       id="reviewName3"  class="form-control "  style="width: 35%!important; display: inline-block!important;" required>
                                <input type="text" placeholder="Reviewer's E-Mail" name="reviewMail3"
                                       id="reviewMail3"  class="form-control "  style="width: 35%!important;display: inline-block!important;" required>
                                <input type="text" placeholder="Affiliation (University/Enstitu)" name="affiliation3"
                                       id="affiliation3"  class="form-control "  style="width: 29%!important;display: inline-block!important;" required>

                                 <span class="anahtar">*required</span>

                                <div class="help-block with-errors"></div>
                                
                                
                                <hr>
                                
                                 <div>
                                <h2 class="StepTitle">Please Add, Edit or Remove Authors*:</h2>
                                <input type="text" name="all_authors" id="all_authors" style="display: none">
                                <div id="author_table" class="author_table">
                                    <table class="table" id="my_author_table">
                                        <tr>
                                            <th colspan="3">Current Author List</th>
                                        </tr>
                                        <tr>

                                        </tr>
                                        <!-- This is our clonable table line -->
                                        <tr class="hide">
                                            <td contenteditable="true" class="icon"><i class="fa fa-pencil-square-o"
                                                                                       aria-hidden="true"
                                                                                       onclick="editAuthor(this)">
                                            </td>
                                            <td contenteditable="true" class="icon"><i class="fa fa-trash-o"
                                                                                       aria-hidden="true"
                                                                                       onclick="deleteRow(this)"></i>
                                            </td>
                                            <td class="name">
                                                <input type="text" id="name_author" name="name_author"
                                                       class="author_name">
                                            </td>
                                            <!--
                                            <td class="current">
                                                <span onclick="addCurrentAuthor(this)" class="buttonFinish"
                                                      id="select_current"
                                                      style="margin: 0px !important; cursor: pointer;">
                                                    *</span>
                                            </td>
                                            -->
                                        </tr>
                                    </table>
                                </div>
                                <span id="uyari2" class="uyari">*required </span>
                                <a href="#" onclick="document.getElementById('id01').style.display='block'"
                                   class="btn btn-authors"><i class="fa fa-plus"></i>&nbsp&nbspAdd Another Authors
                                </a>

                            </div>
                                
                                
                                
                       
                       
                       
                       <hr>
                        <h2 class="StepTitle">Upload File*:</h2>
                               
                                <input type="hidden" name="MAX_FILE_SIZE" value="5000000"  required >
                                <input type="file" name="my_file" id="my_file" 
                                       class="rsform-upload-box"/>
                                <br> <span class="anahtar">*required</span> <span class="anahtar"> (Upto 5 MB  word file can be uploaded)</span></br></br>


                     <hr>


                      
                      
                           
                           



                           

                         
                         


                       
                       

                        <!-- End SmartWizard Content -->

                    </td>
                </tr>
                 <tr><td><input type="submit" style="color:white;font-size : 20px;background:#006A68;width: 250px; height: 50px;" name="submit" value="Submit"</td></tr>
           
            </table>
        </form>

        <!-- End SmartWizard Content -->

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

                <label><b>Institution</b></label>
                <input type="text" placeholder="Enter Institution" id="authors_institution" required>


                <button id="add-authors-btn" class="btn btn-authors">submit</button>
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
                <label><b>First Name</b></label>
                <input type="text" placeholder="Enter First Name" id="first_name_2" required>

                <label><b>Last Name</b></label>
                <input type="text" placeholder="Enter Last Name" id="last_name_2" required>

                <label><b>Email Address</b></label>
                <input type="text" placeholder="Enter Email Address" id="authors_email_2" required>

                <label><b>Institution</b></label>
                <input type="text" placeholder="Enter Institution" id="authors_institution_2" required>


                <button id="edit-authors-btn" class="btn btn-authors">submit</button>
            </div>

        </div>
    </div>

</div>
<!-- jQuery -->
<script src="js/jquery/jquery.js">
</script>

<script charset="ıso-8859-9">
    var str = document.getElementById("ncp_id").innerHTML;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var gelen = xmlhttp.responseText;
            var deger = gelen.split("\"");
            //document.write(gelen);

            /*
            var title = deger[0].substr(2, (deger[0].length-3));
            var name_author = deger[1].substr(1, (deger[1].length - 2));
            var key_words = deger[2].substr(1, (deger[2].length - 2));
            var abstract = deger[3].substr(1, (deger[3].length - 2));
            var message = deger[4].substr(1, (deger[4].length - 2));
            */

            var title = deger[1];
            var name_author = deger[3];
            var key_words = deger[5];
            var abstract = deger[7];
            var message = deger[9];

            document.getElementById("title").value = title;
            document.getElementById("all_authors").value = name_author;
            document.getElementById("key_words").value = key_words;
            document.getElementById("abstract").value = abstract;
            document.getElementById("message").value = message;

            if (name_author.match(/,/g)) {
                var yazar = name_author.split(",");
                for (i = 0; i < yazar.length; i++) {
                    document.getElementById("name_author").value = yazar[i];
                    var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
                    $('#author_table').find('table').append($clone);
                }
            }
            else {
                document.getElementById("name_author").value = name_author;
                var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
                $('#author_table').find('table').append($clone);
            }

        }
    };

    xmlhttp.open("GET", "data_get_paper.php?id=" + str, true);
    xmlhttp.send();


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

    $BTN.click(function () {
        var author_first_name = document.getElementById("first_name").value;
        var author_last_name = document.getElementById("last_name").value;
        var author_name = author_first_name + " " + author_last_name;

        document.getElementById("name_author").value = author_name;
        var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
        $TABLE.find('table').append($clone);
        document.getElementById('id01').style.display = 'none';

        document.getElementById("first_name").value = "";
        document.getElementById("last_name").value = "";
        if (document.getElementById("all_authors").value == "")
            document.getElementById("all_authors").value = author_name;
        else {
            document.getElementById("all_authors").value = document.getElementById("all_authors").value + "," + author_name;
        }
    });
</script>
<script>
    var last_author_name = "";

    function editAuthor(r) {
        var s = r.parentNode.parentNode.rowIndex;
        var author_name = (document.getElementById("my_author_table").rows[s].cells[2].children[0].value).split(" ");
        last_author_name = document.getElementById("my_author_table").rows[s].cells[2].children[0].value;
        document.getElementById("first_name_2").value = author_name[0];
        document.getElementById("last_name_2").value = author_name[1];
        document.getElementById('id02').style.display = 'block';

        var i = r.parentNode.parentNode.rowIndex;
        document.getElementById("my_author_table").deleteRow(i);

    }

    /*
     function addCurrentAuthor(r) {
     var i = r.parentNode.parentNode.rowIndex;
     var tmp = document.getElementById("my_author_table").rows[i].cells[2].children[0].value;
     document.getElementById("my_author_table").rows[i].cells[2].children[0].value = tmp + " *";
     this.disabled(true);
     }
     */
    $('#edit-authors-btn').click(function () {
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

    });
    
    
     
    
    
</script>
<script>

function myFunction1() {
     
var upload1 = document.getElementById("my_file").value;
       
        document.getElementById("prev_upload").innerHTML = upload1;
            if (upload1 == '')
                document.getElementById("file_baslik").style.color = 'red';
            else 
            	document.getElementById("file_baslik").style.color = '#73879C';
            	
            }
           
     
     
            var manuscript_title1 = document.getElementById("title").value;
            var key_words1 = document.getElementById("key_words").value;
            var abstract1 = document.getElementById("abstract").value;
            var message1 = document.getElementById("message").value;
            var upload1 = document.getElementById("my_file").value;
                	
 //-----------

            document.getElementById("prev_title").innerHTML = manuscript_title1;
            
            if (manuscript_title1 == 'Title*' || manuscript_title1 == '')
                document.getElementById("title_baslik").style.color = 'red';
            else 
            	document.getElementById("title_baslik").style.color = '#73879C';
//-----------
             
            document.getElementById("prev_keyword").innerHTML = key_words1;
            
            
            if (key_words1 == 'keyword' || key_words1 == '')
                document.getElementById("keywords_baslik").style.color = 'red';
            else 
            	document.getElementById("keywords_baslik").style.color = '#73879C';
//-----------
            document.getElementById("prev_abstract").innerHTML = abstract1;
            
            if (abstract1 == 'abstract' || abstract1 == '')
                document.getElementById("abstract_baslik").style.color = 'red';
            else 
            	document.getElementById("abstract_baslik").style.color = '#73879C';
//-----------
            document.getElementById("prev_message").innerHTML = message1;
            
            if (message1 == 'message' || message1 == '')
                document.getElementById("message_baslik").style.color = 'red';
            else 
            	document.getElementById("message_baslik").style.color = '#73879C';
//-----------
            var reviewName1,reviewName2,reviewName3;
            reviewName1=document.getElementById("reviewName1").value;
            reviewName2=document.getElementById("reviewName2").value;
            reviewName3=document.getElementById("reviewName3").value;
            
            document.getElementById("prev_reviewName1").innerHTML = reviewName1;
            document.getElementById("prev_reviewName2").innerHTML = reviewName2;
            document.getElementById("prev_reviewName3").innerHTML = reviewName3;
//-----------
            if (reviewName1 == '' || reviewName2 == '' || reviewName3 == ''  )
                document.getElementById("refere_baslik").style.color = 'red';
            else 
            	document.getElementById("refere_baslik").style.color = '#73879C';
//-----------
            document.getElementById("prev_upload").innerHTML = upload1;
            if (upload1 == '')
                document.getElementById("file_baslik").style.color = 'red';
            else 
            	document.getElementById("file_baslik").style.color = '#73879C';
            	
            }

</script>
