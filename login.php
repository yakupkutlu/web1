<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> <?php echo $journalDomain; ?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="css/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="css/animate/animate.min.css" rel="stylesheet">

    <!-- Select2 -->
    <link href="js/select2/dist/css/select2.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.min.css" rel="stylesheet">
</head>
<style>
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        text-align: left!important;
    }
</style>

<body class="login">
 <table heigth="40px" width="100%">
<tbody>
<tr><td>  -</td><td style="background-color:rgb(16, 16, 16);">-</td><td style="background-color:rgb(17, 18, 18);">-</td><td>-</td></tr>
</tbody>
 </table>
<table width="100%">
<tbody>
<tr><td style="background-color: #006A68;"></td><td style="background-color: black;"></td><td style="background-color:rgb(0, 0, 0);"></td></tr>
<tr><td></td><td> <center> <a href="index.php"> <img src="images/iste.png" class="image_full"/></a></td><td></td></tr>
<tr><td style="background-color: blue;"></td><td style="background-color: blue;"></td><td style="background-color: #006A68;"></td></tr>
</tbody>
 </table>
 

<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>
    <a class="hiddenanchor" id="reset_pass"></a>

    <div class="login_wrapper">
<center> <h2> Editorial Manager for online submission and manuscript tracking</h2><center>
        <div class="animate form login_form">
            <section class="login_content">

                <form method="post" action="system.php?system=login">
                    <h1>Login Form</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="User Name" name="user" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" name="pass" required="" />
                    </div>
                       <img  src="img.php" width="150" height="50"> <br>
                     <!--
                     <?php $sayi1 = rand(10, 20); 
                    	$sayi2 = rand(1, 20);
                    	$dogrulamakodu=$sayi2+$sayi1;
                     ?>
                   
               		<div>
                        <input size="6" maxlength="6" class="form-control" disabled placeholder="<?php echo $sayi1.'+'.$sayi2.'  '?> " type="text" />
                     </div>
                    
                    
							<input  value="<?php echo $dogrulamakodu; ?>" name="dkod" type="hidden" />
--> 							
 							<div>
                        <input size="6" maxlength="6" class="form-control" placeholder="Enter Code " name="kod" type="text" autocomplete="off" />
                     </div>

                        
                       
                    
                    <div>
                        <button type="submit" class="btn btn-dark">Log in</button>
                        <a class="to_register" href="#reset_pass">Lost your password?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">

                        <p class="change_link" >
                            <a href="#signup" class="to_register" style="font-size: 15px!important; font-weight: bold;">New to site? Create Account </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1>  <?php echo $journalDomain; ?> &copy; 2024</h1>
                            <p></p>
                        </div>
                    </div>
                </form>
            </section>
        </div>



        
        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form method="post" action="system.php?system=new_user">
                    <h1>Create Account</h1>
                    <div class="form-group">
                        <select class="select2_single form-control" tabindex="-1" name="unvan" >
                            <option></option>
                            <option value="Professor">Professor</option>
                            <option value="Associate Professor">Associate Professor</option>
                            <option value="Assistant Professor">Assistant Professor</option>
                            <option value="Dr">Dr</option>
                            <option value="PhD">PhD</option>
                            <option value="MSc">MSc</option>
                            <option value="Other">Other</option>

                        </select>
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="Your Name" name="name" required="" />
                    </div>

                    <div>
                        <input type="text" class="form-control" placeholder="Your Surname" name="surname" required="" />
                    </div>

                    
                    <div>
                        <input type="email" class="form-control" placeholder="Email" name="email"  required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password" name="pass"  required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Again Password" name="pass_again"  required="" />
                    </div>
                    <div>
                        <textarea style="margin-bottom: 20px; resize: none;" name="adress" class="form-control" rows="3" placeholder="Adress"></textarea>
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="Instition" name="instition"  required="" />
                    </div>

                     <div>
                        <input type="text" class="form-control" placeholder="ORCID Number" name="orcid_no"  required="" />
                    </div>
                    <div>
                        <input type="text" class="form-control" placeholder="Phone" name="phone"  required="" />
                    </div>

                    <div>
                        <input type="text" class="form-control" placeholder="work area *** Please separate with comma  ***" name="work_area"  required="" />
                    </div>
 						 <img  src="img.php" width="150" height="50">   <br>                  
 <!--
                    <?php $sayi1 = rand(10, 20); 
                    $sayi2 = rand(1, 20);
                    $dogrulamakodu=$sayi2+$sayi1;
                     ?>
               		<div>
                        <input size="6" maxlength="6" class="form-control" disabled placeholder="<?php echo $sayi1.'+'.$sayi2.' '?> " type="text" />
                     </div>
                      
 
<input value="<?php echo $dogrulamakodu; ?>" name="dkod" type="hidden" />
-->                 
 
 							<div>
                        <input size="6" maxlength="6" class="form-control" placeholder="Enter Code" name="kod" type="text" required />
 
                    </div>

                    <div>
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1>  <?php echo $journalDomain; ?> &copy; 2024</h1>
                            <p> </p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

        <div id="register" class="animate form reset_pass_form">
            <section class="login_content">
                <form method="post" action="system.php?system=reset_pass">
                    <h1>Reset Password</h1>
                    <div>
                        <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="#signin" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1>  <?php echo $journalDomain; ?>&copy; 2024</h1>
                            <p> </p>
                        </div>
                    </div>
                </form>
            </section>
        </div>


    </div>
</div>
<!-- jQuery -->
<script src="user/js/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="user/js/bootstrap/bootstrap.min.js"></script>
<script src="js/select2/dist/js/select2.full.min.js"></script>
<script src="user/js/custom/custom.min.js"></script>


<!-- Select2 -->
<script>
    $(document).ready(function() {
        $(".select2_single").select2({
            placeholder: "Select Your Title",
            allowClear: true
        });
        $(".select2_group").select2({});
        $(".select2_multiple").select2({
            maximumSelectionLength: 4,
            placeholder: "With Max Selection limit 4",
            allowClear: true
        });
    });

</script>
<!-- /Select2 -->

</body>
</html>
