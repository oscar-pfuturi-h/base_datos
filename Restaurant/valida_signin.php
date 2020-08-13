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
        echo '<p class="error">La dirección de correo electrónico ya está registrada!</p>';
    }

    if ($res->num_rows == 0) {
        $query = "INSERT INTO clientes (nombre, apellidos, correo, contrasenha) VALUES ('".$nombre."', '".$apellidos."', '".$correo."', '".$contrasenha."');";
        $res1 = $db_connection->query($query);
 
        if ($res1) {
            echo '<p class="success">Se ha registrado correctamente!</p>';
        } else {
            echo '<p class="error">Algo salió mal, vuelva a intentarlo!</p>';
        }
    }
}
 
?>