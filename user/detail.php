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
        <td style="width:6%"><a href='index.php?page=cited&authors_id=<?php echo $id;?>'>Cited :</a></td>
        <td style="width:20%;" align="left"><a href='index.php?page=cited&authors_id=<?php echo $id;?>'><?php echo $cited; ?></a></td>
    </tr>
    <tr>
        <td colspan="6"></br> </td>
    </tr>
</table></br>
<p>&nbsp;</p>
<h1> <?php echo $title; ?> </h1>
<b><?php echo $authors; ?></b></br></br>
<h3>Abstract</h3>

<p><?php echo $abstract; ?></p>


<h3>Keywords</h3>
<?php echo $keywords; ?>


<p>&nbsp;</p>
<p> Volume <?php echo $volume; ?>, No <?php echo $no; ?>,
    <?php
    // IGW yayınlarının SUPPLEMENTARY olduğunu belirtmek için
    if ($volume == 1 and $no == 3 and $year == 2016 and $publish_date == '2016-10-10') echo "Supplement, ";
    ?>
    <?php echo $pp; ?>, <?php echo $year; ?> </p>

<a href="download.php?id=<?php echo $id; ?>" target="_blank"><img src="images/pdf_icon.jpg" width="25" heght="25"> Download full text</a>
&nbsp; | &nbsp;
<strong><a onclick='open_citation("<?php echo $citeStr; ?>")' style='cursor: hand; cursor: pointer;'> How to Cite </a></strong>&nbsp; |
&nbsp;
<a href="download_XML.php?id=<?php echo $id; ?>"> Download XML Files </a>

<br><br>

<strong> References </strong>
<?php echo $references; ?>

