
<style>


 
        /* Style the popup image */
        .popup {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.9);
            justify-content: center;
            align-items: center;
        }

        .popup img {
            max-width: 90%;
            max-height: 90%;
        }
    

/* Close button */
        .close {
            position: absolute;
            top: 20px;
            right: 45px;
            color: #fff;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
        }

    #aramaKutusu {
        width: 238px;
        height: 34px;
        overflow: hidden;
        background: url(images/arama_kutusu.png) no-repeat
    }

    #archive {
        border-style: solid;
        border-width: 2px;
        border-color: #2A3F54;
    }

    #aramaKutusu input {
        width: 193px;
        height: 19px;
        margin: 7px 0 0 7px;
        padding: 0;
        float: left;
        border: none;
        background: #eee;
        font: bold 12px Arial
    }

    #aramaKutusu button {
        width: 25px;
        height: 25px;
        margin: 4px 9px 0 2px;
        float: right;
        text-indent: -9999px;
        border: none;
        background: url(images/btn.png) no-repeat;
        cursor: pointer
    }
    
    
      #tablofont {
       font-size: x-small;
    }

</style>

<?php
@include("app/connect.php");
 



if($page == "earlyview"){
    
    $content_page_sql = mysqli_query($baglanti,"SELECT `year`,`volume`,`no` FROM `submission_list` WHERE `accept` = 1 AND `publish` = -1 AND `earlyview` = 1 GROUP BY `year`,`volume`,`no` ORDER BY `year` DESC, `volume` DESC, `no` DESC LIMIT 1");
 
}
else{
    $content_page_sql = mysqli_query($baglanti,"SELECT `year`,`volume`,`no` FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1 GROUP BY `year`,`volume`,`no` ORDER BY `year` DESC, `volume` DESC, `no` DESC LIMIT 1");
 
}
 
$content_page = mysqli_fetch_array($content_page_sql);

if (isset($content) and $content == 1) {
    $volume = $content_page["volume"];
    $no = $content_page["no"];
    $year = $content_page["year"];
} elseif(isset($_GET["volume"])) {
    $volume = $_GET["volume"];
    $no = $_GET["no"];
    $year = $_GET["year"];
}



if (isset($_GET["aranan"]))
	$aranacak = $_GET["aranan"];

if (isset($_GET["genel_aranan"]))
	$genel_aranan = $_GET["genel_aranan"];


// linkiyle bellirli vol no gelmesi
if ((!isset($aranacak)) && (!isset($genel_aranan))) {
	
	if($page == "content"){	
		$sql_str = "SELECT * FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1 AND `yayin_turu` = 1 AND `year` = $year AND `volume` = $volume AND `no` = $no ORDER BY start_page";
	}elseif($page == "archive"){	
		$sql_str = "SELECT * FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1 AND `yayin_turu` = 1 AND `year` = $year AND `volume` = $volume AND `no` = $no ORDER BY start_page";
	}else{
       $sql_str = "SELECT * FROM `submission_list` WHERE `accept` = 1 AND `publish` = -1  AND `earlyview` = 1 ORDER BY start_page";
	}
 
}

// herhangi yıl içinde aranan
if (isset($aranacak)) {
    $sql_str = "SELECT * FROM `submission_list` WHERE (`accept` = 1 AND `publish` = 1 AND `year` = $year AND `volume` = $volume AND `no` = $no) AND (`title` like '%$aranacak%' OR `name_surname` like '%$aranacak%' OR `authors` like '%$aranacak%')";
}

//arşivde aranan

if (isset($genel_aranan)) {
    $sql_str = "SELECT * FROM `submission_list` WHERE (`accept` = 1 AND `publish` = 1) AND (`title` like '%$genel_aranan%' OR `name_surname` like '%$genel_aranan%' OR `authors` like '%$genel_aranan%')";
}





