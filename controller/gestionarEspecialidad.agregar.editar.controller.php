<?php

try {

    require_once '../logic/Especialidad.class.php';
    require_once '../util/functions/Helper.class.php';

   
    if
    (
            !isset($_POST["p_nombre_especialidad"]) ||
            empty($_POST["p_nombre_especialidad"]) ||

            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
//Cita
     $nombre_especialidad        = $_POST["p_nombre_especialidad"];

     $tipoOperacion = $_POST["p_tipo_ope"];

    $objEspecialidad = new Especialidad();

    if ($tipoOperacion == "agregar") {
//Cita
        $objEspecialidad->setEspecialidad($nombre_especialidad);
        
        $resultado = $objEspecialidad->agregar();
        
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_codigo_especialidad"]) ||
                empty($_POST["p_codigo_especialidad"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_codigo_especialidad"];
        $objEspecialidad->setEspecialidad($nombre_especialidad);
        $resultado = $objEspecialidad->editar($codigo);
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
