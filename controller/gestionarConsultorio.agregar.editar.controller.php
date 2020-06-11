<?php

try {

    require_once '../logic/Sede.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_Empresa"]) ||
            empty($_POST["p_Empresa"]) ||

            !isset($_POST["p_Nombre_Sede"]) ||
            empty($_POST["p_Nombre_Sede"]) ||

            !isset($_POST["p_Departamento"]) ||
            empty($_POST["p_Departamento"]) ||

            !isset($_POST["p_Provincia"]) ||
            empty($_POST["p_Provincia"]) ||

            !isset($_POST["p_Distrito"]) ||
            empty($_POST["p_Distrito"]) ||
  
            !isset($_POST["p_TipoSede"]) ||
            empty($_POST["p_TipoSede"]) ||

            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

     $Empresa       = $_POST["p_Empresa"];
     $NombreSede    = $_POST["p_Nombre_Sede"];
     $Departamento  = $_POST["p_Departamento"];
     $Provincia     = $_POST["p_Provincia"];
     $Distrito      = $_POST["p_Distrito"];
     $Direccion     = $_POST["p_Direccion"];
     $TipoSede      = $_POST["p_TipoSede"];


     $tipoOperacion = $_POST["p_tipo_ope"];

    $objSede = new Sede();

    if ($tipoOperacion == "agregar") {

        $objSede->setEmpresa_id($Empresa);
        $objSede->setNombre_sede($NombreSede);
        $objSede->setDepartamento_sede($Departamento);
        $objSede->setProvincia_sede($Provincia);
        $objSede->setDistrito_sede($Distrito);
        $objSede->setDireccion_sede($Direccion);
        $objSede->setTipo_sede($TipoSede);
        
        $resultado = $objSede->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_codigo_Sede"]) ||
                empty($_POST["p_codigo_Sede"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_codigo_Sede"];
        $objSede->setSede_id($codigo);
        $objSede->setEmpresa_id($Empresa);
        $objSede->setNombre_sede($NombreSede);
        $objSede->setDepartamento_sede($Departamento);
        $objSede->setProvincia_sede($Provincia);
        $objSede->setDistrito_sede($Distrito);
        $objSede->setDireccion_sede($Direccion);
        $objSede->setTipo_sede($TipoSede);

        $resultado = $objSede->editar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
