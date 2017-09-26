<?php

/*
  ----------------------------------------------------------
 | plus.php		main plus program							|
 |----------------------------------------------------------|
 |															|
 | @author		Sergio A. Pohlmann <sergio@ycube.net>		|
 | @date		May, 24 of 2005								|
 | @copyright	ycube.net									|
 |															|
  ----------------------------------------------------------
  
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


 
header ("Content-type: application/vnd.mozilla.xul+xml; charset=iso-8859-1");
echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?> ";
echo "<?xml-stylesheet href=\"chrome://global/skin/\" type=\"text/css\"?>";
error_reporting(E_ALL ^ E_NOTICE);

// Load a common functions
include_once ( "include/functions.php" );

// Configure a multilanguage system 
if ( file_exists( "config/Y_Language_Config.php" )) {
    include_once ( "config/Y_Language_Config.php");
}

// Starting Template
include_once ("include/Y_Template.class.php"); 

// ##### 13
if ( file_exists( "templates/base.xul" )) {
	$T = new Y_Template( "templates/base.xul" );
}
if ( file_exists( "templates/base.xul.html" )) {
	$T = new Y_Template( "templates/base.xul.html" );
}
// ##### 13

$T->Show('xml_header');
$T->LanguageVariables();

// Date definition
setlocale(LC_ALL, LOCALE_ );
$date = strftime( DATEFORMAT_, time() );


// Constants definitions
define( 'LOGIN_',		1 );
define( 'CHECKLOGIN_', 	2 );

define( 'REL_OLD_',		20);
define( 'RELEASES_',	21);

// System Definitions -------------------------------------------------------




// Select a project
$project= $_GET['project'];
if (empty( $project )) {
	$project = "plus";
}
 
// Database Abstration Layer
include_once "include/Y_DB.class.php";

// And defines a database class
$DB = new Y_DB();
// Atribute a database
$DB->Database = $project;



//echo "<!-- $project -->\n";
// Determine a user and password
$username 	= $_GET['user'];
$pass 		= $_GET['pass'];
$session	= $_GET['sess'];
$ok   		= $_GET['ok'];
$secure 	= $_GET['secure'];

$Global['username'] = $username;
$Global['project'] 	= $project;
$Global['user'] 	= $ok;
$Global['session']	= $session;
$Global['version']	= "";


// Check if the project exist

// #### 15 - Auto create new projects
if( !file_exists( "project/") ) {
	$T->Set( 'project', $Global['project'] );
//	$T->Set( 'onkey', $command );
	$T->Show( 'start_xul' );
	$T->Show( 'start_login' );
	$T->Show( 'project_error' );
	$T->Show( 'end_login' );
	$T->Show('end_xul');
	die();
}

// Check and create a menu and data base if not exist

$Create = new Y_DB();
$Create->Database = '';
$Create->Query( "CREATE DATABASE IF NOT EXISTS ".$project );


// ##### 19 
// Create a directory, if no exist
if( !file_exists( "project/" . $project ) ) {
	$desc = mkdir( "project/" . $project );
}
// ##### 19 end

if( !file_exists( "project/" . $project . "/data.menu__.base.php") ) {
	$desc = fopen( "project/" . $project . "/data.menu__.base.php", "a" );
	
	$text= "<?php \n".
	"/** data.menu__.base.php	Menu Principal    ( data_form )\n".
	" * \n".
	" * @author 	ycube RAD Plus ( automatically Generated ) \n".
	" * \n".
	" */\n".
	" \n".
	"\$Obj->alias = \"".$Global['project']."\";\n".
	"\$Obj->doc = \"Principal\";\n".
	"\$Obj->help = \"Principal menu\";\n".
	"?>";	
    fputs( $desc, $text . "\n" );
    fclose( $desc );

}



//																	} #73 

// Select an action 
$action = $_GET[action];
if (empty( $action )) {
    $action = LOGIN_;
}

