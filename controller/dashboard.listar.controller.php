<?php

require_once '../logic/Dashboard.class.php';
require_once '../util/functions/Helper.class.php';

try {
	if 
        (
            !isset($_POST["p_mes"]) ||
            empty($_POST["p_mes"]) ||

            !isset($_POST["p_numero"]) ||
            empty($_POST["p_numero"]) ||

            !isset($_POST["p_ano"]) ||
            empty($_POST["p_ano"]) ||

            !isset($_POST["p_estado"]) ||
            empty($_POST["p_estado"]) 
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    $mes 	= $_POST["p_mes"];
	$numero = $_POST["p_numero"];
	$ano 	= $_POST["p_ano"];
	$estado = $_POST["p_estado"];

    $objDashboard = new Dashboard();
    $resultado = $objDashboard->listar($mes,$numero,$ano,$estado);
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

