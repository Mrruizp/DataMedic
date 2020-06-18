<?php

try {
    require_once '../logic/Especializacion.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_especializacion"]) ||
            empty($_POST["p_codigo_especializacion"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codEspecializacion = $_POST["p_codigo_especializacion"];
    
    $objEspecializacion = new Especializacion();
    $resultado = $objEspecializacion->leerDatos($codEspecializacion);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


