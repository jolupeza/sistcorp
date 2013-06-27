-- phpMyAdmin SQL Dump
-- version 3.5.8.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-06-2013 a las 09:03:44
-- Versión del servidor: 5.5.31-0ubuntu0.13.04.1
-- Versión de PHP: 5.4.9-4ubuntu2.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `sistema_adm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_accion`
--

CREATE TABLE IF NOT EXISTS `tbl_accion` (
  `ID_ACCION` int(11) NOT NULL AUTO_INCREMENT,
  `Accion` varchar(100) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  `ID_OPCION` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_ACCION`),
  KEY `FK_OPC_ACCION` (`ID_OPCION`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `tbl_accion`
--

INSERT INTO `tbl_accion` (`ID_ACCION`, `Accion`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`, `ID_OPCION`) VALUES
(1, 'VER FORM', '1', 1, '2011-06-02 00:00:00', NULL, NULL, 1),
(2, 'ACCION: GUARDAR', '1', 1, '2011-06-02 00:00:00', NULL, NULL, 1),
(3, 'VER FORM', '1', 1, '2011-06-02 00:00:00', NULL, NULL, 2),
(4, 'ACCION: GUARDAR', '1', 1, '2011-06-02 00:00:00', NULL, NULL, 2),
(5, 'VER FORM', '1', 1, '2011-06-02 00:00:00', NULL, NULL, 3),
(6, 'ACCION: GUARDAR', '1', 1, '2011-06-03 00:00:00', NULL, NULL, 3),
(7, 'VER FORM', '1', 1, '2011-06-03 00:00:00', NULL, NULL, 4),
(8, 'ACCION: GUARDAR', '1', 1, '2011-06-03 00:00:00', NULL, NULL, 4),
(9, 'VER FORM', '1', 1, '2011-06-03 00:00:00', NULL, NULL, 5),
(10, 'ACCION: GUARDAR', '1', 1, '2011-06-03 00:00:00', NULL, NULL, 5),
(11, 'VER FORM', '1', 1, '2011-06-03 00:00:00', NULL, NULL, 6),
(12, 'ACCION: GUARDAR', '1', 1, '2011-06-03 00:00:00', NULL, NULL, 6),
(13, 'VER FORM', '1', 1, '2011-06-03 00:00:00', NULL, NULL, 7),
(14, 'ACCION: GUARDAR', '1', 1, '2011-06-03 00:00:00', NULL, NULL, 6),
(15, 'VER FORM', '1', 1, '2011-06-16 09:06:27', NULL, NULL, 8),
(16, 'ACCION: GUARDAR', '1', 1, '2011-06-16 09:06:27', NULL, NULL, 8),
(17, 'VER FORM', '1', 1, '2011-06-16 09:06:56', NULL, NULL, 9),
(18, 'ACCION: GUARDAR', '1', 1, '2011-06-16 09:06:56', NULL, NULL, 9),
(19, 'VER FORM', '1', 1, '2011-06-21 10:29:11', NULL, NULL, 10),
(20, 'ACCION: GUARDAR', '1', 1, '2011-06-21 10:29:38', NULL, NULL, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_actividadcomercial`
--

CREATE TABLE IF NOT EXISTS `tbl_actividadcomercial` (
  `ID_ACTIVIDADCOMERCIAL` int(11) NOT NULL AUTO_INCREMENT,
  `ActividadComercial` varchar(100) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_ACTIVIDADCOMERCIAL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_actividadcomercial`
--

INSERT INTO `tbl_actividadcomercial` (`ID_ACTIVIDADCOMERCIAL`, `ActividadComercial`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(1, 'Almacenamiento y Deposito', '1', 1, '2011-06-01 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_claseprod`
--

CREATE TABLE IF NOT EXISTS `tbl_claseprod` (
  `ID_CLASEPROD` int(11) NOT NULL AUTO_INCREMENT,
  `Clase` varchar(200) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  `ID_GRUPOPROD` int(11) NOT NULL,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_CLASEPROD`),
  KEY `FK_CLA_EMP` (`ID_EMPRESA`),
  KEY `FK_CLA_GRP` (`ID_GRUPOPROD`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_claseprod`
--

INSERT INTO `tbl_claseprod` (`ID_CLASEPROD`, `Clase`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`, `ID_GRUPOPROD`, `ID_EMPRESA`) VALUES
(1, 'TRANSISTORES 2', '1', 1, '2011-06-04 00:00:00', 1, '2011-06-04 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_clientes`
--

CREATE TABLE IF NOT EXISTS `tbl_clientes` (
  `ID_CLIENTE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  `RazonSocial` varchar(200) DEFAULT NULL,
  `Nombres` varchar(100) DEFAULT NULL,
  `Ape_Paterno` varchar(50) DEFAULT NULL,
  `Ape_Materno` varchar(255) DEFAULT NULL,
  `Fec_Nacimiento` datetime DEFAULT NULL,
  `ID_TIPODOCUMENTO` int(11) DEFAULT NULL,
  `NroDocumento` varchar(20) DEFAULT NULL,
  `CodDpto` char(3) DEFAULT NULL,
  `CodProv` char(1) DEFAULT NULL,
  `CodDist` char(3) DEFAULT NULL,
  `Direccion` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Telefono` varchar(7) DEFAULT NULL,
  `Celular` varchar(9) DEFAULT NULL,
  `OtrosDatos` varchar(300) DEFAULT NULL,
  `Fl_Cliente` char(1) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_CLIENTE`),
  KEY `FK_CLIE_EMP` (`ID_EMPRESA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_clientes`
--

INSERT INTO `tbl_clientes` (`ID_CLIENTE`, `ID_EMPRESA`, `RazonSocial`, `Nombres`, `Ape_Paterno`, `Ape_Materno`, `Fec_Nacimiento`, `ID_TIPODOCUMENTO`, `NroDocumento`, `CodDpto`, `CodProv`, `CodDist`, `Direccion`, `Email`, `Telefono`, `Celular`, `OtrosDatos`, `Fl_Cliente`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(1, 1, '', 'Pedro', 'Gonzales', 'Torres', '1987-06-02 00:00:00', 1, '85962345', 'U16', 'U', 'U06', 'Av. Los Angeles 743', 'pedro@hotmail.com', '4589623', '994856125', '', '1', '1', 1, '2011-06-16 00:00:00', NULL, NULL),
(2, 1, 'Comercial San Miguel', '', '', '', '2009-03-02 00:00:00', 2, '20452896419', 'U15', 'U', 'U22', 'Av. Rosales 123', 'sanmiguel@hotmail.com', '4528963', '', '', '1', '1', 1, '2011-06-16 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cotizacion_cab`
--

CREATE TABLE IF NOT EXISTS `tbl_cotizacion_cab` (
  `ID_COTIZACIONCAB` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  `NroCotizacion` varchar(10) DEFAULT NULL,
  `Fec_Emision` datetime DEFAULT NULL,
  `Fec_Vencimiento` datetime DEFAULT NULL,
  `ID_CLIENTE` int(11) DEFAULT NULL,
  `ID_VENDEDOR` int(11) DEFAULT NULL,
  `ID_MONEDA` int(11) DEFAULT NULL,
  `TipoCambio` decimal(15,2) DEFAULT NULL,
  `SubTotal` decimal(15,2) DEFAULT NULL,
  `IGV` decimal(4,2) DEFAULT NULL,
  `IGVMonto` decimal(15,2) DEFAULT NULL,
  `Total` decimal(15,2) DEFAULT NULL,
  `Estado` varchar(20) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`ID_COTIZACIONCAB`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `tbl_cotizacion_cab`
--

INSERT INTO `tbl_cotizacion_cab` (`ID_COTIZACIONCAB`, `ID_EMPRESA`, `NroCotizacion`, `Fec_Emision`, `Fec_Vencimiento`, `ID_CLIENTE`, `ID_VENDEDOR`, `ID_MONEDA`, `TipoCambio`, `SubTotal`, `IGV`, `IGVMonto`, `Total`, `Estado`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(33, 1, '159753456', '2011-06-18 00:00:00', '2011-06-18 00:00:00', 1, 1, 1, 1.00, 491.56, 0.18, 88.48, 580.04, 'P0000000000000000001', '0', 1, '2011-06-19 00:00:00', 1, 2011.00),
(35, 1, '1', '2011-06-18 00:00:00', '2011-06-25 00:00:00', 1, 1, 2, 2.77, 371.07, 0.18, 66.79, 437.86, 'P0000000000000000001', '1', 1, '2011-06-19 00:00:00', NULL, NULL),
(36, 1, '2', '2011-06-18 00:00:00', '2011-06-25 00:00:00', 1, 1, 1, 1.00, 865.20, 0.18, 155.74, 1020.94, 'P0000000000000000002', '1', 1, '2011-06-22 00:00:00', 1, 2011.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cotizacion_det`
--

CREATE TABLE IF NOT EXISTS `tbl_cotizacion_det` (
  `ID_COTIZACIONDET` int(11) NOT NULL AUTO_INCREMENT,
  `ID_COTIZACIONCAB` int(11) DEFAULT NULL,
  `ID_PRODUCTO` int(11) DEFAULT NULL,
  `ID_TIPOPRECIO` int(11) NOT NULL,
  `Cantidad` decimal(10,2) DEFAULT NULL,
  `PrecioUnitario` decimal(15,2) DEFAULT NULL,
  `Total` decimal(15,2) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_COTIZACIONDET`),
  KEY `FK_COTI_DET_CABE` (`ID_COTIZACIONCAB`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `tbl_cotizacion_det`
--

INSERT INTO `tbl_cotizacion_det` (`ID_COTIZACIONDET`, `ID_COTIZACIONCAB`, `ID_PRODUCTO`, `ID_TIPOPRECIO`, `Cantidad`, `PrecioUnitario`, `Total`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(7, 33, 1, 1, 3.00, 50.52, 151.56, '1', 1, '2011-06-18 00:00:00', 1, '2011-06-19 00:00:00'),
(8, 33, 2, 2, 4.00, 85.00, 340.00, '1', 1, '2011-06-18 00:00:00', 1, '2011-06-19 00:00:00'),
(9, 35, 1, 1, 15.00, 50.52, 757.80, '1', 1, '2011-06-18 00:00:00', 1, '2011-06-18 00:00:00'),
(10, 35, 2, 1, 3.00, 90.00, 270.00, '1', 1, '2011-06-18 00:00:00', 1, '2011-06-18 00:00:00'),
(11, 36, 1, 1, 10.00, 50.52, 505.20, '1', 1, '2011-06-18 00:00:00', 1, '2011-06-19 00:00:00'),
(12, 36, 2, 1, 4.00, 90.00, 360.00, '1', 1, '2011-06-18 00:00:00', 1, '2011-06-19 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_empresa`
--

CREATE TABLE IF NOT EXISTS `tbl_empresa` (
  `ID_EMPRESA` int(11) NOT NULL AUTO_INCREMENT,
  `RUC` varchar(11) NOT NULL,
  `RazonSocial` varchar(100) NOT NULL,
  `Logo` varchar(250) NOT NULL,
  `ID_TIPOEMPRESA` int(11) DEFAULT NULL,
  `ID_ACTIVIDADCOMERCIAL` int(11) NOT NULL DEFAULT '0',
  `Ubigeo` varchar(6) NOT NULL,
  `DireccionLegal` varchar(100) NOT NULL,
  `Activo` char(1) NOT NULL DEFAULT '1',
  `User_Creacion` int(11) NOT NULL,
  `Fec_Creacion` datetime NOT NULL,
  `User_Modificacion` int(11) NOT NULL,
  `Fec_Modificacion` datetime NOT NULL,
  PRIMARY KEY (`ID_EMPRESA`),
  KEY `FK_TIPOEMP_EMP` (`ID_TIPOEMPRESA`),
  KEY `FK_ACTCOMER_EMP` (`ID_ACTIVIDADCOMERCIAL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_empresa`
--

INSERT INTO `tbl_empresa` (`ID_EMPRESA`, `RUC`, `RazonSocial`, `Logo`, `ID_TIPOEMPRESA`, `ID_ACTIVIDADCOMERCIAL`, `Ubigeo`, `DireccionLegal`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(1, '20332148550', 'CORPORACION ELECTRONIC HIGH POWER S.A.C.', '../20332148550.jpg', 1, 1, '151501', 'SMP', '1', 1, '2011-05-30 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_familiaprod`
--

CREATE TABLE IF NOT EXISTS `tbl_familiaprod` (
  `ID_FAMILIAPROD` int(11) NOT NULL AUTO_INCREMENT,
  `Familia` varchar(200) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  `ID_GRUPOPROD` int(11) NOT NULL,
  `ID_CLASEPROD` int(11) DEFAULT NULL,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_FAMILIAPROD`),
  KEY `FK_FAM_EMP` (`ID_EMPRESA`),
  KEY `FK_FAM_GRP` (`ID_GRUPOPROD`),
  KEY `FK_FAM_CLA` (`ID_CLASEPROD`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_familiaprod`
--

INSERT INTO `tbl_familiaprod` (`ID_FAMILIAPROD`, `Familia`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`, `ID_GRUPOPROD`, `ID_CLASEPROD`, `ID_EMPRESA`) VALUES
(1, 'TRANSISTORES BIPOLARES PNP', '1', 1, '2011-06-04 00:00:00', 1, '2011-06-06 00:00:00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_formapago`
--

CREATE TABLE IF NOT EXISTS `tbl_formapago` (
  `ID_FORMAPAGO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  `FormaPago` varchar(20) DEFAULT NULL,
  `Abreviatura` varchar(5) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID_FORMAPAGO`),
  KEY `FK_FORPAGO_EMP` (`ID_EMPRESA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_grupoprod`
--

CREATE TABLE IF NOT EXISTS `tbl_grupoprod` (
  `ID_GRUPOPROD` int(11) NOT NULL AUTO_INCREMENT,
  `Grupo` varchar(200) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_GRUPOPROD`),
  KEY `FK_GRP_EMP` (`ID_EMPRESA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_grupoprod`
--

INSERT INTO `tbl_grupoprod` (`ID_GRUPOPROD`, `Grupo`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`, `ID_EMPRESA`) VALUES
(1, 'ELECTRONICA : MATERIALES 2', '1', 1, '2011-06-04 00:00:00', 1, '2011-06-04 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_modulos`
--

CREATE TABLE IF NOT EXISTS `tbl_modulos` (
  `ID_MODULO` int(11) NOT NULL AUTO_INCREMENT,
  `Modulo` varchar(100) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_MODULO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbl_modulos`
--

INSERT INTO `tbl_modulos` (`ID_MODULO`, `Modulo`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(1, 'Administración', '1', 1, '2011-06-02 00:00:00', NULL, NULL),
(2, 'Almacén', '1', 1, '2011-06-03 00:00:00', NULL, NULL),
(3, 'Facturación', '1', 1, '2011-06-03 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_moneda`
--

CREATE TABLE IF NOT EXISTS `tbl_moneda` (
  `ID_MONEDA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  `Moneda` varchar(10) DEFAULT NULL,
  `Abreviatura` varchar(5) DEFAULT NULL,
  `Simbolo` varchar(3) DEFAULT NULL,
  `TipoCambio` decimal(15,2) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID_MONEDA`),
  KEY `FK_MON_EMP` (`ID_EMPRESA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_moneda`
--

INSERT INTO `tbl_moneda` (`ID_MONEDA`, `ID_EMPRESA`, `Moneda`, `Abreviatura`, `Simbolo`, `TipoCambio`, `Activo`) VALUES
(1, 1, 'Soles', 'PEN', 'S/.', 1.00, '1'),
(2, 1, 'Dolares', 'USA', '$', 2.77, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_opciones`
--

CREATE TABLE IF NOT EXISTS `tbl_opciones` (
  `ID_OPCION` int(11) NOT NULL AUTO_INCREMENT,
  `Opcion` varchar(100) DEFAULT NULL,
  `URL` varchar(200) DEFAULT NULL,
  `PAGINA_SEL` varchar(200) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(1) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  `ID_MODULO` int(11) DEFAULT NULL,
  `ID_OPCION_REF` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_OPCION`),
  KEY `FK_MOD_OPC` (`ID_MODULO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tbl_opciones`
--

INSERT INTO `tbl_opciones` (`ID_OPCION`, `Opcion`, `URL`, `PAGINA_SEL`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`, `ID_MODULO`, `ID_OPCION_REF`) VALUES
(1, 'Perfil', 'administracion/perfil', 'administracion/perfil', '1', 1, '2011-06-02 00:00:00', NULL, NULL, 1, NULL),
(2, 'Usuarios', 'administracion/usuarios', 'administracion/usuarios', '1', 1, '2011-06-02 00:00:00', NULL, NULL, 1, NULL),
(3, 'MANT. GRUPOS', '../MOD_ALMACEN/grupo_prod.php', '/Sistema/MOD_ALMACEN/grupo_prod.php', '1', 1, '2011-06-03 00:00:00', NULL, NULL, 2, 0),
(4, 'MANT. CLASES', '../MOD_ALMACEN/clase_prod.php', '/Sistema/MOD_ALMACEN/clase_prod.php', '1', 1, '2011-06-03 00:00:00', NULL, NULL, 2, 0),
(5, 'MANT. FAMILIAS', '../MOD_ALMACEN/familia_prod.php', '/Sistema/MOD_ALMACEN/familia_prod.php', '1', 1, '2011-06-03 00:00:00', NULL, NULL, 2, 0),
(6, 'MANT. PRODUCTOS', '../MOD_ALMACEN/productos.php', '/Sistema/MOD_ALMACEN/productos.php', '1', 1, '2011-06-03 00:00:00', NULL, NULL, 2, 0),
(7, 'MANT. PROVEEDOR', '../MOD_FACTURACION/proveedor.php', '/Sistema/MOD_FACTURACION/proveedor.php', '1', 1, '2011-06-03 00:00:00', NULL, NULL, 3, 0),
(8, 'MANT. CLIENTES', '../MOD_FACTURACION/cliente.php', '/Sistema/MOD_FACTURACION/cliente.php', '1', 1, '2011-06-16 09:05:33', NULL, NULL, 3, 0),
(9, 'MANT. COTIZACION', '../MOD_FACTURACION/cotizacion.php', '/Sistema/MOD_FACTURACION/cotizacion.php', '1', 1, '2011-06-16 09:05:33', NULL, NULL, 3, 0),
(10, 'MANT. PEDIDO', '../MOD_FACTURACION/pedido.php', '/Sistema/MOD_FACTURACION/pedido.php', '1', 1, '2011-06-21 10:28:16', NULL, NULL, 3, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_parametro_det`
--

CREATE TABLE IF NOT EXISTS `tbl_parametro_det` (
  `ID_PARAMETRODET` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PARAMETRO` int(11) DEFAULT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Abreviatura` varchar(10) DEFAULT NULL,
  `Valor1` varchar(20) DEFAULT NULL,
  `Valor2` varchar(20) DEFAULT NULL,
  `Valor3` varchar(20) DEFAULT NULL,
  `Valor4` varchar(20) DEFAULT NULL,
  `Valor5` varchar(20) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_PARAMETRODET`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `tbl_parametro_det`
--

INSERT INTO `tbl_parametro_det` (`ID_PARAMETRODET`, `ID_PARAMETRO`, `Descripcion`, `Abreviatura`, `Valor1`, `Valor2`, `Valor3`, `Valor4`, `Valor5`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(1, 1, 'Pendiente', NULL, 'P0000000000000000001', NULL, NULL, NULL, NULL, '1', 1, '2011-06-18 00:00:00', NULL, NULL),
(2, 1, 'Aprobado', NULL, 'P0000000000000000002', NULL, NULL, NULL, NULL, '1', 1, '2011-06-16 09:15:58', NULL, NULL),
(3, 1, 'Rechazado', NULL, 'P0000000000000000003', NULL, NULL, NULL, NULL, '1', 1, '2011-06-16 09:16:34', NULL, NULL),
(4, 1, 'Eliminado', NULL, 'P0000000000000000004', NULL, NULL, NULL, NULL, '1', 1, '2011-06-18 00:00:00', NULL, NULL),
(5, 2, 'Pendiente', NULL, 'P0000000000000000005', NULL, NULL, NULL, NULL, '1', 1, '2011-06-18 00:00:00', NULL, NULL),
(6, 2, 'Pendiente Aprobar', NULL, 'P0000000000000000006', NULL, NULL, NULL, NULL, '1', 1, '2011-06-18 00:00:00', NULL, NULL),
(7, 2, 'Aprobado', NULL, 'P0000000000000000007', NULL, NULL, NULL, NULL, '1', 1, '2011-06-18 00:00:00', NULL, NULL),
(8, 2, 'Rechazado', NULL, 'P0000000000000000008', NULL, NULL, NULL, NULL, '1', 1, '2011-06-18 00:00:00', NULL, NULL),
(9, 2, 'Eliminado', NULL, 'P0000000000000000009', NULL, NULL, NULL, NULL, '1', 1, '2011-06-18 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_parametro_gen`
--

CREATE TABLE IF NOT EXISTS `tbl_parametro_gen` (
  `ID_PARAMETRO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  `Parametro` varchar(50) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_PARAMETRO`),
  KEY `FK_PARAM_EMP` (`ID_EMPRESA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_parametro_gen`
--

INSERT INTO `tbl_parametro_gen` (`ID_PARAMETRO`, `ID_EMPRESA`, `Parametro`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(1, 1, 'Estados Cotizacion', '1', 1, '2011-06-16 09:14:43', NULL, NULL),
(2, 1, 'Estados Nota Pedido', '1', 1, '2001-06-16 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pedido_cab`
--

CREATE TABLE IF NOT EXISTS `tbl_pedido_cab` (
  `ID_PEDIDOCAB` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  `ID_COTIZACIONCAB` int(11) DEFAULT NULL,
  `ID_VENDEDOR` int(11) DEFAULT NULL,
  `NroPedido` varchar(10) DEFAULT NULL,
  `Fec_Emision` datetime DEFAULT NULL,
  `ID_CLIENTE` int(11) DEFAULT NULL,
  `ID_MONEDA` int(11) DEFAULT NULL,
  `TipoCambio` decimal(3,2) DEFAULT NULL,
  `SubTotal` decimal(15,2) DEFAULT NULL,
  `IGV` decimal(4,2) DEFAULT NULL,
  `IGVMonto` decimal(15,2) DEFAULT NULL,
  `Total` decimal(15,2) DEFAULT NULL,
  `Descuento` int(11) DEFAULT NULL,
  `DescuentoMonto` decimal(15,2) DEFAULT NULL,
  `TotalConDescuento` decimal(15,2) DEFAULT NULL,
  `Estado` varchar(20) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_PEDIDOCAB`),
  KEY `FK_COTI_PEDIDO` (`ID_COTIZACIONCAB`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `tbl_pedido_cab`
--

INSERT INTO `tbl_pedido_cab` (`ID_PEDIDOCAB`, `ID_EMPRESA`, `ID_COTIZACIONCAB`, `ID_VENDEDOR`, `NroPedido`, `Fec_Emision`, `ID_CLIENTE`, `ID_MONEDA`, `TipoCambio`, `SubTotal`, `IGV`, `IGVMonto`, `Total`, `Descuento`, `DescuentoMonto`, `TotalConDescuento`, `Estado`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(8, 1, 36, 1, NULL, '2011-06-18 00:00:00', 1, 1, 1.00, 865.20, 0.18, 155.74, 1020.94, NULL, NULL, NULL, 'P0000000000000000005', '1', 1, '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pedido_det`
--

CREATE TABLE IF NOT EXISTS `tbl_pedido_det` (
  `ID_PEDIDODET` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PEDIDOCAB` int(11) DEFAULT NULL,
  `ID_PRODUCTO` int(11) DEFAULT NULL,
  `ID_TIPOPRECIO` int(11) DEFAULT NULL,
  `Cantidad` decimal(10,2) DEFAULT NULL,
  `PrecioUnitario` decimal(15,2) DEFAULT NULL,
  `Total` decimal(15,2) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_PEDIDODET`),
  KEY `FK_PED_DET_CABE` (`ID_PEDIDOCAB`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `tbl_pedido_det`
--

INSERT INTO `tbl_pedido_det` (`ID_PEDIDODET`, `ID_PEDIDOCAB`, `ID_PRODUCTO`, `ID_TIPOPRECIO`, `Cantidad`, `PrecioUnitario`, `Total`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(14, 8, 1, 1, 10.00, 50.52, 505.20, '1', 1, '0000-00-00 00:00:00', NULL, NULL),
(15, 8, 2, 1, 4.00, 90.00, 360.00, '1', 1, '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_perfil`
--

CREATE TABLE IF NOT EXISTS `tbl_perfil` (
  `ID_PERFIL` int(11) NOT NULL AUTO_INCREMENT,
  `Perfil` varchar(50) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_PERFIL`),
  KEY `FK_EMP_PERF` (`ID_EMPRESA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbl_perfil`
--

INSERT INTO `tbl_perfil` (`ID_PERFIL`, `Perfil`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`, `ID_EMPRESA`) VALUES
(1, 'ADMINISTRADORES', '1', 0, '2003-06-11 00:00:00', 1, '2011-06-03 00:00:00', 1),
(2, 'VENDEDORES', '1', 0, '2003-06-11 00:00:00', 1, '2011-06-03 00:00:00', 1),
(3, 'ALMACEN 2', '1', 1, '2011-06-04 00:00:00', 1, '2011-06-04 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto`
--

CREATE TABLE IF NOT EXISTS `tbl_producto` (
  `ID_PRODUCTO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  `ID_UNIDMED` int(11) DEFAULT NULL,
  `ID_FAMPROD` int(11) DEFAULT NULL,
  `ID_CLASEPROD` int(11) DEFAULT NULL,
  `ID_GRUPOPROD` int(11) DEFAULT NULL,
  `Producto` varchar(200) DEFAULT NULL,
  `Abreviatura` varchar(50) DEFAULT NULL,
  `ID_MONEDA` int(11) DEFAULT NULL,
  `PrecioCosto` decimal(15,2) DEFAULT NULL,
  `PrecioVenta` decimal(15,2) DEFAULT NULL,
  `PrecioXMayor` decimal(15,2) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  `ID_TIPOPRODUCTO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_PRODUCTO`),
  KEY `FK_PRO_UNIDMED` (`ID_UNIDMED`),
  KEY `FK_PRO_GRP` (`ID_GRUPOPROD`),
  KEY `FK_PRO_CLA` (`ID_CLASEPROD`),
  KEY `FK_PRO_FAM` (`ID_FAMPROD`),
  KEY `FK_PRO_TIPOPRO` (`ID_TIPOPRODUCTO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_producto`
--

INSERT INTO `tbl_producto` (`ID_PRODUCTO`, `ID_EMPRESA`, `ID_UNIDMED`, `ID_FAMPROD`, `ID_CLASEPROD`, `ID_GRUPOPROD`, `Producto`, `Abreviatura`, `ID_MONEDA`, `PrecioCosto`, `PrecioVenta`, `PrecioXMayor`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`, `ID_TIPOPRODUCTO`) VALUES
(1, 1, 2, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 'SOT23 4', 1, 30.00, 45.00, 35.00, '1', 1, '2011-06-04 00:00:00', 1, '2011-06-19 00:00:00', 2),
(2, 1, 1, 1, 1, 1, 'TRANSISTOR NPN SOT40 77', 'SOT40 77', 1, 80.00, 90.00, 85.00, '1', 1, '2011-06-18 00:00:00', NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos_detalle`
--

CREATE TABLE IF NOT EXISTS `tbl_productos_detalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grupo` int(11) NOT NULL,
  `clase` int(11) NOT NULL,
  `familia` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `producto` varchar(150) NOT NULL,
  `tipoprecio` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `user_creacion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Volcado de datos para la tabla `tbl_productos_detalle`
--

INSERT INTO `tbl_productos_detalle` (`id`, `grupo`, `clase`, `familia`, `idproducto`, `producto`, `tipoprecio`, `cantidad`, `precio`, `user_creacion`) VALUES
(26, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 1, 50.52, 1),
(27, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 2, 50.52, 1),
(28, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 3, 50.52, 1),
(29, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 3, 50.52, 1),
(30, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 6, 50.52, 1),
(31, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 6, 50.52, 1),
(32, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 6, 50.52, 1),
(33, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 5, 50.52, 1),
(34, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 6, 50.52, 1),
(35, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 6, 50.52, 1),
(36, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 2, 5, 40.52, 1),
(37, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 2, 50.52, 1),
(38, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 5, 50.52, 1),
(39, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 1, 2, 90.00, 1),
(40, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 5, 50.52, 1),
(41, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 2, 3, 85.00, 1),
(42, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 2, 4, 85.00, 1),
(43, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 2, 4, 85.00, 1),
(44, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 2, 4, 85.00, 1),
(45, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 2, 4, 85.00, 1),
(46, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 5, 50.52, 1),
(47, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 2, 50.52, 1),
(48, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 2, 5, 85.00, 1),
(49, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 2, 3, 85.00, 1),
(50, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 6, 50.52, 1),
(51, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 2, 50.52, 1),
(52, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 100, 50.52, 1),
(53, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 2, 3, 85.00, 1),
(54, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 2, 5, 85.00, 1),
(55, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 1, 50.52, 1),
(56, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 2, 50.52, 1),
(57, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 3, 50.52, 1),
(58, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 4, 50.52, 1),
(59, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 2, 7, 85.00, 1),
(60, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 2, 2, 85.00, 1),
(61, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 3, 50.52, 1),
(62, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 2, 4, 85.00, 1),
(63, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 10, 50.52, 1),
(64, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 2, 10, 85.00, 1),
(65, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 10, 50.52, 1),
(66, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 2, 20, 85.00, 1),
(67, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 1, 30, 90.00, 1),
(68, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 1, 20, 90.00, 1),
(69, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 15, 50.52, 1),
(70, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 10, 50.52, 1),
(71, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 1, 2, 90.00, 1),
(72, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 1, 4, 90.00, 1),
(73, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 1, 5, 90.00, 1),
(74, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 1, 3, 90.00, 1),
(75, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 2, 10, 40.52, 1),
(76, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 1, 3, 90.00, 1),
(77, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 15, 50.52, 1),
(78, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 15, 50.52, 1),
(79, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 15, 50.52, 1),
(80, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 10, 50.52, 1),
(81, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 1, 5, 90.00, 1),
(82, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 1, 5, 90.00, 1),
(83, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 1, 3, 90.00, 1),
(84, 1, 1, 1, 2, 'TRANSISTOR NPN SOT40 77', 1, 3, 90.00, 1),
(85, 1, 1, 1, 1, 'TRANSISTOR PNP SOT23 66', 1, 5, 50.52, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proveedor`
--

CREATE TABLE IF NOT EXISTS `tbl_proveedor` (
  `ID_PROVEEDOR` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  `RazonSocial` varchar(200) DEFAULT NULL,
  `RUC` varchar(11) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Objeto_Social` varchar(300) DEFAULT NULL,
  `CodDpto` varchar(3) DEFAULT NULL,
  `CodProv` varchar(3) DEFAULT NULL,
  `CodDist` varchar(3) DEFAULT NULL,
  `DireccionLegal` varchar(200) DEFAULT NULL,
  `Telefono` varchar(7) DEFAULT NULL,
  `Celular` varchar(9) DEFAULT NULL,
  `Fax` varchar(15) DEFAULT NULL,
  `Aniversario` datetime DEFAULT NULL,
  `Contacto` varchar(250) DEFAULT NULL,
  `EmailContacto` varchar(100) DEFAULT NULL,
  `CelularContacto` varchar(9) DEFAULT NULL,
  `HonomasticoContacto` datetime NOT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_PROVEEDOR`),
  KEY `FK_PRO_EMP` (`ID_EMPRESA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tbl_proveedor`
--

INSERT INTO `tbl_proveedor` (`ID_PROVEEDOR`, `ID_EMPRESA`, `RazonSocial`, `RUC`, `Email`, `Objeto_Social`, `CodDpto`, `CodProv`, `CodDist`, `DireccionLegal`, `Telefono`, `Celular`, `Fax`, `Aniversario`, `Contacto`, `EmailContacto`, `CelularContacto`, `HonomasticoContacto`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(3, 1, 'VICTOR GALARZA NUÑEZ', '10455317211', 'vgalarza@isp.qnet.com.pe', 'CONSULTOR INFORMATICO', 'U15', 'U01', 'U01', 'Nisperos', '4849315', '996189053', '', '1988-12-07 00:00:00', 'Arturo Castro', 'acastro@isp.qnet.com.pe', '996189054', '0000-00-00 00:00:00', '1', 1, '2011-06-06 00:00:00', 1, '2011-06-20 00:00:00'),
(4, 1, 'SERVICIOS VRAC', '20455317211', 'vgalarza@isp.qnet.com.pe', 'CONSULTORIA', 'U15', 'U01', 'U02', 'Nisperos', '4849315', '996189053', '', NULL, 'Arturo Castro', 'acastro@isp.qnet.com.pe', '996189054', '0000-00-00 00:00:00', '1', 1, '2011-06-06 00:00:00', NULL, NULL),
(5, 1, 'COMERCIO PERU', '20698574591', 'vgalarza@isp.qnet.com.pe', 'EMPRESA DE COMUNICACIONES', 'U12', 'U04', 'U24', 'Nisperos', '4849315', '996189053', '', NULL, 'Arturo Castro', 'acastro@isp.qnet.com.pe', '996189054', '0000-00-00 00:00:00', '1', 1, '2011-06-06 00:00:00', 1, '2011-06-20 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rel_perf_accion`
--

CREATE TABLE IF NOT EXISTS `tbl_rel_perf_accion` (
  `ID_REL_PRF_ACC` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PERFIL` int(11) DEFAULT NULL,
  `ID_ACCION` int(11) DEFAULT NULL,
  `Activo` int(11) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_REL_PRF_ACC`),
  KEY `FK_ACC_REL` (`ID_ACCION`),
  KEY `FK_PERF_REL` (`ID_PERFIL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `tbl_rel_perf_accion`
--

INSERT INTO `tbl_rel_perf_accion` (`ID_REL_PRF_ACC`, `ID_PERFIL`, `ID_ACCION`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(1, 1, 1, 1, 1, '2011-06-02 00:00:00', NULL, NULL),
(2, 1, 2, 1, 1, '2011-06-02 00:00:00', NULL, NULL),
(3, 1, 3, 1, 1, '2011-06-02 00:00:00', NULL, NULL),
(4, 1, 4, 1, 1, '2011-06-02 00:00:00', NULL, NULL),
(5, 1, 5, 1, 1, '2011-06-03 00:00:00', NULL, NULL),
(6, 1, 6, 1, 1, '2011-06-03 00:00:00', NULL, NULL),
(7, 1, 7, 1, 1, '2011-06-03 00:00:00', NULL, NULL),
(8, 1, 8, 1, 1, '2011-06-03 00:00:00', NULL, NULL),
(9, 1, 9, 1, 1, '2011-06-03 00:00:00', NULL, NULL),
(10, 1, 10, 1, 1, '2011-06-03 00:00:00', NULL, NULL),
(11, 1, 11, 1, 1, '2011-06-03 00:00:00', NULL, NULL),
(12, 1, 12, 1, 1, '2011-06-03 00:00:00', NULL, NULL),
(13, 1, 13, 1, 1, '2011-06-03 00:00:00', NULL, NULL),
(14, 1, 14, 1, 1, '2011-06-03 00:00:00', NULL, NULL),
(15, 1, 15, 1, 1, '2011-06-16 09:07:50', NULL, NULL),
(16, 1, 16, 1, 1, '2011-06-16 09:07:50', NULL, NULL),
(17, 1, 17, 1, 1, '2011-06-16 09:08:19', NULL, NULL),
(18, 1, 18, 1, 1, '2011-06-16 09:08:19', NULL, NULL),
(19, 1, 19, 1, 1, '2011-06-21 10:30:34', NULL, NULL),
(20, 1, 20, 1, 1, '2011-06-21 10:30:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sucursal`
--

CREATE TABLE IF NOT EXISTS `tbl_sucursal` (
  `ID_SUCURSAL` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  `Sucursal` varchar(50) DEFAULT NULL,
  `CodDpto` char(3) DEFAULT NULL,
  `CodProv` char(3) DEFAULT NULL,
  `CodDist` char(3) DEFAULT NULL,
  `Direccion` varchar(200) DEFAULT NULL,
  `Telefono` varchar(7) DEFAULT NULL,
  `NombreJefe` varchar(200) DEFAULT NULL,
  `CelularJefe` varchar(9) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_SUCURSAL`),
  KEY `FK_SUCURSAL_EMP` (`ID_EMPRESA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_sucursal`
--

INSERT INTO `tbl_sucursal` (`ID_SUCURSAL`, `ID_EMPRESA`, `Sucursal`, `CodDpto`, `CodProv`, `CodDist`, `Direccion`, `Telefono`, `NombreJefe`, `CelularJefe`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(1, 1, 'MEGAPLAZA', '15', '15', '01', 'Panamericana Norte con Carlos Izaguirre', '4849315', 'JEFE VENTAS', '988154896', '1', 1, '2011-06-18 14:35:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipocomprobante`
--

CREATE TABLE IF NOT EXISTS `tbl_tipocomprobante` (
  `ID_TIPOCOMPROBANTE` int(11) NOT NULL AUTO_INCREMENT,
  `Comprobante` varchar(30) DEFAULT NULL,
  `Abreviatura` varchar(10) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID_TIPOCOMPROBANTE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipodocumento`
--

CREATE TABLE IF NOT EXISTS `tbl_tipodocumento` (
  `ID_TIPODOCUMENTO` int(11) NOT NULL AUTO_INCREMENT,
  `TipoDocumento` varchar(50) DEFAULT NULL,
  `Abreviatura` varchar(5) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID_TIPODOCUMENTO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_tipodocumento`
--

INSERT INTO `tbl_tipodocumento` (`ID_TIPODOCUMENTO`, `TipoDocumento`, `Abreviatura`, `Activo`) VALUES
(1, 'Documento Nacional de Identidad', 'D.N.I', '1'),
(2, 'Registro Único del Contribuyente', 'R.U.C', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipoempresa`
--

CREATE TABLE IF NOT EXISTS `tbl_tipoempresa` (
  `ID_TIPOEMPRESA` int(11) NOT NULL AUTO_INCREMENT,
  `TipoEmpresa` varchar(100) DEFAULT NULL,
  `TipoEmp_Corto` varchar(10) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_TIPOEMPRESA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_tipoempresa`
--

INSERT INTO `tbl_tipoempresa` (`ID_TIPOEMPRESA`, `TipoEmpresa`, `TipoEmp_Corto`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(1, 'SOCIEDAD ANONIMA', 'S.A.', '1', 1, '2011-06-01 00:00:00', NULL, NULL),
(2, 'SOCIEDAD ANONIMA CERRADA', 'S.A.C.', '1', 1, '2011-06-01 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipoprecio`
--

CREATE TABLE IF NOT EXISTS `tbl_tipoprecio` (
  `ID_TIPOPRECIO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPRESA` varchar(255) DEFAULT NULL,
  `TipoPrecio` varchar(20) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID_TIPOPRECIO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_tipoprecio`
--

INSERT INTO `tbl_tipoprecio` (`ID_TIPOPRECIO`, `ID_EMPRESA`, `TipoPrecio`, `Activo`) VALUES
(1, '1', 'Precio Venta', '1'),
(2, '1', 'Precio Mayor', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipoproducto`
--

CREATE TABLE IF NOT EXISTS `tbl_tipoproducto` (
  `ID_TIPOPRODUCTO` int(11) NOT NULL AUTO_INCREMENT,
  `TIPO` varchar(50) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID_TIPOPRODUCTO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbl_tipoproducto`
--

INSERT INTO `tbl_tipoproducto` (`ID_TIPOPRODUCTO`, `TIPO`, `Activo`) VALUES
(1, 'INSUMO', '1'),
(2, 'PRODUCTO', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_transportistas`
--

CREATE TABLE IF NOT EXISTS `tbl_transportistas` (
  `ID_TRANSPORTISTA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  `Nombres` varchar(200) DEFAULT NULL,
  `TipoCarro` varchar(100) DEFAULT NULL,
  `MarcaCarro` varchar(100) DEFAULT NULL,
  `Placa` varchar(10) DEFAULT NULL,
  `Color` varchar(20) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_TRANSPORTISTA`),
  KEY `FK_TRANS_EMP` (`ID_EMPRESA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_ubigeo`
--

CREATE TABLE IF NOT EXISTS `tbl_ubigeo` (
  `ID_UBIGEO` int(11) NOT NULL AUTO_INCREMENT,
  `CodDpto` varchar(3) DEFAULT NULL,
  `CodProv` varchar(3) DEFAULT NULL,
  `CodDist` varchar(3) DEFAULT NULL,
  `Ubigeo` varchar(100) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  PRIMARY KEY (`ID_UBIGEO`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2053 ;

--
-- Volcado de datos para la tabla `tbl_ubigeo`
--

INSERT INTO `tbl_ubigeo` (`ID_UBIGEO`, `CodDpto`, `CodProv`, `CodDist`, `Ubigeo`, `Activo`) VALUES
(1, 'U01', 'U00', 'U00', 'AMAZONAS', '1'),
(2, 'U01', 'U01', 'U00', 'CHACHAPOYAS', '1'),
(3, 'U01', 'U01', 'U01', 'CHACHAPOYAS', '1'),
(4, 'U01', 'U01', 'U02', 'ASUNCION', '1'),
(5, 'U01', 'U01', 'U03', 'BALSAS', '1'),
(6, 'U01', 'U01', 'U04', 'CHETO', '1'),
(7, 'U01', 'U01', 'U05', 'CHILIQUIN', '1'),
(8, 'U01', 'U01', 'U06', 'CHUQUIBAMBA', '1'),
(9, 'U01', 'U01', 'U07', 'GRANADA', '1'),
(10, 'U01', 'U01', 'U08', 'HUANCAS', '1'),
(11, 'U01', 'U01', 'U09', 'LA JALCA', '1'),
(12, 'U01', 'U01', 'U10', 'LEIMEBAMBA', '1'),
(13, 'U01', 'U01', 'U11', 'LEVANTO', '1'),
(14, 'U01', 'U01', 'U12', 'MAGDALENA', '1'),
(15, 'U01', 'U01', 'U13', 'MARISCAL CASTILLA', '1'),
(16, 'U01', 'U01', 'U14', 'MOLINOPAMPA', '1'),
(17, 'U01', 'U01', 'U15', 'MONTEVIDEO', '1'),
(18, 'U01', 'U01', 'U16', 'OLLEROS', '1'),
(19, 'U01', 'U01', 'U17', 'QUINJALCA', '1'),
(20, 'U01', 'U01', 'U18', 'SAN FRANCISCO DE DAGUAS', '1'),
(21, 'U01', 'U01', 'U19', 'SAN ISIDRO DE MAINO', '1'),
(22, 'U01', 'U01', 'U20', 'SOLOCO', '1'),
(23, 'U01', 'U01', 'U21', 'SONCHE', '1'),
(24, 'U01', 'U02', 'U00', 'BAGUA', '1'),
(25, 'U01', 'U02', 'U01', 'LA PECA', '1'),
(26, 'U01', 'U02', 'U02', 'ARAMANGO', '1'),
(27, 'U01', 'U02', 'U03', 'COPALLIN', '1'),
(28, 'U01', 'U02', 'U04', 'EL PARCO', '1'),
(29, 'U01', 'U02', 'U05', 'IMAZA', '1'),
(30, 'U01', 'U03', 'U00', 'BONGARA', '1'),
(31, 'U01', 'U03', 'U01', 'JUMBILLA', '1'),
(32, 'U01', 'U03', 'U02', 'CHISQUILLA', '1'),
(33, 'U01', 'U03', 'U03', 'CHURUJA', '1'),
(34, 'U01', 'U03', 'U04', 'COROSHA', '1'),
(35, 'U01', 'U03', 'U05', 'CUISPES', '1'),
(36, 'U01', 'U03', 'U06', 'FLORIDA', '1'),
(37, 'U01', 'U03', 'U07', 'JAZAN', '1'),
(38, 'U01', 'U03', 'U08', 'RECTA', '1'),
(39, 'U01', 'U03', 'U09', 'SAN CARLOS', '1'),
(40, 'U01', 'U03', 'U10', 'SHIPASBAMBA', '1'),
(41, 'U01', 'U03', 'U11', 'VALERA', '1'),
(42, 'U01', 'U03', 'U12', 'YAMBRASBAMBA', '1'),
(43, 'U01', 'U04', 'U00', 'CONDORCANQUI', '1'),
(44, 'U01', 'U04', 'U01', 'NIEVA', '1'),
(45, 'U01', 'U04', 'U02', 'EL CENEPA', '1'),
(46, 'U01', 'U04', 'U03', 'RIO SANTIAGO', '1'),
(47, 'U01', 'U05', 'U00', 'LUYA', '1'),
(48, 'U01', 'U05', 'U01', 'LAMUD', '1'),
(49, 'U01', 'U05', 'U02', 'CAMPORREDONDO', '1'),
(50, 'U01', 'U05', 'U03', 'COCABAMBA', '1'),
(51, 'U01', 'U05', 'U04', 'COLCAMAR', '1'),
(52, 'U01', 'U05', 'U05', 'CONILA', '1'),
(53, 'U01', 'U05', 'U06', 'INGUILPATA', '1'),
(54, 'U01', 'U05', 'U07', 'LONGUITA', '1'),
(55, 'U01', 'U05', 'U08', 'LONYA CHICO', '1'),
(56, 'U01', 'U05', 'U09', 'LUYA', '1'),
(57, 'U01', 'U05', 'U10', 'LUYA VIEJO', '1'),
(58, 'U01', 'U05', 'U11', 'MARIA', '1'),
(59, 'U01', 'U05', 'U12', 'OCALLI', '1'),
(60, 'U01', 'U05', 'U13', 'OCUMAL', '1'),
(61, 'U01', 'U05', 'U14', 'PISUQUIA', '1'),
(62, 'U01', 'U05', 'U15', 'PROVIDENCIA', '1'),
(63, 'U01', 'U05', 'U16', 'SAN CRISTOBAL', '1'),
(64, 'U01', 'U05', 'U17', 'SAN FRANCISCO DEL YESO', '1'),
(65, 'U01', 'U05', 'U18', 'SAN JERONIMO', '1'),
(66, 'U01', 'U05', 'U19', 'SAN JUAN DE LOPECANCHA', '1'),
(67, 'U01', 'U05', 'U20', 'SANTA CATALINA', '1'),
(68, 'U01', 'U05', 'U21', 'SANTO TOMAS', '1'),
(69, 'U01', 'U05', 'U22', 'TINGO', '1'),
(70, 'U01', 'U05', 'U23', 'TRITA', '1'),
(71, 'U01', 'U06', 'U00', 'RODRIGUEZ DE MENDOZA', '1'),
(72, 'U01', 'U06', 'U01', 'SAN NICOLAS', '1'),
(73, 'U01', 'U06', 'U02', 'CHIRIMOTO', '1'),
(74, 'U01', 'U06', 'U03', 'COCHAMAL', '1'),
(75, 'U01', 'U06', 'U04', 'HUAMBO', '1'),
(76, 'U01', 'U06', 'U05', 'LIMABAMBA', '1'),
(77, 'U01', 'U06', 'U06', 'LONGAR', '1'),
(78, 'U01', 'U06', 'U07', 'MARISCAL BENAVIDES', '1'),
(79, 'U01', 'U06', 'U08', 'MILPUC', '1'),
(80, 'U01', 'U06', 'U09', 'OMIA', '1'),
(81, 'U01', 'U06', 'U10', 'SANTA ROSA', '1'),
(82, 'U01', 'U06', 'U11', 'TOTORA', '1'),
(83, 'U01', 'U06', 'U12', 'VISTA ALEGRE', '1'),
(84, 'U01', 'U07', 'U00', 'UTCUBAMBA', '1'),
(85, 'U01', 'U07', 'U01', 'BAGUA GRANDE', '1'),
(86, 'U01', 'U07', 'U02', 'CAJARURO', '1'),
(87, 'U01', 'U07', 'U03', 'CUMBA', '1'),
(88, 'U01', 'U07', 'U04', 'EL MILAGRO', '1'),
(89, 'U01', 'U07', 'U05', 'JAMALCA', '1'),
(90, 'U01', 'U07', 'U06', 'LONYA GRANDE', '1'),
(91, 'U01', 'U07', 'U07', 'YAMON', '1'),
(92, 'U02', 'U00', 'U00', 'ANCASH', '1'),
(93, 'U02', 'U01', 'U00', 'HUARAZ', '1'),
(94, 'U02', 'U01', 'U01', 'HUARAZ', '1'),
(95, 'U02', 'U01', 'U02', 'COCHABAMBA', '1'),
(96, 'U02', 'U01', 'U03', 'COLCABAMBA', '1'),
(97, 'U02', 'U01', 'U04', 'HUANCHAY', '1'),
(98, 'U02', 'U01', 'U05', 'INDEPENDENCIA', '1'),
(99, 'U02', 'U01', 'U06', 'JANGAS', '1'),
(100, 'U02', 'U01', 'U07', 'LA LIBERTAD', '1'),
(101, 'U02', 'U01', 'U08', 'OLLEROS', '1'),
(102, 'U02', 'U01', 'U09', 'PAMPAS', '1'),
(103, 'U02', 'U01', 'U10', 'PARIACOTO', '1'),
(104, 'U02', 'U01', 'U11', 'PIRA', '1'),
(105, 'U02', 'U01', 'U12', 'TARICA', '1'),
(106, 'U02', 'U02', 'U00', 'AIJA', '1'),
(107, 'U02', 'U02', 'U01', 'AIJA', '1'),
(108, 'U02', 'U02', 'U02', 'CORIS', '1'),
(109, 'U02', 'U02', 'U03', 'HUACLLAN', '1'),
(110, 'U02', 'U02', 'U04', 'LA MERCED', '1'),
(111, 'U02', 'U02', 'U05', 'SUCCHA', '1'),
(112, 'U02', 'U03', 'U00', 'ANTONIO RAYMONDI', '1'),
(113, 'U02', 'U03', 'U01', 'LLAMELLIN', '1'),
(114, 'U02', 'U03', 'U02', 'ACZO', '1'),
(115, 'U02', 'U03', 'U03', 'CHACCHO', '1'),
(116, 'U02', 'U03', 'U04', 'CHINGAS', '1'),
(117, 'U02', 'U03', 'U05', 'MIRGAS', '1'),
(118, 'U02', 'U03', 'U06', 'SAN JUAN DE RONTOY', '1'),
(119, 'U02', 'U04', 'U00', 'ASUNCION', '1'),
(120, 'U02', 'U04', 'U01', 'CHACAS', '1'),
(121, 'U02', 'U04', 'U02', 'ACOCHACA', '1'),
(122, 'U02', 'U05', 'U00', 'BOLOGNESI', '1'),
(123, 'U02', 'U05', 'U01', 'CHIQUIAN', '1'),
(124, 'U02', 'U05', 'U02', 'ABELARDO PARDO LEZAMETA', '1'),
(125, 'U02', 'U05', 'U03', 'ANTONIO RAYMONDI', '1'),
(126, 'U02', 'U05', 'U04', 'AQUIA', '1'),
(127, 'U02', 'U05', 'U05', 'CAJACAY', '1'),
(128, 'U02', 'U05', 'U06', 'CANIS', '1'),
(129, 'U02', 'U05', 'U07', 'COLQUIOC', '1'),
(130, 'U02', 'U05', 'U08', 'HUALLANCA', '1'),
(131, 'U02', 'U05', 'U09', 'HUASTA', '1'),
(132, 'U02', 'U05', 'U10', 'HUAYLLACAYAN', '1'),
(133, 'U02', 'U05', 'U11', 'LA PRIMAVERA', '1'),
(134, 'U02', 'U05', 'U12', 'MANGAS', '1'),
(135, 'U02', 'U05', 'U13', 'PACLLON', '1'),
(136, 'U02', 'U05', 'U14', 'SAN MIGUEL DE CORPANQUI', '1'),
(137, 'U02', 'U05', 'U15', 'TICLLOS', '1'),
(138, 'U02', 'U06', 'U00', 'CARHUAZ', '1'),
(139, 'U02', 'U06', 'U01', 'CARHUAZ', '1'),
(140, 'U02', 'U06', 'U02', 'ACOPAMPA', '1'),
(141, 'U02', 'U06', 'U03', 'AMASHCA', '1'),
(142, 'U02', 'U06', 'U04', 'ANTA', '1'),
(143, 'U02', 'U06', 'U05', 'ATAQUERO', '1'),
(144, 'U02', 'U06', 'U06', 'MARCARA', '1'),
(145, 'U02', 'U06', 'U07', 'PARIAHUANCA', '1'),
(146, 'U02', 'U06', 'U08', 'SAN MIGUEL DE ACO', '1'),
(147, 'U02', 'U06', 'U09', 'SHILLA', '1'),
(148, 'U02', 'U06', 'U10', 'TINCO', '1'),
(149, 'U02', 'U06', 'U11', 'YUNGAR', '1'),
(150, 'U02', 'U07', 'U00', 'CARLOS FERMIN FITZCARRALD', '1'),
(151, 'U02', 'U07', 'U01', 'SAN LUIS', '1'),
(152, 'U02', 'U07', 'U02', 'SAN NICOLAS', '1'),
(153, 'U02', 'U07', 'U03', 'YAUYA', '1'),
(154, 'U02', 'U08', 'U00', 'CASMA', '1'),
(155, 'U02', 'U08', 'U01', 'CASMA', '1'),
(156, 'U02', 'U08', 'U02', 'BUENA VISTA ALTA', '1'),
(157, 'U02', 'U08', 'U03', 'COMANDANTE NOEL', '1'),
(158, 'U02', 'U08', 'U04', 'YAUTAN', '1'),
(159, 'U02', 'U09', 'U00', 'CORONGO', '1'),
(160, 'U02', 'U09', 'U01', 'CORONGO', '1'),
(161, 'U02', 'U09', 'U02', 'ACO', '1'),
(162, 'U02', 'U09', 'U03', 'BAMBAS', '1'),
(163, 'U02', 'U09', 'U04', 'CUSCA', '1'),
(164, 'U02', 'U09', 'U05', 'LA PAMPA', '1'),
(165, 'U02', 'U09', 'U06', 'YANAC', '1'),
(166, 'U02', 'U09', 'U07', 'YUPAN', '1'),
(167, 'U02', 'U10', 'U00', 'HUARI', '1'),
(168, 'U02', 'U10', 'U01', 'HUARI', '1'),
(169, 'U02', 'U10', 'U02', 'ANRA', '1'),
(170, 'U02', 'U10', 'U03', 'CAJAY', '1'),
(171, 'U02', 'U10', 'U04', 'CHAVIN DE HUANTAR', '1'),
(172, 'U02', 'U10', 'U05', 'HUACACHI', '1'),
(173, 'U02', 'U10', 'U06', 'HUACCHIS', '1'),
(174, 'U02', 'U10', 'U07', 'HUACHIS', '1'),
(175, 'U02', 'U10', 'U08', 'HUANTAR', '1'),
(176, 'U02', 'U10', 'U09', 'MASIN', '1'),
(177, 'U02', 'U10', 'U10', 'PAUCAS', '1'),
(178, 'U02', 'U10', 'U11', 'PONTO', '1'),
(179, 'U02', 'U10', 'U12', 'RAHUAPAMPA', '1'),
(180, 'U02', 'U10', 'U13', 'RAPAYAN', '1'),
(181, 'U02', 'U10', 'U14', 'SAN MARCOS', '1'),
(182, 'U02', 'U10', 'U15', 'SAN PEDRO DE CHANA', '1'),
(183, 'U02', 'U10', 'U16', 'UCO', '1'),
(184, 'U02', 'U11', 'U00', 'HUARMEY', '1'),
(185, 'U02', 'U11', 'U01', 'HUARMEY', '1'),
(186, 'U02', 'U11', 'U02', 'COCHAPETI', '1'),
(187, 'U02', 'U11', 'U03', 'CULEBRAS', '1'),
(188, 'U02', 'U11', 'U04', 'HUAYAN', '1'),
(189, 'U02', 'U11', 'U05', 'MALVAS', '1'),
(190, 'U02', 'U12', 'U00', 'HUAYLAS', '1'),
(191, 'U02', 'U12', 'U01', 'CARAZ', '1'),
(192, 'U02', 'U12', 'U02', 'HUALLANCA', '1'),
(193, 'U02', 'U12', 'U03', 'HUATA', '1'),
(194, 'U02', 'U12', 'U04', 'HUAYLAS', '1'),
(195, 'U02', 'U12', 'U05', 'MATO', '1'),
(196, 'U02', 'U12', 'U06', 'PAMPAROMAS', '1'),
(197, 'U02', 'U12', 'U07', 'PUEBLO LIBRE', '1'),
(198, 'U02', 'U12', 'U08', 'SANTA CRUZ', '1'),
(199, 'U02', 'U12', 'U09', 'SANTO TORIBIO', '1'),
(200, 'U02', 'U12', 'U10', 'YURACMARCA', '1'),
(201, 'U02', 'U13', 'U00', 'MARISCAL LUZURIAGA', '1'),
(202, 'U02', 'U13', 'U01', 'PISCOBAMBA', '1'),
(203, 'U02', 'U13', 'U02', 'CASCA', '1'),
(204, 'U02', 'U13', 'U03', 'ELEAZAR GUZMAN BARRON', '1'),
(205, 'U02', 'U13', 'U04', 'FIDEL OLIVAS ESCUDERO', '1'),
(206, 'U02', 'U13', 'U05', 'LLAMA', '1'),
(207, 'U02', 'U13', 'U06', 'LLUMPA', '1'),
(208, 'U02', 'U13', 'U07', 'LUCMA', '1'),
(209, 'U02', 'U13', 'U08', 'MUSGA', '1'),
(210, 'U02', 'U14', 'U00', 'OCROS', '1'),
(211, 'U02', 'U14', 'U01', 'OCROS', '1'),
(212, 'U02', 'U14', 'U02', 'ACAS', '1'),
(213, 'U02', 'U14', 'U03', 'CAJAMARQUILLA', '1'),
(214, 'U02', 'U14', 'U04', 'CARHUAPAMPA', '1'),
(215, 'U02', 'U14', 'U05', 'COCHAS', '1'),
(216, 'U02', 'U14', 'U06', 'CONGAS', '1'),
(217, 'U02', 'U14', 'U07', 'LLIPA', '1'),
(218, 'U02', 'U14', 'U08', 'SAN CRISTOBAL DE RAJAN', '1'),
(219, 'U02', 'U14', 'U09', 'SAN PEDRO', '1'),
(220, 'U02', 'U14', 'U10', 'SANTIAGO DE CHILCAS', '1'),
(221, 'U02', 'U15', 'U00', 'PALLASCA', '1'),
(222, 'U02', 'U15', 'U01', 'CABANA', '1'),
(223, 'U02', 'U15', 'U02', 'BOLOGNESI', '1'),
(224, 'U02', 'U15', 'U03', 'CONCHUCOS', '1'),
(225, 'U02', 'U15', 'U04', 'HUACASCHUQUE', '1'),
(226, 'U02', 'U15', 'U05', 'HUANDOVAL', '1'),
(227, 'U02', 'U15', 'U06', 'LACABAMBA', '1'),
(228, 'U02', 'U15', 'U07', 'LLAPO', '1'),
(229, 'U02', 'U15', 'U08', 'PALLASCA', '1'),
(230, 'U02', 'U15', 'U09', 'PAMPAS', '1'),
(231, 'U02', 'U15', 'U10', 'SANTA ROSA', '1'),
(232, 'U02', 'U15', 'U11', 'TAUCA', '1'),
(233, 'U02', 'U16', 'U00', 'POMABAMBA', '1'),
(234, 'U02', 'U16', 'U01', 'POMABAMBA', '1'),
(235, 'U02', 'U16', 'U02', 'HUAYLLAN', '1'),
(236, 'U02', 'U16', 'U03', 'PAROBAMBA', '1'),
(237, 'U02', 'U16', 'U04', 'QUINUABAMBA', '1'),
(238, 'U02', 'U17', 'U00', 'RECUAY', '1'),
(239, 'U02', 'U17', 'U01', 'RECUAY', '1'),
(240, 'U02', 'U17', 'U02', 'CATAC', '1'),
(241, 'U02', 'U17', 'U03', 'COTAPARACO', '1'),
(242, 'U02', 'U17', 'U04', 'HUAYLLAPAMPA', '1'),
(243, 'U02', 'U17', 'U05', 'LLACLLIN', '1'),
(244, 'U02', 'U17', 'U06', 'MARCA', '1'),
(245, 'U02', 'U17', 'U07', 'PAMPAS CHICO', '1'),
(246, 'U02', 'U17', 'U08', 'PARARIN', '1'),
(247, 'U02', 'U17', 'U09', 'TAPACOCHA', '1'),
(248, 'U02', 'U17', 'U10', 'TICAPAMPA', '1'),
(249, 'U02', 'U18', 'U00', 'SANTA', '1'),
(250, 'U02', 'U18', 'U01', 'CHIMBOTE', '1'),
(251, 'U02', 'U18', 'U02', 'CACERES DEL PERU', '1'),
(252, 'U02', 'U18', 'U03', 'COISHCO', '1'),
(253, 'U02', 'U18', 'U04', 'MACATE', '1'),
(254, 'U02', 'U18', 'U05', 'MORO', '1'),
(255, 'U02', 'U18', 'U06', 'NEPEÑA', '1'),
(256, 'U02', 'U18', 'U07', 'SAMANCO', '1'),
(257, 'U02', 'U18', 'U08', 'SANTA', '1'),
(258, 'U02', 'U18', 'U09', 'NUEVO CHIMBOTE', '1'),
(259, 'U02', 'U19', 'U00', 'SIHUAS', '1'),
(260, 'U02', 'U19', 'U01', 'SIHUAS', '1'),
(261, 'U02', 'U19', 'U02', 'ACOBAMBA', '1'),
(262, 'U02', 'U19', 'U03', 'ALFONSO UGARTE', '1'),
(263, 'U02', 'U19', 'U04', 'CASHAPAMPA', '1'),
(264, 'U02', 'U19', 'U05', 'CHINGALPO', '1'),
(265, 'U02', 'U19', 'U06', 'HUAYLLABAMBA', '1'),
(266, 'U02', 'U19', 'U07', 'QUICHES', '1'),
(267, 'U02', 'U19', 'U08', 'RAGASH', '1'),
(268, 'U02', 'U19', 'U09', 'SAN JUAN', '1'),
(269, 'U02', 'U19', 'U10', 'SICSIBAMBA', '1'),
(270, 'U02', 'U20', 'U00', 'YUNGAY', '1'),
(271, 'U02', 'U20', 'U01', 'YUNGAY', '1'),
(272, 'U02', 'U20', 'U02', 'CASCAPARA', '1'),
(273, 'U02', 'U20', 'U03', 'MANCOS', '1'),
(274, 'U02', 'U20', 'U04', 'MATACOTO', '1'),
(275, 'U02', 'U20', 'U05', 'QUILLO', '1'),
(276, 'U02', 'U20', 'U06', 'RANRAHIRCA', '1'),
(277, 'U02', 'U20', 'U07', 'SHUPLUY', '1'),
(278, 'U02', 'U20', 'U08', 'YANAMA', '1'),
(279, 'U03', 'U00', 'U00', 'APURIMAC', '1'),
(280, 'U03', 'U01', 'U00', 'ABANCAY', '1'),
(281, 'U03', 'U01', 'U01', 'ABANCAY', '1'),
(282, 'U03', 'U01', 'U02', 'CHACOCHE', '1'),
(283, 'U03', 'U01', 'U03', 'CIRCA', '1'),
(284, 'U03', 'U01', 'U04', 'CURAHUASI', '1'),
(285, 'U03', 'U01', 'U05', 'HUANIPACA', '1'),
(286, 'U03', 'U01', 'U06', 'LAMBRAMA', '1'),
(287, 'U03', 'U01', 'U07', 'PICHIRHUA', '1'),
(288, 'U03', 'U01', 'U08', 'SAN PEDRO DE CACHORA', '1'),
(289, 'U03', 'U01', 'U09', 'TAMBURCO', '1'),
(290, 'U03', 'U02', 'U00', 'ANDAHUAYLAS', '1'),
(291, 'U03', 'U02', 'U01', 'ANDAHUAYLAS', '1'),
(292, 'U03', 'U02', 'U02', 'ANDARAPA', '1'),
(293, 'U03', 'U02', 'U03', 'CHIARA', '1'),
(294, 'U03', 'U02', 'U04', 'HUANCARAMA', '1'),
(295, 'U03', 'U02', 'U05', 'HUANCARAY', '1'),
(296, 'U03', 'U02', 'U06', 'HUAYANA', '1'),
(297, 'U03', 'U02', 'U07', 'KISHUARA', '1'),
(298, 'U03', 'U02', 'U08', 'PACOBAMBA', '1'),
(299, 'U03', 'U02', 'U09', 'PACUCHA', '1'),
(300, 'U03', 'U02', 'U10', 'PAMPACHIRI', '1'),
(301, 'U03', 'U02', 'U11', 'POMACOCHA', '1'),
(302, 'U03', 'U02', 'U12', 'SAN ANTONIO DE CACHI', '1'),
(303, 'U03', 'U02', 'U13', 'SAN JERONIMO', '1'),
(304, 'U03', 'U02', 'U14', 'SAN MIGUEL DE CHACCRAMPA', '1'),
(305, 'U03', 'U02', 'U15', 'SANTA MARIA DE CHICMO', '1'),
(306, 'U03', 'U02', 'U16', 'TALAVERA', '1'),
(307, 'U03', 'U02', 'U17', 'TUMAY HUARACA', '1'),
(308, 'U03', 'U02', 'U18', 'TURPO', '1'),
(309, 'U03', 'U02', 'U19', 'KAQUIABAMBA', '1'),
(310, 'U03', 'U03', 'U00', 'ANTABAMBA', '1'),
(311, 'U03', 'U03', 'U01', 'ANTABAMBA', '1'),
(312, 'U03', 'U03', 'U02', 'EL ORO', '1'),
(313, 'U03', 'U03', 'U03', 'HUAQUIRCA', '1'),
(314, 'U03', 'U03', 'U04', 'JUAN ESPINOZA MEDRANO', '1'),
(315, 'U03', 'U03', 'U05', 'OROPESA', '1'),
(316, 'U03', 'U03', 'U06', 'PACHACONAS', '1'),
(317, 'U03', 'U03', 'U07', 'SABAINO', '1'),
(318, 'U03', 'U04', 'U00', 'AYMARAES', '1'),
(319, 'U03', 'U04', 'U01', 'CHALHUANCA', '1'),
(320, 'U03', 'U04', 'U02', 'CAPAYA', '1'),
(321, 'U03', 'U04', 'U03', 'CARAYBAMBA', '1'),
(322, 'U03', 'U04', 'U04', 'CHAPIMARCA', '1'),
(323, 'U03', 'U04', 'U05', 'COLCABAMBA', '1'),
(324, 'U03', 'U04', 'U06', 'COTARUSE', '1'),
(325, 'U03', 'U04', 'U07', 'HUAYLLO', '1'),
(326, 'U03', 'U04', 'U08', 'JUSTO APU SAHUARAURA', '1'),
(327, 'U03', 'U04', 'U09', 'LUCRE', '1'),
(328, 'U03', 'U04', 'U10', 'POCOHUANCA', '1'),
(329, 'U03', 'U04', 'U11', 'SAN JUAN DE CHACÑA', '1'),
(330, 'U03', 'U04', 'U12', 'SAÑAYCA', '1'),
(331, 'U03', 'U04', 'U13', 'SORAYA', '1'),
(332, 'U03', 'U04', 'U14', 'TAPAIRIHUA', '1'),
(333, 'U03', 'U04', 'U15', 'TINTAY', '1'),
(334, 'U03', 'U04', 'U16', 'TORAYA', '1'),
(335, 'U03', 'U04', 'U17', 'YANACA', '1'),
(336, 'U03', 'U05', 'U00', 'COTABAMBAS', '1'),
(337, 'U03', 'U05', 'U01', 'TAMBOBAMBA', '1'),
(338, 'U03', 'U05', 'U02', 'COTABAMBAS', '1'),
(339, 'U03', 'U05', 'U03', 'COYLLURQUI', '1'),
(340, 'U03', 'U05', 'U04', 'HAQUIRA', '1'),
(341, 'U03', 'U05', 'U05', 'MARA', '1'),
(342, 'U03', 'U05', 'U06', 'CHALLHUAHUACHO', '1'),
(343, 'U03', 'U06', 'U00', 'CHINCHEROS', '1'),
(344, 'U03', 'U06', 'U01', 'CHINCHEROS', '1'),
(345, 'U03', 'U06', 'U02', 'ANCO_HUALLO', '1'),
(346, 'U03', 'U06', 'U03', 'COCHARCAS', '1'),
(347, 'U03', 'U06', 'U04', 'HUACCANA', '1'),
(348, 'U03', 'U06', 'U05', 'OCOBAMBA', '1'),
(349, 'U03', 'U06', 'U06', 'ONGOY', '1'),
(350, 'U03', 'U06', 'U07', 'URANMARCA', '1'),
(351, 'U03', 'U06', 'U08', 'RANRACANCHA', '1'),
(352, 'U03', 'U07', 'U00', 'GRAU', '1'),
(353, 'U03', 'U07', 'U01', 'CHUQUIBAMBILLA', '1'),
(354, 'U03', 'U07', 'U02', 'CURPAHUASI', '1'),
(355, 'U03', 'U07', 'U03', 'GAMARRA', '1'),
(356, 'U03', 'U07', 'U04', 'HUAYLLATI', '1'),
(357, 'U03', 'U07', 'U05', 'MAMARA', '1'),
(358, 'U03', 'U07', 'U06', 'MICAELA BASTIDAS', '1'),
(359, 'U03', 'U07', 'U07', 'PATAYPAMPA', '1'),
(360, 'U03', 'U07', 'U08', 'PROGRESO', '1'),
(361, 'U03', 'U07', 'U09', 'SAN ANTONIO', '1'),
(362, 'U03', 'U07', 'U10', 'SANTA ROSA', '1'),
(363, 'U03', 'U07', 'U11', 'TURPAY', '1'),
(364, 'U03', 'U07', 'U12', 'VILCABAMBA', '1'),
(365, 'U03', 'U07', 'U13', 'VIRUNDO', '1'),
(366, 'U03', 'U07', 'U14', 'CURASCO', '1'),
(367, 'U04', 'U00', 'U00', 'AREQUIPA', '1'),
(368, 'U04', 'U01', 'U00', 'AREQUIPA', '1'),
(369, 'U04', 'U01', 'U01', 'AREQUIPA', '1'),
(370, 'U04', 'U01', 'U02', 'ALTO SELVA ALEGRE', '1'),
(371, 'U04', 'U01', 'U03', 'CAYMA', '1'),
(372, 'U04', 'U01', 'U04', 'CERRO COLORADO', '1'),
(373, 'U04', 'U01', 'U05', 'CHARACATO', '1'),
(374, 'U04', 'U01', 'U06', 'CHIGUATA', '1'),
(375, 'U04', 'U01', 'U07', 'JACOBO HUNTER', '1'),
(376, 'U04', 'U01', 'U08', 'LA JOYA', '1'),
(377, 'U04', 'U01', 'U09', 'MARIANO MELGAR', '1'),
(378, 'U04', 'U01', 'U10', 'MIRAFLORES', '1'),
(379, 'U04', 'U01', 'U11', 'MOLLEBAYA', '1'),
(380, 'U04', 'U01', 'U12', 'PAUCARPATA', '1'),
(381, 'U04', 'U01', 'U13', 'POCSI', '1'),
(382, 'U04', 'U01', 'U14', 'POLOBAYA', '1'),
(383, 'U04', 'U01', 'U15', 'QUEQUEÑA', '1'),
(384, 'U04', 'U01', 'U16', 'SABANDIA', '1'),
(385, 'U04', 'U01', 'U17', 'SACHACA', '1'),
(386, 'U04', 'U01', 'U18', 'SAN JUAN DE SIGUAS', '1'),
(387, 'U04', 'U01', 'U19', 'SAN JUAN DE TARUCANI', '1'),
(388, 'U04', 'U01', 'U20', 'SANTA ISABEL DE SIGUAS', '1'),
(389, 'U04', 'U01', 'U21', 'SANTA RITA DE SIGUAS', '1'),
(390, 'U04', 'U01', 'U22', 'SOCABAYA', '1'),
(391, 'U04', 'U01', 'U23', 'TIABAYA', '1'),
(392, 'U04', 'U01', 'U24', 'UCHUMAYO', '1'),
(393, 'U04', 'U01', 'U25', 'VITOR', '1'),
(394, 'U04', 'U01', 'U26', 'YANAHUARA', '1'),
(395, 'U04', 'U01', 'U27', 'YARABAMBA', '1'),
(396, 'U04', 'U01', 'U28', 'YURA', '1'),
(397, 'U04', 'U01', 'U29', 'JOSE LUIS BUSTAMANTE Y RIVERO', '1'),
(398, 'U04', 'U02', 'U00', 'CAMANA', '1'),
(399, 'U04', 'U02', 'U01', 'CAMANA', '1'),
(400, 'U04', 'U02', 'U02', 'JOSE MARIA QUIMPER', '1'),
(401, 'U04', 'U02', 'U03', 'MARIANO NICOLAS VALCARCEL', '1'),
(402, 'U04', 'U02', 'U04', 'MARISCAL CACERES', '1'),
(403, 'U04', 'U02', 'U05', 'NICOLAS DE PIEROLA', '1'),
(404, 'U04', 'U02', 'U06', 'OCOÑA', '1'),
(405, 'U04', 'U02', 'U07', 'QUILCA', '1'),
(406, 'U04', 'U02', 'U08', 'SAMUEL PASTOR', '1'),
(407, 'U04', 'U03', 'U00', 'CARAVELI', '1'),
(408, 'U04', 'U03', 'U01', 'CARAVELI', '1'),
(409, 'U04', 'U03', 'U02', 'ACARI', '1'),
(410, 'U04', 'U03', 'U03', 'ATICO', '1'),
(411, 'U04', 'U03', 'U04', 'ATIQUIPA', '1'),
(412, 'U04', 'U03', 'U05', 'BELLA UNION', '1'),
(413, 'U04', 'U03', 'U06', 'CAHUACHO', '1'),
(414, 'U04', 'U03', 'U07', 'CHALA', '1'),
(415, 'U04', 'U03', 'U08', 'CHAPARRA', '1'),
(416, 'U04', 'U03', 'U09', 'HUANUHUANU', '1'),
(417, 'U04', 'U03', 'U10', 'JAQUI', '1'),
(418, 'U04', 'U03', 'U11', 'LOMAS', '1'),
(419, 'U04', 'U03', 'U12', 'QUICACHA', '1'),
(420, 'U04', 'U03', 'U13', 'YAUCA', '1'),
(421, 'U04', 'U04', 'U00', 'CASTILLA', '1'),
(422, 'U04', 'U04', 'U01', 'APLAO', '1'),
(423, 'U04', 'U04', 'U02', 'ANDAGUA', '1'),
(424, 'U04', 'U04', 'U03', 'AYO', '1'),
(425, 'U04', 'U04', 'U04', 'CHACHAS', '1'),
(426, 'U04', 'U04', 'U05', 'CHILCAYMARCA', '1'),
(427, 'U04', 'U04', 'U06', 'CHOCO', '1'),
(428, 'U04', 'U04', 'U07', 'HUANCARQUI', '1'),
(429, 'U04', 'U04', 'U08', 'MACHAGUAY', '1'),
(430, 'U04', 'U04', 'U09', 'ORCOPAMPA', '1'),
(431, 'U04', 'U04', 'U10', 'PAMPACOLCA', '1'),
(432, 'U04', 'U04', 'U11', 'TIPAN', '1'),
(433, 'U04', 'U04', 'U12', 'UÑON', '1'),
(434, 'U04', 'U04', 'U13', 'URACA', '1'),
(435, 'U04', 'U04', 'U14', 'VIRACO', '1'),
(436, 'U04', 'U05', 'U00', 'CAYLLOMA', '1'),
(437, 'U04', 'U05', 'U01', 'CHIVAY', '1'),
(438, 'U04', 'U05', 'U02', 'ACHOMA', '1'),
(439, 'U04', 'U05', 'U03', 'CABANACONDE', '1'),
(440, 'U04', 'U05', 'U04', 'CALLALLI', '1'),
(441, 'U04', 'U05', 'U05', 'CAYLLOMA', '1'),
(442, 'U04', 'U05', 'U06', 'COPORAQUE', '1'),
(443, 'U04', 'U05', 'U07', 'HUAMBO', '1'),
(444, 'U04', 'U05', 'U08', 'HUANCA', '1'),
(445, 'U04', 'U05', 'U09', 'ICHUPAMPA', '1'),
(446, 'U04', 'U05', 'U10', 'LARI', '1'),
(447, 'U04', 'U05', 'U11', 'LLUTA', '1'),
(448, 'U04', 'U05', 'U12', 'MACA', '1'),
(449, 'U04', 'U05', 'U13', 'MADRIGAL', '1'),
(450, 'U04', 'U05', 'U14', 'SAN ANTONIO DE CHUCA', '1'),
(451, 'U04', 'U05', 'U15', 'SIBAYO', '1'),
(452, 'U04', 'U05', 'U16', 'TAPAY', '1'),
(453, 'U04', 'U05', 'U17', 'TISCO', '1'),
(454, 'U04', 'U05', 'U18', 'TUTI', '1'),
(455, 'U04', 'U05', 'U19', 'YANQUE', '1'),
(456, 'U04', 'U05', 'U20', 'MAJES', '1'),
(457, 'U04', 'U06', 'U00', 'CONDESUYOS', '1'),
(458, 'U04', 'U06', 'U01', 'CHUQUIBAMBA', '1'),
(459, 'U04', 'U06', 'U02', 'ANDARAY', '1'),
(460, 'U04', 'U06', 'U03', 'CAYARANI', '1'),
(461, 'U04', 'U06', 'U04', 'CHICHAS', '1'),
(462, 'U04', 'U06', 'U05', 'IRAY', '1'),
(463, 'U04', 'U06', 'U06', 'RIO GRANDE', '1'),
(464, 'U04', 'U06', 'U07', 'SALAMANCA', '1'),
(465, 'U04', 'U06', 'U08', 'YANAQUIHUA', '1'),
(466, 'U04', 'U07', 'U00', 'ISLAY', '1'),
(467, 'U04', 'U07', 'U01', 'MOLLENDO', '1'),
(468, 'U04', 'U07', 'U02', 'COCACHACRA', '1'),
(469, 'U04', 'U07', 'U03', 'DEAN VALDIVIA', '1'),
(470, 'U04', 'U07', 'U04', 'ISLAY', '1'),
(471, 'U04', 'U07', 'U05', 'MEJIA', '1'),
(472, 'U04', 'U07', 'U06', 'PUNTA DE BOMBON', '1'),
(473, 'U04', 'U08', 'U00', 'LA UNION', '1'),
(474, 'U04', 'U08', 'U01', 'COTAHUASI', '1'),
(475, 'U04', 'U08', 'U02', 'ALCA', '1'),
(476, 'U04', 'U08', 'U03', 'CHARCANA', '1'),
(477, 'U04', 'U08', 'U04', 'HUAYNACOTAS', '1'),
(478, 'U04', 'U08', 'U05', 'PAMPAMARCA', '1'),
(479, 'U04', 'U08', 'U06', 'PUYCA', '1'),
(480, 'U04', 'U08', 'U07', 'QUECHUALLA', '1'),
(481, 'U04', 'U08', 'U08', 'SAYLA', '1'),
(482, 'U04', 'U08', 'U09', 'TAURIA', '1'),
(483, 'U04', 'U08', 'U10', 'TOMEPAMPA', '1'),
(484, 'U04', 'U08', 'U11', 'TORO', '1'),
(485, 'U05', 'U00', 'U00', 'AYACUCHO', '1'),
(486, 'U05', 'U01', 'U00', 'HUAMANGA', '1'),
(487, 'U05', 'U01', 'U01', 'AYACUCHO', '1'),
(488, 'U05', 'U01', 'U02', 'ACOCRO', '1'),
(489, 'U05', 'U01', 'U03', 'ACOS VINCHOS', '1'),
(490, 'U05', 'U01', 'U04', 'CARMEN ALTO', '1'),
(491, 'U05', 'U01', 'U05', 'CHIARA', '1'),
(492, 'U05', 'U01', 'U06', 'OCROS', '1'),
(493, 'U05', 'U01', 'U07', 'PACAYCASA', '1'),
(494, 'U05', 'U01', 'U08', 'QUINUA', '1'),
(495, 'U05', 'U01', 'U09', 'SAN JOSE DE TICLLAS', '1'),
(496, 'U05', 'U01', 'U10', 'SAN JUAN BAUTISTA', '1'),
(497, 'U05', 'U01', 'U11', 'SANTIAGO DE PISCHA', '1'),
(498, 'U05', 'U01', 'U12', 'SOCOS', '1'),
(499, 'U05', 'U01', 'U13', 'TAMBILLO', '1'),
(500, 'U05', 'U01', 'U14', 'VINCHOS', '1'),
(501, 'U05', 'U01', 'U15', 'JESUS NAZARENO', '1'),
(502, 'U05', 'U02', 'U00', 'CANGALLO', '1'),
(503, 'U05', 'U02', 'U01', 'CANGALLO', '1'),
(504, 'U05', 'U02', 'U02', 'CHUSCHI', '1'),
(505, 'U05', 'U02', 'U03', 'LOS MOROCHUCOS', '1'),
(506, 'U05', 'U02', 'U04', 'MARIA PARADO DE BELLIDO', '1'),
(507, 'U05', 'U02', 'U05', 'PARAS', '1'),
(508, 'U05', 'U02', 'U06', 'TOTOS', '1'),
(509, 'U05', 'U03', 'U00', 'HUANCA SANCOS', '1'),
(510, 'U05', 'U03', 'U01', 'SANCOS', '1'),
(511, 'U05', 'U03', 'U02', 'CARAPO', '1'),
(512, 'U05', 'U03', 'U03', 'SACSAMARCA', '1'),
(513, 'U05', 'U03', 'U04', 'SANTIAGO DE LUCANAMARCA', '1'),
(514, 'U05', 'U04', 'U00', 'HUANTA', '1'),
(515, 'U05', 'U04', 'U01', 'HUANTA', '1'),
(516, 'U05', 'U04', 'U02', 'AYAHUANCO', '1'),
(517, 'U05', 'U04', 'U03', 'HUAMANGUILLA', '1'),
(518, 'U05', 'U04', 'U04', 'IGUAIN', '1'),
(519, 'U05', 'U04', 'U05', 'LURICOCHA', '1'),
(520, 'U05', 'U04', 'U06', 'SANTILLANA', '1'),
(521, 'U05', 'U04', 'U07', 'SIVIA', '1'),
(522, 'U05', 'U04', 'U08', 'LLOCHEGUA', '1'),
(523, 'U05', 'U05', 'U00', 'LA MAR', '1'),
(524, 'U05', 'U05', 'U01', 'SAN MIGUEL', '1'),
(525, 'U05', 'U05', 'U02', 'ANCO', '1'),
(526, 'U05', 'U05', 'U03', 'AYNA', '1'),
(527, 'U05', 'U05', 'U04', 'CHILCAS', '1'),
(528, 'U05', 'U05', 'U05', 'CHUNGUI', '1'),
(529, 'U05', 'U05', 'U06', 'LUIS CARRANZA', '1'),
(530, 'U05', 'U05', 'U07', 'SANTA ROSA', '1'),
(531, 'U05', 'U05', 'U08', 'TAMBO', '1'),
(532, 'U05', 'U06', 'U00', 'LUCANAS', '1'),
(533, 'U05', 'U06', 'U01', 'PUQUIO', '1'),
(534, 'U05', 'U06', 'U02', 'AUCARA', '1'),
(535, 'U05', 'U06', 'U03', 'CABANA', '1'),
(536, 'U05', 'U06', 'U04', 'CARMEN SALCEDO', '1'),
(537, 'U05', 'U06', 'U05', 'CHAVIÑA', '1'),
(538, 'U05', 'U06', 'U06', 'CHIPAO', '1'),
(539, 'U05', 'U06', 'U07', 'HUAC-HUAS', '1'),
(540, 'U05', 'U06', 'U08', 'LARAMATE', '1'),
(541, 'U05', 'U06', 'U09', 'LEONCIO PRADO', '1'),
(542, 'U05', 'U06', 'U10', 'LLAUTA', '1'),
(543, 'U05', 'U06', 'U11', 'LUCANAS', '1'),
(544, 'U05', 'U06', 'U12', 'OCAÑA', '1'),
(545, 'U05', 'U06', 'U13', 'OTOCA', '1'),
(546, 'U05', 'U06', 'U14', 'SAISA', '1'),
(547, 'U05', 'U06', 'U15', 'SAN CRISTOBAL', '1'),
(548, 'U05', 'U06', 'U16', 'SAN JUAN', '1'),
(549, 'U05', 'U06', 'U17', 'SAN PEDRO', '1'),
(550, 'U05', 'U06', 'U18', 'SAN PEDRO DE PALCO', '1'),
(551, 'U05', 'U06', 'U19', 'SANCOS', '1'),
(552, 'U05', 'U06', 'U20', 'SANTA ANA DE HUAYCAHUACHO', '1'),
(553, 'U05', 'U06', 'U21', 'SANTA LUCIA', '1'),
(554, 'U05', 'U07', 'U00', 'PARINACOCHAS', '1'),
(555, 'U05', 'U07', 'U01', 'CORACORA', '1'),
(556, 'U05', 'U07', 'U02', 'CHUMPI', '1'),
(557, 'U05', 'U07', 'U03', 'CORONEL CASTAÑEDA', '1'),
(558, 'U05', 'U07', 'U04', 'PACAPAUSA', '1'),
(559, 'U05', 'U07', 'U05', 'PULLO', '1'),
(560, 'U05', 'U07', 'U06', 'PUYUSCA', '1'),
(561, 'U05', 'U07', 'U07', 'SAN FRANCISCO DE RAVACAYCO', '1'),
(562, 'U05', 'U07', 'U08', 'UPAHUACHO', '1'),
(563, 'U05', 'U08', 'U00', 'PAUCAR DEL SARA SARA', '1'),
(564, 'U05', 'U08', 'U01', 'PAUSA', '1'),
(565, 'U05', 'U08', 'U02', 'COLTA', '1'),
(566, 'U05', 'U08', 'U03', 'CORCULLA', '1'),
(567, 'U05', 'U08', 'U04', 'LAMPA', '1'),
(568, 'U05', 'U08', 'U05', 'MARCABAMBA', '1'),
(569, 'U05', 'U08', 'U06', 'OYOLO', '1'),
(570, 'U05', 'U08', 'U07', 'PARARCA', '1'),
(571, 'U05', 'U08', 'U08', 'SAN JAVIER DE ALPABAMBA', '1'),
(572, 'U05', 'U08', 'U09', 'SAN JOSE DE USHUA', '1'),
(573, 'U05', 'U08', 'U10', 'SARA SARA', '1'),
(574, 'U05', 'U09', 'U00', 'SUCRE', '1'),
(575, 'U05', 'U09', 'U01', 'QUEROBAMBA', '1'),
(576, 'U05', 'U09', 'U02', 'BELEN', '1'),
(577, 'U05', 'U09', 'U03', 'CHALCOS', '1'),
(578, 'U05', 'U09', 'U04', 'CHILCAYOC', '1'),
(579, 'U05', 'U09', 'U05', 'HUACAÑA', '1'),
(580, 'U05', 'U09', 'U06', 'MORCOLLA', '1'),
(581, 'U05', 'U09', 'U07', 'PAICO', '1'),
(582, 'U05', 'U09', 'U08', 'SAN PEDRO DE LARCAY', '1'),
(583, 'U05', 'U09', 'U09', 'SAN SALVADOR DE QUIJE', '1'),
(584, 'U05', 'U09', 'U10', 'SANTIAGO DE PAUCARAY', '1'),
(585, 'U05', 'U09', 'U11', 'SORAS', '1'),
(586, 'U05', 'U10', 'U00', 'VICTOR FAJARDO', '1'),
(587, 'U05', 'U10', 'U01', 'HUANCAPI', '1'),
(588, 'U05', 'U10', 'U02', 'ALCAMENCA', '1'),
(589, 'U05', 'U10', 'U03', 'APONGO', '1'),
(590, 'U05', 'U10', 'U04', 'ASQUIPATA', '1'),
(591, 'U05', 'U10', 'U05', 'CANARIA', '1'),
(592, 'U05', 'U10', 'U06', 'CAYARA', '1'),
(593, 'U05', 'U10', 'U07', 'COLCA', '1'),
(594, 'U05', 'U10', 'U08', 'HUAMANQUIQUIA', '1'),
(595, 'U05', 'U10', 'U09', 'HUANCARAYLLA', '1'),
(596, 'U05', 'U10', 'U10', 'HUAYA', '1'),
(597, 'U05', 'U10', 'U11', 'SARHUA', '1'),
(598, 'U05', 'U10', 'U12', 'VILCANCHOS', '1'),
(599, 'U05', 'U11', 'U00', 'VILCAS HUAMAN', '1'),
(600, 'U05', 'U11', 'U01', 'VILCAS HUAMAN', '1'),
(601, 'U05', 'U11', 'U02', 'ACCOMARCA', '1'),
(602, 'U05', 'U11', 'U03', 'CARHUANCA', '1'),
(603, 'U05', 'U11', 'U04', 'CONCEPCION', '1'),
(604, 'U05', 'U11', 'U05', 'HUAMBALPA', '1'),
(605, 'U05', 'U11', 'U06', 'INDEPENDENCIA', '1'),
(606, 'U05', 'U11', 'U07', 'SAURAMA', '1'),
(607, 'U05', 'U11', 'U08', 'VISCHONGO', '1'),
(608, 'U06', 'U00', 'U00', 'CAJAMARCA', '1'),
(609, 'U06', 'U01', 'U00', 'CAJAMARCA', '1'),
(610, 'U06', 'U01', 'U01', 'CAJAMARCA', '1'),
(611, 'U06', 'U01', 'U02', 'ASUNCION', '1'),
(612, 'U06', 'U01', 'U03', 'CHETILLA', '1'),
(613, 'U06', 'U01', 'U04', 'COSPAN', '1'),
(614, 'U06', 'U01', 'U05', 'ENCAÑADA', '1'),
(615, 'U06', 'U01', 'U06', 'JESUS', '1'),
(616, 'U06', 'U01', 'U07', 'LLACANORA', '1'),
(617, 'U06', 'U01', 'U08', 'LOS BAÑOS DEL INCA', '1'),
(618, 'U06', 'U01', 'U09', 'MAGDALENA', '1'),
(619, 'U06', 'U01', 'U10', 'MATARA', '1'),
(620, 'U06', 'U01', 'U11', 'NAMORA', '1'),
(621, 'U06', 'U01', 'U12', 'SAN JUAN', '1'),
(622, 'U06', 'U02', 'U00', 'CAJABAMBA', '1'),
(623, 'U06', 'U02', 'U01', 'CAJABAMBA', '1'),
(624, 'U06', 'U02', 'U02', 'CACHACHI', '1'),
(625, 'U06', 'U02', 'U03', 'CONDEBAMBA', '1'),
(626, 'U06', 'U02', 'U04', 'SITACOCHA', '1'),
(627, 'U06', 'U03', 'U00', 'CELENDIN', '1'),
(628, 'U06', 'U03', 'U01', 'CELENDIN', '1'),
(629, 'U06', 'U03', 'U02', 'CHUMUCH', '1'),
(630, 'U06', 'U03', 'U03', 'CORTEGANA', '1'),
(631, 'U06', 'U03', 'U04', 'HUASMIN', '1'),
(632, 'U06', 'U03', 'U05', 'JORGE CHAVEZ', '1'),
(633, 'U06', 'U03', 'U06', 'JOSE GALVEZ', '1'),
(634, 'U06', 'U03', 'U07', 'MIGUEL IGLESIAS', '1'),
(635, 'U06', 'U03', 'U08', 'OXAMARCA', '1'),
(636, 'U06', 'U03', 'U09', 'SOROCHUCO', '1'),
(637, 'U06', 'U03', 'U10', 'SUCRE', '1'),
(638, 'U06', 'U03', 'U11', 'UTCO', '1'),
(639, 'U06', 'U03', 'U12', 'LA LIBERTAD DE PALLAN', '1'),
(640, 'U06', 'U04', 'U00', 'CHOTA', '1'),
(641, 'U06', 'U04', 'U01', 'CHOTA', '1'),
(642, 'U06', 'U04', 'U02', 'ANGUIA', '1'),
(643, 'U06', 'U04', 'U03', 'CHADIN', '1'),
(644, 'U06', 'U04', 'U04', 'CHIGUIRIP', '1'),
(645, 'U06', 'U04', 'U05', 'CHIMBAN', '1'),
(646, 'U06', 'U04', 'U06', 'CHOROPAMPA', '1'),
(647, 'U06', 'U04', 'U07', 'COCHABAMBA', '1'),
(648, 'U06', 'U04', 'U08', 'CONCHAN', '1'),
(649, 'U06', 'U04', 'U09', 'HUAMBOS', '1'),
(650, 'U06', 'U04', 'U10', 'LAJAS', '1'),
(651, 'U06', 'U04', 'U11', 'LLAMA', '1'),
(652, 'U06', 'U04', 'U12', 'MIRACOSTA', '1'),
(653, 'U06', 'U04', 'U13', 'PACCHA', '1'),
(654, 'U06', 'U04', 'U14', 'PION', '1'),
(655, 'U06', 'U04', 'U15', 'QUEROCOTO', '1'),
(656, 'U06', 'U04', 'U16', 'SAN JUAN DE LICUPIS', '1'),
(657, 'U06', 'U04', 'U17', 'TACABAMBA', '1'),
(658, 'U06', 'U04', 'U18', 'TOCMOCHE', '1'),
(659, 'U06', 'U04', 'U19', 'CHALAMARCA', '1'),
(660, 'U06', 'U05', 'U00', 'CONTUMAZA', '1'),
(661, 'U06', 'U05', 'U01', 'CONTUMAZA', '1'),
(662, 'U06', 'U05', 'U02', 'CHILETE', '1'),
(663, 'U06', 'U05', 'U03', 'CUPISNIQUE', '1'),
(664, 'U06', 'U05', 'U04', 'GUZMANGO', '1'),
(665, 'U06', 'U05', 'U05', 'SAN BENITO', '1'),
(666, 'U06', 'U05', 'U06', 'SANTA CRUZ DE TOLED', '1'),
(667, 'U06', 'U05', 'U07', 'TANTARICA', '1'),
(668, 'U06', 'U05', 'U08', 'YONAN', '1'),
(669, 'U06', 'U06', 'U00', 'CUTERVO', '1'),
(670, 'U06', 'U06', 'U01', 'CUTERVO', '1'),
(671, 'U06', 'U06', 'U02', 'CALLAYUC', '1'),
(672, 'U06', 'U06', 'U03', 'CHOROS', '1'),
(673, 'U06', 'U06', 'U04', 'CUJILLO', '1'),
(674, 'U06', 'U06', 'U05', 'LA RAMADA', '1'),
(675, 'U06', 'U06', 'U06', 'PIMPINGOS', '1'),
(676, 'U06', 'U06', 'U07', 'QUEROCOTILLO', '1'),
(677, 'U06', 'U06', 'U08', 'SAN ANDRES DE CUTERVO', '1'),
(678, 'U06', 'U06', 'U09', 'SAN JUAN DE CUTERVO', '1'),
(679, 'U06', 'U06', 'U10', 'SAN LUIS DE LUCMA', '1'),
(680, 'U06', 'U06', 'U11', 'SANTA CRUZ', '1'),
(681, 'U06', 'U06', 'U12', 'SANTO DOMINGO DE LA CAPILLA', '1'),
(682, 'U06', 'U06', 'U13', 'SANTO TOMAS', '1'),
(683, 'U06', 'U06', 'U14', 'SOCOTA', '1'),
(684, 'U06', 'U06', 'U15', 'TORIBIO CASANOVA', '1'),
(685, 'U06', 'U07', 'U00', 'HUALGAYOC', '1'),
(686, 'U06', 'U07', 'U01', 'BAMBAMARCA', '1'),
(687, 'U06', 'U07', 'U02', 'CHUGUR', '1'),
(688, 'U06', 'U07', 'U03', 'HUALGAYOC', '1'),
(689, 'U06', 'U08', 'U00', 'JAEN', '1'),
(690, 'U06', 'U08', 'U01', 'JAEN', '1'),
(691, 'U06', 'U08', 'U02', 'BELLAVISTA', '1'),
(692, 'U06', 'U08', 'U03', 'CHONTALI', '1'),
(693, 'U06', 'U08', 'U04', 'COLASAY', '1'),
(694, 'U06', 'U08', 'U05', 'HUABAL', '1'),
(695, 'U06', 'U08', 'U06', 'LAS PIRIAS', '1'),
(696, 'U06', 'U08', 'U07', 'POMAHUACA', '1'),
(697, 'U06', 'U08', 'U08', 'PUCARA', '1'),
(698, 'U06', 'U08', 'U09', 'SALLIQUE', '1'),
(699, 'U06', 'U08', 'U10', 'SAN FELIPE', '1'),
(700, 'U06', 'U08', 'U11', 'SAN JOSE DEL ALTO', '1'),
(701, 'U06', 'U08', 'U12', 'SANTA ROSA', '1'),
(702, 'U06', 'U09', 'U00', 'SAN IGNACIO', '1'),
(703, 'U06', 'U09', 'U01', 'SAN IGNACIO', '1'),
(704, 'U06', 'U09', 'U02', 'CHIRINOS', '1'),
(705, 'U06', 'U09', 'U03', 'HUARANGO', '1'),
(706, 'U06', 'U09', 'U04', 'LA COIPA', '1'),
(707, 'U06', 'U09', 'U05', 'NAMBALLE', '1'),
(708, 'U06', 'U09', 'U06', 'SAN JOSE DE LOURDES', '1'),
(709, 'U06', 'U09', 'U07', 'TABACONAS', '1'),
(710, 'U06', 'U10', 'U00', 'SAN MARCOS', '1'),
(711, 'U06', 'U10', 'U01', 'PEDRO GALVEZ', '1'),
(712, 'U06', 'U10', 'U02', 'CHANCAY', '1'),
(713, 'U06', 'U10', 'U03', 'EDUARDO VILLANUEVA', '1'),
(714, 'U06', 'U10', 'U04', 'GREGORIO PITA', '1'),
(715, 'U06', 'U10', 'U05', 'ICHOCAN', '1'),
(716, 'U06', 'U10', 'U06', 'JOSE MANUEL QUIROZ', '1'),
(717, 'U06', 'U10', 'U07', 'JOSE SABOGAL', '1'),
(718, 'U06', 'U11', 'U00', 'SAN MIGUEL', '1'),
(719, 'U06', 'U11', 'U01', 'SAN MIGUEL', '1'),
(720, 'U06', 'U11', 'U02', 'BOLIVAR', '1'),
(721, 'U06', 'U11', 'U03', 'CALQUIS', '1'),
(722, 'U06', 'U11', 'U04', 'CATILLUC', '1'),
(723, 'U06', 'U11', 'U05', 'EL PRADO', '1'),
(724, 'U06', 'U11', 'U06', 'LA FLORIDA', '1'),
(725, 'U06', 'U11', 'U07', 'LLAPA', '1'),
(726, 'U06', 'U11', 'U08', 'NANCHOC', '1'),
(727, 'U06', 'U11', 'U09', 'NIEPOS', '1'),
(728, 'U06', 'U11', 'U10', 'SAN GREGORIO', '1'),
(729, 'U06', 'U11', 'U11', 'SAN SILVESTRE DE COCHAN', '1'),
(730, 'U06', 'U11', 'U12', 'TONGOD', '1'),
(731, 'U06', 'U11', 'U13', 'UNION AGUA BLANCA', '1'),
(732, 'U06', 'U12', 'U00', 'SAN PABLO', '1'),
(733, 'U06', 'U12', 'U01', 'SAN PABLO', '1'),
(734, 'U06', 'U12', 'U02', 'SAN BERNARDINO', '1'),
(735, 'U06', 'U12', 'U03', 'SAN LUIS', '1'),
(736, 'U06', 'U12', 'U04', 'TUMBADEN', '1'),
(737, 'U06', 'U13', 'U00', 'SANTA CRUZ', '1'),
(738, 'U06', 'U13', 'U01', 'SANTA CRUZ', '1'),
(739, 'U06', 'U13', 'U02', 'ANDABAMBA', '1'),
(740, 'U06', 'U13', 'U03', 'CATACHE', '1'),
(741, 'U06', 'U13', 'U04', 'CHANCAYBAÑOS', '1'),
(742, 'U06', 'U13', 'U05', 'LA ESPERANZA', '1'),
(743, 'U06', 'U13', 'U06', 'NINABAMBA', '1'),
(744, 'U06', 'U13', 'U07', 'PULAN', '1'),
(745, 'U06', 'U13', 'U08', 'SAUCEPAMPA', '1'),
(746, 'U06', 'U13', 'U09', 'SEXI', '1'),
(747, 'U06', 'U13', 'U10', 'UTICYACU', '1'),
(748, 'U06', 'U13', 'U11', 'YAUYUCAN', '1'),
(749, 'U07', 'U00', 'U00', 'CALLAO', '1'),
(750, 'U07', 'U01', 'U00', 'CALLAO', '1'),
(751, 'U07', 'U01', 'U01', 'CALLAO', '1'),
(752, 'U07', 'U01', 'U02', 'BELLAVISTA', '1'),
(753, 'U07', 'U01', 'U03', 'CARMEN DE LA LEGUA REYNOSO', '1'),
(754, 'U07', 'U01', 'U04', 'LA PERLA', '1'),
(755, 'U07', 'U01', 'U05', 'LA PUNTA', '1'),
(756, 'U07', 'U01', 'U06', 'VENTANILLA', '1'),
(757, 'U08', 'U00', 'U00', 'CUSCO', '1'),
(758, 'U08', 'U01', 'U00', 'CUSCO', '1'),
(759, 'U08', 'U01', 'U01', 'CUSCO', '1'),
(760, 'U08', 'U01', 'U02', 'CCORCA', '1'),
(761, 'U08', 'U01', 'U03', 'POROY', '1'),
(762, 'U08', 'U01', 'U04', 'SAN JERONIMO', '1'),
(763, 'U08', 'U01', 'U05', 'SAN SEBASTIAN', '1'),
(764, 'U08', 'U01', 'U06', 'SANTIAGO', '1'),
(765, 'U08', 'U01', 'U07', 'SAYLLA', '1'),
(766, 'U08', 'U01', 'U08', 'WANCHAQ', '1'),
(767, 'U08', 'U02', 'U00', 'ACOMAYO', '1'),
(768, 'U08', 'U02', 'U01', 'ACOMAYO', '1'),
(769, 'U08', 'U02', 'U02', 'ACOPIA', '1'),
(770, 'U08', 'U02', 'U03', 'ACOS', '1'),
(771, 'U08', 'U02', 'U04', 'MOSOC LLACTA', '1'),
(772, 'U08', 'U02', 'U05', 'POMACANCHI', '1'),
(773, 'U08', 'U02', 'U06', 'RONDOCAN', '1'),
(774, 'U08', 'U02', 'U07', 'SANGARARA', '1'),
(775, 'U08', 'U03', 'U00', 'ANTA', '1'),
(776, 'U08', 'U03', 'U01', 'ANTA', '1'),
(777, 'U08', 'U03', 'U02', 'ANCAHUASI', '1'),
(778, 'U08', 'U03', 'U03', 'CACHIMAYO', '1'),
(779, 'U08', 'U03', 'U04', 'CHINCHAYPUJIO', '1'),
(780, 'U08', 'U03', 'U05', 'HUAROCONDO', '1'),
(781, 'U08', 'U03', 'U06', 'LIMATAMBO', '1'),
(782, 'U08', 'U03', 'U07', 'MOLLEPATA', '1'),
(783, 'U08', 'U03', 'U08', 'PUCYURA', '1'),
(784, 'U08', 'U03', 'U09', 'ZURITE', '1'),
(785, 'U08', 'U04', 'U00', 'CALCA', '1'),
(786, 'U08', 'U04', 'U01', 'CALCA', '1'),
(787, 'U08', 'U04', 'U02', 'COYA', '1'),
(788, 'U08', 'U04', 'U03', 'LAMAY', '1'),
(789, 'U08', 'U04', 'U04', 'LARES', '1'),
(790, 'U08', 'U04', 'U05', 'PISAC', '1'),
(791, 'U08', 'U04', 'U06', 'SAN SALVADOR', '1'),
(792, 'U08', 'U04', 'U07', 'TARAY', '1'),
(793, 'U08', 'U04', 'U08', 'YANATILE', '1'),
(794, 'U08', 'U05', 'U00', 'CANAS', '1'),
(795, 'U08', 'U05', 'U01', 'YANAOCA', '1'),
(796, 'U08', 'U05', 'U02', 'CHECCA', '1'),
(797, 'U08', 'U05', 'U03', 'KUNTURKANKI', '1'),
(798, 'U08', 'U05', 'U04', 'LANGUI', '1'),
(799, 'U08', 'U05', 'U05', 'LAYO', '1'),
(800, 'U08', 'U05', 'U06', 'PAMPAMARCA', '1'),
(801, 'U08', 'U05', 'U07', 'QUEHUE', '1'),
(802, 'U08', 'U05', 'U08', 'TUPAC AMARU', '1'),
(803, 'U08', 'U06', 'U00', 'CANCHIS', '1'),
(804, 'U08', 'U06', 'U01', 'SICUANI', '1'),
(805, 'U08', 'U06', 'U02', 'CHECACUPE', '1'),
(806, 'U08', 'U06', 'U03', 'COMBAPATA', '1'),
(807, 'U08', 'U06', 'U04', 'MARANGANI', '1'),
(808, 'U08', 'U06', 'U05', 'PITUMARCA', '1'),
(809, 'U08', 'U06', 'U06', 'SAN PABLO', '1'),
(810, 'U08', 'U06', 'U07', 'SAN PEDRO', '1'),
(811, 'U08', 'U06', 'U08', 'TINTA', '1'),
(812, 'U08', 'U07', 'U00', 'CHUMBIVILCAS', '1'),
(813, 'U08', 'U07', 'U01', 'SANTO TOMAS', '1'),
(814, 'U08', 'U07', 'U02', 'CAPACMARCA', '1'),
(815, 'U08', 'U07', 'U03', 'CHAMACA', '1'),
(816, 'U08', 'U07', 'U04', 'COLQUEMARCA', '1'),
(817, 'U08', 'U07', 'U05', 'LIVITACA', '1'),
(818, 'U08', 'U07', 'U06', 'LLUSCO', '1'),
(819, 'U08', 'U07', 'U07', 'QUIÑOTA', '1'),
(820, 'U08', 'U07', 'U08', 'VELILLE', '1'),
(821, 'U08', 'U08', 'U00', 'ESPINAR', '1'),
(822, 'U08', 'U08', 'U01', 'ESPINAR', '1'),
(823, 'U08', 'U08', 'U02', 'CONDOROMA', '1'),
(824, 'U08', 'U08', 'U03', 'COPORAQUE', '1'),
(825, 'U08', 'U08', 'U04', 'OCORURO', '1'),
(826, 'U08', 'U08', 'U05', 'PALLPATA', '1'),
(827, 'U08', 'U08', 'U06', 'PICHIGUA', '1'),
(828, 'U08', 'U08', 'U07', 'SUYCKUTAMBO', '1'),
(829, 'U08', 'U08', 'U08', 'ALTO PICHIGUA', '1'),
(830, 'U08', 'U09', 'U00', 'LA CONVENCION', '1'),
(831, 'U08', 'U09', 'U01', 'SANTA ANA', '1'),
(832, 'U08', 'U09', 'U02', 'ECHARATE', '1'),
(833, 'U08', 'U09', 'U03', 'HUAYOPATA', '1'),
(834, 'U08', 'U09', 'U04', 'MARANURA', '1'),
(835, 'U08', 'U09', 'U05', 'OCOBAMBA', '1'),
(836, 'U08', 'U09', 'U06', 'QUELLOUNO', '1'),
(837, 'U08', 'U09', 'U07', 'KIMBIRI', '1'),
(838, 'U08', 'U09', 'U08', 'SANTA TERESA', '1'),
(839, 'U08', 'U09', 'U09', 'VILCABAMBA', '1'),
(840, 'U08', 'U09', 'U10', 'PICHARI', '1'),
(841, 'U08', 'U10', 'U00', 'PARURO', '1'),
(842, 'U08', 'U10', 'U01', 'PARURO', '1'),
(843, 'U08', 'U10', 'U02', 'ACCHA', '1'),
(844, 'U08', 'U10', 'U03', 'CCAPI', '1'),
(845, 'U08', 'U10', 'U04', 'COLCHA', '1'),
(846, 'U08', 'U10', 'U05', 'HUANOQUITE', '1'),
(847, 'U08', 'U10', 'U06', 'OMACHA', '1'),
(848, 'U08', 'U10', 'U07', 'PACCARITAMBO', '1'),
(849, 'U08', 'U10', 'U08', 'PILLPINTO', '1'),
(850, 'U08', 'U10', 'U09', 'YAURISQUE', '1'),
(851, 'U08', 'U11', 'U00', 'PAUCARTAMBO', '1'),
(852, 'U08', 'U11', 'U01', 'PAUCARTAMBO', '1'),
(853, 'U08', 'U11', 'U02', 'CAICAY', '1'),
(854, 'U08', 'U11', 'U03', 'CHALLABAMBA', '1'),
(855, 'U08', 'U11', 'U04', 'COLQUEPATA', '1'),
(856, 'U08', 'U11', 'U05', 'HUANCARANI', '1'),
(857, 'U08', 'U11', 'U06', 'KOSÑIPATA', '1'),
(858, 'U08', 'U12', 'U00', 'QUISPICANCHI', '1'),
(859, 'U08', 'U12', 'U01', 'URCOS', '1'),
(860, 'U08', 'U12', 'U02', 'ANDAHUAYLILLAS', '1'),
(861, 'U08', 'U12', 'U03', 'CAMANTI', '1'),
(862, 'U08', 'U12', 'U04', 'CCARHUAYO', '1'),
(863, 'U08', 'U12', 'U05', 'CCATCA', '1'),
(864, 'U08', 'U12', 'U06', 'CUSIPATA', '1'),
(865, 'U08', 'U12', 'U07', 'HUARO', '1'),
(866, 'U08', 'U12', 'U08', 'LUCRE', '1'),
(867, 'U08', 'U12', 'U09', 'MARCAPATA', '1'),
(868, 'U08', 'U12', 'U10', 'OCONGATE', '1'),
(869, 'U08', 'U12', 'U11', 'OROPESA', '1'),
(870, 'U08', 'U12', 'U12', 'QUIQUIJANA', '1'),
(871, 'U08', 'U13', 'U00', 'URUBAMBA', '1'),
(872, 'U08', 'U13', 'U01', 'URUBAMBA', '1'),
(873, 'U08', 'U13', 'U02', 'CHINCHERO', '1'),
(874, 'U08', 'U13', 'U03', 'HUAYLLABAMBA', '1'),
(875, 'U08', 'U13', 'U04', 'MACHUPICCHU', '1'),
(876, 'U08', 'U13', 'U05', 'MARAS', '1'),
(877, 'U08', 'U13', 'U06', 'OLLANTAYTAMBO', '1'),
(878, 'U08', 'U13', 'U07', 'YUCAY', '1'),
(879, 'U09', 'U00', 'U00', 'HUANCAVELICA', '1'),
(880, 'U09', 'U01', 'U00', 'HUANCAVELICA', '1'),
(881, 'U09', 'U01', 'U01', 'HUANCAVELICA', '1'),
(882, 'U09', 'U01', 'U02', 'ACOBAMBILLA', '1'),
(883, 'U09', 'U01', 'U03', 'ACORIA', '1'),
(884, 'U09', 'U01', 'U04', 'CONAYCA', '1'),
(885, 'U09', 'U01', 'U05', 'CUENCA', '1'),
(886, 'U09', 'U01', 'U06', 'HUACHOCOLPA', '1'),
(887, 'U09', 'U01', 'U07', 'HUAYLLAHUARA', '1'),
(888, 'U09', 'U01', 'U08', 'IZCUCHACA', '1'),
(889, 'U09', 'U01', 'U09', 'LARIA', '1'),
(890, 'U09', 'U01', 'U10', 'MANTA', '1'),
(891, 'U09', 'U01', 'U11', 'MARISCAL CACERES', '1'),
(892, 'U09', 'U01', 'U12', 'MOYA', '1'),
(893, 'U09', 'U01', 'U13', 'NUEVO OCCORO', '1'),
(894, 'U09', 'U01', 'U14', 'PALCA', '1'),
(895, 'U09', 'U01', 'U15', 'PILCHACA', '1'),
(896, 'U09', 'U01', 'U16', 'VILCA', '1'),
(897, 'U09', 'U01', 'U17', 'YAULI', '1'),
(898, 'U09', 'U01', 'U18', 'ASCENSION', '1'),
(899, 'U09', 'U01', 'U19', 'HUANDO', '1'),
(900, 'U09', 'U02', 'U00', 'ACOBAMBA', '1'),
(901, 'U09', 'U02', 'U01', 'ACOBAMBA', '1'),
(902, 'U09', 'U02', 'U02', 'ANDABAMBA', '1'),
(903, 'U09', 'U02', 'U03', 'ANTA', '1'),
(904, 'U09', 'U02', 'U04', 'CAJA', '1'),
(905, 'U09', 'U02', 'U05', 'MARCAS', '1'),
(906, 'U09', 'U02', 'U06', 'PAUCARA', '1'),
(907, 'U09', 'U02', 'U07', 'POMACOCHA', '1'),
(908, 'U09', 'U02', 'U08', 'ROSARIO', '1'),
(909, 'U09', 'U03', 'U00', 'ANGARAES', '1'),
(910, 'U09', 'U03', 'U01', 'LIRCAY', '1'),
(911, 'U09', 'U03', 'U02', 'ANCHONGA', '1'),
(912, 'U09', 'U03', 'U03', 'CALLANMARCA', '1'),
(913, 'U09', 'U03', 'U04', 'CCOCHACCASA', '1'),
(914, 'U09', 'U03', 'U05', 'CHINCHO', '1'),
(915, 'U09', 'U03', 'U06', 'CONGALLA', '1'),
(916, 'U09', 'U03', 'U07', 'HUANCA-HUANCA', '1'),
(917, 'U09', 'U03', 'U08', 'HUAYLLAY GRANDE', '1'),
(918, 'U09', 'U03', 'U09', 'JULCAMARCA', '1'),
(919, 'U09', 'U03', 'U10', 'SAN ANTONIO DE ANTAPARCO', '1'),
(920, 'U09', 'U03', 'U11', 'SANTO TOMAS DE PATA', '1'),
(921, 'U09', 'U03', 'U12', 'SECCLLA', '1'),
(922, 'U09', 'U04', 'U00', 'CASTROVIRREYNA', '1'),
(923, 'U09', 'U04', 'U01', 'CASTROVIRREYNA', '1'),
(924, 'U09', 'U04', 'U02', 'ARMA', '1'),
(925, 'U09', 'U04', 'U03', 'AURAHUA', '1'),
(926, 'U09', 'U04', 'U04', 'CAPILLAS', '1'),
(927, 'U09', 'U04', 'U05', 'CHUPAMARCA', '1'),
(928, 'U09', 'U04', 'U06', 'COCAS', '1'),
(929, 'U09', 'U04', 'U07', 'HUACHOS', '1'),
(930, 'U09', 'U04', 'U08', 'HUAMATAMBO', '1'),
(931, 'U09', 'U04', 'U09', 'MOLLEPAMPA', '1'),
(932, 'U09', 'U04', 'U10', 'SAN JUAN', '1'),
(933, 'U09', 'U04', 'U11', 'SANTA ANA', '1'),
(934, 'U09', 'U04', 'U12', 'TANTARA', '1'),
(935, 'U09', 'U04', 'U13', 'TICRAPO', '1'),
(936, 'U09', 'U05', 'U00', 'CHURCAMPA', '1'),
(937, 'U09', 'U05', 'U01', 'CHURCAMPA', '1'),
(938, 'U09', 'U05', 'U02', 'ANCO', '1'),
(939, 'U09', 'U05', 'U03', 'CHINCHIHUASI', '1'),
(940, 'U09', 'U05', 'U04', 'EL CARMEN', '1'),
(941, 'U09', 'U05', 'U05', 'LA MERCED', '1'),
(942, 'U09', 'U05', 'U06', 'LOCROJA', '1'),
(943, 'U09', 'U05', 'U07', 'PAUCARBAMBA', '1'),
(944, 'U09', 'U05', 'U08', 'SAN MIGUEL DE MAYOCC', '1'),
(945, 'U09', 'U05', 'U09', 'SAN PEDRO DE CORIS', '1'),
(946, 'U09', 'U05', 'U10', 'PACHAMARCA', '1'),
(947, 'U09', 'U06', 'U00', 'HUAYTARA', '1'),
(948, 'U09', 'U06', 'U01', 'HUAYTARA', '1'),
(949, 'U09', 'U06', 'U02', 'AYAVI', '1'),
(950, 'U09', 'U06', 'U03', 'CORDOVA', '1'),
(951, 'U09', 'U06', 'U04', 'HUAYACUNDO ARMA', '1'),
(952, 'U09', 'U06', 'U05', 'LARAMARCA', '1'),
(953, 'U09', 'U06', 'U06', 'OCOYO', '1'),
(954, 'U09', 'U06', 'U07', 'PILPICHACA', '1'),
(955, 'U09', 'U06', 'U08', 'QUERCO', '1'),
(956, 'U09', 'U06', 'U09', 'QUITO-ARMA', '1'),
(957, 'U09', 'U06', 'U10', 'SAN ANTONIO DE CUSICANCHA', '1'),
(958, 'U09', 'U06', 'U11', 'SAN FRANCISCO DE SANGAYAICO', '1'),
(959, 'U09', 'U06', 'U12', 'SAN ISIDRO', '1'),
(960, 'U09', 'U06', 'U13', 'SANTIAGO DE CHOCORVOS', '1'),
(961, 'U09', 'U06', 'U14', 'SANTIAGO DE QUIRAHUARA', '1'),
(962, 'U09', 'U06', 'U15', 'SANTO DOMINGO DE CAPILLAS', '1'),
(963, 'U09', 'U06', 'U16', 'TAMBO', '1'),
(964, 'U09', 'U07', 'U00', 'TAYACAJA', '1'),
(965, 'U09', 'U07', 'U01', 'PAMPAS', '1'),
(966, 'U09', 'U07', 'U02', 'ACOSTAMBO', '1'),
(967, 'U09', 'U07', 'U03', 'ACRAQUIA', '1'),
(968, 'U09', 'U07', 'U04', 'AHUAYCHA', '1'),
(969, 'U09', 'U07', 'U05', 'COLCABAMBA', '1'),
(970, 'U09', 'U07', 'U06', 'DANIEL HERNANDEZ', '1'),
(971, 'U09', 'U07', 'U07', 'HUACHOCOLPA', '1'),
(972, 'U09', 'U07', 'U09', 'HUARIBAMBA', '1'),
(973, 'U09', 'U07', 'U10', 'ÑAHUIMPUQUIO', '1'),
(974, 'U09', 'U07', 'U11', 'PAZOS', '1'),
(975, 'U09', 'U07', 'U13', 'QUISHUAR', '1'),
(976, 'U09', 'U07', 'U14', 'SALCABAMBA', '1'),
(977, 'U09', 'U07', 'U15', 'SALCAHUASI', '1'),
(978, 'U09', 'U07', 'U16', 'SAN MARCOS DE ROCCHAC', '1'),
(979, 'U09', 'U07', 'U17', 'SURCUBAMBA', '1'),
(980, 'U09', 'U07', 'U18', 'TINTAY PUNCU', '1'),
(981, 'U10', 'U00', 'U00', 'HUANUCO', '1'),
(982, 'U10', 'U01', 'U00', 'HUANUCO', '1'),
(983, 'U10', 'U01', 'U01', 'HUANUCO', '1'),
(984, 'U10', 'U01', 'U02', 'AMARILIS', '1'),
(985, 'U10', 'U01', 'U03', 'CHINCHAO', '1'),
(986, 'U10', 'U01', 'U04', 'CHURUBAMBA', '1'),
(987, 'U10', 'U01', 'U05', 'MARGOS', '1'),
(988, 'U10', 'U01', 'U06', 'QUISQUI', '1'),
(989, 'U10', 'U01', 'U07', 'SAN FRANCISCO DE CAYRAN', '1'),
(990, 'U10', 'U01', 'U08', 'SAN PEDRO DE CHAULAN', '1'),
(991, 'U10', 'U01', 'U09', 'SANTA MARIA DEL VALLE', '1'),
(992, 'U10', 'U01', 'U10', 'YARUMAYO', '1'),
(993, 'U10', 'U01', 'U11', 'PILLCO MARCA', '1'),
(994, 'U10', 'U02', 'U00', 'AMBO', '1'),
(995, 'U10', 'U02', 'U01', 'AMBO', '1'),
(996, 'U10', 'U02', 'U02', 'CAYNA', '1'),
(997, 'U10', 'U02', 'U03', 'COLPAS', '1'),
(998, 'U10', 'U02', 'U04', 'CONCHAMARCA', '1'),
(999, 'U10', 'U02', 'U05', 'HUACAR', '1'),
(1000, 'U10', 'U02', 'U06', 'SAN FRANCISCO', '1'),
(1001, 'U10', 'U02', 'U07', 'SAN RAFAEL', '1'),
(1002, 'U10', 'U02', 'U08', 'TOMAY KICHWA', '1'),
(1003, 'U10', 'U03', 'U00', 'DOS DE MAYO', '1'),
(1004, 'U10', 'U03', 'U01', 'LA UNION', '1'),
(1005, 'U10', 'U03', 'U07', 'CHUQUIS', '1'),
(1006, 'U10', 'U03', 'U11', 'MARIAS', '1'),
(1007, 'U10', 'U03', 'U13', 'PACHAS', '1'),
(1008, 'U10', 'U03', 'U16', 'QUIVILLA', '1'),
(1009, 'U10', 'U03', 'U17', 'RIPAN', '1'),
(1010, 'U10', 'U03', 'U21', 'SHUNQUI', '1'),
(1011, 'U10', 'U03', 'U22', 'SILLAPATA', '1'),
(1012, 'U10', 'U03', 'U23', 'YANAS', '1'),
(1013, 'U10', 'U04', 'U00', 'HUACAYBAMBA', '1'),
(1014, 'U10', 'U04', 'U01', 'HUACAYBAMBA', '1'),
(1015, 'U10', 'U04', 'U02', 'CANCHABAMBA', '1'),
(1016, 'U10', 'U04', 'U03', 'COCHABAMBA', '1'),
(1017, 'U10', 'U04', 'U04', 'PINRA', '1'),
(1018, 'U10', 'U05', 'U00', 'HUAMALIES', '1'),
(1019, 'U10', 'U05', 'U01', 'LLATA', '1'),
(1020, 'U10', 'U05', 'U02', 'ARANCAY', '1'),
(1021, 'U10', 'U05', 'U03', 'CHAVIN DE PARIARCA', '1'),
(1022, 'U10', 'U05', 'U04', 'JACAS GRANDE', '1'),
(1023, 'U10', 'U05', 'U05', 'JIRCAN', '1'),
(1024, 'U10', 'U05', 'U06', 'MIRAFLORES', '1'),
(1025, 'U10', 'U05', 'U07', 'MONZON', '1'),
(1026, 'U10', 'U05', 'U08', 'PUNCHAO', '1'),
(1027, 'U10', 'U05', 'U09', 'PUÑOS', '1'),
(1028, 'U10', 'U05', 'U10', 'SINGA', '1'),
(1029, 'U10', 'U05', 'U11', 'TANTAMAYO', '1'),
(1030, 'U10', 'U06', 'U00', 'LEONCIO PRADO', '1'),
(1031, 'U10', 'U06', 'U01', 'RUPA-RUPA', '1'),
(1032, 'U10', 'U06', 'U02', 'DANIEL ALOMIAS ROBLES', '1'),
(1033, 'U10', 'U06', 'U03', 'HERMILIO VALDIZAN', '1'),
(1034, 'U10', 'U06', 'U04', 'JOSE CRESPO Y CASTILLO', '1'),
(1035, 'U10', 'U06', 'U05', 'LUYANDO', '1'),
(1036, 'U10', 'U06', 'U06', 'MARIANO DAMASO BERAUN', '1'),
(1037, 'U10', 'U07', 'U00', 'MARAÑON', '1'),
(1038, 'U10', 'U07', 'U01', 'HUACRACHUCO', '1'),
(1039, 'U10', 'U07', 'U02', 'CHOLON', '1'),
(1040, 'U10', 'U07', 'U03', 'SAN BUENAVENTURA', '1'),
(1041, 'U10', 'U08', 'U00', 'PACHITEA', '1'),
(1042, 'U10', 'U08', 'U01', 'PANAO', '1'),
(1043, 'U10', 'U08', 'U02', 'CHAGLLA', '1'),
(1044, 'U10', 'U08', 'U03', 'MOLINO', '1'),
(1045, 'U10', 'U08', 'U04', 'UMARI', '1'),
(1046, 'U10', 'U09', 'U00', 'PUERTO INCA', '1'),
(1047, 'U10', 'U09', 'U01', 'PUERTO INCA', '1'),
(1048, 'U10', 'U09', 'U02', 'CODO DEL POZUZO', '1'),
(1049, 'U10', 'U09', 'U03', 'HONORIA', '1'),
(1050, 'U10', 'U09', 'U04', 'TOURNAVISTA', '1'),
(1051, 'U10', 'U09', 'U05', 'YUYAPICHIS', '1'),
(1052, 'U10', 'U10', 'U00', 'LAURICOCHA', '1'),
(1053, 'U10', 'U10', 'U01', 'JESUS', '1'),
(1054, 'U10', 'U10', 'U02', 'BAÑOS', '1'),
(1055, 'U10', 'U10', 'U03', 'JIVIA', '1'),
(1056, 'U10', 'U10', 'U04', 'QUEROPALCA', '1'),
(1057, 'U10', 'U10', 'U05', 'RONDOS', '1'),
(1058, 'U10', 'U10', 'U06', 'SAN FRANCISCO DE ASIS', '1'),
(1059, 'U10', 'U10', 'U07', 'SAN MIGUEL DE CAURI', '1'),
(1060, 'U10', 'U11', 'U00', 'YAROWILCA', '1'),
(1061, 'U10', 'U11', 'U01', 'CHAVINILLO', '1'),
(1062, 'U10', 'U11', 'U02', 'CAHUAC', '1'),
(1063, 'U10', 'U11', 'U03', 'CHACABAMBA', '1'),
(1064, 'U10', 'U11', 'U04', 'APARICIO POMARES', '1'),
(1065, 'U10', 'U11', 'U05', 'JACAS CHICO', '1'),
(1066, 'U10', 'U11', 'U06', 'OBAS', '1'),
(1067, 'U10', 'U11', 'U07', 'PAMPAMARCA', '1'),
(1068, 'U10', 'U11', 'U08', 'CHORAS', '1'),
(1069, 'U11', 'U00', 'U00', 'ICA', '1'),
(1070, 'U11', 'U01', 'U00', 'ICA', '1'),
(1071, 'U11', 'U01', 'U01', 'ICA', '1'),
(1072, 'U11', 'U01', 'U02', 'LA TINGUIÑA', '1'),
(1073, 'U11', 'U01', 'U03', 'LOS AQUIJES', '1'),
(1074, 'U11', 'U01', 'U04', 'OCUCAJE', '1'),
(1075, 'U11', 'U01', 'U05', 'PACHACUTEC', '1'),
(1076, 'U11', 'U01', 'U06', 'PARCONA', '1'),
(1077, 'U11', 'U01', 'U07', 'PUEBLO NUEVO', '1'),
(1078, 'U11', 'U01', 'U08', 'SALAS', '1'),
(1079, 'U11', 'U01', 'U09', 'SAN JOSE DE LOS MOLINOS', '1'),
(1080, 'U11', 'U01', 'U10', 'SAN JUAN BAUTISTA', '1'),
(1081, 'U11', 'U01', 'U11', 'SANTIAGO', '1'),
(1082, 'U11', 'U01', 'U12', 'SUBTANJALLA', '1'),
(1083, 'U11', 'U01', 'U13', 'TATE', '1'),
(1084, 'U11', 'U01', 'U14', 'YAUCA DEL ROSARIO', '1'),
(1085, 'U11', 'U02', 'U00', 'CHINCHA', '1'),
(1086, 'U11', 'U02', 'U01', 'CHINCHA ALTA', '1'),
(1087, 'U11', 'U02', 'U02', 'ALTO LARAN', '1'),
(1088, 'U11', 'U02', 'U03', 'CHAVIN', '1'),
(1089, 'U11', 'U02', 'U04', 'CHINCHA BAJA', '1'),
(1090, 'U11', 'U02', 'U05', 'EL CARMEN', '1'),
(1091, 'U11', 'U02', 'U06', 'GROCIO PRADO', '1'),
(1092, 'U11', 'U02', 'U07', 'PUEBLO NUEVO', '1'),
(1093, 'U11', 'U02', 'U08', 'SAN JUAN DE YANAC', '1'),
(1094, 'U11', 'U02', 'U09', 'SAN PEDRO DE HUACARPANA', '1'),
(1095, 'U11', 'U02', 'U10', 'SUNAMPE', '1'),
(1096, 'U11', 'U02', 'U11', 'TAMBO DE MORA', '1'),
(1097, 'U11', 'U03', 'U00', 'NAZCA', '1'),
(1098, 'U11', 'U03', 'U01', 'NAZCA', '1'),
(1099, 'U11', 'U03', 'U02', 'CHANGUILLO', '1'),
(1100, 'U11', 'U03', 'U03', 'EL INGENIO', '1'),
(1101, 'U11', 'U03', 'U04', 'MARCONA', '1'),
(1102, 'U11', 'U03', 'U05', 'VISTA ALEGRE', '1'),
(1103, 'U11', 'U04', 'U00', 'PALPA', '1'),
(1104, 'U11', 'U04', 'U01', 'PALPA', '1'),
(1105, 'U11', 'U04', 'U02', 'LLIPATA', '1'),
(1106, 'U11', 'U04', 'U03', 'RIO GRANDE', '1'),
(1107, 'U11', 'U04', 'U04', 'SANTA CRUZ', '1'),
(1108, 'U11', 'U04', 'U05', 'TIBILLO', '1'),
(1109, 'U11', 'U05', 'U00', 'PISCO', '1'),
(1110, 'U11', 'U05', 'U01', 'PISCO', '1'),
(1111, 'U11', 'U05', 'U02', 'HUANCANO', '1'),
(1112, 'U11', 'U05', 'U03', 'HUMAY', '1'),
(1113, 'U11', 'U05', 'U04', 'INDEPENDENCIA', '1'),
(1114, 'U11', 'U05', 'U05', 'PARACAS', '1'),
(1115, 'U11', 'U05', 'U06', 'SAN ANDRES', '1'),
(1116, 'U11', 'U05', 'U07', 'SAN CLEMENTE', '1'),
(1117, 'U11', 'U05', 'U08', 'TUPAC AMARU INCA', '1'),
(1118, 'U12', 'U00', 'U00', 'JUNIN', '1'),
(1119, 'U12', 'U01', 'U00', 'HUANCAYO', '1'),
(1120, 'U12', 'U01', 'U01', 'HUANCAYO', '1'),
(1121, 'U12', 'U01', 'U04', 'CARHUACALLANGA', '1'),
(1122, 'U12', 'U01', 'U05', 'CHACAPAMPA', '1'),
(1123, 'U12', 'U01', 'U06', 'CHICCHE', '1'),
(1124, 'U12', 'U01', 'U07', 'CHILCA', '1'),
(1125, 'U12', 'U01', 'U08', 'CHONGOS ALTO', '1'),
(1126, 'U12', 'U01', 'U11', 'CHUPURO', '1'),
(1127, 'U12', 'U01', 'U12', 'COLCA', '1'),
(1128, 'U12', 'U01', 'U13', 'CULLHUAS', '1'),
(1129, 'U12', 'U01', 'U14', 'EL TAMBO', '1'),
(1130, 'U12', 'U01', 'U16', 'HUACRAPUQUIO', '1'),
(1131, 'U12', 'U01', 'U17', 'HUALHUAS', '1');
INSERT INTO `tbl_ubigeo` (`ID_UBIGEO`, `CodDpto`, `CodProv`, `CodDist`, `Ubigeo`, `Activo`) VALUES
(1132, 'U12', 'U01', 'U19', 'HUANCAN', '1'),
(1133, 'U12', 'U01', 'U20', 'HUASICANCHA', '1'),
(1134, 'U12', 'U01', 'U21', 'HUAYUCACHI', '1'),
(1135, 'U12', 'U01', 'U22', 'INGENIO', '1'),
(1136, 'U12', 'U01', 'U24', 'PARIAHUANCA', '1'),
(1137, 'U12', 'U01', 'U25', 'PILCOMAYO', '1'),
(1138, 'U12', 'U01', 'U26', 'PUCARA', '1'),
(1139, 'U12', 'U01', 'U27', 'QUICHUAY', '1'),
(1140, 'U12', 'U01', 'U28', 'QUILCAS', '1'),
(1141, 'U12', 'U01', 'U29', 'SAN AGUSTIN', '1'),
(1142, 'U12', 'U01', 'U30', 'SAN JERONIMO DE TUNAN', '1'),
(1143, 'U12', 'U01', 'U32', 'SAÑO', '1'),
(1144, 'U12', 'U01', 'U33', 'SAPALLANGA', '1'),
(1145, 'U12', 'U01', 'U34', 'SICAYA', '1'),
(1146, 'U12', 'U01', 'U35', 'SANTO DOMINGO DE ACOBAMBA', '1'),
(1147, 'U12', 'U01', 'U36', 'VIQUES', '1'),
(1148, 'U12', 'U02', 'U00', 'CONCEPCION', '1'),
(1149, 'U12', 'U02', 'U01', 'CONCEPCION', '1'),
(1150, 'U12', 'U02', 'U02', 'ACO', '1'),
(1151, 'U12', 'U02', 'U03', 'ANDAMARCA', '1'),
(1152, 'U12', 'U02', 'U04', 'CHAMBARA', '1'),
(1153, 'U12', 'U02', 'U05', 'COCHAS', '1'),
(1154, 'U12', 'U02', 'U06', 'COMAS', '1'),
(1155, 'U12', 'U02', 'U07', 'HEROINAS TOLEDO', '1'),
(1156, 'U12', 'U02', 'U08', 'MANZANARES', '1'),
(1157, 'U12', 'U02', 'U09', 'MARISCAL CASTILLA', '1'),
(1158, 'U12', 'U02', 'U10', 'MATAHUASI', '1'),
(1159, 'U12', 'U02', 'U11', 'MITO', '1'),
(1160, 'U12', 'U02', 'U12', 'NUEVE DE JULIO', '1'),
(1161, 'U12', 'U02', 'U13', 'ORCOTUNA', '1'),
(1162, 'U12', 'U02', 'U14', 'SAN JOSE DE QUERO', '1'),
(1163, 'U12', 'U02', 'U15', 'SANTA ROSA DE OCOPA', '1'),
(1164, 'U12', 'U03', 'U00', 'CHANCHAMAYO', '1'),
(1165, 'U12', 'U03', 'U01', 'CHANCHAMAYO', '1'),
(1166, 'U12', 'U03', 'U02', 'PERENE', '1'),
(1167, 'U12', 'U03', 'U03', 'PICHANAQUI', '1'),
(1168, 'U12', 'U03', 'U04', 'SAN LUIS DE SHUARO', '1'),
(1169, 'U12', 'U03', 'U05', 'SAN RAMON', '1'),
(1170, 'U12', 'U03', 'U06', 'VITOC', '1'),
(1171, 'U12', 'U04', 'U00', 'JAUJA', '1'),
(1172, 'U12', 'U04', 'U01', 'JAUJA', '1'),
(1173, 'U12', 'U04', 'U02', 'ACOLLA', '1'),
(1174, 'U12', 'U04', 'U03', 'APATA', '1'),
(1175, 'U12', 'U04', 'U04', 'ATAURA', '1'),
(1176, 'U12', 'U04', 'U05', 'CANCHAYLLO', '1'),
(1177, 'U12', 'U04', 'U06', 'CURICACA', '1'),
(1178, 'U12', 'U04', 'U07', 'EL MANTARO', '1'),
(1179, 'U12', 'U04', 'U08', 'HUAMALI', '1'),
(1180, 'U12', 'U04', 'U09', 'HUARIPAMPA', '1'),
(1181, 'U12', 'U04', 'U10', 'HUERTAS', '1'),
(1182, 'U12', 'U04', 'U11', 'JANJAILLO', '1'),
(1183, 'U12', 'U04', 'U12', 'JULCAN', '1'),
(1184, 'U12', 'U04', 'U13', 'LEONOR ORDOÑEZ', '1'),
(1185, 'U12', 'U04', 'U14', 'LLOCLLAPAMPA', '1'),
(1186, 'U12', 'U04', 'U15', 'MARCO', '1'),
(1187, 'U12', 'U04', 'U16', 'MASMA', '1'),
(1188, 'U12', 'U04', 'U17', 'MASMA CHICCHE', '1'),
(1189, 'U12', 'U04', 'U18', 'MOLINOS', '1'),
(1190, 'U12', 'U04', 'U19', 'MONOBAMBA', '1'),
(1191, 'U12', 'U04', 'U20', 'MUQUI', '1'),
(1192, 'U12', 'U04', 'U21', 'MUQUIYAUYO', '1'),
(1193, 'U12', 'U04', 'U22', 'PACA', '1'),
(1194, 'U12', 'U04', 'U23', 'PACCHA', '1'),
(1195, 'U12', 'U04', 'U24', 'PANCAN', '1'),
(1196, 'U12', 'U04', 'U25', 'PARCO', '1'),
(1197, 'U12', 'U04', 'U26', 'POMACANCHA', '1'),
(1198, 'U12', 'U04', 'U27', 'RICRAN', '1'),
(1199, 'U12', 'U04', 'U28', 'SAN LORENZO', '1'),
(1200, 'U12', 'U04', 'U29', 'SAN PEDRO DE CHUNAN', '1'),
(1201, 'U12', 'U04', 'U30', 'SAUSA', '1'),
(1202, 'U12', 'U04', 'U31', 'SINCOS', '1'),
(1203, 'U12', 'U04', 'U32', 'TUNAN MARCA', '1'),
(1204, 'U12', 'U04', 'U33', 'YAULI', '1'),
(1205, 'U12', 'U04', 'U34', 'YAUYOS', '1'),
(1206, 'U12', 'U05', 'U00', 'JUNIN', '1'),
(1207, 'U12', 'U05', 'U01', 'JUNIN', '1'),
(1208, 'U12', 'U05', 'U02', 'CARHUAMAYO', '1'),
(1209, 'U12', 'U05', 'U03', 'ONDORES', '1'),
(1210, 'U12', 'U05', 'U04', 'ULCUMAYO', '1'),
(1211, 'U12', 'U06', 'U00', 'SATIPO', '1'),
(1212, 'U12', 'U06', 'U01', 'SATIPO', '1'),
(1213, 'U12', 'U06', 'U02', 'COVIRIALI', '1'),
(1214, 'U12', 'U06', 'U03', 'LLAYLLA', '1'),
(1215, 'U12', 'U06', 'U04', 'MAZAMARI', '1'),
(1216, 'U12', 'U06', 'U05', 'PAMPA HERMOSA', '1'),
(1217, 'U12', 'U06', 'U06', 'PANGOA', '1'),
(1218, 'U12', 'U06', 'U07', 'RIO NEGRO', '1'),
(1219, 'U12', 'U06', 'U08', 'RIO TAMBO', '1'),
(1220, 'U12', 'U07', 'U00', 'TARMA', '1'),
(1221, 'U12', 'U07', 'U01', 'TARMA', '1'),
(1222, 'U12', 'U07', 'U02', 'ACOBAMBA', '1'),
(1223, 'U12', 'U07', 'U03', 'HUARICOLCA', '1'),
(1224, 'U12', 'U07', 'U04', 'HUASAHUASI', '1'),
(1225, 'U12', 'U07', 'U05', 'LA UNION', '1'),
(1226, 'U12', 'U07', 'U06', 'PALCA', '1'),
(1227, 'U12', 'U07', 'U07', 'PALCAMAYO', '1'),
(1228, 'U12', 'U07', 'U08', 'SAN PEDRO DE CAJAS', '1'),
(1229, 'U12', 'U07', 'U09', 'TAPO', '1'),
(1230, 'U12', 'U08', 'U00', 'YAULI', '1'),
(1231, 'U12', 'U08', 'U01', 'LA OROYA', '1'),
(1232, 'U12', 'U08', 'U02', 'CHACAPALPA', '1'),
(1233, 'U12', 'U08', 'U03', 'HUAY-HUAY', '1'),
(1234, 'U12', 'U08', 'U04', 'MARCAPOMACOCHA', '1'),
(1235, 'U12', 'U08', 'U05', 'MOROCOCHA', '1'),
(1236, 'U12', 'U08', 'U06', 'PACCHA', '1'),
(1237, 'U12', 'U08', 'U07', 'SANTA BARBARA DE CARHUACAYAN', '1'),
(1238, 'U12', 'U08', 'U08', 'SANTA ROSA DE SACCO', '1'),
(1239, 'U12', 'U08', 'U09', 'SUITUCANCHA', '1'),
(1240, 'U12', 'U08', 'U10', 'YAULI', '1'),
(1241, 'U12', 'U09', 'U00', 'CHUPACA', '1'),
(1242, 'U12', 'U09', 'U01', 'CHUPACA', '1'),
(1243, 'U12', 'U09', 'U02', 'AHUAC', '1'),
(1244, 'U12', 'U09', 'U03', 'CHONGOS BAJO', '1'),
(1245, 'U12', 'U09', 'U04', 'HUACHAC', '1'),
(1246, 'U12', 'U09', 'U05', 'HUAMANCACA CHICO', '1'),
(1247, 'U12', 'U09', 'U06', 'SAN JUAN DE YSCOS', '1'),
(1248, 'U12', 'U09', 'U07', 'SAN JUAN DE JARPA', '1'),
(1249, 'U12', 'U09', 'U08', 'TRES DE DICIEMBRE', '1'),
(1250, 'U12', 'U09', 'U09', 'YANACANCHA', '1'),
(1251, 'U13', 'U00', 'U00', 'LA LIBERTAD', '1'),
(1252, 'U13', 'U01', 'U00', 'TRUJILLO', '1'),
(1253, 'U13', 'U01', 'U01', 'TRUJILLO', '1'),
(1254, 'U13', 'U01', 'U02', 'EL PORVENIR', '1'),
(1255, 'U13', 'U01', 'U03', 'FLORENCIA DE MORA', '1'),
(1256, 'U13', 'U01', 'U04', 'HUANCHACO', '1'),
(1257, 'U13', 'U01', 'U05', 'LA ESPERANZA', '1'),
(1258, 'U13', 'U01', 'U06', 'LAREDO', '1'),
(1259, 'U13', 'U01', 'U07', 'MOCHE', '1'),
(1260, 'U13', 'U01', 'U08', 'POROTO', '1'),
(1261, 'U13', 'U01', 'U09', 'SALAVERRY', '1'),
(1262, 'U13', 'U01', 'U10', 'SIMBAL', '1'),
(1263, 'U13', 'U01', 'U11', 'VICTOR LARCO HERRERA', '1'),
(1264, 'U13', 'U02', 'U00', 'ASCOPE', '1'),
(1265, 'U13', 'U02', 'U01', 'ASCOPE', '1'),
(1266, 'U13', 'U02', 'U02', 'CHICAMA', '1'),
(1267, 'U13', 'U02', 'U03', 'CHOCOPE', '1'),
(1268, 'U13', 'U02', 'U04', 'MAGDALENA DE CAO', '1'),
(1269, 'U13', 'U02', 'U05', 'PAIJAN', '1'),
(1270, 'U13', 'U02', 'U06', 'RAZURI', '1'),
(1271, 'U13', 'U02', 'U07', 'SANTIAGO DE CAO', '1'),
(1272, 'U13', 'U02', 'U08', 'CASA GRANDE', '1'),
(1273, 'U13', 'U03', 'U00', 'BOLIVAR', '1'),
(1274, 'U13', 'U03', 'U01', 'BOLIVAR', '1'),
(1275, 'U13', 'U03', 'U02', 'BAMBAMARCA', '1'),
(1276, 'U13', 'U03', 'U03', 'CONDORMARCA', '1'),
(1277, 'U13', 'U03', 'U04', 'LONGOTEA', '1'),
(1278, 'U13', 'U03', 'U05', 'UCHUMARCA', '1'),
(1279, 'U13', 'U03', 'U06', 'UCUNCHA', '1'),
(1280, 'U13', 'U04', 'U00', 'CHEPEN', '1'),
(1281, 'U13', 'U04', 'U01', 'CHEPEN', '1'),
(1282, 'U13', 'U04', 'U02', 'PACANGA', '1'),
(1283, 'U13', 'U04', 'U03', 'PUEBLO NUEVO', '1'),
(1284, 'U13', 'U05', 'U00', 'JULCAN', '1'),
(1285, 'U13', 'U05', 'U01', 'JULCAN', '1'),
(1286, 'U13', 'U05', 'U02', 'CALAMARCA', '1'),
(1287, 'U13', 'U05', 'U03', 'CARABAMBA', '1'),
(1288, 'U13', 'U05', 'U04', 'HUASO', '1'),
(1289, 'U13', 'U06', 'U00', 'OTUZCO', '1'),
(1290, 'U13', 'U06', 'U01', 'OTUZCO', '1'),
(1291, 'U13', 'U06', 'U02', 'AGALLPAMPA', '1'),
(1292, 'U13', 'U06', 'U04', 'CHARAT', '1'),
(1293, 'U13', 'U06', 'U05', 'HUARANCHAL', '1'),
(1294, 'U13', 'U06', 'U06', 'LA CUESTA', '1'),
(1295, 'U13', 'U06', 'U08', 'MACHE', '1'),
(1296, 'U13', 'U06', 'U10', 'PARANDAY', '1'),
(1297, 'U13', 'U06', 'U11', 'SALPO', '1'),
(1298, 'U13', 'U06', 'U13', 'SINSICAP', '1'),
(1299, 'U13', 'U06', 'U14', 'USQUIL', '1'),
(1300, 'U13', 'U07', 'U00', 'PACASMAYO', '1'),
(1301, 'U13', 'U07', 'U01', 'SAN PEDRO DE LLOC', '1'),
(1302, 'U13', 'U07', 'U02', 'GUADALUPE', '1'),
(1303, 'U13', 'U07', 'U03', 'JEQUETEPEQUE', '1'),
(1304, 'U13', 'U07', 'U04', 'PACASMAYO', '1'),
(1305, 'U13', 'U07', 'U05', 'SAN JOSE', '1'),
(1306, 'U13', 'U08', 'U00', 'PATAZ', '1'),
(1307, 'U13', 'U08', 'U01', 'TAYABAMBA', '1'),
(1308, 'U13', 'U08', 'U02', 'BULDIBUYO', '1'),
(1309, 'U13', 'U08', 'U03', 'CHILLIA', '1'),
(1310, 'U13', 'U08', 'U04', 'HUANCASPATA', '1'),
(1311, 'U13', 'U08', 'U05', 'HUAYLILLAS', '1'),
(1312, 'U13', 'U08', 'U06', 'HUAYO', '1'),
(1313, 'U13', 'U08', 'U07', 'ONGON', '1'),
(1314, 'U13', 'U08', 'U08', 'PARCOY', '1'),
(1315, 'U13', 'U08', 'U09', 'PATAZ', '1'),
(1316, 'U13', 'U08', 'U10', 'PIAS', '1'),
(1317, 'U13', 'U08', 'U11', 'SANTIAGO DE CHALLAS', '1'),
(1318, 'U13', 'U08', 'U12', 'TAURIJA', '1'),
(1319, 'U13', 'U08', 'U13', 'URPAY', '1'),
(1320, 'U13', 'U09', 'U00', 'SANCHEZ CARRION', '1'),
(1321, 'U13', 'U09', 'U01', 'HUAMACHUCO', '1'),
(1322, 'U13', 'U09', 'U02', 'CHUGAY', '1'),
(1323, 'U13', 'U09', 'U03', 'COCHORCO', '1'),
(1324, 'U13', 'U09', 'U04', 'CURGOS', '1'),
(1325, 'U13', 'U09', 'U05', 'MARCABAL', '1'),
(1326, 'U13', 'U09', 'U06', 'SANAGORAN', '1'),
(1327, 'U13', 'U09', 'U07', 'SARIN', '1'),
(1328, 'U13', 'U09', 'U08', 'SARTIMBAMBA', '1'),
(1329, 'U13', 'U10', 'U00', 'SANTIAGO DE CHUCO', '1'),
(1330, 'U13', 'U10', 'U01', 'SANTIAGO DE CHUCO', '1'),
(1331, 'U13', 'U10', 'U02', 'ANGASMARCA', '1'),
(1332, 'U13', 'U10', 'U03', 'CACHICADAN', '1'),
(1333, 'U13', 'U10', 'U04', 'MOLLEBAMBA', '1'),
(1334, 'U13', 'U10', 'U05', 'MOLLEPATA', '1'),
(1335, 'U13', 'U10', 'U06', 'QUIRUVILCA', '1'),
(1336, 'U13', 'U10', 'U07', 'SANTA CRUZ DE CHUCA', '1'),
(1337, 'U13', 'U10', 'U08', 'SITABAMBA', '1'),
(1338, 'U13', 'U11', 'U00', 'GRAN CHIMU', '1'),
(1339, 'U13', 'U11', 'U01', 'CASCAS', '1'),
(1340, 'U13', 'U11', 'U02', 'LUCMA', '1'),
(1341, 'U13', 'U11', 'U03', 'COMPIN', '1'),
(1342, 'U13', 'U11', 'U04', 'SAYAPULLO', '1'),
(1343, 'U13', 'U12', 'U00', 'VIRU', '1'),
(1344, 'U13', 'U12', 'U01', 'VIRU', '1'),
(1345, 'U13', 'U12', 'U02', 'CHAO', '1'),
(1346, 'U13', 'U12', 'U03', 'GUADALUPITO', '1'),
(1347, 'U14', 'U00', 'U00', 'LAMBAYEQUE', '1'),
(1348, 'U14', 'U01', 'U00', 'CHICLAYO', '1'),
(1349, 'U14', 'U01', 'U01', 'CHICLAYO', '1'),
(1350, 'U14', 'U01', 'U02', 'CHONGOYAPE', '1'),
(1351, 'U14', 'U01', 'U03', 'ETEN', '1'),
(1352, 'U14', 'U01', 'U04', 'ETEN PUERTO', '1'),
(1353, 'U14', 'U01', 'U05', 'JOSE LEONARDO ORTIZ', '1'),
(1354, 'U14', 'U01', 'U06', 'LA VICTORIA', '1'),
(1355, 'U14', 'U01', 'U07', 'LAGUNAS', '1'),
(1356, 'U14', 'U01', 'U08', 'MONSEFU', '1'),
(1357, 'U14', 'U01', 'U09', 'NUEVA ARICA', '1'),
(1358, 'U14', 'U01', 'U10', 'OYOTUN', '1'),
(1359, 'U14', 'U01', 'U11', 'PICSI', '1'),
(1360, 'U14', 'U01', 'U12', 'PIMENTEL', '1'),
(1361, 'U14', 'U01', 'U13', 'REQUE', '1'),
(1362, 'U14', 'U01', 'U14', 'SANTA ROSA', '1'),
(1363, 'U14', 'U01', 'U15', 'SAÑA', '1'),
(1364, 'U14', 'U01', 'U16', 'CAYALTI', '1'),
(1365, 'U14', 'U01', 'U17', 'PATAPO', '1'),
(1366, 'U14', 'U01', 'U18', 'POMALCA', '1'),
(1367, 'U14', 'U01', 'U19', 'PUCALA', '1'),
(1368, 'U14', 'U01', 'U20', 'TUMAN', '1'),
(1369, 'U14', 'U02', 'U00', 'FERREÑAFE', '1'),
(1370, 'U14', 'U02', 'U01', 'FERREÑAFE', '1'),
(1371, 'U14', 'U02', 'U02', 'CAÑARIS', '1'),
(1372, 'U14', 'U02', 'U03', 'INCAHUASI', '1'),
(1373, 'U14', 'U02', 'U04', 'MANUEL ANTONIO MESONES MURO', '1'),
(1374, 'U14', 'U02', 'U05', 'PITIPO', '1'),
(1375, 'U14', 'U02', 'U06', 'PUEBLO NUEVO', '1'),
(1376, 'U14', 'U03', 'U00', 'LAMBAYEQUE', '1'),
(1377, 'U14', 'U03', 'U01', 'LAMBAYEQUE', '1'),
(1378, 'U14', 'U03', 'U02', 'CHOCHOPE', '1'),
(1379, 'U14', 'U03', 'U03', 'ILLIMO', '1'),
(1380, 'U14', 'U03', 'U04', 'JAYANCA', '1'),
(1381, 'U14', 'U03', 'U05', 'MOCHUMI', '1'),
(1382, 'U14', 'U03', 'U06', 'MORROPE', '1'),
(1383, 'U14', 'U03', 'U07', 'MOTUPE', '1'),
(1384, 'U14', 'U03', 'U08', 'OLMOS', '1'),
(1385, 'U14', 'U03', 'U09', 'PACORA', '1'),
(1386, 'U14', 'U03', 'U10', 'SALAS', '1'),
(1387, 'U14', 'U03', 'U11', 'SAN JOSE', '1'),
(1388, 'U14', 'U03', 'U12', 'TUCUME', '1'),
(1389, 'U15', 'U00', 'U00', 'LIMA', '1'),
(1390, 'U15', 'U01', 'U00', 'LIMA', '1'),
(1391, 'U15', 'U01', 'U01', 'LIMA', '1'),
(1392, 'U15', 'U01', 'U02', 'ANCON', '1'),
(1393, 'U15', 'U01', 'U03', 'ATE', '1'),
(1394, 'U15', 'U01', 'U04', 'BARRANCO', '1'),
(1395, 'U15', 'U01', 'U05', 'BREÑA', '1'),
(1396, 'U15', 'U01', 'U06', 'CARABAYLLO', '1'),
(1397, 'U15', 'U01', 'U07', 'CHACLACAYO', '1'),
(1398, 'U15', 'U01', 'U08', 'CHORRILLOS', '1'),
(1399, 'U15', 'U01', 'U09', 'CIENEGUILLA', '1'),
(1400, 'U15', 'U01', 'U10', 'COMAS', '1'),
(1401, 'U15', 'U01', 'U11', 'EL AGUSTINO', '1'),
(1402, 'U15', 'U01', 'U12', 'INDEPENDENCIA', '1'),
(1403, 'U15', 'U01', 'U13', 'JESUS MARIA', '1'),
(1404, 'U15', 'U01', 'U14', 'LA MOLINA', '1'),
(1405, 'U15', 'U01', 'U15', 'LA VICTORIA', '1'),
(1406, 'U15', 'U01', 'U16', 'LINCE', '1'),
(1407, 'U15', 'U01', 'U17', 'LOS OLIVOS', '1'),
(1408, 'U15', 'U01', 'U18', 'LURIGANCHO', '1'),
(1409, 'U15', 'U01', 'U19', 'LURIN', '1'),
(1410, 'U15', 'U01', 'U20', 'MAGDALENA DEL MAR', '1'),
(1411, 'U15', 'U01', 'U21', 'MAGDALENA VIEJA', '1'),
(1412, 'U15', 'U01', 'U22', 'MIRAFLORES', '1'),
(1413, 'U15', 'U01', 'U23', 'PACHACAMAC', '1'),
(1414, 'U15', 'U01', 'U24', 'PUCUSANA', '1'),
(1415, 'U15', 'U01', 'U25', 'PUENTE PIEDRA', '1'),
(1416, 'U15', 'U01', 'U26', 'PUNTA HERMOSA', '1'),
(1417, 'U15', 'U01', 'U27', 'PUNTA NEGRA', '1'),
(1418, 'U15', 'U01', 'U28', 'RIMAC', '1'),
(1419, 'U15', 'U01', 'U29', 'SAN BARTOLO', '1'),
(1420, 'U15', 'U01', 'U30', 'SAN BORJA', '1'),
(1421, 'U15', 'U01', 'U31', 'SAN ISIDRO', '1'),
(1422, 'U15', 'U01', 'U32', 'SAN JUAN DE LURIGANCHO', '1'),
(1423, 'U15', 'U01', 'U33', 'SAN JUAN DE MIRAFLORES', '1'),
(1424, 'U15', 'U01', 'U34', 'SAN LUIS', '1'),
(1425, 'U15', 'U01', 'U35', 'SAN MARTIN DE PORRES', '1'),
(1426, 'U15', 'U01', 'U36', 'SAN MIGUEL', '1'),
(1427, 'U15', 'U01', 'U37', 'SANTA ANITA', '1'),
(1428, 'U15', 'U01', 'U38', 'SANTA MARIA DEL MAR', '1'),
(1429, 'U15', 'U01', 'U39', 'SANTA ROSA', '1'),
(1430, 'U15', 'U01', 'U40', 'SANTIAGO DE SURCO', '1'),
(1431, 'U15', 'U01', 'U41', 'SURQUILLO', '1'),
(1432, 'U15', 'U01', 'U42', 'VILLA EL SALVADOR', '1'),
(1433, 'U15', 'U01', 'U43', 'VILLA MARIA DEL TRIUNFO', '1'),
(1434, 'U15', 'U02', 'U00', 'BARRANCA', '1'),
(1435, 'U15', 'U02', 'U01', 'BARRANCA', '1'),
(1436, 'U15', 'U02', 'U02', 'PARAMONGA', '1'),
(1437, 'U15', 'U02', 'U03', 'PATIVILCA', '1'),
(1438, 'U15', 'U02', 'U04', 'SUPE', '1'),
(1439, 'U15', 'U02', 'U05', 'SUPE PUERTO', '1'),
(1440, 'U15', 'U03', 'U00', 'CAJATAMBO', '1'),
(1441, 'U15', 'U03', 'U01', 'CAJATAMBO', '1'),
(1442, 'U15', 'U03', 'U02', 'COPA', '1'),
(1443, 'U15', 'U03', 'U03', 'GORGOR', '1'),
(1444, 'U15', 'U03', 'U04', 'HUANCAPON', '1'),
(1445, 'U15', 'U03', 'U05', 'MANAS', '1'),
(1446, 'U15', 'U04', 'U00', 'CANTA', '1'),
(1447, 'U15', 'U04', 'U01', 'CANTA', '1'),
(1448, 'U15', 'U04', 'U02', 'ARAHUAY', '1'),
(1449, 'U15', 'U04', 'U03', 'HUAMANTANGA', '1'),
(1450, 'U15', 'U04', 'U04', 'HUAROS', '1'),
(1451, 'U15', 'U04', 'U05', 'LACHAQUI', '1'),
(1452, 'U15', 'U04', 'U06', 'SAN BUENAVENTURA', '1'),
(1453, 'U15', 'U04', 'U07', 'SANTA ROSA DE QUIVES', '1'),
(1454, 'U15', 'U05', 'U00', 'CAÑETE', '1'),
(1455, 'U15', 'U05', 'U01', 'SAN VICENTE DE CAÑETE', '1'),
(1456, 'U15', 'U05', 'U02', 'ASIA', '1'),
(1457, 'U15', 'U05', 'U03', 'CALANGO', '1'),
(1458, 'U15', 'U05', 'U04', 'CERRO AZUL', '1'),
(1459, 'U15', 'U05', 'U05', 'CHILCA', '1'),
(1460, 'U15', 'U05', 'U06', 'COAYLLO', '1'),
(1461, 'U15', 'U05', 'U07', 'IMPERIAL', '1'),
(1462, 'U15', 'U05', 'U08', 'LUNAHUANA', '1'),
(1463, 'U15', 'U05', 'U09', 'MALA', '1'),
(1464, 'U15', 'U05', 'U10', 'NUEVO IMPERIAL', '1'),
(1465, 'U15', 'U05', 'U11', 'PACARAN', '1'),
(1466, 'U15', 'U05', 'U12', 'QUILMANA', '1'),
(1467, 'U15', 'U05', 'U13', 'SAN ANTONIO', '1'),
(1468, 'U15', 'U05', 'U14', 'SAN LUIS', '1'),
(1469, 'U15', 'U05', 'U15', 'SANTA CRUZ DE FLORES', '1'),
(1470, 'U15', 'U05', 'U16', 'ZUÑIGA', '1'),
(1471, 'U15', 'U06', 'U00', 'HUARAL', '1'),
(1472, 'U15', 'U06', 'U01', 'HUARAL', '1'),
(1473, 'U15', 'U06', 'U02', 'ATAVILLOS ALTO', '1'),
(1474, 'U15', 'U06', 'U03', 'ATAVILLOS BAJO', '1'),
(1475, 'U15', 'U06', 'U04', 'AUCALLAMA', '1'),
(1476, 'U15', 'U06', 'U05', 'CHANCAY', '1'),
(1477, 'U15', 'U06', 'U06', 'IHUARI', '1'),
(1478, 'U15', 'U06', 'U07', 'LAMPIAN', '1'),
(1479, 'U15', 'U06', 'U08', 'PACARAOS', '1'),
(1480, 'U15', 'U06', 'U09', 'SAN MIGUEL DE ACOS', '1'),
(1481, 'U15', 'U06', 'U10', 'SANTA CRUZ DE ANDAMARCA', '1'),
(1482, 'U15', 'U06', 'U11', 'SUMBILCA', '1'),
(1483, 'U15', 'U06', 'U12', 'VEINTISIETE DE NOVIEMBRE', '1'),
(1484, 'U15', 'U07', 'U00', 'HUAROCHIRI', '1'),
(1485, 'U15', 'U07', 'U01', 'MATUCANA', '1'),
(1486, 'U15', 'U07', 'U02', 'ANTIOQUIA', '1'),
(1487, 'U15', 'U07', 'U03', 'CALLAHUANCA', '1'),
(1488, 'U15', 'U07', 'U04', 'CARAMPOMA', '1'),
(1489, 'U15', 'U07', 'U05', 'CHICLA', '1'),
(1490, 'U15', 'U07', 'U06', 'CUENCA', '1'),
(1491, 'U15', 'U07', 'U07', 'HUACHUPAMPA', '1'),
(1492, 'U15', 'U07', 'U08', 'HUANZA', '1'),
(1493, 'U15', 'U07', 'U09', 'HUAROCHIRI', '1'),
(1494, 'U15', 'U07', 'U10', 'LAHUAYTAMBO', '1'),
(1495, 'U15', 'U07', 'U11', 'LANGA', '1'),
(1496, 'U15', 'U07', 'U12', 'LARAOS', '1'),
(1497, 'U15', 'U07', 'U13', 'MARIATANA', '1'),
(1498, 'U15', 'U07', 'U14', 'RICARDO PALMA', '1'),
(1499, 'U15', 'U07', 'U15', 'SAN ANDRES DE TUPICOCHA', '1'),
(1500, 'U15', 'U07', 'U16', 'SAN ANTONIO', '1'),
(1501, 'U15', 'U07', 'U17', 'SAN BARTOLOME', '1'),
(1502, 'U15', 'U07', 'U18', 'SAN DAMIAN', '1'),
(1503, 'U15', 'U07', 'U19', 'SAN JUAN DE IRIS', '1'),
(1504, 'U15', 'U07', 'U20', 'SAN JUAN DE TANTARANCHE', '1'),
(1505, 'U15', 'U07', 'U21', 'SAN LORENZO DE QUINTI', '1'),
(1506, 'U15', 'U07', 'U22', 'SAN MATEO', '1'),
(1507, 'U15', 'U07', 'U23', 'SAN MATEO DE OTAO', '1'),
(1508, 'U15', 'U07', 'U24', 'SAN PEDRO DE CASTA', '1'),
(1509, 'U15', 'U07', 'U25', 'SAN PEDRO DE HUANCAYRE', '1'),
(1510, 'U15', 'U07', 'U26', 'SANGALLAYA', '1'),
(1511, 'U15', 'U07', 'U27', 'SANTA CRUZ DE COCACHACRA', '1'),
(1512, 'U15', 'U07', 'U28', 'SANTA EULALIA', '1'),
(1513, 'U15', 'U07', 'U29', 'SANTIAGO DE ANCHUCAYA', '1'),
(1514, 'U15', 'U07', 'U30', 'SANTIAGO DE TUNA', '1'),
(1515, 'U15', 'U07', 'U31', 'SANTO DOMINGO DE LOS OLLEROS', '1'),
(1516, 'U15', 'U07', 'U32', 'SURCO', '1'),
(1517, 'U15', 'U08', 'U00', 'HUAURA', '1'),
(1518, 'U15', 'U08', 'U01', 'HUACHO', '1'),
(1519, 'U15', 'U08', 'U02', 'AMBAR', '1'),
(1520, 'U15', 'U08', 'U03', 'CALETA DE CARQUIN', '1'),
(1521, 'U15', 'U08', 'U04', 'CHECRAS', '1'),
(1522, 'U15', 'U08', 'U05', 'HUALMAY', '1'),
(1523, 'U15', 'U08', 'U06', 'HUAURA', '1'),
(1524, 'U15', 'U08', 'U07', 'LEONCIO PRADO', '1'),
(1525, 'U15', 'U08', 'U08', 'PACCHO', '1'),
(1526, 'U15', 'U08', 'U09', 'SANTA LEONOR', '1'),
(1527, 'U15', 'U08', 'U10', 'SANTA MARIA', '1'),
(1528, 'U15', 'U08', 'U11', 'SAYAN', '1'),
(1529, 'U15', 'U08', 'U12', 'VEGUETA', '1'),
(1530, 'U15', 'U09', 'U00', 'OYON', '1'),
(1531, 'U15', 'U09', 'U01', 'OYON', '1'),
(1532, 'U15', 'U09', 'U02', 'ANDAJES', '1'),
(1533, 'U15', 'U09', 'U03', 'CAUJUL', '1'),
(1534, 'U15', 'U09', 'U04', 'COCHAMARCA', '1'),
(1535, 'U15', 'U09', 'U05', 'NAVAN', '1'),
(1536, 'U15', 'U09', 'U06', 'PACHANGARA', '1'),
(1537, 'U15', 'U10', 'U00', 'YAUYOS', '1'),
(1538, 'U15', 'U10', 'U01', 'YAUYOS', '1'),
(1539, 'U15', 'U10', 'U02', 'ALIS', '1'),
(1540, 'U15', 'U10', 'U03', 'AYAUCA', '1'),
(1541, 'U15', 'U10', 'U04', 'AYAVIRI', '1'),
(1542, 'U15', 'U10', 'U05', 'AZANGARO', '1'),
(1543, 'U15', 'U10', 'U06', 'CACRA', '1'),
(1544, 'U15', 'U10', 'U07', 'CARANIA', '1'),
(1545, 'U15', 'U10', 'U08', 'CATAHUASI', '1'),
(1546, 'U15', 'U10', 'U09', 'CHOCOS', '1'),
(1547, 'U15', 'U10', 'U10', 'COCHAS', '1'),
(1548, 'U15', 'U10', 'U11', 'COLONIA', '1'),
(1549, 'U15', 'U10', 'U12', 'HONGOS', '1'),
(1550, 'U15', 'U10', 'U13', 'HUAMPARA', '1'),
(1551, 'U15', 'U10', 'U14', 'HUANCAYA', '1'),
(1552, 'U15', 'U10', 'U15', 'HUANGASCAR', '1'),
(1553, 'U15', 'U10', 'U16', 'HUANTAN', '1'),
(1554, 'U15', 'U10', 'U17', 'HUAÑEC', '1'),
(1555, 'U15', 'U10', 'U18', 'LARAOS', '1'),
(1556, 'U15', 'U10', 'U19', 'LINCHA', '1'),
(1557, 'U15', 'U10', 'U20', 'MADEAN', '1'),
(1558, 'U15', 'U10', 'U21', 'MIRAFLORES', '1'),
(1559, 'U15', 'U10', 'U22', 'OMAS', '1'),
(1560, 'U15', 'U10', 'U23', 'PUTINZA', '1'),
(1561, 'U15', 'U10', 'U24', 'QUINCHES', '1'),
(1562, 'U15', 'U10', 'U25', 'QUINOCAY', '1'),
(1563, 'U15', 'U10', 'U26', 'SAN JOAQUIN', '1'),
(1564, 'U15', 'U10', 'U27', 'SAN PEDRO DE PILAS', '1'),
(1565, 'U15', 'U10', 'U28', 'TANTA', '1'),
(1566, 'U15', 'U10', 'U29', 'TAURIPAMPA', '1'),
(1567, 'U15', 'U10', 'U30', 'TOMAS', '1'),
(1568, 'U15', 'U10', 'U31', 'TUPE', '1'),
(1569, 'U15', 'U10', 'U32', 'VIÑAC', '1'),
(1570, 'U15', 'U10', 'U33', 'VITIS', '1'),
(1571, 'U16', 'U00', 'U00', 'LORETO', '1'),
(1572, 'U16', 'U01', 'U00', 'MAYNAS', '1'),
(1573, 'U16', 'U01', 'U01', 'IQUITOS', '1'),
(1574, 'U16', 'U01', 'U02', 'ALTO NANAY', '1'),
(1575, 'U16', 'U01', 'U03', 'FERNANDO LORES', '1'),
(1576, 'U16', 'U01', 'U04', 'INDIANA', '1'),
(1577, 'U16', 'U01', 'U05', 'LAS AMAZONAS', '1'),
(1578, 'U16', 'U01', 'U06', 'MAZAN', '1'),
(1579, 'U16', 'U01', 'U07', 'NAPO', '1'),
(1580, 'U16', 'U01', 'U08', 'PUNCHANA', '1'),
(1581, 'U16', 'U01', 'U09', 'PUTUMAYO', '1'),
(1582, 'U16', 'U01', 'U10', 'TORRES CAUSANA', '1'),
(1583, 'U16', 'U01', 'U12', 'BELEN', '1'),
(1584, 'U16', 'U01', 'U13', 'SAN JUAN BAUTISTA', '1'),
(1585, 'U16', 'U01', 'U14', 'TENIENTE MANUEL CLAVERO', '1'),
(1586, 'U16', 'U02', 'U00', 'ALTO AMAZONAS', '1'),
(1587, 'U16', 'U02', 'U01', 'YURIMAGUAS', '1'),
(1588, 'U16', 'U02', 'U02', 'BALSAPUERTO', '1'),
(1589, 'U16', 'U02', 'U05', 'JEBEROS', '1'),
(1590, 'U16', 'U02', 'U06', 'LAGUNAS', '1'),
(1591, 'U16', 'U02', 'U10', 'SANTA CRUZ', '1'),
(1592, 'U16', 'U02', 'U11', 'TENIENTE CESAR LOPEZ ROJAS', '1'),
(1593, 'U16', 'U03', 'U00', 'LORETO', '1'),
(1594, 'U16', 'U03', 'U01', 'NAUTA', '1'),
(1595, 'U16', 'U03', 'U02', 'PARINARI', '1'),
(1596, 'U16', 'U03', 'U03', 'TIGRE', '1'),
(1597, 'U16', 'U03', 'U04', 'TROMPETEROS', '1'),
(1598, 'U16', 'U03', 'U05', 'URARINAS', '1'),
(1599, 'U16', 'U04', 'U00', 'MARISCAL RAMON CASTILLA', '1'),
(1600, 'U16', 'U04', 'U01', 'RAMON CASTILLA', '1'),
(1601, 'U16', 'U04', 'U02', 'PEBAS', '1'),
(1602, 'U16', 'U04', 'U03', 'YAVARI', '1'),
(1603, 'U16', 'U04', 'U04', 'SAN PABLO', '1'),
(1604, 'U16', 'U05', 'U00', 'REQUENA', '1'),
(1605, 'U16', 'U05', 'U01', 'REQUENA', '1'),
(1606, 'U16', 'U05', 'U02', 'ALTO TAPICHE', '1'),
(1607, 'U16', 'U05', 'U03', 'CAPELO', '1'),
(1608, 'U16', 'U05', 'U04', 'EMILIO SAN MARTIN', '1'),
(1609, 'U16', 'U05', 'U05', 'MAQUIA', '1'),
(1610, 'U16', 'U05', 'U06', 'PUINAHUA', '1'),
(1611, 'U16', 'U05', 'U07', 'SAQUENA', '1'),
(1612, 'U16', 'U05', 'U08', 'SOPLIN', '1'),
(1613, 'U16', 'U05', 'U09', 'TAPICHE', '1'),
(1614, 'U16', 'U05', 'U10', 'JENARO HERRERA', '1'),
(1615, 'U16', 'U05', 'U11', 'YAQUERANA', '1'),
(1616, 'U16', 'U06', 'U00', 'UCAYALI', '1'),
(1617, 'U16', 'U06', 'U01', 'CONTAMANA', '1'),
(1618, 'U16', 'U06', 'U02', 'INAHUAYA', '1'),
(1619, 'U16', 'U06', 'U03', 'PADRE MARQUEZ', '1'),
(1620, 'U16', 'U06', 'U04', 'PAMPA HERMOSA', '1'),
(1621, 'U16', 'U06', 'U05', 'SARAYACU', '1'),
(1622, 'U16', 'U06', 'U06', 'VARGAS GUERRA', '1'),
(1623, 'U16', 'U07', 'U00', 'DATEM DEL MARAÑON', '1'),
(1624, 'U16', 'U07', 'U01', 'BARRANCA', '1'),
(1625, 'U16', 'U07', 'U02', 'CAHUAPANAS', '1'),
(1626, 'U16', 'U07', 'U03', 'MANSERICHE', '1'),
(1627, 'U16', 'U07', 'U04', 'MORONA', '1'),
(1628, 'U16', 'U07', 'U05', 'PASTAZA', '1'),
(1629, 'U16', 'U07', 'U06', 'ANDOAS', '1'),
(1630, 'U17', 'U00', 'U00', 'MADRE DE DIOS', '1'),
(1631, 'U17', 'U01', 'U00', 'TAMBOPATA', '1'),
(1632, 'U17', 'U01', 'U01', 'TAMBOPATA', '1'),
(1633, 'U17', 'U01', 'U02', 'INAMBARI', '1'),
(1634, 'U17', 'U01', 'U03', 'LAS PIEDRAS', '1'),
(1635, 'U17', 'U01', 'U04', 'LABERINTO', '1'),
(1636, 'U17', 'U02', 'U00', 'MANU', '1'),
(1637, 'U17', 'U02', 'U01', 'MANU', '1'),
(1638, 'U17', 'U02', 'U02', 'FITZCARRALD', '1'),
(1639, 'U17', 'U02', 'U03', 'MADRE DE DIOS', '1'),
(1640, 'U17', 'U02', 'U04', 'HUEPETUHE', '1'),
(1641, 'U17', 'U03', 'U00', 'TAHUAMANU', '1'),
(1642, 'U17', 'U03', 'U01', 'IÑAPARI', '1'),
(1643, 'U17', 'U03', 'U02', 'IBERIA', '1'),
(1644, 'U17', 'U03', 'U03', 'TAHUAMANU', '1'),
(1645, 'U18', 'U00', 'U00', 'MOQUEGUA', '1'),
(1646, 'U18', 'U01', 'U00', 'MARISCAL NIETO', '1'),
(1647, 'U18', 'U01', 'U01', 'MOQUEGUA', '1'),
(1648, 'U18', 'U01', 'U02', 'CARUMAS', '1'),
(1649, 'U18', 'U01', 'U03', 'CUCHUMBAYA', '1'),
(1650, 'U18', 'U01', 'U04', 'SAMEGUA', '1'),
(1651, 'U18', 'U01', 'U05', 'SAN CRISTOBAL', '1'),
(1652, 'U18', 'U01', 'U06', 'TORATA', '1'),
(1653, 'U18', 'U02', 'U00', 'GENERAL SANCHEZ CERRO', '1'),
(1654, 'U18', 'U02', 'U01', 'OMATE', '1'),
(1655, 'U18', 'U02', 'U02', 'CHOJATA', '1'),
(1656, 'U18', 'U02', 'U03', 'COALAQUE', '1'),
(1657, 'U18', 'U02', 'U04', 'ICHUÑA', '1'),
(1658, 'U18', 'U02', 'U05', 'LA CAPILLA', '1'),
(1659, 'U18', 'U02', 'U06', 'LLOQUE', '1'),
(1660, 'U18', 'U02', 'U07', 'MATALAQUE', '1'),
(1661, 'U18', 'U02', 'U08', 'PUQUINA', '1'),
(1662, 'U18', 'U02', 'U09', 'QUINISTAQUILLAS', '1'),
(1663, 'U18', 'U02', 'U10', 'UBINAS', '1'),
(1664, 'U18', 'U02', 'U11', 'YUNGA', '1'),
(1665, 'U18', 'U03', 'U00', 'ILO', '1'),
(1666, 'U18', 'U03', 'U01', 'ILO', '1'),
(1667, 'U18', 'U03', 'U02', 'EL ALGARROBAL', '1'),
(1668, 'U18', 'U03', 'U03', 'PACOCHA', '1'),
(1669, 'U19', 'U00', 'U00', 'PASCO', '1'),
(1670, 'U19', 'U01', 'U00', 'PASCO', '1'),
(1671, 'U19', 'U01', 'U01', 'CHAUPIMARCA', '1'),
(1672, 'U19', 'U01', 'U02', 'HUACHON', '1'),
(1673, 'U19', 'U01', 'U03', 'HUARIACA', '1'),
(1674, 'U19', 'U01', 'U04', 'HUAYLLAY', '1'),
(1675, 'U19', 'U01', 'U05', 'NINACACA', '1'),
(1676, 'U19', 'U01', 'U06', 'PALLANCHACRA', '1'),
(1677, 'U19', 'U01', 'U07', 'PAUCARTAMBO', '1'),
(1678, 'U19', 'U01', 'U08', 'SAN FRANCISCO DE ASIS DE YARUSYACAN', '1'),
(1679, 'U19', 'U01', 'U09', 'SIMON BOLIVAR', '1'),
(1680, 'U19', 'U01', 'U10', 'TICLACAYAN', '1'),
(1681, 'U19', 'U01', 'U11', 'TINYAHUARCO', '1'),
(1682, 'U19', 'U01', 'U12', 'VICCO', '1'),
(1683, 'U19', 'U01', 'U13', 'YANACANCHA', '1'),
(1684, 'U19', 'U02', 'U00', 'DANIEL ALCIDES CARRION', '1'),
(1685, 'U19', 'U02', 'U01', 'YANAHUANCA', '1'),
(1686, 'U19', 'U02', 'U02', 'CHACAYAN', '1'),
(1687, 'U19', 'U02', 'U03', 'GOYLLARISQUIZGA', '1'),
(1688, 'U19', 'U02', 'U04', 'PAUCAR', '1'),
(1689, 'U19', 'U02', 'U05', 'SAN PEDRO DE PILLAO', '1'),
(1690, 'U19', 'U02', 'U06', 'SANTA ANA DE TUSI', '1'),
(1691, 'U19', 'U02', 'U07', 'TAPUC', '1'),
(1692, 'U19', 'U02', 'U08', 'VILCABAMBA', '1'),
(1693, 'U19', 'U03', 'U00', 'OXAPAMPA', '1'),
(1694, 'U19', 'U03', 'U01', 'OXAPAMPA', '1'),
(1695, 'U19', 'U03', 'U02', 'CHONTABAMBA', '1'),
(1696, 'U19', 'U03', 'U03', 'HUANCABAMBA', '1'),
(1697, 'U19', 'U03', 'U04', 'PALCAZU', '1'),
(1698, 'U19', 'U03', 'U05', 'POZUZO', '1'),
(1699, 'U19', 'U03', 'U06', 'PUERTO BERMUDEZ', '1'),
(1700, 'U19', 'U03', 'U07', 'VILLA RICA', '1'),
(1701, 'U20', 'U00', 'U00', 'PIURA', '1'),
(1702, 'U20', 'U01', 'U00', 'PIURA', '1'),
(1703, 'U20', 'U01', 'U01', 'PIURA', '1'),
(1704, 'U20', 'U01', 'U04', 'CASTILLA', '1'),
(1705, 'U20', 'U01', 'U05', 'CATACAOS', '1'),
(1706, 'U20', 'U01', 'U07', 'CURA MORI', '1'),
(1707, 'U20', 'U01', 'U08', 'EL TALLAN', '1'),
(1708, 'U20', 'U01', 'U09', 'LA ARENA', '1'),
(1709, 'U20', 'U01', 'U10', 'LA UNION', '1'),
(1710, 'U20', 'U01', 'U11', 'LAS LOMAS', '1'),
(1711, 'U20', 'U01', 'U14', 'TAMBO GRANDE', '1'),
(1712, 'U20', 'U02', 'U00', 'AYABACA', '1'),
(1713, 'U20', 'U02', 'U01', 'AYABACA', '1'),
(1714, 'U20', 'U02', 'U02', 'FRIAS', '1'),
(1715, 'U20', 'U02', 'U03', 'JILILI', '1'),
(1716, 'U20', 'U02', 'U04', 'LAGUNAS', '1'),
(1717, 'U20', 'U02', 'U05', 'MONTERO', '1'),
(1718, 'U20', 'U02', 'U06', 'PACAIPAMPA', '1'),
(1719, 'U20', 'U02', 'U07', 'PAIMAS', '1'),
(1720, 'U20', 'U02', 'U08', 'SAPILLICA', '1'),
(1721, 'U20', 'U02', 'U09', 'SICCHEZ', '1'),
(1722, 'U20', 'U02', 'U10', 'SUYO', '1'),
(1723, 'U20', 'U03', 'U00', 'HUANCABAMBA', '1'),
(1724, 'U20', 'U03', 'U01', 'HUANCABAMBA', '1'),
(1725, 'U20', 'U03', 'U02', 'CANCHAQUE', '1'),
(1726, 'U20', 'U03', 'U03', 'EL CARMEN DE LA FRONTERA', '1'),
(1727, 'U20', 'U03', 'U04', 'HUARMACA', '1'),
(1728, 'U20', 'U03', 'U05', 'LALAQUIZ', '1'),
(1729, 'U20', 'U03', 'U06', 'SAN MIGUEL DE EL FAIQUE', '1'),
(1730, 'U20', 'U03', 'U07', 'SONDOR', '1'),
(1731, 'U20', 'U03', 'U08', 'SONDORILLO', '1'),
(1732, 'U20', 'U04', 'U00', 'MORROPON', '1'),
(1733, 'U20', 'U04', 'U01', 'CHULUCANAS', '1'),
(1734, 'U20', 'U04', 'U02', 'BUENOS AIRES', '1'),
(1735, 'U20', 'U04', 'U03', 'CHALACO', '1'),
(1736, 'U20', 'U04', 'U04', 'LA MATANZA', '1'),
(1737, 'U20', 'U04', 'U05', 'MORROPON', '1'),
(1738, 'U20', 'U04', 'U06', 'SALITRAL', '1'),
(1739, 'U20', 'U04', 'U07', 'SAN JUAN DE BIGOTE', '1'),
(1740, 'U20', 'U04', 'U08', 'SANTA CATALINA DE MOSSA', '1'),
(1741, 'U20', 'U04', 'U09', 'SANTO DOMINGO', '1'),
(1742, 'U20', 'U04', 'U10', 'YAMANGO', '1'),
(1743, 'U20', 'U05', 'U00', 'PAITA', '1'),
(1744, 'U20', 'U05', 'U01', 'PAITA', '1'),
(1745, 'U20', 'U05', 'U02', 'AMOTAPE', '1'),
(1746, 'U20', 'U05', 'U03', 'ARENAL', '1'),
(1747, 'U20', 'U05', 'U04', 'COLAN', '1'),
(1748, 'U20', 'U05', 'U05', 'LA HUACA', '1'),
(1749, 'U20', 'U05', 'U06', 'TAMARINDO', '1'),
(1750, 'U20', 'U05', 'U07', 'VICHAYAL', '1'),
(1751, 'U20', 'U06', 'U00', 'SULLANA', '1'),
(1752, 'U20', 'U06', 'U01', 'SULLANA', '1'),
(1753, 'U20', 'U06', 'U02', 'BELLAVISTA', '1'),
(1754, 'U20', 'U06', 'U03', 'IGNACIO ESCUDERO', '1'),
(1755, 'U20', 'U06', 'U04', 'LANCONES', '1'),
(1756, 'U20', 'U06', 'U05', 'MARCAVELICA', '1'),
(1757, 'U20', 'U06', 'U06', 'MIGUEL CHECA', '1'),
(1758, 'U20', 'U06', 'U07', 'QUERECOTILLO', '1'),
(1759, 'U20', 'U06', 'U08', 'SALITRAL', '1'),
(1760, 'U20', 'U07', 'U00', 'TALARA', '1'),
(1761, 'U20', 'U07', 'U01', 'PARIÑAS', '1'),
(1762, 'U20', 'U07', 'U02', 'EL ALTO', '1'),
(1763, 'U20', 'U07', 'U03', 'LA BREA', '1'),
(1764, 'U20', 'U07', 'U04', 'LOBITOS', '1'),
(1765, 'U20', 'U07', 'U05', 'LOS ORGANOS', '1'),
(1766, 'U20', 'U07', 'U06', 'MANCORA', '1'),
(1767, 'U20', 'U08', 'U00', 'SECHURA', '1'),
(1768, 'U20', 'U08', 'U01', 'SECHURA', '1'),
(1769, 'U20', 'U08', 'U02', 'BELLAVISTA DE LA UNION', '1'),
(1770, 'U20', 'U08', 'U03', 'BERNAL', '1'),
(1771, 'U20', 'U08', 'U04', 'CRISTO NOS VALGA', '1'),
(1772, 'U20', 'U08', 'U05', 'VICE', '1'),
(1773, 'U20', 'U08', 'U06', 'RINCONADA LLICUAR', '1'),
(1774, 'U21', 'U00', 'U00', 'PUNO', '1'),
(1775, 'U21', 'U01', 'U00', 'PUNO', '1'),
(1776, 'U21', 'U01', 'U01', 'PUNO', '1'),
(1777, 'U21', 'U01', 'U02', 'ACORA', '1'),
(1778, 'U21', 'U01', 'U03', 'AMANTANI', '1'),
(1779, 'U21', 'U01', 'U04', 'ATUNCOLLA', '1'),
(1780, 'U21', 'U01', 'U05', 'CAPACHICA', '1'),
(1781, 'U21', 'U01', 'U06', 'CHUCUITO', '1'),
(1782, 'U21', 'U01', 'U07', 'COATA', '1'),
(1783, 'U21', 'U01', 'U08', 'HUATA', '1'),
(1784, 'U21', 'U01', 'U09', 'MAÑAZO', '1'),
(1785, 'U21', 'U01', 'U10', 'PAUCARCOLLA', '1'),
(1786, 'U21', 'U01', 'U11', 'PICHACANI', '1'),
(1787, 'U21', 'U01', 'U12', 'PLATERIA', '1'),
(1788, 'U21', 'U01', 'U13', 'SAN ANTONIO', '1'),
(1789, 'U21', 'U01', 'U14', 'TIQUILLACA', '1'),
(1790, 'U21', 'U01', 'U15', 'VILQUE', '1'),
(1791, 'U21', 'U02', 'U00', 'AZANGARO', '1'),
(1792, 'U21', 'U02', 'U01', 'AZANGARO', '1'),
(1793, 'U21', 'U02', 'U02', 'ACHAYA', '1'),
(1794, 'U21', 'U02', 'U03', 'ARAPA', '1'),
(1795, 'U21', 'U02', 'U04', 'ASILLO', '1'),
(1796, 'U21', 'U02', 'U05', 'CAMINACA', '1'),
(1797, 'U21', 'U02', 'U06', 'CHUPA', '1'),
(1798, 'U21', 'U02', 'U07', 'JOSE DOMINGO CHOQUEHUANCA', '1'),
(1799, 'U21', 'U02', 'U08', 'MUÑANI', '1'),
(1800, 'U21', 'U02', 'U09', 'POTONI', '1'),
(1801, 'U21', 'U02', 'U10', 'SAMAN', '1'),
(1802, 'U21', 'U02', 'U11', 'SAN ANTON', '1'),
(1803, 'U21', 'U02', 'U12', 'SAN JOSE', '1'),
(1804, 'U21', 'U02', 'U13', 'SAN JUAN DE SALINAS', '1'),
(1805, 'U21', 'U02', 'U14', 'SANTIAGO DE PUPUJA', '1'),
(1806, 'U21', 'U02', 'U15', 'TIRAPATA', '1'),
(1807, 'U21', 'U03', 'U00', 'CARABAYA', '1'),
(1808, 'U21', 'U03', 'U01', 'MACUSANI', '1'),
(1809, 'U21', 'U03', 'U02', 'AJOYANI', '1'),
(1810, 'U21', 'U03', 'U03', 'AYAPATA', '1'),
(1811, 'U21', 'U03', 'U04', 'COASA', '1'),
(1812, 'U21', 'U03', 'U05', 'CORANI', '1'),
(1813, 'U21', 'U03', 'U06', 'CRUCERO', '1'),
(1814, 'U21', 'U03', 'U07', 'ITUATA', '1'),
(1815, 'U21', 'U03', 'U08', 'OLLACHEA', '1'),
(1816, 'U21', 'U03', 'U09', 'SAN GABAN', '1'),
(1817, 'U21', 'U03', 'U10', 'USICAYOS', '1'),
(1818, 'U21', 'U04', 'U00', 'CHUCUITO', '1'),
(1819, 'U21', 'U04', 'U01', 'JULI', '1'),
(1820, 'U21', 'U04', 'U02', 'DESAGUADERO', '1'),
(1821, 'U21', 'U04', 'U03', 'HUACULLANI', '1'),
(1822, 'U21', 'U04', 'U04', 'KELLUYO', '1'),
(1823, 'U21', 'U04', 'U05', 'PISACOMA', '1'),
(1824, 'U21', 'U04', 'U06', 'POMATA', '1'),
(1825, 'U21', 'U04', 'U07', 'ZEPITA', '1'),
(1826, 'U21', 'U05', 'U00', 'EL COLLAO', '1'),
(1827, 'U21', 'U05', 'U01', 'ILAVE', '1'),
(1828, 'U21', 'U05', 'U02', 'CAPAZO', '1'),
(1829, 'U21', 'U05', 'U03', 'PILCUYO', '1'),
(1830, 'U21', 'U05', 'U04', 'SANTA ROSA', '1'),
(1831, 'U21', 'U05', 'U05', 'CONDURIRI', '1'),
(1832, 'U21', 'U06', 'U00', 'HUANCANE', '1'),
(1833, 'U21', 'U06', 'U01', 'HUANCANE', '1'),
(1834, 'U21', 'U06', 'U02', 'COJATA', '1'),
(1835, 'U21', 'U06', 'U03', 'HUATASANI', '1'),
(1836, 'U21', 'U06', 'U04', 'INCHUPALLA', '1'),
(1837, 'U21', 'U06', 'U05', 'PUSI', '1'),
(1838, 'U21', 'U06', 'U06', 'ROSASPATA', '1'),
(1839, 'U21', 'U06', 'U07', 'TARACO', '1'),
(1840, 'U21', 'U06', 'U08', 'VILQUE CHICO', '1'),
(1841, 'U21', 'U07', 'U00', 'LAMPA', '1'),
(1842, 'U21', 'U07', 'U01', 'LAMPA', '1'),
(1843, 'U21', 'U07', 'U02', 'CABANILLA', '1'),
(1844, 'U21', 'U07', 'U03', 'CALAPUJA', '1'),
(1845, 'U21', 'U07', 'U04', 'NICASIO', '1'),
(1846, 'U21', 'U07', 'U05', 'OCUVIRI', '1'),
(1847, 'U21', 'U07', 'U06', 'PALCA', '1'),
(1848, 'U21', 'U07', 'U07', 'PARATIA', '1'),
(1849, 'U21', 'U07', 'U08', 'PUCARA', '1'),
(1850, 'U21', 'U07', 'U09', 'SANTA LUCIA', '1'),
(1851, 'U21', 'U07', 'U10', 'VILAVILA', '1'),
(1852, 'U21', 'U08', 'U00', 'MELGAR', '1'),
(1853, 'U21', 'U08', 'U01', 'AYAVIRI', '1'),
(1854, 'U21', 'U08', 'U02', 'ANTAUTA', '1'),
(1855, 'U21', 'U08', 'U03', 'CUPI', '1'),
(1856, 'U21', 'U08', 'U04', 'LLALLI', '1'),
(1857, 'U21', 'U08', 'U05', 'MACARI', '1'),
(1858, 'U21', 'U08', 'U06', 'NUÑOA', '1'),
(1859, 'U21', 'U08', 'U07', 'ORURILLO', '1'),
(1860, 'U21', 'U08', 'U08', 'SANTA ROSA', '1'),
(1861, 'U21', 'U08', 'U09', 'UMACHIRI', '1'),
(1862, 'U21', 'U09', 'U00', 'MOHO', '1'),
(1863, 'U21', 'U09', 'U01', 'MOHO', '1'),
(1864, 'U21', 'U09', 'U02', 'CONIMA', '1'),
(1865, 'U21', 'U09', 'U03', 'HUAYRAPATA', '1'),
(1866, 'U21', 'U09', 'U04', 'TILALI', '1'),
(1867, 'U21', 'U10', 'U00', 'SAN ANTONIO DE PUTINA', '1'),
(1868, 'U21', 'U10', 'U01', 'PUTINA', '1'),
(1869, 'U21', 'U10', 'U02', 'ANANEA', '1'),
(1870, 'U21', 'U10', 'U03', 'PEDRO VILCA APAZA', '1'),
(1871, 'U21', 'U10', 'U04', 'QUILCAPUNCU', '1'),
(1872, 'U21', 'U10', 'U05', 'SINA', '1'),
(1873, 'U21', 'U11', 'U00', 'SAN ROMAN', '1'),
(1874, 'U21', 'U11', 'U01', 'JULIACA', '1'),
(1875, 'U21', 'U11', 'U02', 'CABANA', '1'),
(1876, 'U21', 'U11', 'U03', 'CABANILLAS', '1'),
(1877, 'U21', 'U11', 'U04', 'CARACOTO', '1'),
(1878, 'U21', 'U12', 'U00', 'SANDIA', '1'),
(1879, 'U21', 'U12', 'U01', 'SANDIA', '1'),
(1880, 'U21', 'U12', 'U02', 'CUYOCUYO', '1'),
(1881, 'U21', 'U12', 'U03', 'LIMBANI', '1'),
(1882, 'U21', 'U12', 'U04', 'PATAMBUCO', '1'),
(1883, 'U21', 'U12', 'U05', 'PHARA', '1'),
(1884, 'U21', 'U12', 'U06', 'QUIACA', '1'),
(1885, 'U21', 'U12', 'U07', 'SAN JUAN DEL ORO', '1'),
(1886, 'U21', 'U12', 'U08', 'YANAHUAYA', '1'),
(1887, 'U21', 'U12', 'U09', 'ALTO INAMBARI', '1'),
(1888, 'U21', 'U12', 'U10', 'SAN PEDRO DE PUTINA PUNCO', '1'),
(1889, 'U21', 'U13', 'U00', 'YUNGUYO', '1'),
(1890, 'U21', 'U13', 'U01', 'YUNGUYO', '1'),
(1891, 'U21', 'U13', 'U02', 'ANAPIA', '1'),
(1892, 'U21', 'U13', 'U03', 'COPANI', '1'),
(1893, 'U21', 'U13', 'U04', 'CUTURAPI', '1'),
(1894, 'U21', 'U13', 'U05', 'OLLARAYA', '1'),
(1895, 'U21', 'U13', 'U06', 'TINICACHI', '1'),
(1896, 'U21', 'U13', 'U07', 'UNICACHI', '1'),
(1897, 'U22', 'U00', 'U00', 'SAN MARTIN', '1'),
(1898, 'U22', 'U01', 'U00', 'MOYOBAMBA', '1'),
(1899, 'U22', 'U01', 'U01', 'MOYOBAMBA', '1'),
(1900, 'U22', 'U01', 'U02', 'CALZADA', '1'),
(1901, 'U22', 'U01', 'U03', 'HABANA', '1'),
(1902, 'U22', 'U01', 'U04', 'JEPELACIO', '1'),
(1903, 'U22', 'U01', 'U05', 'SORITOR', '1'),
(1904, 'U22', 'U01', 'U06', 'YANTALO', '1'),
(1905, 'U22', 'U02', 'U00', 'BELLAVISTA', '1'),
(1906, 'U22', 'U02', 'U01', 'BELLAVISTA', '1'),
(1907, 'U22', 'U02', 'U02', 'ALTO BIAVO', '1'),
(1908, 'U22', 'U02', 'U03', 'BAJO BIAVO', '1'),
(1909, 'U22', 'U02', 'U04', 'HUALLAGA', '1'),
(1910, 'U22', 'U02', 'U05', 'SAN PABLO', '1'),
(1911, 'U22', 'U02', 'U06', 'SAN RAFAEL', '1'),
(1912, 'U22', 'U03', 'U00', 'EL DORADO', '1'),
(1913, 'U22', 'U03', 'U01', 'SAN JOSE DE SISA', '1'),
(1914, 'U22', 'U03', 'U02', 'AGUA BLANCA', '1'),
(1915, 'U22', 'U03', 'U03', 'SAN MARTIN', '1'),
(1916, 'U22', 'U03', 'U04', 'SANTA ROSA', '1'),
(1917, 'U22', 'U03', 'U05', 'SHATOJA', '1'),
(1918, 'U22', 'U04', 'U00', 'HUALLAGA', '1'),
(1919, 'U22', 'U04', 'U01', 'SAPOSOA', '1'),
(1920, 'U22', 'U04', 'U02', 'ALTO SAPOSOA', '1'),
(1921, 'U22', 'U04', 'U03', 'EL ESLABON', '1'),
(1922, 'U22', 'U04', 'U04', 'PISCOYACU', '1'),
(1923, 'U22', 'U04', 'U05', 'SACANCHE', '1'),
(1924, 'U22', 'U04', 'U06', 'TINGO DE SAPOSOA', '1'),
(1925, 'U22', 'U05', 'U00', 'LAMAS', '1'),
(1926, 'U22', 'U05', 'U01', 'LAMAS', '1'),
(1927, 'U22', 'U05', 'U02', 'ALONSO DE ALVARADO', '1'),
(1928, 'U22', 'U05', 'U03', 'BARRANQUITA', '1'),
(1929, 'U22', 'U05', 'U04', 'CAYNARACHI', '1'),
(1930, 'U22', 'U05', 'U05', 'CUÑUMBUQUI', '1'),
(1931, 'U22', 'U05', 'U06', 'PINTO RECODO', '1'),
(1932, 'U22', 'U05', 'U07', 'RUMISAPA', '1'),
(1933, 'U22', 'U05', 'U08', 'SAN ROQUE DE CUMBAZA', '1'),
(1934, 'U22', 'U05', 'U09', 'SHANAO', '1'),
(1935, 'U22', 'U05', 'U10', 'TABALOSOS', '1'),
(1936, 'U22', 'U05', 'U11', 'ZAPATERO', '1'),
(1937, 'U22', 'U06', 'U00', 'MARISCAL CACERES', '1'),
(1938, 'U22', 'U06', 'U01', 'JUANJUI', '1'),
(1939, 'U22', 'U06', 'U02', 'CAMPANILLA', '1'),
(1940, 'U22', 'U06', 'U03', 'HUICUNGO', '1'),
(1941, 'U22', 'U06', 'U04', 'PACHIZA', '1'),
(1942, 'U22', 'U06', 'U05', 'PAJARILLO', '1'),
(1943, 'U22', 'U07', 'U00', 'PICOTA', '1'),
(1944, 'U22', 'U07', 'U01', 'PICOTA', '1'),
(1945, 'U22', 'U07', 'U02', 'BUENOS AIRES', '1'),
(1946, 'U22', 'U07', 'U03', 'CASPISAPA', '1'),
(1947, 'U22', 'U07', 'U04', 'PILLUANA', '1'),
(1948, 'U22', 'U07', 'U05', 'PUCACACA', '1'),
(1949, 'U22', 'U07', 'U06', 'SAN CRISTOBAL', '1'),
(1950, 'U22', 'U07', 'U07', 'SAN HILARION', '1'),
(1951, 'U22', 'U07', 'U08', 'SHAMBOYACU', '1'),
(1952, 'U22', 'U07', 'U09', 'TINGO DE PONASA', '1'),
(1953, 'U22', 'U07', 'U10', 'TRES UNIDOS', '1'),
(1954, 'U22', 'U08', 'U00', 'RIOJA', '1'),
(1955, 'U22', 'U08', 'U01', 'RIOJA', '1'),
(1956, 'U22', 'U08', 'U02', 'AWAJUN', '1'),
(1957, 'U22', 'U08', 'U03', 'ELIAS SOPLIN VARGAS', '1'),
(1958, 'U22', 'U08', 'U04', 'NUEVA CAJAMARCA', '1'),
(1959, 'U22', 'U08', 'U05', 'PARDO MIGUEL', '1'),
(1960, 'U22', 'U08', 'U06', 'POSIC', '1'),
(1961, 'U22', 'U08', 'U07', 'SAN FERNANDO', '1'),
(1962, 'U22', 'U08', 'U08', 'YORONGOS', '1'),
(1963, 'U22', 'U08', 'U09', 'YURACYACU', '1'),
(1964, 'U22', 'U09', 'U00', 'SAN MARTIN', '1'),
(1965, 'U22', 'U09', 'U01', 'TARAPOTO', '1'),
(1966, 'U22', 'U09', 'U02', 'ALBERTO LEVEAU', '1'),
(1967, 'U22', 'U09', 'U03', 'CACATACHI', '1'),
(1968, 'U22', 'U09', 'U04', 'CHAZUTA', '1'),
(1969, 'U22', 'U09', 'U05', 'CHIPURANA', '1'),
(1970, 'U22', 'U09', 'U06', 'EL PORVENIR', '1'),
(1971, 'U22', 'U09', 'U07', 'HUIMBAYOC', '1'),
(1972, 'U22', 'U09', 'U08', 'JUAN GUERRA', '1'),
(1973, 'U22', 'U09', 'U09', 'LA BANDA DE SHILCAYO', '1'),
(1974, 'U22', 'U09', 'U10', 'MORALES', '1'),
(1975, 'U22', 'U09', 'U11', 'PAPAPLAYA', '1'),
(1976, 'U22', 'U09', 'U12', 'SAN ANTONIO', '1'),
(1977, 'U22', 'U09', 'U13', 'SAUCE', '1'),
(1978, 'U22', 'U09', 'U14', 'SHAPAJA', '1'),
(1979, 'U22', 'U10', 'U00', 'TOCACHE', '1'),
(1980, 'U22', 'U10', 'U01', 'TOCACHE', '1'),
(1981, 'U22', 'U10', 'U02', 'NUEVO PROGRESO', '1'),
(1982, 'U22', 'U10', 'U03', 'POLVORA', '1'),
(1983, 'U22', 'U10', 'U04', 'SHUNTE', '1'),
(1984, 'U22', 'U10', 'U05', 'UCHIZA', '1'),
(1985, 'U23', 'U00', 'U00', 'TACNA', '1'),
(1986, 'U23', 'U01', 'U00', 'TACNA', '1'),
(1987, 'U23', 'U01', 'U01', 'TACNA', '1'),
(1988, 'U23', 'U01', 'U02', 'ALTO DE LA ALIANZA', '1'),
(1989, 'U23', 'U01', 'U03', 'CALANA', '1'),
(1990, 'U23', 'U01', 'U04', 'CIUDAD NUEVA', '1'),
(1991, 'U23', 'U01', 'U05', 'INCLAN', '1'),
(1992, 'U23', 'U01', 'U06', 'PACHIA', '1'),
(1993, 'U23', 'U01', 'U07', 'PALCA', '1'),
(1994, 'U23', 'U01', 'U08', 'POCOLLAY', '1'),
(1995, 'U23', 'U01', 'U09', 'SAMA', '1'),
(1996, 'U23', 'U01', 'U10', 'CORONEL GREGORIO ALBARRACIN LANCHIPA', '1'),
(1997, 'U23', 'U02', 'U00', 'CANDARAVE', '1'),
(1998, 'U23', 'U02', 'U01', 'CANDARAVE', '1'),
(1999, 'U23', 'U02', 'U02', 'CAIRANI', '1'),
(2000, 'U23', 'U02', 'U03', 'CAMILACA', '1'),
(2001, 'U23', 'U02', 'U04', 'CURIBAYA', '1'),
(2002, 'U23', 'U02', 'U05', 'HUANUARA', '1'),
(2003, 'U23', 'U02', 'U06', 'QUILAHUANI', '1'),
(2004, 'U23', 'U03', 'U00', 'JORGE BASADRE', '1'),
(2005, 'U23', 'U03', 'U01', 'LOCUMBA', '1'),
(2006, 'U23', 'U03', 'U02', 'ILABAYA', '1'),
(2007, 'U23', 'U03', 'U03', 'ITE', '1'),
(2008, 'U23', 'U04', 'U00', 'TARATA', '1'),
(2009, 'U23', 'U04', 'U01', 'TARATA', '1'),
(2010, 'U23', 'U04', 'U02', 'HEROES ALBARRACIN', '1'),
(2011, 'U23', 'U04', 'U03', 'ESTIQUE', '1'),
(2012, 'U23', 'U04', 'U04', 'ESTIQUE-PAMPA', '1'),
(2013, 'U23', 'U04', 'U05', 'SITAJARA', '1'),
(2014, 'U23', 'U04', 'U06', 'SUSAPAYA', '1'),
(2015, 'U23', 'U04', 'U07', 'TARUCACHI', '1'),
(2016, 'U23', 'U04', 'U08', 'TICACO', '1'),
(2017, 'U24', 'U00', 'U00', 'TUMBES', '1'),
(2018, 'U24', 'U01', 'U00', 'TUMBES', '1'),
(2019, 'U24', 'U01', 'U01', 'TUMBES', '1'),
(2020, 'U24', 'U01', 'U02', 'CORRALES', '1'),
(2021, 'U24', 'U01', 'U03', 'LA CRUZ', '1'),
(2022, 'U24', 'U01', 'U04', 'PAMPAS DE HOSPITAL', '1'),
(2023, 'U24', 'U01', 'U05', 'SAN JACINTO', '1'),
(2024, 'U24', 'U01', 'U06', 'SAN JUAN DE LA VIRGEN', '1'),
(2025, 'U24', 'U02', 'U00', 'CONTRALMIRANTE VILLAR', '1'),
(2026, 'U24', 'U02', 'U01', 'ZORRITOS', '1'),
(2027, 'U24', 'U02', 'U02', 'CASITAS', '1'),
(2028, 'U24', 'U02', 'U03', 'CANOAS DE PUNTA SAL', '1'),
(2029, 'U24', 'U03', 'U00', 'ZARUMILLA', '1'),
(2030, 'U24', 'U03', 'U01', 'ZARUMILLA', '1'),
(2031, 'U24', 'U03', 'U02', 'AGUAS VERDES', '1'),
(2032, 'U24', 'U03', 'U03', 'MATAPALO', '1'),
(2033, 'U24', 'U03', 'U04', 'PAPAYAL', '1'),
(2034, 'U25', 'U00', 'U00', 'UCAYALI', '1'),
(2035, 'U25', 'U01', 'U00', 'CORONEL PORTILLO', '1'),
(2036, 'U25', 'U01', 'U01', 'CALLERIA', '1'),
(2037, 'U25', 'U01', 'U02', 'CAMPOVERDE', '1'),
(2038, 'U25', 'U01', 'U03', 'IPARIA', '1'),
(2039, 'U25', 'U01', 'U04', 'MASISEA', '1'),
(2040, 'U25', 'U01', 'U05', 'YARINACOCHA', '1'),
(2041, 'U25', 'U01', 'U06', 'NUEVA REQUENA', '1'),
(2042, 'U25', 'U02', 'U00', 'ATALAYA', '1'),
(2043, 'U25', 'U02', 'U01', 'RAYMONDI', '1'),
(2044, 'U25', 'U02', 'U02', 'SEPAHUA', '1'),
(2045, 'U25', 'U02', 'U03', 'TAHUANIA', '1'),
(2046, 'U25', 'U02', 'U04', 'YURUA', '1'),
(2047, 'U25', 'U03', 'U00', 'PADRE ABAD', '1'),
(2048, 'U25', 'U03', 'U01', 'PADRE ABAD', '1'),
(2049, 'U25', 'U03', 'U02', 'IRAZOLA', '1'),
(2050, 'U25', 'U03', 'U03', 'CURIMANA', '1'),
(2051, 'U25', 'U04', 'U00', 'PURUS', '1'),
(2052, 'U25', 'U04', 'U01', 'PURUS', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_unidadmedida`
--

CREATE TABLE IF NOT EXISTS `tbl_unidadmedida` (
  `ID_UNIDMED` int(11) NOT NULL AUTO_INCREMENT,
  `UnidadMedida` varchar(100) DEFAULT NULL,
  `Abreviatura` varchar(20) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_UNIDMED`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbl_unidadmedida`
--

INSERT INTO `tbl_unidadmedida` (`ID_UNIDMED`, `UnidadMedida`, `Abreviatura`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(1, 'UNIDAD', 'UNI', '1', 1, '2011-06-04 00:00:00', NULL, NULL),
(2, 'KILOGRAMO', 'Kg', '1', 1, '2011-06-04 00:00:00', NULL, NULL),
(3, 'CAJA', 'CAJA', '1', 1, '2011-06-04 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario` (
  `ID_USUARIO` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(12) NOT NULL,
  `PWD` varchar(100) NOT NULL,
  `Nombres` varchar(100) NOT NULL,
  `Ape_Paterno` varchar(100) NOT NULL,
  `Ape_Materno` varchar(50) NOT NULL,
  `Sexo` char(1) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Telefono` varchar(9) NOT NULL,
  `Activo` char(1) NOT NULL DEFAULT '1',
  `User_Creacion` int(11) NOT NULL DEFAULT '0',
  `Fec_Creacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `User_Modificacion` int(11) NOT NULL DEFAULT '0',
  `Fec_Modificacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ID_EMPRESA` int(11) NOT NULL DEFAULT '0',
  `ID_PERFIL` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_USUARIO`),
  KEY `FK_EMP_USR` (`ID_EMPRESA`),
  KEY `FK_PERF_USER` (`ID_PERFIL`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Registro de Usuarios' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`ID_USUARIO`, `Usuario`, `PWD`, `Nombres`, `Ape_Paterno`, `Ape_Materno`, `Sexo`, `Email`, `Telefono`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`, `ID_EMPRESA`, `ID_PERFIL`) VALUES
(1, 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'José Luis', 'Pérez', 'Zárate', 'M', 'jolupeza@outlook.com', '993301435', '1', 1, '2011-05-30 00:00:00', 1, '2011-06-03 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_vendedor`
--

CREATE TABLE IF NOT EXISTS `tbl_vendedor` (
  `ID_VENDEDOR` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  `ID_TIPODOCUMENTO` int(11) DEFAULT NULL,
  `NroDocumento` varchar(20) DEFAULT NULL,
  `Nombres` varchar(100) DEFAULT NULL,
  `ApePaterno` varchar(50) DEFAULT NULL,
  `ApeMaterno` varchar(50) DEFAULT NULL,
  `CodDpto` char(3) DEFAULT NULL,
  `CodProv` char(3) DEFAULT NULL,
  `CodDist` char(3) DEFAULT NULL,
  `Direccion` varchar(200) DEFAULT NULL,
  `Telefono` varchar(7) DEFAULT NULL,
  `Celular` varchar(9) DEFAULT NULL,
  `ID_SUCURSAL` int(11) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_VENDEDOR`),
  KEY `FK_VENDEDOR_EMP` (`ID_EMPRESA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_vendedor`
--

INSERT INTO `tbl_vendedor` (`ID_VENDEDOR`, `ID_EMPRESA`, `ID_TIPODOCUMENTO`, `NroDocumento`, `Nombres`, `ApePaterno`, `ApeMaterno`, `CodDpto`, `CodProv`, `CodDist`, `Direccion`, `Telefono`, `Celular`, `ID_SUCURSAL`, `Activo`, `User_Creacion`, `Fec_Creacion`, `User_Modificacion`, `Fec_Modificacion`) VALUES
(1, 1, 1, '45531721', 'VENDEDOR ONE', 'SMP', 'MEGAPLAZA', '15', '15', '01', 'Av. Reynaldo Saavedra Pinon 2693', '4849315', '996189053', 1, '1', 1, '2011-06-18 14:34:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_venta_cab`
--

CREATE TABLE IF NOT EXISTS `tbl_venta_cab` (
  `ID_VENTACAB` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPRESA` int(11) DEFAULT NULL,
  `ID_PEDIDOCAB` int(11) DEFAULT NULL,
  `ID_TIPOCOMPROBANTE` int(11) DEFAULT NULL,
  `Serie` varchar(5) DEFAULT NULL,
  `Correlativo` varchar(10) DEFAULT NULL,
  `Fec_Emision` datetime DEFAULT NULL,
  `ID_CLIENTE` varchar(255) DEFAULT NULL,
  `ID_VENDEDOR` int(11) DEFAULT NULL,
  `ID_MONEDA` int(11) DEFAULT NULL,
  `TipoCambio` decimal(3,2) DEFAULT NULL,
  `ID_TRANSPORTISTA` int(11) DEFAULT NULL,
  `ID_FORMAPAGO` varchar(255) DEFAULT NULL,
  `PlazoDias` int(11) DEFAULT NULL,
  `Fec_Vencimiento` datetime DEFAULT NULL,
  `SubTotal` decimal(15,2) DEFAULT NULL,
  `IGV` decimal(4,2) DEFAULT NULL,
  `IGVMonto` decimal(15,2) DEFAULT NULL,
  `Total` decimal(15,2) DEFAULT NULL,
  `Descuento` decimal(5,2) DEFAULT NULL,
  `DescuentoMonto` decimal(15,2) DEFAULT NULL,
  `TotalConDescuento` decimal(15,2) DEFAULT NULL,
  `Estado` varchar(4) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_VENTACAB`),
  KEY `FK_VENTA_EMP` (`ID_EMPRESA`),
  KEY `FK_VENTA_PED` (`ID_PEDIDOCAB`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_venta_det`
--

CREATE TABLE IF NOT EXISTS `tbl_venta_det` (
  `ID_VENTADET` int(11) NOT NULL AUTO_INCREMENT,
  `ID_VENTACAB` int(11) DEFAULT NULL,
  `ID_PRODUCTO` int(11) DEFAULT NULL,
  `ID_TIPOPRECIO` int(11) DEFAULT NULL,
  `Cantidad` decimal(6,2) DEFAULT NULL,
  `PrecioUnitario` decimal(15,2) DEFAULT NULL,
  `Total` decimal(15,2) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL,
  `User_Creacion` int(11) DEFAULT NULL,
  `Fec_Creacion` datetime DEFAULT NULL,
  `User_Modificacion` int(11) DEFAULT NULL,
  `Fec_Modificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_VENTADET`),
  KEY `FK_VENTADET_PRO` (`ID_PRODUCTO`),
  KEY `FK_VTA_DET_CABE` (`ID_VENTACAB`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_accion`
--
ALTER TABLE `tbl_accion`
  ADD CONSTRAINT `FK_OPC_ACCION` FOREIGN KEY (`ID_OPCION`) REFERENCES `tbl_opciones` (`ID_OPCION`);

--
-- Filtros para la tabla `tbl_claseprod`
--
ALTER TABLE `tbl_claseprod`
  ADD CONSTRAINT `FK_CLA_EMP` FOREIGN KEY (`ID_EMPRESA`) REFERENCES `tbl_empresa` (`ID_EMPRESA`),
  ADD CONSTRAINT `FK_CLA_GRP` FOREIGN KEY (`ID_GRUPOPROD`) REFERENCES `tbl_grupoprod` (`ID_GRUPOPROD`);

--
-- Filtros para la tabla `tbl_clientes`
--
ALTER TABLE `tbl_clientes`
  ADD CONSTRAINT `FK_CLIE_EMP` FOREIGN KEY (`ID_EMPRESA`) REFERENCES `tbl_empresa` (`ID_EMPRESA`);

--
-- Filtros para la tabla `tbl_cotizacion_det`
--
ALTER TABLE `tbl_cotizacion_det`
  ADD CONSTRAINT `FK_COTI_DET_CABE` FOREIGN KEY (`ID_COTIZACIONCAB`) REFERENCES `tbl_cotizacion_cab` (`ID_COTIZACIONCAB`);

--
-- Filtros para la tabla `tbl_empresa`
--
ALTER TABLE `tbl_empresa`
  ADD CONSTRAINT `FK_ACTCOMER_EMP` FOREIGN KEY (`ID_ACTIVIDADCOMERCIAL`) REFERENCES `tbl_actividadcomercial` (`ID_ACTIVIDADCOMERCIAL`),
  ADD CONSTRAINT `FK_TIPOEMP_EMP` FOREIGN KEY (`ID_TIPOEMPRESA`) REFERENCES `tbl_tipoempresa` (`ID_TIPOEMPRESA`);

--
-- Filtros para la tabla `tbl_familiaprod`
--
ALTER TABLE `tbl_familiaprod`
  ADD CONSTRAINT `FK_FAM_CLA` FOREIGN KEY (`ID_CLASEPROD`) REFERENCES `tbl_claseprod` (`ID_CLASEPROD`),
  ADD CONSTRAINT `FK_FAM_EMP` FOREIGN KEY (`ID_EMPRESA`) REFERENCES `tbl_empresa` (`ID_EMPRESA`),
  ADD CONSTRAINT `FK_FAM_GRP` FOREIGN KEY (`ID_GRUPOPROD`) REFERENCES `tbl_grupoprod` (`ID_GRUPOPROD`);

--
-- Filtros para la tabla `tbl_formapago`
--
ALTER TABLE `tbl_formapago`
  ADD CONSTRAINT `FK_FORPAGO_EMP` FOREIGN KEY (`ID_EMPRESA`) REFERENCES `tbl_empresa` (`ID_EMPRESA`);

--
-- Filtros para la tabla `tbl_grupoprod`
--
ALTER TABLE `tbl_grupoprod`
  ADD CONSTRAINT `FK_GRP_EMP` FOREIGN KEY (`ID_EMPRESA`) REFERENCES `tbl_empresa` (`ID_EMPRESA`);

--
-- Filtros para la tabla `tbl_moneda`
--
ALTER TABLE `tbl_moneda`
  ADD CONSTRAINT `FK_MON_EMP` FOREIGN KEY (`ID_EMPRESA`) REFERENCES `tbl_empresa` (`ID_EMPRESA`);

--
-- Filtros para la tabla `tbl_opciones`
--
ALTER TABLE `tbl_opciones`
  ADD CONSTRAINT `FK_MOD_OPC` FOREIGN KEY (`ID_MODULO`) REFERENCES `tbl_modulos` (`ID_MODULO`);

--
-- Filtros para la tabla `tbl_parametro_gen`
--
ALTER TABLE `tbl_parametro_gen`
  ADD CONSTRAINT `FK_PARAM_EMP` FOREIGN KEY (`ID_EMPRESA`) REFERENCES `tbl_empresa` (`ID_EMPRESA`);

--
-- Filtros para la tabla `tbl_pedido_cab`
--
ALTER TABLE `tbl_pedido_cab`
  ADD CONSTRAINT `FK_COTI_PEDIDO` FOREIGN KEY (`ID_COTIZACIONCAB`) REFERENCES `tbl_cotizacion_cab` (`ID_COTIZACIONCAB`);

--
-- Filtros para la tabla `tbl_perfil`
--
ALTER TABLE `tbl_perfil`
  ADD CONSTRAINT `FK_EMP_PERF` FOREIGN KEY (`ID_EMPRESA`) REFERENCES `tbl_empresa` (`ID_EMPRESA`);

--
-- Filtros para la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD CONSTRAINT `FK_PRO_CLA` FOREIGN KEY (`ID_CLASEPROD`) REFERENCES `tbl_claseprod` (`ID_CLASEPROD`),
  ADD CONSTRAINT `FK_PRO_FAM` FOREIGN KEY (`ID_FAMPROD`) REFERENCES `tbl_familiaprod` (`ID_FAMILIAPROD`),
  ADD CONSTRAINT `FK_PRO_GRP` FOREIGN KEY (`ID_GRUPOPROD`) REFERENCES `tbl_grupoprod` (`ID_GRUPOPROD`),
  ADD CONSTRAINT `FK_PRO_TIPOPRO` FOREIGN KEY (`ID_TIPOPRODUCTO`) REFERENCES `tbl_tipoproducto` (`ID_TIPOPRODUCTO`),
  ADD CONSTRAINT `FK_PRO_UNIDMED` FOREIGN KEY (`ID_UNIDMED`) REFERENCES `tbl_unidadmedida` (`ID_UNIDMED`);

--
-- Filtros para la tabla `tbl_proveedor`
--
ALTER TABLE `tbl_proveedor`
  ADD CONSTRAINT `FK_PRO_EMP` FOREIGN KEY (`ID_EMPRESA`) REFERENCES `tbl_empresa` (`ID_EMPRESA`);

--
-- Filtros para la tabla `tbl_rel_perf_accion`
--
ALTER TABLE `tbl_rel_perf_accion`
  ADD CONSTRAINT `FK_REL_ACC` FOREIGN KEY (`ID_ACCION`) REFERENCES `tbl_accion` (`ID_ACCION`),
  ADD CONSTRAINT `FK_REL_PRF` FOREIGN KEY (`ID_PERFIL`) REFERENCES `tbl_perfil` (`ID_PERFIL`);

--
-- Filtros para la tabla `tbl_sucursal`
--
ALTER TABLE `tbl_sucursal`
  ADD CONSTRAINT `FK_SUCURSAL_EMP` FOREIGN KEY (`ID_EMPRESA`) REFERENCES `tbl_empresa` (`ID_EMPRESA`);

--
-- Filtros para la tabla `tbl_transportistas`
--
ALTER TABLE `tbl_transportistas`
  ADD CONSTRAINT `FK_TRANS_EMP` FOREIGN KEY (`ID_EMPRESA`) REFERENCES `tbl_empresa` (`ID_EMPRESA`);

--
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `FK_USR_EMP` FOREIGN KEY (`ID_EMPRESA`) REFERENCES `tbl_empresa` (`ID_EMPRESA`),
  ADD CONSTRAINT `FK_USR_PRF` FOREIGN KEY (`ID_PERFIL`) REFERENCES `tbl_perfil` (`ID_PERFIL`);

--
-- Filtros para la tabla `tbl_vendedor`
--
ALTER TABLE `tbl_vendedor`
  ADD CONSTRAINT `FK_VENDEDOR_EMP` FOREIGN KEY (`ID_EMPRESA`) REFERENCES `tbl_empresa` (`ID_EMPRESA`);

--
-- Filtros para la tabla `tbl_venta_cab`
--
ALTER TABLE `tbl_venta_cab`
  ADD CONSTRAINT `FK_VENTA_EMP` FOREIGN KEY (`ID_EMPRESA`) REFERENCES `tbl_empresa` (`ID_EMPRESA`),
  ADD CONSTRAINT `FK_VENTA_PED` FOREIGN KEY (`ID_PEDIDOCAB`) REFERENCES `tbl_pedido_cab` (`ID_PEDIDOCAB`);

--
-- Filtros para la tabla `tbl_venta_det`
--
ALTER TABLE `tbl_venta_det`
  ADD CONSTRAINT `FK_VENTADET_PRO` FOREIGN KEY (`ID_PRODUCTO`) REFERENCES `tbl_producto` (`ID_PRODUCTO`),
  ADD CONSTRAINT `FK_VTA_DET_CABE` FOREIGN KEY (`ID_VENTACAB`) REFERENCES `tbl_venta_cab` (`ID_VENTACAB`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
