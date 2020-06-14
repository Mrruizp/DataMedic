<?php
	require_once '../logic/Horario.class.php';
    require_once '../util/functions/Helper.class.php';
try {
    
    
    if 
        (
           
            !isset($_POST["p_codigo_doctor"]) ||
            empty($_POST["p_codigo_doctor"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
   
    $codigo_doctor = $_POST["p_codigo_doctor"];
    
    $objHorario = new Horario();
    $resultado = $objHorario->listarHorarioDetalle($codigo_doctor);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


