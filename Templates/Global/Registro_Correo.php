<?php
  
  require_once '../../phps/Carga_variables.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Styles/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../../Styles/CSS/Styles.css">
    <title>Registro de correo</title>
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
                    <legend>Registrar correo electronico</legend>
                    <br>
                    <div class="form-group row mar-top">
                        <label for="staticMateria" class="col-sm-2 col-form-label">Correo electronico</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control short-input" id="nuevo_correo" name="nuevo_correo">
                        </div>
                    </div>
                </fieldset>
                <div class="btn-centered">
                    <button type="submit" class="btn btn-primary btn-lg btn-dark">Enviar</button>
                </div>
            </form>
            <?php 
                require_once '../../phps/conexionBD.php';

                if ($_SERVER['REQUEST_METHOD'] === 'POST'){
                   $correo = $_POST['nuevo_correo'];

                   try{
                    $sql = $conn->prepare("UPDATE maestro SET correo_electronico=:param1 WHERE id_maestro=:param2");
                    $sql->bindValue(":param1", $correo);
                    $sql->bindValue(":param2", $id);
                    $sql->execute();
                    $_SESSION['email'] = $correo;
                   }catch(PDOException $e){
                      echo "Error en la conexion->".$e;
                  }

                   header("Location: Mi_Perfil.php");
                }

            ?>
        </div>
    </div>
    
</body>
</html>