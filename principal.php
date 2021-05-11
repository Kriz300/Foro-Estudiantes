<?php
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location: /pbd");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://kit.fontawesome.com/d0975da095.js" crossorigin="anonymous"></script>
    </head>
<!-- Contenido  -->
    <body onload="myFunction('key=body')">
        <?php
            include_once('header.php');
        ?>
        <div class="row" style="margin-top: 100px">
            <div class="col" style="margin-left: 15px" >
                <div class="card">
                    <div class="card-header" id="header1">
                        Notificaciones
                    </div>
                    <ul id="row-notificaciones" class="list-group list-group-flush">
                    </ul>
                </div>
            </div>
            <div class="col-6">
                <div id="cursos-list" class="col" style="margin-left: 10px" >
                </div>
            </div>
            <div class="col">
            </div>
        </div>
        <?php
            include_once("scripts.php");
        ?>
        <script type="text/javascript">
            function myFunction(id) {
                $.ajax({
                    url: "sql/notificaciones.php",
                    data:id,
                    type: "POST",
                    success: function(data){
                        data=data.split(",");
                        if (data[0]=='bell') {
                            $("#notification-count").remove();                  
                            $("#notification-latest").show();
                            $("#notification-latest").html(data[1]);
                        }
                        else {
                            $("#row-notificaciones").html(data[1]);
                        }
                    },
                    error: function(){}           
                });
            }
            $(document).ready(function() {
                $('body').click(function(e){
                    if ( e.target.id != 'notification-icon'){
                        $("#notification-latest").hide();
                    }
                });
                $.ajax({
                    url: "sql/datacursos.php",
                    type: "POST",
                    success: function(data){
                        $("#cursos-list").html(data);
                    },
                    error: function(){}           
                });
            });                                    
        </script>
    </body>
</html>