<?php
$Obj->name = "fact_cont_res";
$Obj->alias = "Facturas Contables";
$Obj->help = "Factura Contable";
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
$Obj->NoInsert = "1";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "f_suc",
        F_ALIAS_ => "SUC",
        F_HELP_ => "SUC",
        F_TYPE_ => "text",
        F_LENGTH_ => "8",
        F_BROW_ => "1",
        F_ORD_ => "10",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_user",
        F_ALIAS_ => "Usuario",
        F_HELP_ => "Usuario",
        F_TYPE_ => "text",
        F_LENGTH_ => "30",
        F_BROW_ => "1",
        F_ORD_ => "20",
        C_VIEW_ => "false",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_nro",
        F_ALIAS_ => "Nro Factura Legal",
        F_HELP_ => "Nro",
        F_TYPE_ => "text",
        F_LENGTH_ => "12",
        F_BROW_ => "1",
        F_ORD_ => "30",
        C_CHANGE_ => "false",
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
        F_ORD_ => "32",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_ref",
        F_ALIAS_ => "Nro Ticket Interno",
        F_HELP_ => "Nro Ticket o Pedido",
        F_TYPE_ => "text",
		F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT  '+f_ticket.getVal()",
        F_QUERY_REF_ => "f_ticket.hasChanged()&&f_estado.get()=='Cerrada'",
        F_LENGTH_ => "14",
		F_BROW_ => "1",
        F_ORD_ => "35",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_buscar",
        F_ALIAS_ => "Buscar Venta",
        F_HELP_ => "Buscar Venta",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_NODB_ => "1",
        F_ORD_ => "36",
        F_INLINE_ => "1",
        C_VIEW_ => "f_estado.get()=='Cerrada'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_ticket",
        F_ALIAS_ => "Ticket",
        F_HELP_ => "Ticket",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "f_buscar.hasChanged()",
        F_RELTABLE_ => "factura_venta f,clientes c",
        F_SHOWFIELD_ => "f_nro,concat(cli_nombre,|{-}|,|{[}|,date_format(f_fecha,|{%d-%m-%Y}|),|{]-}|,|{(}|,f_estado,|{)}|)",
        F_FILTER_ => "'( f_nro like |{'+f_buscar.get()+'%}| or cli_nombre like |{'+f_buscar.get()+'%}|)   and f.f_cli_cod = c.cli_id /*and f.f_estado =  |{Cerrada}|*/'",
        F_NODB_ => "1",
        F_ORD_ => "37",
        F_INLINE_ => "1",
        C_VIEW_ => "f_estado.get()=='Cerrada'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_pdv",
        F_ALIAS_ => "Punto de Venta",
        F_HELP_ => "Punto de Venta",
        F_TYPE_ => "text",
        F_LENGTH_ => "6",
        F_BROW_ => "1",
        F_ORD_ => "40",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_fecha",
        F_ALIAS_ => "Fecha de Carga",
        F_HELP_ => "Fecha",
        F_TYPE_ => "date",
        F_BROW_ => "1",
		C_VIEW_ => "false",
        F_ORD_ => "50",
        C_CHANGE_ => "false",
        G_SHOW_ => "60",
        G_CHANGE_ => "60"));

$Obj->Add(
    array(
        F_NAME_ => "f_ruc",
        F_ALIAS_ => "R.U.C.",
        F_HELP_ => "R.U.C.",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_ORD_ => "60",
        C_VIEW_ => "false",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_mot_anul",
        F_ALIAS_ => "Motivo Anulacion",
        F_HELP_ => "Motivo Anulacion",
        F_TYPE_ => "text",
        F_MULTI_ => "1",
        F_LENGTH_ => "400",
        F_ORD_ => "80",
        C_VIEW_ => "f_estado.get()=='Anulada'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_total",
        F_ALIAS_ => "Total de Factura",
        F_HELP_ => "Total de Factura",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT SUM(d_subtotal) FROM fact_vent_det WHERE d_fact =  '+f_ticket.getVal()",
        F_QUERY_REF_ => "f_ticket.hasChanged()&&f_estado.get()=='Cerrada'",
        F_LENGTH_ => "18",
        F_BROW_ => "1",
        F_ORD_ => "90",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_tipo",
        F_ALIAS_ => "Tipo",
        F_HELP_ => "Tipo",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Contado,Credito",
        F_LENGTH_ => "14",
        F_BROW_ => "1",
        F_ORD_ => "110",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_nodel",
        F_ALIAS_ => "No Delete",
        F_HELP_ => "No Delete",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "120",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableDeleteButton()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
