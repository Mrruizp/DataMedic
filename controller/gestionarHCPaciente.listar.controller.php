<?php

require_once '../logic/HCPaciente.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objHCPaciente = new HCPaciente();
    $resultado = $objHCPaciente->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

