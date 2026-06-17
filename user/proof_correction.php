
<?php
if (yetki_kontrol($role_number, "proof_correction")) {
    include("../app/connect.php");
    $user_name = $_SESSION["user"];

    echo "<center><a class='btn btn-round btn-warning inbox-title'>PROOF CORRECTION</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
                <th>No</th>
                <th>Manuscript No</th>
                <th>Manuscript Title</th>
                <th>Editor's Message</th>
                <th>Process</th>
                
            </tr>
            </thead>
            <tbody>";

    if ($query = mysqli_query($baglanti,"select * from submission_list where user_name='$user_name' AND publish_status=1 and proof_state=0 ;")) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $sira . "</td>";
            $sira += 1;
            echo "<td>" . $data["paperID"] . "</td>";
            echo "<td>" . $data["title"] . "</td>";
            echo "<td>" . $data["msg_proof_author"] . "</td>";
            echo "<td align='center'>
            <a href='../" . $data["paperfile1"] . "' target='_blank'><img src='../images/icon/down_pdf.jpg' height='28px'  style='padding-right:10px;' title='Download PDF File'></a>           
            <a href='index.php?page=proof_correction_page&m_id=20&rnb=4&id=" . $data['id'] . "'><img src='../images/icon/forms-icon.png' title='Edit Paper' style='padding-right:10px;' height='28px' ></a>
              </td>";
            echo "</tr>";

        }
    }
    echo "</tbody>
        </table>";
} else header("Refresh:0;  URL = 404.php ");