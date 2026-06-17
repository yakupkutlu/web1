<?php
if (yetki_kontrol($role_number, "comment_request")) {
    include("../app/connect.php");
//include("../system.php");

    echo "<center><a class='btn btn-round btn-warning inbox-title'>ACCEPTED REVIEW REQUESTS</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th>Manuscript Code</th>
                <th>Manuscript Title</th>
                <th>Reviewer Accepted Date</th>
                <th>Reviewer End Date</th>
                <th>Authors</th>
                <th style='text-align: center'>View</th>
				<th style='text-align: center'>Review</th>
            </tr>
            </thead>
            <tbody>";
    $user_id = mysqli_fetch_object(mysqli_query($baglanti,"select * from users where user_name='$user_name'"))->id;

//if ($query = mysqli_query($baglanti,"select * from review_requests where reviewerid='$user_id' and review_status=1 and acceptance_status=-1")) 

    if ($query = mysqli_query($baglanti,"select * from review_requests where reviewerid='$user_id' and acceptance_status=-1")) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            $rPaperID = $data["paperid"];
			$review_status = $data["review_status"];
            if($rPaperQuery = mysqli_fetch_object(mysqli_query($baglanti,"select * from submission_list where id='$rPaperID' and accept_status=-1 ")))
            
            {
            
            
            echo "<tr>";
            echo "<td>" . $rPaperQuery->paperID . "</td>";
            echo "<td>" . $rPaperQuery->title . "</td>";
            echo "<td>" . $data['request_date'] . "</td>";
            $enddate = strtotime('21 day',strtotime($data['request_date']));
            $enddate = date('Y-m-d' ,$enddate );
            echo "<td>" . $enddate . "</td>";
            echo "<td>" . $rPaperQuery->authors . "</td>";
            echo "<td align='center'>
<a href='javascript:void(0)' onclick='popupwindow(\"show_paper.php?id=" . $rPaperQuery->id . "\",600,700);'><i class=\"fa fa-search\" style='padding-right:10px;'></i></a>
<a href='../" . $rPaperQuery->paperfile1 . "'><i class=\"fa fa-download\" style='padding-right:10px;'></i></a>
</td>";
             if ($review_status==1){
								 echo "<td align='center'>
					 <a href='index.php?page=review_add_comment&rnb=3&m_id=15&id=" . $data["id"] . "'><i class=\"fa fa-edit fa-2xs\"></i></a>
			 </td>"; }
else{
	
	     echo "<td align='center'>
<a class='btn btn-round btn-success inbox-title' style='color:green' href='my_request_comment.php?process=1&id=" . $data['id'] . "'>  Accept </a>
<a style='color:white' href='my_request_comment.php?process=0&id=" . $data['id'] . "' class='btn btn-round btn-danger inbox-title'>Reject</a>  
</td>";
}			 
		   echo "</tr>";}

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

