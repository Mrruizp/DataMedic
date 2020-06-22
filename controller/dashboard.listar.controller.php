<?php

require_once '../logic/Tratamiento.class.php';
require_once '../util/functions/Helper.class.php';

try {
    $objTratamiento = new Tratamiento();
    $resultado = $objTratamiento->listar();
    Helper::imprimeJSON(200, "", $resultado);
} catch (Exception $exc) {
    Helper::imprimeJSON(500, $exc->getMessage(), "");
}

