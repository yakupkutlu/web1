<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Gerekli dosyaları include ediyoruz
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';

function yetki_kontrol($role_number, $page)
{
    global $baglanti;
    $yetki = false;
    include("../app/connect.php");

    $query = mysqli_query($baglanti,"Select * from menus where yetki='$role_number'");
    while ($data = mysqli_fetch_array($query)) {
        if ($page == $data["page"]) {
            $yetki = true;
            break;
        }
    }

    return $yetki;
}

function replace_mail_content($text)
{
    include("../app/connect.php");
    
    // PHP 8 Uyumluluğu: Değişkenlerin tanımsız/boş olma ihtimaline karşı ?? eklendi
    $text = str_replace("[[journalName]]", $journalName ?? "", $text);
    $text = str_replace("[[journalShortName]]", $journalShortName ?? "", $text);
    $text = str_replace("[[journalEditorChef]]", $journalEditorChef ?? "", $text);
    $text = str_replace("[[journalISSN]]", $journalISSN ?? "", $text);
    $text = str_replace("[[journalDomain]]", $journalDomain ?? "", $text);
    $text = str_replace("[[journalMail]]", $journalMail ?? "", $text);
    $text = str_replace("[[jEditorChefMail]]", $jEditorChefMail ?? "", $text);
    $text = str_replace("[[paperIDstart]]", $paperIDstart ?? "", $text);
    
    return $text;
}

function find_image($user_name)
{
    $dir = 'images';
    $files = scandir($dir);
    $user_image = "";
    foreach ($files as $image) {
        if (preg_match("/" . $user_name . "/", $image))
            $user_image = $image;
    }

    if ($user_image == "") $user_image = "user.png";
    echo $user_image;
}

function mail_gonder($to, $subject, $message)
{
    global $journalName;
    $jName = $journalName ?? 'JAIwA'; // PHP 8 Uyumluluğu

    $mail = new PHPMailer(true);

    try {
        // SMTP Sunucu Ayarları
        $mail->SMTPDebug = 0;                                       
        $mail->isSMTP();                                            
        $mail->Host       = 'journalaiwa.com';                  
        $mail->SMTPAuth   = true;                                   
        $mail->Username   = 'info@journalaiwa.com';             
        $mail->Password   = 'Asd123.456.';                          
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
        $mail->Port       = 465;                                    
        
        $mail->setFrom('info@journalaiwa.com', $jName); 

        // Alıcı Ayarları
        $mail->addAddress($to); 
        
        if ($subject != "Password Reset Request"){
            $mail->addBCC("yakupkutlu@gmail.com");  
            $mail->addBCC("cemal.turan@yahoo.com"); 
            $mail->addBCC("ali.uyan@yahoo.com");
        }
        
        // İçerik
        $mail->isHTML(true); 
        $mail->CharSet = 'utf-8';
        $mail->Subject = $subject;
        $mail->Body    = $message;

        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    } catch (Exception $e) {
        // Hata durumunda sistemin çökmemesi için sessizce false dönüyoruz
        return false;
    }
} // END: mail_gonder()

function send_message($message, $to, $send, $role)
{
    global $baglanti;
    $date = date("Y-m-d");

    if ($role == 2) {
        // editörlere ve baş editöre
        $messageQuery = mysqli_query($baglanti,"select * from users where role=1 or role=2");
        while ($data = mysqli_fetch_array($messageQuery)) {
            $user_name = $data["user_name"];
            mysqli_query($baglanti,"insert into message_table (user_name,message,gonderen,`date`) VALUES ('$user_name','$message','$send','$date')");
        }
    }
    
    if ($role == 3) {
        // hakeme
    }
    
    if ($role == 4) {
        // yazara
        $yQuery = "insert into message_table (user_name,message,gonderen,`date`) VALUES ('$to','$message','$send','$date')";
        mysqli_query($baglanti,$yQuery);
    }
}

