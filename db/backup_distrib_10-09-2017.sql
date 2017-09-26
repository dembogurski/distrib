/*
SQLyog Ultimate v11.11 (32 bit)
MySQL - 5.1.33-community : Database - distrib
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `__autonum__` */

DROP TABLE IF EXISTS `__autonum__`;

CREATE TABLE `__autonum__` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `value` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Table structure for table `ajustes` */

DROP TABLE IF EXISTS `ajustes`;

CREATE TABLE `ajustes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aj_prod` int(11) DEFAULT NULL,
  `aj_fecha` date DEFAULT NULL,
  `aj_usuario` varchar(60) DEFAULT NULL,
  `aj_inicial` double(10,2) DEFAULT NULL,
  `aj_oper` varchar(50) DEFAULT NULL,
  `aj_ajuste` double(10,2) DEFAULT NULL,
  `aj_final` double(10,2) DEFAULT NULL,
  `aj_signo` varchar(4) DEFAULT NULL,
  `aj_motivo` varchar(150) DEFAULT NULL,
  `aj_hora` varchar(60) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `amortizaciones` */

DROP TABLE IF EXISTS `amortizaciones`;

CREATE TABLE `amortizaciones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `a_fact` int(11) DEFAULT NULL,
  `a_cuota` int(11) DEFAULT NULL,
  `a_fecha` date DEFAULT NULL,
  `a_comp` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `a_concepto` int(11) DEFAULT NULL,
  `a_compl` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `a_saldo_ant` double(16,2) DEFAULT NULL,
  `a_monto` double(16,2) DEFAULT NULL,
  `a_saldo` double(16,2) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `articulos` */

DROP TABLE IF EXISTS `articulos`;

CREATE TABLE `articulos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) DEFAULT NULL,
  `p_sector` varchar(60) DEFAULT NULL,
  `p_grupo` varchar(60) DEFAULT NULL,
  `p_tipo` varchar(60) DEFAULT NULL,
  `p_descrip` varchar(64) DEFAULT NULL,
  `p_barcode` varchar(30) DEFAULT NULL,
  `p_costo_prom` double(16,2) DEFAULT NULL,
  `p_um` varchar(60) DEFAULT NULL,
  `p_valmin` double(16,2) DEFAULT NULL,
  `p_estado` varchar(12) DEFAULT NULL,
  `p_stock` double(12,2) DEFAULT NULL,
  `p_imp` varchar(60) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `codigo` (`codigo`),
  UNIQUE KEY `p_descrip` (`p_descrip`)
) ENGINE=InnoDB AUTO_INCREMENT=1068 DEFAULT CHARSET=latin1;

/*Table structure for table `bcos` */

DROP TABLE IF EXISTS `bcos`;

CREATE TABLE `bcos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `b_cod` varchar(10) DEFAULT NULL,
  `b_nombre` varchar(60) DEFAULT NULL,
  `b_direccion` varchar(60) DEFAULT NULL,
  `b_tel` varchar(20) DEFAULT NULL,
  `b_contacto` varchar(60) DEFAULT NULL,
  `b_mail` varchar(40) DEFAULT NULL,
  `b_web` varchar(40) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Table structure for table `bcos_cheq_ter` */

DROP TABLE IF EXISTS `bcos_cheq_ter`;

CREATE TABLE `bcos_cheq_ter` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `chq_ref` varchar(60) DEFAULT NULL,
  `chq_bco` varchar(4) DEFAULT NULL,
  `chq_cta` varchar(20) DEFAULT NULL,
  `chq_num` varchar(60) DEFAULT NULL,
  `chq_benef` varchar(60) DEFAULT NULL,
  `chq_fecha_emis` date DEFAULT NULL,
  `chq_fecha_pag` date DEFAULT NULL,
  `chq_valor` double(15,2) DEFAULT NULL,
  `chq_moneda` varchar(15) DEFAULT NULL,
  `chq_cotiz` int(11) DEFAULT NULL,
  `chq_moneda_ref` double(12,2) DEFAULT NULL,
  `chq_suc` varchar(3) DEFAULT NULL,
  `chq_estado` varchar(15) DEFAULT NULL,
  `chq_mot_anul` varchar(60) DEFAULT NULL,
  `chq_fecha_ins` date DEFAULT NULL,
  `chq_trans` varchar(4) DEFAULT NULL,
  `chq_saldo` double(16,2) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `caja` */

DROP TABLE IF EXISTS `caja`;

CREATE TABLE `caja` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cj_ref` varchar(5) DEFAULT NULL,
  `cj_user` varchar(30) DEFAULT NULL,
  `cj_fecha` date DEFAULT NULL,
  `cj_saldo_ini` double(16,2) DEFAULT NULL,
  `cj_estado` varchar(10) DEFAULT NULL,
  `cj_suc` varchar(4) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `caja_cambios` */

DROP TABLE IF EXISTS `caja_cambios`;

CREATE TABLE `caja_cambios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cb_fecha` date DEFAULT NULL,
  `cb_moneda` varchar(5) DEFAULT NULL,
  `cb_compra` int(11) DEFAULT NULL,
  `cb_venta` int(11) DEFAULT NULL,
  `cb_ref` varchar(5) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `caja_con` */

DROP TABLE IF EXISTS `caja_con`;

CREATE TABLE `caja_con` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cjc_cod` varchar(3) DEFAULT NULL,
  `cjc_descri` varchar(40) DEFAULT NULL,
  `cjc_compl` varchar(2) DEFAULT NULL,
  `cjc_tipo` varchar(1) DEFAULT NULL,
  `cjc_autom` varchar(2) DEFAULT NULL,
  `cjc_gasto` varchar(60) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Table structure for table `caja_monedas` */

DROP TABLE IF EXISTS `caja_monedas`;

CREATE TABLE `caja_monedas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `m_cod` varchar(5) DEFAULT NULL,
  `m_descri` varchar(20) DEFAULT NULL,
  `m_ref` varchar(2) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `caja_mov` */

