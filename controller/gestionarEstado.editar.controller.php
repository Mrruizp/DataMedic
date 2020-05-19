<?php

try {

    require_once '../logic/Cita.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_cod_citaEstado"]) ||
            empty($_POST["p_cod_citaEstado"]) ||

            !isset($_POST["p_estado_cita"]) ||
            empty($_POST["p_estado_cita"]) 

    ) 
    {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

     $cod_citaEstado  = $_POST["p_cod_citaEstado"];
     $estado_cita     = $_POST["p_estado_cita"];

     $objCita = new Cita();
        $resultado = $objCita->editarEstardo($cod_citaEstado, $estado_cita);
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
