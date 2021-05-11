<?php
    session_start();
    $con = pg_connect("host = localhost port=5432 dbname=Horario user=postgres password=ASD123 connect_timeout= 5");
	
	$sql = "INSERT INTO Comentarios VALUES (default,$1,$2,$3,$4,$5,$6)";
    pg_query_params($con, $sql, array($_SESSION["id"], $_POST["hilo"], $_POST["res"], $_POST["cuerpo"], 0, 0));
?>