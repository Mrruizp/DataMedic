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
    private $Doc_id_paciente;
    private $Ciudad_paciente;
    private $EstadoCivil_paciente;
    private $Edad_paciente;
    private $Nombre_paciente;
    private $Apellidos_paciente;
    private $Sexo_paciente;
    private $Ocupacion_paciente;
    private $Religion_paciente;
    private $Domicilio_paciente;
    private $Telefono_paciente;
    private $PersonaResponsable_paciente;
    private $TelefonoResponsable_paciente;


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

    public function getDoc_id_paciente() {
        return $this->Doc_id_paciente;
    }

    public function getCiudad_paciente() {
        return $this->Ciudad_paciente;
    }

    public function getEstadoCivil_paciente() {
        return $this->EstadoCivil_paciente;
    }

    public function getEdad_paciente() {
        return $this->Edad_paciente;
    }

    public function getNombre_paciente() {
        return $this->Nombre_paciente;
    }

    public function getApellidos_paciente() {
        return $this->Apellidos_paciente;
    }

    public function getSexo_paciente() {
        return $this->Sexo_paciente;
    }

    public function getOcupacion_paciente() {
        return $this->Ocupacion_paciente;
    }

    public function getReligion_paciente() {
        return $this->Religion_paciente;
    }

    public function getDomicilio_paciente() {
        return $this->Domicilio_paciente;
    }

    public function getTelefono_paciente() {
        return $this->Telefono_paciente;
    }

    public function getPersonaResponsable_paciente() {
        return $this->PersonaResponsable_paciente;
    }

    public function getTelefonoResponsable_paciente() {
        return $this->TelefonoResponsable_paciente;
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

    public function setDoc_id_paciente($Doc_id_paciente) {
        $this->Doc_id_paciente = $Doc_id_paciente;
    }

    public function setCiudad_paciente($Ciudad_paciente) {
        $this->Ciudad_paciente = $Ciudad_paciente;
    }

    public function setEstadoCivil_paciente($EstadoCivil_paciente) {
        $this->EstadoCivil_paciente = $EstadoCivil_paciente;
    }

    public function setEdad_paciente($Edad_paciente) {
        $this->Edad_paciente = $Edad_paciente;
    }

    public function setNombre_paciente($Nombre_paciente) {
        $this->Nombre_paciente = $Nombre_paciente;
    }

    public function setApellidos_paciente($Apellidos_paciente) {
        $this->Apellidos_paciente = $Apellidos_paciente;
    }

    public function setSexo_paciente($Sexo_paciente) {
        $this->Sexo_paciente = $Sexo_paciente;
    }

    public function setOcupacion_paciente($Ocupacion_paciente) {
        $this->Ocupacion_paciente = $Ocupacion_paciente;
    }

    public function setReligion_paciente($Religion_paciente) {
        $this->Religion_paciente = $Religion_paciente;
    }

    public function setDomicilio_paciente($Domicilio_paciente) {
        $this->Domicilio_paciente = $Domicilio_paciente;
    }

    public function setTelefono_paciente($Telefono_paciente) {
        $this->Telefono_paciente = $Telefono_paciente;
    }

    public function setPersonaResponsable_paciente($PersonaResponsable_paciente) {
        $this->PersonaResponsable_paciente = $PersonaResponsable_paciente;
    }

    public function setTelefonoResponsable_paciente($TelefonoResponsable_paciente) {
        $this->TelefonoResponsable_paciente = $TelefonoResponsable_paciente;
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
                        c.doc_id,
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

                    select * from fn_registrarCita_paciente(
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
