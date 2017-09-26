<?php
/** def_form.menu__.php		Menu Definition Form
 * 
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	Jun, 21 of 2005
 * Last modification on Oct, 21 of 2007 by Doglas A. Dembogurski  <douglas@ycube.net>
 * In Relationship Changed  the form of selecting a menu
 */
 

include_once("./include/Y_Menu_Extract.class.php"); 
$extract_menu =  new Y_Menu_Extract();   // Class to extract all menus

$Obj->SetName ( "Definiçào de menus" );
$Obj->SetAlias( "Controle do  formulario de Menus");
$Obj->file		= "data.menu__";
$Obj->def_form 	= true;			// if is a definition form
$Obj->def_mul  	= false;		// If is multiple def_form
$Obj->engine 	= true;			// Is only to engine

$Obj->Add_Def(
	array(
	F_NAME_		=> "alias",
	F_ALIAS_	=> "Alias", 
	F_HELP_		=> "Nome do Sistema",
	F_TYPE_		=> "text",
	F_LENGTH_	=> 20,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "doc",
	F_ALIAS_	=> "Documentaçào", 
	F_HELP_		=> "Dado para a documentação oficial",
	F_TYPE_		=> "text",
	F_LENGTH_	=> 40,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "help",
	F_ALIAS_	=> "Ajuda", 
	F_HELP_		=> "Ajuda contextual",
	F_TYPE_		=> "text",
	F_LENGTH_	=> 20,
	G_SHOW_		=> '1'
));



$Obj->Add(
	array(
	F_NAME_		=> "F_NAME_",
	F_ALIAS_	=> "Nome", 
	F_HELP_		=> "Nome do Menu",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_BROW_		=> 1,
	F_LENGTH_	=> 15,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_ALIAS_",
	F_ALIAS_	=> "Alias", 
	F_HELP_		=> "Alias do Menu",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 40,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_HELP_",
	F_ALIAS_	=> "Ajuda", 
	F_HELP_		=> "Ajuda contextual para o menu",
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
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "R_TABLE_",
	F_ALIAS_	=> "Relação", 
	F_HELP_		=> "Menu superior",
	C_SHOW_		=> "el['F_TYPE_'].get()!='header'",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> $extract_menu->getMenuList(),
	F_LENGTH_	=> 20,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_OPER_",
	F_ALIAS_	=> "Operação", 
	F_HELP_		=> "Operação executada pelo menu",
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
	F_HELP_		=> "Objeto a ser chamado",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> ",",	
	P_PROC_		=> "menu_link",
	F_LENGTH_	=> 40,
	G_SHOW_		=> '1'
));
/*
$Obj->Add(
	array(
	F_NAME_		=> "R_BOLD_",
	F_ALIAS_	=> "Realce", 
	F_HELP_		=> "Condiçào de realce",
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
	F_HELP_		=> "Ordem de apresentação",
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
	F_HELP_		=> "Grupo que po visualizar o menu",
	F_TYPE_		=> "INT_PROC",
	P_PROC_		=> "group_trustee",
	P_SHOW_		=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));

?>