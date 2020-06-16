CREATE DATABASE dataMedic;

CREATE TABLE correlativo
 (
	tabla character varying(100) not null,
	numero integer not null,
	CONSTRAINT pk_correlativo PRIMARY KEY (tabla)
 );
-- select * from empresa
CREATE TABLE empresa
(
  empresa_id int,
  razon_social character varying(100) NOT NULL, -- se presenta ante los bancos o sunat
  razon_comercial character varying(100) NOT NULL, -- se presenta ante los clientes
  ruc  character varying(20) NOT NULL,
  CONSTRAINT pk_empresa_id PRIMARY KEY (empresa_id)
);

-- ALTER TABLE empresa
-- RENAME column nombre_empresa TO razon_social; 
select * from sede

CREATE TABLE sede
(
  sede_id int,
  nombre_sede character varying(100) NOT NULL,
  departamento_sede character varying(100) NOT NULL,
  provincia_sede character varying(100) NOT NULL,
  distrito_sede character varying(100) NOT NULL,
  direccion_sede character varying(200) NOT NULL,
  tipo_sede char(1) NOT NULL;, -- P: Principal, S: Secundario
  empresa_id int,
  CONSTRAINT pk_sede_id PRIMARY KEY (sede_id),
  CONSTRAINT fk_sede_empresa_id FOREIGN KEY (empresa_id) references empresa(empresa_id)  
);

CREATE TABLE area
(
  area_id int,
  nombre_area character varying(100) NOT NULL,
  CONSTRAINT pk_area_id PRIMARY KEY (area_id)
);

CREATE TABLE consultorio
(
  consultorio_id int,
  nombre_consultorio character varying(100) NOT NULL,
  sede_id int,
  area_id int,
  CONSTRAINT pk_consultorio_id PRIMARY KEY (consultorio_id),
  CONSTRAINT fk_consultorio_sede_id FOREIGN KEY (sede_id) references sede(sede_id),
  CONSTRAINT fk_consultorio_area_id FOREIGN KEY (area_id) references area(area_id)
);

CREATE TABLE cargo
(
  cargo_id serial not NULL,
  descripcion character varying(50) NOT NULL,
  CONSTRAINT pk_cargo PRIMARY KEY (cargo_id)
);

CREATE TABLE USUARIO
(
	doc_id character varying(20),
    nombreCompleto character varying(100),
	direccion character varying(200),
    telefono character varying(25),
   -- sexo char(1) not null, -- Mujer: 0, Hombre: 1 
   -- edad char(2) not null,
    email character varying(150) not null,
    cargo_id integer,
	numInicioSesion int;
    constraint pk_usuario_doc_id primary key(doc_id),
    constraint fk_usuario_cargo_id foreign key(cargo_id) references cargo(cargo_id),
	CONSTRAINT uni_email UNIQUE (email)
);

CREATE TABLE cita
(
  cita_id integer not NULL,
  fecha character varying(50)not null,
  nombre_doctor character varying(100) not null,
  descripcion character varying(500) not NULL,
  doc_id character varying(20),
  estado character varying(50)not null,
  consultorio_id int,
  paciente_id int,
  CONSTRAINT pk_cita_cita_id PRIMARY KEY (cita_id),
  CONSTRAINT fk_cita_doc_id foreign key (doc_id) references usuario(doc_id),
  CONSTRAINT fk_cita_consultorio_id foreign key (consultorio_id) references consultorio(consultorio_id),
  CONSTRAINT fk_cita_paciente_id foreign key (paciente_id) references paciente(paciente_id)
);

CREATE TABLE especialidad
(
  especialidad_id integer,
  nombre_especialidad character varying(200)not null,
  CONSTRAINT pk_especialidad_especialidad_id PRIMARY KEY (especialidad_id)
);

CREATE TABLE doctorEspecializacion
(
  doctorEspecializacion_id integer not NULL,
  -- otra_Especializacion_nombre character varying(100)not null,
  especialidad_id integer,
  doctor_id integer,
  CONSTRAINT pk_doctorEspecializacion_otra_doctorEspecializacion_id PRIMARY KEY (doctorEspecializacion_id),
  CONSTRAINT fk_doctorEspecializacion_especialidad_id foreign key (especialidad_id) references especialidad(especialidad_id),
  CONSTRAINT fk_doctorEspecializacion_doctor_id foreign key (doctor_id) references doctor(doctor_id)	
);

CREATE TABLE doctor
(
  doctor_id integer not NULL,
  colegio character varying(10)not null,
  codigo_colegio character varying(20) not NULL,
  nombre character varying(100) not NULL,
  apellido character varying(100) not NULL,
  direccion character varying(200) not NULL,
  telefono character varying(20) not NULL,
  email character varying(150) not NULL,
  CONSTRAINT pk_doctor_doctor_id PRIMARY KEY (doctor_id)
);

-- horario de trabajo y atención de cada doctor.
CREATE TABLE horario_atencion 
(
  horario_atencion_id serial,
  doctor_id int not null,
  consultorio_id int not null,
  dia_semana character varying(50) not null, -- Lunes, Martes ..., Domingo
  numero character varying(5) not null, -- 1,2,3,4,..,31
  mes character varying(20) not null,
  ano char(4) not null,
  hora character varying(10) not null,
  horario char(2) not null, -- AM, PM
  estado char(1)not null, -- 1 : disponible, 0: no disponible
  CONSTRAINT pk_horario_atencion_horario_atencion_id PRIMARY KEY (horario_atencion_id),
  CONSTRAINT fk_horario_atencion_doctor_id foreign key (doctor_id) references doctor(doctor_id),
  CONSTRAINT fk_horario_atencion_consultorio_id foreign key (consultorio_id) references consultorio(consultorio_id)
);


select * from consultorio

/*ALTER TABLE synop
  ADD CONSTRAINT estacoes_fk
  FOREIGN KEY (id_estacao)
  REFERENCES estacoes
*/
-- ALTER TABLE USUARIO ALTER COLUMN direccion  DROP  NOT NULL;
-- ALTER TABLE USUARIO ALTER COLUMN telefono  DROP  NOT NULL;

