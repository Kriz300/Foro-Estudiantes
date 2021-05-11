<?php
    session_start();
    $con = pg_connect("host = localhost port=5432 dbname=Horario user=postgres password=ASD123 connect_timeout= 5");
	
	$sql = "SELECT estado_like_hilo.estadol, estado_like_hilo.estadod FROM estado_like_hilo WHERE estado_like_hilo.rut = $1 and estado_like_hilo.ID_post = $2";
    $result = pg_query_params($con, $sql, array($_SESSION["id"], $_POST["key"]));
    
    if (pg_num_rows($result) == 0) {

		$sql = "SELECT hilos.likes, hilos.dislike FROM hilos WHERE hilos.id = $1";
        $result = pg_query_params($con, $sql, array($_POST["key"]));
        $row = pg_fetch_array($result);
        $cl = (int) $row["likes"] + 1;
        $sql = "UPDATE hilos SET Likes = $2  WHERE hilos.id=$1";
        pg_query_params($con, $sql, array($_POST["key"], $cl));
        $sql = "INSERT INTO estado_like_hilo VALUES (default,$1,$2,$3,$4)";
        pg_query_params($con, $sql, array($_SESSION["id"], 1, 0, $_POST["key"]));
    }
    else {
        $row = pg_fetch_array($result);
        if ($row["estadol"] == 0) {
            $sql = "SELECT hilos.likes, hilos.dislike FROM hilos WHERE hilos.id = $1";
            $result = pg_query_params($con, $sql, array($_POST["key"]));
            $row = pg_fetch_array($result);
            $cl = (int) $row["likes"] + 1;
            $sql = "UPDATE hilos SET Likes = $2  WHERE hilos.id=$1";
            pg_query_params($con, $sql, array($_POST["key"], $cl));
            $sql = "UPDATE estado_like_hilo SET estadol = $3 WHERE estado_like_hilo.Rut = $1 and estado_like_hilo.ID_Post = $2;";
            pg_query_params($con, $sql, array($_SESSION["id"], $_POST["key"], 1));
        }
    }
?>