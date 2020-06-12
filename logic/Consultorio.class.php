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
            $sql = "select * from f_generar_correlativo('consultorio') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setConsultorio_id($nuevoCodigo);

                
                $sql = "
                        insert into consultorio
                        values(
                                :p_consultorio_id,
                                :p_nombre_consultorio,
                                :p_sede_id,
                                :p_area
                               );
                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_consultorio_id", $this->getConsultorio_id());
                $sentencia->bindParam(":p_nombre_consultorio", $this->getNombre_consultorio());
                $sentencia->bindParam(":p_sede_id", $this->getSede_id());
                $sentencia->bindParam(":p_area", $this->getArea_id());
                $sentencia->execute();
                
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='consultorio'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();

                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla Consultorio");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
 
        return false;
    }


    public function leerDatos($p_codigoConsultorio) {
        try {
            $sql = "
                    select 
                            consultorio_id,
                            nombre_consultorio,
                            sede_id,
                            area_id
                        from 
                            consultorio
                    where
                        consultorio_id = :p_codigo_consultorio;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_consultorio", $p_codigoConsultorio);
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
                    consultorio 
                set 
                    consultorio_id = :p_consultorio_id,
                    nombre_consultorio = :p_nombre_consultorio,
                    sede_id = :p_sede_id,
                    area_id = :p_area
                where
                    consultorio_id = :p_consultorio_id
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_consultorio_id", $this->getConsultorio_id());
            $sentencia->bindParam(":p_nombre_consultorio", $this->getNombre_consultorio());
            $sentencia->bindParam(":p_sede_id", $this->getSede_id());
            $sentencia->bindParam(":p_area", $this->getArea_id());
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
                delete from consultorio where consultorio_id = :p_consultorio_id;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_consultorio_id", $this->getConsultorio_id());
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
