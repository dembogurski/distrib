<?php
$Obj->name = "nota_credito";
$Obj->alias = "Nota de Credito Cliente";
$Obj->help = "Nota de Credito Cliente";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "nota_credito";
$Obj->Filter = "";
$Obj->Sort = "n_nro desc";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "1";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "n_lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "4",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton() ; disableDeleteButton();  ",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_nro",
        F_ALIAS_ => "Nº Nota Credito",
        F_HELP_ => "Nº Nota Credito",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select gen_nota_credito('+n_cli_cod.getVal()+','+n_cat.getVal()+','+n_usuario.getStr()+');'",
        F_QUERY_REF_ => "n_gen.hasChanged()&&n_gen.get()=='Si'&& n_nro.getVal()==0",
        F_LENGTH_ => "14",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "10",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_usuario",
        F_ALIAS_ => "Usuario",
        F_HELP_ => "Usuario",
        F_TYPE_ => "formula",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_ORD_ => "11",
        F_INLINE_ => "1",
        C_VIEW_ => "operation==CHANGE_",
        F_FORMULA_ => "p_user_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_fecha",
        F_ALIAS_ => "Fecha",
        F_HELP_ => "Fecha",
        F_TYPE_ => "date",
        F_BROW_ => "1",
        F_ORD_ => "12",
        F_INLINE_ => "1",
        V_DEFAULT_ => "thisDate_",
        C_VIEW_ => "operation==CHANGE_",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_b_cli",
        F_ALIAS_ => "Buscar Cliente",
        F_HELP_ => "Buscar Cliente",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_NODB_ => "1",
        F_ORD_ => "20",
        C_CHANGE_ => "n_gen.get()=='No'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_cli_cod",
        F_ALIAS_ => "Cliente",
        F_HELP_ => "Cliente",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "n_b_cli.hasChanged() && operation==CONSULT_",
        F_OPTIONS_ => "1",
        F_RELTABLE_ => "clientes",
        F_SHOWFIELD_ => "cli_id,concat(cli_nombre,|{   }|,cli_tipo_doc,|{: }|,cli_ci)",
        F_FILTER_ => "'cli_ci like |{'+n_b_cli.get()+'%}| or cli_nombre like |{'+n_b_cli.get()+'%}| LIMIT 26' ",
        F_ORD_ => "30",
        F_INLINE_ => "1",
        V_DEFAULT_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_cli_nombre",
        F_ALIAS_ => "Cliente",
        F_HELP_ => "Cliente",
        F_TYPE_ => "text",
        F_RELATION_ => "1",
        F_RELTABLE_ => "clientes",
        F_SHOWFIELD_ => "cli_nombre",
        F_RELFIELD_ => "cli_id",
        F_LOCALFIELD_ => "n_cli_cod",
        F_LENGTH_ => "50",
        F_BROW_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "31",
        F_INLINE_ => "1",
        C_VIEW_ => "operation!=INSERT_&&operation!=CONSULT_",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_cat",
        F_ALIAS_ => "Cat.",
        F_HELP_ => "Categoria",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select cli_cat from clientes where cli_id = '+n_cli_cod.getVal()",
        F_QUERY_REF_ => "n_cli_cod.hasChanged()",
        F_LENGTH_ => "3",
        F_BROW_ => "1",
        F_ORD_ => "32",
        F_INLINE_ => "1",
        V_DEFAULT_ => "1",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_edit_cli",
        F_ALIAS_ => "Edición",
        F_HELP_ => "Editar Cliente / Registrar",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => ",Editar,Registrar",
        F_NODB_ => "1",
        F_ORD_ => "33",
        F_INLINE_ => "1",
        C_SHOW_ => "operation==CONSULT_&&n_cli_cod.getVal()>0",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_cli_form",
        F_ALIAS_ => "Editar Cliente",
        F_HELP_ => "Editar Cliente",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'cli_id =  '+n_cli_cod.getVal()+ ' and cli_id > 1'",
        F_LINK_ => "db.clientes",
        F_SEND_ => "if(operation==CONSULT_&&n_edit_cli.get()=='Editar'){ n_cli_cod.get() }else{ 1 }",
        F_NODB_ => "1",
        F_ORD_ => "34",
        C_SHOW_ => "operation==CONSULT_&&n_edit_cli.get()!=''",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Abierta,Cerrada",
        F_ORD_ => "42",
        C_VIEW_ => "operation==CHANGE_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_imprimir",
        F_ALIAS_ => "Imprimir Nota de Credito",
        F_HELP_ => "Imprimir Nota de Credito",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.nota_credito",
        F_NODB_ => "1",
        F_ORD_ => "43",
        F_INLINE_ => "1",
        C_SHOW_ => "operation==CHANGE_&&n_estado.get()=='Cerrada'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_estadoi",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT n_estado FROM nota_credito WHERE n_nro = '+n_nro.getVal()",
        F_QUERY_REF_ => "n_estadoi.firstSQL||n_nro.hasChanged()",
        F_LENGTH_ => "10",
        F_NODB_ => "1",
        F_ORD_ => "44",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_factura",
        F_ALIAS_ => "Factura",
        F_HELP_ => "Factura",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "n_cli_cod.hasChanged() || (operation==CHANGE_ && n_nro.getVal() > 0 && n_factura.firstSQL)",
        F_RELTABLE_ => "factura_venta",
        F_SHOWFIELD_ => "f_nro,CONCAT(|{   Fecha: }|, DATE_FORMAT(f_fecha,|{%d-%m-%Y}|))",
        F_FILTER_ => "'f_cli_cod = '+n_cli_cod.getVal()+' AND f_estado = |{Cerrada}|'",
        F_NODB_ => "1",
        F_ORD_ => "45",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_gen",
        F_ALIAS_ => "Generar Nota de Credito",
        F_HELP_ => "Generar Nota de Credito",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "No,Si",
        F_NODB_ => "1",
        F_ORD_ => "46",
        C_VIEW_ => "operation==CONSULT_&&n_cli_cod.getVal()>1&&n_factura.getVal()>0",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_set_change",
        F_ALIAS_ => "Operacion = Change",
        F_HELP_ => "Operacion = Change",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "52",
        C_SHOW_ => "n_gen.get()=='Si'",
        C_VIEW_ => "false",
        F_FORMULA_ => "operation=CHANGE_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_det",
        F_ALIAS_ => "Detalle de Nota de Credito",
        F_HELP_ => "Detalle de Nota de Credito",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'d_fact = '+n_nro.getVal()",
        F_LINK_ => "db.nota_credito_det",
        F_SEND_ => "n_nro.getVal()",
        F_NODB_ => "1",
        F_ORD_ => "62",
        C_SHOW_ => "operation==CHANGE_&&n_estado.get()=='Abierta'&&n_factura.getVal()>0&&n_estadoi.get()=='Abierta'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_deti",
        F_ALIAS_ => "Detalle de Nota de Credito",
        F_HELP_ => "Detalle de Nota de Credito",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'d_fact = '+n_nro.getVal()",
        F_LINK_ => "db.nota_credito_det_ne",
        F_SEND_ => "n_nro.getVal()",
        F_NODB_ => "1",
        F_ORD_ => "62",
        C_SHOW_ => "operation==CHANGE_&&n_estado.get()!='Anulada'&&n_factura.getVal()>0&&n_estadoi.get()=='Cerrada'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_limit",
        F_ALIAS_ => "Limite de Items",
        F_HELP_ => "Limite de Items",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT valor FROM   parametros WHERE clave LIKE |{limite_items_x_venta}|'",
        F_QUERY_REF_ => "n_limit.firstSQL",
        F_NODB_ => "1",
        F_ORD_ => "72",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_doclick",
        F_ALIAS_ => "click",
        F_HELP_ => "Contro click",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "123",
        C_SHOW_ => "n_estadoi.get()=='Abierta'",
        C_VIEW_ => "false",
        F_FORMULA_ => "if( !openSubform   ){  document.getElementById(|{cap`n_det`Detalle de Nota de Credito}|).click(); openSubform=true; }else{openSubform=false;  }",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));
		
