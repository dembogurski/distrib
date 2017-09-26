<?php
$Obj->name = "caja_cambios";
$Obj->alias = "Cotizaciones";
$Obj->help = "Control de Cotizaciones";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "caja_cambios";
$Obj->Filter = "";
$Obj->Sort = "cb_fecha DESC";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "cb_fecha",
        F_ALIAS_ => "Fecha",
        F_HELP_ => "Fecha del cambio",
        F_TYPE_ => "date",
        F_LENGTH_ => "10",
        F_BROW_ => "1",
        F_ORD_ => "10",
        V_DEFAULT_ => "thisDate_",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cb_moneda",
        F_ALIAS_ => "Moneda",
        F_HELP_ => "Moneda utilizada",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "caja_monedas",
        F_SHOWFIELD_ => "m_descri",
        F_FILTER_ => "'m_ref!=|{Si}|'",
        F_LENGTH_ => "5",
        F_BROW_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cb_compra",
        F_ALIAS_ => "Compra",
        F_HELP_ => "Valor para Compra",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT cb_compra FROM caja_cambios WHERE cb_fecha<='+cb_fecha.getStr()+' AND cb_moneda='+cb_moneda.getStr()+' ORDER BY cb_fecha DESC'",
        F_QUERY_REF_ => "cb_moneda.hasChanged()||cb_fecha.hasChanged()",
        F_LENGTH_ => "15",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "30",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cb_venta",
        F_ALIAS_ => "Venta",
        F_HELP_ => "Valor para Venta",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT cb_venta FROM caja_cambios WHERE cb_fecha<='+cb_fecha.getStr()+' AND cb_moneda='+cb_moneda.getStr()+' ORDER BY cb_fecha DESC'",
        F_QUERY_REF_ => "cb_moneda.hasChanged()||cb_fecha.hasChanged()",
        F_LENGTH_ => "15",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "40",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cb_ref",
        F_ALIAS_ => "Referencia",
        F_HELP_ => "Referencia",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT m_cod FROM caja_monedas WHERE m_ref=|{Si}| LIMIT 1'",
        F_QUERY_REF_ => "el['cb_ref'].firstSQL",
        F_LENGTH_ => "5",
        F_BROW_ => "1",
        F_ORD_ => "50",
        C_CHANGE_ => "false",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

?>
