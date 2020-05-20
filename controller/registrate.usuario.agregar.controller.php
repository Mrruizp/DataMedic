<?php
    
    try {

    require_once '../logic/Usuario.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_dni"]) ||
            empty($_POST["p_dni"]) ||
            
            !isset($_POST["p_nombreCompleto"]) ||
            empty($_POST["p_nombreCompleto"]) ||
            
            !isset($_POST["p_email"]) ||
            empty($_POST["p_email"]) ||
            
            !isset($_POST["p_password"]) ||
            empty($_POST["p_password"]) 
            
    ) 
        {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

    $Dni                = $_POST["p_dni"];
    $NombresCompleto    = $_POST["p_nombreCompleto"];
    $Email              = $_POST["p_email"];
    $Password           = $_POST["p_password"];

    $objUsuario = new Usuario();

    
        $objUsuario->setDni($Dni);
        $objUsuario->setNombresCompleto($NombresCompleto);
        $objUsuario->setEmail($Email);
        $objUsuario->setPassword($Password);
        $resultado = $objUsuario->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


