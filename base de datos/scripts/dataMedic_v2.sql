-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2020 a las 17:54:43
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `datamedic`
--
select * from credenciales_acceso;

DELIMITER $$
CREATE PROCEDURE `fn_editarUsuario` (
									in p_codigo_usuario int, 
									in p_doc_id varchar(20), 
									in p_nombres varchar(100),
									in p_direccion varchar(200),
									in p_telefono varchar(25), 
									in p_email varchar(150), 
									in p_cargo_id integer,	
									in p_clave char(32),
									in p_tipo char(1),
									in p_estado char(1)
 								) 
begin

	-- codigo integer;
	

 							-- update usuario
 								
								update 
									usuario
								set
									doc_id    = p_doc_id,
									nombrecompleto   = p_nombres,
									direccion = p_direccion,
									telefono  = p_telefono,
									email     = p_email,
									cargo_id  = p_cargo_id
								where 
									doc_id = p_doc_id;
								
								-- update credenciales_acceso
 								
								update 
									credenciales_acceso
								set
									
									clave  = (select md5(p_clave)),
									tipo   = p_tipo,
									estado = p_estado,
									doc_id = p_doc_id
								where 
									doc_id = p_doc_id;
								
							
 
 end$$

DELIMITER $$
CREATE PROCEDURE `fn_eliminarUsuario` (
									in p_doc_id varchar(20)
                                    )
 begin						
				-- Eliminar credenciales_acceso
						delete from credenciales_acceso
						where doc_id = p_doc_id;
						
				-- Eliminar usuario
 						delete from usuario
						where doc_id = p_doc_id;
                      
						
 end$$


DELIMITER $$
CREATE PROCEDURE `fn_insert_log_especialidad` (
												in `p_doc_id_log` VARCHAR(20), 
                                                in `p_nombres_log` VARCHAR(100), 
                                                in `p_cargo_id_log` INT, 
                                                in `p_tipo_log` CHAR(1), 
                                                in `p_tipo_operacion` VARCHAR(100), 
                                                in `p_ip` VARCHAR(200), 
                                                in `p_especialidad_id` INT, 
											    in `p_nombre_especialidad` VARCHAR(200)
											   )
begin

declare p_fecha varchar(50);
declare p_tiempo varchar(50);

set p_fecha = CURRENT_DATE;
set p_tiempo = CURRENT_TIME;
							
							
								insert into log_especialidad
										(
											usuarioqueregistra_doc_id, 
											usuarioqueregistra_nombres,
											usuarioqueregistra_cargo_id, 
											usuarioqueregistra_tipo,
											fecha,
											tiempo,
											tipo_operacion,
											ip,
											especialidad_id,
											nombre_especialidad
										)
									values (
												p_doc_id_log, 
												p_nombres_log, 
												p_cargo_id_log, 
												p_tipo_log,
												p_fecha,
												p_tiempo,
												p_tipo_operacion,
												p_ip,
												p_especialidad_id,
												p_nombre_especialidad
												
											); 
                                            
										
end$$

DELIMITER $$
CREATE PROCEDURE `fn_insert_log_inicioseseion` (
												in `p_email` VARCHAR(150), 
                                                in `p_cargo` VARCHAR(50), 
                                                in `p_tipo` CHAR(1), 
                                                in `p_ip` VARCHAR(100)
                                                )
begin
declare p_doc_id varchar(20);
declare p_nombres varchar(50);
declare p_apellidos varchar(50);

declare p_fecha varchar(50);
declare p_tiempo varchar(50);
	
	select doc_id into p_doc_id from usuario where email = p_email;
    select nombrecompleto into p_nombres from usuario where email = p_email; 
    
    set p_fecha = CURRENT_DATE;
	set p_tiempo = CURRENT_TIME;
            
							insert into log_inicioseseion
							values(p_doc_id, p_nombres,p_cargo,p_tipo,p_fecha,p_tiempo,p_ip);
                            
end$$

DELIMITER $$
CREATE PROCEDURE `fn_insert_log_tratamiento` (
																		in `p_doc_id_log` VARCHAR(20), 
                                                                        in `p_nombres_log` VARCHAR(100), 
                                                                        in `p_cargo_id_log` INT, 
                                                                        in `p_tipo_log` CHAR(1), 
                                                                        in `p_tipo_operacion` VARCHAR(100), 
                                                                        in `p_ip` VARCHAR(200), 
                                                                        in `p_tratamiento_id` INT, 
                                                                        in `p_nombre_tratamiento` VARCHAR(200)
                                                                        )
begin
declare p_fecha varchar(50);
declare p_tiempo varchar(50);

