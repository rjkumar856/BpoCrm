<?php
include '../include/db.php';
$reg_user = new USER1();
if($_POST['id'])
{
	$id=$_POST['id'];
	
	$city = $reg_user->runQuery("SELECT * FROM city WHERE state_id=:id");
	$city->execute(array(':id' => $id));
	?><option selected="selected">Select Your City</option>
	<?php while($row=$city->fetch(PDO::FETCH_ASSOC))
	{
		?>
		<option value="<?php echo $row['city_id']; ?>"><?php echo $row['city_name']; ?></option>
		<?php
	}
}
?>