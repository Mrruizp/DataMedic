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
    $objEspecializacion->setEspecializacion_id($codEspecializacion);
    $resultado = $objEspecializacion->eliminar();
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


