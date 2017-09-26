<?php
$Obj->name = "articulos";
$Obj->alias = "Articulos";
$Obj->help = "Articulos";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "articulos";
$Obj->Filter = "";
$Obj->Sort = "codigo asc";
$Obj->p_insert = "'select gen_lista_precios('+codigo.getStr()+')'";
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
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT CONCAT(  LEFT(CONCAT(|{A}|,|{0000}|),4),  _autonum(|{cod_art}|))'",
        F_QUERY_REF_ => "codigo.firstSQL&&operation==INSERT_",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "10",
        F_UNIQ_ => "1",
        C_CHANGE_ => "false",
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
        F_NAME_ => "p_sector",
        F_ALIAS_ => "Sector",
        F_HELP_ => "Sector",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "sector",
        F_SHOWFIELD_ => "s_cod,s_nombre",
        F_REQUIRED_ => "1",
        F_ORD_ => "26",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_grupo",
        F_ALIAS_ => "Grupo",
        F_HELP_ => "Grupo",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "p_sector.hasChanged()",
        F_RELTABLE_ => "grupos_x_sector s, grupo g",
        F_SHOWFIELD_ => "s.gc_cod,g_nombre",
        F_FILTER_ => "'s_cod='+p_sector.getVal()+' and s.gc_cod = g.g_cod'",
        F_REQUIRED_ => "1",
        F_ORD_ => "28",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_tipo",
        F_ALIAS_ => "Sub-Grupo",
        F_HELP_ => "Sub-Grupo",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "p_grupo.hasChanged()",
        F_RELTABLE_ => "tipos_x_grupo gt,tipo t",
        F_SHOWFIELD_ => "ct_cod, t_nombre",
        F_FILTER_ => "'gt.g_cod ='+p_grupo.getVal()+' and gt.ct_cod = t.t_cod '",
        F_REQUIRED_ => "1",
        F_ORD_ => "30",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_sectorn",
        F_ALIAS_ => "Sector",
        F_HELP_ => "Sector",
        F_TYPE_ => "text",
        F_RELATION_ => "1",
        F_RELTABLE_ => "sector",
        F_SHOWFIELD_ => "s_nombre",
        F_RELFIELD_ => "s_cod",
        F_LOCALFIELD_ => "p_sector",
        F_LENGTH_ => "30",
        F_NODB_ => "1",
        F_ORD_ => "33",
        C_VIEW_ => "(operation==BROWSE_||operation==SHOW_)&&false",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_grupon",
        F_ALIAS_ => "Grupo",
        F_HELP_ => "Grupo",
        F_TYPE_ => "text",
        F_RELATION_ => "1",
        F_RELTABLE_ => "grupo",
        F_SHOWFIELD_ => "g_nombre",
        F_RELFIELD_ => "g_cod",
        F_LOCALFIELD_ => "p_grupo",
        F_LENGTH_ => "30",
        F_NODB_ => "1",
        F_ORD_ => "34",
        F_INLINE_ => "1",
        C_VIEW_ => "(operation==BROWSE_||operation==SHOW_)&&false",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_tipon",
        F_ALIAS_ => "Tipo",
        F_HELP_ => "Tipo",
        F_TYPE_ => "text",
        F_RELATION_ => "1",
        F_RELTABLE_ => "tipo",
        F_SHOWFIELD_ => "t_nombre",
        F_RELFIELD_ => "t_cod",
        F_LOCALFIELD_ => "p_tipo",
        F_LENGTH_ => "38",
        F_NODB_ => "1",
        F_ORD_ => "35",
        F_INLINE_ => "1",
        C_VIEW_ => "(operation==BROWSE_||operation==SHOW_)&&false",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_descrip",
        F_ALIAS_ => "Descipcion",
        F_HELP_ => "Descipcion",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select concat('+p_grupon.getStr()+',|{-}|,'+p_tipon.getStr()+')'",
        F_QUERY_REF_ => "false",
        F_LENGTH_ => "64",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "45",
        F_UNIQ_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_um",
        F_ALIAS_ => "Unid. Medida",
        F_HELP_ => "Unidad de Medida",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "um",
        F_SHOWFIELD_ => "u_cod,u_descri,u_cod",
        F_FILTER_ => "'true order by u_prior asc'",
        F_REQUIRED_ => "1",
        F_ORD_ => "48",
        C_CHANGE_ => "operation!=INSERT_ ",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_imp",
        F_ALIAS_ => "Impuesto",
        F_HELP_ => "Impuesto",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "def_imp",
        F_SHOWFIELD_ => "imp_cod,concat(valor,|{%}|)",
        F_BROW_ => "1",
        F_ORD_ => "50",
        F_INLINE_ => "1",
        V_DEFAULT_ => "'IVA_10'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_costo_prom",
        F_ALIAS_ => "Precio Costo Promedio",
        F_HELP_ => "Precio Costo Promedio",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "55",
        C_VIEW_ => "operation!=INSERT_",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_valmin",
        F_ALIAS_ => "Valor Minimo",
        F_HELP_ => "Valor Minimo de Venta",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT '+p_costo_prom.getVal()+' + (('+p_costo_prom.getVal()+' * valor) / 100) FROM parametros WHERE clave = |{porc_val_min}| '",
        F_QUERY_REF_ => "p_costo_prom.hasChanged()&&p_costo_prom.getVal()>0||(p_valmin.firstSQL&&p_costo_prom.getVal()>0)",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "56",
        F_INLINE_ => "1",
        C_VIEW_ => "operation!=INSERT_",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_stock",
        F_ALIAS_ => "Stock Global",
        F_HELP_ => "Stock",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT calc_stock('+codigo.getStr()+')'",
        F_QUERY_REF_ => "operation==CHANGE_&&codigo.get()!=''",
        F_LENGTH_ => "12",
        F_DEC_ => "2",
		F_BROW_ => "1",
        F_ORD_ => "57",
        F_INLINE_ => "1",
        C_VIEW_ => "operation!=INSERT_",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Liberado,Bloqueado",
        F_LENGTH_ => "12",
        F_ORD_ => "58",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_set_precios",
        F_ALIAS_ => "Definir Precios",
        F_HELP_ => "Definir Precios",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.def_lista_prec",
        F_NODB_ => "1",
        F_ORD_ => "60",
        F_INLINE_ => "1",
        C_VIEW_ => "operation!=INSERT_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_cantidades",
        F_ALIAS_ => "Cantidades",
        F_HELP_ => "Cantidades",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.stock_x_suc",
        F_NODB_ => "1",
        F_ORD_ => "63",
        F_INLINE_ => "1",
        C_VIEW_ => "operation!=INSERT_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_listas",
        F_ALIAS_ => "Listas de Precios",
        F_HELP_ => "Listas de Precios",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'codigo = '+codigo.getStr()",
        F_LINK_ => "db.lista_precios",
        F_SEND_ => "codigo.get()",
        F_NODB_ => "1",
        F_ORD_ => "65",
        C_SHOW_ => "operation==CHANGE_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_cants",
        F_ALIAS_ => "Cantidades",
        F_HELP_ => "Cantidades",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'codigo = '+codigo.getStr()",
        F_LINK_ => "db.stock",
        F_SEND_ => "codigo.get()",
        F_NODB_ => "1",
        F_ORD_ => "75",
        C_SHOW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "p_lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "95",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableDeleteButton() ",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_open_sub",
        F_ALIAS_ => "Abre Subformulario",
        F_HELP_ => "Abre Subformulario",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "180",
        C_VIEW_ => "false",
        F_FORMULA_ => "document.getElementById(|{p_listas}|).setAttribute(|{hidden}|,|{false}|); document.getElementById(|{hbox_p_listas}|).setAttribute(|{height}|,|{180}|);",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_upper",
        F_ALIAS_ => "Pone en Mayusculas",
        F_HELP_ => "Pone en Mayusculas",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "180",
        C_VIEW_ => "false",
        F_FORMULA_ => "  setValue('p_descrip', p_descrip.get().toUpperCase() ) ",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_doclick",
        F_ALIAS_ => "click",
        F_HELP_ => "Contro click",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "190",
        C_VIEW_ => "false",
        F_FORMULA_ => "if( !openSubform   ){  document.getElementById(|{cap`p_listas`Listas de Precios}|).click();  openSubform=true; }else{openSubform=false;  }",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_lockum",
        F_ALIAS_ => "click",
        F_HELP_ => "Contro click",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "196",
        C_VIEW_ => "false",
        F_FORMULA_ => "if(  operation!=INSERT_  ){  document.getElementById(|{p_um}|).setAttribute(|{disabled}|,true); }",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

?>
