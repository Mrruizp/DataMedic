<?php

require_once '../logic/Especializacion.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objEspecializacion = new Especializacion();
    $resultado = $objEspecializacion->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

