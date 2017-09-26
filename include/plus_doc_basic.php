<?php


/** plus_doc_basic.php		Makes a simple documentation
 *  ====================================================
 *
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	May, 30 of 2005
 *
 */
 
Global $Global, $DB, $T;
	
// Starting Template	
$D = new Y_Template( "templates/doc.xul" );

switch ( $item ) {
	case 1: {
		$D->Set ( 'title', "Documentación Básica - " . $Global[ 'project' ] );
		$D->Show( 'title' );
		$D->Set ( 'item', "1 - Introducción" );
		$D->Show( 'item' );
		
		
		break;
	}	
		
		
	case 2: {
		$D->Set ( 'item', "2 - Menus" );
		$D->Show( 'item' );
		
		
		break;
	}
	
	case 3: {
		$D->Set ( 'item', "3 - Tablas" );
		$D->Show( 'item' );
		
		
		break;
	}
	
	case 4: {
		$D->Set ( 'item', "4 - Formularios" );
		$D->Show( 'item' );
		
		
		break;
	}
}


?>