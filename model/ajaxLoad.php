<script>

function showCategoriesLang(lang){
          if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
          } 
          else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
          }
          xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("categoriesGrid").innerHTML = xmlhttp.responseText;

          initMultiSelect();
          showListProductFromSelectedCategory($("select#checkBoxesCategories").val(),$("#searchValue").val(), $("#lang").val(), "id_product");

          }

        };

          xmlhttp.open("GET","../view/showCategoriesLang.php?lang="+lang,true);
          xmlhttp.send();

}


        
function showListProductFromSelectedCategory(str, search, lang, order) {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("productsGrid").innerHTML = xmlhttp.responseText;
             $('.tags').tagsInput({
               'height':'50px',
               'width':' 200px',
                'onAddTag':  function() { updateDataBase(-$(this).parent().parent().attr('id'),$(this).val(),10); },
               'onRemoveTag': function() { updateDataBase(-$(this).parent().parent().attr('id'),$(this).val(),10); },
               'interactive':true,
               'defaultText':'Ajouter',
               'removeWithBackspace' : true,
               'minChars' : 0,
               'maxChars' : 0, // if not provided there is no limit
               'placeholderColor' : '#777777'
            });

             select();
             select2();
             reload();
             unselect();
             selectAll();




            }
        };

        xmlhttp.open("GET","../view/showListProductFromSelectCat.php?q="+str+"&search="+search+"&lang="+lang+"&order="+order,true);
        xmlhttp.send();
}


function updateDataBase(id, content, column, lang){

        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
      

        xmlhttp.open("GET","../model/updateDataBase.php?id="+id+"&content="+content+"&column="+column+"&lang="+lang,true);
        xmlhttp.send();
  
}




function massCategoriesUpdate(tabId, category){
        if (tabId == "" || category == "") {
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
      

        xmlhttp.open("GET","../model/massCategoriesUpdate.php?tabId="+tabId+"&cat="+category,true);
        xmlhttp.send();
    }
}








</script>
