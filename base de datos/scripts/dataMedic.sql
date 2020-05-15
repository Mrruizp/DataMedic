CREATE DATABASE dataMedic;

CREATE TABLE cargo
(
  cargo_id serial not NULL,
  descripcion character varying(50) NOT NULL,
  CONSTRAINT pk_cargo PRIMARY KEY (cargo_id)
);

CREATE TABLE correlativo
 (
	tabla character varying(100) not null,
	numero integer not null,
	CONSTRAINT pk_correlativo PRIMARY KEY (tabla)
 );

CREATE TABLE USUARIO
(
	doc_id character varying(20) null,
    nombreCompleto character varying(100) not null,
	direccion character varying(200) not null,
    telefono character varying(25) null,
   -- sexo char(1) not null, -- Mujer: 0, Hombre: 1 
   -- edad char(2) not null,
    email character varying(150) not null,
    cargo_id integer,
    constraint pk_usuario_doc_id primary key(doc_id),
    constraint fk_usuario_cargo_id foreign key(cargo_id) references cargo(cargo_id),
	CONSTRAINT uni_email UNIQUE (email)
);

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

CREATE TABLE especialidad
(
  especialidad_id integer not NULL,
  nombre_especialidad character varying(200)not null,
  CONSTRAINT pk_especialidad_especialidad_id PRIMARY KEY (especialidad_id)
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
  especialidad_id int,
  CONSTRAINT pk_doctor_doctor_id PRIMARY KEY (doctor_id),
  CONSTRAINT fk_doctor_especialidad_id foreign key (especialidad_id) references especialidad(especialidad_id)	
);

CREATE TABLE cita
(
  cita_id integer not NULL,
  fecha character varying(50)not null,
  hora character varying(50) not NULL,
  descripcion character varying(500) not NULL,
  doc_id character varying(20),
  doctor_id int,
  CONSTRAINT pk_cita_cita_id PRIMARY KEY (cita_id),
  CONSTRAINT fk_cita_doc_id foreign key (doc_id) references usuario(doc_id),
  CONSTRAINT fk_cita_doctor_id foreign key (doctor_id) references doctor(doctor_id)
);
-- select * from paciente
CREATE TABLE paciente
(
  paciente_id integer not NULL,
  doc_id character varying(20) null,
  nombre character varying(100) not NULL,
  apellido_paterno character varying(100) not NULL,
  apellido_materno character varying(100) not NULL,
  edad character varying(3) not NULL,
  sexo char(1)not null,
  raza char(1)not null,
  naturalde character varying(100) not NULL,
  procedencia character varying(100) not NULL,
  estado_civil char(1) not null,
  ocupacion character varying(200) not NULL,
  instruccion character varying(200) not NULL,
  religion character varying(100) not NULL,
  domicilio character varying(200) not NULL,
  telefono character varying(20) not NULL,
  personaresponsable character varying(100) not NULL,
  personaresponsable_telefono character varying(20) not NULL,
  fecha_ingreso character varying(50) not NULL,
  hora character varying(20) not NULL,
  modoingreso character varying(50) not NULL,
  fecha_historia_clinica character varying(50) not NULL,
  descripcion_enfermedad_actual character varying(1000) not NULL,
  CONSTRAINT pk_paciente_paciente_id PRIMARY KEY(paciente_id)
);
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

drop table fecha;

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
insert into correlativo
values('cita',1); 
insert into correlativo
values('usuario',0); 
insert into correlativo
values('doctor',0); 

insert into correlativo
values('paciente',0); 
insert into correlativo
values('costo',0); 
insert into correlativo
values('tratamiento',0); 
insert into correlativo
values('historial_tratamiento',0);
insert into correlativo
values('historial_tratamiento',5); 

 -- Registros   select * from menu
 -- Menú
insert into menu(codigo_menu,nombre)
values(1,'Inicio'); 
insert into menu(codigo_menu,nombre)
values(2,'Agenda'); 
insert into menu(codigo_menu,nombre)
values(3,'Historia Clínica');
insert into menu(codigo_menu,nombre)
values(4,'Presupuesto');

-- cargo

select * from cargo
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
values(3,1,'Gestionar datos Paciente', 'gestionarPaciente.view.php');
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
-- select * from menu_item_accesos

insert into usuario(doc_id,nombrecompleto, direccion, telefono,email,cargo_id)
values('45977448','Juan Benito casas','Av. Guardia Civil, urb. Proceres #4456. Surco','996456547','juanBenito@hotmail.com',1);

-- Credenciales de acceso
-- select * from menu_item

insert into credenciales_acceso(codigo_usuario,clave,tipo,estado,fecha_registro, doc_id)
values(1,(select MD5('123')),'A','A',(select now()),'45977448');

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
values(1,'CMP','123456','Andres','Hurtado','Lima-Surco','998745418','andresHurtado@hotmail.com',1);

select * from fecha

insert into cita
values(1,'Lunes, 25 Mayo','9:00 am', '-------','45977448',1);
insert into cita
values(2,'Miércoles, 27 Mayo','9:30 am', '-------','45977448',1);
insert into cita
values(3,'Viernes, 29 Mayo','10:00 am', '-------','45977448',1);

select 
	fecha_id,
	concat(mes, ', ',dia_semana, ' ',numero, ', ',hora)as fecha
from 
	fecha
where
                        estado = 'disponible';
--
-- insert fecha

insert into fecha
values(1,'Mayo','Lunes','25','9:00','disponible');

insert into fecha
values(2,'Mayo','Lunes','25','9:30','disponible');

insert into fecha
values(3,'Mayo','Lunes','25','10:00','disponible');

insert into fecha
values(4,'Mayo','Lunes','25','10:30','no disponible');

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

select * from menu;

select 
                        c.cita_id,
                        c.fecha,
                        c.hora,
                        c.descripcion,
                        u.nombrecompleto,
                        concat(nombre, ' ',apellido) as nombresdoctor
                    from 
                        cita c inner join doctor d
                    on
                        c.doctor_id = d.doctor_id inner join usuario u
                    on
                        c.doc_id = u.doc_id 