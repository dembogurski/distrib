<?php
$Obj->name = "fact_vent_det";
$Obj->alias = "Detalle de Factura";
$Obj->help = "Detalle de Factura de Venta";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "fact_vent_det";
$Obj->Filter = "";
$Obj->Sort = "";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "1";
$Obj->NoInsert = "1";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "d_fact",
        F_ALIAS_ => "N° Factura",
        F_HELP_ => "N° Factura",
        F_TYPE_ => "text",
        F_LENGTH_ => "12",
        F_DEC_ => "0",
        F_ORD_ => "4",
        C_VIEW_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_limit",
        F_ALIAS_ => "Check Limit",
        F_HELP_ => "Check Limit",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT COUNT(*) >= '+sup['f_limit']+' FROM fact_vent_det WHERE d_fact = '+d_fact.getVal()",
        F_QUERY_REF_ => "d_limit.firstSQL",
        F_NODB_ => "1",
        F_ORD_ => "6",
        C_VIEW_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_codigo",
        F_ALIAS_ => "Codigo",
        F_HELP_ => "Codigo",
        F_TYPE_ => "text",
        F_LENGTH_ => "14",
		C_CHANGE_ => "operation==INSERT_",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_descrip",
        F_ALIAS_ => "Descripcion",
        F_HELP_ => "Descripcion",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT CONCAT( s.s_nombre,|{-}|, g.g_nombre,|{-}|,t.t_nombre,|{-}|,c.color) FROM productos p, sector s, grupo g, tipo t, colores c WHERE  p.p_sector = s.s_cod AND p.p_grupo = g.g_cod AND p.p_tipo = t.t_cod AND p.p_color = c.c_cod and p.p_cod = '+d_codigo.getVal()",
        F_QUERY_REF_ => "d_codigo.hasChanged()||operation==BROWSE_",
        F_SHOWFIELD_ => "s_nombre",
        F_LOCALFIELD_ => "d_fact",
        F_LENGTH_ => "80",
        F_BROW_ => "1",
        F_ORD_ => "20",
        F_INLINE_ => "1",
        C_CHANGE_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_check_dupli",
        F_ALIAS_ => "Check Duplicate",
        F_HELP_ => "Check Duplicate",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT COUNT(*) FROM fact_vent_det WHERE d_fact = '+d_fact.getVal()+' and d_codigo ='+d_codigo.getVal()",
        F_QUERY_REF_ => "d_codigo.getVal()>0&&d_codigo.hasChanged()&&operation==INSERT_",
        F_NODB_ => "1",
        F_ORD_ => "24",
        C_VIEW_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_stock",
        F_ALIAS_ => "Stock",
        F_HELP_ => "Existencia del Producto en Stock",
        F_TYPE_ => "text",
        F_RELATION_ => "1",
        F_RELTABLE_ => "productos",
        F_SHOWFIELD_ => "p_cant",
        F_RELFIELD_ => "p_cod",
        F_LOCALFIELD_ => "d_codigo",
        F_LENGTH_ => "12",
        F_NODB_ => "1",
        F_ORD_ => "30",
        C_CHANGE_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_um_p",
        F_ALIAS_ => "UM",
        F_HELP_ => "Unidad de Medida del Producto",
        F_TYPE_ => "text",
        F_RELATION_ => "1",
        F_RELTABLE_ => "productos",
        F_SHOWFIELD_ => "p_um",
        F_RELFIELD_ => "p_cod",
        F_LOCALFIELD_ => "d_codigo",
        F_LENGTH_ => "6",
        F_NODB_ => "1",
        F_ORD_ => "40",
        F_INLINE_ => "1",
        C_CHANGE_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado del Producto",
        F_TYPE_ => "text",
        F_RELATION_ => "1",
        F_RELTABLE_ => "productos",
        F_SHOWFIELD_ => "p_estado",
        F_RELFIELD_ => "p_cod",
        F_LOCALFIELD_ => "d_codigo",
        F_LENGTH_ => "10",
        F_REQUIRED_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "40",
        F_INLINE_ => "1",
        C_CHANGE_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_cant",
        F_ALIAS_ => "Cantidad",
        F_HELP_ => "Cantidad",
        F_TYPE_ => "text",
        F_LENGTH_ => "12",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "50",
        C_CHANGE_ => "d_estado.get()=='Disponible'",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_um",
        F_ALIAS_ => "UM p/Venta",
        F_HELP_ => "Unidad de Medida del Producto",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "(d_um_p.hasChanged()&& d_codigo.getVal()>0&&d_um_p.get()!='') ||(operation==CHANGE_&&d_um_p.get()!=''&&d_cant.hasChanged())",
        F_RELTABLE_ => "um",
        F_SHOWFIELD_ => "u_cod,u_descri",
        F_LOCALFIELD_ => "d_codigo",
        F_FILTER_ => "'u_cod = '+d_um_p.getStr()+' OR u_ref = '+d_um_p.getStr()+'  '",
        F_LENGTH_ => "6",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "60",
        F_INLINE_ => "1",
        C_CHANGE_ => "d_um_p.get()!=''&&d_estado.get()=='Disponible'",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_cant_v",
        F_ALIAS_ => "Cant. Venta",
        F_HELP_ => "Cant. Venta",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT '+d_cant.getVal()+' * u_mult  FROM um WHERE u_cod = '+d_um.getStr()+''",
        F_QUERY_REF_ => "(d_cant.hasChanged()||d_um.hasChanged())&&d_cant.getVal()>0",
        F_LENGTH_ => "12",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "70",
        F_INLINE_ => "1",
        C_CHANGE_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_msg_limit",
        F_ALIAS_ => "ATENCION!",
        F_HELP_ => "ATENCION!",
        F_TYPE_ => "formula",
        F_LENGTH_ => "50",
        F_NODB_ => "1",
        F_ORD_ => "80",
        C_SHOW_ => "d_limit.getVal() > 0",
        F_FORMULA_ => "'Ha llegado al Limite de '+sup['f_limit']+' Items por Factura!'",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_msg_dupli",
        F_ALIAS_ => "ATENCION!",
        F_HELP_ => "ATENCION!",
        F_TYPE_ => "formula",
        F_LENGTH_ => "50",
        F_NODB_ => "1",
        F_ORD_ => "80",
        C_SHOW_ => "d_check_dupli.getVal() > 0",
        F_FORMULA_ => "'Codigo Duplicado!'",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_precio",
        F_ALIAS_ => "Precio",
        F_HELP_ => "Precio",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT p_precio_'+sup['f_cat']+' FROM productos WHERE p_cod = '+d_codigo.getVal()",
        F_QUERY_REF_ => "d_codigo.hasChanged()",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "90",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_subtotal",
        F_ALIAS_ => "Subtotal",
        F_HELP_ => "Subtotal",
        F_TYPE_ => "formula",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
		F_TOTAL_ => "1",
        F_ORD_ => "100",
        F_INLINE_ => "1",
        F_FORMULA_ => "d_cant_v.getVal() *  d_precio.getVal() ",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_lock_unlock",
        F_ALIAS_ => "Lock Unlock",
        F_HELP_ => "Lock Unlock",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "110",
        C_VIEW_ => "false",
        F_FORMULA_ => "if( d_limit.getVal() > 0 || d_check_dupli.getVal() > 0 || d_cant_v.getVal() > d_stock.getVal() || d_estado.get()=='Bloqueado' || d_subtotal.getVal() == 0){disableAcceptButton()}else{enableAcceptButton()}",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

?>