set p_fecha = CURRENT_DATE;
set p_tiempo = CURRENT_TIME;						
							
							
								insert into log_tratamiento
										(
											usuarioqueregistra_doc_id, 
											usuarioqueregistra_nombres,
											usuarioqueregistra_cargo_id, 
											usuarioqueregistra_tipo,
											fecha,
											tiempo,
											tipo_operacion,
											ip,
											tratamiento_id,
											nombre_tratamiento
										)
									values (
												p_doc_id_log, 
												p_nombres_log, 
												p_cargo_id_log, 
												p_tipo_log,
												p_fecha,
												p_tiempo,
												p_tipo_operacion,
												p_ip,
												p_tratamiento_id,
												p_nombre_tratamiento
												
											); 
										
end$$

DELIMITER $$
CREATE PROCEDURE `fn_insert_log_usuario` (
											in `p_doc_id_log` VARCHAR(20), 
                                            in `p_nombres_log` VARCHAR(100), 
                                            in `p_cargo_id_log` INT, 
                                            in `p_tipo_log` CHAR(1), 
                                            in `p_cod_usuario` INT, 
                                            in `p_doc_id` VARCHAR(20), 
                                            in `p_nombres` VARCHAR(100), 
                                            in `p_direccion` VARCHAR(200), 
                                            in `p_telefono` VARCHAR(25), 
                                            in `p_email` VARCHAR(150), 
                                            in `p_cargo_id` INT, 
                                            in `p_clave` VARCHAR(32), 
                                            in `p_tipo` CHAR(1), 
                                            in `p_estado` CHAR(1), 
                                            in `p_tipo_operacion` VARCHAR(100), 
                                            in `p_ip` VARCHAR(200)
                                            )
begin

declare p_fecha character varying(50);
declare p_tiempo character varying(50);

set p_fecha = CURRENT_DATE;
set p_tiempo = CURRENT_TIME;

							
							-- if estado = 0 then
							if 
								p_doc_id_log is null and 
								p_nombres_log is null and
								p_cargo_id_log is null and 
								p_tipo_log is null	then
								
								insert into log_usuario
										(
											usuarioqueregistra_doc_id,
											usuarioqueregistra_nombres,
											usuarioqueregistra_cargo_id,
											usuarioqueregistra_tipo,
											fecha,
											tiempo,
											tipo_operacion,
											ip,
											doc_id,
											nombrecompleto,
											direccion,
											telefono,
											email,
											cargo_id
										)
									values (
												null,
												null,
												3,
												'C',
												p_fecha,
												p_tiempo,
												p_tipo_operacion,
												p_ip,
												p_doc_id,
												p_nombres,
												p_direccion,
												p_telefono,
												p_email,
												p_cargo_id
											);
							else
								insert into log_usuario
										(
											usuarioqueregistra_doc_id,
											usuarioqueregistra_nombres,
											usuarioqueregistra_cargo_id,
											usuarioqueregistra_tipo,
											fecha,
											tiempo,
											tipo_operacion,
											ip,
											doc_id,
											nombrecompleto,
											direccion,
											telefono,
											email,
											cargo_id
										)
									values (
												p_doc_id_log,
												p_nombres_log,
												p_cargo_id_log,
												p_tipo_log,
												p_fecha,
												p_tiempo,
												p_tipo_operacion,
												p_ip,
												p_doc_id,
												p_nombres,
												p_direccion,
												p_telefono,
												p_email,
												p_cargo_id
											); 
							end if;				
										INSERT INTO log_credenciales_acceso
																( 
																	clave,
																	tipo,
																	estado,
																	fecha_registro,
																	doc_id
																)
										VALUES (
													p_clave,
													p_tipo,
													p_estado,
													(select now()),
													p_doc_id
												);
                                                
                                      
										
end$$

DELIMITER $$
CREATE PROCEDURE `fn_numSesion` (
									in `p_doc_id` INT
								) 
begin

declare con int;
					select numiniciosesion into con from usuario where doc_id = p_doc_id;
					
					if con is null then
						
						update 
							usuario
						set 
							numiniciosesion = 0
						where 
							doc_id = p_doc_id;
							
					end if;
					
					update 
						usuario
					set 
						numiniciosesion = numiniciosesion + 1
					where 
						doc_id = p_doc_id;
                  
end$$

DELIMITER $$
CREATE PROCEDURE `fn_registrarCita_historialTratamiento` (
															in `p_tratamiento_id` INT, 
                                                            in `p_cita_id` INT, 
                                                            in `p_cod_pac` INT, 
                                                            in `p_fecha` VARCHAR(50), 
                                                            in `p_hora` VARCHAR(50), 
                                                            in `p_horario` CHAR(2), 
                                                            in `p_descripcion` VARCHAR(255)
                                                            )
