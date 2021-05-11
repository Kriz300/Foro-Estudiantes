<?php
	$conn = pg_connect("host = localhost port=5432 dbname=Horario user=postgres password=ASD123 connect_timeout= 5");
	
	if ($_POST['tipo'] == "1") {
		
		$sql = "SELECT hilos.rut FROM hilos WHERE id = $1";
		$result = pg_query_params($conn, $sql,array($_POST['hilo']));
		$row = pg_fetch_array($result);

		$sql = "INSERT INTO notificaciones VALUES (default,$1,$2,$3,$4,$5,$6)";
		pg_query_params($conn, $sql,array($row["rut"], $_POST['hilo'], null, $_POST['tipo'], 0, null));
	}

	if ($_POST['tipo'] == "0") {
		$sql = "INSERT INTO notificaciones VALUES(default,$1,$2,$3,$4,$5,$6)";
		pg_query_params($conn, $sql,array($_SESSION["id"], null, $_POST["sigla"], $_POST['tipo'], 0, null));
	}
	
?>
