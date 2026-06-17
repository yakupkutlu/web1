<style>
    #photo input {
        display: none;
    }

    #photo a {
        cursor: pointer;
    }
</style>

<?php
//kullanıcı bilgileri getir
$profilInfo = BilgileriGetir();

 
?>
 

<div class="row">
    <div class="col-md-3 col-sm-3 col-xs-3">
        <form id="upload_photo" action="../system.php?system=upload_photo&user_name=<?php echo $user_name;?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div id="photo" class="profile_pic_upload">
                    <a><img src="images/<?php find_image($user_name); ?>" alt="..."
                            class="img-circle profile_img_upload"></a>
                    <input type="file" name="user_photo" id="user_photo" size="25"/>
                </div>
            </div>

            <div class="form-group" style="text-align: center; margin-left: auto; margin-right: auto;">
                <span id="image_dir"><?php find_image($user_name); ?></span>
            </div>

            <div class="form-group" style="text-align: center; margin-left: auto; margin-right: auto; ">
                <button type="submit" class="btn btn-success">Yükle</button>
            </div>
            <div class="form-group" style="text-align: center; margin-left: auto; margin-right: auto; ">
                <label>** Resim Yüklemek İçin Resim İconuna Tıklayınız</label>
            </div>

        </form>
    </div>


    <div class="col-md-9 col-sm-9 col-xs-9">
        <form id="demo-form2" action="../system.php?system=upload_profile&user_name=<?php echo $user_name; ?>"
              method="post" data-parsley-validate class="form-horizontal form-label-left">

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profile_name">Name<span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="profile_name" name="name" required="required"
                           class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profile_surname">Surname <span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="profile_surname" name="surname" required="required"
                           class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="profile_user_name_form">UserName
                    <span
                            class="required">**</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="profile_user_name_form" name="user_name_form" disabled
                           class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group">
                <label for="profile_email" class="control-label col-md-3 col-sm-3 col-xs-12">E-Mail</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="profile_email" class="form-control col-md-7 col-xs-12" type="text" name="email"  disabled>
                </div>
            </div>

            <div class="form-group">
                <label for="profile_adress" class="control-label col-md-3 col-sm-3 col-xs-12">Adres</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="profile_adress" class="form-control col-md-7 col-xs-12" type="text" name="adress">
                </div>
            </div>

            <div class="form-group">
                <label for="profile_instition" class="control-label col-md-3 col-sm-3 col-xs-12">Affilation/Institution</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="profile_instition" class="form-control col-md-7 col-xs-12" type="text" name="instition">
                </div>
            </div>

            <div class="form-group">
                <label for="profile_phone" class="control-label col-md-3 col-sm-3 col-xs-12">Phone Number</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="profile_phone" class="form-control col-md-7 col-xs-12" type="text" name="phone">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Work Area <span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="profile_user_work_area" name="user_work_area" required="required"
                           class="form-control col-md-7 col-xs-12">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">ORCID Number <span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="profile_user_orcid" name="orcid_no" required="required"
                           class="form-control col-md-7 col-xs-12"   value="<?php echo $profilInfo['orcid_no'];?>" >
                </div>
            </div>
 
<?php $unvan= $profilInfo['unvan'];


?>

            <div class="form-group">
                <label for="profile_unvan" class="control-label col-md-3 col-sm-3 col-xs-12">Title</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="select2_single form-control" tabindex="-1" name="unvan">
                        <option></option>
                
                                 
                        <option  <?php     if ($unvan=='Professor') { echo 'selected'; }   ?>   value="Professor">Professor</option>
                        <option  <?php     if ($unvan=='Associate Professor') { echo 'selected'; }   ?> value="Associate Professor">Associate Professor</option>
                        <option  <?php     if ($unvan=='Assistant Professor') { echo 'selected'; }   ?> value="Assistant Professor">Assistant Professor</option>
                        <option  <?php     if ($unvan=='Other') { echo 'selected'; }   ?>  value="Other">Other</option>

                    </select>
                </div>
            </div>
            <br>
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="profile_pass" name="pass" class="date-picker form-control col-md-7 col-xs-12"
                           required="required"
                           type="password" placeholder="Enter your password for saving profile">
                </div>
            </div>




            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
                    <a href="index.php" class="btn btn-primary">Cancel</a>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>


        </form>
    </div>
</div>
<script src="js/jquery/jquery.min.js"></script>
<!-- UPDATE PROFİLE -->
<script>

    $(document).ready(function () {

        var str = document.getElementById("session_user_name").innerHTML;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var gelen = xmlhttp.responseText;
                var deger = gelen.split("\"");
                var name_surname = deger[1];
                var tmp = name_surname.split(" ");
                var name = "";
                var count_tmp = tmp.length;
                if (count_tmp == 2) {
                    name = tmp[0];
                }
                else {
                    for (var i = 0; i < (count_tmp - 1); i++) {
                        name += tmp[i] + " ";
                        if (i == count_tmp - 2) name += tmp[i];
                    }
                }
                var surname = tmp[count_tmp - 1];
                var user_name_form = deger[3];
                var email = deger[5];
                var adress = deger[7];
                var instition = deger[9];
                var phone = deger[11];
                var user_work_area = deger[13];
                
                var unvan = deger[15];


                document.getElementById("profile_name").value = name;
                document.getElementById("profile_surname").value = surname;
                document.getElementById("profile_user_name_form").value = user_name_form;
                document.getElementById("profile_email").value = email;
                document.getElementById("profile_adress").value = adress;
                document.getElementById("profile_instition").value = instition;
                document.getElementById("profile_phone").value = phone;
                document.getElementById("profile_user_work_area").value = user_work_area;
         
                //document.getElementById("profile_unvan").value = unvan;


            }
        };


        xmlhttp.open("GET", "getdata.php?user=" + str, true);
        xmlhttp.send();

    });


</script>
<!-- /UPDATE PROFİLE -->
<!-- UODATE İMAGE -->
<script>
    $(document).ready(function () {
        $(function () {

            $('#photo a').click(function () {
                // Simulate a click on the file input button
                // to show the file browser dialog
                $(this).parent().find('input').click();


                document.getElementById("image_dir").innerHTML = document.getElementById("user_photo");
            });

            document.getElementById('user_photo').onchange = uploadOnChange;

            function uploadOnChange() {
                var filename = this.value;
                var lastIndex = filename.lastIndexOf("\\");
                if (lastIndex >= 0) {
                    filename = filename.substring(lastIndex + 1);
                }
                document.getElementById('image_dir').innerHTML = filename;
            }


        });
    });
</script>
<!-- /UODATE İMAGE -->



