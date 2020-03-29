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


$result = getProductsByCat($q);

$smallImg = '../../img/p/'.$row['idImage'].'/'.$row['idImage'].'-medium_default.jpg ';

/*





            R E S E A R C H



*/
echo "TEST OK";
echo '<table align="center" id="idTabProd">
<tr bgcolor="#CCFEE1">
<th class="imgClass"  width ="5%"> Image </th>
<th class="idClass"  width="1%">ID</th>
<th class="referenceClass" width ="4%">Référence</th>
<th class="activeClass" id="activeAll"  width="1%">Actif</th>
<th class="nameClass"  width = "8%">Nom</th>
<th class="catPClass"  width = "8%">Catégories Parentes</th>
<th class="catNPClass"  width = "8%">Catégories Non Parentes</th>
<th class="priceHTClass"  width = "2%">Prix HT</th>
<th class="priceTTCClass"  width = "2%">Prix TTC</th>
<th class="quantityClass" width= "2%">Q.</th>
<th class="weightClass" width="2%">Poids</th>
<th class="metaKeyWordsClass" width ="3%" >Mots clés</th>
<th class="descriptionClass" >Description</th>
<th class="resumeClass">Résumé</th>
<th class="metaDescriptionClass">Meta Description</th>
</tr>';
$count = 1;
while($row = mysqli_fetch_array($result)) {
    extract($row);
    $smallImg = '../../img2/p/'.$idImage.'/'.$idImage.'-small_default.jpg ';
    $id = $id_product;
    $checked = ""; if ($active) $checked="checked"; //permet de modifier le html et de cocher la checkbox si le produit est actif


    $color;
    if ($count%2) $color = "#CCFFFF"; else $color = "#F0FEFF";
    echo '<tr id='.-$id.' bgcolor='.$color.'>';
    echo '<td class="imgClass"> <img width="100%"  src='.$smallImg.' /></td>';
    echo '<td class="idClass" onclick=test1() contenteditable  id="'.$id."-".ID_.'" onblur=updateDataBase(this.id,this.innerHTML,'.ID_.')>' . $id .    ' </td>';
    echo '<td class="referenceClass" contenteditable id="'.$id."_".REFERENCE_.'" onblur="updateDataBase(pid(this),this.innerHTML,'.REFERENCE_.')">' . $reference . '</td>';
    echo '<td class="activeClass"> 
        <input id="'.$id."-".ACTIVE_.'" class="activated" type="checkbox" onchange=updateDataBase(-this.parentElement.parentElement.id,this.checked,'.ACTIVE_.') '.$checked.'><br>
         </td>';

    echo '<td class="nameClass" contenteditable  id="'.$id."-".NAME_.'" onblur=updateDataBase(pid(this),this.innerHTML,'.NAME_.')>' . $nameProduct . '</td>';
    //deleteCategoryParent('.$id.','.$this.value.')
    $idCatSelec = 0;
    echo '<td class="catPClass" ><select id="A'.$id."_".CATP_.'" name="catParentes" style="width: 100%" size=4 multiple="multiple" onchange="$idCatSelec = swapCategory(A'.$id."_".CATNP_.', A'.$id."_".CATP_.');updateDataBase(-this.parentElement.parentElement.id,$idCatSelec,'.CATP_.')">';
            foreach (getCategoriesParentes($id) as $key => $value) {            
             echo "<option id=".$value["id_category"].">".$value["name"].'</option>';
        } 
    echo '</select></td>';
    echo '<td class="catNPClass" ><select id="A'.$id."_".CATNP_.'" name="catNonParentes" style="width: 100%" size=4 multiple="multiple" onchange="$idCatSelec = swapCategory(A'.$id."_".CATP_.', A'.$id."_".CATNP_.');updateDataBase(-this.parentElement.parentElement.id,$idCatSelec,'.CATNP_.')" >';
            foreach (getCategoriesNonParentes($id) as $key => $value) {            
              echo "<option id=".$value["id_category"].">".$value["name"].'</option>';
        } 
    echo '</select></td>';
    echo '<td class="priceHTClass" contenteditable id="'.$id."_".PRICEHT_.'" onblur="updateDataBase(pid(this),this.innerHTML,'.PRICEHT_.');setPriceTTC(pid(this))">' . round($price, 2) . '</td>';
    echo '<td class="priceTTCClass" contenteditable id="'.$id."_".PRICETTC_.'" onblur="updateDataBase(pid(this),(this.innerHTML)*0.833333333,'.PRICEHT_.');setPriceHT(pid(this));">' . round($price*1.2, 2) . '</td>';
    echo '<td class="quantityClass"  contenteditable id="'.$id."_".QUANTITY_.'" onblur=updateDataBase(pid(this),this.innerHTML,'.QUANTITY_.')>' . $quantity . '</td>';
    echo '<td class="weightClass"  contenteditable id="'.$id."_".WEIGHT_.'" onblur=updateDataBase(pid(this),this.innerHTML,'.WEIGHT_.')>' . round($weight, 3) . '</td>';
    echo '<td class="metaKeyWordsClass"   >';
     echo '<input class="tags" id="'.$id."-".METAKEYWORDS_.'"  value="'.$meta_keywords.'"/>';
    echo '</td>';
    echo '<td class="descriptionClass" contenteditable  id="'.$id."-".DESCRIPTION_.'" onblur=updateDataBase(pid(this),this.innerHTML,'.DESCRIPTION_.')>' . $description. '</td>';
    echo '<td class="resumeClass" contenteditable  id="'.$id."-".RESUME_.'" onblur=updateDataBase(pid(this),this.innerHTML,'.RESUME_.')>' . $description_short. '</td>';
    echo '<td class="metaDescriptionClass" contenteditable  id="'.$id."-".METADESCRIPTION_.'" onblur=updateDataBase(pid(this),this.innerHTML,'.METADESCRIPTION_.')>' . $meta_description. '</td>';
    echo "</tr>";

    $count++;
    
}





echo "</table>";





mysqli_close($con);
?>




</body>
</html>