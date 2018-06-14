<?php
include '../include/db.php';
$reg_user = new USER1();
if($_POST['id'])
{
	$id=$_POST['id'];
		
	$state = $reg_user->runQuery("SELECT * FROM state WHERE country_id=:id");
	$state->execute(array(':id' => $id));
	?><option selected="selected">Select Your State</option><?php
	while($row=$state->fetch(PDO::FETCH_ASSOC))
	{
		?>
        	<option value="<?php echo $row['state_id']; ?>"><?php echo $row['state_name']; ?></option>
        <?php
	}
}
?>