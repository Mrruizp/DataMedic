Create database lachuspita;
-- drop database lachuspita;

CREATE TABLE correlativo
 (
	tabla character varying(100) not null,
	numero integer not null,
	CONSTRAINT pk_correlativo PRIMARY KEY (tabla)
 );

create table departamento
(
 dep_codDepartamento int,
 dep_nombre character varying(100) not null,
 constraint pk_departamento_dep_codDepartamento primary key(dep_codDepartamento)
);

create table provincia
(
 prov_codProvincia int,
 prov_nombre character varying(100) not null,
 dep_codDepartamento int,
 constraint pk_provincia_prov_codProvincia primary key(prov_codProvincia),
 constraint fk_provincia_dep_codDepartamento foreign key(dep_codDepartamento) references departamento
);

create table distrito
(
 dist_codDistrito int,
 dist_nombre character varying(100) not null,
 prov_codProvincia int,
 constraint pk_distrito_dis_codDistrito primary key(dist_codDistrito),
 constraint fk_distrito_prov_codProvincia foreign key(prov_codProvincia) references provincia
);

-- drop table user_cliente;
-- ALTER TABLE cliente RENAME TO user_cliente;
select * from user_cliente
create table user_cliente
(
 user_codCliente int,
 user_tipoDocumento character varying(50), -- DNI, carnet extrangería o RUC
 user_numDocumento character varying(50),
 user_nombre character varying(100),
 user_apellidos character varying(100),
 user_telefono_fijo character varying(20),
 user_telefono_celular character varying(20),
 user_fecha_nac character varying(100),
 user_direccion character varying(200),
  cl_razon_social character varying(200) not null,
 -- cl_departamento character varying() not null,
 -- cl_provincia character varying() not null,
 -- cl_distrito character varying() not null,
 user_correo character varying(200) unique,
 user_alias character varying(100),
 user_clave character varying(200),
 user_estado_sesion char(1),
 constraint pk_cliente_cl_codCliente primary key(user_codCliente),
 CONSTRAINT uni_email UNIQUE (user_correo)
);

create table empresa -- el cliente registra la empresa para que se le entregue factura.
(
 ep_codempresa_compPago int,
 ep_ruc character varying(20) not null,
 ep_razon_social character varying(200) not null,
 -- cl_departamento character varying() not null,
 -- cl_provincia character varying() not null,
 -- cl_distrito character varying() not null,
 ep_direccion character varying() not null,
 ep_telefono_fijo character varying(20) not null,
 ep_telefono_celular character varying(20) not null
);

create table comprobantePago
(
 cp_codComprobantePago int,
 cp_nombre character varying(100) not null
);

create table pedido
(
 p_codPedido int,
 p_fecha_pedido character varying(50) not null,
 p_hora_pedido character varying(20) not null,
 p_fecha_entrega character varying(50) not null,,
 p_rango_hora_entrega character varying(50) not null, -- el rango de entrega para el pedido
 p_gravado int,
 p_inafecto decimal not null,
 p_exonerado decimal not null,
 p_igv decimal not null,
 p_total decimal not null,
 p_estado character varying(100) not null,
 p_descripcion character varying(500) not null,
 cl_codCliente int,
 ep_codempresa_compPago int,
 cp_codComprobantePago int,
 constraint pk_pedido_p_codPedido primary key(p_codPedido),
 constraint fk_pedido_cl_codCliente foreign key(cl_codCliente) references (cliente),
 constraint fk_pedido_ep_codempresa_compPago foreign key(ep_codempresa_compPago) references empresa_compPago(),
 constraint fk_pedido_cp_codComprobantePago foreign key (cp_codComprobantePago) references comprobantePago()
);

create table producto
(
 codProducto int,
 descripcion,
 unidad_medida,
 contenido,
 stock_minimo,
 precio,
 moneda,
 perecible,
 tiempo_reposicion,

);

create table detalle_pedido
(
 dp_codDetalle_pedido int,
 dp_cant int,
 dp_precio decimal,
 dp_pago_cliente decimal,
 p_codPedido int,
 codProducto int,
 constraint fk_pedido_codDetalle_pedido foreign key(codDetalle_pedido) references cliente(),
 constraint fk_pedido_p_codPedido foreign key(p_codPedido) references pedido(p_codPedido),
 constraint fk_pedido_codProducto foreign key(codProducto) references producto(codProducto)
);
-- FUNCIONES
-- [1]
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

-- INSERT
 -- Correlativo
insert into correlativo(tabla, numero)
values('user_cliente',0);

-- CLIENTE

select * from correlativo;
select * from user_cliente;

delete from correlativo;
delete from user_cliente;

insert into cliente
values
	(
	 1,
	 'DNI',
	 '45977448',
	 'Ana Paula',
	 'Saso',
	 '-',
	 '9945033750',
	 '14/08/2020',
	 'Av.Guardía cicil #953',
	 '-',
	 'ana_paula@hotmail.com',
	 'a.Paula',
	 '202cb962ac59075b964b07152d234b70',
	 'A'
	);

-- insert into: departamento, provincia, distrito
insert into departamento
values(1, 'Lima');
insert into provincia
values(1, 'Lima', 1);
insert into distrito
values(1, 'San Borja', 1);
insert into distrito
values(2, 'Chorrillos', 1);
insert into distrito
values(3, 'Santiago de Surco', 1);
insert into distrito
values(4, 'La Molina', 1);
insert into distrito
values(5, 'Surquillo', 1);