switch ( $action ) {
  case LOGIN_:
  		login( $ok );
		break;
  case CHECKLOGIN_:
  		checklogin( $pass );
		break;
  case SHOW_MAIN_:
  		show_main();
  		break;
  
 		
  // Show a release data Old version	
  case REL_OLD_:
  		releases( 'old' );
		break;
  // Show a release data 	
  case RELEASES_:
  		releases( 'new' );
		break;
 
  default:
      die ( "Invalid code action in input of page ");
	  
} // ------------------------------------------------------------------------


/** login	Makes a login in the system
 */
 
function login( $ok ) {

	global $T, $Global, $DB;
	
	// Check and destroy if exist a anterior seccion
	$session = $Global['session'];
	if( !empty($session)){
		$qry = 'DELETE FROM p_session WHERE serial ="'.$session.'"';
		$DB->Query($qry);
	}
	
	// Define variables
	$T->Set( 'project', $Global['project'] );
	$command="oncommand=\"loginCmd('" . $Global['project'] . "')\"";
	$T->Set( 'onkey', $command );
	// Start a xul page
	$T->Show( 'start_xul' );
	includeJS( "base.js" );
	$T->Show( 'start_login' );
	
	if( $ok == 9999 ) {
		$T->Show( 'login_error' );
	}
	
	$T->Show( 'get_login' );
	echo "<button label=\"System Login\" id=\"login\" $command />\n";
	$T->Show( 'end_login' );
	
	// End of xul page
	$T->Show('end_xul');

 
} // login() ----------------------------------------------------------------





/** checklogin	Makes a login in the system
 */
 
