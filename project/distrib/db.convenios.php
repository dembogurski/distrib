<?php
$Obj->name = "convenios";
$Obj->alias = "Convenios de la Empresa";
$Obj->help = "Convenios de la Empresa";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "convenios";
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
        F_NAME_ => "conv_cod",
        F_ALIAS_ => "Codigo de Convenio",
        F_HELP_ => "Codigo de Convenio",
        F_TYPE_ => "text",
        F_LENGTH_ => "4",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "conv_nombre",
        F_ALIAS_ => "Convenio",
        F_HELP_ => "Nombre del Convenio",
        F_TYPE_ => "text",
        F_LENGTH_ => "50",
        F_BROW_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "conv_tipo",
        F_ALIAS_ => "Tipo",
        F_HELP_ => "Tipo de Convenio",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Tarjeta de Credito,Tarjeta Debito,Convenio",
        F_BROW_ => "1",
        F_ORD_ => "30",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "conv_porc",
        F_ALIAS_ => "Porsentaje",
        F_HELP_ => "Porsentaje",
        F_TYPE_ => "text",
        F_LENGTH_ => "10",
        F_DEC_ => "6",
        F_BROW_ => "1",
        F_ORD_ => "40",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "conv_dias_acr",
        F_ALIAS_ => "Dias p/acreditacion",
        F_HELP_ => "Dias p/acreditacion",
        F_TYPE_ => "text",
        F_LENGTH_ => "4",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
