<?php
$Obj->name = "parametros";
$Obj->alias = "Parametros Globales";
$Obj->help = "Parametros Globales";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "parametros";
$Obj->Filter = "";
$Obj->Sort = "clave asc";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "clave",
        F_ALIAS_ => "Clave",
        F_HELP_ => "Clave",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "valor",
        F_ALIAS_ => "Valor",
        F_HELP_ => "Valor",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "descrip",
        F_ALIAS_ => "Descripcion",
        F_HELP_ => "Descipcion",
        F_TYPE_ => "text",
        F_LENGTH_ => "100",
        F_BROW_ => "1",
        F_ORD_ => "30",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));
		
$Obj->Add(
    array(
        F_NAME_ => "p_noDel",
        F_ALIAS_ => "Bloquea el boton Delete",
        F_HELP_ => "Bloquea el boton Delete",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "4",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableDeleteButton()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));		

?>
