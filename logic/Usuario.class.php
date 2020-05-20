<?php

require_once '../data/Conexion.class.php';

class Usuario extends Conexion {

    private $Cod_credenciales;
    private $Dni;
    private $NombresCompleto;
    private $P_foto;
    private $Email;
    private $Password;
    //private $Cuenta;

    public function getCod_credenciales() {
        return $this->Cod_credenciales;
    }

    public function getDni() {
        return $this->Dni;
    }

    public function getNombresCompleto() {
        return $this->NombresCompleto;
    }

    public function getP_foto() {
        return $this->P_foto;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function getPassword() {
        return $this->Password;
    }

    public function setCod_credenciales($Cod_credenciales) {
        $this->Cod_credenciales = $Cod_credenciales;
    }

    public function setDni($Dni) {
        $this->Dni = $Dni;
    }

    public function setNombresCompleto($NombresCompleto) {
        $this->NombresCompleto = $NombresCompleto;
    }

    public function setP_foto($P_foto) {
        $this->P_foto = $P_foto;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
    }

    public function setPassword($Password) {
        $this->Password = $Password;
    }

    public function listar() {
       
        try {
            $sql = "
                    select 
                        codigo_usuario,
                        clave,
                        tipo,
                        estado,
                        fecha_registro,
                        doc_id
                        
                    from 
                        credenciales_acceso   
                    order by 
                            2
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
   
    public function leerDatos($p_dni) {
        try {
            $sql = "
                    select 
                            u.doc_id,
                            u.nombreCompleto,
                            u.direccion,
                            u.telefono,
                            c.clave,                            
                            c.estado,
                            c.codigo_usuario,
                            c.tipo
                        
                    from 
                        usuario u inner join credenciales_acceso c
                    on
                        u.doc_id = c.doc_id
                    where 
                        u.doc_id = :p_dni;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function leerFoto($p_dni) {
        try {
            $sql = "
                    select 
                        doc_id
                    from 
                        credenciales_acceso
                    where 
                        doc_id = :p_dni

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni", $p_dni);
           // $sentencia->bindParam(":p_foto", $this->getP_foto);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function agregar() {
        $this->dblink->beginTransaction();
        
        try {
            $sql = "select * from f_generar_correlativo('credenciales_acceso') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            
            if ($sentencia->rowCount()){
                $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
                $nuevoCodigo = $resultado["nc"];
                $this->setCod_credenciales($nuevoCodigo);
                
                /*Insertar en la tabla candidato*/
//                $sql = "
//                    insert into laboratorio(codigo_laboratorio,nombre,codigo_pais) 
//                    values(:p_cod_lab, :p_nomb, :p_codigo_pais)
//                    ";
                
                $sql = "select * from fn_registrarUsuario_cliente(   
                                                :p_cod_credenciales,  
                                                :p_doc_id, 
                                                :p_nombreCompleto,
                                                :p_email, 
                                                :p_password
                                             );
                        ";
                $sentencia = $this->dblink->prepare($sql);
                // $sentencia->bindParam(":p_codigoCandidato", $this->getCodigoCandidato());
                $sentencia->bindParam(":p_cod_credenciales", $this->getCod_credenciales());
                $sentencia->bindParam(":p_doc_id", $this->getDni());
                $sentencia->bindParam(":p_nombreCompleto", $this->getNombresCompleto());
                $sentencia->bindParam(":p_email", $this->getEmail());
                $sentencia->bindParam(":p_password", $this->getPassword());
                $sentencia->execute();
                
                $this->dblink->commit();
                return true;
                
            }else{
                throw new Exception("No se ha configurado el correlativo para la tabla credenciales_acceso");
            }
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return false;
    }

    public function editar() {
        try {
            $sql = "select * from fn_editarUsuario(                    
                                        :p_cod_usuario,
                                        :p_doc_id, 
                                        :p_nombres,
                                        :p_apellidos, 
                                        :p_direccion, 
                                        :p_telefono, 
                                        :p_sexo, 
                                        :p_edad, 
                                        :p_email, 
                                        :p_cargo_id, 
                                        :p_clave,
                                        :p_tipo,
                                        :p_estado
                                     );";
            $sentencia = $this->dblink->prepare($sql);
            
            $sentencia->bindParam(":p_cod_usuario", $this->getCodigoUsuario());
            $sentencia->bindParam(":p_doc_id", $this->getDni());
            $sentencia->bindParam(":p_nombres", $this->getNombres());
            $sentencia->bindParam(":p_apellidos", $this->getApellidos());
            $sentencia->bindParam(":p_direccion", $this->getDireccion());
            $sentencia->bindParam(":p_telefono", $this->getTelefono());
            $sentencia->bindParam(":p_sexo", $this->getSexo());
            $sentencia->bindParam(":p_edad", $this->getEdad());
            $sentencia->bindParam(":p_email", $this->getEmail());
            $sentencia->bindParam(":p_cargo_id", $this->getCargo());
            $sentencia->bindParam(":p_clave", $this->getConstrasenia());
            $sentencia->bindParam(":p_tipo", $this->getTipo());
            $sentencia->bindParam(":p_estado", $this->getEstado());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }

    public function eliminar() {
        try {
            $sql = "select * from fn_eliminarUsuario(                    
                                        :p_doc_id
                                     );";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_doc_id", $this->getDni());
            $sentencia->execute();
            return true;
        } catch (Exception $exc) {
            throw $exc;
        }
        return false;
    }
}
