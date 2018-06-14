<?php
	echo "string";
header('Content-Type: application/json');

$con = mysqli_connect("localhost","demo_users","D-cku%OGoG&s","demo_bpo");

// Check connection
if (mysqli_connect_errno($con))
{
    echo "Failed to connect to DataBase: " . mysqli_connect_error();
}else
{
	echo "string";
    $data_points = array();
    
    $result = mysqli_query($con, "SELECT * FROM lead_allocation ");
    
    while($row = mysqli_fetch_array($result))
    {        
        echo $point = array("label" => $row['user_id'] , "y" => $row['id']);
        
        array_push($data_points, $point);        
    }
    
    echo json_encode($data_points, JSON_NUMERIC_CHECK);
}
mysqli_close($con);

?>