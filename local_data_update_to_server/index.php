<?php
header('Access-Control-Allow-Origin: *');
include '../include/db.php'; 
$reg_user = new USER1();
require_once('../include/class.user.php');
$class_user = new USER();

if($_SERVER['REQUEST_METHOD']=="POST"){
    try{
        
        if(isset($_REQUEST['lead_details'])){
            
                $posted_value = (array) json_decode($_REQUEST['lead_details']);
                foreach($posted_value as $posted){
                $posted = (array) $posted;
                
                if($_REQUEST['server_name']){
                    $server_name = htmlentities(trim($_REQUEST['server_name']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
                }else{
                    $server_name='';
                }
                
                $local_id = htmlentities(trim($posted['LeadID']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
                $user_id = htmlentities(trim($posted['user_id']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$first_name = htmlentities(trim($posted['firstName']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$last_name = htmlentities(trim($posted['lastName']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$middle_name = htmlentities(trim($posted['middleName']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$email = addslashes(htmlentities(trim($posted['email']),ENT_QUOTES,"UTF-8",FALSE));
        		$phone = htmlentities(trim($posted['phoneNum']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$alter_num = htmlentities(trim($posted['alterPhoneNum']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$address_line1 = htmlentities(trim($posted['address1']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$address_line2 = htmlentities(trim($posted['address2']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$state = htmlentities(trim($posted['state']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$city = htmlentities(trim($posted['city']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$country = htmlentities(trim($posted['country']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$zip_code = htmlentities(trim($posted['zipcode']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		
        		$status = htmlentities(trim($posted['status']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$modifiedBy = htmlentities(trim($posted['modifiedBy']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$ip_address = htmlentities(trim($posted['ip_address']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$date_added = htmlentities(trim($posted['date_added']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$lastModified = htmlentities(trim($posted['lastModified']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		
        		$customer_pass = htmlentities(trim($posted['cus_pass_phrase']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$rdspass = htmlentities(trim($posted['rds_pass']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$rds_id = htmlentities(trim($posted['rds_id']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		
        		$total_amount = htmlentities(trim($posted['total_amount']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$tenure = htmlentities(trim($posted['tenture']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$reference_number = htmlentities(trim($posted['reff_number']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$ticket_number = htmlentities(trim($posted['ticket_number']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		
        		if(empty($first_name) || empty($last_name) || empty($email) || empty($phone) || empty($state) || empty($city) || empty($country)){
        		    echo json_encode(array("message"=>"All the fields are required"));
        		}else{
        		    
        		    $file_name='';
        		    
        		    if(isset($_FILES["document"]) && $_FILES["document"]["size"] > 100){
        		    $target_dir = "uploads/rds/";
                    $target_file = $target_dir . basename($_FILES["document"]["name"]);
                    $uploadOk = 1;
                    $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                        if($FileType == 'doc' || $FileType == 'docx' || $FileType == 'xls' || $FileType == 'xlsx' || $FileType == 'pdf'){
                            $file_name = time().rand(1111,9999).".".$FileType;
                            $target_file_new = $target_dir . $file_name;
                            if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file_new)){
                        		$_SESSION['add_lead_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>
                        		<strong>Success!</strong>  Document added successfully.</div>";
            			    
            			    $stmt = $reg_user->runQuery("INSERT INTO add_leads(user_id,local_id,firstName,middleName,lastName,email,phoneNum,alterPhoneNum,address1,address2,city,state,country,zipcode,status,modifiedBy,server_name,ip_address) 
                            VALUES('$user_id','$local_id','$first_name','$middle_name','$last_name','$email','$phone','$alter_num','$address_line1','$address_line2','$city','$state','$country','$zip_code','$status','$modifiedBy','$server_name','$ip_address')");
                            $stmt->execute();
                            $new_lead_id = $reg_user->lasdID();
                            
                            $stmt = $reg_user->runQuery("INSERT INTO rds(lead_id,local_id,rds_id,user_id,rds_pass,cus_pass_phrase,upload_doc,status,modified_by,server_name,ip_address) 
                            VALUES('$new_lead_id','$local_id','$rds_id','$user_id','$rdspass','$customer_pass','$file_name','$status','$modifiedBy','$server_name','$ip_address')");
                            $stmt->execute();
                            
                            $stmt = $reg_user->runQuery("INSERT INTO add_sales(lead_id,local_id,user_id,total_amount,tenture,reff_number,ticket_number,status,modified_by,server_name,ip_address) 
                            VALUES('$new_lead_id','$local_id','$user_id','$total_amount','$tenure','$reference_number','$ticket_number','$status','$modifiedBy','$server_name','$ip_address')");
                            $stmt->execute();
                            
                    		$_SESSION['add_lead_error_msg'] = "<div class='alert alert-success'><button class='close' data-dismiss='alert'>&times;</button>
                    		<strong>Success!</strong>  New leads added successfully.</div>";
                    		$class_user->redirect('add_leads');
                    		exit();
        
                            } else {
                                $_SESSION['add_lead_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> Sorry, there was an error uploading your file.</div>";
                            }
                            
                        }else {
                            $_SESSION['add_lead_error_msg'] = "<div class='alert alert-danger'><button class='close' data-dismiss='alert'>&times;</button> Selected file is not a valid document file. The accepted file type is doc,docx,xls,xlsx and pdf.</div>";
                        }
        		    }else{
        		        
        		        $stmt_lead = $reg_user->runQuery("SELECT * FROM add_leads al LEFT JOIN add_sales sa ON al.lead_id=sa.lead_id LEFT JOIN rds rs ON al.lead_id=rs.lead_id WHERE al.local_id='$local_id' AND al.server_name='$server_name'");
                        $stmt_lead->execute();
                        $lead_details = $stmt_lead->fetchAll(PDO::FETCH_ASSOC);
                        if($stmt_lead->rowCount()){
                            
            			    $stmt = $reg_user->runQuery("UPDATE add_leads SET user_id='$user_id',firstName='$first_name',
            			    middleName='$middle_name',lastName='$last_name',email='$email',phoneNum='$phone',alterPhoneNum='$alter_num',address1='$address_line1',address2='$address_line2',city='$city',
            			    state='$state',country='$country',zipcode='$zip_code',status='$status',modifiedBy='$modifiedBy',ip_address='$ip_address' WHERE local_id='$local_id' AND server_name='$server_name'");
                            $stmt->execute();
                            
                            $stmt = $reg_user->runQuery("UPDATE rds SET rds_id='$rds_id',user_id='$user_id',rds_pass='$rdspass',cus_pass_phrase='$customer_pass',upload_doc='$file_name',status='$status',modified_by='$modifiedBy',ip_address='$ip_address' 
                            WHERE local_id='$local_id' AND server_name='$server_name'");
                            $stmt->execute();
                            
                            $stmt = $reg_user->runQuery("UPDATE add_sales SET user_id='$user_id',total_amount='$total_amount',tenture='$tenure',reff_number='$reference_number',ticket_number='$ticket_number',status='$status',modified_by='$modifiedBy',ip_address='$ip_address' 
                             WHERE local_id='$local_id' AND server_name='$server_name'");
                            $stmt->execute();
        		        }else{
        		            
        		            $stmt = $reg_user->runQuery("INSERT INTO add_leads(user_id,local_id,firstName,middleName,lastName,email,phoneNum,alterPhoneNum,address1,address2,city,state,country,zipcode,status,modifiedBy,server_name,ip_address) 
                            VALUES('$user_id','$local_id','$first_name','$middle_name','$last_name','$email','$phone','$alter_num','$address_line1','$address_line2','$city','$state','$country','$zip_code','$status','$modifiedBy','$server_name','$ip_address')");
                            $stmt->execute();
                            $new_lead_id = $reg_user->lasdID();
                            
                            $stmt = $reg_user->runQuery("INSERT INTO rds(lead_id,local_id,rds_id,user_id,rds_pass,cus_pass_phrase,upload_doc,status,modified_by,server_name,ip_address) 
                            VALUES('$new_lead_id','$local_id','$rds_id','$user_id','$rdspass','$customer_pass','$file_name','$status','$modifiedBy','$server_name','$ip_address')");
                            $stmt->execute();
                            
                            $stmt = $reg_user->runQuery("INSERT INTO add_sales(lead_id,local_id,user_id,total_amount,tenture,reff_number,ticket_number,status,modified_by,server_name,ip_address) 
                            VALUES('$new_lead_id','$local_id','$user_id','$total_amount','$tenure','$reference_number','$ticket_number','$status','$modifiedBy','$server_name','$ip_address')");
                            $stmt->execute();
        		            
        		        }
                            
                    		echo json_encode(array("message"=>"Success"));
        		    }
        		}
                }
            }else{
                echo json_encode(array("message"=>"empty data1"));
            }
		}catch(Exception $ex){
			 echo json_encode(array("message"=>$ex->getMessage()));
		}
}else{
    echo json_encode(array("message"=>"wrong method"));
}
?>