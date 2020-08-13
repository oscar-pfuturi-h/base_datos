<?php 
include('conexion.php');
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Contacto</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/estilos2.css">
	<link rel="stylesheet" type="text/css" href="css/contacto.css">
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
					<li><a style="border-right: 3px solid #fff;" href="contacto.html"><span>Contacto</span></a></li>
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

		<div id="info">
			<div id="office">
				<h2>Oficinas administrativas</h2>
				<p>Misti Gourmet</p>
				<p>Calle Mercaderes 123, Cercado</p>
				<p>Arequipa - Perú</p>
				<span>Teléfono:</span>
				<p>454865</p>
				<span>Horario de atención:</span>
				<p>Lunes a viernes de 09:00 am a 05:00 pm</p>
			</div>
			<div class="mapa">
				<figure>
					<img src="img/mapa1.jpg" alt="mapa" style="width: 50%; height: 250px; float: left; border: 1px solid gray; margin-bottom: 4%;">
				</figure>
			</div>
		</div>
		<div id="form">
			<form method="post" action="envia_mensaje.php">
				<h3>Ponte en contacto con nosotros</h3>
				<p>Envianos un mensaje</p>
				<div class="b name">
					<label>Nombres</label>
					<input type="text" name="nombres">
				</div>
				<div class="b mail">
					<label>Correo electrónico</label>
					<input type="email" name="correo" required>
				</div>
				<div class="b phone">
					<label>Teléfono</label>
					<input type="number" name="telefono" minlength="6" maxlength="12" min="100000">
				</div>
				<div class="b matter">
					<label>Asunto</label>
					<input type="text" name="asunto">
				</div>
				<div class="b mesage">
					<label>Mensaje</label>
					<input type="text" name="mensaje" required>
				</div>
				<div id="btn">
					<input type="submit" name="enviar" value="Enviar">
				</div>
			</form>
		</div>
	</div>
</body>
</html>