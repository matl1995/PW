<?php
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

	//Cojo las variables de url
	$usuario=$_GET['usuario'];
	$nombre=$_GET['nombre'];
	$fotoUsuario=$_GET['foto'];
	$tiempo=$_GET['tiempo'];

	//Cojo las variables post
	$titulo = $_POST['titulo'];
	$publicacion = $_POST['publicacion'];

	$sql = "INSERT INTO `pw_71358141`.`publicaciones` (`title`, `content`, `pic`, `user`, `name`,`pic-user`,`time`,`numero`) 
	VALUES ('$titulo', '$publicacion', NULL, '$usuario', '$nombre', '$fotoUsuario', '$tiempo',NULL)";

	if ($conn->query($sql) === TRUE) {
		header('Location: ../actual.php');
		} else {
	    echo "Error en la inserción";
	    header('Location: ../actual.php');
	}

	$conn->close();
?>