<?php

 


function isim_parcalama($gelen)
{
    $isim = explode(" ", trim($gelen));
    $ad = substr($isim[0], 0, 1);
    $soyad =end($isim);;
    $soyad_ad = $soyad . ", " . $ad . ".";
    return $soyad_ad;
}

function isim_parcalama_jgate($gelen)
{
    $isim = explode(" ", trim($gelen));
    $ad = $isim[0];
    $soyad = end($isim);
    $tmp[0] = $ad;
    $tmp[1] = $soyad;
    return $tmp;
}

$p_id = $_GET["p_id"];
if (isset($_GET["process"])) $process = $_GET["process"];
else $process = "";
$pQuery = "Select * from submission_list where id='$p_id'";
$paperProp = mysqli_fetch_object(mysqli_query($baglanti,$pQuery));
$paperTitle = $paperProp->title;
$authors = $paperProp->authors;
$keywords1 = $paperProp->keyword;
$pub_abstract = $paperProp->abstract;
$references = $paperProp->references;
$volume = $paperProp->volume;

 
$coverImage=$paperProp->coverImage;             
$submission_date=$paperProp->submission_date;  
$accept_date=$paperProp->accept_date;
$publish_date=$paperProp->publish_date;
$available_date=$paperProp->available_date;
$doi = $paperProp->doi;
$no = $paperProp->no;
$pp = $paperProp->pp;
$start_page = $paperProp->start_page;
$year = $paperProp->year;
$earlyview = $paperProp->earlyview;
$yturu= $paperProp-> yayin_turu;

