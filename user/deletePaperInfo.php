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
if (yetki_kontrol($role_number, "reviewer")) {
    include("../app/connect.php");
//include("../system.php");
    ?>
    <center><a class='btn btn-round btn-warning inbox-title'>Delete Paper Info</a></center>
    <?php
    $id = $_GET['paperID'];
    $query = mysqli_query($baglanti,"select * from submission_list where id='$id' ");
    $paper = mysqli_fetch_object($query);
    $paperID = $paper->paperID;
    $title = $paper->title;
    $publish = $paper->publish;
    $name_surname = $paper->name_surname;
    $authors = $paper->authors;
    ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br/>
                    <form method="post" action="deletePaperPage.php?id=<?php echo $id; ?>" id="contactForm"
                          data-parsley-validate class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class=" col-md-12 col-sm-12 col-xs-12" for="first-name">
                                <?php
                                echo 'PaperID : <font color="red"> ' . $paperID . '</font><br> ' ;
                                echo 'Paper Title :<font color="red">' . $title . '</font> <br>' ;
                                echo 'Authors :<font color="red">' . $authors . '</font><br> ' ;
                                echo 'Name Surname of User :<font color="red">' . $name_surname . '</font> <br><br>' ;
                                echo '<h3><font color="red">  Are You Sure  ? </font> </h3><br><br>' ;
                                

 
                                
                               
                                
                                ?>
                            </label></br></br>
                            <?php
                            if ($publish == 1) { ?>
                                <center>
                                    <h2 style="color: red;font-weight: bold" for="first-name">
                                        The paper has been published  !!!
                                    </h2>
                                </center>
                            <?php }
                            ?>
                        </div>






<script src="js/jquery/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
<script>
              var Top1,Top2;  
              function captchaCode() {
                    var Numb1, Numb2, Numb3, Numb4, Code;
                    Numb1 = (Math.ceil(Math.random() * 10) - 1).toString();
                    Numb2 = (Math.ceil(Math.random() * 10) - 1).toString();
                    Numb3 = (Math.ceil(Math.random() * 10) - 1).toString();
                    Top1 = Numb1 + Numb2;
                    Top2 = Numb3;

                    Code = Top1 + "+" + Top2; 
                    $("#code1").text(Code);
            
            }
                    
                    $(function() {
                      captchaCode();
                      
                      $("#contactForm").submit(function(){
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
</script>

 

 
		




 <div class="ln_solid"></div>


                   <div class="mail">
         <span id="code1" style="padding: 8px; padding-bottom: 13px; font-size: 25px; font-weight: bold;
        border: solid 3px; border-color: #73879C;color: #90111A;">  code </span>
        
        <a class= "btn btn-app" onclick="captchaCode();">  <i class="fa fa-refresh"></i> Refresh</a>
                  <span id="captcha" ></span>

                        <div class="answer"><p><br>Please enter the numbers in image (to prevent spam)</p></div>
					    <div class="mail-input-name-input" style="padding-top:0px;"><p>
						<input type="text" class="contact"  id="captcha_txt" placeholder="Enter captcha code"/></p>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/></p>
                        </div>	
                    </div>

                   
                     <div class="button_div">
						<div class="formBody">
                            <input type="submit" width="200px" value="Delete All this Paper Records" name="contact_submitted" id="Send" class="btn btn-danger"/>
                        </div>
                        
                    </div>
           













                       
                        <div class="form-group text-center">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                             </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
} else header("Refresh:0;  URL = 404.php ");
?>


