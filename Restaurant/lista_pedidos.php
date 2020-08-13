<?php 
include('conexion.php');
?>

<html>
<head>
	<title>Pedidos</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/pedidos.css">
</head>
<body>
	<form method="post" action="confirmar_pedido.php">
		<div class="title">
			<h3>Lista de pedidos</h3>
		</div>
		<div id="reserva">
			<div class="r nro-personas">
				<div class="subt">
					<label>Número de asistentes</label>
					<p>¿Cuántas personas asistirán?</p>
				</div>
				<input type="number" name="nro_p" id="nro_p" min="1" max="99" maxlength="2" value="1" style="width: 40px; margin-left: 10px;" required>
			</div>
			<div class="r fecha-r">
				<div class="subt">
					<label>Fecha de reservación</label>
					<p>Indique la fecha que desee reservar</p>
				</div>
				<input type="date" name="fecha_r" id="fecha_r" min="2020-07-20" required>
			</div>
			<div class="r hora-r">
				<div class="subt">
					<label>Hora de reservación</label>
					<p>Indique la hora que desee reservar</p>
				</div>
				<input type="time" name="hora_r" id="hora_r" required>
			</div>
		</div>
		<table id="pedidos-t">
			<tr>
				<th class="descripcion">Descripción</th>
				<th class="cantidad">Cantidad</th>
				<th class="precio">P/U</th>
				<th class="total">Total</th>
			</tr>
			<?php

			$qry = "SELECT pr.nombre, pr.precio FROM productos pr;";
			$res = $db_connection->query($qry);
			while ($fila = $res->fetch_assoc()){
			?>
			<tr>
				<td class="descripcion"><?php echo $fila['nombre']; ?></td>
				<td class="cantidad"><input type="number" name="cantidad" id="cantidad" min="1" max="99" maxlength="2" value="1" style="width: 40px; margin-left: 10px;"></td>
				<td class="precio">S/<?php echo $fila['precio']; ?></td>
				<?php $total = $fila['precio'] * $fila['precio']; ?>
				<td class="total">S/<?php echo $total; ?></td>
			</tr>
			<?php 
			}
			?>
		</table>
		<div id="pago-block">
			<div id="pago">
				<span>Pago Total: S/<?php echo $total; ?></span>
			</div>
			<div id="btn">
				<input type="submit" name="aceptar" id="aceptar" value="Aceptar">
			</div>
			<div id="btn">
				<button type="button" name="cancelar" id="cancelar" onclick="window.location.href='cancelar_pedido.php'">Cancelar</button>
			</div>
		</div>
	</form>
	<blockquote style="display: inline-block; float: left; width: 80%; margin-left: 10%;margin-bottom: 20px; border: 1px solid #000;">
		<p style="font: italic 12px arial; text-align: left;">Atención: Las reservaciones deberán hacerse con un mínimo de 3 horas de anticipación</p>
	</blockquote>
</body>
	