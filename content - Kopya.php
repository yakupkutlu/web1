<style>
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
//@include("app/connect.php");
 

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
					
					
					
							
				<table class="bg-blue2"  width="90%" class="text-center mb-5 wow fadeInUp" data-wow-delay="0.3s">
                    <tbody> 
					<tr>
					   <td style="padding:20px" width="40%" rowspan=3> <center>
						 <img src="img/cover1_temp2.png"> </center></td>
                        <td class="bg-blue2"  width="60%" height="1"   style='color: #FFFFFF;'> 
											                          
                           	
<?php

// liste start	
				   
            echo "				                          
                            </br>
                            <strong>&nbsp;&nbsp;Volume   $volume, &nbsp;No: $no, &nbsp;$year</strong></br></br>                  
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
            	
						//	$publish_date = $tmp["publish_date"];
				
						// IGW-2016 YA DA PUFFERFISH-2017 SUPPLEMENTARY yayınları dahil ETMEMEK için
           			//     if ($publish_date != '2016-10-10' and $publish_date != '2017-12-19') {					
                  			  // 2016-10-10 YALNIZCA IGW-2016 SUPPLEMENTARY YAYINLARININ YAYIN TARİHİDİR
										// 2017-12-19 YALNIZCA PUFFERFISH-2017 SUPPLEMENTARY YAYINLARININ YAYIN TARİHİDİR
                    				// GERİ KALAN BÜTÜN YAYINLAR CONTENT SAYFASINDAN NORMAL BİR ŞEKİLDE GÖRÜNECEKTİR
                    
                    yayin_bilgilerini_yaz($tmp);
                    $sira++;
              		//  }// END: if($publish_date != '2016-10-10' or $publish_date != '2017-12-19')					
				
				
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
                
                    
          
          
				
        } else { // else for if ((!isset($genel_aranan)) && (!isset($aranacak))) {
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
					
			echo '<a class="btn btn-primary" href="">   The results of <b>" '. $aranacak.'" </b> </a>  ';
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

                echo "<table class=\" wow fadeInUp\" data-wow-delay=\"0.3s\"  width=\"80%\">
                            <tbody   id=\"tablofont\">";
						if($sira%2==1)
                           echo "<tr bgcolor=\"#f4f5ef\" >";
					   else
						    echo "<tr >";
						echo " <td width=\"5%\" rowspan=\"2\"> $sira - </td>
                                    <td width=\"90%\"><strong>
									<a href=\"abstract_info.php?page=info&paperID=$id\" target=\"_blank\"> $title</a></strong></td>
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
        echo "<table width=\"90%\">
				<tbody>
				<tr>
					<td class=\"bg-blue2\"   width=\"100%\" height=\"1\">&nbsp;</td>
				</tr>
				</tbody>
			</table>
			 <p>
						<center>					 
													<a class=\"btn btn-primary\"href='index.php?page=archive' >GO TO ARCHIVE</a>
										   </center>
			 
			
				 
			</table>";
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

    /*
        ID = 81 olan IGW SUPPLEMENTARY YAYINLAR 1. CİLT 3. SAYI (2016) İÇİNDE.
        ID = 81'deki yayın ID = 125'deki yayının özeti. ID 81 Linki 125'e ona yönlendirildi // iptal edildi yakup kutlu 15.05.2018
    */
    //    if ($id == 81)  // iptal edildi yakup kutlu 15.05.2018
     //       $id = 81;

    /*
        ID = 93 olan IGW SUPPLEMENTARY YAYINLAR 1. CİLT 3. SAYI (2016) İÇİNDE.
        ID = 93'teki yayın ID = 139'daki yayının özeti. ID 93 Linki 139'a ona yönlendirildi  // iptal edildi yakup kutlu 15.05.2018
    */
    if ($id == 93)
        $id = 93;
	
	// PUFFERFISH-2017 ARTICLE OLAN ÖZETLERİN ID'LERİ MAKALELERE YÖNLENDİRİLDİ
	switch($id){
		case 298;
			$id = 212;
			break;
		
		case 320;
			$id = 234;
			break;
			
		case 301;
			$id = 238;
			break;
		
		case 293;
			$id = 243;
			break;
		
		case 322;
			$id = 245;
			break;
		
		case 290;
			$id = 248;
			break;
		
		case 312;
			$id = 264;
			break;
		
		case 296;
			$id = 281;
			break;
	}

    echo "<table width=\"90%\">
		<tbody>";
						if($sira%2==1)
                           echo "<tr bgcolor=\"#f4f5ef\" >";
					   else
						    echo "<tr >";
						echo " <td width=\"90%\"><strong><a href=\"abstract_info.php?page=info&paperID=$id\" target=\"_blank\">$title</a></strong></td>
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
				<td width=\"90%\"><strong><a href=\"abstract_info.php?page=info&paperID=$id\" target=\"_blank\">$title</a></strong></td>
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








?>






<?php

echo  $volume;
  $volume=0;$no=0; $year=0;
 // cover files start
	
				/// end cover files 

?>




        <!-- Jobs Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Current Issue
</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                     
                    <div class="tab-content">
                      <div class="row">
                        
						<div class="col-9 col-sm-9 col-mb-9 col-lg-9 ">
						   
						   <div class="job-item p-4 mb-4">
                                <div class="row">
                                    <div class="col">
                                         <div class="row">
										  <div class="col-9">
                                            <h6 >The Relationships of Weight and Length of wolf from northeastern Mediterranean </h6>
                                            <p> Yakup Kutlu*, Servet Ahmet Dogdu, Cemal Turan , Deniz Yağlıoglu*, Servet Ahmet Dogdu, Cemal Turan</p>
                                             <i class="far fa-clock text-primary me-2"></i>Viewed :	401	</span>
                                          <i class="far fa-money-bill-alt text-primary me-2"></i>Downloaded :	271</span>    
										  </div>
										  <div class="col-3">
												 <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
													<a class="btn btn-primary" href="">140-150</a>
										  </div>  
										 </div>                               
                                    </div>                                    
                                </div>								                                    
                              </div>  
							  
						
						
							   <div class="job-item p-4 mb-4">
                                <div class="row">
                                    <div class="col">
                                         <div class="row">
										  <div class="col-9">
                                            <h6 >The Relationships of Weight and Length of wolf from northeastern Mediterranean </h6>
                                            <p> Yakup Kutlu*, Servet Ahmet Dogdu, Cemal Turan , Deniz Yağlıoglu*, Servet Ahmet Dogdu, Cemal Turan</p>
                                             <i class="far fa-clock text-primary me-2"></i>Viewed :	401	</span>
                                          <i class="far fa-money-bill-alt text-primary me-2"></i>Downloaded :	271</span>    
										  </div>
										  <div class="col-3">
												 <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
													<a class="btn btn-primary" href="">140-150</a>
										  </div>  
										 </div>                               
                                    </div>                                    
                                </div>								                                    
                              </div> 
							  
							  
							  	   <div class="job-item p-4 mb-4">
                                <div class="row">
                                    <div class="col">
                                         <div class="row">
										  <div class="col-9">
                                            <h6 >The Relationships of Weight and Length of wolf from northeastern Mediterranean </h6>
                                            <p> Yakup Kutlu*, Servet Ahmet Dogdu, Cemal Turan , Deniz Yağlıoglu*, Servet Ahmet Dogdu, Cemal Turan</p>
                                             <i class="far fa-clock text-primary me-2"></i>Viewed :	401	</span>
                                          <i class="far fa-money-bill-alt text-primary me-2"></i>Downloaded :	271</span>    
										  </div>
										  <div class="col-3">
												 <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
													<a class="btn btn-primary" href="">140-150</a>
										  </div>  
										 </div>                               
                                    </div>                                    
                                </div>								                                    
                              </div> 
							  
							  
							  	   <div class="job-item p-4 mb-4">
                                <div class="row">
                                    <div class="col">
                                         <div class="row">
										  <div class="col-9">
                                            <h6 >The Relationships of Weight and Length of wolf from northeastern Mediterranean </h6>
                                            <p> Yakup Kutlu*, Servet Ahmet Dogdu, Cemal Turan , Deniz Yağlıoglu*, Servet Ahmet Dogdu, Cemal Turan</p>
                                             <i class="far fa-clock text-primary me-2"></i>Viewed :	401	</span>
                                          <i class="far fa-money-bill-alt text-primary me-2"></i>Downloaded :	271</span>    
										  </div>
										  <div class="col-3">
												 <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
													<a class="btn btn-primary" href="">140-150</a>
										  </div>  
										 </div>                               
                                    </div>                                    
                                </div>								                                    
                              </div> 
 
 
 
							  
							</div>
                          
							
							<div class="col-3 col-sm-3 col-mb-3 col-lg-3   wow fadeInUp" data-wow-delay="0.1s">
										<a class="cat-item bg-white2 rounded p-4" href="">
											<img src="img/cover1_temp.png" width="90%">
											<br><h6 class="mb-3"> </h6>
											<h6 class="mb-3" style="margin-top:30px" >2023  Volume 1  Issue 1 </h6>
											<p class="mb-0"> <?php echo "&nbsp;&nbsp;<a style='color: #0000FF;' target='_blank' href='$cover'>Cover Page</a>";
					echo "&nbsp;&nbsp;|&nbsp;&nbsp;<a style='color: #0000FF;' target='_blank' href='$front_matter'>Front Matter</a>";
					echo "&nbsp;&nbsp;|&nbsp;&nbsp;<a style='color: #0000FF;' target='_blank' href='$front_matter $table_of_contents'>Table of Contents</a><br><br>";
					 

											?>  </p>
											<p class="mb-0">   </p>
											 
										</a>
									</div>
								
						</div> <!-- Jobs row End -->
									
					   </div>
                     
 	
	
				   </div>
                </div>
            </div>
         
        <!-- Jobs End -->