begin
 
 declare p_historial_tratamiento_id_actual integer;
 
 select historial_tratamiento_id into p_historial_tratamiento_id_actual from historial_tratamiento where paciente_id = p_cod_pac;



							if p_historial_tratamiento_id_actual is null then
								
								insert into historial_tratamiento(historial_tratamiento_id, fecha, hora, horario, descripcion, paciente_id, tratamiento_id)
								values((select f_generar_correlativo('historial_tratamiento')), p_fecha, p_hora, p_horario, p_descripcion, p_cod_pac, p_tratamiento_id);
								
								update correlativo set numero = numero +1
                    					 where tabla='historial_tratamiento';
										 
								
							else
								
								update 
											historial_tratamiento
										set 
											fecha          = p_fecha,
											hora           = p_hora,
											horario        = p_horario,
											descripcion    = p_descripcion, 
											paciente_id    = p_cod_pac, 
											tratamiento_id = p_tratamiento_id
										where
											historial_tratamiento_id = p_historial_tratamiento_id_actual;
								
							end if;
                            
							
 end$$

DELIMITER $$
CREATE PROCEDURE `fn_registrarCita_paciente` (
											in `p_codHorario` INTEGER, 
                                            in `p_cita_id` INTEGER, 
                                            in `p_fecha` VARCHAR(50), 
                                            in `p_hora` VARCHAR(50), 
                                            in `p_horario` CHAR(2), 
                                            in `p_consultorio_id` INT, 
                                            in `p_descripcion` VARCHAR(500), 
                                            in `p_doc_id_usuario` VARCHAR(20), 
                                            in `p_nombre_doctor` VARCHAR(100), 
                                            in `p_doc_id_paciente` VARCHAR(20), 
                                            in `p_nombres` VARCHAR(100), 
                                            in `p_apellidos` VARCHAR(100), 
                                            in `p_edad` VARCHAR(3), 
                                            in `p_sexo` CHAR(1), 
                                            in `p_naturalde` VARCHAR(100), 
                                            in `p_estado_civil` CHAR(1), 
                                            in `p_ocupacion` VARCHAR(200), 
                                            in `p_religion` VARCHAR(100), 
                                            in `p_domicilio` VARCHAR(200), 
                                            in `p_telefono` VARCHAR(20), 
                                            in `p_personaresponsable` VARCHAR(100), 
                                            in `p_personaresponsable_telefono` VARCHAR(20)
                                            ) 
begin
  
  declare p_nombre_doctor_cita varchar(100);
  declare p_cita_id_estado varchar(50);
  declare paciente_id_estado varchar(50);
  declare p_doc_id_paciente_temp integer;
  
  
  select nombre_doctor into p_nombre_doctor_cita from cita where cita_id = p_cita_id ;
 

  select cita_id into p_cita_id_estado from cita where cita_id = p_cita_id ;
  
  
  select paciente_id into paciente_id_estado from cita where cita_id = p_cita_id ; 

  
  set p_doc_id_paciente_temp = 0;
 

								
									if paciente_id_estado is null then
										insert into paciente
																	(
																		paciente_id,
																		doc_id,
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
																		personaresponsable_telefono
																	)
												values(
															(select f_generar_correlativo('paciente') as nc),
															p_doc_id_paciente,
															p_nombres,
															p_apellidos,
															p_edad,
															p_sexo,
															p_naturalde,
															p_estado_civil,
															p_ocupacion,
															p_religion,
															p_domicilio,
															p_telefono,
															p_personaresponsable,
															p_personaresponsable_telefono
														);



														update 
															correlativo 
														set 
															numero = numero + 1 
														where 
															tabla='paciente';

										else
											update 
												paciente 
											set 
												doc_id = p_doc_id_paciente,
												nombres = p_nombres,
												apellidos = p_apellidos,
												edad = p_edad,
												sexo = p_sexo,
												naturalde = p_naturalde,
												estado_civil = p_estado_civil,
												ocupacion = p_ocupacion,
												religion = p_religion,
												domicilio = p_domicilio,
												telefono = p_telefono,
												personaresponsable = p_personaresponsable,
												personaresponsable_telefono = p_personaresponsable_telefono
											where 
												doc_id = p_doc_id_paciente;
										end if;
										select paciente_id into p_doc_id_paciente_temp from paciente where doc_id = p_doc_id_paciente;
										
										if p_cita_id_estado is null then
											insert into cita(
														cita_id,
														fecha,
														hora,
														horario,
														nombre_doctor,
														descripcion,
														doc_id,
														estado,
														consultorio_id,
														paciente_id
													)
												values(
															p_cita_id,
															p_fecha,
															p_hora,
															p_horario,
															p_nombre_doctor,
															p_descripcion,
															p_doc_id_usuario,
															'En proceso de confirmaciÃ³n',
															p_consultorio_id,
															p_doc_id_paciente_temp
														);

												update 
													correlativo 
												set 
													numero = p_cita_id
												where 
													tabla='cita';

												update 
													horario_atencion 
												set estado = '0'
												where 
													horario_atencion_id = p_codHorario;
										else
											update 
													cita 
												set 
													descripcion = p_descripcion
												where 
													cita_id = p_cita_id;
										end if;	
						
 end$$

