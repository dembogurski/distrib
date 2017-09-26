<?php
/** db_proc__.php		Procedure database form
 * 
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	Jun, 15 of 2005
 */


$Obj->name= "procedures";
$Obj->alias = "Stored Procedures System";
$Obj->doc = "Stored Procedures and Functions";
$Obj->File = "p_proc";
$Obj->Sort = "name";

$Obj->Add(
	array(
	F_NAME_		=> "name",
	F_ALIAS_	=> "Name", 
	F_HELP_		=> "Procedure Name",
	F_TYPE_		=> "text",
	F_REQUIRED_	=>	1,
	F_LENGTH_	=> 20,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));


$Obj->Add(
    array(
        F_NAME_ => "F_DATA_LOCAL_",
        F_ALIAS_ => "Data Local",
        F_HELP_ => "Local Data Repository",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT * FROM p_proc WHERE name='+el['name'].getStr()+' LIMIT 1'",
        F_QUERY_REF_ => "el['name'].hasChanged()",
        F_LENGTH_ => "20",
        F_NODB_ => "1",
        C_VIEW_ => "false",
        G_SHOW_ => "1",
        G_CHANGE_ => "1"));

$Obj->Add(
    array(
        F_NAME_ => "__autofill__",
        F_ALIAS_ => "Autofill",
        F_HELP_ => "Data Repository",
        F_TYPE_ => "formula",
        F_LENGTH_ => "20",
        F_NODB_ => "1",
        F_FORMULA_ => "el['F_DATA_LOCAL_'].hasChanged()",
        C_VIEW_ => "false",
        G_SHOW_ => "1",
        G_CHANGE_ => "1"));

$Obj->Add(
	array(
	F_NAME_		=> "descr",
	F_ALIAS_	=> "Description", 
	F_HELP_		=> "Procedure Short description",
	F_TYPE_		=> "text",
	F_BROW_		=> 1,
	F_REQUIRED_	=>	1,
	F_MULTI_	=> 1,
	F_LENGTH_	=> 60,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "doc",
	F_ALIAS_	=> "Documentation", 
	F_HELP_		=> "Procedure Documentation",
	F_TYPE_		=> "text",
	F_MULTI_	=> 1.02,
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "type",
	F_ALIAS_	=> "Type", 
	F_HELP_		=> "Procedure Type",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "FUNCTION,PROCEDURE",
	F_REQUIRED_	=>	1,
	F_LENGTH_	=> 20,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "parameters",
	F_ALIAS_	=> "Parameters", 
	F_HELP_		=> "List of input parameters",
	F_TYPE_		=> "text",
	F_MULTI_	=> 1.02,
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "returns",
	F_ALIAS_	=> "Function returns", 
	F_HELP_		=> "List of function returns",
	F_TYPE_		=> "text",
	C_SHOW_		=> "(el['type'].get()=='FUNCTION')",
	F_MULTI_	=> 1,
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "body",
	F_ALIAS_	=> "Body", 
	F_HELP_		=> "Body contents",
	F_TYPE_		=> "text",
	F_MULTI_	=> 1.30,
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));

?>