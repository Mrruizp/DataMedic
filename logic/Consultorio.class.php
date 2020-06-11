<?php

require_once '../data/Conexion.class.php';
session_name("DataMedic");
session_start();

class Consultorio extends Conexion {

    private $Consultorio_id;
    private $Nombre_consultorio;
    private $Sede_id;
    private $Area_id;

    public function getConsultorio_id() {
        return $this->Consultorio_id;
    }

    public function getNombre_consultorio() {
        return $this->Nombre_consultorio;
    }

    public function getSede_id() {
        return $this->Sede_id;
    }

    public function getArea_id() {
        return $this->Area_id;
    }

    public function setConsultorio_id($Consultorio_id) {
        $this->Consultorio_id = $Consultorio_id;
    }

    public function setNombre_consultorio($Nombre_consultorio) {
        $this->Nombre_consultorio = $Nombre_consultorio;
    }

    public function setSede_id($Sede_id) {
        $this->Sede_id = $Sede_id;
    }
    public function setArea_id($Area_id) {
        $this->Area_id = $Area_id;
    }
    

    public function listar() {
        try {

                $sql = "
                        select 
                            consultorio_id,
                            nombre_consultorio,
                            sede_id,
                            area_id
                        from 
                            consultorio;
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
