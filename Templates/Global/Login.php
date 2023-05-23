<?php
    //Se inicia la sesion
    // session_unset();
    // session_destroy();
   // session_start();

    //Se pide el archivo que controla la duracion de las sesiones
    //require('../../phps/sesiones.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../Styles/CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../../Styles/CSS/Styles.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="header">
        <h1 class="title">Asistencia QR UDEM</h1>
    </div>
    <div class="container">
            <div class="login-container">   
                <form id="loginform"  method="POST">
                    <fieldset>
                        <div class="form-group">
                            <label for="usuario" class="form-label mt-4 lab-esp centered">Nombre de usuario</label>
                            <input type="text" class="form-control input-login" name="nom_usuario" maxlength="30"/>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label mt-4 lab-esp centered">Contraseña</label>
                            <input type="password" class="form-control input-login"  name="passwd" maxlength="30"/>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1" class="form-label mt-4 lab-esp centered">Tipo de usuario</label>
                            <select class="form-select input-login" id="select-tipo-usuario" name="tipo_usuario">
                              <option>Maestro</option>
                              <option>Administrador</option>
                              <option>Director de departamento</option>
                              <option>Vicerrector</option>
                              <option>Rector</option>
                            </select>
                        </div>
                        <label class="form-label centered"><a href="./Recuperacion.html" class="link">Olvide mi contraseña</a></label>
                    </fieldset>
                    <div class="btn-centered">
                        <button type="submit" class="btn btn-primary btn-lg btn-dark">Iniciar Sesi&oacute;n</button>
                    </div>
                </form>  
            </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#loginform').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: '../../phps/login/controlador.php',
                    data: $(this).serialize(),
                    success: function(response)
                    {
                        console.log(response);
                        var jsonData = JSON.parse(response);
                        // user is logged in successfully in the back-end 
                        // let's redirect 
                        if (jsonData.success)
                        {
                    
                            let tipo = document.getElementById('select-tipo-usuario').value;

                            if(tipo == 'Maestro')
                                location.href = '../Maestro/Qr_display.php';
                            else if(tipo == 'Administrador')
                                location.href = '../Administrador/Reportes_de_casos_especiales_admi.php';
                            else if(tipo == 'Director de departamento')
                                location.href = '../Director_departamento/Menu_opciones.php';
                            else if(tipo == 'Vicerrector')
                                location.href = '../Rector-Vicerrector/Visualizar_Departamentos_Vicerrector.php';
                            else if(tipo == 'Rector')
                                location.href = '../Rector-Vicerrector/Visualizar_Escuelas_Rector.php';
                        }
                        else
                        {
                            alert(jsonData.message);
                        }
                   }
               });
             });
        });
    </script>
</body>
</html>