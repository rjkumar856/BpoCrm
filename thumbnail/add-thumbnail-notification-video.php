<?php
if(isset($_POST['cus_add_new_user'])){
		try{
		    $embed_youtube_url = addslashes(trim($_POST['embed_youtube_url']));
		if(empty($embed_youtube_url)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
		    $stmt = $reg_user->runQuery("INSERT INTO director_message(embed_youtube_url) VALUES('$embed_youtube_url')");
            $stmt->execute();
            $new_user_id = $reg_user->lasdID();
    		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>New Thumbnail Youtube URL!</strong> Added Successfully.</div>";
    		header("Location: add-thumbnail-notification-video");
    		exit();
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
						<h4>Create New Home Page Video</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="view-thumbnail-notification-video">Thumbnail Home Page Videos</a></li>
							<li class="breadcrumb-item active"><a href="#">Add Home Page Videos</a></li>
						</ol>
						<div class="box box-block bg-white">
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>
							
							<form name="news upload" id="news" action="" method="POST" enctype="multipart/form-data">
						
								<div class="form-group">
									<label for="exampleInputPassword1"><b>Embed Youtube Video URL*</b></label>
									<input type="text" class="form-control" name="embed_youtube_url" id="name" aria-describedby="emailHelp" placeholder="Enter the embed youtube video URL" required="required" value="<?php if(isset($_POST['embed_youtube_url'])){ echo $_POST['embed_youtube_url']; } ?>"/>
								</div>
								<button type="submit" name="cus_add_new_user" class="btn btn-primary">Submit</button> &nbsp;
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