-- select * from usuario
CREATE TABLE CREDENCIALES_ACCESO
 ( 	
	codigo_usuario integer not null,
	clave character(32) not NULL,
	tipo char(1) not null, -- Amin: A, Docente: D, Estudiante: E
   -- p_foto bytea,
	estado char(1),
    fecha_registro varchar(50),
    doc_ID varchar(20),
    CONSTRAINT pk_codigo_usuario PRIMARY KEY (codigo_usuario),
    CONSTRAINT fk_usuario_doc_ID foreign key(doc_ID) references 
    USUARIO(doc_ID)
    
 );
 
 
 CREATE TABLE menu
(
  codigo_menu integer not NULL,
  nombre character varying(50) not NULL,
  CONSTRAINT menu_pkey PRIMARY KEY (codigo_menu)
);

CREATE TABLE menu_item
(
  codigo_menu integer not NULL,
  codigo_menu_item integer not NULL,
  nombre character varying(50) not NULL,
  archivo character varying(100) not NULL,
  CONSTRAINT pk_menu_item PRIMARY KEY (codigo_menu, codigo_menu_item),
  CONSTRAINT fk_menu_item_menu FOREIGN KEY (codigo_menu)
      REFERENCES menu (codigo_menu)
);

CREATE TABLE menu_item_accesos
(
  codigo_menu integer not NULL,
  codigo_menu_item integer not NULL,
  cargo_id integer not NULL,
  acceso character(1) not NULL,
  CONSTRAINT pk_menu_item_accesos PRIMARY KEY (codigo_menu, codigo_menu_item, cargo_id),
  CONSTRAINT fk_menu_item_accesos_cargo_id FOREIGN KEY (cargo_id)
      REFERENCES cargo (cargo_id),
  CONSTRAINT fk_menu_item_accesos_menu_item FOREIGN KEY (codigo_menu, codigo_menu_item)
      REFERENCES menu_item (codigo_menu, codigo_menu_item)
);

-- select * from cita
CREATE TABLE paciente
(
  paciente_id integer,
  doc_id character varying(20),
  nombres character varying(100),
  apellidos character varying(100),
  edad character varying(3),
  sexo char(1),
  raza char(1),
  naturalde character varying(100),-- Lugar de nacimiento
  procedencia character varying(100),
  estado_civil char(1),
  ocupacion character varying(200),
  instruccion character varying(200),
  religion character varying(100),
  domicilio character varying(200),
  telefono character varying(20),
  personaresponsable character varying(100),
  personaresponsable_telefono character varying(20),
  fecha_ingreso character varying(50),
  hora character varying(20),
  modoingreso character varying(50),
  fecha_historia_clinica character varying(50),
  descripcion_enfermedad_actual character varying(1000),
  CONSTRAINT pk_paciente_paciente_id PRIMARY KEY(paciente_id)
);
-- drop table cita;
-- drop table paciente;
-- drop table pago;
-- drop table historial_tratamiento;

CREATE TABLE tratamiento
(
  tratamiento_id integer not NULL,
  nombre_tratamiento character varying(200)not null,
  CONSTRAINT pk_tratamiento_tratamiento_id PRIMARY KEY (tratamiento_id)
);

CREATE TABLE historial_tratamiento
(
  historial_tratamiento_id integer not NULL,
  fecha character varying(50)not null,
  hora character varying(50) not NULL,
  descripcion character varying(2000) not NULL,
  paciente_id int,
  tratamiento_id int,
  CONSTRAINT pk_historial_tratamiento_historial_tratamiento_id PRIMARY KEY (historial_tratamiento_id),
  CONSTRAINT fk_historial_tratamiento_paciente_id foreign key(paciente_id) references paciente(paciente_id),
  CONSTRAINT fk_historial_tratamiento_tratamiento_id foreign key(tratamiento_id) references tratamiento(tratamiento_id)
);

CREATE TABLE pago
(
  pago_id integer not NULL,
  fecha_pago character varying(50)not null,
  hora_pago character varying(50) not NULL,
  descripcion character varying(500) not NULL,
  monto float not null,
  igv float not null,
  monto_total float not null,
  estado character varying(50)not null,
  paciente_id int,
  CONSTRAINT pk_pago_pago_id PRIMARY KEY (pago_id),
  CONSTRAINT fk_pago_paciente_id foreign key(paciente_id) references paciente(paciente_id)
);

CREATE TABLE fecha
(
  fecha_id integer not NULL,
  mes character varying(50)not null,
  dia_semana character varying(50)not null,
  numero char(2)not null, -- ejemplo: 01, 02,03,04 ... 31
  hora char(8)not null, -- ejemplo: 8:00 am ..., 5:00 pm
  estado character varying(50)not null,
  CONSTRAINT pk_fecha_fecha_id PRIMARY KEY (fecha_id)
);
-- LOGS

-- tabla para el historial de log inicio sesión
  CREATE TABLE log_inicioSeseion
  (
  	doc_id character varying(20) not null,
    nombrecompleto character varying(100) not null,    
	cargo character varying(50) not null,
	tipo char(1) not null,
	fecha character varying(50) not null,
	tiempo character varying(50) not null,
	ip character varying(200) not null
  );
  
CREATE TABLE log_usuario
  (
	usuarioQueRegistra_doc_id character varying(20),
    usuarioQueRegistra_nombres character varying(100),
    usuarioQueRegistra_cargo_id int,
    usuarioQueRegistra_tipo char(1),
    fecha character varying(50),
    tiempo character varying(50),
    tipo_operacion character varying(100),
    ip character varying(200),
  	doc_id character varying(20),
    nombreCompleto character varying(100),
	direccion character varying(200),
    telefono character varying(25),
    email character varying(150),
    cargo_id integer
  );
  
  -- drop table log_credenciales_acceso
  CREATE TABLE log_credenciales_acceso
 ( 	
	clave character(32),
	tipo char(1), -- Amin: A, Docente: D, Estudiante: E
	estado char(1),
    fecha_registro varchar(50),
    doc_ID varchar(20)
 );
 
