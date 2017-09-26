<?php
/** def_form.menu__.php		Menu Definition Form
 * 
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	Jun, 21 of 2005
 */
 

$Obj->SetName ( "Form Definition" );
$Obj->SetAlias( "Formularios");
$Obj->file		= "db.form__";
$Obj->file		= "db.ent";
$Obj->def_form 	= true;			// if is a definition form
$Obj->def_mul  	= true;			// If is multiple def_form
$Obj->engine 	= true;			// Is only to engine


// Formulary properties
// ====================
$Obj->Add_Def(
	array(
	F_NAME_		=> "name",
	F_ALIAS_	=> "Nombre", 
	F_HELP_		=> "Nombre del Formulario",
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
	F_HELP_		=> "Alias del Formulario",
	F_TYPE_		=> "text",
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
	F_PREVAL_	=> "el['alias'].get()",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 60,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "copy_from",
	F_ALIAS_	=> "Copiar de", 
	F_HELP_		=> "Copiar formulario",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> ",",	
	P_PROC_		=> "menu_link",
	C_SHOW_		=> "operation==INS_DATA_",
	F_LENGTH_	=> 40,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "Inheritance",
	F_ALIAS_	=> "Heredar de", 
	F_HELP_		=> "Heredar datos de otro formulario",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "",
	P_PROC_		=> "tables",
	F_LENGTH_	=> 20,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "File",
	F_ALIAS_	=> "Tabla", 
	F_HELP_		=> "Tabla a la cual pertenece el formulario",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "[ INSERT ]",
	P_PROC_		=> "tables",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 20,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "Filter",
	F_ALIAS_	=> "Filtro", 
	F_HELP_		=> "Sentencia SQL para filtrar el contenido",
	V_DEFAULT_	=> "",
	F_TYPE_		=> "text",
	F_MULTI_	=> "1",
	P_PROC_		=> "",
	F_REQUIRED_	=> 0,
	F_LENGTH_	=> 90
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "Sort",
	F_ALIAS_	=> "Ordenacion", 
	F_HELP_		=> "Sentencia de ordenacion de los campos",
	F_TYPE_		=> "text",
	P_PROC_		=> "",
	F_REQUIRED_	=> 0,
	F_LENGTH_	=> 90
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "p_insert",
	F_ALIAS_	=> "Proc. Insert", 
	F_HELP_		=> "Procedimientos adicionales para inserciones",
	F_MULTI_	=> 1,
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "p_change",
	F_ALIAS_	=> "Proc. Modificar", 
	F_HELP_		=> "Procedimientos adicionales para modificaciones",
	F_MULTI_	=> 1,
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "p_delete",
	F_ALIAS_	=> "Proc. Borrar", 
	F_HELP_		=> "Procedimientos adicionales para borrar registros",
	F_MULTI_	=> 1,
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "Zebra",
	F_ALIAS_	=> "Colores de Zebra", 
	F_HELP_		=> "Alterna colores de zebra en el browse",
	F_TYPE_		=> "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT CONCAT(|{white}|,|{,}|,|{lightblue}|)'",
        F_QUERY_REF_ => "Zebra.firstSQL&&operation==INS_DATA_",	
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 40,	
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "Noedit",
	F_ALIAS_	=> "Bloquear Change", 
	F_HELP_		=> "Impide alterar datos en el formulario",
	F_TYPE_		=> "checkbox",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "NoInsert",
	F_ALIAS_	=> "Bloquear Insert", 
	F_HELP_		=> "Impide insertar datos en el formulario",
	F_TYPE_		=> "checkbox",
	F_INLINE_	=> "1", 
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));

$Obj->Add_Def(
	array(
	F_NAME_		=> "Limit",
	F_ALIAS_	=> "Limitar", 
	F_HELP_		=> "Cantidad de datos por página de browser",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 3,
	G_SHOW_		=> '1'
));



// Field data																

