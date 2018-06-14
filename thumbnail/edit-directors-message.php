<?php
if(isset($_GET['id'])){
$edit_requested_id=$_GET['id'];
}else{
    header("Location: view-directors-message");
}

if(isset($_POST['cus_add_new_user'])){
    try{
		$content_title = htmlentities(trim($_POST['content_title']));
		$content_link = htmlentities(trim($_POST['content_link']));
		$contents = htmlentities(trim($_POST['contents']));
		
		if(empty($content_title) || empty($content_link) || empty($contents)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
		    $stmt = $reg_user->runQuery("UPDATE director_message_contents SET title='$content_title',content='$contents',link='$content_link' WHERE id='$edit_requested_id'");
            $stmt->execute();
            
    		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>Directors Message!</strong> Updated Successfully.</div>";
    		header("Location: edit-directors-message?id=".$edit_requested_id);
    		exit();
		}
		}catch(PDOException $ex){
			$_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}
include 'include/header.php';
$edit_requested_query = $reg_user->runQuery("SELECT * FROM director_message_contents WHERE id='$edit_requested_id'");
$edit_requested_query->execute();
$edit_requested_details = $edit_requested_query->fetch(PDO::FETCH_ASSOC);
?>
<div class="site-content">
				<div class="content-area py-1">
					<div class="container-fluid">
						<h4>Edit Directors Message</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="view-directors-message">View Directors Message</a></li>
							<li class="breadcrumb-item active"><a href="#">Edit Directors Message</a></li>
						</ol>
						<div class="box box-block bg-white">
						    
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>

							<form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
									    <label><b>Content Title*</b></label>
										<input type="text" id="content_title" placeholder="Title" name="content_title" value="<?php echo $edit_requested_details['title']; ?>" class="form-control" required>
									</div>
									
									<div class="form-group">
									    <label><b>Content Link*</b></label>
										<input type="text" id="content_link" placeholder="Link" name="content_link" value="<?php echo $edit_requested_details['link']; ?>" class="form-control" required>
									</div>
								</div>
								
								<div class="col-md-6">
									<div class="form-group">
									    <label><b>Contents*</b></label>
									    <textarea name="contents" id="contents" class="form-control" rows="6" placeholder="Contents" required><?php echo $edit_requested_details['content']; ?></textarea>
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Update Directors Message" name="cus_add_new_user">
									</div>
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
		<script type="text/javascript" src="js/forms-pickers.js"></script>
		</body>
		</html>