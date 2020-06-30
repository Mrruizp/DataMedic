<?php

require_once '../data/Conexion.class.php';
session_name("DataMedic");
session_start();

class Especializacion extends Conexion {

    private $Especializacion_id;
    private $Especialidad_id;
    private $Doctor_id;
    


    public function getEspecializacion_id() {
        return $this->Especializacion_id;
    }

    public function getEspecialidad_id() {
        return $this->Especialidad_id;
    }

    public function getDoctor_id() {
        return $this->Doctor_id;
    }


    public function setEspecializacion_id($Especializacion_id) {
        $this->Especializacion_id = $Especializacion_id;
    }

    public function setEspecialidad_id($Especialidad_id) {
        $this->Especialidad_id = $Especialidad_id;
    }

    public function setDoctor_id($Doctor_id) {
        $this->Doctor_id = $Doctor_id;
    }



    public function listar() {
        try {

                $sql = "
                        select 
                            e.doctorespecializacion_id,
                            s.nombre_especialidad,
                            concat(d.nombre, ', ',d.apellido) as nombresDoctor
                        from 
                            doctorespecializacion e inner join especialidad s
                        on
                            e.especialidad_id = s.especialidad_id inner join doctor d
                        on
                            e.doctor_id = d.doctor_id
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
            $sql = "select * from f_generar_correlativo('doctorespecializacion') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setEspecializacion_id($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "

                    insert into doctorespecializacion
                    values(
                            :p_Especializacion_id,
                            :p_Especialidad_id,
                            :p_doctor_id
                           )
                    ";
                $sentencia = $this->dblink->prepare($sql);
   
                $sentencia->bindParam(":p_Especializacion_id", $this->getEspecializacion_id());
                $sentencia->bindParam(":p_Especialidad_id", $this->getEspecialidad_id());
                $sentencia->bindParam(":p_doctor_id", $this->getDoctor_id());
                $sentencia->execute();
                /*Insertar en la tabla laboratorio*/
                
                
                $sql = "
                            insert into log_doctorEspecializacion
                            values(
                                    '$_SESSION[s_doc_id]',
                                    '$_SESSION[s_usuario]',
                                     $_SESSION[cargo_id],
                                    '$_SESSION[tipo]',
                                    (select current_date),
                                    (select current_time),
                                    'Insert',
                                    '$_SERVER[REMOTE_ADDR]',
                                    :p_Especializacion_id,
                                    :p_Especialidad_id,
                                    :p_doctor_id
                                );
                        ";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_Especializacion_id", $this->getEspecializacion_id());
                        $sentencia->bindParam(":p_Especialidad_id", $this->getEspecialidad_id());
                        $sentencia->bindParam(":p_doctor_id", $this->getDoctor_id());
                        $sentencia->execute();
                        
                        /*Actualizar el correlativo*/
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='doctorespecializacion'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                //*Actualizar el correlativo*/

                $this->dblink->commit();
                return true;
                
            }else{
                throw new Exception("No se ha configurado el correlativo para la tabla doctorEspecializacion");
            }
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return false;
    }

    public function leerDatos($codDoctorespecializacion) {
        try {
            $sql = "
                    select 
                        doctorespecializacion_id,
                        especialidad_id,
                        doctor_id
                    from 
                        doctorespecializacion
                    where
                        doctorespecializacion_id = $codDoctorespecializacion;
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

    public function editar($p_codigoEspecializacion) {
        try {
            $sql = "
                update 
                    doctorespecializacion 
                set  
                    especialidad_id = :p_especialidad_id,
                    doctor_id = :p_doctor_id
                where
                    doctorespecializacion_id = $p_codigoEspecializacion;
                ";
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_Especializacion_id", $this->getEspecializacion_id());
            $sentencia->bindParam(":p_especialidad_id", $this->getEspecialidad_id());
            $sentencia->bindParam(":p_doctor_id", $this->getDoctor_id());
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
                delete from doctorespecializacion where doctorespecializacion_id = :p_especializaion_id;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_especializaion_id", $this->getEspecializacion_id());
            $sentencia->execute();
            
            $sql = "insert into log_doctorEspecializacion
                            values(
                                    '$_SESSION[s_doc_id]',
                                    '$_SESSION[s_usuario]',
                                     $_SESSION[cargo_id],
                                    '$_SESSION[tipo]',
                                    (select current_date),
                                    (select current_time),
                                    'delete',
                                    '$_SERVER[REMOTE_ADDR]',
                                    :p_Especializacion_id,
                                    :p_Especialidad_id,
                                    :p_doctor_id
                                );
                        ";
                        $sentencia = $this->dblink->prepare($sql);
                        $sentencia->bindParam(":p_Especializacion_id", $this->getEspecializacion_id());
                        $sentencia->bindParam(":p_Especialidad_id", $this->getEspecialidad_id());
                        $sentencia->bindParam(":p_doctor_id", $this->getDoctor_id());
                        $sentencia->execute();
        
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
