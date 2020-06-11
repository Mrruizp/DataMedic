<?php

require_once '../logic/Area.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objArea = new Area();
    $resultado = $objArea->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

