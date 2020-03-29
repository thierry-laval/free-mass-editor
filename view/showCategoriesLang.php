<?php

include_once('../model/connexion.php');
include_once('../model/setProducts.php');
include_once('../model/getCategoryList.php');
include_once('../model/ajaxLoad.php');
include_once('../model/langs.php');
include_once('../model/JSFunction.js');

?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script src="../js/jquery-3.1.0.js"></script>
<script src='../model/JQueryFunctions.js'></script>

<!-- Include the plugin's CSS and JS: -->
<link rel="stylesheet" href="../css/bootstrap-3.3.2.min.css" type="text/css"/>

<script type="text/javascript" src="../js/bootstrap-3.3.2.min.js"></script>
 
<!-- Include the plugin's CSS and JS: -->
<script type="text/javascript" src="../js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="../css/bootstrap-multiselect.css" type="text/css"/>

<script src="../js/jquery.tagsinput.js"></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.tagsinput.css" />

</head>

<body>

<?php
$lang = $_GET['lang'];
?>

<div id="allSelect" align="center">

<select id="checkBoxesCategories"  class="reload" name="categories"  multiple="multiple" >
<?php

    foreach (getCategories($lang) as $key => $value) {
        echo    '<option selected="selected" value='.$value["id"].">".$value["name"].'</option>';
    }  
?>
</select>



    <select selected="selected" id="hiddenColumns" class="menu" multiple="multiple">
    <option selected="selected" id="imgClass">Images</option>
    <option selected="selected" id="idClass">Identifiant</option>
    <option selected="selected" id="referenceClass">Référence</option>
    <option selected="selected" id="activeClass">Actif</option>
    <option selected="selected" id="nameClass">Nom</option>
    <option selected="selected" id="catPClass">Catégorie P.</option>
    <option selected="selected" id="catNPClass">Catégories N.P.</option>
    <option selected="selected" id="priceHTClass">Prix HT</option>
    <option selected="selected" id="priceTTCClass">Prix TTC</option>
    <option selected="selected" id="quantityClass">Quantité</option>
    <option selected="selected" id="weightClass">Poids</option>
    <option selected="selected" id="metaKeyWordsClass">Mots clés</option>
    <option selected="selected" id="descriptionClass">Description</option>
    <option selected="selected" id="resumeClass">Résumé</option>
    <option selected="selected" id="metaDescriptionClass">Meta Description</option>
</select>

</br>
  <input id="searchValue"  type="text" class="reload" name="search" placeholder="Recherche" value="" >
</div>






<select id="checkBoxesCategories2" name="categories" >
<?php

    foreach (getAllCategories($lang) as $key => $value) {
        echo    '<option value='.$value["id"].">".$value["name"].'</option>';
    }  
?>
</select>

</div>




</body>
</html>	