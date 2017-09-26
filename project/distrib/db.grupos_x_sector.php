<?php
$Obj->name = "grupos_x_sector";
$Obj->alias = "Grupos x Sector";
$Obj->help = "Grupos x Sector";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "grupos_x_sector";
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
        F_ALIAS_ => "Sector",
        F_HELP_ => "Código",
        F_TYPE_ => "text",
        F_OPTIONS_ => "DB",
        F_LENGTH_ => "8",
        F_DEC_ => "0",
        F_REQUIRED_ => "1",
        F_ORD_ => "10",        
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "gc_cod",
        F_ALIAS_ => "Codigo",
        F_HELP_ => "Codigo",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "grupo",
        F_SHOWFIELD_ => "g_cod,g_nombre",
        F_LENGTH_ => "8",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "grupo",
        F_ALIAS_ => "Grupo",
        F_HELP_ => "Grupo",
        F_TYPE_ => "text",
        F_RELATION_ => "1",
        F_RELTABLE_ => "grupo",
        F_SHOWFIELD_ => "g_nombre",
        F_RELFIELD_ => "g_cod",
        F_LOCALFIELD_ => "gc_cod",
        F_BROW_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "30",
        C_VIEW_ => "operation==BROWSE_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
