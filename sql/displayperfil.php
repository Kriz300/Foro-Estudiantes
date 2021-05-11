<?php
	session_start();
	$con = pg_connect("host = localhost port=5432 dbname=Horario user=postgres password=ASD123 connect_timeout= 5");
    
    $sql = "SELECT nombre, email FROM usuarios WHERE rut = $1";
    $result = pg_query_params($con, $sql, array($_SESSION['id']));    

    $response = pg_fetch_array($result);

	if(!empty($response)) {
        echo json_encode($response);
	}
?>