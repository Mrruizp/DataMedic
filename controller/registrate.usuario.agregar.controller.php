<?php
    
    try {

    require_once '../logic/Usuario.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_email"]) ||
            empty($_POST["p_email"]) ||
            
            !isset($_POST["p_password"]) ||
            empty($_POST["p_password"]) 
            
    ) 
        {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

        $Email              = $_POST["p_email"];
        $Password           = $_POST["p_password"];

        $objUsuario = new Usuario();

        $objUsuario->setEmail($Email);
        $objUsuario->setConstrasenia($Password);
        $resultado = $objUsuario->agregar();
/*
        echo '<pre>';
        echo 'Datos que llegan por POST';
        print_r($resultado);
        echo '</pre>';
*/
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


