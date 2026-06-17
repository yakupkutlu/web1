<?php
if (yetki_kontrol($role_number, "submission")) {
    include("../app/connect.php");
//include("../system.php");
$science=$_GET['science'];
 


echo "<center><a class='btn btn-round btn-warning inbox-title'>Submision INBOX</a></center>
     <br><br><center>";
	 
    /*echo "<center><a class='btn btn-round btn-warning inbox-title'>Submision INBOX</a></center>
     <br><br><center><a href='../user/index.php?page=submission&m_id=5&rnb=2&science='  class='btn btn-round btn-success inbox-title'> <img src='../images/icon_all.png' width='30' height='30'>All Sciences</a>   <a href='../user/index.php?page=submission&m_id=5&rnb=2&science=engineering' class='btn btn-round btn-warning inbox-title'><img src='../images/icon_engineering.png' width='30' height='30'> Engineering Sciences</a>   <a href='../user/index.php?page=submission&m_id=5&rnb=2&science=natural'  class='btn btn-round btn-warning inbox-title'> <img src='../images/icon_natural.png' width='30' height='30'>  Natural Sciences</a></center>";
	  <th>Science</th>
	 */
	 
  echo "<table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th>ID</th>
                <th>Name and Surname</th>
               
                <th>Paper's Title</th>
                <th>PaperID</th>
                <th>Upload Date</th>
                <th style='text-align: center'>Process</th>
            </tr>
            </thead>
            <tbody>";


if ($science=="engineering"){
    $My_query="select * from submission_list where accept=0 and revision_status=0 and reviever_state=0 and accept_status=-1 and workarea='Engineering Science' ;";
 
}
elseif ($science=="natural"){
    $My_query="select * from submission_list where accept=0 and revision_status=0 and reviever_state=0 and accept_status=-1 and workarea='Natural Science' ;";
 
}
else{

    $My_query="select * from submission_list where accept=0 and revision_status=0 and reviever_state=0 and accept_status=-1;";
}



    if ($query = mysqli_query($baglanti,$My_query)) {// accept_status!=-2
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $sira . "</td>";
            $sira += 1;
            echo "<td>" . $data["authors"] . "</td>";
            //echo "<td>" . $data["workarea"] . "</td>";
            echo "<td>" .$data["title"] . "</td>";
            echo "<td>" .$data["paperID"] . "</td>";
            if ($data["date_time"] == "0000-00-00 00:00:00") echo "<td>" . $data["date"] . "</td>";
            else echo "<td>" . $data["date_time"] . "</td>";
            if ($data["revised_number"] == 0) {
                echo "<td align='center'>
            <a href='javascript:void(0)' onclick='popupwindow(\"show_paper.php?id=" . $data["id"] . "\",600,700);'><i title='Detail' class=\"fa fa-search\" style='padding-right:10px;'></i></a>
            <a href='../" . $data["paperfile1"] . "' target='_blank'><i title='Download' class=\"fa fa-download\" style='padding-right:10px;'></i></a>
            <a href='index.php?page=process&process=send_back_author&rnb=2&m_id=5&id=" . $data["id"] . "'><i title='Send Back' class=\"fa fa-reply\"></i></a>
            <a href='index.php?page=process&process=send_review&rnb=2&m_id=5&id=" . $data["id"] . "'><i title='Send to Reviewer' class=\"fa fa-share\"></i></a>            
 				<a href='index.php?page=process&process=add_similarityrate&rnb=2&m_id=5&id=" . $data["id"] . "'><i title='Add Similarity Rate' class=\"fa fa-tachometer\"  ></i> </a> 
         
                           
            </td>";
            } else {
                echo "<td align='center'>
            <a href='javascript:void(0)' onclick='popupwindow(\"show_paper.php?id=" . $data["id"] . "\",600,700);'><i title='Detail' class=\"fa fa-search\" style='padding-right:10px;'></i></a>
            <a href='javascript:void(0)' onclick='popupwindow(\"show_revision.php?id=" . $data["id"] . "\",600,700);'><i title='Download' class=\"fa fa-download\" style='padding-right:10px;'></i></a>
            <a href='index.php?page=process&process=send_back_author&rnb=2&m_id=5&id=" . $data["id"] . "'><i title='Send Back' class=\"fa fa-reply\"></i></a>
            <a href='index.php?page=process&process=send_review&m_id=5&rnb=2&id=" . $data["id"] . "'><i title='Send to Reviewer' class=\"fa fa-share\"></i></a>
            </td>";
            }
            echo "</tr>";

        }
    }
    echo "</tbody>
        </table>";
} else header("Refresh:0;  URL = 404.php ");
?>


<script>
    function popupwindow(url, w, h) {
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        return window.open(url, null, 'toolbar=no, location=no,resizable=0, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
</script>

