 <?php
 
 echo $fileToUpload = $_GET['fileToUpload'];
 //simple upload
 
 print_r (explode(".",$fileToUpload));
 
// $file_temp = $_FILES['file']['tmp_name'];   
   // $info = getimagesize($file_temp);
    
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $image=$_FILES["file"]["name"];

    $image_size=getimagesize($fileToUpload);
    echo $image_size;
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
       echo  $image_name = addslashes($_FILES['image']['name']);
        echo $x=$_POST["username"];

        echo $sql="INSERT INTO  `user_image` (username, userimage) VALUES('$x','$image_name')";

        if(!$insert=mysqli_query($conn,$sql))
            echo "problem uploading image";
        else
        {
            $img="uploads/".$file_name;
            echo '<img src= "'.$img.'" height=200 width=150>';
        }
    }
    ?>