$Obj->Add(
	array(
	F_NAME_		=> "F_NAME_",
	F_ALIAS_	=> "Nombre", 
	F_HELP_		=> "Nombre del Campo",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 15,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_ERROR_",
	F_ALIAS_	=> "A T E N C I Ó N !   NOMBRE DE CAMPO INVÁLIDO!", 
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
        F_NAME_ => "F_READ_TRUSTEES",
        F_ALIAS_ => "Read Trustees",
        F_HELP_ => "Read a anterior trustes",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT G_SHOW_, G_CHANGE_ FROM p_data ORDER BY id DESC LIMIT 1'",
        F_QUERY_REF_ => "F_NAME_.hasChanged()",
        F_LENGTH_ => "20",
        F_NODB_ => "1",
        C_VIEW_ => "false",
        G_SHOW_ => "1",
        G_CHANGE_ => "1"));
$Obj->Add(
    array(
        F_NAME_ => "F_DATA_LOCAL_",
        F_ALIAS_ => "Data Local",
        F_HELP_ => "Local Data Repository",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT * FROM p_data WHERE F_NAME_='+F_NAME_.getStr()+' LIMIT 1'",
        F_QUERY_REF_ => "F_NAME_.hasChanged()",
        F_LENGTH_ => "20",
        F_NODB_ => "1",
        C_VIEW_ => "false",
        G_SHOW_ => "1",
        G_CHANGE_ => "1"));

$Obj->Add(
    array(
        F_NAME_ => "F_DATA_GLOBAL",
        F_ALIAS_ => "Data Global",
        F_HELP_ => "Global Data Repository",
        F_TYPE_ => "text",
        F_MAKE_QUERY_ => "1",
        F_QUERY_ => "'SELECT * FROM '+". GenData
				."+'.p_data WHERE F_NAME_='+F_NAME_.getStr()+' LIMIT 1'",
        F_QUERY_REF_ => "(F_DATA_LOCAL_.hasChanged())&&(F_DATA_LOCAL_.get()=='__NO DATA__')",
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
        F_FORMULA_ => "db('F_NAME_')",
        C_VIEW_ => "false",
        G_SHOW_ => "1",
        G_CHANGE_ => "1"));
