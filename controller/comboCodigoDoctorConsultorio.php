<?php

require_once '../logic/comboCodigo.class.php';
require_once '../util/functions/Helper.class.php';

try {
	if
    	(
            !isset($_POST["p_codigo_consultorio"]) ||
            empty($_POST["p_codigo_consultorio"]) 
    	) 
	{
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
    $codigo_consultorio         = $_POST["p_codigo_consultorio"];

    $objComboCodigo = new comboCodigo();
	$resultado = $objComboCodigo->cargarDatos_CodigoDoctorConsultorio($codigo_consultorio);    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

