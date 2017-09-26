<?php


/** plusRPC.php		Remote procedure calls
 *  ================================================
 *
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	Set, 21 of 2005
 * 
 */
 

 
/** System Definitions
 */
error_reporting(E_ALL ^ E_NOTICE);

// Load a common functions
include_once ( "include/functions.php" );

// Load a Engine class
include_once ( "include/Y_Engine.class.php" );

// Select a project
$project = $_POST['project'];
// OLD IN # 30 
/*
$project = $_GET['project'];
*/



// Database Abstration Layer
include_once "include/Y_DB.class.php";
$DB = new Y_DB();




// Atribute a database
$DB->Database = $project;

$action  = $_POST['action'];
$session = $_POST['sess'];
$link	 = $_POST['link'];
$page	 = $_POST['page'];
$object  = $_POST['obj'];
$pass	 = $_POST['pass'];
/* OLD IN 30
$action  = $_GET['action'];
$session = $_GET['sess'];
$link	 = $_GET['link'];
$page	 = $_GET['page'];
$object  = $_GET['obj'];
$pass	 = $_GET['pass'];
*/
//$DB->query( "# ---> ".$action ); // ##########################################

// Constants definitions
define( 'MENU_ONLY_',	0 ); // Not used
define( 'BROWSE_',		1 ); // Not used
define( 'SHOW_',		2 ); // Not Used
define( 'DELETE_', 		3 );
define( 'CHANGE_', 		4 );
define( 'INSERT_',		5 );
define( 'INT_PROC_',	6 );
define( 'INS_DATA_',	7 );		// Insert property in a form
define( 'VIEW_DATA_',	8 );		// View a properties of a form
define( 'CHG_DATA_',	9 );		// Change a properties
define( 'DELETE_FRM_',	10);		// Kill a Form

define( 'EDIT_BROWSE_', 15);		// Browse a db_form element
define( 'EDIT_SHOW_',	16);		// Show a db form
define( 'EDIT_CHANGE_',	17);		// Change a db form element
define( 'EDIT_DELETE_',	18);		// Kill a element of a DB Form

define( 'CONSULT_', 	20);		// Consult to a formulary

define( 'INS_ELEM_', 	30);		// Insert a element in a DB form
define( 'INSERT_ELEM_',	31); 		// Insert from javascript

define( 'QUERY_',			100 ); // Makes a database query
define( 'SELECT_POPULATE',	101 ); // Makes a query to populate a select list
define( 'SQL_QUERY_',		103 ); // Query to a SQL Server
define( 'AUTONUM_',			104 ); // Autonumerical control
define( 'PROCEDURE_',		105 ); // Stored Procedures to access a DB
define( 'BEGIN_',			106 ); // Start a transaction
define( 'COMMIT_',			107 ); // End a transaction and write consults
define( 'ROLLBACK_',		108 ); // Cancel a transaction

define( 'CALLPROC_',		110 ); // Call a procedure

$version = $_POST[v];
$Global = start_session( $session, $version );
$Global[ 'project' ] = $_POST[project];
/* OLD IN # 30
$version = $_GET[v];
$Global = start_session( $session, $version );
$Global[ 'project' ] = $_GET[project];
*/

$Global[ 'page' ] = $page;
$Global[ 'oper' ] = $action;
$Global[ 'link' ] = $link;
$Global[ 'object']= $object; 
$Global[ 'SQL_Status'] = "ER";
$pass = stripslashes( $pass ); // { #71 }		


$temp = explode ( ".", $link );
$link_type = $temp[0];
$link_name = $temp[1];
if ( ! empty($temp[2]) ) {
	$link_name.=".";
	$link_name.=$temp[2];
}
$Global['link'] = $temp[1];
$Global['full_link'] = $link;

// print_r($Global);

// RPC tests
// echo "<script src=\"./include/functions.js\" type=\"application/x-javascript\" />";

// Monitoring a $option
/*
$DB->Query( 'SELECT "Action = '. $action .'"');
$DB->NextRecord();
$DB->Query( 'SELECT "==================================="');
$DB->NextRecord();
*/

// echo "full:" . $Global['full_link'] . "<br> ";
// sayerror( $action );

switch ( $action ) {
    

	 
	/*
		I N S E R T S
	*/
	// Insert a record 		
	case INSERT_:
  		insert( $link_name, $link_type, $object, $pass );
  		break;
  		
	// Insert a new formulary
	case INS_DATA_:
  		insert_db_form( $link_name, $link_type, $object, $pass );
  		break;
  	
  	// Insert a element of a formulary
	case INSERT_ELEM_:
  		insert_elem( $link_name, $link_type, $object, $pass );
  		break;
	// ..........................................................

	/*
		C H A N G E
	*/
	// Change a record 		
	case CHANGE_:
  		change( $link_name, $link_type, $object, $pass );
  		break;

  	// Change a property of a formulary
	case CHG_DATA_:
  		change_form( $link_name, $link_type, $object, $pass );
  		break;

  	// Change a element of a DB Form
	case EDIT_CHANGE_:
  		edit_change( $link_name, $link_type, $object, $pass );
  		break;

  	// ..........................................................
  	
  	/*
  		D E L E T E
  	*/

	// Delete an object of a system
	case DELETE_:
  		delete( $link_name, $link_type, $object );
  		break;

	// Delete a formulary
	case DELETE_FRM_:
  		delete_form( $link_name, $link_type, $object );
  		break;

  	// Delete a element of formulary
  	case EDIT_DELETE_:
  		edit_delete( $link_name, $link_type, $object );
  		break;

 	
  	/*
		CREATE
 	*/
	// Create a new project in the system 
	case NEW_PROJECT_:  
		create_new_project($object);		 
		break;		
		
	 		
  	
  	// ..........................................................
  	
	// Make a database query
	case QUERY_:
  		query( $pass );
		break;
	// Make a call to a specific procedure
	case CALLPROC_:
  		callProc( $pass );
		break;

	// Starts a transaction
	case BEGIN_:
  		begin();
 		break;
	// Write a transaction
	case COMMIT_:
  		commit();
		break;
	// Cancel a transaction
	case ROLLBACK_:
  		rollback();
		break;
	
	// Make a Query to populate a Select_list
	case SELECT_POPULATE_ :
  		select_populate( $query );
  		break;
  	
	case AUTONUM_ :
  		autonum( $pass );
  		break;
 		
	default:
    	sayerror( "Invalid code action in input of page (plusRPC)");
		die();
	  
} 

