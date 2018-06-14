<?php
if(!session_id()){
session_start();
}
    include '../include/db.php';
    $reg_user = new USER1();
    include '../include/class.user.php';
    $class_user = new USER();
    $ip_address = $class_user->getClientIP();
    $user_id= $_SESSION['userSession'];
    if(isset($_POST["import_leads"])){

 
		//$filename=$_FILES["data_import"]["tmp_name"];
		$csvfile = $_FILES['data_import']['name'];
 
$ext = pathinfo($csvfile, PATHINFO_EXTENSION);
 
$base_name = pathinfo($csvfile, PATHINFO_BASENAME);

if(!$_FILES['data_import']['name'] == "")
    
{ 
 
if($ext == "csv")
 
{
 
 if(file_exists($base_name))
{
      echo "file already exist" . $base_name;
                                                  
}
 
    else
{
	    
if (is_uploaded_file($_FILES['data_import']['tmp_name'])) 
 
{
	
	//echo "<h1>" . "File ". $_FILES['data_import']['name'] ." uploaded successfully." . "</h1>";
 
	readfile($_FILES['data_import']['tmp_name']);
	                                                         
 }
          $handle = fopen($_FILES['data_import']['tmp_name'], "r");
 $i=1;
   while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
{
    
	if($i>1){

    
    $lead_num_stmt = $reg_user->runQuery("SELECT (max(`lead_id`)+1) lead_num FROM `add_leads`");
    $lead_num_stmt->execute();
    $result_lead_num = $lead_num_stmt->fetchAll();
    foreach($result_lead_num as $rowAnnounce)
                                        {
                                            echo "SELECT (max(`lead_id`)+1) lead_num FROM `add_leads`";
             echo $lead_num = $rowAnnounce['lead_num'];   
             
     $stmt_import = $reg_user->runQuery(" INSERT INTO add_leads (lead_id,user_id,firstName,middleName,lastName,email,phoneNum,alterPhoneNum,address1,address2,city,state,country,zipcode,status,modifiedBy,ip_address) VALUES ('$lead_num','$user_id','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$user_id','$ip_address')");
   $stmt_import->execute();
                                       
   $import_add_sales = $reg_user->runQuery(" INSERT INTO add_sales (lead_id,user_id,reff_number,ticket_number,status,modified_by,ip_address) VALUES ('$lead_num','$user_id','Ref_$lead_num','Tic_$lead_num','Y','$user_id','$ip_address')");
   $import_add_sales->execute();
    
    $stmt_rds = $reg_user->runQuery(" INSERT INTO rds (lead_id,rds_id,user_id,status,modified_by,ip_address) VALUES ('$lead_num','RDS_$lead_num','$user_id','Y','$user_id','$ip_address')");
   $stmt_rds->execute();
                                        }
   

	}

     
 $i++;
   }
 
  fclose($handle);
    echo "<script>
    alert('File uploaded successfully.');
    </script>";
}
 
}
 
else
{
 
 echo " <script>
    alert('Check file Extension. your file must be in csv formate.')
    </script>";
		   
 }
 
}  
 
else
{
 echo "<script>
 alert('Please Upload File')
 </script>";
 }
    }
    echo "<script>
    window.location.href = \"https://www.webliststore.com/bpo_crm/import_data\";
    </script>";
?>		