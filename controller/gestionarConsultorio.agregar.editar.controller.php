<?php

try {

    require_once '../logic/Consultorio.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_Nombre_Consultorio"]) ||
            empty($_POST["p_Nombre_Consultorio"]) ||

            !isset($_POST["p_Sede"]) ||
            empty($_POST["p_Sede"]) ||

            !isset($_POST["p_Area"]) ||
            empty($_POST["p_Area"]) ||

            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

     $Nombre_Consultorio = $_POST["p_Nombre_Consultorio"];
     $Sede               = $_POST["p_Sede"];
     $Area               = $_POST["p_Area"];


     $tipoOperacion = $_POST["p_tipo_ope"];

    $objConsultorio = new Consultorio();

    if ($tipoOperacion == "agregar") {

        $objConsultorio->setNombre_consultorio($Nombre_Consultorio);
        $objConsultorio->setSede_id($Sede);
        $objConsultorio->setArea_id($Area);
        
        $resultado = $objConsultorio->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_codigo_consultorio"]) ||
                empty($_POST["p_codigo_consultorio"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_codigo_consultorio"];
        
        $objConsultorio->setConsultorio_id($codigo);
        $objConsultorio->setNombre_consultorio($Nombre_Consultorio);
        $objConsultorio->setSede_id($Sede);
        $objConsultorio->setArea_id($Area);

        $resultado = $objConsultorio->editar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
