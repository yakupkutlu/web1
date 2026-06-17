
        <div class="row justify-content-center"> <!-- Added justify-content-center class to center the column -->
		    <div class="col-md-4  bg-dark  wow fadeIn" data-wow-delay="0.3s">
  
        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form method="post" action="system.php?system=new_user">
                    <h1> </h1>
                    <div class="form-group  p-2">   
                        <select class="select2_single form-control" tabindex="-1" name="unvan" >
                            <option>Select</option>
                            <option value="Professor">Professor</option>
                            <option value="Associate Professor">Associate Professor</option>
                            <option value="Assistant Professor">Assistant Professor</option>
                            <option value="Dr">Dr</option>
                            <option value="PhD">PhD</option>
                            <option value="MSc">MSc</option>
                            <option value="Other">Other</option>

                        </select>
                    </div>
                    <div class="col-12 p-2">
                        <input type="text" class="form-control" placeholder="Your Name" name="name" required="" />
                    </div>

                       <div class="col-12 p-2">
                        <input type="text" class="form-control" placeholder="Your Surname" name="surname" required="" />
                    </div>

                    
                    <div class="col-12 p-2">
                        <input type="email" class="form-control" placeholder="Email" name="email"  required="" />
                    </div>
                     <div class="col-12 p-2">
                        <input type="password" class="form-control" placeholder="Password" name="pass"  required="" />
                    </div>
                     <div class="col-12 p-2">
                        <input type="password" class="form-control" placeholder="Again Password" name="pass_again"  required="" />
                    </div>
                     <div class="col-12 p-2">
                        <textarea style="margin-bottom: 20px; resize: none;" name="adress" class="form-control" rows="3" placeholder="Adress"></textarea>
                    </div>
                      <div class="col-12 p-2">
                        <input type="text" class="form-control" placeholder="Instition" name="instition"  required="" />
                    </div>

                      <div class="col-12 p-2">
                        <input type="text" class="form-control" placeholder="ORCID Number" name="orcid_no"  required="" />
                    </div>
                    <div class="col-12 p-2">
                        <input type="text" class="form-control" placeholder="Phone" name="phone"  required="" />
                    </div>

                      <div class="col-12 p-2">
                        <input type="text" class="form-control" placeholder="work area *** Please separate with comma  ***" name="work_area"  required="" />
                    </div>
					
					 <div class="col-12 p-2">
 						 <img  src="img.php" width="150" height="50">   </div>                
 <!--
                    <?php $sayi1 = rand(10, 20); 
                    $sayi2 = rand(1, 20);
                    $dogrulamakodu=$sayi2+$sayi1;
                     ?>
               		<div>
                        <input size="6" maxlength="6" class="form-control" disabled placeholder="<?php echo $sayi1.'+'.$sayi2.' '?> " type="text" />
                     </div>
                      
 
					<input value="<?php echo $dogrulamakodu; ?>" name="dkod" type="hidden" />
-->                 
 
 					 <div class="col-12 p-2">
                        <input size="6" maxlength="6" class="form-control" placeholder="Enter Code" name="kod" type="text" required />
 
                    </div>

                    
					
					 <div class="col-12">
                      <button class="btn btn-dark w-100 py-3" name="submit"   type="submit">Submit</button>
                      </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="index.php?page=login" class="to_register"> Login </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            
                        </div>
                    </div>
                </form>
            </section>
        </div>
		</div>
	 </div>
