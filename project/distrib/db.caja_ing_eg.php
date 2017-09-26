<?php
$Obj->name = "caja_ing_eg";
$Obj->alias = "Caja Ingreso y Egreso";
$Obj->help = "Movimientos de Caja";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "caja_mov";
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
        F_NAME_ => "cj_ref",
        F_ALIAS_ => "Nº",
        F_HELP_ => "Numero de Referencia",
        F_TYPE_ => "text",
        F_OPTIONS_ => "DB",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT cj_ref FROM caja WHERE cj_estado = |{Abierta}| and cj_suc = '+cj_suc.getStr()+' ORDER BY id DESC LIMIT 1'",
        F_QUERY_REF_ => "cj_ref.firstSQL&&cj_suc.notEmpty()",
        F_LENGTH_ => "5",
        F_ORD_ => "2",
        C_CHANGE_ => "false",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "__date",
        F_ALIAS_ => "Fecha",
        F_HELP_ => "Fecha en que se realiza la operación",
        F_TYPE_ => "date",
        F_LENGTH_ => "10",
        F_BROW_ => "1",
        F_ORD_ => "15",
        F_INLINE_ => "1",
        V_DEFAULT_ => "thisDate_",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "__user",
        F_ALIAS_ => "Usuario",
        F_HELP_ => "Codigo del usuario",
        F_TYPE_ => "formula",
        F_RELTABLE_ => "mnt_func",
        F_ORD_ => "20",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        F_FORMULA_ => "p_user_ ",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cj_suc",
        F_ALIAS_ => "Sucursal",
        F_HELP_ => "Suc",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT local from p_users where name = '+__user.getStr()",
        F_QUERY_REF_ => "cj_suc.firstSQL&&__user.notEmpty()",
        F_LENGTH_ => "4",
        F_BROW_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "26",
        F_INLINE_ => "1",
        C_CHANGE_ => "false",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "es",
        F_ALIAS_ => "Entrada/Salida",
        F_HELP_ => "Entrada/Salida",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "E,S",
        F_LENGTH_ => "2",
        F_REQUIRED_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "35",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "__moneda",
        F_ALIAS_ => "Moneda",
        F_HELP_ => "Tipo de Moneda ",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "caja_monedas",
        F_SHOWFIELD_ => "m_cod,m_descri",
        F_BROW_ => "1",
        F_ORD_ => "40",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "__cotiz",
        F_ALIAS_ => "Cotizacion",
        F_HELP_ => "Cotizacion del dia",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select obtener_cambio('+__moneda.getStr()+');'",
        F_QUERY_REF_ => "__moneda.hasChanged()",
        F_LENGTH_ => "8",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "50",
        F_INLINE_ => "1",
        V_DEFAULT_ => "1",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "monto",
        F_ALIAS_ => "Monto",
        F_HELP_ => "Monto",
        F_TYPE_ => "text",
        F_LENGTH_ => "14",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "60",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "monto_m_ref",
        F_ALIAS_ => "Monto Ref",
        F_HELP_ => "Monto Ref",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "65",
        F_INLINE_ => "1",
        C_VIEW_ => "true",
        F_FORMULA_ => "monto.getVal()*__cotiz.getVal()",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "busc_conc",
        F_ALIAS_ => "Buscar Concepto",
        F_HELP_ => "Buscar Concepto",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_NODB_ => "1",
        F_ORD_ => "66",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "concepto",
        F_ALIAS_ => "Concepto",
        F_HELP_ => "Concepto",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "busc_conc.hasChanged()",
        F_RELTABLE_ => "caja_con",
        F_SHOWFIELD_ => "cjc_cod,cjc_descri",
        F_FILTER_ => "'cjc_descri like |{'+busc_conc.get()+'%}| and cjc_tipo  like '+es.getStr()",
        F_ORD_ => "67",
        F_INLINE_ => "1",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "compl",
        F_ALIAS_ => "Complemento (Facturas Documentos)",
        F_HELP_ => "Complemento",
        F_TYPE_ => "text",
        F_MULTI_ => "1",
        F_LENGTH_ => "200",
        F_ORD_ => "140",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "entrada_ref",
        F_ALIAS_ => "Entrada Ref",
        F_HELP_ => "Entrada En mondeda de Referencia",
        F_TYPE_ => "formula",
        F_OPTIONS_ => "DB",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_TOTAL_ => "1",
        F_ORD_ => "150",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        F_FORMULA_ => "if(es.get()=='E'){monto.getVal()*__cotiz.getVal()}else{0}",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "salida_ref",
        F_ALIAS_ => "Salida Ref",
        F_HELP_ => "Salida En mondeda de Referencia",
        F_TYPE_ => "formula",
        F_OPTIONS_ => "DB",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_TOTAL_ => "1",
        F_ORD_ => "160",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        F_FORMULA_ => "if(es.get()=='S'){monto.getVal()*__cotiz.getVal()}else{0}",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "__lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "170",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton()",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "__lockmsg",
        F_ALIAS_ => "( ! )",
        F_HELP_ => "( ! )",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "180",
        C_VIEW_ => "cj_ref.getVal()<1",
        F_FORMULA_ => "if(cj_ref.getVal()<1){ 'Caja Cerrada!!!' } ",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "accept",
        F_ALIAS_ => "Aceptar",
        F_HELP_ => "Aceptar",
        F_TYPE_ => "proc",
        F_QUERY_ => "'SELECT caja_ins_aciento('+cj_ref.getVal()+','+__date.getStr()+','+__user.getStr()+', '+monto.getVal()+','+__moneda.getStr()+','+__cotiz.getVal()+','+es.getStr()+','+concepto.getStr()+', '+compl.getStr()+',|{}|)'",
        F_NODB_ => "1",
        F_ORD_ => "190",
        C_SHOW_ => "!accept.get()",
        C_VIEW_ => "allValid&&monto_m_ref.getVal()>0&&concepto.getVal()>0",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "__msg",
        F_ALIAS_ => "( ! )",
        F_HELP_ => "Mensaje",
        F_TYPE_ => "formula",
        F_LENGTH_ => "60",
        F_NODB_ => "1",
        F_ORD_ => "200",
        C_SHOW_ => "accept.get()",
        F_FORMULA_ => "'Ok registro realizado con exito!!!'",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "__reload",
        F_ALIAS_ => "Recargar",
        F_HELP_ => "Recargar",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "210",
        C_SHOW_ => "accept.get()",
        C_VIEW_ => "false",
        F_FORMULA_ => "setTimeout('window.location.reload()',2000)",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

?>
