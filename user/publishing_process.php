<?php
include("../app/connect.php");
//include("../system.php");
if (yetki_kontrol($role_number, "publishing_process")) {
    echo "<center><a class='btn btn-round btn-warning inbox-title'>Publishing Process INBOX</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th>ID</th>
                <th>Name and Surname</th>
                <th>Paper's Title</th>
                <th>Message From The Author</th>
                <th style='text-align: center'>Process</th>
                <th>State</th>
            </tr>
            </thead>
            <tbody>";

    if ($query = mysqli_query($baglanti,"select * from submission_list where accept=1 and publish=0 and (publish_status=1 or publish_status=2) ")) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $sira . "</td>";
            $sira += 1;
            if ($data["authors"] != "")
                echo "<td>" . $data["authors"] . "</td>";
            else echo "<td>" . $data["name_surname"] . "</td>";
            echo "<td>" . $data["title"] . "</td>";
            echo "<td>" . $data["msg_publishing"] . "</td>";
            echo "<td align='center'>
            <a href='javascript:void(0)' onclick='popupwindow(\"show_paper.php?id=" . $data["id"] . "\",600,700);'><i title='Detail' class=\"fa fa-search\" style='padding-right:10px;'></i></a>
            <a href='../" . $data["paperfile1"] . "' target='_blank'><i title='Download' class=\"fa fa-download\" style='padding-right:10px;'></i></a>
            <a href='index.php?page=accepted_paper_detail&m_id=11&rnb=2&p_id=" . $data["id"] . "'><i title='Publish' class=\"fa fa-check-circle\" style='padding-right:10px;'></i></a>
            </td>";
            if ($data["publish_status"] ==1 )
            echo "<td align='center'><font color='red'>Yazar Onayı Bekleniyor</font>
            </td>";
            if ($data["publish_status"] ==2 )
                echo "<td align='center'><font color='green'>Onaylandı</font>
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

