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
    <body onload="Load('key=<?php echo $_GET['key']?>')">
        <?php
            include_once('header.php');
        ?>
        <div class="row" style="margin-top:50px">
            <div id="archivos" class="col">
            </div>
            <div id="hilos" class="col">
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header" id="header1">
                        Crear Hilo
                    </div>
                    <div class="card-body">
                        <form class="needs-validation" novalidate="">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                   <input type="text" id="titulo" class="form-control" placeholder="Título" require>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <input type="text" id="Tag" class="form-control" placeholder="Tag (Opcional)">
                                </div>
                            </div>
                        </form>
                        <div class="mb-3">
                            <input type="text" id="cuerpo" class="form-control" maxlength="150" placeholder="Máx. 150 carácteres">
                            <button class="btn btn-secondary" type="button" id ="CrearHilo" style="float: right;"> <!-- Con este boton se desencadena la query-->
                                Crear 
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            include_once('scripts.php');
        ?>
        <script type="text/javascript">
            $("#CrearHilo").on("click", function () {
                var titulo = document.getElementById("titulo").value;
                var tag = document.getElementById("Tag").value;
                var cuerpo = document.getElementById("cuerpo").value;
                let key = 'key=<?php echo $_GET['key']?>';
                $.ajax({
                    url: "sql/crearhilo.php",
                    data: key+"&titulo="+titulo+"&cuerpo="+cuerpo+"&tag="+tag,
                    type: "POST",
                    success: function(data){
                        window.location.reload();
                    },
                    error: function(){}           
                });
                
            });
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
            function Load(id, id2) {
                $.ajax({
                    url: "sql/cursohilos.php",
                    data:id,
                    type: "POST",
                    success: function(data){
                        $("#hilos").html(data);
                    },
                    error: function(){}           
                });
                $.ajax({
                    url: "sql/cursoarchivos.php",
                    data:id,
                    type: "POST",
                    success: function(data){
                        $("#archivos").html(data);
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
            });                                    
        </script>
    </body>
</html>