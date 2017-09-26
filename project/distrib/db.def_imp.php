<?php
$Obj->name = "def_imp";
$Obj->alias = "Definicion de Impuestos";
$Obj->help = "Definicion de Impuestos";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "def_imp";
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
        F_NAME_ => "imp_cod",
        F_ALIAS_ => "Codigo Impuesto",
        F_HELP_ => "Codigo Impuesto",
        F_TYPE_ => "text",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "valor",
        F_ALIAS_ => "Valor",
        F_HELP_ => "Valor",
        F_TYPE_ => "text",
        F_LENGTH_ => "8",
        F_BROW_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
