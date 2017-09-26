<?php
$Obj->name = "categorias";
$Obj->alias = "Categorias";
$Obj->help = "Categorias de Cliente";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "categorias";
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
        F_NAME_ => "cat_code",
        F_ALIAS_ => "Código de Categoria",
        F_HELP_ => "Código de Categoria",
        F_TYPE_ => "text",
        F_LENGTH_ => "1",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "cat_descrip",
        F_ALIAS_ => "Descripción",
        F_HELP_ => "Descripción",
        F_TYPE_ => "text",
        F_LENGTH_ => "30",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