$Obj->Add(
    array(
        F_NAME_ => "n_doclicki",
        F_ALIAS_ => "click",
        F_HELP_ => "Contro click",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "123",
        C_SHOW_ => "n_estadoi.get()=='Cerrada'",
        C_VIEW_ => "false",
        F_FORMULA_ => "if( !openSubform   ){  document.getElementById(|{cap`n_deti`Detalle de Nota de Credito}|).click(); openSubform=true; }else{openSubform=false;  }",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));		

$Obj->Add(
    array(
        F_NAME_ => "n_open_sub",
        F_ALIAS_ => "Abre Subformulario",
        F_HELP_ => "Abre Subformulario",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "124",
        C_VIEW_ => "false",
		C_SHOW_ => "n_estadoi.get()=='Abierta'",
        F_FORMULA_ => "document.getElementById(|{n_det}|).setAttribute(|{hidden}|,|{false}|); document.getElementById(|{hbox_n_det}|).setAttribute(|{height}|,|{280}|);",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));
$Obj->Add(
    array(
        F_NAME_ => "n_open_subi",
        F_ALIAS_ => "Abre Subformulario",
        F_HELP_ => "Abre Subformulario",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "124",
        C_VIEW_ => "false",
		C_SHOW_ => "n_estadoi.get()=='Cerrada'",
        F_FORMULA_ => "document.getElementById(|{n_deti}|).setAttribute(|{hidden}|,|{false}|); document.getElementById(|{hbox_n_deti}|).setAttribute(|{height}|,|{280}|);",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));		

