<?php
if (yetki_kontrol($role_number, "rejected")) {
include("../app/connect.php");
//include("../system.php");

echo "<center><a class='btn btn-round btn-warning inbox-title'>Rejected INBOX</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th>ID</th>
                <th>Name and Surname</th>
                <th>E-Mail</th>
                <th>Paper's Title</th>
                <th>PaperID</th>
                <th style='text-align: center'>Detail</th>
            </tr>
            </thead>
            <tbody>";

if ($query = mysqli_query($baglanti,"select * from submission_list where accept=0 and accept_status=0;")) {
    $sira = 1;
    while ($data = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>" . $sira . "</td>";
        $sira += 1;
        if ($data["authors"] != "")
            echo "<td>" . $data["authors"] . "</td>";
        else echo "<td>" . $data["name_surname"] . "</td>";
        echo "<td>" . $data["email"] . "</td>";
        echo "<td>" . $data["title"] . "</td>";
        echo "<td>" . $data["paperID"] . "</td>";
        echo "<td align='center'>
<a href='../" . $data["paperfile1"] . "' target='_blank'><i title='Dosya İndir' class=\"fa fa-download\" style='padding-right:10px;'></i></a>
<a href='javascript:void(0)' onclick='popupwindow(\"show_paper_review_detail.php?id=".$data["id"]."\",600,700);'><i class=\"fa fa-search\" style='padding-right:10px;'></i></a>
</td>";
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

