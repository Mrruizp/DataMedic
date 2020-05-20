<?php

require_once '../data/Conexion.class.php';
session_name("DataMedic");
session_start();

class HCPaciente extends Conexion {

    

    public function listar() {
        try {

                $sql = "
                        select 
                            paciente_id,
                            doc_id,
                            nombres,
                            apellidos,
                            edad,
                            sexo,
                            naturalde,
                            estado_civil,
                            ocupacion,
                            raza,
                            procedencia,
                            instruccion,
                            religion,
                            domicilio,
                            telefono,
                            personaresponsable,
                            personaresponsable_telefono,
                            fecha_ingreso,
                            hora,
                            modoingreso,
                            fecha_historia_clinica,
                            descripcion_enfermedad_actual
                        from 
                            paciente
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

    
