<?php 
    require_once '../../phps/Carga_variables.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de intervenciones externas</title>
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
                  <?php require_once '../../phps/Carga_submenu.php' ?>
                </ul>
              </div>
            </div>
        </nav>
        
        <div class="info-container-big">
           <h2>Reportes de intervenciones externas</h2>
           <table class="table table-hover">
              <thead>
                <tr class="table-dark">
                  <th scope="col">No de caso</th>
                  <th scope="col">Matr&iacute;cula</th>
                  <th scope="col">Maestro</th>
                  <th scope="col">Grupo</th>
                  <th scope="col">Materia</th>
                  <th scope="col">Motivo</th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Justificacion</th>
                  <th scope="col">Estatus</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>1113</td>
                    <td>784532</td>
                    <td>Irving Cruz</td>
                    <td>582367</td>
                    <td>Modelado</td>
                    <td>Ausentismo</td>
                    <td>12/04/23</td>
                    <td>{ Texto }</td>
                    <td> 
                      <form>
                      <button class="btn btn-success">Aceptar</button>
                      <button class="btn btn-danger">Denegar</button>
                      <form>
                    </td>
                </tr>
                <tr>
                  <td>1233</td>
                  <td>582367</td>
                  <td>Franciso Lopez</td>
                  <td>567883</td>
                  <td>Ing de Software</td>
                  <td>Reunion</td>
                  <td>15/02/23</td>
                  <td>{ Texto }</td>
                  <td> 
                    <form>
                      <button class="btn btn-success">Aceptar</button>
                      <button class="btn btn-danger">Denegar</button>
                    <form>
                  </td>
              </tr>
              </tbody>
            </table>
        </div>
    </div>
</body>
</html>