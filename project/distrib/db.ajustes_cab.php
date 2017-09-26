<?php
/** project/delavictoria/db.ajustes_cab.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "ajustes_cab";
$Obj->alias = "Ajustar Producto";
$Obj->help = "Ajustar Producto";
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
        F_ALIAS_ => "Desabilita el boton Consult",
        F_HELP_ => "Desabilita el boton Consult",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "4",
        C_SHOW_ => "__lock.firstSQL",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton()",
        G_SHOW_ => "60",
        G_CHANGE_ => "60"));

 
$Obj->Add(
    array(
        F_NAME_ => "codigo",
        F_ALIAS_ => "Código",
        F_HELP_ => "Código del Producto a fraccionar",
        F_TYPE_ => "text",
        F_LENGTH_ => "12",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "60",
        G_CHANGE_ => "60"));
 
 

$Obj->Add(
    array(
        F_NAME_ => "descrip",
        F_ALIAS_ => "Descripcion",
        F_HELP_ => "Descripcion",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT CONCAT( s.s_nombre,|{-}|, g.g_nombre,|{-}|,t.t_nombre,|{-}|,c.color),p_cant,p_suc FROM productos p, sector s, grupo g, tipo t, colores c WHERE  p.p_sector = s.s_cod AND p.p_grupo = g.g_cod AND p.p_tipo = t.t_cod AND p.p_color = c.c_cod and p.p_cod = '+codigo.getVal()",
        F_QUERY_REF_ => "codigo.hasChanged()||operation==CONSULT_",
        F_SHOWFIELD_ => "s_nombre",
        F_LOCALFIELD_ => "d_fact",
        F_LENGTH_ => "80",
        F_BROW_ => "1",
        F_ORD_ => "20",
        F_INLINE_ => "1",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_cant",
        F_ALIAS_ => "Cantidad en Stock",
        F_HELP_ => "Cantidad en Stock",
        F_TYPE_ => "formula",
        F_LENGTH_ => "8",
        F_NODB_ => "1",
        F_ORD_ => "40",
        F_FORMULA_ => "db('p_cant')",
        G_SHOW_ => "60",
        G_CHANGE_ => "60"));

$Obj->Add(
    array(
        F_NAME_ => "suc",
        F_ALIAS_ => "Sucursal",
        F_HELP_ => "Sucursal",
        F_TYPE_ => "formula",
        F_LENGTH_ => "4",
        F_NODB_ => "1",
        F_ORD_ => "45",
        F_INLINE_ => "1",
        F_FORMULA_ => "db('p_suc')",
        G_SHOW_ => "60",
        G_CHANGE_ => "60"));
  



$Obj->Add(
    array(
        F_NAME_ => "sub_ajuste",
        F_ALIAS_ => "Ajustes",
        F_HELP_ => "Ajustes de Mercaderia",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'aj_prod='+codigo.getVal()",
        F_LINK_ => "db.ajustes",
        F_SEND_ => "codigo.getVal()",
        F_BROW_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "70",
        C_SHOW_ => "codigo.get()!=''&&descrip.get()!='__NO DATA__'",
        C_VIEW_ => "operation!=INSERT_",
        G_SHOW_ => "60",
        G_CHANGE_ => "60"));
?>
