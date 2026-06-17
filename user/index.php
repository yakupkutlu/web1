<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ob_start();


include("../app/connect.php");
include("../system.php");
include("function.php");
if (!isset($_SESSION["user"])) {
    $mesaj='SESSION has been finished.  Please log in again. <a href="https://'.$journalDomain.'/index.php?page=login"> GO LOGIN </a> ';
   
    MesajGoster($mesaj);
    Yonlendirme('index.php?page=login');
    die();
}

if (!isset($_GET['edit_page'])) $edit_page = "";
else $edit_page = $_GET['edit_page'];
?>

<!DOCTYPE html>
<html lang="en">
<head>



<script>
   //  (adsbygoogle = window.adsbygoogle || []).push({
   //       google_ad_client: "ca-pub-3687433991547872",
   //       enable_page_level_ads: true
   //  });
</script>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php  echo $journalShortName; ?></title>
    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico'/>

    <!-- Bootstrap -->
    <link href="css/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="js/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="css/nprogress/nprogress.css" rel="stylesheet">

    <script src="js/tiny_mce/tiny_mce.js" type="text/javascript"></script>

    <link href="css/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="css/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="css/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="css/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="css/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


    <!-- Include SmartWizard CSS -->
    <link href="js/jQuery-Smart-Wizard/css/smart_wizard_vertical.css" rel="stylesheet" type="text/css"/>


    <!-- Custom Theme Style -->
    <link href="css/custom.css" rel="stylesheet">


    <style>
        #user_role_name {
            display: none;
        }

        .user_role_name_button {
            background-color: transparent;
            box-sizing: border-box;
            padding: 0px 0px 0px 25px;
            border-width: 0px;
            border-style: outset;
            border-color: buttonface;
            border-image: initial;
            width: 100%;
            text-align: left;
        }

        .user_role_name_button:hover {
            background-color: #0f0784;
            color: #FFFFFF;
        }

        #roll h2 {
            padding: 0px 10px 0px 10px;
        }

        .roll_a a {
            padding: 10px 18px;
            margin-top: -8px;
            cursor: pointer;
            margin-right: 10px;
        }

        .home {
            color: white;
            font-weight: bold;
            padding-left: 60px;
        }
    </style>
</head>
<?php

$session_user = $_SESSION["user"];
$session_pass = $_SESSION["pass"];
$sql = "SELECT * FROM users WHERE user_name= '$session_user' AND pass= '$session_pass'";
$tmp_user = mysqli_fetch_object(mysqli_query($baglanti,$sql));
$user_name = $tmp_user->user_name;
$name_surname = $tmp_user->name_surname;
$role_number_real = $tmp_user->role;

if (!isset($_GET['m_id'])) {
    $m_id = 0;
} else {
    $m_id = $_GET['m_id'];
}

if (!isset($_GET['rnb'])) {
    $role_number = $tmp_user->role;
    $role = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM role WHERE id= '$role_number'"))->role_name;
} else {
    $role_number = $_GET['rnb'];
    $role = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM role WHERE id= '$role_number'"))->role_name;
}
if (isset($_POST['user_role_name'])) {
    $role = $_POST['user_role_name'];
    $role_number = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM role WHERE role_name= '$role'"))->id;
}

if (!isset($_GET['page'])) {
    $sql_menu_color = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM menus WHERE id= (SELECT min(id) FROM menus WHERE yetki= '$role_number')"));
    $page = $sql_menu_color->page;
    $m_id = $sql_menu_color->id;
} else $page = $_GET['page'];
?>

