
<?php
if (yetki_kontrol($role_number, "author_revision")) {
    include("../app/connect.php");
    $user_name = $_SESSION["user"];

    echo "<center><a class='btn btn-round btn-warning inbox-title'>PAPERS UNDER REVISION</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
                <th>No</th>
                <th>Manuscript No</th>
                <th>Manuscript Title</th>
                <th>Update Date</th>
                <th>Process</th>
                
            </tr>
            </thead>
            <tbody>";

    if ($query = mysqli_query($baglanti,"select * from submission_list where user_name='$user_name' AND revision_status=1;")) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $sira . "</td>";
            $sira += 1;
            echo "<td>" . $data["paperID"] . "</td>";
            echo "<td>" . $data["title"] . "</td>";
            echo "<td>" . $data["date"] . "</td>";
            echo "<td align='center'>
                <a href='javascript:void(0)' onclick='popupwindow(\"show_reviewers_detail.php?id=" . $data["id"] . "\",600,700);'><img src='../images/icon/detail.png' height='28px'  style='padding-right:10px;' title='Detail'></a>
                <a href='index.php?page=add_revision_page&m_id=23&rnb=4&id=" . $data['id'] . "'><img src='../images/icon/add_paper.ico'  height='28px'  style='padding-right:10px;' title='Add Revised Paper'></a>
              </td>";
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