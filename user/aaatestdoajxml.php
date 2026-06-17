<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $journalShortName; ?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.css" rel="stylesheet">
</head>

<body class="nav-md">

<!-- page content -->
<div class="x_panel" style="height: 726px; margin-bottom: 0px; display: block;">
    <div class="x_content">

        <?php
        
    
        // test yapılacak 
        
        
        
 
include("../app/connect.php");
include("../user/function.php");   
 
     
        
 

function isim_parcalama($gelen)
{
    $isim = explode(" ", trim($gelen));
    $ad = substr($isim[0], 0, 1);
    $soyad = $isim[1];
    $soyad_ad = $soyad . ", " . $ad . ".";
    return $soyad_ad;
}

function isim_parcalama_jgate($gelen)
{
    $isim = explode(" ", trim($gelen));
    $ad = $isim[0];
    $soyad = $isim[1];
    $tmp[0] = $ad;
    $tmp[1] = $soyad;
    return $tmp;
}


  
 
        $gelen_yazarlar_jgate = "";
        
        $gelen_yazarlar_OA = "";

        $volume=8 ;
        $no=1;
        $download_str = "SELECT * FROM submission_list WHERE volume = '$volume' and no = '$no' ";
        $download_sorgu = @mysqli_query($baglanti,$download_str);
        $sonuc="";
        
      while ($k = mysqli_fetch_object($download_sorgu)) { 
       
        $gelen_yazarlar =""; 
        $keywords = "";
        
        $title = $k->title;
        $yazar1 = $k->name_surname;
        $yazar = explode(",", $k->authors); 
        
        
        $keywords1 = $k->keyword;
        $anahtar_kelime = explode(",", $keywords1);
        $abstract = $k->abstract;
        //$abstract =tirnak_replace($abstract); 
        $yayin_yili= $k-> date;
        $link = $k->paperfile1;
        
        
        $download_link = $journalDomainName.substr($link, 2, -1)."f";
        
        
        $paperID = $k->paperID;
        $yturu= $k-> yayin_turu;
        $references== $k->references;
        $doi= $k->doi;
        $volume = $k->volume;
        $no = $k->no;
        $pp = $k->pp;
        $pages=explode("-", $pp);
        $end_page =$pages[1];
        $start_page =$k->start_page;

    
        //XMLFİLES için
       // $gelen_yazarlar = "<name>" . isim_parcalama($yazar1) . "</name>" . "\n"."<affiliationId>1</affiliationId>". "\n"."<orcid_id>https://orcid.org/0000-0002-0000-0000</orcid_id>". "\n";
        for ($i = 0; $i < count($yazar); $i++) {
            // $yazarlar[$i] = "\n"."<author> ". "\n". "<name>" . isim_parcalama($yazar[$i]). "</name>" . "\n"."<affiliationId>1</affiliationId>". "\n"."<orcid_id>https://orcid.org/0000-0002-0000-0000</orcid_id>". "\n"."</author>". "\n";
           
            $yazarlar[$i] = "\n"."<author> ". "\n". "<name>" . $yazar[$i]. "</name>" . "\n"."<affiliationId>1</affiliationId>". "\n"."<orcid_id>https://orcid.org/0000-0002-0000-0000</orcid_id>". "\n"."</author>". "\n";
            $gelen_yazarlar = $gelen_yazarlar . $yazarlar[$i];
        }

 

   

        for ($i = 0; $i < count($anahtar_kelime); $i++) {
            $gelen_anahtar[$i] = "<keyword>" . $anahtar_kelime[$i] . "</keyword>" . "\n";
            $keywords = $keywords . $gelen_anahtar[$i];
        }

 //echo "test -----------10---------------"."<br>".$title."<br>". $volume. "<br>".$no."<br>". $yayin_yili."<br>". $gelen_yazarlar."<br>". $abstract."<br>". $keywords."<br>". $download_link."<br>". $paperID."<br>". $doi."<br>". $start_page. "<br>".$end_page ;
        
        $sonuc.=create_XML_DOAJ($title, $volume, $no, $yayin_yili, $gelen_yazarlar, $abstract, $keywords, $download_link, $paperID, $doi, $start_page, $end_page);
        
        //echo "<hr>  ".$sonuc;
      }
        
         $xml_text="<?xml version=\"1.0\" encoding=\"utf-8\"?>" . "\n\n" .
  "<records>" . "\n" .$sonuc.
"</records>" . "\n";

   
         
         
         
    $dosya_adi = "../jgate/doaj_" . $volume."_" .$no.".xml";
    $dosya = fopen($dosya_adi, "w");
    fwrite($dosya, $xml_text);
// Veriler dosyada yanyana yapışmasın ve okunduğunda düzgün görüntülenebilsin diye
// mesajın ardından <br> etiketini ve satır sonu karakterlerini
// (\r\n karakterleri) yaz...
    fwrite($dosya, "\r\n");
    /*
header('Content-Type: text/xml');
header('Content-Disposition: attachment; filename='.basename($dosya_adi));
header('Expires: -1');
header('Cache-Control: private');
header('Pragma: public');
header('Content-Length: ' . filesize($dosya_adi));
readfile($dosya_adi);
exit;
*/
// Dosyayı kapat. Başkaları da kullanabilsin...
    fclose($dosya);
// END : XML Dosyası
         
         
          echo "tamalandi--".$volume."--".$no;
     
// end : XMLFİLES için
   
        
        
        
        
        
        
        
        
        
        
        
        

        
            ?>
            
         
            
       


    </div>
</div>

<!-- /page content -->

<!-- footer content -->
<footer>
    <div class="pull-right">
        Makale Yönetimi @ 2017
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->

<script type="text/javascript">
    window.onresize = function () {
        window.resizeTo(630, 900);
    }
    window.onclick = function () {
        window.resizeTo(630, 900);
    }
</script>


<!-- jQuery -->
<script src="js/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="js/custom/custom.min.js"></script>
</body>
</html>


