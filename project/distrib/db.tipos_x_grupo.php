<?php
$Obj->name = "tipos_x_grupo";
$Obj->alias = "Tipos de Tela x Grupo";
$Obj->help = "Tipos de Tela x Cada Grupo";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "tipos_x_grupo";
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
        F_ALIAS_ => "Grupo",
        F_HELP_ => "Codigo",
        F_TYPE_ => "text",
        F_LENGTH_ => "8",
        F_DEC_ => "0",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "b_tipo",
        F_ALIAS_ => "Buscar Tipo",
        F_HELP_ => "Buscar Tipo",
        F_TYPE_ => "text",
        F_NODB_ => "1",
        F_ORD_ => "16",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "ct_cod",
        F_ALIAS_ => "Codigo Tipo",
        F_HELP_ => "Codigo Tipo",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "b_tipo.hasChanged()",
        F_RELTABLE_ => "tipo",
        F_SHOWFIELD_ => "t_cod,t_nombre",
        F_FILTER_ => "'t_nombre like |{'+b_tipo.get()+'%}|'",
        F_BROW_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "ct_tipo",
        F_ALIAS_ => "Tipo",
        F_HELP_ => "Tipo",
        F_TYPE_ => "text",
        F_RELATION_ => "1",
        F_RELTABLE_ => "tipo",
        F_SHOWFIELD_ => "t_nombre",
        F_RELFIELD_ => "t_cod",
        F_LOCALFIELD_ => "ct_cod",
        F_BROW_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "30",
        C_VIEW_ => "operation=='BROWSE_'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
