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
if (!isset($_GET['process'])) $process = "";
else $process = $_GET['process'];
if (($process == "") || ($process == "detail")) { ?>
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

            $link2=$data["paperfile2"];
            $msg_publishing=$data["msg_publishing"];
            $accept_date=$data["accept_date"];
            $editorDecision=$data["editorDecision"];
            $editorDecisionMsg_toAuthor=$data["editorDecisionMsg_toAuthor"];
            $publish_date=$data["publish_date"];
            $authors=$data["authors"];
            $references=$data["references"];
            $volume=$data["volume"];
            $no=$data["no"];
            $pp=$data["pp"];
            $start_page=$data["start_page"];
            $doi=$data["doi"];
        
        }
        ?>
        <div style="text-align: center; margin-bottom: 30px;">
            <a href="show_paper_publish_detail.php?process=detail&id=<?php echo $id; ?>"
               class="btn btn-round btn-primary">Paper
                Detail</a>
            <a href="show_paper_publish_detail.php?process=history&id=<?php echo $id; ?>"
               class="btn btn-round btn-primary">History</a>
            <a href="show_paper_publish_detail.php?process=reviewer&id=<?php echo $id; ?>"
               class="btn btn-round btn-primary">Review
                Decision</a>
        </div>

        <center><b><h2>UNDER PUBLISHED PAPER DETAIL</h2></b></center>
        </br>
        <table class="table table-striped">

            <tbody>
            <tr>
                <td>Name and Surname</td>
                <td><?php echo $name_surname; ?></td>
            </tr>
            <tr>
                <td>Institution</td>
                <td><?php echo $institution; ?></td>
            </tr>
            <tr>
                <td>Adress</td>
                <td><?php echo $adress; ?></td>
            </tr>

            <tr>
                <td>Phone Number</td>
                <td><?php echo $phone; ?></td>
            </tr>
            <tr>
                <td>Fax</td>
                <td><?php echo $fax; ?></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>Manuscript Title</td>
                <td><?php echo $title; ?></td>
            </tr>
            <tr>
                <td>Authors</td>
                <td><?php echo $authors; ?></td>
            </tr>
            <tr>
                <td>Abstract</td>
                <td><?php echo $abstract; ?></td>
            </tr>
            <tr>
                <td>Keyword</td>
                <td><?php echo $keyword; ?></td>
            </tr>
            <tr>
                <td><a href="<?php echo $link; ?>" target="_blank">Manuscript file</a></td>
                <td><a href="<?php echo $link; ?>" target="_blank"><?php echo $paperID; ?></a></td>
            </tr>

            <tr>
                <td><a href="<?php echo $link2;?>" target="_blank">Manuscript file2</a></td>
                <td><a href="<?php echo $link2;?>" target="_blank"><?php echo $paperID; ?></a></td>
            </tr>
            <tr>
                <td>Publisihing Message</td>
                <td><?php echo $msg_publishing; ?></td>
            </tr>
                <tr>
                <td>Submission  Date</td>
                <td><?php echo $submission_date; ?></td>
            </tr>
            <tr>
                <td>Accept Date</td>
                <td><?php echo $accept_date; ?></td>
            </tr>
              <tr>
                <td>Publish Date</td>
                <td><?php echo $publish_date; ?></td>
            </tr>
            <tr>
                <td>Editor Decision</td>
                <td><?php echo $editorDecision; ?></td>
            </tr>
            <tr>
                <td>Editor Decision Msg to Author</td>
                <td><?php echo $editorDecisionMsg_toAuthor; ?></td>
            </tr>
          
            <tr>
                <td>Authors</td>
                <td><?php echo $authors; ?></td>
            </tr>
            <tr>
                <td>References</td>
                <td><?php echo $references; ?></td>
            </tr>
            <tr>
                <td>Volume</td>
                <td><?php echo $volume; ?></td>
            </tr>
            <tr>
                <td>No</td>
                <td><?php echo $no; ?></td>
            </tr>
            <tr>
                <td>PP</td>
                <td><?php echo $pp; ?></td>
            </tr>
            <tr>
                <td>Start Page</td>
                <td><?php echo $start_page; ?></td>
            </tr>
            <tr>
                <td>Doi</td>
                <td><?php echo $doi; ?></td>
            </tr>

            <tr>
                <td>Message to Editor</td>
                <td><?php echo $msg_to_editor; ?></td>
            </tr>
            <tr>
                <td>Year</td>
                <td><?php echo $year; ?></td>
            </tr>
            	<tr>
                <td>Graphical Abstract</td>
                <td><br> <img width='300px' src='<?php echo $coverImage; ?>' alt ="<?php echo $coverImage; ?>" ></td>
            </tr>
            </tbody>
        </table>

    </div>
