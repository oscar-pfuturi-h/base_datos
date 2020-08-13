<div id="log">
	<?php
	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
	?>
	<p>
		<a href="iniciasesion.php">Iniciar sesión</a>
		o
		<a href="registrarse.php">Registrarse</a>
	</p>
	<?php 
	}

	else {
		$flag = 1;
	?>
	<div id='user'>
		<div id='user_name'>
			<span><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidos']; ?></span>
		</div>
	</div>

	<?php
	}
	?>
</div>