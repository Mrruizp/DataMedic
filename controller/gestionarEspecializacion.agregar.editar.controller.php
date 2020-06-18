<?php

try {

    require_once '../logic/Especializacion.class.php';
    require_once '../util/functions/Helper.class.php';

   
    if
    (
            !isset($_POST["p_especialidad_id"]) ||
            empty($_POST["p_especialidad_id"]) ||

            !isset($_POST["p_doctor_id"]) ||
            empty($_POST["p_doctor_id"]) ||

            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

     $Especialidad_id   = $_POST["p_especialidad_id"];
     $Doctor_id         = $_POST["p_doctor_id"];

     $tipoOperacion = $_POST["p_tipo_ope"];

    $objEspecializacion = new Especializacion();

    if ($tipoOperacion == "agregar") {

        $objEspecializacion->setEspecialidad_id($Especialidad_id);
        $objEspecializacion->setDoctor_id($Doctor_id);
        
        $resultado = $objEspecializacion->agregar();
        
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_codigo_especializacion"]) ||
                empty($_POST["p_codigo_especializacion"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_codigo_especializacion"];

        $objEspecializacion->setEspecialidad_id($Especialidad_id);
        $objEspecializacion->setDoctor_id($Doctor_id);
        
        $resultado = $objEspecializacion->editar($codigo);
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
