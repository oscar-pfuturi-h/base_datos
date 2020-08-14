<?php 
include('conexion.php');
?>

<html>
<head>
	<title>Admins - Misti Gourmet</title>
	<link rel="stylesheet" type="text/css" href="css/estilos4.css">
	<link rel="stylesheet" type="text/css" href="css/productos.css">
</head>

<body>
	<div id="form">
<?php
if ($_REQUEST['tc']=='add'){
?>
	<form method="POST" action="agregar_prod.php">
		<div class="f head">
			<h2>Agregar Producto</h2>
		</div>
		<div class="f body">
			<div class="elem aa fcat">
				<div class="label">
					<label>Categoría:</label>
				</div>
				<div class="in">
					<input type="checkbox" name="fcp" id="fcp" value="platillos"><span>Platillo</span>
					<input type="checkbox" name="fcpo" id="fcpo" value="postres"><span>Postre</span>
					<input type="checkbox" name="fcb" id="fcb" value="bebidas"><span>Bebida</span>
				</div>
			</div>
			<div class="elem aa fname">
				<div class="label">
					<label>Descripción:</label>
				</div>
				<div class="in">
					<input type="text" name="fn" id="fn" required>
				</div>
			</div>
			<div class="elem aa fimg">
				<div class="label">
					<label>Imagen:</label>
				</div>
				<div class="in">
					<input type="file" name="fi" id="fi" required>
				</div>
			</div>
			<div class="elem bb fprice">
				<div class="label">
					<label>Precio:</label>
				</div>
				<div class="in">
					<input type="number" name="fp" id="fp" max="99" min="1" step="0.5" maxlength="2" required>
				</div>
			</div>
			<div class="elem bb fdisp">
				<div class="label">
					<label>Disponible:</label>
				</div>
				<div class="in">
					<input type="radio" name="fds" id="fds" value="1"><span>Sí</span>
					<input type="radio" name="fdn" id="fdn" value="0"><span>No</span>
				</div>
			</div>
			<div class="elem bb falc">
				<div class="label">
					<label>Alcohol:</label>
				</div>
				<div class="in">
					<input type="radio" name="alcs" id="fds" value="1"><span>Sí</span>
					<input type="radio" name="alcn" id="fdn" value="0"><span>No</span>
				</div>
			</div>
		</div>
		<div class="f foot">
			<input type="submit" name="confirm" id="confirm" value="Confirmar">
		</div>
	</form>
<?php 
}
if ($_REQUEST['tc']=='edit'){
	$qry = "SELECT nombre, disponible, precio, imagen FROM productos
			WHERE id_prod=".$_REQUEST['pid'].";";
	$res = $db_connection->query($qry);
	$row = $res->fetch_assoc();
	if ($_REQUEST['cat']==0){
?>
	<form method="POST" action="actualizar_prod.php?pid=<?php echo $_REQUEST['pid']; ?>">
		<div class="f head">
			<h2>Editar Producto</h2>
		</div>
		<div class="f body">
			<div class="elem aa fcat">
				<div class="label">
					<label>Categoría:</label>
				</div>
				<div class="in">
					<input type="checkbox" name="fcp" id="fcp" value="platillos"><span>Platillo</span>
					<input type="checkbox" name="fcpo" id="fcpo" value="postres"><span>Postre</span>
					<input type="checkbox" name="fcb" id="fcb" value="bebidas"><span>Bebida</span>
				</div>
			</div>
			<div class="elem aa fname">
				<div class="label">
					<label>Descripción:</label>
				</div>
				<div class="in">
					<input type="text" name="fn" id="fn" value="<?php echo $row['nombre']; ?>" required>
				</div>
			</div>
			<div class="elem aa fimg">
				<div class="label">
					<label>Imagen:</label>
				</div>
				<div class="in">
					<input type="file" name="fi" id="fi" value="<?php echo $row['imagen']; ?>" required>
				</div>
			</div>
			<div class="elem bb fprice">
				<div class="label">
					<label>Precio:</label>
				</div>
				<div class="in">
					<input type="number" name="fp" id="fp" max="99" min="1" step="0.5" maxlength="2" value="<?php echo $row['precio']; ?>" required>
				</div>
			</div>
			<div class="elem bb fdisp">
				<div class="label">
					<label>Disponible:</label>
				</div>
				<div class="in">
					<input type="radio" name="fds" id="fds" value="1"><span>Sí</span>
					<input type="radio" name="fdn" id="fdn" value="0"><span>No</span>
				</div>
			</div>
		</div>

	<?php 
	}
	if ($_REQUEST['cat']==1){
	?>
	<form method="POST" action="actualizar_prod.php?pid=<?php echo $_REQUEST['pid']; ?>">
		<div class="f head">
			<h2>Editar Producto</h2>
		</div>
		<div class="f body">
			<div class="elem aa fcat">
				<div class="label">
					<label>Categoría:</label>
				</div>
				<div class="in">
					<input type="checkbox" name="fcp" id="fcp" value="platillos"><span>Platillo</span>
					<input type="checkbox" name="fcpo" id="fcpo" value="postres" checked><span>Postre</span>
					<input type="checkbox" name="fcb" id="fcb" value="bebidas"><span>Bebida</span>
				</div>
			</div>
			<div class="elem aa fname">
				<div class="label">
					<label>Descripción:</label>
				</div>
				<div class="in">
					<input type="text" name="fn" id="fn" value="<?php echo $row['nombre']; ?>" required>
				</div>
			</div>
			<div class="elem aa fimg">
				<div class="label">
					<label>Imagen:</label>
				</div>
				<div class="in">
					<input type="file" name="fi" id="fi" value="<?php echo $row['imagen']; ?>" required>
				</div>
			</div>
			<div class="elem bb fprice">
				<div class="label">
					<label>Precio:</label>
				</div>
				<div class="in">
					<input type="number" name="fp" id="fp" max="99" min="1" step="0.5" maxlength="2" value="<?php echo $row['precio']; ?>" required>
				</div>
			</div>
			<div class="elem bb fdisp">
				<div class="label">
					<label>Disponible:</label>
				</div>
				<div class="in">
					<input type="radio" name="fds" id="fds" value="1"><span>Sí</span>
					<input type="radio" name="fdn" id="fdn" value="0"><span>No</span>
				</div>
			</div>
		</div>

	<?php 
	}
	if ($_REQUEST['cat']==2){
	?>
	<form method="POST" action="actualizar_prod.php?pid=<?php echo $_REQUEST['pid']; ?>">
		<div class="f head">
			<h2>Editar Producto</h2>
		</div>
		<div class="f body">
			<div class="elem aa fcat">
				<div class="label">
					<label>Categoría:</label>
				</div>
				<div class="in">
					<input type="checkbox" name="fcp" id="fcp" value="platillos"><span>Platillo</span>
					<input type="checkbox" name="fcpo" id="fcpo" value="postres"><span>Postre</span>
					<input type="checkbox" name="fcb" id="fcb" value="bebidas" checked><span>Bebida</span>
				</div>
			</div>
			<div class="elem aa fname">
				<div class="label">
					<label>Descripción:</label>
				</div>
				<div class="in">
					<input type="text" name="fn" id="fn" value="<?php echo $row['nombre']; ?>" required>
				</div>
			</div>
			<div class="elem aa fimg">
				<div class="label">
					<label>Imagen:</label>
				</div>
				<div class="in">
					<input type="file" name="fi" id="fi" value="<?php echo $row['imagen']; ?>" required>
				</div>
			</div>
			<div class="elem bb fprice">
				<div class="label">
					<label>Precio:</label>
				</div>
				<div class="in">
					<input type="number" name="fp" id="fp" max="99" min="1" step="0.5" maxlength="2" value="<?php echo $row['precio']; ?>" required>
				</div>
			</div>
			<div class="elem bb fdisp">
				<div class="label">
					<label>Disponible:</label>
				</div>
				<div class="in">
					<input type="radio" name="fds" id="fds" value="1"><span>Sí</span>
					<input type="radio" name="fdn" id="fdn" value="0"><span>No</span>
				</div>
			</div>
			<div class="elem bb falc">
				<div class="label">
					<label>Alcohol:</label>
				</div>
				<div class="in">
					<input type="radio" name="alcs" id="alcs" value="1"><span>Sí</span>
					<input type="radio" name="alcn" id="alcn" value="0"><span>No</span>
				</div>
			</div>
		</div>
	<?php 
	}
	?>
		<div class="f foot">
			<input type="submit" name="confirm" id="confirm" value="Confirmar">
		</div>
	</form>	
<?php 
}
?>
	</div>	
</body>
</html>