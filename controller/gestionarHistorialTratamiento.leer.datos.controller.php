<?php

try {
    require_once '../logic/Cita.class.php';
    require_once '../util/functions/Helper.class.php';
    
    
    
    
    if 
        (
            !isset($_POST["p_codigo_cita"]) ||
            empty($_POST["p_codigo_cita"]) ||

            !isset($_POST["p_codigo_paciente"]) ||
            empty($_POST["p_codigo_paciente"]) ||

            !isset($_POST["p_fechahisttratamiento_cita"]) ||
            empty($_POST["p_fechahisttratamiento_cita"])  ||

            !isset($_POST["p_hora_tratamiento"]) ||
            empty($_POST["p_hora_tratamiento"]) 
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $codCita = $_POST["p_codigo_cita"];
    $codPaciente = $_POST["p_codigo_paciente"];
    $fechahisttratamiento_cita = $_POST["p_fechahisttratamiento_cita"];
    $hora_tratamiento = $_POST["p_hora_tratamiento"];
    
    $objCita = new Cita();
    $resultado = $objCita->leerDatosHistorialTratamiento($codCita, $codPaciente, $fechahisttratamiento_cita, $hora_tratamiento);
    
    

    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


