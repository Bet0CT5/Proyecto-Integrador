<?php

//Se evita que salgan errores de NOTICES
error_reporting(E_ALL ^ E_NOTICE);

//Se obtiene el timestamp del servidor de cuando se hizo la petición.
$hora = $_SERVER["REQUEST_TIME"];

//Duracion de la sesión en segundos
$duracion = 60;

//Si el tiempo de la sesion es mayor al tiempo permitido de la duracion
//Se destruye la sesion y crea una nueva
if(isset($_SESSION['ultima_actividad']) && ($hora - $_SESSION['ultima_actividad']) > $duracion){
    session_unset();
    session_destroy();
    session_start();
}

//NOTA: Este archivo debe ser incluido en cada página que necesite comprobar las sesiones

//Definimos el valor de la sesion "ultima actividad" como el timestamp del servidor
$_SESSION['ultima_actividad'] = $hora; 

?>