<?php
/** db_form.group__.php		Group database form
 * 
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	Jun, 15 of 2005
 */
 
//function LoadForm( $Obj )
//{

$Obj->name= "User Control";
$Obj->alias = "Usuarios del sistema";
$Obj->doc = "Usuarios registrados";
$Obj->File = "p_users";

$Obj->Add(
	array(
	F_NAME_		=> "name",
	F_ALIAS_	=> "Nombre", 
	F_HELP_		=> "Nombre del Usuario",
	F_TYPE_		=> "text",
	F_REQUIRED_	=>	1,
	F_LENGTH_	=> 40,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "obs",
	F_ALIAS_	=> "Observacion", 
	F_HELP_		=> "Datos del Usuario",
	F_TYPE_		=> "text",
	F_LENGTH_	=> 60,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "local",
	F_ALIAS_	=> "Localidad", 
	F_HELP_		=> "Localidad del Usuario",
	F_TYPE_		=> "text",
	F_LENGTH_	=> 60,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "resh",
	F_ALIAS_	=> "Horizontal", 
	F_HELP_		=> "Resolución Horizontal del monitor",
	F_TYPE_		=> "text",
	F_LENGTH_	=> 4,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "resv",
	F_ALIAS_	=> "Vertical", 
	F_HELP_		=> "Resolución Vertical del monitor",
	F_TYPE_		=> "text",
	F_LENGTH_	=> 4,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "lang",
	F_ALIAS_	=> "Lenguaje", 
	F_HELP_		=> "Lenguaje utilizada para el usuario",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "br,en,es",
	F_LENGTH_	=> 2,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));

$Obj->Add(
	array(
	F_NAME_		=> "trustee",
	F_ALIAS_	=> "Trustee", 
	F_HELP_		=> "Relacion de Confianza del usuario",
	F_TYPE_		=> "INT_PROC",
	P_PROC_		=> "group_trustee",
	P_SHOW_		=> "",
	F_LENGTH_	=> 1,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));

?>