<?php

try {

    require_once '../logic/Area.class.php';
    require_once '../util/functions/Helper.class.php';

   
    if
    (
            !isset($_POST["p_nombre_area"]) ||
            empty($_POST["p_nombre_area"]) ||

            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

     $nombre_area        = $_POST["p_nombre_area"];

     $tipoOperacion = $_POST["p_tipo_ope"];

    $objArea = new Area();

    if ($tipoOperacion == "agregar") {

        $objArea->setArea($nombre_area);
        
        $resultado = $objArea->agregar();
        
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_codigo_area"]) ||
                empty($_POST["p_codigo_area"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_codigo_area"];
        $objArea->setArea($nombre_area);
        $resultado = $objArea->editar($codigo);
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
