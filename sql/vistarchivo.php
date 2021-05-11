<?php
	session_start();
	$con = pg_connect("host = localhost port=5432 dbname=Horario user=postgres password=ASD123 connect_timeout= 5");
    
    $sql = "SELECT archivos.url, archivos.tipo FROM archivos WHERE archivos.id = $1";
    $result = pg_query_params($con, $sql, array($_POST["key"]));    

	$response='';

    while($row=pg_fetch_array($result)) {
        $name = explode("/", $row["url"]);
        $nombre = explode(".",end($name));
        $response = $response . '<div class="card"> <div class="card-header" id="header1">' . $nombre[0] . '</div> <div class="card-body" style="height:700px;">';
        if ($row["tipo"]=="pdf") {
            $response = $response . '<embed height="100%" width="100%" name="" src="/pbd' . $row["url"] . '" type="application/pdf"/>';
        }
        else if ($row["tipo"]=="txt" || $row["tipo"]=="html") {
            $response = $response . '<iframe height="100%" width="100%" src="/pbd' . $row["url"] . '" scrolling="no" frameborder="0"></iframe>';
        }
        if ($row["tipo"]=="img") {
            $response = $response . "<img class='d-block' height='100%' width='100%' src='/pbd" . $row["url"] . "'>";
        }
	}
	$response = $response . '</div> </div>';

	if(!empty($response)) {
		print $response;
	}
?>