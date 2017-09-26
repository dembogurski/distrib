<?php
/** def_form.menu__.php		Menu Definition Form
 * 
 * Portuguese Version
 *
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	Jun, 21 of 2005
 */
 

$Obj->SetName ( "Form Definition" );
$Obj->SetAlias( "Formularios");
$Obj->file		= "db.form__";
$Obj->file		= "db.";
$Obj->def_form 	= true;			// if is a definition form
$Obj->def_mul  	= true;			// If is multiple def_form
$Obj->engine 	= true;			// Is only to engine


// Formulary properties
// ====================
$Obj->Add_Def(
	array(
	F_NAME_		=> "name",
	F_ALIAS_	=> "Nome", 
	F_HELP_		=> "Nome do Formulario",
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
	F_HELP_		=> "Alias para o Formulario",
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
	F_ALIAS_	=> "Herdar de", 
	F_HELP_		=> "Herdar dados de outro formulario",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "",
	P_PROC_		=> "tables",
	F_LENGTH_	=> 20,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "File",
	F_ALIAS_	=> "Tabela", 
	F_HELP_		=> "Tabela a qual pertence o formulario",
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
	F_HELP_		=> "Sentença SQL para filtrar conteúdo",
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
	F_ALIAS_	=> "Ordenação", 
	F_HELP_		=> "Sentença de ordenação dos campos",
	F_TYPE_		=> "text",
	P_PROC_		=> "",
	F_REQUIRED_	=> 0,
	F_LENGTH_	=> 90
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "p_insert",
	F_ALIAS_	=> "Proc. Inserir", 
	F_HELP_		=> "Procedimiento adicional para a rotina de inserção",
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
	F_HELP_		=> "Procedimento adicional para a rotina de modificação",
	F_MULTI_	=> 1,
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "p_delete",
	F_ALIAS_	=> "Proc. Apagar", 
	F_HELP_		=> "Procedimento adicional para apagar registros",
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
    F_QUERY_ 	=> "'SELECT CONCAT(|{white}|,|{,}|,|{lightblue}|)'",
    F_QUERY_REF_ => "Zebra.firstSQL&&operation==INS_DATA_",		
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 40,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "Noedit",
	F_ALIAS_	=> "Bloquear Change", 
	F_HELP_		=> "Bloqueia formulario para alteração",
	F_TYPE_		=> "checkbox",
	F_INLINE_	=> "1", 
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "NoInsert",
	F_ALIAS_	=> "Bloquear Insert", 
	F_HELP_		=> "Bloqueia formulario para inserções",
	F_TYPE_		=> "checkbox",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));

$Obj->Add_Def(
	array(
	F_NAME_		=> "Limit",
	F_ALIAS_	=> "Limitar", 
	F_HELP_		=> "Quantidade de linhas limitadas no browser",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 3,
	G_SHOW_		=> '1'
));



// Field data																

$Obj->Add(
	array(
	F_NAME_		=> "F_NAME_",
	F_ALIAS_	=> "Nome", 
	F_HELP_		=> "Nome do campo",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 15,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_ERROR_",
	F_ALIAS_	=> "A T E N Ç Ã O! NOME DE CAMPO INVÁLIDO", 
	F_HELP_		=> "Nome de campo inválido",
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
        F_QUERY_ => "'SELECT * FROM '+". GenData
				."+'.p_data WHERE F_NAME_='+F_NAME_.getStr()+' LIMIT 1'",
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
        F_QUERY_ => "'SELECT * FROM plus_data.p_data WHERE F_NAME_='+F_NAME_.getStr()+' LIMIT 1'",
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
	F_HELP_		=> "Alias do Campo",
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
	F_HELP_		=> "Help contextual do campo",
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
	F_HELP_		=> "Tipo de dado",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "text,select_list,dynamic_select_list,subform,formula,".
					"date,report,proc,db_filled",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 10,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_MULTI_",
	F_ALIAS_	=> "Multiline", 
	F_HELP_		=> "Permite multiplas linhas no texto",
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
	F_HELP_		=> "Controla campo numérico de forma automatica",
	F_TYPE_		=> "checkbox",
	F_INLINE_	=> "1",
	C_SHOW_		=> "el['F_TYPE_'].get()=='text'",
	F_REQUIRED_	=> 0,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_DSL_",
	F_ALIAS_	=> "Condição", 
	F_HELP_		=> "Condição para efetual um Select List Dinâmico",
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
	F_ALIAS_	=> "Opções", 
	F_HELP_		=> "Opções do Campo",
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
	F_HELP_		=> "Formulario a ser chamado",
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
	F_ALIAS_	=> "Relatório", 
	F_HELP_		=> "Relatório a chamar",
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
	F_ALIAS_	=> "Consulta SQL", 
	F_HELP_		=> "Efetual consulta SQL?",
	F_TYPE_		=> "checkbox",
	C_SHOW_		=> "(el['F_TYPE_'].get()=='text')||(el['F_TYPE_'].get()=='date')",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_QUERY_",
	F_ALIAS_	=> "Query", 
	F_HELP_		=> "Consulta a ser efetuadaL",
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
	F_ALIAS_	=> "Condição", 
	F_HELP_		=> "Condição para efetuar a consulta SQL",
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
	F_HELP_		=> "Campo a ser enviado ao subformulario",
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
	F_HELP_		=> "Permite relacinar com campo de outra tabela",
	F_TYPE_		=> "checkbox",
	C_SHOW_		=> "(el['F_TYPE_'].get()=='text')||".
					"(el['F_TYPE_'].get()=='date')",
	F_REQUIRED_	=> 0,
	G_SHOW_		=> '1'
));

