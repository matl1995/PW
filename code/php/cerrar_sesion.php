<?php
	session_start();

	$servername = "localhost";
	$username = "pw_71358141";
	$password = "1995miguel";
	$dbname = "pw_71358141";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Conexión a base de datos fallida");
	}

	$conn->query("SET NAMES 'utf8'");

	$usuario=$_SESSION["usuario"];

	$resultado = $conn->query('SELECT `user` FROM `usuarios`');
	if (!$resultado) {
    	die('No se pudo consultar:' . mysql_error());
	}
	
	$encontrado=0;
	while($row = $resultado->fetch_assoc()) {
		if($usuario==$row["user"])
		{
			$encontrado=1;
			$sql = $conn->query("UPDATE `pw_71358141`.`usuarios` SET `activo`=0 WHERE `user`='$usuario'");

			if ($sql == 1) {
				//Elimino todas las variables de sesion
				session_unset(); 
				//Elimino la sesion
				session_destroy(); 
				header('Location: ../index.php');
				} else {
			    echo "Error en al cerrar sesion";
			    header('Location: ../index.php');
			}
		}
	}
	if($encontrado==0)
	{
		echo "Hay un error en usuario";
		header('Location: ../index.php');
	}

	$conn->close();
?>