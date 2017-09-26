<?php
$Obj->name = "bcos_chq_ter";
$Obj->alias = "Cheques de Terceros";
$Obj->help = "Cheques de Terceros";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "bcos_cheq_ter";
$Obj->Filter = "";
$Obj->Sort = "id, chq_fecha_pag DESC";
$Obj->p_insert = "'UPDATE bcos_cheq_ter SET chq_saldo = chq_valor WHERE chq_ref = '+chq_ref.getVal()+' '";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "chq_ref",
        F_ALIAS_ => "Referencia",
        F_HELP_ => "Referencia",
        F_TYPE_ => "text",
        F_REQUIRED_ => "1",
        F_ORD_ => "3",
        C_CHANGE_ => "operation==INSERT_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_trans",
        F_ALIAS_ => "Codigo de Transaccion",
        F_HELP_ => "Codigo de Transaccion",
        F_TYPE_ => "text",
        F_LENGTH_ => "4",
        F_ORD_ => "4",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_nodel",
        F_ALIAS_ => "Inhabilita boton de borrar",
        F_HELP_ => "Inhabilita boton de borrar",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "5",
        C_SHOW_ => "true",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableDeleteButton()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_bco",
        F_ALIAS_ => "Banco",
        F_HELP_ => "Banco",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "bcos",
        F_SHOWFIELD_ => "b_cod,b_nombre",
        F_LENGTH_ => "4",
        F_REQUIRED_ => "1",
        F_ORD_ => "5",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_bco_nom",
        F_ALIAS_ => "Banco",
        F_HELP_ => "Banco",
        F_TYPE_ => "text",
        F_RELATION_ => "1",
        F_RELTABLE_ => "bcos",
        F_SHOWFIELD_ => "b_nombre",
        F_RELFIELD_ => "b_cod",
        F_LOCALFIELD_ => "chq_bco",
        F_LENGTH_ => "60",
        F_NODB_ => "1",
        F_ORD_ => "6",
        F_INLINE_ => "1",
        C_VIEW_ => "operation==CHANGE_||operation==SHOW_",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_cta",
        F_ALIAS_ => "Cuenta",
        F_HELP_ => "Cuenta",
        F_TYPE_ => "text",
        F_LENGTH_ => "20",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_num",
        F_ALIAS_ => "Numero",
        F_HELP_ => "Numero del cheque",
        F_TYPE_ => "text",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "20",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_benef",
        F_ALIAS_ => "Librador",
        F_HELP_ => "Beneficiario del Cheque",
        F_TYPE_ => "text",
        F_LENGTH_ => "60",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "25",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_fecha_emis",
        F_ALIAS_ => "Fecha Emision",
        F_HELP_ => "Fecha Emision",
        F_TYPE_ => "date",
        F_QUERY_REF_ => "chq_fecha_emis.firstSQL",
        F_BROW_ => "1",
        F_ORD_ => "30",
        C_VIEW_ => "chq_estado.get()!=''",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_fecha_pag",
        F_ALIAS_ => "Fecha Limite cobro",
        F_HELP_ => "Fecha Limite cobro del cheque",
        F_TYPE_ => "date",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_valor",
        F_ALIAS_ => "Valor",
        F_HELP_ => "Valor del cheque",
        F_TYPE_ => "text",
        F_LENGTH_ => "15",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "60",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_moneda",
        F_ALIAS_ => "Moneda",
        F_HELP_ => "Moneda utilizada",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "caja_monedas",
        F_SHOWFIELD_ => "m_cod,m_descri",
        F_LENGTH_ => "15",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "65",
        F_INLINE_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_cotiz",
        F_ALIAS_ => "Cotizacion del dia",
        F_HELP_ => "Cotizacion del dia",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select obtener_cambio('+chq_moneda.getStr()+');'",
        F_QUERY_REF_ => "chq_moneda.hasChanged()||chq_cotiz.firstSQL",
        F_LENGTH_ => "8",
        F_DEC_ => "0",
        F_ORD_ => "68",
        F_INLINE_ => "1",
        C_VIEW_ => "true",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_moneda_ref",
        F_ALIAS_ => "Monto (Ref) ",
        F_HELP_ => "Monto (Moneda Referencia) ",
        F_TYPE_ => "formula",
        F_LENGTH_ => "12",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_TOTAL_ => "1",
        F_ORD_ => "80",
        F_INLINE_ => "1",
        C_CHANGE_ => "chq_valor.hasChanged()||chq_cotiz.hasChanged()",
        F_FORMULA_ => "chq_cotiz.getVal()*chq_valor.getVal()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_suc",
        F_ALIAS_ => "Suc",
        F_HELP_ => "Obtiene la localidad del usuario actual",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select p.local from p_users p where name =|{'+p_user_+'}|'",
        F_QUERY_REF_ => "chq_suc.firstSQL",
        F_RELTABLE_ => "p_users",
        F_LENGTH_ => "3",       
        F_ORD_ => "85",
        C_VIEW_ => "true",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Pendiente,Cobrado,Depositado,Devuelto,Anulado",
        F_LENGTH_ => "15",
        F_BROW_ => "1",
        F_ORD_ => "110",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_mot_anul",
        F_ALIAS_ => "Motivo de Anulación",
        F_HELP_ => "Motivo de Anulación",
        F_TYPE_ => "text",
        F_LENGTH_ => "60",        
        F_ORD_ => "120",
        C_VIEW_ => "chq_estado.get()=='Anulado'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "chq_fecha_ins",
        F_ALIAS_ => "Fecha Registro",
        F_HELP_ => "Fecha Registro",
        F_TYPE_ => "date",        
        F_ORD_ => "150",
        V_DEFAULT_ => "thisDate_",
        C_VIEW_ => "false",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));
$Obj->Add(
    array(
        F_NAME_ => "chq_saldo",
        F_ALIAS_ => "Saldo",
        F_HELP_ => "Saldo",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "160",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));		

?>
