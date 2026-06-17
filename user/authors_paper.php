<?php
if (yetki_kontrol($role_number, "authors_paper")) {
    include("../app/connect.php");
    $user_name = $_SESSION["user"];

    echo "<center><a class='btn btn-round btn-warning inbox-title'>PAPER LIST</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
                <th>No</th>
                <th>Manuscript No</th>
                <th>Manuscript Title</th>
                <th>Update Date</th>
                <th>Status</th>
                <th>Detail</th>
                
            </tr>
            </thead>
            <tbody>";
	
	// ESKİ $query = mysqli_query($baglanti,"select * from submission_list where user_name='$user_name';")
	/* YENİSİ 8.5.2017 */
    if ($query = mysqli_query($baglanti,"select * from submission_list where email='$user_name';")) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $sira . "</td>";
            $sira += 1;
            echo "<td>" . $data["paperID"] . "</td>";
            echo "<td>" . $data["title"] . "</td>";
            if ($data["date_time"] == "0000-00-00 00:00:00")
                echo "<td>" . $data["date"] . "</td>";
            else echo "<td>" . $data["date_time"] . "</td>";
            if ($data["reviever_state"] == 0) $state = "In Editor";
            if ($data["accept_status"] == -3) $state = "<a href='index.php?page=editorial_correction&m_id=21&rnb=4'>Editorial Correction Requested &nbsp;&nbsp;&nbsp;&nbsp;<i class=\"fa fa-sign-out\" title='Editorial Correction Requested' aria-hidden=\"true\"></i></a> ";
            if ($data["reviever_state"] == 1 && $data["accept_status"] == -1) $state = "Under Review";
            if ($data["accept_status"] == 0) $state = "Rejected";
            if ($data["accept_status"] == 2 || $data["accept_status"] == 3 || $data["accept_status"] == 4) $state = "<a href='index.php?page=author_revision&m_id=24&rnb=4'><label style='color: red'>Revision Required &nbsp;&nbsp;&nbsp;&nbsp;</label><i class=\"fa fa-sign-out\" title='Revision Required' aria-hidden=\"true\"></i></a> ";
            if ($data["accept"] == 1 && $data["publish"] == 0 && $data["publish_status"] == 0) $state = "Your Paper is Accepted";
            if (($data["accept"] == 1 && $data["publish"] == -1) || ($data["accept"] == 1 && $data["publish"] == -1 && $data["proof_state"] == 1 ) ) $state = "Under Publishing";
            if ($data["accept"] == 1 && $data["publish_status"] == 1 && $data["proof_state"] == 0 ) $state = "<a href='index.php?page=proof_correction&m_id=25&rnb=4'>Proof Correction &nbsp;&nbsp;&nbsp;&nbsp;<i class=\"fa fa-sign-out\" title='Proof Correction' aria-hidden=\"true\"></i></a>";
            if ($data["accept"] == 1 && $data["publish"] == 1) $state = "Published";
            echo "<td>" . $state . "</td>";
            echo "<td align='center'>
            <a href='javascript:void(0)' onclick='popupwindow(\"show_reviewers_detail.php?id=" . $data["id"] . "\",600,700);'><img src='../images/icon/detail.png'  height='28px'  style='padding-right:10px;' title='Detail'></a>";
            
             if ($data["accept"] == 1 && $data["publish"] == 0 && $data["publish_status"] == 0){
              echo " <a href='javascript:void(0)' onclick='popupwindow(\"show_accepted_page.php?paperid=" . $data["id"] . "\",600,700);'><img src='../images/icon/accepted.png'  height='28px'  style='padding-right:10px;' title='Accepted'></a>";
             
             }
            
            
            echo "</td>";

            echo "</tr>";

        }
    }
    echo "</tbody>
        </table>";

    echo "<script>
    function popupwindow(url, w, h) {
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        return window.open(url, null, 'toolbar=no, location=no,resizable=0, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
</script>";
} else header("Refresh:0;  URL = 404.php ");