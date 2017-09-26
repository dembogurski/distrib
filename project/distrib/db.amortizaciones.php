<?php
$Obj->name = "amortizaciones";
$Obj->alias = "Amortizaciones";
$Obj->help = "Amortizaciones";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "amortizaciones";
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
        F_NAME_ => "a_fact",
        F_ALIAS_ => "Factura",
        F_HELP_ => "Factura",
        F_TYPE_ => "text",
        F_LENGTH_ => "11",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "a_cuota",
        F_ALIAS_ => "Nro Cuota",
        F_HELP_ => "Nro Cuota",
        F_TYPE_ => "text",
        F_LENGTH_ => "3",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "a_fecha",
        F_ALIAS_ => "Fecha",
        F_HELP_ => "Fecha",
        F_TYPE_ => "date",
        F_BROW_ => "1",
        F_ORD_ => "30",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "a_comp",
        F_ALIAS_ => "Nro Doc Comprobante",
        F_HELP_ => "Nro Doc",
        F_TYPE_ => "text",
        F_MULTI_ => "1",
        F_LENGTH_ => "100",
        F_BROW_ => "1",
        F_ORD_ => "40",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "a_concepto",
        F_ALIAS_ => "Concepto",
        F_HELP_ => "Concepto",
        F_TYPE_ => "text",
        F_LENGTH_ => "3",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "46",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "a_compl",
        F_ALIAS_ => "Complemento",
        F_HELP_ => "Nro Doc Complementario",
        F_TYPE_ => "text",
        F_ORD_ => "47",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "a_saldo_ant",
        F_ALIAS_ => "Saldo Ant",
        F_HELP_ => "Saldo Anterior",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "a_monto",
        F_ALIAS_ => "Monto",
        F_HELP_ => "Monto",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "a_saldo",
        F_ALIAS_ => "Saldo",
        F_HELP_ => "Saldo",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

?>
