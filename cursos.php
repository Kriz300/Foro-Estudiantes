<?php
    session_start();
    if (!isset($_SESSION["usuario"])) {
        header("Location: /pbd");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/owl.carousel.min.css">
        <link rel="stylesheet" href="css/owl.theme.default.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://kit.fontawesome.com/d0975da095.js" crossorigin="anonymous"></script>
    </head>
    <body onload="Load()">
        <?php
            include_once('header.php');
        ?>
        <select id="type">
			<option value="key=inscritos">Inscritos</option>
			<option value="key=noinscritos">No Inscritos</option>
		</select>
        <div class="container nt-5 nb-5">
            <div id="carousel-list" class="owl-carousel owl-theme">
            </div>
        </div>
        
        <?php
            include_once('scripts.php');
        ?>
        <script>
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
            function Load() {
                var posicion = document.getElementById("type").options.selectedIndex;
                var op = document.getElementById("type").options[posicion].value;
                $.ajax({
                    url: "sql/listcursos.php",
                    data: op,
                    type: "POST",
                    success: function(data){
                        $("#carousel-list").html(data);
                        $('script[src="js/owl.carousel.min.js"]').remove();
                        $('<script>').attr('src', "js/owl.carousel.min.js").appendTo('head');
                        $('script[src="js/jquery.mousewheel.min.js"]').remove();
                        $('<script>').attr('src', "js/jquery.mousewheel.min.js").appendTo('head');
                        $('script[src="js/carousel.js"]').remove();
                        $('<script>').attr('src', "js/carousel.js").appendTo('head');
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