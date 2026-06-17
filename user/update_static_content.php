<?php
include("../system.php");
include "function.php";
$role_number=$_GET["rnb"];

$edit_mail = $_GET["edit_mail"];

if (yetki_kontrol($role_number, "edit_menu")) {
    echo "<br>";

  if (isset($_POST["page"]) and isset($_POST["postContent"]) && $edit_mail != "edit_page") {
        include("../app/connect.php");
        $content = str_replace("\r\n", "",  $_POST["postContent"]);
        $page = $_POST["page"];


        if (mysqli_query($baglanti,"UPDATE static_content SET content= '$content' WHERE page_name= '$page' AND state=1")) {

            MesajGoster("The content has been updated..");
            Yonlendirme("index.php?page=edit_menu&m_id=1&rnb=1");
        } else{
              MesajGoster("The content has not been updated.... ERROR");
            Yonlendirme("index.php?page=edit_menu&m_id=1&rnb=1");
            
        }
    }
    
  
    
   elseif (isset($_POST["page"]) and isset($_POST["postContent"]) ) {
        include("../app/connect.php");
        $content = str_replace("\r\n", "", $_POST["postContent"]);
        $page = $_POST["page"];
        

  $sorgu="UPDATE mailTable SET text= '".$content."'  WHERE id= '".$page."'";

  
          if (mysqli_query($baglanti,$sorgu)) {

            MesajGoster("The mail content has been updated.");
            Yonlendirme("index.php?page=edit_mail_text&m_id=1&rnb=1");
           
        } else {
            MesajGoster("The mail content has not been updated. ... ERROR " );
            Yonlendirme("index.php?page=edit_mail_text&m_id=1&rnb=1");
        }
    }
    
      


} else header("Refresh:0;  URL = 404.php ");
?>

