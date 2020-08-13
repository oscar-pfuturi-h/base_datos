addEventListener('load', initializeEvent, false);
function initializeEvent(){
		var ob=document.getElementById('add_p');
		ob.addEventListener('click', pressLink, false);
		
}

function pressLink(e) {
	e.preventDefault();
	var url=e.target.getAttribute('href');
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
	var formulario = document.getElementById("form");
	if (conexion2.readyState == 4){
		formulario.innerHTML = conexion2.responseText;
	} else {
		formulario.innerHTML = 'Cargando...';
	}
}