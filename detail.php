<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php    
	$page= $_GET["page"];
    $id = $_GET["paperID"];



// Bu sayfa abstract_info.php içinde include ile çağrılıyor. Burada kullanılan PHP değişkenleri abstract_info.php sayfasında oluşturuluyor.
$accept_str = "UPDATE submission_list SET view = view+1 WHERE id = $id";
$sorgu = @mysqli_query($baglanti,$accept_str);




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
            $references1 = $bilgi["references"];

            $references2 = str_replace("'", "", $references1);
            $references = str_replace('"', '', $references2);

            $accept_date = $bilgi["accept_date"];
            $publish_date = $bilgi["publish_date"];
            $downloadlink = $bilgi["paperfile1"];
            $submission_date = $bilgi["submission_date"];
            $available_date = $bilgi["available_date"];
            

            $view = $bilgi["view"];
            $download = $bilgi["download"];

            //$cited=$bilgi["cited"];
            $sorgu_cited = mysqli_query($baglanti,"SELECT * FROM `cited_table` WHERE `sub_id`=$id");
            $cited = @mysqli_num_rows($sorgu_cited);
            $paperID=$bilgi["paperID"];
			$doi = $bilgi["doi"];

            $id = $bilgi["id"];

            $journal = $journalName;
            
           
            $coverimage = $bilgi["coverImage"];
            if($coverimage=="")
                $coverimage="	./paperimages/coverimage.png";
            
            
    
        
			
			 
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
			if ($yayin_turu==30){
			//if (($volume == 1{} and $no == 3 and $year == 2016 and $publish_date == '2016-10-10') or ($volume == 2 and $no == 3 and $year == 2017 and $publish_date == '2017-12-19'))
					
				$citeStr .= " ($year). $title.  $SupplementNo, $event_name,$pp. ";
			}elseif($yayin_turu==20) {
			
			$citeStr .= " ($year). $title. $journal, $volume($no), $SupplementNo, $pp.";
			}
			elseif($yayin_turu==40) {
				$citeStr = $bilgi2["howtocite"];
			}	
			
			else{
				$citeStr .= " ($year). $title. $journal, $volume($no), $pp, doi : $doi";
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
     
	 echo "<meta name=\"description\" content=\"$abstract\" />";
    
	 echo "<meta name=\"keywords\" content=\"aaa $keywords\" />";

    ?>
    <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
   

    <link rel="stylesheet" href="js/cite_dialog/css/jquery.ui.all.css">
    <script src="js/cite_dialog/js/jquery-1.8.3.js"></script>
    <script src="js/cite_dialog/js/jquery.bgiframe-2.1.2.js"></script>
    <script src="js/cite_dialog/js/jquery.ui.core.js"></script>
    <script src="js/cite_dialog/js/jquery.ui.widget.js"></script>
    <script src="js/cite_dialog/js/jquery.ui.mouse.js"></script>
    <script src="js/cite_dialog/js/jquery.ui.button.js"></script>
    <script src="js/cite_dialog/js/jquery.ui.draggable.js"></script>
    <script src="js/cite_dialog/js/jquery.ui.position.js"></script>
    <script src="js/cite_dialog/js/jquery.ui.resizable.js"></script>
    <script src="js/cite_dialog/js/jquery.ui.dialog.js"></script>
    <script src="js/cite_dialog/js/jquery.ui.effect.js"></script>
    <script src="js/cite_dialog/js/my.citation.script.js"></script>


    <style>
        #citation-area{
            padding: 7px;
            width: 500px;
            max-width: 500px;
            min-width: 500px;
            height: 80px;
            max-height: 80px;
            min-height: 80px;
        }
    </style>
</head>






    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-dark" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


    

        <!-- Header End -->
       
        <!-- Header End -->
 




      

                      




        <!-- Job Detail Start  xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx-->

 







