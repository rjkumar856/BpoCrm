<?php
if(!session_id()){
session_start();
}
require_once 'class.user.php';
$user = new USER();
$user->logout();	
$user->redirect('index');
?>