<?php

require_once 'configuracion.php';
//require_once '../util/functions/Helper.class.php';

class Conexion{
    protected $dblink;
    
    public function __construct() {
        $this->abrirConexion();
        //echo "conexi¨®n abierta";
    }
    
    public function __destruct() {
        $this->dblink = NULL;
        //echo "Conexi¨®n cerrada";
    }
    
    protected function abrirConexion(){
        $servidor = "mysql:host=".BD_SERVIDOR.";dbname=".BD_NOMBRE_BD;
        //$servidor = "mysql:host=".BD_SERVIDOR.";port=".BD_PUERTO.";dbname=".BD_NOMBRE_BD;
        $usuario = BD_USUARIO;
        $clave = BD_CLAVE;
        
        try {
            $this->dblink = new PDO($servidor, $usuario, $clave);
            $this->dblink->exec('SET NAMES utf8');
            $this->dblink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $exc) {
            Helper::mensaje($exc->getMessage(), "e");
            
        }
        
        return $this->dblink;
    }
}