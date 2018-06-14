<?php
include("include/header.php");
?>
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/jsgrid/dist/jsgrid-theme.min.css">
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/DataTables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/DataTables/Responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/DataTables/Buttons/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css">


<title>List Of Announcements</title>
<div class="site-content">
		<div class="content-area py-1">
			<div class="container-fluid">
				<h4>List Of Announcements</h4>
				<div class="box box-block bg-white">
    				
                        
                            <div class="table-responsive">          
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Summary</th>
                                        <th>Announcements</th>
                                        <th>Date of Publish</th>
                                        <th>Status</th>
                                    <?php
				                    if($logged_in_result->usertype == 'super-admin' || $logged_in_result->usertype == 'admin' || $logged_in_result->usertype == 'manager' || $logged_in_result->usertype == 'l2-level'){ ?>
                                        <th>Deactivate</th>
                                        <th>Delete</th>
                                    <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $announcement_stmt = $reg_user->runQuery("SELECT * FROM announcements ORDER BY id");
                                        $announcement_stmt->execute();
                                        $result_announce = $announcement_stmt->fetchAll();
                                        $i=1;
                                        foreach($result_announce as $rowAnnounce)
                                        {
                                            if($rowAnnounce["status"] == 'Active')
                                            {
                                        ?>
                                        
                                        <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $rowAnnounce["summary"]; ?></td>
                                        <td><?php echo $rowAnnounce["announcements"]; ?></td>
                                        <td><?php echo $rowAnnounce["publishDate"]; ?></td>
                                        <td><?php echo $rowAnnounce["status"]; ?></td>
                                <?php
				                if($logged_in_result->usertype == 'super-admin' || $logged_in_result->usertype == 'admin' || $logged_in_result->usertype == 'manager' || $logged_in_result->usertype == 'l2-level'){ ?>
                                        <td><button type="button" class="btn btn-primary" onclick="return deactive('<?php echo $rowAnnounce["Id"]; ?>');"><i class="fa fa-ban" aria-hidden="true"></i></button></td>
                                        <td><button type="button" class="btn btn-primary" onclick="return del_announce('<?php echo $rowAnnounce["Id"]; ?>');"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                                <?php } ?>
                                        </tr>
                                        <?php
                                            }else
                                            {
                                        ?>
                                        <tr bgcolor="#EAEDED">
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $rowAnnounce["summary"]; ?></td>
                                        <td><?php echo $rowAnnounce["announcements"]; ?></td>
                                        <td><?php echo $rowAnnounce["publishDate"]; ?></td>
                                        <td><?php echo $rowAnnounce["status"]; ?></td>
                                <?php
    				            if($logged_in_result->usertype == 'super-admin' || $logged_in_result->usertype == 'admin' || $logged_in_result->usertype == 'manager' || $logged_in_result->usertype == 'l2-level'){ ?>
                                        <td><button type="button" class="btn btn-primary" onclick="return deactive('<?php echo $rowAnnounce["Id"]; ?>');"><i class="fa fa-ban" aria-hidden="true"></i></button></td>
                                        <td><button type="button" class="btn btn-primary" onclick="return del_announce('<?php echo $rowAnnounce["Id"]; ?>');"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                                <?php } ?>
                                        </tr>
                                        <?php
                                        }
                                        $i++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
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
		    function deactive(id)
		    {
		        //alert(id);
		       $.ajax({
                url:"ListOfAnnouncements/deactive_announcements.php",
                type:"POST",
                data:'id=' + id,
                success:function(data){
                $("#deactive_div").html(data);
                console.log(data);
                alert("Your announcement is deactivated successfully!");
                window.location.href = "https://www.webliststore.com/bpo_crm/list_of_announcements";
                }
                });
		        return true;
		    }
		    function del_announce(del_id)
		    {
		         $.ajax({
                url:"ListOfAnnouncements/delete_announcements.php",
                type:"POST",
                data:'del_id=' + del_id,
                success:function(data){
                $("#del_div").html(data);
                console.log(data);
                alert("Your announcement is deleted successfully!");
                window.location.href = "https://www.webliststore.com/bpo_crm/list_of_announcements";
                }
                });
		        return true;
		    }
		</script>