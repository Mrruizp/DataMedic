<?php

try {
    require_once '../logic/Area.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_area"]) ||
            empty($_POST["p_codigo_area"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codArea = $_POST["p_codigo_area"];
    
    $objArea = new Area();
    $resultado = $objArea->leerDatos($codArea);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


