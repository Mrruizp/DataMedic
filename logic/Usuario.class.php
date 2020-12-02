<?php

require_once '../data/Conexion.class.php';

class Usuario extends Conexion {

    private $Cod_credenciales;
    private $Dni;
    private $P_foto;
    private $NombreCompleto;
    private $Apellidos;
    private $Direccion;
    private $Email;
    private $Telefono;
    //private $Sexo;
    //private $Edad;
    private $Cargo;
    private $Constrasenia;
    private $Tipo;
    private $Estado;
    private $CodigoCurso;
    //private $Cuenta;

    public function getCod_credenciales() {
        return $this->Cod_credenciales;
    }

    public function getCodigoUsuario() {
        return $this->CodigoUsuario;
    }

    public function getDni() {
        return $this->Dni;
    }

    public function getP_foto() {
        return $this->P_foto;
    }

    public function getNombreCompleto() {
        return $this->NombreCompleto;
    }


    public function getDireccion() {
        return $this->Direccion;
    }

    public function getEmail(){
        return $this->Email;
    }

    public function getTelefono(){
        return $this->Telefono;
    }

    public function getCargo()
    {
        return $this->Cargo; // es el c贸digo del cargo
    }

    public function getConstrasenia(){
        return $this->Constrasenia;
    }

    public function getTipo()
    {
        return $this->Tipo;
    }

    public function getEstado(){
        return $this->Estado;
    }


    public function setCod_credenciales($Cod_credenciales) {
        $this->Cod_credenciales = $Cod_credenciales;
    }

    public function setCodigoUsuario($CodigoUsuario) {
        $this->CodigoUsuario = $CodigoUsuario;
    }

    public function setDni($Dni) {
        $this->Dni = $Dni;
    }

    public function setP_foto($P_foto) {
        $this->P_foto = $P_foto;
    }

    public function setNombreCompleto($NombreCompleto) {
        $this->NombreCompleto = $NombreCompleto;
    }

    public function setApellidos($Apellidos) {
        $this->Apellidos = $Apellidos;
    }

    public function setDireccion($Direccion) {
        $this->Direccion = $Direccion;
    }

    public function SetEmail($Email){
        $this->Email = $Email;
    }

    public function setTelefono($Telefono) {
        $this->Telefono = $Telefono;
    }

    public function setCargo($Cargo){
        $this->Cargo = $Cargo;
    }

    public function setConstrasenia($Constrasenia){
        $this->Constrasenia = $Constrasenia;
    }

    public function setTipo($Tipo){
        $this->Tipo = $Tipo;
    }

