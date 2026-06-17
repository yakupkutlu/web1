



<style>
    #contact-tbl tr td{
        padding:5px;
    }
</style>

 
<div id="content">
    <br>
    <!--
    <table id="contact-tbl">
        <tr>
            <td>General Contact E-Mail</td>
            <td>: <?php echo $journalMail; ?></td>
        </tr>
        <tr>
            <td valign="top">Cemal TURAN<br>Editor-in-Chief</td>
            <td valign="top">: turancemal@yahoo.com</td>
        </tr>
        <tr>
            <td valign="top">Yakup KUTLU<br>Managing Editor</td>
            <td valign="top">: yakupkutlu@gmail.com</td>
        </tr>
    </table> -->

    <?php
    $sql = "SELECT content FROM static_content WHERE page_name= 'contact' AND state= 1";

    $query = mysqli_query($baglanti,$sql);
    if ($query) {
        $tmp = mysqli_fetch_array($query);
        $content = $tmp["content"];
    } else {
        echo "Veritabanı Hatası";
    }
    echo $content;
    ?>

    <br><br><hr><br><br>
<div class="row justify-content-center"> <!-- Added justify-content-center class to center the column -->
    <div class="col-md-4  bg-light  wow fadeIn" data-wow-delay="0.3s">
	
    <form method="post" action="system.php?system=contact">
	<h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Contact For Any Question</h1>
  
        <p>You can leave a message to contact us using form below</p>
        <div class="mail-input-name"><p>Name and Surname</p></div>
        <div class="mail-input-name-input"><p><input class="contact" type="text" name="your_name" value=""/></p>
        </div>
        <div class="mail-input-name"><p>Subject</p></div>
        <div class="mail-input-name-input"><p><input class="contact" type="text" name="your_subject" value=""/></p>
        </div>

        <div class="mail-input-name"><p>Email Address</p></div>
        <div class="mail-input-name-input"><p><input class="contact" type="text" name="your_email" value=""/></p>
        </div>
        <div class="mail-input-name"><p>Message</p></div>
        <div class="mail-input-name-input"><p><textarea class="contact textarea" rows="10" cols="23"
                                                        name="your_message"></textarea></p></div>
     
        
				<div class="mail-input-name-input">
				 <img  src="img.php" width="150" height="50"> <br>
				</div>
				  
 				 <div class="mail-input-name-input">        
       				 <p style="padding: 10px 0 10px 0;">Please enter the CODE (to prevent spam)</p>         
        		</div>
			        
			
			
        <div class="mail-input-name-input">
         <input size="12" maxlength="6"  placeholder="Enter Code " name="kod" type="text" autocomplete="off" /><br><br>
         
        </div>




        <div class="submission-form">

           
			 <div class="col-12">
              <button class="btn btn-primary w-100 py-3" type="submit" value="Send" name="contact_submitted" id="Send" >Send Message</button>
                 </div>
        </div>


    </form>

</div>

</div>


