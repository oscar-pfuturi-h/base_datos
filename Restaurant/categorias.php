<?php 
header('Content-Type: text/html; charset=utf-8');
include('conexion.php');

if($_REQUEST['cod'] == 'plato'){
	$qry1="SELECT pr.id_prod, pr.nombre, pr.precio, pr.imagen FROM platillos p
		INNER JOIN productos pr ON p.id_plato = pr.id_prod
		WHERE pr.disponible = 1
		ORDER BY pr.nombre;";
	$res = $db_connection->query($qry1);
	$cont = 1;
	while ($filas = $res->fetch_assoc()){
		$idp = $filas['id_prod'];
		$nombre = $filas['nombre'];
		$precio = $filas['precio'];
		$imagen = $filas['imagen'];
 
		/*print " <tr>
					<td class='imagen'><figure><img src='$imagen' alt='imagen postre'/></figure></td>
					<td class='descripcion'>$nombre</td>
					<td class='precio'>S/$precio</td>
					<td class='cantidad'><input type='number' name='cantidad' id='cantidad' min='1' max='99' maxlength='2' value='1' style='width: 40px; margin-left: 20px';></td>
					<td class='agregar'><input type='submit' name='agregar' id='agregar' style='width:100px; height:20px;' value='Agregar' onclick='window.location.href='agregar_pedido.php?idp=$idp&price=$precio''></td>
					window.location.href='agregar_pedido.php?idp=$idp&cant=#cantidad'
				</tr>";
		$cont++;*/
?>
		<tr>
			<td class='imagen'><figure><img src='<?php echo $imagen; ?>' alt='Imagen no disponible'/></figure></td>
			<td class='descripcion' id="nombre"><?php echo $nombre; ?></td>
			<td class='precio'>S/<?php echo $precio; ?></td>
			<td class='cantidad'><input type='number' name='cantidad' id='cantidad' min='1' max='99' maxlength='2' value='1' style='width: 40px; margin-left: 20px';></td>
			<td class='agregar'><input type='submit' name='agregar' id='agregar' style='width:100px; height:20px;' onclick="agrega_pedido(<?php echo $idp ?>, $('cantidad').val())" value="Agregar"></td>
		</tr>

<?php
	}
}

if ($_REQUEST['cod'] == 'postre'){
	$qry1="SELECT pr.id_prod, pr.nombre, pr.precio, pr.imagen FROM postres po
		INNER JOIN productos pr ON po.id_postre = pr.id_prod
		WHERE pr.disponible = 1
		ORDER BY pr.nombre;";
	$res = $db_connection->query($qry1);
	$cont = 1;
	while ($filas = $res->fetch_assoc()){
		$idp = $filas['id_prod'];
		$nombre = $filas['nombre'];
		$precio = $filas['precio'];
		$imagen = $filas['imagen'];
		
		/*print "<div id='ppb'>
				<a id='prod_$cont' href='tabla_pedidos.php?name=$nombre&price=$precio'><figure>
					<img src='$imagen' alt='imagen postre'/>
				</figure>
				<span>$nombre (S/$precio)</span></a>
			</div>";
		$cont++;*/
		?>
		<tr>
			<td class='imagen'><figure><img src='<?php echo $imagen; ?>' alt='Imagen no disponible'/></figure></td>
			<td class='descripcion' id="nombre"><?php echo $nombre; ?></td>
			<td class='precio'>S/<?php echo $precio; ?></td>
			<td class='cantidad'><input type='number' name='cantidad' id='cantidad' min='1' max='99' maxlength='2' value='1' style='width: 40px; margin-left: 20px';></td>
			<td class='agregar'><input type='submit' name='agregar' id='agregar' style='width:100px; height:20px;' onclick="agrega_pedido(<?php echo $idp ?>, $('cantidad').val())" value="Agregar"></td>
		</tr>

<?php
	} 
}
if ($_REQUEST['cod'] == 'bebida'){
	$qry1="SELECT pr.id_prod, pr.nombre, pr.precio, pr.imagen, b.alcohol FROM bebidas b
		INNER JOIN productos pr ON b.id_bebida = pr.id_prod
		WHERE pr.disponible = 1
		ORDER BY pr.nombre;";
	$res = $db_connection->query($qry1);
	$cont = 1;
	while ($filas = $res->fetch_assoc()){
		$idp = $filas['id_prod'];
		$nombre = $filas['nombre'];
		$alcohol = $filas['alcohol'];
		$precio = $filas['precio'];
		$imagen = $filas['imagen'];

		/*print "<div id='ppb'>
				<a id='prod_$cont' href='tabla_pedidos.php?name=$nombre&price=$precio'><figure>
					<img src='$imagen' alt='imagen bebida'/>
				</figure>
				<span>$nombre (S/$precio)</span></a>
			</div>";
		$cont++;*/
	?>
		<tr>
			<td class='imagen'><figure><img src='<?php echo $imagen; ?>' alt='Imagen no disponible'/></figure></td>
			<td class='descripcion' id="nombre"><?php echo $nombre; if ($alcohol==1) echo " (alcohol)"; ?></td>
			<td class='precio'>S/<?php echo $precio; ?></td>
			<td class='cantidad'><input type='number' name='cantidad' id='cantidad' min='1' max='99' maxlength='2' value='1' style='width: 40px; margin-left: 20px';></td>
			<td class='agregar'><input type='submit' name='agregar' id='agregar' style='width:100px; height:20px;' onclick="agrega_pedido(<?php echo $idp ?>, $('cantidad').val())" value="Agregar"></td>
		</tr>

<?php
	}
}
?>