/**
 * create_new_project 		Make a new empty folder "empty Project"
 * ================================================================
 *
 * @param String $project_name
 */

function create_new_project($project_name){	
  	mkdir("project/$project_name",0777) or die(  /* Make Error log here */  ) ;	  	
}

// create_new_project() --------------------------------------------------- 



/** query		Makes a database query
 * 	====================================================
 * 
 */

function query ( $query ) {

	global $DB, $Global;
	
	$delimiter="`";
	$numRow = 0;
	$array = array();
	$query = str_replace ("wWz", "+",$query );
	$query = str_replace ("|{", '"',$query );
	$query = str_replace ("}|", '"',$query );
	$Global['SQL_Status']="";

	
		
// # 167
// ##### 24 - Transactions
	if( strpos( $query,"(") >1 ){
//		$DB->Query( "\nSET AUTOCOMMIT=0" );
		$DB->query( "\nSTART TRANSACTION" );
		$query = '   '. $query;
	}
/* OLD
	if( substr( $query,0,6) != 'SELECT' ){
		$DB->Query( 'SET AUTOCOMMIT=0' );
	}
*/
// ##### 24 - Transactions
	$DB->query( $query );
	while( $DB->NextRecord() ) {
		$numRow++;
		$numCol = count( $DB->Record ) / 2;
		$keys = array_keys( $DB->Record );
// print_r( $DB->Record );	
		for ( $i = 0; $i < $numCol; $i++ ) {
// ##### 22	
			array_push( $array, stripslashes($DB->Record[$i]));
// OLD			array_push( $array, $DB->Record[$i]);
// ##### 22	
		}
	}
	
// # 167

// ##### 24 - Transactions

	if( strpos( $query,"(") >1 ){
		$Result=$DB->ID_Query;
		if( $Global['SQL_Status'] == 'ER' ){
			$DB->query( "\n### T R A N S A C T I O N   E R R O R ###; ROLLBACK \n" );
		}
		else{
			$DB->query( "COMMIT \n" );
		}
//		$DB->Query( "SET AUTOCOMMIT=1\n" );
	}

/* OLD if( substr( $query,0,6) != 'SELECT' ){
		$DB->Query( 'COMMIT' );
		$DB->Query( 'SET AUTOCOMMIT=1');
	}
*/
// ##### 24 - Transactions
	
	// Print a formated data
	// First, a identification of object and operation 
	
// ##### 30
	// To return a correct charset
	header("Content-type: text/javascript; charset=iso-8859-1");	
// ##### 30 end

	echo $delimiter . "_0" . $delimiter; 
	echo $Global['object'] . $delimiter;
	echo $Global['full_link'] . $delimiter;
	// Now, a number of rows and column of a responseText
	echo "_1" . $delimiter; 
	echo $numRow . $delimiter;
	echo $numCol . $delimiter;
	// The header of columns
	echo "_2" . $delimiter; 
	for ( $i = 1; $i < count( $keys ); $i+= 2 ) {
		echo $keys[$i] . $delimiter;
	}
	// And the array with all information
	echo "_3" . $delimiter; 
	for ( $i = 0; $i < count( $array ); $i++ ) {
		echo $array[$i] . $delimiter;
	}
	return;
	

} // query() ---------------------------------------------------------------


/** callProc		Makes a database query (call Procedure)
 * 	=======================================================
 * 
 */

function callProc ( $query ) {

	global $DB, $Global;
	
	$delimiter="`";
	$numRow = 0;
	$array = array();
	$query = str_replace ("wWz", "+",$query );
	$Global['SQL_Status']="";
// ##### 22	
//	$query = addslashes($query);
// ##### 22	

// ##### 24 - Transactional Procedures 
//	$DB->Query( "\nSET AUTOCOMMIT=0" );
	$DB->query( "\nSTART TRANSACTION" );
	$DB->query( "   ".$query );
	if( $Global['SQL_Status'] == 'ER' ){
		$DB->query( "\n### T R A N S A C T I O N   E R R O R ###; ROLLBACK \n" );
	}
	else{
		$DB->query( "COMMIT \n" );
	}
//	$DB->Query( "SET AUTOCOMMIT=1" );
// OLD	$DB->query( $query );
// ##### 24

// Print a formated data
// ##### 30
	// To return a correct charset
	header("Content-type: text/javascript; charset=iso-8859-1");	
// ##### 30 end
	// First, a identification of object and operation 
	echo $delimiter . "_0" . $delimiter; 
	echo $Global['object'] . $delimiter;
	echo $Global['full_link'] . $delimiter;
	// Now, a number of rows and column of a responseText
	echo "_1" . $delimiter; 
	echo 0 . $delimiter;
	echo 0 . $delimiter;
	// The header of columns
	echo "_2" . $delimiter; 
	echo 0 . $delimiter;
	// And the array with all information
	echo "_3" . $delimiter; 
	echo 0 . $delimiter;
	return;
} // callProc() ------------------------------------------------------------



