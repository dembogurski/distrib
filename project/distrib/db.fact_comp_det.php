<?php
$Obj->name = "fact_comp_det";
$Obj->alias = "Detalle de la Compra";
$Obj->help = "Detalle de la Compra";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "fact_comp_det";
$Obj->Filter = "";
$Obj->Sort = "id asc";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "p_ref",
        F_ALIAS_ => "Nº Compra",
        F_HELP_ => "Ref. Compra",
        F_TYPE_ => "text",
        F_LENGTH_ => "8",
        F_DEC_ => "0",
        F_ORD_ => "10",
        C_VIEW_ => "false",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_busc",
        F_ALIAS_ => "Buscar Articulo",
        F_HELP_ => "Buscar Articulo",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_NODB_ => "1",
        F_ORD_ => "16",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_cod_art",
        F_ALIAS_ => "Articulo",
        F_HELP_ => "Codigo Articulo y Descripcion",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "p_busc.hasChanged()",
        F_RELTABLE_ => "articulos",
        F_SHOWFIELD_ => "codigo,p_descrip",
        F_FILTER_ => "'p_descrip LIKE |{'+p_busc.get()+'%}| or p_barcode = |{'+p_busc.get()+'}| '",
        F_BROW_ => "1",
        F_ORD_ => "18",
        F_INLINE_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_cod",
        F_ALIAS_ => "Lote",
        F_HELP_ => "Código del Lote",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select nro_lote()'",
        F_QUERY_REF_ => "p_cod.firstSQL&&operation==INSERT_&&p_cod_art.get()!=''",
        F_LENGTH_ => "16",
        F_DEC_ => "0",
        F_REQUIRED_ => "1",
        F_ORD_ => "20",
        F_INLINE_ => "1",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_cod_prov",
        F_ALIAS_ => "Codigo Proveedor",
        F_HELP_ => "Codigo del Proveedor",
        F_TYPE_ => "text",
        F_LENGTH_ => "24",
        F_ORD_ => "24",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_descri",
        F_ALIAS_ => "Descripcion",
        F_HELP_ => "Descripcion",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select p_descrip from articulos where codigo = '+p_cod_art.getStr()",
        F_QUERY_REF_ => "(p_cod_art.hasChanged()&&operation==INSERT_)||(operation==CHANGE_&&p_descri.firstSQL_)",
        F_LENGTH_ => "70",
        F_BROW_ => "1",
        F_ORD_ => "40",
        C_CHANGE_ => "true",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_um_art",
        F_ALIAS_ => "x",
        F_HELP_ => "Unidad de Medida Principal",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select p_um from articulos where codigo = '+p_cod_art.getStr()",
        F_QUERY_REF_ => "(p_cod_art.hasChanged()&&operation==INSERT_)||(operation==CHANGE_&&p_descri.firstSQL_)",
        F_LENGTH_ => "8",
        F_NODB_ => "1",
        F_ORD_ => "41",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_cant_compra",
        F_ALIAS_ => "Cant. Compra",
        F_HELP_ => "Cant. Compra",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_TOTAL_ => "1",
        F_ORD_ => "42",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_valor",
        F_ALIAS_ => "Valor Compra",
        F_HELP_ => "Valor Compra",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_TOTAL_ => "1",
        F_ORD_ => "43",
        F_INLINE_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_um",
        F_ALIAS_ => "Unid. Medida",
        F_HELP_ => "Unidad de Medida",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "p_um_art.hasChanged()",
        F_RELTABLE_ => "um",
        F_SHOWFIELD_ => "u_cod,u_descri",
        F_FILTER_ => "' u_cod = '+p_um_art.getStr()+' or u_ref = '+p_um_art.getStr()+' ORDER BY u_prior ASC'",
        F_BROW_ => "1",
        F_ORD_ => "44",
        F_INLINE_ => "1",
        C_SHOW_ => "p_cod_art.get()!='' && p_um_art.get()!=''",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_umult",
        F_ALIAS_ => "Mult.",
        F_HELP_ => "UM de Referencia",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT u_mult FROM um WHERE u_cod ='+p_um.getStr()",
        F_QUERY_REF_ => "p_um.hasChanged()||p_umult.firstSQL",
        F_LENGTH_ => "8",
        F_REQUIRED_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "46",
        F_INLINE_ => "1",
        C_VIEW_ => "p_um.get()!=''",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_cant_um",
        F_ALIAS_ => "Cant.Equiv",
        F_HELP_ => "Cantidad equivalente x UM",
        F_TYPE_ => "formula",
        F_LENGTH_ => "10",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "48",
        F_FORMULA_ => "p_cant_compra.getVal()*p_umult.getVal()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_um_art_info",
        F_ALIAS_ => " ",
        F_HELP_ => "UM principal del Articulo",
        F_TYPE_ => "formula",
        F_LENGTH_ => "5",
        F_NODB_ => "1",
        F_ORD_ => "49",
        F_INLINE_ => "1",
        F_FORMULA_ => "p_um_art.get()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_compra",
        F_ALIAS_ => "Precio Compra",
        F_HELP_ => "Precio Compra",
        F_TYPE_ => "formula",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "60",
        F_FORMULA_ => "(((p_valor.getVal() * sup['c_cotiz']) / p_cant_um.getVal()  ) +( ((p_valor.getVal() * sup['c_cotiz'] ) / p_cant_um.getVal()  * sup['c_porc_rec'] ) / 100))  ",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "text",
        F_LENGTH_ => "12",
        F_ORD_ => "140",
        V_DEFAULT_ => "'Activo'",
        C_VIEW_ => "false",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_lock_unclock",
        F_ALIAS_ => "Control",
        F_HELP_ => "Control",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "150",
        C_VIEW_ => "false",
        F_FORMULA_ => "if( p_cod_art.get()!='' && p_cant_um.getVal()> 0 && p_compra.getVal()> 0){ enableAcceptButton() }else{ disableAcceptButton() }",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
