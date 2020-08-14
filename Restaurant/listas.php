<?php 
include('conexion.php');

if($_REQUEST['code'] == 0){
?>
	<div id="c-title">
		<h1>Lista de Clientes</h1>
	</div>
	<div id="list-client">
		<table>
			<tr id="c-subt">
				<th class="data cname st">Cliente</th>
				<th class="data cmail st">Correo</th>
				<th class="data cn-reservas st">Nro. Reservas</th>
				<th class="data cr-actual st">Reserva Actual</th>
				<th class="data chora st">Hora</th>
				<th class="ver st" colspan="2">Ver</th>
			</tr>
<?php 
		$qry = "SELECT c.id_cliente, c.nombre, c.apellidos, c.correo				FROM clientes c;";

		$res = $db_connection->query($qry);

		while ($filas = $res->fetch_assoc()){
			$id_cliente = $filas['id_cliente'];
			$qry2 = "SELECT COUNT(r.fecha_reservada) 'nro_reservas' 
				FROM reservaciones r WHERE r.id_cliente=".$id_cliente.";";
			$res2 = $db_connection->query($qry2);
			$row = $res2->fetch_assoc();
?>
			<tr class="row">
				<td class="data cname info user"><?php echo $filas['nombre'] . " " . $filas['apellidos']; ?></td>
				<td class="data cmail info user"><?php echo $filas['correo']; ?></td>
				<td class="data cn-reservas info user"><?php echo $row['nro_reservas']; ?>
				</td>
	<?php 
			$qry1 = "SELECT fecha_reservada, hora FROM reservaciones
					WHERE id_cliente = ".$id_cliente." AND fecha_reservada >= CURRENT_DATE
					ORDER BY fecha_reservada DESC";

			$res1 = $db_connection->query($qry1);
			if ($res1->num_rows == 0){
	?>
				<td class="data cr-actual">Ninguna</td>
				<td class="data chora">--:--</td>
			<?php 
			}
			else {
				while ($filas1 = $res1->fetch_assoc()){
				?>
				<td class="data cr-actual"><?php echo $filas1['fecha_reservada']; ?></td>
				<td class="data chora"><?php echo $filas1['hora']; ?></td>
			<?php 
				} 
			}
			?>
				<td class="ver"><button type="button" name="f-btn" id="factura-btn" onclick="window.location.href='reservaciones.php?cid=<?php echo $id_cliente; ?>'">Reservaciones</button></td>
				<td class="ver"><button type="button" name="f-btn" id="factura-btn" onclick="window.location.href='facturas.php?cid=<?php echo $id_cliente; ?>'">Facturas</button></td>
			</tr>
		<?php 
		}
		?>
		</table>
	</div>
<?php
}

