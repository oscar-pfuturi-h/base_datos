<?php
include('conexion.php');
 
if (isset($_POST['enviar'])) {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $contrasenha = $_POST['contrasenha'];
    //$password_hash = password_hash($password, PASSWORD_BCRYPT);
 
    $query = "SELECT * FROM clientes WHERE correo='".$correo."';";
    $res = $db_connection->query($query);
    //$query->bindParam("email", $email, PDO::PARAM_STR);
    //$rows = $res->fetch_assoc();
    if ($res->num_rows > 0) {
        print "<script> alert('La dirección de correo electrónico ya está registrada!');
                window.location.replace('registrarse.php'); </script>";
    }

    if ($res->num_rows == 0) {
        $query = "INSERT INTO clientes (nombre, apellidos, correo, contrasenha) VALUES ('".$nombre."', '".$apellidos."', '".$correo."', '".$contrasenha."');";
        $res1 = $db_connection->query($query);
 
        if ($res1) {
            print "<script> alert('Se ha registrado correctamente!');
                window.location.replace('index.php'); </script>";
        } else {
            print "<script> alert('Ha ocurrido un problema!');
                window.location.replace('registrarse.php'); </script>";
        }
    }
}
 
?>