function create_XML($title, $gelen_yazarlar, $yayin_yili, $keywords, $referans, $abstract, $download_link, $pp, $volume, $no, $paperID)
{
    global $journalMail, $journalDomain, $journalName;
    $jMail = $journalMail ?? "";
    $jDomain = $journalDomain ?? "";
    $jName = $journalName ?? "";

    $xml_text = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" . "\n" .
        "<!DOCTYPE  ags:resources\n SYSTEM  \"http://purl.org/agmes/agrisap/dtd/\">" . "\n\n" .
        "<ags:resources xmlns:ags=\"http://purl.org/agmes/1.1/\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\" xmlns:agls=\"http://www.naa.gov.au/recordkeeping/gov_online/agls/1.2\" xmlns:dcterms=\"http://purl.org/dc/terms/\">" . "\n" .
        "<ags:resource ags:arn=\"tr2016000001\">" . "\n" .
        "<dc:title xml:lang=\"eng\">" . $title . "</dc:title>" . "\n" .
        "<dc:creator>" . "\n\n" .
        $gelen_yazarlar . "\n\n\n\n" .
        "</dc:creator>" . "\n" .
        "<dc:date>" . "\n" .
        "<dcterms:dateissued>" . $yayin_yili . "</dcterms:dateissued>" . "\n" .
        "</dc:date>" . "\n\n" .
        "<dc:subject>" . "\n" .
        "<ags:subjectclassification scheme=\"ags:asc\">" . "p10" . "</ags:subjectclassification>" . "\n" .
        $keywords . "\n" .
        "</dc:subject>" . "\n\n" .
        "<dc:description>" . "\n" .
        "<ags:descriptionnotes>" . $referans . "</ags:descriptionnotes>" . "\n\n\n" .
        "<dcterms:abstract xml:lang=\"eng\">" . $abstract . "</dcterms:abstract>" . "\n\n" .
        "</dc:description>" . "\n\n\n" .
        "<dc:identifier scheme=\"dcterms:uri\">" . $download_link . "</dc:identifier>" . "\n" .
        "<dc:format>" . "\n" .
        "<dcterms:extent>" . $pp . "</dcterms:extent>" . "\n" .
        "<dcterms:medium>" . "internet" . "</dcterms:medium>" . "\n" .
        "</dc:format>" . "\n" .
        "<dc:language scheme=\"ags:iso639-1\">" . "en" . "</dc:language>" . "\n" .
        "<agls:availability>" . "\n\n\n" .
        "<ags:availabilitylocation>" . "doga ve bilim dernegi,  iskenderun, hatay, 31200, turkey. ".$jMail." http://" .$jDomain. "</ags:availabilitylocation>" . "\n" .
        "<ags:availabilityNumber>" . "Vol." . $volume . " " . "No." . $no . "</ags:availabilityNumber>" . "\n\n" .
        "</agls:availability>" . "\n\n" .
        "<ags:citation>" . "\n" .
        "<ags:citationtitle xml:lang=\"eng\">" . "".$jName."" . "</ags:citationtitle>" . "\n" .
        "<ags:citationchronology>" . "2016" . "</ags:citationchronology>" . "\n" .
        "</ags:citation>" . "\n" .
        "</ags:resource>" . "\n" .
        "</ags:resources>" . "\n";

    $dosya_adi = "../XMLfiles/" . $paperID . ".xml";
    $dosya = fopen($dosya_adi, "w");
    if($dosya) {
        fwrite($dosya, $xml_text);
        fwrite($dosya, "\r\n");
        fclose($dosya);
    }
}

