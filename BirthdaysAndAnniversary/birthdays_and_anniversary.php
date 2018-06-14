<?php
ob_start();
if (!isset($_SESSION['userSession'])) {
	header('location:login');
}
$logged_in_stmt = $reg_user->runQuery("SELECT * FROM user WHERE id = '".$_SESSION['userSession']."' ");
$logged_in_stmt->execute();
$logged_in_result = $logged_in_stmt->fetchObject();

include("include/header.php");
?>
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/jsgrid/dist/jsgrid-theme.min.css">
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/DataTables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/DataTables/Responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/DataTables/Buttons/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?php echo DIR_SYSTEM; ?>vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css">

    
    <title>Birthdays And Anniversary</title>
<div class="site-content">
		<div class="content-area py-1">
			<div class="container-fluid">
				<h4>Birthdays And Anniversary</h4>
				<div class="box box-block bg-white">
    				
                        
                            <div class="table-responsive">          
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th>EmpId</th>
                                        <th>Name</th>
                                        <th>Birthdays</th>
                                        <th>Anniversary</th>
                                        <th>Email sent</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $user_bd = $reg_user->runQuery("SELECT * FROM user ORDER BY id");
                                        $user_bd->execute();
                                        $result_bd = $user_bd->fetchAll();
                                        foreach($result_bd as $rowC)
                                        {
                                          $rowC["id"];
                                          $rowC["first_name"];
                                          $rowC["middel_name"];
                                          $rowC["last_name"];
                                          $rowC["dob"];
                                          $rowC["anniversary"];
                                          $rowC["email_status"];
                                        
                                        ?>
                                        <tr>
                                        <td><?php echo $rowC["id"]; ?></td>
                                        <td><?php echo $rowC["first_name"].' '.$rowC["middel_name"].' '.$rowC["last_name"]; ?></td>
                                        <td><?php echo $rowC["dob"]; ?></td>
                                        <td><?php echo $rowC["anniversary"]; ?></td>
                                        <?php
                                        if($rowC["email_status"] == 'YES')
                                        {
                                        ?>
                                        <td><i class="fa fa-check" aria-hidden="true" style="color:green"></i></td>
                                        <?php
                                        }else
                                        {
                                        ?>
                                        <td><i class="fa fa-times" aria-hidden="true" style="color:red"></i></td>
                                        <?php
                                        }
                                        ?>
                                        </tr>
                                        <?php
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