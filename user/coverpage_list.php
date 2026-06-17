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


     echo "<a href='index.php?page=new_coverpage&m_id=12&rnb=2' class='btn btn-round btn-danger inbox-title'>Add New Issue</a>"; 

    echo "<center><a class='btn btn-round btn-warning inbox-title'>Cover Page List</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th style='width: 5%;'>ID</th>
                <th style='width: 5%;'>year</th>
 				<th style='width: 5%;'>volume</th>
                <th style='width: 5%'>no</th>
                <th style='width: 20%;'>Cover</th>
                <th style='width: 20%;'>Front matter</th>
                <th style='width: 20%;'>Table of contents</th>
                
            </tr>
            </thead>
            <tbody>";

    if ($query = mysqli_query($baglanti,"select * from cover_files_path where 1 order by id desc ")) {
        $sira = 1;
        //INSERT INTO `cover_files_path`(`id`, `year`, `volume`, `no`, `cover`, `front_matter`, `table_of_contents`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7])while ($data = mysqli_fetch_array($query)) {
            while ($data = mysqli_fetch_array($query)) {
			$id = $data["id"];	
            $year = $data["year"];
            $volume = $data["volume"];
            $no = $data["no"];
            $cover = $data["cover"];            
            $front_matter = $data["front_matter"];
            $table_of_contents = $data["table_of_contents"];
            

            echo "<tr>";
            echo "<td style='width: 5%'>" . $sira . "</td>";
            $sira += 1;
            echo "<td style='width: 5%'> " . $year . "</td>";
            echo "<td style='width: 5%'>" . $volume . "</td>";
            echo "<td style='width: 5%'> " . $no . "</td>";
            echo "<td style='text-align: left; width: 20%'>" . $cover . " &nbsp; | &nbsp; <a href='javascript:void(0)' onclick='popupwindow(\"upload_coverfile.php?process=coverpdf&id=" . $data["id"] . "\",500,250);'><img src='../images/icon/up_pdf.png' height='28px' style='padding-right:10px;' title='Upload PDF File'></a> 
           
             </td>";
            echo "<td style='text-align: left;width: 20%'> " . $front_matter . " &nbsp; &nbsp; | &nbsp; <a href='javascript:void(0)' onclick='popupwindow(\"upload_coverfile.php?process=matterpdf&id=" . $data["id"] . "\",500,250);'><img src='../images/icon/up_pdf.png' height='28px' style='padding-right:10px;' title='Upload PDF File'></a> 
            </td>";
            echo "<td style='text-align: left;width: 20%'>" . $table_of_contents . "  &nbsp; &nbsp;| &nbsp;  <a href='javascript:void(0)' onclick='popupwindow(\"upload_coverfile.php?process=tableofpdf&id=" . $data["id"] . "\",500,250);'><img src='../images/icon/up_pdf.png' height='28px' style='padding-right:10px;' title='Upload PDF File'></a> 
           </td>";
            
            
            
            
            
            
					//upload pdf
					//download pdf
					//upload word
					//download word
					// show detail
           /* echo "<td align='center'>
            <a href='javascript:void(0)' onclick='popupwindow(\"upload_coverfile.php?process=coverpdf&id=" . $data["id"] . "\",500,250);'><img src='../images/icon/up_pdf.png' height='28px' style='padding-right:10px;' title='Upload PDF File'></a> 
           
            <a href='javascript:void(0)' onclick='popupwindow(\"upload_coverfile.php?process=matterpdf&id=" . $data["id"] . "\",500,250);'><img src='../images/icon/up_pdf.png' height='28px' style='padding-right:10px;' title='Upload PDF File'></a> 
           
             <a href='javascript:void(0)' onclick='popupwindow(\"upload_coverfile.php?process=tableofpdf&id=" . $data["id"] . "\",500,250);'><img src='../images/icon/up_pdf.png' height='28px' style='padding-right:10px;' title='Upload PDF File'></a> 
           
           
            </td>";
            */

            echo "</tr>";

        }
    }


    echo "</tbody>
        </table></br>   
        
         
        
       ";

 

} else
    header("Refresh:0;  URL = 404.php ");
?>


<script>
    function popupwindow(url, w, h) {
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        return window.open(url, null, 'toolbar=no, location=no,resizable=1, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
</script>