$Obj->Add(
    array(
        F_NAME_ => "n_cob_efectivo",
        F_ALIAS_ => "Cobro en Efectivo",
        F_HELP_ => "Cobro en Efectivo",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_ORD_ => "134",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_conv_cod",
        F_ALIAS_ => "Codigo Convenio",
        F_HELP_ => "Codigo Convenio Tarjeta",
        F_TYPE_ => "text",
        F_LENGTH_ => "4",
        F_DEC_ => "0",
        F_ORD_ => "144",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_monto_conv",
        F_ALIAS_ => "Monto Cobrado con Convenio",
        F_HELP_ => "Monto Cobrado con Convenio",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_ORD_ => "154",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_moneda",
        F_ALIAS_ => "Moneda",
        F_HELP_ => "Moneda",
        F_TYPE_ => "text",
        F_LENGTH_ => "4",
        F_ORD_ => "164",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_fact_cont",
        F_ALIAS_ => "Factura Contable",
        F_HELP_ => "Factura Contable",
        F_TYPE_ => "text",
        F_LENGTH_ => "11",
        F_DEC_ => "0",
        F_ORD_ => "174",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_lock_anul",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "180",
        C_VIEW_ => "false",
        F_FORMULA_ => "if(n_estado.get()=='Anulada'){enableAcceptButton()}else{disableAcceptButton()}",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_voucher",
        F_ALIAS_ => "Voucher",
        F_HELP_ => "Voucher",
        F_TYPE_ => "text",
        F_LENGTH_ => "24",
        F_ORD_ => "190",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_suc",
        F_ALIAS_ => "Suc",
        F_HELP_ => "Suc",
        F_TYPE_ => "text",
        F_LENGTH_ => "4",
        F_ORD_ => "200",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_cant_filas",
        F_ALIAS_ => "Cant Filas",
        F_HELP_ => "Cant Filas",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT COUNT(d_fact) FROM fact_vent_det WHERE d_fact = '+n_nro.getVal()",
        F_QUERY_REF_ => "n_cant_filas.firstSQL&&n_nro.getVal()",
        F_LENGTH_ => "4",
        F_NODB_ => "1",
        F_ORD_ => "210",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_enable_delete",
        F_ALIAS_ => "Enable / Disable Delete Button",
        F_HELP_ => "Enable / Disable Delete Button",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "220",
        C_VIEW_ => "false",
        F_FORMULA_ => "if(n_cant_filas.getVal() > 0){ disableDeleteButton() }else{  enableDeleteButton() }",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "n_tipo",
        F_ALIAS_ => "Tipo",
        F_HELP_ => "Tipo",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Contado,Credito",
        F_ORD_ => "230",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
