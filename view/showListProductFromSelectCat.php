<!DOCTYPE html>
<?php
include_once('../model/selectProducts.php');
include_once('../model/getCategoryList.php');
include_once('../model/defines.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


</head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 2px solid black;
    padding: 5px;
}

td{
    font-size: 10px;
    font-family: "Trebuchet MS";
}

th {
    text-align: left;
    font-size: 13px;
    font-family: "Trebuchet MS";

}


.tags { 
    margin:100; 
    padding:100; 
    position:absolute; 
    right:240px; 
    bottom:-12px; 
    list-style:none; 
}

table {
    margin: 10px;

}




</style>

<body>

<?php

$q = $_GET['q'];
$search = $_GET['search'];
$order = $_GET['order'];
$lang = $_GET['lang'];

$result = getProductsByCatAndSearch($q,$search,$order, $lang    );

$allCurrentId = array();



echo '<table align="center" padding="10cm">
<tr id="menuBar" bgcolor="#CCFEE1">
<th class="imgClass"  width ="5%"> Image </th>
<th class="idClass" name="id_product"   width="1%">ID</th>
<th class="referenceClass" width ="4%">Référence</th>
<th class="activeClass" name="active" width="1%">Actif</th>
<th class="nameClass" name="name"  width = "8%">Nom</th>
<th class="catPClass"  width = "10%">Catégories Parentes</th>
<th class="catNPClass"  width = "10%">Catégories Non Parentes</th>
<th class="priceHTClass" name="price"  width = "2%">Prix HT</th>
<th class="priceTTCClass" name="price"  width = "2%">Prix TTC</th>
<th class="quantityClass" name="quantity" width= "2%">Q.</th>
<th class="weightClass" name="weight" width="2%">Poids</th>
<th class="metaKeyWordsClass" width ="3%" >Mots clés</th>
<th class="descriptionClass" >Description</th>
<th class="resumeClass">Résumé</th>
<th class="metaDescriptionClass">Meta Description</th>
</tr>';
$count = 1;




while($row = mysqli_fetch_array($result)) {
    extract($row);
    $smallImg = '../../img/p'.$idImage.'/'.$idImage.'-medium_default.jpg ';
    $path = "";
        for($i = 0; $i <= strlen($idImage); $i++){
            $path  = $path."/".$idImage{$i};
        }
   // $smallImg = '../../img/p'.$path.$idImage.'-medium_default.jpg';
    $id = $id_product;  
    $checked = ""; if ($active) $checked="checked"; //permet de modifier le html et de cocher la checkbox si le produit est actif
    $allCurrentId[] = $id;


    $color;
    if ($count%2) $color = "#CCFFFF"; else $color = "#F0FEFF";
    echo '<tr id='.-$id.' class="identifiant"  bgcolor='.$color.'>';
    echo '<td class="imgClass"> <img width="100%"  src='.$smallImg.' /></td>';
    echo '<td class="idClass" id="'.$id."-".ID_.'" onblur=updateDataBase(this.id,this.innerHTML,'.ID_.','.$lang.')>' . $id .    ' </td>';
    echo '<td class="referenceClass" contenteditable id="'.$id."_".REFERENCE_.'" onblur="updateDataBase(pid(this),this.innerHTML,'.REFERENCE_.','.$lang.')">' . $reference . '</td>';
    echo '<td class="activeClass"> 
        <input id="'.$id."-".ACTIVE_.'" class="activated" type="checkbox" onchange=updateDataBase(-this.parentElement.parentElement.id,this.checked,'.ACTIVE_.','.$lang.') '.$checked.'><br>
         </td>';

    echo '<td class="nameClass" contenteditable  id="'.$id."-".NAME_.'" onblur=updateDataBase(pid(this),this.innerHTML,'.NAME_.','.$lang.')>' . $nameProduct . '</td>';
    //deleteCategoryParent('.$id.','.$this.value.')
    $idCatSelec = 0;
    echo '<td class="catPClass" ><select id="A'.$id."_".CATP_.'" name="catParentes" style="width: 100%" size=4 multiple="multiple" onchange="$idCatSelec = swapCategory(A'.$id."_".CATNP_.', A'.$id."_".CATP_.');updateDataBase(-this.parentElement.parentElement.id,$idCatSelec,'.CATP_.','.$lang.')">';
            foreach (getCategoriesParentes($id, $lang) as $key => $value) {            
             echo "<option id=".$value["id_category"].">".$value["name"].'</option>';
        } 
    echo '</select></td>';
    echo '<td class="catNPClass" ><select id="A'.$id."_".CATNP_.'" name="catNonParentes" style="width: 100%" size=4 multiple="multiple" onchange="$idCatSelec = swapCategory(A'.$id."_".CATP_.', A'.$id."_".CATNP_.');updateDataBase(-this.parentElement.parentElement.id,$idCatSelec,'.CATNP_.','.$lang.')" >';
            foreach (getCategoriesNonParentes($id, $lang) as $key => $value) {            
              echo "<option id=".$value["id_category"].">".$value["name"].'</option>';
        } 
    echo '</select></td>';
    echo '<td class="priceHTClass" contenteditable id="'.$id."_".PRICEHT_.'" onblur="updateDataBase(pid(this),this.innerHTML,'.PRICEHT_.','.$lang.');setPriceTTC(pid(this))">' . round($price, 2) . '</td>';
    echo '<td class="priceTTCClass" contenteditable id="'.$id."_".PRICETTC_.'" onblur="updateDataBase(pid(this),(this.innerHTML)*0.833333333,'.PRICEHT_.','.$lang.');setPriceHT(pid(this));">' . round($price*1.2, 2) . '</td>';
    echo '<td class="quantityClass"  contenteditable id="'.$id."_".QUANTITY_.'" onblur=updateDataBase(pid(this),this.innerHTML,'.QUANTITY_.','.$lang.')>' . $quantity . '</td>';
    echo '<td class="weightClass"  contenteditable id="'.$id."_".WEIGHT_.'" onblur=updateDataBase(pid(this),this.innerHTML,'.WEIGHT_.','.$lang.')>' . round($weight, 3) . '</td>';
    echo '<td class="metaKeyWordsClass"   onchange=updateDataBase(pid(this),"showListProductFromSelectCat.L134",'.METAKEYWORDS_.','.$lang.') >' ;
    echo '<input class="tags" id="'.$id."-".METAKEYWORDS_.'"   value="'.$meta_keywords.'"/>';
    echo '</td>';
    echo '<td class="descriptionClass" contenteditable  id="'.$id."-".DESCRIPTION_.'" onblur=updateDataBase(pid(this),this.innerHTML,'.DESCRIPTION_.','.$lang.')>' . $description. '</td>';
    echo '<td class="resumeClass" contenteditable  id="'.$id."-".RESUME_.'" onblur=updateDataBase(pid(this),this.innerHTML,'.RESUME_.','.$lang.')>' . $description_short. '</td>';
    echo '<td class="metaDescriptionClass" contenteditable  id="'.$id."-".METADESCRIPTION_.'" onblur=updateDataBase(pid(this),this.innerHTML,'.METADESCRIPTION_.','.$lang.')>' . $meta_description. '</td>';
    echo "</tr>";

    $count++;
    
}

echo "</table>";



mysqli_close($con);

?>



</body>
</html>