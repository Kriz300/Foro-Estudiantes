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
    <body onload="Load('key=<?php echo $_GET['key']?>', 'key=<?php echo $_GET['curso']?>')">
        <?php
            include_once('header.php');
        ?>
        <div class="row" id="fila" style="margin-top:50px">
            <div id="archivos" class="col">
            </div>
            <div id="vista" class="col-6">
<!--
                <div class="card">
                    <div class="card-header" id="header1">
                        Archivo
                    </div>
                    <div class="card-body" style="height:700px;">
                        <embed height="100%" width="100%" name="" src="ER.pdf" type="application/pdf" />
                    </div>
                </div>
-->
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
            function Load(id, id2) {
                $.ajax({
                    url: "sql/vistarchivo.php",
                    data:id,
                    type: "POST",
                    success: function(data){
                        $("#vista").html(data);
                    },
                    error: function(){}           
                });
                $.ajax({
                    url: "sql/cursoarchivos.php",
                    data:id2,
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