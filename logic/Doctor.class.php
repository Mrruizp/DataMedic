<?php

require_once '../data/Conexion.class.php';
session_name("DataMedic");
session_start();

class Doctor extends Conexion {

    private $Doctor_id;
    private $Colegio;
    private $Codigo_colegio;
    private $Nombre;
    private $Apellido;
    private $Direccion;
    private $Telefono;
    private $Email;
    


    public function getDoctor_id() {
        return $this->Doctor_id;
    }

    public function getColegio() {
        return $this->Colegio;
    }

    public function getCodigo_colegio() {
        return $this->Codigo_colegio;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function getApellido() {
        return $this->Apellido;
    }

    public function getDireccion() {
        return $this->Direccion;
    }

    public function getTelefono() {
        return $this->Telefono;
    }

    public function getEmail() {
        return $this->Email;
    }


    public function setDoctor_id($Doctor_id) {
        $this->Doctor_id = $Doctor_id;
    }

    public function setColegio($Colegio) {
        $this->Colegio = $Colegio;
    }

    public function setCodigo_colegio($Codigo_colegio) {
        $this->Codigo_colegio = $Codigo_colegio;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function setApellido($Apellido) {
        $this->Apellido = $Apellido;
    }

    public function setDireccion($Direccion) {
        $this->Direccion = $Direccion;
    }

    public function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
    }


    public function listar() {
        try {

                $sql = "
                        select 
                             Doctor_id,
                             Colegio,
                             Codigo_colegio,
                             Nombre,
                             Apellido,
                             Direccion,
                             Telefono,
                             Email
                        from 
                            doctor
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
            $sql = "select * from f_generar_correlativo('doctor') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setDoctor_id($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "

                    insert into doctor
                    values(
                            :p_doctor_id,
                            :p_colegio,
                            :p_codigo_colegio,
                            :p_nombre,
                            :p_apellido,
                            :p_direccion,
                            :p_telefono,
                            :p_email
                            )
                    ";
                $sentencia = $this->dblink->prepare($sql);
   
                $sentencia->bindParam(":p_doctor_id", $this->getDoctor_id());
                $sentencia->bindParam(":p_colegio", $this->getColegio());
                $sentencia->bindParam(":p_codigo_colegio", $this->getCodigo_colegio());
                $sentencia->bindParam(":p_nombre", $this->getNombre());
                $sentencia->bindParam(":p_apellido", $this->getApellido());
                $sentencia->bindParam(":p_direccion", $this->getDireccion());
                $sentencia->bindParam(":p_telefono", $this->getTelefono());
                $sentencia->bindParam(":p_email", $this->getEmail());
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
                    where tabla='doctor'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                //*Actualizar el correlativo*/

                $this->dblink->commit();
                return true;
                
            }else{
                throw new Exception("No se ha configurado el correlativo para la tabla doctor");
            }
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return false;
    }

    public function leerDatos($codDoctor) {
        try {
            $sql = "
                    select 
                             Doctor_id,
                             Colegio,
                             Codigo_colegio,
                             Nombre,
                             Apellido,
                             Direccion,
                             Telefono,
                             Email
                        from 
                            doctor
                    where
                        Doctor_id = $codDoctor;
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

    public function editar($p_codigoDoctor) {
        try {
            $sql = "
                update 
                    doctor 
                set  
                    colegio        = :p_colegio,
                    codigo_colegio = :p_codigo_colegio,
                    nombre         = :p_nombre,
                    apellido       = :p_apellido,
                    direccion      = :p_direccion,
                    telefono       = :p_telefono,
                    email          = :p_email
                where
                    doctor_id = $p_codigoDoctor;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_colegio", $this->getColegio());
            $sentencia->bindParam(":p_codigo_colegio", $this->getCodigo_colegio());
            $sentencia->bindParam(":p_nombre", $this->getNombre());
            $sentencia->bindParam(":p_apellido", $this->getApellido());
            $sentencia->bindParam(":p_direccion", $this->getDireccion());
            $sentencia->bindParam(":p_telefono", $this->getTelefono());
            $sentencia->bindParam(":p_email", $this->getEmail());
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
                delete from doctor where doctor_id = :p_doctor_id;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_doctor_id", $this->getDoctor_id());
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
