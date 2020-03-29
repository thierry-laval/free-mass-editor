<?php



function getProductsByCatAndSearch($q, $search, $order, $lang){
    $con = connect();
    $cat = explode(",",$q);

    $multiSelect = "";
    for($i=0; $i<count($cat); $i++){
        $multiSelect = $multiSelect.' id_category = "'.$cat[$i].'" OR';
    }
    $multiSelect = substr_replace($multiSelect, "", -3, 3);

    return  mysqli_query($con,
            'SELECT DISTINCT ps_product_lang.id_product, ps_product_lang.name AS nameProduct, ps_product.active, ps_product_lang.description, description_short, ps_product_lang.link_rewrite,
             ps_product_lang.meta_description, ps_product_lang.meta_keywords, ps_product_shop.price, ps_stock_available.quantity as quantity, ps_image.id_image as idImage, ps_product_lang.meta_keywords as meta_keywords,
             ps_product.weight as weight, ps_product.reference as reference, ps_product_lang.meta_description as meta_description, ps_product_lang.description as description
            FROM ps_product_lang 
            INNER JOIN ps_product_shop ON ps_product_shop.id_product = ps_product_lang.id_product
            INNER JOIN ps_stock_available ON ps_stock_available.id_product = ps_product_lang.id_product 
            INNER JOIN ps_image ON ps_image.id_product = ps_product_shop.id_product
            INNER JOIN ps_category_product ON ps_category_product.id_product = ps_product_lang.id_product
            INNER JOIN ps_product ON ps_product.id_product = ps_product_lang.id_product
            WHERE id_lang = '.$lang.' AND cover = 1 AND ps_product_shop.id_shop = 1 AND ps_stock_available.id_shop = 1
            AND ps_product_lang.id_shop = 1 AND ps_product_lang.name LIKE "%'.$search.'%"AND ('.$multiSelect.') 
            ORDER BY '.$order);
            

}






/*function getProductsFromCategory($id_category){
	try{$bdd = new PDO('mysql:host=localhost;dbname=prestashop;charset=utf8', 'root', 'root');}catch(Exception $e){die('Erreur : '.$e->getMessage());}

	$req = $bdd->prepare(
		'SELECT ps_category_product.id_product as idProduct, ps_product_lang.name as name
		FROM ps_category_product
		INNER JOIN ps_product_lang ON ps_category_product.id_product = ps_product_lang.id_product
		WHERE id_category= :id_category
 

			');



		$req->bindParam(':id_category', $id_category, PDO::PARAM_INT);
		$req->execute();
		$products = $req->fetchAll();
		return $products;
}



function getProductsByCat($q){
$con = connect();

$cat = explode(",",$q);


$multiSelect = "";
for($i=0; $i<count($cat); $i++){
$multiSelect = $multiSelect.' id_category = "'.$cat[$i].'" OR';
}
$multiSelect = substr_replace($multiSelect, "", -3, 3);
//echo $multiSelect;



	return  mysqli_query($con,
		'SELECT DISTINCT ps_product_lang.id_product, ps_product_lang.name AS nameProduct, ps_product.active, ps_product_lang.description, description_short, ps_product_lang.link_rewrite,
		 ps_product_lang.meta_description, ps_product_lang.meta_keywords, ps_product_shop.price, ps_stock_available.quantity as quantity, ps_image.id_image as idImage, ps_product_lang.meta_keywords as meta_keywords,
		 ps_product.weight as weight, ps_product.reference as reference, ps_product_lang.meta_description as meta_description, ps_product_lang.description as description
        FROM ps_product_lang 
        INNER JOIN ps_product_shop ON ps_product_shop.id_product = ps_product_lang.id_product
        INNER JOIN ps_stock_available ON ps_stock_available.id_product = ps_product_lang.id_product 
        INNER JOIN ps_image ON ps_image.id_product = ps_product_shop.id_product
        INNER JOIN ps_category_product ON ps_category_product.id_product = ps_product_lang.id_product
        INNER JOIN ps_product ON ps_product.id_product = ps_product_lang.id_product
        WHERE cover = 1 AND ps_product_lang.id_lang  = 1 AND ps_product_shop.id_shop = 1 AND ps_stock_available.id_shop = 1
        AND ps_product_lang.id_shop = 1 AND ('.$multiSelect.') 
        ORDER BY id_product
       ');

}




function getIdProductsByCatAndSearch($q, $search){
$con = connect();

$cat = explode(",",$q);


$multiSelect = "";
for($i=0; $i<count($cat); $i++){
$multiSelect = $multiSelect.' id_category = "'.$cat[$i].'" OR';
}
$multiSelect = substr_replace($multiSelect, "", -3, 3);
//echo $multiSelect;



	return  mysqli_query($con,
		'SELECT DISTINCT ps_product_lang.id_product as id_product
        FROM ps_product_lang 
        INNER JOIN ps_product_shop ON ps_product_shop.id_product = ps_product_lang.id_product
        INNER JOIN ps_stock_available ON ps_stock_available.id_product = ps_product_lang.id_product 
        INNER JOIN ps_image ON ps_image.id_product = ps_product_shop.id_product
        INNER JOIN ps_category_product ON ps_category_product.id_product = ps_product_lang.id_product
        INNER JOIN ps_product ON ps_product.id_product = ps_product_lang.id_product
        WHERE cover = 1 AND ps_product_lang.id_lang  = 1 AND ps_product_shop.id_shop = 1 AND ps_stock_available.id_shop = 1
        AND ps_product_lang.id_shop = 1 AND ps_product_lang.name LIKE "%'.$search.'%"AND ('.$multiSelect.') 
        ORDER BY id_product
       ');

}

function getIdProductsListByCatAndSearch($q, $search){
	$r = getIdProductsByCatAndSearch($q, $search);
	$list = "";
	while($row = mysqli_fetch_array($r)){
   		 $list = $list.",".$row['id_product'];
	}
	return $list;

}

function massCategoriesUpdate111($tabIdProducts, $idCategory){
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
?>

