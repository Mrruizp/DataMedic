<?php

try {

    require_once '../logic/Horario.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            
        /*
            !isset($_POST["p_sede"]) ||
            empty($_POST["p_sede"]) ||

            !isset($_POST["p_area"]) ||
            empty($_POST["p_area"]) ||
        */
            !isset($_POST["p_consultorio"]) ||
            empty($_POST["p_consultorio"]) ||

            !isset($_POST["p_doctor"]) ||
            empty($_POST["p_doctor"]) ||
 
            !isset($_POST["p_dia"]) ||
            empty($_POST["p_dia"]) ||

            !isset($_POST["p_numero"]) ||
            empty($_POST["p_numero"]) ||

            !isset($_POST["p_mes"]) ||
            empty($_POST["p_mes"]) ||

            !isset($_POST["p_ano"]) ||
            empty($_POST["p_ano"]) ||

            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }

    // $sede        = $_POST["p_sede"];
    // $area        = $_POST["p_area"];
     $consultorio = $_POST["p_consultorio"];
     $doctor      = $_POST["p_doctor"];
     $dia         = $_POST["p_dia"];
     $numero      = $_POST["p_numero"];
     $mes         = $_POST["p_mes"];
     $ano         = $_POST["p_ano"];

     $tipoOperacion = $_POST["p_tipo_ope"];

    $objHorario = new Horario();

    if ($tipoOperacion == "agregar") {

        //$objCita->setSede($sede);
       // $objCita->setFecha($area);
        $objHorario->setConsultorio_id($consultorio);
        $objHorario->setDoctor_id($doctor);
        $objHorario->setDia($dia);
        $objHorario->setNumero($numero);
        $objHorario->setMes($mes);
        $objHorario->setAno($ano);
        
        $resultado = $objHorario->agregar();
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
