<?php 

function connect(){

	$con = mysqli_connect('localhost','root','password','database_name');
	if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
	$con->set_charset("utf8");
	return $con;
}

?>
