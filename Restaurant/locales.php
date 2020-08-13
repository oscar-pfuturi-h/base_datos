<?php 
include('conexion.php');
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Locales</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/estilos2.css">
	<link rel="stylesheet" type="text/css" href="css/locales.css">
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
	<!--<div id="body">
		<div id="subtitulo">
			<h2>Locales</h2>
		</div>
		<div id="msg1">
			<span>Visitanos en nuestros cuatro locales <br>distribuidas estratégicamente en la ciudad de Arequipa</span>
		</div>
		<div id="imagen">
			<figure>
				<img src="img/fondo4.jpg" alt="Fondo para el subtitulo">
			</figure>
		</div>
	</div> -->
	<div id="info">
		<?php
		$qry1="SELECT direccion, distrito, provincia, referencia, hora_abierto, hora_cerrado, mapa FROM sucursal;";
		$res = $db_connection->query($qry1);
		while ($filas = $res->fetch_assoc()){
			$direccion = $filas['direccion'];
			$distrito = $filas['distrito'];
			$provincia = $filas['provincia'];
			$referencia = $filas['referencia'];
			$hora_abierto = $filas['hora_abierto'];
			$hora_cerrado = $filas['hora_cerrado'];
		?>
		<div class="dir d1">
			<h3><?php echo $direccion; ?></h3><!--Mercaderes, Mariano Melgar, ... -->
			<p><?php echo $direccion; ?></p>
			<p><?php echo $distrito; ?></p>
			<p><?php echo $provincia; ?></p>
			<span>Referencia:</span>
			<p><?php echo $referencia; ?></p>
			<span>Horario de atención:</span>
			<p><?php echo $hora_abierto . " - " . $hora_cerrado; ?></p>
		</div>
		<div class="mapa">
			<figure>
				<img src="<?php echo $filas['mapa']; ?>" alt="Mapa de la ubicación" style="width: 100%; height: 250px;">
			</figure>
		</div>
		<?php 
		} 
		?>
	</div>
</div>
</body>
</html>