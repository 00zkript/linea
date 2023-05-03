

-- Matricula Natacion

--sistema para un escuela de natación/ GyM/ Tienda





create table cliente (
    idcliente int not null auto_increment PRIMARY KEY,
    codigo varchar(50),
    nombres varchar(250),
    apellidos varchar(250),
    idtipo_documento_identidad int,
    numero_documento_identidad varchar(20),
    imagen text,
    sexo varchar(50),
    estado tinyint(1) default '0'
);


create table tipo_empleado (
    idtipo_empleado int not null auto_increment PRIMARY KEY,
    nombre varchar(250),
    slug varchar(250),
    imagen text,
    descripcion text,
    estado tinyint(1) default '0'
);


create table empleado (
    idempleado int not null auto_increment PRIMARY KEY,
    codigo varchar(50),
    nombres varchar(250),
    apellidos varchar(250),
    idtipo_documento_identidad int,
    numero_documento_identidad varchar(20),
    imagen text,
    fecha_ingreso datetime,
    fecha_culminacion datetime,
    idtipo_empleado int,
    sexo varchar(50),
    create_at TIMESTAMP,
    estado tinyint(1) default '0'
);




create table modalidad (
    idmodalidad int not null auto_increment PRIMARY KEY,
    nombre varchar(250),
    slug varchar(250),
    descripcion text,
    estado tinyint(1) default '0'
);




create table metodo_pago (
    idmetodo_pago int not null auto_increment PRIMARY KEY,
    nombre varchar(250),
    slug varchar(250),
    descripcion text,
    estado tinyint(1) default '0'
);





create table curso (
    idcurso int not null auto_increment PRIMARY KEY,
    nombre varchar(250),
    slug varchar(250),
    descripcion text,
    contenido text,
    imagen text,
    idmodalidad int,
    fecha_inicio datetime,
    fecha_f datetime,
    idempleado int,
    monto_total DECIMAL(11,2),
    idsucursal int,
    create_at TIMESTAMP,
    estado tinyint(1) default '0'
);



create table sucursal (
    idsucursal int not null auto_increment PRIMARY KEY,
    nombre varchar(250),
    slug varchar(250),
    direccion text,
    horario_atencion text,
    imagen text,
    descripcion text,
    contenido text,
    estado tinyint(1) default '0'
);



create table matricula_curso (
    idmatricula_curso int not null auto_increment PRIMARY KEY,
    idcliente int,
    idsucursal int,
    idcurso int,
    idempleado int,
    monto_inicial decimal(11,2),
    metodo_pago_id2 int,
    idmodalidad int,
    curso_monto_total decimal(11,2),
    curso_fecha_inicio datetime,
    curso_fecha_f datetime,
    cuota_cantidad INT,
    cuota_monto DECIMAL(11,2),
    create_at TIMESTAMP,
    estado tinyint(1) default '0'
);




create table cliente_cuotas (
    idcliente_cuotas int not null auto_increment PRIMARY KEY,
    idmatricula int,
    idcliente int,
    cuaota_cantidad int,
    cuaota_numero int,
    cuaota_monto decimal(11,2),
    metodo_pago_id2 int,
    fecha_pago datetime,
    idestado_pago int, tinyint(1) default '0'
    estado tinyint(1) default '0'
);




create table tipo_entrenamiento (
    idtipo_entrenamiento int not null auto_increment PRIMARY KEY,
    codigo varchar(50),
    nombre varchar(250),
    slug varchar(250),
    descripcion text,
    tipo varchar(250),
    fecha_inicio datetime,
    fecha_f datetime,
    idempleado int,
    idmodalidad int,
    costo total DECIMAL(11,2),
    create_at TIMESTAMP,
    estado tinyint(1) default '0'
);



create table inscripcion (
    idinscripcion int not null auto_increment PRIMARY KEY,
    idcliente int,
    idtipo_entrenamiento int,
    idmodalidad int,
    tipo_entrenamiento_fecha_inicio datetime,
    tipo_entrenamiento_fecha_f datetime,
    tipo_entrenamiento_monto_total datetime,
    cuotas_cantidad int,
    monto_inicial decimal(11,2),
    metodo_pago_id2 int,
    estado tinyint(1) default '0'
);


create table tipo_producto (
    idtipo_producto int not null auto_increment PRIMARY KEY,
    nombre varchar(250),
    slug varchar(250),
    descripcion text,
    estado tinyint(1) default '0'
);


create table producto (
    idproducto int not null auto_increment PRIMARY KEY,
    codigo varchar(50),
    nombre varchar(250),
    slug varchar(250),
    descripcion text,
    precio_unitario decimal(11,2),
    precio_lista decimal(11,2),
    stock INT,
    idtipo_producto int,
    estado tinyint(1) default '0'
);

create table estado_pago (
    idestado_pago int not null auto_increment PRIMARY KEY,
    nombre varchar(250),
    slug varchar(250),
    descripcion text,
    estado tinyint(1) default '0'
);

create table venta (
    idventa int not null auto_increment PRIMARY KEY,
    idcliente int,
    idempleado int,
    idestado_pago int,
    fecha_pago datetime,
    total decimal(11,2),
    estado tinyint(1) default '0'
);

create table venta_detalle (
    idventa_detalle int not null auto_increment PRIMARY KEY,
    idventa int,
    idproducto int,
    precio_unitario decimal(11,2),
    cantidad INT,
    monto_total decimal(11,2),
    estado tinyint(1) default '0'
);













































empleadoa cargode la matricula
    busca cliente
    crea cliente
    crea matricula


cajero
    busca matricula
    realiza cobro
    imprime ticket



pisciona ('grande', 'mediana', 'pequeña')
concepto ('nueva matricula')
temporada ('verano' <se calcula de enero-junio>, 'invierno' <junio-diciembre>)
    abre programa

programa ('para adultos', 'para niños')

cantidad de sessiones
    id
    nombre
    cantidad
    precio

horario ('L-M-V', 'M-J-S', 'S-D')


matricula
    codigo
    idcliente
    idempleado
    fecha_matricula
    concepto
    idpiscina
    idconcepto
    idtemporada
    idprograma
    idqty_session
    idhorario




