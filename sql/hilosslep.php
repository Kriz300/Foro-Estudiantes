<?php
	session_start();

	$id_hilo = $_POST["key"];

	$con = pg_connect("host = localhost port=5432 dbname=Horario user=postgres password=ASD123 connect_timeout= 5");
	
	$sql = "SELECT hilos.id, hilos.cuerpo FROM hilos where hilos.id = $1";
	$result = pg_query_params($con, $sql, array($id_hilo));

	$hilo = array();
	$row=pg_fetch_array($result);
	$hilo[$row["id"]] = $row["cuerpo"];

	$sql = "SELECT comentarios.id, comentarios.cuerpo FROM comentarios WHERE comentarios.id_hilo = $1 and comentarios.id_respondido = 0 ORDER BY id";
	$result = pg_query_params($con, $sql, array($id_hilo));
	
    $sql = "SELECT comentarios.id, comentarios.cuerpo, comentarios.id_respondido FROM comentarios WHERE comentarios.id_respondido = $1 ORDER BY id";

	$comentarios = array();
	$respuestas = array();
	
	while($row=pg_fetch_array($result)) {
		$comentarios[$row["id"]] = $row["cuerpo"];
	}

	foreach ($comentarios as $key => $value) {
		$result = pg_query_params($con, $sql, array($key));
		while($row=pg_fetch_array($result)) {
			$flag = 0;
			$respuestaa = $row["id_respondido"];
			foreach($respuestas as $key => $value) {
				if ($key == $respuestaa) {
					$value[$row["id"]] = $row["cuerpo"];
					$respuestas[$key] = $value;
					$flag = 1;
				}
			}
			if ($flag == 0) {
				$respuestas[$respuestaa] = array($row["id"] => $row["cuerpo"]);
			}
		}
	}

	$sql = "SELECT hilos.likes, hilos.dislike FROM hilos WHERE hilos.id = $1";
	$result = pg_query_params($con, $sql, array($id_hilo));
	$hl = pg_fetch_array($result);

	$response = '<div class="card-header"> ' . $hilo[$id_hilo] . '<div class="card-body"> <li class="list-group-item" id="botones"> <input type="text" class="form-control" name="" id="hilo,' . $id_hilo . '" aria-describedby="" placeholder="Comentario..."> </li> <ul class="list-group list-group-horizontal justify-content-end"> <li class="list-group-item" id="botones"> <button id="hilo,' . $id_hilo . '" data ="' . $id_hilo . '" value="comentario" class="btn btn-secondary"><i class="fas fa-comment-dots">comentar</i></button> </li>';
	$response = $response . '<li class="list-group-item" id="botones"> <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> <i class="fas fa-comments"> <span class="badge badge-light">' . sizeof($comentarios) . '</span> </i> </button> </li>';
	$response = $response . '<li class="list-group-item" id="botones"> <button id="hilo,' . $id_hilo . '" data ="' . $id_hilo . '" class="btn btn-secondary" style="float: right;" value="like"> <i class="fas fa-thumbs-up"> <span class="badge badge-light">' . $hl["likes"] . '</span> </i> </button> </li> <li class="list-group-item" id="botones">';
	$response = $response . '<button id="hilo,' . $id_hilo . '" data ="' . $id_hilo . '" class="btn btn-secondary" style="float: right;" value="dislike"> <i class="fas fa-thumbs-down"> <span class="badge badge-light">' . $hl["dislike"] . '</span> </i> </button> </li> </ul> </div>';
	$response = $response . '<div class="collapse" id="collapseExample"> <div class="card card-body">';

	foreach ($comentarios as $id => $cuerpo) {

		$sql = "SELECT comentarios.likes, comentarios.dislike FROM comentarios WHERE comentarios.id = $1";
		$result = pg_query_params($con, $sql, array($id));
		$cl = pg_fetch_array($result);

		$response = $response . '<ul class="list-group list-group-flush"> <div class="card-title" style="color: black;"> ' . $cuerpo . '</div> <div class="card-body"> <li class="list-group-item" id="botones"> <input type="text" class="form-control" name="" id="comentario,' . $id . '" aria-describedby="" value="" placeholder="Comentario..."> </li> ';
		$response = $response . '<ul class="list-group list-group-horizontal justify-content-end"> <li class="list-group-item" id="botones"> <button id="comentario,' . $id . '" data ="' . $id . '" class="btn btn-secondary" value="comentario"><i class="fas fa-comment-dots">comentar</i> </button> </li> ';
		$response = $response . '<li class="list-group-item" id="botones"> <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample' . $id . '" aria-expanded="false" aria-controls="collapseExample"> <i class="fas fa-comments"> <span class="badge badge-light">';
		if (!empty($respuestas[$id])) {
			$response = $response . sizeof($respuestas[$id]);
			$response = $response . '</span> </i> </button> </li>';
			$response = $response . '<li class="list-group-item" id="botones"> <button id="comentario,' . $id . '" data ="' . $id_hilo . '" class="btn btn-secondary" style="float: right;" value="like"> <i class="fas fa-thumbs-up"> <span class="badge badge-light">' . $cl["likes"] . '</span> </i> </button> </li>';
			$response = $response . '<li class="list-group-item" id="botones"> <button id="comentario,' . $id . '" data ="' . $id_hilo . '" class="btn btn-secondary" style="float: right;" value="dislike"> <i class="fas fa-thumbs-down"> <span class="badge badge-light">' . $cl["dislike"] . '</span> </i> </button> </li> </ul> </div>';
			$response = $response . '<div class="collapse" id="collapseExample' . $id . '">';
			foreach ($respuestas[$id] as $id_res => $cuerpo_res) {

				$sql = "SELECT comentarios.likes, comentarios.dislike FROM comentarios WHERE comentarios.id = $1";
				$result = pg_query_params($con, $sql, array($id_res));
				$rl = pg_fetch_array($result);
	
				$response = $response . '<div class="card card-body"> <ul class="list-group list-group-flush"> <li class="list-group-item" style="color: black;">' . $cuerpo_res . '</li> </ul> ';
				$response = $response . '<ul class="list-group list-group-horizontal justify-content-end"> <li class="list-group-item" id="botones"> <button id="comentario,' . $id_res . '" data ="' . $id_hilo . '" class="btn btn-secondary" style="float: right;" value="like"> <i class="fas fa-thumbs-up"> <span class="badge badge-light">' . $rl["likes"] . '</span> </i> </button> </li>';
				$response = $response . '<li class="list-group-item" id="botones"> <button id="comentario,' . $id_res . '" data ="' . $id_hilo . '" class="btn btn-secondary" style="float: right;" value="dislike"> <i class="fas fa-thumbs-down"> <span class="badge badge-light">' . $rl["dislike"] . '</span> </i> </button> </li> </ul> </div> ';
			}
		}
		else {
			$response = $response . "0";
			$response = $response . '</span> </i> </button> </li>';
			$response = $response . '<li class="list-group-item" id="botones"> <button id="comentario,' . $id . '" data ="' . $id_hilo . '" class="btn btn-secondary" style="float: right;" value="like"> <i class="fas fa-thumbs-up"> <span class="badge badge-light">' . $cl["likes"] . '</span> </i> </button> </li>';
			$response = $response . '<li class="list-group-item" id="botones"> <button id="comentario,' . $id . '" data ="' . $id_hilo . '" class="btn btn-secondary" style="float: right;" value="dislike"> <i class="fas fa-thumbs-down"> <span class="badge badge-light">' . $cl["dislike"] . '</span> </i> </button> </li> </ul> </div>';
		}
		$response = $response . '</div> </ul>';
	}
	$response = $response . '</div> </div> </div>';

	if(!empty($response)) {
		print $response;
	}
?>