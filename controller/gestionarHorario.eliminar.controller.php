<?php

try {
    require_once '../logic/Horario.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_Horario"]) ||
            empty($_POST["p_codigo_Horario"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codHorario = $_POST["p_codigo_Horario"];
    
    $objHorario = new Horario();
    $objHorario->setHorario_id($codHorario);
    $resultado = $objHorario->eliminar();
    
    if ($resultado){
        Helper::imprimeJSON(200, "Se eliminó correctamente", "");
    }
    
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


