<?php

require_once '../logic/comboCodigo.class.php';
require_once '../util/functions/Helper.class.php';

try {
	if
    	(
            !isset($_POST["p_codigo_area"]) ||
            empty($_POST["p_codigo_area"]) 
    	) 
	{
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

    $codigo_area         = $_POST["p_codigo_area"];

    $objComboCodigo = new comboCodigo();
	$resultado = $objComboCodigo->cargarDatos_CodigoConsultorio($codigo_area);    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

