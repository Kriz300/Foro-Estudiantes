<?php
	session_start();
	$con = pg_connect("host = localhost port=5432 dbname=Horario user=postgres password=ASD123 connect_timeout= 5");
	$username = $_POST["mail"];
	$password = $_POST['password'];
	
	$sql = "SELECT * FROM usuarios WHERE email = $1;";
	$result = pg_query_params($con,$sql, array($username));
	if (pg_num_rows($result) == 1) {   
		$row = pg_fetch_array($result);
		if ($password == $row['clave']){ 
			$_SESSION['id'] = $row["rut"];
			$_SESSION['usuario'] = $row["nombre"];
			header("Location: /pbd/principal.php");
		} 
		else { 
			header("Location: /pbd/principal.php");
		}
	} 
	else { 
		header("Location: /pbd/principal.php");
	}
?>