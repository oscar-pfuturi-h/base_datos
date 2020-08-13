<?php 
include('conexion.php');
session_start();

$correo = $_POST['correo'];
$contrasenha = $_POST['contrasenha'];

/*$hash = password_hash($contrasenha, CRYPT_BLOWFISH); //encriptar
if (password_verify($contrasenha, $hash)) {
    echo '¡La contraseña es válida!';
} else {
    echo 'La contraseña no es válida.';
}*/

// admins
$res = mysqli_query($db_connection, "SELECT e.nombre, e.apellidos, e.turno, 
											c.correo, c.contrasenha 
									FROM cajero c
									INNER JOIN empleados e ON e.id_empleado = c.id_cajero 
									WHERE c.correo = '".$correo."' AND c.contrasenha = '".$contrasenha."';");


if (!empty($res) && mysqli_num_rows($res) > 0){
	$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
	
	$_SESSION['loggedin'] = true;
	$_SESSION['nombre'] = $row['nombre'];
	$_SESSION['apellidos'] = $row['apellidos'];
	$_SESSION['turno'] = $row['turno'];
	$_SESSION['correo'] = $row['correo'];
	header('Location: admin.php');
	exit();
}

//clients
$res = mysqli_query($db_connection, "SELECT id_cliente, nombre, apellidos, correo, contrasenha 
									FROM clientes 
									WHERE correo = '".$correo."';");

if (!empty($res) && mysqli_num_rows($res) > 0){
	$row = mysqli_fetch_array($res, MYSQLI_ASSOC);
	if (strcmp($contrasenha, $row['contrasenha']) === 0){
		$_SESSION['loggedin'] = true;
		$_SESSION['id_cliente'] = $row['id_cliente'];
		$_SESSION['nombre'] = $row['nombre'];
		$_SESSION['apellidos'] = $row['apellidos'];
		$_SESSION['correo'] = $row['correo'];
		header('Location: index.php');
	} 
	else {
		print "<script> alert('Correo o contraseña incorrectos!');
				window.location.replace('iniciasesion.php'); </script>";
	}
} else {
	print "<script> alert('Correo o contraseña incorrectos!');
			window.location.replace('iniciasesion.php'); </script>";
}

mysqli_close($db_connection);
?>