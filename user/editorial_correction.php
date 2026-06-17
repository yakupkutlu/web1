<?php
if (yetki_kontrol($role_number, "editorial_correction")) {
    include("../app/connect.php");
//include("../system.php");
    $user_name = $_SESSION["user"];

    echo "<center><a class='btn btn-round btn-warning inbox-title'>EDITORIAL CORRECTION REQUESTED</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th>ID</th>
                <th>Manuscript No</th>
                <th>Manuscript Title</th>
                <th>Senders's Editor Name</th>
                <th>Message</th>
                <th>Return Date</th>
                <th style='text-align: center'>Process</th>
            </tr>
            </thead>
            <tbody>";

    if ($query = mysqli_query($baglanti,"select * from submission_list where user_name='$user_name' AND accept_status=-3; ;")) {// accept_status!=-2
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            $sub_id=$data["id"];
            echo "<tr>";
            echo "<td>" . $sira . "</td>";
            $sira += 1;
            $send_back_message_query=mysqli_query($baglanti,"select * from send_back_author where paper_id='$sub_id'");
            $send_back_message=mysqli_fetch_object($send_back_message_query);
            $editor=$send_back_message->editor;
            $message=$send_back_message->message;
            $return_date=$send_back_message->return_date;
            echo "<td>" . $data["paperID"] . "</td>";
            echo "<td>" . $data["title"]  . "</td>";
            echo "<td>" . $editor . "</td>";
            echo "<td>" . $message . "</td>";
            echo "<td>" . $return_date . "</td>";
            echo "<td align='center'>
            <a href='../" . $data["paperfile1"] . "' target='_blank'><i title='Download' class=\"fa fa-download\" style='padding-right:10px;'></i></a>
            <a href='javascript:void(0)' onclick='popupwindow(\"show_reviewers_detail.php?id=" . $data["id"] . "\",600,700);'><img src='../images/icon/detail.png' height='28px'  style='padding-right:10px;' title='Detail'></a>
            <a href='index.php?page=editorial_correction_page&process=editorial_correction&rnb=4&id=".$sub_id."&m_id=".$m_id."'><img src='../images/icon/edit.ico' title='Edit Paper' style='padding-right:10px;' height='28px' ></a>
            </td>";

            echo "</tr>";

        }
    }
    echo "</tbody>
        </table>";
} else header("Refresh:0;  URL = 404.php ");
?>


<script>
    function popupwindow(url, w, h) {
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        return window.open(url, null, 'toolbar=no, location=no,resizable=0, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
</script>

