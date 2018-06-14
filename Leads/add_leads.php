<?php
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
                		
                		$ip_address = $class_user->getClientIP();
    			    $user_id= $_SESSION['userSession'];
    			    $stmt = $reg_user->runQuery("INSERT INTO add_leads(user_id,firstName,middleName,lastName,email,phoneNum,alterPhoneNum,address1,address2,city,state,country,zipcode,status,modifiedBy,ip_address) 
                    VALUES('$user_id','$first_name','$middle_name','$last_name','$email','$phone','$alter_num','$address_line1','$address_line2','$city','$state','$country','$zip_code','Y','$user_id','$ip_address')");
                    $stmt->execute();
                    $new_lead_id = $reg_user->lasdID();
                    
                    $stmt = $reg_user->runQuery("INSERT INTO rds(lead_id,rds_id,user_id,rds_pass,cus_pass_phrase,upload_doc,status,modified_by,ip_address) 
                    VALUES('$new_lead_id','$rds_id','$user_id','$rdspass','$customer_pass','$file_name','Y','$user_id','$ip_address')");
                    $stmt->execute();
                    
                    $stmt = $reg_user->runQuery("INSERT INTO add_sales(lead_id,user_id,total_amount,tenture,reff_number,ticket_number,status,modified_by,ip_address) 
                    VALUES('$new_lead_id','$user_id','$total_amount','$tenure','$reference_number','$ticket_number','Y','$user_id','$ip_address')");
                    $stmt->execute();
                    
            		$_SESSION['add_lead_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>
            		<strong>Success!</strong>  New leads added successfully.</div>";
            		$class_user->redirect('add_leads');
            		exit();

                    } else {
                        $_SESSION['add_lead_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> Sorry, there was an error uploading your file.</div>";
                    }
                    
                }else {
                    $_SESSION['add_lead_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> Selected file is not a valid document file. The accepted file type is doc,docx,xls,xlsx and pdf.</div>";
                }
		    }else{
    			    $ip_address = $class_user->getClientIP();
    			    $user_id= $_SESSION['userSession'];
    			    $stmt = $reg_user->runQuery("INSERT INTO add_leads(user_id,firstName,middleName,lastName,email,phoneNum,alterPhoneNum,address1,address2,city,state,country,zipcode,status,modifiedBy,ip_address) 
                    VALUES('$user_id','$first_name','$middle_name','$last_name','$email','$phone','$alter_num','$address_line1','$address_line2','$city','$state','$country','$zip_code','Y','$user_id','$ip_address')");
                    $stmt->execute();
                    $new_lead_id = $reg_user->lasdID();
                    
                    $stmt = $reg_user->runQuery("INSERT INTO rds(lead_id,rds_id,user_id,rds_pass,cus_pass_phrase,upload_doc,status,modified_by,ip_address) 
                    VALUES('$new_lead_id','$rds_id','$user_id','$rdspass','$customer_pass','$file_name','Y','$user_id','$ip_address')");
                    $stmt->execute();
                    
                    $stmt = $reg_user->runQuery("INSERT INTO add_sales(lead_id,user_id,total_amount,tenture,reff_number,ticket_number,status,modified_by,ip_address) 
                    VALUES('$new_lead_id','$user_id','$total_amount','$tenure','$reference_number','$ticket_number','Y','$user_id','$ip_address')");
                    $stmt->execute();
                    
            		$_SESSION['add_lead_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>
            		<strong>Success!</strong>  New leads added successfully.</div>";
            		$class_user->redirect('add_leads');
            		exit();
		    }
		}
		}catch(Exception $ex){
			$_SESSION['add_lead_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}

if(isset($_POST['add_rds_lead'])){
    try{
		$customer_pass = htmlentities(trim($_POST['customer_pass']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$rdspass = htmlentities(trim($_POST['rdspass']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$rds_id = htmlentities(trim($_POST['rds_id']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		
		
		if(empty($customer_pass) || empty($rds_id) || empty($rdspass) || $_FILES["document"]["size"]<100){
		    $_SESSION['add_rds_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the required Fileds!</div>";
		}else{
		    
		    $target_dir = "uploads/rds/";
            $target_file = $target_dir . basename($_FILES["document"]["name"]);
            $uploadOk = 1;
            $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                if($FileType == 'doc' || $FileType == 'docx' || $FileType == 'xls' || $FileType == 'xlsx' || $FileType == 'pdf'){
                    $file_name = time().rand(1111,9999).".".$FileType;
                    $target_file_new = $target_dir . $file_name;
                    if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file_new)){
                        $ip_address = $class_user->getClientIP();
        			    $user_id= $_SESSION['userSession'];
        			    $rds_id_old = time().rand(1111,9999);
        			    $stmt = $reg_user->runQuery("INSERT INTO rds(rds_id,user_id,rds_pass,cus_pass_phrase,upload_doc,status,modified_by,ip_address) 
                        VALUES('$rds_id','$user_id','$rdspass','$customer_pass','$file_name','Y','$user_id','$ip_address')");
                        $stmt->execute();
                        $new_lead_id = $reg_user->lasdID();
                        
                		$_SESSION['add_rds_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>
                		<strong>Success!</strong>  New RDS Info added successfully.</div>";
                		$class_user->redirect('add_leads');
                		exit();
                    } else {
                        $_SESSION['add_rds_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> Sorry, there was an error uploading your file.</div>";
                    }
                    
                }else {
                    $_SESSION['add_rds_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> Selected file is not a valid document file. The accepted file type is doc,docx,xls,xlsx and pdf.</div>";
                }
		    
    			    
		}
		}catch(Exception $ex){
			$_SESSION['add_rds_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}

if(isset($_POST['add_sales_lead'])){
    try{
		$total_amount = htmlentities(trim($_POST['total_amount']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$tenure = htmlentities(trim($_POST['tenure']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$reference_number = htmlentities(trim($_POST['reference_number']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		$ticket_number = htmlentities(trim($_POST['ticket_number']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		
		if(empty($total_amount) || empty($tenure) || empty($reference_number) || empty($ticket_number)){
		    $_SESSION['add_sales_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please Fill all the required Fileds!</div>";
		}else{
                $ip_address = $class_user->getClientIP();
			    $user_id = $_SESSION['userSession'];
			    $reff_number = time().rand(1111,9999);
			    $stmt = $reg_user->runQuery("INSERT INTO add_sales(user_id,total_amount,tenture,reff_number,ticket_number,status,modified_by,ip_address) 
                VALUES('$user_id','$total_amount','$tenure','$reference_number','$ticket_number','Y','$user_id','$ip_address')");
                $stmt->execute();
                $new_lead_id = $reg_user->lasdID();
                
        		$_SESSION['add_sales_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>
        		<strong>Success!</strong> New Sales Details added successfully.</div>";
        		$class_user->redirect('add_leads');
        		exit();
		}
		}catch(Exception $ex){
			$_SESSION['add_sales_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>".$ex->getMessage()."</div>";
		}
}

include 'include/header.php';
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
											<input type="text" class="form-control" placeholder="First Name" name="fisrt_name" required value="<?php if(isset($_POST['fisrt_name'])){ echo $_POST['fisrt_name']; } ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Last Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Last Name" name="last_name" required value="<?php if(isset($_POST['last_name'])){ echo $_POST['last_name']; } ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Phone Number*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Phone Number" name="phone" pattern="[6-9]{1}[0-9]{9}" required value="<?php if(isset($_POST['phone'])){ echo $_POST['phone']; } ?>">
										</div>
									</div>	
									<div class="form-group">
									    <label><b>Address line 1</b></label>
										<textarea name="address_line1" placeholder="Address" class="form-control"><?php if(isset($_POST['address_line1'])){ echo $_POST['address_line1']; } ?></textarea>
									</div>
		
									<div class="form-group">
									    <label><b>Country*</b></label>
										<select name="country" class="form-control country" required>
										    <option selected="selected">Select Your Country</option>
										    <!--<option <?php if(isset($_POST['country']) && $_POST['country'] == 'india'){ echo "selected"; } ?> value="india">India</option>-->
										    <?php
	                                            $country = $reg_user->runQuery("SELECT * FROM country");
	                                            $country->execute();
                                            	while($row=$country->fetch(PDO::FETCH_ASSOC))
	                                            {
	                                    	?>
                                                <option value="<?php echo $row['country_id']; ?>"><?php echo $row['country_name']; ?></option>
                                            <?php
                                            	} 
                                            ?>
										</select>
									</div>
								    <div class="form-group">
									    <label><b>City*</b></label>
										<select name="city" class="form-control city" required>
										    <option selected="selected">Select Your City</option>
										    <!--<option <?php if(isset($_POST['city']) && $_POST['city'] == 'bangalore'){ echo "selected"; } ?> value="bangalore">Bangalore</option>
										    <option <?php if(isset($_POST['city']) && $_POST['city'] == 'varanasi'){ echo "selected"; } ?> value="varanasi">Varanasi</option>-->
										</select>
									</div>
								</div>
								
								<div class="col-md-6">
								    <div class="form-group">
										<label><b>Middle Name</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Middle Name" name="middle_name" value="<?php if(isset($_POST['middle_name'])){ echo $_POST['middle_name']; } ?>">
										</div>
									</div>	
								    <div class="form-group">
									    <label><b>Email*</b></label>
									<input type="email" class="form-control" placeholder="Email" name="email" required value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>">
									</div>
									<div class="form-group">
									    <label><b>Alternate Number</b></label>
									<input type="text" class="form-control" placeholder="Alternate Number" pattern="[6-9]{1}[0-9]{9}" name="alter_num" value="<?php if(isset($_POST['alter_num'])){ echo $_POST['alter_num']; } ?>">
									</div>
									<div class="form-group">
									    <label><b>Address line 2</b></label>
										<textarea name="address_line2" placeholder="Address" class="form-control"><?php if(isset($_POST['address_line2'])){ echo $_POST['address_line2']; } ?></textarea>
									</div>
									<div class="form-group">
									    <label><b>State*</b></label>
										<select name="state" class="form-control state" required>
										    <option selected="selected">Select Your State</option>
										    <!--<option <?php if(isset($_POST['state']) && $_POST['state'] == 'karnataka'){ echo "selected"; } ?> value="karnataka">Karnataka</option>
										    <option <?php if(isset($_POST['state']) && $_POST['state'] == 'UP'){ echo "selected"; } ?> value="UP">Uttar Pradesh</option>-->
										</select>
									</div>
									<div class="form-group">
									    <label><b>Zipcode</b></label>
									<input type="text" class="form-control" placeholder="Zipcode" name="zip_code" value="<?php if(isset($_POST['zip_code'])){ echo $_POST['zip_code']; } ?>">
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
											<input type="text" class="form-control" placeholder="RDS ID" name="rds_id" readonly value="<?php if(isset($_POST['rds_id'])){ echo $_POST['rds_id']; }else{ echo 'RDS_'.rand(1111,9999).time(); } ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Customer Pass Phrase*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Customer pass phrase" name="customer_pass" value="<?php if(isset($_POST['customer_pass'])){ echo $_POST['customer_pass']; } ?>">
										</div>
									</div>
								</div>
								
								<div class="col-md-6">
								    <div class="form-group">
										<label><b>RDS Pass*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="RDS Pass" name="rdspass" value="<?php if(isset($_POST['rdspass'])){ echo $_POST['rdspass']; } ?>">
										</div>
									</div>
									<div class="form-group">
									    <lable><b>Documents Upload*</b></lable>
									    <div class="input-group">
                                          <input type="file" name="document" accept=".pdf,.doc,.docx,.xls,.xlsx" value="<?php if(isset($_POST['document'])){ echo $_POST['document']; } ?>">
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
											<input type="number" class="form-control" placeholder="Total Amount" name="total_amount" value="<?php if(isset($_POST['total_amount'])){ echo $_POST['total_amount']; } ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Reference Number*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Reference Number" name="reference_number" readonly value="<?php if(isset($_POST['reference_number'])){ echo $_POST['reference_number']; }else{ echo 'Ref_'.time().rand(1111,9999); } ?>">
										</div>
									</div>
								</div>
								
								<div class="col-md-6">
								    <div class="form-group">
										<label><b>Tenure*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Tenure" name="tenure" value="<?php if(isset($_POST['tenure'])){ echo $_POST['tenure']; } ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Ticket Number*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Ticket Number" name="ticket_number" readonly value="<?php if(isset($_POST['ticket_number'])){ echo $_POST['ticket_number']; }else{ echo 'Tic_'.rand(1111,9999).time(); } ?>">
										</div>
									</div>
								</div>
							</div>
                        </div>
                        <br>
                        <div class="col-md-12 row d-inline-block">
								<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Submit Leads" name="add_new_leads">
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
		<script type="text/javascript">
$(document).ready(function()
{
	$("#loding1").hide();
	$("#loding2").hide();
	$(".country").change(function()
	{
		$("#loding1").show();
		var id=$(this).val();
		var dataString = 'id='+ id;
		$(".state").find('option').remove();
		$(".city").find('option').remove();
		$.ajax
		({
			type: "POST",
			url: "Leads/get_state.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#loding1").hide();
				$(".state").html(html);
			} 
		});
	});
	
	
	$(".state").change(function()
	{
		$("#loding2").show();
		var id=$(this).val();
		var dataString = 'id='+ id;
	
		$.ajax
		({
			type: "POST",
			url: "Leads/get_city.php",
			data: dataString,
			cache: false,
			success: function(html)
			{
				$("#loding2").hide();
				$(".city").html(html);
			} 
		});
	});
	
});
</script>

	</body>
</html>