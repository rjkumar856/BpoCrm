<?php
include '../include/db.php';
$reg_user = new USER1();

if(isset($_POST["title"]))
{
    $stmt_addr = $reg_user->runQuery(" INSERT INTO events (title, startEvent, endEvent) VALUES (:title, :start_event, :end_event)");
/*    $stmt_addr->execute();
 $query = "
 INSERT INTO events 
 (title, start_event, end_event) 
 VALUES (:title, :start_event, :end_event)
 ";
 $statement = $connect->prepare($query);*/
 $stmt_addr->execute(
  array(
   ':title'  => $_POST['title'],
   ':start_event' => $_POST['start'],
   ':end_event' => $_POST['end']
  )
 );
}


?>
