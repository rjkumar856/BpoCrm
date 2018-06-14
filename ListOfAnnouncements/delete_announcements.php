<?php
include '../include/db.php';
$reg_user = new USER1();
$del_id = $_POST['del_id'];
$del = $reg_user->runQuery("Delete from announcements where Id='$del_id';");
$del->execute();
?>