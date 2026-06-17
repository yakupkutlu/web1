<?php
include("../app/connect.php");

if (yetki_kontrol($role_number, "edit_menu")) {
   
   

    
    
            echo "<div class='formBody'>";
	 
	     //  SUPPLEMENTARY yayınları sırayla dahil ETMEK için

        echo "</div>";
    


echo "<br><hr>";







     echo "<a href='index.php?page=new_eventpage&m_id=42&rnb=1' class='btn btn-round btn-danger inbox-title'>Add New Supplement</a>"; 

    echo "<center><a class='btn btn-round btn-warning inbox-title'>Supplements List</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th style='width: 5%;'>ID</th>
                <th style='width: 5%;'>year</th>
 			
                <th style='width: 50%;'>Event Name</th>
                <th style='width: 20%;'>published paper IDs</th>
                <th style='width: 5%;'>Type of Paper</th>
               	<th style='width: 10%;'>Process</th>
                
            </tr>
            </thead>
            <tbody>";

    if ($query = mysqli_query($baglanti,"select * from supplementary_events where 1 order by year desc ")) {
        $sira = 1;
   //INSERT INTO `supplementary_events`(`id`, `event_short_name`, `event_cite_name`, `suplementary_name`, `supplamentTittle`, `SupplementNo`, `published_paperIDs`, `yayin_turu`, `year`, `volume`, `no`, `date`)  
            while ($data = mysqli_fetch_array($query)) {
			$id = $data["id"];	
            $year = $data["year"];
            $volume = $data["volume"];
            $no = $data["no"];
            $supplamentTittle = $data["supplamentTittle"];            
            $published_paperID = $data["published_paperIDs"];
            $yayin_turu = $data["yayin_turu"];
            

            echo "<tr>";
            echo "<td style='width: 5%'>" . $sira . "</td>";
            $sira += 1;
            echo "<td style='width: 5%'> " . $year . "</td>";
            echo "<td style='text-align: left; width: 50%'>" . $supplamentTittle."</td>";
            echo "<td style='text-align: left;width: 20%'> " . $published_paperID." </td>";
            echo "<td style='text-align: left;width: 5%'>";
            
            if($yayin_turu==3) 
             echo "Abstract";
            elseif($yayin_turu==2) 
          	 echo "Article";
            else 
              echo "Book</td>";
             
              echo "<td style='width: 10%'>"; 
              
					echo "<a href='index.php?page=new_eventpage&m_id=42&rnb=1&e_id=$id'> <strong>  Edit Event</strong> </a></td>";
           
            
            
            
            
            
            
					//upload pdf
					//download pdf
					//upload word
					//download word
					// show detail
           /* echo "<td align='center'>
            <a href='javascript:void(0)' onclick='popupwindow(\"upload_coverfile.php?process=coverpdf&id=" . $data["id"] . "\",500,250);'><img src='../images/icon/up_pdf.png' height='28px' style='padding-right:10px;' title='Upload PDF File'></a> 
           
            <a href='javascript:void(0)' onclick='popupwindow(\"upload_coverfile.php?process=matterpdf&id=" . $data["id"] . "\",500,250);'><img src='../images/icon/up_pdf.png' height='28px' style='padding-right:10px;' title='Upload PDF File'></a> 
           
             <a href='javascript:void(0)' onclick='popupwindow(\"upload_coverfile.php?process=tableofpdf&id=" . $data["id"] . "\",500,250);'><img src='../images/icon/up_pdf.png' height='28px' style='padding-right:10px;' title='Upload PDF File'></a> 
           
           
            </td>";
            */

            echo "</tr>";

        }
    }


    echo "</tbody>  </table>";

 
 
 
 echo "<br><hr><hr>";

?>


<script>
    function popupwindow(url, w, h) {
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        return window.open(url, null, 'toolbar=no, location=no,resizable=1, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
</script>


<?php

echo "<br><hr>";


    echo "<center><a class='btn btn-round btn-warning inbox-title'>Publishing Paper List  </a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th style='width: 5%;'>ID</th>
                <th style='width: 55%;'>Paper's Detail</th>
 					<th style='width: 10%;'>Paper  ID </th>
            </tr>
            </thead>
            <tbody>";

    if ($query = mysqli_query($baglanti,"select * from submission_list where accept=1 and publish=-1 and publish_status=0 ")) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            $title = $data["title"];
            $authors = $data["authors"];
            $pp = $data["pp"];
            $id = $data["id"];

            echo "<tr>";
            echo "<td>" . $sira . "</td>";
            $sira += 1;
            echo "<td style='width: 55%'><strong>" . $title . "</br>" . $authors . "</strong></td>";
            echo "<td style='width: 10%'>" . $id. "</td>";
					//upload pdf
					//download pdf
					//upload word
					//download word
					// show detail
    

            echo "</tr>";

        }
    }


    echo "</tbody>
        </table></br>   
        
        <hr></br>   
        
       ";




} else header("Refresh:0;  URL = 404.php ");
?>