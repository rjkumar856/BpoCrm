<?php
if(isset($_GET['delete_id']) && !empty($_GET['delete_id'])){
	$stmt = $reg_user->runQuery("DELETE FROM add_leads WHERE lead_id=".$_GET['delete_id']);
	$stmt->execute();
	$stmt = $reg_user->runQuery("DELETE FROM add_sales WHERE lead_id=".$_GET['delete_id']);
	$stmt->execute();
	$stmt = $reg_user->runQuery("DELETE FROM rds WHERE lead_id=".$_GET['delete_id']);
	$stmt->execute();
	$stmt = $reg_user->runQuery("DELETE FROM lead_allocation WHERE lead_id=".$_GET['delete_id']);
	$stmt->execute();
	
	$class_user->redirect('view_leads');
}

include 'include/header.php';
?>
<title>Leads</title>
        <div class="site-content view-leads view-pagination">
			<div class="content-area py-1">
					<div class="container-fluid">
						<h4>View All Leads</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">View All Leads</li>
						</ol>
						<div class="box box-block bg-white">
							<table class="table jsgrid table-striped table-bordered dataTable table-responsive" id="table-2">
								<thead>
									<tr>
									    <th>S.No</th>
									    <th>OPTIONS</th>
										<th>First Name</th>
										<th>Middle Name</th>
										<th>Last Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Alternative Phone</th>
										<th>Address1</th>
										<th>Address2</th>
										<th>City</th>
										<th>State</th>
										<th>Country</th>
										<th>Zipcode</th>
										
										<th>RDS ID</th>
										<th>RDS Pass</th>
										<th>Customer Pass</th>
										<th>Doc</th>
										
										<th>total_amount</th>
										<th>tenture</th>
										<th>reff_number</th>
										<th>ticket_number</th>
										
										<th>Created Date</th>
										<th>Status<br><small>Click to change Status</small></th>
									</tr>
								</thead>
								<tbody>
            				<?php
                                $tbl_name="";
                                $adjacents = 3;
                                $targetpage = strtok(rtrim($_SERVER['REQUEST_URI'], "/"), "?"); 	//your file name  (the name of this file)
                                $limit = 20;								//how many items to show per page
                                
                                $stmt = $reg_user->runQuery("SELECT COUNT(*) as POST_COUNT FROM add_leads al LEFT JOIN add_sales sa ON al.lead_id=sa.lead_id 
                                    LEFT JOIN rds rs ON al.lead_id=rs.lead_id WHERE al.user_id='".$_SESSION['userSession']."' ORDER BY al.date_added DESC");
                                $stmt->execute();
                                $row_count = $stmt->fetchObject();
                                $total_pages = $row_count->POST_COUNT;
                                $page = (isset($_GET['page']))?$_GET['page']:0;
                                if($page){ $start = ($page - 1) * $limit; }
                                else{ $start = 0; }							//if no page var is given, set start to 0
                                $count= $start + 1;
                                
                                $stmt_post = $reg_user->runQuery("SELECT *,al.lead_id as LeadID,al.status as LeadStatus FROM add_leads al LEFT JOIN add_sales sa ON al.lead_id=sa.lead_id 
                                    LEFT JOIN rds rs ON al.lead_id=rs.lead_id WHERE al.user_id='".$_SESSION['userSession']."' ORDER BY al.date_added DESC LIMIT $start, $limit");
                                $stmt_post->execute();
                                
                                if ($page == 0){ $page = 1; }					//if no page var is given, default to 1.
                                $prev = $page - 1;							//previous page is page - 1
                                $next = $page + 1;							//next page is page + 1
                                $lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
                                $lpm1 = $lastpage - 1;						//last page minus 1
                                
                                	$pagination = "";
                                	if($lastpage > 1){	
                                		$pagination .= "<div class=\"pagination\" id='sub_pagination'><div>Showing ".$count." to ". ((($count + $limit - 1) < $total_pages)?($count + $limit - 1) :$total_pages) ." of ".$total_pages." entries</div><br>";
                                		//previous button
                                		if ($page > 1) 
                                			$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage?page=$prev\"><i class='fa fa-angle-double-left'></i> previous</a></li>";
                                		else
                                			$pagination.= "<li class=\"page-item\"><span class=\"page-link disabled\"><i class='fa fa-angle-double-left'></i> previous</span></li>";	
                                		
                                		//pages	
                                		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
                                		{	
                                			for ($counter = 1; $counter <= $lastpage; $counter++)
                                			{
                                				if ($counter == $page)
                                					$pagination.= "<li class=\"page-item active\"><span class=\"page-link current\">$counter</span></li>";
                                				else
                                					$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage?page=$counter\">$counter</a></li>";					
                                			}
                                		}
                                		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
                                		{
                                			//close to beginning; only hide later pages
                                			if($page < 1 + ($adjacents * 2))		
                                			{
                                				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                                				{
                                					if ($counter == $page)
                                						$pagination.= "<li class=\"page-item active\"><span class=\"page-link current\">$counter</span></li>";
                                					else
                                						$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage?page=$counter\">$counter</a></li>";					
                                				}
                                				$pagination.= "<li class=\"page-item\">...</li>";
                                				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
                                				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";		
                                			}
                                			//in middle; hide some front and some back
                                			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                                			{
                                				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage?page=1\">1</a></li>";
                                				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage?page=2\">2</a></li>";
                                				$pagination.= "<li class=\"page-item\">...</li>";
                                				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                                				{
                                					if ($counter == $page)
                                						$pagination.= "<li class=\"page-item active\"><span class=\"page-link current\">$counter</span></li>";
                                					else
                                						$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage?page=$counter\">$counter</a></li>";					
                                				}
                                				$pagination.= "<li class=\"page-item\">...</li>";
                                				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage?page=$lpm1\">$lpm1</a></li>";
                                				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage?page=$lastpage\">$lastpage</a></li>";		
                                			}
                                			//close to end; only hide early pages
                                			else
                                			{
                                				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage?page=1\">1</a></li>";
                                				$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage?page=2\">2</a></li>";
                                				$pagination.= "<li class=\"page-item\">...</li>";
                                				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                                				{
                                					if ($counter == $page)
                                						$pagination.= "<li class=\"page-item active\"><span class=\"page-link current\">$counter</span></li>";
                                					else
                                						$pagination.= "<li class=\"page-item\"><a class=\"page-link\" href=\"$targetpage?page=$counter\">$counter</a></li>";					
                                				}
                                			}
                                		}
                                		
                                		//next button
                                		if ($page < $counter - 1) 
                                			$pagination.= "<a class=\"page-link\" href=\"$targetpage?page=$next\">next <i class='fa fa-angle-double-right'></i></a>";
                                		else
                                			$pagination.= "<span class=\"page-link disabled\">next <i class='fa fa-angle-double-right'></i></span>";
                                		$pagination.= "</div>\n";		
                                	}
                            
                            $stmt_post->execute();
                            for($i=0; $stmt1 = $stmt_post->fetchObject(); $i++){
                            ?><tr>
                                <td><?php echo $count; ?></td>
                            <td class="jsgrid-cell jsgrid-control-field jsgrid-align-center" style="width: 50px;">
								<a class="icons large edit p-5" href="<?php echo DIR_SYSTEM; ?>edit_lead?id=<?php echo $stmt1->LeadID;?>"><i class="fa fa-pencil" title="Edit"></i></a>
								<a class="icons large edit p-5" onclick="delete_id(<?php echo $stmt1->LeadID;?>);" ><i class="fa fa-trash" aria-hidden="true" title="Delete"></i></a>
							</td>
							            <td><?php echo $stmt1->firstName; ?></td>
										<td><?php echo $stmt1->middleName;?></td>
										<td><?php echo $stmt1->lastName; ?></td>
										<td><?php echo $stmt1->email;?></td>
										<td><?php echo $stmt1->phoneNum;?></td>
										<td><?php echo $stmt1->alterPhoneNum;?></td>
										<td><?php echo $stmt1->address1;?></td>
										<td><?php echo $stmt1->address2;?></td>
										<td><?php echo $stmt1->city;?></td>
										<td><?php echo $stmt1->state;?></td>
										<td><?php echo $stmt1->country;?></td>
										<td><?php echo $stmt1->zipcode;?></td>
										
										<td><?php echo $stmt1->rds_id;?></td>
										<td><?php echo $stmt1->rds_pass;?></td>
										<td><?php echo $stmt1->cus_pass_phrase;?></td>
										<td><?php if(!empty($stmt1->upload_doc)){ echo "<a href='".DIR_SYSTEM."uploads/rds/".$stmt1->upload_doc."' target='_blank' title='Download'>Download</a>";}?></td>
										
										<td><?php echo $stmt1->total_amount;?></td>
										<td><?php echo $stmt1->tenture;?></td>
										<td><?php echo $stmt1->reff_number;?></td>
										<td><?php echo $stmt1->ticket_number;?></td>
										
										<td><?php echo $stmt1->date_added;?></td>
										<td><?php
                                            if(($stmt1->LeadStatus)=='Y')
                                            {
                                            ?>
                                            <a class="btn btn-primary" href="lead_status_update?id=<?php echo $stmt1->LeadID;?>" title="Click here to Deactive" >Active</a>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <a class="btn btn-primary" href="lead_status_update?id=<?php echo $stmt1->LeadID;?>" title="Click here to Active">Deactive</a>
                                            <?php
                                            }
                                            ?></td>
										</tr><?php $count++; } ?>
								</tbody>
							</table>
							<?php echo $pagination; ?>
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
        delete_id = function(id) {
        	if(confirm('Are you sure you want to delete this Lead?')){
        	    window.location.href='view_leads?delete_id='+id;
        	}
        }
        </script>
	</body>
</html>