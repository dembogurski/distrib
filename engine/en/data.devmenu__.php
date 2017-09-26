<?php
/** data_devmenu__.php	Plus definitions to a Developer Menu
 * 
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	Jun, 16 of 2005
 */

 
$Obj->Add(
	array(
	F_NAME_		=> "_menuplus_",
	F_ALIAS_	=> "+", 
	F_HELP_		=> "Menu Plus",
	F_TYPE_		=> "header",
	G_SHOW_		=> '2147483647',
));
	
	$Obj->Add(
		array(
		F_NAME_		=> "_print_",
		F_ALIAS_	=> "Print", 
		F_HELP_		=> "Print the actual screen",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_menuplus_",	
		G_SHOW_		=> '2147483647',
		F_OPER_		=>	6,
		F_LINK_		=> 'print_'			
	));
	$Obj->Add(
		array(
		F_NAME_		=> "_reload_",
		F_ALIAS_	=> "Reload", 
		F_HELP_		=> "Reload a page",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_menuplus_",	
		G_SHOW_		=> '2147483647',
		F_OPER_		=>	6,
		F_LINK_		=> 'reload_'			
	));
	$Obj->Add(
		array(
		F_NAME_		=> "_manual_",
		F_ALIAS_	=> "Manual", 
		F_HELP_		=> "Generate a User Manual",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_menuplus_",
		F_OPER_		=> 6,
		F_LINK_		=> 'doc_0',
		G_SHOW_		=> '2147483647'
	));
	$Obj->Add(
		array(
		F_NAME_		=> "_documentation_",
		F_ALIAS_	=> "Documentation", 
		F_HELP_		=> "System Documentation",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_menuplus_",
		G_SHOW_		=> '1'
	));
		$Obj->Add(
			array(
			F_NAME_		=> "_datadict_",
			F_ALIAS_	=> "Data Dictionary", 
			F_HELP_		=> "Relation of a data fields used in the system",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_documentation_",	
			F_OPER_		=> 6,
			F_LINK_		=> 'doc_5',
			G_SHOW_		=> '1'	
		));
/*	
		$Obj->Add(
			array(
			F_NAME_		=> "_gendoc_",
			F_ALIAS_	=> "Simple", 
			F_HELP_		=> "Simple System Documentation",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_documentation_",	
			F_OPER_		=> 6,
			F_LINK_		=> 'doc_1',
			G_SHOW_		=> '1'	
		));
*/
		$Obj->Add(
			array(
			F_NAME_		=> "_detdoc_",
			F_ALIAS_	=> "Full", 
			F_HELP_		=> "Complex System Documentation",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_documentation_",	
			F_OPER_		=> 6,
			F_LINK_		=> 'doc_2',
			G_SHOW_		=> '1'	
		));
/*		
		$Obj->Add(
			array(
			F_NAME_		=> "_consist_",
			F_ALIAS_	=> "Consistence", 
			F_HELP_		=> "Consistence Check",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_documentation_",	
			F_OPER_		=> 6,
			F_LINK_		=> 'doc_3',
			G_SHOW_		=> '1'	
		));
*/		
		$Obj->Add(
			array(
			F_NAME_		=> "_export_dia_",
			F_ALIAS_	=> "Export to DIA", 
			F_HELP_		=> "Generate a DIA compatible file",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_documentation_",	
			F_OPER_		=> 6,
			F_LINK_		=> 'doc_4',
			G_SHOW_		=> '1'	
		));
	
	$Obj->Add(
		array(
		F_NAME_		=> "_passwd_",
		F_ALIAS_	=> "Password", 
		F_HELP_		=> "Change a user password",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_menuplus_",
		G_SHOW_		=> '2147483647',
		F_LINK_		=> 'db.user_pass__'	,
        F_FILTER_ => "name=p_user_"
	));
		$Obj->Add(
			array(
			F_NAME_		=> "_respref_",
			F_ALIAS_	=> "Preferences", 
			F_HELP_		=> "User preferences",
			F_TYPE_		=> "menu",
			R_TABLE_	=> "_menuplus_",	
			F_OPER_		=> 20,				
			F_NODOC_	=> '1',	
			G_SHOW_		=> '2147483647',					
			F_LINK_		=> 'db.preferences__'			
		));		
	

	$Obj->Add(
		array(
		F_NAME_		=> "_logout_",
		F_ALIAS_	=> "Close session", 
		F_HELP_		=> "Close a user session",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_menuplus_",
		F_OPER_		=> 6,
		F_LINK_		=> 'logout_',
		G_SHOW_		=> '2147483647'
	));
			


