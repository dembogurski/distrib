<?php
$Obj->name = "usuarios";
$Obj->alias = "Funcionarios";
$Obj->help = "Lista de Funcionarios (Usuarios del Sistema)";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "p_users";
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
        F_NAME_ => "nro_usuario",
        F_ALIAS_ => "ID",
        F_HELP_ => "Codigo de Funcionario",
        F_TYPE_ => "text",
        F_AUTONUM_ => "1",
        F_OPTIONS_ => "DB",
        F_BROW_ => "1",
        F_ORD_ => "3",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "name",
        F_ALIAS_ => "Nombre p/Acceso",
        F_HELP_ => "Nombre de Usuario para acceso al Sistema.",
        F_TYPE_ => "text",
        F_LENGTH_ => "40",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "nombre",
        F_ALIAS_ => "Nombre Completo",
        F_HELP_ => "Apellido y Nombre Socio",
        F_TYPE_ => "text",
        F_LENGTH_ => "80",
        F_BROW_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "local",
        F_ALIAS_ => "Sucursal",
        F_HELP_ => "Sucursal Donde Trabaja",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "empresas",
        F_SHOWFIELD_ => "emp_cod,emp_nombre",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "26",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "ci",
        F_ALIAS_ => "C.I.",
        F_HELP_ => "C.I.",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_ORD_ => "30",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "tel",
        F_ALIAS_ => "Telefonos",
        F_HELP_ => "Telefonos",
        F_TYPE_ => "text",
        F_LENGTH_ => "60",
        F_BROW_ => "1",
        F_ORD_ => "40",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "email",
        F_ALIAS_ => "Email",
        F_HELP_ => "Email",
        F_TYPE_ => "text",
        F_LENGTH_ => "80",
        F_BROW_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Activo,Inactivo",
        F_BROW_ => "1",
        F_ORD_ => "60",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "__nodelete",
        F_ALIAS_ => "Disable delete Button",
        F_HELP_ => "Disable delete Button",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "70",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableDeleteButton()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

 

?>
