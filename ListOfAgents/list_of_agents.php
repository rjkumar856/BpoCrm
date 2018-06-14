<?php
include 'include/header.php';
?>
<title>Leads</title>
        <div class="site-content view-leads view-pagination">
			<div class="content-area py-1">
					<div class="container-fluid">
						<h4>View Sales Target</h4>
						<ol class="breadcrumb no-bg mb-1">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">View Sales Target</li>
						</ol>
						<div class="box box-block bg-white">
						    <?php
						    if($logged_in_result->usertype == 'super-admin' || $logged_in_result->usertype == 'admin' || $logged_in_result->usertype == 'manager' || $logged_in_result->usertype == 'l2-level' || $logged_in_result->usertype == 'agents'){ ?>
							<table class="table jsgrid table-striped table-bordered dataTable table-responsive" id="table-2">
								<thead>
									<tr>
									    <th>#</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>RDS ID</th>
										<th>Total Amount</th>
										<th>Tenture</th>
										<th>Reff Number</th>
										<th>Ticket Number</th>
										<th>Created Date</th>
									<?php
				                    if($logged_in_result->usertype == 'super-admin' || $logged_in_result->usertype == 'admin' || $logged_in_result->usertype == 'manager'){ ?>
										<th>Assign(ed) To</th>
									<?php } ?>
										<th>Status<br><small>Click to change Status</small></th>
									</tr>
								</thead>
								<tbody>
            				<?php
                                $tbl_name="";
                                $adjacents = 3;
                                $targetpage = strtok(rtrim($_SERVER['REQUEST_URI'], "/"), "?"); 	//your file name  (the name of this file)
                                $limit = 20; //how many items to show per page
                                
                                $sql_query = "SELECT COUNT(*) as POST_COUNT FROM add_leads al LEFT JOIN add_sales sa ON al.lead_id=sa.lead_id 
                                    LEFT JOIN rds rs ON al.lead_id=rs.lead_id LEFT JOIN lead_allocation la ON la.lead_id=al.lead_id
                                    LEFT JOIN user us ON us.id=la.user_id ";

            					if($logged_in_result->usertype != 'super-admin' && $logged_in_result->usertype != 'admin' && $logged_in_result->usertype != 'manager' && $logged_in_result->usertype != 'l2-level'){
            					    $sql_query .=" WHERE la.user_id='".$_SESSION['userSession']."' ";
            					}
                                
                                $sql_query .=" ORDER BY al.date_added DESC";
                                
                                $stmt = $reg_user->runQuery($sql_query);
                                $stmt->execute();
                                $row_count = $stmt->fetchObject();
                                $total_pages = $row_count->POST_COUNT;
                                $page = (isset($_GET['page']))?$_GET['page']:0;
                                if($page){ $start = ($page - 1) * $limit; }
                                else{ $start = 0; }							//if no page var is given, set start to 0
                                $count= $start + 1;
                                
                                $sql_query = "SELECT *,al.lead_id as LeadID,al.status as LeadStatus,al.date_added as createdAt,la.user_id as AssignedTo,la.status as TicketStatus, 
                                la.id as TicketID FROM add_leads al LEFT JOIN add_sales sa ON al.lead_id=sa.lead_id 
                                    LEFT JOIN rds rs ON al.lead_id=rs.lead_id LEFT JOIN lead_allocation la ON la.lead_id=al.lead_id 
                                    LEFT JOIN user us ON us.id=la.user_id ";

            					if($logged_in_result->usertype != 'super-admin' && $logged_in_result->usertype != 'admin' && $logged_in_result->usertype != 'manager' && $logged_in_result->usertype != 'l2-level'){
            					    $sql_query .=" WHERE la.user_id='".$_SESSION['userSession']."' ";
            					}
                                
                                $sql_query .=" ORDER BY al.date_added DESC LIMIT $start, $limit";
                                
                                $stmt_post = $reg_user->runQuery($sql_query);
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
							            <td><?php echo $stmt1->firstName; ?></td>
										<td><?php echo $stmt1->lastName; ?></td>
										<td><?php echo $stmt1->email;?></td>
										<td><?php echo $stmt1->phoneNum;?></td>
										<td><?php echo $stmt1->rds_id;?></td>
										<td><?php echo $stmt1->total_amount;?></td>
										<td><?php echo $stmt1->tenture;?></td>
										<td><?php echo $stmt1->reff_number;?></td>
										<td><?php echo $stmt1->ticket_number;?></td>
										<td><?php echo $stmt1->createdAt;?></td>
                                    <?php
				                    if($logged_in_result->usertype == 'super-admin' || $logged_in_result->usertype == 'admin' || $logged_in_result->usertype == 'manager'){ ?>
                                        <td><?php if(empty(trim($stmt1->AssignedTo))){ ?><a class="btn btn-primary" href="allocate_lead?id=<?php echo $stmt1->LeadID;?>" target="_blank"> Assign </a>
                                        <?php }else{ echo $stmt1->first_name;} ?></td>
                                    <?php } ?>
										<td><?php
										if(empty(trim($stmt1->TicketID))){
										    echo "Not Assinged";
										}else{
										if($stmt1->TicketStatus == "close"){ ?><a class="btn btn-primary" href="ticket_status_update?id=<?php echo $stmt1->TicketID;?>" title="Click here to change status Open" >Close</a>
										<?php }else{ ?><a class="btn btn-primary" href="ticket_status_update?id=<?php echo $stmt1->TicketID;?>" title="Click here to change status Close">Open</a> <?php } } ?></td>
										</tr>
										<?php $count++; } ?>
								</tbody>
							</table>
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