<?php 
$server = 'localhost';
$user = 'root';
$password = '';
$database = 'restaurant';
$db_connection = mysqli_connect($server, $user, $password, $database);

if (!$db_connection){
	die("Connection failed: " . mysqli_connect_error());
}


/*$server = 'localhost';
$connectionInfo = array('Database'=>'restaurant', 'UID'=>'root', 'PWD'=>'', 'CharacterSet'=>'UTF-8');
$connection = sqlsrv_connect($server, $connectionInfo);

if (!$connection){
	echo "Fallo de conexión.";
} else {
	echo "Conexión exitosa.";
}*/
?>