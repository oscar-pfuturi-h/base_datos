addEventListener('load', inicializarEventos, false);

function inicializarEventos(){
	for (var i=0; i<3; i++){
		var ob=document.getElementById('li_'+i);
		ob.addEventListener('click', presionEnlace, false);
	}
}

function presionEnlace(e) {
	e.preventDefault();
	var url=e.target.getAttribute('href');
	mostrarDatos(url);
}

var conexion1;
function mostrarDatos(url){
	conexion1=new XMLHttpRequest();
	conexion1.onreadystatechange = procesarEventos;
	conexion1.open("GET", url, true);
	conexion1.send();
}

function procesarEventos(){
	var listas = document.getElementById("lists");
	if (conexion1.readyState == 4){
		listas.innerHTML = conexion1.responseText;
	} else {
		listas.innerHTML = 'Cargando...';
	}
}

