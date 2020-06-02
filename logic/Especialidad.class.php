<?php

require_once '../data/Conexion.class.php';
session_name("DataMedic");
session_start();

class Especialidad extends Conexion {

    private $Especialidad_id;
    private $Especialidad;
    


    public function getEspecialidad_id() {
        return $this->Especialidad_id;
    }

    public function getEspecialidad() {
        return $this->Especialidad;
    }


    public function setEspecialidad_id($Especialidad_id) {
        $this->Especialidad_id = $Especialidad_id;
    }

    public function setEspecialidad($Especialidad) {
        $this->Especialidad = $Especialidad;
    }


    public function listar() {
        try {

                $sql = "
                        select 
                            especialidad_id,
                            nombre_especialidad
                        from 
                            especialidad
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
            $sql = "select * from f_generar_correlativo('especialidad') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setEspecialidad_id($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "

                    insert into especialidad
                    values(:p_Especialidad_id,:p_Especialidad)
                    ";
                $sentencia = $this->dblink->prepare($sql);
   
                $sentencia->bindParam(":p_Especialidad_id", $this->getEspecialidad_id());
                $sentencia->bindParam(":p_Especialidad", $this->getEspecialidad());
                $sentencia->execute();
                /*Insertar en la tabla laboratorio*/
                
                /*Actualizar el correlativo*/
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='especialidad'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                //*Actualizar el correlativo*/
               /* $sql2 = "select * from fn_insert_log_tratamiento(
                                                                    '$_SESSION[s_doc_id]',
                                                                    '$_SESSION[s_usuario]',
                                                                     $_SESSION["cargo"],
                                                                    '$_SESSION[tipo]',
                                                                    'Registro',
                                                                    '$_SERVER[REMOTE_ADDR]'
                                                                    :p_Tratamiento_id,
                                                                    :p_Tratamiento
                                                                );";
                        $sentencia2 = $this->dblink->prepare($sql2);
                        $sentencia2->bindParam(":p_Tratamiento_id", $this->getTratamiento_id());
                        $sentencia2->bindParam(":p_Tratamiento", $this->getTratamiento());
                        $sentencia2->execute();
                        */
                $this->dblink->commit();
                return true;
                
            }else{
                throw new Exception("No se ha configurado el correlativo para la tabla especialidad");
            }
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return false;
    }

    public function leerDatos($codEspecialidad) {
        try {
            $sql = "
                    select 
                        especialidad_id,
                        nombre_especialidad
                    from 
                        especialidad
                    where
                        especialidad_id = $codEspecialidad;
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

    public function editar($p_codigoEspecialidad) {
        try {
            $sql = "
                update 
                    especialidad 
                set  
                    nombre_especialidad = :p_especialidad
                where
                    especialidad_id = $p_codigoEspecialidad;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_especialidad", $this->getEspecialidad());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

    public function eliminar() {
        try {
            $sql = "
                delete from especialidad where especialidad_id = :p_especialidad_id;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_especialidad_id", $this->getEspecialidad_id());
            $sentencia->execute();
            /*
            $sql = "select * from fn_insert_log_curso
                                    (
                                        '$_SESSION[s_doc_id]',
                                        '$_SESSION[s_usuario]',
                                        '$_SESSION[s_apellidos]',
                                        $_SESSION[cargo_id],
                                        '$_SESSION[tipo]',
                                        :p_curso_id,
                                        null,
                                        'Eliminar',
                                        '$_SERVER[REMOTE_ADDR]'
                                    );";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_curso_id", $this->getCodigo_curso());
                //$sentencia->bindParam(":p_nombre_curso", $this->getNombre_curso());
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
