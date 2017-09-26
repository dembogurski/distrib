<?php
/** db_form.group__.php		Group database form
 * 
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	Jun, 15 of 2005
 */
 
//function LoadForm( $Obj )
//{

$Obj->name = "Group Control";
$Obj->alias ="Grupos de usuarios";
$Obj->doc = "Grupos de Usuarios";
$Obj->File = "p_groups";

$Obj->Add(
	array(
	F_NAME_		=> "name",
	F_ALIAS_	=> "Nombre", 
	F_HELP_		=> "Nombre del Grupo",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 40,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "obs",
	F_ALIAS_	=> "Descripcion", 
	F_HELP_		=> "Descripcion del Grupo",
	F_REQUIRED_	=> 1,
	F_TYPE_		=> "text",
	F_LENGTH_	=> 60,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "trustee",
	F_ALIAS_	=> "Trustee", 
	F_HELP_		=> "Relacion de Confianza del grupo",
	F_TYPE_		=> "INT_PROC",
	P_PROC_		=> "group_trustee",
	P_SHOW_		=> "",
	F_LENGTH_	=> 1,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
			
//} // LoadMenu() -------------------------------------------------------------
?>