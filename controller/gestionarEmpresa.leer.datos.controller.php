<?php

try {
    require_once '../logic/Empresa.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_empresa"]) ||
            empty($_POST["p_codigo_empresa"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codEmpresa = $_POST["p_codigo_empresa"];
    
    $objEmpresa = new Empresa();
    $resultado = $objEmpresa->leerDatos($codEmpresa);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