/** 
 * autonum		Control a autonum value
 * ====================================================
 * 
 */

function autonum ( $name ) {

	global $DB, $Global;
	
	$query = "SELECT value FROM __autonum__ WHERE name='" . $name . "';";
	$delimiter="`";
	$numRow = 0;
	$array = array();
	$query = str_replace ("wWz", "+",$query );
	$DB->query( $query );
	while( $DB->NextRecord() ) {
		$numRow++;
		$numCol = count( $DB->Record ) / 2;
		$keys = array_keys( $DB->Record );
// print_r( $DB->Record );	
		for ( $i = 0; $i < $numCol; $i++ ) {
			$autoValue = $DB->Record[$i] + 1;
			array_push( $array, $autoValue );
		}
	}
	
	$query = "UPDATE __autonum__ SET value='" . $autoValue .
			"' WHERE name='" . $name . "'";
	$DB->Query( $query );
	// Print a formated data
	// First, a identification of object and operation 
// ##### 30
	// To return a correct charset
	header("Content-type: text/javascript; charset=iso-8859-1");	
// ##### 30 end
	echo $delimiter . "_0" . $delimiter; 
	echo $Global['object'] . $delimiter;
	echo $Global['full_link'] . $delimiter;
	// Now, a number of rows and column of a responseText
	echo "_1" . $delimiter; 
	echo $numRow . $delimiter;
	echo $numCol . $delimiter;
	// The header of columns
	echo "_2" . $delimiter; 
	for ( $i = 1; $i < count( $keys ); $i+= 2 ) {
		echo $keys[$i] . $delimiter;
	}
	// And the array with all information
	echo "_3" . $delimiter; 
	for ( $i = 0; $i < count( $array ); $i++ ) {
		echo $array[$i] . $delimiter;
	}

	return;
	

} // autonum() -------------------------------------------------------------



/*	delete		Delete a object
	======================================================================*/
/*
function OLDdelete ( $link_name, $link_type, $object ) {

	global $T, $DB, $TF, $Global;
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link_name ) ) {
		sayerror( "EMPTY LINK_NAME (plusvalidate:delete)");
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
		sayerror( "FILE $file DON'T EXIST (plusvalidate:delete)");
	}

	// The file to write
	$filewrite = "project/".$Global['project']."/".$link_type.
				".".$link_name.".php";

	
	// delete accordly type of form
	
	// Data Formulary
	if ( $link_type == "data" ) {
		$Obj->Delete_Data( $filewrite, $object );
		cleanReturn();
		return;
	} 

	
	// DB Formulary
	if ( $link_type == "db" ) {
		$Obj->Delete_DB( $object );
		cleanReturn();
		return;
	} 
	
	
	sayerror( "TYPE $link_type UNKNOW (plusvalidate:delete)" );
	

} // delete() ---------------------------------------------------------------

*/


function sayerror( $text ) {
	echo "<script>\n ";
	echo "    window.parent.alert( " . '"' . $text . '"' . " );\n";
	echo "</script>\n";
}



/** insert		Insert a values into an object
 * 	====================================================
 *
 * @parameter	$link_name		name of the link (object)
 * @parameter	$link_type		type of link
 * @parameter	$object			object to delete
 * 
 */

function insert ( $link_name, $link_type, $object, $pass ) {

	global $T, $DB, $TF, $Global;
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link_name ) ) {
		sayerror( "EMPTY LINK_NAME (plusvalidate:insert)");
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
		sayerror( "FILE $file DON'T EXIST (plusvalidate:insert)");
	}


	// The file to write
	$filewrite = "project/".$Global['project']."/".$link_type.
				".".$link_name.".php";


				
	// Insert accordly type of form
	
	// Data Formulary
	if ( $link_type == "data" ) {
		$pass = str_replace ('"', "'", $pass );						// #72
		$Obj->Change_Data( $filewrite, $object, $pass );
		cleanReturn();
		return;
	} 
	
	// DB Formulary
	if ( $link_type == "db" ) {
// ##### 22	
		$Obj->Insert_DB( addslashes($pass) );
// OLD		$Obj->Insert_DB( $pass );
// ##### 22	
		
		cleanReturn();		
		return;
	} 
	
	
	sayerror( "TYPE $link_type UNKNOW (plusvalidate:insert)" );
	

} // insert() ---------------------------------------------------------------



/** insert_db_form		Insert a values into a db_form
 * 	====================================================
 *
 * @param	$link_name		name of the link (object)
 * @param	$link_type		type of link
 * @param	$object			object to insert
 * @param 	@pass			passed data
 * 
 */

function insert_db_form ( $link_name, $link_type, $object, $pass ) {

	global $T, $DB, $TF, $Global;
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link_name ) ) {
		sayerror( "EMPTY LINK_NAME (plusvalidate:insert_db_form)");
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
		sayerror( "FILE $file DON'T EXIST (plusvalidate:insert_db_form)");
	}
	// The file to write
	// Report file
	if( $Global['link']=='rep__' ){
		if( !file_exists( "project/".$Global['project']."/reports" ) ){
			mkdir( "project/".$Global['project']."/reports" , 0777);
		}
		$filewrite = "project/".$Global['project']."/reports/rep." . 
		$Global['object'];
/*		$filewrite = "project/".$Global['project']."/reports/rep." . 
		$link_name;
*/
	}
	// db file
	else{
//		$filewrite = "project/".$Global['project']."/db." . $link_name;
		$filewrite = "project/".$Global['project']."/db." . 
		$Global['object'];
	}
