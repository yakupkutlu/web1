
      
       
<div class="card bg-blue2" style="width: 100%;height:10px">
   <div class="card-body">
    <h5 class="card-title"> </h5>
    <p class="card-text"> </p>
    
  </div>
</div>



    <!-- Testimonial Start -->
    <div class="container-xxl bg-white ">
        <div class="container py-5">
            <div class="row g-5">
               
<!-- Statistics Start -->
			   <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="btn btn-sm border rounded-pill text-primary px-3 mb-3">Statistics</div>
                   
					
					   
  <div class="card">
	  <div class="card-header">
	   Journal Statistics
	  </div>
	  <div class="card-body">  					
					
					
					
					
			
					<?php
							  $data=getStatistics();
							 // print_r($data);
							 
					/*		 

					 echo ' Total Articles/Abstracts	:'.$data["TotalArticles"].'<br>';
					 echo ' Total Articles view	:'.$data["TotalArticlesview"].'<br>';
					 echo ' Total Articles download	:'.$data["TotalArticlesdownload"];
					
					echo '  	 <h3 class="mb-4">Google Scholar Index</h3>
                    	';
					
					 echo ' CiteScore: 0 (updated 01.01.2024)<br>';
					 echo ' No. of citations	:'.$data["totalCite"].'<br>';
					 echo ' Google h-index		:'.$data["hIndexScore"].'<br>';
					 echo ' Google i10-index	:'.$data["i10IndexScore"].'<br>';
					 
						*/ 
					?>			
					
					
					
					
					
					
					
					
					
							
							
		 <div class="row">
				<div class="col-md-3 col-sm-6 col-12   wow fadeInUp">
					<div class="info-box text-center bg-light">
						<span class="info-box-icon"><i class="fa fa-2x fa-file"></i></span>
							<div class="info-box-content">
								<span class="info-box-text"> Articles  <br> </span>
						<span class="info-box-number"><?php echo $data["TotalArticles"]; ?></span>
							</div>

					</div>

				</div>
 
			<div class="col-md-3 col-sm-6 col-12 wow fadeInUp">
					<div class="info-box text-center  bg-light border-1">
					<span class="info-box-icon "><i class="fa fa-2x  fa-eye"></i></span>
						<div class="info-box-content">
							<span class="info-box-text"> Views <br></span>
							<span class="info-box-number"><?php echo $data["TotalArticlesview"]; ?></span>
						</div>

					</div>

				</div>

			<div class="col-md-3 col-sm-6 col-12 wow fadeInUp">
				<div class="info-box text-center  bg-light">
					<span class="info-box-icon"><i class="fa fa-2x fa-download"></i></span>
					<div class="info-box-content">
						<span class="info-box-text"> Downloads</span>
						<span class="info-box-number"><?php echo $data["TotalArticlesdownload"]; ?></span>
					</div>

				</div>

			</div>

			<div class="col-md-3 col-sm-6 col-12 wow fadeInUp">
				<div class="info-box text-center  bg-light">
				<span class="info-box-icon"><i class="far fa-2x fa-star"></i></span>
					<div class="info-box-content">
					<span class="info-box-text">Web Hits<br></span>
					<span class="info-box-number"><?php   echo mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM options "))->websitehit;
		?></span>
					</div>
				</div>

			</div>
		
			
			
			

		</div>
	</div>


