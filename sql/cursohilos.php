<?php
	session_start();
	$con = pg_connect("host = localhost port=5432 dbname=Horario user=postgres password=ASD123 connect_timeout= 5");
    
    $sql = "SELECT hilos.id, hilos.titulo FROM hilos where hilos.sigla = $1";
    $result = pg_query_params($con, $sql, array($_POST["key"]));
    
    $sql = "SELECT cursos.nombre FROM cursos where cursos.sigla = $1";
    

	$response='<div class="card"> <div class="card-header" id="header1"> Hilos - ' . pg_fetch_array(pg_query_params($con, $sql,array($_POST["key"])))["nombre"] . '</div> <div class="card-body"> <div class="list-group">';

    while($row=pg_fetch_array($result)) {
		$response = $response . '<a href="hilos.php?key=' . $row["id"] . '" class="list-group-item list-group-item-action"> <p class="mb-1">' . $row["titulo"] . '</p> </a>';
	}
	$response = $response . '</div> </div> </div>';

	if(!empty($response)) {
		print $response;
	}
?>