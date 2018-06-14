<?php

include '../include/db.php';
$reg_user = new USER1();
if(isset($_POST["id"]))
{
 $statement = $reg_user->runQuery(" DELETE from events WHERE id=:id ");
 //echo "$query";
 //$statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':id' => $_POST['id']
  )
 );
}else
{
    echo "sdcdsc";
}

?>