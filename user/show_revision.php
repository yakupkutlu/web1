<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Makale Yönetimi </title>

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
        $query = "select * from submission_list where id='$id'";
        $pQuery = mysqli_fetch_object(mysqli_query($baglanti,$query));
        $title = $pQuery->title;
        $p_date = $pQuery->date;

        ?>
        <center><h2><?php echo $title; ?></h2></center>
        <br>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Dosya</th>
                <th>Yüklenme Tarihi</th>
                <th>Açıklma</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $rQuery = mysqli_query($baglanti,"Select * from submission_revision WHERE sub_id='$id'");

            $sira = 1;
            while ($data = mysqli_fetch_array($rQuery)) {
                ?>
                <tr>
                    <td><?php echo $sira; ?></td>
                    <td><a href="<?php echo $data["paper_file_old"]; ?>"> <?php echo $data["last_paperID"]; ?></a></td>
                    <td><?php if ($sira == 1) echo $p_date;
                        else echo $data["upload_date"]; ?>
                    </td>
                    <td><?php if ($sira == 1) echo "İlk Yüklenen Dosya";
                        else echo ($sira - 1) . ". Revizyon Dosyası";
                        ?>
                    </td>
                </tr>
                <?php $sira++;
            } ?>

            </tbody>
        </table>

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