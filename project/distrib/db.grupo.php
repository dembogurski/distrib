<?php
$Obj->name = "grupo";
$Obj->alias = "Grupo";
$Obj->help = "Grupo";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "grupo";
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
        F_NAME_ => "g_cod",
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
        F_NAME_ => "g_nombre",
        F_ALIAS_ => "Grupo",
        F_HELP_ => "Grupo",
        F_TYPE_ => "text",
        F_LENGTH_ => "60",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "tipos",
        F_ALIAS_ => "Tipos de este Grupo",
        F_HELP_ => "Tipos de este Grupo",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'g_cod='+g_cod.getVal()",
        F_LINK_ => "db.tipos_x_grupo",
        F_SEND_ => "g_cod.getVal()",
        F_NODB_ => "1",
        F_ORD_ => "30",
        C_SHOW_ => "operation==CHANGE_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
