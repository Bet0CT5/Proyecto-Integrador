<?php
  
  require_once '../../phps/Carga_variables.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
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
                <legend>Mi Perfil</legend>
                <br />
                <table border=0>
                  <tr>
                    <td style="text-align: left"><h5>ID:    </h5></td>
                    <td style="text-align: left"><h5><small class="text-muted">  <?php echo '  '.$id; ?></small></h5></td>
                  </tr>
                  <tr>
                    <td style="text-align: left"><h5>Tipo de perfil:    </h5></td>
                    <td style="text-align: left"><h5><small class="text-muted">  <?php echo '  '.$tipo; ?></small></h5></td>
                  </tr>
                  <tr>
                    <td style="text-align: left"><h5>Departamento:     </h5></td>
                    <td style="text-align: left"><h5><small class="text-muted">  <?php 
                      if($depa != NULL and $depa != ''){
                        echo '  '.$depa;
                      }else{
                        echo '  No disponible';
                      }
                    ?></small></h5></td>
                  </tr>
                  <tr>
                    <td style="text-align: left"><h5>Puesto:    </h5></td>
                    <td style="text-align: left"><h5><small class="text-muted">  <?php echo '  '.$puesto; ?></small></h5></td>
                  </tr>
                  <tr>
                    <td style="text-align: left"><h5>Correo:    </h5></td>
                    <td style="text-align: left"><h5><small class="text-muted">  <?php 
                      if($email != NULL and $email != ''){
                        echo '  '.$email;
                      }else{
                        echo '
                            <button type="button" class="btn btn-secondary" onClick="return agregarEmail()">Agregar Email</button>';
                      }
                    ?></small></h5></td>
                  </tr>
                </table>
        </div>
    </div>
    <script>
        //Codigo de Javascript
        function agregarEmail(){
             window.location.href='./Registro_Correo.php';
        }
    </script>
</body>
</html>