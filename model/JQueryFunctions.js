$(document).ready(function(){

  $('#lang').multiselect({
    buttonText: function(options, select) {
                return 'Langue';
            },
  });

  $('#lang').change(function(){
     showCategoriesLang($(this).val());
  });

  $('#lang').trigger("change");

});





function selectAll(){
  $(".imgClass").dblclick(function(){
    $(".imgClass").parent().css("background-color", "#ABCDEA");
    $("#menuBar").css("background-color", "#CCFEE1");
  });
}

function select(){
  $(".imgClass").click(function(){
 
    if($(this).parent().css("background-color") == "rgb(255, 225, 110)"){
        $(this).parent().css("background-color", "#ABCDEA");
      }
    else if($(this).parent().css("background-color") == "rgb(171, 205, 234)"){
        $(this).parent().css("background-color", "#CCFFFF");
      }

      if($(this).parent().css("background-color") == "rgb(255, 225, 111)"){
        $(this).parent().css("background-color", "#ABCDEB");
      }
    else if($(this).parent().css("background-color") == "rgb(171, 205, 235)"){
        $(this).parent().css("background-color", "#F0FEFF");
      }

     // alert($(this).parent().css("background-color"));

  });
}

function select2(){
  $(".imgClass").parent().mouseover(function(){
 
    if($(this).css("background-color") == "rgb(204, 255, 255)"){
        $(this).css("background-color", "#FFE16E");
      }
    else if($(this).css("background-color") == "rgb(240, 254, 255)"){
        $(this).css("background-color", "#FFE16F");
      }


  });
}

function unselect(){
  $(".imgClass").parent().mouseout(function(){
 
    if($(this).css("background-color") == "rgb(255, 225, 110)"){
        $(this).css("background-color", "CCFFFF");
      }
    else if($(this).css("background-color") == "rgb(255, 225, 111)"){
        $(this).css("background-color", "#F0FEFF");
      }

  });
}

function reload(){
  $(".reloadSort").click(function(){
   showListProductFromSelectedCategory($("select#checkBoxesCategories").val(),$("#searchValue").val(), $(this).attr("name"));
   $(this).css("background-color", "ABCDD1");
  });
}


function initMultiSelect(){
            $('#checkBoxesCategories').multiselect({
                includeSelectAllOption: true,
                buttonText: function(options, select) {
                  return 'Catégories';
                },
                enableFiltering: true,
                filterPlaceholder: 'Rechercher',
                includeSelectAllOption: true
             });

            
            
            $('#checkBoxesCategories2').multiselect({
                buttonText: function(options, select) {
                  return 'Catégories';
                },
                enableFiltering: true,
            });


            $('#hiddenColumns').multiselect({
                onChange: function(option, checked, select) {
                if($(option).is(":checked")){
                   showColumn($(option).attr('id'));
                   alert($(option).attr('id'));
                }
                else{
                   hideColumn($(option).attr('id'))
                }
              },

                buttonText: function(options, select) {
                    return 'Colonnes';
              }
           });

          $("#checkBoxesCategories2").change(function(){
            var idCategories = "";

            $('tr').each(function() {
              if (typeof $(this).attr("id") != 'undefined')
                if($(this).css("background-color") == "rgb(171, 205, 234)" || $(this).css("background-color") == "rgb(171, 205, 235)" ){
                  idCategories += ($(this).attr("id")).substr(1)+",";
                }
            });

              idCategories = idCategories.substr(0, idCategories.length-1);
              massCategoriesUpdate(idCategories,$(this).val());
              showListProductFromSelectedCategory($("select#checkBoxesCategories").val(),($("#searchValue").val()), $("#lang").val(), "id_product");

          });


            $(".reload").change(function(){
                showListProductFromSelectedCategory($("select#checkBoxesCategories").val(),$("#searchValue").val(), $("#lang").val(), "id_product");
            });

          
}
  