DELIMITER $$
CREATE PROCEDURE `fn_registrarHorario` (
										in `p_consultorio` INT, 
                                        in `p_doctor` INT, 
                                        in `p_dia_semana` VARCHAR(50), 
                                        in `p_numero` VARCHAR(50), 
                                        in `p_mes` VARCHAR(50), 
                                        in `p_ano` VARCHAR(50)
                                        ) 
begin
						
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'8:00','AM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'8:30','AM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'9:00','AM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'9:30','AM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'10:00','AM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'10:30','AM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'11:00','AM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'11:30','AM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'12:00','PM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'12:30','PM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'1:00','PM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'2:00','PM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'2:30','PM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'3:00','PM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'3:30','PM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'4:00','PM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'4:30','PM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
							
							insert into horario_atencion
							values((select f_generar_correlativo('horario_atencion')),p_doctor,p_consultorio,p_dia_semana,p_numero,p_mes,p_ano,'5:00','PM','1');							
							update correlativo set numero = numero + 1 where tabla='horario_atencion';
					
end$$

call fn_registrarUsuario(              
							'74123658',
							'Renzo Ruiz',
							'aaaaaaaaaaaaa', 
							'965874587', 
							'renzorp_14@hotmail.com', 
							 3, 
							'123',
							'C',
							'A'
                         );
select * from usuario;
DELIMITER $$
CREATE PROCEDURE `fn_registrarUsuario` (
										-- in `p_codigo_usuario` INT, 
                                        in `p_doc_id` VARCHAR(20), 
                                        in `p_nombres` VARCHAR(50), 
                                        in `p_direccion` VARCHAR(200), 
                                        in `p_telefono` VARCHAR(25), 
                                        in `p_email` VARCHAR(150), 
                                        in `p_cargo_id` INT, 
                                        in `p_clave` VARCHAR(32), 
                                        in `p_tipo` CHAR(1), 
                                        in `p_estado` CHAR(1)
                                        )
begin
declare p_codigo_usuario int;
								insert into usuario (doc_id, nombreCompleto, direccion, telefono, email, cargo_id)
								values(p_doc_id, p_nombres, p_direccion, p_telefono, p_email, p_cargo_id);
                                
								select (count(*) + 1 ) into p_codigo_usuario from credenciales_acceso;
                                
								insert into credenciales_acceso
								values(
										p_codigo_usuario,
										(select md5(p_clave)),
										p_tipo,
										p_estado,
										(select now()),
										p_doc_id
									  );
								
								
 end$$


 DELIMITER $$
 CREATE PROCEDURE f_generar_correlativo(in `p_tabla` VARCHAR(255))
 BEGIN
		select 
			c.numero+1 
		from 
			correlativo c 
		where 
			c.tabla = p_tabla;
 end$$ 

-- --------------------------------------------------------
-- Nombre de la base de datos

create database data_medic_bd;
--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `area_id` int(11) NOT NULL,
  `nombre_area` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `cargo_id` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`cargo_id`, `descripcion`) VALUES
(1, 'gerente'),
(2, 'doctor'),
(3, 'paciente'),
(4, 'soporte TI');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `cita_id` int(11) NOT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `hora` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `horario` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `nombre_doctor` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `doc_id` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `consultorio_id` int(11) DEFAULT NULL,
  `paciente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorio`
--

