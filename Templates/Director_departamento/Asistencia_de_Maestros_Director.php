<?php
  require_once '../../phps/Carga_variables.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistencia de maestros</title>
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
          <?php echo $salir ?>
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
                  <?php require_once '../../phps/Carga_submenu.php'; ?>
                </ul>
              </div>
            </div>
        </nav>
        
        <div class="info-container-big">
          <h2>Asistencia de Maestros</h2>
          <table class="table table-hover">
             <thead>
               <tr class="table-dark">
                 <th scope="col">Id Asistencia</th>
                 <th scope="col">Nombre Maestro</th>
                 <th scope="col">Id Maestro</th>
                 <th scope="col">Departamento</th>
                 <th scope="col">CRN Grupo</th>
                 <th scope="col">Fecha</th>
                 <th scope="col">Presente al Inicio</th>
                 <th scope="col">Presente al Final</th>
               </tr>
             </thead>
             <tbody>
                <tr>
                  <td>27567</td>
                  <td>Irving Cruz3</td>
                  <td>784532</td>
                  <td>SC Ciencias Computacionales</td>
                  <td>784532</td>
                  <td>05/04/2023</td>
                  <td>06/04/2023</td>
                  <td>06/04/2023</td>
                </tr>
                <tr>
                  <td>27567</td>
                  <td>Irving Cruz3</td>
                  <td>784532</td>
                  <td>SC Ciencias Computacionales</td>
                  <td>784532</td>
                  <td>05/04/2023</td>
                  <td>06/04/2023</td>
                  <td>06/04/2023</td>
                </tr>
                <tr>
                  <td>27567</td>
                  <td>Irving Cruz3</td>
                  <td>784532</td>
                  <td>SC Ciencias Computacionales</td>
                  <td>784532</td>
                  <td>05/04/2023</td>
                  <td>06/04/2023</td>
                  <td>06/04/2023</td>
                </tr>
                <tr>
                  <td>27567</td>
                  <td>Irving Cruz3</td>
                  <td>784532</td>
                  <td>SC Ciencias Computacionales</td>
                  <td>784532</td>
                  <td>05/04/2023</td>
                  <td>06/04/2023</td>
                  <td>06/04/2023</td>
                </tr>
                <tr>
                  <td>27567</td>
                  <td>Irving Cruz3</td>
                  <td>784532</td>
                  <td>SC Ciencias Computacionales</td>
                  <td>784532</td>
                  <td>05/04/2023</td>
                  <td>06/04/2023</td>
                  <td>06/04/2023</td>
                </tr>
             </tbody>
           </table>
       </div>

    </div>
</body>
</html>