$Obj->Add(
	array(
	F_NAME_		=> "F_ALIAS_",
	F_ALIAS_	=> "Alias", 
	F_HELP_		=> "Alias del Campo",
	F_TYPE_		=> "text",
	C_SHOW_		=> "",
	F_PREVAL_	=> '',
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 60,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_HELP_",
	F_ALIAS_	=> "Help", 
	F_HELP_		=> "Help contextual del campo",
	F_TYPE_		=> "text",
	F_PREVAL_	=> "el['F_ALIAS_'].get()",
	V_DEFAULT_	=> '',
	F_PREVALID	=> '',
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 60,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_TYPE_",
	F_ALIAS_	=> "Tipo", 
	F_HELP_		=> "Tipo de dato",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "text,select_list,dynamic_select_list,subform,formula,".
					"date,report,proc",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 10,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_MULTI_",
	F_ALIAS_	=> "Multiline", 
	F_HELP_		=> "Permite multiples lines in text",
	F_TYPE_		=> "checkbox",
	F_INLINE_	=> "1",
	C_SHOW_		=> "el['F_TYPE_'].get()=='text'",
	F_REQUIRED_	=> 0,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_AUTONUM_",
	F_ALIAS_	=> "Autonumerico", 
	F_HELP_		=> "Controla campo numerico automáticamente",
	F_TYPE_		=> "checkbox",
	F_INLINE_	=> "1",
	C_SHOW_		=> "el['F_TYPE_'].get()=='text'",
	F_REQUIRED_	=> 0,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_DSL_",
	F_ALIAS_	=> "Condicion", 
	F_HELP_		=> "Condicion para el Select List Dinamico",
	F_TYPE_		=> "text",
	C_SHOW_		=> "(el['F_TYPE_'].get()=='dynamic_select_list')",
	F_MULTI_	=> 1,
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_OPTIONS_",
	F_ALIAS_	=> "Opciones", 
	F_HELP_		=> "Opciones del Campo",
	F_TYPE_		=> "text",
	F_MULTI_	=> 1,
	C_SHOW_		=> "(el['F_TYPE_'].get()!='text')||(el['F_AUTONUM_'].get()!='')",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_LINK_",
	F_ALIAS_	=> "Link", 
	F_HELP_		=> "Objeto a ser llamado",
	F_TYPE_		=> "select_list",
	C_SHOW_		=> "(el['F_TYPE_'].get()=='subform')",
	F_REQUIRED_	=> 1,
	F_OPTIONS_	=> ",",	
	P_PROC_		=> "menu_link",
	F_LENGTH_	=> 40,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_REPORT_",
	F_ALIAS_	=> "Reporte", 
	F_HELP_		=> "Reporte a ser llamado",
	F_TYPE_		=> "select_list",
	C_SHOW_		=> "(el['F_TYPE_'].get()=='report')",
	F_REQUIRED_	=> 1,
	F_OPTIONS_	=> ",",	
	P_PROC_		=> "report_link",
	F_LENGTH_	=> 40,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_MAKE_QUERY_",
	F_ALIAS_	=> "Llamar SQL", 
	F_HELP_		=> "Debe efectuar una consulta SQL?",
	F_TYPE_		=> "checkbox",
	C_SHOW_		=> "(el['F_TYPE_'].get()=='text')||(el['F_TYPE_'].get()=='date')",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_QUERY_",
	F_ALIAS_	=> "Query", 
	F_HELP_		=> "Query para el servidor SQL",
	F_TYPE_		=> "text",
	C_SHOW_		=> "(el['F_MAKE_QUERY_'].get()>'0')||(el['F_TYPE_'].get()=='proc')",
	F_MULTI_	=> 1,
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_QUERY_REF_",
	F_ALIAS_	=> "Condición", 
	F_HELP_		=> "Condición de referencia para consultar la Dase de Datos",
	F_TYPE_		=> "text",
	C_SHOW_		=> "el['F_MAKE_QUERY_'].get()>'0'",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_SEND_",
	F_ALIAS_	=> "Transporte", 
	F_HELP_		=> "Campo a ser enviado al subform",
	F_TYPE_		=> "text",
	C_SHOW_		=> "el['F_TYPE_'].get()=='subform'",
	F_REQUIRED_	=> 1,
	F_OPTIONS_	=> "",	
	P_PROC_		=> "menu_link",
	F_LENGTH_	=> 40,
	G_SHOW_		=> '1'
));



$Obj->Add(
	array(
	F_NAME_		=> "F_RELATION_",
	F_ALIAS_	=> "Relacionar", 
	F_HELP_		=> "Permite relacinar con campo de otra tabla",
	F_TYPE_		=> "checkbox",
	C_SHOW_		=> "(el['F_TYPE_'].get()=='text')||".
					"(el['F_TYPE_'].get()=='date')",
	F_REQUIRED_	=> 0,
	G_SHOW_		=> '1'
));


$Obj->Add(
	array(
	F_NAME_		=> "F_RELTABLE_",
	F_ALIAS_	=> "Relacion - Tabla", 
	F_HELP_		=> "Tabla de relacion",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> ",",
	C_SHOW_		=> "(el['F_TYPE_'].get()=='select_list')||".
					"(el['F_TYPE_'].get()=='dynamic_select_list')||".
					"(el['F_RELATION_'].get()!='')",
	P_PROC_		=> "tables",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));