$query = mysqli_query($baglanti,$sql_str);
if ($query) {
    $count = mysqli_num_rows($query);
	 
    if ($count > 0) {
 
        if (!isset($genel_aranan)) {
            
             
              $adres_gonder="arama.php?page=archive&volume=$volume&no=$no&year=$year";

?>
                  <div class=".col-md-4 .offset-md-4">
                        <div class="position-relative mx-auto" style="max-width: 400px;">
						<form action='<?php echo $adres_gonder; ?>' method='post'>
                     
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Search Title or Author" name="aranan">
                            <button type="submit" name="ara" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Search</button>
						 </form>
                        </div>
                    </div>
					
					
					
							
				<table class="bg-blue2"  width="100%" class="text-center   wow fadeInUp" data-wow-delay="0.3s">
                    <tbody> 
					<tr> 
					    
                        <td class="bg-blue2"     style='padding:10px;margin:10px;color: #FFFFFF;'> 
											                          
                           	
<?php

// liste start	
				   
            echo "				                          
                            
                          <center> <h4 style='  ;color: #FFFFFF;'> Volume :  $volume  &nbsp;|&nbsp; No: $no  &nbsp;|&nbsp;$year</h4>                 
                        </td>
                    </tr>";
                    
// start cover files getir
				
				 // cover files start
				$sorgu = mysqli_query($baglanti,"SELECT * FROM cover_files_path WHERE volume = $volume AND no = $no AND year = $year");
				if(mysqli_num_rows($sorgu)>0){
					$d = mysqli_fetch_array($sorgu);
					$cover = $d["cover"];
					$front_matter = $d["front_matter"];
					$table_of_contents = $d["table_of_contents"];
					
					echo "<tr><td class=\"bg-blue2\"  td width=\"100%\" height=\"1\"  style='color: #FFFFFF;'>";
					echo "&nbsp;&nbsp;<a style='color: #FFFFFF;' target='_blank' href='$cover'>Cover Page</a>";
					echo "&nbsp;&nbsp;|&nbsp;&nbsp;<a style='color: #FFFFFF;' target='_blank' href='$front_matter'>Front Matter</a>";
					echo "&nbsp;&nbsp;|&nbsp;&nbsp;<a style='color: #FFFFFF;' target='_blank' href='$table_of_contents'>Table of Contents</a><br><br>";
					echo "</td></tr>";
				}
				
				/// end cover files 
					
			echo "		
                    </tbody>
                </table>
                <p>&nbsp;</p>";
        } // END: if (!isset($genel_aranan))
        
        
        
  
        
       
 			$result = mysqli_query($baglanti,$sql_str);

        if ((!isset($genel_aranan)) && (!isset($aranacak))) {
             $sira=1;
            while ($tmp = mysqli_fetch_assoc($result)) {
            	
						 
                    
                    yayin_bilgilerini_yaz_2($tmp);
                    $sira++;
              		 
				
            } // END: while(mysqli_fetch_assoc);

 			
                //  SUPPLEMENTARY yayınları sırayla dahil ETMEK için
            $sql_str_sup = "SELECT * FROM `supplementary_events` WHERE  `year` = $year AND `volume` = $volume AND `no` = $no ORDER BY `SupplementNo`";
				$result = mysqli_query($baglanti,$sql_str_sup);
                        
            while ($tmp = mysqli_fetch_assoc($result)) {
                	if($tmp["suplementary_name"]) 
                	{
                		$yturu=$tmp["yayin_turu"];
               	if($yturu==3) {            
          			  $yayintipi=$tmp["SupplementNo"];
        				 }elseif($yturu==2) {            
        				    $yayintipi=$tmp["SupplementNo"];
      			   }elseif($yturu==4) {            
        				  $yayintipi=$tmp["SupplementNo"];
        				 }
            
                
                	echo '<span style=\"font-weight: bold; font-size:14px;\"><center>';
                	// echo 	"SUPPLEMENT of<br>";
	 				//echo $tmp["SupplementNo"]."<br>";
               
                  echo $yayintipi."<br>";
                	//echo $tmp["suplementary_name"];
                	
                	echo '<br></center></span>';
               	
                	 $published_paperID=$tmp["published_paperIDs"];
                	 
                	 if($published_paperID==""){
                	 		$query2 = mysqli_query($baglanti,"SELECT * FROM submission_list WHERE  accept=1 AND publish = 1 AND `year` = $year AND `yayin_turu` = $yturu AND `volume` = $volume AND `no` = $no ORDER BY start_page ASC");
              		 
                	 }else {
                	 		$query2 = mysqli_query($baglanti,"SELECT * FROM submission_list WHERE  `year` = $year  AND `volume` = $volume AND  `id` in ($published_paperID) ORDER BY start_page ASC");
              		 
                	 	
                	 }
                	 
                	 
                	 //	$query2 = mysqli_query($baglanti,"SELECT * FROM submission_list WHERE   `year` = $year AND   `volume` = $volume AND  `id` in ($published_paperID) ORDER BY start_page ASC");
					 $sira=1;
              		  while ($tmp2 = mysqli_fetch_array($query2)) {
								
								yayin_bilgilerini_yaz($tmp2);
							    $sira++;
                		} // END: while(mysqli_fetch_array);
                
               	 } //end  	if($tmp["suplementary_name"]) 
                	
            } // end  while ($tmp = mysqli_fetch_assoc($result)) 
                
                    
          
          
				
        } else {   // else for if ((!isset($genel_aranan)) && (!isset($aranacak))) {
 //  Arama Sonuçları  

												  
?>

							 <div class="job-item p-4 mb-4">
                                <div class="row">
                                    <div class="col">
                                         <div class="row">
										  
										  <div class="col-9">	
										
							  


<?php   
													 
			if (isset($_GET["aranan"])){
					$aranacak = $_GET["aranan"];
					
			echo '<a class="btn btn-primary" href="">   The results of keyword : <b>"'. $aranacak.'" </b> </a>  ';
			}

			if (isset($_GET["genel_aranan"])){
					$genel_aranan = $_GET["genel_aranan"];
					
					 echo '<a class="btn btn-primary" href="">    The results of <b>" '. $genel_aranan.' " </b> </a>  ';
					//echo "<h2>  The results of ".  $genel_aranan."</h2> ";
			}
?>

											</div>  
										 </div>                               
                                    </div>                                    
                                </div>								                                    
                              </div>  


<?php             $sira = 1;
            while ($tmp = mysqli_fetch_array($query)) {
                $title = $tmp["title"];
                /*
				if ($tmp["authors"] == "") { // EGER DIGER YAZARLAR YOK ISE
                    $authors = $tmp["name_surname"];
                } else {  // EGER DIGER YAZARLAR VAR ISE
                    $authors = $tmp["name_surname"] . "*, " . $tmp["authors"];
                }
				*/
                $authors = $tmp["authors"];

                $pp = $tmp["pp"];
                $id = $tmp["id"];
                $view = $tmp["view"];
                $download = $tmp["download"];
                // $cited = $tmp["cited"];
                $sorgu1 = mysqli_query($baglanti,"SELECT * FROM `cited_table` WHERE `sub_id`=$id");
                $cited = @mysqli_num_rows($sorgu1);






// makale listele arama sonucu

                echo "<table class=\" table  wow fadeInUp\" data-wow-delay=\"0.3s\"  width=\"100%\">
                            <tbody    >";
						if($sira%2==1)
                           echo "<tr bgcolor=\"#f4f5ef\" >";
					   else
						    echo "<tr >";
						echo " <td width=\"5%\" rowspan=\"2\"> $sira - #</td>
                                    <td width=\"100%\"><h3>
									<><a href=\"index.php?$id\" target=\"_blank\"> $title</a></h3></td>
                                    <td width=\"5%\"><p> </p></td>
                                </tr>";
						if($sira%2==1)
                           echo "<tr bgcolor=\"#f4f5ef\" >";
					   else
						    echo "<tr >";
						echo "  <td width=\"90%\"><strong>$authors</strong></td>
                                    <td width=\"5%\">
                                      &nbsp;
                                    </td>
                                </tr>
                            </tbody>
                            </table>
                             
                        </br>";
                        // <td width=\"5%\"><a href='index.php?page=cited&authors_id=$id'>Cited : </a></td><td align='left' width=\"10%\"><a href='index.php?page=cited&authors_id=$id'>$cited</a></td>
                                   
                $sira++;

            } // END  while ($tmp = mysqli_fetch_array($query))
        }  // END else



        // Yayın listesi altındaki YEŞİL ÇİZGİ ve GO TO ARCHIEVE butonu
       
        // END: Yayın listesi altındaki YEŞİL ÇİZGİ ve GO TO ARCHIEVE butonu
    } // END: if($count>0)
} // END: if($query)




