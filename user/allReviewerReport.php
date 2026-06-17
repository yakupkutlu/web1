
<?php

$sql_str = "SELECT * FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1 GROUP BY `year`,`volume`,`no` ORDER BY `year` DESC, `volume` DESC, `no` DESC";
$query = mysqli_query($baglanti,$sql_str);
if ($query) {
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        echo "<div class='formBody'>";
        $yearTitle = 0;
        while ($tmp = mysqli_fetch_array($query)) {
            $volume = $tmp["volume"];
            $no = $tmp["no"];
            $year = $tmp["year"];

            if($year != $yearTitle){
                echo "<center><a class='btn btn-round btn-info inbox-title'>".$year."</a></center><br>";
                $yearTitle = $year;
            }
            echo "<center><a href='index.php?page=reviewReport&m_id=35&rnb=2&volume=$volume&no=$no&year=$year'>";
            echo "<input type='button' class='btn  btn-success' value='Volume.$volume&nbsp;-&nbsp;No.$no&nbsp;-&nbsp;$year'><br>";
            echo "</a></center>";
        }
        echo "<br><br></div>";
    }
}
?>