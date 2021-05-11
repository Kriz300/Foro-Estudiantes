<?php
include_once('header.php');
?>
  <div class="row" style="margin-top:50px">
    <div class="col">
    </div>
    <div class="col-9">
      <div class="card">
        <div class="card-header" id="header1">
          Archivos - Nombre del curso
        </div>
        <div class="card-body">
          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action">
              Archivo 1
            </a>
            <a href="#" class="list-group-item list-group-item-action">
              Archivo 2
            </a>
            <a href="#" class="list-group-item list-group-item-action">
              Archivo 3
            </a>
            <ul class="list-group list-group-horizontal justify-content-end">
              <li class="list-group-item" id="botones">
                <!-- Boton para el collapse -->
                <button class="btn btn-secondary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="float: right;">
                  Subir archivo 
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- Input para subir archivo -->
      <div class="collapse" id="collapseExample">
        <ul class="list-group list-group-horizontal justify-content-end">
          <input type="file" class="form-control" name="" id="SubirArchivo" aria-describedby="" placeholder="Max 150 carácteres" maxlength="158" style="width: 100%;">
          <button class="btn btn-secondary" type="button" id ="" style="float: right;"> <!-- Con este boton se desencadena la query-->
            Enviar 
          </button>
        </ul>
      </div>
    </div>
    <div class="col">
    </div>
  </div>
<?php
include_once('footer.php');
?>