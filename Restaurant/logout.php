<?php 
	session_start();
	unset ($_SESSION['nombres']);
	unset ($_SESSION['correo']);
	unset ($_SESSION['loggedin']);
	session_destroy();
	header('Location: index.php');
?>