// ##### 30
// Table field select
$Obj->Add(
    array(
        F_NAME_ => "F_RELCOL_",
        F_ALIAS_ => "Columnas",
        F_HELP_ => "Columnas de la Tabla",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "F_RELTABLE_.hasChanged()",
        F_RELTABLE_ => "information_schema.COLUMNS",
        F_SHOWFIELD_ => "COLUMN_NAME,''",
        F_FILTER_ => "' TABLE_NAME = '+F_RELTABLE_.getStr()+' and COLUMN_NAME <> |{id}| ' ",
		C_SHOW_		=> "(el['F_TYPE_'].get()=='select_list')||".
					"(el['F_TYPE_'].get()=='dynamic_select_list')||".
					"(el['F_RELATION_'].get()!='' ) &&  el['F_RELTABLE_'].get()!='' ",
		C_VIEW_ => "operation!=EDIT_SHOW_",		
        F_NODB_ => "1",
        F_ORD_ => "120",
        F_INLINE_ => "1",
        G_SHOW_ => "1",
        G_CHANGE_ => "1"));
	
$Obj->Add(
	array(
	F_NAME_		=> "F_SHOWFIELD_",
	F_ALIAS_	=> "Relacion - Mostrar", 
	F_HELP_		=> "Campo de la tabla, que debe ser mostrado",
	F_TYPE_		=> "text", 	
	F_MAKE_QUERY_ => "1",
        F_QUERY_ => "F_SHOWFIELD_.get()==''? 'SELECT CONCAT('+F_RELCOL_.getStr()+', |{}| )' : 'SELECT CONCAT('+F_SHOWFIELD_.getStr()+', |{,}|  ,'+F_RELCOL_.getStr()+')'   ",
        F_QUERY_REF_ => "F_RELCOL_.hasChanged()",	
	C_SHOW_		=> "el['F_RELTABLE_'].get()!=''",
	F_OPTIONS_	=> "",
	P_PROC_		=> "",
	F_LENGTH_	=> 80,
	G_SHOW_		=> '1'
));


$Obj->Add(
	array(
	F_NAME_		=> "F_RELFIELD_",
	F_ALIAS_	=> "Campo Externo", 
	F_HELP_		=> "Campo de la otra tabla para relacionar",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "F_RELTABLE_.hasChanged()",
        F_RELTABLE_ => "information_schema.COLUMNS",
        F_SHOWFIELD_ => "COLUMN_NAME,''",
        F_FILTER_ => "' TABLE_NAME = '+F_RELTABLE_.getStr()+' and COLUMN_NAME <> |{id}| ' ",
	C_SHOW_		=> "el['F_RELATION_'].get()!=''",
	F_OPTIONS_	=> "",
	P_PROC_		=> "",
	F_LENGTH_	=> 80,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_LOCALFIELD_",
	F_ALIAS_	=> "Campo local", 
	F_HELP_		=> "Campo local para relacionar con la otra tabla",
        F_TYPE_ => "dynamic_select_list",
        F_DSL_ => "F_RELTABLE_.hasChanged()",
        F_RELTABLE_ => "information_schema.COLUMNS",
        F_SHOWFIELD_ => "COLUMN_NAME,''",
        F_FILTER_ => "' TABLE_NAME = |{'+localTable+'}| and COLUMN_NAME <> |{id}| ' ",
	C_SHOW_		=> "el['F_RELATION_'].get()!=''",
	F_OPTIONS_	=> "",
    F_INLINE_ => "1",
	P_PROC_		=> "",
	F_LENGTH_	=> 80,
	G_SHOW_		=> '1'
));

/* OLD IN # 30
$Obj->Add(
	array(
	F_NAME_		=> "F_SHOWFIELD_",
	F_ALIAS_	=> "Relacion - Mostrar", 
	F_HELP_		=> "Campo de la tabla, que debe ser mostrado",
	F_TYPE_		=> "text",
	C_SHOW_		=> "el['F_RELTABLE_'].get()!=''",
	F_OPTIONS_	=> "",
	P_PROC_		=> "",
	F_LENGTH_	=> 80,
	G_SHOW_		=> '1'
));


$Obj->Add(
	array(
	F_NAME_		=> "F_RELFIELD_",
	F_ALIAS_	=> "Campo Externo", 
	F_HELP_		=> "Campo de la otra tabla para relacionar",
	F_TYPE_		=> "text",
	C_SHOW_		=> "el['F_RELATION_'].get()!=''",
	F_OPTIONS_	=> "",
	P_PROC_		=> "",
	F_LENGTH_	=> 80,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_LOCALFIELD_",
	F_ALIAS_	=> "Campo local", 
	F_HELP_		=> "Campo local para relacionar con la otra tabla",
	F_TYPE_		=> "text",
	C_SHOW_		=> "el['F_RELATION_'].get()!=''",
	F_OPTIONS_	=> "",
	P_PROC_		=> "",
	F_LENGTH_	=> 80,
	G_SHOW_		=> '1'
));
*/