function yayin_bilgilerini_yaz($tmp)
{   
   global $sira;
	global $baglanti;
    /* Bu fonksiyonda
        # $query = mysqli_query($baglanti,$sql_str);
        komutu ile veritabanına gönderilen ve dönen sonucu parçalanan sorgudan yayınlar ile ilgili bilgiler alınıyor.
        Alınan bilgiler webde "Content" sayfasında ilgili cilt ve sayıdaki yayınları listeliyor.

        Fonksiyon
        # while ($tmp = mysqli_fetch_array($query))
        döngüsü içinde çağrılarak bütün yayınlar yazdırılıyor.
    */
    $title = $tmp["title"];
    /*
    if ($tmp["authors"] == "") { // EGER DIGER YAZARLAR YOK ISE
        $authors = $tmp["name_surname"];
    } else {  // EGER DIGER YAZARLAR VAR ISE
        $authors = $tmp["name_surname"] . "*, " . $tmp["authors"];
    }
    */
    $authors = $tmp["authors"];

    $pp = $tmp["pp"];
    $id = $tmp["id"];
    $view = $tmp["view"];
    $download = $tmp["download"];
    //$cited = $tmp["cited"];
    $sorgu1 = mysqli_query($baglanti,"SELECT * FROM `cited_table` WHERE `sub_id`=$id");
    $cited = @mysqli_num_rows($sorgu1);

  
    echo "<table width=\"90%\">
		<tbody>";
						if($sira%2==1)
                           echo "<tr bgcolor=\"#f4f5ef\" >";
					   else
						    echo "<tr >";
						echo " <td width=\"90%\"><strong><a href=\"index.php?$id\" target=\"_blank\">$title</a></strong></td>
				<td width=\"10%\" rowspan=\"2\"><p>$pp</p></td>
			</tr>";
						if($sira%2==1)
                           echo "<tr bgcolor=\"#f4f5ef\" >";
					   else
						    echo "<tr >";
						echo " 
				<td width=\"90%\"><strong>$authors</strong></td>
			
			</tr>
		</tbody>
		</table>";
						if($sira%2==1)
                           echo "<table width=\"90%\" bgcolor=\"#f4f5ef\" class='istatistik'>";
					   else
						    echo "<table width=\"90%\"   class='istatistik'>";
						echo " 
		
		
		

			<tbody>
				<tr><td width=\"5%\">Viewed : </td><td align='left' width=\"10%\">$view</td>
				<td width=\"5%\">Downloaded : </td><td align='left' width=\"10%\">$download</td>
				<td width=\"5%\"></td><td align='left' width=\"10%\"></td>
				</tr>
			</tbody>
	</table>
	</br>";
} // END: yayin_bilgilerini_yaz($tmp)