$Obj->Add(
	array(
	F_NAME_		=> "F_RELTABLE_",
	F_ALIAS_	=> "Relação - Tabela", 
	F_HELP_		=> "Tabela para relacionar",
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
        F_ALIAS_ => "Colunas",
        F_HELP_ => "Colunas da Tabla",
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
	F_ALIAS_	=> "Relação - Mostrar", 
	F_HELP_		=> "Campo da tabla, que deve ser mostrado",
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
	F_HELP_		=> "Campo da outra tabla para relacionar",
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
	F_HELP_		=> "Campo local para relacionar con a outra tabla",
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

// # 30 end




$Obj->Add(
	array(
	F_NAME_		=> "F_FILTER_",
	F_ALIAS_	=> "Filtro", 
	F_HELP_		=> "Filtro a ser utilizado na consulta",
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
	F_ALIAS_	=> "Tamanho", 
	F_HELP_		=> "Tamano do campoo",
	F_TYPE_		=> "text",
	C_SHOW_		=> "",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 6,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_DEC_",
	F_ALIAS_	=> "Decimais", 
	F_HELP_		=> "Numero de decimais",
	F_TYPE_		=> "text",
	C_SHOW_		=> "(el['F_TYPE_'].get()=='text')||(el['F_TYPE_'].get()=='formula')",
	F_INLINE_	=> "1", 
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 2,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_BROW_",
	F_ALIAS_	=> "Listavel", 
	F_HELP_		=> "Se o campo pode ser visto como coluna em browser"  ,
	F_TYPE_		=> "checkbox",
	P_PROC_		=> "",
	V_DEFAULT_	=> 1,
	F_INLINE_	=> "1", 
	P_SHOW_		=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_REQUIRED_",
	F_ALIAS_	=> "Requerido", 
	F_HELP_		=> "Se o campo é requerido"  ,
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
	F_HELP_		=> "Ignorar campo na base de dados"  ,
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
	P_PROC_		=> "",
	F_INLINE_	=> "1", 
	P_SHOW_		=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_ORD_",
	F_ALIAS_	=> "Ordem", 
	F_HELP_		=> "Ordem no formulario"  ,
	F_TYPE_		=> "text",
	P_PROC_		=> "",
	P_SHOW_		=> "",
	F_BROW_		=> 1,
	F_LENGTH_	=> 3,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_INLINE_",
	F_ALIAS_	=> "in Line", 
	F_HELP_		=> "Na mesma linha anterior"  ,
	F_TYPE_		=> "checkbox",
	P_PROC_		=> "",
	F_INLINE_	=> "1", 
	P_SHOW_		=> "",
	F_BROW_		=> 1,
	F_LENGTH_	=> 3,
	G_SHOW_		=> '1'
));
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
	F_HELP_		=> "Valor default",
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
	F_HELP_		=> "Condição para existencia do campo",
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
	F_HELP_		=> "Condição para que o campo seja visivel",
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
	F_HELP_		=> "Condição para editar o campo",
	F_MULTI_	=> 1,
	F_TYPE_		=> "text",
	C_SHOW_		=> "el['F_EXTRA_'].get()==1",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_PREVAL_",
	F_ALIAS_	=> "Prevalidação", 
	F_HELP_		=> "Prevalidação do campo",
	C_SHOW_		=> "false",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_POSVAL_",
	F_ALIAS_	=> "Posvalidação", 
	F_HELP_		=> "Posvalidação do campo",
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
	F_ALIAS_	=> "Mensagem", 
	F_HELP_		=> "Mensagem de erro para erro de posvalidação",
	C_SHOW_		=> "(el['F_EXTRA_'].get()==1)&&(el['F_POSVAL_'].get()!='')",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_FORMULA_",
	F_ALIAS_	=> "Formula", 
	F_HELP_		=> "Formula para o campo",
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
	F_HELP_		=> "Grupo que pode visualizar o campo"  ,
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
	F_HELP_		=> "Grupo que pode modificar o conteúdo do campo",
	F_TYPE_		=> "INT_PROC",
	P_PROC_		=> "group_trustee",
	C_SHOW_		=> "",
	F_BROW_		=> 1,
	P_SHOW_		=> "",
	F_INLINE_	=> "1", 
	F_PREVAL_	=> "el['G_SHOW_'].getVal()",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));

?>