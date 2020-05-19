<?php

try {

    require_once '../logic/Tratamiento.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_nombre_tratamiento"]) ||
            empty($_POST["p_nombre_tratamiento"]) ||

            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
//Cita
     $nombre_tratamiento        = $_POST["p_nombre_tratamiento"];

     $tipoOperacion = $_POST["p_tipo_ope"];

    $objTratamiento = new Tratamiento();

    if ($tipoOperacion == "agregar") {
//Cita
        $objTratamiento->setTratamiento($nombre_tratamiento);
        
        $resultado = $objTratamiento->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_codigo_tratamiento"]) ||
                empty($_POST["p_codigo_tratamiento"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_codigo_tratamiento"];
        $objTratamiento->setTratamiento($nombre_tratamiento);
        $resultado = $objTratamiento->editar($codigo);
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
