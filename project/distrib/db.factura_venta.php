<?php
$Obj->name = "factura_venta";
$Obj->alias = "Factura de Venta";
$Obj->help = "Factura de Venta";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "factura_venta";
$Obj->Filter = "";
$Obj->Sort = "f_nro desc";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "f_lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "4",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton() ; disableDeleteButton();  ",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_tipo_doc",
        F_ALIAS_ => "Tipo Documento",
        F_HELP_ => "Tipo Documento",
        F_TYPE_ => "formula",
        F_ORD_ => "6",
        C_VIEW_ => "false",
        F_FORMULA_ => "3",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_nro",
        F_ALIAS_ => "Nº Factura",
        F_HELP_ => "Nº Factura",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select gen_venta('+f_cli_cod.getVal()+','+f_cat.getVal()+','+f_usuario.getStr()+',3);'",
        F_QUERY_REF_ => "f_gen.hasChanged()&&f_gen.get()=='Si'&& f_nro.getVal()==0",
        F_LENGTH_ => "14",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "10",
        C_CHANGE_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_usuario",
        F_ALIAS_ => "Usuario",
        F_HELP_ => "Usuario",
        F_TYPE_ => "formula",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_ORD_ => "11",
        F_INLINE_ => "1",
        C_VIEW_ => "operation==CHANGE_",
        F_FORMULA_ => "p_user_",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_fecha",
        F_ALIAS_ => "Fecha",
        F_HELP_ => "Fecha",
        F_TYPE_ => "date",
        F_BROW_ => "1",
        F_ORD_ => "12",
        F_INLINE_ => "1",
        V_DEFAULT_ => "thisDate_",
        C_VIEW_ => "operation==CHANGE_",
        C_CHANGE_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_b_cli",
        F_ALIAS_ => "Buscar Cliente",
        F_HELP_ => "Buscar Cliente",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_NODB_ => "1",
        F_ORD_ => "20",
        C_CHANGE_ => "f_gen.get()=='No'",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_cli_cod",
        F_ALIAS_ => "Cliente",
        F_HELP_ => "Cliente",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "f_b_cli.hasChanged() && operation==CONSULT_",
        F_OPTIONS_ => "1",
        F_RELTABLE_ => "clientes",
        F_SHOWFIELD_ => "cli_id,concat(cli_nombre,|{   }|,cli_tipo_doc,|{: }|,cli_ci)",
        F_FILTER_ => "'cli_ci like |{'+f_b_cli.get()+'%}| or cli_nombre like |{'+f_b_cli.get()+'%}| LIMIT 26' ",
        F_ORD_ => "30",
        F_INLINE_ => "1",
        V_DEFAULT_ => "1",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_cli_nombre",
        F_ALIAS_ => "Cliente",
        F_HELP_ => "Cliente",
        F_TYPE_ => "text",
        F_RELATION_ => "1",
        F_RELTABLE_ => "clientes",
        F_SHOWFIELD_ => "cli_nombre",
        F_RELFIELD_ => "cli_id",
        F_LOCALFIELD_ => "f_cli_cod",
        F_LENGTH_ => "50",
        F_BROW_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "31",
        F_INLINE_ => "1",
        C_VIEW_ => "operation!=INSERT_&&operation!=CONSULT_",
        C_CHANGE_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_cat",
        F_ALIAS_ => "Cat.",
        F_HELP_ => "Categoria",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select cli_cat from clientes where cli_id = '+f_cli_cod.getVal()",
        F_QUERY_REF_ => "f_cli_cod.hasChanged()",
        F_LENGTH_ => "3",
        F_BROW_ => "1",
        F_ORD_ => "32",
        F_INLINE_ => "1",
        V_DEFAULT_ => "1",
        C_CHANGE_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_edit_cli",
        F_ALIAS_ => "Edición",
        F_HELP_ => "Editar Cliente / Registrar",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => ",Editar,Registrar",
        F_NODB_ => "1",
        F_ORD_ => "33",
        F_INLINE_ => "1",
        C_SHOW_ => "operation==CONSULT_&&f_cli_cod.getVal()>0",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_cli_form",
        F_ALIAS_ => "Editar Cliente",
        F_HELP_ => "Editar Cliente",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'cli_id =  '+f_cli_cod.getVal()+ ' and cli_id > 1'",
        F_LINK_ => "db.clientes",
        F_SEND_ => "if(operation==CONSULT_&&f_edit_cli.get()=='Editar'){ f_cli_cod.get() }else{ 1 }",
        F_NODB_ => "1",
        F_ORD_ => "34",
        C_SHOW_ => "operation==CONSULT_&&f_edit_cli.get()!=''",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Abierta,En_caja,Presupuesto,Anulada",
        F_ORD_ => "36",
        C_VIEW_ => "operation==CHANGE_",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_ticket",
        F_ALIAS_ => "Imprimir Ticket",
        F_HELP_ => "Imprimir Ticket",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.ticket",
        F_NODB_ => "1",
        F_ORD_ => "38",
        F_INLINE_ => "1",
        C_SHOW_ => "operation==CHANGE_&&f_estado.get()!='Anulada'&&f_estado.get()=='Abierta'",
        G_SHOW_ => "96",
        G_CHANGE_ => "96"));