</div>					
					
	
	   <br>	
 
  <div class="card">
  <div class="card-header">
   
   <a title="content "  href="<?php echo $googleScholar; ?>">Google Scholar Index</a>				
 
  </div>
  <div class="card-body">                 

					
 <div class="row">
		<div class="col-md-3 col-sm-6 col-12   wow fadeInUp">
			<div class="info-box text-center  bg-light">
				<span class="info-box-icon"><i class="fa fa-2x fa-chart-line text-primary "></i></span>
					<div class="info-box-content">
						<span class="info-box-text">CiteScore <br> </span>
						 <span class="info-box-number"><?php echo "0.2"; ?></span>
					</div>

			</div>

		</div>


	<div class="col-md-3 col-sm-6 col-12 wow fadeInUp">
			<div class="info-box text-center  bg-light border-1">
			<span class="info-box-icon "><i class="fa fa-2x  fa-h-square"></i></span>
				<div class="info-box-content">
					<span class="info-box-text"> h-index <br></span>
					<span class="info-box-number"><?php echo $data["hIndexScore"]; ?></span>
				</div>

			</div>

		</div>

	<div class="col-md-3 col-sm-6 col-12 wow fadeInUp">
		<div class="info-box text-center  bg-light">
			<span class="info-box-icon"><i class="fa fa-2x fa-info"></i></span>
			<div class="info-box-content">
				<span class="info-box-text"> i10-index<br></span>
				<span class="info-box-number"><?php echo $data["i10IndexScore"]; ?></span>
			</div>

		</div>

	</div>

	<div class="col-md-3 col-sm-6 col-12 wow fadeInUp">
		<div class="info-box text-center  bg-light">
		<span class="info-box-icon"><i class="fa fa-2x  fa-chart-bar" aria-hidden="true"></i>
</span>
			<div class="info-box-content">
			<span class="info-box-text">Citations<br></span>
			<span class="info-box-number"><?php   echo $data["totalCite"];
?></span>
			</div>
		</div>

	</div>
	

</div>
	   <br><a title="content " class="btn btn-primary rounded-pill px-4 wow fadeInUp" href="<?php echo $googleScholar; ?>">Google Scholar</a>				
 </div>  	(CiteScore updated 01.01.2024)
                 
</div>			
		
		
		   <br>		
		
					

 <div class="card">            
       <div class="card-header">
	   Publication Statistics
	  </div>
	  <div class="card-body">  					
					
							
		 <div class="row">
			
			
		   <div class="col-md-2 col-sm-4 col-12 wow fadeInUp">
				<div class="info-box text-center  bg-light">
				<span class="info-box-icon"><i class="far fa-2x fa-calendar"></i></span>
					<div class="info-box-content">
					<span class="info-box-text">Review Time<br></span>
					<span class="info-box-number">20days</span>
					</div>
				</div>

			</div>
			
			
			
		   <div class="col-md-4 col-sm-6 col-12 wow fadeInUp">
				<div class="info-box text-center  bg-light">
				<span class="info-box-icon"><i class="far fa-2x fa-calendar"></i></span>
					<div class="info-box-content">
					<span class="info-box-text"> Submission to Acceptance<br></span>
					<span class="info-box-number">50days</span>
					</div>
				</div>

			</div>


			
		   <div class="col-md-6 col-sm-6 col-12 wow fadeInUp">
				<div class="info-box text-center  bg-light">
				<span class="info-box-icon"><i class="far fa-2x fa-calendar"></i></span>
					<div class="info-box-content">
					<span class="info-box-text">Acceptance to Publication/Earlyview<br></span>
					<span class="info-box-number">10days</span>
					</div>
				</div>

			</div>




			
			
			

		</div>
	</div>	
	</div>					
				
 </div>
                
					
					
					