DROP TABLE IF EXISTS `caja_mov`;

CREATE TABLE `caja_mov` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cj_ref` varchar(5) DEFAULT NULL,
  `__date` date DEFAULT NULL,
  `__user` varchar(60) DEFAULT NULL,
  `__moneda` varchar(60) DEFAULT NULL,
  `__cotiz` int(11) DEFAULT NULL,
  `monto` double(14,2) DEFAULT NULL,
  `concepto` varchar(60) DEFAULT NULL,
  `compl` varchar(200) DEFAULT NULL,
  `entrada_ref` double(60,2) DEFAULT NULL,
  `salida_ref` double(60,2) DEFAULT NULL,
  `cj_ref_aux` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `categorias` */

DROP TABLE IF EXISTS `categorias`;

CREATE TABLE `categorias` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_code` int(11) DEFAULT NULL,
  `cat_descrip` varchar(30) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Table structure for table `clientes` */

DROP TABLE IF EXISTS `clientes`;

CREATE TABLE `clientes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cli_id` int(11) DEFAULT NULL,
  `cli_ci` varchar(16) DEFAULT NULL,
  `cli_tipo_doc` varchar(60) DEFAULT NULL,
  `cli_nombre` varchar(50) DEFAULT NULL,
  `cli_cat` varchar(60) DEFAULT NULL,
  `cli_limit` int(11) DEFAULT NULL,
  `cli_nro_cta` int(11) DEFAULT NULL,
  `cli_fecha_nac` date DEFAULT NULL,
  `cli_tel` varchar(13) DEFAULT NULL,
  `cli_email` varchar(50) DEFAULT NULL,
  `cli_pais` varchar(60) DEFAULT NULL,
  `cli_dep_estado` varchar(60) DEFAULT NULL,
  `cli_ciudad` varchar(60) DEFAULT NULL,
  `cli_dir` varchar(300) DEFAULT NULL,
  `cli_fecha_ins` date DEFAULT NULL,
  `cli_ventas` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1155 DEFAULT CHARSET=latin1;

/*Table structure for table `convenios` */

DROP TABLE IF EXISTS `convenios`;

CREATE TABLE `convenios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conv_cod` varchar(4) DEFAULT NULL,
  `conv_nombre` varchar(50) DEFAULT NULL,
  `conv_tipo` varchar(60) DEFAULT NULL,
  `conv_porc` double(10,6) DEFAULT NULL,
  `conv_dias_acr` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Table structure for table `cuotas` */

DROP TABLE IF EXISTS `cuotas`;

CREATE TABLE `cuotas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `c_fact` int(11) DEFAULT NULL,
  `c_nro_cuota` int(11) DEFAULT NULL,
  `c_monto` double(14,2) DEFAULT NULL,
  `c_moneda` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `c_cotiz` double(8,2) DEFAULT NULL,
  `c_monto_ref` double(16,2) DEFAULT NULL,
  `c_venc` date DEFAULT NULL,
  `c_saldo` double(16,2) DEFAULT NULL,
  `c_suc` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `c_estado` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `c_entrega` double(16,2) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `def_imp` */

DROP TABLE IF EXISTS `def_imp`;

CREATE TABLE `def_imp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `imp_cod` varchar(60) DEFAULT NULL,
  `valor` varchar(8) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `empresas` */

DROP TABLE IF EXISTS `empresas`;

CREATE TABLE `empresas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `emp_cod` varchar(2) DEFAULT NULL,
  `emp_nombre` varchar(60) DEFAULT NULL,
  `emp_ruc` varchar(20) DEFAULT NULL,
  `emp_dir` varchar(60) DEFAULT NULL,
  `emp_tel` varchar(30) DEFAULT NULL,
  `emp_mail` varchar(30) DEFAULT NULL,
  `emp_web` varchar(40) DEFAULT NULL,
  `emp_tipo` varchar(60) DEFAULT NULL,
  `emp_ciudad` varchar(40) DEFAULT NULL,
  `emp_estado` varchar(60) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `fact_comp_det` */

DROP TABLE IF EXISTS `fact_comp_det`;

CREATE TABLE `fact_comp_det` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `p_ref` int(11) DEFAULT NULL,
  `p_cod_art` varchar(60) DEFAULT NULL,
  `p_cod_prov` varchar(24) DEFAULT NULL,
  `p_cod` int(11) DEFAULT NULL,
  `p_descri` varchar(70) DEFAULT NULL,
  `p_cant_compra` double(16,2) DEFAULT NULL,
  `p_valor` double(16,2) DEFAULT NULL,
  `p_um` varchar(60) DEFAULT NULL,
  `p_cant` double(16,2) DEFAULT NULL,
  `p_compra` double(16,2) DEFAULT NULL,
  `p_estado` varchar(12) DEFAULT NULL,
  `p_cant_um` varchar(10) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

/*Table structure for table `fact_cont` */

DROP TABLE IF EXISTS `fact_cont`;

CREATE TABLE `fact_cont` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_suc` varchar(8) DEFAULT NULL,
  `f_user` varchar(30) DEFAULT NULL,
  `f_ref` varchar(14) DEFAULT NULL,
  `f_estab` varchar(6) DEFAULT NULL,
  `f_pdv` varchar(6) DEFAULT NULL,
  `f_nro` varchar(12) DEFAULT NULL,
  `f_fecha` date DEFAULT NULL,
  `f_ruc` varchar(20) DEFAULT NULL,
  `f_estado` varchar(60) DEFAULT NULL,
  `f_mot_anul` varchar(400) DEFAULT NULL,
  `f_total` varchar(18) DEFAULT NULL,
  `f_venc` date DEFAULT NULL,
  `f_tipo` varchar(14) DEFAULT NULL,
  `f_timbrado` varchar(10) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=141 DEFAULT CHARSET=latin1;

