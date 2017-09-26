<?php
$Obj->name = "cuotas_cob";
$Obj->alias = "Cuotas Cobrar";
$Obj->help = "Cuotas Cobrar";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "cuotas";
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
        F_ALIAS_ => "Lock",
        F_HELP_ => "Lock",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "2",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableDeleteButton()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "msg_ok",
        F_ALIAS_ => "( ! )",
        F_HELP_ => "Mensaje",
        F_TYPE_ => "formula",
        F_LENGTH_ => "80",
        F_NODB_ => "1",
        F_ORD_ => "2",
        C_VIEW_ => "c_cobrar_cheque.get() || c_contado.get()",
        F_FORMULA_ => "'La cuota ha sido cobrada con Exito! Recargando en 5 Segundos'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_lock2",
        F_ALIAS_ => "Lock",
        F_HELP_ => "Lock",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "3",
        C_SHOW_ => "operation==CHANGE_",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_suc",
        F_ALIAS_ => "Suc",
        F_HELP_ => "Suc",
        F_TYPE_ => "text",
        F_LENGTH_ => "4",
        F_NODB_ => "1",
        F_ORD_ => "4",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_usuario",
        F_ALIAS_ => "Usuario",
        F_HELP_ => "Usuario",
        F_TYPE_ => "formula",
        F_LENGTH_ => "20",
        F_NODB_ => "1",
        F_ORD_ => "6",
        F_INLINE_ => "1",
        F_FORMULA_ => "p_user_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_ref_caja",
        F_ALIAS_ => "Nro Caja",
        F_HELP_ => "Nro Caja",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT cj_ref FROM caja WHERE cj_estado = |{Abierta}| AND cj_suc = '+c_suc.getStr()+' ORDER BY id DESC LIMIT 1'",
        F_QUERY_REF_ => "c_ref_caja.firstSQL&&c_suc.get()!=''",
        F_LENGTH_ => "6",
        F_NODB_ => "1",
        F_ORD_ => "7",
        F_INLINE_ => "1",
        C_VIEW_ => "false",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_fact",
        F_ALIAS_ => "Factura",
        F_HELP_ => "Factura",
        F_TYPE_ => "text",
        F_LENGTH_ => "11",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_nro_cuota",
        F_ALIAS_ => "Nro Cuota",
        F_HELP_ => "Nro Cuota",
        F_TYPE_ => "text",
        F_LENGTH_ => "3",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "20",
        F_INLINE_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_venc",
        F_ALIAS_ => "Vencimiento",
        F_HELP_ => "Vencimiento",
        F_TYPE_ => "date",
        F_BROW_ => "1",
        F_ORD_ => "24",
        F_INLINE_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_monto",
        F_ALIAS_ => "Monto",
        F_HELP_ => "Monto",
        F_TYPE_ => "text",
        F_LENGTH_ => "14",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "30",
        G_SHOW_ => "96",
        G_CHANGE_ => "96"));

