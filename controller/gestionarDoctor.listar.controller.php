<?php

require_once '../logic/Doctor.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objDoctor = new Doctor();
    $resultado = $objDoctor->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