if ($process == "publish") {
    $gelen_yazarlar_jgate = "";
    $keywords = "";
    $gelen_yazarlar_OA = "";
    $gelen_yazarlar_ICI = "";
    $references_ICI="";

    $sql = "update submission_list set publish=1 WHERE id ='$p_id'";
    if (mysqli_query($baglanti,$sql)) {
        $download_str = "SELECT * FROM submission_list WHERE id = '$p_id'";
        $download_sorgu = @mysqli_query($baglanti,$download_str);


        $k = mysqli_fetch_object($download_sorgu);
        $title = $k->title;
        $yazar1 = $k->name_surname;
        $yazar = explode(",", $k->authors);
        $keywords1 = $k->keyword;
        $anahtar_kelime = explode(",", $keywords1);
        $abstract = $k->abstract;
        $abstract =tirnak_replace($abstract);
        $volume=$k->volume;
        $no=$k->no;
        $download_link = $k->paperfile1;  
        $journalDomain="https://".$journalDomain;
        $download_link = str_replace("..", $journalDomain, $download_link);
        $doi = $k->doi;
        $paperID = $k->paperID;
        $yturu= $k-> yayin_turu;
        $publish_date=$k->publish_date;
        $year = $k->year;
        $pp = $k->pp;$endpage=  explode("-", $pp);
        $end_page=$endpage[1];
        
         $references =$k-> references;
         $references = str_replace("'", "", $references);
         $references = str_replace('"', '', $references);
         
         
      

        //XMLFİLES için
        $gelen_yazarlar = "<ags:creatorpersonal>" . isim_parcalama($yazar1) . "</ags:creatorpersonal>" . "\n";
        for ($i = 0; $i < count($yazar); $i++) {

            $yazarlar[$i] = "<ags:creatorpersonal>" . isim_parcalama($yazar[$i]) . "</ags:creatorpersonal>" . "\n";
            $gelen_yazarlar = $gelen_yazarlar . $yazarlar[$i];
        }

        for ($i = 0; $i < count($anahtar_kelime); $i++) {
            $gelen_anahtar[$i] = "<ags:subjectthesaurus xml:lang=\"eng\" scheme=\"ags:cabt\">" . $anahtar_kelime[$i] . "</ags:subjectthesaurus>" . "\n";
            $keywords = $keywords . $gelen_anahtar[$i];
        }

        create_XML($title, $gelen_yazarlar, $year, $keywords, $references, $abstract, $download_link, $pp, $volume, $no, $paperID);

// end : XMLFİLES için

// JGATE için
        for ($i = 0; $i < count($yazar); $i++) {
            $yazar_ad_soyad = isim_parcalama_jgate($yazar[$i]);
            $yazar_email = mysqli_fetch_object(mysqli_query($baglanti,"select * from users where name_surname='$yazar[$i]'"))->email;

            $yazarlar_jgate[$i] = "\t" . "<Author>" . "\n" .
                "\t\t" . "<FirstName>" . $yazar_ad_soyad[0] . " </FirstName>" . "\n" .
                "\t\t" . "<MiddleName> </MiddleName>" . "\n" .
                "\t\t" . "<LastName>" . $yazar_ad_soyad[1] . " </LastName>" . "\n" .
                "\t\t" . "<Affiliation> </Affiliation>" . "\n" .
                "\t\t" . "<AuthorEmails> " . $yazar_email . "</AuthorEmails>" . "\n" .
                "\t" . "</Author>" . "\n";

            $gelen_yazarlar_jgate = $gelen_yazarlar_jgate . $yazarlar_jgate[$i];
        }
// end : JGATE için
        create_jgate($title, $volume, $year, $gelen_yazarlar_jgate, $abstract, $keywords, $download_link, $paperID);

// OA için
        for ($i = 0; $i < count($yazar); $i++) {
            $yazar_ad_soyad = isim_parcalama_jgate($yazar[$i]);
            $yazarlar_oa[$i] = "\t\t\t" . "<dc:creator>" . $yazar_ad_soyad[1] . "," . $yazar_ad_soyad[0] . "</dc:creator>\n";

            $gelen_yazarlar_OA = $gelen_yazarlar_OA . $yazarlar_oa[$i];
        }
// end : OA için

        create_OA($title, $year, $gelen_yazarlar_OA, $abstract, $paperID);
        
// ICI coperniqus index

 
        for ($i = 0; $i < count($yazar); $i++) {
            $yazar_ad_soyad = isim_parcalama_jgate($yazar[$i]);
          
            $yazarlar_ICI[$i] = "\t" . "<author>" . "\n" .
                "\t\t" . "<name>" . $yazar_ad_soyad[0] . "</name>" . "\n" .
                "\t\t" . "<polishAffiliation>false</polishAffiliation>" . "\n" .
                "\t\t" . "<surname>" . $yazar_ad_soyad[1] . "</surname>" . "\n" .
                "\t\t" . "<instituteAffiliation> - </instituteAffiliation>" . "\n" .
                "\t\t" . "<order> " . ($i+1) . "</order>" . "\n" .
                "\t\t" . "<role>AUTHOR</role>" . "\n" .
                "\t" . "</author>" . "\n";
           

            $gelen_yazarlar_ICI = $gelen_yazarlar_ICI . $yazarlar_ICI[$i];
        }
        
    
      $keywords="";
       for ($i = 0; $i < count($anahtar_kelime); $i++) {
            $gelen_anahtar[$i] = "<keyword> " . trim($anahtar_kelime[$i]) . "</keyword>" . "\n";
            $keywords = $keywords . $gelen_anahtar[$i];
        }
        
      	
       
        $ref = explode("<br>", $references);
        
       
        $j=1;
		for ($i = 0; $i < count($ref); $i++) {
		    if($ref[$i]!=""){
		      
            $gelen_ref[$i] =  "\t" . "<reference>" . "\n" .
                "\t\t" . "<unparsedContent>" . trim($ref[$i]) . "</unparsedContent>" . "\n" . 
                "\t\t" . "<order>" . ($j++) . "</order>" . "\n" .
                "\t" . "</reference>" . "\n"; 
                $references_ICI = $references_ICI . $gelen_ref[$i];
		    }
        }

 			   $references_ICI = str_replace("&","",$references_ICI);

       
         create_XML_ICI($title, $volume, $no, $year, $gelen_yazarlar_ICI, $abstract, $keywords, $download_link, $paperID, $doi, $start_page, $end_page, $references_ICI,$publish_date );
      
        
        
        
        
        

        header("Refresh:1 URL=index.php?page=publishing_papers&m_id=12&rnb=2");

    } else echo "veritabanı hatası";
}
if ($process == "publishing") { ?>
    <form class="form-horizontal form-label-left" method="post" action="publish_paper_page.php?id=<?php echo $p_id; ?>">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="title" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $paperTitle; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Authors<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="authors" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $authors; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Abstract<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class="form-control" name="abstract" rows="12"><?php echo $pub_abstract; ?></textarea>
            </div>
        </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Key words<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="keywords1" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $keywords1; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">References<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class="form-control" name="references" rows="12"><?php echo $references; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Volume<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="volume" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $volume; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Number<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="number" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $no; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">PP<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="pp" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $pp; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Page Number<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="start_page" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $start_page; ?>">
            </div>
        </div>
<!--
   	 <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type of Paper<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="yturu" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php //echo $yturu; ?>">
            </div>
        </div>
        
        -->
  <div class="form-group">
      
      
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type of Paper<span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <select name="yturu" required="required" class="form-control col-md-7 col-xs-12">
            <option value="">Please select</option>
            <option value="1" <?php if (($yturu == '1') || ($yturu == '0') ) echo 'selected'; ?>> Article</option>
            <option value="2" <?php if ($yturu == '2') echo 'selected'; ?>>Symposium Article</option>
            <option value="3" <?php if ($yturu == '3') echo 'selected'; ?>>Abstract</option>
            <option value="4" <?php if ($yturu == '4') echo 'selected'; ?>>Book</option> 
        </select>
    </div>
</div>


        
 	 <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><span
                        class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                 1 (for article)<br> 2 (for Symposium Article) <br> 3 (for Abstract) <br> 4 (for Book)
            </div>
        </div>


       <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">DOI <span
                        class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="doi"  class="form-control col-md-7 col-xs-12"
                       value="<?php echo $doi; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Year<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="year" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $year; ?>">
            </div>
        </div>




    <!-- DATES -->
     <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Submission Date<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="submission_date" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $submission_date; ?>">
            </div>
        </div>
         <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Accept Date<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="accept_date" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $accept_date; ?>">
            </div>
        </div>

 <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Available Date<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="available_date" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $available_date; ?>">
            </div>
        </div>
 <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Publication Date<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="publish_date" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $publish_date; ?>">
            </div>
        </div>
        
        
        
        
         <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Graphical Abstract<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
               <img width='300px' src='<?php echo $coverImage; ?>' alt ="<?php echo $coverImage; ?>" >
            </div>
        </div>
        
         
                







  <br><br>
  
   <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Early View  / Fast Publication<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                 
                       
                  
                  
                   <input type="radio" id="yes" name="earlyview" value="1"  <?php if($earlyview==1){ echo "checked";} ?> >
                                    <label for="yes">Show in Early View Page</label><br>
                                    <input type="radio" id="no" name="earlyview" value="0"  <?php if($earlyview==0){ echo "checked";} ?>>
                                    <label for="no">Don't Show in Early View Page</label> 
                                    <br> 
<hr><span class="anahtar">*required</span>      
            </div>
        </div>
 

                                     


                                       <br><br>

        <div class="form-group">

            <div style="text-align: center">
                <br>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
    <?php
}

