<?php
$Obj->name = "rep_comport_cli";
$Obj->alias = "Reporte de Comportamiento de Clientes";
$Obj->help = "Reporte de Comportamiento de Clientes";
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
        F_NAME_ => "f_lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "4",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton() ; disableDeleteButton();  ",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_b_cli",
        F_ALIAS_ => "Buscar Cliente",
        F_HELP_ => "Buscar Cliente",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_NODB_ => "1",
        F_ORD_ => "20", 
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_cli_cod",
        F_ALIAS_ => "Cliente",
        F_HELP_ => "Cliente",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "f_b_cli.hasChanged() && operation==CONSULT_",
        F_OPTIONS_ => "",
		F_NODB_ => "1",
        F_RELTABLE_ => "clientes",
        F_SHOWFIELD_ => "cli_id,concat(cli_nombre,|{   }|,cli_tipo_doc,|{: }|,cli_ci)",
        F_FILTER_ => "'cli_ci like |{'+f_b_cli.get()+'%}| or cli_nombre like |{'+f_b_cli.get()+'%}| LIMIT 26' ",
        F_ORD_ => "30",
        F_INLINE_ => "1",
        V_DEFAULT_ => "'Buscar Anonimo'",
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
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "hasta",
        F_ALIAS_ => "Fecha hasta",
        F_HELP_ => "Fecha hasta",
        F_TYPE_ => "date",
        F_NODB_ => "1",
        F_ORD_ => "50",
        V_DEFAULT_ => "thisDate_",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));		
		
$Obj->Add(
    array(
        F_NAME_ => "f_rep",
        F_ALIAS_ => "Ver Reporte",
        F_HELP_ => "Ver Reporte",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.comport_cli",
        F_NODB_ => "1",
        F_ORD_ => "60",        
        C_SHOW_ => "f_cli_cod.getVal() > 0 && desde.get()!= '' && hasta.get()!= ''",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));		

?>
