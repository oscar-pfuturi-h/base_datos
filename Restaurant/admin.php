<?php 
include('conexion.php');
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admins - Misti Gourmet</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilos4.css">
	<link rel="stylesheet" type="text/css" href="css/estilos5.css">
	<link rel="stylesheet" type="text/css" href="css/clientes.css">
	<link rel="stylesheet" type="text/css" href="css/productos.css">
	<link rel="stylesheet" type="text/css" href="css/empleados.css">

	<script src="js/listas_ajax.js"></script>
</head>
<body>
<div id="content">
	<nav>
		<div id="info">
			<div id="name">
				<span>Administrador:</span>
				<p><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidos']; ?></p>
			</div>
		</div>

		<div id="buttons">
			<div class="b clients">
				<a class="look c" id="li_0" href="listas.php?code=0">Clientes</a>
			</div>
			<div class="b products">
				<a class="look p" id="li_1" href="listas.php?code=1">Productos</a>
			</div>
			<div class="b admins">
				<a class="look a" id="li_2" href="listas.php?code=2">Empleados</a>
			</div>
			<div id="logout">
				<a id="out" href="logout.php"><span>Cerrar Sesión</span></a>
			</div>
		</div>

		<div id="lists">
			<!-- listas de elementos -->
		</div>
	</nav>
</div>
</body>
</html>