function checklogin( $pass ) {


	global $T, $DB, $Global;
	
	$project=$Global['project'];
	$user	=$Global['user'];

 	$trustee = pow( 2, 31) -1;   // Developer trustee

	// Checking a GROUP Table
	$qry='CREATE TABLE IF NOT EXISTS p_groups ( ' . 
		 'id 		INT 	UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, ' .
		 'name		VARCHAR(40) UNIQUE, ' .
		 'obs		VARCHAR(60), ' .
		 'trustee	BIGINT UNSIGNED ) TYPE=INNODB;';
	$DB->Query( $qry );

	// Check if the developer user exist
	$DB->Query( 'SELECT * FROM p_groups WHERE name="Developer"' );

	
	$DB->NextRecord();

	if ( empty( $DB->Record ) ) {
		 $DB->Query( 'INSERT INTO p_groups ( id, name, obs, trustee ) ' .
		 			 'VALUES ( NULL, "Developer", "Plus Developer", ' .
					 $trustee . ') ');
	} 

	// Checking a SESSION Table
	$qry='CREATE TABLE IF NOT EXISTS p_session ( ' . 
		 'id 		BIGINT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, ' .
		 'user		INT		UNSIGNED, ' .
		 'ip		VARCHAR(15), ' .
		 'day		CHAR(2), ' .		 
		 'serial	VARCHAR(60), ' .
		 'name		VARCHAR(40), ' .
		 'project	VARCHAR(20), ' .
		 'transp1	BLOB, ' .
		 'transp2	BLOB, ' .
		 'trustee	BIGINT UNSIGNED, ' .
		 'INDEX(serial) ) TYPE=INNODB;';
	$DB->Query( $qry );
	
	
	// Checking a USER Table
	$qry='CREATE TABLE IF NOT EXISTS p_users ( ' . 
		 'id 		INT 	UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, ' .
		 'name		VARCHAR(40) UNIQUE, ' .
		 'obs		VARCHAR(60), ' .
		 'resh		INT UNSIGNED, ' .
		 'resv		INT UNSIGNED, ' .
		 'local		VARCHAR(60), ' .
		 'lang		VARCHAR(2), '.
		 'trustee	BIGINT UNSIGNED, ' .
		 'password	VARCHAR(20) ) TYPE=INNODB;';
	$DB->Query( $qry );
	
	// Checking a INTEGR Table
	$qry='CREATE TABLE IF NOT EXISTS p_ref_int ( ' . 
		 'id 	INT 	UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, ' .
		 '_dep_table	VARCHAR(20), ' .
		 '_dep_field	VARCHAR(15), ' .
		 '_ref_table	VARCHAR(20), ' .
		 '_ref_field	VARCHAR(15), ' .
		 '_operation	VARCHAR(10) ) TYPE=INNODB;';
	$DB->Query( $qry );
	
	// Check if the developer user exist
	$DB->Query( 'SELECT * FROM p_users WHERE name="Developer"' );
	$DB->NextRecord();
	if ( empty( $DB->Record ) ) {
		$psw = crypt( "plus" , 1 );
		$DB->Query( 'INSERT INTO p_users ' . 
					' ( id, name, obs, trustee, password ) ' .
		 			'VALUES ( NULL, "Developer", "Plus Developer", ' . 
					$trustee . ', "' . $psw . '" ) ');
	} 

	$qry='CREATE TABLE IF NOT EXISTS p_log ( ' . 
		 'id 		INT 	UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, ' .
		 'year		CHAR (4), ' .
		 'month		CHAR (2), ' .
		 'day		CHAR (2), ' .
		 'hour		CHAR (2), ' .
		 'minute	CHAR (2), ' .
		 'second 	CHAR (2), ' .
		 'user		VARCHAR(20), ' .
		 'action	VARCHAR(80), ' .
		 'status	CHAR (2), ' .
		 'obs		VARCHAR(250) ) TYPE=INNODB;';
	$DB->Query( $qry );
	

	// Client IP number	
	$ip = getenv( 'REMOTE_ADDR' );

	// Check if the user exist
	$user 		= $Global['user'];
	$username 	= $Global['username'];
	$DB->Query( 'SELECT * FROM p_users WHERE name="' . $username . '";' );
	$psw = crypt ( $pass, 1 );
	$DB->NextRecord();
	if ( ! empty( $DB->Record ) ) {
		if ( $psw == $DB->Record['password'] ) {
			
			if ( (strlen( $pass ) >5) || $username == "Developer" ) {
				$user=$DB->Record['id'];
				$Global['user'] = $user;
				$username=$DB->Record['name'];
				$Global['username'] = $username;

				$T->Show('start_xul');
				includeJS( "base.js" );
				
				// Window dimensin control
				$resh = $DB->Record['resh'];
				$resv = $DB->Record['resv'];
				if( ($resh != 0) && ($resv != 0) ){
					echo "<script> window.resizeTo(".$resh.",".$resv.")</script>\n";
				}
				else{
					echo "<script> window.resizeTo(800,600)</script>\n";
				}
				
				$trustee=$DB->Record['trustee'];
				$Global['lang']=$DB->Record['lang'];
				if($Global['lang']=='' ){
					$Global['lang']='en';
				}
//				$Global['trustee'] = $trustee;
				$Global['trustee'] = trustee();

				// Make a audit log
				audit_log ( $username, 'Login at ' . $ip, 'OK', '' );
			
				// Check if exist a project directory
				if( !file_exists( "./project/".$Global['project']."/reports")) {
					mkdir("./project/".$Global['project']."/reports",0777);
					mkdir("./project/".$Global['project']."/reports/config",0777);
				}
	
				// Check for a new version
				checkNewVersion();

				// Prepare a session 
				$session = set_session();

				$version = $Global['version']."|". $user ."|". $username .
				"|" . $Global['trustee']."|" . $Global['lang'];
				echo "<script>gotoPlusexec( 0," .
					 " '$session', '$project', '$version' );";
				echo "</script>";
				$T->Show('end_xul');	
				die();
			}

		}
		else {

			
			// Make a audit log
			audit_log ( $username, 'Try Login at ' . $ip, 'NO',
	 					'Invalid password' );	
		}
	}
	else {
		// Make a audit log
		audit_log ( '_no_user_', $user . ' try Login at ' . $ip, 'NO',
	 				'Invalid username' );
	}
	
	$user="9999";
	$T->Show('start_xul');
	includeJS( "base.js" );
	echo "<script>gotoPlus( 0, $user, '$project' ); </script>";
	$T->Show('end_xul');
} // checklogin() -----------------------------------------------------------




