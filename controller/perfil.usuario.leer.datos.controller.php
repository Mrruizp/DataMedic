<?php

require_once '../util/functions/Helper.class.php';
require_once '../logic/Usuario.class.php';


//Haciendo lectura de la variable $_POST["dniUsuarioSesion"] que viene del archivo perfil.usuario.view.php
//$dni = $_POST["dniUsuarioSesion"];
$dni = $_POST["s_usuario"];

try {
    $objUsuario  = new Usuario();
//  a. Estado = Cita Atendida
    $objUsuario1 = new Usuario();
    $objUsuario2 = new Usuario();
    $objUsuario3 = new Usuario();
    $objUsuario4 = new Usuario();
    $objUsuario5 = new Usuario();
    $objUsuario6 = new Usuario();
    $objUsuario7 = new Usuario();
    $objUsuario8 = new Usuario();
    $objUsuario9 = new Usuario();
    $objUsuario10 = new Usuario();
    $objUsuario11 = new Usuario();
    $objUsuario12 = new Usuario();
// --------------------------------------------------   
    $resultado   = $objUsuario->leerDatos($dni);

// REPORTE 1: Número de citas: por estado y mes 
//  a. Estado = Cita Atendida
    $resultado1  = $objUsuario1->reporte1_enero();
    $resultado2  = $objUsuario2->reporte1_febrero();
    $resultado3  = $objUsuario3->reporte1_marzo();
    $resultado4  = $objUsuario4->reporte1_abril();
    $resultado5  = $objUsuario5->reporte1_mayo();
    $resultado6  = $objUsuario6->reporte1_junio();
    $resultado7  = $objUsuario7->reporte1_julio();
    $resultado8  = $objUsuario8->reporte1_agosto();
    $resultado9 = $objUsuario9->reporte1_setiembre();
    $resultado10 = $objUsuario10->reporte1_octubre();
    $resultado11 = $objUsuario11->reporte1_noviembre();
    $resultado12 = $objUsuario12->reporte1_diciembre();
// b. Estado : Citan Denegada.
//    echo '<pre>';
//    print_r($resultado);
//    echo '</pre>';
    
} catch (Exception $exc) {
    Helper::mensaje($exc->getMessage(), "e");
}