$Obj->Add(
	array(
	F_NAME_		=> "F_FILTER_",
	F_ALIAS_	=> "Filtro", 
	F_HELP_		=> "Filtro a ser aplicado en el Query",
	F_TYPE_		=> "text",
	F_MULTI_	=> 1,
	C_SHOW_		=> "(el['F_RELTABLE_'].get()!='')&&".
					"el['F_RELATION_'].get()==''",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_LENGTH_",
	F_ALIAS_	=> "Tamaño", 
	F_HELP_		=> "Tamaño del campo",
	F_TYPE_		=> "text",
	F_BROW_		=> 1,
	C_SHOW_		=> "",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 6,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_DEC_",
	F_ALIAS_	=> "Decimales", 
	F_HELP_		=> "Numero de decimales",
	F_TYPE_		=> "text",
	C_SHOW_		=> "(el['F_TYPE_'].get()=='text')||(el['F_TYPE_'].get()=='formula')",
	F_OPTIONS_	=> "",
	F_INLINE_	=> "1", 
	F_LENGTH_	=> 2,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_BROW_",
	F_ALIAS_	=> "Listable", 
	F_HELP_		=> "Si puede aparecer en los browses"  ,
	F_TYPE_		=> "checkbox",
	P_PROC_		=> "",
	V_DEFAULT_	=> "1",
	F_INLINE_	=> "1", 
	P_SHOW_		=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_REQUIRED_",
	F_ALIAS_	=> "Requerido", 
	F_HELP_		=> "Si el campo es requerido"  ,
	F_TYPE_		=> "checkbox",
	P_PROC_		=> "",
	P_SHOW_		=> "",
	F_BROW_		=> 1,
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_NODB_",
	F_ALIAS_	=> "Ignorar", 
	F_HELP_		=> "Ignorar en la base de Datos"  ,
	F_TYPE_		=> "checkbox",
	P_PROC_		=> "",
	F_INLINE_	=> "1", 
	P_SHOW_		=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_TOTAL_",
	F_ALIAS_	=> "Totalizar", 
	F_HELP_		=> "1 si el campo debe totalizar en browses"  ,
	F_TYPE_		=> "checkbox",
	C_SHOW_		=> "el['F_DEC_'].get()!=''",
	F_INLINE_	=> "1", 
	P_PROC_		=> "",
	P_SHOW_		=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_ORD_",
	F_ALIAS_	=> "Orden", 
	F_HELP_		=> "Orden en el formulario"  ,
	F_TYPE_		=> "text",
	P_PROC_		=> "",
	P_SHOW_		=> "",
	F_BROW_		=> 1,
	F_LENGTH_	=> 3,
	G_SHOW_		=> '1'
));

