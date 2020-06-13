<?php

require_once '../logic/comboCodigo.class.php';
require_once '../util/functions/Helper.class.php';

try {
	if
    	(
            !isset($_POST["p_codigo_sede"]) ||
            empty($_POST["p_codigo_sede"]) 
    	) 
	{
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
    $codigo_sede         = $_POST["p_codigo_sede"];

    $objComboCodigo = new comboCodigo();
	$resultado = $objComboCodigo->cargarDatos_CodigoAreaSede($codigo_sede);    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