$Obj->Add(
    array(
        F_NAME_ => "f_caja",
        F_ALIAS_ => "Ir a Caja",
        F_HELP_ => "Establecer formas de Pago",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.caja",
        F_NODB_ => "1",
        F_ORD_ => "38",
        F_INLINE_ => "1",
        C_SHOW_ => "operation==CHANGE_&&f_estado.get()!='Anulada'&&f_estado.get()=='En_caja'",
        G_SHOW_ => "96",
        G_CHANGE_ => "96"));

$Obj->Add(
    array(
        F_NAME_ => "f_enviar_caja",
        F_ALIAS_ => "Enviar a Caja",
        F_HELP_ => "Enviar a Caja",
        F_TYPE_ => "proc",
        F_QUERY_ => "'update factura_venta set f_estado = |{En_caja}| where f_nro = '+f_nro.getVal()",
        F_NODB_ => "1",
        F_ORD_ => "39",
        F_INLINE_ => "1",
        C_SHOW_ => "f_estado.get()=='En_caja'",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_presupuesto",
        F_ALIAS_ => "Imprimir Presupuesto",
        F_HELP_ => "Imprimir Presupuesto",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.presupuesto",
        F_NODB_ => "1",
        F_ORD_ => "40",
        F_INLINE_ => "1",
        C_SHOW_ => "operation==CHANGE_&&f_estado.get()=='Presupuesto'",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_motivo_anul",
        F_ALIAS_ => "Motivo de Anulacion",
        F_HELP_ => "Motivo de Anulacion",
        F_TYPE_ => "text",
        F_MULTI_ => "1",
        F_LENGTH_ => "1024",
        F_REQUIRED_ => "1",
        F_ORD_ => "45",
        C_VIEW_ => "f_estado.get()=='Anulada'",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_gen",
        F_ALIAS_ => "Generar Factura",
        F_HELP_ => "Generar Factura",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "No,Si",
        F_NODB_ => "1",
        F_ORD_ => "46",
        C_VIEW_ => "operation==CONSULT_&&f_cli_cod.getVal()>0",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_set_change",
        F_ALIAS_ => "Operacion = Change",
        F_HELP_ => "Operacion = Change",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "52",
        C_SHOW_ => "f_gen.get()=='Si'",
        C_VIEW_ => "false",
        F_FORMULA_ => "operation=CHANGE_",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_det",
        F_ALIAS_ => "Detalle de Factura",
        F_HELP_ => "Detalle de Factura de Venta",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'d_fact = '+f_nro.getVal()",
        F_LINK_ => "db.fact_vent_det",
        F_SEND_ => "f_nro.getVal()",
        F_NODB_ => "1",
        F_ORD_ => "62",
        C_SHOW_ => "operation==CHANGE_&&f_estado.get()!='Anulada'&&f_estado.get()!='En_caja'",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_limit",
        F_ALIAS_ => "Limite de Items",
        F_HELP_ => "Limite de Items",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT valor FROM   parametros WHERE clave LIKE |{limite_items_x_venta}|'",
        F_QUERY_REF_ => "f_limit.firstSQL",
        F_NODB_ => "1",
        F_ORD_ => "72",
        C_VIEW_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_doclick",
        F_ALIAS_ => "click",
        F_HELP_ => "Contro click",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "123",
        C_VIEW_ => "false",
        F_FORMULA_ => "if( !openSubform   ){  document.getElementById(|{cap`f_det`Detalle de Factura}|).click(); openSubform=true; }else{openSubform=false;  }",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_open_sub",
        F_ALIAS_ => "Abre Subformulario",
        F_HELP_ => "Abre Subformulario",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "124",
        C_VIEW_ => "false",
        F_FORMULA_ => "document.getElementById(|{f_det}|).setAttribute(|{hidden}|,|{false}|); document.getElementById(|{hbox_f_det}|).setAttribute(|{height}|,|{280}|);",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));
		
	

