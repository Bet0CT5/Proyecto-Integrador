<?php
  
  require_once '../../phps/Carga_variables.php';
  require_once '../../phps/conexionBD.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programar reposici&oacute;n</title>
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
        <div class="body-container" style="width: 70%; margin-left: 15%">
            <form action="" method="POST">
                <fieldset>
                    <legend>Agenda la reposici&oacute;n</legend><br><br>

                    <table class="centered">
                        <tr>
                            <td>
                                <div class="form-group row mar-top">
                                    <label for="staticCaso" class="col-sm-2 col-form-label">No de caso:</label>
                                    <div class="col-sm-10">
                                      <input type="text" class="form-control short-input"  id="noCaso" name="noCaso">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group row">
                                    <label for="staticSalon" class="col-sm-2 col-form-label">Sal&oacute;n:</label>
                                    <div class="col-sm-10">
                                      <select class="form-select short-input" name="salon">
                                        <?php
                                            try{
                                              $sql = $conn->prepare("SELECT numero_salon FROM salon");
                                              $sql->execute();
                                              
                                              while($salones = $sql->fetch(PDO::FETCH_ASSOC)){
                                               echo '<option>'.$salones['numero_salon'].'</option>';
                                              }
                                            }catch(PDOException $e){
                                               echo "Error en la conexion al obtener los salones".$e;
                                            }
                                        ?>
                                      </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group row">
                                    <label for="staticFecha" class="col-sm-2 col-form-label">Fecha:</label>
                                    <div class="col-sm-10">
                                      <input type="date" class="form-control short-input" id="date" name="date">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group row">
                                    <label for="staticHora" class="col-sm-2 col-form-label">Hora de inicio:</label>
                                    <div class="col-sm-10">
                                      <select class="form-select short-input" name="horaInicio">
                                            <?php 
                                              try{
                                                 $sql = $conn->prepare("SELECT hora_inicio FROM grupo INNER JOIN maestro_grupo
                                                  ON grupo.crn_grupo=maestro_grupo.crn_grupo WHERE id_maestro=:id_maestro");
                                                  $sql->bindValue(":id_maestro", $id);
                                                  $sql->execute();
                                                  
                                                  while($horasDeInicio = $sql->fetch(PDO::FETCH_ASSOC)){
                                                      echo "<option>".substr($horasDeInicio['hora_inicio'], 0, 5)."</option>";
                                                  }
                                              }catch(PDOException $e){
                                                $mensaje = 'Error en la conexion al obtener las horas disponibles'.$e;
                                                echo "<script>alert('$mensaje')</script>";
                                              }
                                            
                                            ?>
                                      </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>

                </fieldset>
                <div class="btn-centered">
                    <button type="submit" class="btn btn-primary btn-lg btn-dark">Enviar</button>
                </div>
            </form>
            <?php 
                
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                  //Se recuperan los datos de las variables POST
                  $numeroDeCaso = $_POST['noCaso'];
                  $salon = $_POST['salon'];
                  $fecha = $_POST['date'];
                  $hora_de_inicio = $_POST['horaInicio'];

                  $fechaTSTObj = DateTime::createFromFormat('m/d/Y', $fecha);

                  if($fechaTSTObj !== false){
                    $fechaTST = $fechaTSTObj->format('Y-m-d');
                  }else{
                    $fechaTST = date('Y-m-d');
                  }
                  
                  $fecha = date('Y-m-d');

                  //Se comprueba que exista el id de la falta que se reportó en falta justificada.
                  $sql = $conn->prepare("SELECT id_falta FROM falta_justificada WHERE id_falta=:param1 AND id_maestro=:param2");
                  $sql->bindValue(":param1", $numeroDeCaso);
                  $sql->bindValue(":param2", $id);
                  $sql->execute();

                  $conf = $sql->fetch();
                  
                  //Si hay un registro existente con ese id se pasa a programar la reposición
                  if($conf > 0){
                      $sql = $conn->prepare("INSERT INTO reposicion (id_falta, numero_salon, fecha, hora_inicio, hora_final) VALUES (:id_falta, :numero_salon, :fecha, :hora_inicio, :hora_fin)");
                      $sql->bindValue(":id_falta", $numeroDeCaso);
                      $sql->bindValue(":numero_salon", $salon);
                      $sql->bindValue(":fecha", $fechaTST);
                      $sql->bindValue(":hora_inicio", $hora_de_inicio);
                      $hora_de_fin = strtotime('+59 minutes', strtotime($hora_de_inicio));
                      $hdf = date('H:i:s');
                      $sql->bindValue(":hora_fin", $hdf);
                      
                      $sql->execute();
                      
                      $mensaje = 'Tu reposición ha sido registrada';
                      echo "<script>alert('$mensaje')
                            window.location='Qr_display.php'</script>";

                  }else{
                    $mensaje = 'No hay un registro existente de falta justificada';
                    echo "<script>alert('$mensaje')</script>";
                  }
              }
            ?>
        </div>
    </div>

</body>
</html>