function get_paper_detail($tmp)
{
	global $baglanti;
    /* Bu fonksiyonda
        # $query = mysqli_query($baglanti,$sql_str);
        komutu ile veritabanına gönderilen ve dönen sonucu parçalanan sorgudan yayınlar ile ilgili bilgiler alınıyor.
        Alınan bilgiler webde "Content" sayfasında ilgili cilt ve sayıdaki yayınları listeliyor.

        Fonksiyon
        # while ($tmp = mysqli_fetch_array($query))
        döngüsü içinde çağrılarak bütün yayınlar yazdırılıyor.
    */
    $title = $tmp["title"];
    /*
    if ($tmp["authors"] == "") { // EGER DIGER YAZARLAR YOK ISE
        $authors = $tmp["name_surname"];
    } else {  // EGER DIGER YAZARLAR VAR ISE
        $authors = $tmp["name_surname"] . "*, " . $tmp["authors"];
    }
    */
    $authors = $tmp["authors"];

    $pp = $tmp["pp"];
    $id = $tmp["id"];
    $view = $tmp["view"];
    $download = $tmp["download"];
    //$cited = $tmp["cited"];
    $sorgu1 = mysqli_query($baglanti,"SELECT * FROM `cited_table` WHERE `sub_id`=$id");
    $cited = @mysqli_num_rows($sorgu1);

     

    echo "<table width=\"100%\">
		<tbody>
			<tr>
				<td width=\"90%\"><strong><a href=\"index.php?$id\" target=\"_blank\">$title</a></strong></td>
				<td width=\"10%\" rowspan=\"2\"><p>$pp</p></td>
			</tr>
			<tr>
				<td width=\"90%\"><strong>$authors</strong></td>
			
			</tr>
		</tbody>
		</table>
		<table class='istatistik'>
			<tbody>
				<tr><td width=\"5%\">Viewed : </td><td align='left' width=\"10%\">$view</td>
				<td width=\"5%\">Downloaded : </td><td align='left' width=\"10%\">$download</td>
				<td width=\"5%\"></td><td align='left' width=\"10%\"></td>
				</tr>
			</tbody>
	</table>
	</br>";
} // END: yayin_bilgilerini_yaz($tmp)