$Obj->Add(
    array(
        F_NAME_ => "f_cob_efectivo",
        F_ALIAS_ => "Cobro en Efectivo",
        F_HELP_ => "Cobro en Efectivo",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_ORD_ => "134",
        C_VIEW_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_conv_cod",
        F_ALIAS_ => "Codigo Convenio",
        F_HELP_ => "Codigo Convenio Tarjeta",
        F_TYPE_ => "text",
        F_LENGTH_ => "4",
        F_DEC_ => "0",
        F_ORD_ => "144",
        C_VIEW_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_monto_conv",
        F_ALIAS_ => "Monto Cobrado con Convenio",
        F_HELP_ => "Monto Cobrado con Convenio",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_ORD_ => "154",
        C_VIEW_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_moneda",
        F_ALIAS_ => "Moneda",
        F_HELP_ => "Moneda",
        F_TYPE_ => "text",
        F_LENGTH_ => "4",
        F_ORD_ => "164",
        C_VIEW_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_fact_cont",
        F_ALIAS_ => "Factura Contable",
        F_HELP_ => "Factura Contable",
        F_TYPE_ => "text",
        F_LENGTH_ => "11",
        F_DEC_ => "0",
        F_ORD_ => "174",
        C_VIEW_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_lock_anul",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "180",
        C_VIEW_ => "false",
        F_FORMULA_ => "if(f_estado.get()=='Anulada'){enableAcceptButton()}else{disableAcceptButton()}",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_voucher",
        F_ALIAS_ => "Voucher",
        F_HELP_ => "Voucher",
        F_TYPE_ => "text",
        F_LENGTH_ => "24",
        F_ORD_ => "190",
        C_VIEW_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_suc",
        F_ALIAS_ => "Suc",
        F_HELP_ => "Suc",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select local from p_users where name =|{'+p_user_+'}|'",
        F_QUERY_REF_ => "f_suc.firstSQL",
        F_LENGTH_ => "4",
        F_ORD_ => "200",
		C_CHANGE_ => "false",
        C_VIEW_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_cant_filas",
        F_ALIAS_ => "Cant Filas",
        F_HELP_ => "Cant Filas",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT COUNT(d_fact) FROM fact_vent_det WHERE d_fact = '+f_nro.getVal()",
        F_QUERY_REF_ => "f_cant_filas.firstSQL&&f_nro.getVal()",
        F_LENGTH_ => "4",
        F_NODB_ => "1",
        F_ORD_ => "210",
        C_VIEW_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_enable_delete",
        F_ALIAS_ => "Enable / Disable Delete Button",
        F_HELP_ => "Enable / Disable Delete Button",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "220",
        C_VIEW_ => "false",
        F_FORMULA_ => "if(f_cant_filas.getVal() > 0){ disableDeleteButton() }else{  enableDeleteButton() }",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_cerrar",
        F_ALIAS_ => "Cerrar Ventana",
        F_HELP_ => "Cerrar Ventana",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "222",
        C_SHOW_ => "f_enviar_caja.get()",
        F_FORMULA_ => "self.close()",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_tipo",
        F_ALIAS_ => "Tipo",
        F_HELP_ => "Tipo",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Contado,Credito",
        F_ORD_ => "230",
        C_VIEW_ => "false",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

?>
