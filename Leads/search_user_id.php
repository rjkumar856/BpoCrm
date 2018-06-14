<?php
header('Content-type: application/json');
include '../include/db.php';
$reg_user = new USER1();
$json = array();

$sql = "SELECT * FROM user ";
if(isset($_REQUEST['phrase']) && !empty($_REQUEST['phrase'])){
$phrase = strtolower(trim($_REQUEST['phrase']));
$sql .=" WHERE lower(first_name) LIKE '%$phrase%' OR lower(middel_name) LIKE '%$phrase%' OR lower(last_name) LIKE '%$phrase%' OR lower(cusEmail) LIKE '%$phrase%' OR mobile LIKE '%$phrase%' ";
}
$sql .=" ORDER by first_name ASC LIMIT 20";
	$stmt = $reg_user->runQuery($sql);
	$stmt->execute();
	for($i = 0;  $object = $stmt->fetch(PDO::FETCH_ASSOC); $i++){
		$json[]=array("id"=>$object['id'],"name"=>$object['first_name'], "lastname"=>$object['last_name'],"email"=>$object['cusEmail']);				 
	}

echo json_encode($json);
?>