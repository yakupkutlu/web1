<div class="x_panel">
<!--
    <a class="btn btn-app" href="index.php?page=add_paper&rnb=<?php echo $role_number;?>">
        <i class="fa fa-plus"></i> Submit New Manuscript
    </a>
    <a class="btn btn-app" href="index.php?page=not_completed&rnb=<?php echo $role_number;?>">
        <i class="fa fa-edit"></i> Submissions Not Completed
    </a>
-->
    <div class="x_content">
        <?php
        include("../app/connect.php");

        echo "<center>Submissions Not Completed </center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Authors</th>
                <th>Keywords</th>
                <th>Abstract</th>
                <th>Message</th>
                <th>File</th>
                <th>Process</th>
            </tr>
            </thead>
            <tbody>";
        $s_user=$_SESSION["user"];
        if ($query = mysqli_query($baglanti,"select * from submission_list_temp where user_name='$s_user' and state=1;")) {
            $sira = 1;
            while ($data = mysqli_fetch_array($query)) {
                echo "<tr>";
                echo "<td>" . $sira . "</td>";
                $sira += 1;
                echo "<td>" . $data["title"] . "</td>";
                echo "<td>" . $data["all_authors"] . "</td>";
                echo "<td>" . $data["key_words"] . "</td>";
                echo "<td>" . $data["abstract"] . "</td>";
                echo "<td>" . $data["message"] . "</td>";
                echo "<td>Dosya</td>";
                echo "<td align='center'><a href='index.php?page=not_completed_paper&ncp_id=".$data["id"]."'><i class=\"fa fa-edit\"></i></a> 
                <a href='process.php?process=delete_not_comp&id=".$data["id"]."'><i class=\"fa fa-trash-o\" style='padding-left:10px'></i></a>
                </td>";
                echo "</tr>";

            }
        }
        echo "</tbody>
        </table>";
        ?>
    </div>

</div>


