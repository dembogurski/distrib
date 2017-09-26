<?php

/** db.force_update__.php form to force system update	 
 * 
 * @author	Doglas A. Dembogurski <douglas@ycube.net>
 * @date	Mar, 15 of 2008 
 */


$Obj->name = "force_update";
$Obj->alias = "Forzando Actualización de sistema";
$Obj->help = "Forzando Actualización de sistema";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "force_update";
$Obj->Filter = "";
$Obj->Sort = "";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "";
$Obj->Noedit = "";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "__lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "2",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton()",
        G_SHOW_ => "1",
        G_CHANGE_ => "1"));

$Obj->Add(
    array(
        F_NAME_ => "__noBack",
        F_ALIAS_ => "No Go Back",
        F_HELP_ => "No Go Back",
        F_TYPE_ => "formula",
        F_ORD_ => "3",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableBackButton();",
        G_SHOW_ => "1",
        G_CHANGE_ => "1"));

$Obj->Add(
    array(
        F_NAME_ => "drop_table",
        F_ALIAS_ => "Actualizacion",
        F_HELP_ => "Actualizacion",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'drop table if exists p_version'",
        F_QUERY_REF_ => "drop_table.firstSQL",
        F_LENGTH_ => "12",
        F_NODB_ => "1",
        F_ORD_ => "10",
        C_VIEW_ => "false",
        C_CHANGE_ => "false",
        G_SHOW_ => "1",
        G_CHANGE_ => "1"));

$Obj->Add(
    array(
        F_NAME_ => "__goBack",
        F_ALIAS_ => "Volver",
        F_HELP_ => "Volver",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "20",
        C_SHOW_ => "drop_table.get()=='__NO DATA__'",
        C_VIEW_ => "false",
        F_FORMULA_ => "window.opener.location.reload();setTimeout('self.close()',1500);",
        G_SHOW_ => "1",
        G_CHANGE_ => "1"));

$Obj->Add(
    array(
        F_NAME_ => "messagge",
        F_ALIAS_ => "Mensaje",
        F_HELP_ => "Mensaje",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "30",
        C_SHOW_ => "true",
        C_VIEW_ => "false",
        F_FORMULA_ => "enableMessageButton('<<< Forzando actualización para el siguiente login! >>>' ,1500);",
        G_SHOW_ => "1",
        G_CHANGE_ => "1"));

?>
