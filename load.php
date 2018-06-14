<?php
$data = array();
include '../include/db.php';
$reg_user = new USER1();
$logged_in_stmt = $reg_user->runQuery("SELECT * FROM events ORDER BY id");
$logged_in_stmt->execute();

/*$query = "SELECT * FROM events ORDER BY id";

$statement = $connect->prepare($query);

$statement->execute();*/

$result = $logged_in_stmt->fetchAll();
echo "sadsd";
print_r($result);
foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'start'   => $row["start_event"],
  'end'   => $row["end_event"]
 );
}

echo json_encode($data);
?>