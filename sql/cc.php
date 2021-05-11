<?php
	session_start();
	$con = pg_connect("host = localhost port = 5432 dbname = Horario user = postgres password = ASD123 connect_timeout = 5");
    
    $sql = "UPDATE usuarios SET clave = $2 WHERE rut = $1";
    $result = pg_query_params($con, $sql, array($_SESSION['id'],$_POST["key"]));

	if(!empty($result)) {
        session_destroy();
        echo "Cambio realizado";
    }
?>