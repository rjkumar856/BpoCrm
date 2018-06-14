<?php

include 'include/header.php';

if (isset($_POST['Update'])) {

 
  $stmt = $reg_user->runQuery("SELECT * FROM user WHERE id = '".$_SESSION['userSession']."' ");
  $stmt->execute();

                                $stmt = $reg_user->runQuery("SELECT * FROM user WHERE id = '".$_SESSION['userSession']."' ");
                                $stmt->execute();
                                for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
                                { 

  					echo $cpassword =  $stmt1->cusPassword;
					echo $opassword = md5(trim($_POST['opassword']));
					$password = md5(trim($_POST['password']));
					
					if($opassword == $cpassword)
					{

						 $stmt = $reg_user->runQuery("UPDATE `user` SET `cusPassword`='$password' WHERE id = '".$_SESSION['userSession']."'");
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

                         	 
                         	 echo "NOOO ";
                         }
}
}

if (isset($_POST['Change'])) {

	$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["Change"])) {
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

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000000000000) {
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

       echo $pro_img = "uploads/".$_FILES["fileToUpload"]["name"];


 


    } else {
        echo "Sorry, there was an error uploading your file.";
    }

  
}


	$target_dir1 = "uploads/";
$target_file1 = $target_dir1 . basename($_FILES["fileToUpload1"]["name"]);
$uploadOk1 = 1;
$imageFileType1 = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["Change"])) {
    $check1 = getimagesize($_FILES["fileToUpload1"]["tmp_name"]);
    if($check1 !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk1 = 1;
    } else {
        echo "File is not an image.";
        $uploadOk1 = 0;
    }
}

// Check file size
if ($_FILES["fileToUpload1"]["size"] > 500000000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk1 = 0;
}
// Allow certain file formats
if($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
&& $imageFileType1 != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk1 = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk1 == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload1"]["tmp_name"], $target_file1)) {
        echo "The file ". basename( $_FILES["fileToUpload1"]["name"]). " has been uploaded.";

     echo $pro_img1 = "uploads/".$_FILES["fileToUpload1"]["name"];


 


    } else {
        echo "Sorry, there was an error uploading your file.";
    }

  
}


	echo $sql = "UPDATE `login` SET `logo`='$pro_img',`bg`='$pro_img1' WHERE id = '1'";
	 $stmt = $reg_user->runQuery("UPDATE `login` SET `logo`='$pro_img',`bg`='$pro_img1' WHERE id = '1'");
                             if($stmt->execute()){

                             	echo "yoo";
                             }
                             else
                             {
                             	echo "noo";
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
                        <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">Change Password</button>
                    <?php
                    if($logged_in_result->usertype == 'super-admin' || $logged_in_result->usertype == 'admin' || $logged_in_result->usertype == 'manager' || $logged_in_result->usertype == 'l2-level'){ ?>
                         <button class="tablinks" onclick="openCity(event, 'Paris')" id="defaultOpen">Change LOGO And Background</button>
                    <?php
                    } ?>
                        </div>

                        <div id="London" class="tabcontent" style="">
                        			<div class="row" >
                        			<div class="col-md-12" style=" text-align: justify-all;" align="center">
                        				<h1>Change Password</h1></div>
								<?php
                                $stmt = $reg_user->runQuery("SELECT * FROM user WHERE id = '".$_SESSION['userSession']."' ");
                                $stmt->execute();
                                for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
                                { ?>


                                		  <form class="form-horizontal" method="post" enctype="multipart/form-data">

                                		  	
										   	 <div class="col-md-6" >
										   	 <div class="form-group">
											 <label><b>Old Password </b></label>
											 <div class="input-group">
											 <input type="password" class="form-control"  placeholder="Old Password" name="opassword" >
										     </div>
									         </div></div>
 											<div class="col-md-6" >
									         	 <div class="form-group">
											 <label><b>Password</b></label>
											 <div class="input-group">
											 <input type="password" class="form-control"  placeholder="Password" name="password"  >
										     </div>
									         </div>
									     </div>
									         									    					      
									         	
                                		  
<br><br><br>	<?php
								}
							?>
									<div class="center" align="center">
									<input type="submit" class="btn btn-danger" value="Update" name="Update" style="width: 90px;">
									</div>
</form>
</div></div>
						
                  
            <?php
			if($logged_in_result->usertype == 'super-admin' || $logged_in_result->usertype == 'admin' || $logged_in_result->usertype == 'manager' || $logged_in_result->usertype == 'l2-level'){ ?>
                        <div id="Paris" class="tabcontent">
                     <div class="row" >
                        			<div class="col-md-12" style=" text-align: justify-all;" align="center">

                        				<h1>Change Backgrounds And Logo</h1>
</div><div class="col-md-12" style=" text-align: justify-all;" >
								<?php
                                $stmt = $reg_user->runQuery("SELECT * FROM login WHERE id = '1' ");
                                $stmt->execute();
                                for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
                                { ?>


                                		  <form class="form-horizontal" method="post" enctype="multipart/form-data">
                                		  	<label><b>Logo</b></label><br>
                                		  	<img src="<?php echo DIR_SYSTEM; ?><?php echo $stmt1->logo; ?>" style="width: 200px;"><br><br>
                                		  	  <input class="form-group" type="file" name="fileToUpload" id="fileToUpload">
										   	
										   	 <br><br>
										   	 <label><b>Background</b></label><br>
										   	 <img src="<?php echo DIR_SYSTEM; ?><?php echo $stmt1->bg; ?>" style="width: 250px;"><br><br>
                                		  	  <input class="form-group" type="file" name="fileToUpload1" id="fileToUpload1">
										  </div>
									     </div>
									     <br>
									     <?php
									     }
									     ?>
<script>
window.onload = function () {

var limit = 10000;    //increase number of dataPoints by increasing the limit
var y = 100;    
var data = [];
var dataSeries = { type: "line" };
var dataPoints = [];
for (var i = 0; i < limit; i += 1) {
	y += Math.round(Math.random() * 10 - 5);
	dataPoints.push({
		x: i,
		y: y
	});
}
dataSeries.dataPoints = dataPoints;
data.push(dataSeries);

//Better to construct options first and then pass it as a parameter
var options = {
	zoomEnabled: true,
	animationEnabled: true,
	title: {
		text: "Try Zooming - Panning"
	},
	axisY: {
		includeZero: false
	},
	data: data  // random data
};

$("#chartContainer").CanvasJSChart(options);

}
</script>
<div class="center" align="center">
<input type="submit" class="btn btn-danger" value="Update" name="Change" style="width: 90px;">
</div>
</form>
</div>
							<?php } ?>
							
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
