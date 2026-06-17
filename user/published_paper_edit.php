<?php
include("../app/connect.php");
//include("../system.php");
if (yetki_kontrol($role_number, "publishing_papers")) {

    /*
    $query = mysqli_query($baglanti,"select * from submission_list where publish=-1 ");

    while ($tmp = mysqli_fetch_array($query)) {
        $title = $tmp["title"];
        /*
        if ($tmp["authors"] == "") { // EGER DIGER YAZARLAR YOK ISE
            $authors = $tmp["name_surname"];
        } else {  // EGER DIGER YAZARLAR VAR ISE
            $authors = $tmp["name_surname"] . "*, " . $tmp["authors"];
        }
        */
    /*
        $authors = $tmp["authors"];

        $pp = $tmp["pp"];
        $id = $tmp["id"];
        //$view = $tmp["view"];
        //$download = $tmp["download"];
        // $cited = $tmp["cited"];
        //$sorgu1 = mysqli_query($baglanti,"SELECT * FROM `cited` WHERE `makale_id`=$id");
        //$cited = @mysqli_num_rows($sorgu1);
        echo "<center><a class='btn btn-round btn-warning inbox-title'>Publishing Papers INBOX</a></center>";

        echo "<div class='publishing_papers'> <table width=\"100%\">
                                <tbody>
                                    <tr>
                                        <td width=\"92%\"><strong><a href=\"abstract_info.php?page=info&paperID=$id\" target=\"_blank\">$title</a></strong></td>
                                        <td width=\"8%\"><p>$pp</p></td>
                                    </tr>
                                    <tr>
                                        <td width=\"92%\"><strong>$authors</strong></td>
                                        <td width=\"8%\">
                                          &nbsp;
                                        </td>
                                    </tr>
                                </tbody>
                                </table>

                            </br></div>";


    } // END: while(mysqli_fetch_array);*/

    echo "<center><a class='btn btn-round btn-warning inbox-title'>Published Content Paper INBOX</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th style='width: 5%;'>ID</th>
                <th style='width: 55%;'>Paper's Detail</th>
 					<th style='width: 10%;'>pp</th>
                <th style='text-align: center; width: 30%'>Process</th>
            </tr>
            </thead>
            <tbody>";

//$content_page_sql = mysqli_query($baglanti,"SELECT `year`,`volume`,`no` FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1 GROUP BY `year`,`volume`,`no` ORDER BY `year` DESC, `volume` DESC, `no` DESC LIMIT 1");
 
 	$content_page_sql = mysqli_query($baglanti,"SELECT `year`,`volume`,`no` FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1 GROUP BY `year`,`volume`,`no` ORDER BY `year` DESC, `volume` DESC, `no` DESC LIMIT 1");
	$content_page = mysqli_fetch_array($content_page_sql);


    $volume = $content_page["volume"];
    $no = $content_page["no"];
    $year = $content_page["year"];

    $sql_str = "SELECT * FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1  AND `year` = $year AND `volume` = $volume AND `no` = $no ORDER BY start_page";

 
    if ($query = mysqli_query($baglanti,"$sql_str")) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            $title = $data["title"];
            $authors = $data["authors"];
            $pp = $data["pp"];
            $id = $data["id"];

            echo "<tr>";
            echo "<td>" . $sira . "</td>";
            $sira += 1;
            echo "<td style='width: 55%'><strong>" . $title . "</br>" . $authors . "</strong></td>";
            echo "<td style='width: 10%'>" . $pp . "</td>";
					//upload pdf
					//download pdf
					//upload word
					//download word
					// show detail
            echo "<td align='center'>
            <a href='javascript:void(0)' onclick='popupwindow(\"upload_file.php?process=pdf&id=" . $data["id"] . "\",400,300);'>
            <img src='../images/icon/up_pdf.png' height='28px' style='padding-right:10px;' title='Upload PDF File'></a>";
            $sonuc=explode(".pd",$data["paperfile1"]);
            if (!$sonuc[1] == "f")
                echo "<a href='" . "' target='_blank'><img src='../images/icon/down_no_pdf.png' title='PDF file not uploaded' style='padding-right:10px;' height='28px' ></a>";
            else
            echo "<a href='../" . $data["paperfile1"] . "' target='_blank'><img src='../images/icon/down_pdf.jpg' height='28px'  style='padding-right:10px;' title='Download PDF File'></a> "; 
            echo "<a href='javascript:void(0)' onclick='popupwindow(\"upload_file.php?id=" . $data["id"] . "\",400,300);'>
            <img src='../images/icon/up_word.png' height='28px'  style='padding-right:10px;' title='Upload WORD File'></a>";
            if ($data["word_format"] == "NULL")
                echo "<a href='../" . $data["paperfile1"] . "' target='_blank'><img src='../images/icon/down_word.ico' title='Download WORD File' style='padding-right:10px;' height='28px' ></a>";
            else echo "<a href='../" . $data["word_format"] . "' target='_blank'><img src='../images/icon/down_word.ico' title='Download WORD File' style='padding-right:10px;' height='28px' ></a>";
            echo " <a href='javascript:void(0)' onclick='popupwindow(\"show_paper_review_detail.php?id=" . $data["id"] . "\",600,850);'>
            <img src='../images/icon/detail2.png' height='28px'  style='padding-right:10px;' title='Detail'></a>
            <a href='index.php?page=accepted_paper_detail&process=publish&m_id=12&rnb=2&p_id=" . $data["id"] . "'>
            <img src='../images/icon/accept.jpg' height='28px'  style='padding-right:10px;' title='Publish'></a><a href='index.php?page=accepted_paper_detail&process=publishing&m_id=12&rnb=2&p_id=" . $data["id"] . "'><img src='../images/icon/edit.ico' title='Edit Paper' style='padding-right:10px;' height='28px' ></a>
             
            </td>";

            echo "</tr>";

        }
    }


    echo "</tbody>
        </table></br>   
        
        <hr></br>   
        
       ";

  echo "<a class='btn btn-round btn-danger inbox-title' href='index.php?page=coverpage_list&m_id=12&rnb=2'>  Define <b> Cover Page | Front Matter | Table of Contents </b></a> ";

  echo "<hr></br>    
        </br>";


} else
    header("Refresh:0;  URL = 404.php ");
?>


<script>
    function popupwindow(url, w, h) {
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        return window.open(url, null, 'toolbar=no, location=no,resizable=0, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
</script>

