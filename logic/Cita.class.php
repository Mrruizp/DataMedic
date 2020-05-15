<?php

require_once '../data/Conexion.class.php';
session_name("CampusVirtual");
session_start();

class Cita extends Conexion {

    private $Cita_id;
    private $Fecha;
    private $Hora;
    private $Descripcion;
    private $Doc_id;
    private $Doctor_id;
    private $Estado;

    public function getCita_id() {
        return $this->Cita_id;
    }

    public function getFecha() {
        return $this->Fecha;
    }

    public function getHora() {
        return $this->Hora;
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function getDoc_id() {
        return $this->Doc_id;
    }

    public function getDoctor_id() {
        return $this->Doctor_id;
    }

    public function getEstado() {
        return $this->Estado;
    }

    public function setCita_id($Cita_id) {
        $this->Cita_id = $Cita_id;
    }

    public function setFecha($Fecha) {
        $this->Fecha = $Fecha;
    }

    public function setHora($Hora) {
        $this->Hora = $Hora;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    public function setDoc_id($Doc_id) {
        $this->Doc_id = $Doc_id;
    }

    public function setDoctor_id($Doctor_id) {
        $this->Doctor_id = $Doctor_id;
    }

    public function setEstado($Estado) {
        $this->Estado = $Estado;
    }


    public function listar() {
        try {
            $sql = "
                    select 
                        c.cita_id,
                        c.fecha,
                        c.hora,
                        c.descripcion,
                        u.nombrecompleto,
                        concat(nombre, ' ',apellido) as nombresdoctor,
                        c.estado
                    from 
                        cita c inner join doctor d
                    on
                        c.doctor_id = d.doctor_id inner join usuario u
                    on
                        c.doc_id = u.doc_id 
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
            $sql = "select * from f_generar_correlativo('cita') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();

            if ($sentencia->rowCount()) {
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCita_id($nuevoCodigo);

                /* Insertar en la tabla laboratorio */
                $sql = "

                    insert into cita
                    values(
                                :p_cita_id,
                                :p_fecha,
                                :p_hora, 
                                :p_descripcion,
                                :p_doc_id,
                                :p_doctor_id,
                                'Cita en proceso de confirmación'
                            );
                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_cita_id", $this->getCita_id());
                $sentencia->bindParam(":p_fecha", $this->getFecha());
                $sentencia->bindParam(":p_hora", $this->getHora());
                $sentencia->bindParam(":p_descripcion", $this->getDescripcion());
                $sentencia->bindParam(":p_doc_id", $this->getDoc_id());
                $sentencia->bindParam(":p_doctor_id", $this->getDoctor_id());
                //$sentencia->bindParam(":p_estado", $this->getEstado());
                $sentencia->execute();
                /* Insertar en la tabla laboratorio */

                /* Actualizar el correlativo */
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='cita'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();

                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla curso");
            }
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return false;
    }

    public function leerDatos($p_codigoCurso) {
        try {
            $sql = "
                    select * from curso 
                    where curso_id = :p_codigo_curso
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codigo_curso", $p_codigoCurso);
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
                    curso 
                set  
                    nombre_curso = :p_nombre_curso
                where
                    curso_id = :p_curso_id
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_nombre_curso", $this->getNombre_curso());
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
                                        :p_nombre_curso,
                                        'Update',
                                        '$_SERVER[REMOTE_ADDR]'
                                    );";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_curso_id", $this->getCodigo_curso());
                $sentencia->bindParam(":p_nombre_curso", $this->getNombre_curso());
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

}
