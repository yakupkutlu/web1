<style>
    .print {
        font-size: 25px;
        font-weight: 400;
    }
</style>
<?php
$content_page_sql = mysqli_query($baglanti,"SELECT `year`,`volume`,`no` FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1 GROUP BY `year`,`volume`,`no` ORDER BY `year` DESC, `volume` DESC, `no` DESC LIMIT 1");
$content_page = mysqli_fetch_array($content_page_sql);

if (isset($content) and $content == 1) {
    $volume = $content_page["volume"];
    $no = $content_page["no"];
    $year = $content_page["year"];
} else {
    $volume = $_GET["volume"];
    $no = $_GET["no"];
    $year = $_GET["year"];
}

?>
<span class="print pull-right">
       <a class="fa fa-print" href="javascript:printpage();"></a>
  </span>
<div class="x_panel" id="prnt">

    <?php
    /* !!! ÖNEMLİ !!!
        3 tane yayin_turu değeri var:
        1. Derginin rutin sayılarındaki tam metin makaleler
        2. Derginin ek sayılarındaki tam metin makaleler
        3. Derginin ek sayılarındaki özet metinler

        Şimdilik review reports sayfasında sadece 1. id'li yayınlar gelecek
        16.02.2018
    */

    $sql_str = "SELECT * FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1 AND `year` = $year AND `volume` = $volume AND `no` = $no AND `yayin_turu` = 1 ORDER BY start_page";


    $query = mysqli_query($baglanti,$sql_str);
    if ($query) {
        while ($tmp = mysqli_fetch_array($query)) {
            $subID = $tmp['id'];

            $queryDetail = mysqli_query($baglanti,"select * from submission_list where id='$subID'");
            while ($data = mysqli_fetch_array($queryDetail)) {
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
            }
            ?>
<hr>
             <h2>Article</h2>           
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
                <!--               <tr>
                    <td>Adress</td>
                    <td><?php //echo $adress; ?></td>
                </tr>

                <tr>
                    <td>Phone Number</td>
                    <td><?php //echo $phone; ?></td>
                </tr>
                <tr>
                    <td>Fax</td>
                    <td><?php //echo $fax; ?></td>
                </tr> -->
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
                    <td>Message to Editor</td>
                    <td><?php echo $msg_to_editor; ?></td>
                </tr>
                <tr>
                    <td>Year</td>
                    <td><?php echo $year; ?></td>
                </tr>
              


            <?php
            $queryHistory = mysqli_query($baglanti,"select * from submission_list where id='$subID'");
            while ($data = mysqli_fetch_array($queryHistory)) {
               // $upload_date = $data["date"];
                $accept_date = $data["accept_date"];
                $publish_date = $data["publish_date"];
                $submission_date = $data["submission_date"];
                //    $author_message = $data["msg_to_editor"];
                // $editor_message = $data["msg_proof_author"];
                $editor_message = $data["editorDecisionMsg_toAuthor"];
                //    $msg_publishing = $data["msg_publishing"];

            } ?>
           
                <tr>
                    <td>Submission Date</td>
                    <td><?php echo $submission_date; ?></td>
                </tr>
                <tr>
                    <td>Accepted Date</td>
                    <td><?php echo $accept_date; ?></td>
                </tr>

                <!--
                <tr>
                    <td>Author's Message</td>
                    <td><?php //echo $author_message; ?></td>
                </tr> -->
                <tr>
                    <td>Editor's Decision</td>
                    <td><?php echo $editor_message; ?></td>
                </tr>
                <tr>
                    <td>Published Date</td>
                    <td><?php echo $publish_date; ?></td>
                </tr>
                <!--                <tr>
                    <td>Publish Message</td>
                    <td><?php //echo $msg_publishing; ?></td>
                </tr> -->
                </tbody>
            </table>
            <hr>

            <?php
            $queryReview = mysqli_query($baglanti,"SELECT * FROM review_requests WHERE paperid='$subID' AND acceptance_status IN (1,2,3,4)");

            $sayi = 1;
            while ($data = mysqli_fetch_array($queryReview)) {

                $rID = $data["reviewerid"];
                $rQuery = mysqli_fetch_object(mysqli_query($baglanti,"select * from users where id=$rID"));
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
                    <!--
                    <tr>
                        <td>Review Request Status</td>
                        <td><?php
                    /*
                        if ($rStatus == -1) echo "Awaiting review";
                        if ($rStatus == 0) echo "Rejected";
                        if ($rStatus == 1) echo "Accepted";
                        */
                    ?></td>
                    </tr>

				-->
                    <tr>
                        <td>Reviewer's Decision</td>
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

            <table width="100%">
                <tbody>
                <tr>
                    <td width="100%" height="1" bgcolor="#006A68">&nbsp;</td>
                </tr>
                </tbody>
            </table>
            <br>
            <?php
        } // END: while tmp query
    } // END: if($query)*/

    ?>
</div>

<script>
    function printpage() {
        var mywindow = window.open('', 'PRINT');

        mywindow.document.write('</head><body >');
        mywindow.document.write('<h1>' + document.title + '</h1>');
        mywindow.document.write(document.getElementById('prnt').innerHTML);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10*/

        mywindow.print();
        mywindow.close();

        return true;
    }
</script>