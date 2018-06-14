<?php
$logged_in_stmt = $reg_user->runQuery("SELECT * FROM user WHERE id = '".$_SESSION['userSession']."' ");
$logged_in_stmt->execute();
$logged_in_result = $logged_in_stmt->fetchObject();



/*if (isset($_POST['submit'])) {

	echo $image = $_POST['image'];

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
if ($_FILES["fileToUpload"]["size"] > 500000) {
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


 $stmt = $reg_user->runQuery("UPDATE `user` SET `profile_img`='$pro_img' WHERE id = '".$_SESSION['userSession']."'");
                             if($stmt->execute()){

                             	echo "yoo";
                             }
                             else
                             {
                             	echo "noo";
                             }


    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

	
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta name="keywords" content="" />
<meta name="author" content="">
<meta name="robots" content="noindex, nofollow" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://use.fontawesome.com/ef3000c315.js"></script>
<style>.raisetick {position: fixed;right: 100px;top: 0px;z-index: 9999;width: 120px;}.raisetick img {width: 120px;}div#infor { position: fixed;right: 0;background: #fff;top: 60px;}</style>
<?php include 'style.php'; ?>
</head>
<body class="fixed-sidebar fixed-header skin-default content-appear" onload="notifyMe();">
		<div class="wrapper"> 
			<!-- Preloader -->
			<div class="preloader"></div>
			<!-- Sidebar -->
			<div class="site-overlay"></div>
			<div class="site-sidebar">
				<div class="custom-scroll custom-scroll-light">
					<ul class="sidebar-menu">
						<li class="menu-title">Home</li>
						<li class="with-sub">
							<a class="waves-effect waves-light" href="<?php echo DIR_SYSTEM; ?>index">
								<span class="s-icon"><i class="fa fa-home" aria-hidden="true"></i></span>
								<span class="s-text">Dashboard</span>
							</a>
						</li>
						<li class="with-sub">
							<a class="waves-effect  waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-world"></i></span>
								<span class="s-text">Sales Target</span>
							</a>
							<ul>
							    <li><a href="<?php echo DIR_SYSTEM; ?>list_of_agents">List Of Agents</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a class="waves-effect waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-folder"></i></span>
								<span class="s-text">Leads</span>
							</a>
							<ul>
							    <li><a href="<?php echo DIR_SYSTEM; ?>add_leads">Add Leads</a></li>
							    <li><a href="<?php echo DIR_SYSTEM; ?>view_leads">View Leads</a></li>
							</ul>
						</li>
					
						<li class="with-sub">
							<a class="waves-effect waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="ti-email"></i></span>
								<span class="s-text">Emails</span>
							</a>
							<ul>
							    <li><a href="<?php echo DIR_SYSTEM; ?>emails_mod">Send Emails</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a class="waves-effect  waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>
								<span class="s-text">Calendar</span>
							</a>
							<ul>
							    <li><a href="<?php echo DIR_SYSTEM; ?>to_do_lists">To do List</a></li>
							</ul>
						</li>
						<li class="with-sub">
							<a class="waves-effect  waves-light" href="<?php echo DIR_SYSTEM; ?>import_data">
								<span class="s-icon"><i class="fa fa-upload" aria-hidden="true"></i></span>
								<span class="s-text">Import Center</span>
							</a>
						</li>
					
						<li class="with-sub">
							<a class="waves-effect  waves-light">
							    <span class="s-caret"><i class="fa fa-angle-down"></i></span>
								<span class="s-icon"><i class="fa fa-bullhorn" aria-hidden="true"></i></span>
								<span class="s-text">Announcements</span>
							</a>
							<ul>
					<?php
				    if($logged_in_result->usertype == 'super-admin' || $logged_in_result->usertype == 'admin' || $logged_in_result->usertype == 'manager' || $logged_in_result->usertype == 'l2-level'){ ?>
							    <li><a href="<?php echo DIR_SYSTEM; ?>new_announcements">New Announcements</a></li>
					<?php } ?>
							    <li><a href="<?php echo DIR_SYSTEM; ?>list_of_announcements">List of Announcements</a></li>
							</ul>
						</li>
					<?php
				    if($logged_in_result->usertype == 'super-admin' || $logged_in_result->usertype == 'admin' || $logged_in_result->usertype == 'manager' || $logged_in_result->usertype == 'l2-level'){ ?>
						<li class="with-sub">
							<a class="waves-effect  waves-light" href="<?php echo DIR_SYSTEM; ?>birthdays_and_anniversary">
								<span class="s-icon"><i class="fa fa-birthday-cake" aria-hidden="true"></i></span>
								<span class="s-text">Birthdays And<br />Anniversary</span>
							</a>
						</li>
					<?php } ?>
					<?php
				    if($logged_in_result->usertype == 'super-admin' || $logged_in_result->usertype == 'admin' || $logged_in_result->usertype == 'manager' || $logged_in_result->usertype == 'l2-level'){ ?>
							<li class="with-sub">
							<a class="waves-effect  waves-light" href="<?php echo DIR_SYSTEM; ?>UsersList">
								<span class="s-icon"><i class="fa fa-user" aria-hidden="true"></i></span>
								<span class="s-text">User List</span>
							</a>
						</li>
					<?php } ?>
						<li class="with-sub">
						<a class="waves-effect  waves-light" href="<?php echo DIR_SYSTEM; ?>logout">
							<span class="s-icon"><i class="ti-lock"></i></span>
							<span class="s-text">Logout</span>
						</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="site-header">
				<nav class="navbar navbar-light">
					<div class="navbar-left">
						<a class="navbar-brand" href="/">
							   <?php
                                $stmt = $reg_user->runQuery("SELECT * FROM login WHERE id = '1' ");
                                $stmt->execute();
                                for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
                                { ?>
							<div class="logo"><img src="<?php echo DIR_SYSTEM; ?><?php echo $stmt1->logo; ?>" style="width:188px; height:55px;"/></div>

							<?php
						}
							?>
						</a>
						<div class="toggle-button dark sidebar-toggle-first float-xs-left hidden-md-up">
							<span class="hamburger"></span>
						</div>
						<div class="toggle-button-second dark float-xs-right hidden-md-up">
							<i class="ti-arrow-left"></i>
						</div>
						<div class="toggle-button dark float-xs-right hidden-md-up" data-toggle="collapse" data-target="#collapse-1">
							<span class="more"></span>
						</div>
					</div>
					<div class="navbar-right navbar-toggleable-sm collapse" id="collapse-1">
						<div class="toggle-button light sidebar-toggle-second float-xs-left hidden-sm-down">
							<span class="hamburger"></span>
						</div>
						<div class="toggle-button-second light float-xs-right hidden-sm-down">
							<i class="ti-arrow-left"></i>
						</div>
						<ul class="nav navbar-nav float-md-right">
							
							<li class="nav-item dropdown hidden-sm-down">
								<?php
                                $stmt = $reg_user->runQuery("SELECT * FROM user WHERE id = '".$_SESSION['userSession']."' ");
                                $stmt->execute();
                                for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
                                { ?>
								<a href="#" data-toggle="dropdown" aria-expanded="false">
									<span class="avatar box-32 name">
									<img src="<?php echo DIR_SYSTEM; ?>include/<?php echo $stmt1->profile_img; ?>" style="height:  100%">
									
									</span>
								</a><?php } ?>
								<div class="dropdown-menu dropdown-menu-right animated fadeInUp">
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="Profile_Info"><i class="fa fa-edit"></i> Edit Profile</a>
									<a class="dropdown-item" href="Setting"><i class="fa fa-edit"></i> Setting</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="logout"><i class="ti-power-off mr-0-5"></i> Sign out</a>
								</div>
							</li>
							
						</ul>
						<ul class="nav navbar-nav">
							<li class="nav-item hidden-sm-down">
								<a class="nav-link toggle-fullscreen" href="#">
									<i class="ti-fullscreen"></i>
								</a>
							</li>
							<li class="nav-item dropdown hidden-sm-down">
								<a class="nav-link" href="#" data-toggle="dropdown" aria-expanded="false">
									<i class="ti-layout-grid3"></i>
								</a>
								<div class="dropdown-apps dropdown-menu animated fadeInUp">
									<div class="a-grid">
										<div class="row row-sm">
											<div class="col-xs-4">
												<div class="a-item">
													<a href="#">
														<div class="ai-icon"><img class="img-fluid" src="img/brands/dropbox.png" alt=""></div>
														<div class="ai-title">Dropbox</div>
													</a>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="a-item">
													<a href="#">
														<div class="ai-icon"><img class="img-fluid" src="img/brands/github.png" alt=""></div>
														<div class="ai-title">Github</div>
													</a>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="a-item">
													<a href="#">
														<div class="ai-icon"><img class="img-fluid" src="img/brands/wordpress.png" alt=""></div>
														<div class="ai-title">Wordpress</div>
													</a>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="a-item">
													<a href="#">
														<div class="ai-icon"><img class="img-fluid" src="img/brands/gmail.png" alt=""></div>
														<div class="ai-title">Gmail</div>
													</a>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="a-item">
													<a href="#">
														<div class="ai-icon"><img class="img-fluid" src="img/brands/drive.png" alt=""></div>
														<div class="ai-title">Drive</div>
													</a>
												</div>
											</div>
											<div class="col-xs-4">
												<div class="a-item">
													<a href="#">
														<div class="ai-icon"><img class="img-fluid" src="img/brands/dribbble.png" alt=""></div>
														<div class="ai-title">Dribbble</div>
													</a>
												</div>
											</div>
										</div>
									</div>
									<a class="dropdown-more" href="#">
										<strong>View all apps</strong>
									</a>
								</div>
							</li>
						</ul>
					</div>
				</nav>
			</div>
			
			<script>
			    function photo()
			    {
			        var fileToUpload = $("#fileToUpload").val();
			        alert(fileToUpload);
			         $.ajax({
                url:"include/photo_submit.php",
                type:"GET",
                data:'fileToUpload=' + fileToUpload,
                success:function(data){
                    $("#abc").html(data);
                    console.log(data);
                    //alert("New Academic Year created successfully!");
                }
            });
            return true;
			    }
			</script>
			<script>
function notifyMe() {
    var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();

if(dd<10) {
    dd = '0'+dd
} 

if(mm<10) {
    mm = '0'+mm
} 

today = yyyy + '-' + mm + '-' + dd;
<?php
$data = array();
$stmt = $reg_user->runQuery("SELECT DATE(`startEvent`) todayDate, title FROM `events` where DATE(`startEvent`) = CURDATE()");
$stmt->execute();
$in_result = $stmt->fetchAll();
foreach($in_result as $row1)
{
 $a = $row1["todayDate"];


?>
if(today == '<?php echo $a; ?>')
{
   // alert(today);
  if (!("Notification" in window)) {
    alert("This browser does not support desktop notification");
  }
  else if (Notification.permission === "granted") {
        var options = {
                body: "<?php echo $row1["title"]; ?>",
                icon: "icon.jpg",
                dir : "ltr"
             };
          var notification = new Notification("Todays Calendar",options);
  }
  else if (Notification.permission !== 'denied') {
    Notification.requestPermission(function (permission) {
      if (!('permission' in Notification)) {
        Notification.permission = permission;
      }
    
      if (permission === "granted") {
        var options = {
              body: "<?php echo $row1["title"]; ?>",
              icon: "icon.jpg",
              dir : "ltr"
          };
        var notification = new Notification("Todays Calendar",options);
      }
    });
  }
}
<?php
}
?>
}
</script>