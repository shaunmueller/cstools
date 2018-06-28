window.onload = init;

function init(){
	var Order = document.getElementById("orderForm");  
	document.getElementById("preBuiltForm").style.display="none";
	document.getElementById("buildForm").style.display="none";	
	Order.onclick = RadioChange;
}

function RadioChange(){
	if (document.getElementById("preBuilt").checked){
		document.getElementById("preBuiltForm").style.display="initial";
		document.getElementById("buildForm").style.display="none";
	}
	else if (document.getElementById("build").checked){
		document.getElementById("preBuiltForm").style.display="none";
		document.getElementById("buildForm").style.display="initial";
	}
}