<?php
if(isset($_GET['id'])){
$get_lead_id = $_GET['id'];
}else{
    $class_user->redirect('view_leads');
}

if(isset($_POST['add_new_leads'])){
    try{
		$userid = htmlentities(trim($_POST['userid']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
		
		if(empty($userid)){
		    $_SESSION['add_lead_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button>Please select a User!</div>";
		}else{
		    
		    $ip_address = $class_user->getClientIP();
            echo $user_id = $_SESSION['userSession'];
		    
		    $stmt = $reg_user->runQuery("SELECT * FROM lead_allocation WHERE lead_id='$get_lead_id'");
    		$stmt->execute();
    		if($stmt->rowCount() == 0){
        		  				


                			    $stmt = $reg_user->runQuery("INSERT INTO lead_allocation(lead_id,user_id,status,allocated_by,ip_address) VALUES('$get_lead_id','$userid','open','$user_id','$ip_address')");
                                $stmt->execute();
                                
                        		$_SESSION['add_lead_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>
                        		<strong>Success!</strong> Leads assigned successfully.</div>";
                        		$class_user->redirect('allocate_lead?id='.$get_lead_id);
                    		    exit();
    		}else{
    		    $_SESSION['add_lead_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> This lead already llocated to someone else.</div>";
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
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>js/autocomplete/easy-autocomplete.min.css">
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>js/autocomplete/easy-autocomplete.themes.min.css">
        <div class="site-content add-leads">
			<div class="content-area py-1">
				<div class="container-fluid">
					<h4>Assign Lead</h4>
					<div class="box box-block bg-white">
						    
                        <div class=" clearfix">
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
                        
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>First Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="First Name" name="fisrt_name" readonly value="<?php echo $lead_details['firstName']; ?>">
										</div>
									</div>
									
									<div class="form-group">
										<label><b>Phone Number*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Phone Number" name="phone" readonly pattern="[6-9]{1}[0-9]{9}" value="<?php echo $lead_details['phoneNum']; ?>">
										</div>
									</div>
								    <div class="form-group">
										<label><b>RDS ID*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="RDS ID" name="rds_id" readonly value="<?php echo $lead_details['rds_id']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Reference Number*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Reference Number" name="reference_number" readonly value="<?php echo $lead_details['reff_number']; ?>">
										</div>
									</div>
									<div class="form-group">
										<label><b>Allocate to*</b></label>
										<div class="input-group">
											<input type="text" id="smartcard_autocomplete" class="form-control" placeholder="Userid" name="userid_temp" value="<?php if(isset($_POST['userid_temp'])){ echo $_POST['userid_temp']; } ?>" >
											<input type="hidden" id="allocated_userid" name="userid" value="<?php if(isset($_POST['userid'])){ echo $_POST['userid']; } ?>" >
										</div>
									</div>
								</div>
								
								<div class="col-md-6">
								    <div class="form-group">
										<label><b>Last Name*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Last Name" name="last_name"  readonly value="<?php echo $lead_details['lastName']; ?>">
										</div>
									</div>
		
								    <div class="form-group">
									    <label><b>Email*</b></label>
									<input type="email" class="form-control" placeholder="Email" name="email" readonly value="<?php echo $lead_details['email']; ?>">
									</div>
									<div class="form-group">
										<label><b>Total Amount*</b></label>
										<div class="input-group">
											<input type="number" class="form-control" placeholder="Total Amount" readonly name="total_amount" value="<?php echo $lead_details['total_amount']; ?>">
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
                        <br>
                        <div class="col-md-12 row d-inline-block">
								<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Assign Lead" name="add_new_leads">
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
		<script type="text/javascript" src="<?php echo DIR_SYSTEM; ?>js/autocomplete/jquery.easy-autocomplete.min.js"></script>
        <script type="text/javascript">
        var options = {
          url: function(phrase) {
            return "<?php echo DIR_SYSTEM; ?>Leads/search_user_id.php";
          },
          getValue: function(element) {
            return element.name;
          },
          ajaxSettings: {
            dataType: "json",
            method: "POST",
            data: {
              dataType: "json"
            }
          },
          preparePostData: function(data) {
            data.phrase = $("#smartcard_autocomplete").val();
            return data;
          },
          requestDelay: 400,
          list: {
                            onSelectItemEvent: function() {
                            var value = $("#smartcard_autocomplete").getSelectedItemData().id; //get the id associated with the selected value
                           $("#allocated_userid").val(value).trigger("change"); //copy it to the hidden field
                          },
                                maxNumberOfElements: 20,
                                sort: {
                                    enabled: true
                                }
                            },
        template: {
        type: "description",
        fields: {
            description: "email"
        }
    }
        };
        $("#smartcard_autocomplete").easyAutocomplete(options);
        </script>
	</body>
</html>