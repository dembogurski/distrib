<?php
/** db_form.integrity__.php		Referencial Integrity database form
 * 
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	Jun, 15 of 2005
 */
 
$Obj->name= "Referencial Integrity";
$Obj->alias = "Integridad referencial";
$Obj->doc = "Integridad Referencial entre tablas del sistema";
$Obj->File = "p_ref_int";
$Obj->Sort = "_dep_table,_dep_field";

$Obj->Add(
	array(
	F_NAME_		=> "_dep_table",
	F_ALIAS_	=> "Tabla Dependente", 
	F_HELP_		=> "Tabla Dependente",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "",
	P_PROC_		=> "tables",
	F_BROW_		=> 1,
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 20,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "_dep_field",
	F_ALIAS_	=> "Campo Dependente", 
	F_HELP_		=> "Nombre del campo dependente",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 15,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "_ref_table",
	F_ALIAS_	=> "Tabla Referencia", 
	F_HELP_		=> "Tabla Referencial",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "",
	P_PROC_		=> "tables",
	F_BROW_		=> 1,
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 20,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "_ref_field",
	F_ALIAS_	=> "Campo Referenciado", 
	F_HELP_		=> "Nombre del Campo de referencia",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 15,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));

/*
$Obj->Add(
	array(
	F_NAME_		=> "operation",
	F_ALIAS_	=> "Operation", 
	F_HELP_		=> "Operation a ejecutar en dependencias",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "restrict,cascade,null",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 10,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
*/


/* OLD in # 12
 
$Obj->name= "Referencial Integrity";
$Obj->alias = "Integridad referencial";
$Obj->doc = "Integridad Referencial entre tablas del sistema";
$Obj->File = "p_integr";
$Obj->Sort = "prim_table,prim_field";

$Obj->Add(
	array(
	F_NAME_		=> "prim_table",
	F_ALIAS_	=> "Tabla Referencia", 
	F_HELP_		=> "Tabla primaria de referencia",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "",
	P_PROC_		=> "tables",
	F_BROW_		=> 1,
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 20,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "prim_field",
	F_ALIAS_	=> "Campo Referencia", 
	F_HELP_		=> "Nombre del Campo primario",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 15,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "sec_table",
	F_ALIAS_	=> "Tabla Dependente", 
	F_HELP_		=> "Tabla secundaria (depende da tabla de referencia)",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "",
	P_PROC_		=> "tables",
	F_BROW_		=> 1,
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 20,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "sec_field",
	F_ALIAS_	=> "Campo Dependente", 
	F_HELP_		=> "Nombre del Campo primario",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 15,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "operation",
	F_ALIAS_	=> "Operation", 
	F_HELP_		=> "Operation a ejecutar en dependencias",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "restrict,cascade,null",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 10,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));


*/

?>