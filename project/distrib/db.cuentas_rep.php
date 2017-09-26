<?php
$Obj->name = "cuentas_rep";
$Obj->alias = "Historial de Cuentas de Clientes";
$Obj->help = "Historial de Cuentas de Clientes";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "tmp";
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
        F_NAME_ => "c_lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "4",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton() ; ",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_busc",
        F_ALIAS_ => "Buscar Cliente",
        F_HELP_ => "Buscar Cliente",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_cli_cod",
        F_ALIAS_ => "Cliente",
        F_HELP_ => "Cliente",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "c_busc.hasChanged()",
        F_OPTIONS_ => "%",
        F_RELTABLE_ => "clientes",
        F_SHOWFIELD_ => "cli_id,concat(cli_nombre,|{   }|,cli_tipo_doc,|{: }|,cli_ci)",
        F_FILTER_ => "'cli_ci like |{'+c_busc.get()+'%}| or cli_nombre like |{'+c_busc.get()+'%}| LIMIT 26' ",
        F_ORD_ => "30",
        F_INLINE_ => "1",
        V_DEFAULT_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "desde",
        F_ALIAS_ => "Fecha desde",
        F_HELP_ => "Fecha desde",
        F_TYPE_ => "date",
        F_NODB_ => "1",
        F_ORD_ => "40",
        V_DEFAULT_ => "thisDate_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "hasta",
        F_ALIAS_ => "Fecha hasta",
        F_HELP_ => "Fecha hasta",
        F_TYPE_ => "date",
        F_NODB_ => "1",
        F_ORD_ => "50",
        V_DEFAULT_ => "thisDate_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "tipo",
        F_ALIAS_ => "Tipo de Reporte",
        F_HELP_ => "Tipo de Reporte",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Historial de Credito,Porcentaje Contado Vs Credito",
        F_NODB_ => "1",
        F_ORD_ => "54",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "estado",
        F_ALIAS_ => "Estado de las Cuotas",
        F_HELP_ => "Estado",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "%,Pendiente,Cancelada",
        F_NODB_ => "1",
        F_ORD_ => "58",
        C_SHOW_ => "tipo.get()=='Historial de Credito'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "vp",
        F_ALIAS_ => "Vista Previa/Impresion",
        F_HELP_ => "Vista Previa/Impresion",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Vista Previa,Imprimir",
        F_NODB_ => "1",
        F_ORD_ => "60",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "rep",
        F_ALIAS_ => "Ver Historial de Cliente",
        F_HELP_ => "Ver Historial de Cliente",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.ventas_credito",
        F_NODB_ => "1",
        F_ORD_ => "100",
        F_INLINE_ => "1",
        C_SHOW_ => "tipo.get()=='Historial de Credito'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "rep_p",
        F_ALIAS_ => "Reporte de Porcentajes Contado Vs Credito",
        F_HELP_ => "Reporte de Porcentajes Contado Vs Credito",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.porc_cont_cred",
        F_NODB_ => "1",
        F_ORD_ => "110",
        C_SHOW_ => "tipo.get()=='Porcentaje Contado Vs Credito'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
