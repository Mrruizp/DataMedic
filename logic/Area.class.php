<?php

require_once '../data/Conexion.class.php';
session_name("DataMedic");
session_start();

class Area extends Conexion {

    private $Area_id;
    private $Area;
    


    public function getArea_id() {
        return $this->Area_id;
    }

    public function getArea() {
        return $this->Area;
    }


    public function setArea_id($Area_id) {
        $this->Area_id = $Area_id;
    }

    public function setArea($Area) {
        $this->Area = $Area;
    }


    public function listar() {
        try {

                $sql = "
                        select 
                            area_id,
                            nombre_area
                        from 
                            area
                ";
            
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function agregar() {
        $this->dblink->beginTransaction();

        try {
            $sql = "select * from f_generar_correlativo('area') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setArea_id($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "

                    insert into area
                    values(
                            :p_Area_id,
                            :p_Area
                            )
                    ";
                $sentencia = $this->dblink->prepare($sql);
   
                $sentencia->bindParam(":p_Area_id", $this->getArea_id());
                $sentencia->bindParam(":p_Area", $this->getArea());
                $sentencia->execute();
                /*Insertar en la tabla laboratorio*/
                
            /*
                $sql = "select * from fn_insert_log_especialidad(
                                                                    '$_SESSION[s_doc_id]',
                                                                    '$_SESSION[s_usuario]',
                                                                     $_SESSION[cargo_id],
                                                                    '$_SESSION[tipo]',
                                                                    'Registro',
                                                                    '$_SERVER[REMOTE_ADDR]',
                                                                    :p_especialidad_id,
                                                                    :p_especialidad
                                                                );";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_especialidad_id", $this->getEspecialidad_id());
                        $sentencia->bindParam(":p_especialidad", $this->getEspecialidad());
                        $sentencia->execute();
            */
                        /*Actualizar el correlativo*/
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='area'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                //*Actualizar el correlativo*/

                $this->dblink->commit();
                return true;
                
            }else{
                throw new Exception("No se ha configurado el correlativo para la tabla área");
            }
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return false;
    }

    public function leerDatos($codArea) {
        try {
            $sql = "
                    select 
                        area_id,
                        nombre_area
                    from 
                        area
                    where
                        area_id = $codArea;
                ";
            $sentencia = $this->dblink->prepare($sql);
          //  $sentencia->bindParam(":p_codigo_paciente", $p_codigoPaciente);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function editar($p_codigoArea) {
        try {
            $sql = "
                update 
                    area 
                set  
                    nombre_area = :p_area
                where
                    area_id = $p_codigoArea;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_area", $this->getArea());
            $sentencia->execute();
            /*
            $sql = "select * from fn_insert_log_especialidad(
                                                                    '$_SESSION[s_doc_id]',
                                                                    '$_SESSION[s_usuario]',
                                                                     $_SESSION[cargo_id],
                                                                    '$_SESSION[tipo]',
                                                                    'Editar',
                                                                    '$_SERVER[REMOTE_ADDR]',
                                                                    :p_especialidad_id,
                                                                    :p_especialidad
                                                                );";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_especialidad_id", $this->getEspecialidad_id());
                        $sentencia->bindParam(":p_especialidad", $this->getEspecialidad());
                        $sentencia->execute();
            */
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

    public function eliminar() {
        try {
            $sql = "
                delete from area where area_id = :p_area_id;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_area_id", $this->getArea_id());
            $sentencia->execute();
    /*      
            $sql = "select * from fn_insert_log_especialidad(
                                                                    '$_SESSION[s_doc_id]',
                                                                    '$_SESSION[s_usuario]',
                                                                     $_SESSION[cargo_id],
                                                                    '$_SESSION[tipo]',
                                                                    'Eliminar',
                                                                    '$_SERVER[REMOTE_ADDR]',
                                                                    :p_especialidad_id,
                                                                    :p_especialidad
                                                                );";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_especialidad_id", $this->getEspecialidad_id());
                        $sentencia->bindParam(":p_especialidad", $this->getEspecialidad());
                        $sentencia->execute();
    */
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

    public function editarEstardo($cod_citaEstado, $estado_cita) {
        try {
            $sql = "
                update 
                    cita 
                set  
                    estado = '$estado_cita'
                where
                    cita_id = $cod_citaEstado
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

}
