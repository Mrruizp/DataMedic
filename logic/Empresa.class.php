<?php

require_once '../data/Conexion.class.php';
session_name("DataMedic");
session_start();

class Empresa extends Conexion {

    private $Empresa_id;
    private $Razon_social;
    private $Razon_comercial;
    private $Ruc;
    


    public function getEmpresa_id() {
        return $this->Empresa_id;
    }

    public function getRazon_social() {
        return $this->Razon_social;
    }

    public function getRazon_comercial() {
        return $this->Razon_comercial;
    }

    public function getRuc() {
        return $this->Ruc;
    }


    public function setEmpresa_id($Empresa_id) {
        $this->Empresa_id = $Empresa_id;
    }

    public function setRazon_social($Razon_social) {
        $this->Razon_social = $Razon_social;
    }

    public function setRazon_comercial($Razon_comercial) {
        $this->Razon_comercial = $Razon_comercial;
    }

    public function setRuc($Ruc) {
        $this->Ruc = $Ruc;
    }


    public function listar() {
        try {

                $sql = "
                        select 
                            empresa_id,
                            razon_social,
                            razon_comercial,
                            ruc
                        from 
                            empresa
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
            $sql = "select * from f_generar_correlativo('empresa') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setEmpresa_id($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "

                    insert into empresa
                    values(
                            :p_empresa_id,
                            :p_razon_social,
                            :p_razon_comercial,
                            :p_ruc
                            )
                    ";
                $sentencia = $this->dblink->prepare($sql);
   
                $sentencia->bindParam(":p_empresa_id", $this->getEmpresa_id());
                $sentencia->bindParam(":p_razon_social", $this->getRazon_social());
                $sentencia->bindParam(":p_razon_comercial", $this->getRazon_comercial());
                $sentencia->bindParam(":p_ruc", $this->getRuc());
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
                    where tabla='especialidad'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                //*Actualizar el correlativo*/

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

    public function leerDatos($codEmpresa) {
        try {
            $sql = "
                    select 
                            empresa_id,
                            razon_social,
                            razon_comercial,
                            ruc
                        from 
                            empresa
                    where
                        empresa_id = $codEmpresa;
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

    public function editar($p_codigoEmpresa) {
        try {
            $sql = "
                update 
                    empresa 
                set 
                    razon_social = :p_razon_social,
                    razon_comercial = :p_razon_comercial,
                    ruc = :p_ruc
                where
                    empresa_id = $p_codigoEmpresa;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_razon_social", $this->getRazon_social());
             $sentencia->bindParam(":p_razon_comercial", $this->getRazon_comercial());
             $sentencia->bindParam(":p_ruc", $this->getRuc());
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
                delete from empresa where empresa_id = :p_empresa_id;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_empresa_id", $this->getEmpresa_id());
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
