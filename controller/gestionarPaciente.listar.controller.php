<?php

require_once '../logic/Cita.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objCita = new Cita();
    $resultado = $objCita->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

