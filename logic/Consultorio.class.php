<?php

require_once '../data/Conexion.class.php';
session_name("DataMedic");
session_start();

class Sede extends Conexion {

    private $Sede_id;
    private $Empresa_id;
    private $Nombre_sede;
    private $Departamento_sede;
    private $Provincia_sede;
    private $Distrito_sede;
    private $Direccion_sede;
    private $Tipo_sede;



    public function getSede_id() {
        return $this->Sede_id;
    }

    public function getEmpresa_id() {
        return $this->Empresa_id;
    }

    public function getNombre_sede() {
        return $this->Nombre_sede;
    }

    public function getDepartamento_sede() {
        return $this->Departamento_sede;
    }
    public function getProvincia_sede() {
        return $this->Provincia_sede;
    }
    public function getDistrito_sede() {
        return $this->Distrito_sede;
    }
    public function getDireccion_sede() {
        return $this->Direccion_sede;
    }
    public function getTipo_sede() {
        return $this->Tipo_sede;
    }

    public function setSede_id($Sede_id) {
        $this->Sede_id = $Sede_id;
    }
    public function setEmpresa_id($Empresa_id) {
        $this->Empresa_id = $Empresa_id;
    }
    public function setNombre_sede($Nombre_sede) {
        $this->Nombre_sede = $Nombre_sede;
    }
    public function setDepartamento_sede($Departamento_sede) {
        $this->Departamento_sede = $Departamento_sede;
    }
    public function setProvincia_sede($Provincia_sede) {
        $this->Provincia_sede = $Provincia_sede;
    }
    public function setDistrito_sede($Distrito_sede) {
        $this->Distrito_sede = $Distrito_sede;
    }
    public function setDireccion_sede($Direccion_sede) {
        $this->Direccion_sede = $Direccion_sede;
    }

    public function setTipo_sede($Tipo_sede) {
        $this->Tipo_sede = $Tipo_sede;
    }

    public function listar() {
        try {

                $sql = "
                        select 
                            sede_id,
                            nombre_sede,
                            empresa_id,
                            departamento_sede,
                            provincia_sede,
                            distrito_sede,
                            direccion_sede,
                            tipo_sede
                        from 
                            sede;
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
            $sql = "select * from f_generar_correlativo('sede') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setSede_id($nuevoCodigo);

                
                $sql = "
                        insert into sede
                        values(
                                :p_sede_id,
                                :p_nombre_sede,
                                :p_empresa_id,
                                :p_departamento_sede,
                                :p_provincia_sede,
                                :p_distrito_sede,
                                :p_direccion_sede,
                                :p_tipo_sede
                               );
                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_sede_id", $this->getSede_id());
                $sentencia->bindParam(":p_nombre_sede", $this->getNombre_sede());
                $sentencia->bindParam(":p_empresa_id", $this->getEmpresa_id());
                $sentencia->bindParam(":p_departamento_sede", $this->getDepartamento_sede());
                $sentencia->bindParam(":p_provincia_sede", $this->getProvincia_sede());
                $sentencia->bindParam(":p_distrito_sede", $this->getDistrito_sede());
                $sentencia->bindParam(":p_direccion_sede", $this->getDireccion_sede());
                $sentencia->bindParam(":p_tipo_sede", $this->getTipo_sede());
                $sentencia->execute();
                
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='sede'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();

                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla Sede");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
 
        return false;
    }


    public function leerDatos($p_codigoSede) {
        try {
            $sql = "
                    select 
                            sede_id,
                            nombre_sede,
                            empresa_id,
                            departamento_sede,
                            provincia_sede,
                            distrito_sede,
                            direccion_sede,
                            tipo_sede
                        from 
                            sede
                    where
                        sede_id = :p_codigo_sede;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_sede", $p_codigoSede);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function editar() {
        try {
            $sql = "
                update 
                    sede 
                set 
                    nombre_sede = :p_nombre_sede,
                    departamento_sede = :p_departamento_sede,
                    provincia_sede = :p_provincia_sede,
                    distrito_sede = :p_distrito_sede,
                    direccion_sede = :p_direccion_sede,
                    tipo_sede = :p_tipo_sede
                where
                    sede_id = :p_sede_id
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_sede_id", $this->getSede_id());
            $sentencia->bindParam(":p_nombre_sede", $this->getNombre_sede());
            //$sentencia->bindParam(":p_empresa_id", $this->getEmpresa_id());
            $sentencia->bindParam(":p_departamento_sede", $this->getDepartamento_sede());
            $sentencia->bindParam(":p_provincia_sede", $this->getProvincia_sede());
            $sentencia->bindParam(":p_distrito_sede", $this->getDistrito_sede());
            $sentencia->bindParam(":p_direccion_sede", $this->getDireccion_sede());
            $sentencia->bindParam(":p_tipo_sede", $this->getTipo_sede());
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
                delete from sede where sede_id = :p_sede_id;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_sede_id", $this->getSede_id());
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
            */
                $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

    

}
