<?php

require_once '../data/Conexion.class.php';
session_name("DataMedic");
session_start();

class Tratamiento extends Conexion {

    private $Tratamiento_id;
    private $Tratamiento;
    


    public function getTratamiento_id() {
        return $this->Tratamiento_id;
    }

    public function getTratamiento() {
        return $this->Tratamiento;
    }


    public function setTratamiento_id($Tratamiento_id) {
        $this->Tratamiento_id = $Tratamiento_id;
    }

    public function setTratamiento($Tratamiento) {
        $this->Tratamiento = $Tratamiento;
    }


    public function listar() {
        try {

                $sql = "
                        select 
                            tratamiento_id,
                            nombre_tratamiento
                        from 
                            tratamiento
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
            $sql = "select * from f_generar_correlativo('tratamiento') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setTratamiento_id($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "

                    insert into tratamiento
                    values(:p_Tratamiento_id,:p_Tratamiento)
                    ";
                $sentencia = $this->dblink->prepare($sql);
   
                $sentencia->bindParam(":p_Tratamiento_id", $this->getTratamiento_id());
                $sentencia->bindParam(":p_Tratamiento", $this->getTratamiento());
                $sentencia->execute();
                /*Insertar en la tabla laboratorio*/
                
                /*Actualizar el correlativo*/
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='tratamiento'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                //*Actualizar el correlativo*/
                $this->dblink->commit();
                return true;
                
            }else{
                throw new Exception("No se ha configurado el correlativo para la tabla tratamiento");
            }
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return false;
    }

    public function leerDatos($p_codigoTratamiento) {
        try {
            $sql = "
                    select 
                        tratamiento_id,
                        nombre_tratamiento
                    from 
                        tratamiento
                    where
                        tratamiento_id = $p_codigoTratamiento;
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

    public function editar($p_codigoTrat) {
        try {
            $sql = "
                update 
                    tratamiento 
                set  
                    nombre_tratamiento = :p_Tratamiento
                where
                    tratamiento_id = $p_codigoTrat;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_Tratamiento", $this->getTratamiento());
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
                select * from fn_eliminarCursoPruebaPregunta(:p_curso_id);
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_curso_id", $this->getCodigo_curso());
            $sentencia->execute();

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
