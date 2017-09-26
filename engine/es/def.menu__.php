<?php
/** def_form.menu__.php		Menu Definition Form
 * 
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	Jun, 21 of 2005
 * Last modification on Oct, 21 of 2007 by Doglas A. Dembogurski  <douglas@ycube.net>
 * In Relationship Changed  the form of selecting a menu
 */
 

include_once("include/Y_Menu_Extract.class.php"); 
$extract_menu =  new Y_Menu_Extract();   // Class to extract all menus

$Obj->SetName ( "Menu Definition" );
$Obj->SetAlias( "Control del formulario de Menus");
$Obj->file		= "data.menu__";
$Obj->def_form 	= true;			// if is a definition form
$Obj->def_mul  	= false;		// If is multiple def_form
$Obj->engine 	= true;			// Is only to engine

$Obj->Add_Def(
	array(
	F_NAME_		=> "alias",
	F_ALIAS_	=> "Alias", 
	F_HELP_		=> "Nombre del Sistema",
	F_TYPE_		=> "text",
	F_LENGTH_	=> 20,
	F_BROW_		=> '1',
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "doc",
	F_ALIAS_	=> "Documentacion", 
	F_HELP_		=> "Dato para la documentacion oficial",
	F_TYPE_		=> "text",
	F_LENGTH_	=> 40,
	F_BROW_		=> '1',
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "help",
	F_ALIAS_	=> "Help", 
	F_HELP_		=> "Help contextual",
	F_TYPE_		=> "text",
	F_LENGTH_	=> 20,
	G_SHOW_		=> '1'
));



$Obj->Add(
	array(
	F_NAME_		=> "F_NAME_",
	F_ALIAS_	=> "Nombre", 
	F_HELP_		=> "Nombre del Menu",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_BROW_		=> 1,
	F_LENGTH_	=> 15,
	F_BROW_		=> '1',
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_ALIAS_",
	F_ALIAS_	=> "Alias", 
	F_HELP_		=> "Alias del Menu",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 40,
	F_BROW_		=> '1',
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_HELP_",
	F_ALIAS_	=> "Help", 
	F_HELP_		=> "Help contextual para el menu",
	F_TYPE_		=> "text",
	F_PREVAL_	=> "el['F_ALIAS_'].get()",	
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 60,
	G_SHOW_		=> '1'
));
//	F_PREVAL_	=> "el['F_ALIAS_'].get()",
$Obj->Add(
	array(
	F_NAME_		=> "F_TYPE_",
	F_ALIAS_	=> "Tipo", 
	F_HELP_		=> "Tipo de Menu a ser usado",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "header,menu,submenu",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 10,
	F_BROW_		=> '0',
	G_SHOW_		=> '1'
));

			
$Obj->Add(
	array(
	F_NAME_		=> "R_TABLE_",
	F_ALIAS_	=> "Relacion", 
	F_HELP_		=> "Menu padre",
	C_SHOW_		=> "el['F_TYPE_'].get()!='header'",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> $extract_menu->getMenuList(),
	F_LENGTH_	=> 20,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_OPER_",
	F_ALIAS_	=> "Operación", 
	F_HELP_		=> "Operación ejecutada por el menu",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "1_ Browse,20_ Consult",	
	F_REQUIRED_	=> 1,
	P_PROC_		=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_LINK_",
	F_ALIAS_	=> "Link", 
	F_HELP_		=> "Objeto a ser llamado",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> ",",	
	P_PROC_		=> "menu_link",
	F_LENGTH_	=> 40,
	G_SHOW_		=> '1'
));
/*$Obj->Add(
	array(
	F_NAME_		=> "R_BOLD_",
	F_ALIAS_	=> "Realce", 
	F_HELP_		=> "Condición de realce",
	C_SHOW_		=> "el['F_OPER_'].get()!='20'",
	F_TYPE_		=> "text",
	F_LENGTH_	=> 80,
	G_SHOW_		=> '1'
));
*/
/*
$Obj->Add(
	array(
	F_NAME_		=> "F_ORD_",
	F_ALIAS_	=> "Orden", 
	F_HELP_		=> "Orden de Presentación",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",	
	P_PROC_		=> "",
	F_LENGTH_	=> 2,
	G_SHOW_		=> '1'
));
*/
$Obj->Add(
	array(
	F_NAME_		=> "F_FILTER_",
	F_ALIAS_	=> "Filtro", 
	F_HELP_		=> "Filtro a ser aplicado",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",	
	P_PROC_		=> "",
	F_LENGTH_	=> 80,
	G_SHOW_		=> '1'
));

$Obj->Add(
	array(
	F_NAME_		=> "G_SHOW_",
	F_ALIAS_	=> "Grupo", 
	F_HELP_		=> "Grupo que puede visualizar el menu",
	F_TYPE_		=> "INT_PROC",
	P_PROC_		=> "group_trustee",
	P_SHOW_		=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));

?>