<?php
$Obj->name = "rep_stock";
$Obj->alias = "Reportes de Stock";
$Obj->help = "Reportes de Stock";
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
        F_NAME_ => "p_lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "4",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton() ",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "d_buscar",
        F_ALIAS_ => "Buscar:",
        F_HELP_ => "Buscar por Codigo o Descripcion",
        F_TYPE_ => "text",
        F_LENGTH_ => "40",
        F_NODB_ => "1",
        F_ORD_ => "10",         
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_codigo",
        F_ALIAS_ => "Codigo",
        F_HELP_ => "Codigo",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "d_buscar.hasChanged()",
        F_RELTABLE_ => "articulos",
		F_OPTIONS_ => "%",
        F_SHOWFIELD_ => "codigo,p_descrip",
        F_FILTER_ => "' codigo =  |{'+d_buscar.get()+'}| OR p_descrip LIKE |{'+d_buscar.get()+'%}| OR p_barcode = |{'+d_buscar.get()+'}| '",
        F_LENGTH_ => "14",
		F_NODB_ => "1",
        F_BROW_ => "1",
        F_ORD_ => "10",
        C_CHANGE_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));
		
 

$Obj->Add(
    array(
        F_NAME_ => "p_cant",
        F_ALIAS_ => "Cantidad en Stock > que:",
        F_HELP_ => "Cantidad en Stock",
        F_TYPE_ => "text",
        F_LENGTH_ => "4",
        F_DEC_ => "0",
        F_NODB_ => "1",
        F_ORD_ => "77",         
        V_DEFAULT_ => "'0'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_rep",
        F_ALIAS_ => "Generar Reporte de Stock General Detallado",
        F_HELP_ => "Generar Reporte de Stock General",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.stock",
        F_NODB_ => "1",
        F_ORD_ => "100",
        C_SHOW_ => "d_codigo.get()!=''",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
