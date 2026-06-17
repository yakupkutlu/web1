<div class="row justify-content-center"> <!-- Added justify-content-center class to center the column -->
    <div class="col-md-4">
        <div class="wow fadeInUp" data-wow-delay="0.5s">
            <p class="mb-4"> </p>
            <form method="post" action="system.php?system=login">
            <center><h3> Editorial Manager System </h3></center>
                <center><h1> Login </h1></center>
                <div class="row g-3">
                    <div class="col-md-12"> <!-- Changed col-md-6 to col-md-12 to occupy full width -->
                        <div class="form-floating">
                            <input type="text" class="form-control" id="name" placeholder="User Name" name="user" >
                            <label for="name">e-mail </label>
                        </div>
                    </div>
                    <div class="col-md-12"> <!-- Changed col-md-6 to col-md-12 to occupy full width -->
                        <div class="form-floating">
                            <input type="password" class="form-control" id="Password" placeholder="Password" name="pass" >
                            <label for="email">Password</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <img  src="img.php" width="150" height="50"> <br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input  class="form-control" id="Password" placeholder="Enter Code " name="kod" type="text" >
                            <label for="email">Code</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-dark w-100 py-3" type="submit">Login</button>
                    </div>
					
					<button class="btn rounded-pill border btn-dark" >  <a class="to_register" href="index.php?page=reset_pass">Lost your password?</a></button> 
					
					<button class="btn  rounded-pill border btn-dark" >   <a href="index.php?page=signup" class="to_register" style="font-size: 15px!important; font-weight: bold;">New User? Create Account </a></button> 
					
                   
                </div>
            </form>
        </div>
    </div>
</div>