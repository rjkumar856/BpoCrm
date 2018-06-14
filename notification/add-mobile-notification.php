<?php
if(isset($_POST['SubmitButton'])){
    try{
		$title = htmlentities(trim($_POST['title']));
		$message = htmlentities(trim($_POST['message']));

		if(empty($title) || empty($message)){
		    $_SESSION['add_user_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the Fileds!</div>";
		}else{
		    
                    		    $registrationIds = "AIzaSyCMw2QKe4BvDnfAAZ2GyjWA5Z0rBJ_saNE";
                                // prep the bundle
                                $msg = array
                                (
                                	'message' 	=> 'here is a message. message',
                                	'title'		=> 'This is a title. title',
                                	'subtitle'	=> 'This is a subtitle. subtitle',
                                	'tickerText'	=> 'Ticker text here...Ticker text here...Ticker text here',
                                	'vibrate'	=> 1,
                                	'sound'		=> 1,
                                	'largeIcon'	=> 'large_icon',
                                	'smallIcon'	=> 'small_icon',
                                	"score"=> "5x1",
                                	"time"=>"15:10"
                                );
                                $fields = array(
                                	'registration_ids' 	=> $registrationIds,
                                	"to"=>"/topics/news",
                                	"notification"=> array("body"=>"Hello","title"=>"This is test message."),
                                	'data'			=> $msg
                                );
                                 
                                $headers = array(
                                	'Authorization: key=AIzaSyCMw2QKe4BvDnfAAZ2GyjWA5Z0rBJ_saNE',
                                	'Content-Type: application/json'
                                	);
                                 
                                $ch = curl_init();
                                curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
                                curl_setopt( $ch,CURLOPT_POST, true );
                                curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
                                curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
                                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
                                curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
                                $result = curl_exec($ch );
                                curl_close( $ch );
                                $result;
		    
                        $stmt = $reg_user->runQuery("INSERT INTO push_notification(title,body) 
            		    VALUES('$title','$message')");
                        $stmt->execute();
                        
                		$_SESSION['add_user_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button><strong>New Notification!</strong> Added Successfully.</div>";
                		header("Location: add-mobile-notification");
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
						<h4>Create New Notification</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="view-mobile-notification">Notification List</a></li>
							<li class="breadcrumb-item active"><a href="add-notification-slider">Add Notification</a></li>
						</ol>
						<div class="box box-block bg-white">
						    <div class="error-div"><?php if(isset($_SESSION['add_user_error_msg'])){ echo $_SESSION['add_user_error_msg']; unset($_SESSION['add_user_error_msg']); } ?></div>
							<form name="news upload" id="news" action="" method="POST" enctype="multipart/form-data">
								<div class="form-group">
									<label for="exampleInputEmail1"><b>Notification Title*</b></label>
									<input type="text" class="form-control" name="title" id="title" value="<?php if(isset($_POST['title'])){ echo $_POST['title']; } ?>" placeholder="Enter the Notification Title" required="required"/>
								</div>
						
								<div class="form-group">
									<label for="exampleInputPassword1"><b>Message*</b></label>
									<textarea class="form-control" name="message" required="required"><?php if(isset($_POST['message'])){ echo $_POST['message']; } ?></textarea>
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