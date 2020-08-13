<?php 
include('conexion.php');
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Reservas</title>
	<meta charset="utf-8">
	<script src="js/cat_ajax.js"></script>
	<script src="js/agrega_pedido.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/estilos2.css">
	<link rel="stylesheet" type="text/css" href="css/reservas.css">
	<style type="text/css">
		#prods{
			float: left;
			width: 60%;
			height: auto;
			border: 1px solid #000;
			margin-bottom: 10px;
		}
		#prods tr{
			width: 100%;
			height: 65px;
		}

		#prods td{
			height: 100%;
			font: 15px arial;
			border: 1px solid #000;
		}
		.imagen {
			width: 20%;
		}
		.nombre{
			width: 40%;
		}
		.precio{
			width: 10%;
		}
		.cantidad{
			width: 10%;
		}
		.agregar{
			width: 20%;
		}
		.cantidad input{
			float: left;
		}

		#prods figure{
			width:60%;
			height:65px;
		}
		#prods img{
			width: 100%;
			margin-left: 30%;
			height: 65px;
		}
		#ppb{
			float: left;
			width: 20%;
			height: 80px;
			margin-bottom: 10px;
			border: 1px solid #000;
		}

		#ppb a{
			text-decoration: none;
			color: #000;
			width: 100%;
			height: 100%;
		}

		#ppb figure{
			width:100%;
			height:65px;
		}
		#ppb img{
			width: 100%;
			height: 65px;
		}
		#ppb span{
			width: 100%;
			height: 13px;
			padding-bottom: 2px;
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

	<section id="categorias">
		<div id="h2">
			<h2>CATEGORÍAS</h2>
		</div>
		<div id="menu">
			<p><a id="cat_platos" href="categorias.php?cod=plato">Platos</a></p>
			<p><a id="cat_postres" href="categorias.php?cod=postre">Postres</a></p>
			<p><a id="cat_bebidas" href="categorias.php?cod=bebida">Bebidas</a></p>
		</div>
	</section>

	<aside id="form">
		<?php
		if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
		?>
		<div class="title">
			<span>Inicia sesión o crea una cuenta para realizar una reservación</span>
		</div>
		<div id="btn-block">
			<button type="button" class="b" onclick="window.location.href='iniciasesion.php'">Iniciar Sesión</button>
			<button type="button" class="b" onclick="window.location.href='registrarse.php'">Registrarse</button>
		</div>
		<?php 
		}

		else {
		?>
		<div class="title">
			<h3>Agregue los productos que consumirá</h3>
			<p>Solo se mostrarán los productos disponibles</p>
		</div>

		<div id="btn-block">
			<div id="btn">
				<input type="submit" name="ver-lista" id="ver-lista" onclick="window.location.href='lista_pedidos.php'" value="Ver Lista">
			</div>
		</div>
		<?php
		}
		?>
	</aside>
	<table id="subt-prods">
		<tr>
			<th class="imagen">Producto</th>
			<th class="descripcion">Descripción</th>
			<th class="precio">P/U</th>
			<th class="cantidad">Cantidad</th>
			<th class="agregar">Agregar</th>
		</tr>
	</table>
	<table id="prods">
			<!-- aqui va el ajax categorias.php-->
	</table>

</div>
</body>
</html>