function create_jgate($title, $volume, $yayin_yili, $gelen_yazarlar_jgate, $abstract, $keywords, $download_link, $paperID)
{
    global $journalDomain, $journalShortName;
    $jDomain = $journalDomain ?? "";
    $jShortName = $journalShortName ?? "";

    $xml_text = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" . "\n\n" .
        "<ArticleSet>" . "\n" .
        "\t" . "<Article>" . "\n" .
        "\t\t" . "<Journal>" . "\n" .
        "\t\t\t" . "<PublisherName>".$jDomain."</PublisherName>" . "\n" .
        "\t\t\t" . "<JournalTitle>".$jShortName." </JournalTitle>" . "\n" .
        "\t\t\t" . "<PISSN>PISSN</PISSN>" . "\n" .
        "\t\t\t" . "<EISSN>EISSN</EISSN>" . "\n" .
        "\t\t\t" . "<Volume>" . $volume . " </Volume>" . "\n" .
        "\t\t\t" . "<Issue> </Issue>" . "\n" .
        "\t\t\t" . "<PubDate PubStatus=\"epublish\">" . "\n" .
        "\t\t\t\t" . "<Year>" . $yayin_yili . " </Year>" . "\n" .
        "\t\t\t\t" . "<Month>-</Month>" . "\n" .
        "\t\t\t\t" . "<Day>-</Day>" . "\n" .
        "\t\t\t" . "</PubDate>" . "\n" .
        "\t\t" . "</Journal>" . "\n\n" .
        "<ArticleTitle>" . $title . "</ArticleTitle>" . "\n" .
        "<FirstPage>-</FirstPage>" . "\n" .
        "<LastPage>-</LastPage>" . "\n" .
        "<Language>EN</Language>" . "\n" .
        "<AuthorList>" . "\n" .
        $gelen_yazarlar_jgate .
        "</AuthorList>" . "\n" .
        "<DOI> </DOI>" . "\n" .
        "<Abstract>" . $abstract . "</Abstract>" . "\n" .
        "<Keywords>" . $keywords . "</Keywords>" . "\n" .
        "<URLs>" . "\n" .
        "\t" . "<abstract>Abstract URL</abstract>" . "\n" .
        "\t" . "<Fulltext>" . "\n" .
        "\t\t" . "<pdf>" . $download_link . "</pdf>" . "\n" .
        "\t" . "</Fulltext>" . "\n" .
        "</URLs>" . "\n\n" .
        "\t" . "</Article>" . "\n" .
        "</ArticleSet>" . "\n";

    $dosya_adi = "../jgate/" . $paperID . ".xml";
    $dosya = fopen($dosya_adi, "w");
    if($dosya) {
        fwrite($dosya, $xml_text);
        fwrite($dosya, "\r\n");
        fclose($dosya);
    }
}

function create_XML_DOAJ($title, $volume, $no, $yayin_yili, $gelen_yazarlar, $abstract, $keywords, $download_link, $paperID, $doi, $start_page, $end_page)
{
    global $journalDomain, $journalName;
    $jDomain = $journalDomain ?? "";
    $jName = $journalName ?? "";

    $xml_text = "";
    $xml_text .=  "<record>
    <language>eng</language>
    <publisher>".$jDomain." </publisher>
    <journalTitle>".$jName."</journalTitle>
    <issn>2458-8989</issn>
    <eissn>2458-8989</eissn>
    <publicationDate>". $yayin_yili ."</publicationDate>
    <volume>". $volume  ."</volume>
    <issue>". $no  ."</issue>
    <startPage>". $start_page  ." </startPage>
    <endPage>". $end_page  ."</endPage>
    <doi>". $doi  ."</doi>
    <publisherRecordId>". $paperID ."</publisherRecordId>
    <documentType>article</documentType>
    <title language=\"eng\">" . $title . "</title>
    <authors>".
      $gelen_yazarlar. 
    "</authors>
    <affiliationsList>
      <affiliationName affiliationId=\"1\">İSTE</affiliationName>
    </affiliationsList>
    <abstract language=\"eng\">" . $abstract . "</abstract>
    <fullTextUrl format=\"pdf\">" . $download_link . "</fullTextUrl>
    <keywords language=\"eng\">
      ".$keywords."
    </keywords>
  </record>". "\n";

  return $xml_text;
}

