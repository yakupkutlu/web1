<?php
// Bu sayfa abstract_info.php içinde include ile çağrılıyor. Burada kullanılan PHP değişkenleri abstract_info.php sayfasında oluşturuluyor.
$accept_str = "UPDATE submission_list SET view = view+1 WHERE id = $id";
$sorgu = @mysqli_query($baglanti,$accept_str);

?>
</br>
<table width="100%" align="right" bgcolor="#f0f8ff">
    <th align="left" colspan="6" height="30px">This Article Statistics</th>

    <tr>
        <td style="width:8%">Viewed :</td>
        <td style="width:20%;" align="left"><?php echo $view; ?></td>
        <td style="width:12%">Downloaded :</td>
        <td style="width:20%;" align="left"><?php echo $download; ?></td>
<!--
        <td style="width:6%"><a style="color:#000000 " href='index.php?page=cited&authors_id=<?php echo $id;?>'>Cited :</a></td>
        <td style="width:20%;" align="left"><a style="color:#000000 " href='index.php?page=cited&authors_id=<?php echo $id;?>'><?php echo $cited; ?></a></td>
  --> 
    </tr>
    <tr>
        <td colspan="6"></br> </td>
    </tr>
</table></br>
<p>&nbsp;</p>
<h1> <?php echo $title; ?> </h1>
<b><?php echo $authors; ?></b></br></br>
<?php
if($doi != ""){
	echo "DOI: <a href='http://dx.doi.org/$doi' target='_blank'>$doi</a><br>";
}
if($yayin_turu==4) 
{

$citeStr = $bilgi2["howtocite"];
}
else {
				
echo "<h3>Abstract</h3><p>";

echo $abstract;
echo " </p>";

}
				?>

<h3>Keywords</h3>
<?php echo $keywords; ?>
 

<br>
    <?php

$sorgu1 = "SELECT * FROM supplementary_events WHERE  volume=$volume AND no=$no AND  year=$year AND yayin_turu=$yayin_turu ";
$sorgu2 = mysqli_query($baglanti,$sorgu1);

while($result2=@mysqli_fetch_array($sorgu2)) {
	
$SupplementNo=$result2["SupplementNo"];

if($yayin_turu==3||$yayin_turu==4) { 
 echo $SupplementNo.", ".$year."<br>";
}elseif($yayin_turu==2) {
	echo "<br> 
<p> Volume $volume, No $no, $SupplementNo, pp $pp, $year </p><br> ";	
}else {
	echo "<br> 
<p> Volume $volume, No $no,  pp $pp, $year </p><br> ";	
}



    // IGW-2016 yayınlarının SUPPLEMENTARY olduğunu belirtmek için
   if($yayin_turu==3) {
	// echo $SupplementNo."<br>";
	 } 
	
	// PUFFERFISH-2017 yayınlarının SUPPLEMENTARY olduğunu belirtmek için
   // if ($volume == 2 and $no == 3 and $year == 2017 and $publish_date == '2017-12-19') echo "Supplement, ";
}
    ?>
  


<br>
 

 
 <?php


   // suplemente yayın_turu =2 ve 3 olanlardır 2 text tanımlıyor ,  3 absaract tanımlıyor
    // PUFFERFISH-2017 yayınlarının SUPPLEMENTARY olduğunu belirtmek için
    // IGW-2016 yayınlarının SUPPLEMENTARY olduğunu belirtmek için
   
$down_text='<a href="download.php?id='.$id.'" target="_blank"><img src="images/pdf_icon.jpg" width="25" heght="25"> Download full text</a>';
$down_abs='<a href="download.php?id='.$id.'" target="_blank"><img src="images/pdf_icon.jpg" width="25" heght="25"> Download Abstract</a>';

 if($yayin_turu==3) {
	 echo $down_abs;
	 } else {
	 	echo $down_text;
	 }
  
	
	
   
    
    
    
    
    ?>



&nbsp; | &nbsp;
<strong><a onclick='open_citation("<?php echo $citeStr; ?>")' style='cursor: hand; cursor: pointer;'> How to Cite </a></strong>&nbsp; |
&nbsp;
<a href="download_XML.php?id=<?php echo $id; ?>"> Download XML Files </a>

<br><br>

<strong> References </strong>
<?php
if (!preg_match_all("/<ul>/",$references)){
    $references=str_replace("<br>","<li>",$references);
    $references="<ul>".$references."</ul></br>";
}
echo $references;
?>

