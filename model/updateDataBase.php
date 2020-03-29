<?php
include_once('../model/defines.php');
include_once('../model/connexion.php');	
$con = connect();



function updateName($idProduct, $name, $lang){
	global $con;

	mysqli_query($con,
		'UPDATE ps_product_lang
		SET name = "'.$name.'"
		WHERE id_product = '.$idProduct.' AND id_lang = '.$lang);

}

function updatePrice($idProduct, $price){
	global $con;
	mysqli_query($con, 
		'UPDATE ps_product_shop
		SET price = '.$price.'
		WHERE id_product = '.$idProduct
		);
}

function updateQuantity($idProduct, $quantity){
	global $con;
	mysqli_query($con,
		'UPDATE ps_stock_available
		SET quantity = '.$quantity.'
		WHERE id_product = '.$idProduct
		);
}

function updateResume($idProduct, $resume, $lang){
	global $con;
	mysqli_query($con,
		'UPDATE ps_product_lang
		SET description_short = "'.$resume.'"	
		WHERE id_product = '.$idProduct.' AND id_lang = '.$lang
		);
}

function addCategoryParent($idProduct, $idCategory){
	global $con;
	mysqli_query($con,
		'INSERT INTO ps_category_product VALUES ('.$idCategory.', '.$idProduct.', 0)'
		);
}


function deleteCategoryParent($idProduct, $idCategory){
	global $con;
	mysqli_query($con,
		'DELETE FROM ps_category_product WHERE id_category = '.$idCategory.' AND id_product = '.$idProduct
		);
}


function setActiveProduct($idProduct, $isActive){
	global $con;
	$bool = 1;
	if($isActive == "false") 
	$bool = 0;


	mysqli_query($con,
		'UPDATE ps_product_shop
		SET active = '.$bool.'
		WHERE id_product = '.$idProduct
		);

	mysqli_query($con,
		'UPDATE ps_product
		SET active = '.$bool.'
		WHERE id_product = '.$idProduct
		);
}

function setMetaKeyWords($idProduct, $keywords, $lang){
	global $con;
	mysqli_query($con, 
		'UPDATE ps_product_lang
		SET meta_keywords = "'.$keywords.'"
		WHERE id_product = '.$idProduct.' AND id_lang = '.$lang
		);
}

function updateWeight($idProduct, $weight){
	global $con;
	mysqli_query($con,
		'UPDATE ps_product
		SET weight = '.$weight.'
		WHERE id_product = '.$idProduct
		);
}

function updateReference($idProduct, $reference){
	global $con;
	mysqli_query($con,
		'UPDATE ps_product
		SET reference = "'.$reference.'"
		WHERE id_product = '.$idProduct
		);
}

function updateMetaDescription($idProduct, $metaDescription, $lang){
		global $con;
	mysqli_query($con,
		'UPDATE ps_product_lang
		SET meta_description = "'.$metaDescription.'"
		WHERE id_product = '.$idProduct.' AND id_lang = '.$lang
		);
}

function updateDescription($idProduct, $description, $lang){
	global $con;
	mysqli_query($con,
		'UPDATE ps_product_lang
		SET description = "'.$description.'"
		WHERE id_product = '.$idProduct.' AND id_lang = '.$lang
		);
}




function updateDataBase($idProduct, $content, $column, $lang){

		$columEdit = -1;

		switch ($column){
			case 0 :
				updateAllCategories($idProduct, $content);
			break;
			case NAME_ :
				updateName($idProduct, $content, $lang);	
			case ACTIVE_:
				setActiveProduct($idProduct, $content);
			break;
			case PRICEHT_ :
				updatePrice($idProduct, $content);
			break;
			case QUANTITY_ :
				updateQuantity($idProduct, $content);
			break;
			case RESUME_ :
				updateResume($idProduct, $content, $lang);
			break;
			case CATP_:
				deleteCategoryParent($idProduct, $content);
			break;
			case CATNP_:
				addCategoryParent($idProduct, $content);
			break;
			case METAKEYWORDS_:
				setMetaKeyWords($idProduct, $content, $lang);
			break;
			case WEIGHT_ :
				updateWeight($idProduct,$content);
			break;
			case REFERENCE_ :
				updateReference($idProduct,$content);
			break;
			case METADESCRIPTION_ :
				updateMetaDescription($idProduct, $content, $lang);
			break;
			case DESCRIPTION_ :
				updateDescription($idProduct, $content, $lang);
			break;


		}


		
}




updateDataBase($_GET['id'], $_GET['content'], $_GET['column'], $_GET['lang']);



?>