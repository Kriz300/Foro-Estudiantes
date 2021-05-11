<?php
	session_start();
	$con = pg_connect("host = localhost port=5432 dbname=Horario user=postgres password=ASD123 connect_timeout= 5");
    
    $sql = "SELECT archivos.url, archivos.id FROM archivos WHERE archivos.sigla = $1";
    $result = pg_query_params($con, $sql, array($_POST["key"]));
    
    $sql = "SELECT cursos.nombre FROM cursos where cursos.sigla = $1";
    

	$response='<div class="card"> <div class="card-header" id="header1"> Archivos - ' . pg_fetch_array(pg_query_params($con, $sql,array($_POST["key"])))["nombre"] . '</div> <div class="list-group">';

    while($row=pg_fetch_array($result)) {
        $response = $response . '<a href="archivo.php?key=' . $row["id"] . '&curso=' . $_POST["key"] .'" class="list-group-item list-group-item-action"> <p class="mb-1">';
        $name = explode("/", $row["url"]);
        $nombre = explode(".",end($name));
        $response = $response . $nombre[0] . '</p> </a>';
	}
	$response = $response . '</div> </div>';

	if(!empty($response)) {
		print $response;
	}
?>