// print_r($Global);
// echo $link_type ."\n";
// echo $filewrite;
// die();
	
	// New DB Formulary
	if ( $link_type == "def" ) {
		$pass = str_replace ('"', "'", $pass );						// #72
		$Obj->Change_DB_form( $filewrite, $object, $pass );
		cleanReturn();
		return;
	} 
	sayerror( "TYPE $link_type UNKNOW (plusvalidate:insert_db_form)" );
	

} // insert_db_form() -------------------------------------------------------



/** insert_elem		Insert a elements in a db form
 * 	====================================================
 *
 * @param	$link_name		name of the link (object)
 * @param	$link_type		type of link
 * @param	$object			object to insert
 * @param 	$pass			passed data
 * 
 */

function insert_elem ( $link_name, $link_type, $object, $pass ) {

	global $T, $DB, $TF, $Global;
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link_name ) ) {
		sayerror( "EMPTY LINK_NAME (plusvalidate:insert_elem)");
	}

	$tmp = explode('.',$Global['full_link']);
	$fileType = $tmp[0];

	// Localize a object - Priority to a system object (engine)
	if( $fileType == 'rep' ){
		$file = "project/".$Global['project']."/reports/rep.".$link_name.".php";
	} else {
		$file = "project/".$Global['project']."/db.".$link_name.".php";
	}
	
	if ( file_exists( $file )) {
		include ( $file );
	}
	else {
		sayerror( "FILE $file DON'T EXIST (plusvalidate:insert_elem)");
	}
/*
print_r($Global);
die();	
*/
// The file to write
	if( $fileType == 'rep' ){
		$filewrite = "project/".$Global['project']."/reports/rep." .
					$link_name;
	} else {
		$filewrite = "project/".$Global['project']."/db." .
					$link_name;
	}

echo "[".$filewrite.']';
	

		
	



	// insert accordly type of form
	
	// Data Formulary
//122	if ( $link_type == "db" ) {
		$pass = str_replace ('"', "'", $pass );						// #72


		writeDataRep( $pass );  // # 7 - Data Repository

		$Obj->Change_DB_Form_el( $filewrite, $object, $pass );
		cleanReturn();
		return;
//122	} 


	sayerror( "TYPE $link_type UNKNOW (plusvalidate:insert_elem)" );
	

} // insert_elem() ----------------------------------------------------------




