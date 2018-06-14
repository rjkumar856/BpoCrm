<?php
include '../include/db.php';
$reg_user = new USER1();
$id = $_POST['id'];
$update_status = $reg_user->runQuery("UPDATE announcements set status='Deactive' where Id='$id' and status='Active';");
$update_status->execute();
?>