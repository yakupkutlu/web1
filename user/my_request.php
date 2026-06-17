<?php
if (yetki_kontrol($role_number, "my_request")) {
    include("../app/connect.php");
//include("../system.php");

    echo "<center><a class='btn btn-round btn-warning inbox-title'>REVIEW REQUESTS</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th>Manuscript Code</th>
                <th>Manuscript Title</th>
                <th>Invitation Date</th>
                <th>Authors</th>
                <th style='text-align: center'>Decision</th>
            </tr>
            </thead>
            <tbody>";
    $user_id = mysqli_fetch_object(mysqli_query($baglanti,"select * from users where user_name='$user_name'"))->id;

    if ($query = mysqli_query($baglanti,"select * from review_requests where reviewerid='$user_id' and review_status=-1")) {

        while ($data = mysqli_fetch_array($query)) {
            $rPaperID = $data["paperid"];
            $rPaperQuery = mysqli_fetch_object(mysqli_query($baglanti,"select * from submission_list where id='$rPaperID'; "));

            if (($rPaperQuery->accept == 0) && ($rPaperQuery->revision_status == 0) && ($rPaperQuery->reviever_state == 1) && ($rPaperQuery->accept_status == -1)) {
                echo "<tr>";
                echo "<td>" . $rPaperQuery->paperID . "</td>";
                echo "<td>" . $rPaperQuery->title . "</td>";
                echo "<td>" . $data['request_date'] . "</td>";
                echo "<td>" . $rPaperQuery->authors . "</td>";
                echo "<td align='center'>
<a class='btn btn-round btn-success inbox-title' style='color:green' href='my_request_comment.php?process=1&id=" . $data['id'] . "'>  Accept </a>
<a style='color:white' href='my_request_comment.php?process=0&id=" . $data['id'] . "' class='btn btn-round btn-danger inbox-title'>Reject</a>  
</td>";
                echo "</tr>";
            }
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

