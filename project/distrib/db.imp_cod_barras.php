<?php
$Obj->name = "imp_cod_barras";
$Obj->alias = "Imprimir Codigo de Barras";
$Obj->help = "Imprimir Codigo de Barras";
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
        F_NAME_ => "__lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "10",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton() ",
        G_SHOW_ => "128",
        G_CHANGE_ => "128"));

$Obj->Add(
    array(
        F_NAME_ => "c_codigo",
        F_ALIAS_ => "Código",
        F_HELP_ => "Código",
        F_TYPE_ => "text",
        F_OPTIONS_ => "DB",
        F_LENGTH_ => "10",
        F_BROW_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_ref",
        F_ALIAS_ => "Ref",
        F_HELP_ => "Ref.",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT p_ref FROM productos p  WHERE p.p_cod = '+c_codigo.getVal()",
        F_QUERY_REF_ => "c_codigo.hasChanged()",
        F_LENGTH_ => "80",
        F_NODB_ => "1",
        F_ORD_ => "30",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_descrip",
        F_ALIAS_ => "Descripcion",
        F_HELP_ => "Descripcion",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT CONCAT( s.s_nombre,|{-}|, g.g_nombre,|{-}|,t.t_nombre,|{-}|,c.color) FROM productos p, sector s, grupo g, tipo t, colores c WHERE  p.p_sector = s.s_cod AND p.p_grupo = g.g_cod AND p.p_tipo = t.t_cod AND p.p_color = c.c_cod and p.p_cod = '+c_codigo.getVal()",
        F_QUERY_REF_ => "c_codigo.hasChanged()",
        F_LENGTH_ => "80",
        F_NODB_ => "1",
        F_ORD_ => "40",
         
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_print",
        F_ALIAS_ => "Imprimir",
        F_HELP_ => "Imprimir",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.barcode",
        F_NODB_ => "1",
        F_ORD_ => "50",
        C_VIEW_ => "c_descrip.get()!='__NO DATA__'&&c_codigo.getVal()>0",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