/*Table structure for table `fact_vent_det` */

DROP TABLE IF EXISTS `fact_vent_det`;

CREATE TABLE `fact_vent_det` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `d_fact` int(11) DEFAULT NULL,
  `d_codigo` varchar(14) DEFAULT NULL,
  `d_descrip` varchar(80) DEFAULT NULL,
  `d_cant` double(12,2) DEFAULT NULL,
  `d_um` varchar(6) DEFAULT NULL,
  `d_cant_v` double(12,2) DEFAULT NULL,
  `d_precio` double(16,2) DEFAULT NULL,
  `d_subtotal` double(16,2) DEFAULT NULL,
  `d_imp` varchar(10) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `d_codigo` (`d_codigo`),
  KEY `d_fact` (`d_fact`)
) ENGINE=InnoDB AUTO_INCREMENT=4541 DEFAULT CHARSET=latin1;

/*Table structure for table `factura_compra` */

DROP TABLE IF EXISTS `factura_compra`;

CREATE TABLE `factura_compra` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `c_ref` varchar(8) DEFAULT NULL,
  `c_tipo_doc` varchar(60) DEFAULT NULL,
  `c_empr` varchar(2) DEFAULT NULL,
  `c_prov` varchar(5) DEFAULT NULL,
  `c_fecha` date DEFAULT NULL,
  `c_hora` time DEFAULT NULL,
  `c_fecha_fac` date DEFAULT NULL,
  `c_factura` varchar(20) DEFAULT NULL,
  `c_moneda` varchar(10) DEFAULT NULL,
  `c_cotiz` int(11) DEFAULT NULL,
  `c_fn` double(12,2) DEFAULT NULL,
  `c_otros` double(12,2) DEFAULT NULL,
  `c_valor_total` double(14,2) DEFAULT NULL,
  `c_porc_rec` double(7,2) DEFAULT NULL,
  `c_tipo` varchar(10) DEFAULT NULL,
  `c_estado` varchar(15) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `c_ref` (`c_ref`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Table structure for table `factura_venta` */

DROP TABLE IF EXISTS `factura_venta`;

CREATE TABLE `factura_venta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `f_nro` int(11) DEFAULT NULL,
  `f_tipo_doc` varchar(60) DEFAULT NULL,
  `f_cli_cod` varchar(60) DEFAULT NULL,
  `f_cat` varchar(3) DEFAULT NULL,
  `f_estado` varchar(60) DEFAULT NULL,
  `f_fecha` date DEFAULT NULL,
  `f_hora` time DEFAULT NULL,
  `f_usuario` varchar(20) DEFAULT NULL,
  `f_cob_efectivo` double(16,2) DEFAULT NULL,
  `f_conv_cod` int(11) DEFAULT NULL,
  `f_monto_conv` double(16,2) DEFAULT NULL,
  `f_moneda` varchar(4) DEFAULT NULL,
  `f_p_exp` varchar(6) DEFAULT NULL,
  `f_fact_cont` int(11) DEFAULT NULL,
  `f_motivo_anul` varchar(1024) DEFAULT NULL,
  `f_voucher` varchar(24) DEFAULT NULL,
  `f_suc` varchar(4) DEFAULT NULL,
  `f_tipo` varchar(60) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `f_nro` (`f_nro`)
) ENGINE=InnoDB AUTO_INCREMENT=647 DEFAULT CHARSET=latin1;

/*Table structure for table `grupo` */

DROP TABLE IF EXISTS `grupo`;

CREATE TABLE `grupo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `g_cod` int(11) DEFAULT NULL,
  `g_nombre` varchar(60) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

/*Table structure for table `grupos_x_sector` */

DROP TABLE IF EXISTS `grupos_x_sector`;

CREATE TABLE `grupos_x_sector` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_cod` int(11) DEFAULT NULL,
  `gc_cod` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=latin1;

/*Table structure for table `lista_precios` */

DROP TABLE IF EXISTS `lista_precios`;

CREATE TABLE `lista_precios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) DEFAULT NULL,
  `num` int(11) DEFAULT NULL,
  `precio_unit` double(16,2) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4233 DEFAULT CHARSET=latin1;

/*Table structure for table `nota_credito` */

DROP TABLE IF EXISTS `nota_credito`;

CREATE TABLE `nota_credito` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `n_nro` int(11) DEFAULT NULL,
  `n_usuario` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `n_fecha` date DEFAULT NULL,
  `n_cli_cod` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `n_cat` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `n_estado` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `n_cob_efectivo` double(16,2) DEFAULT NULL,
  `n_conv_cod` int(11) DEFAULT NULL,
  `n_monto_conv` double(16,2) DEFAULT NULL,
  `n_moneda` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `n_fact_cont` int(11) DEFAULT NULL,
  `n_voucher` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `n_suc` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `n_tipo` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `nota_credito_det` */

DROP TABLE IF EXISTS `nota_credito_det`;

