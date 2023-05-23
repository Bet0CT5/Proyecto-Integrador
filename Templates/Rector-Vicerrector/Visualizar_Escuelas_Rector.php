<?php
  require_once '../../phps/Carga_variables.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar Departamentos</title>
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
                    <?php require_once '../../phps/Carga_submenu.php';  ?>
                </ul>
              </div>
            </div>
        </nav>
        <div class="body-container">
          <h3>Visualizar Escuelas</h3>
            <select name="Escuelas" id="escu">
                <option value="Arquitectura_y_ciencias">Arquitectura y ciencias del habitat</option>
                <option value="Arte">Arte y Dise&ntilde;o</option>
                <option value="Salud">Ciencias de Salud</option>
                <option value="Derecho">Derecho y Ciencias Sociales</option>
                <option value="Educacion">Educacion y Humanidades</option>
                <option value="Ingenieria">Ingenieria y tecnologia</option>
                <option value="Negocios">Negocios</option>
            </select>

              <input type="submit" value="Seleccionar" onclick="location.href='./Reporte_de_Asistencia_Rector.html'">
        </div>
    </div>
</body>
</html>