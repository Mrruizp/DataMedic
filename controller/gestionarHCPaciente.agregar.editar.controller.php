<?php

try {

    require_once '../logic/HCPaciente.class.php';
    require_once '../util/functions/Helper.class.php';

    if
    (
            !isset($_POST["p_codigo_paciente"]) ||
            empty($_POST["p_codigo_paciente"]) ||

            !isset($_POST["p_raza"]) ||
            empty($_POST["p_raza"]) ||

            !isset($_POST["p_procedencia"]) ||
            empty($_POST["p_procedencia"]) ||

            !isset($_POST["p_instruccion"]) ||
            empty($_POST["p_instruccion"]) ||

            !isset($_POST["p_religion"]) ||
            empty($_POST["p_religion"]) ||

            !isset($_POST["p_domicilio"]) ||
            empty($_POST["p_domicilio"]) ||

            !isset($_POST["p_telefPacHC"]) ||
            empty($_POST["p_telefPacHC"]) ||

            !isset($_POST["p_fechaIngresoPaciente"]) ||
            empty($_POST["p_fechaIngresoPaciente"]) ||

            !isset($_POST["p_horaHistClinica"]) ||
            empty($_POST["p_horaHistClinica"]) ||

            !isset($_POST["p_modoIngreso"]) ||
            empty($_POST["p_modoIngreso"]) ||

            !isset($_POST["p_fechaHistClinica"]) ||
            empty($_POST["p_fechaHistClinica"]) ||

            !isset($_POST["p_enfermedadActual"]) ||
            empty($_POST["p_enfermedadActual"]) ||

            !isset($_POST["p_personaResponsable_paciente1"]) ||
            empty($_POST["p_personaResponsable_paciente1"]) ||

            !isset($_POST["p_telefono_paciente2"]) ||
            empty($_POST["p_telefono_paciente2"]) 
    ) 
    {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
/*
    echo '<pre>';
    echo 'Datos que llegan por POST';
    print_r($_POST);
    echo '</pre>';
*/
     $codigo_paciente              = $_POST["p_codigo_paciente"];
     $raza                         = $_POST["p_raza"];
     $procedencia                  = $_POST["p_procedencia"];
     $instruccion                  = $_POST["p_instruccion"];
     $religion                     = $_POST["p_religion"];
     $domicilio                    = $_POST["p_domicilio"];
     $telefPacHC                   = $_POST["p_telefPacHC"];
     $fechaIngresoPaciente         = $_POST["p_fechaIngresoPaciente"];
     $horaHistClinica              = $_POST["p_horaHistClinica"];
     $modoIngreso                  = $_POST["p_modoIngreso"];
     $fechaHistClinica             = $_POST["p_fechaHistClinica"];
     $enfermedadActual             = $_POST["p_enfermedadActual"];
     $personaResponsable_paciente1 = $_POST["p_personaResponsable_paciente1"];
     $telefono_paciente2           = $_POST["p_telefono_paciente2"];


     //$tipoOperacion = $_POST["p_tipo_ope"];

    $objHCPaciente = new HCPaciente();
       
        $resultado = $objHCPaciente->agregarDatosAdicionales(
                                                                    $codigo_paciente,
                                                                    $raza,
                                                                    $procedencia,
                                                                    $instruccion,
                                                                    $religion,
                                                                    $domicilio,
                                                                    $telefPacHC,
                                                                    $fechaIngresoPaciente,
                                                                    $horaHistClinica,
                                                                    $modoIngreso,
                                                                    $fechaHistClinica,
                                                                    $enfermedadActual,
                                                                    $personaResponsable_paciente1,
                                                                    $telefono_paciente2
                                                                );
        
        

        if ($resultado) {
            Helper::imprimeJSON(200, "Agregado correctamente", "");
        }
   
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}
