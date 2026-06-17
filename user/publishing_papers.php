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

    echo "<center><a class='btn btn-round btn-warning inbox-title'>Publishing Precess INBOX</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th style='width: 5%;'>ID</th>
                <th style='width: 45%;'>Paper's Detail</th>
				<th style='width: 5%;'>Start Page</th>
 				<th style='width: 5%;'>pp</th>
                <th style='text-align: center; width: 35%'>Process</th>
            </tr>
            </thead>
            <tbody>";

    if ($query = mysqli_query($baglanti,"select * from submission_list where accept=1 and publish=-1 and publish_status=0 order by start_page")) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            $title = $data["title"];
            $authors = $data["authors"];
            $pp = $data["pp"];
            $id = $data["id"];
			$sp = $data["start_page"];

            echo "<tr>";
            echo "<td>" . $sira . "</td>";
            $sira += 1;
            echo "<td style='width: 45%'><strong>" . $title . "</br>" . $authors . "</strong></td>";
           echo "<td style='width: 5%'>" . $sp . "</td>"; echo "<td style='width: 5%'>" . $pp . "</td>";
					//upload pdf
					//download pdf
					//upload word
					//download word
					// show detail
            echo "<td align='center'>";
			 $sorgu="SELECT * FROM submission_list where id=". $data["id"];
			$doi = mysqli_fetch_object(mysqli_query($baglanti,$sorgu))->doi;
			if ($doi==""){
			  echo "<a href='get_doi.php?process=create&paperID=" . $data['id']."'>
            <img src='../images/icon/doi_logo.png' height='28px' style='padding-right:10px;' title='Create DOI for this paper'></a>";
			}else{
				 
				 echo "<img src='../images/icon/doi_logo_ok.png' height='28px' style='padding-right:10px;' title=' DOI was created for this paper'> ";
			}
		
		
	    	if ($doi==""){
			
			}else{
				 
			   echo "<a href='get_doi.php?process=update&paperID=" . $data['id']."'>
            <img src='../images/zenodo_update.png' height='28px' style='padding-right:10px;' title='Update Zenodo Content'></a>";
			}
			 
            echo "<a href='javascript:void(0)' onclick='popupwindow(\"upload_file.php?process=pdf&id=" . $data["id"] . "\",400,300);'>
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
            echo " 
			<a href='javascript:void(0)' onclick='popupwindow(\"show_paper_review_detail.php?id=" . $data["id"] . "\",600,850);'>
			
            <img src='../images/icon/detail2.png' height='28px'  style='padding-right:10px;' title='Detail'></a>
			 <a href='javascript:void(0)' onclick='popupwindow(\"upload_file.php?process=abstractimage&id=" . $data["id"] . "\",450,250);'><img src='../images/icon/up_img.png' height='28px' style='padding-right:10px;' title='Upload Graphical Abstract Image File'></a> 
           
            <a href='index.php?page=accepted_paper_detail&process=publish&m_id=12&rnb=2&p_id=" . $data["id"] . "'>
            <img src='../images/icon/accept.jpg' height='28px'  style='padding-right:10px;' title='Publish'></a><a href='index.php?page=accepted_paper_detail&process=publishing&m_id=12&rnb=2&p_id=" . $data["id"] . "'><img src='../images/icon/edit.ico' title='Edit Paper' style='padding-right:10px;' height='28px' ></a>
            <a href='index.php?page=accepted_paper_detail&process=proof_message&m_id=12&rnb=2&p_id=" . $data["id"] . "'><img src='../images/icon/forms-icon.png' height='28px'  style='padding-right:10px;' title='Proof Reading'></a>   
            
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

    echo "<center><a class='btn btn-round btn-warning inbox-title'>Proof Reading INBOX</a></center></br></br>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th style='width: 5%;'>ID</th>
                <th  style='width: 55%;'>Paper's Detail</th>
                  <th  style='width: 10%;'>pp</th>
                <th style='text-align: center; width: 30%'>Process</th>
            </tr>
            </thead>
            <tbody>";

    if ($query = mysqli_query($baglanti,"select * from submission_list where accept=1 and publish=-1 and publish_status=1 ")) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            $title = $data["title"];
            $authors = $data["authors"];
            $pp = $data["pp"];
            $id = $data["id"];
            $proof_state = $data["proof_state"];
            if ($proof_state == 0) echo "<tr style='color: red'>";
            else echo "<tr style='color: #006A68'>";
            echo "<td>" . $sira . "</td>";
            $sira += 1;
            echo "<td style='width: 55%'><strong>" . $title . "</br>" . $authors . "</strong></td>";
            echo "<td style='width: 10%'>" . $pp . "</td>";
            if ($proof_state == 0) echo '<td style="width: 5%"><img src="../images/icon/message-bubble-send.ico" style="height: 28px;"></td>';
            else echo '<td style="width: 5%"><img src="../images/icon/message-bubble-received.png" style="height: 28px;"></td>';
            echo "<td align='center'>
            <a href='javascript:void(0)' onclick='popupwindow(\"publishing_papers_detail.php?id=" . $data["id"] . "\",600,850);'><img src='../images/icon/proff_message.ico' height='28px'  style='padding-right:10px;' title='Proff Reading Message'></a>            
            <a href='javascript:void(0)' onclick='popupwindow(\"upload_file.php?process=pdf&id=" . $data["id"] . "\",350,150);'><img src='../images/icon/up_pdf.png' height='28px' style='padding-right:10px;' title='Upload PDF File'></a> 
            <a href='../" . $data["paperfile1"] . "' target='_blank'><img src='../images/icon/down_pdf.jpg' height='28px'  style='padding-right:10px;' title='Download PDF File'></a>                       
            <a href='javascript:void(0)' onclick='popupwindow(\"upload_file.php?id=" . $data["id"] . "\",350,150);'><img src='../images/icon/up_word.png' height='28px'  style='padding-right:10px;' title='Upload WORD File'></a>";
            if ($data["word_format"] == "NULL")
                echo "<a href='../" . $data["paperfile1"] . "' target='_blank'><img src='../images/icon/down_word.ico' title='Download WORD File' style='padding-right:10px;' height='28px' ></a>";
            else echo "<a href='../" . $data["word_format"] . "' target='_blank'><img src='../images/icon/down_word.ico' title='Download WORD File' style='padding-right:10px;' height='28px' ></a>";
            echo "<a href='index.php?page=accepted_paper_detail&process=publishing&m_id=12&rnb=2&p_id=" . $data["id"] . "'><img src='../images/icon/edit.ico' title='Edit Paper' style='padding-right:10px;' height='28px' ></a>
            <a href='index.php?page=accepted_paper_detail&process=publish&m_id=12&rnb=2&p_id=" . $data["id"] . "'><img src='../images/icon/accept.jpg' height='28px'  style='padding-right:10px;' title='Publish'></a>
            </td>";


            echo "</tr>";

        }
    }
    echo "</tbody>
        </table>";

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

