<?php
$Obj->name = "caja";
$Obj->alias = "Caja";
$Obj->help = "Registro de Caja";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "caja";
$Obj->Filter = "cj_user =  p_user_  ";
$Obj->Sort = "id desc";
$Obj->p_insert = "'SELECT caja_ins_aciento('+cj_ref.getVal()+','+cj_fecha.getStr()+','+cj_user.getStr()+', '+cj_saldo_ini.getVal()+',|{G$}|,1,|{E}|,1,|{-}|,|{}|)'";
$Obj->p_change = "";
$Obj->p_delete = "'delete from caja_mov where cj_ref = '+cj_ref.getVal()";
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
        F_AUTONUM_ => "1",
        F_OPTIONS_ => "DB",
        F_LENGTH_ => "5",
        F_BROW_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cj_user",
        F_ALIAS_ => "Usuario",
        F_HELP_ => "Código del usuario que registra esta caja",
        F_TYPE_ => "formula",
        F_OPTIONS_ => "DB",
        F_RELTABLE_ => "mnt_func",
        F_LENGTH_ => "30",
        F_BROW_ => "1",
        F_ORD_ => "25",
        C_CHANGE_ => "false",
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
        F_QUERY_ => "'SELECT local from p_users where name = '+cj_user.getStr()",
        F_QUERY_REF_ => "cj_suc.firstSQL&&operation==INSERT_",
        F_LENGTH_ => "4",
		F_INLINE_ => "1",
        F_BROW_ => "1",
        F_ORD_ => "26",
        C_CHANGE_ => "false",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cj_fecha",
        F_ALIAS_ => "Fecha",
        F_HELP_ => "Fecha del caja",
        F_TYPE_ => "date",
        F_LENGTH_ => "10",
        F_BROW_ => "1",
        F_ORD_ => "30",
        V_DEFAULT_ => "thisDate_",
        C_CHANGE_ => "operation==INSERT_",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cj_saldo_ini",
        F_ALIAS_ => "Saldo Inicial",
        F_HELP_ => "Saldo Inicial",
        F_TYPE_ => "text",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_TOTAL_ => "1",
        F_ORD_ => "40",
        C_CHANGE_ => "operation==INSERT_",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cj_saldo_final",
        F_ALIAS_ => "Saldo Actual o Momentaneo (F5 Actualizar)",
        F_HELP_ => "Saldo Final o Momentaneo",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'select sum(m.entrada_ref) - sum(m.salida_ref) from caja c, caja_mov m where  c.cj_ref = m.cj_ref and c.cj_ref = '+cj_ref.getVal()",
        F_QUERY_REF_ => "cj_saldo_final.firstSQL||operation==SHOW_",
        F_LENGTH_ => "16",
        F_DEC_ => "2",
        F_NODB_ => "1",
        F_ORD_ => "50",
        F_INLINE_ => "1",
        C_CHANGE_ => "false",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cj_estado",
        F_ALIAS_ => "Estado",
        F_HELP_ => "Estado actual",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Abierta,Cerrada",
        F_LENGTH_ => "10",
        F_BROW_ => "1",
        F_ORD_ => "60",
        C_VIEW_ => "operation==CHANGE_",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cj_movs",
        F_ALIAS_ => "Movimientos",
        F_HELP_ => "Movimientos de Caja",
        F_TYPE_ => "subform",
        F_OPTIONS_ => "'cj_ref='+cj_ref.getVal()",
        F_LINK_ => "db.caja_mov",
        F_SEND_ => "cj_ref.get()",
        F_NODB_ => "1",
        F_ORD_ => "70",
        C_VIEW_ => "cj_ref.notEmpty()&&operation==CHANGE_&&cj_estado.get()=='Abierta' ",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "cj_check",
        F_ALIAS_ => "Chequea",
        F_HELP_ => "Chequea",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT COUNT(id) FROM caja WHERE cj_estado = |{Abierta}| and cj_suc = '+cj_suc.getStr()",
        F_QUERY_REF_ => "cj_check.firstSQL",
        F_LENGTH_ => "10",
        F_NODB_ => "1",
        F_ORD_ => "80",
        C_SHOW_ => "operation==INSERT_ && cj_suc.notEmpty()",
        C_VIEW_ => "false",
        F_POSVAL_ => "cj_check.getVal()<1",
        F_MESSAGE_ => "'Ya existe Caja Abierta con fecha anterior, Favor Cerrar Primero antes de Abrir otra'",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "__lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "90",
        C_SHOW_ => "operation==INSERT_",
        C_VIEW_ => "false",
        F_FORMULA_ => "if( cj_check.getVal()<1   ){ enableAcceptButton()   }else{ disableAcceptButton() }",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

?>
