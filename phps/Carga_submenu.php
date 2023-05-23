<?php 

require_once 'Carga_variables.php';

if($tipo == 'Maestro'){
    echo '<li class="nav-item"><a class="nav-link" href="../Maestro/Reportar_Caso_Especial.php">Reportar caso especial</a></li>
    <li class="nav-item"><a class="nav-link" href="../Maestro/Visualizar_datos_asistencia.php">Reportes y datos de asistencia</a></li>
    <li class="nav-item"><a class="nav-link" href="../Maestro/Qr_display.php">Escanear QR</a></li>
    <li class="nav-item"><a class="nav-link" href="../Global/Mi_Perfil.php">Mi perfil</a></li>';
  }else if($tipo == 'Administrador'){
    echo '<li class="nav-item"><a class="nav-link" href="../Administrador/Reportes_de_casos_especiales_admi.php">Reportes de casos especiales</a></li>
    <li class="nav-item"><a class="nav-link" href="../Global/Mi_Perfil.php">Mi perfil</a></li>';
  }else if($tipo == 'Director de departamento'){
    echo '<li class="nav-item"><a class="nav-link" href="../Director_departamento/Menu_opciones.php">Menu principal</a></li>
    <li class="nav-item"><a class="nav-link" href="../Global/Mi_Perfil.php">Mi perfil</a></li>';
  }else if($tipo == 'Vicerrector'){
    echo '<li class="nav-item"><a class="nav-link" href="../Rector-Vicerrector/Visualizar_Departamentos_Vicerrector.php">Reportes de asistencia por departamento</a></li>
    <li class="nav-item"><a class="nav-link" href="../Rector-Vicerrector/Reporte_de_Asistencia_Vicerrector.php">Reporte general de asistencia</a></li>
    <li class="nav-item"><a class="nav-link" href="../Global/Mi_Perfil.php">Mi perfil</a></li>';
  }else if($tipo == 'Rector'){
    echo '<li class="nav-item"><a class="nav-link" href="../Rector-Vicerrector/Visualizar_Escuelas_Rector.php">Reportes de asistencia por escuela</a></li>
    <li class="nav-item"><a class="nav-link" href="../Rector-Vicerrector/Reporte_de_Asistencia_Rector.php">Reporte general de asistencia</a></li>
    <li class="nav-item"><a class="nav-link" href="../Global/Mi_Perfil.php">Mi perfil</a></li>';
  }

?>