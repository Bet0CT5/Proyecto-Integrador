<?php
  
  require_once '../../phps/Carga_variables.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportar cambio de sal&oacute;n</title>
    <link rel="stylesheet" href="../../Styles/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../../Styles/CSS/Styles.css">
</head>
<body>
    <div class="header">
        <h1 class="title">Asistencia QR UDEM</h1>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-black nav">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><img src="../../Styles/Images/email-white-32px.png" /></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand" href="#"><?php echo $estado; ?></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <?php echo $salir; ?>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
    </nav>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav me-auto">
                  <?php 
                    require_once '../../phps/Carga_submenu.php';
                  ?>
                </ul>
              </div>
            </div>
        </nav>
        <div class="body-container">
            <form>
                <fieldset>
                    <legend>Reportar cambio de sal&oacute;n</legend>
                    <br>
                    <div class="form-group row mar-top">
                        <label for="staticMateria" class="col-sm-2 col-form-label">Materia</label>
                        <div class="col-sm-10">
                          <select class="form-select" id="mat">
                             <option>-- Selecciona una opcion -- </option>
                             <option> 2 </option>
                          </select>
                        </div>
                    </div>
                    <div class="form-group row mar-top">
                        <label for="staticSalon" class="col-sm-2 col-form-label">Nuevo Sal&oacute;n</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control short-input" id="nuevo-salon">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="staticExplicacion" class="form-label mt-4 centered">Explicacion (maximo 500 caracteres)</label>
                        <textarea class="form-control" id="explicacionDeCambio" rows="3"></textarea>
                    </div>
                </fieldset>
                <div class="btn-centered">
                    <button type="submit" class="btn btn-primary btn-lg btn-dark">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>