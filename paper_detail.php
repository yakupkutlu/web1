<?php

$page= $_GET["page"];
$id = $_GET["paperID"];

    // VT sorgulamasinda herhangi bir sorun var mi? Sorun yoksa 1, sorun varsa 0 degeri alir.
    $kontrol = 1;

    //$sorgu = mysqli_query($baglanti,"SELECT * FROM submission_list WHERE id=$id AND `accept` = 1 AND `publish` = 1"); //sadece basılanlar 
    
	
	$sorgu = mysqli_query($baglanti,"SELECT * FROM submission_list WHERE id=$id AND `accept` = 1 ");  // kabul edilen ama basılmayan

    if($sorgu){
        $count = @mysqli_num_rows($sorgu);
        if($count>0){
            $bilgi = @mysqli_fetch_array($sorgu);
            $title = $bilgi["title"];
			/*
            if($bilgi["authors"] == ""){ // EGER DIGER YAZARLAR YOK ISE
                $authors = $bilgi["name_surname"];
            } else { // EGER DIGER YAZARLAR VAR ISE
                $authors = $bilgi["name_surname"]."*, ".$bilgi["authors"];
            }
			*/
			$authors = $bilgi["authors"];

            $abstract = $bilgi["abstract"];
           
            $keywords = $bilgi["keyword"];
            $volume = $bilgi["volume"];
            $no = $bilgi["no"];
            $pp = $bilgi["pp"];
            $year = $bilgi["year"];
            $yayin_turu = $bilgi["yayin_turu"];
            $references = $bilgi["references"];
            $accept_date = $bilgi["accept_date"];
            $publish_date = $bilgi["publish_date"];
            $downloadlink = $bilgi["paperfile1"];
            $view=$bilgi["view"];
            $download=$bilgi["download"];
            //$cited=$bilgi["cited"];
            $sorgu_cited = mysqli_query($baglanti,"SELECT * FROM `cited_table` WHERE `sub_id`=$id");
            $cited = @mysqli_num_rows($sorgu_cited);
            $paperID=$bilgi["paperID"];
			   $doi = $bilgi["doi"];

            $id = $bilgi["id"];
            $journal = "Natural and Engineering Sciences";
            
            $sorgu1 = mysqli_query($baglanti,"SELECT * FROM supplementary_events WHERE year=$year AND volume=$volume AND no=$no AND yayin_turu=$yayin_turu");
            $bilgi2 = @mysqli_fetch_array($sorgu1);
            $event_name  = $bilgi2["event_cite_name"];
            $SupplementNo=$bilgi2["SupplementNo"];
			
			/*
            if($bilgi["authors"] == ""){// EGER DIGER YAZARLAR YOK ISE
                $allAuthors = $bilgi["name_surname"];
            } else {// EGER DIGER YAZARLAR VAR ISE
                $allAuthors = $bilgi["name_surname"].",".$bilgi["authors"];
            }
			*/
			$tmpAllAuthors = $bilgi["authors"];
			$allAuthors = str_replace("*", "", $tmpAllAuthors);
			

            $citeStr = "";
            $str = explode(",",$allAuthors);
            for($i=0; $i<count($str); $i++){
                $t = explode(" ",trim($str[$i]));
                $citeStr .= end($t).", ".$t[0][0].".";
                if($i+1 != count($str)) $citeStr .= ", ";
            }
            
            //Ozturk, B. (2016). Why We Have to Protect Grouper as a Common Ecological Heritage in the Mediterranean Sea. 
           // Natural and Engineering Sciences, 1(3), Supplement ,10.
            //($year). $title.
            //Ozturk, B. (2016). Why We Have to Protect Grouper as a Common Ecological Heritage in the Mediterranean Sea. 
           // $event_name ="Abstracts Book of International Grouper Workshop, 07-08 October 2016, Bodrum, Turkey"; p10.
			if ($yayin_turu==3){
			//if (($volume == 1{} and $no == 3 and $year == 2016 and $publish_date == '2016-10-10') or ($volume == 2 and $no == 3 and $year == 2017 and $publish_date == '2017-12-19'))
					
				$citeStr .= " ($year). $title.  $SupplementNo, $event_name,$pp.";
			}elseif($yayin_turu==2) {
			
			$citeStr .= " ($year). $title. $journal, $volume($no), $SupplementNo, $pp.";
			}
				elseif($yayin_turu==4) {
				$citeStr = $bilgi2["howtocite"];
			}	
			
			else{
				$citeStr .= " ($year). $title. $journal, $volume($no), $pp.";
			}	
				
        } else{
            $kontrol = 0;
        }
    } else{
        $kontrol = 0;
    }

    if($kontrol == 0){
        header("Location: index.php?page=content");
    }
    echo "<meta name=\"citation_journal_title\" content=\"".$journalName."\" />";
    echo "<meta name=\"citation_title\" content=\"$title\" />";
    echo "<meta name=\"citation_year\" content=\"$year\" />";

    $tmp = explode(",",$bilgi["name_surname"].", ".$bilgi["authors"]);
    for($i=0; $i<count($tmp); $i++){
        $metaStr = "";
        $tmp2 = explode(" ",$tmp[$i]);
        $metaStr = end($tmp2).", ";

        for($k=0; $k<count($tmp2)-1; $k++){
            $metaStr .= $tmp2[$k];
        }
        echo "<meta name=\"citation_author\" content=\"$metaStr\" />";
    }
    echo "<meta name=\"citation_viewed\" content=\"$view\" />";
    echo "<meta name=\"citation_downloaded\" content=\"$download\" />";
    echo "<meta name=\"citation_cited\" content=\"$cited\" />";


    ?>
   







    <div id="site_content">

 

        <div class="content_container_midle">

            <?php

         

            if  ($page=="detail") {
                // burası veritabanından gelecek şekilde şekilllenecek;
                include("detail.php");

              
            }

            ?>


        </div>

    </div>

