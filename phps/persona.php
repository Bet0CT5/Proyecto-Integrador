<?php

    // Modelo para manejar las variables de sesion

    require_once 'conexionBD.php';

    class Persona
    {
        var $usuario;
        var $id;
        var $nombre;
        var $tipo_usuario;


        function __construct($user, $type){
            
            global $conn;
            
            $this->usuario = $user;
            $this->tipo_usuario = $type;
            $this->nombre = $this->obtenerNombre($conn);
            $this->id = $this->obtenerId($conn);
        }

        function obtenerNombre(){

            try{
                if($this->tipo_usuario == "Maestro"){
                    $consulta=$conn->prepare("SELECT maestro.nombre_maestro FROM cuenta_maestro, maestro WHERE cuenta_maestro.id_maestro=maestro.id_maestro AND cuenta_maestro.nombre_maestro=:param1");
                }else if($this->tipo_usuario == "Administrador"){
                    $consulta=$conn->prepare("SELECT administrador.nombre_gestor FROM cuenta_administrador, administrador WHERE cuenta_administrador.id_gestor=administrador.id_gestor AND cuenta_administrador.nombre_gestor=:param1");
                }else if($this->tipo_usuario == "Director de departamento"){
                    $consulta=$conn->prepare("SELECT director_departamento.nombre_director FROM cuenta_director_departamento, director_departamento WHERE cuenta_director_departamento.id_director=director_departamento.id_director AND cuenta_director_departamento.nombre_director=:param1");
                }else if($this->tipo_usuario == "Vicerrector"){
                    $consulta=$conn->prepare("SELECT vicerrector.nombre_vicerrector FROM cuenta_vicerrector, vicerrector WHERE cuenta_vicerrector.id_vicerrector=vicerrector.id_vicerrector AND cuenta_vicerrector.nombre_vicerrector=:param1");
                }else if($this->tipo_usuario == "Rector"){
                    $consulta=$conn->prepare("SELECT rector.nombre_rector FROM cuenta_rector, rector WHERE cuenta_rector.id_rector=rector.id_rector AND cuenta_rector.nombre_rector=:param1");
                }

                $consulta->bindValue(":param1", $this->usuario);
                $consulta->execute();

                $result = $consulta->fetch();

                return $result;

            }catch(PDOException $e){
                echo "Error en la conexion->".$e->getMessage();
            }
        }

        function obtenerId($conn){

            try{
                if($this->tipo_usuario == "Maestro"){
                    $consulta = $conn->prepare("SELECT id_maestro FROM cuenta_maestro WHERE nombre_maestro=:param1");
                }else if($this->tipo_usuario == "Administrador"){
                    $consulta = $conn->prepare("SELECT id_gestor FROM cuenta_administrador WHERE nombre_gestor=:param1");
                }else if($this->tipo_usuario == "Director de departamento"){
                    $consulta = $conn->prepare("SELECT id_director FROM cuenta_director_departamento WHERE nombre_director=:param1");
                }else if($this->tipo_usuario == "Vicerrector"){
                    $consulta = $conn->prepare("SELECT id_vicerrector FROM cuenta_vicerrector WHERE nombre_vicerrector=:param1");
                }else if($this->tipo_usuario == "Rector"){
                    $consulta = $conn->prepare("SELECT id_rector FROM cuenta_rector WHERE nombre_rector=:param1");
                }

                $consulta->bindValue(":param1", $this->usuario);
                $consulta->execute();

                $result = $consula->fetch();

                return $result;

            }catch(PDOException $e){
                echo "Error en la conexion->".$e->getMesage();
            }
        }

        function setUsuario($user){
            $this->usuario = $user;
        }

        function setNombre(){
            $this->nombre = $this->obtenerNombre();
        }

        function setTipo($type){
            $this->tipo_usuario = $type;
        }

        function getUsuario(){
            return $this->usuario;
        }

        function getNombre(){
            return $this->nombre;
        }

        function getTipoUsuario(){
            return $this->tipo_usuario;
        }

    }

?>