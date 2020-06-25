<?php

require_once '../data/Conexion.class.php';
session_name("DataMedic");
session_start();

class HCPaciente extends Conexion {

    

    public function listar() {
        try {

                $sql = "
                        select 
                           distinct p.paciente_id,
                            p.doc_id,
                            p.nombres,
                            p.apellidos,
                            p.edad,
                            p.sexo,
                            p.naturalde,
                            p.estado_civil,
                            p.ocupacion,
                            p.raza,
                            p.procedencia,
                            p.instruccion,
                            p.religion,
                            p.domicilio,
                            p.telefono,
                            p.personaresponsable,
                            p.personaresponsable_telefono,
                            p.fecha_ingreso,
                            p.hora,
                            p.modoingreso,
                            p.fecha_historia_clinica,
                            p.descripcion_enfermedad_actual
                        from 
                            paciente p inner join cita c 
                        on
                            p.paciente_id = c.paciente_id
                        where
                            c.estado = 'Cita Confirmada' or c.estado = 'Cita Atendido'
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarHistorialTratamiento($codPaciente) {
        try {

                $sql = "
                        select 
                            p.doc_id,
                            h.historial_tratamiento_id,
                            h.fecha,
                            h.hora,
                            h.descripcion,
                            t.nombre_tratamiento
                        from
                            paciente p inner join historial_tratamiento h
                        on
                            p.paciente_id = h.paciente_id inner join tratamiento t
                        on
                            h.tratamiento_id = t.tratamiento_id
                        where
                            h.paciente_id = $codPaciente;                            
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function agregarDatosAdicionales(
                                                    $codigo_paciente,
                                                    $raza,
                                                    $procedencia,
                                                    $instruccion,
                                                    $religion,
                                                    $domicilio,
                                                    $telefPacHC,
                                                    $fechaIngresoPaciente,
                                                    $horaHistClinica,
                                                    $modoIngreso,
                                                    $fechaHistClinica,
                                                    $enfermedadActual,
                                                    $personaResponsable_paciente1,
                                                    $telefono_paciente2
                                                ) {
        $this->dblink->beginTransaction();

        try {
                $sql = "
                        update 
                            paciente
                        set
                            raza                          = '$raza', 
                            procedencia                   = '$procedencia',
                            instruccion                   = '$instruccion',
                            religion                      = '$religion',
                            domicilio                     = '$domicilio',
                            telefono                      = '$telefPacHC',
                            personaresponsable            = '$personaResponsable_paciente1',
                            personaresponsable_telefono   = '$telefono_paciente2',
                            fecha_ingreso                 = '$fechaIngresoPaciente',
                            hora                          = '$horaHistClinica',
                            modoingreso                   = '$modoIngreso',
                            fecha_historia_clinica        = '$fechaHistClinica',
                            descripcion_enfermedad_actual = '$enfermedadActual'
                        where
                            paciente_id = $codigo_paciente;
                    ";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                
                $this->dblink->commit();
                return true;
             
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
 
        return false;
    }

    public function leerDatos($p_codigoPaciente) {
        try {
            $sql = "
                    select 
                            *
                        from 
                            paciente
                    where
                        paciente_id = $p_codigoPaciente;
                ";
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_codigo_paciente", $p_codigoPaciente);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}

    
