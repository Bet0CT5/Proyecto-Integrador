<?php
  require_once '../../phps/Carga_variables.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambios de Salones</title>
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
          <h2>Cambios de Salones</h2>
          <table class="table table-hover">
             <thead>
               <tr class="table-dark">
                 <th scope="col">No de Caso</th>
                 <th scope="col">Fecha</th>
                 <th scope="col">Matrícula</th>
                 <th scope="col">Nombre</th>
                 <th scope="col">Grupo</th>
                 <th scope="col">Materia</th>
                 <th scope="col">Salón Actual</th>
                 <th scope="col">Salón Nuevo</th>
               </tr>
             </thead>
             <tbody>
             <?php
require_once '../../phps/conexionBD.php';

// Realizar la consulta en la base de datos
$consulta = "SELECT r.id_reposicion, f.crn_grupo, m.nombre_materia, m.id_maestro, ma.nombre_maestro, f.fecha AS fecha_falta, r.fecha AS fecha_reposicion, r.numero_salon
             FROM reposicion r
             INNER JOIN falta_justificada f ON r.id_falta = f.id_falta
             INNER JOIN maestro ma ON f.id_maestro = ma.id_maestro
             INNER JOIN materia m ON f.crn_grupo = m.crn_grupo
             WHERE f.id_maestro = :id_maestro";
$stmt = $conn->prepare($consulta);
$stmt->bindParam(':id_maestro', $id);
$stmt->execute();

while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
  echo "<tr>";
  echo "<td>" . $fila['id_reposicion'] . "</td>";
  echo "<td>" . $fila['fecha_falta'] . "</td>";
  echo "<td>" . $fila['matricula'] . "</td>";
  echo "<td>" . $fila['nombre'] . "</td>";
  echo "<td>" . $fila['grupo'] . "</td>";
  echo "<td>" . $fila['nombre_materia'] . "</td>";
  echo "<td>" . $fila['salon_actual'] . "</td>";
  echo "<td>" . $fila['salon_nuevo'] . "</td>";
  echo "</tr>";
}

?>
             </tbody>
           </table>
       </div>

    </div>
</body>
</html>
