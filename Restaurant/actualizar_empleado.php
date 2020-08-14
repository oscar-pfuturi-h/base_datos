<?php 
include('conexion.php');

	if (isset($_POST['fds'])){
		$qry = "UPDATE productos SET nombre='".$_POST['fn']."', disponible=1, precio=".$_POST['fp'].", imagen='img/".$_POST['fi']."' 
			WHERE id_prod=".$_REQUEST['pid'].";";
		$res = $db_connection->query($qry);
		if (isset($_POST['alcs'])){
			$qry = "UPDATE bebidas SET alcohol=1 WHERE id_bebida=".$_REQUEST['pid'].";";
			$res = $db_connection->query($qry);
			if ($res){
				print "<script> alert('Producto actualizado correctamente!');
	                window.location.replace('admin.php'); </script>";
			} else {
				print "<script> alert('Ha ocurrido un problema!');
	                window.location.replace('admin.php'); </script>";
			}
		}
		if (isset($_POST['alcn'])){
			$qry = "UPDATE bebidas SET alcohol=0 WHERE id_bebida=".$_REQUEST['pid'].";";
			$res = $db_connection->query($qry);
			if ($res){
				print "<script> alert('Producto actualizado correctamente!');
	                window.location.replace('admin.php'); </script>";
			} else {
				print "<script> alert('Ha ocurrido un problema!');
	                window.location.replace('admin.php'); </script>";
			}
		}
	} 
	if (isset($_POST['fdn'])){
		$qry = "UPDATE productos SET nombre='".$_POST['fn']."', disponible=0, precio=".$_POST['fp'].", imagen='img/".$_POST['fi']."' 
			WHERE id_prod=".$_REQUEST['pid'].";";
		$res = $db_connection->query($qry);
		if (isset($_POST['alcs'])){
			$qry = "UPDATE bebidas SET alcohol=1 WHERE id_bebida=".$_REQUEST['pid'].";";
			$res = $db_connection->query($qry);
			if ($res){
				print "<script> alert('Producto actualizado correctamente!');
	                window.location.replace('admin.php'); </script>";
			} else {
				print "<script> alert('Ha ocurrido un problema!');
	                window.location.replace('admin.php'); </script>";
			}
		}
		if (isset($_POST['alcn'])){
			$qry = "UPDATE bebidas SET alcohol=0 WHERE id_bebida=".$_REQUEST['pid'].";";
			$res = $db_connection->query($qry);
			if ($res){
				print "<script> alert('Producto actualizado correctamente!');
	                window.location.replace('admin.php'); </script>";
			} else {
				print "<script> alert('Ha ocurrido un problema!');
	                window.location.replace('admin.php'); </script>";
			}
		}
	}
		
?>