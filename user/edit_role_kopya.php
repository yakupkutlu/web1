<?php

if (yetki_kontrol($role_number, "edit_role")) {
    function users_menu($role_number)
    {

        //ROLE 1 BAŞ EDİTOR
        //ROLE 2 EDİTÖR
        //ROLE 3 HAKEM
        //ROLE 4 YAZAR

        echo "<div class='clearfix'>";
        echo "<h4><strong>DÜZENLENECEK ROLÜ SEÇİNİZ</strong></h4>";
        echo "<hr>";

        echo "<ul class='nav edit-menu'>";
        if ($role_number == "1") {
            echo "<li><a href='#'><i class=\"fa fa-object-group\"></i>&nbsp&nbspEDİTÖR</a>";
            echo "<ul class='nav sub-menu'>";
            echo "<li><a href='index.php?page=edit_role&process=editor_form'><i class=\"fa fa-arrow-circle-right\"></i>&nbsp&nbspEDİTÖR EKLE</a></li>";
            echo "<li><a href='index.php?page=edit_role&process=editor_list'><i class=\"fa fa-arrow-circle-right\"></i>&nbsp&nbspEDİTÖR LİSTELE</a></li>";
            echo "</li></ul>";
        }
        echo "<li><a href='#'><i class=\"fa fa-graduation-cap\"></i>&nbsp&nbspHAKEM</a>";
        echo "<ul class='nav sub-menu'>";
        echo "<li><a href='index.php?page=edit_role&process=reviewers_form'><i class=\"fa fa-arrow-circle-right\"></i>&nbsp&nbspHAKEM EKLE</a></li>";
        echo "<li><a href='index.php?page=edit_role&process=reviewers_list'><i class=\"fa fa-arrow-circle-right\"></i>&nbsp&nbspHAKEM LİSTELE</a></li>";
        echo "</li></ul>";

        echo "<li><a href='index.php?page=edit_role&process=authors_list'><i class=\"fa fa-user\"></i>&nbsp&nbspYAZAR</a>";

        echo "</ul>";

        echo "</div>";
    } // END users_menu()

    function reviewers_list()
    {
        include("../app/connect.php");
        // include("../system.php");

        echo "<center>HAKEM LISTESİ</center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
                <th>No</th>
                <th>Ad Soyad</th>
                <th>E-Mail</th>
                <th>Durum</th>
                <th style='text-align: center'>Process</th>
            </tr>
            </thead>
            <tbody>";

        if ($query = mysqli_query($baglanti,"select * from users where role=3;")) {

            $sira = 1;
            while ($data = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $sira . "</td>";
                $sira += 1;
                echo "<td>" . $data["user_name"] . "</td>";
                echo "<td>" . $data["email"] . "</td>";
                echo "<td>" . (($data["state"] == 1) ? "Aktif" : "Pasif") . "</td>";
                echo "<td align='center'><a href='index.php?page=edit_role&process=edit_reviewer&id=$data[id]'><i class=\"fa fa-edit\"></i></a></td>";
                echo "</tr>";

            }
        }
        echo "</tbody>
        </table>";
    } // END: reviewers_list()

    function reviewers_form()
    {
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
            <form  action=\"index.php?page=edit_role&process=add_reviewer\" method=\"post\">
                <table id=\"tbl\">
                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\" align=\"center\">
                            YENİ HAKEM EKLE
                        </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> Ad Soyad </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"name\"></td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> E-Mail </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"email\"> </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\">
                            <input type=\"submit\" value=\"Kaydet\" id=\"btn\">
                        </td>
                    </tr>
                </table>
            </form>";
    } // END: reviewers_form();

    function add_reviewer()
    {
        include("../app/connect.php");
        //include("../system.php");
        $name = _post("name");
        $email = _post("email");
        $user_name = explode("@", $email)[0];
        $pass = md5(md5($user_name));
        if (mysqli_query($baglanti,"insert into users (user_name,name_surname,pass,email,role) VALUES ('$user_name','$name','$pass' ,'$email','3')")) {
            echo "Yeni hakem başarılı bir şekilde eklendi<br>";
        } else echo "Hakem eklenirken bir hata ile karşılaşıldı. <br>";
    } // END: add_reviewer()

    function edit_reviewer()
    {
        include("../app/connect.php");
        //include("../system.php");
        $id = _get("id");

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

            <form action=\"index.php?page=edit_role&process=update_reviewer&id=$id\" method=\"post\">
                <table id=\"tbl\">
                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\" align=\"center\">
                            HAKEM BİLGİLERİ GÜNCELLEME
                        </td>
                    </tr>
                    
                    <tr>
                        <td style='padding: 5px'> Kullanıcı Adı </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"user_name\" value='$user_name'></td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> Ad Soyad </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"name_surname\" value='$name_surname'></td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> E-Mail </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"email\" value='$email'> </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan='2'>
                            <input type='radio' name='state' value='1' " . ($state == 1 ? " checked" : "") . "> Aktif
                            <input type='radio' name='state' value='0' " . ($state != 1 ? " checked" : "") . "> Pasif
                        </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\">
                            <input type=\"submit\" value=\"Güncelle\" id=\"btn\">
                        </td>
                    </tr>
                </table>
            </form>";
        }

    } // END: edit_reviewer

    function update_reviewer()
    {
        include("../app/connect.php");
        //include("../system.php");
        $user_name = _post("user_name");
        $name_surname = _post("name_surname");
        $email = _post("email");
        $state = _post("state");
        $id = _get("id");
        if (mysqli_query($baglanti,"update users set user_name='$user_name',name_surname='$name_surname',email='$email',state='$state' where id='$id'")) {
            echo "Hakem güncellemesi başarılı bir şekilde yapıldı.<br><br>";
        } else echo "Hakem bilgileri güncellenirken bir hata ile karşılaşıldı<br><br>";


    } // END: update_reviewer


    /*******************************************************************************************/
    if ($role_number == '1') {
        function editor_list()
        {
            include("../app/connect.php");
            //include("../system.php");

            echo "<center>EDİTOR LISTESİ</center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
                <th>No</th>
                <th>Ad Soyad</th>
                <th>E-Mail</th>
                <th>Durum</th>
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
                    echo "<td>" . $data["user_name"] . "</td>";
                    echo "<td>" . $data["email"] . "</td>";
                    echo "<td>" . (($data["state"] == 1) ? "Aktif" : "Pasif") . "</td>";
                    echo "<td align='center'><a href='index.php?page=edit_role&process=edit_editor&id=$data[id]'><i class=\"fa fa-edit\"></i></a></td>";
                    echo "</tr>";

                }
            }
            echo "</tbody>
        </table>";

        } // END: editor_list()

        function editor_form()
        {
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
            <form  action=\"index.php?page=edit_role&process=add_editor\" method=\"post\">
                <table id=\"tbl\">
                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\" align=\"center\">
                            YENİ EDİTÖR EKLE
                        </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> Ad Soyad </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"name\"></td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> E-Mail </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"email\"> </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\">
                            <input type=\"submit\" value=\"Kaydet\" id=\"btn\">
                        </td>
                    </tr>
                </table>
            </form>";
        } // END: editor_form();

        function add_editor()
        {
            include("../app/connect.php");
            //include("../system.php");
            $name = _post("name");
            $email = _post("email");
            $user_name = explode("@", $email)[0];
            $pass = md5(md5($user_name));
            if (mysqli_query($baglanti,"insert into users (user_name,name_surname,pass,email,role) VALUES ('$user_name','$name','$pass','$email','2')")) {
                echo "Yeni editör başarılı bir şekilde eklendi<br>";
            } else echo "Editör eklenirken bir hata ile karşılaşıldı. Hata : " . $sql->error() . "<br>";

        } // END: add_editor()

        function edit_editor()
        {
            include("../app/connect.php");
            //include("../system.php");
            $id = _get("id");

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

            <form action=\"index.php?page=edit_role&process=update_editor&id=$id\" method=\"post\">
                <table id=\"tbl\">
                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\" align=\"center\">
                            EDİTÖR BİLGİLERİ GÜNCELLEME
                        </td>
                    </tr>
                    
                    <tr>
                        <td style='padding: 5px'> Kullanıcı Adı </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"user_name\" value='$user_name'></td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> Ad Soyad </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"name_surname\" value='$name_surname'></td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px'> E-Mail </td>
                        <td style='padding: 5px'> <input type=\"text\" name=\"email\" value='$email'> </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan='2'>
                            <input type='radio' name='state' value='1' " . ($state == 1 ? " checked" : "") . "> Aktif
                            <input type='radio' name='state' value='0' " . ($state != 1 ? " checked" : "") . "> Pasif
                        </td>
                    </tr>

                    <tr style='padding: 5px'>
                        <td style='padding: 5px' colspan=\"2\">
                            <input type=\"submit\" value=\"Güncelle\" id=\"btn\">
                        </td>
                    </tr>
                </table>
            </form>";
            }


        } // END: edit_reviewer

        function update_editor()
        {
            include("../app/connect.php");
            //include("../system.php");
            $user_name = _post("user_name");
            $name_surname = _post("name_surname");
            $email = _post("email");
            $state = _post("state");
            $id = _get("id");
            if (mysqli_query($baglanti,"update users set user_name='$user_name',name_surname='$name_surname',email='$email',state='$state' where id='$id'")) {
                echo "Editör güncellemesi başarılı bir şekilde yapıldı.<br><br>";
            } else echo "Editör bilgileri güncellenirken bir hata ile karşılaşıldı<br><br>";

        } // END: update_editor
    }
    /*******************************************************************************************/
    function authors_list()
    {
        include("../app/connect.php");
        //include("../system.php");

        echo "<center>EDİTOR LISTESİ</center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
                <th>No</th>
                <th>Ad Soyad</th>
                <th>E-Mail</th>
                <th>Durum</th>
                <th style='text-align: center'>Process</th>
            </tr>
            </thead>
            <tbody>";

        if ($query = mysqli_query($baglanti,"select * from users where role=4;")) {
            $sira = 1;
            while ($data = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $sira . "</td>";
                $sira += 1;
                echo "<td>" . $data["user_name"] . "</td>";
                echo "<td>" . $data["email"] . "</td>";
                echo "<td>" . (($data["state"] == 1) ? "Aktif" : "Pasif") . "</td>";
                echo "<td align='center'><a href='index.php?page=edit_role&process=edit_editor&id=$data[id]'><i class=\"fa fa-edit\"></i></a></td>";
                echo "</tr>";

            }
        }
        echo "</tbody>
        </table>";

    } // END: authors_list()


    /*******************************************************************************************/

    $process = @$_GET['process'];
    switch ($process) {

        case "editor_form":
            editor_form();
            break;

        case "add_editor":
            add_editor();
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

        case "reviewers_form":
            reviewers_form();
            break;

        case "add_reviewer":
            add_reviewer();
            break;

        case "edit_reviewer":
            edit_reviewer();
            break;

        case "update_reviewer":
            update_reviewer();
            break;

        case "authors_list":
            authors_list();
            break;

        default:
            users_menu($role_number);
            break;
    }
} else header("Refresh:0;  URL = 404.php ");
?>

