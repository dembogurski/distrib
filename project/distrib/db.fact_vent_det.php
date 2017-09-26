<?php
$Obj->name = "fact_vent_det";
$Obj->alias = "Detalle de Factura";
$Obj->help = "Detalle de Factura de Venta";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "fact_vent_det";
$Obj->Filter = "";
$Obj->Sort = "";
$Obj->p_insert = "'select corr_stock()'";
$Obj->p_change = "'select corr_stock()'";
$Obj->p_delete = "'select corr_stock()'";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "";
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
        F_NAME_ => "d_stock_neg",
        F_ALIAS_ => "Stock Negativo",
        F_HELP_ => "Check Limit",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT valor FROM parametros WHERE clave = |{stock_negativo}|'",
        F_QUERY_REF_ => "d_stock_neg.firstSQL",
        F_NODB_ => "1",
        F_ORD_ => "6",
        C_VIEW_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_buscar",
        F_ALIAS_ => "Buscar:",
        F_HELP_ => "Buscar por Codigo o Descripcion",
        F_TYPE_ => "text",
        F_LENGTH_ => "40",
        F_NODB_ => "1",
        F_ORD_ => "10",
        C_CHANGE_ => "operation==INSERT_",
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
        F_SHOWFIELD_ => "codigo,p_descrip",
        F_FILTER_ => "' codigo =  |{'+d_buscar.get()+'}| OR p_descrip LIKE |{'+d_buscar.get()+'%}| OR p_barcode = |{'+d_buscar.get()+'}| '",
        F_LENGTH_ => "14",
        F_BROW_ => "1",
        F_ORD_ => "10",
        C_CHANGE_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_descrip",
        F_ALIAS_ => "Descripcion",
        F_HELP_ => "Descripcion",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT  p_descrip FROM articulos WHERE codigo =  '+d_codigo.getStr()",
        F_QUERY_REF_ => "d_codigo.hasChanged()||operation==BROWSE_",
        F_LENGTH_ => "80",
        F_BROW_ => "1",
        F_ORD_ => "20",
        F_INLINE_ => "1",
        C_VIEW_ => "operation!=INSERT_",
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
        F_QUERY_ => "'SELECT COUNT(*) FROM fact_vent_det WHERE d_fact = '+d_fact.getVal()+' and d_codigo ='+d_codigo.getStr()",
        F_QUERY_REF_ => "d_codigo.getStr()!=''&&d_codigo.hasChanged()&&operation==INSERT_",
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
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT IF(cantidad IS NOT NULL,cantidad,0) AS stock FROM stock WHERE codigo = '+d_codigo.getStr()+' AND suc = '+sup['f_suc']+''",
        F_QUERY_REF_ => "(d_codigo.getStr()!=''&&d_codigo.hasChanged()&&operation==INSERT_)||(d_codigo.getStr()!=''&&operation==CHANGE_)",
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
        F_RELTABLE_ => "articulos",
        F_SHOWFIELD_ => "p_um",
        F_RELFIELD_ => "codigo",
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
        F_NAME_ => "d_um_ref",
        F_ALIAS_ => "UM Ref",
        F_HELP_ => "UM Ref del Producto",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT u_ref FROM um WHERE u_cod = '+d_um_p.getStr()+' '",
        F_QUERY_REF_ => "d_codigo.getStr()!='' && d_um_p.hasChanged()",
        F_LENGTH_ => "6",
        F_NODB_ => "1",
        F_ORD_ => "42",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
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
        F_RELTABLE_ => "articulos",
        F_SHOWFIELD_ => "p_estado",
        F_RELFIELD_ => "codigo",
        F_LOCALFIELD_ => "d_codigo",
        F_LENGTH_ => "10",
        F_REQUIRED_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "42",
        F_INLINE_ => "1",
        C_VIEW_ => "true",
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
        C_CHANGE_ => "d_estado.get()=='Liberado'",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_um",
        F_ALIAS_ => "UM Venta",
        F_HELP_ => "Unidad de Medida del Producto",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "(u_ref_g.hasChanged()&& d_codigo.getStr()!=''&&u_ref_g.get()!='') ||(operation==CHANGE_&&u_ref_g.get()!=''&&d_cant.hasChanged())",
        F_RELTABLE_ => "um",
        F_SHOWFIELD_ => "u_cod,u_descri",
        F_LOCALFIELD_ => "d_codigo",
        F_FILTER_ => "'u_cod = '+u_ref_g.getStr()+' OR u_ref = '+u_ref_g.getStr()+' ORDER BY u_prior ASC '",
        F_LENGTH_ => "6",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "60",
        F_INLINE_ => "1",
        C_CHANGE_ => "u_ref_g.get()!=''&&d_estado.get()=='Liberado'",
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
        F_NAME_ => "d_valmin",
        F_ALIAS_ => "Valmin",
        F_HELP_ => "Valmin",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT p_valmin FROM articulos WHERE codigo = '+d_codigo.getStr()",
        F_QUERY_REF_ => "d_codigo.hasChanged()",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_NODB_ => "1",
        F_ORD_ => "72",
        C_VIEW_ => "false",
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
        F_NAME_ => "style",
        F_ALIAS_ => "Style 0",
        F_HELP_ => "Style 0",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "81",
        C_VIEW_ => "false",
        F_FORMULA_ => "document.getElementById(|{d_msg_dupli}|).setAttribute(|{style}|,|{height:30px;color:blue;font-size:18px;}|);   ",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "d_precio",
        F_ALIAS_ => "Precio",
        F_HELP_ => "Precio",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT precio_unit FROM lista_precios WHERE codigo = '+d_codigo.getStr()+' and num = '+sup['f_cat']+' '",
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
        F_NAME_ => "d_imp",
        F_ALIAS_ => "Impuesto",
        F_HELP_ => "Impuesto",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT  p_imp FROM articulos WHERE codigo =  '+d_codigo.getStr()",
        F_QUERY_REF_ => "d_codigo.hasChanged()||operation==BROWSE_",
        F_LENGTH_ => "10",
        F_ORD_ => "102",
        C_VIEW_ => "false",
        C_CHANGE_ => "false",
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
        F_FORMULA_ => "if( d_limit.getVal() > 0 || d_check_dupli.getVal() > 0 || ((d_cant_v.getVal() < d_stock_neg.getVal()) && ( d_stock.getVal() > d_stock_neg.getVal() )) || d_estado.get()=='Bloqueado' || d_subtotal.getVal() == 0  ){disableAcceptButton()}else{enableAcceptButton()}",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "u_ref_g",
        F_ALIAS_ => "UM Ref",
        F_HELP_ => "Style 1",
        F_TYPE_ => "formula",
        F_LENGTH_ => "10",
        F_NODB_ => "1",
        F_ORD_ => "120",
        C_VIEW_ => "false",
        F_FORMULA_ => "if(d_um_ref.get()==''){d_um_p.get()}else{d_um_ref.get()}",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "style1",
        F_ALIAS_ => "Style 1",
        F_HELP_ => "Style 1",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "120",
        C_SHOW_ => "d_estado.get()=='Bloqueado'",
        C_VIEW_ => "false",
        F_FORMULA_ => "document.getElementById(|{d_estado}|).setAttribute(|{style}|,|{height:30px;color:red;font-size:16px;}|);   ",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "msg_min",
        F_ALIAS_ => "ATENCION!",
        F_HELP_ => "ATENCION",
        F_TYPE_ => "formula",
        F_LENGTH_ => "50",
        F_NODB_ => "1",
        F_ORD_ => "122",
        C_SHOW_ => "d_valmin.getVal() > d_precio.getVal() && d_cant_v.getVal() > 0",
        C_VIEW_ => "true",
        F_FORMULA_ => "'Esta vendiendo bajo el precio minimo:'+d_valmin.getVal()+' '",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

?>
