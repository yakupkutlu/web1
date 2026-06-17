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
                            <button type="submit" name="ara" class="btn btn-dark py-2 position-absolute top-0 end-0 mt-2 me-2">Search</button>
						 </form>
                        </div>
                    </div>




<?php
/*
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
						 ';
							
					 
				$yearTitle = $year;
				     echo'  
                             <div class="col-12">
                               <div class="row gy-4">';
			}
	 //		 echo "<a href='index.php?page=archive&volume=$volume&no=$no&year=$year'>";
      //      echo "<input type='button' class='button_archive' value='Volume.$volume&nbsp;-&nbsp;No.$no&nbsp;-&nbsp;$year'><br>";
        //    echo "</a>";
			
			
                           

					echo'<div class="col-md-4 wow fadeIn" data-wow-delay="0.1s"><center>';
					echo ' 		
						 <div class="col-12 btn-primary  btn-lg">
							<div class="mybg text-center">'.$year.'
							</div>
						</div>';
					 echo '<a href="index.php?page=archive&volume='.$volume.'&no='.$no.'&year='.$year.'">';
							    
                      Echo ' <div class="d-flex align-items-center bg-light rounded p-4">
                                <div class="align-items-center  rounded p-1"><img src="img/cover1_temp2.png"> 
									
                                   <span> <b>  Volume '.$volume.'</b></span>
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
				   </div>
				   </div>
				';
    }
}

*/
?>



 
   

<hr>
                                 <?php
@include("app/connect.php");

// Önce sadece yılları alıyoruz
$sql_years = "SELECT DISTINCT `year` 
              FROM `submission_list` 
              WHERE `accept` = 1 AND `publish` = 1 
              ORDER BY `year` DESC";

$q_years = mysqli_query($baglanti, $sql_years);

echo '
<div class="col-12">
    <div class="row gy-4">';

while ($y = mysqli_fetch_assoc($q_years)) {
    $year = $y["year"];

    

     echo '<div class="card">
    <h5 class="card-header">'.$year.'</h5>
    <div class="card-body">';

    // Bu yılın tüm volume–no kayıtları
    $sql_vol = "SELECT DISTINCT volume, no 
                FROM submission_list
                WHERE accept = 1 AND publish = 1 AND year = '$year'
                ORDER BY volume DESC, no DESC";

    $q_vol = mysqli_query($baglanti, $sql_vol);

    while ($v = mysqli_fetch_assoc($q_vol)) {
        $volume = $v["volume"];
        $no     = $v["no"];

        echo '
                                            <div class="media text-muted pt-3">
                                                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-black">
                                                <a href="index.php?page=archive&volume='.$volume.'&no='.$no.'&year='.$year.'">
                                                     <strong class="d-block text-gray-dark"> <span><b> Volume '.$volume.' – Issue '.$no.' </b></span></strong>
                                                </a></p>
                                            </div>

                ';
    }
    echo '</div></div>';
}
echo ' ';

?>

 
 