// ##### 21 
$Obj->Add(
	array(
	F_NAME_		=> "F_INLINE_",
	F_ALIAS_	=> "in Line", 
	F_HELP_		=> "En la Misma fila anterior"  ,
	F_TYPE_		=> "checkbox",
	P_PROC_		=> "",
	P_SHOW_		=> "",
	F_INLINE_	=> "1", 
	F_BROW_		=> 1,
	F_LENGTH_	=> 3,
	G_SHOW_		=> '1'
));
// ##### 21
$Obj->Add(
	array(
	F_NAME_		=> "F_UNIQ_",
	F_ALIAS_	=> "Unico", 
	F_HELP_		=> "Campo Unico",
	F_TYPE_		=> "checkbox",
	C_SHOW_		=> "",
	F_INLINE_	=> "1", 
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_EXTRA_",
	F_ALIAS_	=> "Campos Extra", 
	F_HELP_		=> "Visualizar campos extra"  ,
	F_TYPE_		=> "checkbox",
	F_NODB_		=> 1,
	P_PROC_		=> "",
	V_DEFAULT_	=> "",
	F_INLINE_	=> "1", 
	P_SHOW_		=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "V_DEFAULT_",
	F_ALIAS_	=> "Defecto", 
	F_HELP_		=> "Valor por defecto",
	C_SHOW_		=> "el['F_EXTRA_'].get()==1",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "C_SHOW_",
	F_ALIAS_	=> "Cond_Exist", 
	F_HELP_		=> "Condición para que el campo exista en el presente formulario",
	F_MULTI_	=> 1,
	F_TYPE_		=> "text",
	C_SHOW_		=> "el['F_EXTRA_'].get()==1",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "C_VIEW_",
	F_ALIAS_	=> "Cond_Show", 
	F_HELP_		=> "Condición para que el campo sea visible",
	F_MULTI_	=> 1,
	F_TYPE_		=> "text",
	C_SHOW_		=> "el['F_EXTRA_'].get()==1",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "C_CHANGE_",
	F_ALIAS_	=> "Cond_Change", 
	F_HELP_		=> "Condición para Editar el campo",
	F_MULTI_	=> 1,
	F_TYPE_		=> "text",
	C_SHOW_		=> "el['F_EXTRA_'].get()==1",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));

# 18

/*
$Obj->Add(
	array(
	F_NAME_		=> "C_DEL_",
	F_ALIAS_	=> "Cond_Delete", 
	F_HELP_		=> "Condición para Borrar el campo",
	F_MULTI_	=> 1,
	F_TYPE_		=> "text",
	C_SHOW_		=> "el['F_EXTRA_'].get()==1",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
*/


$Obj->Add(
	array(
	F_NAME_		=> "F_PREVAL_",
	F_ALIAS_	=> "Prevalidación", 
	F_HELP_		=> "Prevalidación del campo",
	C_SHOW_		=> "false",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));


$Obj->Add(
	array(
	F_NAME_		=> "F_POSVAL_",
	F_ALIAS_	=> "Posvalidación", 
	F_HELP_		=> "Posvalidación del campo",
	C_SHOW_		=> "el['F_EXTRA_'].get()==1",
	F_MULTI_	=> 1,
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_MESSAGE_",
	F_ALIAS_	=> "Messaje de error", 
	F_HELP_		=> "Mensaje de error de Posvalidación del campo",
	C_SHOW_		=> "(el['F_EXTRA_'].get()==1)&&(el['F_POSVAL_'].get()!='')",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));

# 18

$Obj->Add(
	array(
	F_NAME_		=> "F_FORMULA_",
	F_ALIAS_	=> "Formula", 
	F_HELP_		=> "Formula para el campo",
	F_TYPE_		=> "text",
	C_SHOW_		=> "(el['F_TYPE_'].get()=='formula')",
	F_MULTI_	=> 1,
	F_REQUIRED_	=> 1,
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));

$Obj->Add(
	array(
	F_NAME_		=> "G_SHOW_",
	F_ALIAS_	=> "Grupo Ver", 
	F_HELP_		=> "Grupo que puede visualizar el campo"  ,
	F_TYPE_		=> "INT_PROC",
	P_PROC_		=> "group_trustee",
	C_SHOW_		=> "",
	F_BROW_		=> 1,
	P_SHOW_		=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "G_CHANGE_",
	F_ALIAS_	=> "Grupo Modificar", 
	F_HELP_		=> "Grupo que puede modificar el contenido del campo",
	F_TYPE_		=> "INT_PROC",
	P_PROC_		=> "group_trustee",
	C_SHOW_		=> "",
	F_BROW_		=> 1,
	F_INLINE_	=> "1", 
	P_SHOW_		=> "",
	F_PREVAL_	=> "el['G_SHOW_'].getVal()",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));

?>