CREATE TABLE `consultorio` (
  `consultorio_id` int(11) NOT NULL,
  `nombre_consultorio` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `sede_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correlativo`
--

CREATE TABLE `correlativo` (
  `tabla` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `correlativo`
--
select * from correlativo;


INSERT INTO `correlativo` (`tabla`, `numero`) VALUES
('area', 0),
('cargo', 0),
('cita', 0),
('consultorio', 0),
('credenciales_acceso', 0),
('doctor', 0),
('doctorespecializacion', 0),
('empresa', 0),
('historial_tratamiento', 0),
('Horario de Atención', 0),
('horario_atencion', 0),
('paciente', 0),
('sede', 0),
('tratamiento', 0),
('usuario', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credenciales_acceso`
--

CREATE TABLE `credenciales_acceso` (
  `codigo_usuario` int(11) NOT NULL,
  `clave` char(32) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `estado` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_registro` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `doc_ID` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `credenciales_acceso`
--

INSERT INTO `credenciales_acceso` (`codigo_usuario`, `clave`, `tipo`, `estado`, `fecha_registro`, `doc_ID`) VALUES
(1, '202cb962ac59075b964b07152d234b70', 'S', 'A', '2020-10-20 12:05:10', '44745581'),
(2, '202cb962ac59075b964b07152d234b70', 'D', 'A', '2020-10-20 12:36:34', '44444444'),
(3, '202cb962ac59075b964b07152d234b70', 'C', 'A', '2020-10-20 12:36:34', '22222222'),
(4, '202cb962ac59075b964b07152d234b70', 'C', 'A', '2020-10-20 12:36:34', '22224444'),
(9, '202cb962ac59075b964b07152d234b70', 'D', 'A', '2020-10-20 12:36:34', '88225544');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL,
  `colegio` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_colegio` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `colegio`, `codigo_colegio`, `nombre`, `apellido`, `direccion`, `telefono`, `email`) VALUES
(1, 'CMP', '123456', 'Andres', 'Hurtado', 'Lima-Surco', '998745418', 'andresHurtado@hotmail.com'),
(2, 'CMP', '852147', 'Juan', 'CÃ³rdoba', 'Lima-San Borja', '995544754', 'juancordoba@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctorespecializacion`
--

CREATE TABLE `doctorespecializacion` (
  `doctorEspecializacion_id` int(11) NOT NULL,
  `especialidad_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `empresa_id` int(11) NOT NULL,
  `razon_social` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `razon_comercial` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ruc` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empresa_id`, `razon_social`, `razon_comercial`, `ruc`) VALUES
(1, 'Clinica Ricardo Palma Sa', 'Clinica Ricardo Palma', '20100121809');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `especialidad_id` int(11) NOT NULL,
  `nombre_especialidad` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `especialidad`
--

INSERT INTO `especialidad` (`especialidad_id`, `nombre_especialidad`) VALUES
(1, 'Endodoncia'),
(2, 'Cirugía'),
(3, 'Implantología'),
(4, 'Estática Dental & Diseño de Sonrisa'),
(5, 'Ortodoncia'),
(6, 'rehabilitación oral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_tratamiento`
--

CREATE TABLE `historial_tratamiento` (
  `historial_tratamiento_id` int(11) NOT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `hora` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `horario` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(2000) COLLATE utf8_spanish_ci NOT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `tratamiento_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario_atencion`
--

CREATE TABLE `horario_atencion` (
  `horario_atencion_id` bigint(20) UNSIGNED NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `consultorio_id` int(11) NOT NULL,
  `dia_semana` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `numero` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `mes` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `ano` char(4) COLLATE utf8_spanish_ci NOT NULL,
  `hora` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `horario` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `estado` char(1) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_cita`
--

CREATE TABLE `log_cita` (
  `usuarioQueRegistra_doc_id` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_nombres` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_cargo_id` int(11) DEFAULT NULL,
  `usuarioQueRegistra_tipo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiempo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_operacion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ip` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cita_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_credenciales_acceso`
--

CREATE TABLE `log_credenciales_acceso` (
  `clave` char(32) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_registro` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `doc_ID` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_doctor`
--

CREATE TABLE `log_doctor` (
  `usuarioQueRegistra_doc_id` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_nombres` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_cargo_id` int(11) DEFAULT NULL,
  `usuarioQueRegistra_tipo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiempo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_operacion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ip` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `colegio` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigo_colegio` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_doctorespecializacion`
--

CREATE TABLE `log_doctorespecializacion` (
  `usuarioQueRegistra_doc_id` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_nombres` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_cargo_id` int(11) DEFAULT NULL,
  `usuarioQueRegistra_tipo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiempo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_operacion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ip` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `doctorEspecializacion_id` int(11) NOT NULL,
  `especialidad_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_especialidad`
--

CREATE TABLE `log_especialidad` (
  `usuarioQueRegistra_doc_id` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_nombres` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_cargo_id` int(11) DEFAULT NULL,
  `usuarioQueRegistra_tipo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiempo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_operacion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ip` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `especialidad_id` int(11) DEFAULT NULL,
  `nombre_especialidad` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_historial_tratamiento`
--

CREATE TABLE `log_historial_tratamiento` (
  `usuarioQueRegistra_doc_id` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_nombres` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_cargo_id` int(11) DEFAULT NULL,
  `usuarioQueRegistra_tipo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiempo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_operacion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ip` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `historial_tratamiento_id` int(11) DEFAULT NULL,
  `fecha_historial_tratamiento` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hora_historial_tratamiento` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion_historial_tratamiento` varchar(2000) COLLATE utf8_spanish_ci DEFAULT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `tratamiento_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_inicioseseion`
--

CREATE TABLE `log_inicioseseion` (
  `doc_id` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombrecompleto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cargo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tiempo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ip` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `log_inicioseseion`
--

INSERT INTO `log_inicioseseion` (`doc_id`, `nombrecompleto`, `cargo`, `tipo`, `fecha`, `tiempo`, `ip`) VALUES
('44745581', 'Pedro Ruiz Cervera', 'soporte TI', '4', '2020-10-22', '14:06:50', '1'),
('44745581', 'Pedro Ruiz Cervera', 'soporte TI', 'S', '2020-10-22', '14:06:57', '::1'),
('44745581', 'Pedro Ruiz Cervera', 'soporte TI', 'S', '2020-10-22', '14:07:23', '::1'),
('44745581', 'Pedro Ruiz Cervera', 'soporte TI', 'S', '2020-10-22', '14:07:35', '::1'),
('44745581', 'Pedro Ruiz Cervera', 'soporte TI', 'S', '2020-10-22', '14:08:45', '::1'),
('44745581', 'Pedro Ruiz Cervera', 'soporte TI', 'S', '2020-10-22', '14:09:02', '::1'),
('44745581', 'Pedro Ruiz Cervera', 'soporte TI', 'S', '2020-10-22', '14:10:35', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_paciente`
--

CREATE TABLE `log_paciente` (
  `usuarioQueRegistra_doc_id` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_nombres` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_cargo_id` int(11) DEFAULT NULL,
  `usuarioQueRegistra_tipo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiempo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_operacion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ip` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `doc_id` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_tratamiento`
--

CREATE TABLE `log_tratamiento` (
  `usuarioQueRegistra_doc_id` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_nombres` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_cargo_id` int(11) DEFAULT NULL,
  `usuarioQueRegistra_tipo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiempo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_operacion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ip` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tratamiento_id` int(11) DEFAULT NULL,
  `nombre_tratamiento` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log_usuario`
--

CREATE TABLE `log_usuario` (
  `usuarioQueRegistra_doc_id` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_nombres` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `usuarioQueRegistra_cargo_id` int(11) DEFAULT NULL,
  `usuarioQueRegistra_tipo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tiempo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo_operacion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ip` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `doc_id` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombreCompleto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cargo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `codigo_menu` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`codigo_menu`, `nombre`) VALUES
(1, 'Inicio'),
(2, 'Cita'),
(3, 'Historia Clínica'),
(4, 'Tratamiento'),
(5, 'Presupuesto'),
(6, 'Log'),
(8, 'Empresa'),
(9, 'Horario de Atención'),
(10, 'Doctor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_item`
--

CREATE TABLE `menu_item` (
  `codigo_menu` int(11) NOT NULL,
  `codigo_menu_item` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `archivo` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `menu_item`
--

INSERT INTO `menu_item` (`codigo_menu`, `codigo_menu_item`, `nombre`, `archivo`) VALUES
(1, 1, 'Inicio', 'menu.principal.view.php'),
(2, 1, 'ver Cita', 'cita.view.php'),
(2, 2, 'Gestionar Cita', 'gestionarCita.view.php'),
(3, 1, 'Paciente', 'gestionarHCPaciente.view.php'),
(4, 1, 'Gestionar Tratamiento', 'gestionarTratamiento.view.php'),
(5, 1, 'Gestionar Presupuesto', 'gestionarPresupuesto.view.php'),
(6, 1, 'Log', 'log.view.php'),
(8, 1, 'Gestionar Empresa', 'gestionarEmpresa.view.php'),
(8, 2, 'Gestionar Sede', 'gestionarSede.view.php'),
(8, 3, 'Gestionar Consultorio', 'gestionarConsultorio.view.php'),
(8, 4, 'Gestionar Ã�rea', 'gestionarArea.view.php'),
(9, 1, 'Gestionar Horario', 'gestionarHorario.view.php'),
(10, 1, 'Gestionar Doctor', 'gestionarDoctor.view.php'),
(10, 2, 'Gestionar Especialidad', 'gestionarEspecialidad.view.php'),
(10, 3, 'Gestionar Detalle', 'gestionarDetalle.view.php');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu_item_accesos`
--

CREATE TABLE `menu_item_accesos` (
  `codigo_menu` int(11) NOT NULL,
  `codigo_menu_item` int(11) NOT NULL,
  `cargo_id` int(11) NOT NULL,
  `acceso` char(1) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `menu_item_accesos`
--

INSERT INTO `menu_item_accesos` (`codigo_menu`, `codigo_menu_item`, `cargo_id`, `acceso`) VALUES
(1, 1, 1, '1'),
(1, 1, 2, '1'),
(1, 1, 3, '1'),
(1, 1, 4, '1'),
(2, 1, 1, '1'),
(2, 1, 2, '1'),
(2, 1, 3, '0'),
(2, 1, 4, '1'),
(2, 2, 1, '1'),
(2, 2, 2, '1'),
(2, 2, 3, '1'),
(2, 2, 4, '1'),
(3, 1, 1, '1'),
(3, 1, 2, '1'),
(3, 1, 3, '0'),
(3, 1, 4, '1'),
(4, 1, 1, '1'),
(4, 1, 2, '1'),
(4, 1, 3, '0'),
(4, 1, 4, '1'),
(5, 1, 1, '1'),
(5, 1, 2, '0'),
(5, 1, 3, '0'),
(5, 1, 4, '1'),
(6, 1, 4, '1'),
(8, 1, 1, '0'),
(8, 1, 4, '1'),
(8, 2, 1, '1'),
(8, 2, 4, '1'),
(8, 3, 1, '1'),
(8, 3, 4, '1'),
(8, 4, 1, '1'),
(8, 4, 4, '1'),
(9, 1, 1, '1'),
(9, 1, 3, '1'),
(9, 1, 4, '1'),
(10, 1, 1, '1'),
(10, 1, 4, '1'),
(10, 2, 1, '1'),
(10, 2, 4, '1'),
(10, 3, 1, '1'),
(10, 3, 4, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `paciente_id` int(11) NOT NULL,
  `doc_id` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombres` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `edad` varchar(3) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sexo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `raza` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `naturalde` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `procedencia` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado_civil` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ocupacion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `instruccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `religion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `domicilio` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `personaresponsable` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `personaresponsable_telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_ingreso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hora` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `modoingreso` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_historia_clinica` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion_enfermedad_actual` mediumtext COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `pago_id` int(11) NOT NULL,
  `fecha_pago` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `hora_pago` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `monto` float NOT NULL,
  `igv` float NOT NULL,
  `monto_total` float NOT NULL,
  `estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `paciente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `sede_id` int(11) NOT NULL,
  `nombre_sede` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `departamento_sede` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `provincia_sede` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `distrito_sede` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion_sede` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_sede` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `empresa_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento`
--

CREATE TABLE `tratamiento` (
  `tratamiento_id` int(11) NOT NULL,
  `nombre_tratamiento` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tratamiento`
--

INSERT INTO `tratamiento` (`tratamiento_id`, `nombre_tratamiento`) VALUES
(1, 'Infección a las amígdalas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `doc_id` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombreCompleto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `cargo_id` int(11) DEFAULT NULL,
  `numInicioSesion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`doc_id`, `nombreCompleto`, `direccion`, `telefono`, `email`, `cargo_id`, `numInicioSesion`) VALUES
('22222222', 'Jaimito el cartero', 'Av. Huaylas, urb. Proceres #44500. Chorrillos', '951236547', 'jaimito@hotmail.com', 3, NULL),
('22224444', 'Cass Urbina', 'Av. Larco, Miraflores', '998555447', 'cass@hotmail.com', 3, NULL),
('44444444', 'Andres Hurtado', 'Av. Guardia Civil, urb. Proceres #44520. Chorrillos', '999988888', 'andres@hotmail.com', 2, NULL),
('44745581', 'Pedro Ruiz Cervera', 'Av. Aviación # 14456. San Borja', '95147731', 'pedro@hotmail.com', 4, 2),
('45977448', 'Juan Benito casas', 'Av. Guardia Civil, urb. Proceres #4456. Surco', '996456547', 'juanBenito@hotmail.com', 1, NULL),
('88225544', 'Juan Córdoba', 'Aviación, urb. Proceres #44880. San Borja', '995544754', 'juancordoba@hotmail.com', 2, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_id`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`cargo_id`),
  ADD UNIQUE KEY `cargo_id` (`cargo_id`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`cita_id`),
  ADD UNIQUE KEY `unq_cita_paciente_id_fecha` (`fecha`,`paciente_id`),
  ADD KEY `fk_cita_doc_id` (`doc_id`),
  ADD KEY `fk_cita_consultorio_id` (`consultorio_id`),
  ADD KEY `fk_cita_paciente_id` (`paciente_id`);

--
-- Indices de la tabla `consultorio`
--
ALTER TABLE `consultorio`
  ADD PRIMARY KEY (`consultorio_id`),
  ADD KEY `fk_consultorio_sede_id` (`sede_id`),
  ADD KEY `fk_consultorio_area_id` (`area_id`);

--
-- Indices de la tabla `correlativo`
--
ALTER TABLE `correlativo`
  ADD PRIMARY KEY (`tabla`);

--
-- Indices de la tabla `credenciales_acceso`
--
ALTER TABLE `credenciales_acceso`
  ADD PRIMARY KEY (`codigo_usuario`),
  ADD KEY `fk_usuario_doc_ID` (`doc_ID`);

--
-- Indices de la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indices de la tabla `doctorespecializacion`
--
ALTER TABLE `doctorespecializacion`
  ADD PRIMARY KEY (`doctorEspecializacion_id`),
  ADD KEY `fk_doctorEspecializacion_especialidad_id` (`especialidad_id`),
  ADD KEY `fk_doctorEspecializacion_doctor_id` (`doctor_id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empresa_id`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`especialidad_id`);

--
-- Indices de la tabla `historial_tratamiento`
--
ALTER TABLE `historial_tratamiento`
  ADD PRIMARY KEY (`historial_tratamiento_id`),
  ADD KEY `fk_historial_tratamiento_paciente_id` (`paciente_id`),
  ADD KEY `fk_historial_tratamiento_tratamiento_id` (`tratamiento_id`);

--
-- Indices de la tabla `horario_atencion`
--
ALTER TABLE `horario_atencion`
  ADD PRIMARY KEY (`horario_atencion_id`),
  ADD UNIQUE KEY `horario_atencion_id` (`horario_atencion_id`),
  ADD KEY `fk_horario_atencion_doctor_id` (`doctor_id`),
  ADD KEY `fk_horario_atencion_consultorio_id` (`consultorio_id`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`codigo_menu`);

--
-- Indices de la tabla `menu_item`
--
ALTER TABLE `menu_item`
  ADD PRIMARY KEY (`codigo_menu`,`codigo_menu_item`);

--
-- Indices de la tabla `menu_item_accesos`
--
ALTER TABLE `menu_item_accesos`
  ADD PRIMARY KEY (`codigo_menu`,`codigo_menu_item`,`cargo_id`),
  ADD KEY `fk_menu_item_accesos_cargo_id` (`cargo_id`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`paciente_id`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`pago_id`),
  ADD KEY `fk_pago_paciente_id` (`paciente_id`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`sede_id`),
  ADD KEY `fk_sede_empresa_id` (`empresa_id`);

--
-- Indices de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD PRIMARY KEY (`tratamiento_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`doc_id`),
  ADD UNIQUE KEY `uni_email` (`email`),
  ADD KEY `fk_usuario_cargo_id` (`cargo_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `cargo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `horario_atencion`
--
ALTER TABLE `horario_atencion`
  MODIFY `horario_atencion_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `fk_cita_consultorio_id` FOREIGN KEY (`consultorio_id`) REFERENCES `consultorio` (`consultorio_id`),
  ADD CONSTRAINT `fk_cita_doc_id` FOREIGN KEY (`doc_id`) REFERENCES `usuario` (`doc_id`),
  ADD CONSTRAINT `fk_cita_paciente_id` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`paciente_id`);

--
-- Filtros para la tabla `consultorio`
--
ALTER TABLE `consultorio`
  ADD CONSTRAINT `fk_consultorio_area_id` FOREIGN KEY (`area_id`) REFERENCES `area` (`area_id`),
  ADD CONSTRAINT `fk_consultorio_sede_id` FOREIGN KEY (`sede_id`) REFERENCES `sede` (`sede_id`);

--
-- Filtros para la tabla `credenciales_acceso`
--
ALTER TABLE `credenciales_acceso`
  ADD CONSTRAINT `fk_usuario_doc_ID` FOREIGN KEY (`doc_ID`) REFERENCES `usuario` (`doc_id`);

--
-- Filtros para la tabla `doctorespecializacion`
--
ALTER TABLE `doctorespecializacion`
  ADD CONSTRAINT `fk_doctorEspecializacion_doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`),
  ADD CONSTRAINT `fk_doctorEspecializacion_especialidad_id` FOREIGN KEY (`especialidad_id`) REFERENCES `especialidad` (`especialidad_id`);

--
-- Filtros para la tabla `historial_tratamiento`
--
ALTER TABLE `historial_tratamiento`
  ADD CONSTRAINT `fk_historial_tratamiento_paciente_id` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`paciente_id`),
  ADD CONSTRAINT `fk_historial_tratamiento_tratamiento_id` FOREIGN KEY (`tratamiento_id`) REFERENCES `tratamiento` (`tratamiento_id`);

--
-- Filtros para la tabla `horario_atencion`
--
ALTER TABLE `horario_atencion`
  ADD CONSTRAINT `fk_horario_atencion_consultorio_id` FOREIGN KEY (`consultorio_id`) REFERENCES `consultorio` (`consultorio_id`),
  ADD CONSTRAINT `fk_horario_atencion_doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`);

--
-- Filtros para la tabla `menu_item`
--
ALTER TABLE `menu_item`
  ADD CONSTRAINT `fk_menu_item_menu` FOREIGN KEY (`codigo_menu`) REFERENCES `menu` (`codigo_menu`);

--
-- Filtros para la tabla `menu_item_accesos`
--
ALTER TABLE `menu_item_accesos`
  ADD CONSTRAINT `fk_menu_item_accesos_cargo_id` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`cargo_id`),
  ADD CONSTRAINT `fk_menu_item_accesos_menu_item` FOREIGN KEY (`codigo_menu`,`codigo_menu_item`) REFERENCES `menu_item` (`codigo_menu`, `codigo_menu_item`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `fk_pago_paciente_id` FOREIGN KEY (`paciente_id`) REFERENCES `paciente` (`paciente_id`);

--
-- Filtros para la tabla `sede`
--
ALTER TABLE `sede`
  ADD CONSTRAINT `fk_sede_empresa_id` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`empresa_id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_cargo_id` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`cargo_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


SET SQL_SAFE_UPDATES = 0;

-- Consulta
select * from correlativo;

delete from correlativo;

select 
	* 
from 
	usuario u inner join cargo c
on 
	u.cargo_id = c.cargo_id 
    
    select * from credenciales_acceso
    
    delete from credenciales_acceso


