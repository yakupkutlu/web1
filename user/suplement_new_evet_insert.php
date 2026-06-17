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

$event_id = $_GET["e_id"];
echo $event_id;
if (isset($_GET["process"])) $process = $_GET["process"];
else $process = "";
$pQuery = "Select * from supplementary_events where id='$event_id'";
$paperProp = mysqli_fetch_object(mysqli_query($baglanti,$pQuery));

$volume = $paperProp->volume;
$no = $paperProp->no;
$year = $paperProp->year;

$event_short_name	=	$paperProp->event_short_name;
$event_cite_name	=	$paperProp->event_cite_name;
$supplamentTittle	=	$paperProp->supplamentTittle;
$SupplementNo	=	$paperProp->SupplementNo;
$published_paperIDs	=	 $paperProp->published_paperIDs;
$yturu	=	$paperProp->yayin_turu;

 


if ($process == "") {
//INSERT INTO `supplementary_events`(`id`, `event_short_name`, `event_cite_name`, `suplementary_name`, 
       // `supplamentTittle`, `SupplementNo`, `published_paperIDs`, `yayin_turu`,
       // `year`, `volume`, `no`, `date`)
	

	 ?>
 <center><a class='btn btn-round btn-warning inbox-title'>New Event Info</a></center>
    <form class="form-horizontal form-label-left" method="post" action="suplement_new_evet_inserted.php">
       
       
  


        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Event Short Name:<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="event_short_name"  required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $event_short_name; ?>">
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Event Name with date:<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="event_cite_name" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $event_cite_name; ?>">
            </div>
        </div>
        
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><span
                        class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                ex: ARTICLES of INTERNATIONAL CONFERENCE on ARTIFICIAL INTELLIGENCE towards INDUSTRY 4.0 HELD in İSKENDERUN BETWEEN 14-16 NOVEMBER 2019
         </div>
        </div>
        
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Event Name without date:<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="supplamentTittle" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $supplamentTittle; ?>">
            </div>
        </div>
        
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><span
                        class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                ex: INTERNATIONAL CONFERENCE on ARTIFICIAL INTELLIGENCE towards INDUSTRY 4.0
         </div>
        </div>

 				<div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Supplement No:<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="SupplementNo" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $SupplementNo; ?>">
            </div>
        </div>   
        
         <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><span
                        class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                ex: SUPPLEMENT I
                
            </div>
        </div>
        
				<div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">published paper ID<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="published_paperIDs" id="published_paperIDs"  required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php if(isset($published_paperIDs))
                       echo $published_paperIDs;
                       else
                       echo "-"; ?>">
            </div>
        </div>    
  <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><span
                        class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                ex: 333,432,564 I
                
            </div>
        </div>        
          
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type of MS:<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="yturu" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $yturu; ?>">
            </div>
        </div>
         <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name"><span
                        class="required"></span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                2:Article 3:Abtract  4:Book
                
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Volume:<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="volume" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $volume; ?>">
            </div>
        </div>

        


        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Year:<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="year" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $year; ?>">
            </div>
        </div>
          <input type="hidden" name="eid"  value="<?php echo $event_id; ?>">

        <div class="form-group">

            <div style="text-align: center">
                <br>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
    <?php
}
 
   echo "</br>  <hr></br>  ";

    echo "<center><a class='btn btn-round btn-warning inbox-title'>Publishing Paper List  </a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th style='width: 5%;'>ID</th>
                <th style='width: 55%;'>Paper's Detail</th>
 					<th style='width: 10%;'>Paper  ID </th>
                <th style='text-align: center; width: 30%'>Process</th>
            </tr>
            </thead>
            <tbody>";

    if ($query = mysqli_query($baglanti,"select * from submission_list where accept=1 and publish=-1 and publish_status=0 ")) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            $title = $data["title"];
            $authors = $data["authors"];
            $pp = $data["pp"];
            $id = $data["id"];

            echo "<tr>";
            echo "<td>" . $sira . "</td>";
            $sira += 1;
            echo "<td style='width: 55%'><strong>" . $title . "</br>" . $authors . "</strong></td>";
            echo "<td style='width: 10%'>" . $id. "</td>";
					//upload pdf
					//download pdf
					//upload word
					//download word
					// show detail
            echo '<td align="center">
            <button onclick="myAddFunction(this.id)" id= "' . $id. '">Click to ADD</button>
             
            </td>';

            echo "</tr>";

        }
    }


    echo "</tbody>
        </table></br>   
        
        <hr></br>   
        
       ";
 
 
 ?>
 
<script>
function myAddFunction(clicked) {
  var x = document.getElementById("published_paperIDs").value;
  if (x=="-") {
  	document.getElementById("published_paperIDs").value =clicked; 
  }else {
  	document.getElementById("published_paperIDs").value = x+","+clicked; 
  }
  
  
}
</script>



