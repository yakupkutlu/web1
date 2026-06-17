<?php
 include $_SERVER['DOCUMENT_ROOT']."/app/connect.php";
 //get_scholare_satatistics.php
//
 

//echo date("Y").'\n--------ddd---------------------------------\n'.date("d").'<br>';
  $day=date("d");  
  $sonuc=(date("d")%5);
  
  //echo $sonuc;

 if($sonuc==0){
           $year=date("Y");
            $result=checkupdate($year,$baglanti);
            //echo $year;
            //echo $result;
         
           if($result==0){
                 $veri= file_get_contents("https://scholar.google.com/citations?user=IshBPScAAAAJ&hl=en");
                //$veri='<span class="gsc_rsb_title">Cited by</span></h3><table id="gsc_rsb_st"><thead><tr><th class="gsc_rsb_sth"></th><th class="gsc_rsb_sth">All</th><th class="gsc_rsb_sth">Since 2015</th></tr></thead><tbody><tr><td class="gsc_rsb_sc1"><a href="javascript:void(0)" class="gsc_rsb_f gs_ibl" title="This is the number of citations to all publications. The second column has the &quot;recent&quot; version of this metric which is the number of new citations in the last 5 years to all publications.">Citations</a></td><td class="gsc_rsb_std">328</td><td class="gsc_rsb_std">328</td></tr><tr><td class="gsc_rsb_sc1"><a href="javascript:void(0)" class="gsc_rsb_f gs_ibl" title="h-index is the largest number h such that h publications have at least h citations. The second column has the &quot;recent&quot; version of this metric which is the largest number h such that h publications have at least h new citations in the last 5 years.">h-index</a></td><td class="gsc_rsb_std">8</td><td class="gsc_rsb_std">8</td></tr><tr><td class="gsc_rsb_sc1"><a href="javascript:void(0)" class="gsc_rsb_f gs_ibl" title="i10-index is the number of publications with at least 10 citations. The second column has the &quot;recent&quot; version of this metric which is the number of publications that have received at least 10 new citations in the last 5 years.">i10-index</a></td><td class="gsc_rsb_std">5</td><td class="gsc_rsb_std">5</td></tr></tbody></table>';
                 
                $bas = 'Citations</a></td><td class="gsc_rsb_std">';
                $son = '</td>';
                $totalcites = ara($bas, $son, $veri);
                //echo $totalcites[0].' ccc<br>';
            
            
                
                 $bas = 'h-index</a></td><td class="gsc_rsb_std">';
                $son = '</td>';
                $hindex = ara($bas, $son, $veri);
                //echo $hindex[0].'hhh<br>';
                 
                
                
                 $bas = 'i10-index</a></td><td class="gsc_rsb_std">';
                $son = '</td>';
                $i10index = ara($bas, $son, $veri);
                //echo $i10index[0].'iii<br>';
             
             
                $sql0="UPDATE statisticsTable SET `totalCite`='$totalcites[0]', `hIndexScore`='$hindex[0]', `i10IndexScore`='$i10index[0]', `updated`='1', `updateDay`='$day' WHERE `year`='$year'";
                //echo $sql0;
                mysqli_query($baglanti,$sql0);
            
           }else {
        	
            	$sql0="UPDATE statisticsTable SET `updated` ='0' WHERE year='$year'";
            	mysqli_query($baglanti,$sql0);
        	
           }

} //ifdate  end

function ara($bas, $son, $yazi)
{
    @preg_match_all('/' . preg_quote($bas, '/') . 
    '(.*?)'. preg_quote($son, '/').'/i', $yazi, $m);
    return $m[1];
}

function checkupdate($year,$baglanti)
{
   
   
   $sql0="select * from statisticsTable WHERE year='".$year."'";
   
   if($sql_announcement=mysqli_query($baglanti,$sql0)){
            while ($data=mysqli_fetch_array($sql_announcement)){
                $updatedata= $data["updated"];
					 $updateday= $data["updateDay"];
            }
            
	} 
	    
	
   //	echo $updateday."--".$updatedata;
    if($updateday!=date("d")) { 
        	if(!isset($updatedata)) {
        		 //	echo $updateday."***".$updatedata;
        		//$sql0="UPDATE statisticsTable SET totalCite='$totalcites[0]' hIndexScore='$hindex[0]' i10IndexScore='$i10index[0]' updated='1' WHERE year='$year'";
        			$sql0="	INSERT INTO statisticsTable (`year`) VALUES ('$year')";
        			mysqli_query($baglanti,$sql0);		
              	   return 0;
        		
        	}else {
        		return $updatedata;
        	}
    }else {
    	return 1;
    }   	
   
}




?>


