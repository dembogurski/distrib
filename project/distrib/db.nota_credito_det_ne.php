<?php
$Obj->name = "nota_credito_det_ne";
$Obj->alias = "Detalle de Nota Credito";
$Obj->help = "Detalle de Nota Credito";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "nota_credito_det";
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
        F_ALIAS_ => "N° Nota Credito",
        F_HELP_ => "N° Nota Credito",
        F_TYPE_ => "text",
        F_LENGTH_ => "12",
        F_DEC_ => "0",
        F_ORD_ => "4",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "d_codigo",
        F_ALIAS_ => "Codigo:",
        F_HELP_ => "Codigo",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "fact_vent_det",
        F_SHOWFIELD_ => "d_codigo,CONCAT(d_cant_v,|{ }|,d_um)",
        F_FILTER_ => "'d_fact = '+sup['n_factura']",
        F_LENGTH_ => "14",
        F_BROW_ => "1",
        F_ORD_ => "10",
        C_CHANGE_ => "operation==INSERT_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

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
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "d_check_dupli",
        F_ALIAS_ => "Check Duplicate",
        F_HELP_ => "Check Duplicate",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT COUNT(*) FROM nota_credito_det WHERE d_fact = '+d_fact.getVal()+' and d_codigo ='+d_codigo.getVal()",
        F_QUERY_REF_ => "d_codigo.getVal()>0&&d_codigo.hasChanged()&&operation==INSERT_",
        F_NODB_ => "1",
        F_ORD_ => "24",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

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
        C_VIEW_ => "false",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "d_um_ref",
        F_ALIAS_ => "UM Ref",
        F_HELP_ => "UM Ref del Producto",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT u_ref FROM um WHERE u_cod = '+d_um_p.getStr()+' '",
        F_QUERY_REF_ => "d_codigo.getVal()>0 && d_um_p.hasChanged()",
        F_LENGTH_ => "6",
        F_NODB_ => "1",
        F_ORD_ => "42",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "d_cant",
        F_ALIAS_ => "Cantidad Vendida",
        F_HELP_ => "Cantidad Vendida",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select d_cant from fact_vent_det where d_fact =  '+sup['n_factura']+' and d_codigo =  '+d_codigo.getVal()",
        F_QUERY_REF_ => "d_codigo.hasChanged()",
        F_LENGTH_ => "12",
        F_DEC_ => "2",
		C_CHANGE_ => "false",
        F_BROW_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "d_um",
        F_ALIAS_ => "UM de Venta",
        F_HELP_ => "Unidad de Medida del Producto",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT d_um  FROM fact_vent_det WHERE d_codigo = '+d_codigo.getVal()+' and d_fact = '+sup['n_factura'] ",
        F_QUERY_REF_ => "d_codigo.hasChanged()",
        F_LENGTH_ => "16",
        F_BROW_ => "1",
        F_ORD_ => "60",
        F_INLINE_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

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
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "d_cant_dv",
        F_ALIAS_ => "Cantidad a Devolver",
        F_HELP_ => "Cantidad",
        F_TYPE_ => "text",
        F_LENGTH_ => "12",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "71",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

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
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));
		
	

$Obj->Add(
    array(
        F_NAME_ => "style",
        F_ALIAS_ => "Style 0",
        F_HELP_ => "Style 0",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "81",
        C_VIEW_ => "false",
        F_FORMULA_ => "document.getElementById(|{d_msg_dupli}|).setAttribute(|{style}|,|{height:30px;color:blue;font-size:18px;}|);   ",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "d_precio",
        F_ALIAS_ => "Precio Venta",
        F_HELP_ => "Precio Venta",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT d_precio  FROM fact_vent_det WHERE d_codigo = '+d_codigo.getVal()+' and d_fact = '+sup['n_factura'] ",
        F_QUERY_REF_ => "d_codigo.hasChanged()",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "90",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

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
        F_FORMULA_ => "d_cant_dv.getVal() *  d_precio.getVal() ",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));
		
$Obj->Add(
    array(
        F_NAME_ => "d_lock",
        F_ALIAS_ => "ATENCION!",
        F_HELP_ => "ATENCION!",
        F_TYPE_ => "formula",
        F_LENGTH_ => "50",
        F_NODB_ => "1",
        F_ORD_ => "80",
        C_VIEW_ => "false",
        F_FORMULA_ => "if( (d_cant_dv.getVal() > d_cant_v.getVal()) || d_subtotal.getVal() == 0 || d_check_dupli.getVal() > 0){ disableAcceptButton()}else{ enableAcceptButton()}",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));			

?>
