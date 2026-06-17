<?php
if (yetki_kontrol($role_number, "deletePaper")) {
    include("../app/connect.php");
//include("../system.php");

    echo "<center><a class='btn btn-round btn-warning inbox-title'>All Paper INBOX</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th style='vertical-align:inherit '>ID</th>
                <th style='vertical-align:inherit '>Name and Surname</th>
                <th style='vertical-align:inherit '>E-Mail</th>
                <th style='vertical-align:inherit '>Paper's Title</th>
                <th style='vertical-align:inherit '>PaperID</th>
                <th style='text-align: center ; vertical-align:inherit'>Process</th>
            </tr>
            </thead>
            <tbody>";

    if ($query = mysqli_query($baglanti,"select * from submission_list  ")) {
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
<a href='index.php?page=deletePaperInfo&m_id=36&rnb=2&paperID=".$data["id"]."' ><i title='Delete Paper' class=\"fa fa-remove\" style='padding-right:10px;'></i></a>
</td>";
            echo "</tr>";

        }
    }
    echo "</tbody>
        </table>";
} else header("Refresh:0;  URL = 404.php ");
?>


