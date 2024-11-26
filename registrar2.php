<!doctype html>
<html lang="es">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		
		<title>GymShark</title>
	</head>
	<body>
		<?php
			$nombre = $_POST['nombre'];
			$dni = $_POST['dni'];
			$fecha_nacimiento = $_POST['fecha_nacimiento'];
			$email = $_POST['email'];
			$telefono = $_POST['telefono'];
			$fecha_registro = $_POST['fecha_registro'];
			$contraseña = $_POST['contraseña'];
			
			//Establezco conexión
			require 'conexion.php';

			//Creo una contraseña segura en hash, que es la que introduciré en la base de datos como $encriptado, en vez de $contraseña.
			$encriptado = password_hash($contraseña,PASSWORD_DEFAULT);

			//Preparo la sentencia SQL
			$sql = "INSERT INTO cliente (nombre,dni,fecha_nacimiento,email,telefono,fecha_registro,contraseña) VALUES ('$nombre','$dni','$fecha_nacimiento','$email','$telefono','$fecha_registro','$encriptado')";

			//Ejecuto la sentencia y guardo el resultado

			$resultado = $mysqli->query($sql);

			if($resultado>0){
		?>
				<br>
				<p class="alert alert-primary"> Te has registrado con éxito.</p>				
  					

		<?php
			} else {
		?>
				<br>
  				<p class="alert alert-danger"> Usuario ya registerado, pruebe con otro correo. </p>
		<?php		
			}
		?>
			<br>
			<p><a href="login.php" class="btn btn-primary">Inicia Sesion Aquí</a></p>
	</body>
</html>