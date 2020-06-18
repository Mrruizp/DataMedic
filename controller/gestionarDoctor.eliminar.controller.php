<?php

try {
    require_once '../logic/Doctor.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_doctor"]) ||
            empty($_POST["p_codigo_doctor"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codDoctor = $_POST["p_codigo_doctor"];
    
    $objDoctor = new Doctor();
    $objDoctor->setDoctor_id($codDoctor);
    $resultado = $objDoctor->eliminar();
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


