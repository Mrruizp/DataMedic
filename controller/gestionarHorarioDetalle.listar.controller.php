<?php
	require_once '../logic/Horario.class.php';
    require_once '../util/functions/Helper.class.php';
try {
    
    
    if 
        (
           
            !isset($_POST["p_codigo_doctor"]) ||
            empty($_POST["p_codigo_doctor"])||

            !isset($_POST["p_codigo_mes"]) ||
            empty($_POST["p_codigo_mes"]) ||

            !isset($_POST["p_codigo_numero"]) ||
            empty($_POST["p_codigo_numero"])  ||

             !isset($_POST["p_codigo_ano"]) ||
            empty($_POST["p_codigo_ano"])  
            
        )
    {
            Helper::imprimeJSON(500, "Falta completar datos", "");
            exit();
    }
    
   
    $codigo_doctor           = $_POST["p_codigo_doctor"];
    $codigo_mes              = $_POST["p_codigo_mes"];
    $codigo_numero           = $_POST["p_codigo_numero"];
    $codigo_ano              = $_POST["p_codigo_ano"];
    
    $objHorario = new Horario();
    $resultado = $objHorario->listarHorarioDetalle($codigo_doctor, $codigo_mes, $codigo_numero, $codigo_ano);
    
    Helper::imprimeJSON(200, "", $resultado);
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}


