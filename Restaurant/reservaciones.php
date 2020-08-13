<?php 
include('conexion.php');
?>

<html>
<head>
	<title>Admins - Misti Gourmet</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/clientes_reservaciones.css">
</head>
<body>
<div id="content">
	<table id="c-table">
<?php 
	$qry = "SELECT c.nombre, c.apellidos, c.correo, r.fecha_reservada, r.hora
			FROM clientes c 
			INNER JOIN reservaciones r ON r.id_cliente=c.id_cliente
			WHERE c.id_cliente=".$_REQUEST['cid'].";";
	$res = $db_connection->query($qry);
	$row = $res->fetch_assoc();
?>
		<tr>
			<th class="clt">
				<span>Cliente:</span>
			</th>
			<td class="cld">
				<p><?php echo $row['nombre'] . " " . $row['apellidos']; ?></p>
			</td>
		</tr>
		<tr>
			<th class="clt">
				<span>Correo:</span>
			</th>
			<td class="cld">
				<p><?php echo $row['correo']; ?></p>
			</td>
		</tr>
	</table>

	<table id="r-table">
		<thead><h2>Reservaciones</h2></thead>
		<tr class="info">
			<th class="f">Fecha</th>
			<th class="h">Hora</th>
			<th class="na">Nro. Asistentes</th>
			<th class="pc">Productos (Cantidad)</th>
		</tr>
	<?php
	$qry = "SELECT r.fecha_reservada, r.hora, r.nro_clientes
			FROM reservaciones r
			INNER JOIN clientes c ON c.id_cliente=r.id_cliente
			WHERE c.id_cliente=".$_REQUEST['cid'].";";
	$res = $db_connection->query($qry);

	while ($row = $res->fetch_assoc()){
	?>
		<tr class="info">
			<td class="f" rowspan="2"><?php echo $row['fecha_reservada']; ?></td>
			<td class="h" rowspan="2"><?php echo $row['hora']; ?></td>
			<td class="na" rowspan="2"><?php echo $row['nro_clientes']; ?></td>
		<?php
		$qry1 = "SELECT p.nombre, cc.cantidad FROM consumo_cliente cc
				INNER JOIN clientes c ON c.id_cliente=cc.id_cliente
				INNER JOIN reservaciones r ON r.id_cliente=c.id_cliente
				INNER JOIN productos p ON p.id_prod=cc.id_prod
				WHERE c.id_cliente=".$_REQUEST['cid']." AND 
					r.fecha_reservada='".$row['fecha_reservada']."';";
		$res1 = $db_connection->query($qry1);
		while ($row1 = $res1->fetch_assoc()){
		?>
			<tr id="prod">
				<td class="prod name"><?php echo $row1['nombre']." (".$row1['cantidad'].")"; ?></td>
			</tr>		
		<?php 
		}
		?>
		</tr>
	<?php 
	}
	?>
	</table>
</div>
</body>
</html>