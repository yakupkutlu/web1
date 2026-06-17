<style>
    #aramaKutusu{
        width: 238px;
        height: 34px;
        text-align: center;
        margin-right: auto;
        margin-left: auto;
        overflow: hidden;
        padding-bottom: 15px;
        background: url(images/arama_kutusu.png) no-repeat
    }

    #aramaKutusu input{
        width: 193px;
        height: 19px;
        margin: 7px 0 0 7px;
        padding: 0;
        float: left;
        border: none;
        background: #eee;
        font: bold 12px Arial
    }

    #aramaKutusu button{
        width: 25px;
        height: 25px;
        margin: 4px 9px 0 2px;
        float: right;
        text-indent: -9999px;
        border: none;
        background: url(images/btn.png) no-repeat;
        cursor: pointer
    }

</style>

<p style="text-align: justify;"><span><strong><a class="accordion-toggle collapsed from-journal">Archiving Policy</a></strong><br /><br />To guarantee that all papers published in the journal are maintained and permanently accessible, articles are stored in Dergipark which serves as a &nbsp;national archival web site and at the same time permits LOCKSS to &nbsp;collect, preserve, and serve the content.</span></p>
<p style="text-align: justify;"><span>Additionally, authors are encouraged to self-archive the final PDF version of their articles in open electronic archives with &nbsp;that conform to standards of Open Archives Initiative (</span><a href="https://www.openarchives.org/" target="_blank"><span>https://www.openarchives.org/</span></a><span>).&nbsp;Authors should provide a link from the deposited version to the URL of IUPress journal website.</span></p>





              
                  <div class=".col-md-4 .offset-md-4">
                        <div class="position-relative mx-auto" style="max-width: 400px;">
						<form action='arama.php' method='post'>
                     
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Search Title or Author" name="aranacak">
                            <button type="submit" name="ara" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Search</button>
						 </form>
                        </div>
                    </div>
<?php
@include("app/connect.php");
 
$sql_str = "SELECT * FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1 GROUP BY `year`,`volume`,`no` ORDER BY `year` DESC, `volume` DESC, `no` DESC";
$query = mysqli_query($baglanti,$sql_str);
if ($query) {
    $count = mysqli_num_rows($query);
    if ($count > 0) {
        //echo "<div class='formBody'>";
		$yearTitle = 0;
        while ($tmp = mysqli_fetch_array($query)) {
            $volume = $tmp["volume"];
            $no = $tmp["no"];
            $year = $tmp["year"];

			if($year != $yearTitle){
				echo "<br><center><span style='font-size:16px; font-weight:bold;'>";
				//echo $year;
				$filenamereviewer="cover_files/list_of_reviewers_".$year.".pdf";
				//echo $filenamereviewer;
				if (file_exists($filenamereviewer)) {
			//	if ($year == 2018) {
					//echo "<br> <font size=2> <a href='".$filenamereviewer."'>(List of Reviewers ".$year.")</a></font>";
				//	}
				}
				echo "</span></center>";
				
				echo '<div class="row">			
						 <div class="col-12 btn-primary  btn-lg">
							<div class="mybg text-center">'.$year.'
							</div>
						</div>
					 </div>';
				
				$yearTitle = $year;
				     echo' <div class="row g-4">
                             <div class="col-12">
                               <div class="row gy-4">';
			}
	 //		 echo "<a href='index.php?page=archive&volume=$volume&no=$no&year=$year'>";
      //      echo "<input type='button' class='button_archive' value='Volume.$volume&nbsp;-&nbsp;No.$no&nbsp;-&nbsp;$year'><br>";
        //    echo "</a>";
			
			
                           

					echo'<div class="col-md-4 wow fadeIn" data-wow-delay="0.1s"><center>';
					 echo '<a href="index.php?page=archive&volume='.$volume.'&no='.$no.'&year='.$year.'">';
							    
                      Echo ' <div class="d-flex align-items-center bg-light rounded p-4">
                                <div class="align-items-center  bg-white2 rounded p-1"><img src="img/cover1_temp2.png"> 
									
                                   <span> <b> No:'.$no.'</b>, Vol.'.$volume.'</span>
                              </div>
							  </div>
							
								</a>
                            ';  
							
					//echo "<input type='button' class='button_archive' value='Volume.$volume&nbsp;-&nbsp;No.$no&nbsp;-&nbsp;$year'>";
					echo "<br>
					</div>";
                             
                  
                 
			
			
        }
        echo '
		      </div>
                    </div>
				   </div>';
    }
}
?>
 
 