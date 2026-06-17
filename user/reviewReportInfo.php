<?php
include("../app/connect.php");
//include("../system.php");
echo "<div class=\"x_panel\">";
$paperID = $_GET["paperID"];
$sql = "select * from review_requests where paperid='$paperID';";
$title = mysqli_fetch_object(mysqli_query($baglanti,"select title from submission_list where id='$paperID'"))->title;

echo "<center><a class='btn btn-round btn-warning inbox-title'>" . $title . "</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th>ID</th>
                <th>Reviewer's Name Surname</th>
                <th>Report File</th>
                <th>Report File 2</th>
            </tr>
            </thead>
            <tbody>";

if ($query = mysqli_query($baglanti,$sql)) {
    $sira = 1;
    while ($data = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>" . $sira . "</td>";
        $sira += 1;
        $reviewerID=$data["reviewerid"];
        $reviewer=mysqli_fetch_object(mysqli_query($baglanti,"SELECT name_surname FROM users WHERE id='$reviewerID'"))->name_surname;
        echo "<td>" . $reviewer . "</td>";
        if ($data["report_file"] == null || $data["report_file"] == "" || $data["report_file"] == "NULL")
            echo "<td>NOT REPORT FİLE</td>";
        else echo "<td><a href='" . $data["report_file"] . "'> Reviewer's Report File 1</a></td>";
        if ($data["report_file_2"] == null || $data["report_file_2"] == ""|| $data["report_file_2"] == "NULL")
            echo "<td>NOT REPORT FİLE</td>";
        else echo "<td><a href='" . $data["report_file_2"] . "'> Reviewer's Report File 2</a></td>";
        echo "</tr>";

    }
}
echo "</tbody>
        </table>";
echo "</div>";
?>