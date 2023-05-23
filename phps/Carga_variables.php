<?php 

if(!isset($_SESSION['usuario']) and $_SESSION['estado'] != 'Autenticado'){
    header('Location: ../Templates/Global/Login.php');
  } else {
    $estado = $_SESSION['usuario'];
    $salir = '<a class="navbar-brand" href="../../phps/salir.php" target="_self"><img src="../../Styles/Images/logout-white-32px.png" /></a>';
    $tipo = $_SESSION['tipo_perfil'];
    $id = $_SESSION['id_usuario'];
    $puesto = $_SESSION['puesto'];
    $email = $_SESSION['email'];
    $depa = $_SESSION['departamento'];
    $escaneado = $_SESSION['escaneado'];
}


?>