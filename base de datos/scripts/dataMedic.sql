CREATE DATABASE dataMedic

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




select * from menu_item;


select 
                            u.doc_id,
                            u.nombreCompleto,
                            u.direccion,
                            u.telefono,
                            r.clave,                            
                            r.estado,
                            r.codigo_usuario,                           
                            c.descripcion as cargo,
                            c.cargo_id,
                            r.tipo
                    from
                            cargo c inner join usuario u 
                    on 
                            (c.cargo_id = u.cargo_id) inner join credenciales_acceso r
                    on
                            (r.doc_id = u.doc_id) 
                    where
                            u.email = 'juanBenito@hotmail.com' 