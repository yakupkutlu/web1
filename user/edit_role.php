<?php

if (yetki_kontrol($role_number, "edit_role")) {


    function users_menu($role_number)
    {

        //ROLE 1 BAŞ EDİTOR
        //ROLE 2 EDİTÖR
        //ROLE 3 HAKEM
        //ROLE 4 YAZAR
        $m_id = $_GET["m_id"];

        echo "<div class='clearfix'>";
        echo "<h4><strong>AUTHORIZATİON SETTINGS</strong></h4>";
        echo "<hr>";

        echo "<ul class='nav edit-menu'>";
        if ($role_number == "1") {
            echo "<li><a><i class=\"fa fa-object-group\"></i>&nbsp&nbspEDITOR</a>";
            echo "<ul class='nav sub-menu'>";
            echo "<li><a href='index.php?page=edit_role&process=editor_form&rnb=1&m_id=" . $m_id . "'><i class=\"fa fa-arrow-circle-right\"></i>&nbsp&nbspADD EDITOR</a></li>";
            echo "<li><a href='index.php?page=edit_role&rnb=1&process=editor_list&m_id=" . $m_id . "'><i class=\"fa fa-arrow-circle-right\"></i>&nbsp&nbspVIEW EDITOR LIST</a></li>";
            echo "</li></ul>";

            echo "<li><a href='#'><i class=\"fa fa-graduation-cap\"></i>&nbsp&nbspREVIEWER</a>";
            echo "<ul class='nav sub-menu'>";
            echo "<li><a href='index.php?page=edit_role&rnb=1&process=reviewers_form&m_id=" . $m_id . "'><i class=\"fa fa-arrow-circle-right\"></i>&nbsp&nbspADD REVIEWER</a></li>";
            echo "<li><a href='index.php?page=edit_role&rnb=1&process=reviewers_list&m_id=" . $m_id . "'><i class=\"fa fa-arrow-circle-right\"></i>&nbsp&nbspVIEW REVIEWER LIST</a></li>";
            echo "</li></ul>";

            echo "<li><a href='index.php?page=edit_role&rnb=1&process=authors_list&m_id=" . $m_id . "'><i class=\"fa fa-user\"></i>&nbsp&nbspAUTHOR</a>";
        }
        if ($role_number == "2") {

            echo "<li><a href='#'><i class=\"fa fa-graduation-cap\"></i>&nbsp&nbspREVIEWER</a>";
            echo "<ul class='nav sub-menu'>";
            echo "<li><a href='index.php?page=edit_role&rnb=2&process=reviewers_form&m_id=" . $m_id . "'><i class=\"fa fa-arrow-circle-right\"></i>&nbsp&nbspADD REVIEWER</a></li>";
            echo "<li><a href='index.php?page=edit_role&rnb=2&process=reviewers_list&m_id=" . $m_id . "'><i class=\"fa fa-arrow-circle-right\"></i>&nbsp&nbspVIEW REVIEWER LIST</a></li>";
            echo "</li></ul>";

            echo "<li><a href='index.php?page=edit_role&rnb=2&process=authors_list&m_id=" . $m_id . "'><i class=\"fa fa-user\"></i>&nbsp&nbspAUTHOR</a>";
        }


        echo "</ul>";

        echo "</div>";
    } // END users_menu()

    function editor_form()
    {
        $rnb = $_GET["rnb"];
        if ($rnb == 1) $m_id = 3;
        if ($rnb == 2) $m_id = 12;

        echo "<style>
                #btn {
                    height: 30px;
                    width: 80px;
                    color: #73879C;
                }

                #tbl {
                width: 30%;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                }
                                
            </style>
            <div class='clearfix'>
            <form  action=\"index.php?page=edit_role&m_id=" . $m_id . "&rnb=" . $rnb . "&process=add_editor\" method=\"post\">
                <table id=\"tbl\">
                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\" align=\"center\">
                            <h4><strong>ADD EDITOR</strong></h4>
                        </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> Name Surname </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"name\"></td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> E-Mail </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"email\"> </td>
                    </tr>
                    
                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> User Name </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"user_name\"> </td>
                    </tr>
                    
                    <tr style='padding: 5px'>
                        <td style='padding: 5px; '> University/Enstitu </td>
                        <td style='padding: 5px; '> <input  type=\"text\" name=\"instition\"> </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\">
                            <input type=\"submit\" value=\"Submit\" id=\"btn\">
                        </td>
                    </tr>
                </table>
            </form>
            </div>";
        echo "</br>";
        echo "<center><h4><strong>USER'S LIST</strong></h4></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
                <th>No</th>
                <th>Name Surname</th>
                <th>E-Mail</th>                
                <th>Work Area</th>
                <th>Title</th>
                <th>State</th>
                <th style='text-align: center'>Process</th>
            </tr>
            </thead>
            <tbody>";

        if ($query = mysqli_query($baglanti,"select * from users where role=4 or role=3;")) {
            $sira = 1;
            while ($data = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $sira . "</td>";
                $sira += 1;
                echo "<td>" . $data["name_surname"] . "</td>";
                echo "<td>" . $data["email"] . "</td>";
                echo "<td>" . $data["work_area"] . "</td>";
                echo "<td>" . $data["unvan"] . "</td>";
                echo "<td>" . (($data["state"] == 1) ? "Aktif" : "Pasif") . "</td>";
                echo "<td align='center'><a href='index.php?page=edit_role&m_id=" . $m_id . "&rnb=" . $rnb . "&process=add_editor_inAuthors&id=" . $data["id"] . "'><i class=\"fa fa-check\"></i></a></td>";
                echo "</tr>";

            }
        }
        echo "</tbody>
        </table>";

    } // END: editor_form();

    function add_editor()
    {
        include("../app/connect.php");
        $name = $_POST["name"];
        $email = $_POST["email"];
        $user_name = $_POST["user_name"];
        $pass = md5(md5($user_name));
        $instition = $_POST["instition"];
        if (mysqli_query($baglanti,"insert into users (user_name,name_surname,pass,email,role,instition) VALUES ('$user_name','$name','$pass','$email','2','$instition')")) {
            echo "Yeni editör başarılı bir şekilde eklendi";
            header("Refresh:1;  URL = index.php?page=edit_role&rnb=1 ");
        } else {
            echo "Editör eklenirken bir hata ile karşılaşıldı.";
            header("Refresh:1;  URL = index.php?page=edit_role&rnb=1 ");
        }

    } // END: add_editor()

    function add_editor_inAuthors()
    {
        include("../app/connect.php");
        $id = $_GET['id'];

        if (mysqli_query($baglanti,"update users set role=2 where id='$id'")) {
            echo "Yeni hakem başarılı bir şekilde eklendi<br>";
        } else echo "Hakem eklenirken bir hata ile karşılaşıldı. <br>";
    }// END: add_editor_inAuthors()


    function editor_list()
    {
        include("../app/connect.php");
        //include("../system.php");
        $rnb = $_GET["rnb"];
        if ($rnb == 1) $m_id = 3;
        if ($rnb == 2) $m_id = 12;

        echo "<center><h4><strong>EDITOR'S LIST</strong></h4></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
                <th>No</th>
                <th>Name Surname</th>
                <th>E-Mail</th>                
                <th>Work Area</th>
                <th>Title</th>
                <th>State</th>
                <th style='text-align: center'>Process</th>
            </tr>
            </thead>
            <tbody>";

        if ($query = mysqli_query($baglanti,"select * from users where role=2;")) {
            $sira = 1;
            while ($data = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $sira . "</td>";
                $sira += 1;
                echo "<td>" . $data["name_surname"] . "</td>";
                echo "<td>" . $data["email"] . "</td>";
                echo "<td>" . $data["work_area"] . "</td>";
                echo "<td>" . $data["unvan"] . "</td>";
                echo "<td>" . (($data["state"] == 1) ? "Aktif" : "Pasif") . "</td>";
                echo "<td align='center'><a href='index.php?page=edit_role&m_id=" . $m_id . "&rnb=" . $rnb . "&process=edit_editor&id=$data[id]'><i class=\"fa fa-edit\"></i></a></td>";
                echo "</tr>";

            }
        }
        echo "</tbody>
        </table>";

    } // END: editor_list()

    function edit_editor()
    {
        $rnb = $_GET["rnb"];
        if ($rnb == 1) $m_id = 3;
        if ($rnb == 2) $m_id = 12;

        include("../app/connect.php");
        $id = $_GET['id'];

        if ($query = mysqli_query($baglanti,"select * from users where id='$id';")) {
            while ($data = mysqli_fetch_array($query)) {
                $user_name = $data['user_name'];
                $name_surname = $data['name_surname'];
                $email = $data['email'];
                $state = $data['state'];
            }

            echo "<style>
                #btn {
                    height: 30px;
                    width: 80px;
                    color: #2A3F54;
                }

                #tbl {
                width: 30%;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                }
            </style>

            <form action=\"index.php?page=edit_role&m_id=" . $m_id . "&rnb=" . $rnb . "&process=update_editor&id=$id\" method=\"post\">
                <table id=\"tbl\">
                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\" align=\"center\">
                           <h4><strong>UPDATING EDITOR INFORMATION</strong></h4>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style='padding: 5px'> User Name </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"user_name\" value='$user_name'></td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> Name Surname </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"name_surname\" value='$name_surname'></td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> E-Mail </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"email\" value='$email'> </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan='2'>
                            <input type='radio' name='state' value='1' " . ($state == 1 ? " checked" : "") . "> Active
                            <input type='radio' name='state' value='0' " . ($state != 1 ? " checked" : "") . "> Passive
                        </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\">
                            <input type=\"submit\" value=\"Update\" id=\"btn\">
                        </td>
                    </tr>
                </table>
            </form>";
        }


    } // END: edit_editor

    function update_editor()
    {
        include("../app/connect.php");
        $user_name = $_POST["user_name"];
        $name_surname = $_POST["name_surname"];
        $email = $_POST["email"];
        $state = $_POST["state"];
        $id = $_GET["id"];
        if (mysqli_query($baglanti,"update users set user_name='$user_name',name_surname='$name_surname',email='$email',state='$state' where id='$id'")) {
            echo "Editör güncellemesi başarılı bir şekilde yapıldı.<br><br>";
        } else echo "Editör bilgileri güncellenirken bir hata ile karşılaşıldı<br><br>";

    } // END: update_editor


    function reviewers_list()
    {
        include("../app/connect.php");
        $rnb = $_GET["rnb"];
        if ($rnb == 1) $m_id = 3;
        if ($rnb == 2) $m_id = 12;

        echo "<center><h4><strong>REVIEWER'S LIST</strong></h4></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
                <th>No</th>
                <th>Name Surname</th>
                <th>E-Mail</th>                
                <th>Work Area</th>
                <th>Title</th>
                <th>State</th>
                <th style='text-align: center'>Process</th>
            </tr>
            </thead>
            <tbody>";

        if ($query = mysqli_query($baglanti,"select * from users where role=3 ORDER BY name_surname ASC ;")) {

            $sira = 1;
            while ($data = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $sira . "</td>";
                $sira += 1;
                echo "<td>" . $data["name_surname"] . "</td>";
                echo "<td>" . $data["email"] . "</td>";
                echo "<td>" . $data["work_area"] . "</td>";
                echo "<td>" . $data["unvan"] . "</td>";
                echo "<td>" . (($data["state"] == 1) ? "Aktif" : "Pasif") . "</td>";

                echo "<td align='center'><a href='index.php?page=edit_role&m_id=" . $m_id . "&rnb=" . $rnb . "&process=edit_reviewer&id=$data[id]'><i class=\"fa fa-edit\"></i></a></td>";

                echo "</tr>";

            }
        }
        echo "</tbody>
        </table>";
    } // END: reviewers_list()

    function edit_reviewer()
    {
        include("../app/connect.php");
        $id = $_GET["id"];
        $rnb = $_GET["rnb"];
        if ($rnb == 1) $m_id = 3;
        if ($rnb == 2) $m_id = 12;

        if ($query = mysqli_query($baglanti,"select * from users where id='$id';")) {

            while ($data = mysqli_fetch_array($query)) {
                $user_name = $data['user_name'];
                $name_surname = $data['name_surname'];
                $email = $data['email'];
                $state = $data['state'];

            }

            echo "<style>
                #btn {
                    height: 30px;
                    width: 80px;
                    color: #2A3F54;
                }

                #tbl {
                width: 30%;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                }
            </style>

            <form action=\"index.php?page=edit_role&process=update_reviewer&m_id=" . $m_id . "&rnb=" . $rnb . "&id=$id\" method=\"post\">
                <table id=\"tbl\">
                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\" align=\"center\">
                            <h4><strong>UPDATING REVIEWER INFORMATION</strong></h4>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style='padding: 5px'> User Name </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"user_name\" value='$user_name'></td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> Name Surname </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"name_surname\" value='$name_surname'></td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> E-Mail </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"email\" value='$email'> </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan='2'>
                            <input type='radio' name='state' value='1' " . ($state == 1 ? " checked" : "") . "> Active
                            <input type='radio' name='state' value='0' " . ($state != 1 ? " checked" : "") . "> Passive
                        </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\">
                            <input type=\"submit\" value=\"Update\" id=\"btn\">
                        </td>
                    </tr>
                </table>
            </form>";
        }

    } // END: edit_reviewer

    function update_reviewer()
    {
        include("../app/connect.php");
        $user_name = $_POST["user_name"];
        $name_surname = $_POST["name_surname"];
        $email = $_POST["email"];
        $state = $_POST["state"];
        if ($state == 1) $role = 3;
        else $role = 4;
        $id = $_GET["id"];
        if (mysqli_query($baglanti,"update users set user_name='$user_name',name_surname='$name_surname',email='$email',role='$role' where id='$id'")) {
            echo "Hakem güncellemesi başarılı bir şekilde yapıldı.<br><br>";
        } else echo "Hakem bilgileri güncellenirken bir hata ile karşılaşıldı<br><br>";


    } // END: update_reviewer

    function reviewers_form()
    {
        $rnb = $_GET["rnb"];
        if ($rnb == 1) $m_id = 3;
        if ($rnb == 2) $m_id = 12;
        echo "<style>
                #btn {
                    height: 30px;
                    width: 80px;
                    color: #73879C;
                }

                #tbl {
                width: 30%;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                }
                                
            </style>
            <form  action=\"index.php?page=edit_role&m_id=" . $m_id . "&rnb=" . $rnb . "&process=add_reviewer\" method=\"post\">
                <table id=\"tbl\">
                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\" align=\"center\">
                            <h4><strong>ADD REVIEWER</strong></h4>
                        </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px; width: 35%;'> Name Surname </td>
                        <td style='padding: 5px; width: 65%;'> <input style='width: 100%' type=\"text\" name=\"name\"></td>
                    </tr>                   
                                       

                    <tr style='padding: 5px'>
                        <td style='padding: 5px; width: 35%;'> E-Mail </td>
                        <td style='padding: 5px; width: 65%;'> <input style='width: 100%' type=\"text\" name=\"email\"> </td>
                    </tr>
                    
                    <tr style='padding: 5px'>
                        <td style='padding: 5px; width: 35%;'> Work Area </td>
                       <td style='padding: 5px; width: 65%;'> <input style='width: 100%' type=\"text\" name=\"work_area\" placeholder=\"Virgül ile ayırarak doldurunuz\"> </td>
                    </tr>
                    
                    <tr style='padding: 5px'>
                        <td style='padding: 5px; width: 35%;'> University/Enstitu </td>
                        <td style='padding: 5px; width: 65%;'> <input style='width: 100%' type=\"text\" name=\"instition\"> </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\">
                            <input type=\"submit\" value=\"Submit\" id=\"btn\">
                        </td>
                    </tr>
                </table>
            </form>";
        echo "</br>";
        echo "<center><h4><strong>USER'S LIST</strong></h4></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
                <th>No</th>
                <th>Name Surname</th>
                <th>E-Mail</th>                
                <th>Work Area</th>
                <th>Title</th>
                <th>State</th>
                <th style='text-align: center'>Add Reviewer</th>
            </tr>
            </thead>
            <tbody>";

        if ($query = mysqli_query($baglanti,"select * from users where role=4;")) {
            $sira = 1;
            while ($data = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $sira . "</td>";
                $sira += 1;
                echo "<td>" . $data["name_surname"] . "</td>";
                echo "<td>" . $data["email"] . "</td>";
                echo "<td>" . $data["work_area"] . "</td>";
                echo "<td>" . $data["unvan"] . "</td>";
                echo "<td>" . (($data["state"] == 1) ? "Aktif" : "Pasif") . "</td>";
                echo "<td align='center'><a href='index.php?page=edit_role&m_id=" . $m_id . "&rnb=" . $rnb . "&process=add_reviewer_inAuthors&id=" . $data["id"] . "'><i class=\"fa fa-plus-circle\"></i></a></td>";
                echo "</tr>";

            }
        }
        echo "</tbody>
        </table>";

    } // END: reviewers_form();


    function add_reviewer()
    {
        include("../app/connect.php");
        $name = $_POST["name"];
        $email = $_POST["email"];
        $user_name = $_POST["email"];
        $work_area = $_POST["work_area"];
        $instition = $_POST["instition"];
        $pass = md5(md5($user_name));
        $sorgu = "select * from users where email='$email'";
        $sorgu2 = "select * from users where user_name='$user_name'";
        if (mysqli_num_rows(mysqli_query($baglanti,$sorgu2))) {
            echo "Bu kullanıcı adına ait başka bir kullanıcı mevcut<br>";
        } else if (mysqli_num_rows(mysqli_query($baglanti,$sorgu))) {
            echo "There is already an account using this e-mail address<br>";
        } else {
            if (mysqli_query($baglanti,"insert into users (user_name,name_surname,pass,email,role,work_area,new_user,instition) VALUES ('$user_name','$name','$pass' ,'$email','3','$work_area','1','$instition')")) {
                echo "New Reviewer was added successfully<br>";
            } else echo "An error was occured during adding new reviewer<br>";
        }

    } // END: add_reviewer()

    function add_reviewer_inAuthors()
    {
        include("../app/connect.php");
        $id = $_GET['id'];

        if (mysqli_query($baglanti,"update users set role=3 where id='$id'")) {
            echo "New Reviewer was added successfully.<br>";
        } else echo "An error was occured during adding new reviewer<br>";
    }// END: add_reviewer_inAuthors()

    function authors_list()
    {
        $rnb = $_GET["rnb"];
        if ($rnb == 1) $m_id = 3;
        if ($rnb == 2) $m_id = 12;

        include("../app/connect.php");
        //include("../system.php");

        echo "<center><h4><strong>AUTHOR'S LIST</strong></h4></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
                <th>No</th>
                <th>Name Surname</th>
                <th>E-Mail</th>                
                <th>Work Area</th>
                <th>Instition</th>
                <th>Phone</th>
                <th>Title</th>
                <th>State</th>
                <th style='text-align: center'>Process<br>Edit Author /<br> Add Reviewer</th>
            </tr>
            </thead>
            <tbody>";

        if ($query = mysqli_query($baglanti,"select * from users")) {
            // ESKİ SORGU: select * from users where role=4;
            $sira = 1;
            while ($data = mysqli_fetch_array($query)) {
                $r = $data["role"]; // Kullanıcı rolü: 1,2,3,4 (Editor in chief, Editor, Reviewer, Author)
                if ($r == 1) $str = "<span style='color:red'>Editor-in-Chief</span>";
                else if ($r == 2) $str = "<span style='color:red'>Editor</span>";
                else if ($r == 3) $str = "<span style='color:red'>Reviewer</span>";
                else if ($r == 4) $str = "<a title='Add Reviewer' href='index.php?page=edit_role&m_id=" . $m_id . "&rnb=" . $rnb . "&process=add_reviewer_inAuthors&id=" . $data["id"] . "'><i class=\"fa fa-plus-circle\"></i></a>";

                echo "<tr>";
                echo "<td>" . $sira . "</td>";
                $sira += 1;
                echo "<td>" . $data["name_surname"] . "</td>";
                echo "<td>" . $data["email"] . "</td>";
                echo "<td>" . $data["work_area"] . "</td>";
                echo "<td>" . $data["instition"] . "</td>";
                echo "<td>" . $data["phone"] . "</td>";
                echo "<td>" . $data["unvan"] . "</td>";
                echo "<td>" . (($data["state"] == 1) ? "Aktif" : "Pasif") . "</td>";
                echo "<td align='left'><a title='Edit Author' href='index.php?page=edit_role&process=edit_authors&m_id=" . $m_id . "&rnb=" . $rnb . "&id=$data[id]'><i class=\"fa fa-edit\"></i></a> " . $str . "</td>";
                echo "</tr>";

            }
        }
        echo "</tbody>
        </table>";

    } // END: authors_list()

    function edit_authors()
    {
        include("../app/connect.php");
        $id = $_GET["id"];
        $rnb = $_GET["rnb"];
        if ($rnb == 1) $m_id = 3;
        if ($rnb == 2) $m_id = 12;

        if ($query = mysqli_query($baglanti,"select * from users where id='$id';")) {

            while ($data = mysqli_fetch_array($query)) {
                $user_name = $data['user_name'];
                $name_surname = $data['name_surname'];
                $email = $data['email'];
                $state = $data['state'];

            }

            echo "<style>
                #btn {
                    height: 30px;
                    width: 80px;
                    color: #2A3F54;
                }

                #tbl {
                width: 30%;
                margin-left: auto;
                margin-right: auto;
                text-align: center;
                }
            </style>

            <form action=\"index.php?page=edit_role&process=update_authors&m_id=" . $m_id . "&rnb=" . $rnb . "&id=$id\" method=\"post\">
                <table id=\"tbl\">
                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\" align=\"center\">
                           <h4><strong>UPDATING AUTHOR INFORMATION</strong></h4>
                        </td>
                    </tr>
                    
                    <tr>
                        <td style='padding: 5px'> User Name </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"user_name\" value='$user_name'></td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> Name Surname </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"name_surname\" value='$name_surname'></td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> E-Mail </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"email\" value='$email'> </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan='2'>
                            <input type='radio' name='state' value='1' " . ($state == 1 ? " checked" : "") . "> Active
                            <input type='radio' name='state' value='0' " . ($state != 1 ? " checked" : "") . "> Passive
                        </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\">
                            <input type=\"submit\" value=\"Update\" id=\"btn\">
                        </td>
                    </tr>
                </table>
            </form>";
        }

    } // END: edit_authors

    function update_authors()
    {
        include("../app/connect.php");
        $user_name = $_POST["user_name"];
        $name_surname = $_POST["name_surname"];
        $email = $_POST["email"];
        $state = $_POST["state"];
        if ($state == 1) $role = 3;
        else $role = 4;
        $id = $_GET["id"];
        if (mysqli_query($baglanti,"update users set user_name='$user_name',name_surname='$name_surname',email='$email',state='$state' where id='$id'")) {
            echo "Yazar güncellemesi başarılı bir şekilde yapıldı.<br><br>";
        } else echo "Yazar bilgileri güncellenirken bir hata ile karşılaşıldı<br><br>";


    } // END: update_authors


    switch ($_GET["process"]) {

        case "editor_form":
            editor_form();
            break;

        case "add_editor":
            add_editor();
            break;

        case "add_editor_inAuthors":
            add_editor_inAuthors();
            break;

        case "editor_list":
            editor_list();
            break;

        case "edit_editor":
            edit_editor();
            break;

        case "update_editor":
            update_editor();
            break;

        case "reviewers_list":
            reviewers_list();
            break;

        case "edit_reviewer":
            edit_reviewer();
            break;

        case "update_reviewer":
            update_reviewer();
            break;

        case "reviewers_form":
            reviewers_form();
            break;

        case "add_reviewer":
            add_reviewer();
            break;

        case "add_reviewer_inAuthors":
            add_reviewer_inAuthors();
            break;

        case "authors_list":
            authors_list();
            break;

        case "edit_authors":
            edit_authors();
            break;

        case "update_authors":
            update_authors();
            break;

        default:
            users_menu($role_number);
            break;
    }
} else header("Refresh:0;  URL = 404.php ");
?>

