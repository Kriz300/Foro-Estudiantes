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
    <body onload="Load()">
        <?php
            include_once('header.php');
        ?>
        <div class="row" style="margin-top:50px;">
            <div class="col">
            </div>
            <div class="col-md-8">
                <h4 class="mb-3">Perfil</h4>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">Nombre <span class="text-muted"></span></label>
                        <input type="text" id="name" class="form-control" placeholder="Name" disabled value="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">Apellido </label>
                        <input type="text" id="lastname" class="form-control" placeholder="Last Name" disabled value="">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email">Email <span class="text-muted"></span></label>
                    <input type="text" id="email" class="form-control" placeholder="Email Address" disabled value="">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-expiration">Contraseña</label>
                        <input type="password" class="form-control" name="password" id="password"/>
                        <div class="invalid-feedback">
                            Expiration date required
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-cvv">Repetir contraseña</label>
                            <input type="password" class="form-control" name="cfmPassword" id="cfmPassword"/>
                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" onclick="validar()">Cambiar Contraseña</button>
            </div>
            <div class="col">
            </div>
        </div>
        <?php
            include_once("scripts.php");
        ?>
        <script type="text/javascript">
            function Load() {
                $.ajax({
                    url: "sql/displayperfil.php",
                    dataType: "json",
                    type: "POST",
                    success: function(data){
                        const fn = data["nombre"].split(" ");
                        document.getElementById("name").value=fn[0];
                        document.getElementById("lastname").value=fn[1];
                        document.getElementById("email").value=data["email"];
                    },
                    error: function(){}           
                });
            }
            function validar(){
                var p1 = document.getElementById("password").value;
                var p2 = document.getElementById("cfmPassword").value;
                var espacios = false;
                var cont = 0;
                while (!espacios && (cont < p1.length)) {
                    if (p1.charAt(cont) == " "){
                        espacios = true;
                        cont++;
                    }
                    if (espacios) {
                        alert ("La contraseña no puede contener espacios en blanco");
                        return false;
                    }
                    if (p1.length == 0 || p2.length == 0) {
                        alert("Los campos de la password no pueden quedar vacios");
                        return false;
                    }
                    if (p1 != p2) {
                        alert("Las passwords deben de coincidir");
                        return false;
                    } 
                    else {
                        $.ajax({
                            url: "sql/cc.php",
                            data: "key="+p1,
                            type: "POST",
                            success: function(data){
                                alert(data);
                                window.location.replace("");
                            },
                            error: function(){
                                alert("algo fallo ¯\\_(ツ)_/¯");
                            }
                        });
                        return true;
                    }
                }
            }
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
            });                                    
        </script>
    </body>
</html>