<?php
if(empty($_GET['id']) && empty($_GET['code']))
                                {
                                header( "refresh:5;url=login" );
                                }
                                
                                if(isset($_GET['id']) && isset($_GET['code']))
                                {
                                $id = base64_decode($_GET['id']);
                                $code = $_GET['code']; 
                                
                                $stmt = $reg_user->runQuery("SELECT * FROM user WHERE id=:id AND reserve_id=:cusCode LIMIT 1");
                                $stmt->execute(array(":id"=>$id,":cusCode"=>$code));
                                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                                if($stmt->rowCount()){
                                if($row['cusStatus']=== 'N'){
                                $stmt = $reg_user->runQuery("UPDATE user SET cusStatus='Y' WHERE id=:id");
                                $stmt->bindparam(":id",$id);
                                $stmt->execute();	
                                
                                $msg = "
                                <div class='alert alert-success' style='margin-top:20px !important;'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <strong>WoW !</strong>  Your Account is Now Activated please wait while we redirect you to our login page.</div>";
                                header( "refresh:5;url=login" );
                                }
                                else{
                                $msg = "<div class='alert alert-warning' style='margin-top:20px !important;'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <strong>Sorry !</strong>  Your Account is allready Activated please wait while we redirect you to our login page.</div>";
                                header( "refresh:5;url=login" );
                                }
                                }
                                else
                                {
                                $msg = "<div class='alert alert-warning' style='margin-top:20px !important;'>
                                <button class='close' data-dismiss='alert'>&times;</button>
                                <strong>Sorry !</strong>  No Account Found please wait while we redirect you to our register page.</div>";
                                header( "refresh:5;url=register" );
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
							<div>
							    <?php echo $msg; ?>
							</div>
							<div class="p-2 text-xs-center text-muted">
								If already verified <a class="text-black" href="<?php echo DIR_SYSTEM; ?>login"><span class="underline">Sign in</span></a> here!
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript" src="vendor/jquery/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="vendor/tether/js/tether.min.js"></script>
		<script type="text/javascript" src="vendor/bootstrap4/js/bootstrap.min.js"></script>
</body>
</html>