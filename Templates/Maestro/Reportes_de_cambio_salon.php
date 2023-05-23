<?php
  
  require_once '../../phps/Carga_variables.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambios de sal&oacute;n</title>
    <link rel="stylesheet" href="../../Styles/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../../Styles/CSS/Styles.css">
    <!-- Reportes realizados de cambios de salones (Maestro) -->
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
          <h2> Cambios de salones</h2>
          <table class="table table-hover">
  <tbody>
    <tr class="table-dark">
      <th scope="row">No de Caso</th>
      <td>CRN</td>
      <td>Materia</td>
      <td>Nuevo sal&oacute;n</td>
      <td>Fecha</td>
      <td>Estatus</td>
    </tr>
    <?php
          require_once '../../phps/conexionBD.php';
      $consulta = "SELECT cs.id_cambio, g.crn_grupo, m.nombre_materia, cs.num_nuevo_salon, cs.fecha, cs.estatus 
                   FROM cambio_salon cs
                   INNER JOIN grupo g ON cs.crn_grupo = g.crn_grupo
                   INNER JOIN materia m ON g.clave_materia = m.clave_materia
                   WHERE cs.id_maestro = :id_maestro";
      $stmt = $conn->prepare($consulta);
      $stmt->bindParam(':id_maestro', $id);
      $stmt->execute();

      while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<th scope='row'>" . $fila['id_cambio'] . "</th>";
        echo "<td>" . $fila['crn_grupo'] . "</td>";
        echo "<td>" . $fila['nombre_materia'] . "</td>";
        echo "<td>" . $fila['num_nuevo_salon'] . "</td>";
        echo "<td>" . $fila['fecha'] . "</td>";
        echo "<td>" . $fila['estatus'] . "</td>";
        echo "</tr>";
      }
    ?>
  </tbody>
</table>

        </div>
    </div>
</body>
</html>