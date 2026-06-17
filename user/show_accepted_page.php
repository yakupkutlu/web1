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
        $rPaperQuery = mysqli_fetch_object(mysqli_query($baglanti, "select * from submission_list where id='$rPaperID' and accept=1; "));
        $paperID = $rPaperQuery->paperID;
        $title = $rPaperQuery->title;
        $author = $rPaperQuery->name_surname;
        $tarih= $rPaperQuery->accept_date;

        //$requestID = $_GET['userid'];
        //$reviewer = mysqli_fetch_object(mysqli_query($baglanti, "select * from users where id='$requestID'"))->name_surname;

        //$tarih = mysqli_fetch_object(mysqli_query($baglanti, "Select * from review_requests WHERE reviewerid='$requestID' AND paperid='$rPaperID' "))->date;
    ?>

    <center>
        <table width="60%">
            <tr>
                <td>
                    <img width="100%" src="../jaiwa_header.png">
                </td>
            </tr>
            <tr>
                <td>
                    <p style="text-align:justify"><b> <?php echo $tarih; ?> </b></p>
                    <p style="text-align:justify">Dear <b> <?php echo $auhtor; ?>,</b></p>
                    
                   
                    
                    <p style="text-align:justify"> I am happy to inform you that your manuscript <b> <?php echo $paperID; ?> </b> entitled <b> <?php echo $title; ?> </b> has been accepted to be published in the coming issues of <a href="<?php echo $journalDomain; ?>"> <?php echo $journalName; ?> (<?php echo $journalShortName; ?>).</a> We may contact you during the publication process.</p>
                    
                     
                    
                    <p style="text-align:justify">On behalf of the Editorial Board of  <?php echo $journalName; ?>, I appreciate your contribution to the Journal.</p>
                    <p style="text-align:justify">I wish you success for your research,</p>
                    <p style="text-align:justify">Sincerely,</p>
                    <p style="text-align:justify">Editor of <?php echo $journalName; ?></p>
                    <p style="text-align:justify"> <a href="<?php echo $journalDomain; ?>"><?php echo $journalDomain; ?> </a> <br> <img src="../img/logo.png"></p>
                </td>
            </tr>
        </table>
    </center>
</body>
</html>
