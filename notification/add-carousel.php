<?php
 if(isset($_POST['SubmitButton'])){
		
		$title1 = htmlentities(trim($_POST['title1']));
		//echo $name;
		//$password = md5(trim($_POST['password']));
		//$email = addslashes(trim($_POST['email']));
		//$phone = htmlentities(trim($_POST['phone']));
		$title2 = htmlentities(trim($_POST['title2']));
		//echo $experience;
		$title3 = htmlentities(trim($_POST['title3']));
		$file_url = htmlentities(trim($_POST['file_url']));
		//echo $qualification;
		//$expertise = htmlentities(trim($_POST['expertise']));
		//echo $expertise;
		//$role = htmlentities(trim($_POST['role']));
		//$image = htmlentities(trim($_POST['image']));
		//echo $role;
		
	$filename=time().$_FILES['file2']['name'];
	//echo $filename;
	$filetype=$_FILES['file2']['type'];
	$filesize=$_FILES['file2']['size'];
	$temploc=$_FILES['file2']['tmp_name'];
	//move_uploaded_file($temploc,"file2/$filename");
	
	move_uploaded_file($temploc,"slider/$filename");
		
	            $stmt = $reg_user->runQuery("insert into carousel_images(image,title1,title2,title3,file_url)
	values('$filename','$title1','$title2','$title3','$file_url')");
	$stmt->execute();
	//mysqli_query($con1,$sql);		
		
} 
include 'include/header.php';
?>
<div class="site-content">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Create New Carousel Name</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="/ias/newadmin/carouselimages/view-carousel">Carousel User List</a></li>
							<li class="breadcrumb-item active"><a href="#">Add Admin User</a></li>
						</ol>
						<div class="box box-block bg-white">
						    
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							
							
							<form name="news upload" id="news" action="" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label for="exampleInputEmail1">Title1</label>
									<input type="text" class="form-control" name="title1" id="name" aria-describedby="emailHelp" placeholder="Enter the title1" required="required"/>
									<small id="emailHelp" class="form-text text-muted">We'll never share your blogs headline with anyone else.</small>
								</div>
						
								
								<div class="form-group">
									<label for="exampleInputPassword1">Title2</label>
									<input type="text" class="form-control" name="title2" id="qualification" placeholder="Enter the title2" required="required"/>
								</div>
								
								<div class="form-group">
									<label for="exampleInputPassword1">Title3</label>
									<input type="text" class="form-control" name="title3" id="expertise" placeholder="Enter the title3" required="required"/>
								</div>
								
								<div class="form-group">
									<label for="exampleInputPassword1">File URL</label>
									<input type="number " class="form-control" name="file_url" id="experience" placeholder="Enter the experience in number format" required="required"/>
								</div>
								
								
								<div class="form-group">
									<label for="exampleInputFile">File input</label>
									<input type="file" class="form-control-file" name="file2" id="file21" aria-describedby="fileHelp" required="required"/>
									<small id="fileHelp" class="form-text text-muted">Here admin can upload the blogs picture.</small>
								</div>
							
								<div class="checkbox">
									<label>
										<input type="checkbox" required="required"/> Check me out
									</label>
								</div>
								<button type="submit"  name="SubmitButton" class="btn btn-primary">Submit</button> &nbsp;
								<button type="reset" class="btn btn-danger">Reset</button>
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
		<script type="text/javascript" src="js/forms-pickers.js"></script>
		</body>
		</html>