<body class="nav-md">
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="../index.php" target="_blank" class="site_title"><img src="../favicon.png" width="40px" ><span> <?php echo $journalShortName; ?>   </span></a>
                    <a href="../index.php" target="_blank"> <span class="home">Home</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <!-- SOL KISIM -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="images/<?php find_image($user_name); ?>" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>   Welcome ,</span>
                        <h2><?php echo $name_surname; ?></h2>
                        <span  id="session_user_name"><?php echo $_SESSION["user"]; ?></span>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                    <?php include("menu.php");

                    ?>

                </div>
                <!-- /sidebar menu -->

            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav>
                    <div class="nav toggle">
                        <div class="row" id="roll">
                            <div class="col-md-1 col-sm-2">
                                <a id="menu_toggle"><i class="fa fa-bars" style="color:white;"></i></a>
                            </div>
                            <div class="col-md-2 col-sm-2" style="color:white;text-align: center; margin-top: -6px;">
                                <h2><b>User Roles :</b></h2>
                            </div>
                            <div class="col-md-9 col-sm-8 roll_a">
                                <?php

                                $rol_yetki = mysqli_fetch_object(mysqli_query($baglanti,"select * from role where id='$role_number_real'"))->yetki;
                                if (preg_match('/,/', $rol_yetki)) {
                                    $rol_yetkileri = explode(",", $rol_yetki);
                                    foreach ($rol_yetkileri as $role) {
                                        $query = mysqli_query($baglanti,"select * from role where id='$role'");
                                        while ($data = mysqli_fetch_array($query)) {
                                            $role_name_menu = $data['role_name'];
                                            $role_name_number = $data['id'];
                                        }
                                        if ($role_number == $role_name_number) {
                                            ?>
                                            <a href="index.php?rnb=<?php echo $role_name_number; ?>"
                                               class="btn btn-round btn-primary btn-sm"><?php echo $role_name_menu; ?></a>
                                            <?php
                                        } else {

                                            ?>
                                            <a href="index.php?rnb=<?php echo $role_name_number; ?>"
                                               class="btn btn-round btn-default btn-sm"><?php echo $role_name_menu; ?></a>

                                            <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <a href="#"
                                       class="btn btn-round btn-primary btn-sm">Author</a>
                                    <?php
                                }

                                ?>
                            </div>
                        </div>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="#" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                               
                               <!--
                                <img src="images/<?php find_image($user_name); ?>" alt="">
<span
                                        id="session_user_name"><?php echo $_SESSION["user"]; ?></span>
                                                               
                                -->
                                <i class="fa fa-cog" aria-hidden="true">  <span
                                        id="session_user_name">Settings</span></i>

                              
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu pull-right">
                                <li><a href="index.php?page=profile"> My Profile</a></li>
                                <li><a href="index.php?page=message"> My Message</a></li>
                                <li><a href="index.php?page=password"> Change Password</a></li>
                                <li><u>  My User Roles</u></li>
                                <?php

                                $rol_yetki = mysqli_fetch_object(mysqli_query($baglanti,"select * from role where id='$role_number_real'"))->yetki;
                                if (preg_match('/,/', $rol_yetki)) {
                                    $rol_yetkileri = explode(",", $rol_yetki);
                                    foreach ($rol_yetkileri as $role) {
                                        $query = mysqli_query($baglanti,"select * from role where id='$role'");
                                        while ($data = mysqli_fetch_array($query)) {
                                            $role_name_menu = $data['role_name'];
                                        }

                                        ?>
                                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                            <input name="user_role_name" id="user_role_name"
                                                   value="<?php echo $role_name_menu; ?>">
                                            <li>
                                                <button class="user_role_name_button"
                                                        type="submit"> <i class="fa fa-user" aria-hidden="true">
 <?php echo $role_name_menu; ?></i></button>
                                            </li>
                                        </form>
                                        <?php
                                    }
                                }

                                ?>

                                <li><a href="../system.php?system=logout"><i class="fa fa-sign-out pull-right"></i>
                                        Log Out</a></li>
                            </ul>
                        </li>
                        <!-- GELEN MESAJLAR -->
                        <li role="presentation" class="dropdown">
                            <?php
                            $mQuery = mysqli_query($baglanti,"Select * from message_table where user_name='$user_name' and state=1");
                            $countMessage = mysqli_num_rows($mQuery);
                            ?>
                            <a href="#" class="dropdown-toggle info-number" data-toggle="dropdown"
                               aria-expanded="false">
                                <i class="fa fa-envelope-o"></i>
                                <?php if ($countMessage > 0) { ?>
                                    <span class="badge bg-green"><?php echo $countMessage; ?></span>
                                <?php } ?>
                            </a>
                            <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                <?php
                                while ($data = mysqli_fetch_array($mQuery)) {
                                    ?>
                                    <li>
                                        <a href="message_page_control.php">
                                        <span class="image"><img src="images/<?php find_image($data["gonderen"]); ?>"
                                                                 alt="Profile Image"/></span>
                                            <span>
                                            <span><?php echo $data["gonderen"]; ?></span>
                                        </span></br>
                                            <span><?php echo $data["date"]; ?> </span>
                                            <span class="message">
                                            <?php
                                            if (strlen($data["message"]) > 35) {
                                                echo substr($data["message"], 0, 30) . "...";
                                            } else echo $data["message"];
                                            ?>
                                        </span>
                                        </a>
                                    </li>
                                <?php } ?>
                                <!-- GELEN MESAJLAR -->


                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <!-- top tiles -->
            <div class="row tile_count">
                <!--           ÜSTTE GÖRÜNECEKLER -->

            </div>
            <!-- /top tiles -->

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <!--    ANA GÖVDE --->
                    <?php
                    
                    	if ($page == "test") include("add_paper_test.php");   // test için
                    	
                    	
					if ($page == "edit_mail_text") include("static_mail_content_list.php");
                    if ($page == "edit_menu") include("static_menu_content_list.php");
                    if ($page == "events") include("suplementevents.php");                    
                    if ($page == "edit_page") include("edit_static_content.php");
                    if ($page == "edit_role") include("edit_role.php");
                    if ($page == "profile") include("profile.php");
                    if ($page == "message") include("message_page.php");
                    if ($page == "password") include("profile_password.php");
                    /****/
                    if ($page == "contact") include("system_message_page.php");

                    if ($page == "add_papertest") include("add_papertest.php");
                    if ($page == "add_paper") include("add_paper.php");                    
					if ($page == "add_submission") include("add_submission.php");
                    if ($page == "add_paper_success") include("add_paper_success.php");
                    if ($page == "add_paper_not_success") include("add_paper_not_success.php");
                    if ($page == "authors_paper") include("authors_paper.php");
                    if ($page == "editorial_correction") include("editorial_correction.php");
                    if ($page == "editorial_correction_page") include("editorial_correction_page.php");
                    if ($page == "author_revision") include("author_revision.php");
                    if ($page == "add_revision_page") include("add_revision_page.php");
                    if ($page == "proof_correction") include("proof_correction.php");
                    if ($page == "proof_correction_page") include("proof_correction_page.php");

                    if ($page == "submission") include("submission.php");
                    if ($page == "sentBackToAuthor") include("sentBackToAuthor.php");
                    if ($page == "reviewer") include("reviewer.php");
                    if ($page == "revision") include("revision.php");
                    if ($page == "come_revision") include("come_revision.php");
                    if ($page == "accepted_paper") include("user_accepted_paper.php");
                    if ($page == "accepted_paper_detail") include("accepted_paper_detail.php");
                    if ($page == "publishing_process") include("publishing_process.php");
                    if ($page == "publishing_process_page") include("publishing_process_page.php");
                    if ($page == "publishing_papers") include("publishing_papers.php");
 						  if ($page == "coverpage_list") include("coverpage_list.php"); 						  
 						  if ($page == "new_coverpage") include("new_coverpage_insert.php");
 						  if ($page == "new_eventpage") include("suplement_new_evet_insert.php");
 						  
                    if ($page == "published") include("published.php");
                    if ($page == "published_paper_edit") include("published_paper_edit.php");
                    if ($page == "rejected") include("rejected.php");
                    if ($page == "add_cited") include("add_cited.php");
                    if ($page == "add_cited_page") include("add_cited_page.php");

                    if ($page == "not_completed") include("not_completed.php");
                    if ($page == "not_completed_paper") include("not_completed_paper.php");
                    if ($page == "process") include("process.php");

                    if ($page == "my_request") include("my_request.php");
                    if ($page == "comment_request") include("comment_request.php");
                    if ($page == "review_add_comment") include("review_add_comment.php");
                    if ($page == "complated_manuscript") include("complated_manuscript.php");

                    if ($page == "accepted") include("accepted_paper.php");

                    //content kısmı
                    if ($page == "upload_file") include("upload_file.php");

                    if ($page == "allReviewerReport") include("allReviewerReport.php");
                    if ($page == "reviewReport") include("reviewReport.php");
                    if ($page == "reviewReportInfo") include("reviewReportInfo.php");
                    if ($page == "deletePaper") include("deletePaper.php");
                    if ($page == "deletePaperInfo") include("deletePaperInfo.php");
                    
                    if ($page == "indexedlistpage") include("indexed_list_page.php");
                    if ($page == "editorlistpage") include("editor_list_page.php");


                    if ($page == "404") include("404.php");

                    ?>

                </div>

            </div>
            <br/>

        </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
        <div class="pull-right">
       <?php echo $journalDomain; ?>@2024
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="js/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap/bootstrap.min.js"></script>

<!-- NProgress -->
<script src="js/nprogress/nprogress.js"></script>

<!-- DataTable Scripts -->
<script src="css/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="css/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="css/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="css/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="css/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="css/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="css/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="css/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="css/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="css/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="css/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>

<!-- Include jQuery Validator plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>
<!-- iCheck -->
<script src="js/iCheck/icheck.min.js"></script>
<!-- jQuery Smart Wizard -->
<script src="js/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>


<!-- Custom Theme Scripts -->
<script src="js/custom/custom.min.js"></script>

<?php if ($page == "process") { ?>

    <link href="js/reviewer/jquery.dataTables.css" rel="stylesheet">
    <link href="js/reviewer/select.dataTables.css">
    <script src="js/reviewer/dataTables.select.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.2/js/dataTables.select.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="js/custom/custom.min.js"></script>

    <script>$(document).ready(function () {
            $('#reviewer_checked_table').DataTable({
                select: {
                    style: 'multi'
                    //info:false
                },
                language: {
                         info: "Showing _START_ to _END_ of _TOTAL_ entries&nbsp&nbsp&nbsp&nbsp",
                        sInfoFiltered: "(filtered from _MAX_ total entries)&nbsp&nbsp&nbsp&nbsp"
                   }
            });
        });</script>
<?php } else { ?>


    <!-- Datatables -->
    <script>
        $(document).ready(function () {
            var handleDataTableButtons = function () {
                if ($("#datatable-buttons").length) {
                    $("#datatable-buttons").DataTable({
                        dom: "Bfrtip",
                        buttons: [
                            {
                                extend: "copy",
                                className: "btn-sm"
                            },
                            {
                                extend: "csv",
                                className: "btn-sm"
                            },
                            {
                                extend: "excel",
                                className: "btn-sm"
                            },
                            {
                                extend: "pdfHtml5",
                                className: "btn-sm"
                            },
                            {
                                extend: "print",
                                className: "btn-sm"
                            },
                        ],
                        responsive: true
                    });
                }
            };

            TableManageButtons = function () {
                "use strict";
                return {
                    init: function () {
                        handleDataTableButtons();
                    }
                };
            }();

            $('#datatable').dataTable();

            $('#datatable-keytable').DataTable({
                keys: true
            });

            $('#datatable-responsive').DataTable();

            $('#datatable-scroller').DataTable({
                ajax: "js/datatables/json/scroller-demo.json",
                deferRender: true,
                scrollY: 380,
                scrollCollapse: true,
                scroller: true
            });

            $('#datatable-fixed-header').DataTable({
                fixedHeader: true
            });

            var $datatable = $('#datatable-checkbox');

            $datatable.dataTable({
                'order': [[1, 'asc']],
                'columnDefs': [
                    {orderable: false, targets: [0]}
                ]
            });
            $datatable.on('draw.dt', function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_flat-green'
                });
            });

            TableManageButtons.init();
        });
    </script>
    <!-- /Datatables -->
<?php } ?>

<!--- Add Paper --->
<?php if ($page == "add_paper") { ?>
    <script type="text/javascript">
        // Smart Wizard
        $('#wizard').smartWizard({
            transitionEffect: 'fade',
            selected: 0

        });
    </script>
<?php } ?>

<?php if ($page == "not_completed_paper") { ?>
    <script type="text/javascript">
        $('#wizard').smartWizard({
            transitionEffect: 'fade',
            enableAllSteps: true,
            selected: 0
        });
    </script>
<?php } ?>
<!--- /Add Paper --->
</body>
</html>
