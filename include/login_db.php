<?php
if(isset($_POST['login'])){
    $user = new USER();
    $email = trim($_POST['email']);
    echo $password = trim($_POST['password']);



    if($user->login($email,$password)){
         if(isset($_SESSION['requested_page'])){
        $user->redirect($_SESSION['requested_page']);
        unset($_SESSION['requested_page']);
        }else{
        $user->redirect('index');
        }
    }else{
        //$user->redirect('login');
    }
}
?>