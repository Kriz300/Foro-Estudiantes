<?php
    session_start();
    if (isset($_SESSION["usuario"])) {
        header("Location: /pbd/principal.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://kit.fontawesome.com/d0975da095.js" crossorigin="anonymous"></script>
    </head>
    <body onload="enableButton()">
        <?php
            include_once('header.php');
        ?>
        <div class="container">
            <div class="row" style="margin-top:200px">
                <div class="col"></div>
                <div class="col">
                    <form class="form-signin" action="sql/loginr.php" method="POST">
                        <h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>
                        <label for="inputEmail" class="sr-only">Correo</label>
                        <input type="email" id="mailUDP" class="form-control" name="mail" placeholder="Correo">
                        <p id="mailWarning">Solo mail udp</p><br>
                        <label for="inputPassword" class="sr-only">Contraseña</label>
                        <input type="password" id="Password" class="form-control" name="password" placeholder="Contraseña">
                        <p id="passWarning">...</p><br>
                        <button id="enviar" class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                    </form>
                </div>
                <div class="col"></div>
            </div>
        </div>
        <style>
            #mailWarning, #passWarning {color: #f00; display:none;}
            #enviar:disabled{background: #666;}
        </style>
        <?php
            include_once("scripts.php");
        ?>
        <script>
            var userField = document.getElementById("mailUDP");
            var pass = document.getElementById("Password");
            var enviarButton = document.getElementById("enviar");
            
            var user=false;
            var passcheck=false;

            function enableButton() {
                if (user && passcheck){
                    enviarButton.disabled=false;
                } else {
                    enviarButton.disabled=true;
                }	
            }

            userField.addEventListener("keyup", function() {
                if (userField.value.endsWith("mail.udp.cl")){
                    document.getElementById("mailWarning").style.display="none";
                    userField.style.background="#04cf1f";
                    user=true;
                } else {
                    document.getElementById("mailWarning").style.display="block";
                    userField.style.background="#ff0000";
                    user=false;
                }
                enableButton();
            });

            pass.addEventListener("keyup", function() {
                if (pass.length!=""){
                    document.getElementById("passWarning").style.display="none";
                    pass.style.background="#04cf1fc";
                    passcheck=true;
                } else {
                    document.getElementById("passWarning").style.display="block";
                    pass.style.background="#ff0000";
                    passcheck=false;
                }
                enableButton();
            });
        </script>
    </body>
</html>