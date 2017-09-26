<?php
$Obj->name = "empresas";
$Obj->alias = "Empresas";
$Obj->help = "Empresas del Sistema";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "empresas";
$Obj->Filter = "";
$Obj->Sort = "";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "";
$Obj->Noedit = "";
$Obj->NoInsert = "";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "emp_cod",
        F_ALIAS_ => "Codigo",
        F_HELP_ => "Codigo de a empresa",
        F_TYPE_ => "text",
        F_LENGTH_ => "2",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "emp_nombre",
        F_ALIAS_ => "Nombre",
        F_HELP_ => "Nombre de la Empresa",
        F_TYPE_ => "text",
        F_LENGTH_ => "60",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "emp_tipo",
        F_ALIAS_ => "Tipo",
        F_HELP_ => "Tipo de Empresa",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Casa Matriz,Sucursal,Agencia,Deposito",
        F_REQUIRED_ => "1",
        F_ORD_ => "24",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "emp_ruc",
        F_ALIAS_ => "RUC",
        F_HELP_ => "RUC de la Empresa",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_ORD_ => "30",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "emp_ciudad",
        F_ALIAS_ => "Ciudad",
        F_HELP_ => "Ciudad",
        F_TYPE_ => "text",
        F_LENGTH_ => "40",
        F_BROW_ => "1",
        F_ORD_ => "36",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "emp_dir",
        F_ALIAS_ => "Direccion",
        F_HELP_ => "Direccion de la empresa",
        F_TYPE_ => "text",
        F_LENGTH_ => "60",
        F_BROW_ => "1",
        F_ORD_ => "40",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "emp_tel",
        F_ALIAS_ => "Telefono",
        F_HELP_ => "Telefono de la empresa",
        F_TYPE_ => "text",
        F_LENGTH_ => "30",
        F_BROW_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "emp_mail",
        F_ALIAS_ => "Mail",
        F_HELP_ => "Mail de la empresa",
        F_TYPE_ => "text",
        F_LENGTH_ => "30",
        F_BROW_ => "1",
        F_ORD_ => "60",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "emp_web",
        F_ALIAS_ => "Web",
        F_HELP_ => "Direccion Web",
        F_TYPE_ => "text",
        F_LENGTH_ => "40",
        F_BROW_ => "1",
        F_ORD_ => "70",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "emp_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Activo,Inactivo",
        F_BROW_ => "1",
        F_ORD_ => "80",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

?>