/* writeDataRep - Writes a data in a data Repository
*/
function writeDataRep( $pass ){

	global $DB, $Global;
// ##### 7
	// Data Repository
	$dataRep = array();
	$array = explode( ",", $pass);
	for ( $i=0; $i<count($array); $i+=2){
		$dataRep[ $array[$i] ] = convertChar( $array[$i+1] );		
	}
	// Writing in a global Repository
	$DB2 = new Y_DB();
	
// ##### 14	
	$DB2->Database = $DB2->GenData;
//	$DB2->Database = "plus_data";
    $DB2->Query('SELECT id FROM p_data WHERE F_NAME_="'.$dataRep['F_NAME_'].'"');
	$DB2->NextRecord();
	if( empty( $DB2->Record['id'] ) ){
		$query='INSERT INTO p_data ('.
				'F_NAME_, F_ALIAS_, F_HELP_, F_TYPE_, F_DSL_, F_MULTI_, '.
				'F_AUTONUM_, F_OPTIONS_, F_LINK_, F_REPORT_, F_MAKE_QUERY_, '.
				'F_QUERY_, F_QUERY_REF_, F_SEND_, F_RELATION_, F_RELTABLE_, '.
				'F_SHOWFIELD_,F_RELFIELD_,F_LOCALFIELD_,F_FILTER_,F_LENGTH_, '.
				'F_DEC_, F_BROW_, F_REQUIRED_, F_UNIQUE_, F_NODB_, F_TOTAL_, '.
				'F_EXTRA_, V_DEFAULT_, C_SHOW_, C_VIEW_, C_CHANGE_, F_PREVAL_, '.
				'F_POSVAL_, F_MESSAGE_, F_FORMULA_, G_SHOW_, G_CHANGE_) '.
				'VALUES ('.
				'"'. $dataRep['F_NAME_'] . '",'.
				'"'. $dataRep['F_ALIAS_'] . '",'.
				'"'. $dataRep['F_HELP_'] . '",'.
				'"'. $dataRep['F_TYPE_'] . '",'.
				'"'. $dataRep['F_DSL_'] . '",'.
				'"'. $dataRep['F_MULTI_'] . '",'.
				'"'. $dataRep['F_AUTONUM_'] . '",'.
				'"'. $dataRep['F_OPTIONS_'] . '",'.
				'"'. $dataRep['F_LINK_'] . '",'.
				'"'. $dataRep['F_REPORT_'] . '",'.
				'"'. $dataRep['F_MAKE_QUERY_'] . '",'.
				'"'. $dataRep['F_QUERY_'] . '",'.
				'"'. $dataRep['F_QUERY_REF_'] . '",'.
				'"'. $dataRep['F_SEND_'] . '",'.
				'"'. $dataRep['F_RELATION_'] . '",'.
				'"'. $dataRep['F_RELTABLE_'] . '",'.
				'"'. $dataRep['F_SHOWFIELD_'] . '",'.
				'"'. $dataRep['F_RELFIELD'] . '",'.
				'"'. $dataRep['F_LOCALFIELD_'] . '",'.
				'"'. $dataRep['F_FILTER'] . '",'.
				'"'. $dataRep['F_LENGTH_'] . '",'.
				'"'. $dataRep['F_DEC_'] . '",'.
				'"'. $dataRep['F_BROW_'] . '",'.
				'"'. $dataRep['F_REQUIRED_'] . '",'.
				'"'. $dataRep['F_UNIQUE_'] . '",'.
				'"'. $dataRep['F_NODB_'] . '",'.
				'"'. $dataRep['F_TOTAL_'] . '",'.
				'"'. $dataRep['F_EXTRA_'] . '",'.
				'"'. $dataRep['V_DEFAULT_'] . '",'.
				'"'. $dataRep['C_SHOW_'] . '",'.
				'"'. $dataRep['C_VIEW_'] . '",'.
				'"'. $dataRep['C_CHANGE_'] . '",'.
				'"'. $dataRep['F_PREVAL_'] . '",'.
				'"'. $dataRep['F_POSVAL_'] . '",'.
				'"'. $dataRep['F_MESSAGE_'] . '",'.
				'"'. $dataRep['F_FORMULA_'] . '",'.
				'"'. $dataRep['G_SHOW_'] . '",'.
				'"'. $dataRep['G_CHANGE_'] . '")';
		$DB2->Query( $query );
			
	}
	else{
		$query='UPDATE p_data SET '.
				'F_ALIAS_="'. $dataRep['F_ALIAS_'] . '",'.
				'F_HELP_="'. $dataRep['F_HELP_'] . '",'.
				'F_TYPE_="'. $dataRep['F_TYPE_'] . '",'.
				'F_DSL_="'. $dataRep['F_DSL_'] . '",'.
				'F_MULTI_="'. $dataRep['F_MULTI_'] . '",'.
				'F_AUTONUM_="'. $dataRep['F_AUTONUM_'] . '",'.
				'F_OPTIONS_="'. $dataRep['F_OPTIONS_'] . '",'.
				'F_LINK_="'. $dataRep['F_LINK_'] . '",'.
				'F_REPORT_="'. $dataRep['F_REPORT_'] . '",'.
				'F_MAKE_QUERY_="'. $dataRep['F_MAKE_QUERY_'] . '",'.
				'F_QUERY_="'. $dataRep['F_QUERY_'] . '",'.
				'F_QUERY_REF_="'. $dataRep['F_QUERY_REF_'] . '",'.
				'F_SEND_="'. $dataRep['F_SEND_'] . '",'.
				'F_RELATION_="'. $dataRep['F_RELATION_'] . '",'.
				'F_RELTABLE_="'. $dataRep['F_RELTABLE_'] . '",'.
				'F_SHOWFIELD_="'. $dataRep['F_SHOWFIELD_'] . '",'.
				'F_RELFIELD_="'. $dataRep['F_RELFIELD_'] . '",'.
				'F_LOCALFIELD_="'. $dataRep['F_LOCALFIELD_'] . '",'.
				'F_FILTER_="'. $dataRep['F_FILTER_'] . '",'.
				'F_LENGTH_="'. $dataRep['F_LENGTH_'] . '",'.
				'F_DEC_="'. $dataRep['F_DEC_'] . '",'.
				'F_BROW_="'. $dataRep['F_BROW_'] . '",'.
				'F_REQUIRED_="'. $dataRep['F_REQUIRED_'] . '",'.
				'F_UNIQUE_="'. $dataRep['F_UNIQUE_'] . '",'.
				'F_NODB_="'. $dataRep['F_NODB_'] . '",'.
				'F_TOTAL_="'. $dataRep['F_TOTAL_'] . '",'.
				'F_EXTRA_="'. $dataRep['F_EXTRA_'] . '",'.
				'V_DEFAULT_="'. $dataRep['V_DEFAULT_'] . '",'.
				'C_SHOW_="'. $dataRep['C_SHOW_'] . '",'.
				'C_VIEW_="'. $dataRep['C_VIEW_'] . '",'.
				'C_CHANGE_="'. $dataRep['C_CHANGE_'] . '",'.
				'F_PREVAL_="'. $dataRep['F_PREVAL_'] . '",'.
				'F_POSVAL_="'. $dataRep['F_POSVAL_'] . '",'.
				'F_MESSAGE_="'. $dataRep['F_MESSAGE_'] . '",'.
				'F_FORMULA_="'. $dataRep['F_FORMULA_'] . '",'.
				'G_SHOW_="'. $dataRep['G_SHOW_'] . '",'.
				'G_CHANGE_="'. $dataRep['G_CHANGE_'] . '"'.
				'WHERE F_NAME_="'.$dataRep['F_NAME_'].'"';
		$DB2->Query( $query );

	}
	$DB2->Database = $Global['project'];

	// Writing in a local Repository
	$DB->Database = $Global['project'];
    $DB->Query('SELECT id FROM p_data WHERE F_NAME_="'.$dataRep['F_NAME_'].'"');
	$DB->NextRecord();
	if( empty( $DB->Record['id'] ) ){
		$query='INSERT INTO p_data ('.
				'F_NAME_, F_ALIAS_, F_HELP_, F_TYPE_, F_DSL_, F_MULTI_, '.
				'F_AUTONUM_, F_OPTIONS_, F_LINK_, F_REPORT_, F_MAKE_QUERY_, '.
				'F_QUERY_, F_QUERY_REF_, F_SEND_, F_RELATION_, F_RELTABLE_, '.
				'F_SHOWFIELD_,F_RELFIELD_,F_LOCALFIELD_,F_FILTER_,F_LENGTH_, '.
				'F_DEC_, F_BROW_, F_REQUIRED_, F_UNIQUE_, F_NODB_, F_TOTAL_, '.
				'F_EXTRA_, V_DEFAULT_, C_SHOW_, C_VIEW_, C_CHANGE_, F_PREVAL_, '.
				'F_POSVAL_, F_MESSAGE_, F_FORMULA_, G_SHOW_, G_CHANGE_) '.
				'VALUES ('.
				'"'. $dataRep['F_NAME_'] . '",'.
				'"'. $dataRep['F_ALIAS_'] . '",'.
				'"'. $dataRep['F_HELP_'] . '",'.
				'"'. $dataRep['F_TYPE_'] . '",'.
				'"'. $dataRep['F_DSL_'] . '",'.
				'"'. $dataRep['F_MULTI_'] . '",'.
				'"'. $dataRep['F_AUTONUM_'] . '",'.
				'"'. $dataRep['F_OPTIONS_'] . '",'.
				'"'. $dataRep['F_LINK_'] . '",'.
				'"'. $dataRep['F_REPORT_'] . '",'.
				'"'. $dataRep['F_MAKE_QUERY_'] . '",'.
				'"'. $dataRep['F_QUERY_'] . '",'.
				'"'. $dataRep['F_QUERY_REF_'] . '",'.
				'"'. $dataRep['F_SEND_'] . '",'.
				'"'. $dataRep['F_RELATION_'] . '",'.
				'"'. $dataRep['F_RELTABLE_'] . '",'.
				'"'. $dataRep['F_SHOWFIELD_'] . '",'.
				'"'. $dataRep['F_RELFIELD'] . '",'.
				'"'. $dataRep['F_LOCALFIELD_'] . '",'.
				'"'. $dataRep['F_FILTER'] . '",'.
				'"'. $dataRep['F_LENGTH_'] . '",'.
				'"'. $dataRep['F_DEC_'] . '",'.
				'"'. $dataRep['F_BROW_'] . '",'.
				'"'. $dataRep['F_REQUIRED_'] . '",'.
				'"'. $dataRep['F_UNIQUE_'] . '",'.
				'"'. $dataRep['F_NODB_'] . '",'.
				'"'. $dataRep['F_TOTAL_'] . '",'.
				'"'. $dataRep['F_EXTRA_'] . '",'.
				'"'. $dataRep['V_DEFAULT_'] . '",'.
				'"'. $dataRep['C_SHOW_'] . '",'.
				'"'. $dataRep['C_VIEW_'] . '",'.
				'"'. $dataRep['C_CHANGE_'] . '",'.
				'"'. $dataRep['F_PREVAL_'] . '",'.
				'"'. $dataRep['F_POSVAL_'] . '",'.
				'"'. $dataRep['F_MESSAGE_'] . '",'.
				'"'. $dataRep['F_FORMULA_'] . '",'.
				'"'. $dataRep['G_SHOW_'] . '",'.
				'"'. $dataRep['G_CHANGE_'] . '")';
		$DB->Query( $query );
			
	}
	else{
		$query='UPDATE p_data SET '.
				'F_ALIAS_="'. $dataRep['F_ALIAS_'] . '",'.
				'F_HELP_="'. $dataRep['F_HELP_'] . '",'.
				'F_TYPE_="'. $dataRep['F_TYPE_'] . '",'.
				'F_DSL_="'. $dataRep['F_DSL_'] . '",'.
				'F_MULTI_="'. $dataRep['F_MULTI_'] . '",'.
				'F_AUTONUM_="'. $dataRep['F_AUTONUM_'] . '",'.
				'F_OPTIONS_="'. $dataRep['F_OPTIONS_'] . '",'.
				'F_LINK_="'. $dataRep['F_LINK_'] . '",'.
				'F_REPORT_="'. $dataRep['F_REPORT_'] . '",'.
				'F_MAKE_QUERY_="'. $dataRep['F_MAKE_QUERY_'] . '",'.
				'F_QUERY_="'. $dataRep['F_QUERY_'] . '",'.
				'F_QUERY_REF_="'. $dataRep['F_QUERY_REF_'] . '",'.
				'F_SEND_="'. $dataRep['F_SEND_'] . '",'.
				'F_RELATION_="'. $dataRep['F_RELATION_'] . '",'.
				'F_RELTABLE_="'. $dataRep['F_RELTABLE_'] . '",'.
				'F_SHOWFIELD_="'. $dataRep['F_SHOWFIELD_'] . '",'.
				'F_RELFIELD_="'. $dataRep['F_RELFIELD_'] . '",'.
				'F_LOCALFIELD_="'. $dataRep['F_LOCALFIELD_'] . '",'.
				'F_FILTER_="'. $dataRep['F_FILTER_'] . '",'.
				'F_LENGTH_="'. $dataRep['F_LENGTH_'] . '",'.
				'F_DEC_="'. $dataRep['F_DEC_'] . '",'.
				'F_BROW_="'. $dataRep['F_BROW_'] . '",'.
				'F_REQUIRED_="'. $dataRep['F_REQUIRED_'] . '",'.
				'F_UNIQUE_="'. $dataRep['F_UNIQUE_'] . '",'.
				'F_NODB_="'. $dataRep['F_NODB_'] . '",'.
				'F_TOTAL_="'. $dataRep['F_TOTAL_'] . '",'.
				'F_EXTRA_="'. $dataRep['F_EXTRA_'] . '",'.
				'V_DEFAULT_="'. $dataRep['V_DEFAULT_'] . '",'.
				'C_SHOW_="'. $dataRep['C_SHOW_'] . '",'.
				'C_VIEW_="'. $dataRep['C_VIEW_'] . '",'.
				'C_CHANGE_="'. $dataRep['C_CHANGE_'] . '",'.
				'F_PREVAL_="'. $dataRep['F_PREVAL_'] . '",'.
				'F_POSVAL_="'. $dataRep['F_POSVAL_'] . '",'.
				'F_MESSAGE_="'. $dataRep['F_MESSAGE_'] . '",'.
				'F_FORMULA_="'. $dataRep['F_FORMULA_'] . '",'.
				'G_SHOW_="'. $dataRep['G_SHOW_'] . '",'.
				'G_CHANGE_="'. $dataRep['G_CHANGE_'] . '"'.
				'WHERE F_NAME_="'.$dataRep['F_NAME_'].'"';
		$DB->Query( $query );

	}
// ##### 7 end


} // writeDataRep() --------------------------------------------------------






