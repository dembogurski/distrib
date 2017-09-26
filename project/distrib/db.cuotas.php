<?php
$Obj->name = "cuotas";
$Obj->alias = "Cuotas";
$Obj->help = "Cuotas";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "cuotas";
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
        F_NAME_ => "c_fact",
        F_ALIAS_ => "Factura",
        F_HELP_ => "Factura",
        F_TYPE_ => "text",
        F_LENGTH_ => "11",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_nro_cuota",
        F_ALIAS_ => "Nro Cuota",
        F_HELP_ => "Nro Cuota",
        F_TYPE_ => "text",
        F_LENGTH_ => "3",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_monto",
        F_ALIAS_ => "Monto",
        F_HELP_ => "Monto",
        F_TYPE_ => "text",
        F_LENGTH_ => "14",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "30",
        G_SHOW_ => "96",
        G_CHANGE_ => "96"));

$Obj->Add(
    array(
        F_NAME_ => "c_moneda",
        F_ALIAS_ => "Moneda",
        F_HELP_ => "Moneda",
        F_TYPE_ => "text",
        F_LENGTH_ => "4",
        F_ORD_ => "40",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_cotiz",
        F_ALIAS_ => "Cotizacion",
        F_HELP_ => "Cotizacion",
        F_TYPE_ => "text",
        F_LENGTH_ => "8",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_monto_ref",
        F_ALIAS_ => "Monto Gs",
        F_HELP_ => "Monto Gs",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "60",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_venc",
        F_ALIAS_ => "Vencimiento",
        F_HELP_ => "Vencimiento",
        F_TYPE_ => "date",
        F_BROW_ => "1",
        F_ORD_ => "70",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_saldo",
        F_ALIAS_ => "Saldo",
        F_HELP_ => "Saldo",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "80",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_suc",
        F_ALIAS_ => "Suc",
        F_HELP_ => "Suc",
        F_TYPE_ => "text",
        F_LENGTH_ => "4",
        F_BROW_ => "1",
        F_ORD_ => "100",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Pendiente,Cancelada",
        F_BROW_ => "1",
        F_ORD_ => "110",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "c_entrega",
        F_ALIAS_ => "Entrega",
        F_HELP_ => "Entrega",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "120",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

?>
