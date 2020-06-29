<?php

try {
    require_once '../logic/Consultorio.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_consultorio"]) ||
            empty($_POST["p_codigo_consultorio"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codConsultorio = $_POST["p_codigo_consultorio"];
    
    $objConsultorio = new Consultorio();
    $resultado = $objConsultorio->leerDatos($codConsultorio);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


