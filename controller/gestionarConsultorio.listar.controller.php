<?php

require_once '../logic/Sede.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objSede = new Sede();
    $resultado = $objSede->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

