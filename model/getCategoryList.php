<?php
include_once('../model/connexion.php');
$con = connect();



function getCategories($id_lang){
		global  $con;

	return  mysqli_query($con,
		'SELECT DISTINCT ps_category_product.id_category as id, ps_category_lang.name as name, id_lang
		FROM ps_category_product
		INNER JOIN ps_category_lang ON ps_category_product.id_category = 		ps_category_lang.id_category 
        WHERE id_lang = '.$id_lang);
}

function getAllCategories($id_lang){
		global  $con;
	return mysqli_query($con, 
		'SELECT DISTINCT name, id_category as id
		FROM ps_category_lang
		WHERE id_lang = '.$id_lang
		);
}




	function getCategoriesParentes($id_product, $id_lang){
		global  $con;

		return mysqli_query($con, 'SELECT DISTINCT ps_category_product.id_category as id_category, ps_category_lang.name as name
			FROM ps_category_product
			INNER JOIN ps_category_lang ON ps_category_product.id_category = ps_category_lang.id_category
			WHERE id_product = '. $id_product .' AND id_lang = '. $id_lang);
	}



	function getIdCategoriesParentes($id_product, $id_lang){
		
	global $con;


		
			return mysqli_query($con, 'SELECT DISTINCT ps_category_product.id_category as id_category
			FROM ps_category_product
			INNER JOIN ps_category_lang ON ps_category_product.id_category = ps_category_lang.id_category
			WHERE id_product = '.$id_product .' AND id_lang = '. $id_lang);
	
	}


		function getCategoriesNonParentes($id_product, $id_lang){
		global $con;

		return mysqli_query($con,
			'SELECT DISTINCT id_category, name FROM ps_category_lang
			WHERE id_category NOT IN
(			SELECT ps_category_product.id_category
			FROM ps_category_product
			WHERE id_product = '.$id_product.
 ') AND id_lang = '. $id_lang);
	}


?>