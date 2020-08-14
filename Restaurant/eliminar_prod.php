<?php 
include('conexion.php');

$qry = "DELETE FROM productos WHERE id_prod=".$_REQUEST['pid'].";";
$res = $db_connection->query($qry);
if ($res){
	print "<script> alert('Se ha eliminado el producto!');
	        window.location.replace('admin.php'); </script>";
} else{
	print "<script> alert('Ha ocurrido un problema!');
	        window.location.replace('admin.php'); </script>";
}

?>