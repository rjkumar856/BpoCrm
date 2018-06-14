<?php
$user = new USER();
$id = $_GET['id'];
$stmt = $user->runQuery("SELECT * FROM add_leads where lead_id='$id'");
$stmt->execute();
for($i=0; $stmt1 = $stmt->fetchObject(); $i++)
{
$result=$stmt1->status;
if($result == 'Y')
{
$update=$user->runQuery("UPDATE add_leads SET status='N' where lead_id='$id'");
$update->execute();
}else {
$update1=$user->runQuery("UPDATE add_leads SET status='Y' where lead_id='$id'");
$update1->execute();
}
}

header("Location:view_leads");
?>