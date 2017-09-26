<?php
$Obj->name = "lista_precios";
$Obj->alias = "Listas de Precios";
$Obj->help = "Listas de Precios";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "lista_precios";
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
        F_NAME_ => "codigo",
        F_ALIAS_ => "Código",
        F_HELP_ => "Código del Articulo",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "10",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "num",
        F_ALIAS_ => "Numero Lista",
        F_HELP_ => "Numero Lista",
        F_TYPE_ => "text",
        F_LENGTH_ => "2",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "20",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "precio_unit",
        F_ALIAS_ => "Precio Unitario",
        F_HELP_ => "Precio Unitario",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "30",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "__lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "40",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableDeleteButton() ",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
