<?php


/** plusexec.php		Interpreter to a plus system
 *  ================================================
 *
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	May, 30 of 2005
 *
 
   
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
 

 
/** System Definitions
 */

error_reporting(E_ALL ^ E_NOTICE);
$print_	= $_GET['print'];
$action = $_GET['action'];

if( (!$print_) && 
	($action<>"50") ){
	header ("Content-type: application/vnd.mozilla.xul+xml; charset=iso-8859-1");
	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?> ";
	echo "<?xml-stylesheet href=\"chrome://global/skin/\" type=\"text/css\"?>";
}

// Load a common functions
include_once ( "include/functions.php" );

// Load a Engine class
include_once ( "include/Y_Engine.class.php" );

// Configure a multilanguage system 
if ( file_exists( "config/Y_Language_Config.php" )) {
    include_once ( "config/Y_Language_Config.php");
}

// Starting Template
include_once ("include/Y_Template.class.php");   
if( (!$print_) && 
	($action<>"50") ){
	
// ##### 13	
	if ( file_exists( "templates/base.xul" )) {
		$T = new Y_Template( "templates/base.xul" );
	}
	if ( file_exists( "templates/base.xul.html" )) {
		$T = new Y_Template( "templates/base.xul.html" );
	}

// OLD in 13	$T = new Y_Template( "templates/base.xul" );
// ##### 13 end

	$T->Show('xml_header');
}
else{
	$T = new Y_Template( "templates/form.html" );
}
$T->LanguageVariables();

// Date definition
setlocale(LC_ALL, LOCALE_ );
$date = strftime( DATEFORMAT_, time() );

 

// Constants definitions
define( 'MENU_ONLY_',	0 );
define( 'BROWSE_',		1 );
define( 'SHOW_',		2 );
define( 'DELETE_', 		3 );
define( 'CHANGE_', 		4 );
define( 'INSERT_',		5 );
define( 'INT_PROC_',	6 );
define( 'INS_DATA_',	7 );		
define( 'VIEW_DATA_',	8 );		
define( 'CHG_DATA_',	9 );		
define( 'DELETE_FRM_',	10);		

define( 'EDIT_BROWSE_', 15);		
define( 'EDIT_SHOW_',	16);		
define( 'EDIT_CHANGE_',	17);		
define( 'EDIT_DELETE_',	18);		

define( 'CONSULT_', 	20);		
define( 'BROW_CONS_',	21);		

define( 'INS_ELEM_', 	30);		
define( 'INSERT_ELEM_',	31); 		

define( 'REPORT_',		50);		

// System Definitions -------------------------------------------------------

// Select a project
$project = $_GET[project];
if (empty( $project )) {
	echo "NO PROJECT!!!!";
	die();
}

// Database Abstration Layer
include_once "include/Y_DB.class.php";
$DB = new Y_DB();

// Atribute a database
$DB->Database = $project;

$session = $_GET['sess'];
$sel	 = $_GET['sel'];
$link	 = $_GET['link'];
$page	 = $_GET['page'];
$object  = $_GET['obj'];

$version = $_GET[v];
$Global = start_session( $session, $version );
$Global[ 'project' ] = $_GET['project'];

$pgc 	 = $_GET[pgc];		
$temp = explode( ',', $pgc . ',' );
if( $temp[1] == 0 ) {
	$temp[1] = 26;		
}
$Global['pgc'] = ($temp[0]+0).','.($temp[1]+0);
$Global['localTable'] = '';

//echo "\n\n\n<!--".$Global['pgc']."-->\n\n";


define( "Y_LANGUAGE_1", $Global['lang'] );     



//$Global = start_session( $session );
$Global[ 'page' ] = $page;
$Global[ 'oper' ] = $action;
$Global['acceptMode'] = $action;
$Global['proc_insert'] = "";
$Global['proc_change'] = "";
$Global['proc_delete'] = "";

$Global['filter'] = stripslashes( $_GET[pass] );

$Global['sup']    = $_GET[sup];	
$Global['print' ] = $print_;				
$temp = explode ( ".", $link );
$link_type = $temp[0];
$link_name = $temp[1];
if ( ! empty($temp[2]) ) {
	$link_name.=".";
	$link_name.=$temp[2];
}
$Global['link'] = $temp[1];
$Global['full_link'] = $link;

if ( !empty ( $sel ) ) {
	$temp = explode ( "`", $sel );
//	alert($sel);
//	alert( $temp[0] . $temp[1] );
	if ( $temp[0] == "subform" ) {
		$Global['subform'] = "subform`" . $temp[1];
		$Global['send']= $temp[1];
	}
}
$T->Set( 'name', $Global['link'] );
if( (!$print_) && 
	($action<>"50") ){
	$T->Show( 'start_xul' );
}
else{
	$T->Show( 'start_html' );
}

if( $action != "50" ){
	includeJs( 'functions.js' );
}
	
// Referrer Control
$ref = getenv( 'HTTP_REFERER' );
if( (strpos( $ref, "plus") <2) && ( $action != 20 ) ){
	$T->Show( 'illegal_access');
	$T->Show( 'end_xul');
	die();
}

