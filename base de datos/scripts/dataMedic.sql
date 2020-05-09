CREATE DATABASE dataMedic

CREATE TABLE cargo
(
  cargo_id serial not NULL,
  descripcion character varying(50) NOT NULL,
  CONSTRAINT pk_cargo PRIMARY KEY (cargo_id)
);

drop table USUARIO;

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
    constraint pk_usuario_email primary key(email),
    constraint fk_usuario_cargo_id foreign key(cargo_id) references cargo(cargo_id),
	CONSTRAINT uni_email UNIQUE (email)
);

-- select * from CREDENCIALES_ACCESO
CREATE TABLE CREDENCIALES_ACCESO
 ( 	
	codigo_usuario integer not null,
	clave character(32) not NULL,
	tipo char(1) not null, -- Amin: A, Docente: D, Estudiante: E
   -- p_foto bytea,
	estado char(1),
    fecha_registro varchar(50),
    email character varying(150),
    CONSTRAINT pk_codigo_usuario PRIMARY KEY (codigo_usuario),
    CONSTRAINT fk_usuario_email foreign key(email) references 
    USUARIO(email)
    
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

--  Menú item
-- select * from menu_item

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(1,1,'Inicio', 'menu.principal.view.php');

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(2,2,'ver Cita', 'cita.view.php');
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(2,3,'Gestionar Cita', 'gestionarCita.view.php');

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(3,4,'Gestionar datos Paciente', 'gestionarPaciente.view.php');
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(4,4,'Gestionar Tratamiento', 'gestionarTratamiento.view.php');
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(3,5,'Gestionar Presupuesto', 'gestionarPresupuesto.view.php');
