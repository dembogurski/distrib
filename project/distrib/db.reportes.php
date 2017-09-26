<?php
$Obj->name = "reportes";
$Obj->alias = "Reporte Varios";
$Obj->help = "Reporte Varios";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "tmp";
$Obj->Filter = "";
$Obj->Sort = "";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "suc",
        F_ALIAS_ => "Sucursal",
        F_HELP_ => "Sucursal",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "empresas",
        F_SHOWFIELD_ => "emp_cod,emp_nombre",
        F_FILTER_ => "'true order by emp_cod asc'",
        F_NODB_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "desde",
        F_ALIAS_ => "Fecha desde",
        F_HELP_ => "Fecha desde",
        F_TYPE_ => "date",
        F_NODB_ => "1",
        F_ORD_ => "40",
        V_DEFAULT_ => "thisDate_",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "hasta",
        F_ALIAS_ => "Fecha hasta",
        F_HELP_ => "Fecha hasta",
        F_TYPE_ => "date",
        F_NODB_ => "1",
        F_ORD_ => "50",
        V_DEFAULT_ => "thisDate_",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "vp",
        F_ALIAS_ => "Vista Previa/Impresion",
        F_HELP_ => "Vista Previa/Impresion",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Vista Previa,Imprimir",
        F_NODB_ => "1",
        F_ORD_ => "60",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "rep",
        F_ALIAS_ => "Ver Reporte de Movimientos de Caja",
        F_HELP_ => "Ver Reporte en Forma de Vista Previa",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.mov_caja",
        F_NODB_ => "1",
        F_ORD_ => "100",
        F_INLINE_ => "1",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));
		
$Obj->Add(
    array(
        F_NAME_ => "arqueo_caja",
        F_ALIAS_ => "Arqueo de Caja",
        F_HELP_ => "Ver Arqueo de Caja en Forma de Vista Previa",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.arqueo_caja",
        F_NODB_ => "1",
        F_ORD_ => "100",
        F_INLINE_ => "1",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));		

$Obj->Add(
    array(
        F_NAME_ => "__lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "110",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton()",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

?>
