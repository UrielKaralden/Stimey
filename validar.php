<?php

$usuario = $_POST['nnombre'];
$pass = $_POST['npassword'];

if(empty($usuario) || empty($pass)){

	header("Location: index.html");

	exit();
}

$connection = mysqli_connect ("localhost", "root", "", "Stimey")
			or die("Error al conectar a la base de datos");
$consulta = "SELECT * from usuarios where Username='" . $usuario . "'";
$result = mysqli_query($connection, $consulta);

if($row = mysqli_fetch_array($result)){

	if($row['password'] == $pass){


		//Cuando el usuario se ha identificado
		// Generamos la fecha de último acceso
		date_default_timezone_set("Europe/Madrid");
		$fecha = new DateTime();
		$entrada = $fecha->format('Y-m-d H:i:s');
		$consulta = "SELECT * from usuarios where username = '".$usuario."'
			and password = '".$pass."'";
		$result = mysqli_query($connection, $consulta);
		$user_array = mysqli_fetch_array($result);
		$id_user = $user_array[0];
		$id_group = $user_array[3];
		echo "El id del usuario es: '".$id_user."'";

		$consulta = "UPDATE usuarios set lastEntry = '".$entrada."'
			where id = '".$id_user."'";
		$result = mysqli_query($connection, $consulta);
		session_start();

		$_SESSION['usuario'] = $usuario;
		$_SESSION['id'] = $id_user;
		$_SESSION['grupo'] = $id_group;

		echo "<script>alert($id_group); </script>";

		$consulta = "SELECT password from usuarios where id = '".$id_user."'";
		$result = mysqli_query($connection, $consulta);
		$row = mysqli_fetch_array($result);
		$passHash = $row[0];

		$acierto = password_verify($pass, $passHash);

		if(!$acierto)
			echo "<script>alert(\'La contraseña es incorrecta.\'); window.location = \'Index.html\';</script>";

		switch ($id_group) {
			case '1':
				// code...
				header('Location: opcionesGerente.php');
				break;

			case '2':
					// code...
				header('Location: opcionesSupervisor.php');
				break;

			case '3':
					// code...
				header('Location: Contrataciones/Contrataciones.php');
				break;

			case '4':
					// code...
				header('Location: Subcontrataciones/index.php');
				break;

			case '5':
				// code...
				header('Location: contratacion.html');
				break;

			case '6':
					// code...
				header('Location: Inmovilizado/presubir.php');
				break;
		}
	}else{
		header("Location: Index.html");
		exit();
	}
}else{
	header("Location: Index.html");
	exit();
}

?>
