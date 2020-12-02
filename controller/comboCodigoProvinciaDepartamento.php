<?php

require_once '../logic/comboCodigo.class.php';
require_once '../util/functions/Helper.class.php';

try {
	if
    	(
            !isset($_POST["p_codigo_departamento"]) ||
            empty($_POST["p_codigo_departamento"]) 
    	) 
	{
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
    $codigo_departamento         = $_POST["p_codigo_departamento"];

    $objComboCodigo = new comboCodigo();
	$resultado = $objComboCodigo->cargarDatos_CodigoProvinciaDepartamento($codigo_departamento);    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

