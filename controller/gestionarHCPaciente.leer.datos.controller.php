<?php

try {
    require_once '../logic/HCPaciente.class.php';
    require_once '../util/functions/Helper.class.php';
    
    if 
        (
            !isset($_POST["p_codigo_paciente"]) ||
            empty($_POST["p_codigo_paciente"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codPaciente = $_POST["p_codigo_paciente"];
    
    $objHCPaciente = new HCPaciente();
    $resultado = $objHCPaciente->leerDatos($codPaciente);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