CREATE TABLE log_tratamiento
(
  usuarioQueRegistra_doc_id character varying(20),
  usuarioQueRegistra_nombres character varying(100),
  usuarioQueRegistra_cargo_id int,
  usuarioQueRegistra_tipo char(1),
  fecha character varying(50),
  tiempo character varying(50),
  tipo_operacion character varying(100),
  ip character varying(200),
  tratamiento_id int,
  nombre_tratamiento character varying(200)
);

CREATE TABLE log_doctor
(
  usuarioQueRegistra_doc_id character varying(20),
  usuarioQueRegistra_nombres character varying(50),
  usuarioQueRegistra_apellidos character varying(50),
  usuarioQueRegistra_cargo_id int,
  usuarioQueRegistra_tipo char(1),
  fecha character varying(50),
  tiempo character varying(50),
  tipo_operacion character varying(100),
  ip character varying(200),	
  doctor_id integer,
  colegio character varying(10),
  codigo_colegio character varying(20),
  nombre character varying(100),
  apellido character varying(100),
  direccion character varying(200),
  telefono character varying(20),
  email character varying(150),
  especialidad_id int
);



CREATE TABLE log_paciente
(
  usuarioQueRegistra_doc_id character varying(20),
  usuarioQueRegistra_nombres character varying(100),
  usuarioQueRegistra_cargo_id int,
  usuarioQueRegistra_tipo char(1),
  fecha character varying(50),
  tiempo character varying(50),
  tipo_operacion character varying(100),
  ip character varying(200),
  paciente_id integer,
  doc_id character varying(20),
  nombres character varying(100),
  apellidos character varying(100),
  edad character varying(3),
  sexo char(1),
  raza char(1),
  naturalde character varying(100),-- Lugar de nacimiento
  procedencia character varying(100),
  estado_civil char(1),
  ocupacion character varying(200),
  instruccion character varying(200),
  religion character varying(100),
  domicilio character varying(200),
  telefono character varying(20),
  personaresponsable character varying(100),
  personaresponsable_telefono character varying(20),
  fecha_ingreso character varying(50),
  hora character varying(20),
  modoingreso character varying(50),
  fecha_historia_clinica character varying(50),
  descripcion_enfermedad_actual character varying(1000)
);

CREATE TABLE log_historial_tratamiento
(
  usuarioQueRegistra_doc_id character varying(20),
  usuarioQueRegistra_nombres character varying(50),
  usuarioQueRegistra_apellidos character varying(50),
  usuarioQueRegistra_cargo_id int,
  usuarioQueRegistra_tipo char(1),
  fecha character varying(50),
  tiempo character varying(50),
  tipo_operacion character varying(100),
  ip character varying(200),
  historial_tratamiento_id integer,
  fecha_historial_tratamiento character varying(50),
  hora_historial_tratamiento character varying(50),
  descripcion_historial_tratamiento character varying(2000),
  paciente_id int,
  tratamiento_id int
);

CREATE TABLE log_cita
(
  usuarioQueRegistra_doc_id character varying(20),
  usuarioQueRegistra_nombres character varying(50),
  usuarioQueRegistra_apellidos character varying(50),
  usuarioQueRegistra_cargo_id int,
  usuarioQueRegistra_tipo char(1),
  fecha character varying(50),
  tiempo character varying(50),
  tipo_operacion character varying(100),
  ip character varying(200),
  cita_id integer not NULL,
  fecha_cita character varying(50)not null,
  hora_cita character varying(50) not NULL,
  descripcion character varying(500) not NULL,
  doc_id_usuario character varying(20), -- si es el paciente el que registra, será el mismo ----> usuarioQueRegistra_doc_id
  doctor_id int,
  estado character varying(50)not null,-- el que habilita o no la cita es el admin y debe haber un registro de eso
  paciente_id int
);

CREATE TABLE log_especialidad
(
  usuarioQueRegistra_doc_id character varying(20),
  usuarioQueRegistra_nombres character varying(100),
  usuarioQueRegistra_cargo_id int,
  usuarioQueRegistra_tipo char(1),
  fecha character varying(50),
  tiempo character varying(50),
  tipo_operacion character varying(100),
  ip character varying(200),
  especialidad_id int,
  nombre_especialidad character varying(200)
);
-- Nuevas tablas para la ampliación del sistema
-- Empresa, Sucursal, Consultorio.


-- agregados para el LOG
-- agregar al menú el módulo usuario

select * from menu_item

update menu
set nombre = 'Usuario'
where codigo_menu = 5;

select * from menu_item

update menu_item
set nombre = 'GestionarUsuario'
where codigo_menu = 5 and codigo_menu_item = 1;

update menu_item
set archivo = 'GestionarUsuario.view.php'
where codigo_menu = 5 and codigo_menu_item = 1;


-- agregar menu log
insert into menu
values(6,'Log');

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(6,1,'Log', 'log.view.php');



select * from correlativo
-- agregamos usuario sorte TI

insert into cargo
values(4,'soporte TI')

-- Agregamos un super usuario

insert into usuario(doc_id,nombrecompleto, direccion, telefono,email,cargo_id)
values('44745581','Pedro Ruiz Cervera','Av. Aviación # 14456. San Borja','95147731','pedro@hotmail.com',4);

insert into credenciales_acceso(codigo_usuario,clave,tipo,estado,fecha_registro, doc_id)
values(1,(select MD5('123')),'S','A',(select now()),'44745581');
-- agregar accesos al menu para el super usuario

insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,1,4,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(2,1,4,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(2,2,4,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,1,4,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,1,4,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,1,4,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(6,1,4,1); 

-- se agregó nueva columna a la tabla usuario: 
-- Para saber el número de veces que inicio sesión un usuario.
 alter table usuario 
 add column numInicioSesion int;
 
 -- fin
/*
CREATE TABLE mes
(
  mes_id integer not NULL,
  nombre_mes character varying(100)not null, 
  CONSTRAINT pk_mes_mes_id PRIMARY KEY (mes_id)
);

CREATE TABLE dia_semana
(
  dia_semana_id integer not NULL,
  nombre_dia_semana character varying(100)not null, 
  CONSTRAINT pk_dia_semana_dia_semana_id PRIMARY KEY (dia_semana_id)
);
-- insertar calentadio
-- select * from mes
insert into mes
values(1,'Enero');
insert into mes
values(2,'Febrero');
insert into mes
values(3,'Marzo');
insert into mes
values(4,'Abril');
insert into mes
values(5,'Mayo');
insert into mes
values(6,'Junio');
insert into mes
values(7,'Julio');
insert into mes
values(8,'Agosto');
insert into mes
values(9,'Setiembre');
insert into mes
values(10,'Octubre');
insert into mes
values(11,'Noviembre');
insert into mes
values(12,'Diciembre');

-- select * from dia_semana
insert into dia_semana
values(1,'Lunes');
insert into dia_semana
values(2,'Martes');
insert into dia_semana
values(3,'Miércoles');
insert into dia_semana
values(4,'Jueves');
insert into dia_semana
values(5,'Viernes');
insert into dia_semana
values(6,'Sábado');
insert into dia_semana
values(7,'Domingo');

-- select * from fecha
insert into fecha
values(1,'01','9:00 am',1,1);
--
*/
select * from correlativo
-- actualizado para al ampliación del sistema al 08062020
insert into correlativo
values('cita',0); 
insert into correlativo
values('usuario',0); 
insert into correlativo
values('doctor',0); 
insert into correlativo
values('cargo',0); 
insert into correlativo
values('paciente',0); 
insert into correlativo
values('empresa',0);
insert into correlativo
values('sede',0); 
insert into correlativo
values('consultorio',0); 
insert into correlativo
values('tratamiento',0); 
insert into correlativo
values('historial_tratamiento',0);
insert into correlativo
values('credenciales_acceso',0);


 -- Registros   select * from menu
 -- Menú
insert into menu(codigo_menu,nombre)
values(1,'Inicio'); 
insert into menu(codigo_menu,nombre)
values(2,'Cita'); 
insert into menu(codigo_menu,nombre)
values(3,'Historia Clínica');
insert into menu(codigo_menu,nombre)
values(4,'Tratamiento');
insert into menu(codigo_menu,nombre)
values(5,'Presupuesto');

select * from especialidad;

select * from correlativo;

-- actualización al 01/06/2020
select * from f_generar_correlativo('especialidad') as nc
select * from correlativo;

update correlativo
set numero = 5
where tabla = 'especialidad'

insert into correlativo
values('especialidad', 5)

insert into menu(codigo_menu,nombre)
values(7,'Especialidad');

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(7,1,'Gestionar Especialidad', 'gestionarEspecialidad.view.php');

insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(7,1,1,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(7,1,4,1);

-- fin de actualización al 01/06/202

-- actualización de ampliación al 09062020

select * from f_generar_correlativo('empresa') as nc
select * from cargo;

insert into menu(codigo_menu,nombre)
values(8,'Empresa');
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(8,1,'Gestionar Empresa', 'gestionarEmpresa.view.php');
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(8,1,4,1);

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(8,2,'Gestionar Sede', 'gestionarSede.view.php');
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(8,2,4,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(8,2,1,1);

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(8,3,'Gestionar Consultorio', 'gestionarConsultorio.view.php');
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(8,3,4,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(8,3,1,1);

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(8,4,'Gestionar Área', 'gestionarArea.view.php');
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(8,4,4,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(8,4,1,1);

insert into correlativo(tabla, numero)
values('Horario de Atención',0);

insert into menu(codigo_menu,nombre)
values(9,'Horario de Atención');
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(9,1,'Gestionar Horario', 'gestionarHorario.view.php');
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(9,1,1,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(9,1,4,1);


select * from menu

insert into correlativo(tabla, numero)
values('area',0);

insert into empresa
values(1,'Clinica Ricardo Palma Sa','Clinica Ricardo Palma','20100121809');

insert into sede
values(1,'Sede 01 - Miraflores',1,'Lima','Lima','Miraflores','Av. Larco 15002','C');

insert into consultorio
values(1,'Consultorio Dental Mujer',1,1);

-- Horario de atención: 

insert into horario_atencion
values(1,1,1,'Miercoles','1','Julio','2020','8:00','AM','1');

insert into horario_atencion
values(2,1,1,'Miercoles','1','Julio','2020','8:30','AM','1');

insert into horario_atencion
values(3,1,1,'Miercoles','1','Julio','2020','9:00','AM','1');

insert into horario_atencion
values(4,1,1,'Miercoles','1','Julio','2020','9:30','AM','1');

insert into horario_atencion
values(5,1,1,'Miercoles','1','Julio','2020','10:00','AM','1');

insert into horario_atencion
values(6,1,1,'Miercoles','1','Julio','2020','10:30','AM','1');

insert into horario_atencion
values(7,1,1,'Miercoles','1','Julio','2020','11:00','AM','1');

insert into horario_atencion
values(8,1,1,'Miercoles','1','Julio','2020','11:30','AM','1');

insert into horario_atencion
values(9,1,1,'Miercoles','1','Julio','2020','12:00','PM','1');

insert into horario_atencion
values(10,1,1,'Miercoles','1','Julio','2020','12:30','PM','1');

insert into horario_atencion
values(11,1,1,'Miercoles','1','Julio','2020','2:00','PM','1');

insert into horario_atencion
values(12,1,1,'Miercoles','1','Julio','2020','2:30','PM','1');

insert into horario_atencion
values(13,1,1,'Miercoles','1','Julio','2020','3:00','PM','1');

insert into horario_atencion
values(14,1,1,'Miercoles','1','Julio','2020','3:30','PM','1');

insert into horario_atencion
values(15,1,1,'Miercoles','1','Julio','2020','4:00','PM','1');

insert into horario_atencion
values(16,1,1,'Miercoles','1','Julio','2020','4:30','PM','1');







insert into horario_atencion
values(17,2,2,'Miercoles','1','Julio','2020','8:00','AM','1');

insert into horario_atencion
values(18,2,2,'Miercoles','1','Julio','2020','8:30','AM','1');

insert into horario_atencion
values(19,2,2,'Miercoles','1','Julio','2020','9:00','AM','1');

insert into horario_atencion
values(20,2,2,'Miercoles','1','Julio','2020','9:30','AM','1');

insert into horario_atencion
values(21,2,2,'Miercoles','1','Julio','2020','10:00','AM','1');

insert into horario_atencion
values(22,2,2,'Miercoles','1','Julio','2020','10:30','AM','1');

insert into horario_atencion
values(23,2,2,'Miercoles','1','Julio','2020','11:00','AM','1');

insert into horario_atencion
values(24,2,2,'Miercoles','1','Julio','2020','11:30','AM','1');

insert into horario_atencion
values(25,2,2,'Miercoles','1','Julio','2020','12:00','PM','1');

insert into horario_atencion
values(26,2,2,'Miercoles','1','Julio','2020','12:30','PM','1');

insert into horario_atencion
values(27,2,2,'Miercoles','1','Julio','2020','2:00','PM','1');

insert into horario_atencion
values(28,2,2,'Miercoles','1','Julio','2020','2:30','PM','1');

insert into horario_atencion
values(29,2,2,'Miercoles','1','Julio','2020','3:00','PM','1');

insert into horario_atencion
values(30,2,2,'Miercoles','1','Julio','2020','3:30','PM','1');

insert into horario_atencion
values(31,2,2,'Miercoles','1','Julio','2020','4:00','PM','1');

insert into horario_atencion
values(32,2,2,'Miercoles','1','Julio','2020','4:30','PM','1');

-- 


-- insert MES Y AÑO
update 
	menu_item
set nombre = 'Mis Citas'
where
	nombre = 'ver Cita'
	
select * from menu_item


-- FIN AMPLIACIÓN
-- cargo
select * from f_generar_correlativo('empresa') as nc
select * from fecha_atencion_doctor
update menu
set nombre = 'Tratamiento'
where codigo_menu = 4
--  Menú item
-- select * from menu_item

insert into cargo
values(1, 'gerente');
insert into cargo
values(2, 'doctor');
insert into cargo
values(3, 'paciente');

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(1,1,'Inicio', 'menu.principal.view.php');

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(2,1,'ver Cita', 'cita.view.php');
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(2,2,'Gestionar Cita', 'gestionarCita.view.php');

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(3,1,'Paciente', 'gestionarHCPaciente.view.php');

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(4,1,'Gestionar Tratamiento', 'gestionarTratamiento.view.php');
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(5,1,'Gestionar Presupuesto', 'gestionarPresupuesto.view.php');

insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,1,1,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(2,1,1,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(2,2,1,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,1,1,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,1,1,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,1,1,1);

-- Doctor
select * from menu_item_accesos
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,1,2,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(2,1,2,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(2,2,2,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,1,2,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,1,2,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,1,2,0);

update menu_item_accesos
set acceso = '1'
where codigo_menu = 3 and codigo_menu_item = 1
-- Cliente

insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,1,3,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(2,1,3,0);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(2,2,3,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,1,3,0);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,1,3,0);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,1,3,0);
-- select * from menu_item_accesos
select * from menu_item_accesos

update menu_item_accesos
set acceso = '0'
where codigo_menu = 3 and codigo_menu_item = 1 and cargo_id = 3

insert into usuario(doc_id,nombrecompleto, direccion, telefono,email,cargo_id)
values('45977448','Juan Benito casas','Av. Guardia Civil, urb. Proceres #4456. Surco','996456547','juanBenito@hotmail.com',1);

insert into usuario(doc_id,nombrecompleto, direccion, telefono,email,cargo_id)
values('44444444','Andres Hurtado','Av. Guardia Civil, urb. Proceres #44520. Chorrillos','999988888','andres@hotmail.com',2);

insert into usuario(doc_id,nombrecompleto, direccion, telefono,email,cargo_id)
values('22222222','Jaimito el cartero','Av. Huaylas, urb. Proceres #44500. Chorrillos','951236547','jaimito@hotmail.com',3);

insert into usuario(doc_id,nombrecompleto, direccion, telefono,email,cargo_id)
values('22224444','Cass Urbina','Av. Larco, Miraflores','998555447','cass@hotmail.com',3);

insert into usuario(doc_id,nombrecompleto, direccion, telefono,email,cargo_id)
values('88225544','Juan Córdoba','Aviación, urb. Proceres #44880. San Borja','995544754','juancordoba@hotmail.com',2);

-- Credenciales de acceso
-- select * from usuario

insert into credenciales_acceso(codigo_usuario,clave,tipo,estado,fecha_registro, doc_id)
values(1,(select MD5('123')),'A','A',(select now()),'45977448');

insert into credenciales_acceso(codigo_usuario,clave,tipo,estado,fecha_registro, doc_id)
values(2,(select MD5('123')),'D','A',(select now()),'44444444');

insert into credenciales_acceso(codigo_usuario,clave,tipo,estado,fecha_registro, doc_id)
values(3,(select MD5('123')),'C','A',(select now()),'22222222');

insert into credenciales_acceso(codigo_usuario,clave,tipo,estado,fecha_registro, doc_id)
values(4,(select MD5('123')),'C','A',(select now()),'22224444');

insert into credenciales_acceso(codigo_usuario,clave,tipo,estado,fecha_registro, doc_id)
values(9,(select MD5('123')),'D','A',(select now()),'88225544');

-- select * from correlativo
insert into correlativo(tabla, numero)
values('usuario',0);

select * from cita;

-- insert especialidad
insert into especialidad
values(1,'Endodoncia');
insert into especialidad
values(2,'Cirugía');
insert into especialidad
values(3,'Implantología');
insert into especialidad
values(4,'Estética Dental & Diseño de Sonrisa');
insert into especialidad
values(5,'Ortodoncia');
insert into especialidad
values(6,'rehabilitación oral');
-- insert doctor

insert into doctor
values(1,'CMP','123456','Andres','Hurtado','Lima-Surco','998745418','andresHurtado@hotmail.com');

insert into doctor
values(2,'CMP','852147','Juan','Córdoba','Lima-San Borja','995544754','juancordoba@hotmail.com');

select * from horario_Atencion

insert into cita
values(1,'Lunes, 25 Mayo','9:00 am', '-------','45977448',1, 'Cita confirmada');
insert into cita
values(2,'Miércoles, 27 Mayo','9:30 am', '-------','45977448',1,'Cita en proceso de confirmación');
insert into cita
values(3,'Viernes, 29 Mayo','10:00 am', '-------','45977448',1,'Cita en proceso de confirmación');

select 
	fecha_id,
	concat(mes, ', ',dia_semana, ' ',numero, ', ',hora)as fecha
from 
	fecha
where
                        estado = 'disponible';
--
-- insert fecha select * from fecha

insert into fecha
values(1,'Mayo','Lunes','25','9:00','disponible');

insert into fecha
values(2,'Mayo','Lunes','25','9:30','disponible');

insert into fecha
values(3,'Mayo','Lunes','25','10:00','disponible');

insert into fecha
values(4,'Mayo','Lunes','25','10:30','disponible');

insert into fecha
values(5,'Mayo','Lunes','25','11:00','disponible');

insert into fecha
values(6,'Mayo','Lunes','25','11:30','disponible');

insert into fecha
values(7,'Mayo','Lunes','25','12:00','disponible');

insert into fecha
values(8,'Mayo','Lunes','25','12:30','disponible');

insert into fecha
values(9,'Mayo','Lunes','25','13:00','disponible');

insert into fecha
values(10,'Mayo','Lunes','25','14:30','disponible');

insert into fecha
values(11,'Mayo','Lunes','25','15:00','disponible');

insert into fecha
values(12,'Mayo','Lunes','25','15:30','disponible');

insert into fecha
values(13,'Mayo','Lunes','25','16:00','disponible');
--
-- insert histotial tratamiento
insert into historial_tratamiento
values(1,'Lunes 25 de Mayo','9:00', 'se receto medicamentos para el dolor e infeccion a las amigdas,etc.', 1, 1 );

-- agregar tratamiento
select * from correlativo;

 update correlativo set numero = 1
                    	where tabla='historial_tratamiento';
						
						
select * from historial_tratamiento;

insert into tratamiento
values(1, 'Infección a las amígdalas')

select 
                            tratamiento_id,
                            nombre_tratamiento
                        from 
                            tratamiento
-- 
-- función correlativo

select * from f_generar_correlativo('cita') as nc;

CREATE OR REPLACE FUNCTION f_generar_correlativo(p_tabla character varying)
  RETURNS SETOF integer AS
 $$
	
	begin
		return query
		select 
			c.numero+1 
		from 
			correlativo c 
		where 
			c.tabla = p_tabla;
 end
 $$ language plpgsql;
 
 select * from consultorio;
 select * from cita;
 select * from log_paciente;
 select * from log_cita;
 select * from correlativo;

												
												
												
												
	 											
												
select * from fn_registrarCita_paciente(
												'45977448',
												'NombreUsuarioQueRegistra',
												1,
												'A',
												'192.168.1.1',
	 											3,
												'Lunes bla bla bla',
												'12:00',
												'Descripción',
												'45977448',
												1,
	 											'48632147',
	 											'NombrePaciente',
	 											'ApellidosPaciente',
	 											'25',
	 											'M',
	 											'Piura',
	 											'S',
	 											'Contador',
	 											'Católico',
	 											'Lurincito',
	 											'963258741',
	 											'Nomredelresposable',
	 											'963225859'
									);
												
												
												
	 									select * from paciente;	
										delete from paciente;
	 											
												
CREATE OR REPLACE FUNCTION fn_registrarCita_paciente(
												p_codHorario integer,
	 											p_cita_id integer,
												p_fecha character varying(50),
												p_consultorio_id int,
												p_descripcion character varying(500),
												p_doc_id_usuario character varying(20),
												p_nombre_doctor character varying(100),
	 											p_doc_id_paciente character varying(20),
	 											p_nombres character varying(100),
	 											p_apellidos character varying(100),
	 											p_edad character varying(3),
	 											p_sexo char(1),
	 											p_naturalde character varying(100),
	 											p_estado_civil char(1),
	 											p_ocupacion character varying(200),
	 											p_religion character varying(100),
	 											p_domicilio character varying(200),
	 											p_telefono character varying(20),
	 											p_personaresponsable character varying(100),
	 											p_personaresponsable_telefono character varying(20)
											 )  RETURNS void AS   
 $$
 declare
 -- p_estadoPaciente int := (select count(*) from paciente where doc_id = p_doc_id_paciente);
 --p_fecha_registro character varying(50)  := current_date;
 --p_tiempo_registro character varying(50) := current_time;
 begin
							
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
										    (select * from f_generar_correlativo('paciente') as nc),
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
							
							insert into cita(
												cita_id,
												fecha,
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
													p_nombre_doctor,
													p_descripcion,
													p_doc_id_usuario,
													'En proceso de confirmación',
													p_consultorio_id,
													(select paciente_id from paciente where doc_id = p_doc_id_paciente)
												);
							
										update 
											correlativo 
										set numero = p_cita_id
										where 
											tabla='cita';
											
										update 
											horario_atencion 
										set estado = '0'
										where 
											horario_atencion_id = p_codHorario;
										
											
						
 end
 $$ language plpgsql;
 
 select * from horario_atencion;
  select * from paciente;
 
 select * from fn_registrarCita_paciente(
                                                1,
                                                'Miercoles, 1 de Julio del 2020, 10:00 AM',
                                                1,
                                                :p_descripcion,
                                                :p_doc_id_usuario,
                                                :p_doctor_id,
                                                :p_doc_id_paciente,
                                                :p_nombre_paciente,
                                                :p_apellidos_paciente,
                                                :p_edad_paciente,
                                                :p_sexo_paciente,
                                                :p_ciudad_paciente,
                                                :p_estadoCivil_paciente,
                                                :p_ocupacion_paciente,
                                                :p_religion_paciente,
                                                :p_domicilio_paciente,
                                                :p_telefono_paciente,
                                                :p_personaResponsable_paciente,
                                                :p_telefonoResponsable_paciente
                                             );
 
 
 
 	
										update 
											horario_atencion 
										set estado = 0
										where 
											tabla='cita';
 
 
 update 
											fecha
										set
											estado = 'disponible'
										where
											hora = '10:30';
											
  select * from horario_Atencion
 select * from doctor;
  select * from cita
  drop table fecha
 update correlativo set numero = 0
                    	where tabla='historial_tratamiento';
						
 update correlativo set numero = 0
                    	where tabla='cita';
 
 select * from cita
 
 delete from cita;
 delete from paciente;
 (select * from f_generar_correlativo('cita') as nc)
 (select * from f_generar_correlativo('paciente') as nc)
 
 select * from fn_registrarCita_paciente(
	 
	 										    1,
												'Lunes 25 de Mayo',
												'11:00',
												'Holitas bebesitos2',
												'22224444',
												1,
	 											'48745488',
	 											'saoisnaosnaos',
	 											'saoisnaosnaos2',
	 											'20',
	 											'M',
	 											'Chiclayo',
	 											'S',
	 											'Programador',
	 											'Católico',
	 											'Lima-Chorrillos',
	 											'996585478',
	 											'Pepitos Torres',
	 											'985522447'
                                             );
select * from historial_tratamiento;
delete from historial_tratamiento;

CREATE OR REPLACE FUNCTION fn_registrarCita_historialTratamiento(
												p_tratamiento_id integer,
												p_cita_id integer,
	 										    p_historial_tratamiento_id integer,
												p_cod_pac integer,
												p_fecha character varying(50),
												p_hora character varying(50),
												p_descripcion character varying(2000)
											 )  RETURNS void AS   
 $$
 declare
 p_fecha_cita character varying(50) := (select fecha from cita where cita_id = p_cita_id);
 p_fec_hisTra character varying(50) := (select fecha from historial_tratamiento where fecha = p_fecha);
 p_historial_tratamiento_id_actual integer := (select historial_tratamiento_id from historial_tratamiento where fecha = p_fecha);

 begin
							if p_fecha_cita like p_fec_hisTra then
								update 
											historial_tratamiento
										set 
											fecha          = p_fecha,
											hora           = p_hora,
											descripcion    = p_descripcion, 
											paciente_id    = p_cod_pac, 
											tratamiento_id = p_tratamiento_id
										where
											historial_tratamiento_id = p_historial_tratamiento_id_actual;
							else
							
								insert into historial_tratamiento(historial_tratamiento_id, fecha, hora, descripcion, paciente_id, tratamiento_id)
								values(p_historial_tratamiento_id, p_fecha, p_hora, p_descripcion, p_cod_pac, p_tratamiento_id);
								
								update correlativo set numero = numero +1
                    					 where tabla='historial_tratamiento';
							end if;
								
								
											
										 
						
 end
 $$ language plpgsql;

delete from historial_tratamiento;

select * from fn_registrarUsuario(                    
                                        9,
                                        '22222224', 
                                        'maria',
                                        'Lurin', 
                                        '963215998', 
                                        'maria@hotmail.com', 
                                        3, 
                                        '123',
                                        'C',
                                        'A'
                                     );

select * from f_generar_correlativo('credenciales_acceso') as nc
-- función para que el usuario cliente pueda crear su cuenta
select * from correlativo;
update correlativo
set numero = 8
where tabla = 'usuario'

select * from usuario
									 
CREATE OR REPLACE FUNCTION fn_registrarUsuario(
												p_codigo_usuario integer, 
												p_doc_id character varying(20), 
												p_nombres character varying(50),
												p_direccion character varying(200), 
												p_telefono character varying(25), 
												p_email character varying(150), 
												p_cargo_id integer,	
												p_clave character(32),
												p_tipo char(1),
												p_estado char(1)
											 )  RETURNS void AS   
 $$
 declare
 -- p_estado_usuario character varying(50) := (select count(*) from usuario where doc_id = p_doc_id); -- 0 : usuario no existe, 1: usuario existe

 begin
							
								insert into usuario
								values(
										p_doc_id,
										p_nombres,
										'-',
										'-',
										p_email,
										p_cargo_id
									  );
								
								insert into credenciales_acceso
								values(
										p_codigo_usuario,
										(select md5(p_clave)),
										p_tipo,
										p_estado,
										(select now()),
										p_doc_id
									  );
								
								update correlativo set numero = numero +1
                    			where tabla='credenciales_acceso';
								
 end
 $$ language plpgsql;

-- actualizar los datos del usuario registrado
select * from usuario
CREATE OR REPLACE FUNCTION fn_editarUsuario
 								(
									p_codigo_usuario integer, 
									p_doc_id character varying(20), 
									p_nombres character varying(100),
									p_direccion character varying(200),
									p_telefono character varying(25), 
									p_email character varying(150), 
									p_cargo_id integer,	
									p_clave character(32),
									p_tipo char(1),
									p_estado char(1)
 								)RETURNS void AS
$$
declare
	
	-- codigo integer;
	
 begin
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
								
								
 
 
 end
 $$ language plpgsql;
-- función para registrar que usuario iniciarón sesión

CREATE OR REPLACE FUNCTION fn_insert_log_inicioseseion
											(
											p_email character varying(150),
											p_cargo character varying(50),
											p_tipo char(1),
											p_ip character varying(100)
											)returns void as
$$
declare
	p_doc_id character varying(20):= (select doc_id from usuario where email = p_email);
	p_nombres character varying(50):= (select nombrecompleto from usuario where email = p_email);
	--p_apellidos character varying(50):= (select apellidos from usuario where email = p_email);
	
	-- p_cargo_id int:= (select cargo_id from cargo where doc_id = p_doc_id);
	-- p_tipo char(1):= (select tipo from credenciales_acceso where email = p_email);
	
	p_fecha character varying(50)  := current_date;
	p_tiempo character varying(50) := current_time;
begin
							
							
							insert into log_inicioseseion
							values(p_doc_id, p_nombres,p_cargo,p_tipo,p_fecha,p_tiempo,p_ip);
end
$$ language plpgsql;

select * from log_inicioseseion

select * from fn_insert_log_inicioseseion(
                                                                        'cass@hotmail.com', 
                                                                        '3',
                                                                        'C', 
                                                                        '192.168.1.'
                                                                    );
select * from log_usuario				
-- función para registrar los log de usuario
CREATE OR REPLACE FUNCTION fn_insert_log_usuario
											(
											p_doc_id_log character varying(20), 
											p_nombres_log character varying(100),
											p_cargo_id_log int, 
											p_tipo_log char(1), 
											p_cod_usuario int,
											p_doc_id character varying(20), 
											p_nombres character varying(100),												
											p_direccion character varying(200), 
											p_telefono character varying(25), 
											p_email character varying(150), 
											p_cargo_id int,
											p_clave character varying(32),
											p_tipo char(1),
											p_estado char(1),
											p_tipo_operacion character varying(100),
											p_ip character varying(200)												
											)returns void as
$$
declare
	p_fecha character varying(50)  := current_date;
	p_tiempo character varying(50) := current_time;
begin
							
							-- if estado = 0 then
							
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
										
end
$$ language plpgsql;


select * from fn_insert_log_usuario
											(
											'45977448', 
											'Juan Benito casas',
											1, 
											'A', 
											14,
											'55555558', 
											'Betito Pastor',												
											'Jaén', 
											'998877445', 
											'Betito@hotmail.com', 
											3,
											'159',
											'C',
											'A',
											'registrar',
											'192.168.1.1'												
											);
-- 
select * from correlativo;
select * from credenciales_acceso;
select * from cargo;
select * from usuario

-- FUNCIÓN REGISTRAR el log de especialidad
CREATE OR REPLACE FUNCTION fn_insert_log_especialidad
											(
											p_doc_id_log character varying(20), 
											p_nombres_log character varying(100), 
											p_cargo_id_log int, 
											p_tipo_log char(1),
											p_tipo_operacion character varying(100),
											p_ip character varying(200),
											p_especialidad_id int,
											p_nombre_especialidad character varying(200)
											)returns void as
$$
declare
	p_fecha character varying(50)  := current_date;
	p_tiempo character varying(50) := current_time;
begin
							
							select * from log_especialidad
							
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
										
end
$$ language plpgsql;

select * from fn_insert_log_especialidad(
                                                                    '12345678',
                                                                    'bbbbbbbbbbbbbb',
                                                                     3,
                                                                    'A',
                                                                    'Registro',
                                                                    '192.168.1.1',
                                                                    1,
                                                                    'bbbbbbbbbbbbbbbbbb'
                                                                );
																
select * from log_especialidad
-- FUNCIÓN REGISTRAR el log de tratamiento
CREATE OR REPLACE FUNCTION fn_insert_log_tratamiento
											(
											p_doc_id_log character varying(20), 
											p_nombres_log character varying(100), 
											p_cargo_id_log int, 
											p_tipo_log char(1),
											p_tipo_operacion character varying(100),
											p_ip character varying(200),
											p_tratamiento_id int,
											p_nombre_tratamiento character varying(200)
											)returns void as
$$
declare
	p_fecha character varying(50)  := current_date;
	p_tiempo character varying(50) := current_time;
begin
							
							
							
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
										
end
$$ language plpgsql;

select * from log_tratamiento

select * from fn_insert_log_tratamiento
											(
											'45977448', 
											'Renzo', 
											3, 
											'A',
											'Registrar',
											'192.168.1.1',
											1,
											'Resfriado'
											);
											
-- FUNCIÓN REGISTRAR número de sesión por usuario
select * from fn_numSesion
											(
												'44444444'
											);
CREATE OR REPLACE FUNCTION fn_numSesion(p_doc_id character varying(20))returns void as
$$
declare
con int;
begin
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
end
$$ language plpgsql;
-- Función para eliminar un usuario
select * from fn_insert_log_usuario
                                    (
                                        '45977448', 
                                        'Juan Benito casas',
                                        1, 
                                        'A', 
                                        null,
                                        '77774444', 
                                        null,                                               
                                        null, 
                                        null, 
                                        null, 
                                        null,
                                        null,
                                        null,
                                        null,
                                        'delete',
                                        '192.168.1.1'
                                        
                                    );
									
CREATE OR REPLACE FUNCTION fn_eliminarUsuario(p_doc_id character varying(20))RETURNS void AS
 
 $$
 BEGIN
 						
				-- Eliminar credenciales_acceso
						delete from credenciales_acceso
						where doc_id = p_doc_id;
						
				-- Eliminar usuario
 						delete from usuario
						where doc_id = p_doc_id;
						
 end
 $$ language plpgsql;



select * from credenciales_acceso;
select * from usuario;

update correlativo
set numero = 11
where tabla = 'credenciales_acceso';

select * from f_generar_correlativo('credenciales_acceso') as nc




select md5('123')
								
								