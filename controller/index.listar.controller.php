<?php
	require_once '../logic/Cita.class.php';
    require_once '../util/functions/Helper.class.php';
try {
    
    
    if 
        (
            !isset($_POST["p_cod_doctor"]) ||
            empty($_POST["p_cod_doctor"])
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
    $cod_doctor = $_POST["p_cod_doctor"];
    	
    $objCita = new Cita();
    $resultado = $objCita->listarCitaIndex($cod_doctor);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}