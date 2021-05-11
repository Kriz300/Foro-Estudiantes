<?php
    session_start();
    $con = pg_connect("host = localhost port=5432 dbname=Horario user=postgres password=ASD123 connect_timeout= 5");
	
	$sql = "SELECT Estado_like_Comentario.estadol, Estado_like_Comentario.estadod FROM Estado_like_Comentario WHERE Estado_like_Comentario.rut = $1 and Estado_like_Comentario.ID_post = $2";
    $result = pg_query_params($con, $sql, array($_SESSION["id"], $_POST["key"]));
    
    if (pg_num_rows($result) == 0) {

		$sql = "SELECT comentarios.likes, comentarios.dislike FROM comentarios WHERE comentarios.id = $1";
        $result = pg_query_params($con, $sql, array($_POST["key"]));
        $row = pg_fetch_array($result);
        $cl = (int) $row["dislike"] + 1;
        $sql = "UPDATE Comentarios SET dislike = $2  WHERE comentarios.id=$1";
        pg_query_params($con, $sql, array($_POST["key"], $cl));
        $sql = "INSERT INTO Estado_like_comentario VALUES (default,$1,$2,$3,$4)";
        pg_query_params($con, $sql, array($_SESSION["id"], 0, 1, $_POST["key"]));
    }
    else {
        $row = pg_fetch_array($result);
        if ($row["estadod"] == 0) {
            $sql = "SELECT comentarios.likes, comentarios.dislike FROM comentarios WHERE comentarios.id = $1";
            $result = pg_query_params($con, $sql, array($_POST["key"]));
            $row = pg_fetch_array($result);
            $cl = (int) $row["dislike"] + 1;
            $sql = "UPDATE Comentarios SET dislike = $2  WHERE comentarios.id=$1";
            pg_query_params($con, $sql, array($_POST["key"], $cl));
            $sql = "UPDATE Estado_like_comentario SET estadod = $3 WHERE Estado_like_comentario.Rut = $1 and Estado_like_comentario.ID_Post = $2;";
            pg_query_params($con, $sql, array($_SESSION["id"], $_POST["key"], 1));
        }
    }
?>