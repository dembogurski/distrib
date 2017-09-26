<?php
$Obj->name = "articulos_cons";
$Obj->alias = "Buscar Articulos";
$Obj->help = "Articulos";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "articulos";
$Obj->Filter = "db.articulos";
$Obj->Sort = "codigo asc";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "codigo",
        F_ALIAS_ => "Código",
        F_HELP_ => "Código del Articulo",
        F_TYPE_ => "text",       
        F_LENGTH_ => "20",
        F_BROW_ => "1",        
        F_ORD_ => "10",
        F_UNIQ_ => "1",       
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_barcode",
        F_ALIAS_ => "Cod. Barras",
        F_HELP_ => "Cod. Barras",
        F_TYPE_ => "text",
        F_LENGTH_ => "30",
        F_BROW_ => "1",
        F_ORD_ => "14",
        F_INLINE_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

 
$Obj->Add(
    array(
        F_NAME_ => "p_descrip",
        F_ALIAS_ => "Descipcion",
        F_HELP_ => "Descipcion",
        F_TYPE_ => "text",        
        F_LENGTH_ => "64",
        F_BROW_ => "1",        
        F_ORD_ => "45",
        F_UNIQ_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));


$Obj->Add(
    array(
        F_NAME_ => "p_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "%,Liberado,Bloqueado",
        F_LENGTH_ => "12",
        F_ORD_ => "58",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));


 	

?>
 