if ($_REQUEST['code']==1){
?>
	<div id="p-title">
		<h1>Lista de Productos</h1>
	</div>
	<div id="add-block">
		<div id="add-btn">
			<a id="add_p" href="prod_form.php?tc=add">Agregar un producto</a>
		</div>
	</div>
	<div id="list-prods">
		<table class="ptable plato">
			<thead><h2>Platillos</h2></thead>
			<tr id="p-subt">
				<th class="data pname st"><span>Producto</span></th>
				<th class="data pimg st"><span>Dirección Imagen</span></th>
				<th class="data ppu st"><span>Precio</span></th>
				<th class="data pdisp st"><span>Disponible</span></th>
				<th class="opc st"><span>Opciones</span></th>
			</tr>
<?php 
		$qry = "SELECT p.id_prod, p.nombre, p.imagen, p.precio, p.disponible FROM platillos pl
			INNER JOIN productos p ON pl.id_plato=p.id_prod
			ORDER BY p.nombre;";

		$res = $db_connection->query($qry);
		while ($filas = $res->fetch_assoc()){
?>
			<tr class="prods-row">
				<td class="data pname info p"><?php echo $filas['nombre']; ?></td>
				<td class="data pimg info p"><?php echo $filas['imagen']; ?></td>
				<td class="data ppu info p"><?php echo $filas['precio']; ?></td>
			<?php 
			if ($filas['disponible'] == 1){
			?>
				<td class="data pdisp info p">Sí</td>
			<?php 
			}
			else{
			?>
				<td class="data pdisp info p">No</td>
			<?php 
			}
			?>
				<td id="edition" class="buttons"><figure>
					<a id="ep" href="prod_form.php?tc=edit&cat=0&pid=<?php echo $filas['id_prod']; ?>"><img src="img/editar.jpg" title="Editar"></a>
				</figure></td>
				<td id="remove" class="buttons"><figure>
					<img src="img/tacho.jpg" onclick="window.location.href='eliminar_prod.php?pid=<?php echo $filas['id_prod']; ?>'" title="Eliminar">
				</figure></td>
			</tr>
			<?php 
			}
			?>
		</table>

		<table class="ptable postre">
			<thead><h2>Postres</h2></thead>
			<tr id="p-subt">
				<th class="data pname st"><span>Producto</span></th>
				<th class="data pimg st"><span>Dirección Imagen</span></th>
				<th class="data ppu st"><span>Precio</span></th>
				<th class="data pdisp st"><span>Disponible</span></th>
				<th class="opc st"><span>Opciones</span></th>
			</tr>
<?php 
		$qry = "SELECT p.id_prod, p.nombre, p.imagen, p.precio, p.disponible FROM postres po
			INNER JOIN productos p ON po.id_postre=p.id_prod
			ORDER BY p.nombre;";

		$res = $db_connection->query($qry);
		while ($filas = $res->fetch_assoc()){
?>
			<tr class="prods-row">
				<td class="data pname info p"><?php echo $filas['nombre']; ?></td>
				<td class="data pimg info p"><?php echo $filas['imagen']; ?></td>
				<td class="data ppu info p"><?php echo $filas['precio']; ?></td>
			<?php 
			if ($filas['disponible'] == 1){
			?>
				<td class="data pdisp info p">Sí</td>
			<?php 
			}
			else{
			?>
				<td class="data pdisp info p">No</td>
			<?php 
			}
			?>
				<td id="edition" class="buttons"><figure>
					<img src="img/editar.jpg" onclick="window.location.href='prod_form.php?tc=edit&cat=1&pid=<?php echo $filas['id_prod']; ?>'" title="Editar">
				</figure></td>
				<td id="remove" class="buttons"><figure>
					<img src="img/tacho.jpg" onclick="window.location.href='eliminar_prod.php?pid=<?php echo $filas['id_prod']; ?>'" title="Eliminar">
				</figure></td>
			</tr>
		<?php 
		}
		?>
		</table>

		<table class="ptable bebida">
			<thead><h2>Bebidas</h2></thead>
			<tr id="p-subt">
				<th class="data pname st"><span>Producto</span></th>
				<th class="data pimg st"><span>Dirección Imagen</span></th>
				<th class="data ppu st"><span>Precio</span></th>
				<th class="data pal st"><span>Alcohol</span></th>
				<th class="data pdisp st"><span>Disponible</span></th>
				<th class="opc st"><span>Opciones</span></th>
			</tr>
<?php 
		$qry = "SELECT p.id_prod, p.nombre, p.imagen, p.precio, p.disponible, b.alcohol 
				FROM bebidas b
			INNER JOIN productos p ON b.id_bebida=p.id_prod
			ORDER BY p.nombre;";

		$res = $db_connection->query($qry);
		while ($filas = $res->fetch_assoc()){
?>
			<tr class="prods-row">
				<td class="data pname info p"><?php echo $filas['nombre']; ?></td>
				<td class="data pimg info p"><?php echo $filas['imagen']; ?></td>
				<td class="data ppu info p"><?php echo $filas['precio']; ?></td>
			<?php 
			if ($filas['alcohol'] == 1){
			?>
				<td class="data pal info p">Sí</td>
			<?php 
			}
			else{
			?>
				<td class="data pal info p">No</td>
			<?php 
			}
			if ($filas['disponible'] == 1){
			?>
				<td class="data pdisp info p">Sí</td>
			<?php 
			}
			else{
			?>
				<td class="data pdisp info p">No</td>
			<?php 
			}
			?>
				<td id="edition" class="buttons"><figure>
					<img src="img/editar.jpg" onclick="window.location.href='prod_form.php?tc=edit&cat=2&pid=<?php echo $filas['id_prod']; ?>'" title="Editar">
				</figure></td>
				<td id="remove" class="buttons"><figure>
					<img src="img/tacho.jpg" onclick="window.location.href='eliminar_prod.php?pid=<?php echo $filas['id_prod']; ?>'" title="Eliminar">
				</figure></td>
			</tr>
			<?php 
			}
			?>
		</table>
	</div>
<?php
}

