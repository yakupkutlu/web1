  


<br />
<p><span> <?php echo $journalName;  ?>  </span><span>&nbsp;i</span>s an international open access journal and&nbsp;make every effort to ensure the accuracy of all the information contained in our publications. Any opinions and views expressed in this publication are the opinions and views of the authors, and are not the views of or endorsed by <?php echo $journalName;  ?>  <strong> </strong>does not charge any publication fee.<em><br /></em></p>
<p><br /> <!-- Category Start --></p>
<h5 class="text-center mb-5 wow fadeInUp"><strong><?php echo $journalName;  ?> <span>is indexed/tracked/covered by the following services:</span></strong></h5>
<strong> </strong>
<div class="container-xxl py-5">
<div class="container">
<div class="row g-4 justify-content-center">






<?php

  if ($query = mysqli_query($baglanti,"SELECT * FROM indexed_list where  goster=1  order by sira")) {
        $sira = 1;
        while ($data = mysqli_fetch_array($query)) {
            $title = $data["name"];
            $link = $data["link"];
            $image = $data["image"];
            
			 

        echo ' <div class="col-lg-4 col-sm-6 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;"><a href="'.$link.'"> <img title="'.$title.'" src="../images/'.$image.'" alt="'.$title.'" width="200px" />
<p class="mb-0">&nbsp;</p>
</a></div>';
		
			 
           

        }
    }
	
	?>
	

</div>
</div>