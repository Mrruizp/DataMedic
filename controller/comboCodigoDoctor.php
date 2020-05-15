<?php

require_once '../logic/comboCodigo.class.php';
require_once '../util/functions/Helper.class.php';

try {
	if
    	(
            !isset($_POST["p_codigo_especialidad"]) ||
            empty($_POST["p_codigo_especialidad"]) 
    	) 
	{
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
    $codigo_especialidad         = $_POST["p_codigo_especialidad"];

    $objComboCodigo = new comboCodigo();
	$resultado = $objComboCodigo->cargarDatos_CodigoDoctor($codigo_especialidad);    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

