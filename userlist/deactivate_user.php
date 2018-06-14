<?php
include '../include/db.php';
$reg_user = new USER1();
$id = $_POST['id'];
$update_status = $reg_user->runQuery("UPDATE user set cusStatus='N' where id='$id';");
$update_status->execute();
?>