function create_XML_ICI($title, $volume, $no, $yayin_yili, $gelen_yazarlar, $abstract, $keywords, $download_link, $paperID, $doi, $start_page, $end_page, $references1, $publicationDate )
{
    global $journalDomain;
    $jDomain = $journalDomain ?? "";

    $xml_text = '<ici-import>
    <journal issn="3023-7343"/>
    <issue number="[[no]]" volume="[[volume]]" year="[[year]]" publicationDate="[[publicationDate]]" coverDate="[[year]]" coverUrl="https://'. $jDomain.'/images/Tetshy_cover.png" numberOfArticles="1">
    
        <article externalId="[[externalId]]">
            <type>ORIGINAL_ARTICLE</type>
            <languageVersion externalId="[[externalId]]" language="en">
                <title>[[title]]</title>
                <abstract>[[abstract]] </abstract>
                <pdfFileUrl>[[pdfFileUrl]]</pdfFileUrl>
                <publicationDate>[[publicationDate]]</publicationDate>
                <pageFrom>[[pageFrom]]</pageFrom>
                <pageTo>[[pageTo]]</pageTo>
                <doi>[[doi]]</doi>
                <keywords> [[<keyword>...</keyword>]] </keywords>
            </languageVersion>
            
            <authors>[[<author>...</author>]]</authors>
            <references>[[<reference>...</reference>]] </references>
        </article>
    </issue>
    
</ici-import>';

    $xml_text = str_replace("[[publicationDate]]", $publicationDate ?? "", $xml_text);
    $xml_text = str_replace("[[externalId]]", $paperID ?? "", $xml_text);
    $xml_text = str_replace("[[year]]", $yayin_yili ?? "", $xml_text);
    $xml_text = str_replace("[[volume]]", $volume ?? "", $xml_text);
    $xml_text = str_replace("[[no]]", $no ?? "", $xml_text);
    $xml_text = str_replace("[[title]]", $title ?? "", $xml_text);
    $xml_text = str_replace("[[abstract]]", $abstract ?? "", $xml_text);
    $xml_text = str_replace("[[pageFrom]]", $start_page ?? "", $xml_text);
    $xml_text = str_replace("[[pageTo]]", $end_page ?? "", $xml_text);
    $xml_text = str_replace("[[doi]]", $doi ?? "", $xml_text);
    $xml_text = str_replace("[[pdfFileUrl]]", $download_link ?? "", $xml_text);
    $xml_text = str_replace(" [[<keyword>...</keyword>]]", $keywords ?? "", $xml_text);
    $xml_text = str_replace("[[<author>...</author>]]", $gelen_yazarlar ?? "", $xml_text);
    $xml_text = str_replace("[[<reference>...</reference>]]", $references1 ?? "", $xml_text);

    $directory = "../XMLfiles/";
    $dosya_adi = $directory . "ICI_".$paperID . ".xml";

    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }

    $dosya = fopen($dosya_adi, "w");
    if ($dosya) {
        fwrite($dosya, $xml_text);
        fwrite($dosya, "\r\n");
        fclose($dosya);
    }
}

function create_OA($title, $yayin_yili, $gelen_yazarlar_OA, $abstract, $paperID)
{
    global $journalDomain;
    $jDomain = $journalDomain ?? "";

    $date = date("Y-m-d");
    $time = date("h:i:s");
    $xml_text = "<?xml version=\"1.0\" encoding=\"utf-8\"?>" . "\n" .
        "<?xml-stylesheet type='text/xsl' href='/oai.xsl' ?>" . "\n" .
        "<OAI-PMH xmlns=\"http://www.openarchives.org/OAI/2.0/\"" . "\n" .
        "\t" . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"" . "\n" .
        "\t" . "xsi:schemaLocation=\"http://www.openarchives.org/OAI/2.0/" . "\n" .
        "\t" . "http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd\">" . "\n" .
        "<responseDate>" . $date . "T" . $time . "Z</responseDate>" . "\n" .
        "<request verb=\"ListRecords\" metadataPrefix=\"oai_dc\" identifier=\"oai:publications.copernicus.org:acp30709\">http://".$jDomain."/OAfile/" . $paperID . ".</request>" . "\n" .
        "\t" . "<ListRecords>" . "\n" .
        "\t" . "<record>" . "\n" .
        "\t" . "<header>" . "\n" .
        "\t\t" . "<identifier>".$jDomain."/OAfile/" . $paperID . "xsd</identifier>" . "\n\n" .
        "\t\t" . "<datestamp>" . $yayin_yili . "-01-01 </datestamp>" . "\n" .
        "\t\t" . "<setSpec>acp</setSpec>" . "\n" .
        "\t\t" . "</header>" . "\n" .
        "\t\t" . "<metadata>" . "\n" .
        "\t\t" . "<oai_dc:dc" . "\n" .
        "\t\t\t" . "xmlns:oai_dc=\"http://www.openarchives.org/OAI/2.0/oai_dc/\"" . "\n" .
        "\t\t\t" . "xmlns:dc=\"http://purl.org/dc/elements/1.1/\"" . "\n" .
        "\t\t\t" . "xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"" . "\n" .
        "\t\t\t" . "xsi:schemaLocation=\"http://www.openarchives.org/OAI/2.0/oai_dc/" . "\n" .
        "\t\t\t" . "http://www.openarchives.org/OAI/2.0/oai_dc.xsd\">" . "\n" .
        "\t\t\t" . "<dc:title><![CDATA[" . $title . "]]></dc:title>" . "\n" .
        $gelen_yazarlar_OA .
        "\t\t\t" . "<dc:description><![CDATA[" . $abstract . "]]></dc:description>" . "\n" .
        "\t\t\t" . "<dc:date>" . $yayin_yili . "-01-01</dc:date>" . "\n" .
        "\t\t\t" . "<dc:type>Text</dc:type>" . "\n" .
        "\t\t\t" . "<dc:format>application/pdf</dc:format>" . "\n" .
        "\t\t\t" . "<dc:identifier>-</dc:identifier>" . "\n" .
        "\t\t\t" . "<dc:identifier>-</dc:identifier>" . "\n" .
        "\t\t\t" . "<dc:source>-</dc:source>" . "\n" .
        "\t\t\t" . "<dc:language>eng</dc:language>" . "\n" .
        "\t\t" . "</oai_dc:dc>" . "\n" .
        "\t" . "</metadata>" . "\n" .
        "\t" . "</record>" . "\n" .
        "</ListRecords>" . "\n" .
        "</OAI-PMH>" . "\n";

    $dosya_adi = "../OAfile/" . $paperID . ".xsd";
    $dosya = fopen($dosya_adi, "w");
    if($dosya) {
        fwrite($dosya, $xml_text);
        fwrite($dosya, "\r\n");
        fclose($dosya);
    }
}

