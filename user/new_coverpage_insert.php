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

$p_id = $_GET["p_id"];
if (isset($_GET["process"])) $process = $_GET["process"];
else $process = "";
$pQuery = "Select * from cover_files_path where id='$p_id'";
$paperProp = mysqli_fetch_object(mysqli_query($baglanti,$pQuery));

$volume = $paperProp->volume;
$no = $paperProp->no;
$year = $paperProp->year;




if ($process == "") { ?>
 <center><a class='btn btn-round btn-warning inbox-title'>New Issue Info</a></center>
    <form class="form-horizontal form-label-left" method="post" action="new_coverpage_inserted.php">
       
       
       

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
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Year<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="year" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $year; ?>">
            </div>
        </div>

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
 



