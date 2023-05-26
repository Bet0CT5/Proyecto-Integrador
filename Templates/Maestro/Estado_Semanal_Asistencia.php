<?php
  
  require_once '../../phps/Carga_variables.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado Semanal de Asistencia</title>
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
        <div class="info-container-big">
          <h2 style="text-align: center;"> Estado semanal de asistencia</h2>
          <table class="table table-hover">
  <tbody>
    <tr class="table-dark">
      <td>ID</td>
      <td>CRN</td>
      <td>Materia</td>
      <td>Fecha</td>
      <td>Presente Inicio</td>
      <td>Presente Final</td>
    </tr>
    <?php
          require_once '../../phps/conexionBD.php';

          $sql = $conn->prepare("SELECT id_asistencia, asistencia.crn_grupo, nombre_materia, fecha, presente_inicio, presente_final
          FROM asistencia INNER JOIN grupo ON asistencia.crn_grupo=grupo.crn_grupo 
          INNER JOIN materia ON grupo.clave_materia=materia.clave_materia AND grupo.id_departamento=materia.id_departamento
          WHERE id_maestro=:id");
          $sql->bindValue(":id", $id);
          $sql->execute();

          $mensaje = 'N/A';

          while($fila = $sql->fetch(PDO::FETCH_ASSOC)){
            if($fila['presente_inicio'] == null){
              $fila['presente_inicio'] = $mensaje;
            }
  
            if($fila['presente_final'] == null){
              $fila['presente_final'] = $mensaje;
            }
               echo '<tr>
                  <td>'.$fila['id_asistencia'].'</td>
                  <td>'.$fila['crn_grupo'].'</td>
                  <td>'.$fila['nombre_materia'].'</td>
                  <td>'.$fila['fecha'].'</td>
                  <td>'.
                      substr($fila['presente_inicio'], 0, 5).'</td>
                  <td>'.
                     substr($fila['presente_final'], 0, 5).'</td>'
               .'</tr>';
  
  
              }
  ?>
  </tbody>
</table>
        </div>
    </div>
</body>
</html>