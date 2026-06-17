<?php
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

include("../system.php");
include("function.php");
include("../app/connect.php");

$yazılan=mysqli_query($baglanti,'Select * from submission_list where publish=1');
$adet = 0;

while ($yazılan_info = mysqli_fetch_array($yazılan)) {
    $gelen_yazarlar_jgate="";
    $keywords="";
    $gelen_yazarlar_OA="";
    $p_id = $yazılan_info["id"];

    $pQuery = "Select * from submission_list where id='$p_id'";
    $paperProp = mysqli_fetch_object(mysqli_query($baglanti,$pQuery));
    $paperTitle = $paperProp->title;
    $authors = $paperProp->authors;
    $references = $paperProp->references;
    $volume = $paperProp->volume;
    $no = $paperProp->no;
    $pp = $paperProp->pp;
    $start_page = $paperProp->start_page;
    if (!isset($start_page) || $start_page==null) $start_page=0;
    $year = $paperProp->year;

    //$sql = "update submission_list set publish=1 WHERE id ='$p_id'";
    //if (mysqli_query($baglanti,$sql)) {
    $download_str = "SELECT * FROM submission_list WHERE id = '$p_id'";
    $download_sorgu = mysqli_query($baglanti,$download_str);


   $k = mysqli_fetch_object($download_sorgu);
        $title = $k->title;
        $yazar1 = $k->name_surname;
        $yazar = explode(",", $k->authors);
        $anahtar_kelime = explode(",", $k->keyword);
        $abstract = $k->abstract;
        $download_link = $k->paperfile1;
        $paperID = $k->paperID;



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

// OA için
    for ($i = 0; $i < count($yazar); $i++) {
        $yazar_ad_soyad = isim_parcalama_jgate($yazar[$i]);
        $yazarlar_oa[$i] = "\t\t\t" . "<dc:creator>" . $yazar_ad_soyad[1] . "," . $yazar_ad_soyad[0] . "</dc:creator>\n";

        $gelen_yazarlar_OA = $gelen_yazarlar_OA . $yazarlar_oa[$i];
    }
// end : OA için


    //create_jgate($title, $volume, $year, $gelen_yazarlar_jgate, $abstract, $keywords, $download_link, $paperID);

    //create_OA($title, $year, $gelen_yazarlar_OA, $abstract, $paperID);

    echo $p_id . " id li bitti.<br><br>";
    //}
    $adet++;

}

echo "-------------------------------------<br>";
echo "toplamda xml" . $adet;
