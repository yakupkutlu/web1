<?php
include("../app/connect.php");
 
if (yetki_kontrol($role_number, "edit_menu")) {
    echo "<div class='clearfix'>";
    echo "<h4><strong>MENU PAGE'S CONTENT SETTINGS</strong></h4>";
    echo "<hr>";

    echo "<ul class='nav edit-menu'>";
    $query=mysqli_query($baglanti,"SELECT * FROM static_content WHERE state=1");
    while ($data = mysqli_fetch_array($query)) {
       // echo "<li><a href='index.php?page=edit_page&m_id=$m_id&edit_page=$data[page_name]'><i class=\"fa fa-arrow-circle-right\"></i>  &nbsp&nbsp$data[menu_name]</a></li>";
    }
    echo "</ul>";
    echo "</div>";
    


	 
 echo "   <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th style='vertical-align:inherit '>ID</th>
			   
                <th style='vertical-align:inherit '>Menu  Title</th>
				<th style='vertical-align:inherit '>link Page Name</th>
                <th style='vertical-align:inherit '>Son Guncelleme Tarihi</th>
                <th style='text-align: center ; vertical-align:inherit'>Process</th>
                 
                 
            </tr>
            </thead>
            <tbody>";



    $My_query="SELECT * FROM static_content WHERE state=1";
	
    if ($query = mysqli_query($baglanti,$My_query)) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
             $p_id = $data["id"];
			echo "<tr>";
            echo "<td>" . $sira . "</td>";
            echo "<td>" . $data[menu_name] . "</td>";        
            echo "<td>" .$data[page_name] ." - ( id:".$p_id. " )</td>";             
            echo "<td>" .$data[guncellemeTarihi] . "</td>";
            echo "<td align='center'>
<a href='index.php?page=edit_page&m_id=$m_id&edit_page=$data[page_name]'><i title='Dosya İndir' class=\"fa fa-edit\" style='padding-right:10px;'></i></a>

<a href='javascript:void(0)' onclick='popupwindow(\"show_menu_content.php?id=" . $data["id"] . "\",600,700);'><i class=\"fa fa-search\" style='padding-right:10px;'></i></a>
</td>";
            
            echo "</tr>";
			$sira++;
        }
    }
    echo "</tbody>
        </table>";	 
   



} 
else 
	 header("Refresh:0;  URL = 404.php ");
?>


 