if ($process == "proof_message") {
    ?>
    <form class="form-horizontal form-label-left" method="post"
          action="accepted_paper_detail.php?process=proof&id=<?php echo $p_id; ?>">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Proof Correction<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class="form-control" name="message" rows="12"> 

<?php
    $sql_proff = mysqli_query($baglanti,"Select * from mailTable WHERE label ='proof_correction_mail'");
    $sql_proff_text  = mysqli_fetch_object($sql_proff);
    $text = $sql_proff_text->text;
    
    $text=replace_mail_content($text);
    echo $text;
 
  
 ?>  
                </textarea>
            </div>
        </div>


        <div class="form-group">

            <div style="text-align: center">
                <br>
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </div>
    </form>
    <?php
}

if ($process == "proof") {
    session_start();
    ob_start();
    include("../system.php");
    include("function.php");
    include("../app/connect.php");
    
    $p_id = $_GET["id"];
    $message = tirnak_replace($_POST["message"]);
    
    $sql_proff = mysqli_query($baglanti,"Select * from submission_list WHERE id ='$p_id'");
    $paperfile_info = mysqli_fetch_object($sql_proff);
    $paperfile = $paperfile_info->paperfile1;
    $to = $paperfile_info->email;
    if (preg_match_all("/\.pdf/", $paperfile)) {
        $sql = "update submission_list set publish_status=1,msg_proof_author='$message' WHERE id ='$p_id'";
        if (mysqli_query($baglanti,$sql)) {
            $log_state = $p_id . " id li makale PROOF A GÖNDERİLDİ";
            log_all($_SESSION["user"], $log_state);
            $subject="Proof Correction";
            mail_gonder($to, $subject, $message);
            MesajGoster("Paper Submitted Successfully .... [OK]");
            header("Refresh:1 URL=index.php?page=publishing_papers&m_id=12&rnb=2");

        } else {
            $log_state = "HATA ->" . $p_id . " id li makale PROOF A HATASI ->" . mysqli_error();
            log_all($_SESSION["user"], $log_state);
        }
    } else {
        MesajGoster("Please upload the paper pdf file");
        header("Refresh:1 URL=index.php?page=publishing_papers&m_id=12&rnb=2");
    }

}

