<?php

require_once '../data/Conexion.class.php';
session_name("DataMedic");
session_start();

class Horario extends Conexion {

    private $Horario_id;
    private $Consultorio_id;
    private $Doctor_id;
    private $Dia;
    private $Numero;
    private $Mes;
    private $Ano;
    private $Estado;



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

    public function getEstado() {
        return $this->Estado;
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

    public function setEstado($Estado) {
        $this->Estado = $Estado;
    }

    public function listar() {
        try {
                $sql = "
                    select
                        horario_atencion_id,
                        concat(d.nombre, ', ',d.apellido) as nombresDoctor,
                        c.nombre_consultorio,
                        concat(h.dia_Semana, ', ',h.numero,' de ',h.mes,' del ', h.ano) as fecha,
                        h.hora,
                        h.estado
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

                
                $sql = "

                    select * from fn_registrarCita_paciente(
                                                '$_SESSION[s_doc_id]', 
                                                '$_SESSION[s_usuario]',
                                                $_SESSION[cargo_id], 
                                                '$_SESSION[tipo]', 
                                                '$_SERVER[REMOTE_ADDR]',
                                                :p_cita_id,
                                                :p_fecha,
                                                :p_hora,
                                                :p_descripcion,
                                                :p_doc_id_usuario,
                                                :p_doctor_id,
                                                :p_doc_id_paciente,
                                                :p_nombre_paciente,
                                                :p_apellidos_paciente,
                                                :p_edad_paciente,
                                                :p_sexo_paciente,
                                                :p_ciudad_paciente,
                                                :p_estadoCivil_paciente,
                                                :p_ocupacion_paciente,
                                                :p_religion_paciente,
                                                :p_domicilio_paciente,
                                                :p_telefono_paciente,
                                                :p_personaResponsable_paciente,
                                                :p_telefonoResponsable_paciente
                                             );
                    ";
                $sentencia = $this->dblink->prepare($sql);
    // Cita
                $sentencia->bindParam(":p_cita_id", $this->getCita_id());
                $sentencia->bindParam(":p_fecha", $this->getFecha());
                $sentencia->bindParam(":p_hora", $this->getHora());
                $sentencia->bindParam(":p_descripcion", $this->getDescripcion());
                $sentencia->bindParam(":p_doc_id_usuario", $this->getDoc_id());
                $sentencia->bindParam(":p_doctor_id", $this->getDoctor_id());
                
    // Paciente
                $sentencia->bindParam(":p_doc_id_paciente", $this->getDoc_id_paciente());
                $sentencia->bindParam(":p_ciudad_paciente", $this->getCiudad_paciente());
                $sentencia->bindParam(":p_estadoCivil_paciente", $this->getEstadoCivil_paciente());
                $sentencia->bindParam(":p_edad_paciente", $this->getEdad_paciente());
                $sentencia->bindParam(":p_nombre_paciente", $this->getNombre_paciente());
                $sentencia->bindParam(":p_apellidos_paciente", $this->getApellidos_paciente());
                $sentencia->bindParam(":p_sexo_paciente", $this->getSexo_paciente());
                $sentencia->bindParam(":p_ocupacion_paciente", $this->getOcupacion_paciente());
                $sentencia->bindParam(":p_religion_paciente", $this->getReligion_paciente());
                $sentencia->bindParam(":p_domicilio_paciente", $this->getDomicilio_paciente());
                $sentencia->bindParam(":p_telefono_paciente", $this->getTelefono_paciente());
                $sentencia->bindParam(":p_personaResponsable_paciente", $this->getPersonaResponsable_paciente());
                $sentencia->bindParam(":p_telefonoResponsable_paciente", $this->getTelefonoResponsable_paciente());
                $sentencia->execute();
                
                $this->dblink->commit();
                return true;
            } else {
                throw new Exception("No se ha configurado el correlativo para la tabla cita y paciente");
            }
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