// ##### 30
// A statistics control
/*
if( strpos( $ref, "plus.php") >2) {
				
	// Check if it's a online
	
	@ $online = fsockopen( "www.ycube.net", 80, $errNo, $errStr, 1 );
	if( !empty( $online ) ){
		$online = 1;
		$offline = 0;
	}
	else{
		$online = 0;
		$offline = 1;
	}
	// Checking a statistics Table
	$DBx = new Y_DB();
	$DBx->Database = $DBx->GenData;

	$qry='CREATE TABLE IF NOT EXISTS p_sts ( ' . 
		 'id 	INT 	UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, ' .
		 '_number		VARCHAR(30), ' .
		 '_on_execs		INTEGER, ' .
		 '_off_execs	INTEGER, ' .
		 '_x1			INTEGER, ' .
		 '_x2			INTEGER, ' .
		 '_x3			INTEGER, ' .
		 '_y1			VARCHAR(20), ' .
		 '_y2			VARCHAR(20), ' .
		 '_y3			VARCHAR(20) ) TYPE=INNODB;';
	$DBx->Query( $qry );
	
	$DBx->Query( 'SELECT * FROM p_sts LIMIT 1' );
	$DBx->NextRecord();
	$number=$DBx->Record['_number'];
	$projects=$DBx->Record['_x2'];
	$numVersion=$DBx->Record['_y2'];
	
	// ##### 31
	// Check a number of projects
	$direct = opendir("./project");
	$numProj = 0;
	$list=readdir($direct);
	while( $list ){
	$list=readdir($direct);
		$numProj++;
	}
	$numProj-=2;
	
	if ( empty( $DBx->Record ) ) {
		$number = microtime();
		$DBx->Query( 'INSERT INTO p_sts ' . 
					'VALUES ( 0,"'. $number .
					'", 0,0,0,0,0,"","","" ) ');
	} 
	$_on_execs=$DBx->Record['_on_execs']+$online;
	$_off_execs=$DBx->Record['_off_execs']+$offline;
	$_version = explode( "|", $version);
	$DBx->Query( 'UPDATE p_sts SET ' . 
				 '_x2 = '. $numProj . ', '.
				 '_y2 = "'. $_version[0] . '", '.
				 '_on_execs = '. $_on_execs . ', '.
				 '_off_execs = '. $_off_execs );
	if( ($projects != $numProj) || ($numVersion!=$_version[0]) ){
		$_URL = "http://www.ycube.net/plusRPC.php?number=".
		$number."&amp;online=".$_on_execs."&amp;offline=".
		$_off_execs."&amp;y2=".$_version[0]."&amp;x2=".$numProj;				
		//$T->Set( 'URL', $_URL );
	}
				
}  */
// # 30 end


// Make a menu
if( !$print_ ){

// ##### 13 
	if ( file_exists( "templates/form.xul" )) {
		$TF = new Y_Template( "templates/form.xul" );
	}
	if ( file_exists( "templates/form.xul.html" )) {
		$TF = new Y_Template( "templates/form.xul.html" );
	}

// OLD in 13	$TF = new Y_Template( "templates/form.xul" );
// ##### 13 end	
	
	include_once "plusmenu.php";
	if (( $action != INT_PROC_ ) &&
		( empty($sel) )) {
		show_menu();
	}
}
else{
	$TF = new Y_Template( "templates/form.html" );	$Obj = new Y_Engine();
	$file = "project/" . $Global['project'] . "/data.menu__.base.php";
	include_once ( $file );
	$T->Set( 'version', $Global['version'] );
	$T->Set( 'user'		, $Global['username'] ) ;
	$T->Set( 'name'  	, $Obj->GetAlias());
	$TF->Set( 'version', $Global['version'] );
	$TF->Set( 'user'		, $Global['username'] ) ;
	$TF->Set( 'name'  	, $Obj->GetAlias());
	$temp   = time();
	$year   = strftime( "%y", $temp );
	$month  = strftime( "%m", $temp );
	$day    = strftime( "%d", $temp );
	$hour   = strftime( "%H", $temp );
	$minute = strftime( "%M", $temp );
	$T->Set( 'time', $day."/".$month."/".$year."-".$hour.":".$minute);
	$TF->Set( 'time', $day."/".$month."/".$year."-".$hour.":".$minute);
//	$T->Show( 'header' );
}


switch ( $action ) {


  // If is only to show a menu, this do nothing
  case MENU_ONLY_:
  		break;
		
  // Browse a content of an object
  case BROWSE_:
  
  		ShowFunction( "browse");
		browse( $link_name, $link_type);
		break;
		
  // Make a report with an object
  case REPORT_:
  
  		ShowFunction( "report");
		report( $link_name, $link_type);
		break;
		
  // Browse a content of an object, but with a consult parameters
  case BROW_CONS_:
		ShowFunction( "browse");
		browse( $link_name, $link_type);
		break;
		
		
  // Show a content of an object		
  case SHOW_:
		includeJs( 'form_engine.js' );
   		ShowFunction( "show");
 		show( $link, $link_type, $object );
		break;

  // Insert a new content to an object 	
  case INSERT_:
		includeJs( 'form_engine.js' );
   		ShowFunction( "insert");
  		insert( $link, $link_type );
		break;
		
  // Consult	
  case CONSULT_: 		
		ShowFunction( "consult");
		includeJs( 'form_engine.js' );
   		consult( $link, $link_type );
		break;
		
		
  // Insert a new element to an DB form 	
  case INS_ELEM_:
		includeJs( 'form_engine.js' );
  		ShowFunction( "ins_elem");
  		ins_elem( $link, $link_type );
		break;
  
  // Browse a content of an object in a DB form
  case EDIT_BROWSE_:
		includeJs( 'form_engine.js' );
  		ShowFunction( "edit_browse");
		edit_browse( $link_name, $link_type);
		break;
  // Show a content of an object in a DB Form
  case EDIT_SHOW_:
 		includeJs( 'form_engine.js' );
  		ShowFunction( "edit_show");
 		edit_show( $link, $link_type, $object );
		break;


  // Insert a new content to a formulary
  case INS_DATA_:
		includeJs( 'form_engine.js' );
  		ShowFunction( "insert_data");
  		insert_data( $link, $link_type );
		break;
  
  // Change a property of formulary
  case VIEW_DATA_:
		includeJs( 'form_engine.js' );
  		ShowFunction( "view_data");
  		view_data( $link, $link_type );
		break;
		
  // Internal Procedure
  case INT_PROC_:
//		includeJs( 'form_engine.js' );
		if( !$print_ ){
 			ShowFunction( $link );	
			$link();
		}
		break;
					
  default:
      die ( "Invalid code action in input of page (plusexec)");
	  	  
} 

