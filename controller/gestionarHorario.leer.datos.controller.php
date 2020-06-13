<?php

try {
    require_once '../logic/Horario.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_horario"]) ||
            empty($_POST["p_codigo_horario"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codHorario = $_POST["p_codigo_horario"];
    
    $objHorario= new Horario();
    $resultado = $objHorario->leerDatos($codHorario);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


