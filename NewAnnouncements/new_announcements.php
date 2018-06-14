<?php
include("include/header.php");
?>
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/jsgrid/dist/jsgrid-theme.min.css">
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/DataTables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/DataTables/Responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/DataTables/Buttons/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css">


<title>New Announcements</title>
        <div class="site-content">
			<div class="content-area py-1">
				<div class="container-fluid">
					<h4>New Announcements</h4>
					<div class="box box-block bg-white">
			<?php
			if($logged_in_result->usertype == 'super-admin' || $logged_in_result->usertype == 'admin' || $logged_in_result->usertype == 'manager' || $logged_in_result->usertype == 'l2-level'){ ?>
						<div class="row">
									<div class="col-md-6">
									<div class="form-group">
										<label><b>Summary*</b></label>
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Summary" name="summary" id="summary" required>
										</div>
									</div>
									<div class="form-group">
										<label><b>Announcements*</b></label>
										<div class="input-group">
											<textarea name="announcements" id="announcements" placeholder="Announcements.." class="form-control" rows="7"></textarea>
										</div>
									</div>
									<div class="form-group">
										<label><b>Date*</b></label>
										<div class="input-group">
											<input type="date" class="form-control" placeholder="Date" name="date" id="date" required>
										</div>
									</div>	
									
								</div>

								
							<div class="col-md-12">
									<div class="pull-left">
									<input type="submit" class="btn btn-primary" value="Publish Announcements" name="publish" id="publish" onclick="return publishAnnouncements();">
									</div>
							</div>
							       
					</div>
					
					<?php echo $pagination;
							
                                }else{
                                    echo "<div class='alert alert-warning'>You dont have permission to access this page</div>";
                                }
                                ?>
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
		<script type="text/javascript" src="vendor/DataTables/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/js/dataTables.bootstrap4.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/Responsive/js/dataTables.responsive.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/Responsive/js/responsive.bootstrap4.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/Buttons/js/dataTables.buttons.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/Buttons/js/buttons.bootstrap4.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/JSZip/jszip.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/pdfmake/build/pdfmake.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/pdfmake/build/vfs_fonts.js"></script>
		<script type="text/javascript" src="vendor/DataTables/Buttons/js/buttons.html5.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/Buttons/js/buttons.print.min.js"></script>
		<script type="text/javascript" src="vendor/DataTables/Buttons/js/buttons.colVis.min.js"></script>
		<!-- Neptune JS -->
		<script type="text/javascript" src="js/app.js"></script>
		<script type="text/javascript" src="js/demo.js"></script>
		<script type="text/javascript" src="js/tables-datatable.js"></script>
		<script type="text/javascript">
		    function publishAnnouncements()
		    {
		        var summary = $("#summary").val();
		        var announcements = $("#announcements").val();
		        var date = $("#date").val();
		        //alert(summary);
		        $.ajax({
                url:"NewAnnouncements/new_announcements_submit.php",
                type:"POST",
                data:'summary=' + summary + '&announcements=' + announcements + '&date=' + date,
                success:function(data){
                $("#announcement").html(data);
                console.log(data);
                alert("Your announcement is published successfully!");
                window.location.href = "https://www.webliststore.com/bpo_crm/new_announcements";
                }
                });
		        return true;
		    }
		</script>
		
		
		