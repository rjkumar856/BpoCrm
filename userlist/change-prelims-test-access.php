<?php 
if(isset($_GET['id']) && !empty($_GET['id'])){
$usrid = $_GET['id'];
}else{
    header("Location: user-list");
}

if(isset($_POST['cus_update_user'])){
    try{
        $user_id = addslashes(trim($_POST['user_id']));
		$question_type = htmlentities(trim($_POST['question_type']));
		    
		if(empty($user_id) || empty($question_type)){
		    echo $user_id;
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please select the anyone Question Set Number!</div>";
		}else{
		    
		    $stmt_check = $reg_user->runQuery("SELECT * FROM online_test_prelime_user_access WHERE user_id='$usrid' AND question_id='$question_type'");
            $stmt_check->execute();
            if($stmt_check->rowCount() > 0){
		            $stmt_check1 = $stmt_check->fetchObject();
		            $status = (int) $stmt_check1->status + 1;
    			    $stmt = $reg_user->runQuery("UPDATE online_test_prelime_user_access SET status='$status' WHERE user_id='$usrid' AND question_id='$question_type'");
                    $stmt->execute();
            }else{
                $stmt = $reg_user->runQuery("INSERT INTO online_test_prelime_user_access (user_id,question_id,status) VALUES('$usrid','$question_type','1')");
                $stmt->execute();
            }
            
            $_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>User Details!</strong> Updated Successfully.</div>";
            	header("Location: change-prelims-test-access?id=".$usrid);
            	exit();
		}
		
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}

include 'include/header.php';
$stmt_user = $reg_user->runQuery("SELECT * FROM user WHERE id='$usrid'");
$stmt_user->execute();
$row_user = $stmt_user->fetch(PDO::FETCH_ASSOC);
?>
<div class="site-content">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Update User Prelims Test Permissions</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="user-list">User List</a></li>
							<li class="breadcrumb-item active"><a href="#">Edit User</a></li>
						</ol>
						<div class="box box-block bg-white">
						<div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>Full Name*</b></label>
										<div class="input-group">
										    <input type="hidden" name="user_id" value="<?php echo $row_user['userid']; ?>">
											<input type="text" class="form-control" placeholder="Full Name" name="full_name" value="<?php echo $row_user['full_name']; ?>" required readonly>
										</div>
									</div>
		
									<div class="form-group">
									    <label><b>Question Set Number*</b></label>
									    <select name="question_type" class="form-control" required>
									        <option value="">Select the Question Set</option>
									        <?php
									        $stmt = $reg_user->runQuery("SELECT DISTINCT question_type FROM online_test_questions_prelims");
                                            $stmt->execute();
                                            for($i=0; $stmt1 = $stmt->fetchObject(); $i++){
									        ?>
									        <option <?php if($_POST['question_type'] == $stmt1->question_type){ echo "selected"; } ?> value="<?php echo $stmt1->question_type; ?>"><?php echo $stmt1->question_type; ?></option>
									        <?php } ?>
                                            </select>
                                            <p>Select the Question Set to user to attend this Test one more time!</p>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label><b>Email*</b></label>
										<input type="text" placeholder="Email" name="email" class="form-control" value="<?php echo $row_user['email']; ?>" required readonly>
									</div>
								</div>
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Update Access" name="cus_update_user">
									</div>
									</div>
							</form>
							</div>
						</div>
					</div>
				</div>
				
		<script type="text/javascript" src="vendor/jquery/jquery-1.12.3.min.js"></script>
		<script type="text/javascript" src="vendor/tether/js/tether.min.js"></script>
		<script type="text/javascript" src="vendor/bootstrap4/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="vendor/detectmobilebrowser/detectmobilebrowser.js"></script>
		<script type="text/javascript" src="vendor/jscrollpane/jquery.mousewheel.js"></script>
		<script type="text/javascript" src="vendor/jscrollpane/mwheelIntent.js"></script>
		<script type="text/javascript" src="vendor/jscrollpane/jquery.jscrollpane.min.js"></script>
		<script type="text/javascript" src="vendor/jquery-fullscreen-plugin/jquery.fullscreen-min.js"></script>
		<script type="text/javascript" src="vendor/waves/waves.min.js"></script>
		<script type="text/javascript" src="vendor/switchery/dist/switchery.min.js"></script>
		<script type="text/javascript" src="vendor/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
		<script type="text/javascript" src="vendor/autoNumeric/autoNumeric-min.js"></script>
		<script type="text/javascript" src="vendor/dropify/dist/js/dropify.min.js"></script>
		<script type="text/javascript" src="vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
		<script type="text/javascript" src="vendor/clockpicker/dist/jquery-clockpicker.min.js"></script>
		<script type="text/javascript" src="vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
		<!-- Neptune JS -->
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>
		<script type="text/javascript" src="js/forms-masks.js"></script>
		<script type="text/javascript" src="js/forms-upload.js"></script>
        </body>
		</html>