$Obj->Add(
	array(
	F_NAME_		=> "_developer_",
	F_ALIAS_	=> "Developer", 
	F_HELP_		=> "Developer Menu",
	F_TYPE_		=> "header",
	G_SHOW_		=> '1'
));

	$Obj->Add(
		array(
		F_NAME_		=> "_trustees_",
		F_ALIAS_	=> "Trustees", 
		F_HELP_		=> "Users and groups trustee definitions",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_developer_",
		G_SHOW_		=> '1'
	));
	
		$Obj->Add(
			array(
			F_NAME_		=> "_groups_",
			F_ALIAS_	=> "Groups", 
			F_HELP_		=> "Groups Trustee definitions",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_trustees_",	
			G_SHOW_		=> '1',		
			F_LINK_		=> 'db.group__'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_users_",
			F_ALIAS_	=> "Users", 
			F_HELP_		=> "Users trustees definitions",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_trustees_",	
			G_SHOW_		=> '1',		
			F_LINK_		=> 'db.user__'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_log_",
			F_ALIAS_	=> "Audit", 
			F_HELP_		=> "Audit LOG",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_trustees_",	
			G_SHOW_		=> '1',	
			F_OPER_		=> 20,	
			F_LINK_		=> 'db.conslog__'			
		));
	$Obj->Add(
		array(
		F_NAME_		=> "_menus_",
		F_ALIAS_	=> "Menus", 
		F_HELP_		=> "System menu definitions",
		F_TYPE_		=> "menu",
		F_NODOC_	=> '1',
		R_TABLE_	=> "_developer_",
		G_SHOW_		=> '1',
		F_LINK_		=> 'def.menu__'	
	));
	$Obj->Add(
		array(
		F_NAME_		=> "_passwords_",
		F_ALIAS_	=> "Passwords", 
		F_HELP_		=> "Users passwords",
		F_TYPE_		=> "menu",
		F_NODOC_	=> '1',
		R_TABLE_	=> "_developer_",
		G_SHOW_		=> '1',
		F_LINK_		=> 'db.user_pass__'	
	));
	$Obj->Add(
		array(
		F_NAME_		=> "_formularios_",
		F_ALIAS_	=> "Forms", 
		F_HELP_		=> "System Forms",
		F_TYPE_		=> "menu",
		F_NODOC_	=> '1',
		R_TABLE_	=> "_developer_",
		G_SHOW_		=> '1',
		F_LINK_		=> 'def.form__'	
	));
	
	$Obj->Add(
		array(
		F_NAME_		=> "_db_",
		F_ALIAS_	=> "Data Base", 
		F_HELP_		=> "Data Base Operations",
		F_TYPE_		=> "menu",
		F_NODOC_	=> '1',
		R_TABLE_	=> "_developer_",
		G_SHOW_		=> '1',
		F_LINK_		=> ''	
	));
		$Obj->Add(
			array(
			F_NAME_		=> "_integrity_",
			F_ALIAS_	=> "Referencial Integrity", 
			F_HELP_		=> "Referencial Integrity Definitions",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_db_",	
			G_SHOW_		=> '1',		
			F_LINK_		=> 'db.integrity__'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_procedure_",
			F_ALIAS_	=> "Stored Procedures", 
			F_HELP_		=> "Stored Procedures and Functions",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_db_",	
			G_SHOW_		=> '1',		
			F_LINK_		=> 'db.proc__'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_startlog_",
			F_ALIAS_	=> "Start Log", 
			F_HELP_		=> "Start a Internal Data Base Log",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_db_",	
			F_OPER_		=> 6,
			G_SHOW_		=> '1',		
			F_LINK_		=> 'start_log'			
		));
			
		$Obj->Add(
			array(
			F_NAME_		=> "_stoplog_",
			F_ALIAS_	=> "Stop Log", 
			F_HELP_		=> "Stop a Internal Database Log",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_db_",	
			F_OPER_		=> 6,
			G_SHOW_		=> '1',		
			F_LINK_		=> 'stop_log'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_force_update_",
			F_ALIAS_	=> "Force update", 
			F_HELP_		=> "Force the system update",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_db_",	
	        F_OPER_		=> 20,	
			F_NODOC_	=> '1',	
			G_SHOW_		=> '1',					
			F_LINK_		=> 'db.force_update__'			
		));		
		
	$Obj->Add(
		array(
		F_NAME_		=> "_reports_",
		F_ALIAS_	=> "Reports", 
		F_HELP_		=> "A simple Report Generator",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_developer_",
		F_NODOC_	=> '1',
		G_SHOW_		=> '1',
		F_LINK_		=> 'def.rep__'	
	));
	
		$Obj->Add(
			array(
			F_NAME_		=> "_newproject_",
			F_ALIAS_	=> "New Project", 
			F_HELP_		=> "Create a new empty project",
			F_TYPE_		=> "menu",
			R_TABLE_	=> "_developer_",	
	        F_OPER_		=> 20,	
			F_NODOC_	=> '1',	
			G_SHOW_		=> '1',					
			F_LINK_		=> 'db.new_project__'			
		));			
			
//} // LoadMenu() -------------------------------------------------------------
?>