<?php }
if ($process == "reviewer") { ?>
    <div class="x_panel" style="min-height: 726px; margin-bottom: 0px; display: block;">
        <br class="x_content">

        <div style="text-align: center; margin-bottom: 30px;">
            <a href="show_paper_publish_detail.php?process=detail&id=<?php echo $id; ?>"
               class="btn btn-round btn-primary">Paper
                Detail</a>
            <a href="show_paper_publish_detail.php?process=history&id=<?php echo $id; ?>"
               class="btn btn-round btn-primary">History</a>
            <a href="show_paper_publish_detail.php?process=reviewer&id=<?php echo $id; ?>"
               class="btn btn-round btn-primary">Review
                Decision</a>
        </div>

        <center><b><h2>UNDER PUBLISHED PAPER DETAIL</h2></b></center>
        </br>
        <?php
        $query = mysqli_query($baglanti,"select * from review_requests where paperid='$id' ");

        $sayi = 1;
        while ($data = mysqli_fetch_array($query)) {
            $rID = $data["reviewerid"];
            $rQuery = mysqli_fetch_object(mysqli_query($baglanti,"select * from users where id='$rID'"));
            $name_surname = $rQuery->name_surname;
            $email = $rQuery->email;
            $rRequest = $data["request_date"];
            $rStatus = $data["review_status"];//hakemliği kabul etme durumu
            $rAcceptanceValue = $data["acceptance_status"];//makalenin kabul edilebilme durumu
            $rAcceptance = mysqli_fetch_object(mysqli_query($baglanti,"select * from review_decision where `value`= '$rAcceptanceValue' "))->decision;
            $rReport = $data["paper_report"];
            $rMessage = $data["editor_comment"];
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
                    <td>Name and Surname</td>
                    <td><?php echo $name_surname; ?></td>
                </tr>
                <tr>
                    <td>E-mail</td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td>Review Request Date</td>
                    <td><?php echo $rRequest; ?></td>
                </tr>

                <tr>
                    <td>Review Request Status</td>
                    <td><?php
                        if ($rStatus == -1) echo "Awaiting review";
                        if ($rStatus == 0) echo "Rejected";
                        if ($rStatus == 1) echo "Accepted";
                        ?></td>
                </tr>
                <tr>
                    <td>Review Status</td>
                    <td><?php echo $rAcceptance; ?></td>
                </tr>
                <tr>
                    <td>Paper Report</td>
                    <td><?php echo $rReport; ?></td>
                </tr>
                <tr>
                    <td>Editor Comment</td>
                    <td><?php echo $rMessage; ?></td>
                </tr>
                <tr>
                    <td>Report File</td>
                    <?php
                    if (($review_report_file == "") || ($review_report_file == "NULL")) {
                        $rReportFile = "	There is not an uploaded file"; ?>
                        <td><?php echo $rReportFile; ?> </td>
                        <?php

                    } else {
                        $rReportFile = $review_report_file;
                        $rReportFileArray = explode("/", $rReportFile);
                        $rReportFileName = end($rReportFileArray); ?>
                        <td><a href="<?php echo $rReportFile; ?>"><?php echo $rReportFileName; ?></a></td>
                        <?php
                    }
                    ?>

                </tr>

                <tr>
                    <td>Report File 2</td>
                    <?php
                    if (($review_report_file_2 == "") || ($review_report_file_2 == "NULL")) {
                        $rReportFile_2 = "	There is not an uploaded file"; ?>
                        <td><?php echo $rReportFile_2; ?> </td>
                        <?php

                    } else {
                        $rReportFile_2 = $review_report_file_2;
                        $rReportFileArray_2 = explode("/", $rReportFile_2);
                        $rReportFileName_2 = end($rReportFileArray_2); ?>
                        <td><a href="<?php echo $rReportFile_2; ?>"><?php echo $rReportFileName_2; ?></a></td>
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

    <?php

}if ($process == "history") { ?>
    <div class="x_panel" style="min-height: 726px; margin-bottom: 0px; display: block;">
        <br class="x_content">

        <?php
        $query = mysqli_query($baglanti,"select * from submission_list where id='$id'");
        while ($data = mysqli_fetch_array($query)) {
            $upload_date = $data["date"];
            $accept_date = $data["accept_date"];
            $publish_date = $data["publish_date"];
            $author_message = $data["msg_to_editor"];
            $editor_message = $data["msg_proof_author"];
            $msg_publishing = $data["msg_publishing"];

        }
        ?>
        <div style="text-align: center; margin-bottom: 30px;">
            <a href="show_paper_publish_detail.php?process=detail&id=<?php echo $id; ?>"
               class="btn btn-round btn-primary">Paper
                Detail</a>
            <a href="show_paper_publish_detail.php?process=history&id=<?php echo $id; ?>"
               class="btn btn-round btn-primary">History</a>
            <a href="show_paper_publish_detail.php?process=reviewer&id=<?php echo $id; ?>"
               class="btn btn-round btn-primary">Review
                Decision</a>
        </div>

        <center><b><h2>UNDER PUBLISHED PAPER DETAIL</h2></b></center>
        </br>
        <table class="table table-striped">

            <tbody>
            <tr>
                <td>Upload Date</td>
                <td><?php echo $upload_date; ?></td>
            </tr>
            <tr>
                <td>Accepted Date</td>
                <td><?php echo $accept_date; ?></td>
            </tr>
            <tr>
                <td>Published Date</td>
                <td><?php echo $publish_date; ?></td>
            </tr>

            <tr>
                <td>Author's Message</td>
                <td><?php echo $author_message; ?></td>
            </tr>
            <tr>
                <td>Editor's Message</td>
                <td><?php echo $editor_message; ?></td>
            </tr>
            <tr>
                <td>Publish Message</td>
                <td><?php echo $msg_publishing; ?></td>
            </tr>
            </tbody>
        </table>

    </div>
<?php }

?>
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