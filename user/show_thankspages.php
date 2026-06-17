<!DOCTYPE html>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns:dt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882" xmlns="http://www.w3.org/TR/REC-html40">
<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta name=ProgId content=Word.Document>
    <meta name=Generator content="Microsoft Word 14">
    <meta name=Originator content="Microsoft Word 14">
    <title> <?php echo $journalShortName; ?></title>
    <style>
        .print-button {
            position: absolute;
            top: 20px;
            left: 20px;
            cursor: pointer;
        }
    </style>
    <script>
        function printPage() {
            window.print();
        }
    </script>
</head>
<body>
    <img src="../images/icon/printer_icon.png" alt="Print" class="print-button" onclick="printPage()">

    <!-- Kalan içerik buraya gelecek -->
    <?php
        include("../app/connect.php");

        $rPaperID = $_GET['paperid'];
        $rPaperQuery = mysqli_fetch_object(mysqli_query($baglanti, "select * from submission_list where id='$rPaperID'; "));
        $paperID = $rPaperQuery->paperID;
        $title = $rPaperQuery->title;

        $requestID = $_GET['reviewerid'];
        $reviewer = mysqli_fetch_object(mysqli_query($baglanti, "select * from users where id='$requestID'"))->name_surname;

        $tarih = mysqli_fetch_object(mysqli_query($baglanti, "Select * from review_requests WHERE reviewerid='$requestID' AND paperid='$rPaperID' "))->date;
    ?>

    <center>
        <table width="60%">
            <tr>
                <td>
                    <img width="100%" src="../images/iste.png">
                </td>
            </tr>
            <tr>
                <td>
                    <p style="text-align:justify"><b> <?php echo $tarih; ?> </b></p>
                    <p style="text-align:justify">Dear <b> <?php echo $reviewer; ?>,</b></p>
                    <p style="text-align:justify">Thank you for reviewing the manuscript <b> <?php echo $paperID; ?> </b> entitled <b> <?php echo $title; ?> </b> for the <?php echo $journalName; ?> (<?php echo $journalShortName; ?>).</p>
                    <p style="text-align:justify">On behalf of the Editors of <?php echo $journalName; ?>, we appreciate the voluntary contribution that each reviewer gives to the Journal. We thank you for your participation in the online review process and hope that we may call upon you again to review future manuscripts.</p>
                    <p style="text-align:justify">I wish you success for your research,</p>
                    <p style="text-align:justify">Sincerely,</p>
                    <p style="text-align:justify"><?php echo $journalEditorChef; ?></p>
                    <p style="text-align:justify">Editor in Chief, <?php echo $journalShortName; ?></p>
                </td>
            </tr>
        </table>
    </center>
</body>
</html>
