<?php
$Obj->name = "caja_monedas";
$Obj->alias = "Monedas";
$Obj->help = "Control de Monedas";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "caja_monedas";
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
        F_NAME_ => "m_cod",
        F_ALIAS_ => "Codigo",
        F_HELP_ => "Codigo de la moneda",
        F_TYPE_ => "text",
        F_LENGTH_ => "5",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "m_descri",
        F_ALIAS_ => "Descripcion",
        F_HELP_ => "Descripcion de la Moneda",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "m_ref",
        F_ALIAS_ => "Referencia",
        F_HELP_ => "Si es la Unidad Referencial",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "No,Si",
        F_LENGTH_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "30",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

?>
