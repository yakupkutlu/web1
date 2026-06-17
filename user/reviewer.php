<?php
if (yetki_kontrol($role_number, "reviewer")) {
    include("../app/connect.php");
//include("../system.php");
$science=$_GET['science'];

    echo "<center><a class='btn btn-round btn-warning inbox-title'>Under Reviewer INBOX</a></center>
<br><br><center>";

  /*

		  echo "<center><a class='btn btn-round btn-warning inbox-title'>Under Reviewer INBOX</a></center>
		<br><br><center>

		<a href='../user/index.php?page=reviewer&m_id=7&rnb=2&science='  class='btn btn-round btn-success inbox-title'> 
		<img src='../images/icon_all.png' width='30' height='30'>All Sciences</a>  
		 <a href='../user/index.php?page=reviewer&m_id=7&rnb=2&science=engineering' class='btn btn-round btn-warning inbox-title'><img src='../images/icon_engineering.png' width='30' height='30'> Engineering Sciences</a>   
		<a href='../user/index.php?page=reviewer&m_id=7&rnb=2&science=natural'  class='btn btn-round btn-warning inbox-title'> <img src='../images/icon_natural.png' width='30' height='30'>  Natural Sciences</a></center>";
		
		     <th style='vertical-align:inherit '>Science</th>
		*/
      echo "   <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th style='vertical-align:inherit '>ID</th>
                <th style='vertical-align:inherit '>Name and Surname</th>
           
                <th style='vertical-align:inherit '>Paper's Title</th>
                <th style='vertical-align:inherit '>PaperID</th>
                <th style='text-align: center ; vertical-align:inherit'>Detail</th>
                <th style='text-align: center; vertical-align:inherit'>Reviewer Decisions <br>
                <font color='black'>Sent</font> / <font color='green'>Accepted</font> / <font color='blue'>Reviewed</font></th>
            </tr>
            </thead>
            <tbody>";


if ($science=="engineering"){
    $My_query="select * from submission_list where accept=0 and revision_status=0 and reviever_state=1 and accept_status=-1 and workarea='Engineering Science' ;";
 
}
elseif ($science=="natural"){
    $My_query="select * from submission_list where accept=0 and revision_status=0 and reviever_state=1 and accept_status=-1 and workarea='Natural Science' ;";
 
}
else{
 
    $My_query="select * from submission_list where accept=0 and revision_status=0 and reviever_state=1 and accept_status=-1;";
}






    if ($query = mysqli_query($baglanti,$My_query)) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $sira . "</td>";
            $sira += 1;
            if ($data["authors"] != "")
                echo "<td>" . $data["authors"] . "</td>";
            else echo "<td>" . $data["name_surname"] . "</td>";
           // echo "<td>" . $data["workarea"] . "</td>";
            echo "<td>" . $data["title"] . "</td>";
            echo "<td>" . $data["paperID"] . "</td>";
            echo "<td align='center'>
<a href='../" . $data["paperfile1"] . "' target='_blank'><i title='Dosya İndir' class=\"fa fa-download\" style='padding-right:10px;'></i></a>
<a href='javascript:void(0)' onclick='popupwindow(\"show_paper_review_detail.php?id=" . $data["id"] . "\",600,700);'><i class=\"fa fa-search\" style='padding-right:10px;'></i></a>
<a href='index.php?page=process&process=send_review&m_id=7&rnb=2&id=" . $data["id"] . "'><i title='Hakeme Gönder' class=\"fa fa-share\"></i></a>
<a href='index.php?page=accepted&m_id=6&rnb=2&m_id=7&paper_id=" . $data["id"] . "'><i title='Decision' class=\"fa fa-check-circle\" style='padding-right:10px;'></i></a>
</td>";
            $p_id = $data["id"];
            $rRequest = mysqli_fetch_object(mysqli_query($baglanti,"select count(id) as sayi from review_requests where paperid='$p_id' and (review_status=-1 or review_status=1) and state=1"))->sayi;
            $rAccept = mysqli_fetch_object(mysqli_query($baglanti,"select count(id) as sayi from review_requests where paperid='$p_id' and review_status=1 and state=1"))->sayi;
            $rReviewed = mysqli_fetch_object(mysqli_query($baglanti,"select count(id) as sayi from review_requests where paperid='$p_id' and acceptance_status!=-1 and review_status=1 and state=1"))->sayi;
            echo "<td align='center'><b><font color='black'> " . $rRequest . "</font> / <font color='green'>" . $rAccept . "</font>  / <font color='blue'> " . $rReviewed . "</font></b><br>
			<a href='javascript:void(0)' onclick='popupwindow(\"review_request_acceptance_detail.php?id=" . $data["id"] . "\",600,700);'><i class=\"fa fa-search\" style='padding-right:10px;'></i></a></td>";
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

