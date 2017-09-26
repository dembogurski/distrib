<?php
$Obj->name = "fact_cont";
$Obj->alias = "Factura Contable";
$Obj->help = "Factura Contable";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "fact_cont";
$Obj->Filter = "";
$Obj->Sort = "";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "1";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "__lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "4",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableDeleteButton()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_suc",
        F_ALIAS_ => "SUC",
        F_HELP_ => "SUC",
        F_TYPE_ => "text",
        F_LENGTH_ => "8",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_user",
        F_ALIAS_ => "Usuario",
        F_HELP_ => "Usuario",
        F_TYPE_ => "text",
        F_LENGTH_ => "30",
        F_BROW_ => "1",
        F_ORD_ => "20",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_nro",
        F_ALIAS_ => "Nro",
        F_HELP_ => "Nro",
        F_TYPE_ => "text",
        F_LENGTH_ => "30",
        F_BROW_ => "1",
        F_ORD_ => "30",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_ref",
        F_ALIAS_ => "Nro REF",
        F_HELP_ => "Nro REF o Factura",
        F_TYPE_ => "text",
        F_LENGTH_ => "14",
        F_ORD_ => "35",
        V_DEFAULT_ => "'%'",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_pdv",
        F_ALIAS_ => "Punto de Venta",
        F_HELP_ => "Punto de Venta",
        F_TYPE_ => "text",
        F_LENGTH_ => "6",
        F_BROW_ => "1",
        F_ORD_ => "40",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_fecha",
        F_ALIAS_ => "Fecha de Carga",
        F_HELP_ => "Fecha",
        F_TYPE_ => "date",
        F_BROW_ => "1",
        F_ORD_ => "50",
        V_DEFAULT_ => "thisDate_",
        C_VIEW_ => "operation!=INSERT_",
        C_CHANGE_ => "false",
        G_SHOW_ => "60",
        G_CHANGE_ => "60"));

$Obj->Add(
    array(
        F_NAME_ => "f_ruc",
        F_ALIAS_ => "R.U.C.",
        F_HELP_ => "R.U.C.",
        F_TYPE_ => "text",
        F_LENGTH_ => "40",
        F_BROW_ => "1",
        F_ORD_ => "60",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Disponible,Cerrada,Anulada",
        F_BROW_ => "1",
        F_ORD_ => "70",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_mot_anul",
        F_ALIAS_ => "Motivo Anulacion",
        F_HELP_ => "Motivo Anulacion",
        F_TYPE_ => "text",
        F_MULTI_ => "1",
        F_LENGTH_ => "400",
        F_ORD_ => "80",
        C_VIEW_ => "f_estado.get()=='Anulada'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_total",
        F_ALIAS_ => "Total de Factura",
        F_HELP_ => "Total de Factura",
        F_TYPE_ => "text",
        F_LENGTH_ => "18",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "90",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_venc",
        F_ALIAS_ => "Fecha de Vencimiento",
        F_HELP_ => "Fecha de Vencimiento",
        F_TYPE_ => "date",
        F_BROW_ => "1",
        F_ORD_ => "100",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_tipo",
        F_ALIAS_ => "Tipo",
        F_HELP_ => "Tipo",
        F_TYPE_ => "text",
        F_LENGTH_ => "14",
        F_BROW_ => "1",
        F_ORD_ => "110",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