/** change		Change a values of an object
 * 	====================================================
 *
 * @param	$link_name		name of the link (object)
 * @param	$link_type		type of link
 * @param	$object			object to change
 * @param 	$pass			passed data
 * 
 */

function change ( $link_name, $link_type, $object, $pass ) {

	global $T, $DB, $TF, $Global;
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link_name ) ) {
		sayerror( "EMPTY LINK_NAME (plusvalidate:change)");
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
//echo "<-- FILE $file -->\n";
//die();		
	}
	else {
		sayerror( "FILE $file DON'T EXIST (plusvalidate:change)");
	}

	// The file to write
	$filewrite = "project/".$Global['project']."/".$link_type.
				".".$link_name.".php";

	
	// Change accordly type of form

	// Data Formulary
	if ( $link_type == "data" ) {
		$pass = str_replace ('"', "'", $pass );						// #72
		$Obj->Change_Data( $filewrite, $object, $pass );
		cleanReturn();
		return;
	} 
	
	// DB Formulary
	if ( $link_type == "db" ) {
		$Obj->Change_DB( $object, $pass );
		cleanReturn();
		return;
	} 
	
	
	sayerror( "TYPE $link_type UNKNOW (plusvalidate:change)" );
	

} // change() ---------------------------------------------------------------




/** change_form		Change a properties of a formulary
 * 	====================================================
 *
 * @param	$link_name		name of the link (object)
 * @param	$link_type		type of link
 * @param	$object			object to change
 * @param 	$pass			passed data
 * 
 */

