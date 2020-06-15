<?php

try {
    require_once '../logic/Cita.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_Horario_atencion"]) ||
            empty($_POST["p_codigo_Horario_atencion"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codHorario_atencion = $_POST["p_codigo_Horario_atencion"];
    
    $objCita = new Cita();
    $resultado = $objCita->leerDatosHorario($codHorario_atencion);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


