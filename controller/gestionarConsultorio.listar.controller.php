<?php

require_once '../logic/Consultorio.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objConsultorio = new Consultorio();
    $resultado = $objConsultorio->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

