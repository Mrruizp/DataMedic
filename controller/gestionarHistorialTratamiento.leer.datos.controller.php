<?php

try {
    require_once '../logic/Cita.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_cita"]) ||
            empty($_POST["p_codigo_cita"]) ||

            !isset($_POST["p_codigo_paciente"]) ||
            empty($_POST["p_codigo_paciente"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codCita = $_POST["p_codigo_cita"];
    $codPaciente = $_POST["p_codigo_paciente"];
    
    $objCita = new Cita();
    $resultado = $objCita->leerDatosHistorialTratamiento($codCita, $codPaciente);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