function change_form ( $link_name, $link_type, $object, $pass ) {

	global $T, $DB, $TF, $Global;
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link_name ) ) {
		sayerror( "EMPTY LINK_NAME (plusvalidate:change_form)");
	}

	// Localize a object - Priority to a system object (engine)
	if ( file_exists( "engine/".$Global['lang']."/" . $link_type . "." . $link_name . ".php" ) ) {
		$file = "engine/".$Global['lang']."/" . $link_type . "." . $link_name . ".php";
	}
	else {
		if( $link_type == 'rep' ){
			$file = "project/".$Global['project']."/reports/".
			$link_type.".".$link_name.".php";
		} else {
			$file = "project/".$Global['project']."/".
			$link_type.".".$link_name.".php";
		}
	}
	if ( file_exists( $file )) {
		include ( $file );
//echo "<-- FILE $file -->\n";
//die();		
	}
	else {
		sayerror( "FILE $file DON'T EXIST (plusvalidate:change_form)");
	}

	// The file to write
	if( $link_type == 'rep' ){
		$filewrite = "project/".$Global['project']."/reports/".
		$link_type . "." . $link_name;
	}else{
		$filewrite = "project/".$Global['project']."/".$link_type . ".".
		$link_name;
	}


	$pass = str_replace ('"', "'", $pass );							// #72
	$Obj->Change_DB_Form_el_2( $filewrite, $object, $pass );
	cleanReturn();
	

} // change_form() ----------------------------------------------------------


/** edit_change		Change a element of a DB Form
 * 	====================================================
 *
 * @param	$link_name		name of the link (object)
 * @param	$link_type		type of link
 * @param	$object			object to change
 * @param 	$pass			passed data
 * 
 */

function edit_change ( $link_name, $link_type, $object, $pass ) {

	global $T, $DB, $TF, $Global;
	
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link_name ) ) {
		sayerror( "EMPTY LINK_NAME (plusvalidate:insert_elem)");
	}
	// Localize a object - Priority to a system object (engine)
	$tmp = explode('.', $Global['full_link']);
	$formType = $tmp[0];
	if( $formType == 'rep' ){
		$file = "project/".$Global['project']."/reports/rep.".$link_name.".php";
	} else {
		$file = "project/".$Global['project']."/db.".$link_name.".php";
	}
	
	if ( file_exists( $file )) {
		include ( $file );
	}
	else {
		sayerror( "FILE $file DON'T EXIST (plusvalidate:insert_elem)");
	}

	// The file to write
	if( $formType == 'rep' ){
		$filewrite = "project/".$Global['project']."/reports/rep." .
					$link_name;
	} else {
		$filewrite = "project/".$Global['project']."/db." .
					$link_name;
	}
		
	$pass = str_replace ('"', "'", $pass );							// #72

	writeDataRep( $pass );  // # 7 - Data Repository

	$DB->Database = $Global['project'];
	$Obj->Database = $Global['project'];

	$Obj->Change_DB_Form_el( $filewrite, $object, $pass );
	cleanReturn();

} // edit_change() ----------------------------------------------------------






/** Delete an object
 * 	====================================================
 *
 * @param	$link_name		name of the link (object)
 * @param	$link_type		type of link
 * @param	$object			object to delete
 * 
 */

