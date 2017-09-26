<?php
$Obj->name = "rep_margen";
$Obj->alias = "Reporte de Margen x Factura de Compra";
$Obj->help = "Reporte de Margen x Factura de Compra";
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
        F_NAME_ => "desde",
        F_ALIAS_ => "Fecha de Compra Desde",
        F_HELP_ => "Fecha de Compra Hasta",
        F_TYPE_ => "date",
        F_NODB_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "hasta",
        F_ALIAS_ => "Hasta",
        F_HELP_ => "Hasta",
        F_TYPE_ => "date",
        F_NODB_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "rep_recup",
        F_ALIAS_ => "Generar Reporte de Recuperacion",
        F_HELP_ => "Generar Reporte de Recuperacion",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.recup_compras",
        F_NODB_ => "1",
        F_ORD_ => "30",
        C_VIEW_ => "desde.notEmpty()&& hasta.notEmpty()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "__lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "40",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton() ",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

?>
