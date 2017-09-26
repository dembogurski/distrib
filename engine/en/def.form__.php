<?php
/** def_form.menu__.php		Menu Definition Form
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
	F_ALIAS_	=> "Name", 
	F_HELP_		=> "Formulay Name",
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
	F_HELP_		=> "Formulary Alias",
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
	F_HELP_		=> "Contextual Help",
	F_PREVAL_	=> "el['alias'].get()",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 60,
	G_SHOW_		=> '1'
));

// ##### 20
// Copy from other formulary
$Obj->Add_Def(
	array(
	F_NAME_		=> "copy_from",
	F_ALIAS_	=> "Copy From", 
	F_HELP_		=> "Copy from other form",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> ",",	
	P_PROC_		=> "menu_link",
	C_SHOW_		=> "operation==INS_DATA_",
	F_LENGTH_	=> 40,
	G_SHOW_		=> '1'
));
// ##### 20

// ##### 23
// Inheritance resource
$Obj->Add_Def(
	array(
	F_NAME_		=> "Inheritance",
	F_ALIAS_	=> "Inherit From", 
	F_HELP_		=> "Inherit data from other formulary",
	F_TYPE_		=> "select_list",
	F_OPTIONS_	=> "",
	P_PROC_		=> "tables",
	F_LENGTH_	=> 20,
	G_SHOW_		=> '1'
));
// ##### 23

$Obj->Add_Def(
	array(
	F_NAME_		=> "File",
	F_ALIAS_	=> "Table", 
	F_HELP_		=> "Table to connect a form",
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
	F_ALIAS_	=> "Filter", 
	F_HELP_		=> "SQL sentence to filter a content",
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
	F_ALIAS_	=> "Sort", 
	F_HELP_		=> "Field sort sentence",
	F_TYPE_		=> "text",
	P_PROC_		=> "",
	F_REQUIRED_	=> 0,
	F_LENGTH_	=> 90
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "p_insert",
	F_ALIAS_	=> "Proc. Insert", 
	F_HELP_		=> "Procedure used in a insert element",
	F_MULTI_	=> 1,
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "p_change",
	F_ALIAS_	=> "Proc. Change", 
	F_HELP_		=> "Procedure used in a change element",
	F_MULTI_	=> 1,
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "p_delete",
	F_ALIAS_	=> "Proc. Delete", 
	F_HELP_		=> "Procedure used in a delete a element",
	F_MULTI_	=> 1,
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "Zebra",
	F_ALIAS_	=> "Zebra effect", 
	F_HELP_		=> "Colours to use in a zebra effects",
	F_TYPE_		=> "text",
	F_MAKE_QUERY_ => "1",
        F_QUERY_		=> "'SELECT CONCAT(|{white}|,|{,}|,|{lightblue}|)'",
        F_QUERY_REF_ 	=> "Zebra.firstSQL&&operation==INS_DATA_",		
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 40,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "Noedit",
	F_ALIAS_	=> "Lock Edit", 
	F_HELP_		=> "Lock form to a non editable mode",
	F_TYPE_		=> "checkbox",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "NoInsert",
	F_ALIAS_	=> "Lock Insert", 
	F_HELP_		=> "Lock the insert button in the form",
	F_TYPE_		=> "checkbox",
	F_OPTIONS_	=> "",
	F_INLINE_	=> "1", 
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add_Def(
	array(
	F_NAME_		=> "Limit",
	F_ALIAS_	=> "Limit", 
	F_HELP_		=> "Number of lines to limit a browser of form",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 3,
	G_SHOW_		=> '1'
));



// Field data																

$Obj->Add(
	array(
	F_NAME_		=> "F_NAME_",
	F_ALIAS_	=> "Name", 
	F_HELP_		=> "Field Name",
	F_TYPE_		=> "text",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 15,
	F_BROW_		=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_ERROR_",
	F_ALIAS_	=> "D A N G E R !  INVALID FIELD NAME", 
	F_HELP_		=> "Invalid Field name",
	F_TYPE_		=> "formula",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 2,
	C_SHOW_		=> "!el['F_NAME_'].validField()",
	F_FORMULA_	=> "''",
	G_SHOW_		=> '1'
));


// ##### 11 - G_SHOW_ and G_CHANGE_ automatic
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
// ##### 11 end		

// ##### 7
// Data Repository
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

// ##### 7 end


$Obj->Add(
	array(
	F_NAME_		=> "F_ALIAS_",
	F_ALIAS_	=> "Alias", 
	F_HELP_		=> "Field Alias",
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
	F_HELP_		=> "Field Contextual Help",
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
	F_ALIAS_	=> "Tipe", 
	F_HELP_		=> "Data Type",
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
	F_HELP_		=> "Multiples lines in a text",
	F_TYPE_		=> "checkbox",
	C_SHOW_		=> "el['F_TYPE_'].get()=='text'",
	F_INLINE_	=> "1",
	F_REQUIRED_	=> 0,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_AUTONUM_",
	F_ALIAS_	=> "Autonumerical", 
	F_HELP_		=> "Auto control to a numeric values",
	F_TYPE_		=> "checkbox",
	F_INLINE_	=> "1",
	C_SHOW_		=> "el['F_TYPE_'].get()=='text'",
	F_REQUIRED_	=> 0,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_DSL_",
	F_ALIAS_	=> "Condition", 
	F_HELP_		=> "Condition to execute a Dynamic Select List",
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
	F_ALIAS_	=> "Options", 
	F_HELP_		=> "Field Options",
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
	F_HELP_		=> "Formulary to call",
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
	F_ALIAS_	=> "Report", 
	F_HELP_		=> "Report to call",
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
	F_ALIAS_	=> "SQL Query", 
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
	F_HELP_		=> "Query to a SQL server",
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
	F_ALIAS_	=> "Condition", 
	F_HELP_		=> "Condition to make a SQL query",
	F_TYPE_		=> "text",
	C_SHOW_		=> "el['F_MAKE_QUERY_'].get()>'0'",
	F_REQUIRED_	=> 1,
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_SEND_",
	F_ALIAS_	=> "Transport", 
	F_HELP_		=> "Field or data to transport to a subform",
	F_TYPE_		=> "text",
	C_SHOW_		=> "el['F_TYPE_'].get()=='subform'",
	F_REQUIRED_	=> 1,
	F_OPTIONS_	=> "",	
	P_PROC_		=> "menu_link",
	F_LENGTH_	=> 40,
	G_SHOW_		=> '1'
));



##### 13 - Relation
$Obj->Add(
	array(
	F_NAME_		=> "F_RELATION_",
	F_ALIAS_	=> "Relation", 
	F_HELP_		=> "Define a relation with other table",
	F_TYPE_		=> "checkbox",
	C_SHOW_		=> "(el['F_TYPE_'].get()=='text')||".
					"(el['F_TYPE_'].get()=='date')",
	F_REQUIRED_	=> 0,
	G_SHOW_		=> '1'
));
##### 13


$Obj->Add(
	array(
	F_NAME_		=> "F_RELTABLE_",
	F_ALIAS_	=> "Relation - Table", 
	F_HELP_		=> "Table to relation",
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
        F_ALIAS_ => "Columns",
        F_HELP_ => "Table columns",
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
	F_ALIAS_	=> "Relation - Show", 
	F_HELP_		=> "Field of table, to show",
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
	F_ALIAS_	=> "Extern Field", 
	F_HELP_		=> "Field of the other table, to relationship",
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
	F_ALIAS_	=> "Local Field", 
	F_HELP_		=> "Local field, to relationship with the other table",
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
	F_ALIAS_	=> "Filter", 
	F_HELP_		=> "Filter to use in SLQ query",
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
	F_ALIAS_	=> "Length", 
	F_HELP_		=> "Field Length",
	F_TYPE_		=> "text",
	C_SHOW_		=> "",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 6,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_DEC_",
	F_ALIAS_	=> "Decimals", 
	F_HELP_		=> "Number of decimals",
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
	F_ALIAS_	=> "Browseable", 
	F_HELP_		=> "If may visible uin a browses"  ,
	F_TYPE_		=> "checkbox",
	P_PROC_		=> "",
	F_INLINE_	=> "1", 
	V_DEFAULT_	=> 1,
	P_SHOW_		=> "",
	F_LENGTH_	=> 1,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "F_REQUIRED_",
	F_ALIAS_	=> "Required", 
	F_HELP_		=> "Filed is Required"  ,
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
	F_ALIAS_	=> "Ignore", 
	F_HELP_		=> "Do not put this field in a data base"  ,
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
	F_ALIAS_	=> "Totalize", 
	F_HELP_		=> "Totalize a field column in a browser"  ,
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
	F_ALIAS_	=> "Order", 
	F_HELP_		=> "Formulary Order"  ,
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
	F_HELP_		=> "Keep in the same line of before element"  ,
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
	F_ALIAS_	=> "Unique", 
	F_HELP_		=> "Unique field",
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
	F_ALIAS_	=> "Extra Field",
	F_HELP_		=> "Look a extra field"  ,
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
	F_ALIAS_	=> "Default", 
	F_HELP_		=> "Default Value",
	C_SHOW_		=> "el['F_EXTRA_'].get()==1",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));
$Obj->Add(
	array(
	F_NAME_		=> "C_SHOW_",
	F_ALIAS_	=> "Exist", 
	F_HELP_		=> "Condition to exist",
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
	F_ALIAS_	=> "Show", 
	F_HELP_		=> "Condition to Show",
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
	F_ALIAS_	=> "Change", 
	F_HELP_		=> "Condition to change a field",
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
	F_ALIAS_	=> "Prevalidate", 
	F_HELP_		=> "Condition to prevalidate a field",
	C_SHOW_		=> "false",
	F_TYPE_		=> "text",
	F_OPTIONS_	=> "",
	F_LENGTH_	=> 90,
	G_SHOW_		=> '1'
));


$Obj->Add(
	array(
	F_NAME_		=> "F_POSVAL_",
	F_ALIAS_	=> "Postvalidate", 
	F_HELP_		=> "Field Post validate condition",
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
	F_ALIAS_	=> "Error message", 
	F_HELP_		=> "Error message in a posvalidation error",
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
	F_HELP_		=> "Formula to use in these field",
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
	F_ALIAS_	=> "Look Group", 
	F_HELP_		=> "Group authorized to a look these field"  ,
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
	F_ALIAS_	=> "Change Group", 
	F_HELP_		=> "Group authorized to a change these field",
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