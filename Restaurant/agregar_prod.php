<?php 
include('conexion.php');

	if (isset($_POST['fds'])){
		$qry = "INSERT INTO productos (nombre,disponible,precio,imagen) VALUES ('".$_POST['fn']."', 1, ".$_POST['fp'].", '".$_POST['fi']."');";
		$res = $db_connection->query($qry);
	} 
	if (isset($_POST['fdn'])){
		$qry = "INSERT INTO productos (nombre,disponible,precio,imagen) VALUES ('".$_POST['fn']."', 0, ".$_POST['fp'].", 'img/".$_POST['fi']."'');";
		$res = $db_connection->query($qry);
	}
	if (isset($_POST['fcp'])){
		$q = "SELECT MAX(id_prod) 'id' FROM productos;";
		$r = $db_connection->query($q);
		$r2 = $r->fetch_assoc();
		$qry = "INSERT INTO platillos VALUES (".$r2['id'].");";
		$res = $db_connection->query($qry);
		if ($res){
			print "<script> alert('Producto agregado correctamente!');
                window.location.replace('admin.php'); </script>";
		} else {
			print "<script> alert('Ha ocurrido un problema!');
                window.location.replace('admin.php'); </script>";
		}
	}
	if (isset($_POST['fcpo'])){
		$q = "SELECT MAX(id_prod) 'id' FROM productos;";
		$r = $db_connection->query($q);
		$r2 = $r->fetch_assoc();
		$qry = "INSERT INTO postres VALUES (".$r2['id'].");";
		$res = $db_connection->query($qry);
		if ($res){
			print "<script> alert('Producto agregado correctamente!');
                window.location.replace('admin.php'); </script>";
		} else {
			print "<script> alert('Ha ocurrido un problema!');
                window.location.replace('admin.php'); </script>";
		}
	}
	if (isset($_POST['fcb'])){
		$q = "SELECT MAX(id_prod) 'id' FROM productos;";
		$r = $db_connection->query($q);
		$r2 = $r->fetch_assoc();
		if (isset($_POST['alcs'])){
			$qry = "INSERT INTO bebidas VALUES (".$r2['id'].", 1);";
			$res = $db_connection->query($qry);
			if ($res){
				print "<script> alert('Producto agregado correctamente!');
	                window.location.replace('admin.php'); </script>";
			} else {
				print "<script> alert('Ha ocurrido un problema!');
	                window.location.replace('admin.php'); </script>";
			}
		}
		if (isset($_POST['alcn'])){
			$qry = "INSERT INTO bebidas VALUES (".$r2['id'].", 0);";
			$res = $db_connection->query($qry);
			if ($res){
				print "<script> alert('Producto agregado correctamente!');
	                window.location.replace('admin.php'); </script>";
			} else {
				print "<script> alert('Ha ocurrido un problema!');
	                window.location.replace('admin.php'); </script>";
			}
		}
		
	}


?>