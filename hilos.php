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
    <body onload="FullLoad()">
        <?php
            include_once('header.php');
        ?>
        <div class="row" id="fila" style="margin-top:50px">
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
                <div class="col">
                    <div class="card">
                        <div class="card-header" id="header1">
                            <center>Tablero</center>
                        </div>
                    </div>
                    <div id="hilo" class="card">
                        <!--Hay que ver como colocar bien el orden de los comentario (seguramente con un foreach recorriendo la BD)-->
                        <div class="card-header">
                            Texto hilo.
                            <div class="card-body">
                                <li class="list-group-item" id="botones">
                                    <input type="text" class="form-control" name="" id="" aria-describedby="" placeholder="Comentario..."> <!-- caja para escribir el comentario -->
                                </li>   
                                <ul class="list-group list-group-horizontal justify-content-end">
                                    <li class="list-group-item" id="botones">
                                        <button  class="btn btn-secondary" type="submit"><i class="fas fa-comment-dots">comentar</i></button> <!-- buton submit (hay que hacer la conexion entre este boton y la caja) -->
                                    </li> 
                                    <li class="list-group-item" id="botones">
                                        <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fas fa-comments">
                                                <span class="badge badge-light"> 6 </span> <!-- numero de comentarios -->
                                            </i>
                                        </button>
                                    </li>
                                    <li class="list-group-item" id="botones">
                                        <form action="#">
                                            <button  class="btn btn-secondary" type="submit" style="float: right;" value="like">
                                                <i class="fas fa-thumbs-up">
                                                    <span class="badge badge-light"> 150 </span> <!-- aqui debe ir el contador o la referencia a la query para sacar los likes -->
                                                </i>
                                            </button>
                                        </form>
                                    </li>
                                    <li class="list-group-item" id="botones">
                                        <form action="#">
                                            <button  class="btn btn-secondary" type="submit" style="float: right;" value="dislike">
                                                <i class="fas fa-thumbs-down">
                                                    <span class="badge badge-light"> 3 </span> <!-- aqui debe ir el contador o la referencia a la query para sacar los dislikes -->
                                                </i>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <ul class="list-group list-group-flush">
                                        <div class="card-title" style="color: black;"> 
                                            texto primer comentario
                                        </div>
                                        <div class="card-body">
                                            <li class="list-group-item" id="botones">
                                                <input type="text" class="form-control" name="" id="" aria-describedby="" placeholder="Comentario..."> <!-- caja para escribir el comentario -->
                                            </li>   
                                            <ul class="list-group list-group-horizontal justify-content-end">
                                                <li class="list-group-item" id="botones">
                                                    <button  class="btn btn-secondary" type="submit"><i class="fas fa-comment-dots">comentar</i></button> <!-- buton submit (hay que hacer la conexion entre este boton y la caja) -->
                                                </li> 
                                                <li class="list-group-item" id="botones">
                                                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                                                        <i class="fas fa-comments">
                                                            <span class="badge badge-light"> 1 </span>
                                                        </i>
                                                    </button>
                                                </li>
                                                <li class="list-group-item" id="botones">
                                                    <form action="#">
                                                        <button  class="btn btn-secondary" type="submit" style="float: right;" value="like">
                                                            <i class="fas fa-thumbs-up">
                                                                <span class="badge badge-light"> 10 </span> <!-- pasa lo mismo acá -->
                                                            </i>
                                                        </button>
                                                    </form>
                                                </li>
                                                <li class="list-group-item" id="botones">
                                                    <form action="#">
                                                        <button  class="btn btn-secondary" type="submit" style="float: right;" value="dislike">
                                                            <i class="fas fa-thumbs-down">
                                                                <span class="badge badge-light"> 30 </span><!-- pasa lo mismo acá -->
                                                            </i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="collapse" id="collapseExample2">
                                        <!--sub comentario-->
                                            <div class="card card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item" style="color: black;">
                                                        subcomentario
                                                    </li>
                                                </ul>
                                                <ul class="list-group list-group-horizontal justify-content-end">
                                                    <li class="list-group-item" id="botones">
                                                        <form action="#">
                                                            <button  class="btn btn-secondary" type="submit" style="float: right;" value="like">
                                                                <i class="fas fa-thumbs-up">
                                                                    <span class="badge badge-light"> 20 </span>
                                                                </i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li class="list-group-item" id="botones">
                                                        <form action="#">
                                                            <button  class="btn btn-secondary" type="submit" style="float: right;" value="dislike">
                                                                <i class="fas fa-thumbs-down">
                                                                    <span class="badge badge-light"> 10 </span> 
                                                                </i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div><!--fin-->
                                        </div><!--agregado-->
                                    </ul>
                                    <ul class="list-group list-group-flush">
                                        <div class="card-title" style="color: black;"> 
                                            texto segundo comentario
                                        </div>
                                        <div class="card-body">
                                            <li class="list-group-item" id="botones">
                                                <input type="text" class="form-control" name="" id="" aria-describedby="" placeholder="Comentario..."> <!-- caja para escribir el comentario -->
                                            </li>   
                                            <ul class="list-group list-group-horizontal justify-content-end">
                                                <li class="list-group-item" id="botones">
                                                    <button  class="btn btn-secondary" type="submit"><i class="fas fa-comment-dots">comentar</i></button> <!-- buton submit (hay que hacer la conexion entre este boton y la caja) -->
                                                </li> 
                                                <li class="list-group-item" id="botones">
                                                    <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                                                        <i class="fas fa-comments">
                                                            <span class="badge badge-light"> 1 </span>
                                                        </i>
                                                    </button>
                                                </li>
                                                <li class="list-group-item" id="botones">
                                                    <form action="#">
                                                        <button  class="btn btn-secondary" type="submit" style="float: right;" value="like">
                                                            <i class="fas fa-thumbs-up">
                                                                <span class="badge badge-light"> 10 </span> <!-- pasa lo mismo acá -->
                                                            </i>
                                                        </button>
                                                    </form>
                                                </li>
                                                <li class="list-group-item" id="botones">
                                                    <form action="#">
                                                        <button  class="btn btn-secondary" type="submit" style="float: right;" value="dislike">
                                                            <i class="fas fa-thumbs-down">
                                                                <span class="badge badge-light"> 30 </span><!-- pasa lo mismo acá -->
                                                            </i>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="collapse" id="collapseExample1">
                                        <!--sub comentario-->
                                            <div class="card card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item" style="color: black;">
                                                        subcomentario
                                                    </li>
                                                </ul>
                                                <ul class="list-group list-group-horizontal justify-content-end">
                                                    <li class="list-group-item" id="botones">
                                                        <form action="#">
                                                            <button  class="btn btn-secondary" type="submit" style="float: right;" value="like">
                                                                <i class="fas fa-thumbs-up">
                                                                    <span class="badge badge-light"> 20 </span>
                                                                </i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li class="list-group-item" id="botones">
                                                        <form action="#">
                                                            <button  class="btn btn-secondary" type="submit" style="float: right;" value="dislike">
                                                                <i class="fas fa-thumbs-down">
                                                                    <span class="badge badge-light"> 10 </span> 
                                                                </i>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div><!--fin-->
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
            </div>
        </div>
        <?php
            include_once('scripts.php');
        ?>
        <script type="text/javascript">
            function myFunction(id) {
                $.ajax({
                    url: "sql/notificaciones.php",
                    data: id,
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
            function FullLoad() {
                myFunction("key=body");
                let key = 'key=<?php echo $_GET['key']?>';
                $.ajax({
                    url: "sql/hilosslep.php",
                    data: key,
                    type: "POST",
                    success: function(data){
                        $("#hilo").html(data);
                        $('script[src="js/likeit.js"]').remove();
                        $('<script>').attr('src', "js/likeit.js").appendTo('head');
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