<!-- Announcements Start -->
				<div class="col-lg-7 wow fadeIn" data-wow-delay="0.5s">
                    <div class="  border-start border-primary">
                        <div class="testimonial-item ps-5">
						  <div class="btn btn-sm border rounded-pill text-primary px-3 mb-3"><i class="fa fa-bullhorn  pull-left text-primary "> !  !</i> Announcements ! !
						  </div>
                        
                            <p class="text-white ">
							
							<marquee align="middle"  behavior="slide "   scrollamount="4" height="350px" width="100%" direction="up" scrolldelay="1" onmouseover="this.stop();" onmouseleave="this.start();">
					  
								<?php
								$sonuc2=getAnnouncement();
								
								$data=mysqli_fetch_array($sonuc2);
								// Fonksiyonu çağır
									$d=listItems($data["content"]);
									
								echo "yakup kutlu";	 

							    foreach ($d as $match) {
									
									
									echo '<div class="card border-secondary mb-3" style=" width: 90%;">
  <div class="card-header text-primary"><i class="fa fa-bullhorn  pull-left text-primary ">  </i></div>
  <div class="card-body text-secondary">
    <h5 class="card-title">'.$match . '</h5> 
  </div>
</div>';
									
								// echo ' <div class="btn col-12 btn-sm border rounded-pill text-primary px-3 mb-3"><i class="fa fa-bullhorn  pull-left text-primary "> !  !</i> '.$match . '</div>';
							 
								}									 
										 
										
										
										
										 
								function listItems($text) {
									// Regex deseni
									$pattern = '/<li[^>]*>(.*?)<\/li>/s';

									// Eşleşmeleri bul
									preg_match_all($pattern, $text, $matches);

									// Eşleşmeleri listele
									foreach ($matches[1] as $match) {
									   // echo $match . "<br>";
									}
								return $matches[1];
								}


								?>	
								
								
								
								
								
								
							</marquee>
							
							
							
							</p>
                           
                        </div>
                      
                       
                    </div>
                    
                    
                    
   
 

 				
	  
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                </div>
				<!-- Announcements end -->
				
				
				
            </div>
        </div>
    </div>
    <!-- Testimonial End -->




         
        <!-- Footer Start  increase hit -->
        <?php @mysqli_query($baglanti,"UPDATE options SET websitehit= websitehit+1");?>
        
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
				
                     <!--  <a title="content " href="https://worldflagcounter.com/details/iIJ"><img src="https://worldflagcounter.com/iIJ/" alt="Flag Counter"></a> <img src="img/ig.png ">
					 	<img src="../images/icon/wfc_logo.png" width="60%"> -->
					 	
					 	<a href="http://s11.flagcounter.com/more/XCg"><img src="https://s11.flagcounter.com/count2/XCg/bg_2B3940/txt_FFFFFF/border_CCCCCC/columns_2/maxflags_10/viewers_0/labels_0/pageviews_0/flags_0/percent_0/" alt="Flag Counter" border="0"></a>
					 
					  <p style="font-size:small"> <i>Pageviews: <?php   echo mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM options "))->websitehit;
?></i></p>
					   
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Quick Links</h5>
                        <a title="content " class="btn btn-link text-white-50" href="index.php?page=home">About Us</a>
                        <a title="content " class="btn btn-link text-white-50" href="index.php?page=contact">Contact Us</a>
                   
                        <a title="content " class="btn btn-link text-white-50" href="index.php?page=pppolicy">Policies</a>
						<a title="content " class="btn btn-link text-white-50" href="index.php?page=signup">Register</a>
                        <a title="content " class="btn btn-link text-white-50" href="index.php?page=guide_for_authors">Guide for Authors </a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Contact</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>İskenderun / Hatay</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i> </p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@<?php echo $journalDomain;?></p>
						
                        <div class="d-flex pt-2">
                            <a title="content " class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            
                            <a title="content " class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4">Services</h5>
						
						 
                        <p></p>
                        <div class="position-relative mx-auto" style="max-width: 500px;">
                            
							
							
							<form action='arama.php' method='post'>
                     
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Title or Author" name="aranacak">
                            <button type="submit" name="ara" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Search</button>
						 </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-8 text-center text-md-start mb-3 mb-md-0">
                           
							<a title="content " rel="license" href="http://creativecommons.org/licenses/by/4.0/">  All published work is licensed under a Creative Commons Attribution 4.0 International License.
							 
			<img alt="Creative Commons License" style="border-width:0" src="https://i.creativecommons.org/l/by/4.0/80x15.png" /></a>
			
			
			
							 
							      </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                 <!-- Footer End <a title="content " href="">Home</a>
                                <a title="content " href="">Cookies</a>
                                Designed By <a title="content " class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> 
                            --></div>
                        </div>
                    </div>
					
					
					<div class="row">
                        <div class="col-md-12 text-center text-md-start mb-3 mb-md-0">
                           
						 
							 
							<br><center> &copy; <a title="content " class="border-bottom" href="#"><?php echo $journalDomain;?> </a>, All Right Reserved. </center>  
                        </div>
                         
					
					
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a title="content " href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>