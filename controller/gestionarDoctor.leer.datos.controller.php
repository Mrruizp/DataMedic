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
    $resultado = $objDoctor->leerDatos($codDoctor);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


