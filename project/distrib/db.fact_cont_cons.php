<?php
$Obj->name = "fact_cont_cons";
$Obj->alias = "Factura Contable";
$Obj->help = "Factura Contable";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "db.fact_cont_res";
$Obj->Filter = "db.fact_cont_res";
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
        F_NAME_ => "f_suc",
        F_ALIAS_ => "SUC",
        F_HELP_ => "SUC",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "empresas",	
		F_OPTIONS_ => "%",		
        F_SHOWFIELD_ => "emp_cod,emp_nombre",
        F_FILTER_ => "'true order by emp_cod asc'",
        F_LENGTH_ => "4",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_pdv",
        F_ALIAS_ => "Punto de Venta",
        F_HELP_ => "Punto de Venta",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "f_suc.hasChanged()",
        F_OPTIONS_ => "%",
        F_RELTABLE_ => "pdv",
        F_SHOWFIELD_ => "p_cod,p_ubic",
        F_FILTER_ => "'p_suc='+f_suc.getStr()",
        F_LENGTH_ => "6",
        F_BROW_ => "1",        
        F_ORD_ => "12",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_nro",
        F_ALIAS_ => "Nro Factura Legal",
        F_HELP_ => "Nro",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_ORD_ => "30",
        V_DEFAULT_ => "'%'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_ref",
        F_ALIAS_ => "Ticket Nro",
        F_HELP_ => "Nro REF o Ticket",
        F_TYPE_ => "text",
        F_LENGTH_ => "14",
        F_ORD_ => "35",
        V_DEFAULT_ => "'%'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "%,Disponible,Cerrada,Anulada",
        F_BROW_ => "1",
        F_ORD_ => "70",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
