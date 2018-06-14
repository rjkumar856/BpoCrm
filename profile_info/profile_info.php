<?php
include 'include/header.php';

if (isset($_POST['Update'])) {

$target_dir = "include/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";

        $pro_img = "uploads/".$_FILES["fileToUpload"]["name"];

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    $phn = $_POST['phn'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $dob = $_POST['dob'];
    $anniversary = $_POST['anniversary'];
    
if(!empty($pro_img)){
	echo $sql = "UPDATE `user` SET `profile_img`='$pro_img',`mobile`='$phn',`dob`='$dob',`anniversary`='$anniversary',`address1`='$address1',`address2`='address2' WHERE id = '".$_SESSION['userSession']."'";
	 $stmt = $reg_user->runQuery("UPDATE `user` SET `profile_img`='$pro_img',`mobile`='$phn',`dob`='$dob',`anniversary`='$anniversary',`address1`='$address1',`address2`='$address2' WHERE id = '".$_SESSION['userSession']."'");
                             if($stmt->execute()){

                             	echo "yoo";
                             }
                             else
                             {
                             	echo "noo";
                             }
                         }

                         else
                         {

                         	echo $sql = "UPDATE `user` SET `mobile`='$phn',`dob`='$dob',`anniversary`='$anniversary',`address1`='$address1',`address2`='$address2' WHERE id = '".$_SESSION['userSession']."'";
                         	 $stmt = $reg_user->runQuery("UPDATE `user` SET `mobile`='$phn',`dob`='$dob',`anniversary`='$anniversary',`address1`='$address1',`address2`='$address2' WHERE id = '".$_SESSION['userSession']."'");
                             if($stmt->execute()){

                             	echo "yoo";
                             }
                             else
                             {
                             	echo "noo";
                             }
                         }
}

?>
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-top: none;
}
</style>
<title>Leads</title>
        <div class="site-content">
			<div class="content-area py-1">
				<div class="container-fluid">
					<h4>Add Leads</h4>
					<div class="box box-block bg-white">
						    
						<div class="tab">
                        <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Personal Info</button>
                   
                        </div>

                        <div id="London" class="tabcontent" style="">
                        			<div class="row" >
                        			<div class="col-md-12" style=" text-align: justify-all;" align="center">

                        				<h1>Edit Your Profile</h1>

								<?php
                                $stmt = $reg_user->runQuery("SELECT * FROM user WHERE id = '".$_SESSION['userSession']."' ");
                                $stmt->execute();
                                for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
                                { ?>


                                		  <form class="form-horizontal" method="post" enctype="multipart/form-data">

                                		  	<img src="<?php echo DIR_SYSTEM; ?>include/<?php echo $stmt1->profile_img; ?>" style="height: 200px; width: 200px; border-radius: 50%"><br><br><br>
                                		  	  <input class="form-group" type="file" name="fileToUpload" id="fileToUpload">
										   	
										   	 <br><br><br><br><br>
</div>
										   	 <div class="col-md-6" >
										   	 <div class="form-group">
											 <label><b>First Name</b></label>
											 <div class="input-group">
											 <input type="text" class="form-control" value="<?php echo $stmt1->first_name; ?>" placeholder="First Name" name="fname" disabled>
										     </div>
									         </div></div>
 											<div class="col-md-6" >
									         	 <div class="form-group">
											 <label><b>Last Name</b></label>
											 <div class="input-group">
											 <input type="text" class="form-control" value="<?php echo $stmt1->last_name; ?>" placeholder="Last Name" name="lname"  disabled>
										     </div>
									         </div>
									     </div>
									         <div class="col-md-6" >
									         	 <div class="form-group">
											 <label><b>Email Id</b></label>
											 <div class="input-group">
											 <input type="text" class="form-control" value="<?php echo $stmt1->cusEmail; ?>" disabled placeholder="Email Id" name="email"  required>
										     </div>
									         </div>
									     </div>

									     <div class="col-md-6" >
									         	 <div class="form-group">
											 <label><b>Mobile No.</b></label>
											 <div class="input-group">
											 <input type="text" class="form-control" placeholder="Mobile No." name="phn" value="<?php echo $stmt1->mobile; ?>">
										     </div>
									         </div>
									     </div>
									         <div class="col-md-6" >
									         	 <div class="form-group">
											 <label><b>D.O.B</b></label>
											 <div class="input-group">
											 <input type="date" class="form-control" placeholder="D.O.B" name="dob" id="date" value="<?php echo $stmt1->dob; ?>" required>
										     </div>
									         </div>
									     </div>

									      <div class="col-md-6" >
									         	 <div class="form-group">
											 <label><b>Anniversary</b></label>
											 <div class="input-group">
											 <input type="date" class="form-control" id="date" placeholder="anniversary" name="anniversary" value="<?php echo $stmt1->anniversary; ?>" required>
										     </div>
									         </div>
									     </div>

									     <div class="col-md-6" >
									         	 <div class="form-group">
											 <label><b>Address 1</b></label>
											 <div class="input-group">
											 <input type="text" class="form-control" placeholder="Address 1" name="address1" value="<?php echo $stmt1->address1; ?>" required>
										     </div>
									         </div>
									     </div>
									         <div class="col-md-6" >
									         	 <div class="form-group">
											 <label><b>Address 2</b></label>
											 <div class="input-group">
											 <input type="text" class="form-control" placeholder="Address 2" name="address2" value="<?php echo $stmt1->address2; ?>" required>
										     </div>
									         </div>
									     </div>
									     <br><br><br>
									     <?php
									     } ?>
									<div class="center" align="center">
									<input type="submit" class="btn btn-danger" value="Update" name="Update" style="width: 90px;">
								
									</div>
</form>
							
						
							</div></div>
							</div>
                        </div>

                        <div id="Paris" class="tabcontent">
                        <form class="form-horizontal" method="post" action="Leads/add_lead_rds_submit.php" name="rds_lead" id="rds_lead" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>RDS Id*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="RDS Id" name="rdsid" required>
										</div>
									</div>
									<div class="form-group">
										<label><b>Customer Pass Phrase*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Customer pass phrase" name="customer_pass" required>
										</div>
									</div>
								</div>
								
								<div class="col-md-6">
								    <div class="form-group">
										<label><b>RDS Pass*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="RDS Pass" name="rdspass" required>
										</div>
									</div>	
								    <div class="form-group">
									    <lable><b>Documents Upload*</b></lable>
									    <div class="input-group">
                                          <input type="file" name="doc" accept="file_extension/*">
                                        </div>  
									</div>
								</div>
								
								<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Submit" name="doc_submit">
									</div>
									</div>
						
							</form>
							</div> 
                        </div>

                        <div id="Tokyo" class="tabcontent">
                        <form class="form-horizontal" method="post" name="edit_ad" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>Total Amount*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Total Amount" name="total_amount" required>
										</div>
									</div>
									<div class="form-group">
										<label><b>Reference Number*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Reference Number" name="reference_number" required>
										</div>
									</div>
								</div>
								
								<div class="col-md-6">
								    <div class="form-group">
										<label><b>Tenure*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Tenure" name="tenure" required>
										</div>
									</div>	
								    <div class="form-group">
									    <label><b>Ticket Number*</b></label>
									<input type="text" class="form-control" placeholder="Ticket Number" name="ticket_number" required>
									</div>
								</div>
								
								<div class="col-md-12" align="center">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Finish Sales" name="finish_sales">
									</div>
									</div>
						
							</form>
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
		<script type="text/javascript" src="js/forms-pickers.js"></script>
		<script>
            function openCity(evt, cityName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }
            
            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>
