<?php
$Obj->name = "autonum__";
$Obj->alias = "__autonum__";
$Obj->help = "Controla los valores de campos autonuméricos";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "__autonum__";
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
        F_NAME_ => "name",
        F_ALIAS_ => "Nombre",
        F_HELP_ => "Nombre del campo Autonumérico",
        F_TYPE_ => "text",
        F_LENGTH_ => "50",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "2147483647",
        G_CHANGE_ => "2147483647"));

$Obj->Add(
    array(
        F_NAME_ => "value",
        F_ALIAS_ => "Valor",
        F_HELP_ => "Valor actual del campo",
        F_TYPE_ => "text",
        F_LENGTH_ => "50",
        F_BROW_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "2147483647",
        G_CHANGE_ => "2147483647"));

?>