    public function setEstado($Estado){
        $this->Estado = $Estado;
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
   
    public function leerDatos($p_email) {
        try {
            $sql = "
                    select 
                            user_correo                        
                    from 
                        user_cliente
                    where 
                        user_correo = :p_email;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_email", $p_email);
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
<<<<<<< HEAD
=======
            $sql = "select * from f_generar_correlativo('user_cliente') as nc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
>>>>>>> 7ec2fa01784c2ee4995a36760c5c8c19bf933073
            
                
<<<<<<< HEAD
                $sql = "call fn_registrarUsuario(                    
                                        :p_doc_id, 
                                        :p_nombres,
                                        :p_direccion, 
                                        :p_telefono, 
                                        :p_email, 
                                         3, 
                                        :p_clave,
                                        'C',
                                        'A'
                                     );";
                $sentencia = $this->dblink->prepare($sql);
                // $sentencia->bindParam(":p_codigoCandidato", $this->getCodigoCandidato());
                //$sentencia->bindParam(":p_cod_usuario", $this->getCodigoUsuario());
                $sentencia->bindParam(":p_doc_id", $this->getDni());
                $sentencia->bindParam(":p_nombres", $this->getNombreCompleto());
                $sentencia->bindParam(":p_direccion", $this->getDireccion());
                $sentencia->bindParam(":p_telefono", $this->getTelefono());
                $sentencia->bindParam(":p_email", $this->getEmail());
                //$sentencia->bindParam(":p_cargo_id", $this->getCargo());
                $sentencia->bindParam(":p_clave", $this->getConstrasenia());
                //$sentencia->bindParam(":p_tipo", $this->getTipo());
                //$sentencia->bindParam(":p_estado", $this->getEstado());
                $sentencia->execute();
               /* $sql = "update correlativo set numero = numero + 1 
                        where tabla='credenciales_acceso'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                */
                if($_SESSION["cargo_id"] === null)
                {
                    $sql = "call fn_insert_log_usuario
                                    (
                                         null,
                                         null,
                                         null,
                                         null,
                                        :p_cod_usuario,
                                        :p_doc_id,
                                        :p_nombres,                                             
                                        :p_direccion,
                                        :p_telefono,
                                        :p_email,
                                         3,
                                        :p_clave,
                                        'C',
                                        'A',
                                        'Insert',
                                        '$_SERVER[REMOTE_ADDR]'
                                    );";
                }else{
                
                    $sql = "call fn_insert_log_usuario
                                    (
                                        '$_SESSION[s_doc_id]',
                                        '$_SESSION[s_usuario]',
                                         $_SESSION[cargo_id],
                                        '$_SESSION[tipo]',
                                        :p_cod_usuario,
                                        :p_doc_id,
                                        :p_nombres,                                             
                                        :p_direccion,
                                        :p_telefono,
                                        :p_email,
                                         3,
                                        :p_clave,
                                        'C',
                                        'A',
                                        'Insert',
                                        '$_SERVER[REMOTE_ADDR]'
                                    );";
                }
=======
                $sql = "    insert into user_cliente(
                                                        user_codCliente, 
                                                        user_correo, 
                                                        user_clave, 
                                                        user_estado_sesion
                                                    )
                            values(
                                    :p_user_codCliente,
                                    :p_user_correo,
                                    (select md5(:p_user_clave)),
                                    'A'
                                    );";

                $sentencia = $this->dblink->prepare($sql);
                // $sentencia->bindParam(":p_codigoCandidato", $this->getCodigoCandidato());
                $sentencia->bindParam(":p_user_codCliente", $this->getCodigoUsuario());
                $sentencia->bindParam(":p_user_correo", $this->getEmail());
                $sentencia->bindParam(":p_user_clave", $this->getConstrasenia());
                //$sentencia->bindParam(":p_user_estado_sesion", $this->getDireccion());
                $sentencia->execute();
                
                $sql = "update correlativo set numero = numero + 1 
                    where tabla='user_cliente'";
>>>>>>> 7ec2fa01784c2ee4995a36760c5c8c19bf933073
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                //*Actualizar el correlativo*/
                $this->dblink->commit();
                return true;
                
<<<<<<< HEAD
           
=======
            }else{
                throw new Exception("No se ha configurado el correlativo para la tabla user_cliente");
            }
>>>>>>> 7ec2fa01784c2ee4995a36760c5c8c19bf933073
            
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
                                        :p_direccion, 
                                        :p_telefono, 
                                        :p_email, 
                                        :p_cargo_id, 
                                        :p_clave,
                                        :p_tipo,
                                        :p_estado
                                     );";
            $sentencia = $this->dblink->prepare($sql);
            
            $sentencia->bindParam(":p_cod_usuario", $this->getCodigoUsuario());
            $sentencia->bindParam(":p_doc_id", $this->getDni());
            $sentencia->bindParam(":p_nombres", $this->getNombreCompleto());
            $sentencia->bindParam(":p_direccion", $this->getDireccion());
            $sentencia->bindParam(":p_telefono", $this->getTelefono());
            $sentencia->bindParam(":p_email", $this->getEmail());
            $sentencia->bindParam(":p_cargo_id", $this->getCargo());
            $sentencia->bindParam(":p_clave", $this->getConstrasenia());
            $sentencia->bindParam(":p_tipo", $this->getTipo());
            $sentencia->bindParam(":p_estado", $this->getEstado());
            $sentencia->execute();

            session_name("lachuspita");
            session_start();
                $sql = "select * from fn_insert_log_usuario
                                    (
                                        '$_SESSION[s_doc_id]', 
                                        '$_SESSION[s_usuario]',
                                        $_SESSION[cargo_id], 
                                        '$_SESSION[tipo]', 
                                        :p_cod_usuario,
                                        :p_doc_id, 
                                        :p_nombres,                                               
                                        :p_direccion, 
                                        :p_telefono, 
                                        :p_email, 
                                        :p_cargo_id,
                                        :p_clave,
                                        :p_tipo,
                                        :p_estado,
                                        'Update',
                                        '$_SERVER[REMOTE_ADDR]'
                                        
                                    );";

                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_cod_usuario", $this->getCodigoUsuario());
                $sentencia->bindParam(":p_doc_id", $this->getDni());
                $sentencia->bindParam(":p_nombres", $this->getNombreCompleto());
                $sentencia->bindParam(":p_direccion", $this->getDireccion());
                $sentencia->bindParam(":p_telefono", $this->getTelefono());
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
            session_name("DataMedic");
                session_start();
                $sql = "select * from fn_insert_log_usuario
                                    (
                                        '$_SESSION[s_doc_id]', 
                                        '$_SESSION[s_usuario]',
                                        $_SESSION[cargo_id], 
                                        '$_SESSION[tipo]', 
                                        null,
                                        :p_doc_id, 
                                        null,                                               
                                        null, 
                                        null, 
                                        null, 
                                        null,
                                        null,
                                        null,
                                        null,
                                        'delete',
                                        '$_SERVER[REMOTE_ADDR]'
                                        
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
    // REPORTE 1: Número de citas: por estado y mes
    public function reporte1_enero() {// enero
        try {
            $sql = "
                    select 
                        count(*) as num_cita_conf_enero
                    from 
                        cita
                    where  fecha like '%Enero del 2020%' and estado = 'Cita Atendida';

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte1_febrero() {// febrero
        try {
            $sql = "
                    select 
                        count(*) as num_cita_conf_febrero
                    from 
                        cita
                    where  fecha like '%Febrero del 2020%' and estado = 'Cita Atendida';

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte1_marzo() {// marzo
        try {
            $sql = "
                    select 
                        count(*) as num_cita_conf_marzo
                    from 
                        cita
                    where  fecha like '%Marzo del 2020%' and estado = 'Cita Atendida';

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte1_abril() {// abril
        try {
            $sql = "
                    select 
                        count(*) as num_cita_conf_abril
                    from 
                        cita
                    where  fecha like '%Abril del 2020%' and estado = 'Cita Atendida';

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte1_mayo() {// mayo
        try {
            $sql = "
                    select 
                        count(*) as num_cita_conf_mayo
                    from 
                        cita
                    where  fecha like '%Mayo del 2020%' and estado = 'Cita Atendida';

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte1_junio() {// junio
        try {
            $sql = "
                    select 
                        count(*) as num_cita_conf_junio
                    from 
                        cita
                    where  fecha like '%Junio del 2020%' and estado = 'Cita Atendida';

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte1_julio() {// julio
        try {
            $sql = "
                    select 
                        count(*) as num_cita_conf_julio
                    from 
                        cita
                    where  fecha like '%Julio del 2020%' and estado = 'Cita Atendida';

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte1_agosto() {// agosto
        try {
            $sql = "
                    select 
                        count(*) as num_cita_conf_agosto
                    from 
                        cita
                    where  fecha like '%Agosto del 2020%' and estado = 'Cita Atendida';

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte1_setiembre() {// setiembre
        try {
            $sql = "
                    select 
                        count(*) as num_cita_conf_setiembre
                    from 
                        cita
                    where  fecha like '%Setiembre del 2020%' and estado = 'Cita Atendida';

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte1_octubre() {// octubre
        try {
            $sql = "
                    select 
                        count(*) as num_cita_conf_octubre
                    from 
                        cita
                    where  fecha like '%Octubre del 2020%' and estado = 'Cita Atendida';

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte1_noviembre() {// noviembre
        try {
            $sql = "
                    select 
                        count(*) as num_cita_conf_noviembre
                    from 
                        cita
                    where  fecha like '%Noviembre del 2020%' and estado = 'Cita Atendida';

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte1_diciembre() {// diciembre
        try {
            $sql = "
                    select 
                        count(*) as num_cita_conf_diciembre
                    from 
                        cita
                    where  fecha like '%Diciembre del 2020%' and estado = 'Cita Atendida';

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte2_consultorio_1() {
        try {
            $sql = "
                    select count(*) as consultorio_1 from cita where consultorio_id = 1;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte2_consultorio_2() {
        try {
            $sql = "
                    select count(*) as consultorio_2 from cita where consultorio_id = 2;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte2_consultorio_1_enero() {
        try {
            $sql = "
                    select 
                        count(*) as consultorio_1_enero
                    from 
                        cita
                    where  fecha like '%Mayo del 2020%' and consultorio_id = 1;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function reporte2_consultorio_1_febrero() {
        try {
            $sql = "
                    select 
                        count(*) as consultorio_1_febrero
                    from 
                        cita
                    where  fecha like '%Febrero del 2020%' and consultorio_id = 1;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


public function reporte2_consultorio_1_marzo() {
        try {
            $sql = "
                    select 
                        count(*) as consultorio_1_marzo
                    from 
                        cita
                    where  fecha like '%Marzo del 2020%' and consultorio_id = 1;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


public function reporte2_consultorio_1_abril() {
        try {
            $sql = "
                    select 
                        count(*) as consultorio_1_abril
                    from 
                        cita
                    where  fecha like '%Abril del 2020%' and consultorio_id = 1;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


public function reporte2_consultorio_1_mayo() {
        try {
            $sql = "
                    select 
                        count(*) as consultorio_1_mayo
                    from 
                        cita
                    where  fecha like '%Mayo del 2020%' and consultorio_id = 1;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


public function reporte2_consultorio_1_junio() {
        try {
            $sql = "
                    select 
                        count(*) as consultorio_1_junio
                    from 
                        cita
                    where  fecha like '%Junio del 2020%' and consultorio_id = 1;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


public function reporte2_consultorio_1_julio() {
        try {
            $sql = "
                    select 
                        count(*) as consultorio_1_julio
                    from 
                        cita
                    where  fecha like '%Julio del 2020%' and consultorio_id = 1;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


public function reporte2_consultorio_1_agosto() {
        try {
            $sql = "
                    select 
                        count(*) as consultorio_1_agosto
                    from 
                        cita
                    where  fecha like '%Agosto del 2020%' and consultorio_id = 1;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


public function reporte2_consultorio_1_setiembre() {
        try {
            $sql = "
                    select 
                        count(*) as consultorio_1_setiembre
                    from 
                        cita
                    where  fecha like '%Setiembredel 2020%' and consultorio_id = 1;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


public function reporte2_consultorio_1_octubre() {
        try {
            $sql = "
                    select 
                        count(*) as consultorio_1_octubre
                    from 
                        cita
                    where  fecha like '%Octubre del 2020%' and consultorio_id = 1;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


public function reporte2_consultorio_1_noviembre() {
        try {
            $sql = "
                    select 
                        count(*) as consultorio_1_noviembre
                    from 
                        cita
                    where  fecha like '%Noviembre del 2020%' and consultorio_id = 1;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }


public function reporte2_consultorio_1_diciembre() {
        try {
            $sql = "
                    select 
                        count(*) as consultorio_1_diciembre
                    from 
                        cita
                    where  fecha like '%Diciembre del 2020%' and consultorio_id = 1;

                ";
            
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":p_dni", $p_dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}
