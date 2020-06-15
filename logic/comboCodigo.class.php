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

    public function cargarDatos_CodigoAreaSede2($codigo_sede) {
        
        try {
            $sql = "
                    select 
                        a.area_id,
                        a.nombre_area
                    from
                        consultorio c inner join area a
                    on
                        (c.area_id = a.area_id)
                    where
                        c.sede_id = $codigo_sede;";

            
            $sentencia = $this->dblink->prepare($sql);
           // $sentencia->bindParam(":p_curso_id", $codigo_curso);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function cargarDatos_CodigoAreaSede($codigo_sede) {
        
        try {
            $sql = "
                    select 
                        a.area_id,
                        a.nombre_area
                    from
                        consultorio c inner join area a
                    on
                        (c.area_id = a.area_id)
                    where
                        c.sede_id = $codigo_sede;";

            
            $sentencia = $this->dblink->prepare($sql);
           // $sentencia->bindParam(":p_curso_id", $codigo_curso);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function cargarDatos_CodigoConsultorio($codigo_area) {
        
        try {
            $sql = "
                    select 
                      consultorio_id,
                      nombre_consultorio
                    from
                        consultorio
                    where
                        area_id = $codigo_area;";

            
            $sentencia = $this->dblink->prepare($sql);
           // $sentencia->bindParam(":p_curso_id", $codigo_curso);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function cargarDatos_CodigoConsultorioCita($codigo_consultorio) {
        
        try {
            $sql = "
                    select 
                      c.consultorio_id,
                      c.nombre_consultorio
                    from
                        horario_atencion h inner join consultorio c
                    on
                        h.consultorio_id = c.consultorio_id
                    where
                        h.horario_atencion_id = $codigo_consultorio;";

            
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

    public function cargarDatos_CodigoDoctorHorario() {
        
        try {
            $sql = "
                    select 
                      doctor_id,
                      concat(nombre, ' ',apellido) as nombreCompleto
                    from
                        doctor;";

            
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

    public function cargarDatos_CodigoConsultorio2() {
        
        try {
            $sql = "
                    select 
                        consultorio_id,
                        nombre_consultorio
                    from 
                        consultorio;";

            
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
