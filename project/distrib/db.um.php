<?php
$Obj->name = "um";
$Obj->alias = "Unidades de Medida";
$Obj->help = "Unidades de Medida";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "um";
$Obj->Filter = "";
$Obj->Sort = "u_prior asc,u_ref,u_descri";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "";
$Obj->Limit = "100";
$Obj->Add(
    array(
        F_NAME_ => "u_cod",
        F_ALIAS_ => "Unidad",
        F_HELP_ => "Código de la Unidad de Medida",
        F_TYPE_ => "text",
        F_LENGTH_ => "10",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "10",
        F_UNIQ_ => "1",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "u_descri",
        F_ALIAS_ => "Descripción",
        F_HELP_ => "Descripción",
        F_TYPE_ => "text",
        F_LENGTH_ => "40",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "u_ref",
        F_ALIAS_ => "Referencia",
        F_HELP_ => "Referencia a Otra Unidad de Medida",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "um",
        F_SHOWFIELD_ => "u_descri",
        F_FILTER_ => "'u_mult=1'",
        F_LENGTH_ => "5",
        F_BROW_ => "1",
        F_ORD_ => "30",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "u_mult",
        F_ALIAS_ => "Multiplicador",
        F_HELP_ => "Multiplicador ",
        F_TYPE_ => "text",
        F_LENGTH_ => "15",
        F_DEC_ => "3",
        F_BROW_ => "1",
        F_ORD_ => "40",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "u_prior",
        F_ALIAS_ => "Prioridad",
        F_HELP_ => "Prioridad en las Listas",
        F_TYPE_ => "text",
        F_LENGTH_ => "4",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "u_nodel",
        F_ALIAS_ => "Disable Delete",
        F_HELP_ => "Disable Delete",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "60",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableDeleteButton()",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

?>
