<?php

require_once '../data/Conexion.class.php';
session_name("DataMedic");
session_start();

class Dashboard extends Conexion {

    
    public function listar($mes,$numero,$ano,$estado) {
        try {

                $sql = "
                        select
                            distinct i.cita_id,
                            i.fecha,
                            i.hora,
                            i.horario,
                            o.nombre_consultorio,
                            i.nombre_doctor,
                            i.estado,
                            concat(p.nombres, ', ',p.apellidos) as nombrespaciente
                            
                        from 
                            cita i left join consultorio o
                        on
                            i.consultorio_id = o.consultorio_id left join horario_atencion h
                        on
                            i.consultorio_id = h.consultorio_id inner join paciente p
                        on
                            i.paciente_id = p.paciente_id 
                        where
                            i.fecha like '%$mes%' and h.numero = '$numero' and h.ano = '$ano' and i.estado = '$estado';
                ";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
/*
    public function listarNumTotalCitas($mes,$numero,$ano,$estado) {
        try {

                $sql = "
                        select
                            count(*)
                            
                        from 
                            cita i left join consultorio o
                        on
                            i.consultorio_id = o.consultorio_id left join horario_atencion h
                        on
                            i.consultorio_id = h.consultorio_id
                        where
                            i.fecha like '%$mes%' and h.numero = '$numero' and h.ano = '$ano' and i.estado = '$estado';
                ";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    */
}