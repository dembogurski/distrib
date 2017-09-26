<?php
/** data.menu__.base.php	Principal    ( data_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->alias = "Rad Plus";
$Obj->doc = "Principal";
$Obj->help = "Principal menu";
$Obj->Add(
    array(
        F_NAME_ => "archivo",
        F_ALIAS_ => "Archivo",
        F_HELP_ => "Archivo",
        F_TYPE_ => "header",
        R_TABLE_ => "",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "parametros",
        F_ALIAS_ => "Parametros",
        F_HELP_ => "Lista de Parametros Globales",
        F_TYPE_ => "menu",
        R_TABLE_ => "archivo",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.parametros",
        F_FILTER_ => "",
        G_SHOW_ => "1"));

$Obj->Add(
    array(
        F_NAME_ => "usuarios",
        F_ALIAS_ => "Funcionarios",
        F_HELP_ => "Lista de Funcionarios (Usuarios del Sistema)",
        F_TYPE_ => "menu",
        R_TABLE_ => "archivo",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.usuarios",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "empresas",
        F_ALIAS_ => "Empresas",
        F_HELP_ => "Lista de Empresas y o Sucursales",
        F_TYPE_ => "menu",
        R_TABLE_ => "archivo",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.empresas",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "cj",
        F_ALIAS_ => "Caja",
        F_HELP_ => "Caja",
        F_TYPE_ => "header",
        R_TABLE_ => "",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "caja_vent_en_cj",
        F_ALIAS_ => "Ventas en Caja",
        F_HELP_ => "Ventas en Caja",
        F_TYPE_ => "menu",
        R_TABLE_ => "cj",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.factura_venta_caja",
        F_FILTER_ => "f_estado = |{En_caja}|",
        G_SHOW_ => "96"));

$Obj->Add(
    array(
        F_NAME_ => "mov_cajas",
        F_ALIAS_ => "Ingreso y Egreso de Caja",
        F_HELP_ => "Movimientos Ingreso y Egreso de Caja",
        F_TYPE_ => "menu",
        R_TABLE_ => "cj",
        F_OPER_ => "20_ Consult",
        F_LINK_ => "db.caja_ing_eg",
        F_FILTER_ => "",
        G_SHOW_ => "96"));

$Obj->Add(
    array(
        F_NAME_ => "monedas",
        F_ALIAS_ => "Monedas",
        F_HELP_ => "Monedas",
        F_TYPE_ => "menu",
        R_TABLE_ => "cj",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.caja_monedas",
        F_FILTER_ => "",
        G_SHOW_ => "96"));

$Obj->Add(
    array(
        F_NAME_ => "cotiz",
        F_ALIAS_ => "Cotizaciones",
        F_HELP_ => "Cotizaciones",
        F_TYPE_ => "menu",
        R_TABLE_ => "cj",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.caja_cambios",
        F_FILTER_ => "",
        G_SHOW_ => "96"));

$Obj->Add(
    array(
        F_NAME_ => "caja_con",
        F_ALIAS_ => "Conceptos de Caja",
        F_HELP_ => "Conceptos de Caja",
        F_TYPE_ => "menu",
        R_TABLE_ => "cj",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.caja_con",
        F_FILTER_ => "",
        G_SHOW_ => "96"));

$Obj->Add(
    array(
        F_NAME_ => "rep_cj",
        F_ALIAS_ => "Reporte de Mov. Caja",
        F_HELP_ => "Reporte de Mov. Caja",
        F_TYPE_ => "menu",
        R_TABLE_ => "cj",
        F_OPER_ => "20_ Consult",
        F_LINK_ => "db.reportes",
        F_FILTER_ => "",
        G_SHOW_ => "96"));

$Obj->Add(
    array(
        F_NAME_ => "bcos",
        F_ALIAS_ => "Bancos",
        F_HELP_ => "Bancos",
        F_TYPE_ => "header",
        R_TABLE_ => "",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "bancos",
        F_ALIAS_ => "Bancos",
        F_HELP_ => "Bancos",
        F_TYPE_ => "menu",
        R_TABLE_ => "bcos",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.bcos",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "bcos_chq_ter",
        F_ALIAS_ => "Cheques de Terceros",
        F_HELP_ => "Cheques de Terceros",
        F_TYPE_ => "menu",
        R_TABLE_ => "bcos",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.bcos_chq_ter",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "menu_clientes",
        F_ALIAS_ => "Clientes",
        F_HELP_ => "Clientes",
        F_TYPE_ => "menu",
        R_TABLE_ => "archivo",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "clientes",
        F_ALIAS_ => "Clientes",
        F_HELP_ => "Clientes",
        F_TYPE_ => "submenu",
        R_TABLE_ => "menu_clientes",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.clientes",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "clientes_cons",
        F_ALIAS_ => "Buscar Clientes",
        F_HELP_ => "Clientes",
        F_TYPE_ => "submenu",
        R_TABLE_ => "menu_clientes",
        F_OPER_ => "20_ Consult",
        F_LINK_ => "db.clientes_cons",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "menu_proveedores",
        F_ALIAS_ => "Proveedores",
        F_HELP_ => "Proveedores",
        F_TYPE_ => "menu",
        R_TABLE_ => "archivo",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "proveedores",
        F_ALIAS_ => "Proveedores",
        F_HELP_ => "Proveedores",
        F_TYPE_ => "submenu",
        R_TABLE_ => "menu_proveedores",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.proveedores",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "categorias",
        F_ALIAS_ => "Categorias",
        F_HELP_ => "Categorias",
        F_TYPE_ => "submenu",
        R_TABLE_ => "menu_clientes",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.categorias",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "articulos",
        F_ALIAS_ => "Articulos",
        F_HELP_ => "Articulos",
        F_TYPE_ => "menu",
        R_TABLE_ => "archivo",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "",
        F_FILTER_ => "",
        G_SHOW_ => "192"));

$Obj->Add(
    array(
        F_NAME_ => "archivo_mae",
        F_ALIAS_ => "Definicion Articulos",
        F_HELP_ => "Definicion Articulos",
        F_TYPE_ => "submenu",
        R_TABLE_ => "articulos",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.articulos",
        F_FILTER_ => "",
        G_SHOW_ => "192"));

$Obj->Add(
    array(
        F_NAME_ => "sector",
        F_ALIAS_ => "Sectores",
        F_HELP_ => "Sectores",
        F_TYPE_ => "submenu",
        R_TABLE_ => "archivo_prod",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.sector",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "grupo",
        F_ALIAS_ => "Grupos",
        F_HELP_ => "Grupos",
        F_TYPE_ => "submenu",
        R_TABLE_ => "archivo_prod",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.grupo",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "tipo",
        F_ALIAS_ => "Sub-Grupos",
        F_HELP_ => "Sub-Grupos",
        F_TYPE_ => "submenu",
        R_TABLE_ => "archivo_prod",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.tipo",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "inv",
        F_ALIAS_ => "Inventario",
        F_HELP_ => "Inventario",
        F_TYPE_ => "header",
        R_TABLE_ => "",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "fact_prov",
        F_ALIAS_ => "Facturacion Proveedores",
        F_HELP_ => "Facturacion Proveedores",
        F_TYPE_ => "header",
        R_TABLE_ => "",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "",
        F_FILTER_ => "",
        G_SHOW_ => "192"));

$Obj->Add(
    array(
        F_NAME_ => "fact_compra_ab",
        F_ALIAS_ => "Facturas Compra Abiertas",
        F_HELP_ => "Facturas Abiertas",
        F_TYPE_ => "menu",
        R_TABLE_ => "fact_prov",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.factura_compra",
        F_FILTER_ => "c_estado=|{Abierta}| and c_tipo_doc = 1",
        G_SHOW_ => "128"));

$Obj->Add(
    array(
        F_NAME_ => "fact_compra_cer",
        F_ALIAS_ => "Facturas Compra Cerradas",
        F_HELP_ => "Facturas Cerradas",
        F_TYPE_ => "menu",
        R_TABLE_ => "fact_prov",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.factura_compra",
        F_FILTER_ => "c_estado=|{Cerrada}| and c_tipo_doc = 1",
        G_SHOW_ => "128"));

$Obj->Add(
    array(
        F_NAME_ => "entradas_abiertas",
        F_ALIAS_ => "Entrada Mercaderias Abiertas",
        F_HELP_ => "Entrada Mercaderias Abiertas",
        F_TYPE_ => "menu",
        R_TABLE_ => "inv",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.entrada_mercaderias",
        F_FILTER_ => "c_estado=|{Abierta}| and c_tipo_doc = 2",
        G_SHOW_ => "128"));

$Obj->Add(
    array(
        F_NAME_ => "entradas_cerradas",
        F_ALIAS_ => "Entrada Mercaderias Cerradas",
        F_HELP_ => "Entrada Mercaderias Cerradas",
        F_TYPE_ => "menu",
        R_TABLE_ => "inv",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.entrada_mercaderias",
        F_FILTER_ => "c_estado=|{Cerrada}| and c_tipo_doc = 2",
        G_SHOW_ => "128"));

$Obj->Add(
    array(
        F_NAME_ => "fact_cli",
        F_ALIAS_ => "Facturacion Cliente",
        F_HELP_ => "Facturacion Cliente",
        F_TYPE_ => "header",
        R_TABLE_ => "",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "",
        F_FILTER_ => "",
        G_SHOW_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "fact_cli_gen",
        F_ALIAS_ => "Nueva Venta",
        F_HELP_ => "Nueva Venta",
        F_TYPE_ => "menu",
        R_TABLE_ => "fact_cli",
        F_OPER_ => "20_ Consult",
        F_LINK_ => "db.factura_venta",
        F_FILTER_ => "",
        G_SHOW_ => "4"));

$Obj->Add(
    array(
        F_NAME_ => "fact_vent_ab",
        F_ALIAS_ => "Ventas Abiertas",
        F_HELP_ => "Ventas en proceso de carga",
        F_TYPE_ => "menu",
        R_TABLE_ => "fact_cli",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.factura_venta",
        F_FILTER_ => "f_estado = |{Abierta}| and f_tipo_doc = 3",
        G_SHOW_ => "4"));

$Obj->Add(
    array(
        F_NAME_ => "fact_vent_presup",
        F_ALIAS_ => "Presupuestos",
        F_HELP_ => "Presupuestos",
        F_TYPE_ => "menu",
        R_TABLE_ => "fact_cli",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.factura_venta",
        F_FILTER_ => "f_estado = |{Presupuesto}|",
        G_SHOW_ => "4"));

$Obj->Add(
    array(
        F_NAME_ => "fact_vent_cerr",
        F_ALIAS_ => "Ventas Cerradas",
        F_HELP_ => "Ventas Cerradas",
        F_TYPE_ => "menu",
        R_TABLE_ => "fact_cli",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.factura_venta_cerr",
        F_FILTER_ => "f_estado = |{Cerrada}|",
        G_SHOW_ => "4"));

$Obj->Add(
    array(
        F_NAME_ => "convenios",
        F_ALIAS_ => "Convenios",
        F_HELP_ => "Convenios",
        F_TYPE_ => "menu",
        R_TABLE_ => "cj",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.convenios",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "reportes",
        F_ALIAS_ => "Reportes",
        F_HELP_ => "Reportes Varios",
        F_TYPE_ => "header",
        R_TABLE_ => "",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "rep_ventas",
        F_ALIAS_ => "Reporte de Ventas",
        F_HELP_ => "Reporte de Ventas",
        F_TYPE_ => "menu",
        R_TABLE_ => "reportes",
        F_OPER_ => "20_ Consult",
        F_LINK_ => "db.rep_ventas",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "rep_stock",
        F_ALIAS_ => "Reportes de Stock",
        F_HELP_ => "Reportes de Stock",
        F_TYPE_ => "menu",
        R_TABLE_ => "reportes",
        F_OPER_ => "20_ Consult",
        F_LINK_ => "db.rep_stock",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "rep_compras",
        F_ALIAS_ => "Reportes de Compras",
        F_HELP_ => "Reportes de Compras",
        F_TYPE_ => "menu",
        R_TABLE_ => "reportes",
        F_OPER_ => "20_ Consult",
        F_LINK_ => "db.rep_margen",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "cuentas_cob",
        F_ALIAS_ => "Cuentas por Cobrar",
        F_HELP_ => "Cuentas por Cobrar",
        F_TYPE_ => "menu",
        R_TABLE_ => "fact_cli",
        F_OPER_ => "20_ Consult",
        F_LINK_ => "db.cuentas_cob",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "historial_cuent",
        F_ALIAS_ => "Reporte de Ventas a Credito",
        F_HELP_ => "Reporte de Ventas a Credito",
        F_TYPE_ => "menu",
        R_TABLE_ => "reportes",
        F_OPER_ => "20_ Consult",
        F_LINK_ => "db.cuentas_rep",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "comport_cliente",
        F_ALIAS_ => "Comportamiento de Clientes",
        F_HELP_ => "Reporte de Comportamiento de Clientes",
        F_TYPE_ => "menu",
        R_TABLE_ => "reportes",
        F_OPER_ => "20_ Consult",
        F_LINK_ => "db.rep_comport_cli",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "autonumericos",
        F_ALIAS_ => "Numeraciones",
        F_HELP_ => "Numeracion de Documentos",
        F_TYPE_ => "menu",
        R_TABLE_ => "archivo",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.autonum__",
        F_FILTER_ => "",
        G_SHOW_ => "1"));

$Obj->Add(
    array(
        F_NAME_ => "um",
        F_ALIAS_ => "Unidades de Medida",
        F_HELP_ => "Unidades de Medida",
        F_TYPE_ => "submenu",
        R_TABLE_ => "articulos",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.um",
        F_FILTER_ => "",
        G_SHOW_ => "192"));

$Obj->Add(
    array(
        F_NAME_ => "salida_inv",
        F_ALIAS_ => "Salida de Inventario",
        F_HELP_ => "Salida de Inventario",
        F_TYPE_ => "menu",
        R_TABLE_ => "inv",
        F_OPER_ => "20_ Consult",
        F_LINK_ => "db.salida_mercaderias",
        F_FILTER_ => "f_tipo_doc = 4",
        G_SHOW_ => "192"));

$Obj->Add(
    array(
        F_NAME_ => "salida_inv_ab",
        F_ALIAS_ => "Salidas de Inv. Abiertas",
        F_HELP_ => "Salida de Inventario Abiertas",
        F_TYPE_ => "menu",
        R_TABLE_ => "inv",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.salida_mercaderias",
        F_FILTER_ => "f_estado = |{Abierta}| and f_tipo_doc = 4",
        G_SHOW_ => "192"));

$Obj->Add(
    array(
        F_NAME_ => "art_consultar",
        F_ALIAS_ => "Buscar Articulos",
        F_HELP_ => "Buscar Articulos",
        F_TYPE_ => "submenu",
        R_TABLE_ => "articulos",
        F_OPER_ => "20_ Consult",
        F_LINK_ => "db.articulos_cons",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "puntos_exp",
        F_ALIAS_ => "Puntos de Expedicion",
        F_HELP_ => "Puntos de Expedicion",
        F_TYPE_ => "menu",
        R_TABLE_ => "archivo",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.pdv",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "fact_cont_gen",
        F_ALIAS_ => "Facturas Contables",
        F_HELP_ => "Facturas Contables",
        F_TYPE_ => "menu",
        R_TABLE_ => "archivo",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "def_impuestos",
        F_ALIAS_ => "Definicion de Impuestos",
        F_HELP_ => "Definicion de Impuestos",
        F_TYPE_ => "submenu",
        R_TABLE_ => "articulos",
        F_OPER_ => "1_ Browse",
        F_LINK_ => "db.def_imp",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "fact_cont_gener",
        F_ALIAS_ => "Generar Facturas Contables",
        F_HELP_ => "Generar Facturas Contables",
        F_TYPE_ => "submenu",
        R_TABLE_ => "fact_cont_gen",
        F_OPER_ => "20_ Consult",
        F_LINK_ => "db.fact_cont_gen",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "fact_cont_cons",
        F_ALIAS_ => "Buscar Facturas Contables",
        F_HELP_ => "Buscar Facturas Contables",
        F_TYPE_ => "submenu",
        R_TABLE_ => "fact_cont_gen",
        F_OPER_ => "20_ Consult",
        F_LINK_ => "db.fact_cont_cons",
        F_FILTER_ => "",
        G_SHOW_ => "64"));

?>
