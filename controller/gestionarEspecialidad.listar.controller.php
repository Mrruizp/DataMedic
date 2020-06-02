<?php

require_once '../logic/Especialidad.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objEspecialidad = new Especialidad();
    $resultado = $objEspecialidad->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

