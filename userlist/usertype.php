<?php
include '../include/db.php';
$reg_user = new USER1();
$id = $_POST['value_i'];
$utype = $_POST['designation'];
$update_status = $reg_user->runQuery("UPDATE user set usertype='$utype' where id='$id';");
$update_status->execute();
?>