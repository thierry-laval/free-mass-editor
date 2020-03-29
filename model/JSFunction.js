
<script>


function setPriceTTC(idProd){
	document.getElementById(idProd+"_6").innerHTML = (document.getElementById(idProd+"_3").innerHTML*1.2).toFixed(2);
}

function setPriceHT(idProd){
	document.getElementById(idProd+"_3").innerHTML = (document.getElementById(idProd+"_6").innerHTML*(1/1.2)).toFixed(2);
}

function pid(element){ // return the parent id.
	return -element.parentElement.id;
}


function getIdCat(liste){
	return liste.options[liste.selectedIndex].id
}

/*
function checkAll(){ //cocher ou décocher toutes les checkbox des produits actifs.
	var checkboxes = document.getElementsByClassName("activated");
	var bool = false;
	if(checkboxes[0].checked==false)
	bool = true;



	for(i =0; i<checkboxes.length; i++){
			
		checkboxes[i].checked = bool;
		checkboxes[i].onchange();
	}
}
*/


function hideColumn(className){
	var classElements = document.getElementsByClassName(className);
	for(i=0; i<classElements.length; i++){
		classElements[i].style.display = 'none';
		
	}
}

function showColumn(className){
	var classElements = document.getElementsByClassName(className);
	for(i=0; i<classElements.length; i++){
		classElements[i].style.display = 'table-cell';
		
	}
}

function swapCategory(listeA, listeB) {
	var elem = document.createElement("option");
	var index = listeB.selectedIndex;
	elem.text = listeB.options[index].text;
	elem.id = listeB.options[index].id;

	id = getIdCat(listeB);

	listeA.add(elem);
	listeB.remove(listeB.selectedIndex);

	return id;
}



	




</script>




