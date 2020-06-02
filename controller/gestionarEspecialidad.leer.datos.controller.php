<?php

try {
    require_once '../logic/Especialidad.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_especialidad"]) ||
            empty($_POST["p_codigo_especialidad"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codEspecialidad = $_POST["p_codigo_especialidad"];
    
    $objEspecialidad = new Especialidad();
    $resultado = $objEspecialidad->leerDatos($codEspecialidad);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


