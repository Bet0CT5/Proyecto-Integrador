<?php

    require_once 'Carga_variables.php';
    require_once 'ConexionBD.php';
    //Logica del sistema, a través del horario de la computadora se determina si el profesor tiene clase o no a determinada hora en determinado día

    date_default_timezone_set('America/Chihuahua');

    $diaSemana = date("D");
    $hora = date("H:i:s");
    $fecha = date("Y-m-d");
   
    try{
        if($diaSemana == "Mon"){
            $diaConsulta = "SELECT grupo_frecuencias.crn_grupo, clave_materia, numero_salon, hora_inicio, hora_final, id_departamento 
            FROM grupo_frecuencias INNER JOIN
            (SELECT grupo.crn_grupo, clave_materia, numero_salon, hora_inicio, hora_final, id_departamento 
                FROM maestro_grupo INNER JOIN grupo
                ON maestro_grupo.crn_grupo=grupo.crn_grupo WHERE id_maestro=:param1) AS RG
            ON RG.crn_grupo=grupo_frecuencias.crn_grupo
            WHERE lunes='M' AND hora_inicio<=:param2 AND hora_final>=:param3";
        }else if($diaSemana == "Tue"){
            $diaConsulta = "SELECT grupo_frecuencias.crn_grupo, clave_materia, numero_salon, hora_inicio, hora_final, id_departamento 
            FROM grupo_frecuencias INNER JOIN
            (SELECT grupo.crn_grupo, clave_materia, numero_salon, hora_inicio, hora_final, id_departamento 
                FROM maestro_grupo INNER JOIN grupo
                ON maestro_grupo.crn_grupo=grupo.crn_grupo WHERE id_maestro=:param1) AS RG
            ON RG.crn_grupo=grupo_frecuencias.crn_grupo
            WHERE martes='T' AND hora_inicio<=:param2 AND hora_final>=:param3";
        }else if($diaSemana == "Wed"){
            $diaConsulta = "SELECT grupo_frecuencias.crn_grupo, clave_materia, numero_salon, hora_inicio, hora_final, id_departamento 
            FROM grupo_frecuencias INNER JOIN
            (SELECT grupo.crn_grupo, clave_materia, numero_salon, hora_inicio, hora_final, id_departamento 
                FROM maestro_grupo INNER JOIN grupo
                ON maestro_grupo.crn_grupo=grupo.crn_grupo WHERE id_maestro=:param1) AS RG
            ON RG.crn_grupo=grupo_frecuencias.crn_grupo
            WHERE miercoles='W' AND hora_inicio<=:param2 AND hora_final>=:param3";
        }else if($diaSemana == "Thu"){
            $diaConsulta = "SELECT grupo_frecuencias.crn_grupo, clave_materia, numero_salon, hora_inicio, hora_final, id_departamento 
            FROM grupo_frecuencias INNER JOIN
            (SELECT grupo.crn_grupo, clave_materia, numero_salon, hora_inicio, hora_final, id_departamento 
                FROM maestro_grupo INNER JOIN grupo
                ON maestro_grupo.crn_grupo=grupo.crn_grupo WHERE id_maestro=:param1) AS RG
            ON RG.crn_grupo=grupo_frecuencias.crn_grupo
            WHERE jueves='R' AND hora_inicio<=:param2 AND hora_final>=:param3";
        }else if($diaSemana == "Fri"){
            $diaConsulta = "SELECT grupo_frecuencias.crn_grupo, clave_materia, numero_salon, hora_inicio, hora_final, id_departamento 
            FROM grupo_frecuencias INNER JOIN
            (SELECT grupo.crn_grupo, clave_materia, numero_salon, hora_inicio, hora_final, id_departamento 
                FROM maestro_grupo INNER JOIN grupo
                ON maestro_grupo.crn_grupo=grupo.crn_grupo WHERE id_maestro=:param1) AS RG
            ON RG.crn_grupo=grupo_frecuencias.crn_grupo
            WHERE viernes='F' AND hora_inicio<=:param2 AND hora_final>=:param3";
        }else if($diaSemana == "Sat"){
            $diaConsulta = "SELECT grupo_frecuencias.crn_grupo, clave_materia, numero_salon, hora_inicio, hora_final, id_departamento 
            FROM grupo_frecuencias INNER JOIN
            (SELECT grupo.crn_grupo, clave_materia, numero_salon, hora_inicio, hora_final, id_departamento 
                FROM maestro_grupo INNER JOIN grupo
                ON maestro_grupo.crn_grupo=grupo.crn_grupo WHERE id_maestro=:param1) AS RG
            ON RG.crn_grupo=grupo_frecuencias.crn_grupo
            WHERE sabado='S' AND hora_inicio<=:param2 AND hora_final>=:param3";
        }

        $consulta = $conn->prepare($diaConsulta);
        $consulta->bindValue(":param1", $id);
        $consulta->bindValue(":param2", $hora);
        $consulta->bindValue(":param3", $hora);
        $consulta->execute();

        $bool = false;
        $c = 0;

        while($grupo =  $consulta->fetch(PDO::FETCH_ASSOC)){
            $consultaMateria = $conn->prepare("SELECT nombre_materia FROM materia, grupo 
            WHERE materia.clave_materia=grupo.clave_materia AND materia.id_departamento=grupo.id_departamento 
            AND crn_grupo=:param1");
            $consultaMateria->bindValue(":param1", $grupo['crn_grupo']);
            $consultaMateria->execute();
            $nombreMateria = $consultaMateria->fetch(PDO::FETCH_ASSOC);
            $bool = true;

            //(strtotime($hora) <= strtotime($grupo['hora_fin']) AND strtotime($hora) >= strtotime('-10 minutes', strtotime($grupo['hora_fin'])))

            if($c == 0){
                if((strtotime($hora) >= strtotime($grupo['hora_inicio']) AND strtotime($hora) <= strtotime('+75 minutes', strtotime($grupo['hora_inicio'])))){
                        $consultaAsistenciaExistente = $conn->prepare("SELECT * FROM asistencia WHERE id_maestro=:id AND crn_grupo=:crn AND fecha=:fecha AND presente_inicio IS NOT NULL");
                        $consultaAsistenciaExistente->bindValue(":id", $id);
                        $consultaAsistenciaExistente->bindValue(":crn", $grupo['crn_grupo']);
                        $consultaAsistenciaExistente->bindValue(":fecha", $fecha);
                        $consultaAsistenciaExistente->execute();

                        if($consultaAsistenciaExistente->fetch() == 0){
                            echo '<div id="contenedorQR" class="contenedorQR"></div>
                                    <h4 class="centered">QR de inicio de clase</h4>';
                        }else{
                            echo '<h4 class="centered">Ya se registró tu entrada</h4>';
                        }

                }else if($escaneado){
                    echo '<h4 class="centered">Ya escaneaste el código QR</h4>';
                }else if(strtotime($hora) <= strtotime($grupo['hora_final']) AND strtotime($hora) >= strtotime('-10 minutes', strtotime($grupo['hora_final']))){

                        $consultaAsistenciaExistente = $conn->prepare("SELECT * FROM asistencia WHERE id_maestro=:id AND crn_grupo=:crn AND fecha=:fecha AND presente_final IS NOT NULL");
                        $consultaAsistenciaExistente->bindValue(":id", $id);
                        $consultaAsistenciaExistente->bindValue(":crn", $grupo['crn_grupo']);
                        $consultaAsistenciaExistente->bindValue(":fecha", $fecha);
                        $consultaAsistenciaExistente->execute();

                        if($consultaAsistenciaExistente->fetch() == 0){
                            echo '<div id="contenedorQR" class="contenedorQR"></div>
                                    <h4 class="centered">QR de final de clase</h4>';
                        }else{
                            echo '<h4 class="centered">Ya se registró tu salida</h4>';
                        }
                }else{
                    echo '<h4 class="centered">Aun no es momento de escanear el siguiente QR</h4>';
                    if(strtotime($hora) >= strtotime('+75 minutes', strtotime($grupo['hora_inicio']))){
                        $escaneado = false;
                    }
                }
                echo '
                <div id="infoClase" class="infoClase">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-dark">
                            <th scope="col">CRN grupo</th>
                            <th scope="col">Materia</th>
                            <th scope="col">Salon</th>
                            <th scope="col">Hora de inicio</th>
                            <th scope="col">Hora final</th>
                            </tr>
                        </thead>
                        <tbody>';
            }
            $c++;

            echo '
                            <tr>
                                <td>'.$grupo['crn_grupo'].'</td>
                                <td>'.$nombreMateria['nombre_materia'].'</td>
                                <td>'.$grupo['numero_salon'].'</td>'.
                                '<td>'.substr($grupo['hora_inicio'], 0, 5).'</td>
                                <td>'.substr($grupo['hora_final'], 0, 5).'</td>
                            <tr>
                ';

        }

        if(!$bool){
            echo '<br><div id="infoClase" class="infoClase"><h4 class="centered">No tienes clase por el momento<h4></div><br>';
        }else{
            echo '</tbody></table></div>';
        }

    }catch(PDOException $e){
        echo "Error en la conexion->".$e;
    }

    

?>