<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> <?php echo $journalShortName; ?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.css" rel="stylesheet">
</head>

<body class="nav-md">

<!-- page content -->
<div class="x_panel" style="height: 726px; margin-bottom: 0px; display: block;">
    <div class="x_content">

        <?php
        include("../app/connect.php");
        $id = $_GET['id'];
        $query = mysqli_query($baglanti,"select * from submission_list where id='$id'");
        while ($data = mysqli_fetch_array($query)) {
            $name_surname = $data["name_surname"];
            $institution = $data["institution"];
            $adress = $data["adress"];
            $phone = $data["phone"];
            $fax = $data["fax"];
            $email = $data["email"];
            $title = $data["title"];
            $similarity=$data["similarityrate"];
            $authors=$data["authors"];
            $abstract = $data["abstract"];
            $keyword = $data["keyword"];
            $paperID = $data["paperID"];
            $msg_to_editor = $data["msg_to_editor"];
            $year = $data["year"];
            $link=$data["paperfile1"];
            $coverImage=$data["coverImage"];             
            $submission_date=$data["submission_date"];  
			
            $workarea=$data["workarea"];
            $link2=$data["paperfile2"];
            $link2_approval=$data["file_approval"];
            
            $msg_publishing=$data["msg_publishing"];
            $accept_date=$data["accept_date"];
            $editorDecision=$data["editorDecision"];
            $editorDecisionMsg_toAuthor=$data["editorDecisionMsg_toAuthor"];
            $publish_date=$data["publish_date"];
            $authors=$data["authors"];
            $references=$data["references"];
            $volume=$data["volume"];
            $no=$data["no"];
            $pp=$data["pp"];
            $start_page=$data["start_page"];
            $doi=$data["doi"];
        }
        ?>
        <center>   <h1>Manuscript Detail</h1> </center>
        <table class="table table-striped">

            <tbody>
            <tr>
                <td>Name and Surname</td>
                <td><?php echo $name_surname; ?></td>
            </tr>
            <tr>
                <td>Institution</td>
                <td><?php echo $institution; ?></td>
            </tr>
            <tr>
                <td>Adress</td>
                <td><?php echo $adress; ?></td>
            </tr>

            <tr>
                <td>Phone Number</td>
                <td><?php echo $phone; ?></td>
            </tr>
            <tr>
                <td>Fax</td>
                <td><?php echo $fax; ?></td>
            </tr>
            <tr>
                <td>E-mail</td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>Manuscript Title</td>
                <td><?php echo $title; ?></td>
            </tr>
 <tr>
                <td>Similarity Rate</td>
                <td><?php if ($similarity>20) echo '<b><span style="color:#ff0000">'.$similarity.'</span>';else  echo $similarity; ?></td>
            </tr>            
            
            <tr>
                <td>Authors</td>
                <td><?php echo $authors; ?></td>
            </tr>
            <tr>
                <td>Abstract</td>
                <td><?php echo $abstract; ?></td>
            </tr>
            <tr>
                <td>Keyword</td>
                <td><?php echo $keyword; ?></td>
            </tr>            
            <tr>
                <td>Work Area</td>
                <td><?php echo $workarea; ?></td>
            </tr>
            <tr>
                <td><a href="<?php echo $link;?>" target="_blank">Manuscript file</a></td>
                <td><a href="<?php echo $link;?>" target="_blank"><?php echo $paperID; ?>
                     <img src="../images/indir.png" width="30px" heigth="30px">   <br></a></td>
            </tr>

            <tr>
                <td><a href="<?php echo $link2;?>" target="_blank">Manuscript file2</a></td>
                <td><a href="<?php echo $link2;?>" target="_blank"><?php echo $paperID; ?>
                     <img src="../images/indir.png" width="30px" heigth="30px">   <br></a></td>
            </tr>


            <tr>
                <td><a href="<?php echo $link2;?>" target="_blank">Statement for the Ethics Committee Approval Form</a></td>
                <td><a href="<?php echo $link2_approval;?>" target="_blank"><?php echo  $link2_approval; ?>    
                
                     <img src="../images/indir.png" width="30px" heigth="30px">   <br>
                </a></td>
            </tr>


            <tr>
                <td>Publisihing Message</td>
                <td><?php echo $msg_publishing; ?></td>
            </tr>
            
             <tr>
                <td>Submission  Date</td>
                <td><?php echo $submission_date; ?></td>
            </tr>
            
            <tr>
                <td>Accept Date</td>
                <td><?php echo $accept_date; ?></td>
            </tr>
            <tr>
                <td>Editor Decision</td>
                <td><?php echo $editorDecision; ?></td>
            </tr>
            <tr>
                <td>Editor Decision Msg to Author</td>
                <td><?php echo $editorDecisionMsg_toAuthor; ?></td>
            </tr>
            <tr>
                <td>Publish Date</td>
                <td><?php echo $publish_date; ?></td>
            </tr>
            <tr>
                <td>Authors</td>
                <td><?php echo $authors; ?></td>
            </tr>
            <tr>
                <td>References</td>
                <td><?php echo $references; ?></td>
            </tr>
            <tr>
                <td>Volume</td>
                <td><?php echo $volume; ?></td>
            </tr>
            <tr>
                <td>No</td>
                <td><?php echo $no; ?></td>
            </tr>
            <tr>
                <td>PP</td>
                <td><?php echo $pp; ?></td>
            </tr>
            <tr>
                <td>Start Page</td>
                <td><?php echo $start_page; ?></td>
            </tr>
            <tr>
                <td>Doi</td>
                <td><?php echo $doi; ?></td>
            </tr>

            <tr>
                <td>Message to Editor</td>
                <td><?php echo $msg_to_editor; ?></td>
            </tr>
            <tr>
                <td>Year</td>
                <td><?php echo $year; ?></td>
            </tr>
			<tr>
                <td>Graphical Abstract</td>
                <td><br> 
                
                <a href="<?php echo $coverImage; ?>"><?php echo $coverImage; ?>  <img src="../images/indir.png" width="30px" heigth="30px"> </a> <br>
                    
                
                <img width='300px' src='<?php echo $coverImage; ?>' alt ="<?php echo $coverImage; ?>" ></td>
            </tr>
            </tbody>
			
			
			 
			
        </table>

    </div>
</div>

<!-- /page content -->

<!-- footer content -->
<footer>
    <div class="pull-right">
        Makale Yönetimi @ 2017
    </div>
    <div class="clearfix"></div>
</footer>
<!-- /footer content -->

<script type="text/javascript">
    window.onresize = function () {
        window.resizeTo(630, 770);
    }
    window.onclick = function () {
        window.resizeTo(630, 770);
    }
</script>


<!-- jQuery -->
<script src="js/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="js/custom/custom.min.js"></script>
</body>
</html>
