<?php
    include 'dbconnect.php';
    //simple upload
   $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $image=$_FILES["file"]["name"];

    $image_size=getimagesize($_FILES['image']['tmp_name']);
    //echo $image_size;
    if($image_size==FALSE)
    {
        echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('fill data');</SCRIPT>");
        //readfile("login.php");`enter code here`
    }
    else
    {
        move_uploaded_file($file_tmp,"uploads/".$file_name);
        //upload in mysql database

        $file = $_FILES['image']['name'];
        $image_name = addslashes($_FILES['image']['name']);
        $x=$_POST["username"];

        $sql="INSERT INTO  `user_image` (username, userimage) VALUES('$x','$image_name')";

        if(!$insert=mysqli_query($conn,$sql))
            echo "problem uploading image";
        else
        {
            $img="uploads/".$file_name;
            echo '<img src= "'.$img.'" height=200 width=150>';
        }
    }
?>