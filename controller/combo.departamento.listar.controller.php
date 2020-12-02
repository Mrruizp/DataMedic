<?php

require_once '../logic/comboCodigo.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objComboCodigo = new comboCodigo();
    $resultado = $objComboCodigo->cargarDatos_CodigoDepartamento();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

