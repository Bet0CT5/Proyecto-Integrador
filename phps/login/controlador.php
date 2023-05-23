<?php

    require_once('model.php');
    // require_once('../persona.php');

    //instancia
    $model = new Model();

    $model->user = $_POST['nom_usuario'];
    $model->pass = $_POST['passwd'];
    $model->tipo = $_POST['tipo_usuario'];

    $filaControlador = $model->Logear();

    if($filaControlador > 0){

        $filaNombre = $model->obtenerNombre();
        $filaID = $model->obtenerId();
        $model->id = $filaID[0];

        session_unset();
        session_destroy();
        session_start();
        // $persona = new Persona($model->getUser(), $model->getTipo());
            $_SESSION['usuario'] = $filaNombre[0];
            $_SESSION['id_usuario'] = $model->id;
            $_SESSION['estado'] = 'Autenticado';
            $_SESSION['tipo_perfil'] = $model->tipo;
            $_SESSION['puesto'] = $model->obtenerPuesto();
            $_SESSION['email'] = $model->obtenerEmail();
            $_SESSION['departamento'] = $model->obtenerDepartamento();
            $_SESSION['escaneado'] = false;

        $response = array('success' => true);

    } else {

        $response = array('success' => false, 'message' => 'Usuario y/o contrasenia invalidos');

    }


    echo json_encode($response);

?>