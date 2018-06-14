<?php
    $servername="localhost";
    $username="demo_users";
    $password="D-cku%OGoG&s";

    // create connection    
    $conn=mysqli_connect($servername,$username,$password);
    mysqli_select_db($conn,"demo_bpo");
    

    echo "<br>done";    
?>