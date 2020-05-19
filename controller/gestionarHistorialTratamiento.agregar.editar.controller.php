<?php

try {

    require_once '../logic/Cita.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_cod_tratamiento"]) ||
            empty($_POST["p_cod_tratamiento"]) ||

            !isset($_POST["p_cod_citaTratamiento"]) ||
            empty($_POST["p_cod_citaTratamiento"]) ||

            !isset($_POST["p_cod_paciente"]) ||
            empty($_POST["p_cod_paciente"]) ||

            !isset($_POST["p_fechaHistTratamiento"]) ||
            empty($_POST["p_fechaHistTratamiento"]) ||

            !isset($_POST["p_horaHistTratamiento"]) ||
            empty($_POST["p_horaHistTratamiento"]) ||

            !isset($_POST["p_descripcionHistTratamiento"]) ||
            empty($_POST["p_descripcionHistTratamiento"]) 
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
/*
    echo '<pre>';
    echo 'Datos que llegan por POST';
    print_r($_POST);
    echo '</pre>';
*/
     $cod_tratamiento             = $_POST["p_cod_tratamiento"];
     $cod_citaTratamiento         = $_POST["p_cod_citaTratamiento"];
     $cod_paciente                = $_POST["p_cod_paciente"];
     $fechaHistTratamiento        = $_POST["p_fechaHistTratamiento"];
     $horaHistTratamiento         = $_POST["p_horaHistTratamiento"];
     $descripcionHistTratamiento  = $_POST["p_descripcionHistTratamiento"];

     //$tipoOperacion = $_POST["p_tipo_ope"];

    $objCita = new Cita();

        $objCita->setTratamiento_id($cod_tratamiento);
        $objCita->setCita_id($cod_citaTratamiento);
        $objCita->setCod_paciente_Historial_tratamiento_id($cod_paciente);
        $objCita->setFecha_historial_tratamiento($fechaHistTratamiento);
        $objCita->setHora_historial_tratamiento($horaHistTratamiento);
        $objCita->setDescripcion_historial_tratamiento($descripcionHistTratamiento);
        
        $resultado = $objCita->agregarHistorialTratamiento();
        
        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
   
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
