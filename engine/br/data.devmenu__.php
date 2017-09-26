<?php
/** data_devmenu__.php	Plus definitions to a Developer Menu
 * 
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	Jun, 16 of 2005
 *
 * Translated in june, 17 of 2006
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
		F_ALIAS_	=> "Imprimir", 
		F_HELP_		=> "Imprimir vista atual",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_menuplus_",	
		G_SHOW_		=> '2147483647',
		F_OPER_		=>	6,
		F_LINK_		=> 'print_'			
	));
	$Obj->Add(
		array(
		F_NAME_		=> "_reload_",
		F_ALIAS_	=> "Recarregar", 
		F_HELP_		=> "Recarregar tela",
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
		F_HELP_		=> "Manual de usuario",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_menuplus_",
		F_OPER_		=> 6,
		F_LINK_		=> 'doc_0',
		G_SHOW_		=> '2147483647'
	));
	$Obj->Add(
		array(
		F_NAME_		=> "_documentation_",
		F_ALIAS_	=> "Documentaчуo", 
		F_HELP_		=> "Documentaчуo do Sistema",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_menuplus_",
		G_SHOW_		=> '1'
	));
		$Obj->Add(
			array(
			F_NAME_		=> "_datadict_",
			F_ALIAS_	=> "Dicionario de Dados", 
			F_HELP_		=> "Dicionario de dados",
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
			F_ALIAS_	=> "Simplificada", 
			F_HELP_		=> "Documentaчуo simplificada do sistema",
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
			F_ALIAS_	=> "Detalhada", 
			F_HELP_		=> "Documentaчуo Detalhada do sistema",
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
			F_ALIAS_	=> "Consistъncia", 
			F_HELP_		=> "Anсlise de Consistъncia",
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
			F_ALIAS_	=> "Exportar a DIA", 
			F_HELP_		=> "Exportar arquivo para DIA",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_documentation_",	
			F_OPER_		=> 6,
			F_LINK_		=> 'doc_4',
			G_SHOW_		=> '1'	
		));
	
	$Obj->Add(
		array(
		F_NAME_		=> "_passwd_",
		F_ALIAS_	=> "Senha", 
		F_HELP_		=> "Permite trocar a senha de acesso do usuario",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_menuplus_",
		G_SHOW_		=> '2147483647',
		F_LINK_		=> 'db.user_pass__'	,
        F_FILTER_ => "name=p_user_"
	));
		$Obj->Add(
			array(
			F_NAME_		=> "_respref_",
			F_ALIAS_	=> "Preferencias", 
			F_HELP_		=> "Preferencias do usuario",
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
		F_ALIAS_	=> "Terminar Sessуo", 
		F_HELP_		=> "Fecha a sessуo do usuсrio atual",
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
	F_HELP_		=> "Menu de desenvolvimento",
	F_TYPE_		=> "header",
	G_SHOW_		=> '1'
));

	$Obj->Add(
		array(
		F_NAME_		=> "_trustees_",
		F_ALIAS_	=> "Trustees", 
		F_HELP_		=> "Definiчуo de acesso a grupos e usuсrios",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_developer_",
		G_SHOW_		=> '1'
	));
	
		$Obj->Add(
			array(
			F_NAME_		=> "_groups_",
			F_ALIAS_	=> "Grupos", 
			F_HELP_		=> "Definiчуo de direitos de acesso a grupos",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_trustees_",	
			G_SHOW_		=> '1',		
			F_LINK_		=> 'db.group__'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_users_",
			F_ALIAS_	=> "Usuсrios", 
			F_HELP_		=> "Definiчуo de direitos de acesso a usuсrios",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_trustees_",	
			G_SHOW_		=> '1',		
			F_LINK_		=> 'db.user__'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_log_",
			F_ALIAS_	=> "Auditoria", 
			F_HELP_		=> "Registros de Auditorэa",
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
		F_HELP_		=> "Definiчao dos menus do sistema",
		F_TYPE_		=> "menu",
		F_NODOC_	=> '1',
		R_TABLE_	=> "_developer_",
		G_SHOW_		=> '1',
		F_LINK_		=> 'def.menu__'	
	));
	$Obj->Add(
		array(
		F_NAME_		=> "_passwords_",
		F_ALIAS_	=> "Senhas", 
		F_HELP_		=> "Definiчуo das senhas os usuсrios",
		F_TYPE_		=> "menu",
		F_NODOC_	=> '1',
		R_TABLE_	=> "_developer_",
		G_SHOW_		=> '1',
		F_LINK_		=> 'db.user_pass__'	
	));
	$Obj->Add(
		array(
		F_NAME_		=> "_formularios_",
		F_ALIAS_	=> "Formulсrios", 
		F_HELP_		=> "Formulсrios do sistema",
		F_TYPE_		=> "menu",
		F_NODOC_	=> '1',
		R_TABLE_	=> "_developer_",
		G_SHOW_		=> '1',
		F_LINK_		=> 'def.form__'	
	));
	
	$Obj->Add(
		array(
		F_NAME_		=> "_db_",
		F_ALIAS_	=> "Base de Dados", 
		F_HELP_		=> "Operaчѕes com Tabelas e procedimentos",
		F_TYPE_		=> "menu",
		F_NODOC_	=> '1',
		R_TABLE_	=> "_developer_",
		G_SHOW_		=> '1',
		F_LINK_		=> ''	
	));
		$Obj->Add(
			array(
			F_NAME_		=> "_integrity_",
			F_ALIAS_	=> "Integridade Referencial", 
			F_HELP_		=> "Definiчуo de dados para a integridade referencial",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_db_",	
			G_SHOW_		=> '1',		
			F_LINK_		=> 'db.integrity__'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_procedure_",
			F_ALIAS_	=> "Procedimentos Armazenados", 
			F_HELP_		=> "Definiчѕes de Procedimentos e Funчѕes internas",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_db_",	
			G_SHOW_		=> '1',		
			F_LINK_		=> 'db.proc__'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_startlog_",
			F_ALIAS_	=> "Ativar Log", 
			F_HELP_		=> "Ativar Log interno de consultas a Base de Dados",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_db_",	
			F_OPER_		=> 6,
			G_SHOW_		=> '1',		
			F_LINK_		=> 'start_log'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_stoplog_",
			F_ALIAS_	=> "Desativar Log", 
			F_HELP_		=> "Desativar Log interno de consultas р Base de Dados",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_db_",	
			F_OPER_		=> 6,
			G_SHOW_		=> '1',		
			F_LINK_		=> 'stop_log'			
		));
		
		$Obj->Add(
			array(
			F_NAME_		=> "_force_update_",
			F_ALIAS_	=> "Forчar actualizacуo", 
			F_HELP_		=> "Obriga a uma actualizacуo do sistema",
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
		F_ALIAS_	=> "Relatѓrios", 
		F_HELP_		=> "Gerador bсsico de relatѓrios",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_developer_",
		F_NODOC_	=> '1',
		G_SHOW_		=> '1',
		F_LINK_		=> 'def.rep__'	
	));
	
		$Obj->Add(
			array(
			F_NAME_		=> "_newproject_",
			F_ALIAS_	=> "Novo Projeto", 
			F_HELP_		=> "Cria un novo projeto",
			F_TYPE_		=> "menu",
			R_TABLE_	=> "_developer_",	
	        F_OPER_		=> 20,	
			F_NODOC_	=> '1',	
			G_SHOW_		=> '1',					
			F_LINK_		=> 'db.new_project__'			
		));		
	
?>