<style>
    .selectedMenu {
        color: #eeeeee;
        background: #1fa0e4;
        background: -webkit-linear-gradient(#79c9ef, #0f0784);
        background: -moz-linear-gradient(#79c9ef, #0f0784);
        background: -o-linear-gradient(#79c9ef, #0f0784);
        background: -ms-linear-gradient(#79c9ef, #0f0784);
        background: linear-gradient(#79c9ef, #0f0784);
    }

    }

    .selectedMenu a {
        font-weight: 700 !important;
    }
</style>
<?php
$yeni_yuklenenler_sql = "select COUNT(id) as adet from submission_list where accept=0 and revision_status=0 and reviever_state=0 and accept_status=-1;";
$yeni_yuklenenler = mysqli_fetch_object(mysqli_query($baglanti,$yeni_yuklenenler_sql))->adet;

$sent_back_author_sql = "select COUNT(id) as adet from submission_list  where  accept_status=-3;";
$sent_back_author = mysqli_fetch_object(mysqli_query($baglanti,$sent_back_author_sql))->adet;

$hakeme_gonderilen_sql = "select COUNT(id) as adet from submission_list where accept=0 and revision_status=0 and reviever_state=1 and accept_status=-1;";
$hakeme_gonderilen = mysqli_fetch_object(mysqli_query($baglanti,$hakeme_gonderilen_sql))->adet;

$revizyon_olan_sql = "select COUNT(id) as adet from submission_list where accept=0 and revision_status!=0;";
$revizyon_olan = mysqli_fetch_object(mysqli_query($baglanti,$revizyon_olan_sql))->adet;

$revizyon_gelen_sql = "select COUNT(id) as adet from submission_list where accept=0 and revision_status=0 and accept_status=-2;";
$revizyon_gelen = mysqli_fetch_object(mysqli_query($baglanti,$revizyon_gelen_sql))->adet;

$kabul_edilen_sql = "select COUNT(id) as adet from submission_list where accept=1 and publish=0 and publish_status=0";
$kabul_edilen = mysqli_fetch_object(mysqli_query($baglanti,$kabul_edilen_sql))->adet;

$kabul_bekleyen_sql = "select COUNT(id) as adet from submission_list where accept=1 and publish=0 and (publish_status=1 or publish_status=2)";
$kabul_bekleyen = mysqli_fetch_object(mysqli_query($baglanti,$kabul_bekleyen_sql))->adet;

$yayın_bekleyen_sql = "select COUNT(id) as adet from submission_list where publish=-1 and accept=1 and (publish_status=0 or publish_status=1);";
$yayın_bekleyen = mysqli_fetch_object(mysqli_query($baglanti,$yayın_bekleyen_sql))->adet;

$yayınlanan_sql = "select COUNT(id) as adet from submission_list where publish=1;";
$yayınlanan = mysqli_fetch_object(mysqli_query($baglanti,$yayınlanan_sql))->adet;

$reddedilen_sql = "select COUNT(id) as adet from submission_list where accept=0 and accept_status=0;";
$reddedilen = mysqli_fetch_object(mysqli_query($baglanti,$reddedilen_sql))->adet;

$user_id = mysqli_fetch_object(mysqli_query($baglanti,"select * from users where user_name='$user_name'"))->id;

$hakemlik_istek_sql = "select COUNT(id) as adet from review_requests where reviewerid='$user_id' and review_status=-1;";
$hakemlik_istek = mysqli_fetch_object(mysqli_query($baglanti,$hakemlik_istek_sql))->adet;

$hakemlik_kabul_sql = "select COUNT(id) as adet from review_requests where reviewerid='$user_id' and review_status=1 and acceptance_status=-1;";
$hakemlik_kabul = mysqli_fetch_object(mysqli_query($baglanti,$hakemlik_kabul_sql))->adet;

$hakemlik_yorumlanan_sql = "select COUNT(id) as adet from review_requests where reviewerid='$user_id' and review_status=1 and acceptance_status!=-1";
$hakemlik_yorumlanan = mysqli_fetch_object(mysqli_query($baglanti,$hakemlik_yorumlanan_sql))->adet;

$papers_sql = "select COUNT(id) as adet from submission_list where email='$user_name';";
$papers = mysqli_fetch_object(mysqli_query($baglanti,$papers_sql))->adet;

$editorial_correction_sql = "select COUNT(id) as adet from submission_list where email='$user_name' and accept_status=-3;";
$editorial_correction = mysqli_fetch_object(mysqli_query($baglanti,$editorial_correction_sql))->adet;

$upload_revised_sql = "select COUNT(id) as adet from submission_list where user_name='$user_name' AND revision_status=1;";
$upload_revised = mysqli_fetch_object(mysqli_query($baglanti,$upload_revised_sql))->adet;

$proof_sql = "select COUNT(id) as adet from submission_list where user_name='$user_name' AND  accept=1 and publish=-1 and publish_status=1 and proof_state=0;";
$proof = mysqli_fetch_object(mysqli_query($baglanti,$proof_sql))->adet;
?>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3><?php echo $role; ?></h3>


        <ul class="nav side-menu">
            <?php
            //ROLE 1 BAŞ EDİTOR
            //ROLE 2 EDİTÖR
            //ROLE 3 HAKEM
            //ROLE 4 YAZAR
            $query = mysqli_query($baglanti,"select * from menus where ust_menu=0 and yetki='$role_number' and state=1 order by menu_sira");

            while ($data = mysqli_fetch_array($query)) {
            if ($data["name"] != "Log Out") {
            if ($data["id"] == $m_id) {
            ?>
        <li class="selectedMenu">
        <?php } else { ?>
            <li>
                <?php } ?>

                <a href="<?php echo $data['link'] . $role_number; ?>"><i
                            class="<?php echo $data['simge']; ?>"></i>

                    <?php

                    if ($data["id"] == 5) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $yeni_yuklenenler . ")</font>";
                    else if ($data["id"] == 6) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $sent_back_author . ")</font>";
                    else if ($data["id"] == 7) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $hakeme_gonderilen . ")</font>";
                    else if ($data["id"] == 8) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $revizyon_olan . ")</font>";
                    else if ($data["id"] == 9) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $revizyon_gelen . ")</font>";
                    else if ($data["id"] == 10) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $kabul_edilen . ")</font>";
                    else if ($data["id"] == 11) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $kabul_bekleyen . ")</font>";
                    else if ($data["id"] == 12) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $yayın_bekleyen . ")</font>";
                    else if ($data["id"] == 13) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $yayınlanan . ")</font>";
                    else if ($data["id"] == 14) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $reddedilen . ")</font>";
                    else if ($data["id"] == 17) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $hakemlik_istek . ")</font>";
                    else if ($data["id"] == 18) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $hakemlik_kabul . ")</font>";
                    else if ($data["id"] == 19) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $hakemlik_yorumlanan . ")</font>";
                    else if ($data["id"] == 21) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $papers . ")</font>";
                    else if ($data["id"] == 22) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $editorial_correction . ")</font>";
                    else if ($data["id"] == 24) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $upload_revised . ")</font>";
                    else if ($data["id"] == 25) echo $data['name'] . " <font color=\"red\">&nbsp&nbsp&nbsp(" . $proof . ")</font>";
                    else echo $data['name'];

                    ?></a>

                <?php
                $d_id = $data["id"];
                $sql2 = "select * from menus where ust_menu='$d_id' and yetki='$role_number' and state=1";
                $query2 = mysqli_query($baglanti,$sql2);
                if (mysqli_num_rows($query2)) {
                ?>
                <ul class="nav child_menu"
                ">
                <?php
                while ($oku2 = mysqli_fetch_array($query2)) {
                ?>
            <li>
                <a href="<?php echo $oku2['link']. $role_number; ?>"><i
                            class="<?php echo $oku2['simge']; ?>"></i><?php echo $oku2['name']; ?></a>
            </li>
        <?php
        } ?>

        </ul>
        <?php
        }

        } else { ?>
        <li>
            <a href="<?php echo $data['link']; ?>">
                <i class="<?php echo $data['simge']; ?>"></i> <?php echo $data['name']; ?></a>


            <?php

            }
            /*
            $d_id = $data['id'];
            $sql2 = "select * from menus where ust_menu='$d_id' and yetki='$role_number'";
            $query2 = mysqli_query($baglanti,$sql2);
            if (mysqli_num_rows(mysqli_query($baglanti,$sql2))) { ?>
                <ul class="nav child_menu">
                    <?php
                    while ($data2 = mysqli_fetch_array($query2)) {
                        if ($data2["id"] == $m_id) {
                            ?>
                            <li class="selectedMenu">
                        <?php } else { ?>
                            <li>
                        <?php } ?>
                        <a href="<?php echo $data2['link'] . $role_number; ?>"><i
                                    class="<?php echo $data2['simge']; ?>"></i><?php echo $data2['name']; ?>
                        </a></li>
                    <?php } ?>
                </ul>

            <?php }

            ?>*/
            ?>
        </li>
        <?php
        if ($data["id"] == 2) 
			echo " ";
        }
        ?>

        </ul>

    </div>
</div>



 

