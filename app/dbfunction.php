 <?php
 
 
 
function getAnnouncement(){  
	global $baglanti; 
   $sonuc=mysqli_query($baglanti,"select * from static_content WHERE page_name='announcement'");
	
	return	$sonuc;		
			
 }			
			
			
function getStatistics(){  
	global $baglanti; 
   include $_SERVER['DOCUMENT_ROOT']."/app/get_scholare_statistics.php";
            $sql0="select * from statisticsTable WHERE year='".date("Y")."'";
   			if($sonuc=mysqli_query($baglanti,$sql0)){
               return	$sonuc;	
               
              }else{
           
			  return	$sonuc="";	
			  }
		


   include $_SERVER['DOCUMENT_ROOT']."/app/get_scholare_statistics.php";
            $sql0="select * from statisticsTable WHERE year='".date("Y")."'";
   			if($sql_score=mysqli_query($baglanti,$sql0)){
              while ($data=mysqli_fetch_array($sql_score)){
              $totalCite= $data["totalCite"];
              $hIndexScore=$data["hIndexScore"];
              $i10IndexScore=$data["i10IndexScore"];
               }
              }
            
            $sql_str = "SELECT count(id) AS value_sum FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1";
				$row = $row = mysqli_fetch_assoc(mysqli_query($baglanti,$sql_str));			
				$TotalArticles = $row['value_sum'];
				 
           
            $sql_str = "SELECT sum(view) AS value_sum FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1";
				$row = $row = mysqli_fetch_assoc(mysqli_query($baglanti,$sql_str));			
				$TotalArticlesview = $row['value_sum'];
			 
				$sql_str = "SELECT sum(download) AS value_sum FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1";
				$row = $row = mysqli_fetch_assoc(mysqli_query($baglanti,$sql_str));			
				$TotalArticlesdownload = $row['value_sum'];
				 
$data["TotalArticlesdownload"]=$TotalArticlesdownload;
$data["TotalArticlesview"]=$TotalArticlesview;
$data["TotalArticles"]=$TotalArticles;
$data["totalCite"]=$totalCite;
$data["hIndexScore"]=$hIndexScore;
$data["i10IndexScore"]=$i10IndexScore;
         retrun $data
		
 }				


?>