if ($process == "") { ?>
    <center><h3><?php echo $paperTitle; ?></h3></center>
    <center><h5><?php echo $authors; ?></h5></center><br>
    <form class="form-horizontal form-label-left" method="post" action="publish_paper_page.php?id=<?php echo $p_id; ?>">
    
    
     <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="title" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $paperTitle; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Authors<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="authors" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $authors; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Abstract<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class="form-control" name="abstract" rows="12"><?php echo $pub_abstract; ?></textarea>
            </div>
        </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Key words<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="keywords1" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $keywords1; ?>">
            </div>
        </div>

    
    
    
    
    
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">References:<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class="form-control" name="references" rows="12"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Volume<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="volume" required="required" class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Number<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="number" required="required" class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">PP<span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="pp" required="required" class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Page Number<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="start_page" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $start_page; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Year<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="year" required="required" class="form-control col-md-7 col-xs-12">
            </div>
        </div>
        
        
  <div class="form-group">
      
      
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type of Paper<span class="required">*</span></label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <select name="yturu" required="required" class="form-control col-md-7 col-xs-12">
            <option value="">Please select</option>
            <option value="1" <?php if (($yturu == '1') || ($yturu == '0') ) echo 'selected'; ?>> Article</option>
            <option value="2" <?php if ($yturu == '2') echo 'selected'; ?>>Symposium Article</option>
            <option value="3" <?php if ($yturu == '3') echo 'selected'; ?>>Abstract</option>
            <option value="4" <?php if ($yturu == '4') echo 'selected'; ?>>Book</option> 
        </select>
    </div>
</div>

     <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">DOI <span
                        class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="doi"   class="form-control col-md-7 col-xs-12"
                       value="<?php echo $doi; ?>">
            </div>
        </div>

    <!-- DATES -->
    
      <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"> <span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h4>DATES</h4> format :  2024-07-12 
                
            </div>
        </div>
        
    
     <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Submission Date<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                
                <input type="text" name="submission_date" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $submission_date; ?>">  
            </div>
        </div>
         <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Accept Date<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="accept_date" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $accept_date; ?>">
            </div>
        </div>

 <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Available Date<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="available_date" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $available_date; ?>">
            </div>
        </div>
 <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Publication Date<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="publish_date" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $publish_date; ?>">
            </div>
        </div>
        
        
        
        
         <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Graphical Abstract<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
               <img width='300px' src='<?php echo $coverImage; ?>' alt ="<?php echo $coverImage; ?>" >
            </div>
        </div>
        
         
                







  <br><br>
  
   <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Early View  / Fast Publication<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                 
                       
                  
                  
                   <input type="radio" id="yes" name="earlyview" value="1"  <?php if($earlyview==1){ echo "checked";} ?> >
                                    <label for="yes">Show in Early View Page</label><br>
                                    <input type="radio" id="no" name="earlyview" value="0"  <?php if($earlyview==0){ echo "checked";} ?>>
                                    <label for="no">Don't Show in Early View Page</label> 
                                    <br> 
<hr><span class="anahtar">*required</span>      
            </div>
        </div>
 



                                       <br><br>

        <div class="form-group">

            <div style="text-align: center">
                <br>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
    <?php
}
?>




