<?php


/** plusinternal.php		Interpreter to a internal funcions
 *  ==========================================================
 *
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	May, 30 of 2005
 *
 */
 

 
/** System Definitions
 */
 
 
header ("Content-type: application/vnd.mozilla.xul+xml; charset=iso-8859-15");
echo "<?xml version=\"1.0\"?> ";
echo "<?xml-stylesheet href=\"chrome://global/skin/\" type=\"text/css\"?>";

error_reporting(E_ALL ^ E_NOTICE);

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


//$T = new Y_Template( "templates/internal.xul" );
	
// ##### 13 
	if ( file_exists( "templates/internal.xul" )) {
		$T = new Y_Template( "templates/internal.xul" );
	}
	if ( file_exists( "templates/internal.xul.html" )) {
		$T = new Y_Template( "templates/internal.xul.html" );
	}

// ##### 13 end	
	



$T->Show('xml_header');
$T->LanguageVariables();

$T->Show( 'start_xul' );



$function   = $_GET['function'];		// Function to call
$par		= $_GET['par'];			// Parameters
$var		= $_GET['var'];			// Variable to return
$val		= $_GET['val'];			// Value of variable

$temp = explode( ",", $par );
for ( $i=0; $i<count($temp); $i++){
	if ( $temp[$i] != "_0_" ){
		$parameters[$i] = $temp[$i];
	}
	else {
		$i+=3;
	} 
}
// Calling a  Variable function
$function();

$T->Show( 'end_xul' );

// --------------------------------------------------------------------------



function group_trustee() {
	global $parameters, $var, $val, $T;
	
	// If a developer group
	if ( $val == 2147483647 ) {
		echo '<script> alert ("No se puede alterar el grupo Developer");';
		echo 'self.close(); </script>;';
	}
	
	$T->Set( 'title', "Seleccion de Trustee" );
	$T->Show('title');
	
	$numvar = -1;
	for( $i=0; $i<count( $parameters) ; $i+=2 ){
		$numvar ++;
		$T->Set( 'id',    $numvar );
		$T->Set( 'ref',   ($parameters[$i] -1) ); 
		$T->Set( 'label', $parameters[$i+1] );
//		if ( $val & ( pow(2,$numvar) ) ) {             // R6.1
		if ( $val & ( pow(2,($parameters[$i] -1)) ) ) {
			$T->Set( 'selected', 'checked="true"' );
		}
		else {
			$T->Set( 'selected', "" );
		}
		
		$T->Show( 'checkbox' );
	}

	$T->Set( 'name', "Aceptar" );
	$T->Set( 'help', "Aceptar los trustees elegidos");
	$T->Set( 'command', 'oncommand="gr_trustee('."'".$var."'".');"');
	$T->Show( 'applic_button');
	
	$T->Set( 'variables', $numvar );
	$T->Show( 'num_var' );
	
}


/*

function password() {
	global $parameters, $var, $val, $T;
	
	if ( $parameters[0] == $parameters[1] ) {
		$pass = crypt ( $parameters[0], 1 );
	}
	else {
		$pass = "error" ;
	}
	if ( strlen( $parameters[0] ) <6 ) {
		$pass = "len";
	}
	echo '<script>password("' . $pass. '","' . $var .'");';
	echo '</script>;';

}
*/



?>