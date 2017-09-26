/*
  
Copyright (C) 2005 Sergio A. Pohlmann <sergio@ycube.net>

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.


*/

/*	 ----------------------------------- 
	|									|
	|	GLOBAL VARIABLES 				|
	|									|
	 ----------------------------------- 
*/


// Temp Variables
var traceRPC;

// General purpose variables

var project_;
var session_;
var allValid;
var isEdited;
var el;
var sup;
var actualFocus;
var	elName;	
var elDef;
var elPre;
var elPos;
var objectToShow;
var lastKey;
var lastPress;
var lastEval;
var vFlag;   // # 28   - New prevalidation control 
var drawTxRx = true;
var evalError;
var posvalError;
var keypress;
var shiftKey;

var enableError;					// enable error
var enableValid;
var enableFocus;
var lockAll;
var acceptButton;			// State of accept Button
var openSubform;				// State of subforms
var consultThis;

var lastRow;

var __autofill__;

// Values to RPC === OLD
var DELETE = 300;
var CHANGE = 310;

// Values to RPC - NEW
var req;
var RPC_Caller;
var RPC_Last;

var procList;
var inTrans;
var dbData;


// Variables to a time control (setTimeout)
var t_val;		// preValidation
var t_has;		// hasChanged 

// To a hasChanged control
var tohasChanged;


// this is OLD too
var blur_required;
var req;		// RPC request variable
var rpc_operation;

var menu;
var dynamic;


// Constants
const MENU_ONLY_	= 0;
const BROWSE_		= 1;
const SHOW_			= 2;		// Show data
const DELETE_		= 3;
const CHANGE_		= 4;		// Changing a data ( DB ) 
const INSERT_		= 5;		// Insert a data ( DB )
const INT_PROC_		= 6;
const INS_DATA_		= 7;		// Insert a new formulary
const VIEW_DATA_	= 8;		// View a property of dataform
const CHG_DATA_ 	= 9;
const DELETE_FRM_	= 10;
const EDIT_BROWSE_	= 15;
const EDIT_SHOW_	= 16;	// Show the  properties of field
const EDIT_CHANGE_	= 17;	// change a properties of a field
const EDIT_DELETE_	= 18;
const CONSULT_		= 20;
const BROW_CONS_	= 21;
const INS_ELEM_		= 30;
const INSERT_ELEM_	= 31;
const REPORT_		= 50;
const QUERY_			= 100;
const POPULATE_SELECT_	= 101;
const GROUP_TRUSTEE_	= 102;
const SQL_QUERY_		= 103;	// { #71 } 	
const AUTONUM_			= 104;	// { #110 } 
const PROCEDURE_		= 105;	// { #121 }
const BEGIN_			= 106;	// { #121 }
const COMMIT_			= 107;	// { #121 }
const ROLLBACK_			= 108;	// { #121 }
const EXECUTE_			= 109;	// { #133 }
const CALLPROC_			= 110;	// { #139 }

setStartVar();


// setStartVar() - Sets a value to all start variables
// =========================================================================
function setStartVar() {

// Temp Variables
traceRPC = false;

// To determine a actualdata

project_ = "";
session_ = "";
allValid = true;
isEdited = false;
el		 = new Array();
sup		 = new Array();
actualFocus = 0;
elName = new Array();	
elDef  = new Array();
elPre  = new Array();
elPos  = new Array();
objectToShow = 0;
lastKey = 0;
lastPress = 0;
lastEval = "";
vFlag = 0;   // # 28   - New prevalidation control 
evalError = false;
posvalError = false;
keypress = 0;
shiftKey = 0;
enableError=1;					// enable error
enableValid =1;
enableFocus = 1;
lockAll = false;
acceptButton = true;			// State of accept Button
openSubform=false;				// State of subforms
consultThis=false;
lastRow='';
__autofill__ = '_NONE_';

// Values to RPC === OLD
DELETE = 300;
CHANGE = 310;

// Values to RPC - NEW
req="";
RPC_Caller	= new Array();
RPC_Last ='';
procList = new Array();
inTrans = false;
dbData = new Array();


// Variables to a time control (setTimeout)
t_val = 0;		// preValidation
t_has = 0;		// hasChanged 

// To a hasChanged control
tohasChanged = false;


// this is OLD too
blur_required=1;
req = new XMLHttpRequest();		// RPC request variable
rpc_operation = "";

menu = document.getElementById("Principal-menu");
dynamic = document.getElementById("title_dynamic");

} // setStartVar() ---------------------------------------------------------










function transformQuotes( variable, char_ ) {
	if( variable == "" ) {
		return "";
	}
	if( char_ == undefined ) {
		char_ = "\"";
	}
	variable = variable.replace( /\|\{/g, char_);
	variable = variable.replace( /\}\|/g, char_);
	return variable;	
}

