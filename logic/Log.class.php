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
                        u.usuarioqueregistra_apellidos,
                        u.usuarioqueregistra_cargo_id,
                        u.usuarioqueregistra_tipo,
                        u.fecha,
                        u.tiempo,
                        u.ip,
                        u.doc_id,
                        u.nombres,
                        u.apellidos,
                        u.direccion,
                        u.telefono,
                        u.email,
                        u.cargo_id,
                        u.tipo_operacion,
                        c.clave,
                        c.tipo,
                        c.estado,
                        r.nombre_curso
                    from 
                        log_usuario u left join (select distinct on(doc_id, clave,tipo,estado) doc_id, clave,tipo,estado from credenciales_acceso order by doc_id, clave, tipo, estado) c
                    on
                       u.doc_id = c.doc_id inner join (select distinct on (doc_id, curso_id) doc_id, curso_id from log_detalle_docente_profesor order by doc_id, curso_id) d
                    on
                       u.doc_id = d.doc_id inner join curso r
                    on
                        d.curso_id = r.curso_id;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarLog_curso() {
        try {
            $sql = "
                   select 
                        usuarioqueregistra_doc_id,
                        usuarioqueregistra_nombres,
                        usuarioqueregistra_apellidos,
                        usuarioqueregistra_cargo_id,
                        usuarioqueregistra_tipo,
                        fecha,
                        tiempo,
                        curso_id,
                        nombre_curso,
                        tipo_operacion,
                        ip
                    from 
                        log_curso;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarLog_prueba() {
        try {
            $sql = "
                   select 
                        usuarioqueregistra_doc_id,
                        usuarioqueregistra_nombres,
                        usuarioqueregistra_apellidos,
                        usuarioqueregistra_cargo_id,
                        usuarioqueregistra_tipo,
                        fecha,
                        tiempo,
                        prueba_id,
                        cant_preguntas,
                        tiempo_prueba,
                        puntaje_aprobacion,
                        instrucciones,
                        curso_id,
                        tipo_operacion,
                        ip
                    from 
                        log_prueba;
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarLog_pregunta() {
        try {
            $sql = "
                   select 
                        usuarioqueregistra_doc_id,
                        usuarioqueregistra_nombres,
                        usuarioqueregistra_apellidos,
                        usuarioqueregistra_cargo_id,
                        usuarioqueregistra_tipo,
                        fecha,
                        tiempo,
                        pregunta_id,
                        nombre_pregunta,
                        alternativa1,
                        alternativa2,
                        alternativa3,
                        alternativa4,
                        respuesta,
                        prueba_id,
                        tipo_operacion,
                        ip
                       
                    from 
                        log_pregunta;
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
