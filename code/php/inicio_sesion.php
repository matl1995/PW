<?php
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

	$user = $_POST['usuario'];
	$password = $_POST['contrasenia'];

	$resultado = $conn->query('SELECT `user`, `password` FROM `usuarios`');
	if (!$resultado) {
    	die('No se pudo consultar:' . mysql_error());
	}
	
	$encontrado=0;
	while($row = $resultado->fetch_assoc()) {
		if($user==$row["user"] && $password==$row["password"])
		{
			$encontrado=1;
			$sql = $conn->query("UPDATE `pw_71358141`.`usuarios` SET `activo`=1 WHERE `user`='$user' AND `password`='$password'");

			if ($sql == 1) {
				session_start();
				$_SESSION['usuario']=$user;
				header('Location: ../portada.php');
				} else {
			    echo "Error en el inicio";
			    header('Location: ../index.php');
			}
		}
	}
	if($encontrado==0)
	{
		echo "Hay un error en usuario o contraseña";
		header('Location: ../index.php');
	}

	$conn->close();
?>