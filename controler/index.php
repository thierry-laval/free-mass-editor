<?php
    include_once('../model/connexion.php');
    include_once('../model/setProducts.php');
    include_once('../model/getCategoryList.php');
    include_once('../model/langs.php');
    include_once('../model/JSFunction.js');
    include_once('../model/ajaxLoad.php');
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

    <style>
    </style>


<body style="background-color:#CCFFEF">

<div align="center"  style="margin:10 auto;width:200px;height:190px;border:2px solid #999999; padding:10px">

    <select id="lang"  name="Langues" >
        <?php
            foreach (getLangs() as $key => $value) {
                echo    "<option value=".$value["id_lang"].">".$value["iso_code"].'</option>';
            }
        ?>
    </select>


    <div id="categoriesGrid"></div>

</div>

<div id="productsGrid"></div>






</body>
</html>

