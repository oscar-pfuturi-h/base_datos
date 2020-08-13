addEventListener('load', initializeEvent, false);

function initializeEvent(){
	for (var i=1; i<11; i++){
		var ob=document.getElementById('prod_'+i);
		ob.addEventListener('click', pressLink, false);
	}
}

function pressLink(e) {
	e.preventDefault();
	var url=e.target.getAttribute('href');
	alert('tudo bem');
	showData(url);
}

var conexion2;
function showData(url){
	conexion2=new XMLHttpRequest();
	conexion2.onreadystatechange = processEvent;
	conexion2.open("GET", url, true);
	conexion2.send();
}

function processEvent(){
	var pedidos = document.getElementById("pedidos");
	if (conexion2.readyState == 4){
		pedidos.innerHTML = conexion2.responseText;
	} else {
		pedidos.innerHTML = 'Cargando...';
	}
}