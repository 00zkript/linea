/*
SQLyog Ultimate
MySQL - 5.7.24 : Database - linea
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `actividad_semanal` */

DROP TABLE IF EXISTS `actividad_semanal`;

CREATE TABLE `actividad_semanal` (
  `idactividad_semanal` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idactividad_semanal`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `actividad_semanal` */

insert  into `actividad_semanal`(`idactividad_semanal`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (1,'L-M-V','l-m-v',1,NULL,NULL);
insert  into `actividad_semanal`(`idactividad_semanal`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (2,'M-J-S','m-j-s',1,NULL,NULL);
insert  into `actividad_semanal`(`idactividad_semanal`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (3,'S-D','s-d',1,NULL,NULL);

/*Table structure for table `actividad_semanal_has_dia` */

DROP TABLE IF EXISTS `actividad_semanal_has_dia`;

CREATE TABLE `actividad_semanal_has_dia` (
  `idactividad_semanal_has_dia` int(11) NOT NULL AUTO_INCREMENT,
  `idactividad_semanal` int(11) DEFAULT NULL,
  `iddia` int(11) DEFAULT NULL,
  PRIMARY KEY (`idactividad_semanal_has_dia`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `actividad_semanal_has_dia` */

insert  into `actividad_semanal_has_dia`(`idactividad_semanal_has_dia`,`idactividad_semanal`,`iddia`) values (1,1,1);
insert  into `actividad_semanal_has_dia`(`idactividad_semanal_has_dia`,`idactividad_semanal`,`iddia`) values (2,1,3);
insert  into `actividad_semanal_has_dia`(`idactividad_semanal_has_dia`,`idactividad_semanal`,`iddia`) values (3,1,5);
insert  into `actividad_semanal_has_dia`(`idactividad_semanal_has_dia`,`idactividad_semanal`,`iddia`) values (4,2,2);
insert  into `actividad_semanal_has_dia`(`idactividad_semanal_has_dia`,`idactividad_semanal`,`iddia`) values (5,2,4);
insert  into `actividad_semanal_has_dia`(`idactividad_semanal_has_dia`,`idactividad_semanal`,`iddia`) values (6,2,6);
insert  into `actividad_semanal_has_dia`(`idactividad_semanal_has_dia`,`idactividad_semanal`,`iddia`) values (7,3,6);
insert  into `actividad_semanal_has_dia`(`idactividad_semanal_has_dia`,`idactividad_semanal`,`iddia`) values (8,3,7);

/*Table structure for table `asesor` */

DROP TABLE IF EXISTS `asesor`;

CREATE TABLE `asesor` (
  `idasesor` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombres` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `contacto_rapido` tinyint(1) DEFAULT '0',
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idasesor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `asesor` */

/*Table structure for table `atributo` */

DROP TABLE IF EXISTS `atributo`;

CREATE TABLE `atributo` (
  `idatributo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idatributo`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `atributo` */

insert  into `atributo`(`idatributo`,`nombre`,`slug`,`estado`) values (1,'colores','colores',1);
insert  into `atributo`(`idatributo`,`nombre`,`slug`,`estado`) values (2,'tallas','tallas',1);
insert  into `atributo`(`idatributo`,`nombre`,`slug`,`estado`) values (3,'tamaño','tamano',1);
insert  into `atributo`(`idatributo`,`nombre`,`slug`,`estado`) values (4,'presentación','presentacion',1);
insert  into `atributo`(`idatributo`,`nombre`,`slug`,`estado`) values (5,'tipo','tipo',1);
insert  into `atributo`(`idatributo`,`nombre`,`slug`,`estado`) values (6,'distribución','distribucion',1);
insert  into `atributo`(`idatributo`,`nombre`,`slug`,`estado`) values (7,'modelo','modelo',1);

/*Table structure for table `banco` */

DROP TABLE IF EXISTS `banco`;

CREATE TABLE `banco` (
  `idbanco` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idbanco`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `banco` */

/*Table structure for table `banner` */

DROP TABLE IF EXISTS `banner`;

CREATE TABLE `banner` (
  `idbanner` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idtipo_ruta` int(11) DEFAULT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `posicion` int(11) DEFAULT NULL,
  `idbanner_tipo` int(11) DEFAULT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  `boton_text` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `boton_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `boton_target` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `imagen_movil` text COLLATE utf8mb4_unicode_ci,
  `video` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idbanner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `banner` */

/*Table structure for table `banner_tipo` */

DROP TABLE IF EXISTS `banner_tipo`;

CREATE TABLE `banner_tipo` (
  `idbanner_tipo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idbanner_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `banner_tipo` */

insert  into `banner_tipo`(`idbanner_tipo`,`nombre`,`slug`,`estado`) values (1,'Imagen','imagen',1);
insert  into `banner_tipo`(`idbanner_tipo`,`nombre`,`slug`,`estado`) values (2,'Video','video',1);

/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `idblog` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitulo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `autor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `fecha` date DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idblog`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `blog` */

/*Table structure for table `blog_categoria` */

DROP TABLE IF EXISTS `blog_categoria`;

CREATE TABLE `blog_categoria` (
  `idblog_categoria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idblog_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `blog_categoria` */

/*Table structure for table `caja` */

DROP TABLE IF EXISTS `caja`;

CREATE TABLE `caja` (
  `idcaja` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `idsucursal` int(11) DEFAULT NULL,
  `idmoneda` int(11) DEFAULT NULL,
  `moneda_cambio` decimal(11,2) DEFAULT NULL,
  `monto_inicial` decimal(11,2) DEFAULT NULL,
  `monto_actual` decimal(11,2) DEFAULT NULL,
  `monto_final` decimal(11,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idcaja`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `caja` */

/*Table structure for table `cantidad_sesiones` */

DROP TABLE IF EXISTS `cantidad_sesiones`;

CREATE TABLE `cantidad_sesiones` (
  `idcantidad_sesiones` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(11,2) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idcantidad_sesiones`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `cantidad_sesiones` */

insert  into `cantidad_sesiones`(`idcantidad_sesiones`,`nombre`,`slug`,`cantidad`,`precio`,`estado`,`created_at`,`updated_at`) values (1,'3 sessiones x 150 so','3-sessiones-x-150-so',3,150.00,1,NULL,NULL);
insert  into `cantidad_sesiones`(`idcantidad_sesiones`,`nombre`,`slug`,`cantidad`,`precio`,`estado`,`created_at`,`updated_at`) values (2,'6 sessions x 300 so','6-sessions-x-300-so',6,300.00,1,NULL,NULL);
insert  into `cantidad_sesiones`(`idcantidad_sesiones`,`nombre`,`slug`,`cantidad`,`precio`,`estado`,`created_at`,`updated_at`) values (3,'9 sessions x 450 so','9-sessions-x-450-so',9,450.00,1,NULL,NULL);

/*Table structure for table `carril` */

DROP TABLE IF EXISTS `carril`;

CREATE TABLE `carril` (
  `idcarril` int(11) NOT NULL AUTO_INCREMENT,
  `idpiscina` int(11) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `capacidad_maxima` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idcarril`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `carril` */

insert  into `carril`(`idcarril`,`idpiscina`,`nombre`,`slug`,`capacidad_maxima`,`estado`,`created_at`,`updated_at`) values (1,1,'Carril 1','carril-1',4,1,NULL,NULL);
insert  into `carril`(`idcarril`,`idpiscina`,`nombre`,`slug`,`capacidad_maxima`,`estado`,`created_at`,`updated_at`) values (2,1,'Carril 2','carril-2',4,1,NULL,NULL);
insert  into `carril`(`idcarril`,`idpiscina`,`nombre`,`slug`,`capacidad_maxima`,`estado`,`created_at`,`updated_at`) values (3,1,'Carril 3','carril-3',4,1,NULL,NULL);
insert  into `carril`(`idcarril`,`idpiscina`,`nombre`,`slug`,`capacidad_maxima`,`estado`,`created_at`,`updated_at`) values (4,1,'Carril 4','carril-4',4,1,NULL,NULL);
insert  into `carril`(`idcarril`,`idpiscina`,`nombre`,`slug`,`capacidad_maxima`,`estado`,`created_at`,`updated_at`) values (5,1,'Carril 5','carril-5',4,1,NULL,NULL);
insert  into `carril`(`idcarril`,`idpiscina`,`nombre`,`slug`,`capacidad_maxima`,`estado`,`created_at`,`updated_at`) values (6,1,'Carril 6','carril-6',4,1,NULL,NULL);
insert  into `carril`(`idcarril`,`idpiscina`,`nombre`,`slug`,`capacidad_maxima`,`estado`,`created_at`,`updated_at`) values (7,1,'Carril 7','carril-7',4,1,NULL,NULL);
insert  into `carril`(`idcarril`,`idpiscina`,`nombre`,`slug`,`capacidad_maxima`,`estado`,`created_at`,`updated_at`) values (8,1,'Carril 8','carril-8',4,1,NULL,NULL);
insert  into `carril`(`idcarril`,`idpiscina`,`nombre`,`slug`,`capacidad_maxima`,`estado`,`created_at`,`updated_at`) values (9,2,'Carril 1','carril-1',4,1,NULL,NULL);
insert  into `carril`(`idcarril`,`idpiscina`,`nombre`,`slug`,`capacidad_maxima`,`estado`,`created_at`,`updated_at`) values (10,2,'Carril 2','carril-2',4,1,NULL,NULL);
insert  into `carril`(`idcarril`,`idpiscina`,`nombre`,`slug`,`capacidad_maxima`,`estado`,`created_at`,`updated_at`) values (11,2,'Carril 3','carril-3',4,1,NULL,NULL);
insert  into `carril`(`idcarril`,`idpiscina`,`nombre`,`slug`,`capacidad_maxima`,`estado`,`created_at`,`updated_at`) values (12,2,'Carril 4','carril-4',4,1,NULL,NULL);
insert  into `carril`(`idcarril`,`idpiscina`,`nombre`,`slug`,`capacidad_maxima`,`estado`,`created_at`,`updated_at`) values (13,3,'Carril 1','carril-1',4,1,NULL,NULL);
insert  into `carril`(`idcarril`,`idpiscina`,`nombre`,`slug`,`capacidad_maxima`,`estado`,`created_at`,`updated_at`) values (14,3,'Carril 2','carril-2',4,1,NULL,NULL);

/*Table structure for table `categoria` */

DROP TABLE IF EXISTS `categoria`;

CREATE TABLE `categoria` (
  `idcategoria` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pariente` int(11) DEFAULT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nivel` int(11) NOT NULL,
  `orden` int(11) NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) DEFAULT '0',
  `color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '#000000',
  PRIMARY KEY (`idcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categoria` */

/*Table structure for table `categoria_marca` */

DROP TABLE IF EXISTS `categoria_marca`;

CREATE TABLE `categoria_marca` (
  `idcategoria_marca` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idcategoria` int(11) NOT NULL,
  `idmarca` int(11) NOT NULL,
  PRIMARY KEY (`idcategoria_marca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categoria_marca` */

/*Table structure for table `cliente` */

DROP TABLE IF EXISTS `cliente`;

CREATE TABLE `cliente` (
  `idcliente` int(10) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombres` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idtipo_documento_identidad` int(11) DEFAULT NULL,
  `numero_documento_identidad` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexo` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `iddepartamento` int(11) DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `iddistrito` int(11) DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `referencia` text COLLATE utf8mb4_unicode_ci,
  `nota` text COLLATE utf8mb4_unicode_ci,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idcliente`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cliente` */

/*Table structure for table `comprobante` */

DROP TABLE IF EXISTS `comprobante`;

CREATE TABLE `comprobante` (
  `idcomprobante` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro_correlativo` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nro_serie` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`idcomprobante`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `comprobante` */

insert  into `comprobante`(`idcomprobante`,`nombre`,`nro_correlativo`,`nro_serie`,`estado`) values (1,'boleta',NULL,'1',1);
insert  into `comprobante`(`idcomprobante`,`nombre`,`nro_correlativo`,`nro_serie`,`estado`) values (2,'factura',NULL,'1',1);

/*Table structure for table `concepto` */

DROP TABLE IF EXISTS `concepto`;

CREATE TABLE `concepto` (
  `idconcepto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idconcepto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `concepto` */

insert  into `concepto`(`idconcepto`,`nombre`,`estado`,`created_at`,`updated_at`) values (1,'Nueva Matricula',1,NULL,NULL);

/*Table structure for table `contacto` */

DROP TABLE IF EXISTS `contacto`;

CREATE TABLE `contacto` (
  `idcontacto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `telefono` text COLLATE utf8mb4_unicode_ci,
  `celular` text COLLATE utf8mb4_unicode_ci,
  `correo` text COLLATE utf8mb4_unicode_ci,
  `facebook` text COLLATE utf8mb4_unicode_ci,
  `whatsapp` text COLLATE utf8mb4_unicode_ci,
  `instagram` text COLLATE utf8mb4_unicode_ci,
  `twitter` text COLLATE utf8mb4_unicode_ci,
  `youtube` text COLLATE utf8mb4_unicode_ci,
  `linkendin` text COLLATE utf8mb4_unicode_ci,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `google_maps` text COLLATE utf8mb4_unicode_ci,
  `horario` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`idcontacto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `contacto` */

insert  into `contacto`(`idcontacto`,`telefono`,`celular`,`correo`,`facebook`,`whatsapp`,`instagram`,`twitter`,`youtube`,`linkendin`,`direccion`,`google_maps`,`horario`) values (1,'987654321','987654321','venta@example.com','facebook','quiero información','instagram','twitter',NULL,NULL,'direccion tienda',NULL,NULL);

/*Table structure for table `costo_envio` */

DROP TABLE IF EXISTS `costo_envio`;

CREATE TABLE `costo_envio` (
  `idcosto_envio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iddepartamento` int(11) DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `iddistrito` int(11) DEFAULT NULL,
  `precio` decimal(11,2) DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `restriccion` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idcosto_envio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `costo_envio` */

insert  into `costo_envio`(`idcosto_envio`,`iddepartamento`,`idprovincia`,`iddistrito`,`precio`,`descripcion`,`restriccion`,`estado`) values (1,NULL,NULL,NULL,15.00,'descripción del envío','restrición del envío',1);

/*Table structure for table `cupon` */

DROP TABLE IF EXISTS `cupon`;

CREATE TABLE `cupon` (
  `idcupon` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipoDescuento` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descuentoMonto` decimal(11,2) DEFAULT '0.00',
  `descuentoPorcentaje` decimal(11,2) DEFAULT '0.00',
  `montoMinimo` decimal(11,2) DEFAULT '0.00',
  `cantidad` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaExpiracion` date NOT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idcupon`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cupon` */

/*Table structure for table `currency_change_over_time` */

DROP TABLE IF EXISTS `currency_change_over_time`;

CREATE TABLE `currency_change_over_time` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idmoneda` int(11) DEFAULT NULL,
  `moneda_simbolo` varchar(10) DEFAULT NULL,
  `moneda_cambio` decimal(11,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `currency_change_over_time` */

/*Table structure for table `dia` */

DROP TABLE IF EXISTS `dia`;

CREATE TABLE `dia` (
  `iddia` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`iddia`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `dia` */

insert  into `dia`(`iddia`,`nombre`,`slug`,`estado`) values (1,'Lunes','lunes',1);
insert  into `dia`(`iddia`,`nombre`,`slug`,`estado`) values (2,'Martes','martes',1);
insert  into `dia`(`iddia`,`nombre`,`slug`,`estado`) values (3,'Miercoles','miercoles',1);
insert  into `dia`(`iddia`,`nombre`,`slug`,`estado`) values (4,'Jueves','jueves',1);
insert  into `dia`(`iddia`,`nombre`,`slug`,`estado`) values (5,'Viernes','viernes',1);
insert  into `dia`(`iddia`,`nombre`,`slug`,`estado`) values (6,'Sabado','sabado',1);
insert  into `dia`(`iddia`,`nombre`,`slug`,`estado`) values (7,'Domingo','domingo',1);

/*Table structure for table `empleado` */

DROP TABLE IF EXISTS `empleado`;

CREATE TABLE `empleado` (
  `idempleado` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) DEFAULT NULL,
  `nombres` varchar(250) DEFAULT NULL,
  `apellidos` varchar(250) DEFAULT NULL,
  `idtipo_documento_identidad` int(11) DEFAULT NULL,
  `numero_documento_identidad` varchar(20) DEFAULT NULL,
  `imagen` text,
  `fecha_ingreso` date DEFAULT NULL,
  `fecha_culminacion` date DEFAULT NULL,
  `idtipo_empleado` int(11) DEFAULT NULL,
  `sexo` varchar(50) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `correo` varchar(250) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idempleado`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `empleado` */

insert  into `empleado`(`idempleado`,`codigo`,`nombres`,`apellidos`,`idtipo_documento_identidad`,`numero_documento_identidad`,`imagen`,`fecha_ingreso`,`fecha_culminacion`,`idtipo_empleado`,`sexo`,`telefono`,`correo`,`estado`,`created_at`,`updated_at`) values (1,'dsg','asd','6a4sd',1,'87654321','empleado/U8SHJFopc3a1sGY1ed2Tu6GtgrTau9qXSIuCe4Bl.jpeg','2022-12-13',NULL,3,'hombre','987654321','asd@dasda.sda',1,'2023-05-08 13:12:25','2023-05-08 13:18:04');

/*Table structure for table `empresa` */

DROP TABLE IF EXISTS `empresa`;

CREATE TABLE `empresa` (
  `idempresa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ruc` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `igv` decimal(11,2) DEFAULT '0.00',
  `idmoneda` int(11) DEFAULT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci,
  `favicon` text COLLATE utf8mb4_unicode_ci,
  `cuenta_bancaria` text COLLATE utf8mb4_unicode_ci,
  `logo2` text COLLATE utf8mb4_unicode_ci,
  `informacion_adicional` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`idempresa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `empresa` */

insert  into `empresa`(`idempresa`,`nombre`,`ruc`,`igv`,`idmoneda`,`logo`,`favicon`,`cuenta_bancaria`,`logo2`,`informacion_adicional`) values (1,'Linea',NULL,18.00,2,'sR2ilq3B0sC3VbHNSNKyGW7kLBZQWWZYrCwdgI8h.png','kjviaNy5TLlo3EhUJq6iaq53I0pORxMvk2kFkthE.png',NULL,NULL,NULL);

/*Table structure for table `estado_control_venta` */

DROP TABLE IF EXISTS `estado_control_venta`;

CREATE TABLE `estado_control_venta` (
  `idestado_control_venta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idestado_control_venta`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `estado_control_venta` */

insert  into `estado_control_venta`(`idestado_control_venta`,`nombre`,`descripcion`,`estado`) values (1,'PROCESADA',NULL,1);
insert  into `estado_control_venta`(`idestado_control_venta`,`nombre`,`descripcion`,`estado`) values (2,'FINALIZADA',NULL,1);
insert  into `estado_control_venta`(`idestado_control_venta`,`nombre`,`descripcion`,`estado`) values (3,'ANULADA',NULL,1);

/*Table structure for table `estado_envio` */

DROP TABLE IF EXISTS `estado_envio`;

CREATE TABLE `estado_envio` (
  `idestado_envio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` smallint(6) DEFAULT '1',
  PRIMARY KEY (`idestado_envio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `estado_envio` */

insert  into `estado_envio`(`idestado_envio`,`nombre`,`estado`) values (1,'en espera',1);
insert  into `estado_envio`(`idestado_envio`,`nombre`,`estado`) values (2,'enviado',1);
insert  into `estado_envio`(`idestado_envio`,`nombre`,`estado`) values (3,'entregado',1);
insert  into `estado_envio`(`idestado_envio`,`nombre`,`estado`) values (4,'devuelto',1);
insert  into `estado_envio`(`idestado_envio`,`nombre`,`estado`) values (5,'no se entregaran',1);

/*Table structure for table `estado_pago` */

DROP TABLE IF EXISTS `estado_pago`;

CREATE TABLE `estado_pago` (
  `idestado_pago` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`idestado_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `estado_pago` */

insert  into `estado_pago`(`idestado_pago`,`nombre`,`estado`) values (1,'pagado',1);
insert  into `estado_pago`(`idestado_pago`,`nombre`,`estado`) values (2,'espera de pago',1);
insert  into `estado_pago`(`idestado_pago`,`nombre`,`estado`) values (3,'Cancelado',1);
insert  into `estado_pago`(`idestado_pago`,`nombre`,`estado`) values (4,'Reembolsado',1);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` int(11) NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `favorito` */

DROP TABLE IF EXISTS `favorito`;

CREATE TABLE `favorito` (
  `idfavorito` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  PRIMARY KEY (`idfavorito`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `favorito` */

/*Table structure for table `horario` */

DROP TABLE IF EXISTS `horario`;

CREATE TABLE `horario` (
  `idhorario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idhorario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `horario` */

insert  into `horario`(`idhorario`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (1,'07:00 am - 08:00 am','07-00-am-08-00-am',1,NULL,NULL);
insert  into `horario`(`idhorario`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (2,'08:00 am - 09:00 am','08-00-am-09-00-am',1,NULL,NULL);
insert  into `horario`(`idhorario`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (3,'09:00 am - 10:00 am','09-00-am-10-00-am',1,NULL,NULL);
insert  into `horario`(`idhorario`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (4,'10:00 am - 11:00 am','10-00-am-11-00-am',1,NULL,NULL);
insert  into `horario`(`idhorario`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (5,'11:00 am - 12:00 pm','11-00-am-12-00-pm',1,NULL,NULL);
insert  into `horario`(`idhorario`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (6,'12:00 pm - 01:00 pm','12-00-pm-01-00-pm',1,NULL,NULL);
insert  into `horario`(`idhorario`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (7,'01:00 pm - 02:00 pm','01-00-pm-02-00-pm',1,NULL,NULL);
insert  into `horario`(`idhorario`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (8,'02:00 pm - 03:00 pm','02-00-pm-03-00-pm',1,NULL,NULL);
insert  into `horario`(`idhorario`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (9,'03:00 pm - 04:00 pm','03-00-pm-04-00-pm',1,NULL,NULL);
insert  into `horario`(`idhorario`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (10,'04:00 pm - 05:00 pm','04-00-pm-05-00-pm',1,NULL,NULL);
insert  into `horario`(`idhorario`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (11,'05:00 pm - 06:00 pm','05-00-pm-06-00-pm',1,NULL,NULL);

/*Table structure for table `instagram` */

DROP TABLE IF EXISTS `instagram`;

CREATE TABLE `instagram` (
  `idinstagram` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `link` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idinstagram`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `instagram` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `queue` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `libro_reclamacion` */

DROP TABLE IF EXISTS `libro_reclamacion`;

CREATE TABLE `libro_reclamacion` (
  `idlibro_reclamacion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombres_apellidos` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_documento` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_documento` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `correo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre_apoderado` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo_bien` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion_bien` text COLLATE utf8mb4_unicode_ci,
  `tipo_reclamo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detalle_reclamo` text COLLATE utf8mb4_unicode_ci,
  `fecha_ingreso` datetime DEFAULT NULL,
  `estado` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idlibro_reclamacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `libro_reclamacion` */

/*Table structure for table `marca` */

DROP TABLE IF EXISTS `marca`;

CREATE TABLE `marca` (
  `idmarca` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idmarca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `marca` */

/*Table structure for table `matricula` */

DROP TABLE IF EXISTS `matricula`;

CREATE TABLE `matricula` (
  `idmatricula` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(100) DEFAULT NULL,
  `idsucursal` int(11) DEFAULT NULL,
  `sucursal_nombre` varchar(250) DEFAULT NULL,
  `sucursal_direccion` text,
  `idcliente` int(11) DEFAULT NULL,
  `cliente_nombres` varchar(250) DEFAULT NULL,
  `cliente_apellidos` varchar(250) DEFAULT NULL,
  `cliente_tipo_documento_identidad` int(11) DEFAULT NULL,
  `cliente_numero_documento_identidad` varchar(250) DEFAULT NULL,
  `idempleado` int(11) DEFAULT NULL,
  `empleado_nombres` varchar(250) DEFAULT NULL,
  `empleado_apellidos` varchar(250) DEFAULT NULL,
  `empleado_idtipo_documento_identidad` int(11) DEFAULT NULL,
  `empleado_numero_documento_identidad` varchar(250) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `idconcepto` int(11) DEFAULT NULL,
  `idtemporada` int(11) DEFAULT NULL,
  `temporada_nombre` varchar(250) DEFAULT NULL,
  `idprograma` int(11) DEFAULT NULL,
  `programa_nombre` varchar(250) DEFAULT NULL,
  `idcantidad_sesiones` int(11) DEFAULT NULL,
  `cantidad_sesiones_nombre` varchar(250) DEFAULT NULL,
  `cantidad_sesiones_cantidad` int(11) DEFAULT NULL,
  `idactividad_semanal` int(11) DEFAULT NULL,
  `actividad_semanal_nombre` varchar(250) DEFAULT NULL,
  `idpiscina` int(11) DEFAULT NULL,
  `idcarril` int(11) DEFAULT NULL,
  `monto_total` decimal(11,2) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idmatricula`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `matricula` */

/*Table structure for table `matricula_curso` */

DROP TABLE IF EXISTS `matricula_curso`;

CREATE TABLE `matricula_curso` (
  `idmatricula_curso` int(11) NOT NULL AUTO_INCREMENT,
  `idcliente` int(11) DEFAULT NULL,
  `idsucursal` int(11) DEFAULT NULL,
  `idcurso` int(11) DEFAULT NULL,
  `idempleado` int(11) DEFAULT NULL,
  `monto_inicial` decimal(11,2) DEFAULT NULL,
  `metodo_pago_id2` int(11) DEFAULT NULL,
  `idmodalidad` int(11) DEFAULT NULL,
  `curso_monto_total` decimal(11,2) DEFAULT NULL,
  `curso_fecha_inicio` datetime DEFAULT NULL,
  `curso_fecha_f` datetime DEFAULT NULL,
  `cuota_cantidad` int(11) DEFAULT NULL,
  `cuota_monto` decimal(11,2) DEFAULT NULL,
  `create_at` timestamp NULL DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idmatricula_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `matricula_curso` */

/*Table structure for table `matricula_detalle` */

DROP TABLE IF EXISTS `matricula_detalle`;

CREATE TABLE `matricula_detalle` (
  `idmatricula_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `idmatricula` int(11) DEFAULT NULL,
  `idhorario` int(11) DEFAULT NULL,
  `iddia` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idmatricula_detalle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `matricula_detalle` */

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `idmenu` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pariente` int(11) DEFAULT NULL,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idtipo_ruta` int(11) DEFAULT NULL,
  `ruta` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icono` text COLLATE utf8mb4_unicode_ci,
  `posicion` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idmenu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `menu` */

/*Table structure for table `metodo_entrega` */

DROP TABLE IF EXISTS `metodo_entrega`;

CREATE TABLE `metodo_entrega` (
  `idmetodo_entrega` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idmetodo_entrega`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `metodo_entrega` */

insert  into `metodo_entrega`(`idmetodo_entrega`,`nombre`,`estado`) values (1,'ENVIO A DOMICILIO',1);
insert  into `metodo_entrega`(`idmetodo_entrega`,`nombre`,`estado`) values (2,'RECOJO EN TIENDA',1);

/*Table structure for table `metodo_pago` */

DROP TABLE IF EXISTS `metodo_pago`;

CREATE TABLE `metodo_pago` (
  `idmetodo_pago` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idmetodo_pago`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `metodo_pago` */

insert  into `metodo_pago`(`idmetodo_pago`,`nombre`,`descripcion`,`estado`) values (1,NULL,'TARJETA-CREDITO',1);
insert  into `metodo_pago`(`idmetodo_pago`,`nombre`,`descripcion`,`estado`) values (2,NULL,'CONTRAENTREGA-EFECTIVO',1);
insert  into `metodo_pago`(`idmetodo_pago`,`nombre`,`descripcion`,`estado`) values (3,NULL,'PAGO-DEPOSITO-BANCARIO',1);
insert  into `metodo_pago`(`idmetodo_pago`,`nombre`,`descripcion`,`estado`) values (4,NULL,'PAGO-EFECTIVO',1);
insert  into `metodo_pago`(`idmetodo_pago`,`nombre`,`descripcion`,`estado`) values (5,NULL,'MERCADOPAGO',1);
insert  into `metodo_pago`(`idmetodo_pago`,`nombre`,`descripcion`,`estado`) values (6,NULL,'IZIPAY',1);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (2,'2014_10_12_100000_create_password_resets_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (3,'2019_08_19_000000_create_failed_jobs_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (4,'2020_06_03_030835_create_jobs_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (5,'2022_05_20_122102_create_asesor_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (6,'2022_05_20_122102_create_banco_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (7,'2022_05_20_122102_create_banner_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (8,'2022_05_20_122102_create_blog_categoria_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (9,'2022_05_20_122102_create_blog_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (10,'2022_05_20_122102_create_categoria_marca_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (11,'2022_05_20_122102_create_categoria_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (12,'2022_05_20_122102_create_cliente_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (13,'2022_05_20_122102_create_comprobante_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (14,'2022_05_20_122102_create_contacto_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (15,'2022_05_20_122102_create_costo_envio_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (16,'2022_05_20_122102_create_cupon_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (17,'2022_05_20_122102_create_empresa_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (18,'2022_05_20_122102_create_estado_control_venta_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (19,'2022_05_20_122102_create_estado_envio_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (20,'2022_05_20_122102_create_estado_pago_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (21,'2022_05_20_122102_create_favorito_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (22,'2022_05_20_122102_create_libro_reclamacion_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (23,'2022_05_20_122102_create_marca_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (24,'2022_05_20_122102_create_menu_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (25,'2022_05_20_122102_create_metodo_entrega_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (26,'2022_05_20_122102_create_metodo_pago_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (27,'2022_05_20_122102_create_modalidad_despacho_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (28,'2022_05_20_122102_create_moneda_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (29,'2022_05_20_122102_create_pagina_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (30,'2022_05_20_122102_create_politica_privacidad_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (31,'2022_05_20_122102_create_popup_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (32,'2022_05_20_122102_create_pregunta_frecuente_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (33,'2022_05_20_122102_create_producto_imagen_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (34,'2022_05_20_122102_create_producto_manual_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (35,'2022_05_20_122102_create_producto_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (36,'2022_05_20_122102_create_punto_venta_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (37,'2022_05_20_122102_create_recuperar_contrasenia_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (38,'2022_05_20_122102_create_rol_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (39,'2022_05_20_122102_create_seo_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (40,'2022_05_20_122102_create_suscripcion_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (41,'2022_05_20_122102_create_terminos_condiciones_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (42,'2022_05_20_122102_create_tipo_documento_identidad_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (43,'2022_05_20_122102_create_tipo_ruta_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (44,'2022_05_20_122102_create_ubigeo_departamento_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (45,'2022_05_20_122102_create_ubigeo_distrito_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (46,'2022_05_20_122102_create_ubigeo_provincia_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (47,'2022_05_20_122102_create_usuario_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (48,'2022_05_20_122102_create_venta_detalle_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (49,'2022_05_20_122102_create_venta_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (50,'2022_05_26_182310_create_section_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (51,'2022_06_11_161653_create_atributo_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (52,'2022_06_11_161942_create_producto_has_atributo_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (53,'2022_06_13_200919_create_section_home_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (54,'2022_06_15_010431_create_section_home_link_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (55,'2022_06_15_010632_create_section_home_producto_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (56,'2022_06_16_184656_add_column_sliders_to_section_home_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (57,'2022_06_16_220315_add_column_color_to_categoria_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (58,'2022_06_17_130154_create_testimonio_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (59,'2022_07_07_182821_create_instagram_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (60,'2022_11_19_164028_create_producto_relacionado_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (61,'2022_11_22_164921_create_banner_tipo_table',1);
insert  into `migrations`(`id`,`migration`,`batch`) values (62,'2023_05_02_185847_create_permission_tables',2);

/*Table structure for table `modalidad_despacho` */

DROP TABLE IF EXISTS `modalidad_despacho`;

CREATE TABLE `modalidad_despacho` (
  `idmodalidad_despacho` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idmodalidad_despacho`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `modalidad_despacho` */

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

/*Table structure for table `moneda` */

DROP TABLE IF EXISTS `moneda`;

CREATE TABLE `moneda` (
  `idmoneda` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `moneda` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `simbolo` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `simbolo_posicion` enum('LEFT','RIGHT') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cambio` decimal(10,4) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idmoneda`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `moneda` */

insert  into `moneda`(`idmoneda`,`nombre`,`moneda`,`simbolo`,`simbolo_posicion`,`cambio`,`estado`) values (1,'DOLARES','USD','$',NULL,1.0000,1);
insert  into `moneda`(`idmoneda`,`nombre`,`moneda`,`simbolo`,`simbolo_posicion`,`cambio`,`estado`) values (2,'SOLES','PEN','S/',NULL,1.0000,1);

/*Table structure for table `pagina` */

DROP TABLE IF EXISTS `pagina`;

CREATE TABLE `pagina` (
  `idpagina` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `titulo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitulo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `autor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idpagina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pagina` */

/*Table structure for table `pago_cliente` */

DROP TABLE IF EXISTS `pago_cliente`;

CREATE TABLE `pago_cliente` (
  `idpago_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `idmatricula` int(11) DEFAULT NULL,
  `idconcepto` int(11) DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `idcaja` int(11) DEFAULT NULL,
  `idempleado` int(11) DEFAULT NULL,
  `empleado_nombres` varchar(250) DEFAULT NULL,
  `empleado_apellidos` varchar(250) DEFAULT NULL,
  `empleado_idtipo_documento_identidad` int(11) DEFAULT NULL,
  `empleado_numero_documento_identidad` varchar(250) DEFAULT NULL,
  `idtipo_pago` int(11) DEFAULT NULL,
  `idestado_pago` int(11) DEFAULT NULL,
  `monto_total` decimal(11,2) DEFAULT NULL,
  `monto_pago` decimal(11,2) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idpago_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pago_cliente` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

/*Table structure for table `piscina` */

DROP TABLE IF EXISTS `piscina`;

CREATE TABLE `piscina` (
  `idpiscina` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `create_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idpiscina`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `piscina` */

insert  into `piscina`(`idpiscina`,`nombre`,`slug`,`estado`,`create_at`) values (1,'Piscina grande','piscina-grande',1,NULL);
insert  into `piscina`(`idpiscina`,`nombre`,`slug`,`estado`,`create_at`) values (2,'Piscina mediana','piscina-mediana',1,NULL);
insert  into `piscina`(`idpiscina`,`nombre`,`slug`,`estado`,`create_at`) values (3,'Piscina pequeña','piscina-pequena',1,NULL);

/*Table structure for table `politica_privacidad` */

DROP TABLE IF EXISTS `politica_privacidad`;

CREATE TABLE `politica_privacidad` (
  `idpolitica_privacidad` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`idpolitica_privacidad`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `politica_privacidad` */

insert  into `politica_privacidad`(`idpolitica_privacidad`,`contenido`) values (1,'');

/*Table structure for table `popup` */

DROP TABLE IF EXISTS `popup`;

CREATE TABLE `popup` (
  `idpopup` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pagina` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `enlace` text COLLATE utf8mb4_unicode_ci,
  `orden` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idpopup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `popup` */

/*Table structure for table `pregunta_frecuente` */

DROP TABLE IF EXISTS `pregunta_frecuente`;

CREATE TABLE `pregunta_frecuente` (
  `idpregunta_frecuente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pregunta` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `respuesta` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idpregunta_frecuente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `pregunta_frecuente` */

/*Table structure for table `producto` */

DROP TABLE IF EXISTS `producto`;

CREATE TABLE `producto` (
  `idproducto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idmarca` int(11) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `idsection` int(11) DEFAULT NULL,
  `codigo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_precio` tinyint(1) DEFAULT '1',
  `precio` decimal(10,2) NOT NULL DEFAULT '0.00',
  `precio_promocional` decimal(10,2) DEFAULT '0.00',
  `stock` int(11) DEFAULT '0',
  `destacado` tinyint(1) DEFAULT NULL,
  `nuevo` tinyint(1) DEFAULT NULL,
  `liquidacion` tinyint(1) DEFAULT NULL,
  `descripcion_corta` text COLLATE utf8mb4_unicode_ci,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `ficha_tecnica` text COLLATE utf8mb4_unicode_ci,
  `video` text COLLATE utf8mb4_unicode_ci,
  `fecha_registro` datetime DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `producto` */

/*Table structure for table `producto_has_atributo` */

DROP TABLE IF EXISTS `producto_has_atributo`;

CREATE TABLE `producto_has_atributo` (
  `idproducto_has_atributo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) DEFAULT NULL,
  `idatributo` int(11) DEFAULT NULL,
  `valor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idproducto_has_atributo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `producto_has_atributo` */

/*Table structure for table `producto_imagen` */

DROP TABLE IF EXISTS `producto_imagen`;

CREATE TABLE `producto_imagen` (
  `idproducto_imagen` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `posicion` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idproducto_imagen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `producto_imagen` */

/*Table structure for table `producto_manual` */

DROP TABLE IF EXISTS `producto_manual`;

CREATE TABLE `producto_manual` (
  `idproducto_manual` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) NOT NULL,
  `nombre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `posicion` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idproducto_manual`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `producto_manual` */

/*Table structure for table `producto_relacionado` */

DROP TABLE IF EXISTS `producto_relacionado`;

CREATE TABLE `producto_relacionado` (
  `idproducto` int(11) NOT NULL,
  `idproducto_relacionado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `producto_relacionado` */

/*Table structure for table `programa` */

DROP TABLE IF EXISTS `programa`;

CREATE TABLE `programa` (
  `idprograma` int(11) NOT NULL AUTO_INCREMENT,
  `idtemporada` int(11) DEFAULT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idprograma`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `programa` */

insert  into `programa`(`idprograma`,`idtemporada`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (1,1,'para adultos','para-adultos',1,NULL,NULL);
insert  into `programa`(`idprograma`,`idtemporada`,`nombre`,`slug`,`estado`,`created_at`,`updated_at`) values (2,1,'para niños','para-ninos',1,NULL,NULL);

/*Table structure for table `punto_venta` */

DROP TABLE IF EXISTS `punto_venta`;

CREATE TABLE `punto_venta` (
  `idpunto_venta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `whatsapp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horario_atencion` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idpunto_venta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `punto_venta` */

/*Table structure for table `record_asistencia` */

DROP TABLE IF EXISTS `record_asistencia`;

CREATE TABLE `record_asistencia` (
  `idrecord_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `idsucursal` int(11) DEFAULT NULL,
  `idempleado` int(11) DEFAULT NULL,
  `idcliente` int(11) DEFAULT NULL,
  `idactividad_semanal` int(11) DEFAULT NULL,
  `idhorario` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idrecord_asistencia`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `record_asistencia` */

/*Table structure for table `recuperar_contrasenia` */

DROP TABLE IF EXISTS `recuperar_contrasenia`;

CREATE TABLE `recuperar_contrasenia` (
  `idrecuperar_contrasenia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idrecuperar_contrasenia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `recuperar_contrasenia` */

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `idrol` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cargo` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `rol` */

insert  into `rol`(`idrol`,`cargo`,`estado`) values (1,'Administrador',1);
insert  into `rol`(`idrol`,`cargo`,`estado`) values (2,'Usuario',1);

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

/*Table structure for table `section` */

DROP TABLE IF EXISTS `section`;

CREATE TABLE `section` (
  `idsection` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idsection`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `section` */

/*Table structure for table `section_home` */

DROP TABLE IF EXISTS `section_home`;

CREATE TABLE `section_home` (
  `idsection_home` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` text COLLATE utf8mb4_unicode_ci,
  `titulo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitulo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  `posicion` int(11) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `nuevo` int(11) DEFAULT NULL,
  `destacado` int(11) DEFAULT NULL,
  `liquidacion` int(11) DEFAULT NULL,
  `idmarca` int(11) DEFAULT NULL,
  `idcategoria` int(11) DEFAULT NULL,
  `idsection` int(11) DEFAULT NULL,
  `cantidad_slider` int(11) DEFAULT NULL,
  PRIMARY KEY (`idsection_home`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `section_home` */

/*Table structure for table `section_home_link` */

DROP TABLE IF EXISTS `section_home_link`;

CREATE TABLE `section_home_link` (
  `idsection_home_link` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idsection_home` int(11) NOT NULL,
  `texto` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `posicion` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idsection_home_link`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `section_home_link` */

/*Table structure for table `section_home_producto` */

DROP TABLE IF EXISTS `section_home_producto`;

CREATE TABLE `section_home_producto` (
  `idsection_home_producto` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `idsection_home` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `posicion` int(11) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idsection_home_producto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `section_home_producto` */

/*Table structure for table `seo` */

DROP TABLE IF EXISTS `seo`;

CREATE TABLE `seo` (
  `idseo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo_general` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `autor` text COLLATE utf8mb4_unicode_ci,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `keywords` text COLLATE utf8mb4_unicode_ci,
  `googleAnalytics` text COLLATE utf8mb4_unicode_ci,
  `googleTagManager` text COLLATE utf8mb4_unicode_ci,
  `facebookPixel` text COLLATE utf8mb4_unicode_ci,
  `imagen_compartir` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`idseo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `seo` */

insert  into `seo`(`idseo`,`titulo_general`,`autor`,`descripcion`,`keywords`,`googleAnalytics`,`googleTagManager`,`facebookPixel`,`imagen_compartir`) values (1,'Empresa','Author Empresa','Descripcion Empresa','Keywords Empresa',NULL,NULL,NULL,NULL);

/*Table structure for table `sucursal` */

DROP TABLE IF EXISTS `sucursal`;

CREATE TABLE `sucursal` (
  `idsucursal` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `descripcion` text,
  `contenido` text,
  `direccion` text,
  `iddepartamento` int(11) DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `iddistrito` int(11) DEFAULT NULL,
  `imagen` text,
  `horario_atencion` text,
  `estado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idsucursal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `sucursal` */

/*Table structure for table `suscripcion` */

DROP TABLE IF EXISTS `suscripcion`;

CREATE TABLE `suscripcion` (
  `idsuscripcion` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_correo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landing` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `creado` datetime DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idsuscripcion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `suscripcion` */

/*Table structure for table `temporada` */

DROP TABLE IF EXISTS `temporada`;

CREATE TABLE `temporada` (
  `idtemporada` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `fecha_desde` datetime DEFAULT NULL,
  `fecha_hasta` datetime DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idtemporada`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `temporada` */

insert  into `temporada`(`idtemporada`,`nombre`,`slug`,`fecha_desde`,`fecha_hasta`,`estado`,`created_at`,`updated_at`) values (1,'Temporada verano','temporada-verano','2021-09-01 00:00:00','2021-12-31 00:00:00',1,NULL,NULL);
insert  into `temporada`(`idtemporada`,`nombre`,`slug`,`fecha_desde`,`fecha_hasta`,`estado`,`created_at`,`updated_at`) values (2,'Temporada invierno','temporada-invierno','2021-01-01 00:00:00','2021-06-30 00:00:00',1,NULL,NULL);

/*Table structure for table `terminos_condiciones` */

DROP TABLE IF EXISTS `terminos_condiciones`;

CREATE TABLE `terminos_condiciones` (
  `idterminos_condiciones` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`idterminos_condiciones`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `terminos_condiciones` */

insert  into `terminos_condiciones`(`idterminos_condiciones`,`contenido`) values (1,'');

/*Table structure for table `testimonio` */

DROP TABLE IF EXISTS `testimonio`;

CREATE TABLE `testimonio` (
  `idtestimonio` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `testimonio` text COLLATE utf8mb4_unicode_ci,
  `avatar` text COLLATE utf8mb4_unicode_ci,
  `imagen` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idtestimonio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `testimonio` */

/*Table structure for table `tipo_documento_identidad` */

DROP TABLE IF EXISTS `tipo_documento_identidad`;

CREATE TABLE `tipo_documento_identidad` (
  `idtipo_documento_identidad` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  PRIMARY KEY (`idtipo_documento_identidad`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tipo_documento_identidad` */

insert  into `tipo_documento_identidad`(`idtipo_documento_identidad`,`nombre`,`estado`,`orden`) values (1,'DNI',1,1);
insert  into `tipo_documento_identidad`(`idtipo_documento_identidad`,`nombre`,`estado`,`orden`) values (2,'CARNET DE EXTRANJERIA',1,2);
insert  into `tipo_documento_identidad`(`idtipo_documento_identidad`,`nombre`,`estado`,`orden`) values (3,'RUC',1,3);
insert  into `tipo_documento_identidad`(`idtipo_documento_identidad`,`nombre`,`estado`,`orden`) values (4,'PASAPORTE',1,4);

/*Table structure for table `tipo_empleado` */

DROP TABLE IF EXISTS `tipo_empleado`;

CREATE TABLE `tipo_empleado` (
  `idtipo_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `imagen` text,
  `descripcion` text,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idtipo_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tipo_empleado` */

insert  into `tipo_empleado`(`idtipo_empleado`,`nombre`,`slug`,`imagen`,`descripcion`,`estado`) values (1,'Administrador','administrador','administrador.png','Administrador del sistema',1);
insert  into `tipo_empleado`(`idtipo_empleado`,`nombre`,`slug`,`imagen`,`descripcion`,`estado`) values (2,'Gerente','gerente','gerente.png','Gerente del sistema',1);
insert  into `tipo_empleado`(`idtipo_empleado`,`nombre`,`slug`,`imagen`,`descripcion`,`estado`) values (3,'Empleado','empleado','empleado.png','Empleado del sistema',1);

/*Table structure for table `tipo_ruta` */

DROP TABLE IF EXISTS `tipo_ruta`;

CREATE TABLE `tipo_ruta` (
  `idtipo_ruta` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_internal` tinyint(1) DEFAULT '0',
  `route_alias` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idtipo_ruta`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tipo_ruta` */

insert  into `tipo_ruta`(`idtipo_ruta`,`nombre`,`slug`,`is_internal`,`route_alias`,`estado`) values (1,'Sin ruta','sin-ruta',0,NULL,1);
insert  into `tipo_ruta`(`idtipo_ruta`,`nombre`,`slug`,`is_internal`,`route_alias`,`estado`) values (2,'Externa','externa',0,NULL,1);
insert  into `tipo_ruta`(`idtipo_ruta`,`nombre`,`slug`,`is_internal`,`route_alias`,`estado`) values (3,'Interna (Estatica)','interna-estatica',1,NULL,1);
insert  into `tipo_ruta`(`idtipo_ruta`,`nombre`,`slug`,`is_internal`,`route_alias`,`estado`) values (4,'Interna (Categoria)','interna-categoria',1,'web.productos.categoria',1);
insert  into `tipo_ruta`(`idtipo_ruta`,`nombre`,`slug`,`is_internal`,`route_alias`,`estado`) values (5,'Interna (Pagina)','interna-pagina',1,'web.pagina.detalle',1);
insert  into `tipo_ruta`(`idtipo_ruta`,`nombre`,`slug`,`is_internal`,`route_alias`,`estado`) values (6,'Interna (Producto)','interna-producto',1,'web.producto.detalle',0);

/*Table structure for table `ubigeo_departamento` */

DROP TABLE IF EXISTS `ubigeo_departamento`;

CREATE TABLE `ubigeo_departamento` (
  `iddepartamento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`iddepartamento`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ubigeo_departamento` */

insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (1,'Amazonas',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (2,'Áncash',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (3,'Apurímac',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (4,'Arequipa',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (5,'Ayacucho',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (6,'Cajamarca',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (7,'Callao',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (8,'Cusco',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (9,'Huancavelica',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (10,'Huánuco',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (11,'Ica',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (12,'Junín',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (13,'La Libertad',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (14,'Lambayeque',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (15,'Lima',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (16,'Loreto',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (17,'Madre de Dios',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (18,'Moquegua',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (19,'Pasco',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (20,'Piura',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (21,'Puno',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (22,'San Martín',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (23,'Tacna',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (24,'Tumbes',1);
insert  into `ubigeo_departamento`(`iddepartamento`,`nombre`,`estado`) values (25,'Ucayali',1);

/*Table structure for table `ubigeo_distrito` */

DROP TABLE IF EXISTS `ubigeo_distrito`;

CREATE TABLE `ubigeo_distrito` (
  `iddistrito` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iddepartamento` int(11) DEFAULT NULL,
  `idprovincia` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`iddistrito`)
) ENGINE=InnoDB AUTO_INCREMENT=250402 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ubigeo_distrito` */

insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10101,1,101,'Chachapoyas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10102,1,101,'Asunción',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10103,1,101,'Balsas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10104,1,101,'Cheto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10105,1,101,'Chiliquin',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10106,1,101,'Chuquibamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10107,1,101,'Granada',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10108,1,101,'Huancas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10109,1,101,'La Jalca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10110,1,101,'Leimebamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10111,1,101,'Levanto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10112,1,101,'Magdalena',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10113,1,101,'Mariscal Castilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10114,1,101,'Molinopampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10115,1,101,'Montevideo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10116,1,101,'Olleros',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10117,1,101,'Quinjalca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10118,1,101,'San Francisco de Daguas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10119,1,101,'San Isidro de Maino',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10120,1,101,'Soloco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10121,1,101,'Sonche',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10201,1,102,'Bagua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10202,1,102,'Aramango',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10203,1,102,'Copallin',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10204,1,102,'El Parco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10205,1,102,'Imaza',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10206,1,102,'La Peca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10301,1,103,'Jumbilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10302,1,103,'Chisquilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10303,1,103,'Churuja',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10304,1,103,'Corosha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10305,1,103,'Cuispes',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10306,1,103,'Florida',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10307,1,103,'Jazan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10308,1,103,'Recta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10309,1,103,'San Carlos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10310,1,103,'Shipasbamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10311,1,103,'Valera',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10312,1,103,'Yambrasbamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10401,1,104,'Nieva',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10402,1,104,'El Cenepa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10403,1,104,'Río Santiago',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10501,1,105,'Lamud',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10502,1,105,'Camporredondo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10503,1,105,'Cocabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10504,1,105,'Colcamar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10505,1,105,'Conila',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10506,1,105,'Inguilpata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10507,1,105,'Longuita',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10508,1,105,'Lonya Chico',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10509,1,105,'Luya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10510,1,105,'Luya Viejo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10511,1,105,'María',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10512,1,105,'Ocalli',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10513,1,105,'Ocumal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10514,1,105,'Pisuquia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10515,1,105,'Providencia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10516,1,105,'San Cristóbal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10517,1,105,'San Francisco de Yeso',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10518,1,105,'San Jerónimo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10519,1,105,'San Juan de Lopecancha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10520,1,105,'Santa Catalina',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10521,1,105,'Santo Tomas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10522,1,105,'Tingo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10523,1,105,'Trita',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10601,1,106,'San Nicolás',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10602,1,106,'Chirimoto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10603,1,106,'Cochamal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10604,1,106,'Huambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10605,1,106,'Limabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10606,1,106,'Longar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10607,1,106,'Mariscal Benavides',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10608,1,106,'Milpuc',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10609,1,106,'Omia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10610,1,106,'Santa Rosa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10611,1,106,'Totora',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10612,1,106,'Vista Alegre',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10701,1,107,'Bagua Grande',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10702,1,107,'Cajaruro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10703,1,107,'Cumba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10704,1,107,'El Milagro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10705,1,107,'Jamalca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10706,1,107,'Lonya Grande',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (10707,1,107,'Yamon',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20101,2,201,'Huaraz',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20102,2,201,'Cochabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20103,2,201,'Colcabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20104,2,201,'Huanchay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20105,2,201,'Independencia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20106,2,201,'Jangas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20107,2,201,'La Libertad',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20108,2,201,'Olleros',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20109,2,201,'Pampas Grande',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20110,2,201,'Pariacoto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20111,2,201,'Pira',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20112,2,201,'Tarica',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20201,2,202,'Aija',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20202,2,202,'Coris',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20203,2,202,'Huacllan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20204,2,202,'La Merced',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20205,2,202,'Succha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20301,2,203,'Llamellin',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20302,2,203,'Aczo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20303,2,203,'Chaccho',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20304,2,203,'Chingas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20305,2,203,'Mirgas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20306,2,203,'San Juan de Rontoy',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20401,2,204,'Chacas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20402,2,204,'Acochaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20501,2,205,'Chiquian',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20502,2,205,'Abelardo Pardo Lezameta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20503,2,205,'Antonio Raymondi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20504,2,205,'Aquia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20505,2,205,'Cajacay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20506,2,205,'Canis',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20507,2,205,'Colquioc',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20508,2,205,'Huallanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20509,2,205,'Huasta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20510,2,205,'Huayllacayan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20511,2,205,'La Primavera',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20512,2,205,'Mangas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20513,2,205,'Pacllon',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20514,2,205,'San Miguel de Corpanqui',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20515,2,205,'Ticllos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20601,2,206,'Carhuaz',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20602,2,206,'Acopampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20603,2,206,'Amashca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20604,2,206,'Anta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20605,2,206,'Ataquero',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20606,2,206,'Marcara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20607,2,206,'Pariahuanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20608,2,206,'San Miguel de Aco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20609,2,206,'Shilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20610,2,206,'Tinco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20611,2,206,'Yungar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20701,2,207,'San Luis',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20702,2,207,'San Nicolás',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20703,2,207,'Yauya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20801,2,208,'Casma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20802,2,208,'Buena Vista Alta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20803,2,208,'Comandante Noel',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20804,2,208,'Yautan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20901,2,209,'Corongo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20902,2,209,'Aco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20903,2,209,'Bambas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20904,2,209,'Cusca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20905,2,209,'La Pampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20906,2,209,'Yanac',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (20907,2,209,'Yupan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21001,2,210,'Huari',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21002,2,210,'Anra',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21003,2,210,'Cajay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21004,2,210,'Chavin de Huantar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21005,2,210,'Huacachi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21006,2,210,'Huacchis',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21007,2,210,'Huachis',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21008,2,210,'Huantar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21009,2,210,'Masin',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21010,2,210,'Paucas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21011,2,210,'Ponto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21012,2,210,'Rahuapampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21013,2,210,'Rapayan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21014,2,210,'San Marcos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21015,2,210,'San Pedro de Chana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21016,2,210,'Uco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21101,2,211,'Huarmey',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21102,2,211,'Cochapeti',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21103,2,211,'Culebras',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21104,2,211,'Huayan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21105,2,211,'Malvas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21201,2,212,'Caraz',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21202,2,212,'Huallanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21203,2,212,'Huata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21204,2,212,'Huaylas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21205,2,212,'Mato',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21206,2,212,'Pamparomas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21207,2,212,'Pueblo Libre',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21208,2,212,'Santa Cruz',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21209,2,212,'Santo Toribio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21210,2,212,'Yuracmarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21301,2,213,'Piscobamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21302,2,213,'Casca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21303,2,213,'Eleazar Guzmán Barron',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21304,2,213,'Fidel Olivas Escudero',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21305,2,213,'Llama',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21306,2,213,'Llumpa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21307,2,213,'Lucma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21308,2,213,'Musga',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21401,2,214,'Ocros',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21402,2,214,'Acas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21403,2,214,'Cajamarquilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21404,2,214,'Carhuapampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21405,2,214,'Cochas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21406,2,214,'Congas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21407,2,214,'Llipa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21408,2,214,'San Cristóbal de Rajan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21409,2,214,'San Pedro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21410,2,214,'Santiago de Chilcas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21501,2,215,'Cabana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21502,2,215,'Bolognesi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21503,2,215,'Conchucos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21504,2,215,'Huacaschuque',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21505,2,215,'Huandoval',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21506,2,215,'Lacabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21507,2,215,'Llapo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21508,2,215,'Pallasca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21509,2,215,'Pampas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21510,2,215,'Santa Rosa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21511,2,215,'Tauca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21601,2,216,'Pomabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21602,2,216,'Huayllan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21603,2,216,'Parobamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21604,2,216,'Quinuabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21701,2,217,'Recuay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21702,2,217,'Catac',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21703,2,217,'Cotaparaco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21704,2,217,'Huayllapampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21705,2,217,'Llacllin',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21706,2,217,'Marca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21707,2,217,'Pampas Chico',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21708,2,217,'Pararin',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21709,2,217,'Tapacocha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21710,2,217,'Ticapampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21801,2,218,'Chimbote',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21802,2,218,'Cáceres del Perú',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21803,2,218,'Coishco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21804,2,218,'Macate',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21805,2,218,'Moro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21806,2,218,'Nepeña',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21807,2,218,'Samanco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21808,2,218,'Santa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21809,2,218,'Nuevo Chimbote',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21901,2,219,'Sihuas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21902,2,219,'Acobamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21903,2,219,'Alfonso Ugarte',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21904,2,219,'Cashapampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21905,2,219,'Chingalpo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21906,2,219,'Huayllabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21907,2,219,'Quiches',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21908,2,219,'Ragash',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21909,2,219,'San Juan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (21910,2,219,'Sicsibamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (22001,2,220,'Yungay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (22002,2,220,'Cascapara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (22003,2,220,'Mancos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (22004,2,220,'Matacoto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (22005,2,220,'Quillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (22006,2,220,'Ranrahirca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (22007,2,220,'Shupluy',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (22008,2,220,'Yanama',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30101,3,301,'Abancay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30102,3,301,'Chacoche',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30103,3,301,'Circa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30104,3,301,'Curahuasi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30105,3,301,'Huanipaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30106,3,301,'Lambrama',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30107,3,301,'Pichirhua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30108,3,301,'San Pedro de Cachora',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30109,3,301,'Tamburco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30201,3,302,'Andahuaylas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30202,3,302,'Andarapa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30203,3,302,'Chiara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30204,3,302,'Huancarama',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30205,3,302,'Huancaray',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30206,3,302,'Huayana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30207,3,302,'Kishuara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30208,3,302,'Pacobamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30209,3,302,'Pacucha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30210,3,302,'Pampachiri',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30211,3,302,'Pomacocha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30212,3,302,'San Antonio de Cachi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30213,3,302,'San Jerónimo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30214,3,302,'San Miguel de Chaccrampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30215,3,302,'Santa María de Chicmo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30216,3,302,'Talavera',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30217,3,302,'Tumay Huaraca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30218,3,302,'Turpo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30219,3,302,'Kaquiabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30220,3,302,'José María Arguedas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30301,3,303,'Antabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30302,3,303,'El Oro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30303,3,303,'Huaquirca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30304,3,303,'Juan Espinoza Medrano',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30305,3,303,'Oropesa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30306,3,303,'Pachaconas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30307,3,303,'Sabaino',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30401,3,304,'Chalhuanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30402,3,304,'Capaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30403,3,304,'Caraybamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30404,3,304,'Chapimarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30405,3,304,'Colcabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30406,3,304,'Cotaruse',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30407,3,304,'Ihuayllo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30408,3,304,'Justo Apu Sahuaraura',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30409,3,304,'Lucre',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30410,3,304,'Pocohuanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30411,3,304,'San Juan de Chacña',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30412,3,304,'Sañayca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30413,3,304,'Soraya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30414,3,304,'Tapairihua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30415,3,304,'Tintay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30416,3,304,'Toraya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30417,3,304,'Yanaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30501,3,305,'Tambobamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30502,3,305,'Cotabambas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30503,3,305,'Coyllurqui',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30504,3,305,'Haquira',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30505,3,305,'Mara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30506,3,305,'Challhuahuacho',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30601,3,306,'Chincheros',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30602,3,306,'Anco_Huallo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30603,3,306,'Cocharcas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30604,3,306,'Huaccana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30605,3,306,'Ocobamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30606,3,306,'Ongoy',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30607,3,306,'Uranmarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30608,3,306,'Ranracancha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30609,3,306,'Rocchacc',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30610,3,306,'El Porvenir',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30611,3,306,'Los Chankas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30701,3,307,'Chuquibambilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30702,3,307,'Curpahuasi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30703,3,307,'Gamarra',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30704,3,307,'Huayllati',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30705,3,307,'Mamara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30706,3,307,'Micaela Bastidas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30707,3,307,'Pataypampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30708,3,307,'Progreso',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30709,3,307,'San Antonio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30710,3,307,'Santa Rosa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30711,3,307,'Turpay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30712,3,307,'Vilcabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30713,3,307,'Virundo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (30714,3,307,'Curasco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40101,4,401,'Arequipa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40102,4,401,'Alto Selva Alegre',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40103,4,401,'Cayma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40104,4,401,'Cerro Colorado',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40105,4,401,'Characato',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40106,4,401,'Chiguata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40107,4,401,'Jacobo Hunter',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40108,4,401,'La Joya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40109,4,401,'Mariano Melgar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40110,4,401,'Miraflores',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40111,4,401,'Mollebaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40112,4,401,'Paucarpata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40113,4,401,'Pocsi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40114,4,401,'Polobaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40115,4,401,'Quequeña',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40116,4,401,'Sabandia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40117,4,401,'Sachaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40118,4,401,'San Juan de Siguas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40119,4,401,'San Juan de Tarucani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40120,4,401,'Santa Isabel de Siguas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40121,4,401,'Santa Rita de Siguas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40122,4,401,'Socabaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40123,4,401,'Tiabaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40124,4,401,'Uchumayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40125,4,401,'Vitor',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40126,4,401,'Yanahuara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40127,4,401,'Yarabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40128,4,401,'Yura',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40129,4,401,'José Luis Bustamante Y Rivero',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40201,4,402,'Camaná',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40202,4,402,'José María Quimper',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40203,4,402,'Mariano Nicolás Valcárcel',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40204,4,402,'Mariscal Cáceres',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40205,4,402,'Nicolás de Pierola',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40206,4,402,'Ocoña',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40207,4,402,'Quilca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40208,4,402,'Samuel Pastor',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40301,4,403,'Caravelí',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40302,4,403,'Acarí',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40303,4,403,'Atico',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40304,4,403,'Atiquipa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40305,4,403,'Bella Unión',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40306,4,403,'Cahuacho',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40307,4,403,'Chala',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40308,4,403,'Chaparra',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40309,4,403,'Huanuhuanu',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40310,4,403,'Jaqui',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40311,4,403,'Lomas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40312,4,403,'Quicacha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40313,4,403,'Yauca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40401,4,404,'Aplao',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40402,4,404,'Andagua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40403,4,404,'Ayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40404,4,404,'Chachas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40405,4,404,'Chilcaymarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40406,4,404,'Choco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40407,4,404,'Huancarqui',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40408,4,404,'Machaguay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40409,4,404,'Orcopampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40410,4,404,'Pampacolca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40411,4,404,'Tipan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40412,4,404,'Uñon',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40413,4,404,'Uraca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40414,4,404,'Viraco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40501,4,405,'Chivay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40502,4,405,'Achoma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40503,4,405,'Cabanaconde',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40504,4,405,'Callalli',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40505,4,405,'Caylloma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40506,4,405,'Coporaque',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40507,4,405,'Huambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40508,4,405,'Huanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40509,4,405,'Ichupampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40510,4,405,'Lari',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40511,4,405,'Lluta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40512,4,405,'Maca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40513,4,405,'Madrigal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40514,4,405,'San Antonio de Chuca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40515,4,405,'Sibayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40516,4,405,'Tapay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40517,4,405,'Tisco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40518,4,405,'Tuti',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40519,4,405,'Yanque',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40520,4,405,'Majes',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40601,4,406,'Chuquibamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40602,4,406,'Andaray',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40603,4,406,'Cayarani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40604,4,406,'Chichas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40605,4,406,'Iray',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40606,4,406,'Río Grande',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40607,4,406,'Salamanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40608,4,406,'Yanaquihua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40701,4,407,'Mollendo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40702,4,407,'Cocachacra',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40703,4,407,'Dean Valdivia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40704,4,407,'Islay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40705,4,407,'Mejia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40706,4,407,'Punta de Bombón',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40801,4,408,'Cotahuasi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40802,4,408,'Alca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40803,4,408,'Charcana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40804,4,408,'Huaynacotas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40805,4,408,'Pampamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40806,4,408,'Puyca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40807,4,408,'Quechualla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40808,4,408,'Sayla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40809,4,408,'Tauria',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40810,4,408,'Tomepampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (40811,4,408,'Toro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50101,5,501,'Ayacucho',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50102,5,501,'Acocro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50103,5,501,'Acos Vinchos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50104,5,501,'Carmen Alto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50105,5,501,'Chiara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50106,5,501,'Ocros',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50107,5,501,'Pacaycasa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50108,5,501,'Quinua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50109,5,501,'San José de Ticllas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50110,5,501,'San Juan Bautista',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50111,5,501,'Santiago de Pischa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50112,5,501,'Socos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50113,5,501,'Tambillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50114,5,501,'Vinchos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50115,5,501,'Jesús Nazareno',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50116,5,501,'Andrés Avelino Cáceres Dorregaray',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50201,5,502,'Cangallo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50202,5,502,'Chuschi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50203,5,502,'Los Morochucos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50204,5,502,'María Parado de Bellido',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50205,5,502,'Paras',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50206,5,502,'Totos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50301,5,503,'Sancos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50302,5,503,'Carapo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50303,5,503,'Sacsamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50304,5,503,'Santiago de Lucanamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50401,5,504,'Huanta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50402,5,504,'Ayahuanco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50403,5,504,'Huamanguilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50404,5,504,'Iguain',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50405,5,504,'Luricocha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50406,5,504,'Santillana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50407,5,504,'Sivia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50408,5,504,'Llochegua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50409,5,504,'Canayre',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50410,5,504,'Uchuraccay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50411,5,504,'Pucacolpa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50412,5,504,'Chaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50501,5,505,'San Miguel',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50502,5,505,'Anco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50503,5,505,'Ayna',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50504,5,505,'Chilcas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50505,5,505,'Chungui',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50506,5,505,'Luis Carranza',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50507,5,505,'Santa Rosa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50508,5,505,'Tambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50509,5,505,'Samugari',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50510,5,505,'Anchihuay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50511,5,505,'Oronccoy',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50601,5,506,'Puquio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50602,5,506,'Aucara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50603,5,506,'Cabana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50604,5,506,'Carmen Salcedo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50605,5,506,'Chaviña',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50606,5,506,'Chipao',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50607,5,506,'Huac-Huas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50608,5,506,'Laramate',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50609,5,506,'Leoncio Prado',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50610,5,506,'Llauta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50611,5,506,'Lucanas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50612,5,506,'Ocaña',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50613,5,506,'Otoca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50614,5,506,'Saisa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50615,5,506,'San Cristóbal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50616,5,506,'San Juan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50617,5,506,'San Pedro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50618,5,506,'San Pedro de Palco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50619,5,506,'Sancos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50620,5,506,'Santa Ana de Huaycahuacho',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50621,5,506,'Santa Lucia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50701,5,507,'Coracora',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50702,5,507,'Chumpi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50703,5,507,'Coronel Castañeda',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50704,5,507,'Pacapausa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50705,5,507,'Pullo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50706,5,507,'Puyusca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50707,5,507,'San Francisco de Ravacayco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50708,5,507,'Upahuacho',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50801,5,508,'Pausa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50802,5,508,'Colta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50803,5,508,'Corculla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50804,5,508,'Lampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50805,5,508,'Marcabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50806,5,508,'Oyolo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50807,5,508,'Pararca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50808,5,508,'San Javier de Alpabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50809,5,508,'San José de Ushua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50810,5,508,'Sara Sara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50901,5,509,'Querobamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50902,5,509,'Belén',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50903,5,509,'Chalcos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50904,5,509,'Chilcayoc',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50905,5,509,'Huacaña',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50906,5,509,'Morcolla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50907,5,509,'Paico',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50908,5,509,'San Pedro de Larcay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50909,5,509,'San Salvador de Quije',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50910,5,509,'Santiago de Paucaray',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (50911,5,509,'Soras',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51001,5,510,'Huancapi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51002,5,510,'Alcamenca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51003,5,510,'Apongo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51004,5,510,'Asquipata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51005,5,510,'Canaria',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51006,5,510,'Cayara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51007,5,510,'Colca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51008,5,510,'Huamanquiquia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51009,5,510,'Huancaraylla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51010,5,510,'Hualla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51011,5,510,'Sarhua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51012,5,510,'Vilcanchos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51101,5,511,'Vilcas Huaman',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51102,5,511,'Accomarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51103,5,511,'Carhuanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51104,5,511,'Concepción',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51105,5,511,'Huambalpa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51106,5,511,'Independencia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51107,5,511,'Saurama',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (51108,5,511,'Vischongo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60101,6,601,'Cajamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60102,6,601,'Asunción',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60103,6,601,'Chetilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60104,6,601,'Cospan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60105,6,601,'Encañada',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60106,6,601,'Jesús',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60107,6,601,'Llacanora',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60108,6,601,'Los Baños del Inca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60109,6,601,'Magdalena',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60110,6,601,'Matara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60111,6,601,'Namora',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60112,6,601,'San Juan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60201,6,602,'Cajabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60202,6,602,'Cachachi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60203,6,602,'Condebamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60204,6,602,'Sitacocha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60301,6,603,'Celendín',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60302,6,603,'Chumuch',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60303,6,603,'Cortegana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60304,6,603,'Huasmin',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60305,6,603,'Jorge Chávez',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60306,6,603,'José Gálvez',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60307,6,603,'Miguel Iglesias',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60308,6,603,'Oxamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60309,6,603,'Sorochuco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60310,6,603,'Sucre',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60311,6,603,'Utco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60312,6,603,'La Libertad de Pallan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60401,6,604,'Chota',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60402,6,604,'Anguia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60403,6,604,'Chadin',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60404,6,604,'Chiguirip',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60405,6,604,'Chimban',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60406,6,604,'Choropampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60407,6,604,'Cochabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60408,6,604,'Conchan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60409,6,604,'Huambos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60410,6,604,'Lajas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60411,6,604,'Llama',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60412,6,604,'Miracosta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60413,6,604,'Paccha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60414,6,604,'Pion',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60415,6,604,'Querocoto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60416,6,604,'San Juan de Licupis',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60417,6,604,'Tacabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60418,6,604,'Tocmoche',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60419,6,604,'Chalamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60501,6,605,'Contumaza',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60502,6,605,'Chilete',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60503,6,605,'Cupisnique',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60504,6,605,'Guzmango',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60505,6,605,'San Benito',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60506,6,605,'Santa Cruz de Toledo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60507,6,605,'Tantarica',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60508,6,605,'Yonan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60601,6,606,'Cutervo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60602,6,606,'Callayuc',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60603,6,606,'Choros',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60604,6,606,'Cujillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60605,6,606,'La Ramada',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60606,6,606,'Pimpingos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60607,6,606,'Querocotillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60608,6,606,'San Andrés de Cutervo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60609,6,606,'San Juan de Cutervo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60610,6,606,'San Luis de Lucma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60611,6,606,'Santa Cruz',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60612,6,606,'Santo Domingo de la Capilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60613,6,606,'Santo Tomas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60614,6,606,'Socota',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60615,6,606,'Toribio Casanova',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60701,6,607,'Bambamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60702,6,607,'Chugur',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60703,6,607,'Hualgayoc',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60801,6,608,'Jaén',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60802,6,608,'Bellavista',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60803,6,608,'Chontali',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60804,6,608,'Colasay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60805,6,608,'Huabal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60806,6,608,'Las Pirias',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60807,6,608,'Pomahuaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60808,6,608,'Pucara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60809,6,608,'Sallique',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60810,6,608,'San Felipe',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60811,6,608,'San José del Alto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60812,6,608,'Santa Rosa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60901,6,609,'San Ignacio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60902,6,609,'Chirinos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60903,6,609,'Huarango',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60904,6,609,'La Coipa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60905,6,609,'Namballe',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60906,6,609,'San José de Lourdes',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (60907,6,609,'Tabaconas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61001,6,610,'Pedro Gálvez',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61002,6,610,'Chancay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61003,6,610,'Eduardo Villanueva',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61004,6,610,'Gregorio Pita',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61005,6,610,'Ichocan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61006,6,610,'José Manuel Quiroz',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61007,6,610,'José Sabogal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61101,6,611,'San Miguel',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61102,6,611,'Bolívar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61103,6,611,'Calquis',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61104,6,611,'Catilluc',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61105,6,611,'El Prado',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61106,6,611,'La Florida',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61107,6,611,'Llapa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61108,6,611,'Nanchoc',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61109,6,611,'Niepos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61110,6,611,'San Gregorio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61111,6,611,'San Silvestre de Cochan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61112,6,611,'Tongod',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61113,6,611,'Unión Agua Blanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61201,6,612,'San Pablo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61202,6,612,'San Bernardino',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61203,6,612,'San Luis',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61204,6,612,'Tumbaden',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61301,6,613,'Santa Cruz',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61302,6,613,'Andabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61303,6,613,'Catache',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61304,6,613,'Chancaybaños',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61305,6,613,'La Esperanza',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61306,6,613,'Ninabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61307,6,613,'Pulan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61308,6,613,'Saucepampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61309,6,613,'Sexi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61310,6,613,'Uticyacu',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (61311,6,613,'Yauyucan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (70101,7,701,'Callao',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (70102,7,701,'Bellavista',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (70103,7,701,'Carmen de la Legua Reynoso',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (70104,7,701,'La Perla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (70105,7,701,'La Punta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (70106,7,701,'Ventanilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (70107,7,701,'Mi Perú',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80101,8,801,'Cusco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80102,8,801,'Ccorca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80103,8,801,'Poroy',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80104,8,801,'San Jerónimo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80105,8,801,'San Sebastian',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80106,8,801,'Santiago',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80107,8,801,'Saylla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80108,8,801,'Wanchaq',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80201,8,802,'Acomayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80202,8,802,'Acopia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80203,8,802,'Acos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80204,8,802,'Mosoc Llacta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80205,8,802,'Pomacanchi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80206,8,802,'Rondocan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80207,8,802,'Sangarara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80301,8,803,'Anta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80302,8,803,'Ancahuasi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80303,8,803,'Cachimayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80304,8,803,'Chinchaypujio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80305,8,803,'Huarocondo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80306,8,803,'Limatambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80307,8,803,'Mollepata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80308,8,803,'Pucyura',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80309,8,803,'Zurite',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80401,8,804,'Calca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80402,8,804,'Coya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80403,8,804,'Lamay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80404,8,804,'Lares',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80405,8,804,'Pisac',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80406,8,804,'San Salvador',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80407,8,804,'Taray',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80408,8,804,'Yanatile',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80501,8,805,'Yanaoca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80502,8,805,'Checca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80503,8,805,'Kunturkanki',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80504,8,805,'Langui',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80505,8,805,'Layo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80506,8,805,'Pampamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80507,8,805,'Quehue',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80508,8,805,'Tupac Amaru',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80601,8,806,'Sicuani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80602,8,806,'Checacupe',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80603,8,806,'Combapata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80604,8,806,'Marangani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80605,8,806,'Pitumarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80606,8,806,'San Pablo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80607,8,806,'San Pedro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80608,8,806,'Tinta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80701,8,807,'Santo Tomas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80702,8,807,'Capacmarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80703,8,807,'Chamaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80704,8,807,'Colquemarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80705,8,807,'Livitaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80706,8,807,'Llusco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80707,8,807,'Quiñota',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80708,8,807,'Velille',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80801,8,808,'Espinar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80802,8,808,'Condoroma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80803,8,808,'Coporaque',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80804,8,808,'Ocoruro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80805,8,808,'Pallpata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80806,8,808,'Pichigua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80807,8,808,'Suyckutambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80808,8,808,'Alto Pichigua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80901,8,809,'Santa Ana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80902,8,809,'Echarate',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80903,8,809,'Huayopata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80904,8,809,'Maranura',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80905,8,809,'Ocobamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80906,8,809,'Quellouno',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80907,8,809,'Kimbiri',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80908,8,809,'Santa Teresa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80909,8,809,'Vilcabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80910,8,809,'Pichari',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80911,8,809,'Inkawasi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80912,8,809,'Villa Virgen',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80913,8,809,'Villa Kintiarina',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (80914,8,809,'Megantoni',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81001,8,810,'Paruro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81002,8,810,'Accha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81003,8,810,'Ccapi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81004,8,810,'Colcha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81005,8,810,'Huanoquite',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81006,8,810,'Omachaç',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81007,8,810,'Paccaritambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81008,8,810,'Pillpinto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81009,8,810,'Yaurisque',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81101,8,811,'Paucartambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81102,8,811,'Caicay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81103,8,811,'Challabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81104,8,811,'Colquepata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81105,8,811,'Huancarani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81106,8,811,'Kosñipata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81201,8,812,'Urcos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81202,8,812,'Andahuaylillas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81203,8,812,'Camanti',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81204,8,812,'Ccarhuayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81205,8,812,'Ccatca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81206,8,812,'Cusipata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81207,8,812,'Huaro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81208,8,812,'Lucre',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81209,8,812,'Marcapata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81210,8,812,'Ocongate',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81211,8,812,'Oropesa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81212,8,812,'Quiquijana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81301,8,813,'Urubamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81302,8,813,'Chinchero',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81303,8,813,'Huayllabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81304,8,813,'Machupicchu',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81305,8,813,'Maras',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81306,8,813,'Ollantaytambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (81307,8,813,'Yucay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90101,9,901,'Huancavelica',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90102,9,901,'Acobambilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90103,9,901,'Acoria',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90104,9,901,'Conayca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90105,9,901,'Cuenca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90106,9,901,'Huachocolpa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90107,9,901,'Huayllahuara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90108,9,901,'Izcuchaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90109,9,901,'Laria',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90110,9,901,'Manta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90111,9,901,'Mariscal Cáceres',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90112,9,901,'Moya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90113,9,901,'Nuevo Occoro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90114,9,901,'Palca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90115,9,901,'Pilchaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90116,9,901,'Vilca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90117,9,901,'Yauli',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90118,9,901,'Ascensión',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90119,9,901,'Huando',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90201,9,902,'Acobamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90202,9,902,'Andabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90203,9,902,'Anta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90204,9,902,'Caja',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90205,9,902,'Marcas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90206,9,902,'Paucara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90207,9,902,'Pomacocha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90208,9,902,'Rosario',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90301,9,903,'Lircay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90302,9,903,'Anchonga',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90303,9,903,'Callanmarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90304,9,903,'Ccochaccasa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90305,9,903,'Chincho',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90306,9,903,'Congalla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90307,9,903,'Huanca-Huanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90308,9,903,'Huayllay Grande',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90309,9,903,'Julcamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90310,9,903,'San Antonio de Antaparco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90311,9,903,'Santo Tomas de Pata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90312,9,903,'Secclla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90401,9,904,'Castrovirreyna',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90402,9,904,'Arma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90403,9,904,'Aurahua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90404,9,904,'Capillas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90405,9,904,'Chupamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90406,9,904,'Cocas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90407,9,904,'Huachos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90408,9,904,'Huamatambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90409,9,904,'Mollepampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90410,9,904,'San Juan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90411,9,904,'Santa Ana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90412,9,904,'Tantara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90413,9,904,'Ticrapo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90501,9,905,'Churcampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90502,9,905,'Anco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90503,9,905,'Chinchihuasi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90504,9,905,'El Carmen',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90505,9,905,'La Merced',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90506,9,905,'Locroja',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90507,9,905,'Paucarbamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90508,9,905,'San Miguel de Mayocc',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90509,9,905,'San Pedro de Coris',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90510,9,905,'Pachamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90511,9,905,'Cosme',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90601,9,906,'Huaytara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90602,9,906,'Ayavi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90603,9,906,'Córdova',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90604,9,906,'Huayacundo Arma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90605,9,906,'Laramarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90606,9,906,'Ocoyo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90607,9,906,'Pilpichaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90608,9,906,'Querco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90609,9,906,'Quito-Arma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90610,9,906,'San Antonio de Cusicancha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90611,9,906,'San Francisco de Sangayaico',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90612,9,906,'San Isidro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90613,9,906,'Santiago de Chocorvos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90614,9,906,'Santiago de Quirahuara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90615,9,906,'Santo Domingo de Capillas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90616,9,906,'Tambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90701,9,907,'Pampas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90702,9,907,'Acostambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90703,9,907,'Acraquia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90704,9,907,'Ahuaycha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90705,9,907,'Colcabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90706,9,907,'Daniel Hernández',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90707,9,907,'Huachocolpa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90709,9,907,'Huaribamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90710,9,907,'Ñahuimpuquio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90711,9,907,'Pazos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90713,9,907,'Quishuar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90714,9,907,'Salcabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90715,9,907,'Salcahuasi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90716,9,907,'San Marcos de Rocchac',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90717,9,907,'Surcubamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90718,9,907,'Tintay Puncu',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90719,9,907,'Quichuas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90720,9,907,'Andaymarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90721,9,907,'Roble',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90722,9,907,'Pichos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (90723,9,907,'Santiago de Tucuma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100101,10,1001,'Huanuco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100102,10,1001,'Amarilis',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100103,10,1001,'Chinchao',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100104,10,1001,'Churubamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100105,10,1001,'Margos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100106,10,1001,'Quisqui (Kichki)',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100107,10,1001,'San Francisco de Cayran',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100108,10,1001,'San Pedro de Chaulan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100109,10,1001,'Santa María del Valle',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100110,10,1001,'Yarumayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100111,10,1001,'Pillco Marca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100112,10,1001,'Yacus',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100113,10,1001,'San Pablo de Pillao',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100201,10,1002,'Ambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100202,10,1002,'Cayna',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100203,10,1002,'Colpas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100204,10,1002,'Conchamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100205,10,1002,'Huacar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100206,10,1002,'San Francisco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100207,10,1002,'San Rafael',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100208,10,1002,'Tomay Kichwa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100301,10,1003,'La Unión',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100307,10,1003,'Chuquis',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100311,10,1003,'Marías',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100313,10,1003,'Pachas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100316,10,1003,'Quivilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100317,10,1003,'Ripan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100321,10,1003,'Shunqui',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100322,10,1003,'Sillapata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100323,10,1003,'Yanas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100401,10,1004,'Huacaybamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100402,10,1004,'Canchabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100403,10,1004,'Cochabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100404,10,1004,'Pinra',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100501,10,1005,'Llata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100502,10,1005,'Arancay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100503,10,1005,'Chavín de Pariarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100504,10,1005,'Jacas Grande',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100505,10,1005,'Jircan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100506,10,1005,'Miraflores',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100507,10,1005,'Monzón',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100508,10,1005,'Punchao',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100509,10,1005,'Puños',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100510,10,1005,'Singa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100511,10,1005,'Tantamayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100601,10,1006,'Rupa-Rupa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100602,10,1006,'Daniel Alomía Robles',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100603,10,1006,'Hermílio Valdizan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100604,10,1006,'José Crespo y Castillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100605,10,1006,'Luyando',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100606,10,1006,'Mariano Damaso Beraun',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100607,10,1006,'Pucayacu',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100608,10,1006,'Castillo Grande',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100609,10,1006,'Pueblo Nuevo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100610,10,1006,'Santo Domingo de Anda',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100701,10,1007,'Huacrachuco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100702,10,1007,'Cholon',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100703,10,1007,'San Buenaventura',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100704,10,1007,'La Morada',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100705,10,1007,'Santa Rosa de Alto Yanajanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100801,10,1008,'Panao',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100802,10,1008,'Chaglla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100803,10,1008,'Molino',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100804,10,1008,'Umari',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100901,10,1009,'Puerto Inca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100902,10,1009,'Codo del Pozuzo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100903,10,1009,'Honoria',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100904,10,1009,'Tournavista',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (100905,10,1009,'Yuyapichis',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101001,10,1010,'Jesús',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101002,10,1010,'Baños',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101003,10,1010,'Jivia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101004,10,1010,'Queropalca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101005,10,1010,'Rondos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101006,10,1010,'San Francisco de Asís',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101007,10,1010,'San Miguel de Cauri',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101101,10,1011,'Chavinillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101102,10,1011,'Cahuac',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101103,10,1011,'Chacabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101104,10,1011,'Aparicio Pomares',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101105,10,1011,'Jacas Chico',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101106,10,1011,'Obas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101107,10,1011,'Pampamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (101108,10,1011,'Choras',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110101,11,1101,'Ica',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110102,11,1101,'La Tinguiña',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110103,11,1101,'Los Aquijes',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110104,11,1101,'Ocucaje',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110105,11,1101,'Pachacutec',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110106,11,1101,'Parcona',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110107,11,1101,'Pueblo Nuevo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110108,11,1101,'Salas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110109,11,1101,'San José de Los Molinos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110110,11,1101,'San Juan Bautista',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110111,11,1101,'Santiago',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110112,11,1101,'Subtanjalla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110113,11,1101,'Tate',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110114,11,1101,'Yauca del Rosario',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110201,11,1102,'Chincha Alta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110202,11,1102,'Alto Laran',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110203,11,1102,'Chavin',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110204,11,1102,'Chincha Baja',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110205,11,1102,'El Carmen',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110206,11,1102,'Grocio Prado',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110207,11,1102,'Pueblo Nuevo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110208,11,1102,'San Juan de Yanac',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110209,11,1102,'San Pedro de Huacarpana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110210,11,1102,'Sunampe',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110211,11,1102,'Tambo de Mora',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110301,11,1103,'Nasca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110302,11,1103,'Changuillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110303,11,1103,'El Ingenio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110304,11,1103,'Marcona',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110305,11,1103,'Vista Alegre',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110401,11,1104,'Palpa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110402,11,1104,'Llipata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110403,11,1104,'Río Grande',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110404,11,1104,'Santa Cruz',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110405,11,1104,'Tibillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110501,11,1105,'Pisco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110502,11,1105,'Huancano',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110503,11,1105,'Humay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110504,11,1105,'Independencia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110505,11,1105,'Paracas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110506,11,1105,'San Andrés',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110507,11,1105,'San Clemente',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (110508,11,1105,'Tupac Amaru Inca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120101,12,1201,'Huancayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120104,12,1201,'Carhuacallanga',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120105,12,1201,'Chacapampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120106,12,1201,'Chicche',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120107,12,1201,'Chilca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120108,12,1201,'Chongos Alto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120111,12,1201,'Chupuro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120112,12,1201,'Colca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120113,12,1201,'Cullhuas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120114,12,1201,'El Tambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120116,12,1201,'Huacrapuquio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120117,12,1201,'Hualhuas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120119,12,1201,'Huancan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120120,12,1201,'Huasicancha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120121,12,1201,'Huayucachi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120122,12,1201,'Ingenio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120124,12,1201,'Pariahuanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120125,12,1201,'Pilcomayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120126,12,1201,'Pucara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120127,12,1201,'Quichuay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120128,12,1201,'Quilcas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120129,12,1201,'San Agustín',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120130,12,1201,'San Jerónimo de Tunan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120132,12,1201,'Saño',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120133,12,1201,'Sapallanga',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120134,12,1201,'Sicaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120135,12,1201,'Santo Domingo de Acobamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120136,12,1201,'Viques',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120201,12,1202,'Concepción',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120202,12,1202,'Aco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120203,12,1202,'Andamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120204,12,1202,'Chambara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120205,12,1202,'Cochas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120206,12,1202,'Comas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120207,12,1202,'Heroínas Toledo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120208,12,1202,'Manzanares',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120209,12,1202,'Mariscal Castilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120210,12,1202,'Matahuasi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120211,12,1202,'Mito',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120212,12,1202,'Nueve de Julio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120213,12,1202,'Orcotuna',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120214,12,1202,'San José de Quero',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120215,12,1202,'Santa Rosa de Ocopa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120301,12,1203,'Chanchamayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120302,12,1203,'Perene',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120303,12,1203,'Pichanaqui',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120304,12,1203,'San Luis de Shuaro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120305,12,1203,'San Ramón',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120306,12,1203,'Vitoc',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120401,12,1204,'Jauja',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120402,12,1204,'Acolla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120403,12,1204,'Apata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120404,12,1204,'Ataura',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120405,12,1204,'Canchayllo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120406,12,1204,'Curicaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120407,12,1204,'El Mantaro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120408,12,1204,'Huamali',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120409,12,1204,'Huaripampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120410,12,1204,'Huertas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120411,12,1204,'Janjaillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120412,12,1204,'Julcán',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120413,12,1204,'Leonor Ordóñez',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120414,12,1204,'Llocllapampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120415,12,1204,'Marco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120416,12,1204,'Masma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120417,12,1204,'Masma Chicche',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120418,12,1204,'Molinos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120419,12,1204,'Monobamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120420,12,1204,'Muqui',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120421,12,1204,'Muquiyauyo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120422,12,1204,'Paca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120423,12,1204,'Paccha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120424,12,1204,'Pancan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120425,12,1204,'Parco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120426,12,1204,'Pomacancha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120427,12,1204,'Ricran',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120428,12,1204,'San Lorenzo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120429,12,1204,'San Pedro de Chunan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120430,12,1204,'Sausa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120431,12,1204,'Sincos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120432,12,1204,'Tunan Marca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120433,12,1204,'Yauli',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120434,12,1204,'Yauyos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120501,12,1205,'Junin',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120502,12,1205,'Carhuamayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120503,12,1205,'Ondores',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120504,12,1205,'Ulcumayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120601,12,1206,'Satipo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120602,12,1206,'Coviriali',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120603,12,1206,'Llaylla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120604,12,1206,'Mazamari',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120605,12,1206,'Pampa Hermosa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120606,12,1206,'Pangoa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120607,12,1206,'Río Negro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120608,12,1206,'Río Tambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120609,12,1206,'Vizcatan del Ene',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120701,12,1207,'Tarma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120702,12,1207,'Acobamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120703,12,1207,'Huaricolca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120704,12,1207,'Huasahuasi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120705,12,1207,'La Unión',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120706,12,1207,'Palca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120707,12,1207,'Palcamayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120708,12,1207,'San Pedro de Cajas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120709,12,1207,'Tapo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120801,12,1208,'La Oroya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120802,12,1208,'Chacapalpa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120803,12,1208,'Huay-Huay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120804,12,1208,'Marcapomacocha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120805,12,1208,'Morococha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120806,12,1208,'Paccha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120807,12,1208,'Santa Bárbara de Carhuacayan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120808,12,1208,'Santa Rosa de Sacco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120809,12,1208,'Suitucancha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120810,12,1208,'Yauli',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120901,12,1209,'Chupaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120902,12,1209,'Ahuac',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120903,12,1209,'Chongos Bajo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120904,12,1209,'Huachac',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120905,12,1209,'Huamancaca Chico',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120906,12,1209,'San Juan de Iscos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120907,12,1209,'San Juan de Jarpa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120908,12,1209,'Tres de Diciembre',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (120909,12,1209,'Yanacancha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130101,13,1301,'Trujillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130102,13,1301,'El Porvenir',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130103,13,1301,'Florencia de Mora',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130104,13,1301,'Huanchaco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130105,13,1301,'La Esperanza',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130106,13,1301,'Laredo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130107,13,1301,'Moche',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130108,13,1301,'Poroto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130109,13,1301,'Salaverry',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130110,13,1301,'Simbal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130111,13,1301,'Victor Larco Herrera',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130201,13,1302,'Ascope',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130202,13,1302,'Chicama',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130203,13,1302,'Chocope',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130204,13,1302,'Magdalena de Cao',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130205,13,1302,'Paijan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130206,13,1302,'Rázuri',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130207,13,1302,'Santiago de Cao',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130208,13,1302,'Casa Grande',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130301,13,1303,'Bolívar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130302,13,1303,'Bambamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130303,13,1303,'Condormarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130304,13,1303,'Longotea',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130305,13,1303,'Uchumarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130306,13,1303,'Ucuncha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130401,13,1304,'Chepen',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130402,13,1304,'Pacanga',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130403,13,1304,'Pueblo Nuevo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130501,13,1305,'Julcan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130502,13,1305,'Calamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130503,13,1305,'Carabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130504,13,1305,'Huaso',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130601,13,1306,'Otuzco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130602,13,1306,'Agallpampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130604,13,1306,'Charat',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130605,13,1306,'Huaranchal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130606,13,1306,'La Cuesta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130608,13,1306,'Mache',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130610,13,1306,'Paranday',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130611,13,1306,'Salpo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130613,13,1306,'Sinsicap',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130614,13,1306,'Usquil',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130701,13,1307,'San Pedro de Lloc',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130702,13,1307,'Guadalupe',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130703,13,1307,'Jequetepeque',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130704,13,1307,'Pacasmayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130705,13,1307,'San José',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130801,13,1308,'Tayabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130802,13,1308,'Buldibuyo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130803,13,1308,'Chillia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130804,13,1308,'Huancaspata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130805,13,1308,'Huaylillas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130806,13,1308,'Huayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130807,13,1308,'Ongon',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130808,13,1308,'Parcoy',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130809,13,1308,'Pataz',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130810,13,1308,'Pias',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130811,13,1308,'Santiago de Challas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130812,13,1308,'Taurija',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130813,13,1308,'Urpay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130901,13,1309,'Huamachuco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130902,13,1309,'Chugay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130903,13,1309,'Cochorco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130904,13,1309,'Curgos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130905,13,1309,'Marcabal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130906,13,1309,'Sanagoran',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130907,13,1309,'Sarin',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (130908,13,1309,'Sartimbamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131001,13,1310,'Santiago de Chuco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131002,13,1310,'Angasmarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131003,13,1310,'Cachicadan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131004,13,1310,'Mollebamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131005,13,1310,'Mollepata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131006,13,1310,'Quiruvilca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131007,13,1310,'Santa Cruz de Chuca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131008,13,1310,'Sitabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131101,13,1311,'Cascas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131102,13,1311,'Lucma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131103,13,1311,'Marmot',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131104,13,1311,'Sayapullo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131201,13,1312,'Viru',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131202,13,1312,'Chao',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (131203,13,1312,'Guadalupito',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140101,14,1401,'Chiclayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140102,14,1401,'Chongoyape',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140103,14,1401,'Eten',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140104,14,1401,'Eten Puerto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140105,14,1401,'José Leonardo Ortiz',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140106,14,1401,'La Victoria',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140107,14,1401,'Lagunas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140108,14,1401,'Monsefu',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140109,14,1401,'Nueva Arica',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140110,14,1401,'Oyotun',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140111,14,1401,'Picsi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140112,14,1401,'Pimentel',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140113,14,1401,'Reque',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140114,14,1401,'Santa Rosa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140115,14,1401,'Saña',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140116,14,1401,'Cayalti',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140117,14,1401,'Patapo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140118,14,1401,'Pomalca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140119,14,1401,'Pucala',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140120,14,1401,'Tuman',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140201,14,1402,'Ferreñafe',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140202,14,1402,'Cañaris',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140203,14,1402,'Incahuasi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140204,14,1402,'Manuel Antonio Mesones Muro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140205,14,1402,'Pitipo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140206,14,1402,'Pueblo Nuevo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140301,14,1403,'Lambayeque',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140302,14,1403,'Chochope',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140303,14,1403,'Illimo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140304,14,1403,'Jayanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140305,14,1403,'Mochumi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140306,14,1403,'Morrope',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140307,14,1403,'Motupe',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140308,14,1403,'Olmos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140309,14,1403,'Pacora',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140310,14,1403,'Salas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140311,14,1403,'San José',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (140312,14,1403,'Tucume',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150101,15,1501,'Lima',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150102,15,1501,'Ancón',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150103,15,1501,'Ate',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150104,15,1501,'Barranco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150105,15,1501,'Breña',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150106,15,1501,'Carabayllo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150107,15,1501,'Chaclacayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150108,15,1501,'Chorrillos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150109,15,1501,'Cieneguilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150110,15,1501,'Comas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150111,15,1501,'El Agustino',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150112,15,1501,'Independencia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150113,15,1501,'Jesús María',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150114,15,1501,'La Molina',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150115,15,1501,'La Victoria',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150116,15,1501,'Lince',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150117,15,1501,'Los Olivos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150118,15,1501,'Lurigancho',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150119,15,1501,'Lurin',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150120,15,1501,'Magdalena del Mar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150121,15,1501,'Pueblo Libre',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150122,15,1501,'Miraflores',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150123,15,1501,'Pachacamac',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150124,15,1501,'Pucusana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150125,15,1501,'Puente Piedra',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150126,15,1501,'Punta Hermosa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150127,15,1501,'Punta Negra',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150128,15,1501,'Rímac',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150129,15,1501,'San Bartolo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150130,15,1501,'San Borja',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150131,15,1501,'San Isidro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150132,15,1501,'San Juan de Lurigancho',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150133,15,1501,'San Juan de Miraflores',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150134,15,1501,'San Luis',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150135,15,1501,'San Martín de Porres',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150136,15,1501,'San Miguel',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150137,15,1501,'Santa Anita',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150138,15,1501,'Santa María del Mar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150139,15,1501,'Santa Rosa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150140,15,1501,'Santiago de Surco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150141,15,1501,'Surquillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150142,15,1501,'Villa El Salvador',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150143,15,1501,'Villa María del Triunfo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150201,15,1502,'Barranca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150202,15,1502,'Paramonga',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150203,15,1502,'Pativilca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150204,15,1502,'Supe',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150205,15,1502,'Supe Puerto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150301,15,1503,'Cajatambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150302,15,1503,'Copa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150303,15,1503,'Gorgor',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150304,15,1503,'Huancapon',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150305,15,1503,'Manas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150401,15,1504,'Canta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150402,15,1504,'Arahuay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150403,15,1504,'Huamantanga',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150404,15,1504,'Huaros',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150405,15,1504,'Lachaqui',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150406,15,1504,'San Buenaventura',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150407,15,1504,'Santa Rosa de Quives',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150501,15,1505,'San Vicente de Cañete',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150502,15,1505,'Asia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150503,15,1505,'Calango',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150504,15,1505,'Cerro Azul',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150505,15,1505,'Chilca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150506,15,1505,'Coayllo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150507,15,1505,'Imperial',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150508,15,1505,'Lunahuana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150509,15,1505,'Mala',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150510,15,1505,'Nuevo Imperial',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150511,15,1505,'Pacaran',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150512,15,1505,'Quilmana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150513,15,1505,'San Antonio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150514,15,1505,'San Luis',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150515,15,1505,'Santa Cruz de Flores',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150516,15,1505,'Zúñiga',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150601,15,1506,'Huaral',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150602,15,1506,'Atavillos Alto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150603,15,1506,'Atavillos Bajo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150604,15,1506,'Aucallama',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150605,15,1506,'Chancay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150606,15,1506,'Ihuari',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150607,15,1506,'Lampian',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150608,15,1506,'Pacaraos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150609,15,1506,'San Miguel de Acos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150610,15,1506,'Santa Cruz de Andamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150611,15,1506,'Sumbilca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150612,15,1506,'Veintisiete de Noviembre',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150701,15,1507,'Matucana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150702,15,1507,'Antioquia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150703,15,1507,'Callahuanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150704,15,1507,'Carampoma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150705,15,1507,'Chicla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150706,15,1507,'Cuenca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150707,15,1507,'Huachupampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150708,15,1507,'Huanza',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150709,15,1507,'Huarochiri',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150710,15,1507,'Lahuaytambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150711,15,1507,'Langa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150712,15,1507,'Laraos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150713,15,1507,'Mariatana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150714,15,1507,'Ricardo Palma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150715,15,1507,'San Andrés de Tupicocha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150716,15,1507,'San Antonio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150717,15,1507,'San Bartolomé',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150718,15,1507,'San Damian',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150719,15,1507,'San Juan de Iris',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150720,15,1507,'San Juan de Tantaranche',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150721,15,1507,'San Lorenzo de Quinti',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150722,15,1507,'San Mateo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150723,15,1507,'San Mateo de Otao',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150724,15,1507,'San Pedro de Casta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150725,15,1507,'San Pedro de Huancayre',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150726,15,1507,'Sangallaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150727,15,1507,'Santa Cruz de Cocachacra',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150728,15,1507,'Santa Eulalia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150729,15,1507,'Santiago de Anchucaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150730,15,1507,'Santiago de Tuna',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150731,15,1507,'Santo Domingo de Los Olleros',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150732,15,1507,'Surco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150801,15,1508,'Huacho',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150802,15,1508,'Ambar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150803,15,1508,'Caleta de Carquin',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150804,15,1508,'Checras',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150805,15,1508,'Hualmay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150806,15,1508,'Huaura',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150807,15,1508,'Leoncio Prado',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150808,15,1508,'Paccho',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150809,15,1508,'Santa Leonor',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150810,15,1508,'Santa María',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150811,15,1508,'Sayan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150812,15,1508,'Vegueta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150901,15,1509,'Oyon',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150902,15,1509,'Andajes',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150903,15,1509,'Caujul',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150904,15,1509,'Cochamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150905,15,1509,'Navan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (150906,15,1509,'Pachangara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151001,15,1510,'Yauyos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151002,15,1510,'Alis',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151003,15,1510,'Allauca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151004,15,1510,'Ayaviri',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151005,15,1510,'Azángaro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151006,15,1510,'Cacra',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151007,15,1510,'Carania',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151008,15,1510,'Catahuasi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151009,15,1510,'Chocos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151010,15,1510,'Cochas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151011,15,1510,'Colonia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151012,15,1510,'Hongos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151013,15,1510,'Huampara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151014,15,1510,'Huancaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151015,15,1510,'Huangascar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151016,15,1510,'Huantan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151017,15,1510,'Huañec',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151018,15,1510,'Laraos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151019,15,1510,'Lincha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151020,15,1510,'Madean',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151021,15,1510,'Miraflores',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151022,15,1510,'Omas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151023,15,1510,'Putinza',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151024,15,1510,'Quinches',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151025,15,1510,'Quinocay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151026,15,1510,'San Joaquín',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151027,15,1510,'San Pedro de Pilas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151028,15,1510,'Tanta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151029,15,1510,'Tauripampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151030,15,1510,'Tomas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151031,15,1510,'Tupe',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151032,15,1510,'Viñac',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (151033,15,1510,'Vitis',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160101,16,1601,'Iquitos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160102,16,1601,'Alto Nanay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160103,16,1601,'Fernando Lores',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160104,16,1601,'Indiana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160105,16,1601,'Las Amazonas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160106,16,1601,'Mazan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160107,16,1601,'Napo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160108,16,1601,'Punchana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160110,16,1601,'Torres Causana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160112,16,1601,'Belén',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160113,16,1601,'San Juan Bautista',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160201,16,1602,'Yurimaguas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160202,16,1602,'Balsapuerto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160205,16,1602,'Jeberos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160206,16,1602,'Lagunas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160210,16,1602,'Santa Cruz',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160211,16,1602,'Teniente Cesar López Rojas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160301,16,1603,'Nauta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160302,16,1603,'Parinari',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160303,16,1603,'Tigre',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160304,16,1603,'Trompeteros',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160305,16,1603,'Urarinas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160401,16,1604,'Ramón Castilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160402,16,1604,'Pebas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160403,16,1604,'Yavari',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160404,16,1604,'San Pablo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160501,16,1605,'Requena',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160502,16,1605,'Alto Tapiche',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160503,16,1605,'Capelo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160504,16,1605,'Emilio San Martín',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160505,16,1605,'Maquia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160506,16,1605,'Puinahua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160507,16,1605,'Saquena',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160508,16,1605,'Soplin',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160509,16,1605,'Tapiche',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160510,16,1605,'Jenaro Herrera',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160511,16,1605,'Yaquerana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160601,16,1606,'Contamana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160602,16,1606,'Inahuaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160603,16,1606,'Padre Márquez',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160604,16,1606,'Pampa Hermosa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160605,16,1606,'Sarayacu',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160606,16,1606,'Vargas Guerra',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160701,16,1607,'Barranca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160702,16,1607,'Cahuapanas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160703,16,1607,'Manseriche',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160704,16,1607,'Morona',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160705,16,1607,'Pastaza',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160706,16,1607,'Andoas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160801,16,1608,'Putumayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160802,16,1608,'Rosa Panduro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160803,16,1608,'Teniente Manuel Clavero',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (160804,16,1608,'Yaguas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (170101,17,1701,'Tambopata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (170102,17,1701,'Inambari',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (170103,17,1701,'Las Piedras',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (170104,17,1701,'Laberinto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (170201,17,1702,'Manu',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (170202,17,1702,'Fitzcarrald',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (170203,17,1702,'Madre de Dios',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (170204,17,1702,'Huepetuhe',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (170301,17,1703,'Iñapari',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (170302,17,1703,'Iberia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (170303,17,1703,'Tahuamanu',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180101,18,1801,'Moquegua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180102,18,1801,'Carumas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180103,18,1801,'Cuchumbaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180104,18,1801,'Samegua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180105,18,1801,'San Cristóbal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180106,18,1801,'Torata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180201,18,1802,'Omate',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180202,18,1802,'Chojata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180203,18,1802,'Coalaque',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180204,18,1802,'Ichuña',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180205,18,1802,'La Capilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180206,18,1802,'Lloque',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180207,18,1802,'Matalaque',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180208,18,1802,'Puquina',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180209,18,1802,'Quinistaquillas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180210,18,1802,'Ubinas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180211,18,1802,'Yunga',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180301,18,1803,'Ilo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180302,18,1803,'El Algarrobal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (180303,18,1803,'Pacocha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190101,19,1901,'Chaupimarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190102,19,1901,'Huachon',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190103,19,1901,'Huariaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190104,19,1901,'Huayllay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190105,19,1901,'Ninacaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190106,19,1901,'Pallanchacra',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190107,19,1901,'Paucartambo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190108,19,1901,'San Francisco de Asís de Yarusyacan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190109,19,1901,'Simon Bolívar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190110,19,1901,'Ticlacayan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190111,19,1901,'Tinyahuarco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190112,19,1901,'Vicco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190113,19,1901,'Yanacancha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190201,19,1902,'Yanahuanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190202,19,1902,'Chacayan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190203,19,1902,'Goyllarisquizga',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190204,19,1902,'Paucar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190205,19,1902,'San Pedro de Pillao',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190206,19,1902,'Santa Ana de Tusi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190207,19,1902,'Tapuc',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190208,19,1902,'Vilcabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190301,19,1903,'Oxapampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190302,19,1903,'Chontabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190303,19,1903,'Huancabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190304,19,1903,'Palcazu',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190305,19,1903,'Pozuzo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190306,19,1903,'Puerto Bermúdez',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190307,19,1903,'Villa Rica',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (190308,19,1903,'Constitución',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200101,20,2001,'Piura',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200104,20,2001,'Castilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200105,20,2001,'Catacaos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200107,20,2001,'Cura Mori',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200108,20,2001,'El Tallan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200109,20,2001,'La Arena',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200110,20,2001,'La Unión',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200111,20,2001,'Las Lomas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200114,20,2001,'Tambo Grande',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200115,20,2001,'Veintiseis de Octubre',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200201,20,2002,'Ayabaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200202,20,2002,'Frias',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200203,20,2002,'Jilili',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200204,20,2002,'Lagunas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200205,20,2002,'Montero',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200206,20,2002,'Pacaipampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200207,20,2002,'Paimas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200208,20,2002,'Sapillica',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200209,20,2002,'Sicchez',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200210,20,2002,'Suyo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200301,20,2003,'Huancabamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200302,20,2003,'Canchaque',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200303,20,2003,'El Carmen de la Frontera',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200304,20,2003,'Huarmaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200305,20,2003,'Lalaquiz',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200306,20,2003,'San Miguel de El Faique',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200307,20,2003,'Sondor',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200308,20,2003,'Sondorillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200401,20,2004,'Chulucanas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200402,20,2004,'Buenos Aires',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200403,20,2004,'Chalaco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200404,20,2004,'La Matanza',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200405,20,2004,'Morropon',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200406,20,2004,'Salitral',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200407,20,2004,'San Juan de Bigote',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200408,20,2004,'Santa Catalina de Mossa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200409,20,2004,'Santo Domingo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200410,20,2004,'Yamango',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200501,20,2005,'Paita',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200502,20,2005,'Amotape',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200503,20,2005,'Arenal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200504,20,2005,'Colan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200505,20,2005,'La Huaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200506,20,2005,'Tamarindo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200507,20,2005,'Vichayal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200601,20,2006,'Sullana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200602,20,2006,'Bellavista',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200603,20,2006,'Ignacio Escudero',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200604,20,2006,'Lancones',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200605,20,2006,'Marcavelica',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200606,20,2006,'Miguel Checa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200607,20,2006,'Querecotillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200608,20,2006,'Salitral',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200701,20,2007,'Pariñas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200702,20,2007,'El Alto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200703,20,2007,'La Brea',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200704,20,2007,'Lobitos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200705,20,2007,'Los Organos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200706,20,2007,'Mancora',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200801,20,2008,'Sechura',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200802,20,2008,'Bellavista de la Unión',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200803,20,2008,'Bernal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200804,20,2008,'Cristo Nos Valga',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200805,20,2008,'Vice',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (200806,20,2008,'Rinconada Llicuar',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210101,21,2101,'Puno',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210102,21,2101,'Acora',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210103,21,2101,'Amantani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210104,21,2101,'Atuncolla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210105,21,2101,'Capachica',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210106,21,2101,'Chucuito',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210107,21,2101,'Coata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210108,21,2101,'Huata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210109,21,2101,'Mañazo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210110,21,2101,'Paucarcolla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210111,21,2101,'Pichacani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210112,21,2101,'Plateria',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210113,21,2101,'San Antonio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210114,21,2101,'Tiquillaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210115,21,2101,'Vilque',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210201,21,2102,'Azángaro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210202,21,2102,'Achaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210203,21,2102,'Arapa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210204,21,2102,'Asillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210205,21,2102,'Caminaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210206,21,2102,'Chupa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210207,21,2102,'José Domingo Choquehuanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210208,21,2102,'Muñani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210209,21,2102,'Potoni',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210210,21,2102,'Saman',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210211,21,2102,'San Anton',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210212,21,2102,'San José',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210213,21,2102,'San Juan de Salinas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210214,21,2102,'Santiago de Pupuja',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210215,21,2102,'Tirapata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210301,21,2103,'Macusani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210302,21,2103,'Ajoyani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210303,21,2103,'Ayapata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210304,21,2103,'Coasa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210305,21,2103,'Corani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210306,21,2103,'Crucero',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210307,21,2103,'Ituata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210308,21,2103,'Ollachea',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210309,21,2103,'San Gaban',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210310,21,2103,'Usicayos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210401,21,2104,'Juli',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210402,21,2104,'Desaguadero',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210403,21,2104,'Huacullani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210404,21,2104,'Kelluyo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210405,21,2104,'Pisacoma',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210406,21,2104,'Pomata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210407,21,2104,'Zepita',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210501,21,2105,'Ilave',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210502,21,2105,'Capazo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210503,21,2105,'Pilcuyo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210504,21,2105,'Santa Rosa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210505,21,2105,'Conduriri',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210601,21,2106,'Huancane',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210602,21,2106,'Cojata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210603,21,2106,'Huatasani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210604,21,2106,'Inchupalla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210605,21,2106,'Pusi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210606,21,2106,'Rosaspata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210607,21,2106,'Taraco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210608,21,2106,'Vilque Chico',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210701,21,2107,'Lampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210702,21,2107,'Cabanilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210703,21,2107,'Calapuja',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210704,21,2107,'Nicasio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210705,21,2107,'Ocuviri',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210706,21,2107,'Palca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210707,21,2107,'Paratia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210708,21,2107,'Pucara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210709,21,2107,'Santa Lucia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210710,21,2107,'Vilavila',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210801,21,2108,'Ayaviri',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210802,21,2108,'Antauta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210803,21,2108,'Cupi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210804,21,2108,'Llalli',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210805,21,2108,'Macari',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210806,21,2108,'Nuñoa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210807,21,2108,'Orurillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210808,21,2108,'Santa Rosa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210809,21,2108,'Umachiri',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210901,21,2109,'Moho',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210902,21,2109,'Conima',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210903,21,2109,'Huayrapata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (210904,21,2109,'Tilali',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211001,21,2110,'Putina',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211002,21,2110,'Ananea',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211003,21,2110,'Pedro Vilca Apaza',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211004,21,2110,'Quilcapuncu',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211005,21,2110,'Sina',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211101,21,2111,'Juliaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211102,21,2111,'Cabana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211103,21,2111,'Cabanillas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211104,21,2111,'Caracoto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211105,21,2111,'San Miguel',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211201,21,2112,'Sandia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211202,21,2112,'Cuyocuyo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211203,21,2112,'Limbani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211204,21,2112,'Patambuco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211205,21,2112,'Phara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211206,21,2112,'Quiaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211207,21,2112,'San Juan del Oro',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211208,21,2112,'Yanahuaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211209,21,2112,'Alto Inambari',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211210,21,2112,'San Pedro de Putina Punco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211301,21,2113,'Yunguyo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211302,21,2113,'Anapia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211303,21,2113,'Copani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211304,21,2113,'Cuturapi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211305,21,2113,'Ollaraya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211306,21,2113,'Tinicachi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (211307,21,2113,'Unicachi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220101,22,2201,'Moyobamba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220102,22,2201,'Calzada',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220103,22,2201,'Habana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220104,22,2201,'Jepelacio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220105,22,2201,'Soritor',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220106,22,2201,'Yantalo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220201,22,2202,'Bellavista',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220202,22,2202,'Alto Biavo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220203,22,2202,'Bajo Biavo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220204,22,2202,'Huallaga',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220205,22,2202,'San Pablo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220206,22,2202,'San Rafael',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220301,22,2203,'San José de Sisa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220302,22,2203,'Agua Blanca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220303,22,2203,'San Martín',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220304,22,2203,'Santa Rosa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220305,22,2203,'Shatoja',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220401,22,2204,'Saposoa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220402,22,2204,'Alto Saposoa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220403,22,2204,'El Eslabón',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220404,22,2204,'Piscoyacu',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220405,22,2204,'Sacanche',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220406,22,2204,'Tingo de Saposoa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220501,22,2205,'Lamas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220502,22,2205,'Alonso de Alvarado',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220503,22,2205,'Barranquita',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220504,22,2205,'Caynarachi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220505,22,2205,'Cuñumbuqui',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220506,22,2205,'Pinto Recodo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220507,22,2205,'Rumisapa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220508,22,2205,'San Roque de Cumbaza',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220509,22,2205,'Shanao',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220510,22,2205,'Tabalosos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220511,22,2205,'Zapatero',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220601,22,2206,'Juanjuí',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220602,22,2206,'Campanilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220603,22,2206,'Huicungo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220604,22,2206,'Pachiza',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220605,22,2206,'Pajarillo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220701,22,2207,'Picota',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220702,22,2207,'Buenos Aires',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220703,22,2207,'Caspisapa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220704,22,2207,'Pilluana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220705,22,2207,'Pucacaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220706,22,2207,'San Cristóbal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220707,22,2207,'San Hilarión',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220708,22,2207,'Shamboyacu',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220709,22,2207,'Tingo de Ponasa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220710,22,2207,'Tres Unidos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220801,22,2208,'Rioja',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220802,22,2208,'Awajun',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220803,22,2208,'Elías Soplin Vargas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220804,22,2208,'Nueva Cajamarca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220805,22,2208,'Pardo Miguel',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220806,22,2208,'Posic',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220807,22,2208,'San Fernando',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220808,22,2208,'Yorongos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220809,22,2208,'Yuracyacu',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220901,22,2209,'Tarapoto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220902,22,2209,'Alberto Leveau',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220903,22,2209,'Cacatachi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220904,22,2209,'Chazuta',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220905,22,2209,'Chipurana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220906,22,2209,'El Porvenir',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220907,22,2209,'Huimbayoc',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220908,22,2209,'Juan Guerra',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220909,22,2209,'La Banda de Shilcayo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220910,22,2209,'Morales',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220911,22,2209,'Papaplaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220912,22,2209,'San Antonio',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220913,22,2209,'Sauce',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (220914,22,2209,'Shapaja',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (221001,22,2210,'Tocache',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (221002,22,2210,'Nuevo Progreso',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (221003,22,2210,'Polvora',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (221004,22,2210,'Shunte',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (221005,22,2210,'Uchiza',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230101,23,2301,'Tacna',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230102,23,2301,'Alto de la Alianza',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230103,23,2301,'Calana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230104,23,2301,'Ciudad Nueva',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230105,23,2301,'Inclan',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230106,23,2301,'Pachia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230107,23,2301,'Palca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230108,23,2301,'Pocollay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230109,23,2301,'Sama',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230110,23,2301,'Coronel Gregorio Albarracín Lanchipa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230111,23,2301,'La Yarada los Palos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230201,23,2302,'Candarave',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230202,23,2302,'Cairani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230203,23,2302,'Camilaca',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230204,23,2302,'Curibaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230205,23,2302,'Huanuara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230206,23,2302,'Quilahuani',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230301,23,2303,'Locumba',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230302,23,2303,'Ilabaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230303,23,2303,'Ite',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230401,23,2304,'Tarata',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230402,23,2304,'Héroes Albarracín',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230403,23,2304,'Estique',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230404,23,2304,'Estique-Pampa',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230405,23,2304,'Sitajara',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230406,23,2304,'Susapaya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230407,23,2304,'Tarucachi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (230408,23,2304,'Ticaco',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (240101,24,2401,'Tumbes',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (240102,24,2401,'Corrales',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (240103,24,2401,'La Cruz',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (240104,24,2401,'Pampas de Hospital',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (240105,24,2401,'San Jacinto',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (240106,24,2401,'San Juan de la Virgen',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (240201,24,2402,'Zorritos',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (240202,24,2402,'Casitas',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (240203,24,2402,'Canoas de Punta Sal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (240301,24,2403,'Zarumilla',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (240302,24,2403,'Aguas Verdes',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (240303,24,2403,'Matapalo',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (240304,24,2403,'Papayal',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250101,25,2501,'Calleria',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250102,25,2501,'Campoverde',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250103,25,2501,'Iparia',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250104,25,2501,'Masisea',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250105,25,2501,'Yarinacocha',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250106,25,2501,'Nueva Requena',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250107,25,2501,'Manantay',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250201,25,2502,'Raymondi',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250202,25,2502,'Sepahua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250203,25,2502,'Tahuania',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250204,25,2502,'Yurua',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250301,25,2503,'Padre Abad',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250302,25,2503,'Irazola',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250303,25,2503,'Curimana',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250304,25,2503,'Neshuya',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250305,25,2503,'Alexander Von Humboldt',1);
insert  into `ubigeo_distrito`(`iddistrito`,`iddepartamento`,`idprovincia`,`nombre`,`estado`) values (250401,25,2504,'Purus',1);

/*Table structure for table `ubigeo_provincia` */

DROP TABLE IF EXISTS `ubigeo_provincia`;

CREATE TABLE `ubigeo_provincia` (
  `idprovincia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iddepartamento` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idprovincia`)
) ENGINE=InnoDB AUTO_INCREMENT=2505 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ubigeo_provincia` */

insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (101,1,'Chachapoyas',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (102,1,'Bagua',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (103,1,'Bongará',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (104,1,'Condorcanqui',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (105,1,'Luya',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (106,1,'Rodríguez de Mendoza',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (107,1,'Utcubamba',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (201,2,'Huaraz',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (202,2,'Aija',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (203,2,'Antonio Raymondi',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (204,2,'Asunción',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (205,2,'Bolognesi',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (206,2,'Carhuaz',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (207,2,'Carlos Fermín Fitzcarrald',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (208,2,'Casma',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (209,2,'Corongo',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (210,2,'Huari',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (211,2,'Huarmey',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (212,2,'Huaylas',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (213,2,'Mariscal Luzuriaga',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (214,2,'Ocros',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (215,2,'Pallasca',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (216,2,'Pomabamba',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (217,2,'Recuay',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (218,2,'Santa',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (219,2,'Sihuas',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (220,2,'Yungay',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (301,3,'Abancay',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (302,3,'Andahuaylas',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (303,3,'Antabamba',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (304,3,'Aymaraes',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (305,3,'Cotabambas',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (306,3,'Chincheros',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (307,3,'Grau',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (401,4,'Arequipa',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (402,4,'Camaná',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (403,4,'Caravelí',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (404,4,'Castilla',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (405,4,'Caylloma',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (406,4,'Condesuyos',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (407,4,'Islay',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (408,4,'La Uniòn',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (501,5,'Huamanga',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (502,5,'Cangallo',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (503,5,'Huanca Sancos',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (504,5,'Huanta',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (505,5,'La Mar',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (506,5,'Lucanas',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (507,5,'Parinacochas',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (508,5,'Pàucar del Sara Sara',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (509,5,'Sucre',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (510,5,'Víctor Fajardo',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (511,5,'Vilcas Huamán',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (601,6,'Cajamarca',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (602,6,'Cajabamba',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (603,6,'Celendín',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (604,6,'Chota',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (605,6,'Contumazá',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (606,6,'Cutervo',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (607,6,'Hualgayoc',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (608,6,'Jaén',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (609,6,'San Ignacio',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (610,6,'San Marcos',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (611,6,'San Miguel',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (612,6,'San Pablo',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (613,6,'Santa Cruz',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (701,7,'Prov. Const. del Callao',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (801,8,'Cusco',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (802,8,'Acomayo',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (803,8,'Anta',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (804,8,'Calca',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (805,8,'Canas',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (806,8,'Canchis',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (807,8,'Chumbivilcas',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (808,8,'Espinar',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (809,8,'La Convención',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (810,8,'Paruro',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (811,8,'Paucartambo',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (812,8,'Quispicanchi',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (813,8,'Urubamba',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (901,9,'Huancavelica',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (902,9,'Acobamba',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (903,9,'Angaraes',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (904,9,'Castrovirreyna',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (905,9,'Churcampa',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (906,9,'Huaytará',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (907,9,'Tayacaja',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1001,10,'Huánuco',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1002,10,'Ambo',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1003,10,'Dos de Mayo',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1004,10,'Huacaybamba',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1005,10,'Huamalíes',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1006,10,'Leoncio Prado',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1007,10,'Marañón',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1008,10,'Pachitea',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1009,10,'Puerto Inca',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1010,10,'Lauricocha ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1011,10,'Yarowilca ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1101,11,'Ica ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1102,11,'Chincha ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1103,11,'Nasca ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1104,11,'Palpa ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1105,11,'Pisco ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1201,12,'Huancayo ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1202,12,'Concepción ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1203,12,'Chanchamayo ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1204,12,'Jauja ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1205,12,'Junín ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1206,12,'Satipo ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1207,12,'Tarma ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1208,12,'Yauli ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1209,12,'Chupaca ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1301,13,'Trujillo ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1302,13,'Ascope ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1303,13,'Bolívar ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1304,13,'Chepén ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1305,13,'Julcán ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1306,13,'Otuzco ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1307,13,'Pacasmayo ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1308,13,'Pataz ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1309,13,'Sánchez Carrión ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1310,13,'Santiago de Chuco ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1311,13,'Gran Chimú ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1312,13,'Virú ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1401,14,'Chiclayo ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1402,14,'Ferreñafe ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1403,14,'Lambayeque ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1501,15,'Lima ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1502,15,'Barranca ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1503,15,'Cajatambo ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1504,15,'Canta ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1505,15,'Cañete ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1506,15,'Huaral ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1507,15,'Huarochirí ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1508,15,'Huaura ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1509,15,'Oyón ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1510,15,'Yauyos ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1601,16,'Maynas ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1602,16,'Alto Amazonas ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1603,16,'Loreto ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1604,16,'Mariscal Ramón Castilla ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1605,16,'Requena ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1606,16,'Ucayali ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1607,16,'Datem del Marañón ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1608,16,'Putumayo',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1701,17,'Tambopata ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1702,17,'Manu ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1703,17,'Tahuamanu ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1801,18,'Mariscal Nieto ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1802,18,'General Sánchez Cerro ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1803,18,'Ilo ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1901,19,'Pasco ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1902,19,'Daniel Alcides Carrión ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (1903,19,'Oxapampa ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2001,20,'Piura ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2002,20,'Ayabaca ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2003,20,'Huancabamba ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2004,20,'Morropón ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2005,20,'Paita ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2006,20,'Sullana ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2007,20,'Talara ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2008,20,'Sechura ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2101,21,'Puno ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2102,21,'Azángaro ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2103,21,'Carabaya ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2104,21,'Chucuito ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2105,21,'El Collao ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2106,21,'Huancané ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2107,21,'Lampa ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2108,21,'Melgar ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2109,21,'Moho ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2110,21,'San Antonio de Putina ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2111,21,'San Román ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2112,21,'Sandia ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2113,21,'Yunguyo ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2201,22,'Moyobamba ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2202,22,'Bellavista ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2203,22,'El Dorado ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2204,22,'Huallaga ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2205,22,'Lamas ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2206,22,'Mariscal Cáceres ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2207,22,'Picota ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2208,22,'Rioja ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2209,22,'San Martín ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2210,22,'Tocache ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2301,23,'Tacna ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2302,23,'Candarave ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2303,23,'Jorge Basadre ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2304,23,'Tarata ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2401,24,'Tumbes ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2402,24,'Contralmirante Villar ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2403,24,'Zarumilla ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2501,25,'Coronel Portillo ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2502,25,'Atalaya ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2503,25,'Padre Abad ',1);
insert  into `ubigeo_provincia`(`idprovincia`,`iddepartamento`,`nombre`,`estado`) values (2504,25,'Purús',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

/*Table structure for table `usuario` */

DROP TABLE IF EXISTS `usuario`;

CREATE TABLE `usuario` (
  `idusuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idrol` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `clave` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `correo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nombres` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` text COLLATE utf8mb4_unicode_ci,
  `creado` datetime DEFAULT NULL,
  `actualizado` datetime DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `usuario` */

insert  into `usuario`(`idusuario`,`idrol`,`usuario`,`clave`,`correo`,`nombres`,`apellidos`,`foto`,`creado`,`actualizado`,`estado`) values (1,1,'admin','eyJpdiI6IkxHSGVhQlNTKytBMHpwXC9Ed29cL0dadz09IiwidmFsdWUiOiJWRFlQcmNmVlwvNXZRek0xVnJBMW13VzRqV2ZPTEJiVGxKY1hTcU5RdXJvcz0iLCJtYWMiOiI0NWQ1ODEwMTMwNTUzZDlmYjJmMGM2YWIzY2MwMGY0ODI1NTZhZDExMmRhMTBmOWVjYmViNWEwZTY2NjAzMWJmIn0=','admin@example.com','Admin',NULL,NULL,'2023-04-30 02:48:11','2023-04-30 02:48:11',1);

/*Table structure for table `venta` */

DROP TABLE IF EXISTS `venta`;

CREATE TABLE `venta` (
  `idventa` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idestado_envio` int(11) DEFAULT NULL,
  `idcosto_envio` int(11) DEFAULT NULL,
  `idestado_control_venta` int(11) DEFAULT NULL,
  `idcupon` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `precio_envio` decimal(10,2) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `total_final` decimal(10,2) DEFAULT NULL,
  `idmoneda` int(11) DEFAULT '1',
  `precio_cambio` double(10,4) DEFAULT '1.0000',
  `idcliente` int(11) DEFAULT NULL,
  `nombres` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `correo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idtipo_documento_identidad` int(11) DEFAULT NULL,
  `numero_documento_identidad` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idmetodo_entrega` int(11) DEFAULT NULL,
  `iddepartamento` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `idprovincia` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `iddistrito` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` text COLLATE utf8mb4_unicode_ci,
  `referencia` text COLLATE utf8mb4_unicode_ci,
  `idpunto_venta` int(11) DEFAULT NULL,
  `otro_receptor` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facturacion_idcomprobante` int(11) DEFAULT NULL,
  `facturacion_nro_comprobante` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facturacion_ruc` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facturacion_razon_social` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pago_idmetodo_pago` int(11) DEFAULT NULL,
  `pago_idestado_pago` int(11) DEFAULT NULL,
  `pago_mercadopago_id` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pago_cuotas` int(11) DEFAULT NULL,
  `pago_cip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pago_expira_cip` datetime DEFAULT NULL,
  `pago_email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_registro` datetime DEFAULT NULL,
  `fecha_modificacion` datetime DEFAULT NULL,
  `fecha_venta` datetime DEFAULT NULL,
  `fecha_entrega` datetime DEFAULT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `imagen_comprobante_pago` text COLLATE utf8mb4_unicode_ci,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idventa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `venta` */

/*Table structure for table `venta_detalle` */

DROP TABLE IF EXISTS `venta_detalle`;

CREATE TABLE `venta_detalle` (
  `idventa_detalle` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idventa` int(11) DEFAULT NULL,
  `idproducto` int(11) DEFAULT NULL,
  `precio_producto` decimal(10,2) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `estado` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`idventa_detalle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `venta_detalle` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
