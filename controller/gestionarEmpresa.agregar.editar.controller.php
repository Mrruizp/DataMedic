<?php

try {

    require_once '../logic/Empresa.class.php';
    require_once '../util/functions/Helper.class.php';

   
    if
    (
            !isset($_POST["p_ruc"]) ||
            empty($_POST["p_ruc"]) ||

            !isset($_POST["p_razonSocial"]) ||
            empty($_POST["p_razonSocial"]) ||

            !isset($_POST["p_razonComercia"]) ||
            empty($_POST["p_razonComercia"]) ||

            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

     $ruc            = $_POST["p_ruc"];
     $razonSocial    = $_POST["p_razonSocial"];
     $razonComercia  = $_POST["p_razonComercia"];

     $tipoOperacion = $_POST["p_tipo_ope"];

    $objEmpresa = new Empresa();

    if ($tipoOperacion == "agregar") {

        $objEmpresa->setRuc($ruc);
        $objEmpresa->setRazon_social($razonSocial);
        $objEmpresa->setRazon_comercial($razonComercia);

        $resultado = $objEmpresa->agregar();
        
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_codigo_empresa"]) ||
                empty($_POST["p_codigo_empresa"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_codigo_empresa"];

        $objEmpresa->setRuc($ruc);
        $objEmpresa->setRazon_social($razonSocial);
        $objEmpresa->setRazon_comercial($razonComercia);
        
        $resultado = $objEmpresa->editar($codigo);
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
