<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $journalShortName; ?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.css" rel="stylesheet">
</head>

<body class="nav-md">

<!-- page content -->
<div class="x_panel" style="height: 726px; margin-bottom: 0px; display: block;">
    <div class="x_content">

        <?php
        include("../app/connect.php");
        $id = $_GET['id'];
        if (isset($_GET['process']))
            $process = $_GET['process'];
        else $process = "";

        $query = mysqli_query($baglanti,"select * from submission_list where id='$id'");
        while ($data = mysqli_fetch_array($query)) {
            $title = $data["title"];
            $authors = $data["authors"];
            $abstract = $data["abstract"];
            $keywords = $data["keyword"];
            $volume = $data["volume"];
            $no = $data["no"];
            $year = $data["year"];
            $references = $data["references"];
            $publish_date = $data["publish_date"];
            $proof_message = $data["msg_publishing"];
            $author_proof_message=$data["msg_proof_author"];
        }
        if ($process = "") {
            ?>
            <h3> <?php echo $title; ?> </h3>
            <b><?php echo $authors; ?></b></br></br>
            <h4>Abstract</h4>

            <p><?php echo $abstract; ?></p>


            <h4>Keywords</h4>
            <?php echo $keywords; ?>


            <p>&nbsp;</p>
            <p> Volume <?php echo $volume; ?>, No <?php echo $no; ?>,
                <?php
                // IGW yayınlarının SUPPLEMENTARY olduğunu belirtmek için
                if ($volume == 1 and $no == 3 and $year == 2016 and $publish_date == '2016-10-10') echo "Supplement, ";
                ?>
                <?php echo $pp; ?>, <?php echo $year; ?> </p>


            <br><br>

            <strong> References </strong>
            <?php echo $references;
        }
        if ($process="proof"){?>
            <h4>Editor's Message :</h4>
            <b><?php echo $author_proof_message; ?></b></br></br>

            <h4>Authors's Message :</h4>
            <b><?php echo $proof_message; ?></b></br></br>
        <?php
        }
        ?>


    </div>
</div>

<!-- /page content -->

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
        window.resizeTo(630, 900);
    }
    window.onclick = function () {
        window.resizeTo(630, 900);
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


