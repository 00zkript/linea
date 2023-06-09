-- Active: 1653431546013@@127.0.0.1@3306@linea



DROP TABLE IF EXISTS empresa;

CREATE TABLE empresa (
  idempresa int(10) unsigned NOT NULL AUTO_INCREMENT,
  nombre varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  ruc varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  igv decimal(11,2) DEFAULT '0.00',
  idmoneda int(11) DEFAULT NULL,
  logo text COLLATE utf8mb4_unicode_ci,
  favicon text COLLATE utf8mb4_unicode_ci,
  cuenta_bancaria text COLLATE utf8mb4_unicode_ci,
  logo2 text COLLATE utf8mb4_unicode_ci,
  informacion_adicional text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (idempresa)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
insert  into empresa
    (idempresa,nombre,ruc,igv,idmoneda,logo,favicon,cuenta_bancaria,logo2,informacion_adicional)
values
    (1,'Linea',NULL,18.00,2,'sR2ilq3B0sC3VbHNSNKyGW7kLBZQWWZYrCwdgI8h.png','kjviaNy5TLlo3EhUJq6iaq53I0pORxMvk2kFkthE.png',NULL,NULL,NULL);




DROP TABLE IF EXISTS moneda;

CREATE TABLE moneda (
  idmoneda int(10) unsigned NOT NULL AUTO_INCREMENT,
  nombre varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  moneda varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  simbolo varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  simbolo_posicion enum('LEFT','RIGHT') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  cambio decimal(10,4) DEFAULT NULL,
  estado tinyint(1) DEFAULT '0',
  PRIMARY KEY (idmoneda)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table moneda */

insert  into moneda(idmoneda,nombre,moneda,simbolo,simbolo_posicion,cambio,estado) values (1,'DOLARES','USD','$',NULL,1.0000,1);
insert  into moneda(idmoneda,nombre,moneda,simbolo,simbolo_posicion,cambio,estado) values (2,'SOLES','PEN','S/',NULL,1.0000,1);



DROP TABLE IF EXISTS tipo_documento_identidad;

CREATE TABLE tipo_documento_identidad (
  idtipo_documento_identidad int(10) unsigned NOT NULL AUTO_INCREMENT,
  nombre varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  estado tinyint(1) DEFAULT NULL,
  orden int(11) DEFAULT NULL,
  PRIMARY KEY (idtipo_documento_identidad)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


insert  into tipo_documento_identidad(idtipo_documento_identidad,nombre,estado,orden) values (1,'DNI',1,1);
insert  into tipo_documento_identidad(idtipo_documento_identidad,nombre,estado,orden) values (2,'CARNET DE EXTRANJERIA',1,2);
insert  into tipo_documento_identidad(idtipo_documento_identidad,nombre,estado,orden) values (3,'RUC',1,3);
insert  into tipo_documento_identidad(idtipo_documento_identidad,nombre,estado,orden) values (4,'PASAPORTE',1,4);





DROP TABLE IF EXISTS ubigeo_departamento;

CREATE TABLE ubigeo_departamento (
  iddepartamento int(10) unsigned NOT NULL AUTO_INCREMENT,
  nombre varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  estado tinyint(1) DEFAULT '0',
  PRIMARY KEY (iddepartamento)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS ubigeo_provincia;

CREATE TABLE ubigeo_provincia (
  idprovincia int(10) unsigned NOT NULL AUTO_INCREMENT,
  iddepartamento int(11) NOT NULL,
  nombre varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  estado tinyint(1) DEFAULT '0',
  PRIMARY KEY (idprovincia)
) ENGINE=InnoDB AUTO_INCREMENT=2505 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS ubigeo_distrito;

CREATE TABLE ubigeo_distrito (
  iddistrito int(10) unsigned NOT NULL AUTO_INCREMENT,
  iddepartamento int(11) DEFAULT NULL,
  idprovincia int(11) DEFAULT NULL,
  nombre varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  estado tinyint(1) DEFAULT '0',
  PRIMARY KEY (iddistrito)
) ENGINE=InnoDB AUTO_INCREMENT=250402 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;








drop table if exists usuario;
CREATE TABLE usuario (
  idusuario int(10) unsigned NOT NULL AUTO_INCREMENT,
  idrol int(11) NOT NULL,
  usuario varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  clave text COLLATE utf8mb4_unicode_ci NOT NULL,
  correo varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  nombres varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  apellidos varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  foto text COLLATE utf8mb4_unicode_ci,
  creado datetime DEFAULT NULL,
  actualizado datetime DEFAULT NULL,
  estado tinyint(1) DEFAULT '0',
  PRIMARY KEY (idusuario),
  UNIQUE KEY correo (correo)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
insert  into usuario(idusuario,idrol,usuario,clave,correo,nombres,apellidos,foto,creado,actualizado,estado) values (1,1,'admin','eyJpdiI6IkxHSGVhQlNTKytBMHpwXC9Ed29cL0dadz09IiwidmFsdWUiOiJWRFlQcmNmVlwvNXZRek0xVnJBMW13VzRqV2ZPTEJiVGxKY1hTcU5RdXJvcz0iLCJtYWMiOiI0NWQ1ODEwMTMwNTUzZDlmYjJmMGM2YWIzY2MwMGY0ODI1NTZhZDExMmRhMTBmOWVjYmViNWEwZTY2NjAzMWJmIn0=','admin@example.com','Admin',NULL,NULL,'2023-04-30 02:48:11','2023-04-30 02:48:11',1);

DROP TABLE IF EXISTS usuario_has_role;
create table usuario_has_role (
    idusuario_has_role int not null auto_increment primary key,
    idusuario int,
    idrol int
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



drop table if exists roles;
CREATE TABLE roles (
  id int unsigned NOT NULL AUTO_INCREMENT ,
  name varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  guard_name varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY roles_name_guard_name_unique (name,guard_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


drop table if exists permissions;
CREATE TABLE permissions (
  id int unsigned NOT NULL AUTO_INCREMENT,
  name varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  guard_name varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY permissions_name_guard_name_unique (name,guard_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



drop table if exists role_has_permissions;
CREATE TABLE role_has_permissions (
  permission_id int unsigned NOT NULL,
  role_id int unsigned NOT NULL,
  PRIMARY KEY (permission_id,role_id),
  KEY role_has_permissions_role_id_foreign (role_id),
  CONSTRAINT role_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES permissions (id) ON DELETE CASCADE,
  CONSTRAINT role_has_permissions_role_id_foreign FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;








drop table if exists tipo_empleado;
create table tipo_empleado (
    idtipo_empleado int not null auto_increment PRIMARY KEY,
    nombre VARCHAR(250),
    slug VARCHAR(250),
    imagen text,
    descripcion text,
    estado TINYINT(1) DEFAULT '1'
);

insert into tipo_empleado
    ( idtipo_empleado, nombre, slug, imagen, descripcion, estado )
values
    ( 1, 'Administrador', 'administrador', 'administrador.png', 'Administrador del sistema', 1 ),
    ( 2, 'Gerente', 'gerente', 'gerente.png', 'Gerente del sistema', 1 ),
    ( 3, 'Empleado', 'empleado', 'empleado.png', 'Empleado del sistema', 1 );


drop table if exists empleado;
create table empleado (
    idempleado int not null auto_increment PRIMARY KEY,
    codigo varchar(50),
    nombres VARCHAR(250),
    apellidos varchar(250),
    idtipo_documento_identidad int,
    numero_documento_identidad varchar(20),
    imagen text,
    fecha_ingreso date,
    fecha_culminacion date,
    idtipo_empleado int,
    sexo varchar(50),
    telefono varchar(50),
    correo varchar(250),
    estado TINYINT(1) DEFAULT '1',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);


drop table if exists cliente;
CREATE TABLE cliente (
  idcliente int(10) NOT NULL AUTO_INCREMENT,
  codigo varchar(50),
  nombres varchar(250),
  apellidos varchar(250),
  correo varchar(250),
  telefono varchar(15),
  idtipo_documento_identidad int(11),
  numero_documento_identidad varchar(15),
  sexo varchar(50),
  fecha_nacimiento date,
  iddepartamento int(11),
  idprovincia int(11),
  iddistrito int(11),
  direccion text,
  referencia text,
  nota text,
  imagen text,
  created_at TIMESTAMP,
  updated_at TIMESTAMP,
  estado tinyint(1) DEFAULT '0',
  PRIMARY KEY (idcliente)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;











DROP TABLE IF EXISTS piscina;
create table piscina (
    idpiscina int not null auto_increment primary key,
    nombre VARCHAR(250),
    slug VARCHAR(250),
    estado TINYINT(1) DEFAULT '1',
    created_at TIMESTAMP
);
insert into piscina (idpiscina, nombre, slug, estado) VALUES
    (1, 'Piscina grande', 'piscina-grande', 1),
    (2, 'Piscina mediana', 'piscina-mediana', 1),
    (3, 'Piscina pequeña', 'piscina-pequena', 1);




DROP TABLE IF EXISTS carril;
create table carril (
    idcarril int not null auto_increment primary key,
    idpiscina int,
    nombre VARCHAR(250),
    slug VARCHAR(250),
    capacidad_maxima int,
    estado TINYINT(1) DEFAULT '1',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
insert into carril
    (idcarril, idpiscina, nombre, slug, capacidad_maxima, estado)
VALUES
    ( 1, 1, 'Carril 1', 'carril-1', 4, 1),
    ( 2, 1, 'Carril 2', 'carril-2', 4, 1),
    ( 3, 1, 'Carril 3', 'carril-3', 4, 1),
    ( 4, 1, 'Carril 4', 'carril-4', 4, 1),
    ( 5, 1, 'Carril 5', 'carril-5', 4, 1),
    ( 6, 1, 'Carril 6', 'carril-6', 4, 1),
    ( 7, 1, 'Carril 7', 'carril-7', 4, 1),
    ( 8, 1, 'Carril 8', 'carril-8', 4, 1),
    ( 9, 2, 'Carril 1', 'carril-1', 4, 1),
    ( 10, 2, 'Carril 2', 'carril-2', 4, 1),
    ( 11, 2, 'Carril 3', 'carril-3', 4, 1),
    ( 12, 2, 'Carril 4', 'carril-4', 4, 1),
    ( 13, 3, 'Carril 1', 'carril-1', 4, 1),
    ( 14, 3, 'Carril 2', 'carril-2', 4, 1);




DROP TABLE IF EXISTS concepto;
create table concepto (
    idconcepto int not null auto_increment primary key,
    nombre VARCHAR(250),
    estado TINYINT(1) DEFAULT '1',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

INSERT concepto
    (idconcepto, nombre, estado)
VALUES
    (1, 'Nueva Matricula', 1);


DROP TABLE IF EXISTS temporada;
create table temporada (
    idtemporada int not null auto_increment primary key,
    nombre VARCHAR(250),
    slug VARCHAR(250),
    fecha_desde datetime,
    fecha_hasta datetime,
    estado TINYINT(1) DEFAULT '1',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

INSERT INTO temporada
    (idtemporada, nombre, slug, fecha_desde, fecha_hasta, estado)
VALUES
    (1, 'Temporada verano', 'temporada-verano', '2021-09-01', '2021-12-31', 1),
    (2, 'Temporada invierno', 'temporada-invierno', '2021-01-01', '2021-06-30', 1);



DROP TABLE IF EXISTS programa;
create table programa (
    idprograma int not null auto_increment primary key,
    idtemporada int,
    nombre VARCHAR(250),
    slug VARCHAR(250),
    estado TINYINT(1) DEFAULT '1',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
insert into programa
    (idprograma, idtemporada, nombre, slug, estado)
values
    (1, 1, 'para adultos', 'para-adultos', 1),
    (2, 1, 'para niños', 'para-ninos', 1);




DROP TABLE IF EXISTS cantidad_sesiones;
create table cantidad_sesiones (
    idcantidad_sesiones int not null auto_increment primary key,
    nombre VARCHAR(250),
    slug VARCHAR(250),
    cantidad INT,
    precio DECIMAL(11,2),
    estado TINYINT(1) DEFAULT '1',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
insert into cantidad_sesiones
    (idcantidad_sesiones, nombre, slug, cantidad, precio, estado)
values
    (1, '3 sessiones x 150 so', '3-sessiones-x-150-so', 3, 150, 1),
    (2, '6 sessions x 300 so', '6-sessions-x-300-so', 6, 300, 1),
    (3, '9 sessions x 450 so', '9-sessions-x-450-so', 9, 450, 1);


DROP TABLE IF EXISTS dia;
create table dia (
    iddia int not null auto_increment primary key,
    nombre VARCHAR(250),
    slug VARCHAR(250),
    estado TINYINT(1) DEFAULT '1'
);


insert into dia
    (iddia, nombre, slug, estado)
VALUES
    (1, 'Lunes', 'lunes', 1),
    (2, 'Martes', 'martes', 1),
    (3, 'Miercoles', 'miercoles', 1),
    (4, 'Jueves', 'jueves', 1),
    (5, 'Viernes', 'viernes', 1),
    (6, 'Sabado', 'sabado', 1),
    (7, 'Domingo', 'domingo', 1);



DROP TABLE IF EXISTS actividad_semanal;
create table actividad_semanal (
    idactividad_semanal int not null auto_increment primary key,
    nombre VARCHAR(250),
    slug VARCHAR(250),
    estado TINYINT(1) DEFAULT '1',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

insert into actividad_semanal
    (idactividad_semanal, nombre, slug, estado)
VALUES
    (1, 'L-M-V', 'l-m-v', 1),
    (2, 'M-J-S', 'm-j-s', 1),
    (3, 'S-D', 's-d', 1);



DROP TABLE IF EXISTS actividad_semanal_has_dia;
create table actividad_semanal_has_dia (
    idactividad_semanal_has_dia int not null auto_increment primary key,
    idactividad_semanal int,
    iddia int
);

insert into actividad_semanal_has_dia
    ( idactividad_semanal, iddia )
values
    ( 1, 1 ),
    ( 1, 3 ),
    ( 1, 5 ),
    ( 2, 2 ),
    ( 2, 4 ),
    ( 2, 6 ),
    ( 3, 6 ),
    ( 3, 7 );





DROP TABLE IF EXISTS horario;
create table horario (
    idhorario int not null auto_increment primary key,
    nombre VARCHAR(250),
    slug VARCHAR(250),
    estado TINYINT(1) DEFAULT '1',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
insert into horario
    (idhorario, nombre, slug, estado)
VALUES
    (1, '07:00 am - 08:00 am', '07-00-am-08-00-am', 1),
    (2, '08:00 am - 09:00 am', '08-00-am-09-00-am', 1),
    (3, '09:00 am - 10:00 am', '09-00-am-10-00-am', 1),
    (4, '10:00 am - 11:00 am', '10-00-am-11-00-am', 1),
    (5, '11:00 am - 12:00 pm', '11-00-am-12-00-pm', 1),
    (6, '12:00 pm - 01:00 pm', '12-00-pm-01-00-pm', 1),
    (7, '01:00 pm - 02:00 pm', '01-00-pm-02-00-pm', 1),
    (8, '02:00 pm - 03:00 pm', '02-00-pm-03-00-pm', 1),
    (9, '03:00 pm - 04:00 pm', '03-00-pm-04-00-pm', 1),
    (10, '04:00 pm - 05:00 pm', '04-00-pm-05-00-pm', 1),
    (11, '05:00 pm - 06:00 pm', '05-00-pm-06-00-pm', 1);




DROP TABLE IF EXISTS sucursal;
create table sucursal (
    idsucursal int not null auto_increment primary key,
    nombre VARCHAR(250),
    slug VARCHAR(250),
    descripcion text,
    contenido text,
    direccion text,
    iddepartamento int,
    idprovincia int,
    iddistrito int,
    imagen text,
    horario_atencion text,
    estado TINYINT(1) DEFAULT '1',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);


DROP TABLE IF EXISTS matricula;
create table matricula (
    idmatricula int not null auto_increment primary key,
    codigo VARCHAR(100),
    idsucursal int,
    sucursal_nombre VARCHAR(250),
    sucursal_direccion text,
    idcliente INT,
    cliente_nombres VARCHAR(250),
    cliente_apellidos VARCHAR(250),
    cliente_tipo_documento_identidad INT,
    cliente_numero_documento_identidad VARCHAR(250),
    idempleado int,
    empleado_nombres VARCHAR(250),
    empleado_apellidos VARCHAR(250),
    empleado_idtipo_documento_identidad INT,
    empleado_numero_documento_identidad VARCHAR(250),
    fecha_inicio DATE,
    fecha_fin DATE,
    idconcepto int,
    idtemporada int,
    temporada_nombre VARCHAR(250),
    idprograma int,
    programa_nombre VARCHAR(250),
    idcantidad_sesiones int,
    cantidad_sesiones_nombre VARCHAR(250),
    cantidad_sesiones_cantidad int,
    idactividad_semanal int,
    actividad_semanal_nombre VARCHAR(250),
    idpiscina int,
    idcarril int,
    monto_total DECIMAL(11,2),
    estado TINYINT(1) DEFAULT '1',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);


DROP TABLE IF EXISTS matricula_detalle;
create table matricula_detalle (
    idmatricula_detalle int not null auto_increment primary key,
    idmatricula int,
    idhorario int,
    iddia int,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);



DROP TABLE IF EXISTS record_asistencia;
create table record_asistencia (
    idrecord_asistencia int not null auto_increment primary key,
    idsucursal int,
    idempleado int,
    idcliente int,
    idactividad_semanal int,
    idhorario int,
    estado TINYINT(1) DEFAULT '1',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);


DROP TABLE IF EXISTS pago_cliente;
create table pago_cliente (
    idpago_cliente int not null auto_increment primary key,
    idmatricula int,
    idconcepto int,
    idcliente int,
    idcaj0a int,
    idempleado int,
    empleado_nombres VARCHAR(250),
    empleado_apellidos VARCHAR(250),
    empleado_idtipo_documento_identidad int,
    empleado_numero_documento_identidad VARCHAR(250),
    idtipo_pago int,
    idmodo_pago int,
    idestado_pago int,
    idmoneda int,
    moneda_nombre VARCHAR(250),
    moneda_simbolo VARCHAR(250),
    moneda_cambio DECIMAL(11,2),
    monto_total DECIMAL(11,2),
    monto_efectivo DECIMAL(11,2),
    monto_tranferencia DECIMAL(11,2),
    monto_pago DECIMAL(11,2),
    estado TINYINT(1) DEFAULT '1',
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);







DROP TABLE IF EXISTS caja;
create table caja (
    idcaja int not null auto_increment primary key,
    nombre VARCHAR(250),
    slug VARCHAR(250),
    idsucursal int,
    idmoneda int,
    moneda_cambio DECIMAL(11,2),
    monto_inicial DECIMAL(11,2),
    monto_actual DECIMAL(11,2),
    monto_final DECIMAL(11,2),
    fecha DATE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);



drop table if exists currency_change_over_time;
CREATE TABLE currency_change_over_time (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idmoneda INT,
    moneda_simbolo VARCHAR(10),
    moneda_cambio DECIMAL(11,2),
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);





alter table usuario add column idempleado int;
select * from usuario ;
select * from empleado ;





