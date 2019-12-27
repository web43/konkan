<!-- Sign in / Register Modal -->
       
       <!--       php code for sign in     -->
        <?php 
        //session_start();

        $servername="localhost";
        $username="root";
        $dbname="neuleaf";


        $conn=new mysqli($servername,$username,'',$dbname);
        if($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }     


       if(count($_SESSION)>=1)
        {
        echo '<a href="include/logout.php"><h1>LOgout</h1></a>';
        }

        if(isset($_POST['singin-email'])) {
        
            $uid=$_POST['singin-email'];
            $pass=$_POST['singin-password'];
            $sql="select * from user where email='".$uid."' AND password='".$pass."' limit 1";
            $result=$conn->query($sql);
        
        //    if(mysqli_num_rows($result)==1)
        //    {
            
            if (mysqli_num_rows($result)==1)
            {
                $_SESSION["user_name"]=$uid;
                //header("Location:homepage.php");
				echo print_r($_SESSION);
				echo '<a href="include/logout.php"><h1>LOgout</h1></a>';
                echo "<script>alert('Suscefully login')</script>";
                echo "</br>";
				
                exit();
            }    
            
        else{
                    echo "login fail";
            
            exit();
        }
            
        }
        //      sign in code end
        
        ?>

    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                                        <div class="form-group">
                                            <label for="singin-email">Username or email address *</label>
                                            <input type="text" class="form-control" id="singin-email" name="singin-email" required="">
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Password *</label>
                                            <input type="password" class="form-control" id="singin-password" name="singin-password" required="">
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="signin-remember">
                                                <label class="custom-control-label" for="signin-remember">Remember Me</label>
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
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form action="#">
										<div class="form-group">
                                            <label for="register-name">Your Name *</label>
                                            <input type="email" class="form-control" id="register-name" name="register-name" required="">
										</div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-lastname">Your Lastname *</label>
                                            <input type="email" class="form-control" id="register-lastname" name="register-lastname" required="">
                                        </div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-email">Your email address *</label>
                                            <input type="email" class="form-control" id="register-email" name="register-email" required="">
                                        </div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-number">Phone Number *</label>
                                            <input type="password" class="form-control" id="register-number" name="register-number" required="">
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">Password *</label>
                                            <input type="password" class="form-control" id="register-password" name="register-password" required="">
                                        </div><!-- End .form-group -->
                                        <div class="form-group">
                                            <label for="register-Confirm_password">Confirm Password *</label>
                                            <input type="password" class="form-control" id="Confirm_password" name="Confirm_password" required="">
                                        </div><!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" name="Submit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy" required="">
                                                <label class="custom-control-label" for="register-policy">I agree to the <a href="#">privacy policy</a> *</label>
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
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->