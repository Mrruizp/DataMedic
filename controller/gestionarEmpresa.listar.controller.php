<?php

require_once '../logic/Empresa.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objEmpresa = new Empresa();
    $resultado = $objEmpresa->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

