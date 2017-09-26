<?php
/** db.new_project__.php form to create a new empty project		 
 * 
 * @author	Doglas A. Dembogurski <douglas@ycube.net>
 * @date	Nov, 15 of 2007 
 */
 

$Obj->SetName ( "Creating a new Project");
$Obj->SetAlias( "Creating a new Project");

$Obj->Add(
    array(
        F_NAME_ => "proj_lock",
        F_ALIAS_ => "Lock the Insert/Accept button",
        F_HELP_ => "Creating a new Project",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "1",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton()",
        G_SHOW_ => "1",
));

$Obj->Add(
	array(
	F_NAME_		=> "proj_name",
	F_ALIAS_	=> "Project name", 
	F_HELP_		=> "Project name",
	F_TYPE_		=> "text",
	C_SHOW_		=> "operation!=INSERT_",
	F_BROW_		=> 1,
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 40,
	G_SHOW_		=> '2147483647'
));

$Obj->Add(
    array(
        F_NAME_ => "proj_create",
        F_ALIAS_ => "Create the project",
        F_HELP_ => "Create the project",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "No,Yes",
        F_NODB_ => "1",
        F_ORD_ => "20",
        C_SHOW_ => "proj_name.get()!=''",
        C_VIEW_ => "proj_name.get()!=''",
        G_SHOW_		=> '2147483647'
));

$Obj->Add(
    array(
        F_NAME_ => "proj_rpc_call",
        F_ALIAS_ => "LLama a rpc",
        F_HELP_ => "LLama a rpc",
        F_TYPE_ => "formula",
        F_LENGTH_ => "20",
        F_REQUIRED_ => "1",
        F_ORD_ => "30",
        C_SHOW_ => "proj_create.get()=='Yes'",
        C_VIEW_ => "false",
        F_FORMULA_ => "callRPC( proj_name.get() , 'plusRPC.php?action=NEW_PROJECT_&obj='+ proj_name.get() );",
        G_SHOW_		=> '2147483647'
));

$Obj->Add(
    array(
        F_NAME_ => "proj_msg",
        F_ALIAS_ => "Message button",
        F_HELP_ => "Message button",
        F_TYPE_ => "formula",
        F_LENGTH_ => "10",
        F_NODB_ => "1",
        F_ORD_ => "35",
        C_VIEW_ => "false",
        C_SHOW_ => "proj_rpc_call.get()!='false'&&proj_create.get()=='Yes'",
        F_FORMULA_ => "enableMessageButton('Ok!!! the new project has been created with success !!!',2800);",
        G_SHOW_		=> '2147483647'
));

$Obj->Add(
    array(
        F_NAME_ => "proj__goBack",
        F_ALIAS_ => "Volver",
        F_HELP_ => "Volver",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "40",
        C_SHOW_ => "proj_rpc_call.get()!='false'&&proj_create.get()=='Yes'",
        C_VIEW_ => "false",
        F_FORMULA_ => "window.opener.location.reload();setTimeout('self.close()',3000);",
        G_SHOW_		=> '2147483647'
));			

?>