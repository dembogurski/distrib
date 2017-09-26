<?php
$Obj->name = "cuentas_cob";
$Obj->alias = "Cuentas por Cobrar";
$Obj->help = "Cuentas por Cobrar";
$Obj->copy_from = "";
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
        F_NAME_ => "c_lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "4",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton() ; ",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_busc",
        F_ALIAS_ => "Buscar Cliente",
        F_HELP_ => "Buscar Cliente",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_cli_cod",
        F_ALIAS_ => "Cliente",
        F_HELP_ => "Cliente",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "c_busc.hasChanged()",
        F_OPTIONS_ => "1",
        F_RELTABLE_ => "clientes",
        F_SHOWFIELD_ => "cli_id,concat(cli_nombre,|{   }|,cli_tipo_doc,|{: }|,cli_ci)",
        F_FILTER_ => "'cli_ci like |{'+c_busc.get()+'%}| or cli_nombre like |{'+c_busc.get()+'%}| LIMIT 26' ",
        F_ORD_ => "30",
        F_INLINE_ => "1",
        V_DEFAULT_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_factura",
        F_ALIAS_ => "Facturas a Credito",
        F_HELP_ => "Facturas a Credito",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "c_cli_cod.hasChanged()",
        F_RELTABLE_ => "factura_venta f, cuotas c",
        F_SHOWFIELD_ => "distinct f_nro,DATE_FORMAT(f_fecha,|{%d-%m-%Y}|)",
        F_FILTER_ => "'f_cli_cod = '+c_cli_cod.getStr()+' and f_tipo = |{Credito}| and f.f_nro = c.c_fact  and c.c_estado = |{Pendiente}|'",
        F_NODB_ => "1",
        F_ORD_ => "41",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_estado",
        F_ALIAS_ => "Mostrar solo las cuotas con Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Pendiente,Cancelada,%",
        F_NODB_ => "1",
        F_ORD_ => "43",
        F_INLINE_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_cuotas",
        F_ALIAS_ => "Cuotas",
        F_HELP_ => "Cuotas Pendientes",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'c_fact='+c_factura.getVal()+' and c_estado like |{'+c_estado.get()+'}|'",
        F_LINK_ => "db.cuotas_cob",
        F_SEND_ => "c_factura.getVal()",
        F_NODB_ => "1",
        F_ORD_ => "51",
        C_SHOW_ => "c_factura.getVal()>0",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
