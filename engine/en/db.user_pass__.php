<?php
/** db_form.group__.php		Group database form
 * 
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	Jun, 15 of 2005
 */
 

$Obj->SetName ( "User Password Control" );
$Obj->SetAlias( "Passwords of a users of a system");
$Obj->File = "p_users";

$Obj->Add(
	array(
	F_NAME_		=> "name",
	F_ALIAS_	=> "Name", 
	F_HELP_		=> "User Name",
	F_TYPE_		=> "text",
	C_SHOW_		=> "operation!=INSERT_",
	F_BROW_		=> 1,
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 40,
    G_SHOW_ 	=> "2147483647",
    G_CHANGE_ => "2147483647"
));

$Obj->Add(
	array(
	F_NAME_		=> "password",
	F_ALIAS_	=> "Password", 
	F_HELP_		=> "User Password",
	F_TYPE_		=> "password",
	P_SHOW_		=> "",
	C_SHOW_		=> "operation!=INSERT_",
	F_LENGTH_	=> 20,
	F_REQUIRED_	=> 1,
    G_SHOW_ 	=> "2147483647",
    G_CHANGE_ => "2147483647"
));
$Obj->Add(
	array(
	F_NAME_		=> "pass2",
	F_ALIAS_	=> "Confirm", 
	F_HELP_		=> "Password Confirmation",
	F_TYPE_		=> "password",
	C_SHOW_		=> "operation!=INSERT_",
	P_SHOW_		=> "",
	F_NODB_		=> 1,
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 20,
    G_SHOW_ 	=> "2147483647",
    G_CHANGE_ => "2147483647"
));
$Obj->Add(
	array(
	F_NAME_		=> "check",
	F_ALIAS_	=> "check", 
	F_HELP_		=> "Check and apply the user password",
	F_TYPE_		=> "INT_PROC",
	C_SHOW_		=> "operation!=INSERT_",
	P_PROC_		=> "password",
	F_NODB_		=> 1,
	P_SHOW_		=> "",
	F_LENGTH_	=> 1,
    G_SHOW_ 	=> "2147483647",
    G_CHANGE_ => "2147483647"
));
$Obj->Add(
    array(
        F_NAME_ => "__disableDel",
        F_ALIAS_ => "Inhabilita boton de borrar",
        F_HELP_ => "Inhabilita boton de borrar",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "90",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableDeleteButton()",
    G_SHOW_ 	=> "2147483647",
    G_CHANGE_ => "2147483647"
));

			
//} // LoadMenu() -------------------------------------------------------------
?>