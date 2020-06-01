<?php

try {
    require_once '../logic/Tratamiento.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_tratamiento"]) ||
            empty($_POST["p_codigo_tratamiento"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codTratamiento = $_POST["p_codigo_tratamiento"];
    
    $objTratamiento= new Tratamiento();
    $objTratamiento->setTratamiento_id($codTratamiento);
    $resultado = $objTratamiento->eliminar();
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