function releases ( $version ) {

	global $T;
	
	if ( $version == "old" ) {
		$file = "config/plus_release.txt";
	}
	else {
		$file = "config/plus_releases.txt";
	}
		
	$array =  file( $file) ;	
	
	
	
	$T->Show('start_xul');
	includeJS( "base.js" );
	$T->Show( 'start_comment' );
	
	for ( $i=0; $i<count($array); $i++ ) {
		
		$line = explode( "_:", $array[$i] );
		if ( $line[0] =="R" ) {
			$T->Set( 'number', trim($line[1]) );
		}
		if ( $line[0] =="F" ) {
			$T->Set( 'date', trim($line[1]) );
			$T->Show( 'start_comment_line' );
		}
		if ( $line[0] =="C" ) {
			$T->Set( 'comment', trim($line[1]) );
			$T->Show( 'comment_line' );
		}
		if ( $line[0] =="S" ) {
			$T->Show( 'end_comment_line' );
		}
	
	}
		
	$T->Show( 'end_comment' );
	
	$T->Show('end_xul');
	


} // releases() -------------------------------------------------------------


/**
 * checkNewVersion		To verify if have a new version on the server
 *
 */
function checkNewVersion() {

	global $DB, $Global;
	$DB->Database = $Global['project'];
	// Checking a version table
	$qry='CREATE TABLE IF NOT EXISTS p_version ( ' . 
		 'id 		INT 	UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, ' .
		 'dbversion	VARCHAR(10), ' .
		 'dbrelease	VARCHAR(10) ) TYPE=INNODB;';
	$DB->Query( $qry );
	
	// Checking a db version
	$DB->Query( "SELECT dbversion, dbrelease FROM p_version where id=1");
	$DB->NextRecord();
	if( empty( $DB->Record )) {
		$DB->Query( "INSERT INTO p_version ( id, dbversion, dbrelease) ". 
					"values( null, '1.0', '0' )");
		$dbVersion = '1.0';
		$dbRelease = '0';
	}
	else {
		$dbVersion = $DB->Record['dbversion'];
		$dbRelease = $DB->Record['dbrelease'];
	}
	
	// Checking a Release version
	$file = "config/plus_releases.txt";
	$array =  file( $file) ;	
	$line = explode( "_:", $array[0] );
	$release = trim($line[1]);
	$version = trim($line[2]) ;

	$Global['version'] = $version.".".$release;

	if( $release != $dbRelease ){
		releaseChange( $version, $release );
	}

	// Makes a Call to a Function "autostast" if exist 
	// ------------------------------------------------
	$DB->Query('SELECT name FROM p_proc WHERE name="autostart"');
	$DB->NextRecord();
	if( !empty( $DB->Record ) ) {
	    $DB->Query("SELECT autostart( \"".$Global['username']."\")" );
	}
	
} // checkNewVersion()------------------------------------------------------



/**
 * releaseChange		Change a actual release and make a actualizations
 *
 */
