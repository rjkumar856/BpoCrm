<?php
header('Access-Control-Allow-Origin: *');
include '../include/db.php'; 
$reg_user = new USER1();
require_once('../include/class.user.php');
$class_user = new USER();

if($_SERVER['REQUEST_METHOD']=="POST"){
    try{
        
        if(isset($_REQUEST['announcements_details'])){
            
                $posted_value = (array) json_decode($_REQUEST['announcements_details']);
                foreach($posted_value as $posted){
                $posted = (array) $posted;
                
                if($_REQUEST['server_name']){
                    $server_name = htmlentities(trim($_REQUEST['server_name']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
                }else{
                    $server_name='';
                }
                
                $local_id = htmlentities(trim($posted['Id']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
                $summary = htmlentities(trim($posted['summary']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$announcements = htmlentities(trim($posted['announcements']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$publishDate = htmlentities(trim($posted['publishDate']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$status = htmlentities(trim($posted['status']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$reserveId = addslashes(htmlentities(trim($posted['reserveId']),ENT_QUOTES,"UTF-8",FALSE));
        		$userType = htmlentities(trim($posted['userType']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        		$modifiedBy = htmlentities(trim($posted['modifiedBy']),ENT_QUOTES|ENT_SUBSTITUTE,"UTF-8",FALSE);
        	
        		
        		if(empty($summary) || empty($announcements) || empty($local_id)){
        		    echo json_encode(array("message"=>"All the fields are required"));
        		}else{
        	
        		        
        		        $stmt_lead = $reg_user->runQuery("SELECT * FROM announcements an WHERE an.local_id='$local_id' AND an.server_name='$server_name'");
                        $stmt_lead->execute();
                        $lead_details = $stmt_lead->fetchAll(PDO::FETCH_ASSOC);
                        if($stmt_lead->rowCount()){
                            $stmt = $reg_user->runQuery("UPDATE announcements SET summary='$summary',announcements='$announcements',publishDate='$publishDate',status='$status',reserveId='$reserveId',userType='$userType',modifiedBy='$modifiedBy'
                             WHERE local_id='$local_id' AND server_name='$server_name'");
                            $stmt->execute();
        		        }else{
        		            
        		            $stmt = $reg_user->runQuery("INSERT INTO announcements(summary,announcements,publishDate,status,reserveId,userType,modifiedBy,local_id,server_name) 
                            VALUES('$summary','$announcements','$publishDate','$status','$reserveId','$userType','$modifiedBy','$local_id','$server_name')");
                            $stmt->execute();
                            $new_lead_id = $reg_user->lasdID();
        		            
        		        }
                            
                    		echo json_encode(array("message"=>"Success"));
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