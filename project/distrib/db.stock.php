<?php
$Obj->name = "stock";
$Obj->alias = "Stock";
$Obj->help = "Stock";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "stock";
$Obj->Filter = "";
$Obj->Sort = "";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "1";
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
        F_ORD_ => "10",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "suc",
        F_ALIAS_ => "Almacen",
        F_HELP_ => "Almacen",
        F_TYPE_ => "text",
        F_LENGTH_ => "6",
        F_BROW_ => "1",
        F_ORD_ => "20",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "cantidad",
        F_ALIAS_ => "Cantidad",
        F_HELP_ => "Cantidad",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "30",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
