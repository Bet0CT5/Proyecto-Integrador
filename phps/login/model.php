<?php

    // modelo
    

    class Model
    {
        var $id;
        var $user;
        var $pass;
        var $tipo;

        function __construct(){
            
        }

        function Logear(){
            
            require_once '../conexionBD.php';
            //Variables de conexion

            try{

                if($this->tipo == "Maestro"){
                    $consulta=$conn->prepare("SELECT * FROM cuenta_maestro WHERE nombre_maestro=:param1 AND password=:param2");
                }else if($this->tipo == "Administrador"){
                    $consulta=$conn->prepare("SELECT * FROM cuenta_administrador WHERE nombre_gestor=:param1 AND password=:param2");
                }else if($this->tipo == "Director de departamento"){
                    $consulta=$conn->prepare("SELECT * FROM cuenta_director_departamento WHERE nombre_director=:param1 AND password=:param2");
                }else if($this->tipo == "Vicerrector"){
                    $consulta=$conn->prepare("SELECT * FROM cuenta_vicerrector WHERE nombre_vicerrector=:param1 AND password=:param2");
                }else if($this->tipo == "Rector"){
                    $consulta=$conn->prepare("SELECT * FROM cuenta_rector WHERE nombre_rector=:param1 AND password=:param2");
                }

                $consulta->bindValue(":param1", $this->user);
                $consulta->bindValue(":param2", $this->pass);

                $consulta->execute();

                $filaModelo=$consulta->fetch();

                return $filaModelo;

            }catch(PDOException $e){

                echo "Error en la conexion->".$e->getMessage();

            }

        }

        function obtenerNombre(){

            require '../conexionBD.php';

            try{

                if($this->tipo == "Maestro"){
                    $consulta=$conn->prepare("SELECT maestro.nombre_maestro FROM cuenta_maestro, maestro WHERE cuenta_maestro.id_maestro=maestro.id_maestro AND cuenta_maestro.nombre_maestro=:param1");
                }else if($this->tipo == "Administrador"){
                    $consulta=$conn->prepare("SELECT administrador.nombre_gestor FROM cuenta_administrador, administrador WHERE cuenta_administrador.id_gestor=administrador.id_gestor AND cuenta_administrador.nombre_gestor=:param1");
                }else if($this->tipo == "Director de departamento"){
                    $consulta=$conn->prepare("SELECT director_departamento.nombre_director FROM cuenta_director_departamento, director_departamento WHERE cuenta_director_departamento.id_director=director_departamento.id_director AND cuenta_director_departamento.nombre_director=:param1");
                }else if($this->tipo == "Vicerrector"){
                    $consulta=$conn->prepare("SELECT vicerrector.nombre_vicerrector FROM cuenta_vicerrector, vicerrector WHERE cuenta_vicerrector.id_vicerrector=vicerrector.id_vicerrector AND cuenta_vicerrector.nombre_vicerrector=:param1");
                }else if($this->tipo == "Rector"){
                    $consulta=$conn->prepare("SELECT rector.nombre_rector FROM cuenta_rector, rector WHERE cuenta_rector.id_rector=rector.id_rector AND cuenta_rector.nombre_rector=:param1");
                }

                $consulta->bindValue(":param1", $this->user);

                $consulta->execute();

                $filaModelo=$consulta->fetch();

                return $filaModelo;

            }catch(PDOException $e){
                echo "Error en la conexion->".$e->getMessage(); 
            }
        }

        function obtenerId(){

            require '../conexionBD.php';

            try{
                if($this->tipo == "Maestro"){
                    $consulta = $conn->prepare("SELECT id_maestro FROM cuenta_maestro WHERE nombre_maestro=:param1");
                }else if($this->tipo == "Administrador"){
                    $consulta = $conn->prepare("SELECT id_gestor FROM cuenta_administrador WHERE nombre_gestor=:param1");
                }else if($this->tipo == "Director de departamento"){
                    $consulta = $conn->prepare("SELECT id_director FROM cuenta_director_departamento WHERE nombre_director=:param1");
                }else if($this->tipo == "Vicerrector"){
                    $consulta = $conn->prepare("SELECT id_vicerrector FROM cuenta_vicerrector WHERE nombre_vicerrector=:param1");
                }else if($this->tipo == "Rector"){
                    $consulta = $conn->prepare("SELECT id_rector FROM cuenta_rector WHERE nombre_rector=:param1");
                }

                $consulta->bindValue(":param1", $this->user);
                $consulta->execute();

                $result = $consulta->fetch();

                return $result;

            }catch(PDOException $e){
                echo "Error en la conexion->".$e->getMesage();
            }
        }

        function obtenerPuesto(){

            require '../conexionBD.php';

            if($this->tipo == "Maestro"){
                try{
                    $consulta = $conn->prepare("SELECT descripcion_puesto FROM maestro WHERE id_maestro=:param1");
                    $consulta->bindValue(":param1", $this->id);
                    $consulta->execute(); 
                    $resultado = $consulta->fetch();
                    
                    $puesto = $resultado[0];

                }catch(PDOException $e){
                    echo "Error en la conexion->".$e->getMessage();
                }
            }else if($this->tipo == "Administrador"){
                $puesto = "Gestor de asistencia";
            }else if($this->tipo == "Director de departamento"){
                $puesto = "Director de departamento";
            }else if($this->tipo == "Vicerrector"){
                $puesto = "Vicerrector";
            }else if($this->tipo == "Rector"){
                $puesto = "Rector";
            }

            return $puesto;
        }

        function obtenerEmail(){
            
            require '../conexionBD.php';

            try{
                if($this->tipo == "Maestro"){
                    $consulta = $conn->prepare("SELECT correo_electronico FROM maestro WHERE id_maestro=:param1");
                }else if($this->tipo == "Administrador"){
                    $consulta = $conn->prepare("SELECT correo_electronico FROM administrador WHERE id_gestor=:param1");
                }else if($this->tipo == "Director de departamento"){
                    $consulta = $conn->prepare("SELECT correo_electronico FROM director_departamento WHERE id_director=:param1");
                }else if($this->tipo == "Vicerrector"){
                    $consulta = $conn->prepare("SELECT correo_electronico FROM vicerrector WHERE id_vicerrector=:param1");
                }else if($this->tipo == "Rector"){
                    $consulta = $conn->prepare("SELECT correo_electronico FROM rector WHERE id_rector=:param1");
                }

                $consulta->bindValue(":param1", $this->id);
                $consulta->execute();

                $result = $consulta->fetch();

                return $result[0];

            }catch(PDOException $e){
                echo "Error en la conexion->".$e->getMesage();
            }

        }

        function obtenerDepartamento(){

            require '../conexionBD.php';

            if($this->tipo == "Maestro"){
                try{
                    $consulta = $conn->prepare("SELECT nombre_departamento FROM departamento, departamento_maestro, maestro
                    WHERE departamento.id_departamento=departamento_maestro.id_departamento AND departamento_maestro.id_maestro=maestro.id_maestro
                    AND maestro.id_maestro=:param1");
                    $consulta->bindValue(":param1", $this->id);
                    $consulta->execute(); 
                    $resultado = $consulta->fetch();
                    
                    if($resultado > 0){
                        $departamento = $resultado[0];
                    }else{
                        $departamento = "No disponible";
                    }

                }catch(PDOException $e){
                    echo "Error en la conexion->".$e->getMessage();
                }
            }else if($this->tipo == "Administrador"){
                $departamento = "Direccion de efectividad academica";
            }else if($this->tipo == "Director de departamento"){
                try{
                    $consulta = $conn->prepare("SELECT nombre_departamento FROM departamento, departamento_y_director
                    WHERE departamento.id_departamento=departamento_y_director.id_departamento AND id_director=:param1");
                    $consulta->bindValue(":param1", $this->id);
                    $consulta->execute(); 
                    $resultado = $consulta->fetch();
                    
                    if($resultado > 0){
                        $departamento = $resultado[0];
                    }else{
                        $departamento = "No disponible";
                    }

                }catch(PDOException $e){
                    echo "Error en la conexion->".$e->getMessage();
                }
            }else if($this->tipo == "Vicerrector"){
                $departamento = "Vicerrectoria de Educacion Superior";
            }else if($this->tipo == "Rector"){
                $departamento = "Rectoria de la Universidad de Monterrey";
            }

            return $departamento;

        }

        function getUser(){
            return $this->user;
        }

        function getTipo(){
            return $this->tipo;
        }
    }

?>