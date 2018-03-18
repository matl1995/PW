<?php
	$servername = "localhost";
	$username = "pw_71358141";
	$password = "1995miguel";
	$dbname = "pw_71358141";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die(phpAlert("Conexión a base de datos fallida:'.conn->connect_error.'"));
	}

	$conn->query("SET NAMES 'utf8'");

	$name = $_POST['nombre'];
	$lastname = $_POST['apellidos'];
	$user = $_POST['usuario'];
	$password = $_POST['contrasenia'];
	$imagen = "imagenes/juan.jpg";

	$sql = "INSERT INTO `pw_71358141`.`usuarios` (`user`, `name`, `lastname`, `password`, `pic`,`activo`,`email`,`telefono`) 
	VALUES ('$user', '$name', '$lastname', '$password', '$imagen',1,NULL,NULL)";

	if ($conn->query($sql) === TRUE) {
		session_start();
		$_SESSION['usuario']=$user;
		header('Location: ../portada.php');
		} else {
	    echo "Error en la inserción";
	    header('Location: ../index.php');
	}

	$conn->close();
?>