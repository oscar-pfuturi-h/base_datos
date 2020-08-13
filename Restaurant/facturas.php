<?php 
include('conexion.php');
?>

<html>
<head>
	<title>Admins - Misti Gourmet</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/facturas.css">
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
		<tr id="tfoot"><td colspan="2"><h2>Facturas</h2></td></tr>
	</table>

	<?php
	$qry = "SELECT f.id_factura, f.fecha_emision, f.hora_emision, f.pago_total, r.fecha_reservada
			FROM facturas f
			INNER JOIN clientes c ON c.id_cliente=f.id_cliente
			INNER JOIN reservaciones r ON r.id_cliente=c.id_cliente
			WHERE c.id_cliente=".$_REQUEST['cid'].";";
	$res = $db_connection->query($qry);

	while ($row = $res->fetch_assoc()){
	?>
	<table id="f-table">
		<tr class="info">
			<th class="c">Cód. Factura</th>
			<td class="c"><?php echo $row['id_factura']; ?></td>
		</tr>
		<tr class="info">
			<th class="f">Fecha</th>
			<td class="f"><?php echo $row['fecha_emision']; ?></td>
		</tr>
		<tr>
			<th class="h">Hora</th>
			<td class="h"><?php echo $row['hora_emision']; ?></td>
		</tr>
		<tr>
			<th class="pc" >Productos consumidos (Cantidad)</th>
			<th>Subtotal</th>
		</tr>
		<?php
		$qry1 = "SELECT p.nombre, cc.cantidad, p.precio FROM consumo_cliente cc
				INNER JOIN clientes c ON c.id_cliente=cc.id_cliente
				INNER JOIN reservaciones r ON r.id_cliente=c.id_cliente
				INNER JOIN productos p ON p.id_prod=cc.id_prod
				WHERE c.id_cliente=".$_REQUEST['cid']." AND 
					r.fecha_reservada='".$row['fecha_reservada']."';";
		$res1 = $db_connection->query($qry1);
		while ($row1 = $res1->fetch_assoc()){
		?>
		<tr>
			<td><?php echo $row1['nombre']." (".$row1['cantidad'].")"; ?></td>
			<td><?php echo $row1['precio'] * $row1['cantidad']; ?></td>
		</tr>
		<?php 
		}
		?>
		<tr>
			<th>Total:</th>
			<td><?php echo "S/" . $row['pago_total']; ?></td>
		</tr>
	</table>
	<?php 
	}
	?>
</div>
</body>
</html>