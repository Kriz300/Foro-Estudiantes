<?php
	session_start();
	$con = pg_connect("host = localhost port=5432 dbname=Horario user=postgres password=ASD123 connect_timeout= 5");
	$sql = "SELECT cursos.nombre, cursos.sigla, hilos.id, hilos.titulo from cursos,hilos,usuarios_cursos WHERE usuarios_cursos.rut = $1 and usuarios_cursos.sigla = cursos.sigla and hilos.sigla = usuarios_cursos.sigla ORDER BY id DESC limit 3";
	$result = pg_query_params($con, $sql, array($_SESSION["id"]));

	$response='<div class="card"><div class="card-header" id="header1"><center>Tablero</center></div></div>';
	$arr = array();
	$arr2 = array();

	while($row=pg_fetch_array($result)) {
		$flag = 0;
		$curso = $row["sigla"];
		foreach($arr as $key => $value) {
			if ($key == $curso) {
				$value[$row["id"]] = $row["titulo"];
				$arr[$key] = $value;
				$flag = 1;
			}
		}
		if ($flag == 0) {
			$arr[$curso] = array($row["id"] => $row["titulo"]);
			$arr2[$curso] = $row["nombre"];
		}
	}

	foreach($arr as $sigla => $hilo) {
		$response = $response . '<div class="card"> <div class="card-header"> <a style="text-decoration: none; color: white;" href="curso.php?key=' . $sigla . '">' . $arr2[$sigla] . '</a> </div> <ul class="list-group list-group-flush">';
		foreach ($hilo as $id => $titulo) {
			$response = $response . '<a  class="list-group-item list-group-item-action" href="hilos.php?key=' . $id . '">' . $titulo . '</a>';
		}
		$response = $response . '</ul> </div>';
	}

	if(!empty($response)) {
		print $response;
	}
?>