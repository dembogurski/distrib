<?php
$Obj->name = "bcos";
$Obj->alias = "Bancos";
$Obj->help = "Control de Bancos";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "bcos";
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
        F_NAME_ => "b_cod",
        F_ALIAS_ => "Codigo",
        F_HELP_ => "Codigo del Banco",
        F_TYPE_ => "text",
        F_LENGTH_ => "10",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "b_nombre",
        F_ALIAS_ => "Nombre",
        F_HELP_ => "Nombre del Banco",
        F_TYPE_ => "text",
        F_LENGTH_ => "60",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "b_direccion",
        F_ALIAS_ => "Direccion",
        F_HELP_ => "Direccion",
        F_TYPE_ => "text",
        F_LENGTH_ => "60",
        F_ORD_ => "30",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "b_tel",
        F_ALIAS_ => "Telefono",
        F_HELP_ => "Telefono del Banco",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_ORD_ => "40",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "b_contacto",
        F_ALIAS_ => "Contacto",
        F_HELP_ => "Persona normalmente contactada",
        F_TYPE_ => "text",
        F_LENGTH_ => "60",
        F_BROW_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "b_mail",
        F_ALIAS_ => "e-mail",
        F_HELP_ => "e-mail del Banco",
        F_TYPE_ => "text",
        F_LENGTH_ => "40",
        F_ORD_ => "60",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "b_web",
        F_ALIAS_ => "Página",
        F_HELP_ => "Página Web del Banco",
        F_TYPE_ => "text",
        F_LENGTH_ => "40",
        F_ORD_ => "70",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
