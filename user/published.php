<?php
if (yetki_kontrol($role_number, "published")) {
    include("../app/connect.php");
//include("../system.php");

   echo "<center><a class='btn btn-round btn-warning inbox-title'>Published INBOX</a></center>";
   echo "<br><a href =index.php?page=published_paper_edit&m_id=13&rnb=2 class='btn btn-dark inbox-title'>Edit Content Paper</a>";
   echo "<table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th>ID</th>
					 <th>Year-Volume-No</th>
                <th>Name and Surname</th>	
                <th>Paper's Title</th>
                <th>PaperID</th>
                <th style='text-align: center'>Cited Count</th>
                <th style='text-align: center'>Detail</th>
            </tr>
            </thead>
            <tbody>";

    if ($query = mysqli_query($baglanti,"select * from submission_list where publish=1;")) {
        $sira = 1;
         $totalcite=0;
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td style='width: 3%'>" . $sira . "</td>";
            $sira += 1;
            
            echo "<td style='width: 7%'>" . $data["year"] ."-". $data["volume"] ."-". $data["no"] . "</td>";
            if ($data["authors"] != "")
                echo "<td style='width: 20%'>" . $data["authors"] . "</td>";
            else echo "<td style='width: 20%'>" . $data["name_surname"] . "</td>";
            echo "<td style='width: 50%'>" . $data["title"] . "</td>";
            echo "<td style='width: 10%'>" . $data["paperID"] . "</td>";
            
            
               // Title'ı kullanarak diğer makalelerin references kısmında kaç kez geçtiğini say
        $title = mysqli_real_escape_string($baglanti, $data["title"]);
        $cited_query = mysqli_query($baglanti, "SELECT COUNT(id) as count FROM submission_list WHERE publish=1 and `references` LIKE '%$title%'");
        $cited_data = mysqli_fetch_assoc($cited_query);
        $cited_count = $cited_data['count'];

        echo "<td align='center' style='width: 5%'>" . $cited_count . "</td>";
          $totalcite +=$cited_count ;
            
            
            echo "<td align='center' style='width: 10%'>
<a href='../" . $data["paperfile1"] . "' target='_blank'><img src='../images/icon/down_pdf.jpg' height='28px'  style='padding-right:10px;' title='Download PDF File'></i></a>
<a href='javascript:void(0)' onclick='popupwindow(\"show_paper_publish_detail.php?id=" . $data["id"] . "\",600,700);'><img src='../images/icon/detail.png' height='28px'  style='padding-right:10px;' title='Detail'></a>
</td>";
            echo "</tr>";

        }
    }
    echo "</tbody>
        </table>";
        echo "<center><a class='btn btn-round btn-warning inbox-title'>Total Self Cite : ".$totalcite."</a></center>";
} else header("Refresh:0;  URL = 404.php ");
?>


<script>
    function popupwindow(url, w, h) {
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        return window.open(url, null, 'toolbar=no, location=no,resizable=0, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
</script>

