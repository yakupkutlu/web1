<?php
if (yetki_kontrol($role_number, "come_revision")) {
    include("../app/connect.php");
//include("../system.php");

    echo "<center><a class='btn btn-round btn-warning inbox-title'>Revised Paper INBOX</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th>ID</th>
                <th>Name and Surname</th>
                <th>E-Mail</th>
                <th>Paper's Title</th>
                <th>PaperID</th>
                <th style='text-align: center'>Process</th>
            </tr>
            </thead>
            <tbody>";

    if ($query = mysqli_query($baglanti,"select * from submission_list where accept=0 and revision_status=0 and accept_status=-2;")) {
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
           // if ($data["revised_number"] == 0) {
                echo "<td align='center'>
            <a href='javascript:void(0)' onclick='popupwindow(\"show_paper_review_detail.php?process=revised&id=" . $data["id"] . "\",600,700);'><i title='Detay' class=\"fa fa-search\" style='padding-right:10px;'></i></a>
            <a href='../" . $data["paperfile1"] . "' target='_blank'><i title='Dosya İndir' class=\"fa fa-download\" style='padding-right:10px;'></i></a>
            <a href='index.php?page=process&process=send_back_author_in_revised&rnb=2&m_id=9&id=" . $data["id"] . "'><i title='Send Back' class=\"fa fa-reply\" style='padding-right:10px;'></i></a>
            <a href='index.php?page=accepted&rnb=2&m_id=9&state=revised&paper_id=" . $data["id"] . "'><i title='Decision' class=\"fa fa-check-circle\" style='padding-right:10px;'></i></a>
            <a href='index.php?page=process&process=send_review&rnb=2&m_id=9&id=" . $data["id"] . "'><i title='Hakeme Gönder' class=\"fa fa-share\"></i></a>
            </td>";
                /*
            }

            else {
                echo "<td align='center'>
            <a href='javascript:void(0)' onclick='popupwindow(\"show_paper.php?id=" . $data["id"] . "\",600,700);'><i title='Detay' class=\"fa fa-search\" style='padding-right:10px;'></i></a>
            <a href='javascript:void(0)' onclick='popupwindow(\"show_revision.php?id=" . $data["id"] . "\",600,700);'><i title='Dosya İndir' class=\"fa fa-download\" style='padding-right:10px;'></i></a>
            <a href='index.php?page=process&process=send_review&rnb=2&m_id=8&id=" . $data["id"] . "'><i title='Hakeme Gönder' class=\"fa fa-share\"></i></a>
            </td>";
            }*/
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