function noQuotes( variable ) {
	variable = variable.replace( /'/g, "");     //'
	return variable;	
}



/**	form_engine 	Class to make a formulary entries						
==========================================================================*/	
 
function form_engine( 	order, name, alias, value, help, type, options, length,
						dec, cshow, cview, cchg, cdel, trust_show, trust_chg, 
						nodb, inline, required, 
						procedure, reltable, showfield, preval, vdefault, 
						posval, message, link, send, formula, query, queryRef, filter,
						autonum, dsl, replink, multiline ) {

	this.order_ 		= order;
	this.name_ 			= name;
	this.alias_			= alias;
	this.value			= unescape(value.replace( /__CR__/g, "\n") );
	this.value_			= this.value;
	this.lastValue_		= this.value_;
	this.oldValue		= this.value;
	this.help_			= help;
	this.type_			= type.toLowerCase();
	this.options_		= options;
	this.length_		= length;
	this.dec_			= dec;
	this.cshow_			= cshow;
	this.cview_			= cview;
	this.cchg_			= cchg;
	this.cdel_			= cdel;
	this.trust_show_	= trust_show;
	this.trust_chg_		= trust_chg;
	this.nodb_			= nodb;
	this.inline_ 		= inline;
	this.required_		= parseInt(required,10);
	this.procedure_		= procedure;
	this.reltable_		= reltable;
	this.showfield_		= showfield;
	this.preval_		= preval;
	this.vdefault_ 		= vdefault;
	this.posval_		= posval;
	this.message_		= message;
	this.link_			= link;
	this.send_			= send;
	this.formula_		= transformQuotes( formula, "'" );
	this.query_			= transformQuotes( query );		// SQL Query
	this.queryRef_		= queryRef;						// Condition to make a query
	this.filter_		= transformQuotes( filter );	// SQL filter
	this.autonum_		= autonum;
	this.multiline_		= multiline;
	this.dsl_			= dsl;							// Condition to DSL
	this.replink_		= replink;						// Report Link
	this.show_			= true;							// Show this item
	this.dot			= false;						// Point is pressed
	this.changed 		= false;						// haschange control
	
	// To create elements after
	var grid = document.getElementById("grid");
	var rows = document.getElementById("rows");
	var row;
	var col;
	var label;
	var textbox;
	var hbox;
	var vbox;
	var groupbox;
	var menulist;
	var menupopup;
	var focusName;				// Element receiving a focus
	var blurName;				// Element missing a focus



	this.object = "";			// the object in work
	this.oper_RPC="";			// a operation of RPC response
	this.numRows=0;				// a rows of a response text
	this.numCols=0;				// a number of columns
	this.header = new Array();	// the header array response
	this.response=new Array();	// the bidimensional array to response
	this.firstSQL=true;
	
	

	
	window.addEventListener( "keydown", onKey, false );
	window.addEventListener( "keyup", onKeyUp, false );
	window.addEventListener( "mouseup", onMouseUp, false );
	




/**	get			Returns a content of an element								
	======================================================================*/
	this.get = function( evType) {
		type = this.type_;
		
		// Number Format Control
		
		if ( type == "text" ) {

			if( this.dec_ !=''){
				var value_=document.getElementById(this.name_).value+'';
				value_=	value_.replace( /,/g, "");
				value_=	value_.replace( / /g, "");
				return value_;
			}
			return document.getElementById(this.name_).value;
		}
		
		if ( type == "date" ) {
			var keyed =  document.getElementById(this.name_).value;
			if( keyed == "__NO DATA_" ) {
				return "__NO DATA_";
			}
			if( keyed != undefined ) {
			
				//													{ #99
				// Check the format of the date
				// Normal format
				if( (keyed.substr(2,1) == "-" ) &&
					(keyed.substr(5,1) == "-" ) ){
					var day   = parseInt( keyed.substr(0,2),10);
					var month = parseInt( keyed.substr(3,2),10);
					var year  = parseInt( keyed.substr(6,4),10);
				}
				// SQL Format
				else {
					var day   = parseInt( keyed.substr(8,2),10);
					var month = parseInt( keyed.substr(5,2),10);
					var year  = parseInt( keyed.substr(0,4),10);
				}
				if( day<10 ) {
					day = "0" + day;
				}
				if( month<10 ) {
					month = "0" + month;
				}
				if( (!isNaN(day)) && (!isNaN(month)) && (!isNaN(year)) ) {
					return ( year + '-' + month + '-' + day );
				}
				else{
					return "";
				}
			}
			else{
				return '';
			}
		}
	
		if( type == "checkbox" ) {
			if (document.getElementById(this.name_).checked) {		
				return '1';
			}
			else {
				return '';
			}
		}
		if ( type == "select_list" ) {
			return el[this.name_].value_;
		}
		if ( type == "password" ) {
			return el[this.name_].value_;
		}
		if ( type == "int_proc" ) {
			procedure = this.procedure_;
			if ( procedure == "password" ) {
				return el[this.name_].value_;
			}
			if ( procedure == "group_trustee" ) {
				return document.getElementById(this.name_).label;
			}
		}
		return el[this.name_].value_;
	} // get ---------------------------------------------------------------

				
		
/*	getStr		Returns a value of an element in a string format			
	======================================================================*/
	this.getStr = function() {
		return '"' + this.get() + '"';
	} // getStr ------------------------------------------------------------
		


/*	notEmpty		Returns true if a element contains everything			
	======================================================================*/
	this.notEmpty = function() {
		if( ( this.get()==undefined) || (this.get()=="" )){
			return false;
		}
		return true;
	} // notEmpty ----------------------------------------------------------


/*	empty		Returns true if a element is empty		
	======================================================================*/
	this.empty = function() {
		if( ( this.get()==undefined) || (this.get()=="" )){
			return true;
		}
		return false;
	} // notEmpty ----------------------------------------------------------

		
/* 	notSearch	Return true if element is'nt a search field
	======================================================================*/
	this.notSearch = function() {
		if( this.get().indexOf( '%' ) >= 0 ) {
			return true;
		}
		if( ( this.get()==undefined) || (this.get()=="" )){
			return true;
		}
		return false;
	} // notSearch ---------------------------------------------------------
	
/*	getDate		Returns a value of an element in a conventional date format	
	======================================================================*/
	this.getDate = function() {
		var temp = this.get();
		if( temp == "__NO DATA_" ) {
			return "";
		}
		if( temp !="" ) {
			if( temp.length < 10 ) {
				return "";
			}
			// Check the format of the date
			// Normal format
			if( (temp.substr(2,1) == "-" ) &&
				(temp.substr(5,1) == "-" ) ){
				var day   = parseInt( temp.substr(0,2),10);
				var month = parseInt( temp.substr(3,2),10);
				var year  = parseInt( temp.substr(6,4),10);
			}
			// SQL Format
			else {
				var day   = parseInt( temp.substr(8,2),10);
				var month = parseInt( temp.substr(5,2),10);
				var year  = parseInt( temp.substr(0,4),10);
			}
			if( day < 10 ){
				day = "0" + day;
			}
			if( month < 10 ){
				month = "0" + month;
			}
			return( day+'-'+month+'-'+year );
		}
		return '';
	} // getDate -----------------------------------------------------------

//																	} #93
	

				
/*	getMonth			Returns a month of an element								
	======================================================================*/
	this.getMonth = function() {
		var keyed =  document.getElementById(this.name_).value;
		if( keyed == "__NO DATA_" ) {
			return "00";
		}
		if( keyed != undefined ) {
			
			// Check the format of the date
			// Normal format
			if( (keyed.substr(2,1) == "-" ) &&
				(keyed.substr(5,1) == "-" ) ){
				var month = parseInt( keyed.substr(3,2),10);
			}
			// SQL Format
			else {
				var month = parseInt( keyed.substr(5,2),10);
			}
			if( month<10 ) {
				month = "0" + month;
			}
			return month;
		}
		if( isNaN(month)) {
			month=0;
			return 0;
		}
		return "00";
	} // getMonth() --------------------------------------------------------

				
/*getYear			Returns a yead of an element								
	======================================================================*/
	this.getYear = function() {
		var keyed =  document.getElementById(this.name_).value;
		if( keyed == "__NO DATA_" ) {
			return "0000";
		}
		if( keyed != undefined ) {
			
			// Check the format of the date
			// Normal format
			if( (keyed.substr(2,1) == "-" ) &&
				(keyed.substr(5,1) == "-" ) ){
				var year = parseInt( keyed.substr(6,4),10);
			}
			// SQL Format
			else {
				var year = parseInt( keyed.substr(0,4),10);
			}
			return year;
		}
		if( isNaN(year)) {
			month=0;
			return 0;
		}
		return "00";
	} // getYear() ---------------------------------------------------------

				
/*	getDay			Returns a day of an element								
	======================================================================*/
	this.getDay = function() {
		var keyed =  document.getElementById(this.name_).value;
		if( keyed == "__NO DATA_" ) {
			return "00";
		}

		if( keyed != undefined ) {
			
			// Check the format of the date
			// Normal format
			if( (keyed.substr(2,1) == "-" ) &&
				(keyed.substr(5,1) == "-" ) ){				
				var day = parseInt( keyed.substr(0,2),10);
			}
			// SQL Format
			else {
				var day = parseInt( keyed.substr(8,2),10);
			}
			if( day<10 ) {
				day = "0" + day;
			}
			return day;
		}
		if( isNaN(day)) {
			day=0;
			return 0;
		}
		return "00";
	} // getDay() ----------------------------------------------------------




														
/*	getVal		Returns a value of an element 								
	======================================================================*/
	this.getVal = function() {
		
		// Floating Point number
		if( this.dec != "" ) {
			var valor = parseFloat( this.get() );				
		}
		// Interger number
		else {
			var valor = parseInt( this.get(),10 );	
		}

		if( isNaN( valor ) ) {
			return 0;
		}
		return valor;
	} // getStr ------------------------------------------------------------
														
/**	length		Returns a length of a element 								
	======================================================================*/
	this.length = function() {
		var temp = this.get()+"";	
		return temp.length;
	} // length() ----------------------------------------------------------
														
		
/**	hasChanged		Returns a true if a element value is changed			
	======================================================================*/
	this.hasChanged = function() {
		// 																{ #71
		if( !isEdited ){
			return(false);
		}
		
		
// ##### 28		
		
		return this.changed;
		
// ##### 28	

	} // hasChanged() ------------------------------------------------------
	
	
/**	turnChanged		Turns true or false a change property of an element			
	======================================================================*/
	this.turnChanged = function( state ){
		this.changed = state;
	return true;
	} // turnChanged() ------------------------------------------------------


/**	onChange		Returns a true when a element value is changed			
	======================================================================*/
	this.onChange = function() {
		return ( evaluate( this.value_ != this.lastValue_ ) );
	} // hasChanged() ------------------------------------------------------
	

/**	validField		Returns a true if a element is a valid name to field	
	======================================================================*/
	this.validField = function() {
				
		// Check for the invalid names
		var value_ = this.get();
		if( value_ == 'id' )  					return false;
		if( value_ == 'check' )  				return false;
		if( value_ == 'index' )  				return false;
		if( value_ != undefined ) {
			if( value_.indexOf( ' ' ) >= 0 )  	return false;
			if( value_.indexOf( '-' ) >= 0 )  	return false;
			if( value_.indexOf( '$' ) >= 0 )  	return false;
			if( value_.indexOf( '%' ) >= 0 )  	return false;
			if( value_.indexOf( '&' ) >= 0 )  	return false;
			if( value_.indexOf( '*' ) >= 0 )  	return false;
			if( value_.indexOf( "\\" ) >= 0 )  	return false; 
			if( value_.indexOf( '/' ) >= 0 )  	return false;
			if( value_.indexOf( '+' ) >= 0 )  	return false;
		}		
		return true;
		

	} // validField() ------------------------------------------------------
										
					
/**	show		Show a element												
	======================================================================*/
	this.show = function() {



		// Element Condition to show
		if ( (this.cshow_ == undefined) || (this.cshow_ == "" ) ) {
			this.show_ = true;
		}
		else {
			this.show_ = evaluate( this.cshow_ );
		}
		if ( this.show != false ){
			objectToShow++;
		}

		// Element default Value
		if( ( this.vdefault_ != "" ) 	&& 
			( this.value_ == "" ) 		&& 
			( (operation == INSERT_) || (operation==20) )	&&
			( this.autonum_ == '')		){
			this.value_ = evaluate ( this.vdefault_ );
		}
		if( (subform != -1) && (this.name_ == elName[0]) ){
			this.value_ = subform;
		}
		
		// CHECKBOX
		if( this.type_ == "checkbox" ){
			this.createCheckBox();
			return;
		}
		// TEXTBOX
		if( this.type_ == "text" ){						
			this.createTextBox();
			return;
		}
		// DATE
		if( this.type_ == "date" ){
			this.length_ = 10;
			if( ( this.value_ !="" ) 			&& 
				( this.value_ != undefined )		){
				value_ = this.value_;
				var day   = value_.substr(8,2);
				var month = value_.substr(5,2);
				var year  = value_.substr(0,4);
				if( (!isNaN(day)) && (!isNaN(month)) && (!isNaN(year)) ) {
					this.value_ = day+'-'+month+'-'+year;
				}
				if( this.value_.length < 10 ) {
					this.value_ = "";
				}
			}
			this.createTextBox();
			return;
		}
		// FORMULA
		if( this.type_ == "formula" ) {
			this.createTextBox();
			document.getElementById(this.name_).setAttribute("readonly","true");
		}
		// PASSWORD
		if ( this.type_ == "password" ) {
			this.createTextBox();
			return;
		}
		// SELECT_LIST
		if( ( this.type_ == "select_list" ) 		||
			( this.type_ == "dynamic_select_list" )	){
			this.createSelectList();
			return;
		}
		// INTERNAL PROCEDURE
		if ( this.type_ == "int_proc" ) {
			this.createInternal();
			return;
		}
		// REPORT
		if ( this.type_ == "report" ) {
			this.createReport();
			return;
		}
		// PROCEDURE
		if ( this.type_ == "proc" ) {
			this.createProc();
			return;
		}
		// SUBFORMULARY
		if ( this.type_ == "subform" ) {
			this.createSubform();
			return;
		}
		
	} // show() -------------------------------------------------------------


	
/*  condView		Evaluate Condition to view	
	======================================================================*/
	this.condView = function ( object, special ){
		if( ( ! this.show_ ) ) {
			object.setAttribute( "hidden", "true" );
			consultThis=false;
		}
		else{
			if( this.cview_ != "" ){
				if ( !evaluate( this.cview_) ){
					object.setAttribute( "hidden", "true" );
					consultThis=false;
				}
				else{
					if( special > 0 ){
						return;
					}
					object.removeAttribute( "hidden" );
				}	
			}
		}
	} // condView() --------------------------------------------------------
		
	
/**	createTextbox	- 	Generate a textbox field							
	======================================================================*/
	
	this.createTextBox = function() {
	
	
		this.createRow();
		this.createLabel();
		this.createHbox();
		
		textbox = document.createElement("textbox");

		// Multiline controller
		if( (this.multiline_ != '') && (this.length_>90) ) {
			this.length_=90;
		}

		// Determine a properties
		textbox.setAttribute( "id", this.name_ );
		textbox.setAttribute( "size", this.length_ );
		textbox.setAttribute( "maxlength", this.length_ );
		textbox.setAttribute( "value", this.value_ );
		if ( this.type_ == "password" ) {
			textbox.setAttribute( "type", "password" );
		}

		if( (subform != -1 ) && (this.name_ == elName[0])) {
			textbox.setAttribute( "readonly", "true" );
		}

		// Multiline controller
		if( this.multiline_ != '' ) {
			textbox.setAttribute( "multiline", "true" );
			textbox.setAttribute( "cols", this.length_ );
			if( ( this.multiline_ > 1 ) && ( this.multiline_ < 2 ) ){
				var rowBox = ( this.multiline_ - 1 ) * 100;
				textbox.setAttribute( "rows", rowBox );				
			}
		}

		// If is a number 
		if( this.dec_!='' ){
			textbox.setAttribute( "style", 'text-align: right' );
			
		}

		if (( operation == SHOW_) ||
			( operation == EDIT_SHOW_ ) ||
			( this.autonum_ != "" )    ){
			textbox.setAttribute( "readonly", "true" );
		}
																	
		if( this.autonum_ != "" ) { 
			if( operation == INSERT_ ){									
				this.autonum_ = this.name_;
				if( this.options_=='DB') {
					this.show_ = false;
				}
			}
			else{
				if( this.options_=='DB') {
					textbox.setAttribute( "readonly", "true" );
				}

			}

		}
		

		// Check Trustee to show
		if ( ! haveTrustee( this.trust_show_ ) ) {
			this.show_ = false;
		}
		// Check Trustee to change
		if ( (! haveTrustee( this.trust_chg_ )) &&
			 ( operation == INSERT_ ) ) {
			this.show_ = false;
		}

		// Evaluate C_SHOW and C_VIEW
		this.condView( textbox );
	
		// Append in a hbox
		hbox.appendChild( textbox );

		document.onclick = callpreValidation;

		// Control a eventListener
		textbox.addEventListener( "change", changeControl, false );// # 28
		textbox.addEventListener( "focus", callpreValidation, false );
		textbox.addEventListener( "blur",  callpreValidation, false );
		textbox.addEventListener( "click", callpreValidation, false );
		textbox.addEventListener( "select", callpreValidation, false );
																	
	} // createTextbox() ---------------------------------------------------

	
		
/**	createCheckBox	- 	Generate a checkbox field							
	======================================================================*/
	
	this.createCheckBox = function() {
		this.createRow();
		this.createLabel();
		this.createHbox();
		
		checkbox = document.createElement("checkbox");
		
		// Determine a properties
		checkbox.setAttribute( "id", this.name_ );

		if( ( this.vdefault_ == "1")	&&
			(( operation == INSERT_ )	||
			(operation == INS_DATA_) || 
			(operation == INSERT_ELEM_)) ){
			checkbox.setAttribute( "checked", "true" );
		}

		if( ( this.value_  ) ){
			checkbox.setAttribute( "checked", "true" );
		}

		if( (subform != -1 ) && (this.name_ == elName[0])) {
			checkbox.setAttribute( "readonly", "true" );
		}

		if ((operation == SHOW_) ||
		(operation == EDIT_SHOW_) ) {
			checkbox.setAttribute( "readonly", "true" );
		}
		
		
		// Check conditions to show
		
		// Check Trustee to show
		if ( ! haveTrustee( this.trust_show_ ) ) {
			this.show_ = false;
		}
		// Check Trustee to change
		if ( (! haveTrustee( this.trust_chg_ )) &&
			 ( operation == INSERT_ ) ) {
			this.show_ = false;
		}

		// Evaluate C_SHOW and C_VIEW
		this.condView( checkbox );
		
		// Append in a hbox
		hbox.appendChild( checkbox );
		
																	// { #71
		// Control a eventListener
		checkbox.addEventListener( "change", changeControl, false );// # 28
		checkbox.addEventListener( "command", eventCheckBox, false );
		checkbox.addEventListener( "click", eventCheckBox, false );
																	// } #71

	} // createcheckbox() --------------------------------------------------
	
	
/**	createSubform	- 	Generate a subform field							
	======================================================================*/
	
	this.createSubform = function() {
		
		hbox = document.createElement("hbox");
		hbox.setAttribute( "id", "hbox_" + this.name_ );
		hbox.setAttribute( "style", "overflow:auto" );
		rows.appendChild( hbox );		
		col = document.createElement("column");
		col.setAttribute( "id", "col_" + this.name_ );
		col.setAttribute( "flex", "1" );
		hbox.appendChild( col );	
		hbox = document.createElement("hbox");
		hbox.setAttribute( "id", "hbox_" + this.name_ );


		col.appendChild( hbox );		
		
		// Check conditions to show
		
		// Check Trustee to show
		if ( ! haveTrustee( this.trust_show_ ) ) {
			this.show_ = false;
		}
		// Check Trustee to change
		if ( (! haveTrustee( this.trust_chg_ )) &&
			 ( operation == INSERT_ ) ) {
			this.show_ = false;
		}
		
		
	
		iframe = document.createElement("iframe");
		
		// Determine a properties
		iframe.setAttribute( "id", this.name_ );
		iframe.setAttribute( "hidden", "true" );
		iframe.setAttribute( "flex", "1" );
		iframe.setAttribute( "value", this.value_ );
		
		// Append in a groupbox
		groupbox = document.createElement("groupbox");
		groupbox.setAttribute( "id", "gbox_" + this.name_ );
		groupbox.setAttribute( "flex", "1" );
		col.appendChild( groupbox );		
		// Making a caption
		caption = document.createElement("caption");
		caption.setAttribute("id", "cap`"+ this.name_+"`"+this.alias_ );
		
// ##### 27 OLD		caption.setAttribute("label", this.alias_ + " (seleccione)");
		caption.setAttribute("label", this.alias_ + MSG_SELECT_);
		
		caption.setAttribute("tooltiptext", this.help_ );


		// Evaluate C_SHOW and C_VIEW
		this.condView( caption, 1 );
		this.condView( groupbox, 1 );
			
		if ( ! this.show_ ) {
			caption.setAttribute( "hidden", "true" );
		}

		groupbox.appendChild( caption );
		groupbox.appendChild( iframe );
		caption.addEventListener( "click",  setIframe, false );
		
	} // createSubform() ---------------------------------------------------

	
	
		
/**	createInternal	- 	Generate a Internal Procedure						
	======================================================================*/
	
	this.createInternal = function() {
		this.createRow();
		this.createLabel();
		this.createHbox();
				
		button = document.createElement("button"); 
		
		// Determine a properties
		button.setAttribute( "id", this.name_ );
		
		if ( operation == SHOW_ ) {
			button.setAttribute( "readonly", "true" );			
		}
		
		if ( this.procedure_ == "password" ) {
			button.setAttribute( "label", BTN_PASSWD_ );
		}
				
		// Check conditions to show
		
		// Check Trustee to show
		if ( ! haveTrustee( this.trust_show_ ) ) {
			this.show_ = false;
		}
		// Check Trustee to change
		if ( (! haveTrustee( this.trust_chg_ )) &&
			 ( operation == INSERT_ ) ) {
			this.show_ = false;
		}
		
		// Evaluate C_SHOW and C_VIEW
		this.condView( button );
		
		// Append in a hbox
		hbox.appendChild( button );

		if ( this.procedure_ == "group_trustee" ) {
		       
			// Makes a popupset
			popupset = document.createElement("popupset");
			grid.appendChild(popupset);
		
			// Makes a popup
			popup = document.createElement("popup");
			
			// Determine a properties
			popup.setAttribute( "id", "menupopup_" + this.name_ );
			popup.setAttribute( "value", this.value_ );
			popup.setAttribute( "label", this.value_ );
			
			if ( ! this.show_ ) {
			    popup.setAttribute( "hidden", "true" );
			}
			
			var menuName = "menupopup_" +this.name_;
	
			// Append in a popupset
			popupset.appendChild( popup );
			button.setAttribute("popup", "menupopup_"+this.name_ );
			button.setAttribute("label", this.value_ );
			
			// Control a eventListener
			popup.addEventListener( "focus", preValidation, false );
			popup.addEventListener( "blur",  preValidation, false );
			popup.addEventListener( "click",  preValidation, false );
		       //button.setAttribute("minwidth",200);
			var query = "SELECT id, name FROM p_groups;";
			this.validate( QUERY_, GROUP_TRUSTEE_, "", this.name_, query );
			
			return;
			 
			// Check if have a previous options
	 
			if ( this.options_ != "" ) {   
				var options = new Array();   
				options = this.options_.split( ",");    
				
				for ( i=0; i< options.length; i++ ){
				
					// Make a menuitem
					menuitem = document.createElement("menuitem");
					menuitem.setAttribute( "label", options[i] );
					menuitem.setAttribute( "type", "checkbox" );
					menuitem.setAttribute( "ref",  options[i] );
					menuitem.setAttribute( "top",   menuName );  
					
					if ( this.value_ == options[i] ) {
						menuitem.setAttribute( "selected", "true" );
						menuitem.setAttribute( "checked", "true" );
						document.getElementById(menuName).label = options[i];
					}
					
					popup.appendChild( menuitem );
					 
					menuitem.addEventListener( "command", trusteeSelect, false );
					
				}
				
				 
			} 
			return;
		
		}
			
		// Control a eventListener
	 
		if ( this.procedure_ == "password" ) {
			button.addEventListener( "command",  int_Passwd, false );
		}

	} // createInternal() --------------------------------------------------

		
/**	createReport	- 	Generate a button to call a report						
	======================================================================*/
	
	this.createReport = function() {
		this.createRow();
		this.createLabel('');
		this.createHbox();
		button = document.createElement("button");
		
		// Determine a properties
		button.setAttribute( "id", 		this.name_ );
		button.setAttribute( "label", 	this.alias_ );
		button.setAttribute( "tooltiptext", this.help_ );
		
		if ( operation == SHOW_ ) {
			button.setAttribute( "readonly", "true" );
		}
		// Check conditions to show
		
		// Check Trustee to show
		if ( ! haveTrustee( this.trust_show_ ) ) {
			this.show_ = false;
		}
		// Check Trustee to change
		if ( (! haveTrustee( this.trust_chg_ )) &&
			 ( operation == INSERT_ ) ) {
			this.show_ = false;
		}

		// Evaluate C_SHOW and C_VIEW
		this.condView( button );
				
		// Append in a hbox
		hbox.appendChild( button );
		
		// Control a eventListener
		button.addEventListener( "command", report, false );

	} // createReport() --------------------------------------------------

		
/**	createProc	- 	Generate a button to call a procedure						
	======================================================================*/
	
	this.createProc = function() {
		this.value = false;
		this.value_ = false;
		this.createRow();
		this.createLabel('');
		this.createHbox();
				
		button = document.createElement("button");
		
		// Determine a properties
		button.setAttribute( "id", 		this.name_ );
		button.setAttribute( "label", 	this.alias_ );
		button.setAttribute( "tooltiptext", 	this.help_ );
		
		if ( operation == SHOW_ ) {
			button.setAttribute( "readonly", "true" );
		}
		// Check conditions to show
		
		// Check Trustee to show
		if ( ! haveTrustee( this.trust_show_ ) ) {
			this.show_ = false;
		}
		// Check Trustee to change
		if ( (! haveTrustee( this.trust_chg_ )) &&
			 ( operation == INSERT_ ) ) {
			this.show_ = false;
		}

		// Evaluate C_SHOW and C_VIEW
		this.condView( button );
				
		// Append in a hbox
		hbox.appendChild( button );
		
		// Control a eventListener
		button.addEventListener( "command", callProc, false );

	} // createProc() ------------------------------------------------------

		
/**	createSelectList	- 	Generate a select_list field					
	======================================================================*/
	this.createSelectList = function() {
		this.createRow();
		this.createLabel();
		this.createHbox();

		// Makes a menulist
		menulist = document.createElement("menulist");
		
		// Determine a properties
		menulist.setAttribute( "id", this.name_ );
		menulist.setAttribute( "value", this.value_ );
		menulist.setAttribute( "label", this.value_ );
		if ( operation == SHOW_ ) {
			menulist.setAttribute( "readonly", "true" );
		}
		
		// Check Trustee to show
		if ( ! haveTrustee( this.trust_show_ ) ) {
			this.show_ = false;
		}
		// Check Trustee to change
		if ( (! haveTrustee( this.trust_chg_ )) &&
			 ( operation == INSERT_ ) ) {
			this.show_ = false;;
		}

		// Evaluate C_SHOW and C_VIEW
		consultThis=true;
		this.condView( menulist );
				
		var menuName = this.name_;

		// Append in a hbox
		hbox.appendChild( menulist );
		
		// Control a eventListener
		menulist.addEventListener( "change", changeControl, false );// # 28
		menulist.addEventListener( "select", changeControl, false );// # 11
		menulist.addEventListener( "focus", preValidation, false );
		menulist.addEventListener( "command",  preValidation, false );
		menulist.addEventListener( "click",  preValidation, false );		
		
		// Makes a menupopup
		menupopup = document.createElement("menupopup");
		menupopup.setAttribute( "id", "menupopup_" + this.name_ );

		// Append in a menulist
		menulist.appendChild( menupopup );
				
		if ( this.procedure_ == "tables" ) {		
			var query = "SHOW TABLES;";
			this.validate( QUERY_, POPULATE_SELECT_, "", this.name_, query );
			return;
		}
		if ( this.reltable_ != "" ) {

			var filter = "";
			if( this.filter_ != "" ) {
				filter = " WHERE "+ noQuotes( evaluate(this.filter_) );
			}
		
			if( this.showfield_.indexOf( ',' ) >= 0 ){
				var query = "SELECT "+this.showfield_+" FROM " + this.reltable_ + 
					filter + ";";
			}
			else{
				var query = "SELECT * FROM " + this.reltable_ + 
					filter + ";";
			}

			if( ( this.type_!="dynamic_select_list")){
				this.validate( QUERY_, POPULATE_SELECT_, "", this.name_, query );
			}
			else{
				if ( this.value_ != '' ) {
					// Make a menuitem
					menuitem = document.createElement("menuitem");
					menuitem.setAttribute( "label", this.value_ );
					menuitem.setAttribute( "ref",   this.value_ );
					menuitem.setAttribute( "top",   menuName ); 
					menuitem.setAttribute( "selected", "true" );
					document.getElementById(menuName).label = this.value_;
					document.getElementById(menuName).value = this.value_;
					el[menuName].value_ = this.value_;
					el[menuName].value = this.value_;
					menupopup.appendChild( menuitem );
				}
			}
			return;
		}
		
		// Check if have a previous options

		if ( this.options_ != "" ) {
			var options = new Array();
			options = this.options_.split( ",");
			for ( i=0; i< options.length; i++ ){
					
				// Make a menuitem
				menuitem = document.createElement("menuitem");
				menuitem.setAttribute( "label", options[i] );
				menuitem.setAttribute( "ref",   options[i] );
				menuitem.setAttribute( "top",   menuName ); 
				
				if ( (i == 0) && (this.value_ == "") ) {
					this.value_ = options[i];
					menuitem.setAttribute( "selected", "true" );
					document.getElementById(menuName).setAttribute( "label", options[i] );
					document.getElementById(menuName).setAttribute( "value", options[i] );
					el[menuName].value_ = options[i];
					el[menuName].value = options[i];
				}
				if ( this.value_ == options[i] ) {
					menuitem.setAttribute( "selected", "true" );
					document.getElementById(menuName).setAttribute( "label", options[i] );
					document.getElementById(menuName).setAttribute( "value", options[i] );
					el[menuName].value_ = options[i];
					el[menuName].value = options[i];
				}								
				menupopup.appendChild( menuitem );
				menuitem.addEventListener( "change", changeControl, false );// # 28
				menuitem.addEventListener( "select", changeControl, false );// # 28
				menuitem.addEventListener( "command", eventSelect, false );
				
			}
		}

	} // createSelectList() -------------------------------------------------
	
																				
// ##### 21 
// New control to rows
/**	createRow		Make a row to put data in this							
	======================================================================*/		 
	this.createRow = function( ) {
		if( this.inline_ >0 ){
			row = document.getElementById( 'hbox_'+ lastRow );
		}
		else{
			row = document.createElement("row");
			row.setAttribute( "id", "row_" + this.name_ );
			rows.appendChild( row );	
			lastRow = this.name_;
		}
		
	} // createRow() -------------------------------------------------------


/*
	this.createRow = function( superior ) {
		row = document.createElement("row");
		row.setAttribute( "id", "row_" + this.name_ );
		rows.appendChild( row );	
	} // createRow() -------------------------------------------------------
*/

// ##### 21 end


/**	createColumn	Make a column to put data in this						
	======================================================================*/		 
	this.createColumn = function() {
		col = document.createElement("column");
		col.setAttribute( "id", "col_" + this.name_ );
		hbox.appendChild( col );	
	} // createColumn() ----------------------------------------------------
	
																			
/**	createLabel		Creates a label in a data entry							
	======================================================================*/	
	this.createLabel = function( txt ) {
		label = document.createElement("label");
		if ( this.required_ == 1 ) {
			if( txt== undefined ){
				label.setAttribute( "value", "* "+ this.alias_ );
			}
			else{
				label.setAttribute( "value", "*" );
			}
			
		}
		else {
			if( txt== undefined ){
				label.setAttribute( "value", "  "+ this.alias_ );
			}
			else{
				label.setAttribute( "value", "  " );
			}
		}
		label.setAttribute( "id", "lbl_" + this.name_ );
		label.setAttribute( "tooltiptext", this.help_ );

		// Check Trustee
		if ( ! haveTrustee( this.trust_show_ ) ) {
			this.show_ = false;
		}
		// Check Trustee to change
		if ( (! haveTrustee( this.trust_chg_ )) &&
			 ( operation == INSERT_ ) ) {
			 this.show_ = false;
		}

		if( ( this.autonum_ != "" ) && 
			( operation == INSERT_ )){									
			if( this.options_=='DB') {
				this.show_ = false;
			}
		}
		
		// Evaluate C_SHOW and C_VIEW
		this.condView( label );
			
		row.appendChild( label );
	} // createLabel() ------------------------------------------------------
	
	
/**	createHbox		Makes a hbox to content a elements						
	======================================================================*/	
	this.createHbox = function() {
		hbox = document.createElement("hbox");
		hbox.setAttribute( "id", "hbox_" + this.name_ );
		row.appendChild( hbox );		
	} // createHbox() ------------------------------------------------------
	
	
/*	validate		Makes a RPC validation									
	======================================================================*/	
	this.validate = function( action, link, page, obj, pass) {
		getRef();
		
// ##### 30		
		if( action == EXECUTE_ ){
			var xaction = "?action=" + action;
		}
		else {
			var xaction = "?action=" + action + "&action=" + action;
		}
// OLD IN # 30		var xaction = "?action=" + action;
		var xsession= "&sess=" + session_;
		var xproj   = "&project=" + project_ ;
		var xlink	= "&link=" + link;			// this is a operation
		var xpage	= "&page=" + page+action+link;
		var xobj	= "&obj=" + obj;			// The name of a object
		if( pass == undefined ){
			var pass="";
		}
		pass += "";
		var xpass	= "&pass=" + pass.replace( /\+/g, "wWz");
		getRef();
		var xvers	= "&v=" + version_;
		var url   	= "plusRPC.php" + xaction + xsession + xproj + 
						xlink + xpage + xobj + xpass + xvers;

		// Prepare a serial instruction ( Not Real RPC )
		if( action == EXECUTE_ ){
			obj = EXECUTE_;
			url = "EXECUTE_" + link;
			var url   	= "plusRPC.php" + xaction + '&'+link;
			obj = 109;

		}
		


		var rpc_debug = 0;
		if ( rpc_debug == 0 ) {
			callRPC( obj, url );		
		}
		else {
			var atrib = "toolbar=yes,location=yes,directories=yes,status=yes," +
						"menubar=yes,scrollbars=yes,resizable=no,dependent=yes";
			window.open( url, "page" + obj, atrib ) ;
		}
		
	} // validate() ---------------------------------------------------------


} // form_engine -----------------------------------------------------------



/**	callRPC		Makes a RPC call											
	======================================================================*/	
function callRPC( object, orig_url ) {
	var existRPC = 0;
		
	url = orig_url;
	// Check if exist a waiting RPC
	var tmp = url.split('&');
	tmp = tmp[0].split("action=");
	var RPC_Operation = tmp[1];
	for ( i=0; i < RPC_Caller.length; i++ ) {
		if ( RPC_Caller[i]!="" ) {
			existRPC = 1;
		}
	}
	// add a new waiting RPC
	if( RPC_Last != url ){
		RPC_Caller[RPC_Caller.length] = url;
	}
	if ( (existRPC == 0) &&(RPC_Last != url) ) {

		// Execute a serial instruction ( Not RPC )
		if( RPC_Operation == EXECUTE_ ){
			var tmp = url.split("&");
			setTimeout( "evaluate("+tmp[1]+")", 5 );
			return;
		}

		// RPC TRACE
		if( traceRPC ){
			if(document.getElementById('rpc')!= undefined){
				document.getElementById('rpc').value+="direct >"+url+"\n";
			}
		}

		// Call a TX Monitor		
		if( document.getElementById('lbl_Tx')!= undefined){
			var sig=document.getElementById('lbl_Tx').label;
			switch (sig){

				case 'Tx     ':
					document.getElementById('lbl_Tx').label='Tx.    ';
					break;
				case 'Tx.    ':
					document.getElementById('lbl_Tx').label='Tx..   ';
					break;
				case 'Tx..   ':
					document.getElementById('lbl_Tx').label='Tx...  ';
					break;
				case 'Tx...  ':
					document.getElementById('lbl_Tx').label='Tx.... ';
					break;
				case 'Tx.... ':
					document.getElementById('lbl_Tx').label='Tx.....';
					break;
				case 'Tx.....':
					document.getElementById('lbl_Tx').label='Tx     ';

			}
			document.getElementById('Tx').value=url.length+'';
		}


// ##### 30
		// New RPC Caller (POST)
		var data = url;
		tmp = url.split('?');
		url = tmp[0];
		req = new XMLHttpRequest();	
		req.onreadystatechange = changeRPC;
		req.open("POST", url, true );
		req.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		req.send( '__url__='+data );

	}

	RPC_Last = orig_url;
/* OLD IN # 30
		req = new XMLHttpRequest();	
		req.onreadystatechange = changeRPC;
		req.open("GET", url, true );
		req.send( null );
	}

	RPC_Last = url;
*/		
// ##### 30 end		
	
	
} // callRPC() ----------------------------------------------------------


/**	checkError		Check if the RPC Process has send a error message 		
	======================================================================*/
	
function checkError ( response ) {

	tmp = response.split('`');
	if( response.indexOf("_error_") != -1){
		error = MSG_SRV_ERROR_;
		error += tmp[3] + "   ("+ tmp[2]+ ")\n\n";
		if( error.indexOf("_REF_INT_") != -1){
			error = MSG_SRV_ERROR_;			
			error = error+"     REFERENCIAL INTEGRITY ERROR\n";
		}
		alert(error);
		return false; 
	}

	return true; 
} // checkError() ----------------------------------------------------------
	
	
/**	changeRPC		Function called when a RPC changes a status				
	======================================================================*/	
																			
function changeRPC (){

	try{
		rpc_state = req.readyState;
	}
	catch(e) {
		return;
	}

	// RPC TRACE
	if( traceRPC ){	
		if(document.getElementById('rpc')!= undefined){
			document.getElementById('rpc').value+=" {"+rpc_state+"} ";
		}
	}
	
	if( rpc_state == 4 ) {
		try{
			rpc_status = req.status;
		}
		catch(e){
			return;
		}
		if ( rpc_status == 200 ) {
			if ( ! checkError(  req.responseText ) ) {
				// Kill all other RPC calls
				RPC_Caller = new Array();
				if( inTrans ){
					inTrans = false;
					el[elName[0]].validate( ROLLBACK_, ROLLBACK_,"", "", "" );
				}
				isEdited = false;
				//setTimeout('goBack()',20);
				el[elName[0]].validate( EXECUTE_, "goBack()" );
				return;
			}
			oper_RPC = '';
				
			// Separate a received data
			// Clearing a starting spaces - temp2 contains a pure data
			if( req.responseText == "" ){
				fireNewRPC();
				return;
			}
			var temp = req.responseText.split("`_0`");
			if (( temp == undefined) ||
				( temp == "" )		||
				( temp[1]== undefined ) ) {
				fireNewRPC();
				return;
			}
			var temp2 = temp[1].split("`_1`");

			// Call a RX Monitor		
			if( document.getElementById('lbl_Rx')!= undefined){
				var sig=document.getElementById('lbl_Rx').label;
				switch (sig){
	
					case 'Rx     ':
						document.getElementById('lbl_Rx').label='Rx.    ';
						break;
					case 'Rx.    ':
						document.getElementById('lbl_Rx').label='Rx..   ';
						break;
					case 'Rx..   ':
						document.getElementById('lbl_Rx').label='Rx...  ';
						break;
					case 'Rx...  ':
						document.getElementById('lbl_Rx').label='Rx.... ';
						break;
					case 'Rx.... ':
						document.getElementById('lbl_Rx').label='Rx.....';
						break;
					case 'Rx.....':
						document.getElementById('lbl_Rx').label='Rx     ';
	
				}
				document.getElementById('Rx').value=req.responseText.length+'';
			}
			
			
			// determines a object an operation
			var temp3 = temp2[0].split("`");
			object = temp3[0];			// the name of object
			oper_RPC = temp3[1];		// the operation to make
			// Preparing a response array
			temp = temp2[1].split("`_2`");
			temp3 = temp[0].split("`");
			// Number of rows and columns
			numRows = temp3[0];
			numCols = temp3[1];
			// preparing a header
			temp3 = temp[1].split("`_3`");
			temp = temp3[0].split("`") ;
			header = Array();
			for ( i = 0; i< temp.length; i++ ) {
				header[i] = temp[i];		// the header array
			} 
				
			// Making a data array
			if ( temp3[1] != undefined ) {
				temp = temp3[1].split("`");
			}
			response = new Array();
			i=0;
			
			for ( row = 0; row< numRows; row++ ) {
				response[row] = new Array();
				for ( col = 0; col< numCols; col++ ) {
					response[row][col] = temp[i];
					i++;
				}
			}
			
			// Check if have a response data
			if ( numRows == 0 ) {
				var firstData = "__NO DATA__";
			}
			else {
				var firstData = response[0][0];
			}

			// Making a DB variables
			for( var cx=0; cx< header.length; cx++){
				try{
					var toeval="dbData['"+header[cx]+"']=\""+response[0][cx]+"\"";
					eval( toeval );
				}
				catch(e){
				}
			}
					
			// Making a requested operation with a response text

			// POPULATE SELECT operation
			// =============================================================
			if ( oper_RPC == POPULATE_SELECT_ ) {


				// Check if have a showfield
				showCol = -1;
				if ( el[object].showfield_ !="" ) {
					if( el[object].showfield_.indexOf( ',' ) >= 0 ){
						showCol = 1;
					}
					else{
						toShow = el[object].showfield_;
						for ( i=0; i<numCols; i++ ) {
							if( header[i] == toShow ) {
								showCol = i;
							}
						}
					}
				}

				// Makes a menupopup
				var menupopup = document.getElementById("menupopup_" + object);
  	 	 		while( menupopup.childNodes.length>0 ) {
  	 	 			for( var i=0; i < menupopup.childNodes.length; i++ ) {
 	 	 		 		 menupopup.removeChild(menupopup.childNodes[i]);
 	 	 		 		 for( var timeless=0; timeless<1000; timeless++ ){
 	 	 		 		 	// do nothing
 	 	 		 		 }
   	 	 			}
  	 	 		}
 	 	 		haveNodes = true;

				// Check if have a previous options
				if (  el[object].options_ != "" ) {
					var options = new Array();
					options = el[object].options_.split( ",");
					for ( var i=0; i< options.length; i++ ){
	
						// Make a menuitem
						menuitem = document.createElement("menuitem");
						menuitem.setAttribute( "label", options[i] );
						menuitem.setAttribute( "ref",   options[i] );
						menuitem.setAttribute( "top",   object ); 
				
						if ( (i == 0) && (el[object].value_ == "") ) {
							el[object].value_ = options[i];
							menuitem.setAttribute( "selected", "true" );
						}
						if ( el[object].value_ == options[i] ) {
							menuitem.setAttribute( "selected", "true" );
						}
				
						menupopup.appendChild( menuitem );
						
						menuitem.addEventListener( "change", changeControl, false );// # 28
						menuitem.addEventListener( "command", eventSelect, false );
				
					}
				} 
				if(numRows==0) {
						el[object].value_ = '';
						el[object].value  = '';
						enableHasChanged();
						setTimeout('callpreValidation()',200);
				}		
				for ( var i=0; i< numRows; i++ ){
					if ( header[0] == "id" ) {
						showText = response[i][1];
					}
					else {
						showText = response[i][0];
					}
					reference = showText;
					// if have a showfield_
					if ( showCol >= 0 ) {
						showText += " - " + response[i][showCol];
					}

					// Make a menuitem					
					menuitem = document.createElement("menuitem");
					menuitem.setAttribute( "label", showText );
					menuitem.setAttribute( "ref",   reference );
					menuitem.setAttribute( "top",   object ); 
			
					if( ( i==0 ) &&
						( el[object].type_=='dynamic_select_list' )){
						 el[object].value_ = '';
						 el[object].value  = '';
					}
					if ( (el[object].value_ == reference ) ||
						 ((el[object].value_ =='')&&(i==0) &&
						  (el[object].type_=='dynamic_select_list')	 )) {
						 el[object].value_ = reference;
						 el[object].value  = reference;
						// Shows a complete text of selected item 
						document.getElementById( object ).setAttribute("label", showText );
						menuitem.setAttribute( "selected", true) ;
						menuitem.setAttribute( "selected", "true") ;
					}
					menupopup.appendChild( menuitem );
					menuitem.addEventListener( "change", changeControl, false );// # 28
					menuitem.addEventListener( "command", eventSelect, false );
				}
				el[object].turnChanged(true);
// ##### 5		
				vFlag++;
				callpreValidation();
				//enableHasChanged();
				//setTimeout('callpreValidation()',1);
			}
			
			
			// GROUP_TRUSTEE_ operation
			// =============================================================
			if ( oper_RPC == GROUP_TRUSTEE_ ) {
		
				// Makes a menupopup
				var popup = document.getElementById("menupopup_" + object);
				origValue = parseInt(el[object].value_,10);
				for ( i=0; i< numRows; i++ ){
					showText = response[i][1];
					idValue = Math.pow( 2, parseInt(response[i][0],10)-1 );

					// Make a menuitem					
					menuitem = document.createElement("menuitem");
					menuitem.setAttribute( "id", 	object+"`"+idValue );
					menuitem.setAttribute( "label", showText );
					menuitem.setAttribute( "top",   object ); 
					menuitem.setAttribute( "type", "checkbox" );
					
					if ( (origValue & idValue) > 0 ) {
						menuitem.setAttribute( "selected", "true") ;
						menuitem.setAttribute( "checked", "true") ;
					}
					popup.appendChild( menuitem );
					menuitem.addEventListener( "change", changeControl, false );// # 28
					menuitem.addEventListener( "command", trusteeSelect, false );
				
				}
			}
			
			// SQL_QUERY_
			// =============================================================
			if( oper_RPC == SQL_QUERY_ ) 	{

				el[object].lastValue  = "'#'";

				document.getElementById(object).value = firstData;
				el[object].value_ = firstData;
				el[object].value  = firstData;
				document.getElementById(object).autonum_ = "";
				document.getElementById(object).autonum = "";

				// Check Date format to text
				var tempData = firstData;
				if( ( el[object].type_== "text") 	&&
					(  firstData.length==10 ) 		&&
					(tempData.substr(4,1) == "-" )	&&
					(tempData.substr(7,1) == "-" )	){
					
					var day   = parseInt( tempData.substr(8,2),10);
					var month = parseInt( tempData.substr(5,2),10);
					var year  = parseInt( tempData.substr(0,4),10);
//					}
					if( day < 10 ){
						day = "0" + day;
					}
					if( month < 10 ){
						month = "0" + month;
					}
					firstData = day+'-'+month+'-'+year;
					document.getElementById(object).value = firstData;
					el[object].value_ = firstData;
					el[object].value  = firstData;
					
				}
				
				
				el[object].turnChanged(true); 	
				enableHasChanged();
				vFlag++;
				callpreValidation();

			}

			// CALLPROC_
			// =============================================================
			if( oper_RPC == CALLPROC_ ) 	{
				el[object].value_ = true;
				el[object].value  = true;
				var name = el[object].name_;
				var label = el[object].alias_ + " [ OK ]"; 
				document.getElementById(name).value = true;
				document.getElementById(name).setAttribute("label", label);
		
				setTimeout('callpreValidation()',100);
			}
			
			// INSERT_
			// =============================================================
			if( oper_RPC == INSERT_ ) 	{
				// If no procedure
				if( PROC_INSERT_ == "" ) {
					setTimeout('window.location.reload()', 20);
				}
			}

			// CHANGE_
			// =============================================================
			if( oper_RPC == CHANGE_ ) 	{
				// If no procedure
				if( PROC_CHANGE_ == "" ) {
					isEdited = false;
					setTimeout('goBack()',20);
				}
			}

			// DELETE_
			// =============================================================
			if( oper_RPC == DELETE_ ) 	{

				// If no procedure
				if( PROC_DELETE_ == "" ) {
					isEdited = false;
				}
			}
			
			// COMMIT_
			// =============================================================
			if( oper_RPC == COMMIT_ ) 	{
			}

			// AUTONUM_
			// =============================================================
			if( ( oper_RPC == AUTONUM_ ) &&
			 	( operation == INSERT_ ) ){
			 	var temp = firstData;
	 			var tempOld = temp + "";
	 			var tempStr = ""; 
	 			var tempZero = el[object].vdefault_; 		 	
	 			var tempLength = el[object].length_; 		 	
	 			// ZEROFILL
	 			if( tempZero.substr(0,1) == "0" ){
	 				for( var x=0; x<tempLength - tempOld.length; x++ ){
	 					tempStr += "0";
	 				}
	 				temp = tempStr + temp;
	 			}
				document.getElementById(object).value = temp;
				el[object].value_	= firstData;
				el[object].value  	= firstData;
				el[object].autonum_ = "";
				el[object].autonum 	= "";
			 	
			}

			fireNewRPC();
		}
	}
		
} // changeRPC() ---------------------------------------------------------
	

/**	fireNewRPC	Fire a new RPC from RPC List
 *	======================================================================*/

function fireNewRPC (){

	// Kill actual RPC wait and Check if exist a new RPC waiting
	var existRPC = 0;
	var deleted  = 0;
	var newRPC = 9999;

	// RPC TRACE
	if( traceRPC ){
		var rtmp="\n";
		for ( var i=0; i < RPC_Caller.length; i++ ) {
			rtmp+=i+"- "+RPC_Caller[i]+"\n";
		}
		document.getElementById('rpc').value+=rtmp;
	}
	for ( i=0; i < RPC_Caller.length; i++ ) {
			
		if ( RPC_Caller[i] != "" ) {
			if ( deleted == 0 ) {
				RPC_Caller[i] = "";
				deleted = 1;
			}
			else {
				existRPC = 1;
				newRPC = i;
				break;
			}
		}
	}
	// Firing a new RPC
	if ( newRPC < 9999 ) {
		url = RPC_Caller[ newRPC ];
		var tmp = url.split('&');
		tmp = tmp[0].split("action=");
		var RPC_Operation = tmp[1];
		// Execute a serial instruction ( Not RPC )
		var tmp = url.split("&");
		if( RPC_Operation==EXECUTE_){
			setTimeout( "evaluate("+tmp[1]+")", 5 );
			return;
		}

		// Call a TX Monitor		
		if( document.getElementById('lbl_Tx')!= undefined){
			var sig=document.getElementById('lbl_Tx').label;
			switch (sig){
				case 'Tx     ':
					document.getElementById('lbl_Tx').label='Tx.    ';
					break;
				case 'Tx.    ':
					document.getElementById('lbl_Tx').label='Tx..   ';
					break;
				case 'Tx..   ':
					document.getElementById('lbl_Tx').label='Tx...  ';
					break;
				case 'Tx...  ':
					document.getElementById('lbl_Tx').label='Tx.... ';
					break;
				case 'Tx.... ':
					document.getElementById('lbl_Tx').label='Tx.....';
					break;
				case 'Tx.....':
					document.getElementById('lbl_Tx').label='Tx     ';
					break;
			}
			document.getElementById('Tx').value=url.length+'';
		}
		
// ##### 30
		// New RPC Caller (POST)
		var data = url;
		tmp = url.split('?');
		url = tmp[0];
		req = new XMLHttpRequest();	
		req.onreadystatechange = changeRPC;
		req.open("POST", url, true );
		req.setRequestHeader('Content-type','application/x-www-form-urlencoded');
		req.send( '__url__='+data );


/* old in #30		
		
		req = new XMLHttpRequest();	
		req.onreadystatechange = changeRPC;
		req.open("GET", url, true );
		req.send( null );
*/ // # 30 END
	}
	preValidation(false);
	
} // fireNewRPC() ----------------------------------------------------------

	
/**	haveTrustee		Check if the user have a trustee to a property			
	======================================================================*/
	
function haveTrustee ( prop ) {
	
	
	
// ##### 9 -  Chang a intrnar variable 'trustee' by '_trustee'
	
// ##### 27 
	// Trustee to ALL
	if( ( prop == 'ALL' )			||
		( prop == '2147483647' )   	){
		return true;
	}

// ##### 27 end
	
	// If user is a Developer		
	if ( ( _trustee & 1 ) != 0 ) {
		return true;
	}
	// Other user and not have a trustee
	if ( ( _trustee & prop) == 0 ) {
		return false;
	} 
	// Ok, have a trustee
	return true;
} // haveTrustee() -----------------------------------------------------
	

/**	int_Passwd		Internal Procedure to chaneg passwords					
	======================================================================*/

function int_Passwd() {

	// Data of a two passwords
	password = document.getElementById( "password" ).value;
	pass2    = document.getElementById( "pass2" ).value;

	if ( password != pass2 ) {
		alert( MSG_DIFFPASS_ );
		return;
	}
	if ( password.length <6 ) {
		alert( MSG_MIN_PWD_ );
		return;
	}
	document.getElementById("acceptbutton").setAttribute("hidden", "false");
	document.getElementById("check").setAttribute("label", MSG_PWDACCEPT_ );
	document.getElementById("acceptbutton").click();

} // int_Passwd ------------------------------------------------------------


/**	int_Group		Internal Procedure to group trustees					
	======================================================================*/

function int_Group () {

	// Position to open a new window
	hpos = window.screenX + 150;
	vpos = window.screenY + 250;
	
	position   	=  "top=" + vpos + ",left=" + hpos ;
	xfunction  	= "?function=group_trustee";
	xparameters	= "&par=";
	xvariable	= "&var=" + variable;
	xvalue		= "&val=" + value;
	url   		= "plusinternal.php" + xfunction + xparameters + 
						xvariable + xvalue;
						
	if ( debug == 0 ) {
		var atrib = "chrome,dependent=yes," + position;
		window.open( url, "internal", atrib ) ;
	}
	else {
		var atrib = "toolbar=yes,location=yes,directories=yes,status=yes,menubar=yes,"+
					"scrollbars=yes,resizable=no,dependent=yes," + position;
		window.open( url, "internal", atrib ) ;
	}

} // int_Group -------------------------------------------------------------



/**	elementControl		Control a elements actions							
	======================================================================*/	

function elementControl() {

	// Determines a operation to make
	if ( objectToShow == 0) {
		alert( MSG_NOTSHOW_ );
		goBack();
	}
			
	if ( subform != -1 ) {
		actualFocus = 0;
		setTimeout("nextFocus()", 10);	// focus in a second element
	}
	
	// INSERT DATA
	if (( operation == INSERT_ )		||
		( operation == INS_DATA_)		||
		( operation == INSERT_ELEM_)	) {
		// A timeout is to short delay to browser reorganize the fields
		actualFocus = -1;
		setTimeout("nextFocus(-1)", 50);	// focus in a first element	
	}
	
	// CHANGE DATA
	if ( operation == CHANGE_ ) {
		// A timeout is to short delay to browser reorganize the fields
		actualFocus = 0;
		setTimeout("nextFocus(0)", 50);	// focus in a second element
	}
	setTimeout('callpreValidation()', 500 );
	
	//	Transmit Receive monitor
	if( drawTxRx ){
		drawTxRx = false;
		label = document.createElement("label");
		label.setAttribute( "value", "" );
		label.setAttribute( "id", "lbl_rpc" );
		
		// Principal hbox
		menu = document.getElementById("Principal-menu");
		dynamic = document.getElementById("title_dynamic");
		hbox0 = document.createElement("hbox");
		hbox0.setAttribute( "id", "hbox_TxRx" );
		hbox0.setAttribute( "align", "right" );
		hbox0.setAttribute( "flex", "1" );
		if( menu!=undefined ) {
			menu.appendChild( hbox0 );	
		}
		else{
			dynamic.appendChild( hbox0 );			
		}

		// Title Hbox
		if( formTitle != undefined ){
			document.getElementById("title_vbox").setAttribute("hidden", "true");
			hbox = document.createElement("hbox");
			hbox.setAttribute( "id", "hbox_Tit" );
			hbox.setAttribute( "align", "center" );
			hbox.setAttribute( "flex", "1" );
			hbox0.appendChild( hbox );		
			hbox = document.createElement("groupbox");
			hbox.setAttribute( "id", "hbox_Tit" );
			hbox.setAttribute( "align", "center" );
			hbox.setAttribute( "flex", "1" );
			hbox.setAttribute( "size", "50" );
			hbox0.appendChild( hbox );							
			caption = document.createElement("caption");
			caption.setAttribute( "id", "lbl_Tit" );
			//caption.setAttribute( "label", "Title" );
			caption.setAttribute( "size", "10" );
			hbox.appendChild(caption );
			label = document.createElement("label");
			label.setAttribute( "id", "title" );
			label.setAttribute( "value", formTitle );
			label.setAttribute( "style", "font-size:18pt; font-weight:bold;" );
			hbox.appendChild(label );
		}



		// TX Box
		hbox = document.createElement("hbox");
		hbox.setAttribute( "id", "hbox_Tx" );
		hbox.setAttribute( "align", "right" );
		hbox0.appendChild( hbox );		
		hbox = document.createElement("groupbox");
		hbox.setAttribute( "id", "hbox_Tx" );
		hbox.setAttribute( "align", "right" );
		hbox0.appendChild( hbox );							
		caption = document.createElement("caption");
		caption.setAttribute( "id", "lbl_Tx" );
		caption.setAttribute( "label", "Tx     " );
		caption.setAttribute( "tooltiptext", "Transmited Chars" );
		hbox.appendChild(caption );
		label = document.createElement("label");
		label.setAttribute( "id", "Tx" );
		label.setAttribute( "value", "" );
		label.setAttribute( "size", "10" );
		label.setAttribute( "maxlength", "10" );
		hbox.appendChild(label );

		// RX Box
		hbox = document.createElement("hbox");
		hbox.setAttribute( "id", "hbox_Rx" );
		hbox.setAttribute( "align", "right" );
		hbox.setAttribute( "size", "50" );
		hbox0.appendChild( hbox );		
		hbox = document.createElement("groupbox");
		hbox.setAttribute( "id", "hbox_Rx" );
		hbox.setAttribute( "align", "right" );
		hbox.setAttribute( "size", "50" );
		hbox0.appendChild( hbox );							
		caption = document.createElement("caption");
		caption.setAttribute( "id", "lbl_Rx" );
		caption.setAttribute( "label", "Rx     " );
		caption.setAttribute( "tooltiptext", "Received Chars" );
		caption.setAttribute( "size", "10" );
		hbox.appendChild(caption );
		label = document.createElement("label");
		label.setAttribute( "id", "Rx" );
		label.setAttribute( "value", "" );
		label.setAttribute( "size", "10" );
		hbox.appendChild(label );

	}
	


	// RPC TRACE
	if( traceRPC ){
		label = document.createElement("label");
		label.setAttribute( "value", "  RPC" );
		label.setAttribute( "id", "lbl_rpc" );
		var grid = document.getElementById("grid");
		var rows = document.getElementById("rows");
		row = document.createElement("row");
		row.setAttribute( "id", "row_" + this.name_ );
		rows.appendChild( row );	
		row.appendChild( label );
	
		hbox = document.createElement("hbox");
		hbox.setAttribute( "id", "hbox_r[p" );
		row.appendChild( hbox );		
			
		textbox = document.createElement("textbox");
			
		// Determine a properties
		textbox.setAttribute( "id", 'rpc' );
		textbox.setAttribute( "size", 100 );
		textbox.setAttribute( "maxlength", 100 );
		textbox.setAttribute( "value", '' );
		textbox.setAttribute( "multiline", "true" );
		textbox.setAttribute( "cols", 100 );
		textbox.setAttribute( "rows", 10 );
		hbox.appendChild( textbox );
	}
		
} // elementControl() ------------------------------------------------------

																				
/**	eventSelect		Called when a select list element is selected			
	======================================================================*/	

function eventSelect( event ) {

	isEdited = true;
	if ((operation == SHOW_) ||
		(operation == EDIT_SHOW_ ) ||
		(operation == VIEW_DATA_ )) {
		alert( MSG_NOTCHANGEMODE_ );
		return;
	}
	

	menuName = event.target.top;
	selected = event.target.ref;

	if( selected.substr(0,2) == "__" ){
		var temp = prompt ( selected );
		selected = temp;
		
		// Makes a menupopup
		var menupopup = document.getElementById("menupopup_" + menuName);

		// Make a menuitem
		menuitem = document.createElement("menuitem");
		menuitem.setAttribute( "label", selected );
		menuitem.setAttribute( "ref",   selected );
		menuitem.setAttribute( "top",   menuName ); 

		el[object].value_ = selected;
		el[object].value = selected;
		menuitem.setAttribute( "selected", "true" );

		menupopup.appendChild( menuitem );
		
		menuitem.addEventListener( "change", changeControl, false );// # 28
		menuitem.addEventListener( "command", eventSelect, false );
	}

	document.getElementById( event.target.top ).value = selected;
	el[menuName].value_ = selected;
	el[menuName].value = selected;
// ##### 3	
	el[menuName].turnChanged(true);
// ##### 3

	callpreValidation();
	isEdited = true;
			
} // eventSelect() ---------------------------------------------------------


// ##### 28 - Newcontrol to .hasChanged()
/*	changeControl()		Changes a change attribute of a fields
	======================================================================*/
function changeControl(event) {
	var name=event.target.id;
	el[name].turnChanged(true);
	callpreValidation();
	return true;
} // changeControl() --------------------------------------------------------
// ##### 28

																				
/**	eventCheckBox		Called when a checkBox is selected					
	======================================================================*/	

function eventCheckBox( event ) {

	if ((operation == SHOW_) ||
		(operation == EDIT_SHOW_ ) ||
		(operation == VIEW_DATA_ )) {
		alert( MSG_NOTCHANGEMODE_);
		return;
	}
	
	var name = event.target.id;
	
	el[name].turnChanged(true); 
	callpreValidation();
	isEdited = true;
	
} // eventCheckBox() -------------------------------------------------------

																				
/**	trusteeSelect		Called when a select list element is selected		
	======================================================================*/	

function trusteeSelect( event ) {

	if ((operation == SHOW_) ||
		(operation == EDIT_SHOW_ ) ||
		(operation == VIEW_DATA_ )) {
		alert( MSG_NOTCHANGEMODE_);
		return;
	}
	
	menuId   = event.target.id;
	temp = menuId.split('`');
	name = temp[0];
	id   = temp[1];
	
	// To add a new trustee
	if (document.getElementById( menuId ).hasAttribute("checked") ) {
		document.getElementById( name ).value |= id;
		document.getElementById( name ).label |= id;
	}
	// To remove a trustee
	else {
		document.getElementById( name ).value ^= id;
		document.getElementById( name ).label ^= id;	
	}
	
	setTimeout( "callpreValidation()", 50);
	isEdited = true;
			
} // trusteeSelect() ---------------------------------------------------------

																				
/**	setIframe		Determine a Iframe status								
	======================================================================*/	

function setIframe( event ) {

	var dt_ = new Date();	
	var sec_ = dt_.getMinutes() + '' + dt_.getSeconds();	
	var page = sec_;	
	if ((operation == SHOW_) ||
		(operation == EDIT_SHOW_ ) ||
		(operation == VIEW_DATA_ )) {
		page = 99998+''+sec_;
	}
	menuId   = event.target.id;

// ##### 11	if( operation == INSERT_ ){
		openSubform=true;
// ##### 11	}
		
	temp = menuId.split('`');
	iframe = temp[1];
	alias  = temp[2];

	document.getElementById('cap`'+iframe+'`'+alias).setAttribute("label",alias);
	 
	if( document.getElementById(iframe).hasAttribute('hidden') ) {

		// Define a page to call
		getRef();
		xaction = "?action=" + BROWSE_;
		xsession= "&sess=" + session_;
		xproj   = "&project=" + project_ ;
		xlink	= "&link=" + el[iframe].link_;
		xvers	= "&v="+ version_;
		
		filter = el[iframe].options_;
		temp  = filter.split(' ');
		obj    = "&pass=" + evaluate( filter );

		// Preparing to pass actual values							{ #76
		
		var sup = "";
		var tmp = "";
		var value_="";
		for( i=0; i< elName.length; i++ ) {
			var name = elName[i];
	
			value_ = el[name].get();		
			if ( value_ == undefined){
				tmp = "";
			}
			else {
				var tmp = value_;
			}
			tmp +="";
			tmp = tmp.replace( /,/g, "wWx");
			tmp = tmp.replace( /\+/g, "wWz");
			tmp = tmp.replace( /\\/g, "wWw");
			sup += name + "," + escape(tmp) + ",";
		}
		superior = "&sup=" + sup + "_0_,end";
		
		var iframeSend = evaluate(el[iframe].send_) ;
		xtra	= "&sel=subform`" +  iframeSend;
		xpage	= "&page=" + page ;
		url   =	"plusexec.php" + xaction + xsession + xproj + 
					xlink + xpage + xtra + obj + superior + xvers;
		document.getElementById(iframe).setAttribute("height", 300);
		document.getElementById(iframe).setAttribute("width", 700 );
		document.getElementById(iframe).setAttribute("src", url );
		document.getElementById(iframe).removeAttribute('hidden');		
		return;
	}
	else {
		document.getElementById(iframe).setAttribute('hidden',"true");
		return;
	}
		
} // setIframe() -----------------------------------------------------------


/**	report		Call a report form							
	======================================================================*/	

function report( event ) {

	var dt_ = new Date();	
	var sec_ = dt_.getMinutes() + '' + dt_.getSeconds();	
	var page = sec_;	
	if ((operation == SHOW_) ||
		(operation == EDIT_SHOW_ ) ||
		(operation == VIEW_DATA_ )) {
		page = 99998+''+sec_;
	}
	var rep = event.target.id;
	var repLink = el[rep].replink_;
		
	// Define a page to call
	getRef();
	xaction = "?action=" + REPORT_;
	xsession= "&sess=" + session_;
	xproj   = "&project=" + project_ ;
	xlink	= "&link=" + repLink;
	xvers	= "&v="+ version_;
	obj    = "";

	// Preparing to pass actual values	
	var sup = "";
	var tmp = "";
	var value_="";
	for( i=0; i< elName.length; i++ ) {
		var name = elName[i];	
		value_ = el[name].get();		
		if ( value_ == undefined){
			tmp = "";
		}
		else {
			var tmp = value_;
		}
		tmp +="";
		tmp = tmp.replace( /,/g, "wWx");
		tmp = tmp.replace( /\+/g, "wWz");
		tmp = tmp.replace( /\\/g, "wWw");
		sup += name + "," + escape(tmp) + ",";
	}
	superior = "&sup=" + sup + "_0_,end";
	xtra	= "";
	xpage	= "&page=" + page ;
	url   =	"plusexec.php" + xaction + xsession + xproj + 
			xlink + xpage + xtra + obj + superior + xvers;
	window.open( url );	
				
} // report() --------------------------------------------------------------


/**	callProc		Call a procedure							
	======================================================================*/	

function callProc( event ) {

	var element = event.target.id;
	var procedure = evaluate(el[element].query_);
	var name = el[element].name_;
	document.getElementById(name).setAttribute("hidden", "true");
	el[element].validate( CALLPROC_, CALLPROC_, "", name, procedure );
				
} // callProc() ------------------------------------------------------------


	
/**	evaluate			Evaluate a expression and return a result			
	======================================================================*/
function evaluate ( data ) {

	if( evalError ){
		return;
	}
	try{
		resp = eval( data );
	}
	catch(e){
		evalError=true;
		alert( MSG_ERROREVAL_ + data );
		return false;
	}
	return resp;
	
} // evaluate() ------------------------------------------------------------



/**	preValidation		Makes a pre-validation in all elements				
	======================================================================*/	
function preValidation( consults ) {
	
	
	// Condition to start screen (login)
	if ( startScreen == 1 ) {
		return;
	}

	// AllValid Control
	if( (operation == SHOW_)		||
		(operation == EDIT_SHOW_) 	||
		(operation == VIEW_DATA_) 	){
		allValid = false;
	}
	else {
		allValid = true;
	}
	
	// Lock allValid
	if( lockAll==true ){
		allValid = false;
		for ( ix=0; ix< elName.length; ix++ ) {
			name = elName[ix];	
			var elemX = document.getElementById(name);
			elemX.setAttribute('readonly','true');
		}
		return;
	}
	
	if( consults == undefined ){
		var consults = true;
	}
	
	// Error control
	if( evalError ){
		return;
	}

	if( vFlag > 0 ){
		posvalError=false;
		
		for ( var ix=0; ix< elName.length; ix++ ) {
			name = elName[ix];	
			required = el[name].required_;
			value_ = el[name].get();
			toShow = el[name].cshow_;
			preval = el[name].preval_;
			cChange = el[name].cchg_;


// ##### 25
			// A new trustee check to every field
			
			// Check Trustee to show
			if ( ! haveTrustee( el[name].trust_show_ ) ) {
				toShow = false;
			}
			// Check Trustee to change
			if ( (! haveTrustee( el[name].trust_chg_ )) &&
				 ( operation == CHANGE_ ) ) {
				toShow = false;
			}

/* OLD IN 25
			// Check Trustee to show
			if ( ! haveTrustee( el[name].trust_show_ ) ) {
				toShow = true;
			}
			// Check Trustee to change
			if ( (! haveTrustee( el[name].trust_chg_ )) &&
				 ( operation == INSERT_ ) ) {
				toShow = true;
			}

*/

// #### 25 end




			// Number format control
			if( el[name].dec_!=''){
			
				if( ( el[name].type_ != "formula") 	||
					( el[name].cchg_ == '' )		){
					value_ = controlDecimals( value_, el[name].length_,el[name].dec_);
					document.getElementById(name).value = value_;
				}

			}

/* OLD in # 13
			// Condition to CHANGE
			if( (cChange!="") 			&&
				(!evaluate(cChange))	){
				document.getElementById(name).setAttribute( "readonly", "true" );	
			}
*/

			// CHECK REQUIRED FIELD
			if ( ( required == 1 ) && ( value_ == "" ) ) {
				if ( document.getElementById(name).hasAttribute("hidden") ) {
				}
				else {
					allValid = false;	   
				}
			} 
			
			// CHECK FOR AUTONUM VALUE
			if( ( el[name].autonum_ != '' )	&&
				( isEdited == true )		&&
				( el[name].options_!="DB")	){
					var autonum = el[name].autonum_;
					el[name].autonum_ = '';	
					el[name].validate( AUTONUM_, AUTONUM_, "", autonum,autonum, " "  );			
			}
	
			// Condition to show
			var showIt = 1;
			if ( toShow != "" ) {
				if( el[name].type_!="subform" ) {
					if ( evaluate( toShow ) ) {
						document.getElementById(name).removeAttribute("hidden");
						document.getElementById("lbl_"+name).removeAttribute("hidden");
					}
					else{
						showIt = 0;
						document.getElementById(name).setAttribute("hidden", "true");
						document.getElementById("lbl_"+name).setAttribute("hidden", "true");
					}	
				}
				
				else{
					if ( evaluate( toShow ) ) {
						document.getElementById("gbox_"+name).removeAttribute("hidden");
						document.getElementById("cap`"+name+"`"+
						el[name].alias_).removeAttribute("hidden");
					}
					else{
						showIt = 0;
						document.getElementById("gbox_"+name).setAttribute("hidden", "true");
					}	
				
				}
			}
			
			if( showIt == 1 ) {




// ##### 13
				// Condition to CHANGE
				if( cChange!="" ) {
					if( !evaluate(cChange) ){
						document.getElementById(name).setAttribute( "readonly", "true" );	
					}
					else{
						document.getElementById(name).removeAttribute( "readonly");	
					}
				}
// ##### 13	


				//Check for SQL Query
				if( ( el[name].query_ != "" ) 		&&
					( evaluate( el[name].queryRef_))&&
					( consults == true )			){
					var query = evaluate(el[name].query_) ;
					el[name].validate( QUERY_, SQL_QUERY_, "",name, query );
					el[name].firstSQL=false;
				}
	
				//Check for DSL Query
				if( ( el[name].dsl_ != "" ) 	&&
					( evaluate( el[name].dsl_))	&&
					( consults == true )		){
					var filter = "";
					if( el[name].filter_ != "" ) {
						filter = " WHERE "+ noQuotes( evaluate(el[name].filter_) );
					}
	
					if( el[name].showfield_.indexOf( ',' ) >= 0 ){
						var query = "SELECT "+el[name].showfield_+" FROM " + el[name].reltable_ + 
							filter + ";";
					}
					else{
						var query = "SELECT * FROM " + el[name].reltable_ + 
							filter + ";";
					}
					el[name].validate( QUERY_, POPULATE_SELECT_, "", el[name].name_, query );
				}
	
				// EvaluateC_VIEW
				if( el[name].cview_ != "" ){
					if ( !evaluate( el[name].cview_) ){
						document.getElementById(name).setAttribute( "hidden", "true" );
						try{
							document.getElementById("lbl_"+name).setAttribute("hidden", "true");
						}
						catch(e){
						}
					}
					else{
						if( el[name].type_ != "subform" ){
							document.getElementById(name).removeAttribute( "hidden" );
						}
						try{
							document.getElementById("gbox_"+name).removeAttribute("hidden");
						} catch(e){}
						try{
							document.getElementById("cap`"+name+'`'+el[name].alias_).removeAttribute("hidden");
						} catch(e){}
						try{
							document.getElementById("lbl_"+name).removeAttribute("hidden");
						} catch(e){}
					}				
				}
				
				// Evaluate cdel
				if( el[name].cdel_ != '' ){
					if( evaluate( el[name].cdel_) ){
// # 30					enableDeleteButton();
					} 
					else{
						disableDeleteButton();
					}
				}
				
				// Prevalid Value
				if( (preval != "") && (value_ == "") &&
					(document.getElementById(name).hasAttribute("focused")) ){
					result = evaluate( preval );
					el[name].value_ = result;
					el[name].value = result;
					document.getElementById(name).setAttribute("value", result);
				}


				// Formula
				if( el[name].type_ == "formula") {
					v_anterior=el[name].value;
	
					// Normal Formulas
					if( el[name].options_!="DB" ) {
					
						if( ( el[name].cchg_ != '' ) 		&&					
							( evaluate(el[name].cchg_) ) 	){
							document.getElementById(name).removeAttribute( "readonly" );	
							value_ = parseFloat(document.getElementById(name).value);
							if( isNaN( value_ ) ){
								value_ = 0;
							}
							result = value_;
							el[name].value_ = result;
							el[name].value = result;
							document.getElementById(name).setAttribute("value", result);
						}
						else{
							result = evaluate( el[name].formula_ );
							el[name].value_ = result;
							el[name].value = result;
							document.getElementById(name).setAttribute("value", result);
							document.getElementById(name).setAttribute( "readonly", "true" );	
						}
					}
					else{		// DB Formulas
						if( operation!= SHOW_ ){
							result = evaluate( el[name].formula_ );
							el[name].value_ = result;
							el[name].value = result;
							document.getElementById(name).setAttribute("value", result);
						}
					}
					if( v_anterior != result ){
						el[name].turnChanged(true);	// # 28
					}
				}


				// Posvalidating		
				if( (el[name].posval_!="") && (!posvalError) ){
					if( !evaluate( el[name].posval_ )){
						posvalError=true;
						allValid=false;
						if( (keypress == 9)	||
							(keypress == 13)||
							(keypress == 0)	){
							if( el[name].message_ !="" ){
								enableMessageButton( evaluate(el[name].message_),3000 );
							}
							else {
								enableMessageButton( "Error in "+el[name].alias_,5000 );
							}
						}
					}
				}			
			}	
// ##### 6  

// ##### 11
		    // Read Anterior trusteeSelect
			if( ( typeof F_READ_TRUSTEES != "undefined" ) 	&&
				( F_READ_TRUSTEES.hasChanged() ) 		){
				el['G_SHOW_'].value = db('G_SHOW_');
				el['G_SHOW_'].value_ = db('G_SHOW_');
				document.getElementById('G_SHOW_').setAttribute("value", db('G_SHOW_'));
				document.getElementById('G_SHOW_').setAttribute("ref", db('G_SHOW_') );
				document.getElementById('G_SHOW_').setAttribute("label", db('G_SHOW_') );
				el['G_CHANGE_'].value = db('G_CHANGE_');
				el['G_CHANGE_'].value_ = db('G_CHANGE_');
				document.getElementById('G_CHANGE_').setAttribute("value", db('G_CHANGE_'));
				document.getElementById('G_CHANGE_').setAttribute("ref", db('G_CHANGE_') );
				document.getElementById('G_CHANGE_').setAttribute("label", db('G_CHANGE_') );
			}
// ##### 11 end




			// Autofill fields
			if( ( __autofill__ != '_NONE_' ) &&
				( __autofill__.hasChanged() )		){
				if( __autofill__ == '__NO DATA__' ){
					el[name].value = "";
					el[name].value_ = "";
					document.getElementById(name).setAttribute("value", "" );
				}
				else {
					if( typeof dbData[name] != "undefined" ){
						el[name].value = db(name);
						el[name].value_ = db(name);
						document.getElementById(name).setAttribute("value", db(name));
						document.getElementById(name).setAttribute("ref", db(name) );
						document.getElementById(name).setAttribute("label", db(name) );
								
						if( (el[name].type_!="select_list") 		||
							(el[name].type_!="dynamic_select_list")	){
						
						

//				var menupopup = document.getElementById("menupopup_" + name);
//				document.getElementById(name).setAttribute("ref", db(name) );
//				document.getElementById(name).setAttribute("label", db(name) );
				
	
						}
						
						
						
						
					}
				}
			
			}

// #### 6 end			
			
		}
		
		// A new lastvalue control to hasChanged method ( #157 )
		for ( var ix=0; ix< elName.length; ix++ ) {
			name = elName[ix];	
			var newValue = el[name].get();
			if( el[name].lastValue_ != newValue ){
				el[name].turnChanged(true);	// # 28
				el[name].lastValue_ = newValue;
			}
		}
		if(tohasChanged){
			setTimeout( "disableHasChanged()",200);
		}
		else{
			enableHasChanged();
		}
			
		if ( allValid  ){
			if( acceptButton ){
				document.getElementById("acceptbutton").removeAttribute("hidden");
			}
		}
		else {
			document.getElementById("acceptbutton").setAttribute("hidden", "true");
		}
	}
	vFlag--;


	// A hasChange control
	if( vFlag <= 0 ){
		for ( var ix=0; ix< elName.length; ix++ ) {
			name = elName[ix];	
			el[ name].turnChanged(false);
		}
		vFlag = 0;
		return;
	}
	else{
		setTimeout('preValidation()',100);
	}
			
} // preValidation() -------------------------------------------------------


		
/**	showAll		Show all fields												
	======================================================================*/	
function showAll() {

	// Prepare an array to focus control and show all elements
	elName = new Array();
	for ( var name in el ) {
		elName[elName.length] = el[name].name_;

		// Shows a element
		el[name].show();
	
		// { #71									
		// Actualize a last value
		el[name].lastValue_ = el[name].get();
		// } #71									
	}
	elementControl();
} // showAll() --------------------------------------------------------------
																			
																			
/**	nextFocus			Makes a focus in an element							
	======================================================================*/	
function nextFocus( start ) {

	if ( enableFocus == 0 ) {
		return;
	}
	enablefocus = 0;
	setTimeout( 'enFocus()', 50 );
	var startElement = 0;
	// Determine a starting point to focus
	if ( start == undefined ) {
		// Locate the actualFocus
		for ( var i=0; i< elName.length; i++ ) {
			object = document.getElementById(elName[i]);
			if( object.hasAttribute("focused")) {
				actualFocus = i;
			}	
		}
		// if is in the internal of data range 
		if ( actualFocus < elName.length ) {
			startElement = actualFocus + 1 ;
		}
	}
	
	for ( var i=startElement; i< elName.length; i++ ) {
		
		shows = true;
		// check if is editable
		// here is a local to check if have a trustee to change
		// and if the field had a property to edit
		
		// Check Trustee
		if ( ! haveTrustee( el[elName[i]].trust_show_ ) ) {
			shows = false;
		}
		// check if is readonly
		if ( document.getElementById(elName[i]).hasAttribute("readonly") ) {
			shows = false;
		}
		if ( document.getElementById(elName[i]).hasAttribute("hidden") ) {
			shows = false;
		}
		if ( shows == true ) {
			object = document.getElementById(elName[i]);
			object.focus();
			actualFocus = i;
			document.getElementById(elName[i]).click();
			break;
		}
	}
	callpreValidation();

} // nextFocus() -----------------------------------------------------------

/* forceFocus	Force a Focus in a element
==========================================================================*/
function forceFocus( name ){
	document.getElementById(name).click();
	return true;
}


/**	onKey		Checks every time is pressed a key and make a decision		
	======================================================================*/	

function onKey( event ) {
	keypress=event.keyCode;
//alert( keypress );	


	// Condition to start screen (login)
	if ( startScreen == 1 ) {
		return;
	}
// ##### 5
//	if( typeof operation != 'number'){
//		operation = xOper;
//	}
// ##### 5


	if( operation == undefined ) {
		operation = 0;
	}

	// Date control
	var target_ = event.target.id;
	var vartype = '';
	if( event.target.type =="text" ){
		vartype = el[target_].type_;
	}


// ##### 182  €/ Check a <SHIFT> <BACKSPACE> KEY
	if( (keypress == 8) && ( shiftKey >0 ) ){
		document.getElementById(target_).value='';		
	}
	if( keypress == 16 ){
		shiftKey = 1;
		return;		
	}
	shiftKey = 0;
// ##### 18 end		

	
	// Check if has changed
	// <ENTER> <TAB> <ESC> Mouse
	if( (keypress == 13)		||
		(keypress == 27)		||
		(keypress ==  0)		||
		(keypress ==  9)		){
		enableHasChanged();
		setTimeout( "callpreValidation()",1);
	}
	else{
		// If no important key
		// <ARROWS> 
		if( (keypress == 37)		||
			(keypress == 38)		||
			(keypress == 39)		||
			(keypress == 40)		){
		}
		// If is a important key - Actualize a old_var
		else{				
// ##### 22 - Solution to hasChanged() Problem in a numbers		
			if(event.target.type =="text"){
				el[target_].turnChanged(true);
			}	
// ##### 22 end		
		
		
		
		
		
//			enableMessageButton(target_,1000);
		}
	}
	
	if( vartype == 'date' ) {
		// <BACKSPACE> </> <->

		if( (keypress == 8)		||
			(keypress == 37)		||
			(keypress == 39)		||
			(keypress == 46)		||
			(keypress == 109)	){
			return true;
		}
		var keyed = document.getElementById(target_).value;
		var days = new Array( 0,31,29,31,30,31,30,31,31,30,31,30,31);
	
		// Cancelling not numbers
		if( (( keypress < 48 ) && ( keypress > 31)) 	||
		    (( keypress < 96 ) && ( keypress > 57))		||
			( keypress > 105) 							){
			if ( lastKey == 0 ) {
				document.getElementById(target_).click();
				lastKey = 1;
				setTimeout( "enableKey()", 50 );
				alert( MSG_ONLYNUMBERS_ );			
				event.preventDefault();
			}
		}
		if( keyed.length == 2 ) {
			var day = parseInt( keyed,10 );
			if( ( day > 31 )	||
				( day == 0 )	){
				if ( lastKey == 0 ) {
					alert( MSG_NODATE_ );
					lastKey = 1;
					setTimeout( "enableKey()", 50 );
				}
				document.getElementById(target_).value = '';
				return;
			}
			else {
				document.getElementById(target_).value += '-';
			}
		}
		if( keyed.length >= 5 ) {
			var day   = parseInt( keyed.substr(0,2),10);
			var month = parseInt( keyed.substr(3,2),10);
			if( ( month == 0 )	||
				( month >12  )  ){
				if ( lastKey == 0 ) {
					alert( MSG_NOMONTH_ );
					lastKey = 1;
					setTimeout( "enableKey()", 50 );
				}
				return;
			}
			if( ( day > days[month] )	||
				( day == 0 )	){
				if ( lastKey == 0 ) {
					alert( MSG_NODATE_ );
					lastKey = 1;
					setTimeout( "enableKey()", 50 );
				}
				document.getElementById(target_).value = '';
				return;
			}
			if( keyed.length == 5 ) {
				document.getElementById(target_).value += '-' +
				el[target_].options_;
			}
		}
		
		if( keyed.length >= 10 ) {
			var day   = parseInt( keyed.substr(0,2),10);
			var month = parseInt( keyed.substr(3,2),10);
			var year  = parseInt( keyed.substr(6,4),10);
			if( ( (year % 4) != 0 ) &&
				( month == 2  )     &&
				( day   == 29 )		){
				if ( lastKey == 0 ) {
					alert( MSG_NODATE_ );
					lastKey = 1;
					setTimeout( "enableKey()", 50 );
				}
				return;
			}
		}
	}
		
	// Number control
	if( (event.target.type =="text") &&
		(el[target_].dec_ !="")		 ){
			// Number Format Control
			var value_ = el[target_].get()+'';
			value_=	value_.replace( /,/g, "");
			value_=	value_.replace( / /g, "");

			if( (keypress==190) || (keypress==110)){
				el[target_].dot=true;
			}

			if(keypress == 8){
				document.getElementById(target_).value='';
			}
			if( (value_==0)){
				var keyTemp = parseFloat(document.getElementById(target_).value);
// ##### 2				
				if( isNaN( keyTemp ) ){
					keyTemp = 0;
				}
// ##### 2

// ##### 1
				if( (keypress>=48) && (keypress<=57)&&(!el[target_].dot)){
						document.getElementById(target_).value=keyTemp;
				}
				if( (keypress>=96) && (keypress<=105)&&(!el[target_].dot)){
						document.getElementById(target_).value=keyTemp;
				}
			}

/* Old in # 1
			if( (value_==0)){
				
				if( (keypress>48) && (keypress<58)&&(!el[target_].dot)){
						document.getElementById(target_).value='';
				}
				if( (keypress>96) && (keypress<105)&&(!el[target_].dot)){
						document.getElementById(target_).value='';
				}
			}
// ##### 1

*/

			
			lastPress=keypress;

			
			if( (keypress == 8)		||
			(keypress == 37)		||
			(keypress == 39)		||
			(keypress == 110)		||
			(keypress == 190)		||
			(keypress == 194)		||
			(keypress == 109)	){
				return true;
		}
		
		

		// Cancelling not numbers
		if( (( keypress < 48 ) && ( keypress > 31)) 	||
		    (( keypress < 96 ) && ( keypress > 57))		||
			 ( keypress > 105) 							){
			if ( lastKey == 0 ) {
				document.getElementById(target_).click();
				lastKey = 1;
				setTimeout( "enableKey()", 50 );
			}
			event.preventDefault();
		}
	}
		
	// <ESC>	
	if ( keypress == 27 ) {
		prepare_reload();
		goBack();
	} 

	// <SPACE>
	if ( (keypress == 32) ) {
		target_ = event.target.id;
		type_ = event.target.type;

		if ((target_ == "closebutton")   ||
		    (target_ == "acceptbutton" ) ||
		    (target_ == "enableChange" ) ||
		    (target_ == "deletebutton" ) ){
			if ( lastKey == 0 ) {
				document.getElementById(target_).click();
				lastKey = 1;
				setTimeout( "enableKey()", 50 );
			}
			return;
		}
	}
	
	// <ENTER>
	if ( (keypress == 13) ) {
		var target_ = event.target.id;
		var type_ = event.target.type;
		if ((target_ == "closebutton")   ||
		    (target_ == "acceptbutton" ) ||
		    (target_ == "enableChange" ) ||
		    (target_ == "deletebutton" ) ){
			if ( lastKey == 0 ) {
				document.getElementById(target_).click();
				lastKey = 1;
				setTimeout( "enableKey()", 50 );
			}
			return;
		}
		enableHasChanged();
		callpreValidation();
		if ( lastKey == 0 ) {
			nextFocus();
			lastKey = 1;
			setTimeout( "enableKey()", 50 );
		}
	}
	
	// <TAB>
	if ( (keypress == 9) ) {
		enableHasChanged();
		callpreValidation();
		return;
	}
	
	isEdited = true;		
	return true;

} // onKey() ----------------------------------------------------------------


/**	onKeyUp		Checks every time is up a key 		
	======================================================================*/	

function onKeyUp( event ) {

//	callpreValidation();
	return;
	/* Killed in a version 1.2
	name=event.target.id;
	if( (el[name] ==undefined) || (el[name].dec_!='') ){
		return;
	}
*/
}


/**	onMouseUp		Checks every time is up a mouse button 		
	======================================================================*/	

function onMouseUp( event ) {

	enableHasChanged();
	callpreValidation();

}


/** controlDecimals		Number control to show a correct format
 *	======================================================================*/

function controlDecimals( value, length, dec){
	value+="";

	var negative = false;
	if( (value+0)<0 ){
		negative=true;
		value = value.replace( /-/g, "");
	}
		
	var tmp = value.split('.');
	if( tmp[0]==undefined ){
			tmp[0] = '';
	}
	if( tmp[1]==undefined ){
			tmp[1] = '';
	}

	// Calcule a integer
	var integer = parseInt('0'+tmp[0],10);
	integer+='';
	integer = integer.replace( /,/g, "");
	integer = integer.replace( / /g, "");
	var tmpVal ='';
	for( var i=0; i<3; i++ ){
		if((integer.length%3)!=0){
			integer=' '+integer;
		}
	}
	var count=0;
	for( var i=0; i<integer.length;i++){
		if( (count!=0) && (count%3)==0){
			tmpVal+=',';
		}
		tmpVal+=integer.substr(i,1);
		count++;
	}
	integer=tmpVal;

	// calcule a decimal
	var zero='00000000';
	var decimal = tmp[1]+zero;
	decimal = decimal.substr( 0, dec);
	
	// Define a formated number
	if( dec==0 ){
		var newValue = integer+"";
	}
	else{
		var newValue = integer+'.'+decimal;
	}
	if( negative ){
		newValue="-"+newValue;
	}
	
	tmpVal = '                   '+newValue;
	tmpVal=tmpVal.substr((tmpVal.length)-length,length);
	newValue = tmpVal;
	
	return newValue;
	
} // controlDecimals() -----------------------------------------------------


function enableKey() {
	lastKey = 0;
}

function enableHasChanged(){
	tohasChanged = true;
	clearTimeout(t_has);
	t_has = setTimeout( "disableHasChanged()",300);
}

function disableHasChanged(){
	tohasChanged = false;
}

/**	insertData		Insert a data elements in a formulary					
	======================================================================*/

function insertData ( link, page, obj ) {

	getRef();
	action  = operation;
	session = session_;
	proj    = project_;

	callpreValidation();
	if( !allValid ){	
		return;	
	}
	
	var tmp="";	
	var xtmp='';
	enableValid = 0;
	lockAll = true;

	disableAcceptButton();
	disableBackButton();
	enableMessageButton( MSG_PROCESSING_ );
	setTimeout( "disableAcceptButton()", 50 );
	
	var pass = "";
	var temp = "";
	var value_="";
	for( i=0; i< elName.length; i++ ) {
		var name = elName[i];


		value_ = el[name].get();		
		if ( value_ == undefined){
			temp = "";
		}
		else {
			var temp = value_;
		}
		
		// CHECK FOR AUTONUM VALUE
		if( ( el[name].autonum_ != '' )	&&
			( el[name].options_ =="DB")	){
			temp = '_INSERT_AUTONUM_';
		}
	
		// Check if is a [ INSERT ]
		if ( temp == "[ INSERT ]" ) {
			var ok = false;
			var text = MSG_INS_  + name + ")"; 
			temp = prompt ( text );
		}
		
		temp +="";
		temp = temp.replace( /,/g, "wWx");
		temp = temp.replace( /\+/g, "wWz");
		temp = temp.replace( /\\/g, "wWw");

		// Check if is NODB
		if ( el[name].nodb_ != "" ) {
			// do nothing
		}
		else {
			pass += name + "," + escape(temp) + ",";
xtmp+=name+' = '+temp+"\n";			
		}
	
	}
	try{
		obj = el['name'].get();
	}
	catch(e){

// ##### 16 
		if( obj=='' ){
			obj = db('id');
		}

// OLD in 16		obj = "";
// ##### 16 end

	}

// ONLY TO DEBUG
//alert(xtmp);
	// Start a transaction if exist procedures 
	if( PROC_INSERT_ != "" ){
		inTrans = true;
		el[elName[0]].validate( BEGIN_, BEGIN_,"", "", "" );
	}
	el[elName[0]].validate( action, link, "", obj, pass + "_0_,end" );
// ONLY TO DEBUG
//alert('Action: '+action+',\nLink: '+ link+',\nObj: '+obj+',\nPass: '+ pass + "\n_0_,end" );
    
	// Prepare a list of procedures
	if( PROC_INSERT_ != "" ){
	    listProc = PROC_INSERT_.split("##");    	
	    for( var i=0; i<listProc.length; i++ ){
			 var query=evaluate(listProc[i]);
 			el[elName[0]].validate( QUERY_, QUERY_, "","", query );
 			for( var x=0; x<10000; x++ ){ 
 				var xx ="timelost";
 			}
    	}
    	// And force a COMMIT after all
		el[elName[0]].validate( COMMIT_, COMMIT_,"", "", "" );

	}
	
//##### 29	
	// Prepare to insert 
	startScreen=1;
	el[elName[0]].validate( EXECUTE_, "reloadToInsert()" );

return;	


/* OLD IN 29	
	if( ( operation == INS_DATA_ )	||
		( operation == INSERT_ELEM_ )	){
		el[elName[0]].validate( EXECUTE_, "window.location.reload()" );
	} 

	prepare_reload();
	el[elName[0]].validate( EXECUTE_, "reload_()" );
*/ 
// ##### 29 end

} // insertData() ----------------------------------------------------------




/** reloadToInsert		Reload a variables after insert data							
	======================================================================*/

function reloadToInsert () {
	enableValid = 1;
	lockAll = false;
	var clear = document.getElementById("rows");
	while( clear.childNodes.length>0 ) {
		for( var i=0; i < clear.childNodes.length; i++ ) {
			 clear.removeChild(clear.childNodes[i]);
			 for( var timeless=0; timeless<1000; timeless++ ){
				// do nothing
			 }
		}
  	}
	for( var timeless=0; timeless<1000; timeless++ ){}
	setStartVar();
	for( var timeless=0; timeless<1000; timeless++ ){}
	startPage();	
	for( var timeless=0; timeless<1000; timeless++ ){}
	enableAcceptButton();
	enableBackButton();
	disableMessageButton();
	for( var timeless=0; timeless<1000; timeless++ ){}
			 
	setTimeout( "enableAcceptButton()", 100 );
	startScreen=0;

} // reloadToInsert() ------------------------------------------------------




/** enableChange		Enable a changes in a data							
	======================================================================*/

function enableChange () {
	
	operation = CHANGE_;
	document.getElementById("enableChange").setAttribute("hidden","true");
	try{
		document.getElementById("deletebutton").setAttribute("hidden","true");
	}
	catch(e){
		operation = CHANGE_;
	}
	for ( i=1; i< elName.length; i++ ) {
		// Check Trustee to show
		if ( haveTrustee( el[elName[i]].trust_show_ ) ) {
			document.getElementById(elName[i]).removeAttribute("readonly");
		}
		// Check Trustee to change
		if ( ! haveTrustee( el[elName[i]].trust_chg_ ) ) {
			document.getElementById(elName[i]).setAttribute("hidden","true");
			document.getElementById("lbl_"+elName[i]).setAttribute("hidden","true");
		}
		
		// Condition to change
		if( ( el[elName[i]].cchg_ != "" )	&&
			( !evaluate(el[elName[i]].cchg_)) ){
			document.getElementById(elName[i]).setAttribute("readonly","true");
		} 
		if( el[elName[i]].options_ == "DB" )	{
			document.getElementById(elName[i]).setAttribute("readonly","true");
		} 
	}
	actualFocus = 0;
	nextFocus();

} // enableChange()---------------------------------------------------------


/** changeData		Change a Data in a database								
	======================================================================*/

function changeData ( link, page, obj ) {
	
	getRef();
	lockAll = true;

	disableAcceptButton();
	disableBackButton();
	enableMessageButton( MSG_PROCESSING_ );
	
	// Check if is a normal or special operation
	if ( acceptMode == -1 ) {
		action  = operation; // normal
	}
	else {
		action = acceptMode; // special
	}
	session = session_;
	proj    = project_;
	
	var pass = "";
	var temp = "";
	var value_="";
	for( i=0; i< elName.length; i++ ) {
		var name = elName[i];
		value_ = el[name].get();	
		if( el[name].type_ == "password") {
			value_ = document.getElementById(name).value;
		}
		if ( value_ == undefined){
			temp = "";
		}
		else {
			var temp = value_;
		}
		
		
		// Check if is a [ INSERT ]
		if ( temp == "[ INSERT ]" ) {
			var ok = false;
			var text = MSG_INS_ + name + ")"; 
			temp = prompt ( text );
		}
		
		temp+="";
		temp = temp.replace( /,/g, "wWx");
		temp = temp.replace( /\+/g, "wWz");
		temp = temp.replace( /\\/g, "wWw");
		temp = temp.replace( /\"/g, "\\\"");

		// Check if is NODB
		if ( el[name].nodb_ != "" ) {
			// do nothing
		}
		else {
			pass += name + "," + escape(temp) + ",";
		}
	
	}

	// Start a transaction if exist procedures 
	if( PROC_CHANGE_ != "" ){
		inTrans = true;
		el[elName[0]].validate( BEGIN_, BEGIN_,"", "", "" );
	}
	el[elName[0]].validate( action, link, "", obj, pass + "_0_,end" );
    
	// Prepare a list of procedures
	if( PROC_CHANGE_ != "" ){
	    listProc = PROC_CHANGE_.split("##");    	
	    for( var i=0; i<listProc.length; i++ ){
			 var query=evaluate(listProc[i]);
 			el[elName[0]].validate( QUERY_, QUERY_, "","", query );
 			for( var x=0; x<10000; x++ ){ 
 				var xx ="timelost";
 			}
    	}
    	// And force a COMMIT after all
		el[elName[0]].validate( COMMIT_, COMMIT_,"", "", "" );

	}
	if( ( acceptMode == CHG_DATA_ )	||
		( acceptMode == EDIT_CHANGE_ )	){
		isEdited = false;
		el[elName[0]].validate( EXECUTE_, "goBack()" );
	} 
	isEdited = false;
	el[elName[0]].validate( EXECUTE_, "goBack()" );

} // changeData()-----------------------------------------------------------


																			
/**	consult			Consult formulary										
	======================================================================*/
function consult ( action, session, proj, link, page, obj ) {
		
	var tmp="";	

	enableValid = 0;
	lockAll = true;
	disableAcceptButton();
	disableBackButton();
	enableMessageButton( MSG_PROCESSING_ );
	
	var pass = "";
	var temp = "";
	var value_="";
	var filter = "";
	for( i=0; i< elName.length; i++ ) {
		var name = elName[i];

		value_ = el[name].get();
		
		if ( value_ == undefined){
			temp = "";
		}
		else {
			var temp = value_;
		}
		
		temp +="";
		temp = temp.replace( /,/g, "wWx");
		temp = temp.replace( /\+/g, "wWz");
		temp = temp.replace( /\\/g, "wWw");

		// Check if is NODB
		if ( el[name].nodb_ != "" ) {
			// do nothing
		}
		else {
			if ( temp != "" ) {
				filter += name + " LIKE " + escape('"' + temp + '"') + " AND ";
			}
		}
	
	}
	
	filter += 'id LIKE "%"';
	obj += "&pass=" + filter;

	callNew( action, session, proj, link, page, obj );

} // consult() -------------------------------------------------------------



/**	deleteForm		Delete a Formulary										
	======================================================================*/
function deleteForm( action, session, proj, link, page, obj ) {
	if ( confirm ( MSG_DELETE_ )) {
		rpc_operation = DELETE;
		el[elName[0]].validate( action, link, "", obj, "" );
		top.opener.close();	
		setTimeout("self.close()",100);
		el[elName[0]].validate( EXECUTE_, "self.close()" );
	}
} // deleteForm() ----------------------------------------------------------


/**	deleteRecord		Delete a Record										
	======================================================================*/
function deleteRecord( action, session, proj, link, page, obj ) {
	if ( confirm ( MSG_DELETE_ )) {
		enableMessageButton('Procesando Datos! Aguarde, por favor!');
		enableValid = 0;
		lockAll = true;
		disableBackButton();
		disableChangeButton();
		disableDeleteButton();
		rpc_operation = DELETE_;

		// Start a transaction if exist procedures 
		if( PROC_DELETE_ != "" ){
			inTrans = true;
			el[elName[0]].validate( BEGIN_, BEGIN_,"", "", "" );
		}
		el[elName[0]].validate( action, link, '', obj, '' );
	    
		// Prepare a list of procedures
		if( PROC_DELETE_ != "" ){
		    listProc = PROC_DELETE_.split("##");    	
		    for( var i=0; i<listProc.length; i++ ){
				 var query=evaluate(listProc[i]);
				el[elName[0]].validate( QUERY_, QUERY_, "","", query );
	 			for( var x=0; x<10000; x++ ){ 
	 				var xx ="timelost";
	 			}
	    	}
	    	// And force a COMMIT after all
			el[elName[0]].validate( COMMIT_, COMMIT_,"", "", "" );
		}
 
		if( ( acceptMode == CHG_DATA_ )	||
			( acceptMode == EDIT_CHANGE_ )	){
			isEdited = false;
			el[elName[0]].validate( EXECUTE_, "goBack()" );
		} 
		isEdited = false;
		el[elName[0]].validate( EXECUTE_, "goBack()" );
	}
} // deleteRecord() ---------------------------------------------------------  



/**	goBack()		Go to Back on the page									
	======================================================================*/
	
function goBack() {
	
	previous = window.opener;
	if ( previous != undefined ) {
		previous.location.reload();
	}
	if ( isEdited == true ) {
		if ( ! confirm ( QST_GOBACK_ )) {
			return;
		}
	}	
	
	setTimeout( "self.close()", 100 );
	self.close();

} // goBack() --------------------------------------------------------------

// ##### 10 - Force a INSERT procedure
/**	forceInsert()		Force a Insert Process								
	======================================================================*/
	
function forceInsert() {
	
	document.getElementById('acceptbutton').click()
// OLD IN #### 29	
//	previous = window.opener;
//	if ( previous != undefined ) {
//		previous.location.reload();
//	}
//	setTimeout( "self.close()", 1000 );
// #### 29 end

} // forceInsert() --------------------------------------------------------


// ##### 10


															
/**	error		Makes a alert error message									
==========================================================================*/	
function error ( text, time ) {
	if( enableError == 1 ) {
		alert( text );
		enableError =0;		
		setTimeout( 'enError()', 10000 );
		enableValid = 0;
		if( time != undefined ) {
			setTimeout( "nextFocus("+ time +")", 3000 );
		}
		return false;
	}
} // error() ---------------------------------------------------------------


/**	enError			Permit a error message system							
==========================================================================*/	
function enError () {
	enableError = 1;
} // enError() -------------------------------------------------------------


/**	enFocus			Permit a nextFocus system								
==========================================================================*/	
function enFocus () {
	enableFocus = 1;
} // enFocus() -------------------------------------------------------------

	
/** diffDate		Return a difference betwen two dates
==========================================================================*/
function diffDate( first, second ){

	// Check the format of the date
	// Normal format
	if( (first.substr(2,1) == "-" ) &&
		(first.substr(5,1) == "-" ) ){
		var fday   = parseInt( first.substr(0,2),10);
		var fmonth = (parseInt( first.substr(3,2),10))-1;
		var fyear  = parseInt( first.substr(6,4),10);
	}
	// SQL Format
	else {
		var fday   = parseInt( first.substr(8,2),10);
		var fmonth = (parseInt( first.substr(5,2),10))-1;
		var fyear  = parseInt( first.substr(0,4),10);
	}

	// Check the format of the date
	// Normal format
	if( (second.substr(2,1) == "-" ) &&
		(second.substr(5,1) == "-" ) ){
		var sday   = parseInt( second.substr(0,2),10);
		var smonth = (parseInt( second.substr(3,2),10))-1;
		var syear  = parseInt( second.substr(6,4),10);
	}
	// SQL Format
	else {
		var sday   = parseInt( second.substr(8,2),10);
		var smonth = (parseInt( second.substr(5,2),10))-1;
		var syear  = parseInt( second.substr(0,4),10);
	}
	
	var oneMinute	= 60 * 1000;
	var oneHour		= oneMinute * 60;
	var oneDay		= oneHour * 24;
	var firstDate  = new Date( fyear, fmonth, fday );
	var secondDate = new Date( syear, smonth, sday );
	var diff = 0;
	diff = firstDate.getTime() - secondDate.getTime();
	diff = Math.floor(diff/oneDay);
	return diff;
}// diffDate() -------------------------------------------------------------
	
/** sumDays		Return a specified date summed to a number of days
==========================================================================*/
function sumDays( first, days ){

	// Check the format of the date
	// Normal format
	if( (first.substr(2,1) == "-" ) &&
		(first.substr(5,1) == "-" ) ){
		var fday   = parseInt( first.substr(0,2),10);
		var fmonth = (parseInt( first.substr(3,2),10))-1;
		var fyear  = parseInt( first.substr(6,4),10);
	}
	// SQL Format
	else {
		var fday   = parseInt( first.substr(8,2),10);
		var fmonth = (parseInt( first.substr(5,2),10))-1;
		var fyear  = parseInt( first.substr(0,4),10);
	}
	var firstDate  = new Date( fyear, fmonth, fday );
	var sum = firstDate;
	var actual = firstDate.getDate();
	sum.setDate( actual + days ); 
	var day = sum.getDate();
	var month = sum.getMonth()+1;
	var year = sum.getFullYear();
	if( day < 10 ){
		day = '0' + day;
	}
	if( month < 10 ){
		month = '0' + month;
	}
	return day + '-' + month + '-' + year;
}// sumDays() --------------------------------------------------------------


/** sumMonths		Return a specified date summed to a number of months
==========================================================================*/
function sumMonths( first, months ){

	// Check the format of the date
	// Normal format
	if( (first.substr(2,1) == "-" ) &&
		(first.substr(5,1) == "-" ) ){
		var fday   = parseInt( first.substr(0,2),10);
		var fmonth = (parseInt( first.substr(3,2),10))-1;
		var fyear  = parseInt( first.substr(6,4),10);
	}
	// SQL Format
	else {
		var fday   = parseInt( first.substr(8,2),10);
		var fmonth = (parseInt( first.substr(5,2),10))-1;
		var fyear  = parseInt( first.substr(0,4),10);
	}
	var firstDate  = new Date( fyear, fmonth, fday );
	var sum = firstDate;
	var actual = firstDate.getMonth();
	sum.setMonth( actual + months ); 
	var day = sum.getDate();
	var month = sum.getMonth()+1;
	var year = sum.getFullYear();
	if( day < 10 ){
		day = '0' + day;
	}
	if( month < 10 ){
		month = '0' + month;
	}
	return day + '-' + month + '-' + year;
}// sumMonths() ------------------------------------------------------------


/** db 	Returns a value of a last RPC call a db whith a column specification
==========================================================================*/
function db( variable ){
	if( typeof dbData[variable] == "undefined" ){
	    return( "" );
	}
	else {
	    return dbData[variable];
	}
}


/** unique		Returns a unique numbers
==========================================================================*/
function unique(){
	var day_=new Date();
	return( day_.getTime() );	
} // unique() --------------------------------------------------------------



/** setValue()	Sets a value to a variable
==========================================================================*/
function setValue( variable, value ){
	document.getElementById(variable).value  = value;
	document.getElementById(variable).value_ = value;
	el[variable].value = value;
	el[variable].value_= value;
// ##### old in 29	el[variable].value = value_;
} // setValue() ------------------------------------------------------------


