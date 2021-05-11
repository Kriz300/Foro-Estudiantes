<?php
session_start();
$con = pg_connect("host = localhost port=5432 dbname=Horario user=postgres password=ASD123 connect_timeout= 5");

//$sql = "UPDATE datos SET estado = 1 WHERE estado = 0";	
//$result = mysqli_query($conn, $sql);

$response='';
$message = ["Nuevo hilo", "Comentario nuevo", "Nuevo anuncio", ":slep:"];

switch ($_POST["key"]) {
	case 'body':
		$sql = "SELECT * FROM notificaciones where rut = $1 ORDER BY id DESC";
		$result = pg_query_params($con, $sql, array($_SESSION["id"]));
		while($row=pg_fetch_array($result)) {
			//Extraer titulo
			if ($row["tipo"]==1) {
				$href = "hilos.php?key=" . $row["id_hilo"];
				$sql = "select titulo from hilos where id = $1";
				$titulo = pg_fetch_array(pg_query_params($con, $sql,array($row["id_hilo"])))["titulo"];
			}
			else if ($row["tipo"]==2 || $row["tipo"]==0) {
				$href = "cursos.php?key=" . $row["sigla"];
				$sql = "select nombre from cursos where sigla = $1";
				$titulo = pg_fetch_array(pg_query_params($con, $sql,array($row["sigla"])))["nombre"];
			}

			$response = $response . "<li class='list-group-item'>" .
			"<div class='notification-subject'> <a href='" . $href . "'>" . $titulo . "</a> </div>" . 
			"<div class='notification-comment'>" . $message[$row["tipo"]]  . "</li>" .
			"</div>";
		}
		$response = "body,".$response;
		break;
	
	case 'bell':
		$sql = "SELECT * FROM notificaciones where rut = $1 ORDER BY id DESC limit 5";
		$result = pg_query_params($con, $sql, array($_SESSION["id"]));
		while($row=pg_fetch_array($result)) {
			//Extraer titulo
			if ($row["tipo"]==1) {
				$href = "hilos.php?key=" . $row["id_hilo"];
				$sql = "select titulo from hilos where id = $1";
				$titulo = pg_fetch_array(pg_query_params($con, $sql,array($row["id_hilo"])))["titulo"];
			}
			else if ($row["tipo"]==2 || $row["tipo"]==0) {
				$href = "cursos.php?key=" . $row["sigla"];
				$sql = "select nombre from cursos where sigla = $1";
				$titulo = pg_fetch_array(pg_query_params($con, $sql,array($row["sigla"])))["nombre"];
			}

			$response = $response . "<li class='list-group-item'>" .
			"<div class='notification-subject'> <a href='" . $href . "'>" . $titulo . "</a> </div>" . 
			"<div class='notification-comment'>" . $message[$row["tipo"]]  . "</li>" .
			"</div>";
		}
		$response = "bell,".$response;
		break;
}

if(!empty($response)) {
	print $response;
}
?>