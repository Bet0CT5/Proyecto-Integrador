<?php
  
  require_once '../../phps/Carga_variables.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportar Justificaci&oacute;n de Falta</title>
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
            <form action="" method="POST">

                <fieldset>
                    <legend>Reportar justificaci&oacute;n</legend>
                    <div class="form-group row">
                        <label for="tipoCaso" class="col-sm-2 col-form-label">Tipo de falta:</label>
                        <div class="col-sm-10">
                          <select class="form-select short-input" id="selectTipoFalta" name="selectTipoFalta">
                              <option>-- Seleccione una opci&oacute;n --</option>
                              <option>Accidente</option>
                              <option>Enfermedad</option>
                              <option>Compromiso</option>
                              <option>Imprevisto</option>
                          </select>
                        </div>  
                    </div>
                    <div class="form-group row">
                      <label for="grupo" class="col-sm-2 col-form-label">Grupo:</label>
                      <div class="col-sm-10">
                      <?php
require_once '../../phps/conexionBD.php';

$sql = $conn->prepare("SELECT * FROM grupo AS G JOIN maestro_grupo AS MG ON G.crn_grupo = MG.crn_grupo WHERE MG.id_maestro = :id_maestro");
$sql->bindParam(':id_maestro', $id);
$sql->execute();

$grupos = $sql->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $tipo_falta = $_POST['selectTipoFalta'];
  $crn_grupo = $_POST['selectGrupo'];
  $justificacion = $_POST['exampleTextarea'];
  $id_gestor = rand(1, 6);

  $fecha = date('Y-m-d');
  
  $sql = $conn->prepare("INSERT INTO falta_justificada (id_maestro, crn_grupo, tipo_falta, fecha, justificacion, id_gestor, estatus)
          VALUES (:id_maestro, :crn_grupo, :tipo_falta, :fecha, :justificacion, :id_gestor, 0)");
  
  $sql->bindParam(':id_maestro', $id);
  $sql->bindParam(':crn_grupo', $crn_grupo);
  $sql->bindParam(':tipo_falta', $tipo_falta);
  $sql->bindParam(':fecha', $fecha);
  $sql->bindParam(':justificacion', $justificacion);
  $sql->bindParam(':id_gestor', $id_gestor);

  if ($sql->execute()) {
    $csql = $conn->prepare("SELECT id_falta FROM falta_justificada WHERE id_maestro=:maestro AND fecha=:fecha");
    $csql->bindValue(":maestro", $id);
    $csql->bindValue(":fecha", date('Y-m-d'));
    $csql->execute();
    
    if($nuevoid = $csql->fetch(PDO::FETCH_ASSOC)){
      $mensaje = 'La justificación se ha registrado correctamente\nTu id es: '.$nuevoid['id_falta'];
      echo "<script>alert('$mensaje')
            window.location='Qr_display.php'</script>";
      
    }else{
      $mensaje = 'Parece que la justificación no se registro correctamente';
      echo "<script>alert('$mensaje')</script>";
    }
  } else {
    $mensaje = 'Ha ocurrido un error al registrar la justificación.';
    echo "<script>alert('$mensaje')</script>";
  }
}

$conn = null;

echo '<select class="form-select short-input" id="selectGrupo" name="selectGrupo">';
echo '<option>-- Seleccione una opción --</option>';

foreach ($grupos as $grupo) {
  echo '<option>' . $grupo['crn_grupo'] . '</option>';
}

echo '</select>';
?>

                      </div>  
                  </div>
                    <div class="form-group">
                        <label for="justificacionCaso" class="form-label mt-4">Explicaci&oacute;n </label>
                        <textarea class="form-control" id="exampleTextarea" name="exampleTextarea" rows="3"></textarea>
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