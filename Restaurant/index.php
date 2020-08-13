<?php
include('conexion.php');
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Misti Gourmet</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/estilos2.css">
	<style type="text/css">
		#inicio{
			display: inline-block;
			width: 80%;
			margin: 0px 10%;
		}
	</style>
</head>
<body>
<div id="content">
	<div id="header">
		<header>
			<div id="titulo">
				<h1>Misti Gourmet</h1>
			</div>
			<div id="banner">
				<figure>
					<img src="img/banner4.jpg" alt="Banner de la página" style="width: 100%; height: 250px; float: left;">
				</figure>
			</div>
		</header>
	</div>
	<div id="nav">
		<?php $flag = 0; include('login_block.php'); ?>
		
		<nav>
			<ul id="links">
				<li><a href="index.php"><span>Inicio</span></a></li>
				<li><a href="locales.php"><span>Locales</span></a></li>
				<li><a href="reservas.php"><span>Reservaciones</span></a></li>
				<li><a href="carta.php"><span>Carta</span></a></li>
				<li><a style="border-right: 3px solid #fff;" href="contacto.php"><span>Contacto</span></a></li>
			</ul>
		</nav>
		<?php 
		if ($flag == 1){
		?>
		<div id='logout'>
			<button type='button' name='out_btn' id='out_btn' onclick="window.location.href='logout.php';">Cerrar sesión</button>
		</div>
		<?php 
		}
		?>
	</div>
	<div id="inicio">
		<figure>
			<img src="img/banner2.jpg" alt="Banner presentación" style="width: 100%; height: 450px; float: left;">
		</figure>
	</div>
	<div id="footer">
		<footer>
			<span>Todos los Derechos Reservados 2020 &copy; - Misti Gourmet</span>
		</footer>
	</div>
</div>
</body>
</html>