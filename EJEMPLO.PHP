<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
</head>
<body>

<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModalGrupos">Open Modal</button>
</div>


  <!-- Modal -->
  <div class="modal fade" id="myModalGrupos" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content modal_grupo">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <p class="h4 modal-title">Crear grupo</p>
        </div>
        <div class="modal-body">
          <form id="new_grupo" method="post" action="EJEMPLO.PHP">
            <!--Nombre del grupo-->
            <div class="form-group">
              <label for="nombre_grupo">Nombre del grupo</label>
              <input type="text" class="form-control" id="nombre_grupo" name="nombre_grupo" autofocus>
            </div>
            <!--Tipo de musica-->
            <div class="form-group">
              <label for="tipo_musica">Elige tipo de música</label>
              <select class="form-control" id="tipo_musica" name="tipo_musica">
                <option value="Pop">Pop</option>
                <option value="Rock">Rock</option>
                <option value="Jazz">Jazz</option>
                <option value="Blues">Blues</option>
                <option value="Rap">Rap</option>
                <option value="Electrónica">Electrónica</option>
                <option value="Clásica">Clásica</option>
                <option value="Reggaeton">Reggaeton</option>
                <option value="Reggae">Reggae</option>
              </select>
            </div>  
            <!--Edad-->
            <div class="container">
              <div class="form-group form-inline">
                <div class="col-sm-2">
                  <label for="edad_min">Edad mínima</label>
                  <input type="text" class="form-control" id="edad_min" name="edad_min">
                </div>
                <div class="col-sm-1">
                </div>
                <div class="col-sm-2">
                  <label for="edad_max">Edad máxima</label>
                  <input type="text" class="form-control" id="edad_max" name="edad_max">
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-info" data-dismiss="modal">Crear</button>
        </div>
      </div>
      
    </div>
  </div>

</body>
</html>
