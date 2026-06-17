<?php
$paper_id = $_GET["paper_id"];
$state=$_GET["state"];
$pQuery = mysqli_fetch_object(mysqli_query($baglanti,"select * from submission_list where id='$paper_id'"));
$title = $pQuery->title;
$author = $pQuery->authors;
if ($author == "") $author = $pQuery->name_surname;
?>

<style>
    .comments {
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
    }
</style>
<h2>
    <center><a class='btn btn-round btn-warning inbox-title'>Accept Paper</a></center>
</h2><br><br>
<center>
    <table class="table" style="width: 50%;">
        <tr>
            <td style="width: 15%"><b>Title</b></td style="width: 85%">
            <td><?php echo $title; ?></td>
        </tr>
        <tr>
            <td style="width: 15%"><b>Author</b></td style="width: 85%">
            <td><?php echo $author; ?></td>
        </tr>
    </table>
</center>
<div class="comments">
    <div class="x_panel" style="text-align: left; background:#F7F7F7!important; border: none;">
        <div class="clearfix"></div>
        <div class="x_content">
            <br>
            <form class="form-horizontal form-label-left input_mask"
                  action="r_add_comment_decision.php?paper_id=<?php echo $paper_id; ?>&state=<?php echo $state; ?>" method="post"
                  enctype="multipart/form-data">
                <div class="form-group">
                    <?php
                    if (isset($_GET["state"]))
                        $dQuery = mysqli_query($baglanti,"select * from editor_decision");
                    else $dQuery = mysqli_query($baglanti,"select * from editor_decision");
                    while ($data = mysqli_fetch_array($dQuery)) {
                        ?>
                        <div class="radio">
                            <label>
                          
                                <input type="radio" class="flat" checked name="iCheck"
                                       value="<?php echo $data['value'].'-'.$data['decision']; ?>"> <?php echo $data['decision']; ?>
                            </label>
                        </div>
                        <?php if ($data["id"] == '5') {
                            break;
                        }
                    } ?>
                </div>
                <br><br><br><br>

                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="first-name">The Manuscript is accepted as:
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <select name="editor_decision" id="editor_decision" class="select2_single form-control">
                            <option value="NULL">Editor Decision</option>
                            <option value="Research Article">Research Article</option>
                            <option value="Review Article">Review Article</option>
                            <option value="Technical Notes">Technical Notes</option>
                            <option value="Short Communications">Short Communications</option>
                        </select>
                    </div>
                </div>
                <br><br><br><br>
                The Corresponding Author also will be informed with Reviewer's Decisions and Reports appearing
                below:<br><br>
                <?php
                $reportQuery = mysqli_query($baglanti,"select * from review_requests where paperid='$paper_id'");
                $s = 1;
                while ($rq = mysqli_fetch_array($reportQuery)) {
                    $status = $rq["acceptance_status"];
                    $rqQuery = "select * from review_decision where `value`='$status'";
                    $decision = mysqli_fetch_object(mysqli_query($baglanti,$rqQuery))->decision;
                    ?>
						 
                    <input type="checkbox" name="reviewers[]" value=" 
                    
                    <?php
                   echo '<b>Reviewers Decision:</b>' . $decision . '<br>';
                   
                    echo '<b>Message To Author:</b>' . $rq["paper_report"] . '<br>';
                    if (($rq["report_file"] != "") && ($rq["report_file"] != 'NULL')) {
                        $file = explode('/', $rq["report_file"]);
                        echo '<b> Review Comment File: </b> in system if there is Reviewer Comment file</a> ';
                    }
                    if (($rq["report_file_2"] != "") && ($rq["report_file_2"] != 'NULL')) {
                        $file = explode('/', $rq["report_file_2"]);
                        echo '<br><b> Reviewed MS File: </b>  in system if there is Reviewed Paper File</a>';
                    }
                    echo '<br> ';
                    echo 'table_id='.$rq['id'];
                    
                    ?> 
                   
                  ">
                 
                 
                    <b>REVIEWER <?php echo $s++; ?></b> (<?php echo $rq['id']; ?>)<br>
                    <b>Reviewer's Decision:</b> <?php
                    echo $decision; ?><br>
                    <b>Message To Author:</b><?php echo $rq["paper_report"];

                    if (($rq["report_file"] != "") && ($rq["report_file"] != "NULL")) {

                        echo "<br><b> Review Comment File: </b>";
                        $file = explode('/', $rq["report_file"]);
                        echo '<a href="http://'.$journalDomain.'//' . $rq["report_file"] . ' " style="color:blue">' . $file[2] . '</a>';
                    }

                    if (($rq["report_file_2"] != "") && ($rq["report_file_2"] != "NULL")) {

                        echo "<br><b> Reviewed MS File: </b>";
                        $file = explode('/', $rq["report_file_2"]);
                        echo '<a href="http://'.$journalDomain.'//' . $rq["report_file_2"] . '"  style="color:blue">' . $file[2] . '</a>';
                    }

                    ?>
                    <hr><br>
                     
                <?php } ?>
                <hr>
                <div class="form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" style="text-align: left!important;"> Other
                        Comment:</label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                <textarea class="form-control" name="message" id="message" rows="3"
                          placeholder="Write your message..." required></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-5">
                        <button type="submit" class="btn btn-success">Send Decision</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>