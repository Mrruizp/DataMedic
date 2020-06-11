<?php

try {
    require_once '../logic/Sede.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_sede"]) ||
            empty($_POST["p_codigo_sede"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codSede = $_POST["p_codigo_sede"];
    
    $objSede = new Sede();
    $resultado = $objSede->leerDatos($codSede);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