function yayin_bilgilerini_yaz_2($tmp)
{   
   global $sira;
	global $baglanti;
    /* Bu fonksiyonda
        # $query = mysqli_query($baglanti,$sql_str);
        komutu ile veritabanına gönderilen ve dönen sonucu parçalanan sorgudan yayınlar ile ilgili bilgiler alınıyor.
        Alınan bilgiler webde "Content" sayfasında ilgili cilt ve sayıdaki yayınları listeliyor.

        Fonksiyon
        # while ($tmp = mysqli_fetch_array($query))
        döngüsü içinde çağrılarak bütün yayınlar yazdırılıyor.
    */
    $title = $tmp["title"];
    /*
    if ($tmp["authors"] == "") { // EGER DIGER YAZARLAR YOK ISE
        $authors = $tmp["name_surname"];
    } else {  // EGER DIGER YAZARLAR VAR ISE
        $authors = $tmp["name_surname"] . "*, " . $tmp["authors"];
    }
    */
    $authors = $tmp["authors"];

    $pp = $tmp["pp"];
    $id = $tmp["id"];
    $view = $tmp["view"];
    $download = $tmp["download"];
	
	$coverimage = $tmp["coverImage"];
	if($coverimage=="")
		$coverimage="	./paperimages/coverimage.png";
	//else
		//$coverimage="../paperimages/".$coverimage;
	
    
	
    $download = $tmp["download"];
	
    $download = $tmp["download"];
    //$cited = $tmp["cited"];
    $sorgu1 = mysqli_query($baglanti,"SELECT * FROM `cited_table` WHERE `sub_id`=$id");
    $cited = @mysqli_num_rows($sorgu1);

  /*
    echo "<table width=\"90%\">
		<tbody>";
						if($sira%2==1)
                           echo "<tr bgcolor=\"#f4f5ef\" >";
					   else
						    echo "<tr >";
						echo " <td width=\"90%\"><strong><a href=\"index.php?$id\" target=\"_blank\">$title</a></strong></td>
				<td width=\"10%\" rowspan=\"2\"><p>$pp</p></td>
			</tr>";
						if($sira%2==1)
                           echo "<tr bgcolor=\"#f4f5ef\" >";
					   else
						    echo "<tr >";
						echo " 
				<td width=\"90%\"><strong>$authors</strong></td>
			
			</tr>
		</tbody>
		</table>";
						if($sira%2==1)
                           echo "<table width=\"90%\" bgcolor=\"#f4f5ef\" class='istatistik'>";
					   else
						    echo "<table width=\"90%\"   class='istatistik'>";
						echo " 
		
		
		

			<tbody>
				<tr><td width=\"5%\">Viewed : </td><td align='left' width=\"10%\">$view</td>
				<td width=\"5%\">Downloaded : </td><td align='left' width=\"10%\">$download</td>
				<td width=\"5%\"></td><td align='left' width=\"10%\"></td>
				</tr>
			</tbody>
	</table>
	</br>";
	*/
	
	$str=explode(",",$authors);
	$authorslist="";
 

	for($i=0;$i<count($str);$i++){
		 $result = mysqli_query($baglanti, "SELECT * FROM `users` WHERE (`name_surname`='$str[$i]') and (`orcid_no`!='')");

			if ($result) {
				$rowCount = mysqli_num_rows($result);
			 
			 if( $rowCount==1){ 
					$row = mysqli_fetch_assoc($result);
					$orcid_no = $row['orcid_no'];
					 $authorslist.=$str[i].'<a href="https://orcid.org/'.$orcid_no.'" ><sup><img src="images/icon/orcid_logo.png"></sup></a>';
					 if($i!=count($str)-1)
								 $authorslist.=", ";
					}
				}
				else
					{
					 $authorslist=$authors;
					 
					}
		}   


?>	
	
     <div class="job-item p-4 mb-4">
                <div class="row bg-light ">
                     
        
        
  <script>
    function popupwindow2(url, w, h) {
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        return window.open(url, null, 'toolbar=no, location=no,resizable=0, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
</script>
        
        <div class="col-md-12 border rounded p-2 bg-white">
            
                <div class="col-md-12 bg-white ">
                <a  href="index.php?page=detail&paperID=<?php echo $id; ?>" target="_blank">
                  <h4 class="mb-2"><?php echo $title; ?></h4></a>
                    <p><?php echo $authors; ?></p>
                </div>
                <div class="col-md-12 ">
                    <a class="btn btn-dark  mb-2 me-2" href="index.php?page=detail&paperID=<?php echo $id; ?>" target="_blank"><i class="fa fa-info" style="color: #74C0FC;"></i> View Abstract</a>
                    <a class="btn btn-dark   mb-2 me-2" href="download.php?id=<?php echo $id; ?>" target="_blank"><i class="far fa-file-pdf" style="color: #74C0FC;"></i> Download PDF</a>
                   
                   
                         <i class="fa fa-download"></i> <?php echo $download; ?> 
                        <i class="fa fa-eye"></i> <?php echo $view; ?> 
                    
                </div>
            
        </div>
                                </div>
                            </div>
	
	
	
	
	
<?php	
	
} // END: yayin_bilgilerini_yaz($tmp)

 





?>






 




 


<?php
/*

 <!-- Jobs Start -->
 <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">ARTICLES</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                                <h6 class="mt-n1 mb-0">Current Issue</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                                <h6 class="mt-n1 mb-0">Early View</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 me-0 pb-3" data-bs-toggle="pill" href="#tab-3">
                                <h6 class="mt-n1 mb-0">Most Downloaded</h6>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="job-item p-4 mb-4">
                               <div class="row bg-light ">

                               <div class=" p-2 col-3">
                                              <img class="flex-shrink-0 img-fluid border rounded " src="makaleresimler/makale1.png" alt="" style="width: 90%; margine:10px;vertical-align: middle;align:center">
                                        </div>
                                       <div class=" col-9 ">
                                   
                                          <div class="text-start">
                                            <h3 class="mb-2">First Morphological and Genetic Record and Confirmation of Korean Rockfish Sebastes
 schlegelii Hilgendorf, 1880 in the Black Sea Coast of Türkiye </h3>
                                            <span class=" me-2">   Deniz Yağlıoglu *
                                            , Servet Ahmet Doğdu, Cemal Turan, Servet Ahmet Doğdu, Cemal Turan, Servet Ahmet Doğdu, Cemal Turan, Servet Ahmet Doğdu, Cemal Turan</span>
                                            <P></p> <P>
                                            <span class="text-truncate me-3"> <a class="btn  rounded-pill btn-primary" href="">Abstract View</a> </span>
                                            <span class="text-truncate me-3"> <a class="btn  rounded-pill btn-primary" href="">Full Text HTML</a> </span>
                                            <span class="text-truncate me-0"><a class="btn  rounded-pill btn-primary" href=""><i class="far fa-file-pdf  style="color: #74C0FC;"> </i> PDF download</a> </span>
                                             
                                            <span class="text-truncate text-md-end  me-0">
                                            <a class="btn  rounded-pill border btn-white" > Download :  123 <i class="fa  fa-download"></i></a> </span>

                                            <span class="text-truncate text-md-end  me-0">
                                            <a class="btn  rounded-pill border btn-white"  > 123  <i class="fa fa-eye"></i></a> </span>
                                           
                                            <i class="fa-brands fa-edge-legacy"></i>
                                           
                                         </P>             
                                       </div>
                                     </div>
                                     
                                    
                                </div>
                            </div>
                           
 <!--  herbir makale kartı -->
                            <div class="job-item p-4 mb-4">
                                <div class="row bg-light">

                                      <div class=" p-2 col-3">
                                              <img class="flex-shrink-0 img-fluid border rounded " src="makaleresimler/makale2.png" alt="" style="width: 90%; margine:10px;vertical-align: middle;align:center">
                                        </div>
                                       <div class=" col-9 ">
                                   
                                          <div class="text-start">
                                            <h3 class="mb-2">First Morphological and Genetic Record and Confirmation of Korean Rockfish Sebastes
 schlegelii Hilgendorf, 1880 in the Black Sea Coast of Türkiye </h3>
                                            <span class=" me-2">   Deniz Yağlıoglu *
                                            , Servet Ahmet Doğdu, Cemal Turan, Servet Ahmet Doğdu, Cemal Turan, Servet Ahmet Doğdu, Cemal Turan, Servet Ahmet Doğdu, Cemal Turan</span>
                                            <P></p> <P>
                                            <span class="text-truncate me-3"> <a class="btn  rounded-pill btn-primary" href="">Abstract View</a> </span>
                                            <span class="text-truncate me-3"> <a class="btn  rounded-pill btn-primary" href="">Full Text HTML</a> </span>
                                            <span class="text-truncate me-0"><a class="btn  rounded-pill btn-primary" href=""><i class="far fa-file-pdf  style="color: #74C0FC;"> </i> PDF download</a> </span>
                                             
                                            <span class="text-truncate text-md-end  me-0">
                                            <a class="btn  rounded-pill border btn-white" > Download :  123 <i class="fa  fa-download"></i></a> </span>

                                            <span class="text-truncate text-md-end  me-0">
                                            <a class="btn  rounded-pill border btn-white"  > 123  <i class="fa fa-eye"></i></a> </span>
                                           
                                            <i class="fa-brands fa-edge-legacy"></i>
                                           
                                         </P>             
                                       </div>
                                     </div>
                                    
                                </div>
                            </div>
							
							
                            <div class="job-item p-4 mb-4">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-3.jpg" alt="" style="width: 80px; height: 80px;">
                                        <div class="text-start ps-4">
                                            <h5 class="mb-3">Product Designer</h5>
                                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                                            <a class="btn btn-primary" href="">Apply Now</a>
                                        </div>
                                        <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: 01 Jan, 2045</small>
                                    </div>
                                </div>
                            </div>
							

                            <div class="job-item p-4 mb-4">
                                <div class="row g-4">
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded" src="img/com-logo-4.jpg" alt="" style="width: 80px; height: 80px;">
                                        <div class="text-start ps-4">
                                            <h5 class="mb-3">Creative Director</h5>
                                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>New York, USA</span>
                                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
                                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$123 - $456</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
*/
 