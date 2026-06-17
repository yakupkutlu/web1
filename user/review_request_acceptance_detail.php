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
<?php
include("../app/connect.php");
$id = $_GET['id'];
?>
<!-- page content -->
<?php if (!isset($_GET['page'])) { ?>
    <div class="x_panel" style="min-height: 726px; margin-bottom: 0px; display: block;">
        <br class="x_content">

        <?php
        $query = mysqli_query($baglanti,"select * from submission_list where id='$id'");
        while ($data = mysqli_fetch_array($query)) {
            $name_surname = $data["name_surname"];
            $institution = $data["institution"];
            $title = $data["title"];
        }
		
		$acceptedReviewers = "";
		$rRequest = mysqli_query($baglanti,"select * from review_requests where paperid='$id' and review_status=1");
		while($data = mysqli_fetch_array($rRequest)){
			$reviwerID = $data["reviewerid"];
			$reviewerName = mysqli_fetch_array(mysqli_query($baglanti,"select name_surname from users where id = $reviwerID"));
			$acceptedReviewers .= $reviewerName[0]."<br>";
		}
		
		$declinedReviewers = "";
		$rRequest = mysqli_query($baglanti,"select * from review_requests where paperid='$id' and review_status=0");
		while($data = mysqli_fetch_array($rRequest)){
			$reviwerID = $data["reviewerid"];
			$reviewerName = mysqli_fetch_array(mysqli_query($baglanti,"select name_surname from users where id = $reviwerID"));
			$declinedReviewers .= $reviewerName[0]."<br>";
		}
		
		$awaitingReviewers = "";
		$rRequest = mysqli_query($baglanti,"select * from review_requests where paperid='$id' and review_status=-1");
		while($data = mysqli_fetch_array($rRequest)){
			$reviwerID = $data["reviewerid"];
			$reviewerName = mysqli_fetch_array(mysqli_query($baglanti,"select name_surname from users where id = $reviwerID"));
			$awaitingReviewers .= $reviewerName[0]."<br>";
		}
		
		$reviewedReviewers = "";
		$rRequest = mysqli_query($baglanti,"select * from review_requests where paperid='$id' and review_status=1 and acceptance_status != -1");
		while($data = mysqli_fetch_array($rRequest)){
			$reviwerID = $data["reviewerid"];
			$reviewerName = mysqli_fetch_array(mysqli_query($baglanti,"select name_surname from users where id = $reviwerID"));
			$reviewedReviewers .= $reviewerName[0]."<br>";
		}
        ?>

        <center><b><h2>REVIEW REQUEST ACCEPTANCE STATUS</h2></b></center>
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
                <td>Manuscript Title</td>
                <td><?php echo $title; ?></td>
            </tr>
			
			<tr>
                <td>Review Request Acceptance Status</td>
                <td>
					<table>
						<tr>
							<td><span style="color:green; font-weight: bold">Accepted Reviewers</span></td>
						</tr>
						<tr>
							<td><?php echo $acceptedReviewers; ?></td>
						</tr>
					</table>
					
					<br>
					
					<table>
						<tr>
							<td><span style="color:blue; font-weight: bold">Reviewed Reviewers</span></td>
						</tr>
						<tr>
							<td><?php echo $reviewedReviewers; ?></td>
						</tr>
					</table>
					
					<br>
					
					<table>
						<tr>
							<td><span style="color:red; font-weight: bold">Declined Reviewers</span></td>
						</tr>
						<tr>
							<td><?php echo $declinedReviewers; ?></td>
						</tr>
					</table>
					
					<br>
					
					<table>
						<tr>
							<td><span style="color:black; font-weight: bold">Awaiting Answer Reviewers</span></td>
						</tr>
						<tr>
							<td><?php echo $awaitingReviewers; ?></td>
						</tr>
					</table>
				</td>
            </tr>
            </tbody>
        </table>
		
		<center><b><h2>DECISIONS OF REVIEWERS</h2></b></center>
            </br>
            <?php
            $query = mysqli_query($baglanti,"select * from review_requests where paperid='$id' AND review_status!=0 AND state='1'");
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
                $review_report_file=$data["report_file"];
                $review_report_file_2=$data["report_file_2"];


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
                            if ($rStatus==-1) echo "Awaiting review";
                            if ($rStatus==0) echo "Rejected";
                            if ($rStatus==1) echo "Accepted";
                            ?></td>
                    </tr>
                    <tr>
                        <td>Review Status</td>
                        <td><?php echo $rAcceptance; ?></td>
                    </tr>
                    <tr>
                        <td>Message to Author:</td>
                        <td><?php echo $rReport; ?></td>
                    </tr>
                    <tr>
                        <td>Message to Editor:</td>
                        <td><?php echo $rMessage; ?></td>
                    </tr>
                    <tr>
                        <td>Reviewer Comment File:</td>
                        <?php
                        if (!isset($review_report_file))
                        {
                            $rReportFile = "	There is not an uploaded file";?>
                            <td><?php echo $rReportFile; ?></a> </td>
                            <?php

                        }

                        else {
                            $rReportFile = $review_report_file;
                            $rReportFileArray=explode("/",$rReportFile);
                            $rReportFileName=end($rReportFileArray);?>
                            <td><a href="<?php echo $rReportFile; ?>"><?php echo $rReportFileName; ?></a> </td>
                            <?php
                        }
                        ?>

                    </tr>

                    <tr>
                        <td>Reviewer M&S File :</td>
                        <?php
                        if (!isset($review_report_file))
                        {
                            $rReportFile_2 = "	There is not an uploaded file";?>
                            <td><?php echo $rReportFile_2; ?></a> </td>
                            <?php

                        }

                        else {
                            $rReportFile_2 = $review_report_file_2;
                            $rReportFileArray_2=explode("/",$rReportFile_2);
                            $rReportFileName_2=end($rReportFileArray_2);?>
                            <td><a href="<?php echo $rReportFile_2; ?>"><?php echo $rReportFileName_2; ?></a> </td>
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
<?php } ?>
<!--/page_content-->


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