<?php
include_once('../model/connexion.php');
$con = connect();

function getLangs(){
	global $con;
return mysqli_query($con, 
		'SELECT id_lang, iso_code FROM ps_lang ORDER BY id_lang'
		);


}


?>