addEventListener('load', inicializarEventos, false);

function inicializarEventos(){
	var f = ['platos', 'postres', 'bebidas'];
	for (var i=0; i<3; i++){
		var ob=document.getElementById('cat_'+f[i]);
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
	var detalles = document.getElementById("prods");
	if (conexion1.readyState == 4){
		detalles.innerHTML = conexion1.responseText;
	} else {
		detalles.innerHTML = 'Cargando...';
	}
}