function releaseChange( $version, $release ) {
	
	global $DB, $Global;
	$DB->Database = $Global['project'];
	
	//																{ # 107
	// Making a DB Tables Changes
	// ==========================
	// Load a Engine class
	$directory =  "project/" . $Global['project'] ;
	$dir = opendir ( $directory ) ; 
	include_once ( "include/Y_Engine.class.php" );

	// Stored procedure control
	// =====================================================================
	$qry='CREATE TABLE IF NOT EXISTS p_proc ( ' . 
		 'id 		INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, ' .
		 'name			VARCHAR(20), ' .
		 'descr			VARCHAR(60), ' .
		 'doc			VARCHAR(255), '.
		 'type			VARCHAR(10), ' .
		 'parameters	VARCHAR(255), ' .
		 'returns		VARCHAR(255), ' .
		 'body			BLOB ) TYPE=INNODB;';
	$DB->Query( $qry );
	

// ##### 7	
	// Data Repository
	// =====================================================================
	
	$DB->Query( "CREATE DATABASE IF NOT EXISTS ".$DB->GenData );
	
	$qry='CREATE TABLE IF NOT EXISTS p_data ( ' . 
		 'id 		INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, ' .
		 'F_NAME_		VARCHAR(60), ' .
		 'F_ALIAS_		VARCHAR(200), ' .
		 'F_HELP_		VARCHAR(200), ' .
		 'F_TYPE_		VARCHAR(60), ' .
		 'F_DSL_		VARCHAR(200), ' .
		 'F_MULTI_		VARCHAR(2), ' .
		 'F_AUTONUM_	VARCHAR(2), ' .
		 'F_OPTIONS_	VARCHAR(200), ' .
		 'F_LINK_		VARCHAR(60), ' .
		 'F_REPORT_		VARCHAR(60), ' .
		 'F_MAKE_QUERY_	VARCHAR(2), ' .
		 'F_QUERY_		VARCHAR(200), ' .
		 'F_QUERY_REF_	VARCHAR(200), ' .
		 'F_SEND_		VARCHAR(200), ' .
		 'F_RELATION_	VARCHAR(60), ' .
		 'F_RELTABLE_	VARCHAR(60), ' .
		 'F_SHOWFIELD_	VARCHAR(60), ' .
		 'F_RELFIELD_	VARCHAR(60), ' .
		 'F_LOCALFIELD_	VARCHAR(60), ' .
		 'F_FILTER_		VARCHAR(100), ' .
		 'F_LENGTH_		VARCHAR(10), ' .
		 'F_DEC_		VARCHAR(5), ' .
		 'F_BROW_		VARCHAR(2), ' .
		 'F_REQUIRED_	VARCHAR(2), ' .
		 'F_UNIQUE_		VARCHAR(2), ' .
		 'F_NODB_		VARCHAR(2), ' .
		 'F_TOTAL_		VARCHAR(2), ' .
		 'F_EXTRA_		VARCHAR(2), ' .
		 'V_DEFAULT_	VARCHAR(200), ' .
		 'C_SHOW_		VARCHAR(200), ' .
		 'C_VIEW_		VARCHAR(200), ' .
		 'C_CHANGE_		VARCHAR(200), ' .
		 'F_PREVAL_		VARCHAR(200), ' .
		 'F_POSVAL_		VARCHAR(200), ' .
		 'F_MESSAGE_	VARCHAR(200), ' .
		 'F_FORMULA_	VARCHAR(200), ' .
		 'G_SHOW_		VARCHAR(200), ' .
		 'G_CHANGE_		VARCHAR(200) ) TYPE=INNODB;';
	$DB->Query( $qry );	 // Local repository
	
	$DB2 = new Y_DB();
	$DB2->Database = $DB2->GenData;
	$DB2->Query( $qry ); // Global repository


	$DB2 = new Y_DB();
	// Atribute a database
	$DB2->Database = $Global['project'];
	$DB2->Query( "SELECT name FROM p_proc;" );
	while( $DB2->NextRecord() ) {
//		$DB->NextRecord();
		prepareProcedure(  $DB2->Record['name']  );		
	}
	while( $filename = readdir ( $dir ) ) {
		$temp = explode( ".", $filename );
		if( $temp[0] == "db" ) {
			$Obj = "";
			$Obj = new Y_Engine();		
			include ( $directory . "/" . $filename );

			if( $release >= 8 ){
			// Data Repository
				$keydef = array_keys( $Obj->element );	
				for( $i=0; $i< count( $keydef ); $i++ ) {
					$element = $keydef[$i];
					$key = array_keys ($Obj->element[$element]);
					$list = '';
					for( $j=0; $j<count($key); $j++) {
						$list.= $key[$j] .',';
						$list.= $Obj->element[$element][$key[$j]] . ',';
					}
					writeDataRep( $list );
				}
			}

// ##### 29
			// CHANGES A LOCK CONDITION - KILL IN ABOVE VERSIONS
			if( $release > 28 ){
				if( $Obj->Noedit==1 ){
					$Obj->NoInsert=1;
				}
			}
// ##### 29 end			

			$Obj->Write_DB_Form_el($directory . "/". $filename);
		}
	}


	// Makes a Call to a Function "release_xx" if exist 
	// ------------------------------------------------
	$DB->Query('SELECT name FROM p_proc WHERE name="release_'.$release.'"');
	$DB->NextRecord();
	if( !empty( $DB->Record ) ) {
	    $DB->Query("SELECT release_$release( \"".$Global['username']."\")" );
	}

	// Actualize a DB version data
	$DB->Query("UPDATE p_version SET dbversion='" . $version . 
				"', dbrelease='" . $release ."';" );
				
				
	
				
	
} // releaseChange() -------------------------------------------------------




