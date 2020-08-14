<?php 
include('conexion.php');

$qry = "DELETE FROM empleados WHERE id_empleado=".$_REQUEST['eid'].";";
$res = $db_connection->query($qry);
if ($res){
	print "<script> alert('Acción completada!');
	        window.location.replace('admin.php'); </script>";
} else{
	print "<script> alert('Ha ocurrido un problema!');
	        window.location.replace('admin.php'); </script>";
}

?>