if( $Global['print'] ){
	$T->Show('end_html');
}
else{
	$T->Show('end_xul'); 
}

// --------------------------------------------------------------------------
 
 
 

/** browse		Browse a object
 * 	====================================================
 *
 * @param		$link_name		name of the link (object)
 * @param		$link_type		type of link
 * 
 */

function browse ( $link_name, $link_type ) {

	global $T, $DB, $TF, $Global;
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link_name ) ) {
		$T->Set(  'error', "EMPTY LINK_NAME (plusexec:browse)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}

	// REPORT FORM	
	if ( $link_type == "rep" ) {
		$Obj->Make_Report();
		return;
	} 
	
	
	// Localize a object - Priority to a system object (engine)
	if ( file_exists( "engine/".$Global['lang']."/" . $link_type . "." . $link_name . ".php" ) ) {
		$file = "engine/".$Global['lang']."/" . $link_type . "." . $link_name . ".php";
	}
	else {
		$file = "project/".$Global['project']."/".$link_type.".".$link_name.".php";
	}
	if ( file_exists( $file )) {
		include ( $file );
	}
	else {
		$T->Set(  'error', "FILE $file DON'T EXIST (plusexec:browse)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}
	
	// To control a filter if is a consult
	if ( ! empty ( $Global['filter'] ) ) {
		$Obj->Filter = $Global[ 'filter' ];
	}
	
	// Browse accordly type of form
	
	// DEFINITION FORMULARY
	// ====================
	if ( $link_type == "def" ) {
		$Obj->Browse_Def();
		return;
	} 

	
	// DATA FORMULARY
	// ==============
	if ( $link_type == "data" ) {

		// New callbutton control ----------
		$Global['localTable'] = $Obj->File;
		$Global['acceptMode'] = INSERT_;
		$Obj->Browse_Data( $object );
		$TF->Show('hbox_start');

		backButton();
		propertyButton('onclick="callNew(' . VIEW_DATA_ . ','."'". 
		 		$Global[ 'session']."'".','."'".$Global['project']. 
		 		"','". $Global['full_link'] . "','" . $Global['page'] .
				"','". $object . "'" . ');"');
		insertButton('onclick="callNew(' . INSERT_ . ','."'". 
		 		$Global[ 'session']."'".','."'".$Global['project']. 
		 		"','". $Global['full_link'] . "','" . $Global['page'] .
				"','". $object . "'" . ');"');
		$TF->Show('hbox_stop');
		// ----------------------------------
		
		
		return;
	} 


	
	// DB FORMULARY
	// ============
	if ( $link_type == "db" ) {


		// Page broser control (pgc)
		$temp = explode( ',', $Global['pgc']);
		$start_browse = $temp[0]+0;
		
		
		// ##### 23
		// A Inheritance resource
		if( !empty($Obj->Inheritance) ){
			include( "project/".$Global['project']."/db.".$Obj->Inheritance.".php");
			include( "project/".$Global['project']."/".$link_type.".".$link_name.".php");
			
//print_r( $Obj );
//die();

			
			
		}
		// ##### 23
				
		
		if( $Obj->Limit != "" ){
			$limit_browse = $Obj->Limit;	
		}
		else{
			$limit_browse = $temp[1]+0;	
		}
		$next_browse  = $start_browse+$limit_browse;

		// New callbutton control ----------
		$Global['localTable'] = $Obj->File;
		$Global['acceptMode'] = INSERT_;
		$Global['numRows'] = 0;
		$Obj->Browse_DB( $object );
		$TF->Show('hbox_start');
		
		
		if ( empty( $Global['subform'] ) ) {
			backButton();
		}

		$tmp = explode( '-', $Global['page']);
		$tmp[0]+=0;

		if( ( $tmp[0] < 99999 ) &&	
			( $Obj->NoInsert == "" ) 		){
			

// ##### 24 - clearEnter to a Superior variable
			echo "<script>var Superior=\"" . clearEnter($Global['sup']).
			"\"</script>\n";			
/*			echo "<script>var Superior=\"" . clearEnter($Global['sup']).
			"\"</script>\n";			
*/
// ##### 24 end

			insertButton('onclick="callNew(' . INSERT_ . ','."'". 
			 		$Global[ 'session']."'".','."'".$Global['project']. 
			 		"','". $Global['full_link'] . "','" . $Global['page'] .
					"','". $object . "','" . $Global['subform'] .
					"',Superior"  . ')"');
		}

		// Next Button
		
		if( $Global['numRows'] == $limit_browse ){
			nextButton('onclick="callNew(' . BROWSE_ . ','."'". 
			 		$Global[ 'session']."'".','."'".$Global['project']. 
			 		"','". $Global['full_link'] . "','" . $Global['page'] .
					"','". $object . "','" . $Global['subform'] .
					"',Superior,'" . $next_browse.','. $limit_browse . "'".
					','. "'".urlencode($Global['filter'])."'".')"');
		}

		$TF->Show('hbox_stop');
		// ----------------------------------
	
		
		return;
	} 
	
	
	$T->Set(  'error', "TYPE $link_type UNKNOW (plusexec:browse)");
	$T->Show( 'error' );
	$T->Show( 'end_xul' );
	die();
	

} // browse() ---------------------------------------------------------------



/** report		Makes a report
 * 	====================================================
 *
 * @param		$link_name		name of the link (object)
 * @param		$link_type		type of link
 * 
 */

function report ( $link_name, $link_type ) {

	global $T, $DB, $TF, $Global;
	
	$TF = new Y_Template( "templates/form.html" );

	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link_name ) ) {
		$T->Set(  'error', "EMPTY LINK_NAME (plusexec:report)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}
	
	$file = "project/".$Global['project']."/reports/".
			$link_type . "." . $link_name . ".php";
	if ( file_exists( $file )) {
		include ( $file );
	}
	else {
		$T->Set(  'error', "FILE $file DON'T EXIST (plusexec:report)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}
	
	// To control a filter if is a consult
	if ( ! empty ( $Global['filter'] ) ) {
		$Obj->Filter = $Global[ 'filter' ];
	}
	
	// Browse accordly type of form
	
	$Obj->makeReport();
	
	
	$T->Set(  'error', "TYPE $link_type UNKNOW (plusexec:report)");
	$T->Show( 'error' );
	$T->Show( 'end_xul' );
	die();
	

} // report() --------------------------------------------------------------


/** EDIT_browse		Browse a formulary to edition
 * 	=============================================
 *
 * @param	$link_name		name of the link (object)
 * @param	$link_type		type of link
 * 
 */

function edit_browse ( $link_name, $link_type ) {

	global $T, $DB, $TF, $Global;
	
	if( $Global['print'] ){
		$TF = new Y_Template( "templates/form.html" );
	}
	else{
	
// ##### 13 
		if ( file_exists( "templates/form.xul" )) {
			$TF = new Y_Template( "templates/form.xul" );
		}
		if ( file_exists( "templates/form.xul.html" )) {
			$TF = new Y_Template( "templates/form.xul.html" );
		}
	
// OLD in 13	$TF = new Y_Template( "templates/form.xul" );
// ##### 13 end	
	

	}
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link_name ) ) {
		$T->Set(  'error', "EMPTY LINK_NAME (plusexec:browse)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}

	// Localize a object - Priority to a system object (engine)
	if ( file_exists( "engine/".$Global['lang']."/" . $link_type . "." . $link_name . ".php" ) ) {
		$file = "engine/".$Global['lang']."/" . $link_type . "." . $link_name . ".php";
	}
	else {
		if( $link_type=='rep' ){
			$file = "project/".$Global['project']."/reports/".
			$link_type.".".$link_name.".php";
		} else {
			$file = "project/".$Global['project']."/".$link_type.
			".".$link_name.".php";
		}
	}
	if ( file_exists( $file )) {
		include ( $file );
	}
	else {
		$T->Set(  'error', "FILE $file DON'T EXIST (plusexec:browse)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}
	
	
	// Browse accordly type of form
	
	// DB FORMULARY
	// ==============
	$Obj->Browse_DB_Form();

	$TF->Show('hbox_start');
	
	// Make a Back Button	
	$TF->Set('name', "Volver" );
	$TF->Set('help', 'Cerrar la vista actual');
	$TF->Show('close_button');
	
	// Make a Property Button	
	$TF->Set('command','onclick="callNew(' . VIEW_DATA_ . ','."'". 
			$Global[ 'session']."'".','."'".$Global['project']. 
			"','". $Global['full_link'] . "','" . $Global['page'] .
			"','". $object . "'" . ');"');
	$TF->Set('name', "Propiedades" );
	$TF->Set('help', 'Propiedades Comunes a los elementos listados');
	$TF->Show('property_button');

	// Make a Insert Button	
	$TF->Set('command','onclick="callNew(' . INS_ELEM_ . ','."'". 
			$Global[ 'session']."'".','."'".$Global['project']. 
			"','". $Global['full_link'] . "','" . $Global['page'] .
			"','". $object . "'" . ');"');
	
	$TF->Set('name', "Insertar" );
	$TF->Set('help', 'Insertar nuevo elemento');
	$TF->Show('insert_button');
		
	$TF->Show('hbox_stop');
	
	return;
/* Killed in a 1.2 version
	
	$T->Set(  'error', "TYPE $link_type UNKNOW (plusexec:browse)");
	$T->Show( 'error' );
	$T->Show( 'end_xul' );
	die();
	*/

} // edit_browse() ----------------------------------------------------------


/** edit_show		show a object to edit a form
 * 	====================================================
 *
 * @param		$link		name of the link (reference of object)
 * @param		$link_type	type of link
 * @param		$object		Selected object
 * 
 */

function edit_show ( $link, $link_type, $object ) {

	global $T, $DB, $TF, $Global;
	
// ##### 13 
//	$TF = new Y_Template( "templates/form.xul" );
	if ( file_exists( "templates/form.xul" )) {
		$TF = new Y_Template( "templates/form.xul" );
	}
	if ( file_exists( "templates/form.xul.html" )) {
		$TF = new Y_Template( "templates/form.xul.html" );
	}

// OLD in 13	$TF = new Y_Template( "templates/form.xul" );
// ##### 13 end	
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link ) ) {
		$T->Set(  'error', "EMPTY LINK_NAME (plusexec:edit_show)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}

	// Localize a object - Priority to a system object (engine)
	$tmp = explode('.',$Global['full_link']);
	$formType = $tmp[0];
	if ( file_exists( "engine/".$Global['lang']."/" . $link . ".php" ) ) {
		$file = "engine/".$Global['lang']."/" . $link . ".php";
	}
	else {
		if( $formType == 'rep' ){
			$file = "project/".$Global['project']."/reports/".$link.".php";
		} else {
			$file = "project/".$Global['project']."/".$link.".php";
		}
	}
	if ( file_exists( $file )) {
		include ( $file );
	}
	else {
		$T->Set(  'error', "FILE $file DON'T EXIST (plusexec:show)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}
			
	// New callbutton control ----------
	$Global['localTable'] = $Obj->File;
	$Global['acceptMode'] = EDIT_CHANGE_;
	$Obj->Show_Data_DB( $object );
	$TF->Show('hbox_start');

	backButton();
	enableChangeButton();
	acceptChangeButton('onclick="changeData(' . 
			"'". $Global['full_link'] . "','" . $Global['page'] .
			"','". $object . "'" . ')"');
	deleteButton('onclick="prepare_reload();' .
			'deleteRecord(' . EDIT_DELETE_ . ','."'". 
			$Global[ 'session']."'".','."'".$Global['project']. 
			"','". $Global['full_link'] . "','" . $Global['page'] .
			"','". $object . "'" . ')"');
	$TF->Show('hbox_stop');

	return;

} // edit_show() ------------------------------------------------------------


/** show		show a object
 * 	====================================================
 *
 * @param		$link		name of the link (reference of object)
 * @param		$link_type	type of link
 * @param		$object		Selected object
 * 
 */

function show ( $link, $link_type, $object ) {

	global $T, $DB, $TF, $Global;
	if( $Global['print'] ){
		$TF = new Y_Template( "templates/form.html" );
	}
	else{
// ##### 13 
		if ( file_exists( "templates/form.xul" )) {
			$TF = new Y_Template( "templates/form.xul" );
		}
		if ( file_exists( "templates/form.xul.html" )) {
			$TF = new Y_Template( "templates/form.xul.html" );
		}
	
	// OLD in 13	$TF = new Y_Template( "templates/form.xul" );
// ##### 13 end	
	}
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link ) ) {
		$T->Set(  'error', "EMPTY LINK_NAME (plusexec:show)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}

	// Localize a object - Priority to a system object (engine)
	if ( file_exists( "engine/".$Global['lang']."/" . $link . ".php" ) ) {
		$file = "engine/".$Global['lang']."/" . $link . ".php";
	}
	else {
		$file = "project/".$Global['project']."/".$link.".php";
	}
	if ( file_exists( $file )) {
		include ( $file );
	}
	else {
		$T->Set(  'error', "FILE $file DON'T EXIST (plusexec:show)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}
		
	// Browse accordly type of form
	
	// Definition Formulary
	if ( $link_type == "def" ) {
		$Obj->Show_Def( $object );
		return;
	} 

	// Data Formulary
	if ( $link_type == "data" ) {

	
		// New callbutton control ----------
		$Global['localTable'] = $Obj->File;
		$Obj->Show_Data( $object );
		if( $Global['print'] ){
			return;
		}
		$TF->Show('hbox_start');

		backButton();
		enableChangeButton();
		acceptChangeButton('onclick="changeData(' . 
		 		"'". $Global['full_link'] . "','" . $Global['page'] .
				"','". $object . "'" . ')"');
		deleteButton('onclick="deleteRecord(' . DELETE_ . ','."'". 
		 		$Global[ 'session']."'".','."'".$Global['project']. 
		 		"','". $Global['full_link'] . "','" . $Global['page'] .
				"','". $object . "'" . ')"');
		$TF->Show('hbox_stop');
		// ----------------------------------
		
		return;
	} 

	
	// DB Formulary
	if ( $link_type == "db" ) {
	
	
		// ##### 23
		// A Inheritance resource
		if( !empty($Obj->Inheritance) ){
			include( "project/".$Global['project']."/db.".$Obj->Inheritance.".php");
			include( "project/".$Global['project']."/".$link_type.".".$link_name.".php");
		}
		// ##### 23
	
	
		$id = $object;

		$query = "SELECT * FROM " . $Obj->File . " WHERE id = " . 
				 $id . ";";
		$DB->Query( $query);
		$DB->NextRecord();
		
		$object = "";

		// Procedure Control
		$Global['proc_change'] = $Obj->p_change;
		$Global['proc_delete'] = $Obj->p_delete;
		
		$key = array_keys( $Obj->element );
		for( $i=0; $i< count( $key ); $i++ ) {
			$element = $key[$i];
			$name = $Obj->Get( $element, F_NAME_ ) ;
			$Obj->element[$name] [ F_VALUE_ ] = $DB->Record[ $name ];	
			if ( empty( $object ) ) {
				$object = $DB->Record[ $name ];
			}	
		}
	
		// New callbutton control ----------
		$Global['localTable'] = $Obj->File;
		$Global['acceptMode'] = CHANGE_;
		$Obj->Show_DB( $object );
		if( $Global['print'] ){
			return;
		}
		$TF->Show('hbox_start');

		backButton();
		
		if( $Obj->Noedit == "" ){
			enableChangeButton();
			acceptChangeButton('onclick="changeData(' . 
			 		"'". $Global['full_link'] . "','" . $Global['page'] .
					"','". $id . "'" . ')"');
			deleteButton('onclick="deleteRecord(' . DELETE_ . ','."'". 
			 		$Global[ 'session']."'".','."'".$Global['project']. 
			 		"','". $Global['full_link'] . "','" . $Global['page'] .
					"','". $id . "'" . ')"');
		}
				
		$TF->Set('name', "Modificar" );
		$TF->Set('help', 'Modificar los datos');
		
		$TF->Show('hbox_stop');
		// ----------------------------------
		
		return;
	} 
	
	
	$T->Set(  'error', "TYPE $link_type UNKNOW (plusexec:show)");
	$T->Show( 'error' );
	$T->Show( 'end_xul' );
	die();
	

} // show() -----------------------------------------------------------------


/** Insert		Insert a new element in a  object
 * 	====================================================
 *
 * @param		$link		name of the link (reference of object)
 * @param		$link_type	type of link
 * @param		$object		Selected object
 * 
 */

function insert ( $link, $link_type ) {

	global $T, $DB, $TF, $Global;
	$object = "";
	
// ##### 13 
	if ( file_exists( "templates/form.xul" )) {
		$TF = new Y_Template( "templates/form.xul" );
	}
	if ( file_exists( "templates/form.xul.html" )) {
		$TF = new Y_Template( "templates/form.xul.html" );
	}

// OLD in 13	$TF = new Y_Template( "templates/form.xul" );
// ##### 13 end	
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link ) ) {
		$T->Set(  'error', "EMPTY LINK_NAME (plusexec:insert)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}

	// Localize a object - Priority to a system object (engine)
	if ( file_exists( "engine/".$Global['lang']."/" . $link . ".php" ) ) {
		$file = "engine/".$Global['lang']."/" . $link . ".php";
	}
	else {
		$file = "project/".$Global['project']."/".$link.".php";
	}
	if ( file_exists( $file )) {
		include ( $file );
	}
	else {
		$T->Set(  'error', "FILE $file DON'T EXIST (plusexec:insert)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}
	
	// Procedure Control
	$Global['proc_insert'] = $Obj->p_insert;
		
	// Browse accordly type of form

	// Data Formulary
	if ( $link_type == "data" ) {
		
		
		// New callbutton control ----------
		$Global['localTable'] = $Obj->File;
		$Global['acceptMode'] = INSERT_;
		$Obj->Show_Data( $object );
		$TF->Show('hbox_start');

		backButton();
		insertButton('onclick="insertData(' .  
		 		"'". $Global['full_link'] . "','" . $Global['page'] .
				"','". $object . "'" . ')"');
		$TF->Show('hbox_stop');
		// ----------------------------------
		
		
		
		return;
	} 

	
	// DB Formulary
	if ( $link_type == "db" ) {
	
	
		// ##### 23
		// A Inheritance resource
		$Inheritance = $Obj->Inheritance;
		if( !empty($Obj->Inheritance) ){
		
			$Obj = new Y_Engine();
			include( "project/".$Global['project']."/db.".$Inheritance.".php");
			include( "project/".$Global['project']."/".$link.".php");
			
//print_r( $Obj );
//die();

		}
		// ##### 23
	
		$Obj->Show_DB( $object );
		
		$TF->Show('hbox_start');
		
		// Make a Back Button	
		
		backButton();
		insertButton('onclick="insertData(' .  
		 		"'". $Global['full_link'] . "','" . $Global['page'] .
				"','". $object . "'" . ')"');

		enableChangeButton(1);		
		$TF->Show('hbox_stop');
		return;
	} 
	
	
	$T->Set(  'error', "TYPE $link_type UNKNOW (plusexec:insert)");
	$T->Show( 'error' );
	$T->Show( 'end_xul' );
	
	die();
	

} // insert() ---------------------------------------------------------------




/** Consult		Call a cunsult
 * 	====================================================
 *
 * @param		$link		name of the link (reference of object)
 * @param		$link_type	type of link
 * @param		$object		Selected object
 * 
 */

function consult ( $link, $link_type ) {

	global $T, $DB, $TF, $Global;
	$object = "";
	
// ##### 13 
	if ( file_exists( "templates/form.xul" )) {
		$TF = new Y_Template( "templates/form.xul" );
	}
	if ( file_exists( "templates/form.xul.html" )) {
		$TF = new Y_Template( "templates/form.xul.html" );
	}

// OLD in 13	$TF = new Y_Template( "templates/form.xul" );
// ##### 13 end	
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link ) ) {
		$T->Set(  'error', "EMPTY LINK_NAME (plusexec:insert)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}

	// Localize a object - Priority to a system object (engine)
	if ( file_exists( "engine/".$Global['lang']."/" . $link . ".php" ) ) {
		$file = "engine/".$Global['lang']."/" . $link . ".php";
	}
	else {
		$file = "project/".$Global['project']."/".$link.".php";
	}
	if ( file_exists( $file )) {
		include ( $file );
	}
	else {
		$T->Set(  'error', "FILE $file DON'T EXIST (plusexec:insert)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}
	
	// DB Formulary
	if ( $link_type == "db" ) {
				
		// New callbutton control ----------
		$Global['localTable'] = $Obj->File;
		$Global['acceptMode'] = BROW_CONS_;
		$Obj->Show_DB( $object );
		$TF->Show('hbox_start');

		backButton();
		consultButton('onclick="prepare_reload();consult(' . BROW_CONS_ . ','."'". 
		 		$Global[ 'session']."'".','."'".$Global['project']. 
		 		"','". $Obj->Filter . "','" . $Global['page'] .
				"','". $object . "'" . ')"');

		insConsButton('onclick="callNew(' . INSERT_ . ','."'". 
		 		$Global[ 'session']."'".','."'".$Global['project']. 
		 		"','". $Obj->Filter . "','" . $Global['page'] .
				"','". $object . "'" . ');"');


		$TF->Show('hbox_stop');
		// ----------------------------------
			
		return;
	} 
	
	
	$T->Set(  'error', "TYPE $link_type UNKNOW (plusexec:insert)");
	$T->Show( 'error' );
	$T->Show( 'end_xul' );
	
	die();
	

} // consult() ---------------------------------------------------------------


/** Ins_elem		Insert a new element in a db form
 * 	====================================================
 *
 * @param	$link		name of the link (reference of object)
 * @param	$link_type	type of link
 * @param	$object		Selected object
 * 
 */

function ins_elem ( $link, $link_type ) {

	global $T, $DB, $TF, $Global;
	$object = "";
	
	
// ##### 13 
	if ( file_exists( "templates/form.xul" )) {
		$TF = new Y_Template( "templates/form.xul" );
	}
	if ( file_exists( "templates/form.xul.html" )) {
		$TF = new Y_Template( "templates/form.xul.html" );
	}

// OLD in 13	$TF = new Y_Template( "templates/form.xul" );
// ##### 13 end	
	
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link ) ) {
		$T->Set(  'error', "EMPTY LINK_NAME (plusexec:insert_elem)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}

	$tmp = explode( '.', $Global['full_link'] );
	$fileType = $tmp[0];
	// Localize a object - Priority to a system object (engine)
	if ( file_exists( "engine/".$Global['lang']."/" . $link . ".php" ) ) {
		$file = "engine/".$Global['lang']."/" . $link . ".php";
	}
	else {
		if(	$fileType == 'rep' ){
			$file = "project/".$Global['project']."/reports/".$link.".php";
		} else{
			$file = "project/".$Global['project']."/".
			$link.".php";
		}
	}
	if ( file_exists( $file )) {
		include ( $file );
	}
	else {
		$T->Set(  'error', "FILE $file DON'T EXIST (plusexec:insert_elem)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}
		
	// Browse accordly type of form
		
	$Global['oper'] = INSERT_ELEM_;
	
	// Data Formulary
	$Global['localTable'] = $Obj->File;
	$Obj->Show_Data_DB( $object );
		
	$TF->Show('hbox_start');
		
	// Make a Back Button	
	$TF->Set('name', "Volver" );
	$TF->Set('help', 'Cerrar la vista actual');
	$TF->Show('close_button');
	
	// Make a Apply Button	
	$TF->Set('command','onclick="insertData(' .  
			"'". $Global['full_link'] . "','" . $Global['page'] .
			"','". $object . "'" . ')"');
	$TF->Set('name', "Aplicar" );
	$TF->Set('help', 'Aplicar los datos actuales');
	$TF->Show('accept_button');
	$TF->Show('hbox_stop');

	return;

} // ins_elem() ------------------------------------------------------------



/** insert_data		Insert a new element in a  propiety of object
 * 	=============================================================
 *
 * @param		$link		name of the link (reference of object)
 * @param		$link_type	type of link
 * @param		$object		Selected object
 * 
 */

function insert_data ( $link, $link_type ) {

	global $T, $DB, $TF, $Global;
	$object = "";
	
	
// ##### 13 
	if ( file_exists( "templates/form.xul" )) {
		$TF = new Y_Template( "templates/form.xul" );
	}
	if ( file_exists( "templates/form.xul.html" )) {
		$TF = new Y_Template( "templates/form.xul.html" );
	}

// OLD in 13	$TF = new Y_Template( "templates/form.xul" );
// ##### 13 end	
	
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link ) ) {
		$T->Set(  'error', "EMPTY LINK_NAME (plusexec:insert_data)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}

	// Localize a object - Priority to a system object (engine)
	if ( file_exists( "engine/".$Global['lang']."/" . $link . ".php" ) ) {
		$file = "engine/".$Global['lang']."/" . $link . ".php";
	}
	else {
		$file = "project/".$Global['project']."/".$link.".php";
	}
	if ( file_exists( $file )) {
		include ( $file );
	}
	else {
		$T->Set(  'error', "FILE $file DON'T EXIST (plusexec:insert_data)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}
	
	// New callbutton control ----------
	$Global['localTable'] = $Obj->File;
	$Global['acceptMode'] = INS_DATA_;
	$Obj->Show_Prop( $object );
	$TF->Show('hbox_start');

	backButton();
	insertButton('onclick="insertData(' .  
	 		"'". $Global['full_link'] . "','" . $Global['page'] .
			"','". $object . "'" . ')"');
	$TF->Show('hbox_stop');
	// ----------------------------------
	return;

} // insert_data() ----------------------------------------------------------


/** view_data		view a propiety of object
 * 	=============================================================
 *
 * @param	$link		name of the link (reference of object)
 * @param	$link_type	type of link
 * @param	$object		Selected object
 * 
 */

function view_data ( $link, $link_type ) {

	global $T, $DB, $TF, $Global;
	$object = "";
	
	
// ##### 13 
	if ( file_exists( "templates/form.xul" )) {
		$TF = new Y_Template( "templates/form.xul" );
	}
	if ( file_exists( "templates/form.xul.html" )) {
		$TF = new Y_Template( "templates/form.xul.html" );
	}

// OLD in 13	$TF = new Y_Template( "templates/form.xul" );
// ##### 13 end	
	
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link ) ) {
		$T->Set(  'error', "EMPTY LINK_NAME (plusexec:view_data)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}

	// Localize a object - Priority to a system object (engine)
	if ( file_exists( "engine/".$Global['lang']."/" . $link . ".php" ) ) {
		$file = "engine/".$Global['lang']."/" . $link . ".php";
	}
	else {
		if( $link_type == 'rep' ){
			$file = "project/".$Global['project']."/reports/".
			$link.".php";
		} else {
			$file = "project/".$Global['project']."/".$link.".php";
		}
	}
	if ( file_exists( $file )) {
		include ( $file );
	}
	else {
		$T->Set(  'error', "FILE $file DON'T EXIST (plusexec:view_data)");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}

	$pagetemp = explode( "-", $Global['page']);
	$pagetemp[0]+=0;
	$pagetemp[0]++;
	$Global['page'] = "'"+$pagetemp[0]+"-"+$pagetemp[1]+"'";
	
	// DB Formulary
	if( ( $link_type == "db" )	||
		( $link_type == 'rep' ) ){

		// New callbutton control ----------
		$Global['localTable'] = $Obj->File;
		$Global['acceptMode'] = CHG_DATA_;
		$Obj->Show_Prop( $object );
		$TF->Show('hbox_start');

		backButton();
		enableChangeButton();
		acceptChangeButton( 'onclick="changeData(' . 
		 		"'". $Global['full_link'] . "','" . $Global['page'] .
				"','". $id . "'" . ')"');
		deleteButton('onclick="prepare_reload();' .
				'deleteForm(' . DELETE_FRM_ . ','."'". 
		 		$Global[ 'session']."'".','."'".$Global['project']. 
		 		"','". $Global['full_link'] . "','" . $Global['page'] .
				"','". $id . "'" . ')"');
		$TF->Show('hbox_stop');
		return;
	} 
	
	// Data Formulary
	if ( $link_type == "data" ) {

		// New callbutton control ----------
		$Global['localTable'] = $Obj->File;
		$Global['acceptMode'] = CHG_DATA_;
		$Obj->Show_Prop( $object );
		$TF->Show('hbox_start');

		backButton();
		enableChangeButton();
		acceptChangeButton('onclick="changeData(' . 
		 		"'". $Global['full_link'] . "','" . $Global['page'] .
				"','". $id . "'" . ')"');
		deleteButton('onclick="prepare_reload();' .
				'deleteForm(' . DELETE_FRM_ . ','."'". 
		 		$Global[ 'session']."'".','."'".$Global['project']. 
		 		"','". $Global['full_link'] . "','" . $Global['page'] .
				"','". $id . "'" . ')"');
		$TF->Show('hbox_stop');
		// ----------------------------------
		return;
	} 
	
	$T->Set(  'error', "TYPE $link_type UNKNOW (plusexec:view_data)");
	$T->Show( 'error' );
	$T->Show( 'end_xul' );
	
	die();

} // view_data() ------------------------------------------------------------




/** doc_dd	Makes a Data Dictionary
 *	===============================
 */
 
function doc_dd() {
	
	global $Global;
	echo "<script>";
	echo '	document.onload=callDoc("dd");';
	echo "</script>\n";

} // docdd() ----------------------------------------------------------------

/** doc_0	Makes a User Manual
 *	===========================
 */
 
function doc_0() {
	
	global $Global;
	echo "<script>";
	echo '	document.onload=callDoc(0);';
	echo "</script>\n";


} // doc0() -----------------------------------------------------------------


/** doc_1	Makes a Simple Proyect Documentation 
 *	============================================
 */
 
function doc_1() {
	
	global $Global;
	echo "<script>";
	echo '	document.onload=callDoc(1);';
	echo "</script>\n";


} // doc1() -----------------------------------------------------------------


/** doc_2	Makes a Advanced Proyect Documentation 
 *	==============================================
 */
 
function doc_2() {
	
	global $Global;
	echo "<script>";
	echo '	document.onload=callDoc(2);';
	echo "</script>\n";


} // doc2() -----------------------------------------------------------------



/** doc_3	Makes a Consistence Documentation 
 *	=========================================
 */
 
function doc_3() {
	
	global $Global;
	
	// Starting Template	
	
	
//	$T = new Y_Template( "templates/doc.xul" );
// ##### 13 
	if ( file_exists( "templates/doc.xul" )) {
		$T = new Y_Template( "templates/doc.xul" );
	}
	if ( file_exists( "templates/doc.xul.html" )) {
		$T = new Y_Template( "templates/doc.xul.html" );
	}

// ##### 13 end	
	



	$T->Show('script1');
	// Making a page to call (first part)
	echo "<script><![CDATA[ \n";
	echo "var page = \"plusdoc.php?action=3\";\n";
	echo "page += \"&sess=\" + \"" . $Global['session'] . "\";\n";
	echo "page += \"&project=\" + \"" . $Global['project'] . "\";\n";
	echo "page += \"&item=\";\n";
	echo "]]> </script>\n";
	$T->Show('doc3');


} // doc3() -----------------------------------------------------------------

/** doc_4	Generate a DIA file				 
 *	=========================================
 */
 
function doc_4() {
	
	global $Global;

	$file = "./include/plus_doc_dia.php?project=" . $Global['project'] ;
	echo "<script>\n";
	echo 'var atrib = "toolbar=no,location=no,directories=no,status=no," +
				"menubar=yes,scrollbars=yes,resizable=no";' . "\n";
	echo '		window.open( "' . $file.  '", "dia", atrib ) ;';
	echo '	setTimeout( "window.close()", 1000 );';
	echo "</script>\n";

} // doc4() -----------------------------------------------------------------


/** doc_5	Makes a Data Dictionary
 *	===============================
 */
 
function doc_5() {
	
	global $Global;
	echo "<script>";
	echo '	document.onload=callDoc(5);';
	echo "</script>\n";


} // doc5() ----------------------------------------------------------------


/** start_log	Activate a internal LOG
 *	===================================
 */
 
function start_log(){
	$file = "config/db_log";
	if( $handler = fopen( $file, "w")) {
		fputs($handler,  "1" );
		fclose($handler);
	}
	
	$file = "log/plus_sql.log";
	if( file_exists( $file ) ){
		unlink( $file );
	}
	if( $handler = fopen( $file, "w")) {
		fputs($handler,  "*** Starting LOG ***\n" );
		fclose($handler);
	}
	echo "<script>\n";
	echo '	setTimeout( "window.close()", 1000 );';
	echo "</script>\n";
	
} // start_log -------------------------------------------------------------


/** stop_log	Desactivate a internal LOG
 *	===================================
 */
 
function stop_log(){
	$file = "config/db_log";
	if( file_exists( $file ) ){
		unlink( $file );
	}
	echo "<script>\n";
	echo '	setTimeout( "window.close()", 1000 );';
	echo "</script>\n";

} // stop_log --------------------------------------------------------------

 
function ShowFunction( $func ) {
echo "<!-- $func -->\n";
}

?>