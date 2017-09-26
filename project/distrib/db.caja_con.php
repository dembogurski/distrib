<?php
$Obj->name = "caja_con";
$Obj->alias = "Conceptos";
$Obj->help = "Conceptos de Caja";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "caja_con";
$Obj->Filter = "";
$Obj->Sort = "cjc_cod";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "cjc_cod",
        F_ALIAS_ => "Codigo",
        F_HELP_ => "Codigo del concepto",
        F_TYPE_ => "text",
        F_AUTONUM_ => "1",
        F_OPTIONS_ => "DB",
        F_LENGTH_ => "3",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cjc_descri",
        F_ALIAS_ => "Descripción",
        F_HELP_ => "Descripción del concepto",
        F_TYPE_ => "text",
        F_LENGTH_ => "40",
        F_BROW_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cjc_compl",
        F_ALIAS_ => "Complemento",
        F_HELP_ => "Complemento",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "No,Si",
        F_LENGTH_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "30",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cjc_tipo",
        F_ALIAS_ => "Tipo",
        F_HELP_ => "Tipo de asiento",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "E,S",
        F_LENGTH_ => "1",
        F_BROW_ => "1",
        F_ORD_ => "40",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cjc_autom",
        F_ALIAS_ => "Automático",
        F_HELP_ => "Asiento Automático solo el sistema puede preparar",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "No,Si",
        F_LENGTH_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cjc_gasto",
        F_ALIAS_ => "Considerado como Gasto",
        F_HELP_ => "Considerado como Gasto",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "No,Si",
        F_BROW_ => "1",
        F_ORD_ => "60",
        V_DEFAULT_ => "'No'",
        C_VIEW_ => "cjc_tipo.get()=='S'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
