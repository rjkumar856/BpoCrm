<?php 
if(isset($_GET['id']) && !empty($_GET['id'])){
$usrid = $_GET['id'];
}else{
    header("Location: user-list");
}

if(isset($_POST['cus_update_user'])){
    try{
        $user_id = addslashes(trim($_POST['user_id']));
		$full_name = htmlentities(trim($_POST['full_name']));
		$password = md5(trim($_POST['password']));
		$email = addslashes(trim($_POST['email']));
		$phone = htmlentities(trim($_POST['phone']));
		$city = htmlentities(trim($_POST['city']));
		$address = htmlentities(trim($_POST['address']));
		$course_type = htmlentities(trim($_POST['course_type']));
		$user_role = implode(',',$_POST['user_role']);
		    
		if(empty($user_id) || empty($full_name) || empty($email) || empty($phone) || empty($city) || empty($address) || empty($course_type)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
    			    $stmt = $reg_user->runQuery("UPDATE user SET userid='$user_id',full_name='$full_name',email='$email',phone='$phone',course_type='$course_type',
    			    address='$address',city='$city',role='$user_role' WHERE id='$usrid'");
                    $stmt->execute();
                    
                    if(!empty($password)){
                        $stmt = $reg_user->runQuery("UPDATE user SET password='$password' WHERE id='$usrid'");
                        $stmt->execute();
                    }
                    
            		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>User Details!</strong> Updated Successfully.</div>";
            		header("Location: edit-user-list?id=".$usrid);
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
						<h4>Update User List Details</h4>
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
										<label><b>User ID</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="User Name" name="user_id" value="<?php echo $row_user['userid']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Full Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Full Name" name="full_name" value="<?php echo $row_user['full_name']; ?>" required>
										</div>
									</div>
									<div class="form-group">
										<label><b>Password</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Password" name="password">
										</div>
									</div>	
									<div class="form-group">
									    <label><b>Phone*</b></label>
										<input type="text" placeholder="Phone" name="phone" class="form-control" value="<?php echo $row_user['phone']; ?>" required>
									</div>
		
									<div class="form-group">
									    <label><b>Address*</b></label>
									    <textarea name="address" rows="4" class="form-control" placeholder="Address" required><?php echo $row_user['address']; ?></textarea>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
										<label><b>Email*</b></label>
										<input type="text" placeholder="Email" name="email" class="form-control" value="<?php echo $row_user['email']; ?>" required>
									</div>
									
									<div class="form-group">
									    <label><b>City*</b></label>
										<input type="text" placeholder="City" name="city" class="form-control" value="<?php echo $row_user['city']; ?>" required>
									</div>

									<div class="form-group">
									    <label><b>Course Type</b></label>
                                			<select name="course_type" id="course_type" class="form-control" required="true">
                                           <option value="" selected="">Select Course</option>
                                           <option <?php if($row_user['course_type'] == "Prelims"){ echo "selected"; } ?> value="Prelims">Prelims</option>
                                           <option <?php if($row_user['course_type'] == "Prelims cum Mains"){ echo "selected"; } ?> value="Prelims cum Mains">Prelims cum Mains</option>
                                           <option <?php if($row_user['course_type'] == "Foundation Course"){ echo "selected"; } ?> value="Foundation Course">Foundation Course</option>
                                           <option <?php if($row_user['course_type'] == "Mains"){ echo "selected"; } ?> value="Mains">Mains</option>
                                           <option <?php if($row_user['course_type'] == "Optional subject"){ echo "selected"; } ?> value="Optional subject">Optional subject</option>
                                           <option <?php if($row_user['course_type'] == "Interview Guidance"){ echo "selected"; } ?> value="Interview Guidance">Interview Guidance</option>
                                           <option <?php if($row_user['course_type'] == "Study Materials"){ echo "selected"; } ?> value="Study Materials">Study Materials</option>
                                           <option <?php if($row_user['course_type'] == "Essay"){ echo "selected"; } ?> value="Essay">Essay</option>
                                           <option <?php if($row_user['course_type'] == "Integrated Course with Graduation"){ echo "selected"; } ?> value="Integrated Course with Graduation">Integrated Course with Graduation</option>
                                        </select>
									</div>
									<div class="form-group">
									    <label><b>Role (Permissions)*</b></label>
									    <? $user_role = explode(",",$row_user['role']);  ?>
									    <select multiple name="user_role[]" class="form-control">
									        <option <?php if(in_array("4",$user_role)){ echo "selected"; } ?> value="4">None</option>
									          <option <?php if(in_array("1",$user_role)){ echo "selected"; } ?> value="1">Prelims Online Test</option>
                                              <option <?php if(in_array("2",$user_role)){ echo "selected"; } ?> value="2">Mains Online Test</option>
                                              <option <?php if(in_array("3",$user_role)){ echo "selected"; } ?> value="3">Optional Online Test</option>
                                            </select>
                                            <p>To select the multiple option, Press CRTL and select the Option!</p>
									</div>
								</div>
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Update User" name="cus_update_user">
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