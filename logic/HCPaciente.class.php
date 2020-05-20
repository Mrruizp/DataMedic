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
                            ocupacion
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
}

    
