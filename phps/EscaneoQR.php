<?php

    //Este archivo tendrá la lógica para registrar la asistencia una vez que se haya escaneado el código QR.

    require_once 'conexionBD.php';
    require_once 'Carga_variables.php';

    date_default_timezone_set('America/Chihuahua');

    try{
        $diaSemana = date("D");
        $hora = date("H:i:s");

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

     

        while($grupo =  $consulta->fetch(PDO::FETCH_ASSOC)){

        $hora_inicio = strtotime($grupo['hora_inicio']);
        
        echo $grupo['hora_inicio'];

        $hora_fin = strtotime($grupo['hora_final']);

        echo $grupo['hora_final'];

        $hora_actual = strtotime($hora);
    
        if($hora_actual >= $hora_inicio AND $hora_actual <= strtotime('+75 minutes', $hora_inicio)){
            
            $consultaRegistro = $conn->prepare("INSERT INTO asistencia (id_maestro, crn_grupo, fecha, presente_inicio) VALUES (:id_maestro, :crn_grupo, (SELECT CONVERT(DATE, SWITCHOFFSET(SYSDATETIMEOFFSET(), '-06:00'))), :hr)");
            $consultaRegistro->bindValue(":id_maestro", $id);
            $consultaRegistro->bindValue(":crn_grupo", $grupo['crn_grupo']);
            $consultaRegistro->bindValue(":hr", date("H:i:s"));

            $consultaRegistro->execute();

            $_SESSION['escaneado'] = true;

            header('Location: ../Templates/Maestro/Qr_display.php');

        }else if($hora_actual <= $hora_fin AND $hora_actual >= strtotime('-10 minutes', $hora_fin)){

            $consultaObtenerID = $conn->prepare("SELECT id_asistencia FROM asistencia WHERE fecha = (SELECT MAX(fecha) FROM asistencia) AND id_maestro=:param1");
            $consultaObtenerID->bindValue(":param1", $id); 
            $consultaObtenerID->execute();
            $res = $consultaObtenerID->fetch(PDO::FETCH_ASSOC);
            if($res > 0){
                $id_asistencia = $res['id_asistencia'];
                $consultaRegistro = $conn->prepare("UPDATE asistencia SET presente_final=:pf WHERE id_asistencia=:param1");
                $consultaRegistro->bindValue(":param1", $id_asistencia);
                $consultaRegistro->bindValue(":pf", date("H:i:s"));
                $consultaRegistro->execute();
            }else{

                $consultaRegistro = $conn->prepare("INSERT INTO asistencia (id_maestro,crn_grupo,fecha,presente_final) VALUES (:id_maestro, :crn_grupo, (SELECT CONVERT(DATE, SWITCHOFFSET(SYSDATETIMEOFFSET(), '-06:00'))), :hr)");
                $consultaRegistro->bindValue(":id_maestro", $id);
                $consultaRegistro->bindValue(":crn_grupo", $grupo['crn_grupo']);
                $consultaRegistro->bindValue(":hr", date("H:i:s"));
        
                $consultaRegistro->execute();
            }

            echo "Registro exitoso";

            $_SESSION['escaneado'] = true;

            header('Location: ../Templates/Maestro/Qr_display.php');

        }else{
            echo "Parece que hubo un problema al hacer el registro";
        }
    }

    }catch(PDOException $e){
        echo "Error en la conexion->".$e;
    }

    

?>