$Obj->Add(
    array(
        F_NAME_ => "c_moneda",
        F_ALIAS_ => "Moneda",
        F_HELP_ => "Moneda",
        F_TYPE_ => "text",
        F_LENGTH_ => "4",
        F_ORD_ => "40",
        F_INLINE_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_cotiz",
        F_ALIAS_ => "Cotizacion",
        F_HELP_ => "Cotizacion",
        F_TYPE_ => "text",
        F_LENGTH_ => "8",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_monto_ref",
        F_ALIAS_ => "Monto Gs",
        F_HELP_ => "Monto Gs",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "60",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_saldo",
        F_ALIAS_ => "Saldo",
        F_HELP_ => "Saldo",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "80",
        F_INLINE_ => "1",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado",
        F_TYPE_ => "formula",
        F_BROW_ => "1",
        F_ORD_ => "90",
        F_INLINE_ => "1",
        F_FORMULA_ => "if(c_entrega.getVal()==c_saldo.getVal()){'Cancelada'}else{'Pendiente'}",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "c_forma",
        F_ALIAS_ => "Forma de Cobro",
        F_HELP_ => "Forma de Cobro",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => ",Efectivo,Cheque",
        F_NODB_ => "1",
        F_ORD_ => "130",
        C_VIEW_ => "operation==CHANGE_",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_cheques",
        F_ALIAS_ => "Cheque Nro:",
        F_HELP_ => "Cheques Registrados",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "c_forma.hasChanged()",
        F_RELTABLE_ => "bcos_cheq_ter",
        F_SHOWFIELD_ => "chq_num,concat(|{Valor: }|,chq_moneda_ref,|{  Saldo: }|,chq_saldo)",
        F_FILTER_ => "'chq_saldo > 0'",
        F_NODB_ => "1",
        F_ORD_ => "136",
        F_INLINE_ => "1",
        C_SHOW_ => "c_forma.get()!=''",
        C_VIEW_ => "c_forma.get()=='Cheque'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_saldo_chq",
        F_ALIAS_ => "Saldo Cheque",
        F_HELP_ => "Saldo Cheque",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT chq_saldo FROM bcos_cheq_ter WHERE chq_num = '+c_cheques.getStr()",
        F_QUERY_REF_ => "c_cheques.hasChanged()",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_NODB_ => "1",
        F_ORD_ => "140",
        F_INLINE_ => "1",
        C_VIEW_ => "c_forma.get()=='Cheque'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_entrega",
        F_ALIAS_ => "Entrega Actual",
        F_HELP_ => "Entrega Actual",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT 0'",
        F_QUERY_REF_ => "c_entrega.firstSQL",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_ORD_ => "140",
        F_INLINE_ => "1",
        C_VIEW_ => "c_forma.get()!=''",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_reg_cheque",
        F_ALIAS_ => "Registrar un Cheque",
        F_HELP_ => "Registrar un Cheque",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "No,Si",
        F_NODB_ => "1",
        F_ORD_ => "141",
        C_SHOW_ => "c_forma.get()=='Cheque'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_chq_new",
        F_ALIAS_ => "Nuevo Cheque",
        F_HELP_ => "Nuevo Cheque",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'id > 0'",
        F_LINK_ => "db.bcos_cheq_ter",
        F_SEND_ => "c_fact.get()",
        F_NODB_ => "1",
        F_ORD_ => "142",
        C_SHOW_ => "c_forma.get()=='Cheque'&&c_reg_cheque.get()=='Si'",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "c_isuf",
        F_ALIAS_ => "ATENCION!",
        F_HELP_ => "Saldo Cheque Insuficiente",
        F_TYPE_ => "formula",
        F_LENGTH_ => "60",
        F_NODB_ => "1",
        F_ORD_ => "148",
        C_SHOW_ => "c_forma.get()=='Cheque'&&c_entrega.getVal()>0&&(c_entrega.getVal() > c_saldo_chq.getVal() )",
        F_FORMULA_ => "'Saldo de Cheque Insuficiente! Ingrese un monto menor!'",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "c_cobrar",
        F_ALIAS_ => "Cobrar",
        F_HELP_ => "Cobrar",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "No,Si",
        F_NODB_ => "1",
        F_ORD_ => "150",
        C_SHOW_ => "c_entrega.getVal()<=c_saldo.getVal()&&c_forma.get()!=''&&c_entrega.getVal()>0",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_contado",
        F_ALIAS_ => "   Confirme cobrar en Efectivo   ",
        F_HELP_ => "Cobrar en Efectivo",
        F_TYPE_ => "proc",
        F_QUERY_ => "'select cob_cuota_efectivo('+c_fact.getVal()+','+c_nro_cuota.getVal()+','+c_ref_caja.getVal()+','+c_usuario.getStr()+','+c_entrega.getVal()+')'",
        F_NODB_ => "1",
        F_ORD_ => "160",
        F_INLINE_ => "1",
        C_SHOW_ => "c_forma.get()=='Efectivo'&&c_entrega.getVal()<=c_saldo.getVal()&&c_cobrar.get()=='Si'&&c_entrega.getVal()>0  && !c_contado.get()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "c_cobrar_cheque",
        F_ALIAS_ => "   Confirme cobrar Con Cheque   ",
        F_HELP_ => "Cobrar en Efectivo",
        F_TYPE_ => "proc",
        F_QUERY_ => "'select cob_cuota_cheque('+c_fact.getVal()+','+c_nro_cuota.getVal()+','+c_ref_caja.getVal()+','+c_usuario.getStr()+','+c_entrega.getVal()+','+c_cheques.getStr()+')'",
        F_NODB_ => "1",
        F_ORD_ => "160",
        F_INLINE_ => "1",
        C_SHOW_ => "c_forma.get()=='Cheque'&&c_entrega.getVal()<=c_saldo.getVal()&&c_cobrar.get()=='Si'&&c_entrega.getVal()>0&&(c_entrega.getVal() <= c_saldo_chq.getVal()  && !c_cobrar_cheque.get())",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "__goback",
        F_ALIAS_ => "Volver",
        F_HELP_ => "Volver",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "200",
        F_INLINE_ => "1",
        C_SHOW_ => "c_cobrar_cheque.get() || c_contado.get()",
        C_VIEW_ => "false",
        F_FORMULA_ => "window.opener.location.reload(); setTimeout('self.close()',5000)",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "style",
        F_ALIAS_ => "Style 0",
        F_HELP_ => "Style 0",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "210",
        C_VIEW_ => "false",
        F_FORMULA_ => "document.getElementById(|{msg_ok}|).setAttribute(|{style}|,|{height:30px;color:blue;font-size:15px;}|);   ",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