if ($_REQUEST['code'] == 2){
	?>
	<div id="title">
		<h1>Lista de Empleados</h1>
	</div>
	<div id="list-emp">
		<table>
			<thead><h2>Cajeros (administradores)</h2></thead>
			<tr id="e-subt">
				<th class="data ename st">Nombre(s) y Apellidos</th>
				<th class="data edni st">DNI</th>
				<th class="data email st">Correo</th>
				<th class="data etel st">Teléfono</th>
				<th class="data efecha st">Fecha de nacimiento</th>
				<th class="data esal st">Salario</th>
				<th class="data elocal st">Dir. Local</th>
				<th class="data eturno st">Turno</th>
				<th class="data opc">Opciones</th>
			</tr>
<?php 
		$qry = "SELECT e.nombre, e.apellidos, e.id_empleado, e.telefono, e.fecha_nacimiento, e.salario, e.turno, s.direccion, c.correo FROM cajero c 
			INNER JOIN empleados e ON e.id_empleado=c.id_cajero
			INNER JOIN sucursal s ON s.id_sucursal=e.id_sucursal
			ORDER BY e.apellidos;";

		$res = $db_connection->query($qry);
		while ($filas = $res->fetch_assoc()){
?>
			<tr class="emp-row">
				<td class="data ename info user"><?php echo $filas['nombre'] . " " . $filas['apellidos']; ?></td>
				<td class="data edni info user"><?php echo $filas['id_empleado']; ?></td>
				<td class="data email info user"><?php echo $filas['correo']; ?></td>
				<td class="data etel info user"><?php echo $filas['telefono']; ?></td>
				<td class="data efecha info user"><?php echo $filas['fecha_nacimiento']; ?></td>
				<td class="data esal info user">S/<?php echo $filas['salario']; ?></td>
				<td class="data elocal info user"><?php echo $filas['direccion']; ?></td>
				<td class="data eturno info user"><?php echo $filas['turno']; ?></td>
				<td id="edition" class="buttons"><figure>
					<img src="img/editar.jpg" onclick="window.location.href='empleado_form.php?tc=edit&eid=<?php echo $filas['id_empleado']; ?>'" title="Editar">
				</figure></td>
				<td id="remove" class="buttons"><figure>
					<img src="img/tacho.jpg" onclick="window.location.href='eliminar_empleado.php?eid=<?php echo $filas['id_empleado']; ?>'" title="Eliminar">
				</figure></td>
			</tr>
		<?php 
		}
		?>
		</table>

<!-- camareros ------ -->
		<table>
			<thead><h2>Camareros</h2></thead>
			<tr id="e-subt">
				<th class="data ename st">Nombre(s) y Apellidos</th>
				<th class="data edni st">DNI</th>
				<th class="data etel st">Teléfono</th>
				<th class="data efecha st">Fecha de nacimiento</th>
				<th class="data esal st">Salario</th>
				<th class="data elocal st">Dir. Local</th>
				<th class="data eturno st">Turno</th>
				<th class="data opc">Opciones</th>
			</tr>
<?php 
		$qry = "SELECT e.nombre, e.apellidos, e.id_empleado, e.telefono, e.fecha_nacimiento, e.salario, e.turno, s.direccion FROM camarero c 
			INNER JOIN empleados e ON e.id_empleado=c.id_camarero
			INNER JOIN sucursal s ON s.id_sucursal=e.id_sucursal
			ORDER BY e.apellidos;";

		$res = $db_connection->query($qry);
		while ($filas = $res->fetch_assoc()){
?>
			<tr class="emp-row">
				<td class="data ename info user"><?php echo $filas['nombre'] . " " . $filas['apellidos']; ?></td>
				<td class="data edni info user"><?php echo $filas['id_empleado']; ?></td>
				<td class="data etel info user"><?php echo $filas['telefono']; ?></td>
				<td class="data efecha info user"><?php echo $filas['fecha_nacimiento']; ?></td>
				<td class="data esal info user"><?php echo "S/" . $filas['salario']; ?></td>
				<td class="data elocal info user"><?php echo $filas['direccion']; ?></td>
				<td class="data eturno info user"><?php echo $filas['turno']; ?></td>
				<td id="edition" class="buttons"><figure>
					<img src="img/editar.jpg" onclick="window.location.href='empleado_form.php?tc=edit&eid=<?php echo $filas['id_empleado']; ?>'" title="Editar">
				</figure></td>
				<td id="remove" class="buttons"><figure>
					<img src="img/tacho.jpg" onclick="window.location.href='eliminar_empleado.php?eid=<?php echo $filas['id_empleado']; ?>'" title="Eliminar">
				</figure></td>
			</tr>
		<?php 
		}
		?>
		</table>
	</div>
<?php
}
?>