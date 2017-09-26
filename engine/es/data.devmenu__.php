<?php
/** data_devmenu__.php	Plus definitions to a Developer Menu
 * 
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	Jun, 16 of 2005
 *
 * Translated in July, 17 of 2006
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
		F_HELP_		=> "Imprimir vista actual",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_menuplus_",	
		G_SHOW_		=> '2147483647',
		F_OPER_		=>	6,
		F_LINK_		=> 'print_'			
	));
	$Obj->Add(
		array(
		F_NAME_		=> "_reload_",
		F_ALIAS_	=> "Recargar", 
		F_HELP_		=> "Recargar vista actual",
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
		F_HELP_		=> "Manual del usuario",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_menuplus_",
		F_OPER_		=> 6,
		F_LINK_		=> 'doc_0',
		G_SHOW_		=> '2147483647'
	));
	$Obj->Add(
		array(
		F_NAME_		=> "_documentation_",
		F_ALIAS_	=> "Documentacion", 
		F_HELP_		=> "Documentacion del Sistema",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_menuplus_",
		G_SHOW_		=> '1'
	));
		$Obj->Add(
			array(
			F_NAME_		=> "_datadict_",
			F_ALIAS_	=> "Diccionario de Datos", 
			F_HELP_		=> "Diccionario de datos usados en el sistema",
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
			F_HELP_		=> "Documentacion simplificada del sistema",
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
			F_ALIAS_	=> "Detallada", 
			F_HELP_		=> "Documentacion Detallada del sistema",
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
			F_ALIAS_	=> "Consistencia", 
			F_HELP_		=> "Analisis de Consistencia",
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
			F_HELP_		=> "Generar archivo para DIA",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_documentation_",	
			F_OPER_		=> 6,
			F_LINK_		=> 'doc_4',
			G_SHOW_		=> '1'	
		));
	
	$Obj->Add(
		array(
		F_NAME_		=> "_passwd_",
		F_ALIAS_	=> "Contraseña", 
		F_HELP_		=> "Permite el cambio de la contrasena del usuario",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_menuplus_",
		F_LINK_		=> 'db.user_pass__'	,
		G_SHOW_		=> '2147483647',
        F_FILTER_ => "name=p_user_"
		
	));
	
		$Obj->Add(
			array(
			F_NAME_		=> "_respref_",
			F_ALIAS_	=> "Preferencias", 
			F_HELP_		=> "Preferencias de usuario",
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
		F_ALIAS_	=> "Cerrar Sesion", 
		F_HELP_		=> "Cierra la session del usuario actual",
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
	F_HELP_		=> "Menu de desarrollo",
	F_TYPE_		=> "header",
	G_SHOW_		=> '1'
));

	$Obj->Add(
		array(
		F_NAME_		=> "_trustees_",
		F_ALIAS_	=> "Trustees", 
		F_HELP_		=> "Definicion de acceso de grupos y usuarios",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_developer_",
		G_SHOW_		=> '1'
	));
	
		$Obj->Add(
			array(
			F_NAME_		=> "_groups_",
			F_ALIAS_	=> "Grupos", 
			F_HELP_		=> "Definicion de grupos y sus trustees",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_trustees_",	
			G_SHOW_		=> '1',		
			F_LINK_		=> 'db.group__'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_users_",
			F_ALIAS_	=> "Usuarios", 
			F_HELP_		=> "Definicion de usuarios y sus trustees",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_trustees_",	
			G_SHOW_		=> '1',		
			F_LINK_		=> 'db.user__'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_log_",
			F_ALIAS_	=> "Auditoría", 
			F_HELP_		=> "Rastros de Auditoría",
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
		F_HELP_		=> "Definicion de los menues del sistema",
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
		F_HELP_		=> "Definicion de las passwords de los usuarios",
		F_TYPE_		=> "menu",
		F_NODOC_	=> '1',
		R_TABLE_	=> "_developer_",
		G_SHOW_		=> '1',
		F_LINK_		=> 'db.user_pass__'	
	));
	$Obj->Add(
		array(
		F_NAME_		=> "_formularios_",
		F_ALIAS_	=> "Formularios", 
		F_HELP_		=> "Formularios del sistema",
		F_TYPE_		=> "menu",
		F_NODOC_	=> '1',
		R_TABLE_	=> "_developer_",
		G_SHOW_		=> '1',
		F_LINK_		=> 'def.form__'	
	));
	
	$Obj->Add(
		array(
		F_NAME_		=> "_db_",
		F_ALIAS_	=> "Base de Datos", 
		F_HELP_		=> "Operaciones con Tablas y procedimientos",
		F_TYPE_		=> "menu",
		F_NODOC_	=> '1',
		R_TABLE_	=> "_developer_",
		G_SHOW_		=> '1',
		F_LINK_		=> ''	
	));
		$Obj->Add(
			array(
			F_NAME_		=> "_integrity_",
			F_ALIAS_	=> "Integridad Referencial", 
			F_HELP_		=> "Definicion de datos para Integridad Referencial",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_db_",	
			G_SHOW_		=> '1',		
			F_LINK_		=> 'db.integrity__'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_procedure_",
			F_ALIAS_	=> "Procedimientos Almacenados", 
			F_HELP_		=> "Definiciones de funciones y procedimientos",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_db_",	
			G_SHOW_		=> '1',		
			F_LINK_		=> 'db.proc__'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_startlog_",
			F_ALIAS_	=> "Activar Log", 
			F_HELP_		=> "Activar Log interno de llamadas a la Base de Datos",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_db_",	
			F_OPER_		=> 6,
			G_SHOW_		=> '1',		
			F_LINK_		=> 'start_log'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_stoplog_",
			F_ALIAS_	=> "Desactivar Log", 
			F_HELP_		=> "Desactivar Log interno de llamadas a la Base de Datos",
			F_TYPE_		=> "submenu",
			R_TABLE_	=> "_db_",	
			F_OPER_		=> 6,
			G_SHOW_		=> '1',		
			F_LINK_		=> 'stop_log'			
		));
		$Obj->Add(
			array(
			F_NAME_		=> "_force_update_",
			F_ALIAS_	=> "Forzar actualización", 
			F_HELP_		=> "Obliga a una actualización del sistema",
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
		F_ALIAS_	=> "Reportes", 
		F_HELP_		=> "Generador basico de reportes",
		F_TYPE_		=> "menu",
		R_TABLE_	=> "_developer_",
		F_NODOC_	=> '1',
		G_SHOW_		=> '1',
		F_LINK_		=> 'def.rep__'	
	));
		$Obj->Add(
			array(
			F_NAME_		=> "_newproject_",
			F_ALIAS_	=> "Nuevo Proyecto", 
			F_HELP_		=> "Crea un nuevo proyecto",
			F_TYPE_		=> "menu",
			R_TABLE_	=> "_developer_",	
	        F_OPER_		=> 20,	
			F_NODOC_	=> '1',	
			G_SHOW_		=> '1',					
			F_LINK_		=> 'db.new_project__'			
		));	
		
			
//} // LoadMenu() -------------------------------------------------------------
?>