/** prepareProcedure	Prepare a Stored Procedure or function
 *	====================================================================
 *
 */
function prepareProcedure( $procName ) { 
	global $DB, $Global;
	$Proc = new Y_DB();
	// Atribute a database
	$Proc->Database = $Global['project'];
	$Proc->Query( 'SELECT * FROM p_proc WHERE name="'.$procName.'";');
	$Proc->NextRecord();
	
// ##### 31
	// Correction to a MySQL FLOAT error
	$procName 		= $Proc->Record['name'];
	$procType 		= $Proc->Record['type'];
	$procParameters = str_replace 
					("FLOAT", "DOUBLE",$Proc->Record['parameters']);
	$procReturns 	= str_replace 
					("FLOAT", "DOUBLE",$Proc->Record['returns']);
	$procBody 		= str_replace 
					("FLOAT", "DOUBLE",$Proc->Record['body']);
/* OLD in # 31	
	$procName 		= $Proc->Record['name'];
	$procType 		= $Proc->Record['type'];
	$procParameters = $Proc->Record['parameters'];
	$procReturns 	= $Proc->Record['returns'];
	$procBody 		= $Proc->Record['body'];
*/ 
// ##### 31 end


	if( $procType == "PROCEDURE" ){
		$Proc->Query ( "DROP PROCEDURE IF EXISTS ".$procName .";");
		$query = "CREATE PROCEDURE ". $procName ."(" . $procParameters .")";
	}
	else{
		$Proc->Query ( "DROP FUNCTION IF EXISTS ".$procName .";");
		$query = "CREATE FUNCTION ". $procName ."(" . $procParameters .
		") RETURNS ".$procReturns." DETERMINISTIC "; 
	}
	$query .= $procBody;
	$Proc->Query( $query );
	
// ##### 31
	// Correction to a MySQL FLOAT error
	$Proc->Query("UPDATE p_proc SET ".
			"parameters=\"". addslashes($procParameters)."\", ".
			"returns=\"".addslashes($procReturns)."\", ".
			"body=\"".addslashes($procBody).
			"\" WHERE name=\"$procName\"; " );
// ##### 31 end				

} // prepareProcedure() ------------------------------------------------








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
				'"",'.
				'"")';
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
				'G_SHOW_="",'.
				'G_CHANGE_=""'.
				'WHERE F_NAME_="'.$dataRep['F_NAME_'].'"';
		$DB2->Query( $query );

	}
	$DB2->Database = $Global['project'];

	// Writing in a local Repository
	$DB = new Y_DB();
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




 
?>