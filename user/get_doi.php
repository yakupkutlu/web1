<div class="x_content">

<?php
    session_start();
    ob_start();
    $new_name = $_SESSION["user"];

    
  
        include("../app/connect.php");
        include("function.php");
        include("../system.php"); 
		
		include("../app/zen_restapi.php");
		
		Yonlendirme("../user/index.php?page=publishing_papers&m_id=12&rnb=2");
		
		 
 ?>
    
  
 
   
    

</div>

<!-- /page content -->

 