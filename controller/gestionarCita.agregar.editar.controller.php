<?php

try {

    require_once '../logic/Cita.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_doc_id"]) ||
            empty($_POST["p_doc_id"]) ||

            !isset($_POST["p_fecha"]) ||
            empty($_POST["p_fecha"]) ||

            !isset($_POST["p_hora"]) ||
            empty($_POST["p_hora"]) ||

            !isset($_POST["p_doctor"]) ||
            empty($_POST["p_doctor"]) ||

            !isset($_POST["p_descripcion"]) ||
            empty($_POST["p_descripcion"]) ||
            
            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

     $doc_id        = $_POST["p_doc_id"];
     $fecha         = $_POST["p_fecha"];
     $hora          = $_POST["p_hora"];
     //$especialidad  = $_POST["especialidad"];
     $doctor        = $_POST["p_doctor"];
     $descripcion   = $_POST["p_descripcion"];
     $tipoOperacion = $_POST["p_tipo_ope"];

    $objCita = new Cita();

    if ($tipoOperacion == "agregar") {
        $objCita->setDoc_id($doc_id);
        $objCita->setFecha($fecha);
        $objCita->setHora($hora);
        $objCita->setDoctor_id($doctor);
        $objCita->setDescripcion($descripcion);
        
        
        $resultado = $objCita->agregar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    } else { //Editar
        if (
                !isset($_POST["p_codigo_curso"]) ||
                empty($_POST["p_codigo_curso"])
        ) {
            Helper::imprimeJSON(500, "Falta completar datos para editar", "");
            exit();
        }

        $codigo = $_POST["p_codigo_curso"];
        $objCita->setDoc_id($doc_id);
        $objCita->setFecha($fecha);
        $objCita->setHora($hora);
        $objCita->setDoctor_id($doctor);
        $objCita->setDescripcion($descripcion);
        $resultado = $objCita->editar();
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
    }
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
