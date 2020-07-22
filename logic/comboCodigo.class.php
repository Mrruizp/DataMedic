<?php

require_once '../data/Conexion.class.php';
session_name("lachuspita");
session_start();
class comboCodigo extends Conexion {

    
    public function cargarDatos_CodigoDepartamento() {
        
        try {
            $sql = "
                    select 
                        dep_codDepartamento, 
                        dep_nombre 
                    from 
                        departamento;";

            
            $sentencia = $this->dblink->prepare($sql);
           // $sentencia->bindParam(":p_curso_id", $codigo_curso);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function cargarDatos_CodigoProvinciaDepartamento($codigo_departamento) {
        
        try {
            $sql = "
                    select 
                        prov_codProvincia,
                        prov_nombre
                    from
                        provincia
                    where
                        dep_codDepartamento = $codigo_departamento;";

            
            $sentencia = $this->dblink->prepare($sql);
           // $sentencia->bindParam(":p_curso_id", $codigo_curso);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function cargarDatos_CodigoDistritoProvincia($codigo_provincia) {
        
        try {
            $sql = "
                    select 
                        dist_codDistrito,
                        dist_nombre
                    from
                        distrito
                    where
                        prov_codProvincia = $codigo_provincia;";

            
            $sentencia = $this->dblink->prepare($sql);
           // $sentencia->bindParam(":p_curso_id", $codigo_curso);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
}
