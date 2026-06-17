<?php
$requestID = $_GET['id'];
$paperID = mysqli_fetch_object(mysqli_query($baglanti,"Select * from review_requests WHERE id='$requestID'"))->paperid;
$paper = mysqli_fetch_object(mysqli_query($baglanti,"Select * from submission_list WHERE id='$paperID'"));
$paperTitle = $paper->title;
$paperFile = $paper->paperID;
?>
<style>
    .comments {
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }

    .anahtar {
        color: #a94442;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-size: 14px;
        line-height: 1.42857143;
        margin-left: auto;
        margin-right: auto;
        text-align: center;

    }

</style>
<div class="comments">
    <div class="x_panel" style="text-align: left; background:#F7F7F7!important; border: none;">
        <h2>
            <center><b><?php echo $paperTitle; ?></b></center>
            <hr>
            <br><br>
        </h2>
        <div class="clearfix"></div>
        <div class="x_content">
            <br>
            <form class="form-horizontal form-label-left input_mask"
                  action="r_add_comment.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-group">
                        <?php
                        $dQuery = mysqli_query($baglanti,"select * from review_decision ");
                        while ($data = mysqli_fetch_array($dQuery)) {
                            ?>
                                 <?php if ($data["id"] == '3') {
                            
                        }else { ?>
                            <div class="radio">
                                <label>
                             
                                    <input type="radio" class="flat" checked name="iCheck"
                                           value="<?php echo $data['value']; ?>"> <?php echo $data['decision']; ?>
                                </label>
                            </div>
                           

                            <?php 
                             }
                             if ($data["id"] == '5') {
                                break;
                            }
                        } ?>
                    </div>
                    <br><br>
                    <table>
                        <tr>
                            <th width="25%"></th>
                            <th width="15%" style="text-align: center">too poor</th>
                            <th width="15%" style="text-align: center">poor</th>
                            <th width="15%" style="text-align: center">middle</th>
                            <th width="15%" style="text-align: center">good</th>
                            <th width="15%" style="text-align: center">very good</th>
                        </tr>
                        <tr>
                            <td>Quality of the paper</td>
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                ?>
                                <td style="text-align: center">
                                    <label>
                                        <input type="radio" class="flat" name="quality" checked
                                               value="<?php echo $i; ?>">
                                    </label>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>Newness and originality</td>
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                ?>
                                <td style="text-align: center">
                                    <label>
                                        <input type="radio" class="flat" name="newness" checked
                                               value="<?php echo $i; ?>">
                                    </label>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <tr>
                            <td>Contribution to the field</td>
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                ?>
                                <td style="text-align: center">
                                    <label>
                                        <input type="radio" class="flat" name="contribution" checked
                                               value="<?php echo $i; ?>">
                                    </label>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                    </table>
                </div>
                <br><br><br><br><br><br>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" style="text-align: left!important;">Message
                        To Author :</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                <textarea class="form-control" name="message" id="message" rows="3"
                          placeholder="Write your message..." required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" style="text-align: left!important;">Message
                        To Editor :</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                <textarea class="form-control" name="editor_message" rows="3"
                          placeholder="Write your message..." required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12"
                           style="color: #a94442; text-align: left!important;">Review Comment File :</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
                        <input type="file" name="my_file" id="my_file"  accept="odt, .doc, .docx, .pdf, .txt" class="rsform-upload-box"/>
                    </div>
                </div>





                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12"
                           style="color: #a94442;  text-align: left!important;">Reviewed MS File :</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="hidden" name="MAX_FILE_SIZE" value="5000000"/>
                        <input type="file" name="my_file_2" id="my_file_2" accept="odt, .doc, .docx, .pdf, .txt" class="rsform-upload-box"/>
                    </div>
                </div>



<script>
  function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // files is a FileList of File objects. List some properties.
    var output = [];
    for (var i = 0, f; f = files[i]; i++) {
      output.push( 'file size:   ',
                  f.size, ' bytes   ');
           var boyut=f.size;       
    } 
    if(boyut>5000000){
    	boyut=Math.round(boyut/1000000);
    	 alert('File size '+boyut + ' MB. The size is over requirement (max 5MB) ' );
   
 		} 
  }

  document.getElementById('my_file').addEventListener('change', handleFileSelect, false);
   document.getElementById('my_file_2').addEventListener('change', handleFileSelect, false);
  
  
  
  
</script>


                <div class="anahtar">
                    <span class="anahtar">Please do not upload over than 5 MB file!!!</span><br><br>
                </div>

                <div class="anahtar">
                    <span class="anahtar">Please upload WORD files!!!</span><br><br>
                </div>

                <input style="display: none" type="text" name="paperid" value="<?php echo $paperFile; ?>">
                <input style="display: none" type="text" name="r_id" value="<?php echo $requestID; ?>">

                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
                        <button type="submit" class="btn btn-success" >Send</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>