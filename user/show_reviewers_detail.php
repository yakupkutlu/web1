<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> <?php echo $journalShortName; ?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.css" rel="stylesheet">
</head>

<body class="nav-md">
<?php
include("../app/connect.php");
$id = $_GET['id'];
?>
<!-- page content -->

<div class="x_panel" style="min-height: 726px; margin-bottom: 0px; display: block;">
    <br class="x_content">

    <?php
    $query = mysqli_query($baglanti,"select * from submission_list where id='$id'");
    while ($data = mysqli_fetch_array($query)) {
        $name_surname = $data["name_surname"];
        $institution = $data["institution"];
        $adress = $data["adress"];
        $phone = $data["phone"];
        $fax = $data["fax"];
        $email = $data["email"];
        $title = $data["title"];
        $authors = $data["authors"];
        $abstract = $data["abstract"];
        $keyword = $data["keyword"];
        $paperID = $data["paperID"];
        $msg_to_editor = $data["msg_to_editor"];
        $year = $data["year"];
        $link = $data["paperfile1"];
        $editorDecision = $data["editorDecision"];
    } 
    ?>


    <!-- review content -->


    <div style="text-align: center; margin-bottom: 30px;">
        Editor's Message : <?php
        //$mquery=mysqli_query($baglanti,"select msg_to_editor from submission_list where id='$id'");
         
        //$editors_message=mysqli_fetch_object($mquery)->msg_to_editor;
        echo $msg_to_editor;
       
        ?>
    </div>
    <div style="text-align: center; margin-bottom: 30px;">
        Editor's Decision : <?php
        echo $editorDecision;
        ?>
    </div>
    </br>
    <?php
        $query = mysqli_query($baglanti,"select * from review_requests where paperid='$id' AND visible=1");


    $sayi = 1;
    while ($data = mysqli_fetch_array($query)) {
        $rID = $data["reviewerid"];
        $rQuery = mysqli_fetch_object(mysqli_query($baglanti,"select * from users where id='$rID'"));
        $rAcceptanceValue = $data["acceptance_status"];//makalenin kabul edilebilme durumu
        $rAcceptance = mysqli_fetch_object(mysqli_query($baglanti,"select * from review_decision where `value`= '$rAcceptanceValue' "))->decision;
        $rReport = $data["paper_report"];
        $review_report_file = $data["report_file"];
        $review_report_file_2 = $data["report_file_2"];


        ?>
        <table class="table table-striped">
            <thead>
            <tr>
                <th colspan="2">REVIEWER <?php echo $sayi; ?></th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td>Reviewer Decision</td>
                <td><?php echo $rAcceptance; ?></td>
            </tr>
            <tr>
                <td>Reviewer Comments</td>
                <td><?php echo $rReport; ?></td>
            </tr>
            <tr>
                <td>Reviewer Comment File</td>
                <?php
                if (($review_report_file=="") || ($review_report_file=="NULL")) {
                    $rReportFile = "	There is not an uploaded file"; ?>
                    <td><?php echo $rReportFile; ?> </td>
                    <?php

                } else {
                    $rReportFile = $review_report_file;
                    $rReportFileArray = explode("/", $rReportFile);
                    $rReportFileName = end($rReportFileArray); ?>
                    <td><a href="<?php echo $rReportFile; ?>"><?php echo $rReportFileName; ?>  <img src="../images/icon/down_word.png" width="30px" heigth="30px"> </a></td>
                    <?php
                }
                ?>

            </tr>

            <tr>
                <td>Reviewed MS File</td>
                <?php
                if (($review_report_file_2=="") || ($review_report_file_2=="NULL"))  {
                    $rReportFile_2 = "	There is not an uploaded file"; ?>
                    <td><?php echo $rReportFile_2; ?> </td>
                    <?php

                } else {
                    $rReportFile_2 = $review_report_file_2;
                    $rReportFileArray_2 = explode("/", $rReportFile_2);
                    $rReportFileName_2 = end($rReportFileArray_2); ?>
                    <td><a href="<?php echo $rReportFile_2; ?>"><?php echo $rReportFileName_2; ?>  <img src="../images/icon/down_word.png" width="30px" heigth="30px"> </a></td>
                    <?php
                }
                ?>

            </tr>

            </tbody>
        </table>
        <hr>
        <?php
        $sayi++;
    } ?>
</div>

<!-- /review content -->

<!-- footer content -->
<footer>
    <div class="pull-right">
        Makale Yönetimi @ 2017
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->

<script type="text/javascript">
    window.onresize = function () {
        window.resizeTo(630, 770);
    }
    window.onclick = function () {
        window.resizeTo(630, 770);
    }
</script>


<!-- jQuery -->
<script src="js/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="js/custom/custom.min.js"></script>
</body>
</html>
