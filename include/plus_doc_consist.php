<?php


/** plus_doc_consist.php		Makes a Consistence Report
 *  ======================================================
 *
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	August, 20 of 2005
 *
 */
 
Global $Global, $DB, $T;
	
// Starting Template	
$D = new Y_Template( "templates/doc.xul" );

switch ( $item ) {
	case 1: {
		$D->Set ( 'title', "Reporte de Consistencia - " . $Global[ 'project' ] );
		$D->Show( 'title' );
		$D->Set ( 'item', "1 - Trustees" );
		$D->Show( 'item' );
		$error = 0;
		
		// Checkin GROUPS
		$DB->Query( "SELECT * FROM p_groups WHERE id>1;" );
		$topic = "Trustee - ";
		while ( $DB->NextRecord() ) {
			$name 	= $DB->Record['name']; 
			$obs 	= $DB->Record['obs'];
			$trustee= $DB->Record['trustee'];
	
			// EMPTY PASSWORD
			if( ($trustee % 2) == 1 ) {
				$D->Set('content', 
				$topic . "Grupo [" . $name .
				"] - Tiene trustee como Developer" );
				$D->Show('content');
				$error++;
			}
		}
		
		
		// Checking USERS
		$DB->Query( "SELECT * FROM p_users WHERE id>1;" );
		$topic = "Trustee - ";
		while ( $DB->NextRecord() ) {
			$name 	= $DB->Record['name']; 
			$obs 	= $DB->Record['obs'];
			$trustee= $DB->Record['trustee'];
			$password=$DB->Record['password'];
	
			// EMPTY PASSWORD
			if( empty( $password ) ) {
				$D->Set('content', 
				$topic . "User [" . $name .
				"] - Sin password" );
				$D->Show('content');
				$error++;
			}
			
			// EMPTY TRUSTEE
			if( $trustee == 0 ) {
				$D->Set('content', 
				$topic . "User [" . $name .
				"] - Sin Trustee" );
				$D->Show('content');
				$error++;
			}
		}
			
		
		
		// Error Control
		if ( $error == 0 ) {
			$D->Set('content', "Trustees sin errores aparentes." );
			$D->Show('content');
		}
		else {
			if ( $error == 1 ) {
				$D->Set('content', "El sistema de trustees presenta UN error." );
				$D->Show('content');
			}
			else {
				$D->Set('content', "El sistema de trustees presenta " . $error . 
						" errores." );
				$D->Show('content');
			}
		}		
		echo "<br />";
	
		break;
	} // Trustees -----------------------------------------------------------	
		
	
	case 2: {
		$D->Set ( 'item', "2 - Menus" );
		$D->Show( 'item' );
	
		// Checking a data_form
		$Obj = new Y_Engine();
		$file = "project/" . $Global['project'] . "/data.menu__.base.php";
		include_once ( $file );
		$header = array();
		$menu	= array();
		$submenu= array();
		
		$key = array_keys( $Obj->element );
		for( $i=0; $i< count( $key ); $i++ ) {
			if ( $Obj->element[ $key[$i] ] [ F_TYPE_ ] == "header" ) {
				array_push( $header, 
					array( 
						'name' 	=>  $Obj->element[ $key[$i] ] [ F_NAME_ ],
						'alias' =>  $Obj->element[ $key[$i] ] [ F_ALIAS_ ],
						'help' 	=>  $Obj->element[ $key[$i] ] [ F_HELP_ ],
						'table' =>  $Obj->element[ $key[$i] ] [ R_TABLE_ ],
						'link' 	=>  $Obj->element[ $key[$i] ] [ F_LINK_ ],
						'show' 	=>  $Obj->element[ $key[$i] ] [ G_SHOW_ ]
					));	
			}
			if ( $Obj->element[ $key[$i] ] [ F_TYPE_ ] == "menu" ) {
				array_push( $menu, 
					array( 
						'name' 	=>  $Obj->element[ $key[$i] ] [ F_NAME_ ],
						'alias' =>  $Obj->element[ $key[$i] ] [ F_ALIAS_ ],
						'help' 	=>  $Obj->element[ $key[$i] ] [ F_HELP_ ],
						'table' =>  $Obj->element[ $key[$i] ] [ R_TABLE_ ],
						'link' 	=>  $Obj->element[ $key[$i] ] [ F_LINK_ ],
						'show' 	=>  $Obj->element[ $key[$i] ] [ G_SHOW_ ]
					));	
			}
			if ( $Obj->element[ $key[$i] ] [ F_TYPE_ ] == "submenu" ) {
				array_push( $submenu, 
					array( 
						'name' 	=>  $Obj->element[ $key[$i] ] [ F_NAME_ ],
						'alias' =>  $Obj->element[ $key[$i] ] [ F_ALIAS_ ],
						'help' 	=>  $Obj->element[ $key[$i] ] [ F_HELP_ ],
						'table' =>  $Obj->element[ $key[$i] ] [ R_TABLE_ ],
						'link' 	=>  $Obj->element[ $key[$i] ] [ F_LINK_ ],
						'show' 	=>  $Obj->element[ $key[$i] ] [ G_SHOW_ ]
					));	
			}
		}
		
		
		
		// STATISTICS
		$error = 0;			// Not errors at this point
		$badnames = array( 'asdf','sdf','qwe','ert','zxc','123' ); 
		
		// Checking a headers
		$topic = "Header [";
		$key = array_keys( $header );
		for( $i=0; $i< count( $key ); $i++ ) {
		
			// INADEQUATE HELP
			$help = $header[$key[$i]]['help'];
			if( strlen( $help ) < 5 ) {
				$D->Set('content', 
				$topic . $header[$key[$i]]['name'] .
				"] - Help Inadecuado (muy corto): [" . $help . "]" );
				$D->Show('content');
				$error++;
			}
			if( strtolower( $help ) == 
				strtolower ($header[$key[$i]]['name']) ) {
				$D->Set('content', 
				$topic . $header[$key[$i]]['name'] .
				"] - Help Inadecuado: (igual al nombre)" );
				$D->Show('content');
				$error++;
			}
			if( strtolower( $help ) == 
				strtolower ($header[$key[$i]]['alias']) ) {
				$D->Set('content', 
				$topic . $header[$key[$i]]['name'] .
				"] - Help Inadecuado: (igual al alias)" );
				$D->Show('content');
				$error++;
			}
			
			// INADEQUATE SHOW TRUSTEE
			$trustee = $header[$key[$i]]['show'];
			if( $trustee < 2 ) {
				$D->Set('content', 
				$topic . $header[$key[$i]]['name'] .
				"] - Trustee Inadecuado: [" . $trustee . "]" );
				$D->Show('content');
				$error++;
			}
		}
		echo "<br />";
		
		// Checking a menus
		$topic = "Menu [";
		$key = array_keys( $menu );
		for( $i=0; $i< count( $key ); $i++ ) {
		
			// INADEQUATE HELP
			$help = $menu[$key[$i]]['help'];
			if( strlen( $help ) < 5 ) {
				$D->Set('content', 
				$topic . $menu[$key[$i]]['name'] .
				"] - Help Inadecuado (muy corto): [" . $help . "]" );
				$D->Show('content');
				$error++;
			}
			if( strtolower( $help ) == 
				strtolower ($menu[$key[$i]]['name']) ) {
				$D->Set('content', 
				$topic . $menu[$key[$i]]['name'] .
				"] - Help Inadecuado: (igual al nombre)" );
				$D->Show('content');
				$error++;
			}
			if( strtolower( $help ) == 
				strtolower ($menu[$key[$i]]['alias']) ) {
				$D->Set('content', 
				$topic . $menu[$key[$i]]['name'] .
				"] - Help Inadecuado: (igual al alias)" );
				$D->Show('content');
				$error++;
			}
			
			// INADEQUATE SHOW TRUSTEE
			$trustee = $menu[$key[$i]]['show'];
			if( $trustee < 2 ) {
				$D->Set('content', 
				$topic . $menu[$key[$i]]['name'] .
				"] - Trustee Inadecuado: [" . $trustee . "]" );
				$D->Show('content');
				$error++;
			}
				
			// NO RELATION
			if( empty ( $menu[$key[$i]]['table'] ) ) {
				$D->Set('content', 
				$topic . $menu[$key[$i]]['name'] .
				"] - Sin relacion a header" );
				$D->Show('content');
				$error++;
			}
		}
		echo "<br />";
		
		// Checking a submenus
		$topic = "Submenu [";
		$key = array_keys( $submenu );
		for( $i=0; $i< count( $key ); $i++ ) {
		
			// INADEQUATE HELP
			$help = $submenu[$key[$i]]['help'];
			if( strlen( $help ) < 5 ) {
				$D->Set('content', 
				$topic . $submenu[$key[$i]]['name'] .
				"] - Help Inadecuado (muy corto): [" . $help . "]" );
				$D->Show('content');
				$error++;
			}
			if( strtolower( $help ) == 
				strtolower ($submenu[$key[$i]]['name']) ) {
				$D->Set('content', 
				$topic . $submenu[$key[$i]]['name'] .
				"] - Help Inadecuado: (igual al nombre)" );
				$D->Show('content');
				$error++;
			}
			if( strtolower( $help ) == 
				strtolower ($submenu[$key[$i]]['alias']) ) {
				$D->Set('content', 
				$topic . $submenu[$key[$i]]['name'] .
				"] - Help Inadecuado: (igual al alias)" );
				$D->Show('content');
				$error++;
			}
			
			// INADEQUATE SHOW TRUSTEE
			$trustee = $submenu[$key[$i]]['show'];
			if( $trustee < 2 ) {
				$D->Set('content', 
				$topic . $submenu[$key[$i]]['name'] .
				"] - Trustee Inadecuado: [" . $trustee . "]" );
				$D->Show('content');
				$error++;
			}

			// NO RELATION
			if( empty ( $submenu[$key[$i]]['table'] ) ) {
				$D->Set('content', 
				$topic . $submenu[$key[$i]]['name'] .
				"] - Sin relacion a menu" );
				$D->Show('content');
				$error++;
			}
					
		}
		
		// Error Control
		if ( $error == 0 ) {
			$D->Set('content', "Menus sin errores aparentes." );
			$D->Show('content');
		}
		else {
			if ( $error == 1 ) {
				$D->Set('content', "El sistema de menus presenta UN error." );
				$D->Show('content');
			}
			else {
				$D->Set('content', "El sistema de menus presenta " . $error . 
						" errores." );
				$D->Show('content');
			}
		}		
		echo "<br />";
		
/*


print_r( $header );		
print_r( $menu );		
print_r( $submenu );		
*/			
		break;
	}
	
	case 3: {
		$D->Set ( 'item', "3 - Tablas" );
		$D->Show( 'item' );
		$error = 0;

		
		
		
		
				
		// Error Control
		if ( $error == 0 ) {
			$D->Set('content', "Tablas sin errores aparentes." );
			$D->Show('content');
		}
		else {
			if ( $error == 1 ) {
				$D->Set('content', "El sistema de tablas presenta UN error." );
				$D->Show('content');
			}
			else {
				$D->Set('content', "El sistema de tablas presenta " . $error . 
						" errores." );
				$D->Show('content');
			}
		}		
		echo "<br />";
		
		
		break;
	}
	
	case 4: {
		$D->Set ( 'item', "4 - Formularios" );
		$D->Show( 'item' );
		$error = 0;
		
		
		
		// Error Control
		if ( $error == 0 ) {
			$D->Set('content', "Formularios sin errores aparentes." );
			$D->Show('content');
		}
		else {
			if ( $error == 1 ) {
				$D->Set('content', "El sistema de formularios presenta UN error." );
				$D->Show('content');
			}
			else {
				$D->Set('content', "El sistema de formularios presenta " . $error . 
						" errores." );
				$D->Show('content');
			}
		}		
		echo "<br />";
		
		
		break;
	}
}


?>