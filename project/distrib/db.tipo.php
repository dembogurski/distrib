<?php
$Obj->name = "tipo";
$Obj->alias = "Sub-Grupo";
$Obj->help = "Sub-Grupo";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "tipo";
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
        F_NAME_ => "t_cod",
        F_ALIAS_ => "Código",
        F_HELP_ => "Codigo",
        F_TYPE_ => "text",
        F_AUTONUM_ => "1",
        F_OPTIONS_ => "DB",
        F_LENGTH_ => "8",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "t_nombre",
        F_ALIAS_ => "Sub-Grupo",
        F_HELP_ => "Nombre del Tipo",
        F_TYPE_ => "text",
        F_LENGTH_ => "60",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

?>