<!--   sag menü start -->

                   
                </div>
            </div>
        </div>
        <!-- Job Detail End -->
 









        
        

        <!-- Job Detail Start -->
        <div class="container-xxl py-5 wow  "  >
            <div class="container">
                <div class="row gy-5 gx-4">

              
                    <div class="col-lg-8">
                        

                        




                  
                                    

                        <div class="card text-black bg-white  " style="  padding: 20px;">
                      
                          <div class="card-header"><h4><?php echo $title; ?> </h4>   </div>

                                          <p class="card-text padding: 20px;"><h5><?php echo $authors; ?> </h5></p>
                             



						 
                                         <h6 class="mb-3 text-justify">Keywords</h6>
                                        <p style="text-justify: auto;">  <?php 
                                        
                                        // echo $keywords; 
                                        $keys=explode(",",$keywords);                           
                                            foreach ($keys as $v) {
                                                echo '<a title="content " class="btn rounded-pill border  border btn-white"  title="keyword" > '. ($v).'  </a>  ';
                                            }
                                        
                                        
                                        ?>  </p>
                           
                           
                           <p><a title="content " href="https://doi.org/<?php echo $doi; ?> ">
                                         <img src="img/doi_icon.png" width="16px"> 
                                    Doi : <?php echo $doi; ?>  </a>  </p>
						 
                                    <h6 class="mb-3 text-justify">Abstract</h6>
                                    <p style="text-justify: auto;"> <?php echo $abstract; ?>   </p>
                            

                                    <h4 class="mb-3">References</h4>											
							          <?php
                                                    $ref_sembol='<li class="mb-3 text-justify" ><i class="fa fa-check text-dark me-2"></i>';
                                                    if (!preg_match_all("/<ul>/",$references)){
                                                        $references=str_replace("<br>",$ref_sembol,$references);
                                                        $references='<ol class="list-unstyled">'.$references."</ol></br>";
                                                    }
                                                    echo $references;
                                      ?>
                            
                           
                         </div>











        
                        
                    </div>
        
                    <div class="col-lg-4" >
                       

                    <a title="content " class="btn  rounded-pill border btn-white"  title="view" > 
                                    <i class="fa fa-download text-dark me-2"></i><?php echo  $download ; ?> </a> 
								 <a title="content " class="btn  rounded-pill border btn-white"  title="download" >
                                     <i class="fa fa-eye text-dark me-2"></i><?php echo $view; ?></a> 

                        <div class="bg-white rounded p-5 wow  "  >
                            
                        
  
                            <div class="card">
                                   <h5 class="card-header">Exports  </h5>
                                   <div class="card-body">
 
                                   <p> <a title="content "   href="download.php?id=<?php echo $id; ?>" target="_blank"><i class="far fa-file-pdf text-dark me-2" ></i>Download PDF</a></p>
                                   <p><a title="content " href="download_XML.php?id=<?php echo $id; ?>" target="_blank"><i class="fa fa-file-code text-dark me-2"></i>Download XML File</a></p>
                                                 
                                   <p> <a title="content " href="javascript:void(0);" onclick="downloadCiteFile('<?php echo $citeStr; ?>', '<?php echo $paperID; ?>')"> <i class="fa fa-file-code text-dark me-2"></i>Download Citation Text File</a></p>
 
                                                             
                                   
                                   </div>
                                 </div>

 
							<br>
							
                                    
                        <div class="card">
                                   <h5 class="card-header">Article Summery </h5>
                                   <div class="card-body">
 
                                                                                
                                   <p><i class="fa fa-info   text-dark me-2"></i>ISSN : <?php echo $journalISSN; ?> </p>
                                   <p><i class="fa fa-hashtag text-dark  me-2"></i>Volume <?php echo $volume; ?>  Issue <?php echo $no; ?> </p>
                                     <p><i class="fa fa-calendar text-dark me-2"></i>Submission Date: <?php echo $submission_date; ?></p>
                                    <p><i class="fa fa-calendar text-dark me-2"></i>Accepted Date : <?php echo $accept_date; ?></p>
                                    <p><i class="fa fa-calendar text-dark me-2"></i>Available Online  : <?php echo $available_date; ?></p>
                                    <p><i class="fa fa-calendar text-dark me-2"></i>Publication Date :<?php echo $publish_date; ?></p>
                                                    
                                   
                                   </div>
                                 </div>
                                 <br>
                                 
								


                                <div class="card">
                                   <h5 class="card-header">Share Article  </h5>
                                   <div class="card-body">
 
                                                                                
                                            <?php  $TwitText="My article has been published in journal of ".$journalName." %0ALink%3A%0Ahttps%3A//$journalDomain/link/".$id."%0A"; 
                                                $TwitText=str_replace(" ","%20",$TwitText);
                                            ?>
                                            <!-- Twitter için -->
                                            <p><a title="content " href="https://twitter.com/intent/tweet?url=<?php echo  $TwitText; ?>" aria-label="Share on Twitter" target="_blank" rel="noopener noreferrer">
                                            <img src="img/twitter_icon.png" width="18px" alt="Twitter icon"> Share Article on Twitter 
                                            </a></p>

                                                <!-- Facebook için -->
                                            <p><a title="content" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo 'https%3A//' . $journalDomain . '/link/' . $id; ?>" aria-label="Share on Facebook" target="_blank" rel="noopener noreferrer">
                                                    <img src="img/facebook_icon.png" width="18px" alt="Facebook icon"> Share Article on Facebook
                                            </a></p>

                                            <!-- LinkedIn için -->					
                                            <p><a title="linkedin.com/sharing " href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode('https://' . $journalDomain.'/index.php?' . $id); ?>" aria-label="Share on LinkedIn" target="_blank" rel="noopener noreferrer">
                                            <img src="img/linkin_icon.png" width="18px">  Share Article on LinkedIn
                                            </a></p>                 
                                   
                                   </div>
                                 </div>



                                   <br>

								<!-- Instagram için -->
								

                               

                                  <div class="card">
                                         <h5 class="card-header">How to Cite  </h5>
                                           <div class="card-body">
  
                                                 <p> <b>Cite as : </b></p>
                                        
                                                <p   id="citeStr1" >  <?php echo $citeStr; ?>   </p>
                                         
                                              <center>
                                              <button class="btn  rounded-pill border btn-warning"  onclick="openModal(' <?php echo $citeStr; ?> ')">Copy</button></center>
                                                      
                                   
                                           </div>
                                        </div>
                              
							 
                        
								
							    
							  

                        </div>

                        <div class="bg-white rounded p-5 wow  "  >
                           
                           
                                     
                                      
                                      
                              
                       
                             
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Job Detail End -->






















        <?php
 
        ?>
  
 
     <script>
  // Download Citation Text File
					function downloadCiteFile(bibData, paperid) {
						var blob = new Blob([bibData], {type: "text/plain"});
						var url = window.URL.createObjectURL(blob);
						var a = document.createElement("a");
						a.href = url;
						a.download = paperid + ".txt";
						document.body.appendChild(a);
						a.click();
						document.body.removeChild(a);
						window.URL.revokeObjectURL(url);
					}
	 </script>
  
  <script>
function openModal(textToCopy) {
    var modal = document.getElementById("myModal");
    var modalContent = document.getElementById("modalContent");
    var copyText = document.getElementById("copyText");
    copyText.value = textToCopy;
    //modalContent.innerHTML = "<p>" + textToCopy + "</p>";
    modal.style.display = "block";
}

function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}

function copyToClipboard() {
    var copyText = document.getElementById("copyText");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand("copy");
	 modalContent.innerHTML = "<center> Copied </center>";
    //alert("Metin panoya kopyalandı: " + copyText.value);
}
</script>
<style>
.modal {
    display: none; 
    position: fixed; 
    z-index: 1; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4); 
    padding-top: 60px;
}

.modal-content {
    background-color: #fefefe;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%; 

}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>


<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <div id="modalContent" >
      <!-- Metin buraya gelecek -->
	  
    </div>
	<textarea id="copyText" ></textarea>
    <button onclick="copyToClipboard()">  Copy</button>
    
  </div>
</div>