CREATE TABLE `nota_credito_det` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `d_fact` int(11) DEFAULT NULL,
  `d_codigo` varchar(14) COLLATE utf8_unicode_ci DEFAULT NULL,
  `d_descrip` varchar(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `d_cant` double(12,2) DEFAULT NULL,
  `d_um` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `d_cant_v` double(12,2) DEFAULT NULL,
  `d_cant_dv` double(12,2) DEFAULT NULL,
  `d_precio` double(16,2) DEFAULT NULL,
  `d_subtotal` double(16,2) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `p_data` */

DROP TABLE IF EXISTS `p_data`;

CREATE TABLE `p_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `F_NAME_` varchar(60) DEFAULT NULL,
  `F_ALIAS_` varchar(200) DEFAULT NULL,
  `F_HELP_` varchar(200) DEFAULT NULL,
  `F_TYPE_` varchar(60) DEFAULT NULL,
  `F_DSL_` varchar(200) DEFAULT NULL,
  `F_MULTI_` varchar(2) DEFAULT NULL,
  `F_AUTONUM_` varchar(2) DEFAULT NULL,
  `F_OPTIONS_` varchar(200) DEFAULT NULL,
  `F_LINK_` varchar(60) DEFAULT NULL,
  `F_REPORT_` varchar(60) DEFAULT NULL,
  `F_MAKE_QUERY_` varchar(2) DEFAULT NULL,
  `F_QUERY_` varchar(200) DEFAULT NULL,
  `F_QUERY_REF_` varchar(200) DEFAULT NULL,
  `F_SEND_` varchar(200) DEFAULT NULL,
  `F_RELATION_` varchar(60) DEFAULT NULL,
  `F_RELTABLE_` varchar(60) DEFAULT NULL,
  `F_SHOWFIELD_` varchar(60) DEFAULT NULL,
  `F_RELFIELD_` varchar(60) DEFAULT NULL,
  `F_LOCALFIELD_` varchar(60) DEFAULT NULL,
  `F_FILTER_` varchar(100) DEFAULT NULL,
  `F_LENGTH_` varchar(10) DEFAULT NULL,
  `F_DEC_` varchar(5) DEFAULT NULL,
  `F_BROW_` varchar(2) DEFAULT NULL,
  `F_REQUIRED_` varchar(2) DEFAULT NULL,
  `F_UNIQUE_` varchar(2) DEFAULT NULL,
  `F_NODB_` varchar(2) DEFAULT NULL,
  `F_TOTAL_` varchar(2) DEFAULT NULL,
  `F_EXTRA_` varchar(2) DEFAULT NULL,
  `V_DEFAULT_` varchar(200) DEFAULT NULL,
  `C_SHOW_` varchar(200) DEFAULT NULL,
  `C_VIEW_` varchar(200) DEFAULT NULL,
  `C_CHANGE_` varchar(200) DEFAULT NULL,
  `F_PREVAL_` varchar(200) DEFAULT NULL,
  `F_POSVAL_` varchar(200) DEFAULT NULL,
  `F_MESSAGE_` varchar(200) DEFAULT NULL,
  `F_FORMULA_` varchar(200) DEFAULT NULL,
  `G_SHOW_` varchar(200) DEFAULT NULL,
  `G_CHANGE_` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=latin1;

/*Table structure for table `p_groups` */

DROP TABLE IF EXISTS `p_groups`;

CREATE TABLE `p_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `obs` varchar(60) DEFAULT NULL,
  `trustee` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Table structure for table `p_log` */

DROP TABLE IF EXISTS `p_log`;

CREATE TABLE `p_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `year` char(4) DEFAULT NULL,
  `month` char(2) DEFAULT NULL,
  `day` char(2) DEFAULT NULL,
  `hour` char(2) DEFAULT NULL,
  `minute` char(2) DEFAULT NULL,
  `second` char(2) DEFAULT NULL,
  `user` varchar(20) DEFAULT NULL,
  `action` varchar(80) DEFAULT NULL,
  `status` char(2) DEFAULT NULL,
  `obs` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6972 DEFAULT CHARSET=latin1;

/*Table structure for table `p_proc` */

DROP TABLE IF EXISTS `p_proc`;

CREATE TABLE `p_proc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `descr` varchar(60) DEFAULT NULL,
  `doc` varchar(255) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `parameters` varchar(255) DEFAULT NULL,
  `returns` varchar(255) DEFAULT NULL,
  `body` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

/*Table structure for table `p_ref_int` */

DROP TABLE IF EXISTS `p_ref_int`;

CREATE TABLE `p_ref_int` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `_dep_table` varchar(20) DEFAULT NULL,
  `_dep_field` varchar(15) DEFAULT NULL,
  `_ref_table` varchar(20) DEFAULT NULL,
  `_ref_field` varchar(15) DEFAULT NULL,
  `_operation` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `p_session` */

DROP TABLE IF EXISTS `p_session`;

CREATE TABLE `p_session` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `day` char(2) DEFAULT NULL,
  `serial` varchar(60) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `project` varchar(20) DEFAULT NULL,
  `transp1` blob,
  `transp2` blob,
  `trustee` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `serial` (`serial`)
) ENGINE=InnoDB AUTO_INCREMENT=428 DEFAULT CHARSET=latin1;

/*Table structure for table `p_users` */

DROP TABLE IF EXISTS `p_users`;

