<?php
if (!isset($_GET["process"])) {
    $process = "";
} else {
    $process = $_GET["process"];
}
if ($process == "") {
    $sub_id = $_GET["id"];
    $s_query = mysqli_query($baglanti,"select * from submission_list where id='$sub_id'");
    $info = mysqli_fetch_object($s_query);
    $title = $info->title;
    $authors = $info->authors;
    echo "<center><h3>" . $title . "</h3></center>";
    echo "<center><h5>" . $authors . "</h5></center>";
    ?>
    <form class="form-horizontal form-label-left" method="post"
          action="add_cited_page.php?process=add_cited&id=<?php echo $sub_id; ?>">

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Paper Information<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class="form-control" name="paper_info" rows="3"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cited Link<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="paper_link" required="required" class="form-control col-md-7 col-xs-12">
            </div>
        </div>

        <div class="form-group">

            <div style="text-align: center">
                <br>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

    </form>
    <hr><br><br>
    <?php
    echo '<table id="datatable" class="table table-striped table-bordered">
            <thead>
            <tr>
               <th>ID</th>
                <th>Paper Information</th>
                <th style=\'text-align: center\'>Process</th>
            </tr>
            </thead>
            <tbody>';

    if ($query = mysqli_query($baglanti,"select * from cited_table where sub_id='$sub_id';")) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $sira . "</td>";
            $sira += 1;
            echo "<td>" . $data["paper_info"] . "</td>";
            echo "<td align='center'>
<a href='add_cited_page.php?process=delete_cited&id=" . $data["id"] . "' style='padding-right:10px;'><i title='Delete' class=\"fa fa-minus-circle\"></i></a>
<a href='index.php?page=add_cited_page&rnb=2&m_id=30&process=edit_cited&id=" . $data["id"] . "'><i title='Edit' class=\"fa fa-pencil-square-o\"></i></a>
</td>";
            echo "</tr>";

        }
    }
    echo "</tbody>
        </table>";
}
if ($process == "add_cited") {
    session_start();
    ob_start();
    include("../app/connect.php");
    include("../system.php");
    include("function.php");

    $user_name = $_SESSION["user"];
    $sub_id = $_GET["id"];
    $paper_info = tirnak_replace($_POST["paper_info"]);
    $paper_link =tirnak_replace($_POST["paper_link"]);
    $sql = "insert into cited_table (sub_id,paper_info,paper_link) VALUES ('$sub_id','$paper_info','$paper_link')";
    if (mysqli_query($baglanti,$sql)) {
        MesajGoster("Completed Succesfully....[OK]");
        $log_state = $sub_id . " id li makaleye cited eklendi";
        log_all($user_name, $log_state);
        $url = "index.php?page=add_cited_page&m_id=30&rnb=2&id=" . $sub_id;
        Yonlendirme($url);
    } else {
        MesajGoster("Completed UNSUCCESSFUL !!!");
        $log_state = "HATA ->" . $sub_id . " id li makaleye cited EKLENEMEDİ ->VERİ TABANI HATASI ->" . mysqli_error();
        log_all($user_name, $log_state);
        $url = "index.php?page=add_cited_page&m_id=30&rnb=&id=" . $sub_id;
        Yonlendirme($url);
    }


}

if ($process == "delete_cited") {
    session_start();
    ob_start();
    include("../app/connect.php");
    include("../system.php");
    include("function.php");

    $user_name = $_SESSION["user"];
    $id = $_GET["id"];
    $sql = "DELETE FROM `cited_table` WHERE id='$id'";
    if (mysqli_query($baglanti,$sql)) {
        MesajGoster("Completed Succesfully....[OK]");
        $log_state = $sub_id . " id li makaleye cited eklendi";
        log_all($user_name, $log_state);
        $url = "index.php?page=add_cited_page&m_id=30&rnb=2&id=" . $sub_id;
        Yonlendirme($url);
    } else {
        MesajGoster("Completed UNSUCCESSFUL !!!");
        $log_state = "HATA ->" . $sub_id . " id li makalede cited SİLİNEMEDİ ->VERİ TABANI HATASI ->" . mysqli_error();
        log_all($user_name, $log_state);
        $url = "index.php?page=add_cited_page&m_id=30&rnb=&id=" . $sub_id;
        Yonlendirme($url);
    }


}

if ($process == "edit_cited") {
    session_start();
    ob_start();
    $sub_id = $_GET["id"];
    $s_query = mysqli_query($baglanti,"select * from submission_list where id='$sub_id'");
    $info = mysqli_fetch_object($s_query);
    $title = $info->title;
    $authors = $info->authors;

    $c_query = mysqli_query($baglanti,"select * from cited_table where id='$sub_id'");
    $cited_query = mysqli_fetch_object($c_query);
    $paper_info = $cited_query->paper_info;
    $paper_link = $cited_query->paper_link;
    $paper_id=$cited_query->sub_id;
    echo "<center><h3>" . $title . "</h3></center>";
    echo "<center><h5>" . $authors . "</h5></center>";
    ?>
    <form class="form-horizontal form-label-left" method="post"
          action="add_cited_page.php?process=add_edit_cited&id=<?php echo $sub_id; ?>&p_id=<?php echo $paper_id; ?>">

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Paper Information<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea class="form-control" name="paper_info" rows="3"><?php echo $paper_info; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Cited Link<span
                        class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" name="paper_link" required="required" class="form-control col-md-7 col-xs-12"
                       value="<?php echo $paper_link; ?>">
            </div>
        </div>

        <div class="form-group">

            <div style="text-align: center">
                <br>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>

    </form>
    <hr><br><br>

    <?php
}

if ($process == "add_edit_cited") {
    session_start();
    ob_start();
    include("../app/connect.php");
    include("../system.php");
    include("function.php");

    $user_name = $_SESSION["user"];
    $sub_id = $_GET["id"];
    $paper_id=$_GET["p_id"];
    $paper_info = tirnak_replace($_POST["paper_info"]);
    $paper_link =tirnak_replace($_POST["paper_link"]);
    $sql = "insert into cited_table (sub_id,paper_info,paper_link) VALUES ('$sub_id','$paper_info','$paper_link')";
    $sql = "update cited_table set paper_info='$paper_info',paper_link='$paper_link' WHERE id='$sub_id'";
    if (mysqli_query($baglanti,$sql)) {
        MesajGoster("Completed Succesfully....[OK]");
        $log_state = $sub_id . " id li makaleye cited eklendi";
        log_all($user_name, $log_state);
        $url = "index.php?page=add_cited_page&m_id=30&rnb=2&id=" . $paper_id;
        Yonlendirme($url);
    } else {
        MesajGoster("Completed UNSUCCESSFUL !!!");
        $log_state = "HATA ->" . $sub_id . " id li makaleye cited EKLENEMEDİ ->VERİ TABANI HATASI ->" . mysqli_error();
        log_all($user_name, $log_state);
        $url = "index.php?page=add_cited_page&m_id=30&rnb=&id=" . $paper_id;
        Yonlendirme($url);
    }


}

?>