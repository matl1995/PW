<?php
	
	session_start();

	//Ahora hago la insercion de la publicacion en el servidor
	$servername = "localhost";
	$username = "pw_71358141";
	$password = "1995miguel";
	$dbname = "pw_71358141";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Conexión a base de datos fallida:'.conn->connect_error.'");
	}

	$conn->query("SET NAMES 'utf8'");


	$usuario=$_POST['usuario'];
	$nombre=$_POST['nombre'];
	$apellidos=$_POST['apellidos'];
	$email=$_POST['email'];
	$telefono=$_POST['telefono'];
	$password = $_POST['contrasenia'];

	//Obtengo la variable de sesion
	$user=$_SESSION["usuario"];

	//Compruebo si hay que cambiar el usuario
	if($usuario!=NULL)
	{
		$sql="UPDATE `pw_71358141`.`usuarios` SET `user`='$usuario' WHERE `user`='$user' ";

		if ($conn->query($sql) === TRUE) {
			echo "Usuario actualizado";
			} else {
	    	echo "Error en la actualizacion de usuario";
		}
		$_SESSION["usuario"]=$usuario;
	}

	//Compruebo si hay que cambiar el nombre
	if($nombre!=NULL)
	{
		$sql="UPDATE `pw_71358141`.`usuarios` SET `name`='$nombre' WHERE `user`='$user' ";

		if ($conn->query($sql) === TRUE) {
			echo "Nombre actualizado";
			} else {
	    	echo "Error en la actualizacion de nombre";
		}
	}

	//Compruebo si hay que cambiar los apellidos
	if($apellidos!=NULL)
	{
		$sql="UPDATE `pw_71358141`.`usuarios` SET `lastname`='$apellidos' WHERE `user`='$user' ";

		if ($conn->query($sql) === TRUE) {
			echo "Apellidos actualizados";
			} else {
	    	echo "Error en la actualizacion de los apellidos";
		}
	}

	//Compruebo si hay que cambiar el email
	if($email!=NULL)
	{
		$sql="UPDATE `pw_71358141`.`usuarios` SET `email`='$email' WHERE `user`='$user' ";

		if ($conn->query($sql) === TRUE) {
			echo "Email actualizado";
			} else {
	    	echo "Error en la actualizacion de email";
		}
	}

	//Compruebo si hay que cambiar el telefono
	if($telefono!=NULL)
	{
		$sql="UPDATE `pw_71358141`.`usuarios` SET `telefono`='$telefono' WHERE `user`='$user' ";

		if ($conn->query($sql) === TRUE) {
			echo "Telefono actualizado";
			} else {
	    	echo "Error en la actualizacion de telefono";
		}
	}

	//Compruebo si hay que cambiar la contraseña
	if($password!=NULL)
	{
		$sql="UPDATE `pw_71358141`.`usuarios` SET `password`='$password' WHERE `user`='$user' ";

		if ($conn->query($sql) === TRUE) {
			echo "Contraseña actualizada";
			} else {
	    	echo "Error en la actualizacion de contraseña";
		}
	}

	header('Location: ../actual-informacion.php');


	$conn->close();
?>