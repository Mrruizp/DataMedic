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
// Paciente:  
            !isset($_POST["p_doc_id_paciente"]) ||
            empty($_POST["p_doc_id_paciente"]) ||

            !isset($_POST["p_ciudad_paciente"]) ||
            empty($_POST["p_ciudad_paciente"]) ||

            !isset($_POST["p_estadoCivil_paciente"]) ||
            empty($_POST["p_estadoCivil_paciente"]) ||

            !isset($_POST["p_edad_paciente"]) ||
            empty($_POST["p_edad_paciente"]) ||

            !isset($_POST["p_nombre_paciente"]) ||
            empty($_POST["p_nombre_paciente"]) ||

            !isset($_POST["p_apellidos_paciente"]) ||
            empty($_POST["p_apellidos_paciente"]) ||

            !isset($_POST["p_sexo_paciente"]) ||
            empty($_POST["p_sexo_paciente"]) ||

            !isset($_POST["p_ocupacion_paciente"]) ||
            empty($_POST["p_ocupacion_paciente"]) ||

            !isset($_POST["p_religion_paciente"]) ||
            empty($_POST["p_religion_paciente"]) ||

            !isset($_POST["p_domicilio_paciente"]) ||
            empty($_POST["p_domicilio_paciente"]) ||

            !isset($_POST["p_telefono_paciente"]) ||
            empty($_POST["p_telefono_paciente"]) ||

            !isset($_POST["p_personaResponsable_paciente"]) ||
            empty($_POST["p_personaResponsable_paciente"]) ||

            !isset($_POST["p_telefonoResponsable_paciente"]) ||
            empty($_POST["p_telefonoResponsable_paciente"]) ||

            !isset($_POST["p_tipo_ope"]) ||
            empty($_POST["p_tipo_ope"])
    ) {
        Helper::imprimeJSON(500, "Falta completar datos", "");
        exit();
    }
//Cita
     $doc_id        = $_POST["p_doc_id"];
     $fecha         = $_POST["p_fecha"];
     $hora          = $_POST["p_hora"];
     $doctor        = $_POST["p_doctor"];
     $descripcion   = $_POST["p_descripcion"];
//Paciente
     $Doc_id_paciente              = $_POST["p_doc_id_paciente"];
     $Ciudad_paciente              = $_POST["p_ciudad_paciente"];
     $EstadoCivil_paciente         = $_POST["p_estadoCivil_paciente"];
     $Edad_paciente                = $_POST["p_edad_paciente"];
     $Nombre_paciente              = $_POST["p_nombre_paciente"];
     $Apellidos_paciente           = $_POST["p_apellidos_paciente"];
     $Sexo_paciente                = $_POST["p_sexo_paciente"];
     $Ocupacion_paciente           = $_POST["p_ocupacion_paciente"];
     $Religion_paciente            = $_POST["p_religion_paciente"];
     $Domicilio_paciente           = $_POST["p_domicilio_paciente"];
     $Telefono_paciente            = $_POST["p_telefono_paciente"];
     $PersonaResponsable_paciente  = $_POST["p_personaResponsable_paciente"];
     $TelefonoResponsable_paciente = $_POST["p_telefonoResponsable_paciente"];

     $tipoOperacion = $_POST["p_tipo_ope"];

    $objCita = new Cita();

    if ($tipoOperacion == "agregar") {
//Cita
        $objCita->setDoc_id($doc_id);
        $objCita->setFecha($fecha);
        $objCita->setHora($hora);
        $objCita->setDoctor_id($doctor);
        $objCita->setDescripcion($descripcion);
//Paciente  
        $objCita->setDoc_id_paciente($Doc_id_paciente);
        $objCita->setCiudad_paciente($Ciudad_paciente);
        $objCita->setEstadoCivil_paciente($EstadoCivil_paciente);
        $objCita->setEdad_paciente($Edad_paciente);
        $objCita->setNombre_paciente($Nombre_paciente);
        $objCita->setApellidos_paciente($Apellidos_paciente);
        $objCita->setSexo_paciente($Sexo_paciente);
        $objCita->setOcupacion_paciente($Ocupacion_paciente);
        $objCita->setReligion_paciente($Religion_paciente);
        $objCita->setDomicilio_paciente($Domicilio_paciente);
        $objCita->setTelefono_paciente($Telefono_paciente);
        $objCita->setPersonaResponsable_paciente($PersonaResponsable_paciente);
        $objCita->setTelefonoResponsable_paciente($TelefonoResponsable_paciente);
        
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