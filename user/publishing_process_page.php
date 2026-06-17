<?php
$p_id = $_GET["p_id"];
$s_user=$_SESSION["user"];
$s_user_name=mysqli_fetch_object(mysqli_query($baglanti,"select name_surname from users where user_name='$s_user'"))->name_surname;
$p_info_sql=mysqli_query($baglanti,"select * from submission_list where id='$p_id'");
$p_info=mysqli_fetch_object($p_info_sql);
$p_author=$p_info->name_surname;
$p_author_mail=$p_info->email;
$p_paper_id=$p_info->paperID;


$p_sql="update submission_list set publish_status=1 where id='$p_id'";
if (mysqli_query($baglanti,$p_sql)){
 /*   $currespond_message = "Dear Author,<br><br>
The M&S titled as " . $title . " has been submitted to ".$journalName."(".$journalShortName.") successfully.<br><br>
You can track the reviewing process by logging to ".$journalShortName." (http://".$journalDomain."/index.php?page=login).<br><br>
Thanks for choosing ".$journalShortName.".<br><br>
Yours sincerely,<br><br>
".$journalEditorChef."<br>
Editor in Chief ";*/
    $currespond_message = "Makaleniz yayınlansın mı ";
    //if (mail_gonder($email, $title, $currespond_message)){
        $log_state=$p_paper_id." ID li makale YAZARA PROOF EDİLDİ , MAİL GİTTİ";
        log_all($s_user_name,$log_state);
        MesajGoster("Paper is sent to author [OK]");
        Yonlendirme("index.php?page=accepted_paper&m_id=10&rnb=2");
  /*  }
    else {
        $log_state="HATA ->".$p_paper_id." ID li makale YAZARA PROOF EDİLEMEDİ , MAİL HATASI --".mysqli_error();
        log_all($s_user_name,$log_state);
        MesajGoster("Mail ERROR !!!");
        Yonlendirme("index.php?page=accepted_paper&m_id=10&rnb=2");
    }*/

}
else {
    $log_state="HATA ->".$p_paper_id." ID li makale YAZARA PROOF EDİLEMEDİ --".mysqli_error();
    log_all($s_user_name,$log_state);
    MesajGoster("Database ERROR !!!");
    Yonlendirme("index.php?page=accepted_paper&m_id=10&rnb=2");

}