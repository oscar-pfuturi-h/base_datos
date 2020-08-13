<?php 
include('conexion.php');
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Carta</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" type="text/css" href="css/estilos2.css">
	<link rel="stylesheet" type="text/css" href="css/carta.css">
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

	<section id="productos">
		<div id="h2">
			<h2>CATEGORÍAS</h2>
		</div>
		
		<div class="seccion">

			<div class="categoria">
				<span>Platos</span>
			</div>
			<?php
			$qry1="SELECT pr.nombre, pr.disponible, pr.precio, pr.imagen FROM platillos p
				INNER JOIN productos pr ON p.id_plato = pr.id_prod;";
			$res = $db_connection->query($qry1);
			while ($filas = $res->fetch_assoc()){
				$nombre = $filas['nombre'];
				$disponible = $filas['disponible'];
				$precio = $filas['precio'];
				$imagen = $filas['imagen'];
			?>
			<div class="ps plato">
				<figure>
					<img src="<?php echo $imagen; ?>" alt="imagen plato">
				</figure>
				<div class="detalles">
					<span>Detalles del plato</span>
					<p><?php echo $nombre; ?></p>
					<span>Disponible: </span>
					<?php 
					if ($disponible==1){
						print "<p>Sí</p>";
					} else {
						print "<p>No</p>";
					}
					?>
					<span>Precio:</span>
					<p>S/<?php echo $precio; ?></p>
				</div>
			</div>
			<?php 
			}
			?>
		</div>
		<div class="seccion">
			<div class="categoria">
				<span>Postres</span>
			</div>
			<?php
			$qry1="SELECT pr.nombre, pr.disponible, pr.precio, pr.imagen FROM postres po
				INNER JOIN productos pr ON po.id_postre = pr.id_prod;";
			$res = $db_connection->query($qry1);
			while ($filas = $res->fetch_assoc()){
				$nombre = $filas['nombre'];
				$disponible = $filas['disponible'];
				$precio = $filas['precio'];
				$imagen = $filas['imagen'];
			?>
			<div class="ps postre">
				<figure>
					<img src="<?php echo $imagen; ?>" alt="imagen postre">
				</figure>
				<div class="detalles">
					<span>Detalles del postre</span>
					<p><?php echo $nombre; ?></p>
					<span>Disponible: </span>
					<?php 
					if ($disponible==1){
						print "<p>Sí</p>";
					} else {
						print "<p>No</p>";
					}
					?>
					<span>Precio:</span>
					<p>S/<?php echo $precio; ?></p>
				</div>
			</div>
			<?php 
			}
			?>
		</div>
		<div class="seccion">
			<div class="categoria">
				<span>Bebidas</span>
			</div>
			<?php
			$qry1="SELECT pr.nombre, pr.disponible, pr.precio, pr.imagen, b.alcohol FROM bebidas b
				INNER JOIN productos pr ON b.id_bebida = pr.id_prod;";
			$res = $db_connection->query($qry1);
			while ($filas = $res->fetch_assoc()){
				$nombre = $filas['nombre'];
				$alcohol = $filas['alcohol'];
				$disponible = $filas['disponible'];
				$precio = $filas['precio'];
				$imagen = $filas['imagen'];
			?>
			<div class="ps bebida">
				<figure>
					<img src="<?php echo $imagen; ?>" alt="imagen bebida">
				</figure>
				<div class="detalles">
					<span>Detalles de la bebida</span>
					<p><?php echo $nombre; ?></p>
					<span>Alcohol:</span>
					<?php 
					if ($alcohol==1){
						print "<p>Sí</p>";
					} else {
						print "<p>No</p>";
					}
					?>
					<span>Disponible: </span>
					<?php 
					if ($disponible==1){
						print "<p>Sí</p>";
					} else {
						print "<p>No</p>";
					}
					?>
					<span>Precio:</span>
					<p>S/<?php echo $precio; ?></p>
				</div>
			</div>
			<?php 
			}
			?>
		</div>
	</section>
</div>
</body>
</html>

<?php
mysqli_close($db_connection);
?>