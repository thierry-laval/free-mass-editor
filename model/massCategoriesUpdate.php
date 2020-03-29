<?php

include_once('../model/connexion.php');	




/*

function massCategoriesUpdate($tabIdProducts, $idCategory){
$tabIdProducts = explode(",",$tabIdProducts);
$multiSelect = "";
for($i=0; $i<(count($tabIdProducts)); $i++){
	$multiSelect = $multiSelect.'('.$idCategory.', '.$tabIdProducts[$i].', 0),';
}
$multiSelect = substr_replace($multiSelect, "", -1, 1);


echo $multiSelect;


$con = connect();
mysqli_query($con,
		'INSERT INTO ps_category_product VALUES '.$multiSelect);

}
*/

function massCategoriesUpdate($tabIdProducts, $idCategory){

$tabIdProducts = explode(",",$tabIdProducts);
$multiSelect = "";
for($i=0; $i<(count($tabIdProducts)); $i++){
	$multiSelect = $multiSelect.'('.$idCategory.', '.$tabIdProducts[$i].', 0),';
}
$multiSelect = substr_replace($multiSelect, "", -1, 1);


$con = connect();
mysqli_query($con, 'INSERT IGNORE INTO ps_category_product VALUES '.$multiSelect);
}


massCategoriesUpdate($_GET["tabId"], $_GET["cat"]);




?>