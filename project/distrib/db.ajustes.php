<?php
$Obj->name = "ajustes";
$Obj->alias = "Ajustes";
$Obj->help = "Ajustes de Mercaderia";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "ajustes";
$Obj->Filter = "";
$Obj->Sort = "";
$Obj->p_insert = "'UPDATE productos SET p_cant=p_cant'+aj_signo.get()+aj_ajuste.getVal()+' WHERE p_cod='+aj_prod.getVal()";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "1";
$Obj->NoInsert = "";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "aj_prod",
        F_ALIAS_ => "Producto",
        F_HELP_ => "Codigo del Producto",
        F_TYPE_ => "text",
        F_LENGTH_ => "14",
        F_DEC_ => "0",
        F_ORD_ => "10",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "aj_fecha",
        F_ALIAS_ => "Fecha",
        F_HELP_ => "Fecha del Ajuste",
        F_TYPE_ => "date",
        F_BROW_ => "1",
        F_ORD_ => "20",
        V_DEFAULT_ => "thisDate_",
        C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));
		
$Obj->Add(
    array(
        F_NAME_ => "aj_hora",
        F_ALIAS_ => "Hora",
        F_HELP_ => "Hora del Ajuste",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
		F_BROW_ => "1",
		F_LENGTH_ => "10",
		F_INLINE_ => "1",
        F_QUERY_ => "'SELECT CURRENT_TIME'",
        F_QUERY_REF_ => "aj_hora.firstSQL&&operation==INSERT_",
        F_ORD_ => "22", 
		C_CHANGE_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));		

$Obj->Add(
    array(
        F_NAME_ => "aj_usuario",
        F_ALIAS_ => "Usuario",
        F_HELP_ => "Usuario",
        F_TYPE_ => "text",
        F_BROW_ => "1",
        F_ORD_ => "30",
        V_DEFAULT_ => "p_user_",
        C_VIEW_ => "false",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "aj_inicial",
        F_ALIAS_ => "Inicial",
        F_HELP_ => "Existencia Inicial",
        F_TYPE_ => "formula",
        F_LENGTH_ => "10",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "40",
        F_FORMULA_ => "sup['p_cant']",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "aj_oper",
        F_ALIAS_ => "Operacion",
        F_HELP_ => "Operacion",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Aumento en Entrada,Aumento en Salida,Aumento en Inventario,Aumento x Informacion Viciada,Aumento x Variacion de Rendimiento Promedio,Disminucion en Entrada,Disminucion en Salida,Disminucion en Inventario,Disminucion x Informacion Viciada,Disminucion x Variacion de Rendimiento Promedio,Disminucion x Fallas",
        F_LENGTH_ => "50",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "45",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "aj_ajuste",
        F_ALIAS_ => "Ajuste",
        F_HELP_ => "Ajuste Efectuado",
        F_TYPE_ => "text",
        F_LENGTH_ => "10",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_REQUIRED_ => "1",
        F_ORD_ => "50",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "aj_final",
        F_ALIAS_ => "Final",
        F_HELP_ => "Existencia Final",
        F_TYPE_ => "formula",
        F_LENGTH_ => "10",
        F_DEC_ => "2",
        F_BROW_ => "1",
        F_ORD_ => "60",
        F_FORMULA_ => "aj_oper.get().substring(0,7)=='Aumento'?aj_inicial.getVal()+aj_ajuste.getVal():aj_inicial.getVal()-aj_ajuste.getVal()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "aj_signo",
        F_ALIAS_ => "Signo",
        F_HELP_ => "Signo",
        F_TYPE_ => "formula",
        F_LENGTH_ => "4",
        F_ORD_ => "70",
        F_INLINE_ => "1",
        F_FORMULA_ => "aj_oper.get().substring(0,7)=='Aumento'?'+':'-'",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "aj_motivo",
        F_ALIAS_ => "Motivo de Ajuste",
        F_HELP_ => "Motivo de Ajuste",
        F_TYPE_ => "text",
        F_MULTI_ => "1",
        F_LENGTH_ => "150",
        F_REQUIRED_ => "1",
        F_ORD_ => "75",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "__disableChange",
        F_ALIAS_ => "Inhabilita boton de Modificar",
        F_HELP_ => "Inhabilita boton de Modificar",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "80",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableChangeButton()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "__disableDel",
        F_ALIAS_ => "Inhabilita boton de borrar",
        F_HELP_ => "Inhabilita boton de borrar",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "90",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableDeleteButton()",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

$Obj->Add(
    array(
        F_NAME_ => "__lock_unlock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept ",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "100",
        C_VIEW_ => "false",
        F_FORMULA_ => "if( aj_final.getVal()<0 ){disableAcceptButton() }else{ enableAcceptButton() }",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));



?>
