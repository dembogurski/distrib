<?php


/** db.preferences__.php form to change a Windows sizes preferences
 * 
 * @author	Doglas A. Dembogurski <douglas@ycube.net>
 * @date	May, 21 of 2008 
 */
 
 
$Obj->SetName ( "Preferencias");
$Obj->SetAlias( "Preferencias");

$Obj->Add(
    array(
        F_NAME_ => "__inf",
        F_ALIAS_ => "( ! ) Atenção!",
        F_HELP_ => "( ! ) Atenção!",
        F_TYPE_ => "formula",
        F_LENGTH_ => "65",
        F_BROW_ => "1",
        F_ORD_ => "2",
        F_FORMULA_ => "'Os cambios serão efeituados no proximo inicio de sistema!!!'",
        G_SHOW_ => "2147483647",
        G_CHANGE_ => "2147483647"));

$Obj->Add(
    array(
        F_NAME_ => "__lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "5",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton()",
        G_SHOW_ => "2147483647",
        G_CHANGE_ => "2147483647"));

$Obj->Add(
    array(
        F_NAME_ => "__user",
        F_ALIAS_ => "Código de Usuario",
        F_HELP_ => "Código de Usuario",
        F_TYPE_ => "formula",        
        F_BROW_ => "1",
        F_NODB_ => "1",
        F_ORD_ => "10",
        C_VIEW_ => "false",
        F_FORMULA_ => "p_user_",
        G_SHOW_ => "2147483647",
        G_CHANGE_ => "2147483647"));

$Obj->Add(
    array(
        F_NAME_ => "resh",
        F_ALIAS_ => "Preferencia de Tamanho de Janela Horizontal",
        F_HELP_ => "Preferencia de Tamanho de Janela Horizontal",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT resh FROM p_users WHERE name = '+__user.getStr()",
        F_QUERY_REF_ => "resh.firstSQL",
        F_LENGTH_ => "6",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "20",
        C_SHOW_ => "__user.get()!=''",
        G_SHOW_ => "2147483647",
        G_CHANGE_ => "2147483647"));

$Obj->Add(
    array(
        F_NAME_ => "resv",
        F_ALIAS_ => "Preferencia de Tamanho de Janela Vertical",
        F_HELP_ => "Preferencia de Tamanho de Janela Vertical",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT resv FROM p_users WHERE name = '+__user.getStr()",
        F_QUERY_REF_ => "resv.firstSQL",
        F_LENGTH_ => "6",
        F_DEC_ => "0",
        F_BROW_ => "1",
        F_ORD_ => "30",
        C_SHOW_ => "__user.get()!=''",
        G_SHOW_ => "2147483647",
        G_CHANGE_ => "2147483647"));
	
$Obj->Add(
	array(
	F_NAME_		=> "lang",
	F_ALIAS_	=> "Idioma", 
	F_HELP_		=> "Lenguajen utilizada por o usuario",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "br,en,es",
	F_LENGTH_	=> 2,
        G_SHOW_ => "2147483647",
        G_CHANGE_ => "2147483647"));
	
$Obj->Add(
    array(
        F_NAME_ => "exec_update",
        F_ALIAS_ => "Ok!",
        F_HELP_ => "Ok!",
        F_TYPE_ => "proc",
        F_QUERY_ => "'UPDATE p_users SET resh = '+resh.getVal()+', resv = '+resv.getVal()+',  lang = '+lang.getStr()+' WHERE name = '+__user.getStr()+''",
        F_BROW_ => "1",
        F_ORD_ => "50",
        C_SHOW_ => "resh.getVal()>0&&resv.getVal()>0",
        G_SHOW_ => "2147483647",
        G_CHANGE_ => "2147483647"));

$Obj->Add(
    array(
        F_NAME_ => "__msg",
        F_ALIAS_ => "Mensaje",
        F_HELP_ => "Mensaje",
        F_TYPE_ => "formula",
        F_LENGTH_ => "85",
        F_NODB_ => "1",
        F_ORD_ => "80",
        C_SHOW_ => "exec_update.get()",
        C_VIEW_ => "false",
        F_FORMULA_ => "enableMessageButton('Resolução Alterada!!!');",
        G_SHOW_ => "2147483647",
        G_CHANGE_ => "2147483647"));

$Obj->Add(
    array(
        F_NAME_ => "__goBack",
        F_ALIAS_ => "Volver",
        F_HELP_ => "Volver",
        F_TYPE_ => "formula",
        F_BROW_ => "1",
        F_ORD_ => "90",
        C_SHOW_ => "exec_update.get()",
        C_VIEW_ => "false",
        F_FORMULA_ => "window.opener.location.reload();setTimeout('self.close()',1500);",
        G_SHOW_ => "2147483647",
        G_CHANGE_ => "2147483647"));

?>
