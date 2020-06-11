<?php

require_once '../data/Conexion.class.php';
session_name("DataMedic");
session_start();
class comboCodigo extends Conexion {

    private $CodigoCurso;
    //private $CodigoFormacion;
    
    public function getCodigoCurso() {
        return $this->CodigoCurso;
    }
/*
    public function getCodigoFormacion() {
        return $this->codigoFormacion;
    }
*/
    public function setCodigoCurso($CodigoCurso) {
        $this->CodigoCurso = $CodigoCurso;
    }
/*
    public function setCodigoFormacion($codigoFormacion) {
        $this->codigoFormacion = $codigoFormacion;
    }

  */  
    public function cargarDatos_CodigoEspecialidad() {
        
        try {
            $sql = "
                    select 
                        especialidad_id, 
                        nombre_especialidad 
                    from 
                        especialidad;";

            
            $sentencia = $this->dblink->prepare($sql);
           // $sentencia->bindParam(":p_curso_id", $codigo_curso);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function cargarDatos_CodigoDoctor($codigo_especialidad) {
        
        try {
            $sql = "
                    select 
                        doctor_id,
                        concat(nombre, ', ',apellido)as nombres
                    from 
                        doctor
                    where
                        especialidad_id = $codigo_especialidad;";

            
            $sentencia = $this->dblink->prepare($sql);
           // $sentencia->bindParam(":p_curso_id", $codigo_curso);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function cargarDatos_CodigoFecha() {
        
        try {
            $sql = "
                    select 
                        
                        distinct on (dia_semana,numero,mes)
                        fecha_id,
                        concat(dia_semana, ' ',numero, ' de ',mes) as fecha
                    from 
                        fecha
                    where
                        estado = 'disponible'
                    order by 
                        dia_semana, numero, mes;";

            
            $sentencia = $this->dblink->prepare($sql);
           // $sentencia->bindParam(":p_curso_id", $codigo_curso);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function cargarDatos_CodigoHora() {
        
        try {
            $sql = "
                    select 
                        fecha_id,
                        hora
                    from 
                        fecha
                    where
                        estado = 'disponible';";

            
            $sentencia = $this->dblink->prepare($sql);
           // $sentencia->bindParam(":p_curso_id", $codigo_curso);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function cargarDatos_CodigoEmpresa() {
        
        try {
            $sql = "
                    select 
                        empresa_id,
                        razon_social,
                        razon_comercial,
                        ruc
                    from 
                        empresa;";

            
            $sentencia = $this->dblink->prepare($sql);
           // $sentencia->bindParam(":p_curso_id", $codigo_curso);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function cargarDatos_CodigoSede() {
        
        try {
            $sql = "
                    select 
                        sede_id,
                        nombre_sede
                    from 
                        sede;";

            
            $sentencia = $this->dblink->prepare($sql);
           // $sentencia->bindParam(":p_curso_id", $codigo_curso);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function cargarDatos_CodigoArea() {
        
        try {
            $sql = "
                    select 
                        area_id,
                        nombre_area
                    from 
                        area;";

            
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
