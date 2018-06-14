<?php
$user = new USER();
$id = $_GET['id'];
$stmt = $user->runQuery("SELECT * FROM lead_allocation where id='$id'");
$stmt->execute();
for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
{
$result=$stmt1->status;
if($result == 'open')
{
$update=$user->runQuery("UPDATE lead_allocation SET status='close' where id='$id'");
$update->execute();
}else {
$update1=$user->runQuery("UPDATE lead_allocation SET status='open' where id='$id'");
$update1->execute();
}
}

header("Location:list_of_agents");
?>