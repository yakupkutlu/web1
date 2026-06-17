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
$id = $_GET['id']; ?>
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
            $volume=$data["volume"];
            $no=$data["no"];
            $pp=$data["pp"];
            $references=$data["references"];
        }
        ?>

        </br>
        <p>&nbsp;</p>
        <h3> <?php echo $title; ?> </h3>
        <b><?php echo $authors; ?></b></br></br>
        <h4>Abstract</h4>

        <p><?php echo $abstract; ?></p>


        <h4>Keywords</h4>
        <?php echo $keyword; ?>


        <p>&nbsp;</p>
        <p> Volume <?php echo $volume; ?>, No <?php echo $no; ?>,
            <?php echo $pp; ?>, <?php echo $year; ?> </p>

        <br><br>

        <strong> References </strong>
        <?php
        if (!preg_match_all("/<ul>/",$references)){
            $references=str_replace("<br>","<li>",$references);
            $references="<ul>".$references."</ul></br>";
        }
        echo $references;
        ?>

    </div>

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