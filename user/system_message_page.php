<?php
include("../app/connect.php");
$user_name=$_SESSION["user"];

echo "<table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th>#</th>
               <th>Date</th>
               <th>From</th>
               <th>E-Mail</th>
               <th>Subject</th>
               <th>Mesage</th>
               <th>Process</th>
            </tr>
            </thead>
            <tbody>";

if ($query = mysqli_query($baglanti, "select * from contact where state=0  ORDER BY `date` DESC ")) {
    $sira = 1;
    while ($data = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>" . $sira . "</td>";
        $sira += 1;
        echo "<td>" . $data["date"] . "</td>";
        echo "<td>" . $data["name_surname"] . "</td>";
        echo "<td>" . $data["email"] . "</td>";
        echo "<td>" . $data["subject"] . "</td>";
        echo "<td>" . $data["message"] . "</td>";
		echo "<td style='text-align: center;'><a href='delete_message.php?page=systemm&id=".$data["id"]."'><i class=\"fa fa-trash-o\" aria-hidden=\"true\" title='Delete Message'></i></td></a>";
       
        echo "</tr>";

    }
}
echo "</tbody>
        </table>";

?>

