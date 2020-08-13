
<!DOCTYPE html>
<html>
<head>
	<title>Inicio de sesión</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilos3.css">
	<style type="text/css">
		#content{
			width: 100%;
			height: 200px;
		}
		form{
			display: inline-block;
			width: 90%;
			height: 100px;
			padding: 5px 5%;
		}
	</style>
</head>
<body>
	<div id="header">
		<header>
			<div id="titulo">
				<h1>Misti Gourmet</h1>
			</div>
			<div>
				<figure>
					<img src="img/fondo2.jpg" alt="Banner de la página" style="width: 100%; height: 100px; float: left;">
				</figure>
			</div>
		</header>
	</div>
	<div id="nav">
		<nav>
			<ul id="links">
				<li><a href="index.php"><span>Inicio</span></a></li>
				<li><a href="locales.php"><span>Locales</span></a></li>
				<li><a href="reservas.php"><span>Reservaciones</span></a></li>
				<li><a href="carta.php"><span>Carta</span></a></li>
				<li><a style="border-right: 3px solid #fff;" href="contacto.php"><span>Contacto</span></a></li>
			</ul>
		</nav>
	</div>
	<div id="log-block">
		<div id="title">
			<h2>Inicia Sesión</h2>
		</div>
		<div id="content">
			<div id="msg">
				<p>¡Si tienes una cuenta con nosotros, ingresa tus datos para comenzar!</p>
			</div>
			<form method="POST" action="valida_login.php">
				<div id="mail" class="in-block">
					<div class="label">
						<label>Correo electrónico</label>
					</div>
					<div class="input">
						<input type="email" name="correo" id="correo" placeholder="Dirección de Email" required>
					</div>
				</div>

				<div id="pass" class="in-block">
					<div class="label">
						<label>Contraseña</label>
					</div>
					<div class="input">
						<input type="password" name="contrasenha" id="contrasenha" placeholder="Contraseña" required>
					</div>
				</div>

				<div id="btn1">
					<input type="submit" name="enviar" id="enviar" value="Ingresar">
				</div>
			</form>
			<div id="btn2">
				<p>¿Aún no tienes una cuenta?</p>
				<button type="button" onclick="window.location.href='registrarse.php'">Registrarse</button>
			</div>
			
		</div>
	</div>
</body>
</html>