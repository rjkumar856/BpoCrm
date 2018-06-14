<?php
if(isset($_GET['id'])){
$get_lead_id = $_GET['id'];
}else{
    $class_user->redirect('view_leads');
}

if(isset($_POST['add_new_leads'])){
    try{
		$first_name = htmlentities(trim($_POST['fisrt_name']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$last_name = htmlentities(trim($_POST['last_name']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$middle_name = htmlentities(trim($_POST['middle_name']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$email = addslashes(htmlentities(trim($_POST['email']),ENT_QUOTES,"UTF-8",FALSE));
		$phone = htmlentities(trim($_POST['phone']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$alter_num = htmlentities(trim($_POST['alter_num']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$address_line1 = htmlentities(trim($_POST['address_line1']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$address_line2 = htmlentities(trim($_POST['address_line2']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$state = htmlentities(trim($_POST['state']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$city = htmlentities(trim($_POST['city']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$country = htmlentities(trim($_POST['country']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$zip_code = htmlentities(trim($_POST['zip_code']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		
		$customer_pass = htmlentities(trim($_POST['customer_pass']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$rdspass = htmlentities(trim($_POST['rdspass']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$rds_id = htmlentities(trim($_POST['rds_id']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		
		$total_amount = htmlentities(trim($_POST['total_amount']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$tenure = htmlentities(trim($_POST['tenure']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$reference_number = htmlentities(trim($_POST['reference_number']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$ticket_number = htmlentities(trim($_POST['ticket_number']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		
		if(empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($state) || empty($city) || empty($country)){
		    $_SESSION['add_lead_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the required Fileds!</div>";
		}else{
		    
		    $ip_address = $class_user->getClientIP();
            $user_id = $_SESSION['userSession'];
		    
		    $stmt = $reg_user->runQuery("SELECT * FROM add_leads WHERE lead_id='$get_lead_id' AND user_id='$user_id'");
    		$stmt->execute();
    		if($stmt->rowCount()){
        		    $file_name='';
        		    if($_FILES["document"]["size"]>100){
        		    $target_dir = "uploads/rds/";
                    $target_file = $target_dir . basename($_FILES["document"]["name"]);
                    $uploadOk = 1;
                    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                        if($FileType == 'doc' || $FileType == 'docx' || $FileType == 'xls' || $FileType == 'xlsx' || $FileType == 'pdf'){
                            $file_name = time().rand(1111,9999).".".$FileType;
                            $target_file_new = $target_dir . $file_name;
                            if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file_new)){
                        		$_SESSION['add_lead_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>
                        		<strong>Success!</strong>  Document added successfully.</div>";
                        		
                			    $stmt = $reg_user->runQuery("UPDATE add_leads SET firstName='$first_name',middleName='$middle_name',lastName='$last_name',email='$email',phoneNum='$phone',alterPhoneNum='$alter_num',
                			    address1='$address_line1',address2='$address_line2',city='$city',state='$state',country='$country',zipcode='$zip_code',modifiedBy='$user_id',ip_address='$ip_address' WHERE lead_id='$get_lead_id'");
                                $stmt->execute();
                                
                                $stmt = $reg_user->runQuery("UPDATE rds SET rds_pass='$rdspass',cus_pass_phrase='$customer_pass',upload_doc='$file_name',modified_by='$user_id',ip_address='$ip_address' WHERE lead_id='$get_lead_id'");
                                $stmt->execute();
                                
                                $stmt = $reg_user->runQuery("UPDATE add_sales SET total_amount='$total_amount',tenture='$tenure',modified_by='$user_id',ip_address='$ip_address' WHERE lead_id='$get_lead_id'");
                                $stmt->execute();
                                
                        		$_SESSION['add_lead_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>
                        		<strong>Success!</strong>  Leads Details updated successfully.</div>";
                        		$class_user->redirect('edit_lead?id='.$get_lead_id);
                        		exit();
        
                            } else {
                                $_SESSION['add_lead_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> Sorry, there was an error uploading your file.</div>";
                            }
                            
                        }else {
                            $_SESSION['add_lead_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> Selected file is not a valid document file. The accepted file type is doc,docx,xls,xlsx and pdf.</div>";
                        }
        		    }else{
                			    $stmt = $reg_user->runQuery("UPDATE add_leads SET firstName='$first_name',middleName='$middle_name',lastName='$last_name',email='$email',phoneNum='$phone',alterPhoneNum='$alter_num',
                			    address1='$address_line1',address2='$address_line2',city='$city',state='$state',country='$country',zipcode='$zip_code',modifiedBy='$user_id',ip_address='$ip_address' WHERE lead_id='$get_lead_id'");
                                $stmt->execute();
                                
                                $stmt = $reg_user->runQuery("UPDATE rds SET rds_pass='$rdspass',cus_pass_phrase='$customer_pass',modified_by='$user_id',ip_address='$ip_address' WHERE lead_id='$get_lead_id'");
                                $stmt->execute();
                                
                                $stmt = $reg_user->runQuery("UPDATE add_sales SET total_amount='$total_amount',tenture='$tenure',modified_by='$user_id',ip_address='$ip_address' WHERE lead_id='$get_lead_id'");
                                $stmt->execute();
                                
                        		$_SESSION['add_lead_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>
                        		<strong>Success!</strong>  Leads Details updated successfully.</div>";
                        		$class_user->redirect('edit_lead?id='.$get_lead_id);
                    		exit();
        		    }
    		}else{
    		    $_SESSION['add_lead_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> You cannot edit this Lead. Because it is added by someone else.</div>";
    		}
		}
		}catch(Exception $ex){
			$_SESSION['add_lead_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}

include 'include/header.php';

$stmt_lead = $reg_user->runQuery("SELECT *,al.lead_id as LeadID,al.status as LeadStatus FROM add_leads al LEFT JOIN add_sales sa ON al.lead_id=sa.lead_id 
                                    LEFT JOIN rds rs ON al.lead_id=rs.lead_id WHERE al.lead_id='$get_lead_id'");
$stmt_lead->execute();
$lead_details = $stmt_lead->fetch(PDO::FETCH_ASSOC);
?>
<title>Leads</title>
        <div class="site-content add-leads">
			<div class="content-area py-1">
				<div class="container-fluid">
					<h4>Add Leads</h4>
					<div class="box box-block bg-white">
					    <ul class="nav nav-tabs">
                          <li class="nav-item"><a data-toggle="tab" class="nav-link <?php if(isset($_SESSION['add_lead_error_msg']) || (!isset($_SESSION['add_rds_error_msg']) && !isset($_SESSION['add_sales_error_msg']))){ echo "active";} ?>" href="#London">Personal Info</a></li>
                          <li class="nav-item"><a data-toggle="tab" class="nav-link <?php if(isset($_SESSION['add_rds_error_msg'])){ echo "active";} ?>" href="#Paris">RDS Info</a></li>
                          <li class="nav-item"><a data-toggle="tab" class="nav-link <?php if(isset($_SESSION['add_sales_error_msg'])){ echo "active";} ?>" href="#Tokyo">Add Sales</a></li>
                        </ul>
						    
                        <div class="tab-content clearfix">
                            <form class="form-horizontal" name="new_lead" id="new_lead" method="POST" enctype="multipart/form-data">
                            <?php
                            if(isset($_SESSION['add_lead_error_msg'])) 
                            { ?>
                            <div class="alert-msg">
                            <?php echo $_SESSION['add_lead_error_msg']; ?>
                            </div>
                            <?php
                            }
                            unset($_SESSION['add_lead_error_msg']);
                            ?>
                        <div id="London" class="tab-pane fade in active">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>First Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="First Name" name="fisrt_name" required value="<?php echo $lead_details['firstName']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Last Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Last Name" name="last_name" required value="<?php echo $lead_details['lastName']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Phone Number*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Phone Number" name="phone" pattern="[6-9]{1}[0-9]{9}" required value="<?php echo $lead_details['phoneNum']; ?>" <?php if($logged_in_result->usertype != 'super-admin' && $logged_in_result->usertype != 'admin' && $logged_in_result->usertype != 'manager' && $logged_in_result->usertype != 'l2-level'){ echo "readonly"; } ?> >
										</div>
									</div>	
									<div class="form-group">
									    <label><b>Address line 1</b></label>
										<textarea name="address_line1" placeholder="Address" class="form-control"><?php echo $lead_details['address1']; ?></textarea>
									</div>
		
									<div class="form-group">
									    <label><b>Country*</b></label>
										<select name="country" class="form-control" required>
										    <option value="select">Select Your Country</option>
										    <option <?php if($lead_details['country'] == 'india'){ echo "selected"; } ?> value="india">India</option>
										</select>
									</div>
								    <div class="form-group">
									    <label><b>City*</b></label>
										<select name="city" class="form-control" required>
										    <option value="select">Select Your City</option>
										    <option <?php if($lead_details['city'] == 'bangalore'){ echo "selected"; } ?> value="bangalore">Bangalore</option>
										    <option <?php if($lead_details['city'] == 'varanasi'){ echo "selected"; } ?> value="varanasi">Varanasi</option>
										</select>
									</div>
								</div>
								
								<div class="col-md-6">
								    <div class="form-group">
										<label><b>Middle Name</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Middle Name" name="middle_name" value="<?php echo $lead_details['middleName']; ?>">
										</div>
									</div>	
								    <div class="form-group">
									    <label><b>Email*</b></label>
									<input type="email" class="form-control" placeholder="Email" name="email" required value="<?php echo $lead_details['email']; ?>">
									</div>
									<div class="form-group">
									    <label><b>Alternate Number</b></label>
									<input type="text" class="form-control" placeholder="Alternate Number" pattern="[6-9]{1}[0-9]{9}" name="alter_num" <?php if($logged_in_result->usertype != 'super-admin' && $logged_in_result->usertype != 'admin' && $logged_in_result->usertype != 'manager' && $logged_in_result->usertype != 'l2-level'){ echo "readonly"; } ?> value="<?php echo $lead_details['alterPhoneNum']; ?>">
									</div>
									<div class="form-group">
									    <label><b>Address line 2</b></label>
										<textarea name="address_line2" placeholder="Address" class="form-control"><?php echo $lead_details['address2']; ?></textarea>
									</div>
									<div class="form-group">
									    <label><b>State*</b></label>
										<select name="state" class="form-control" required>
										    <option value="select">Select Your State</option>
										    <option <?php if($lead_details['state'] == 'karnataka'){ echo "selected"; } ?> value="karnataka">Karnataka</option>
										    <option <?php if($lead_details['state'] == 'UP'){ echo "selected"; } ?> value="UP">Uttar Pradesh</option>
										</select>
									</div>
									<div class="form-group">
									    <label><b>Zipcode</b></label>
									<input type="text" class="form-control" placeholder="Zipcode" name="zip_code" value="<?php echo $lead_details['zipcode']; ?>">
									</div>
								</div>
							</div>
                        </div>

                        <div id="Paris" class="tab-pane fade <?php if(isset($_SESSION['add_rds_error_msg'])){ echo "in active";} ?>">
								<div class="row">
									<div class="col-md-6">
									 <div class="form-group">
										<label><b>RDS ID*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="RDS ID" name="rds_id" readonly value="<?php echo $lead_details['rds_id']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Customer Pass Phrase*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Customer pass phrase" name="customer_pass" value="<?php echo $lead_details['cus_pass_phrase']; ?>">
										</div>
									</div>
								</div>
								
								<div class="col-md-6">
								    <div class="form-group">
										<label><b>RDS Pass*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="RDS Pass" name="rdspass" value="<?php echo $lead_details['rds_pass']; ?>">
										</div>
									</div>
									<div class="form-group">
									    <lable><b>Documents Upload*</b></lable>
									    <div class="input-group">
                                          <input type="file" name="document" accept=".pdf,.doc,.docx,.xls,.xlsx" >
                                        </div>  
									</div>
								</div>
							</div> 
                        </div>

                        <div id="Tokyo" class="tab-pane fade <?php if(isset($_SESSION['add_sales_error_msg'])){ echo "in active";} ?>">

								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>Total Amount*</b></label>
										<div class="input-group">
											<input type="number" class="form-control" placeholder="Total Amount" name="total_amount" value="<?php echo $lead_details['total_amount']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Reference Number*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Reference Number" name="reference_number" readonly value="<?php echo $lead_details['reff_number']; ?>">
										</div>
									</div>
								</div>
								
								<div class="col-md-6">
								    <div class="form-group">
										<label><b>Tenure*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Tenure" name="tenure" value="<?php echo $lead_details['tenture']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Ticket Number*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Ticket Number" name="ticket_number" readonly value="<?php echo $lead_details['ticket_number']; ?>">
										</div>
									</div>
								</div>
							</div>
                        </div>
                        <br>
                        <div class="col-md-12 row d-inline-block">
								<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Update Leads" name="add_new_leads">
								</div>
						</div>
                    </div>
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