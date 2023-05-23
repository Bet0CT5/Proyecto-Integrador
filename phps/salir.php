<?php
    
    //Se cierra la sesion del usuario
    session_unset();
    session_destroy();

    //Se redirecciona al login
    header('Location: ../Templates/Global/Login.php');

?>