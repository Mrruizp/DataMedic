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

    