function change_str($str)
{
    $find = array("ü", "ğ", "ı", "ş", "ç", "ö", "Ü", "Ğ", "İ", "Ş", "Ç", "Ö");
    $change = array("u", "g", "i", "s", "c", "o", "U", "G", "I", "S", "C", "O");
    return str_replace($find, $change, $str ?? ""); // PHP 8 strict type fix
}

function create_thank_text($tarih, $reviewer, $title, $thank_file_name, $paperID)
{
    global $journalName, $journalShortName, $journalEditorChef, $journalLogo;
    $jName = $journalName ?? "";
    $jShortName = $journalShortName ?? "";
    $jEditorChef = $journalEditorChef ?? "";
    $jLogo = $journalLogo ?? "";

    require_once '../PHPWord.php';
    $PHPWord = new PHPWord();
    $section = $PHPWord->createSection();

    $reviewer = change_str($reviewer);

    $kisi = "Dear " . $reviewer . ",";
    $txt1 = "Thank you for reviewing the manuscript " . $paperID . " entitled \"  " . $title . " \" for the ".$jName." (".$jShortName.").";
    $txt2 = "On behalf of the Editors of ".$jName.", we appreciate the voluntary contribution that each reviewer gives to the Journal. We thank you for your participation in the online review process and hope that we may call upon you again to review future manuscripts.";
    $txt3 = "I wish you success for your research,";
    $txt4 = "Sincerely,";
    $txt5 = $jEditorChef;
    $txt6 = "Editor in Chief, ".$jShortName;

    if($jLogo != "") {
        $section->addImage($jLogo, array('width' => 570, 'height' => 170, 'align' => 'center'));
    }
    
    $section->addTextBreak(2);
    $section->addText($tarih);
    $section->addTextBreak(1);
    $section->addText($kisi, array('name' => 'Times New Roman', 'size' => '12', 'align' => 'both'));
    $section->addTextBreak(1);
    $section->addText($txt1, array('name' => 'Times New Roman', 'size' => '12', 'align' => 'both'));
    $section->addTextBreak(1);
    $section->addText($txt2, array('name' => 'Times New Roman', 'size' => '12', 'align' => 'both'));
    $section->addTextBreak(1);
    $section->addText($txt3, array('name' => 'Times New Roman', 'size' => '12', 'align' => 'both'));
    $section->addTextBreak(1);
    $section->addText($txt4, array('name' => 'Times New Roman', 'size' => '12', 'align' => 'both'));
    $section->addTextBreak(1);
    $section->addText($txt5, array('name' => 'Times New Roman', 'size' => '12', 'align' => 'both'));
    $section->addText($txt6, array('name' => 'Times New Roman', 'size' => '12', 'align' => 'both'));
    $section->addTextBreak(1);

    $objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
    $objWriter->save('../thankfile/' . $thank_file_name);
}

function tirnak_replace($par)
{
    // PHP 8 null koruması eklendi
    return str_replace(
        array("'", "\""),
        array("&#39;", "&quot;"),
        $par ?? "" 
    );
}

function _yonlendir($page)
{
    echo "<meta content='0; URL=$page' http-equiv='refresh'>";
}

?>