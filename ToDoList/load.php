<?php

include '../include/db.php';
$data = array();
$reg_user = new USER1();
$logged_in_stmt = $reg_user->runQuery("SELECT * FROM events ORDER BY id");
$logged_in_stmt->execute();
$result = $logged_in_stmt->fetchAll();
foreach($result as $row)
{
 $data[] = array(
  'id'   => $row["id"],
  'title'   => $row["title"],
  'start'   => $row["startEvent"],
  'end'   => $row["endEvent"]
 );
}

echo json_encode($data);
?>