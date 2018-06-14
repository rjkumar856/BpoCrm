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

    
    <title>User List</title>
<div class="site-content">
		<div class="content-area py-1">
			<div class="container-fluid">
				<h4>List Of Users</h4>
				<div class="box box-block bg-white">
    				<?php
			if($logged_in_result->usertype == 'super-admin' || $logged_in_result->usertype == 'admin' || $logged_in_result->usertype == 'manager' || $logged_in_result->usertype == 'l2-level'){ ?>
                        
                            <div class="table-responsive">          
                                <table class="table">
                                    <thead>
                                        <tr>
                                        <th>EmpId</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Designation</th>
                                        <th>Status</th>
                                        <th>Deactive</th>
                                        <th>Edit</th>
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
                                          $rowC["cusEmail"];
                                          $rowC["mobile"];
                                          $rowC["usertype"];
                                          $rowC["cusStatus"];
                                          if($rowC["cusStatus"] == 'Y')
                                          {
                                              $cusStatus = 'Active';
                                          }else
                                          {
                                              $cusStatus = 'Inactive';
                                          }
                                        
                                        ?>
                                        <tr>
                                        <td><?php echo $rowC["id"]; ?></td>
                                        <td><?php echo $rowC["first_name"].' '.$rowC["middel_name"].' '.$rowC["last_name"]; ?></td>
                                        <td><?php echo $rowC["cusEmail"]; ?></td>
                                        <td><?php echo $rowC["mobile"]; ?></td>
                                        <td contenteditable="false" id="users<?php echo $rowC["id"]; ?>"><?php echo $rowC["usertype"]; ?></td>
                                        <td><?php echo $cusStatus; ?></td>
                                        <td><button type="button" class="btn btn-primary" onclick="return deactive('<?php echo $rowC["id"]; ?>');"><i class="fa fa-ban" aria-hidden="true"></i></button></td>
                                        <td><button type="button" class="btn btn-primary editbtn" data-userid="<?php echo $rowC["id"]; ?>">Edit</button></td>
                                       
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php 
                            }else{
                                    echo "<div class='alert alert-warning'>You dont have permission to access this page</div>";
                                }
                                ?>
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
                url:"UserList/deactivate_user.php",
                type:"POST",
                data:'id=' + id,
                success:function(data){
                $("#deactive_div").html(data);
                console.log(data);
                alert("User is deactivated successfully!");
                window.location.href = "https://www.webliststore.com/bpo_crm/UsersList";
                }
                });
            return true;
        }
      </script>
      <script>
   $(document).ready(function () {

      $('.editbtn').click(function (e) {
          e.preventDefault();
          
          var $this = $(this);
   
          var currentTD = $(this).parents('tr').find('#users');
          if ($(this).html() == 'Edit') {
               
            var value_i = $(this).data('userid');
            //ab = "users" + value_i;
              $('#users' + value_i).html('<td id="users" contenteditable="true"><select id="sel"><option value="admin">Admin</option><option value="normal">Normal</option><option value="manager">Manager</option><option value="agents">Agents</option><option value="super-admin">Super-admin</option><option value="l2-level">L1-Manager</option></select></td>');
              $.each(currentTD, function () {
                  $(this).prop('contenteditable', true)
              });
          } else {
                var designation = $("#sel").val();
                var value_i = $(this).data('userid');
             $.each(currentTD, function () {
                 //$('#users' + value_i).html('<td  contenteditable="false" id="users">Row 0 Column 0</td>');
                 $(this).prop('contenteditable', false)
              });
              $.ajax({
                url:"UserList/usertype.php",
                type:"POST",
                data:'designation=' + designation + '&value_i=' + value_i,
                success:function(data){
                $("#users").html(data);
                console.log(data);
                alert("Updated Successfully!");
                window.location.href = "https://www.webliststore.com/bpo_crm/UsersList";
                }
                });
          }

          $(this).html($(this).html() == 'Edit' ? 'Save' : 'Edit')

      });
       

  });
</script>