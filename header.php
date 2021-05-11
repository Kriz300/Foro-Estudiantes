<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1E1F26;">
    <a class="navbar-brand" href="/pbd/principal.php"><img src="css/img/puerta.jpg" width="30" height="30" class="d-inline-block align-top"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/pbd/principal.php">Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="/pbd/perfil.php">Perfil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Cursos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/pbd/cursos.php">Cursos</a>
                    <div class="dropdown-divider"></div>
                    <?php
                        $con = pg_connect("host = localhost port=5432 dbname=Horario user=postgres password=ASD123 connect_timeout= 5");
                        $sql = "SELECT cursos.nombre, cursos.sigla from cursos, usuarios_cursos WHERE usuarios_cursos.rut = $1 and usuarios_cursos.sigla = cursos.sigla ORDER BY id";
                        $result = pg_query_params($con, $sql, array($_SESSION["id"]));
                        while($row=pg_fetch_array($result)) {
                        ?>
                            <a class="dropdown-item" href="/pbd/curso.php?key=<?php echo $row['sigla'] ?>"><?php echo $row["nombre"] ?></a>
                        <?php
                        }
                    ?>
                </div>
            </li>
        </ul>
        <div class="nombre">
            <?php
                $count = 0;
                if (isset($_SESSION["usuario"])) {
                    echo "<a class='navbar-brand' href='/pbd/perfil.php'>Bienvenido: ".$_SESSION["usuario"]."</a>";
                    $con = pg_connect("host = localhost port=5432 dbname=Horario user=postgres password=ASD123 connect_timeout= 5");
                    $sql = "SELECT * FROM notificaciones where rut = $1 ORDER BY id DESC limit 5";
                    $result = pg_query_params($con, $sql, array($_SESSION["id"]));
                    $count = pg_num_rows($result);
                }
            ?>
        </div>
        <div class="demo-content">
            <div id="notification-header">
                <div style="position:relative">
                    <button id="notification-icon" name="button" onclick="myFunction('key=bell')" class="dropbtn"><span id="notification-count"><?php if($count>0) { echo $count; } ?></span><i class="far fa-bell"></i></button>
                    <div id="notification-latest"></div>
                </div>          
            </div>
        </div>
        <div>
            <a onclick="logout()" class='navbar-brand' href='/pbd/'>Logout</a>
            <script>
                function logout() {
                    $.ajax({
                        url: "sql/destroy.php",
                        success: function(data){
                            alert("logout");
                        },
                        error: function(){}           
                    });
                }
            </script>
        </div>
    </div>
</nav>