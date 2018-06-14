<?php
if(isset($_POST['SubmitButton'])){
    try{
		$title = addslashes(htmlentities(trim($_POST['title'])));
		$file_url = addslashes(trim($_POST['file_url']));

		if(empty($title)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
		    
		    if($_FILES["result_file"]["size"]>10){
		    $target_dir = "../assets/files/notification/";
            $target_file = $target_dir . basename($_FILES["result_file"]["name"]);
            $uploadOk = 1;
            $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if($FileType == 'pdf'){
                    $file_name = time().".".$FileType;
                    $target_file_new = $target_dir . $file_name;
                    if (move_uploaded_file($_FILES["result_file"]["tmp_name"], $target_file_new)){
                        
                        $stmt = $reg_user->runQuery("INSERT INTO moving_slider_marquee(title,file_url,file_links) 
            		    VALUES('$title','$file_url','$file_name')");
            		    $stmt->execute();
                        
                		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>New Notification!</strong> Added Successfully.</div>";
                		header("Location: add-slider-marquee");
                		exit();
                    } else {
                        $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> Sorry, there was an error uploading your file.</div>";
                    }
                    
                }else {
                    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> Selected file is not a PDF file.</div>";
                }
		    }else{
                        $stmt = $reg_user->runQuery("INSERT INTO moving_slider_marquee(title,file_url,file_links) 
            		    VALUES('$title','$file_url','')");
                        $stmt->execute();
                        
                		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>New Notification!</strong> Added Successfully.</div>";
                		header("Location: add-slider-marquee");
                		exit();
		    }
		}
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
} 
include 'include/header.php';
?>
<div class="site-content">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Create New Moving Slider Name</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="view-slider-marquee">Moving Slider User List</a></li>
							<li class="breadcrumb-item active"><a href="#">Add Moving Slider</a></li>
						</ol>
						<div class="box box-block bg-white">
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>
							<form name="news upload" id="news" action="" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label for="exampleInputEmail1"><b>Notification Content*</b></label>
									<input type="text" class="form-control" name="title" id="title" value="<?php if(isset($_POST['title'])){ echo $_POST['title']; } ?>" placeholder="Enter the slider content" required="required"/>
								</div>
								
								<div class="form-group">
									    <label><b>To change Article File (pdf file only)*</b></label>
										<input placeholder="Article File" class="form-control" accept="application/pdf" type="file" id="result_file" name="result_file" value="<?php if(isset($_POST['result_file'])){ echo $_POST['result_file']; } ?>" >
									</div>
									<p>(OR)</p>
								<div class="form-group">
									<label for="exampleInputPassword1"><b>URL</b></label>
									<input type="text" class="form-control" name="file_url" value="<?php if(isset($_POST['file_url'])){ echo $_POST['file_url']; } ?>" id="file_url" placeholder="Enter the url" />
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