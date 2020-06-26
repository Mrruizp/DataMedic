<?php

require_once '../data/Conexion.class.php';

class Horario extends Conexion {

    private $Horario_id;
    private $Consultorio_id;
    private $Doctor_id;
    private $Dia;
    private $Numero;
    private $Mes;
    private $Ano;
    //private $Estado;


    public function getHorario_id() {
        return $this->Horario_id;
    }

    public function getConsultorio_id() {
        return $this->Consultorio_id;
    }

    public function getDoctor_id() {
        return $this->Doctor_id;
    }
    public function getDia() {
        return $this->Dia;
    }
    public function getNumero() {
        return $this->Numero;
    }
    public function getMes() {
        return $this->Mes;
    }

    public function getAno() {
        return $this->Ano;
    }

    public function setHorario_id($Horario_id) {
        $this->Horario_id = $Horario_id;
    }
    public function setConsultorio_id($Consultorio_id) {
        $this->Consultorio_id = $Consultorio_id;
    }
    public function setDoctor_id($Doctor_id) {
        $this->Doctor_id = $Doctor_id;
    }
    public function setDia($Dia) {
        $this->Dia = $Dia;
    }
    public function setNumero($Numero) {
        $this->Numero = $Numero;
    }
    public function setMes($Mes) {
        $this->Mes = $Mes;
    }
   
    public function setAno($Ano) {
        $this->Ano = $Ano;
    }


    public function listar() {
        try {
                $sql = "
                    select
                        distinct on(
                                        concat(h.dia_semana, ', ',h.numero,' de ',h.mes,' del ', h.ano), 
                                        concat(d.nombre, ', ',d.apellido)
                                    )

                        horario_atencion_id,
                        concat(d.nombre, ', ',d.apellido) as nombresDoctor,
                        c.nombre_consultorio,
                        concat(h.dia_semana, ', ',h.numero,' de ',h.mes,' del ', h.ano) as fecha,
                        h.dia_semana,
                        h.numero,
                        h.mes,
                        h.ano,
                        d.doctor_id
                    from 
                        horario_atencion h inner join doctor d
                    on
                        h.doctor_id = d.doctor_id inner join consultorio c
                    on
                        h.consultorio_id = c.consultorio_id;
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarHorarioDetalle($codigo_doctor) {
        try {
                $sql = "
                    select
                        horario_atencion_id,
                        hora,
                        horario,
                        estado
                    from 
                        horario_atencion
                    where
                        doctor_id =  $codigo_doctor;
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
            

                
                $sql = "
                    select * from fn_registrarHorario(
                                                :p_consultorio_id,
                                                :p_doctor_id ,
                                                :p_dia,
                                                :p_numero,
                                                :p_mes,
                                                :p_ano
                                            );
                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_consultorio_id", $this->getConsultorio_id());
                $sentencia->bindParam(":p_doctor_id", $this->getDoctor_id());
                $sentencia->bindParam(":p_dia", $this->getDia());
                $sentencia->bindParam(":p_numero", $this->getNumero());
                $sentencia->bindParam(":p_mes", $this->getMes());
                $sentencia->bindParam(":p_ano", $this->getAno());
                $sentencia->execute();
                
                $this->dblink->commit();
                return true;
           
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
 
        return false;
    }

    

    public function leerDatos($p_codigoHorario) {
        try {
            $sql = "
                    select
                        horario_atencion_id,
                        d.doctor_id,
                        c.consultorio_id,
                        h.dia_Semana,
                        h.numero,
                        h.mes,
                        h.ano,
                        a.area_id,
                        s.sede_id
                    from 
                        horario_atencion h inner join doctor d
                    on
                        h.doctor_id = d.doctor_id inner join consultorio c
                    on
                        h.consultorio_id = c.consultorio_id inner join area a
                    on
                        c.area_id = a.area_id inner join sede s
                    on
                        c.sede_id = s.sede_id
                    where
                        h.horario_atencion_id = :p_horario_atencion_id;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_horario_atencion_id", $p_codigoHorario);
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
                delete from horario_atencion where horario_atencion_id = :p_horario_atencion_id;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_horario_atencion_id", $this->getHorario_id());
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

}
