
      
 






 




         
 <!-- Footer Start  increase hit -->
        <?php @mysqli_query($baglanti,"UPDATE options SET websitehit= websitehit+1");?>
        
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s" style="background-color:#0000;">
            Publisher is <a href="https://www.dogavebilim.com/"> Doga ve Bilim Dernegi (Natural and Science Socity)</a>
            <div class="container py-5">
               <!--    <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
				
                    <a title="content " href="https://worldflagcounter.com/details/iIJ"><img src="https://worldflagcounter.com/iIJ/" alt="Flag Counter"></a> <img src="img/ig.png ">
					 	<img src="../images/icon/wfc_logo.png" width="60%">
					 	
					 	<a href="http://s11.flagcounter.com/more/XCg"><img src="https://s11.flagcounter.com/count2/XCg/bg_2B3940/txt_FFFFFF/border_CCCCCC/columns_2/maxflags_10/viewers_0/labels_0/pageviews_0/flags_0/percent_0/" alt="Flag Counter" border="0"></a>
					 
					  <p style="font-size:small"> <i>Pageviews: <?php   echo mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM options "))->websitehit;
?></i></p>
 
					   
                    </div>
                        
                    <div class="col-lg-3 col-md-6">
                     <h5 class="text-white mb-4">Contact</h5>
                       
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i><?php echo $journalMail;?></p>
                       <p class="mb-2"><i class="fa fa-phone-alt me-3"></i> </p>  
                       
                       <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Türkiye</p>
                        <div class="d-flex pt-2">
                            <a title="content " class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            
                            <a title="content " class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h5 class="text-white mb-4"> </h5>
						
						 
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

-->

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