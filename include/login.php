 <!DOCTYPE html>
<html lang="en">
<head>
<title>BPO CRM</title>
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/bootstrap4/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/themify-icons/themify-icons.css">
		<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>css/core.css">
                <?php
                                $stmt = $reg_user->runQuery("SELECT * FROM login WHERE id = '1' ");
                                $stmt->execute();
                                for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
                                { ?>
<body class="img-cover" style="background-image: url(<?php echo DIR_SYSTEM; ?><?php echo $stmt1->bg; ?>);">
		<div class="container-fluid">
			<div class="sign-form">
				<div class="row">
					<div class="col-md-4 offset-md-7 px-3">
						<div class="box b-a-0">
							<div class="logodiv">
                                                                    
                                
								<img src="<?php echo DIR_SYSTEM; ?><?php echo $stmt1->logo; ?>" style="height: 90px;">

                                                                <?php
                                                        }
                                                                ?>
							</div>
							<!-- <div class="p-2 text-xs-center">
								<h5>Welcome</h5>
							</div> -->
							<form action="<?php echo DIR_SYSTEM; ?>login_db" method="post" enctype="multipart/form-data" class="form-material mb-1">
                                <?php if(isset($_SESSION['userPasswordWrong'])) 
                                { ?>
                                <div class='alert alert-warning'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <?php echo $_SESSION['userPasswordWrong']; ?>
                                </div>
                                <?php 
                                unset($_SESSION['userPasswordWrong']);
                                }  
                                if(isset($_SESSION['userInactive'])) 
                                { ?>
                                <div class='alert alert-warning'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <?php echo $_SESSION['userInactive']; ?>
                                </div>
                                <?php	 
                                unset($_SESSION['userInactive']);
                                }
                                if(isset($_SESSION['userNotExist'])) 
                                { ?>
                                <div class='alert alert-warning'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <?php echo $_SESSION['userNotExist']; ?>
                                </div>
                                <?php
                                unset($_SESSION['userNotExist']);
                                }
                                
                                if(isset($_GET['success']))
                                { ?>
                                <div class='alert alert-success'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <strong>Welcome!</strong> You can signing now. 
                                </div>
                                <?php }
                                if(isset($_SESSION['forgotpassword_succsess'])) 
                                { ?>
                                <div class='alert alert-success'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <?php echo $_SESSION['forgotpassword_succsess']; ?>
                                </div>
                                <?php 
                                unset($_SESSION['forgotpassword_succsess']);
                                }
                                if(isset($_SESSION['forgotpassword_error'])) 
                                { ?>
                                <div class='alert alert-warning'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <?php echo $_SESSION['forgotpassword_error']; ?>
                                </div>
                                <?php 
                                unset($_SESSION['forgotpassword_error']);
                                }
                                ?>
								<div class="form-group">
									<input type="text" name="email" class="form-control" value="" id="input-email" required="required" pattern="[a-zA-Z][\w\.-]*[a-zA-Z0-9]@([a-zA-Z0-9][\w\.-]*[a-zA-Z0-9]\.[a-zA-Z][a-zA-Z\.]*[a-zA-Z])"  placeholder="Email">
								</div>
								<div class="form-group">
									<input type="password" name="password" value="" class="form-control" id="input-password" required="required" placeholder="Password">
								</div>
								<!--<div class="form-group text-xs-right padd10" >
									<a href="forgot-password" >Forgot Password?</a>
								</div>--> 
								<div class="px-4 form-group mb-0">
									<button type="submit" value="Login" name="login" class="btn btn-purple btn-block text-uppercase">Sign in</button>
								</div>
								<div class="px-4 form-group mt-sm-1 text-black">
									New user <a href="<?php echo DIR_SYSTEM; ?>register" class="text-uppercase signup-btn underline" title="Sign up">Sign up</a> here?
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="<?php echo DIR_SYSTEM; ?>vendor/jquery/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="<?php echo DIR_SYSTEM; ?>vendor/tether/js/tether.min.js"></script>
		<script type="text/javascript" src="<?php echo DIR_SYSTEM; ?>vendor/bootstrap4/js/bootstrap.min.js"></script>
	</body>
</html>