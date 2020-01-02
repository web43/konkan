    <?php 
        session_start();
       
        $servername="localhost";
        $username="root";
        $dbname="neuleaf";
        $login_err='';

        $conn=new mysqli($servername,$username,'',$dbname);
        if($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }     


    //---------------------User login Php code ----------------------------------


       if(isset($_POST['singin-email']))
        {

            
        
            $uid=filter_var($_POST['singin-email'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $pass=filter_var($_POST['singin-password'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            $sql="select * from user where email='".$uid."' AND password='".$pass."' limit 1";
            $result=$conn->query($sql);
        
        //    if(mysqli_num_rows($result)==1)
        //    {
            
            if (mysqli_num_rows($result)==1)
            {
                $_SESSION["user_name"]=$uid;
                header("Location:index.php");
                echo '<a href="include/logout.php"><h1>LOgout</h1></a>';
               // echo "</br>";
				//header("Location:../index.php");
               // exit();
            }    
            
                else
                {
                    
                    $login_err="Invalid email or password";
					//echo "<script>alert('Invalid email or password')</script>";
				}
            
            
        }
        // -------------------------validation for registration form--------------
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }

        $errors=array();
        $first_name=$last_name=$u_email=$phone=$address=$password='';
        $first_name_err=$last_name_err=$u_email_err=$address_err=$phone_err=$password_err='';

        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            if(empty($_POST["register-name"]))
            {
                $first_name_err="First name is reuired";
                array_push($errors,$first_name_err);
            }
            else
            {
                $first_name=filter_var($_POST["register-name"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
                    $first_name_err = "Only letters and white space allowed";
                    array_push($errors,$first_name_err);
                  }
            }

            if(empty($_POST["register-lastname"]))
            {
                $last_name_err="Last name required";
                array_push($errors,$first_name_err);
            }
            else
            {
                $last_name=filter_var($_POST["register-lastname"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
                    $last_name_err = "Only letters and white space allowed";
                    array_push($errors,$last_name_err);
                  }
            }
            if(empty($_POST["register-email"]))
            {
                $u_email_err="Email is Required";
                array_push($errors);
            }
            else
            {
                $u_email=test_input($_POST["register-email"]);
                if(!filter_var($u_email, FILTER_VALIDATE_EMAIL))
                {
                    $u_email_err="Invalid email format";
                }
            }

            if(empty($_POST["register-number"]))
            {
                $phone_err="Mobile number required";
                array_push($errors);
            }
            else{
                $filtered_phone_number=filter_var($_POST["register-number"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                $phone_to_check = str_replace("-", "", $filtered_phone_number);
                if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 14) {
                    $phone_err="invalid number";
                    array_push($errors);
                 } else {
                   $phone=$_POST["register-number"];
                 }
            
               
            }

            if(empty($_POST["register-address"]))
            {
                $address_err="Please enter your address";
                array_push($errors,$password_err);
            }
            else{
                $address=filter_var($_POST["register-address"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
            }

            if(empty($_POST['register-password']))
            {
                $password_err="Please fill password";
                array_push($errors,$password_err);

            }
            else if($_POST['register-password']!=$_POST['Confirm_password'])
            {
              $password_err="Password does not match";
              array_push($errors,$password_err);
            }
            else
            {
              $password=test_input($_POST['Confirm_password']);
            }
        }
        // -------------------------End of validation for registration form--------------





        include("include/loginHeader.html");    
    ?>
        <main class="main">
            <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Login</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url('assets/images/backgrounds/login-bg.jpg')">
            	<div class="container">
            		<div class="form-box">
            			<div class="form-tab">
	            			<ul class="nav nav-pills nav-fill" role="tablist">
							    <li class="nav-item">
							        <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Sign In</a>
							    </li>
							    <li class="nav-item">
							        <a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Register</a>
							    </li>
							</ul>
							<div class="tab-content">
							    <div class="tab-pane fade" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
							    	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
							    		<div class="form-group">
							    			<label for="singin-email-2">Username or email address *</label>
							    			<input type="text" class="form-control" id="singin-email-2" name="singin-email" value="<?php echo $uid;?>" required="">
							    		</div><!-- End .form-group -->

							    		<div class="form-group">
							    			<label for="singin-password-2">Password *</label>
                                            <input type="password" class="form-control" id="singin-password-2" name="singin-password" required="">
                                            <span class="error"><?php echo "*" .$login_err ?> </span>
							    		</div><!-- End .form-group -->

							    		<div class="form-footer">
							    			<button type="submit" class="btn btn-outline-primary-2">
			                					<span>LOG IN</span>
			            						<i class="icon-long-arrow-right"></i>
			                				</button>

			                				<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="signin-remember-2">
												<label class="custom-control-label" for="signin-remember-2">Remember Me</label>
											</div><!-- End .custom-checkbox -->

											<a href="#" class="forgot-link">Forgot Your Password?</a>
							    		</div><!-- End .form-footer -->
							    	</form>
							    	<div class="form-choice">
								    	<p class="text-center">or sign in with</p>
								    	<div class="row">
								    		<div class="col-sm-6">
								    			<a href="#" class="btn btn-login btn-g">
								    				<i class="icon-google"></i>
								    				Login With Google
								    			</a>
								    		</div><!-- End .col-6 -->
								    		<div class="col-sm-6">
								    			<a href="#" class="btn btn-login btn-f">
								    				<i class="icon-facebook-f"></i>
								    				Login With Facebook
								    			</a>
								    		</div><!-- End .col-6 -->
								    	</div><!-- End .row -->
							    	</div><!-- End .form-choice -->
							    </div><!-- .End .tab-pane -->
							    <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
							    	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							    		<div class="form-group">
                                            <label for="register-name">Your Name *</label>
                                            <input type="text" class="form-control" id="register-name" name="register-name" value="<?php echo $first_name;?>" required="">
                                            <span class="error"><?php echo $first_name_err; ?></span>
										</div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-lastname">Your Lastname *</label>
                                            <input type="text" class="form-control" id="register-lastname" name="register-lastname" value="<?php echo $last_name;?>" required="">
                                            <span class="error"><?php echo $last_name_err; ?></span>
                                        </div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-email">Your email address *</label>
                                            <input type="email" class="form-control" id="register-email" name="register-email" value="<?php echo $u_email;?>" required="">
                                            <span class="error"><?php echo $u_email_err; ?></span>
                                        </div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-number">Phone Number *</label>
                                            <input type="phone" class="form-control" id="register-number" name="register-number" value="<?php echo $phone;?>" required="">
                                            <span class="error"><?php echo $phone_err; ?></span>
                                        </div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-name">Address: </label>
                                            <input type="text" class="form-control" id="register-address" name="register-address" value="<?php echo $address;?>" required="">
                                            <span class="error"><?php echo $address_err; ?></span>
										</div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">Password *</label>
                                            <input type="password" class="form-control" id="register-password" name="register-password" value="<?php echo $password;?>" required="">
                                            <span class="error"><?php echo $password_err; ?></span>
                                        </div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-Confirm_password">Confirm Password *</label>
                                            <input type="password" class="form-control" id="Confirm_password" name="Confirm_password" required="">
                                        </div><!-- End .form-group -->
							    		<div class="form-footer">
							    			<button type="submit" class="btn btn-outline-primary-2">
			                					<span>SIGN UP</span>
			            						<i class="icon-long-arrow-right"></i>
			                				</button>
			                				<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="register-policy-2" required="">
												<label class="custom-control-label" for="register-policy-2">I agree to the <a href="#">privacy policy</a> *</label>
											</div><!-- End .custom-checkbox -->
							    		</div><!-- End .form-footer -->
							    	</form>
							    	<div class="form-choice">
								    	<p class="text-center">or sign in with</p>
								    	<div class="row">
								    		<div class="col-sm-6">
								    			<a href="#" class="btn btn-login btn-g">
								    				<i class="icon-google"></i>
								    				Login With Google
								    			</a>
								    		</div><!-- End .col-6 -->
								    		<div class="col-sm-6">
								    			<a href="#" class="btn btn-login  btn-f">
								    				<i class="icon-facebook-f"></i>
								    				Login With Facebook
								    			</a>
								    		</div><!-- End .col-6 -->
								    	</div><!-- End .row -->
							    	</div><!-- End .form-choice -->
							    </div><!-- .End .tab-pane -->
							</div><!-- End .tab-content -->
						</div><!-- End .form-tab -->
            		</div><!-- End .form-box -->
            	</div><!-- End .container -->
            </div><!-- End .login-page section-bg -->
        </main><!-- End .main -->

        <?php 
        include('include/loginFooter.php');
        ?>   
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search" placeholder="Search in..." required="">
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>
            
            <nav class="mobile-nav">
                <ul class="mobile-menu">
                    <li class="active">
                        <a href="index.html">Home</a>
                    </li>
                    <li>
                        <a href="category.html">Shop</a>
                    </li>
                    <li>
                        <a href="product.html" class="sf-with-ul">Product</a>
                    </li>
                    <li>
                        <a href="#">Pages</a>
                    </li>
                    <li>
                        <a href="blog.html">Blog</a>
                    </li>
                    <li>
                        <a href="elements-list.html">Elements</a>
                    </li>
                </ul>
            </nav><!-- End .mobile-nav -->

            <div class="social-icons">
                <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
                <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
            </div><!-- End .social-icons -->
        </div><!-- End .mobile-menu-wrapper -->
    </div><!-- End .mobile-menu-container -->

    <!-- Sign in / Register Modal -->
     
    <!-- Plugins JS File -->
    <script src="assets\js\jquery.min.js"></script>
    <script src="assets\js\bootstrap.bundle.min.js"></script>
    <script src="assets\js\jquery.hoverIntent.min.js"></script>
    <script src="assets\js\jquery.waypoints.min.js"></script>
    <script src="assets\js\superfish.min.js"></script>
    <script src="assets\js\owl.carousel.min.js"></script>
    <!-- Main JS File -->
    <script src="assets\js\main.js"></script>

    <script>
	function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        function nospaces(t) {
            if (t.value.match(/\s/g)) {
                t.value = t.value.replace(/\s/g, '');
            }
        }

</script>
</body>

</html>