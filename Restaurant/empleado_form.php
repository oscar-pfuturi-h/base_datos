<?php 
include('conexion.php');
?>

<html>
<head>
	<title>Admins - Misti Gourmet</title>
	<link rel="stylesheet" type="text/css" href="css/estilos4.css">
	<link rel="stylesheet" type="text/css" href="css/productos.css">
	<style type="text/css">
		form{
			height: 350px;
		}
		.f.body{
			height: 250px;
		}
		.elem.bb{
			width: 23%;
		}
		.bb.in input{
			float: left;
			margin-top: 50px;
			width: 50%;
		}

	</style>
</head>

<body>
	<div id="form">
<?php
if ($_REQUEST['tc']=='add'){
?>
	<form method="POST" action="agregar_empleado.php">
		<div class="f head">
			<h2>Agregar Empleado</h2>
		</div>
		<div class="f body">
			<div class="elem aa fcat">
				<div class="label">
					<label>Cargo:</label>
				</div>
				<div class="in">
					<input type="checkbox" name="fcp" id="fcp"><span>Camarero</span>
					<input type="checkbox" name="fcpo" id="fcpo"><span>Cajero</span>
				</div>
			</div>
			<div class="elem aa fname">
				<div class="label">
					<label>Nombre(s):</label>
				</div>
				<div class="in">
					<input type="text" name="nombre" id="nombre" required>
				</div>
			</div>
			<div class="elem bb fprice">
				<div class="label">
					<label>DNI:</label>
				</div>
				<div class="in">
					<input type="number" name="dni" id="dni" max="99999999" min="10000000" step="1" maxlength="8" required>
				</div>
			</div>
			<div class="elem bb fdisp">
				<div class="label">
					<label>Apellido(s):</label>
				</div>
				<div class="in">
					<input type="text" name="apellidos" id="apellidos" required>
				</div>
			</div>
			<div class="elem bb falc">
				<div class="label">
					<label>Teléfono:</label>
				</div>
				<div class="in">
					<input type="number" name="telefono" id="telefono">
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
	$qry = "SELECT * FROM empleados
			WHERE id_empleado=".$_REQUEST['eid'].";";
	$res = $db_connection->query($qry);
	$row = $res->fetch_assoc();
?>
	<form method="POST" action="actualizar_empleado.php?pid=<?php echo $_REQUEST['pid']; ?>">
		<div class="f head">
			<h2>Editar información</h2>
		</div>
		<div class="f body">
			<div class="elem aa fcat">
				<div class="label">
					<label>Cargo:</label>
				</div>
				<div class="in">
					<input type="checkbox" name="camarero" id="camarero" checked><span>Camarero</span>
					<input type="checkbox" name="cajero" id="cajero"><span>Cajero</span>
				</div>
			</div>
			<div class="elem aa fname">
				<div class="label">
					<label>Nombre(s):</label>
				</div>
				<div class="in">
					<input type="text" name="nombre" id="nombre" value="<?php echo $row['nombre']; ?>" required>
				</div>
			</div>
			<div class="elem aa fname">
				<div class="label">
					<label>Apellido(s):</label>
				</div>
				<div class="in">
					<input type="text" name="apellidos" id="apellidos" value="<?php echo $row['apellidos']; ?>" required>
				</div>
			</div>
			<div class="elem aa fname">
				<div class="label">
					<label>DNI:</label>
				</div>
				<div class="in">
					<input type="number" name="dni" id="dni" max="99999999" min="10000000" step="1" maxlength="8" value="<?php echo $row['id_empleado']; ?>" required>
				</div>
			</div>
			<div class="elem aa fname">
				<div class="label">
					<label>Sucursal:</label>
				</div>
				<div class="in">
					<input type="text" name="sucursal" id="sucursal" value="<?php echo $row['id_sucursal']; ?>" required>
				</div>
			</div>
			<div class="elem bb fprice">
				<div class="label">
					<label>Teléfono:</label>
				</div>
				<div class="in">
					<input type="number" name="telefono" id="telefono" max="999999999" min="100000" step="1" maxlength="9" value="<?php echo $row['telefono']; ?>" required>
				</div>
			</div>
			<div class="elem bb fprice">
				<div class="label">
					<label>Fecha de Nacimiento:</label>
				</div>
				<div class="in">
					<input type="date" name="fecha" id="fecha" value="<?php echo $row['fecha_nacimiento']; ?>" required>
				</div>
			</div>
			<div class="elem bb fprice">
				<div class="label">
					<label>Salario:</label>
				</div>
				<div class="in">
					<input type="number" name="salario" id="salario" max="10000" min="950" step="1" maxlength="5" value="<?php echo $row['salario']; ?>" required>
				</div>
			</div>
			<div class="elem bb fprice">
				<div class="label">
					<label>Turno:</label>
				</div>
				<div class="in">
					<input type="text" name="turno" id="turno" value="<?php echo $row['turno']; ?>" required>
				</div>
			</div>

		</div>

	
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