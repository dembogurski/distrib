<?php
$Obj->name = "fact_cont_gen";
$Obj->alias = "Cargar Facturas Contables";
$Obj->help = "Cargar Facturas Contables";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "fact_cont";
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
        F_NAME_ => "f_suc",
        F_ALIAS_ => "SUC",
        F_HELP_ => "SUC",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "empresas",
        F_SHOWFIELD_ => "emp_cod,emp_nombre",
        F_FILTER_ => "'true order by emp_cod asc'",
        F_LENGTH_ => "4",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_pdv",
        F_ALIAS_ => "Punto de Venta",
        F_HELP_ => "Punto de Venta",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "f_suc.hasChanged()",
        F_RELTABLE_ => "pdv",
        F_SHOWFIELD_ => "p_cod,p_ubic",
        F_FILTER_ => "'p_suc='+f_suc.getStr()",
        F_LENGTH_ => "6",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "12",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "pdvs",
        F_ALIAS_ => "Editar PDV`s",
        F_HELP_ => "Editar PDV`s",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "No,Si",
        F_NODB_ => "1",
        F_ORD_ => "14",
        F_INLINE_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_pdvs",
        F_ALIAS_ => "PDVs",
        F_HELP_ => "PDVs",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'p_suc='+f_suc.getStr()",
        F_LINK_ => "db.pdv",
        F_SEND_ => "f_suc.get()",
        F_NODB_ => "1",
        F_ORD_ => "16",
        C_SHOW_ => "pdvs.get()=='Si'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_user",
        F_ALIAS_ => "Usuario",
        F_HELP_ => "Usuario",
        F_TYPE_ => "formula",
        F_OPTIONS_ => "DB",
        F_LENGTH_ => "30",
        F_BROW_ => "1",
        F_ORD_ => "20",
        C_CHANGE_ => "false",
        F_FORMULA_ => "p_user_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_nro",
        F_ALIAS_ => "Nro Inicial",
        F_HELP_ => "Nro",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT  IF( COUNT(f_nro) > 0,max(f_nro) + 1,1) FROM fact_cont WHERE f_suc = '+f_suc.getStr()+' AND f_pdv = '+f_pdv.getStr()+' ORDER BY id DESC LIMIT 1 '",
        F_QUERY_REF_ => "f_suc.hasChanged()||f_pdv.hasChanged()",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "30",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_check",
        F_ALIAS_ => "Chequeo",
        F_HELP_ => "Chequeo",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "' SELECT count(*) FROM fact_cont WHERE f_suc = '+f_suc.getStr()+' AND f_pdv = '+f_pdv.getStr()+' AND f_nro BETWEEN '+f_nro.getVal()+' AND '+f_final.getVal()",
        F_QUERY_REF_ => "f_nro.hasChanged()||f_can.hasChanged()",
        F_LENGTH_ => "6",
        F_NODB_ => "1",
        F_ORD_ => "35",
        F_INLINE_ => "1",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_can",
        F_ALIAS_ => "Cantidad",
        F_HELP_ => "Cantidad a Generar",
        F_TYPE_ => "text",
        F_LENGTH_ => "10",
        F_DEC_ => "0",
        F_REQUIRED_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "46",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_final",
        F_ALIAS_ => "Nro Final",
        F_HELP_ => "Nro Final",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "48",
        F_INLINE_ => "1",
        F_FORMULA_ => "f_nro.getVal()+f_can.getVal()-1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_fecha",
        F_ALIAS_ => "Fecha de Carga",
        F_HELP_ => "Fecha",
        F_TYPE_ => "date",
        F_BROW_ => "1",
        F_ORD_ => "50",
        V_DEFAULT_ => "thisDate_",
        C_VIEW_ => "operation!=INSERT_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_venc",
        F_ALIAS_ => "Fecha de Vencimiento",
        F_HELP_ => "Fecha de Vencimiento",
        F_TYPE_ => "date",
        F_REQUIRED_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "56",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_ruc",
        F_ALIAS_ => "R.U.C.",
        F_HELP_ => "R.U.C.",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "60",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Disponible,Cerrada,Anulada",
        F_BROW_ => "1",
        F_ORD_ => "70",
        C_VIEW_ => "operation==CHANGE_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_total",
        F_ALIAS_ => "Total de Factura",
        F_HELP_ => "Total de Factura",
        F_TYPE_ => "text",
        F_LENGTH_ => "18",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "90",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "__msg",
        F_ALIAS_ => "Mensaje",
        F_HELP_ => "Mensaje",
        F_TYPE_ => "formula",
        F_LENGTH_ => "100",
        F_NODB_ => "1",
        F_ORD_ => "120",
        C_SHOW_ => "f_gen.get()",
        F_FORMULA_ => "'( ! ) Ok Facturas Generadas con Exito!!!'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "__lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "130",
        C_VIEW_ => "false",
        F_FORMULA_ => "if(operation==CONSULT_){disableAcceptButton()}",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "__msg2",
        F_ALIAS_ => "Mensaje",
        F_HELP_ => "Mensaje",
        F_TYPE_ => "formula",
        F_LENGTH_ => "70",
        F_NODB_ => "1",
        F_ORD_ => "140",
        C_SHOW_ => "f_check.getVal()>0",
        F_FORMULA_ => "'( ! ) Ya hay facturas cargadas con estos numeros para esta sucursal!!! '",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_estab",
        F_ALIAS_ => "Establecimiento",
        F_HELP_ => "Establecimiento",
        F_TYPE_ => "text",
        F_LENGTH_ => "3",
        F_ORD_ => "150",
		F_REQUIRED_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_timbrado",
        F_ALIAS_ => "Timbrado",
        F_HELP_ => "Timbrado",
        F_TYPE_ => "text",
        F_LENGTH_ => "8",
		F_REQUIRED_ => "1",
        F_ORD_ => "160",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_gen",
        F_ALIAS_ => "Generar Facturas",
        F_HELP_ => "Generar Facturas",
        F_TYPE_ => "proc",
        F_QUERY_ => "'select gen_fact_cont('+f_nro.getVal()+','+f_can.getVal()+','+f_suc.getStr()+' ,'+f_user.getStr()+', '+f_pdv.getStr()+' ,'+f_ruc.getStr()+' , '+f_venc.getStr()+' ,'+f_estab.getStr()+' , '+f_timbrado.getStr()+');'",
        F_NODB_ => "1",
        F_ORD_ => "180",
        C_SHOW_ => "!f_gen.get()",
        C_VIEW_ => "allValid&&operation==CONSULT_&&f_check.getVal()<1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
