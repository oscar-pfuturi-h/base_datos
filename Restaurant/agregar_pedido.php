<?php 
include('conexion.php');
session_start();

/*$idp = $_REQUEST['idp'];
$cant = $_REQUEST['cant'];

$qry = "SELECT id_prod FROM productos WHERE nombre = ".$_POST['nombre'].";";
$res = $db_connection->query($qry);
$row = $res->fetch_assoc();*/


$qry = "INSERT INTO consumo_cliente VALUES (".$_SESSION['id_cliente'].",".$_POST['codigo'].",".$_POST['cantidad'].");";
$res = $db_connection->query($qry);
print "<script> window.location.replace('index.php'); </script>"
?>