function delete ( $link_name, $link_type, $object ) {

	global $T, $DB, $TF, $Global;
//echo $link_name . "\n" . $link_type . "\n" . $object . "\n";	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link_name ) ) {
		sayerror( "EMPTY LINK_NAME (plusvalidate:delete)");
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
//echo "<-- FILE $file -->\n";
//die();		
	}
	else {
		sayerror( "FILE $file DON'T EXIST (plusvalidate:delete)");
	}

	// The file to write
	$filewrite = "project/".$Global['project']."/".$link_type.
				".".$link_name.".php";

	
	// delete accordly type of form
	
	// Data Formulary
	if ( $link_type == "data" ) {
		$Obj->Delete_Data( $filewrite, $object );
		cleanReturn();
		return;
	} 

	
	// DB Formulary
	if ( $link_type == "db" ) {

		$Obj->Delete_DB( $object );
		cleanReturn();
		return;
	} 
	
	
	sayerror( "TYPE $link_type UNKNOW (plusvalidate:delete)" );
	

} // delete() ---------------------------------------------------------------


/** delete_form		Delete a Formulary
 * 	====================================================
 *
 * @param	$link_name		name of the link (object)
 * @param	$link_type		type of link
 * @param	$object			object to delete
 * 
 */

function delete_form ( $link_name, $link_type, $object ) {

	global $T, $DB, $TF, $Global;
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link_name ) ) {
		sayerror( "EMPTY LINK_NAME (plusvalidate:delete_form)");
	}

	// Localize a object - Priority to a system object (engine)
	if ( file_exists( "engine/".$Global['lang']."/" . $link_type . "." . $link_name . ".php" ) ) {
		$file = "engine/".$Global['lang']."/" . $link_type . "." . $link_name . ".php";
	}
	else {
		if( $link_type == "rep" ) {
			$file = "project/".$Global['project']."/reports/".$link_type.".".$link_name.".php";
		} else {
			$file = "project/".$Global['project']."/".$link_type.".".$link_name.".php";
		}
	}
	if ( file_exists( $file )) {
		include ( $file );
	}
	else {
		sayerror( "FILE $file DON'T EXIST (plusvalidate:delete_form)");
	}

	// The file to write
	if( $link_type == "rep" ) {
		$filewrite = "project/".$Global['project']."/reports/".$link_type.
					".".$link_name.".php";
	} else {
		$filewrite = "project/".$Global['project']."/".$link_type.
					".".$link_name.".php";
	}

	
	// delete accordly type of form
	
	// Data Formulary
	if ( $link_type == "data" ) {
		$Obj->Delete_Data_form( $filewrite );
		cleanReturn();
		return;
	} 

	// Report Formulary
	if ( $link_type == "rep" ) {
		$Obj->Delete_Data_form( $filewrite );
		cleanReturn();
		return;
	} 
	
	// DB Formulary
	if ( $link_type == "db" ) {
		$Obj->Delete_DB_form( $filewrite );
		cleanReturn();
		return;
	} 
	
	
	sayerror( "TYPE $link_type UNKNOW (plusvalidate:delete_form)" );
	

} // delete_form() ----------------------------------------------------------



/** edit_delete		Delete a element of a db form
 * 	====================================================
 *
 * @param	$link_name		name of the link (object)
 * @param	$link_type		type of link
 * @param	$object			object to delete
 * 
 */

function edit_delete ( $link_name, $link_type, $object ) {

	global $T, $DB, $TF, $Global;
	
	// Define a object	
	$Obj = new Y_Engine();

	if ( empty ( $link_name ) ) {
		sayerror( "EMPTY LINK_NAME (plusvalidate:delete)");
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
//echo "<-- FILE $file -->\n";
//die();		
	}
	else {
		sayerror( "FILE $file DON'T EXIST (plusvalidate:delete)");
	}

	// The file to write
	$filewrite = "project/".$Global['project']."/".$link_type.
				".".$link_name.".php";

	
	
	// DB Formulary
	if ( $link_type == "db" ) {
		$Obj->Delete_DB_el( $filewrite, $object );
		cleanReturn();
		return;
	} 
	
	
	sayerror( "TYPE $link_type UNKNOW (plusvalidate:delete)" );
	

} // edit_delete() ----------------------------------------------------------






/** begin		Starts a transaction
	======================================================================*/
function begin() {
	global $DB, $Global;
	$DB->Begin();
	cleanReturn();
} // begin() ---------------------------------------------------------------

/** commit		Write a transaction
	======================================================================*/
function commit() {
	global $DB, $Global;
	$DB->Commit();
	cleanReturn();
} // commit() --------------------------------------------------------------


/** rollback		Cancel a transaction
	======================================================================*/
function rollback() {
	global $DB, $Global;
	$DB->Rollback();
	cleanReturn();
} // rollback() ------------------------------------------------------------


/** cleanReturn	print a formated data to a RPC return
	======================================================================*/
function cleanReturn(){
	global $Global;
	// Print a formated data
	// First, a identification of object and operation 
	$delimiter="`";
// ##### 30
	// To return a correct charset
	header("Content-type: text/javascript; charset=iso-8859-1");	
// ##### 30 end
	echo $delimiter . "_0" . $delimiter; 
	echo $Global['oper'] . $delimiter;
	echo $Global['oper'] . $delimiter;
	// Now, a number of rows and column of a responseText
	echo "_1" . $delimiter; 
	echo 0 . $delimiter;
	echo 0 . $delimiter;
	// The header of columns
	echo "_2" . $delimiter;
	echo 0 . $delimiter;
	// And the array with all information
	echo "_3" . $delimiter; 
	echo 0 . $delimiter;
	return;
		
} // cleanReturn() ---------------------------------------------------------
	
 
?>