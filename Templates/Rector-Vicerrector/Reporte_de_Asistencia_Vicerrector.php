<?php
  require_once '../../phps/Carga_variables.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Asistencia Departamento</title>
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
          <a class="navbar-brand" href="#"><?php echo $estado;  ?></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <?php echo $salir;  ?>
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
                  <?php require_once '../../phps/Carga_submenu.php'  ?>
                </ul>
              </div>
            </div>
        </nav>
        
        <div class="info-container-big">
          <h2>Reporte de Asistencia del Departamento</h2>
          <table class="table table-hover">
             <thead>
               <tr class="table-dark">
                 <th scope="col">Mes</th>
                 <th scope="col">Total de Faltas</th>
                 <th scope="col">Faltas Justificadas</th>
                 <th scope="col">Solo presente al inicio</th>
                 <th scope="col">Solo presente al final</th>
                 <th scope="col">Cambios de Salon</th>
               </tr>
             </thead>
             <tbody>
                <tr>
                  <td>Ene 2023</td>
                  <td>###</td>
                  <td>###</td>
                  <td>###</td>
                  <td>###</td>
                  <td>###</td>
                </tr>
                <tr>
                    <td>Feb 2023</td>
                    <td>###</td>
                    <td>###</td>
                    <td>###</td>
                    <td>###</td>
                    <td>###</td>
                </tr>
             </tbody>
           </table>
       </div>

    </div>
</body>
</html>