<?php
$Obj->name = "factura_compra";
$Obj->alias = "Entrada Directa de Inventario";
$Obj->help = "Entrada Directa de Inventario";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "factura_compra";
$Obj->Filter = "";
$Obj->Sort = "c_fecha desc";
$Obj->p_insert = "";
$Obj->p_change = "'select cerrar_compra('+c_ref.getVal()+','+c_estado.getStr()+')'";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "c_ref",
        F_ALIAS_ => "N°",
        F_HELP_ => "Referencia ",
        F_TYPE_ => "text",
        F_AUTONUM_ => "1",
        F_LENGTH_ => "8",
        F_BROW_ => "1",
        F_ORD_ => "10",
        C_VIEW_ => "true",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_tipo_doc",
        F_ALIAS_ => "Tipo de Documento",
        F_HELP_ => "Tipo de Documento",
        F_TYPE_ => "formula",
        F_ORD_ => "12",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        F_FORMULA_ => "1+1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_empr",
        F_ALIAS_ => "Empresa",
        F_HELP_ => "Empresa",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "empresas",
        F_SHOWFIELD_ => "emp_cod,emp_nombre",
        F_LENGTH_ => "2",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "15",
        F_INLINE_ => "1",
        C_CHANGE_ => "operation==INSERT_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_prov",
        F_ALIAS_ => "Proveedor",
        F_HELP_ => "Proveedor de los productos",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "proveedores",
        F_SHOWFIELD_ => "prov_cod,prov_nombre",
        F_FILTER_ => "'true ORDER BY prov_nombre'",
        F_LENGTH_ => "5",
        F_REQUIRED_ => "1",
        F_ORD_ => "18",
		C_SHOW_ => "false",
        F_INLINE_ => "1",
        V_DEFAULT_ => "'1'",
        C_CHANGE_ => "operation==INSERT_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_bloq_ins",
        F_ALIAS_ => "Bloquea Insertar",
        F_HELP_ => "Bloquea Insertar",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "19",
        C_SHOW_ => "operation==INSERT_",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_prov_nombre",
        F_ALIAS_ => "Proveedor",
        F_HELP_ => "Proveedor",
        F_TYPE_ => "text",
        F_RELATION_ => "1",
        F_RELTABLE_ => "proveedores",
        F_SHOWFIELD_ => "prov_nombre",
        F_RELFIELD_ => "prov_cod",
        F_LOCALFIELD_ => "c_prov",
        F_LENGTH_ => "40",
        F_BROW_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "20",
        C_VIEW_ => "operation==BROWSE_",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_fecha",
        F_ALIAS_ => "Fecha actual",
        F_HELP_ => "Fecha actual",
        F_TYPE_ => "date",
        F_LENGTH_ => "10",
        F_REQUIRED_ => "1",
        F_ORD_ => "21",
        V_DEFAULT_ => "thisDate_",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_fecha_fac",
        F_ALIAS_ => "Fecha Factura",
        F_HELP_ => "Fecha Compra (Factura)",
        F_TYPE_ => "date",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "25",
        F_INLINE_ => "1",
        V_DEFAULT_ => "thisDate_",
        C_CHANGE_ => "operation!=SHOW_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_factura",
        F_ALIAS_ => "Factura",
        F_HELP_ => "Factura de compra",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_ORD_ => "70",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        C_CHANGE_ => "operation==INSERT_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_moneda",
        F_ALIAS_ => "Moneda",
        F_HELP_ => "Moneda utilizada para la compra",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "caja_monedas",
        F_SHOWFIELD_ => "m_descri",
        F_LENGTH_ => "10",
        F_REQUIRED_ => "1",
        F_ORD_ => "75",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_cotiz",
        F_ALIAS_ => "Cotizacion",
        F_HELP_ => "Cotizacion del día",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select obtener_cambio('+c_moneda.getStr()+');'",
        F_QUERY_REF_ => "c_moneda.hasChanged()",
        F_LENGTH_ => "8",
        F_DEC_ => "0",
        F_ORD_ => "78",
        F_INLINE_ => "1",
        C_SHOW_ => "c_moneda.get()!=''",
        C_VIEW_ => "false",
        C_CHANGE_ => "c_moneda.get()!='G$'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_fn",
        F_ALIAS_ => "Flete",
        F_HELP_ => "Flete Nacional",
        F_TYPE_ => "text",
        F_LENGTH_ => "12",
        F_DEC_ => "2",
        F_ORD_ => "80",
        C_VIEW_ => "false",
        C_CHANGE_ => "operation==INSERT_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_otros",
        F_ALIAS_ => "Otros Gastos",
        F_HELP_ => "Otros gastos ",
        F_TYPE_ => "text",
        F_LENGTH_ => "12",
        F_DEC_ => "2",
        F_ORD_ => "82",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        C_CHANGE_ => "operation==INSERT_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_valor_total",
        F_ALIAS_ => "Valor Total",
        F_HELP_ => "Valor Total",
        F_TYPE_ => "text",
        F_LENGTH_ => "14",
        F_DEC_ => "2",
        F_REQUIRED_ => "1",
        F_TOTAL_ => "1",
        F_ORD_ => "85",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_porc_rec",
        F_ALIAS_ => "Sobre Costo",
        F_HELP_ => "% de Recargo de Mercaderia",
        F_TYPE_ => "formula",
        F_LENGTH_ => "7",
        F_DEC_ => "2",
        F_ORD_ => "91",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        C_CHANGE_ => "c_fn.hasChanged()||c_otros.hasChanged()||c_valor_total.hasChanged()",
        F_FORMULA_ => "(( (c_fn.getVal()+c_otros.getVal() ) / c_valor_total.getVal()  )  * 100).toFixed(2)",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado de la Entrada",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Abierta,Cerrada",
        F_LENGTH_ => "15",
        F_BROW_ => "1",
        F_ORD_ => "92",
        C_SHOW_ => "operation!=INSERT_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_tipo",
        F_ALIAS_ => "Forma de Pago",
        F_HELP_ => "Tipo de Factura o Forma de pago",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Contado,Credito",
        F_LENGTH_ => "10",
        F_REQUIRED_ => "1",
        F_ORD_ => "92",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_aut_gen",
        F_ALIAS_ => "Generar Entrada",
        F_HELP_ => "Genera una nueva Entrada directa",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "No,Si",
        F_LENGTH_ => "2",
        F_NODB_ => "1",
        F_ORD_ => "95",
        C_SHOW_ => "(operation==INSERT_&&allValid&&c_tipo.get()!='')",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_gen",
        F_ALIAS_ => "Genera Entrada",
        F_HELP_ => "Genera Compra",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT gen_compra('+c_ref.getVal()+', '+c_empr.getStr()+','+c_prov.getVal()+', '+c_fecha.getStr()+', '+c_fecha_fac.getStr()+',  '+c_factura.getStr()+', '+c_moneda.getStr()+', '+c_cotiz.getVal()+','+c_fn.getVal()+','+c_otros.getVal()+','+c_valor_total.getVal()+','+c_porc_rec.getVal()+','+c_tipo.getStr()+',2)'",
        F_QUERY_REF_ => "el['c_aut_gen'].get()=='Si'&&el['c_gen'].firstSQL",
        F_LENGTH_ => "20",
        F_NODB_ => "1",
        F_ORD_ => "98",
        C_SHOW_ => "operation==INSERT_",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_change",
        F_ALIAS_ => "Prepara para alteración",
        F_HELP_ => "Prepara para aleración",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "100",
        C_SHOW_ => "el['c_gen'].get()==1",
        C_VIEW_ => "false",
        F_FORMULA_ => "operation=CHANGE_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_st",
        F_ALIAS_ => "Tienda/Store Number",
        F_HELP_ => "Tienda/Store Number",
        F_TYPE_ => "text",
        F_LENGTH_ => "24",
        F_NODB_ => "1",
        F_ORD_ => "106",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_print",
        F_ALIAS_ => "Imprimir Factura",
        F_HELP_ => "Imprimir",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.fact_compra",
        F_NODB_ => "1",
        F_ORD_ => "110",
        F_INLINE_ => "1",
        C_VIEW_ => "(operation==CHANGE_||c_estado.get()=='Cerrada')&&false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "__msg",
        F_ALIAS_ => "( ! ) Atencion",
        F_HELP_ => "( ! ) Atencion",
        F_TYPE_ => "formula",
        F_LENGTH_ => "60",
        F_NODB_ => "1",
        F_ORD_ => "112",
        C_SHOW_ => "c_estado.get()=='Cerrada'",
        F_FORMULA_ => "'ATENCION! Una vez cerrada la Factura no debera Reeditarla'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_compras_det",
        F_ALIAS_ => "Detalle de la Compra",
        F_HELP_ => "Detalle de la Compra",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'p_ref='+c_ref.getVal()+''",
        F_LINK_ => "db.entrada_det",
        F_SEND_ => "c_ref.get()",
        F_NODB_ => "1",
        F_ORD_ => "115",
        C_SHOW_ => "((c_estado.get()=='Abierta'&&operation!=INSERT_) )",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "__disableDel",
        F_ALIAS_ => "Inhabilita boton de borrar",
        F_HELP_ => "Inhabilita boton de borrar",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "160",
        C_SHOW_ => "c_estado.get()=='Cerrada'",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableDeleteButton()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "f_doclick",
        F_ALIAS_ => "click",
        F_HELP_ => "Contro click",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "170",
        C_VIEW_ => "false",
        F_FORMULA_ => "if( !openSubform   ){  document.getElementById(|{cap`c_compras_det`Detalle de la Compra}|).click(); openSubform=true; }else{openSubform=false;  }",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

$Obj->Add(
    array(
        F_NAME_ => "f_open_sub",
        F_ALIAS_ => "Abre Subformulario",
        F_HELP_ => "Abre Subformulario",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "180",
        C_VIEW_ => "false",
        F_FORMULA_ => "document.getElementById(|{c_compras_det}|).setAttribute(|{hidden}|,|{false}|); document.getElementById(|{hbox_c_compras_det}|).setAttribute(|{height}|,|{200}|);",
        G_SHOW_ => "68",
        G_CHANGE_ => "68"));

?>
