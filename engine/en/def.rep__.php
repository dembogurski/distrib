<?php
/** def_rep__.php		Report Definition Form
 * 
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	Jun, 21 of 2005
 */
 

$Obj->SetName ( "Report Definition" );
$Obj->SetAlias( "Reportes");
$Obj->file		= "rep.";
$Obj->def_form 	= true;			// if is a definition form
$Obj->def_mul  	= true;			// If is multiple def_form
$Obj->engine 	= true;			// Is only to engine


// Formulary properties
// ====================
$Obj->Add_Def(
	array(
	F_NAME_		=> "name",
	F_ALIAS_	=> "Nombre", 
	F_HELP_		=> "Nombre del Reporte",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 15,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "alias",
	F_ALIAS_	=> "Alias", 
	F_HELP_		=> "Alias del Reporte",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 60,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "ndoc",
	F_ALIAS_	=> "Documentacion", 
	F_HELP_		=> "Dato para la documentacion oficial",
	F_TYPE_		=> "text",
	F_PREVAL_	=> "el['alias'].get()",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 60,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "help",
	F_ALIAS_	=> "Help", 
	F_HELP_		=> "Help contextual",
	F_PREVAL_	=> "el['ndoc'].get()",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 60,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "query",
	F_ALIAS_	=> "Query", 
	F_HELP_		=> "Query para el servidor SQL",
	F_TYPE_		=> "text",
	F_MULTI_	=> 1.07,
	F_LENGTH_	=>88,
	G_SHOW_		=> '1'
));
/*
$Obj->Add_Def(
	array(
	F_NAME_		=> "cond_RH",
	F_ALIAS_	=> "Condition to Report Header", 
	F_HELP_		=> "Condici—n para el Encabezado del Reporte",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "lines_RH",
	F_ALIAS_	=> "Lines of Report Header", 
	F_HELP_		=> "Numero de lineas del Encabezado",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	C_SHOW_		=> "el['cond_RH'].get()!=''",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "cond_RF",
	F_ALIAS_	=> "Condition to Report Footer", 
	F_HELP_		=> "Condici—n para el pie del Reporte",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "lines_RF",
	F_ALIAS_	=> "Lines of Report Footer", 
	F_HELP_		=> "Numero de lineas del Pie del Reporte",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	C_SHOW_		=> "el['cond_RF'].get()!=''",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "cond_PH",
	F_ALIAS_	=> "Condition to Page Header", 
	F_HELP_		=> "Condici—n para el Encabezado de la pagina",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "lines_PH",
	F_ALIAS_	=> "Lines of Page Header", 
	F_HELP_		=> "Numero de lineas del encabezado de la pagina",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	C_SHOW_		=> "el['cond_PH'].get()!=''",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "cond_PF",
	F_ALIAS_	=> "Condition to Page Footer", 
	F_HELP_		=> "Condici—n para el pie de pagina",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "lines_PF",
	F_ALIAS_	=> "Lines of Page Footer", 
	F_HELP_		=> "Numero de lineas del pie de pagina",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	C_SHOW_		=> "el['cond_PF'].get()!=''",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "del_prg",
	F_ALIAS_	=> "Rehacer prg", 
	F_HELP_		=> "Rehacer archivo .prg en cada reporte",
	F_TYPE_		=> "checkbox",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
*/
$Obj->Add_Def(
	array(
	F_NAME_		=> "del_tpl",
	F_ALIAS_	=> "Rehacer tpl", 
	F_HELP_		=> "Rehacer archivo .tpl en cada reporte",
	F_TYPE_		=> "checkbox",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));

$Obj->Add_Def(
	array(
	F_NAME_		=> "tot",
	F_ALIAS_	=> "Incluir totales", 
	F_HELP_		=> "Incluir totales en el reporte",
	F_TYPE_		=> "checkbox",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "pre_sub",
	F_ALIAS_	=> "Prevalidar subtotales", 
	F_HELP_		=> "Evalua e imprime subtotal antes de la linea actual del reporte",
	F_TYPE_		=> "checkbox",
	F_OPTIONS_	=> "",
	C_SHOW_		=> "el['tot'].get()!=''",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "cond_sub",
	F_ALIAS_	=> "Condicion para subtotales", 
	F_HELP_		=> "Condicion para que se muestren los subtotales",
	F_TYPE_		=> "text",
	F_MULTI_	=> 1,
	F_OPTIONS_	=> "",
	C_SHOW_		=> "el['tot'].get()!=''",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "subtotal",
	F_ALIAS_	=> "Campos con subtotal", 
	F_HELP_		=> "Lista de campos con subtotales",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	C_SHOW_		=> "el['tot'].get()!=''",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "dec_sub",
	F_ALIAS_	=> "Decimales", 
	F_HELP_		=> "Numero de decimales del campo",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	C_SHOW_		=> "el['tot'].get()!=''",
	F_LENGTH_	=> 2,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "cond_tot",
	F_ALIAS_	=> "Condicion para totales", 
	F_HELP_		=> "Condicion para que se muestren los totales",
	F_TYPE_		=> "text",
	F_MULTI_	=> 1,
	F_OPTIONS_	=> "",
	C_SHOW_		=> "el['tot'].get()!=''",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "total",
	F_ALIAS_	=> "Campos con total", 
	F_HELP_		=> "Lista de campos con totales",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	C_SHOW_		=> "el['tot'].get()!=''",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "dec_tot",
	F_ALIAS_	=> "Decimales", 
	F_HELP_		=> "Numero de decimales del campo",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	C_SHOW_		=> "el['tot'].get()!=''",
	F_LENGTH_	=> 2,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "query_end",
	F_ALIAS_	=> "Procedure Final", 
	F_HELP_		=> "Procedure a ejecutar en el final del reporte",
	F_TYPE_		=> "text",
	F_MULTI_	=> 1,
	F_LENGTH_	=> 88,
	G_SHOW_		=> '1'
));



// Section data																

$Obj->Add(
	array(
	F_NAME_		=> "F_NAME_",
	F_ALIAS_	=> "Nombre", 
	F_HELP_		=> "Nombre de la seccion",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 15,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_ERROR_",
	F_ALIAS_	=> "A T E N C I Ó N !   NOMBRE DE SECCION INVÁLIDO!", 
	F_HELP_		=> "Nombre de campo invalido",
	F_TYPE_		=> "formula",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 2,
	C_SHOW_		=> "!el['F_NAME_'].validField()",
	F_FORMULA_	=> "''",
	G_SHOW_		=> '1'
));

$Obj->Add(
	array(
	F_NAME_		=> "F_DOC_",
	F_ALIAS_	=> "Documentacion", 
	F_HELP_		=> "Documentacion de la seccion",
	F_TYPE_		=> "text",
	F_PREVAL_	=> "",
	V_DEFAULT_	=> '',
	F_PREVALID	=> '',
	F_REQUIRED_	=> 1,
	F_BROW_		=> 1,
	F_LENGTH_	=> 60,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_QUERY_",
	F_ALIAS_	=> "Query", 
	F_HELP_		=> "Query para el servidor SQL",
	F_TYPE_		=> "text",
	F_MULTI_	=> 1,
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 100,
	G_SHOW_		=> '1'
));

?>