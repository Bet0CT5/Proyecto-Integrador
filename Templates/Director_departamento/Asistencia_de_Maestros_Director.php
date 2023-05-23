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
             <?php
require_once '../../phps/conexionBD.php';

// Realizar la consulta en la base de datos
$consulta = "SELECT a.id_asistencia, m.nombre_maestro, m.id_maestro, d.nombre_departamento, a.crn_grupo, a.fecha, a.presente_inicio, a.presente_final
             FROM asistencia a
             INNER JOIN maestro m ON a.id_maestro = m.id_maestro
             INNER JOIN departamento_maestro dm ON m.id_maestro = dm.id_maestro
             INNER JOIN departamento d ON dm.id_departamento = d.id_departamento
             WHERE a.id_maestro = :id_maestro";
$stmt = $conn->prepare($consulta);
$stmt->bindParam(':id_maestro', $id);
$stmt->execute();

while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
  echo "<tr>";
  echo "<td>" . $fila['id_asistencia'] . "</td>";
  echo "<td>" . $fila['nombre_maestro'] . "</td>";
  echo "<td>" . $fila['id_maestro'] . "</td>";
  echo "<td>" . $fila['nombre_departamento'] . "</td>";
  echo "<td>" . $fila['crn_grupo'] . "</td>";
  echo "<td>" . $fila['fecha'] . "</td>";
  echo "<td>" . $fila['presente_inicio'] . "</td>";
  echo "<td>" . $fila['presente_final'] . "</td>";
  echo "</tr>";
}

?>
             </tbody>
           </table>
       </div>

    </div>
</body>
</html>