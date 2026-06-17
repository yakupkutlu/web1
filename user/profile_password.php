<style>
    #photo input {
        display: none;
    }

    #photo a {
        cursor: pointer;
    }
</style>

<div class="row">
    <div class="col-md-3 col-sm-3 col-xs-3">
       
    </div>


    <div class="col-md-9 col-sm-9 col-xs-9">
        <form id="demo-form2" action="../system.php?system=upload_password&user_name=<?php echo $user_name ?>"
              method="post" data-parsley-validate class="form-horizontal form-label-left">

            

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="profile_pass" name="pass" class="date-picker form-control col-md-7 col-xs-12"
                           required="required"
                           type="password" placeholder="Please write new password ">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Password (again)<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="profile_pass" name="pass_again" class="date-picker form-control col-md-7 col-xs-12"
                           required="required"
                           type="password" placeholder=" Please write new password again">
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



