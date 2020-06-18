<?php

try {

    require_once '../logic/Doctor.class.php';
    require_once '../util/functions/Helper.class.php';

 
    if
    (
            !isset($_POST["p_colegio"]) ||
            empty($_POST["p_colegio"]) ||

            !isset($_POST["p_codigo_colegio"]) ||
            empty($_POST["p_codigo_colegio"]) ||

            !isset($_POST["p_nombre"]) ||
            empty($_POST["p_nombre"]) ||

            !isset($_POST["p_apellido"]) ||
            empty($_POST["p_apellido"]) ||

            !isset($_POST["p_direccion"]) ||
            empty($_POST["p_direccion"]) ||

            !isset($_POST["p_telefono"]) ||
            empty($_POST["p_telefono"]) ||

            !isset($_POST["p_email"]) ||
            empty($_POST["p_email"]) ||

            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

     $colegio         = $_POST["p_colegio"];
     $codigo_colegio  = $_POST["p_codigo_colegio"];
     $nombre          = $_POST["p_nombre"];
     $apellido        = $_POST["p_apellido"];
     $direccion       = $_POST["p_direccion"];
     $telefono        = $_POST["p_telefono"];
     $email           = $_POST["p_email"];

     $tipoOperacion = $_POST["p_tipo_ope"];

    $objDoctor = new Doctor();

    if ($tipoOperacion == "agregar") {

        $objDoctor->setColegio($colegio);
        $objDoctor->setCodigo_colegio($codigo_colegio);
        $objDoctor->setNombre($nombre);
        $objDoctor->setApellido($apellido);
        $objDoctor->setDireccion($direccion);
        $objDoctor->setTelefono($telefono);
        $objDoctor->setEmail($email);
        
        $resultado = $objDoctor->agregar();
        
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_codigo_doctor"]) ||
                empty($_POST["p_codigo_doctor"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_codigo_doctor"];
        $objDoctor->setDoctor_id($codigo);
        $objDoctor->setColegio($colegio);
        $objDoctor->setCodigo_colegio($codigo_colegio);
        $objDoctor->setNombre($nombre);
        $objDoctor->setApellido($apellido);
        $objDoctor->setDireccion($direccion);
        $objDoctor->setTelefono($telefono);
        $objDoctor->setEmail($email);
        $resultado = $objDoctor->editar($codigo);
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
