<?php
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

	//Cojo las variables de url
	$usuario=$_GET['usuario'];
	$numPublicacion=$_GET['numpub'];
	$nombre=$_GET['nombre'];
	$fotoUsuario=$_GET['foto'];
	$tiempo=$_GET['tiempo'];

	//Cojo las variables post
	$comentario = $_POST['comentario'];

	$sql = "INSERT INTO `pw_71358141`.`comentarios` (`numero`, `num-pub`, `user`, `name`, `pic-user`,`content`,`time`) 
	VALUES (NULL, '$numPublicacion', '$usuario', '$nombre', '$fotoUsuario', '$comentario', '$tiempo')";

	if ($conn->query($sql) === TRUE) {
		header('Location: ../publicacion.php?publicacion='.$numPublicacion.'&usuario='.$usuario);
		} else {
	    echo "Error en la inserción";
	    header('Location: ../publicacion.php?publicacion='.$numPublicacion.'&usuario='.$usuario);
	}

	$conn->close();
?>