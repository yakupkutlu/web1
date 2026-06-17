<?php
$paperID=$_GET["id"];
$pQuery="Select * from submission_list where id=$paperID";
$paperProp=mysqli_fetch_object(mysqli_query($baglanti,$pQuery));
$paperTitle=$paperProp->title;
$p_id=$paperProp->id;


?>
<center><h2><?php echo $paperTitle ?></h2></center></br></br>
<form class="form-horizontal form-label-left" method="post" action="proof_correction_page_detail.php?id=<?php echo $p_id;?>">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Proof Correction <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <textarea class="form-control" name="message"  rows="10"></textarea>
        </div>
    </div>

    <div class="form-group">

        <div style="text-align: center">
            <br>
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </div>
</form>
