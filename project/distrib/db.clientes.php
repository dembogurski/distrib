<?php
$Obj->name = "clientes";
$Obj->alias = "Clientes";
$Obj->help = "Clientes";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "clientes";
$Obj->Filter = "";
$Obj->Sort = "cli_nombre";
$Obj->p_insert = "'UPDATE clientes SET cli_nombre = UPPER(cli_nombre);'";
$Obj->p_change = "'UPDATE clientes SET cli_nombre = UPPER(cli_nombre);'";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "";
$Obj->Limit = "100";
$Obj->Add(
    array(
        F_NAME_ => "cli_id",
        F_ALIAS_ => "ID",
        F_HELP_ => "Identificador de Cliente",
        F_TYPE_ => "text",
        F_AUTONUM_ => "1",
        F_LENGTH_ => "8",
        F_DEC_ => "0",
        F_ORD_ => "5",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_ci",
        F_ALIAS_ => "Nro Cédula o R.U.C.",
        F_HELP_ => "Nro Cédula del Cliente o R.U.C.",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_tipo_doc",
        F_ALIAS_ => "Tipo Doc",
        F_HELP_ => "C.I. Paraguay,D.N.I. Argentina,  RG Brasil",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "C.I.,R.U.C.,D.N.I.,RG,Otro",
        F_REQUIRED_ => "1",
        F_ORD_ => "12",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "cli_verif",
        F_ALIAS_ => "Verificacion de Cliente",
        F_HELP_ => "Verificacion",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select count(cli_ci) from clientes where cli_ci ='+cli_ci.getStr()+' and cli_tipo_doc='+cli_tipo_doc.getStr()",
        F_QUERY_REF_ => "cli_ci.hasChanged()||cli_tipo_doc.hasChanged() ",
        F_LENGTH_ => "20",
        F_NODB_ => "1",
        F_ORD_ => "16",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_msgc",
        F_ALIAS_ => "Mensaje",
        F_HELP_ => "Mensaje",
        F_TYPE_ => "formula",
        F_LENGTH_ => "80",
        F_NODB_ => "1",
        F_ORD_ => "17",
        C_SHOW_ => "cli_verif.getVal()>0",
        F_FORMULA_ => "if(cli_verif.getVal()>0){'( ! ) Nro C.I. R.U.C. Ya Existe en la Base de Datos!!!' }else{'Ok'}",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_nombre",
        F_ALIAS_ => "Nombre y Apellido",
        F_HELP_ => "Nombre y Apellido del Cliente",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select cli_nombre from clientes where cli_ci ='+cli_ci.getStr()+' and cli_tipo_doc='+cli_tipo_doc.getStr()+' limit 1'",
        F_QUERY_REF_ => "  cli_ci.get()!=''&&cli_verif.getVal()>0",
        F_LENGTH_ => "50",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "18",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_cat",
        F_ALIAS_ => "Categoría",
        F_HELP_ => "Categoría del Cliente",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "categorias",
        F_SHOWFIELD_ => "cat_code,cat_descrip",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "40",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_limit",
        F_ALIAS_ => "Limite de Credito",
        F_HELP_ => "Limite de Credito",
        F_TYPE_ => "text",
        F_LENGTH_ => "14",
        F_DEC_ => "0",
        F_ORD_ => "42",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_nro_cta",
        F_ALIAS_ => "Nº de Cuenta Corriente",
        F_HELP_ => "Nº de Cuenta Corriente del cliente",
        F_TYPE_ => "text",
        F_LENGTH_ => "15",
		F_INLINE_ => "1",
        F_DEC_ => "0",
        F_ORD_ => "45",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_fecha_nac",
        F_ALIAS_ => "Fecha Nacimiento",
        F_HELP_ => "Fecha Nacimiento",
        F_TYPE_ => "date",
        F_ORD_ => "50",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_tel",
        F_ALIAS_ => "Telefono/s",
        F_HELP_ => "Telefono/s",
        F_TYPE_ => "text",
        F_LENGTH_ => "13",
        F_BROW_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_email",
        F_ALIAS_ => "Email",
        F_HELP_ => "Email",
        F_TYPE_ => "text",
        F_LENGTH_ => "50",
        F_ORD_ => "70",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_pais",
        F_ALIAS_ => "Pais",
        F_HELP_ => "Pais",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Paraguay,Brasil,Argentina,Otro",
        F_ORD_ => "100",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_dep_estado",
        F_ALIAS_ => "Departamento/Estado",
        F_HELP_ => "Departamento/Estado",
        F_TYPE_ => "text",
        F_LENGTH_ => "60",
        F_ORD_ => "110",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_ciudad",
        F_ALIAS_ => "Ciudad",
        F_HELP_ => "Ciudad",
        F_TYPE_ => "text",
        F_LENGTH_ => "60",
        F_ORD_ => "120",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_dir",
        F_ALIAS_ => "Dirección",
        F_HELP_ => "Dirección",
        F_TYPE_ => "text",
        F_MULTI_ => "1",
        F_LENGTH_ => "300",
        F_ORD_ => "130",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_fecha_ins",
        F_ALIAS_ => "Fecha Alta",
        F_HELP_ => "Fecha Alta",
        F_TYPE_ => "date",
        F_ORD_ => "150",
        V_DEFAULT_ => "thisDate_",
        C_VIEW_ => "false",
        C_CHANGE_ => "false",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_ventas",
        F_ALIAS_ => "Ventas",
        F_HELP_ => "Ventas (Para mejor Indice)",
        F_TYPE_ => "text",
        F_LENGTH_ => "12",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "152",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "cli_disableDel",
        F_ALIAS_ => "Inhabilita boton de borrar",
        F_HELP_ => "Inhabilita boton de borrar",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "160",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableDeleteButton()",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "170",
        C_SHOW_ => "cli_verif.getVal()>0",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton()",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cli_unlock",
        F_ALIAS_ => "Desbloquea el boton Insert/Accept",
        F_HELP_ => "Desbloqueael boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "180",
        C_SHOW_ => "cli_verif.getVal()<1",
        C_VIEW_ => "false",
        F_FORMULA_ => "enableAcceptButton()",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

?>
