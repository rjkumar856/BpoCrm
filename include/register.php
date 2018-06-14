<?php
if(isset($_POST['register'])){
    try{
		$first_name = htmlentities(trim($_POST['first_name']));
		$password = md5(trim($_POST['password']));
		$cpassword = md5(trim($_POST['cpassword']));
		$email = addslashes(trim($_POST['email']));
		$mobile = htmlentities(trim($_POST['mobile']));
		$cuscode = time().rand(111,999);
		
		if(empty($password) || empty($first_name) || empty($email) || empty($mobile)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
		
		if($password != $cpassword){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Password and Confirm password does not match!</div>";
		}else{
		  
    		    $stmt = $reg_user->runQuery("SELECT * FROM user WHERE cusEmail='$email'");
    			$stmt->execute();
    			if($stmt->rowCount()){
    			    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>User Name or Email alredy exist. Please use different Email ID!</div>";
    			}else{
    			    $ip_address = $class_user->getClientIP();
    			    $stmt = $reg_user->runQuery("INSERT INTO user(user_name,first_name,cusEmail,cusPassword,mobile,dob,address1,address2,city,state,country,usertype,cusStatus,reserve_id,ip_address) 
                    VALUES('$email','$first_name','$email','$password','$mobile','','','','','','','normal','N','$cuscode','$ip_address')");
                    $stmt->execute();
                    $new_user_id = $reg_user->lasdID();
                    $key = base64_encode($new_user_id);
                    
                    $message = "Hello $first_name,<br /><br />
                    Welcome to BPO CRM!<br/>
            			To complete your registration  please , just click following link<br/>
            			<br /><br />
            			<a href='".DIR_SYSTEM."userverify?id=$key&code=$cuscode'>Click HERE to Activate :)</a>
            			<br /><br />
            			Thanks,";

			$subject = "Confirm Registration";
			$class_user->send_mail_post($email,$message,$subject);	
                    
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>
            		<strong>Success!</strong>  We've sent an email to <b>$email</b>. Please click on the confirmation link in the email to create your account.</div>";
            		header("Location: register");
            		exit();
    			}
		} }
		
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>BPO CRM</title>
<link rel="stylesheet" href="vendor/bootstrap4/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.css">
		<link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/core.css">
<body class="img-cover" style="background-image: url(images/img/photos-1/2.jpeg);">
		<div class="container-fluid">
			<div class="sign-form register">
				<div class="row">
					<div class="col-md-4 offset-md-4 px-3">
						<div class="box b-a-0">
							<div class="logodiv">
								<img src="images/logo.png">
							</div>
							<form method="post" enctype="multipart/form-data" class="form-material">
							<?php 
                            if(isset($_SESSION['userExist'])) 
                            { ?>
                            <div class='alert alert-warning'>
                            <button class='close' data-dismiss='alert'>&times;</button>
                            <?php echo $_SESSION['userExist']; ?>
                            </div class="alert-msg">
                            <?php 
                            unset($_SESSION['userExist']);
                            }
                            
                            if(isset($_SESSION['add_user_error_msg'])) 
                            { ?>
                            <div>
                            <?php echo $_SESSION['add_user_error_msg']; ?>
                            </div>
                            <?php 
                            unset($_SESSION['add_user_error_msg']);
                            }
                            ?>
                            <p id="pass1" style="color: red"></p>
								<div class="form-group">
									<input type="text" class="form-control" name="first_name" value="<?php if(isset($_POST['first_name'])){ echo $_POST['first_name']; } ?>" id="input-fname" placeholder="First Name*" required="required" >
								</div>
								<div class="form-group">
									<input type="email" class="form-control" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" id="input-email" placeholder="Email*" required="required" >
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="mobile" value="<?php if(isset($_POST['mobile'])){ echo $_POST['mobile']; } ?>" id="input-email" pattern="[6-9]{1}[0-9]{9}" placeholder="Mobile*" required="required" title="Phone number with 6-9 and remaing 9 digit with 0-9">
								</div>
								<div class="form-group">
									<input type="password" name="password" value="<?php if(isset($_POST['password'])){ echo $_POST['password']; } ?>" id="password" placeholder="Password*"  class="form-control" required="required" >
								</div>
								<div class="form-group mb-3">
									<input type="password" name="cpassword" value="<?php if(isset($_POST['cpassword'])){ echo $_POST['cpassword']; } ?>" id="cpassword" class="form-control" placeholder="Confirm password*" required="required" >
								</div>
								<div class="px-2 form-group mb-0">
									<button t type="submit" value="Register" name="register" class="btn btn-purple btn-block text-uppercase">Sign up</button>
								</div>
							</form>
							<div class="p-2 text-xs-center text-muted">
								Already have an account? <a class="text-black" href="<?php echo DIR_SYSTEM; ?>login"><span class="underline">Sign in</span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="vendor/jquery/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="vendor/tether/js/tether.min.js"></script>
		<script type="text/javascript" src="vendor/bootstrap4/js/bootstrap.min.js"></script>
        <script>
        $(document).ready(function(){
        $( "#cpassword" ).blur(function() {
        var pass = $("#password").val();
        var cpass = $("#cpassword").val();
        if(pass != cpass){
        $("#pass1").text("Password Dint Match");
        }
        else
        {
        $("#pass1").text("");
        }
        });
        });
        </script>
</body>
</html>