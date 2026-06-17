<?php
if (yetki_kontrol($role_number, "complated_manuscript")) {
    include("../app/connect.php");
//include("../system.php");

    echo "<center><a class='btn btn-round btn-warning inbox-title'>REVIEWED PAPERS</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
                <th>Manuscript Code</th>
                <th>Manuscript Title</th>
                <th>Invitation Date</th>
                <th>Completion Date</th>
                <th>Review Status</th>
                <th style='text-align: center'>Process</th>
            </tr>
            </thead>
            <tbody>";
    $user_id = mysqli_fetch_object(mysqli_query($baglanti,"select * from users where user_name='$user_name'"))->id;

    if ($query = mysqli_query($baglanti,"select * from review_requests where reviewerid='$user_id' and review_status=1 and acceptance_status!=-1")) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            $rPaperID = $data["paperid"];
            $rPaperQuery = mysqli_fetch_object(mysqli_query($baglanti,"select * from submission_list where id='$rPaperID'; "));
            echo "<tr>";
            echo "<td>" . $rPaperQuery->paperID . "</td>";
            echo "<td>" . $rPaperQuery->title . "</td>";
            echo "<td>" . $data['request_date'] . "</td>";
            echo "<td>" . $data['date'] . "</td>";
            echo "<td>Completed</td>";
            echo "<td align='center'>
<a href='javascript:void(0)' onclick='popupwindow(\"show_paper.php?id=" . $rPaperQuery->id . "\",600,700);'><i title='Detay' class=\"fa fa-search\" style='padding-right:10px;'></i></a>
<a target='javascript:void(0)' onclick='popupwindow(\"show_thankspages.php?reviewerid="  . $user_id.  "&paperid=" .  $rPaperID . "\",600,700);'><img src='../images/kurdale.png' width='22' height='22' title='Thanks '></a> 
</td>";
            echo "</tr>";
//<a href='../" . $rPaperQuery->paperfile1 . "'> <i title='Dosya İndir' class=\"fa fa-download\" style='padding-right:10px;'></i></a>
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

