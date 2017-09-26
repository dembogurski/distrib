<?php
$Obj->name = "sector";
$Obj->alias = "Sector";
$Obj->help = "Sector";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "sector";
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
        F_NAME_ => "s_cod",
        F_ALIAS_ => "Código",
        F_HELP_ => "Código",
        F_TYPE_ => "text",
        F_AUTONUM_ => "1",
        F_OPTIONS_ => "DB",
        F_LENGTH_ => "8",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "s_nombre",
        F_ALIAS_ => "Nombre",
        F_HELP_ => "Nombre del Sector",
        F_TYPE_ => "text",
        F_LENGTH_ => "40",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "grupos",
        F_ALIAS_ => "Grupos",
        F_HELP_ => "Grupos",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'s_cod='+s_cod.getVal()",
        F_LINK_ => "db.grupos_x_sector",
        F_SEND_ => "s_cod.getVal()",
        F_NODB_ => "1",
        F_ORD_ => "30",
        C_SHOW_ => "operation==CHANGE_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
