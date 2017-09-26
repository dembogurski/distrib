<?php


/** plusdoc1.php		Makes a simple documentation
 *  ================================================
 *
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	May, 30 of 2005
 *
 */
 

 
/** System Definitions
 */
error_reporting(E_ALL ^ E_NOTICE);
$action  = $_GET['action'];
 
if( $action != 4 ) { 
//#147	header ("Content-type: application/vnd.mozilla.xul+xml; charset=iso-8859-1");
/*#147	echo "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?> ";
//#147	echo "<?xml-stylesheet href=\"chrome://global/skin/\" type=\"text/css\"?>";
*/
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
include_once ("include/Y_Template.class.php");   // A template class

// ##### 13 
if ( file_exists( "templates/base.xul" )) {
	$T = new Y_Template( "templates/base.xul" );
}
if ( file_exists( "templates/base.xul.html" )) {
	$T = new Y_Template( "templates/base.xul.html" );
}
// ##### 13 end


if( $action != 4 ) { 
//#147	$T->Show('xml_header');
//#147	$T->LanguageVariables();
}

// Date definition
setlocale(LC_ALL, LOCALE_ );
$date = strftime( DATEFORMAT_, time() );

 

// Constants definitions - Type of documentation
define( 'USER_',			0 );
define( 'BASIC_',			1 );
define( 'ADVANCED_',		2 );
define( 'CONSIST_',		 	3 );
define( 'DIA_',		 		4 );
define( 'DICT_',		 	5 );

// Load a common functions
include_once ( "include/functions.php" );

$version = $_GET['v'];
$Global = start_session( $session, $version );


// Select a project
$project = $_GET['project'];
if (empty( $project )) {
	echo "NO PROJECT!!!!";
	die();
}
$Global['project'] = $project;

// Database Abstration Layer
include_once "include/Y_DB.class.php";
$DB = new Y_DB();

// Atribute a database
$DB->Database = $project;

$action  = $_GET['action'];
$session = $_GET['sess'];
$item	 = $_GET['item'];



switch ( $action ) {


  case USER_:
		include ( "include/plus_doc_user.php" );
 		break;
  		
  case BASIC_:
		include ( "include/plus_doc_basic.php" );
  		break;
  		
  case ADVANCED_:
		include ( "include/plus_doc_advanced.php" );
  		break;
  		
  case DICT_:
		include ( "include/plus_doc_datadict.php" );
  		break;
  		
  case CONSIST_:
  		if ( $item == 100 ) {
			consist( 1 );
			consist( 2 );
			consist( 3 );
			consist( 4 );
		}
  		consist( $item );
  		break;
  case DIA_:
		include ( "include/plus_doc_dia.php" );
  		break;
					
  default:
      die ( "Invalid code action in input of page (plusexec)");
	  
} 

// --------------------------------------------------------------------------
 
 
function consist( $item ) {
	include ( "include/plus_doc_consist.php" );
}

?>