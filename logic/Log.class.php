<?php

require_once '../data/Conexion.class.php';

class Log extends Conexion {

    public function listarLog_iniciosesion() {
        try {
            $sql = "
                   select 
                        doc_id,
                        nombrecompleto,
                        cargo,
                        tipo,
                        fecha,
                        tiempo,
                        ip
                    from 
                        log_inicioseseion;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarLog_usuario() {
        try {
            $sql = "
                   select 
                            
                            u.usuarioqueregistra_doc_id, 
                            u.usuarioqueregistra_nombres,
                            u.usuarioqueregistra_cargo_id, 
                            u.usuarioqueregistra_tipo,
                            u.fecha,
                            u.tiempo,
                            u.tipo_operacion,
                            u.ip,
                            u.doc_id,
                            u.nombrecompleto,
                            u.direccion,
                            u.telefono,
                            u.email,
                            u.cargo_id,
                            c.clave,
                            c.tipo,
                            c.estado
                    from 
                            log_usuario u left join credenciales_acceso c
                    on
                        u.doc_id = c.doc_id
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarLog_paciente() {
        try {
            $sql = "
                   select 
                            usuarioQueRegistra_doc_id,
                            usuarioQueRegistra_nombres,
                            usuarioQueRegistra_cargo_id,
                            usuarioQueRegistra_tipo,
                            fecha,
                            hora,
                            ip,
                            nombres,
                            apellidos,
                            edad,
                            sexo,
                            naturalde,
                            estado_civil,
                            ocupacion,
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
                            log_paciente;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    public function listarLog_tratamiento() {
        try {
            $sql = "
                   select 
                            *
                    from 
                            log_tratamiento;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarLog_cita() {
        try {
            $sql = "
                   select 
                            *
                    from 
                            log_cita;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}