CREATE TABLE `p_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `obs` varchar(60) DEFAULT NULL,
  `resh` int(10) unsigned DEFAULT NULL,
  `resv` int(10) unsigned DEFAULT NULL,
  `local` varchar(60) DEFAULT NULL,
  `lang` varchar(2) DEFAULT NULL,
  `trustee` bigint(20) unsigned DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `nombre` varchar(80) DEFAULT NULL,
  `ci` varchar(20) DEFAULT NULL,
  `tel` varchar(60) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `nro_usuario` varchar(60) DEFAULT NULL,
  `estado` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

/*Table structure for table `p_version` */

DROP TABLE IF EXISTS `p_version`;

CREATE TABLE `p_version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dbversion` varchar(10) DEFAULT NULL,
  `dbrelease` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Table structure for table `parametros` */

DROP TABLE IF EXISTS `parametros`;

CREATE TABLE `parametros` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(20) DEFAULT NULL,
  `valor` varchar(20) DEFAULT NULL,
  `descrip` varchar(100) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Table structure for table `pdv` */

DROP TABLE IF EXISTS `pdv`;

CREATE TABLE `pdv` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `p_suc` varchar(4) DEFAULT NULL,
  `p_cod` varchar(6) DEFAULT NULL,
  `p_ubic` varchar(30) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Table structure for table `proveedores` */

DROP TABLE IF EXISTS `proveedores`;

CREATE TABLE `proveedores` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prov_cod` int(11) DEFAULT NULL,
  `prov_nombre` varchar(60) DEFAULT NULL,
  `prov_ruc` varchar(20) DEFAULT NULL,
  `prov_dir` varchar(60) DEFAULT NULL,
  `prov_ciudad` varchar(40) DEFAULT NULL,
  `prov_pais` varchar(60) DEFAULT NULL,
  `prov_tel` varchar(40) DEFAULT NULL,
  `prov_fax` varchar(20) DEFAULT NULL,
  `prov_mail` varchar(80) DEFAULT NULL,
  `prov_web` varchar(40) DEFAULT NULL,
  `prov_contacto` varchar(40) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `prov_cod` (`prov_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Table structure for table `sector` */

DROP TABLE IF EXISTS `sector`;

CREATE TABLE `sector` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `s_cod` int(11) DEFAULT NULL,
  `s_nombre` varchar(40) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Table structure for table `stock` */

DROP TABLE IF EXISTS `stock`;

CREATE TABLE `stock` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(20) NOT NULL,
  `suc` varchar(6) NOT NULL,
  `cantidad` double(16,2) DEFAULT NULL,
  PRIMARY KEY (`codigo`,`suc`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3694 DEFAULT CHARSET=latin1;

/*Table structure for table `tipo` */

DROP TABLE IF EXISTS `tipo`;

CREATE TABLE `tipo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `t_cod` int(11) DEFAULT NULL,
  `t_nombre` varchar(60) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

/*Table structure for table `tipos_doc` */

DROP TABLE IF EXISTS `tipos_doc`;

CREATE TABLE `tipos_doc` (
  `tipo_doc` int(4) DEFAULT NULL,
  `descrip` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `tipos_x_grupo` */

DROP TABLE IF EXISTS `tipos_x_grupo`;

CREATE TABLE `tipos_x_grupo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `g_cod` int(11) DEFAULT NULL,
  `ct_cod` varchar(60) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6433 DEFAULT CHARSET=latin1;

/*Table structure for table `tmp` */

DROP TABLE IF EXISTS `tmp`;

CREATE TABLE `tmp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `p_sector` varchar(60) DEFAULT NULL,
  `p_grupo` varchar(60) DEFAULT NULL,
  `p_tipo` varchar(60) DEFAULT NULL,
  `p_color` varchar(60) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `um` */

DROP TABLE IF EXISTS `um`;

CREATE TABLE `um` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `u_cod` varchar(10) DEFAULT NULL,
  `u_descri` varchar(40) DEFAULT NULL,
  `u_ref` varchar(5) DEFAULT NULL,
  `u_mult` double(15,3) DEFAULT NULL,
  `u_prior` int(11) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `u_cod` (`u_cod`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/* Function  structure for function  `anular_factura` */

/*!50003 DROP FUNCTION IF EXISTS `anular_factura` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `anular_factura`(nro integer, usuario varchar(30), obs_ varchar(100)) RETURNS int(11)
    DETERMINISTIC
BEGIN


UPDATE productos p, fact_vent_det d SET p_cant = p_cant + d_cant_v  WHERE d_codigo = p_cod and d_fact = nro;

UPDATE factura_venta SET f_estado = 'Abierta' WHERE f_nro = nro;

INSERT INTO p_log(YEAR, MONTH, DAY, HOUR, MINUTE, SECOND, USER, ACTION, STATUS, obs)
VALUES ( YEAR(CURRENT_DATE), MONTH(CURRENT_DATE), DAY(CURRENT_DATE), HOUR(CURRENT_TIME), MINUTE(CURRENT_TIME), SECOND(CURRENT_TIME), usuario, 'AnularFactura', 'Ok', obs_);

RETURN 1;

END */$$
DELIMITER ;

/* Function  structure for function  `caja_ins_aciento` */

/*!50003 DROP FUNCTION IF EXISTS `caja_ins_aciento` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `caja_ins_aciento`(ref int,fecha date, user varchar(30), _monto double(14,2),moneda varchar(4),cotiz double(8,2), e_s varchar(4), con int, compl varchar(200),aux varchar(14)) RETURNS int(11)
    DETERMINISTIC
BEGIN

DECLARE entrada_ref DOUBLE(14,2);
DECLARE salida_ref DOUBLE(14,2);

IF ref = 0 THEN
  SELECT cj_ref FROM caja WHERE cj_estado = 'Abierta' order by id desc limit 1 into ref;
END IF;

IF  e_s != 'S'  THEN
  SET entrada_ref = _monto * cotiz;
  SET salida_ref = 0;
ELSE
   SET entrada_ref = 0;
   SET salida_ref = _monto * cotiz;
END IF;

INSERT INTO caja_mov(  cj_ref ,__date,__user,__moneda,__cotiz,monto,concepto,compl, entrada_ref, salida_ref,cj_ref_aux)VALUES(ref,fecha,user, moneda, cotiz,_monto,con, compl, entrada_ref,salida_ref,aux);



RETURN 1;
END */$$
DELIMITER ;

/* Function  structure for function  `calc_precio_promedio` */

/*!50003 DROP FUNCTION IF EXISTS `calc_precio_promedio` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `calc_precio_promedio`(codigo_ varchar(30)) RETURNS double
    DETERMINISTIC
BEGIN
    DECLARE PRECIO_PROMEDIO DOUBLE(16,2);
   SELECT AVG(p_compra) FROM factura_compra f, fact_comp_det d WHERE f.c_ref = d.p_ref AND f.c_estado = 'cerrada' AND p_cod_art = codigo_ INTO PRECIO_PROMEDIO;

IF(PRECIO_PROMEDIO IS NULL) THEN
 SET PRECIO_PROMEDIO = 0;
END IF;

UPDATE articulos SET p_costo_prom = PRECIO_PROMEDIO WHERE codigo = codigo_;

RETURN PRECIO_PROMEDIO;

END */$$
DELIMITER ;

/* Function  structure for function  `calc_stock` */

/*!50003 DROP FUNCTION IF EXISTS `calc_stock` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `calc_stock`(codigo_  varchar(30)) RETURNS double(16,2)
    DETERMINISTIC
BEGIN

DECLARE stock DOUBLE(16,2);
DECLARE TMP INT;

# Genera el Stock si hay sucursal Nueva  y Corrige el Stock
 SELECT COUNT(gen_stock_suc(codigo_ ,emp_cod )) FROM empresas WHERE emp_estado = 'Activo'  INTO TMP;
 
SELECT SUM(cantidad) FROM stock WHERE codigo = codigo_ INTO stock ;
 

RETURN stock;
END */$$
DELIMITER ;

/* Function  structure for function  `cerrar_compra` */

/*!50003 DROP FUNCTION IF EXISTS `cerrar_compra` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `cerrar_compra`(nro_compra integer, estado varchar(30)) RETURNS int(11)
    DETERMINISTIC
BEGIN
DECLARE TMP INT;

IF estado = 'Cerrada' THEN
    SELECT COUNT(calc_precio_promedio(p_cod_art)) FROM fact_comp_det WHERE p_ref = nro_compra INTO TMP;
END IF; 

RETURN 1;
END */$$
DELIMITER ;

/* Function  structure for function  `cerrar_venta` */

/*!50003 DROP FUNCTION IF EXISTS `cerrar_venta` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `cerrar_venta`(factura integer, efectivo double(16,2), moneda varchar(4), cotiz double(10,2),voucher varchar(30),conv integer, monto_conv double(16,2),tipo varchar(20)) RETURNS int(11)
    DETERMINISTIC
BEGIN

DECLARE TMP INTEGER;
DECLARE SUC VARCHAR(6);

SELECT f_suc FROM factura_venta WHERE f_nro = factura INTO SUC;


SELECT COUNT(descontar_stock(d_codigo,d_cant_v,SUC)) FROM fact_vent_det WHERE d_fact = factura INTO TMP;

 
 UPDATE factura_venta SET f_estado = 'Cerrada',f_cob_efectivo = efectivo , f_conv_cod = conv ,f_monto_conv = monto_conv, f_moneda = moneda, f_voucher = voucher,f_tipo = tipo,f_hora = current_time  WHERE f_nro = factura; 

RETURN 1;
END */$$
DELIMITER ;

/* Function  structure for function  `cob_cuota_cheque` */

/*!50003 DROP FUNCTION IF EXISTS `cob_cuota_cheque` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `cob_cuota_cheque`(factura int,cuota int,cj_ref int,usuario varchar(30),monto double(14,2),nro_cheq varchar(30)) RETURNS int(11)
    DETERMINISTIC
BEGIN

DECLARE COMPL_ VARCHAR(200);
DECLARE  AUX_ VARCHAR(60);
DECLARE TMP INTEGER;

DECLARE SALDO_ANT DOUBLE(16,2);

DECLARE SALDO  DOUBLE(16,2);

DECLARE CONCEPTO VARCHAR(60);

SELECT c_saldo FROM cuotas WHERE c_fact = factura  AND  c_nro_cuota = cuota INTO SALDO_ANT;
SET SALDO = SALDO_ANT - monto;


SELECT concat('cb_ ',cuota,'_fact_' ,factura) INTO AUX_;

SELECT concat('Cobro cuota ',cuota,' Factura Nro:' ,factura) INTO COMPL_;
  
UPDATE bcos_cheq_ter	 SET chq_saldo = chq_saldo - monto WHERE chq_num = nro_cheq;

IF (SALDO  <= 0) THEN
SELECT concat('Pago Total Cheque Nro: ',nro_cheq)  INTO CONCEPTO;
ELSE
SELECT concat('Pago Parcial Cheque Nro: ',nro_cheq)  INTO CONCEPTO;
END IF;

 INSERT INTO amortizaciones(a_fact,a_cuota,a_fecha,a_comp,a_concepto,a_compl,a_saldo_ant,a_monto,a_saldo)
  VALUES(factura,cuota,CURRENT_DATE,'Cobro con Cheque',8,CONCEPTO,SALDO_ANT,monto,SALDO);

UPDATE cuotas SET c_saldo = SALDO,c_entrega = c_entrega + monto WHERE c_fact = factura AND c_nro_cuota = cuota;

IF (SALDO <= 0) THEN
UPDATE cuotas SET c_saldo = 0,c_entrega = c_monto_ref,c_estado = 'Cancelada'  WHERE c_fact = factura AND c_nro_cuota = cuota;

END IF;

RETURN 1;

END */$$
DELIMITER ;

/* Function  structure for function  `cob_cuota_efectivo` */

/*!50003 DROP FUNCTION IF EXISTS `cob_cuota_efectivo` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `cob_cuota_efectivo`(factura int,cuota int,cj_ref int,usuario varchar(30),monto double(14,2)) RETURNS int(11)
    DETERMINISTIC
BEGIN

DECLARE COMPL_ VARCHAR(200);
DECLARE  AUX_ VARCHAR(60);
DECLARE TMP INTEGER;

DECLARE CONCEPTO VARCHAR(60);

DECLARE SALDO_ANT DOUBLE(16,2);

DECLARE SALDO  DOUBLE(16,2);

SELECT c_saldo FROM cuotas WHERE c_fact = factura  AND  c_nro_cuota = cuota INTO SALDO_ANT;
SET SALDO = SALDO_ANT - monto;

SELECT concat('cb_ ',cuota,'_fact_' ,factura) INTO AUX_;

SELECT concat('Cobro cuota ',cuota,' Factura Nro:' ,factura) INTO COMPL_;

SELECT caja_ins_aciento(cj_ref,current_date,usuario,monto,'G$',1,'E',7,COMPL_,AUX_) INTO TMP ;

IF (SALDO  <= 0) THEN
SELECT concat('Pago Total Efectivo')  INTO CONCEPTO;
ELSE
SELECT concat('Pago Parcial Efectivo ')  INTO CONCEPTO;
END IF;

 INSERT INTO amortizaciones(a_fact,a_cuota,a_fecha,a_comp,a_concepto,a_compl,a_saldo_ant,a_monto,a_saldo)
  VALUES(factura,cuota,CURRENT_DATE,'Cobro en Efectivo',7,CONCEPTO,SALDO_ANT,monto,SALDO);

UPDATE cuotas SET c_saldo = SALDO,c_entrega = c_entrega + monto WHERE c_fact = factura AND c_nro_cuota = cuota;

IF (SALDO <= 0) THEN
UPDATE cuotas SET c_saldo = 0,c_entrega = c_monto_ref,c_estado = 'Cancelada'  WHERE c_fact = factura AND c_nro_cuota = cuota;

END IF;

RETURN 1;

END */$$
DELIMITER ;

/* Function  structure for function  `corr_stock` */

/*!50003 DROP FUNCTION IF EXISTS `corr_stock` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `corr_stock`() RETURNS int(11)
    DETERMINISTIC
BEGIN

DECLARE TMP INTEGER;

SELECT DISTINCT COUNT(gen_stock_suc(p_cod_art ,emp_cod ))   FROM fact_comp_det a, empresas e  INTO TMP;

RETURN TMP;
END */$$
DELIMITER ;

/* Function  structure for function  `descontar_stock` */

/*!50003 DROP FUNCTION IF EXISTS `descontar_stock` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `descontar_stock`(codigo_ varchar(20) , cantidad_ double(14,2) ,suc_ varchar(6)) RETURNS int(11)
    DETERMINISTIC
BEGIN

UPDATE stock SET cantidad = cantidad - cantidad_ WHERE codigo = codigo_  AND suc = suc_ ; 

RETURN 1;

END */$$
DELIMITER ;

/* Function  structure for function  `gen_compra` */

/*!50003 DROP FUNCTION IF EXISTS `gen_compra` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `gen_compra`(ref int,empr varchar(6),prov int,fecha date,fecha_fac date,factura varchar(20),moneda varchar(4),cotiz double(12,2),fn double(12,2),otros double(12,2),valor_total double(12,2),porc_rec double(12,2),tipo varchar(10),tipo_doc_ integer) RETURNS int(11)
    DETERMINISTIC
BEGIN

INSERT INTO 
factura_compra(c_ref,c_empr,c_prov,c_fecha,c_hora,c_fecha_fac,c_factura,c_moneda,c_cotiz,c_fn,c_otros,c_valor_total,c_porc_rec,c_tipo,c_estado,c_tipo_doc)
	VALUES(	ref,empr,prov,fecha,current_time,fecha_fac,factura,moneda,cotiz,fn,otros,valor_total,porc_rec,tipo,'Abierta',tipo_doc_);


RETURN 1;
END */$$
DELIMITER ;

/* Function  structure for function  `gen_fact_cont` */

/*!50003 DROP FUNCTION IF EXISTS `gen_fact_cont` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `gen_fact_cont`(NRO INT, CANT INT,SUC VARCHAR(8),USER VARCHAR(30),PDV VARCHAR(6),RUC VARCHAR(30),VENC DATE,ESTAB VARCHAR(4),TIMBRADO VARCHAR(10)) RETURNS int(11)
    DETERMINISTIC
BEGIN

DECLARE i INTEGER;
DECLARE auX INTEGER;


SET i = 0; 

   WHILE  i < CANT  DO

    SET aux = NRO + i;

      INSERT INTO fact_cont(f_suc,f_user, f_nro, f_ref, f_pdv, f_fecha, f_ruc,                   f_estado,f_mot_anul, f_total, f_venc,f_estab,f_timbrado)VALUES(SUC,USER ,aux, '',PDV,'0000-00-00',RUC,'Disponible','',0, VENC,ESTAB,TIMBRADO);

   SET i = i + 1;  
   END WHILE;

RETURN 1;

END */$$
DELIMITER ;

/* Function  structure for function  `gen_lista_precios` */

/*!50003 DROP FUNCTION IF EXISTS `gen_lista_precios` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `gen_lista_precios`(codigo varchar(20)) RETURNS int(11)
    DETERMINISTIC
BEGIN
DECLARE TMP INTEGER;

     INSERT INTO lista_precios(codigo,num,precio_unit)VALUES (codigo,1,0);
     INSERT INTO lista_precios(codigo,num,precio_unit)VALUES (codigo,2,0);
     INSERT INTO lista_precios(codigo,num,precio_unit)VALUES (codigo,3,0);
     INSERT INTO lista_precios(codigo,num,precio_unit)VALUES (codigo,4,0);   
   
    SELECT COUNT(gen_stock_suc(codigo ,emp_cod )) FROM empresas WHERE emp_estado = 'Activo' INTO TMP;

RETURN 1;
END */$$
DELIMITER ;

/* Function  structure for function  `gen_nota_credito` */

/*!50003 DROP FUNCTION IF EXISTS `gen_nota_credito` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `gen_nota_credito`(cli_cod INT, cat INT,usuario VARCHAR(30)) RETURNS int(11)
    DETERMINISTIC
BEGIN
DECLARE NRO INT;
DECLARE SUC VARCHAR(4);

SELECT local FROM p_users WHERE NAME = usuario  INTO SUC;

SELECT  _autonum('n_nro') INTO NRO;

INSERT INTO nota_credito(n_nro,n_cli_cod,n_cat,n_estado,n_fecha,n_usuario,n_suc)
VALUES	(NRO ,cli_cod,cat, 'Abierta',CURRENT_DATE,usuario,SUC);

RETURN NRO;

END */$$
DELIMITER ;

/* Function  structure for function  `gen_stock_suc` */

/*!50003 DROP FUNCTION IF EXISTS `gen_stock_suc` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `gen_stock_suc`(codigo_ varchar(10),suc_ varchar(10)) RETURNS int(11)
    DETERMINISTIC
BEGIN

DECLARE compras DOUBLE(16,2);
DECLARE ventas DOUBLE(16,2);
DECLARE stock_suc DOUBLE(16,2);
DECLARE STOCK_GLOBAL DOUBLE(16,2);

INSERT IGNORE INTO stock (codigo,suc,cantidad)VALUES(codigo_,suc_, 0);

SELECT SUM(p_cant_um) FROM  factura_compra f, fact_comp_det d WHERE f.c_ref = d.p_ref AND d.p_cod_art =  codigo_ AND f.c_empr = suc_ INTO compras;

SELECT SUM(d_cant_v) FROM  factura_venta f, fact_vent_det d
WHERE f.f_nro = d.d_fact AND d.d_codigo =  codigo_  AND f.f_suc = suc_ INTO ventas;

IF(compras is null) THEN
  SET compras = 0;
END IF;

IF(ventas is null) THEN
  SET ventas = 0;
END IF;

SET stock_suc = compras -  ventas;

UPDATE stock SET cantidad = stock_suc WHERE codigo = codigo_ AND suc = suc_;

SELECT SUM(cantidad) FROM stock WHERE codigo = codigo_ INTO STOCK_GLOBAL;
UPDATE articulos SET p_stock = STOCK_GLOBAL WHERE codigo = codigo_;

RETURN stock_suc;
END */$$
DELIMITER ;

/* Function  structure for function  `gen_venta` */

/*!50003 DROP FUNCTION IF EXISTS `gen_venta` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `gen_venta`(cli_cod INT, cat INT,usuario VARCHAR(30),tipo_doc int) RETURNS int(11)
    DETERMINISTIC
BEGIN
DECLARE NRO INT;
DECLARE SUC VARCHAR(4);

SELECT local FROM p_users WHERE NAME = usuario  INTO SUC;

SELECT  _autonum('f_nro') INTO NRO;

INSERT INTO factura_venta(f_nro,f_cli_cod,f_cat,f_estado,f_fecha,f_usuario,f_suc,f_tipo_doc)
VALUES	(NRO ,cli_cod,cat, 'Abierta',CURRENT_DATE,usuario,SUC,tipo_doc);

RETURN NRO;

END */$$
DELIMITER ;

/* Function  structure for function  `nro_lote` */

/*!50003 DROP FUNCTION IF EXISTS `nro_lote` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `nro_lote`() RETURNS int(11)
    DETERMINISTIC
BEGIN
DECLARE LOTE INTEGER;
DECLARE CANT INTEGER;

SELECT COUNT(*) AS cant FROM fact_comp_det WHERE p_cod LIKE CONCAT('%',RIGHT(YEAR(CURRENT_DATE),2)) INTO CANT;

IF(CANT < 1)THEN   
    UPDATE __autonum__ SET VALUE = 0 WHERE NAME = 'p_cod'; 
END IF;


SELECT CONCAT(_autonum('p_cod'),DATE_FORMAT(CURRENT_DATE,'%y')) INTO LOTE;

RETURN LOTE;

END */$$
DELIMITER ;

/* Function  structure for function  `obtener_cambio` */

/*!50003 DROP FUNCTION IF EXISTS `obtener_cambio` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `obtener_cambio`(moneda VARCHAR(4)) RETURNS int(11)
    DETERMINISTIC
BEGIN
DECLARE COTIZ INT;


SELECT cb_compra FROM caja_cambios WHERE cb_moneda = moneda ORDER BY id DESC LIMIT 1 INTO COTIZ;

IF  ( COTIZ  IS  NULL ) THEN
   RETURN 1;
ELSE
  RETURN COTIZ;
END IF;

RETURN COTIZ;

END */$$
DELIMITER ;

/* Function  structure for function  `obtener_cambio_venta` */

/*!50003 DROP FUNCTION IF EXISTS `obtener_cambio_venta` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `obtener_cambio_venta`(moneda VARCHAR(4)) RETURNS int(11)
    DETERMINISTIC
BEGIN
DECLARE COTIZ INT;


SELECT cb_venta FROM caja_cambios WHERE cb_moneda = moneda ORDER BY id DESC LIMIT 1 INTO COTIZ;

IF  ( COTIZ  IS  NULL ) THEN
   RETURN 1;
ELSE
  RETURN COTIZ;
END IF;

RETURN COTIZ;

END */$$
DELIMITER ;

/* Function  structure for function  `_autonum` */

/*!50003 DROP FUNCTION IF EXISTS `_autonum` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`plus`@`localhost` FUNCTION `_autonum`(variable varchar(20)) RETURNS int(11)
    DETERMINISTIC
BEGIN
  DECLARE value_ INTEGER;
  SET value_=0;

  SELECT value+1 FROM __autonum__ WHERE name=variable 
    LIMIT 1 INTO value_;
  UPDATE __autonum__ SET value=value_ WHEre name=variable;

  RETURN value_;
END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
