<?php


/** plusmenu.php		Interpreter to a menu system
 *  ================================================
 *
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	May, 30 of 2005
 *
 */


/** show_menu	Shows a main menu of a system
 */
 
function show_menu() {

	global $T, $DB, $Global;
	
	// Define variables
	$T->Set( 'command', 'oncommand="menuAction (this.id,'. "'" . 
			 $Global[ 'session'] . "'" .', ' . "'" . $Global['project'] . 
			 "'" . ')"'); 
	// Start a xul page
	
	$Obj = new Y_Engine();

	$file = "project/" . $Global['project'] . "/data.menu__.base.php";
	include_once ( $file );
	
	$file = "engine/".$Global['lang']."/data.devmenu__.php";
	if( file_exists( $file )){
		include_once ( $file );
	}
	else{
		$file = "engine/en/data.devmenu__.php";
		include_once ( $file );
	}

	$T->Set( 'version', $Global['version'] );

	// Making a menu
	$T->Set( 'user'		, $Global['username'] ) ;
	$T->Set( 'title'  	, $Obj->GetAlias());
	$T->Set( 'project'	, $Global['project'] );
	$T->Show('start_menu');


//print_r( $Obj );

	$key = array_keys( $Obj->element );
	for( $i=0; $i< count( $key ); $i++ ) {
		$i_element = $key[$i];

		if ( $Global['oper'] != MENU_ONLY_ ) {
			$T->Set( 'disabled', 'disabled="true"' );
		}
				
		// Menu header
		if ( $Obj->element[ $key[$i] ] [ F_TYPE_ ] == "header" ) {

			$headername = $Obj->Get( $i_element, F_ALIAS_ );
			if ( ($Global['oper'] != MENU_ONLY_ ) && 
				 ( $headername != "+" )  ) {
				$T->Set( 'disabled', 'disabled="true"' );
			}
			else {
				$T->Set( 'disabled', '' );
			}
			
			
			
			$T->Set( 'alias', $Obj->Get( $i_element, F_ALIAS_ ) );
			$T->Set( 'name',  $Obj->Get( $i_element, F_NAME_  ) );
				
				// se houver problemas com os popups pode ser NAME
			$T->Set( 'popup', $Obj->Get( $i_element, F_ALIAS_ )  . ".popup" );	
			$T->Set( 'help',  $Obj->Get( $i_element, F_HELP_ ) );
			$oper = $Obj->Get( $i_element, F_OPER_ );
			if ( empty( $oper ) ) {
				$oper = BROWSE_;
			}
			
			$t_oper = explode( "_", $oper );
			$oper = $t_oper[0];
			
			
			$T->Set( 'command', 'oncommand="menuAction ('.$oper.','. "'" . 
				 $Global[ 'session'] . "'" .', ' . "'" . $Global['project'] . 
				 "','" . $Obj->Get( $i_element, F_LINK_ ) . "',0" . ')"'); 
			
			// Define trustee
			$trustee['header'] = check_trustee( 
					$Obj->Get( $i_element, G_SHOW_ ) )	;		
			if ( $trustee['header'] ) {
				$T->Show( 'menu_header' );
			}
			
			// Menu Elements
			$header = $Obj->Get( $i_element, F_NAME_) ;
			$element = "0_";
//			for ( $b=$i; $b< count( $Obj->element ); $b++ ){
			for ( $b=0; $b< count( $Obj->element ); $b++ ){
				$b_element = $key[$b];			
				if ( ($Obj->Get( $b_element, F_TYPE_ ) == "menu" ) &&
					 ($Obj->Get( $b_element, R_TABLE_ ) == $header )) {
					$T->Set( 'e_alias', $Obj->Get( $b_element, F_ALIAS_) );
					$T->Set( 'e_name', 	$Obj->Get( $b_element, F_NAME_)  );
					$T->Set( 'e_popup', $Obj->Get( $b_element, F_ALIAS_) . ".popup" );	
					$T->Set( 'e_help', 	$Obj->Get( $b_element, F_HELP_ ) );
					$oper = $Obj->Get( $b_element, F_OPER_ );

					
					if ( $Global['oper'] != MENU_ONLY_ ) {
						if ( $headername != "+" ) {
							break; 
						}
					}
					
										
					if ( empty( $oper ) ) {
						$oper = BROWSE_;
					}


					$t_oper = explode( "_", $oper );
					$oper = $t_oper[0];
	

	

// # 162
					
					$T->Set( 'command', 'oncommand="menuAction ('.$oper.
						','. "'" . $Global[ 'session'] . "'" .', ' . 
						"'" . $Global['project'] . 	"','" . 
						$Obj->Get( $b_element, F_LINK_ ) . "',0,'" . 
						$Obj->Get( $b_element, F_FILTER_ )."'".')"'); 
					
/* OLD
					$T->Set( 'command', 'oncommand="menuAction ('.$oper.
						','. "'" . $Global[ 'session'] . "'" .', ' . 
						"'" . $Global['project'] . 
						"','" . $Obj->Get( $b_element, F_LINK_ ) . "',0" . ')"'); 
*/
// # 162 end 


					// Define trustee
					$trustee['element'] = check_trustee( 
					$Obj->Get( $b_element, G_SHOW_ ) )	;		
					
					if ( ($element == "0_") && ( $trustee['header'] )) {
						$T->Show( 'menu_header_startpopup' );
					}	

					// Submenus
					$element = $Obj->Get( $b_element, F_NAME_ );
					$submenu = "0_";
//					for ( $c=$b; $c< count( $Obj->element ); $c++ ){
					for ( $c=0; $c< count( $Obj->element ); $c++ ){
						$c_element = $key[$c];					
						if (($Obj->Get( $c_element, F_TYPE_) == "submenu") &&
						 		($Obj->Get( $c_element, R_TABLE_) ==
								 $element))  {
							$T->Set( 'alias',  $Obj->Get( $c_element, F_ALIAS_) );
							$T->Set( 'name',   $Obj->Get( $c_element,F_NAME_)   );
							$T->Set( 'help',   $Obj->Get( $c_element, F_HELP_ ) );
							$oper = $Obj->Get( $c_element, F_OPER_ );
							
// # 162
							$filter = $Obj->Get( $c_element, F_FILTER_ );
// # 162 							

							if ( empty( $oper ) ) {
								$oper = BROWSE_;
							}
							
							$t_oper = explode( "_", $oper );
							$oper = $t_oper[0];
							
							
		
// # 162		
							$T->Set('command','oncommand="menuAction('.$oper.
								','."'". 
							 	$Global[ 'session'] . "'" .', ' . "'" .
							 	$Global['project'] . "','" . 
								$Obj->Get( $c_element, F_LINK_ ) . "',0,'" . 
								$Obj->Get( $c_element, F_FILTER_ )."'".')"'); 
/*	OLD							
							$T->Set('command','oncommand="menuAction('.$oper.
								','."'". 
							 	$Global[ 'session'] . "'" .', ' . "'" .
							 	$Global['project'] . "','" . 
								$Obj->Get( $c_element, F_LINK_ ) . "',0" . ')"'); 
*/
// # 162 end
							// Define trustee
							$trustee['submenu'] = check_trustee( 
								$Obj->Get( $c_element, G_SHOW_ ) )	;		
							if (($submenu == "0_") && ($trustee['element'])){
								$T->Show( 'menu_element' );			
								$T->Show( 'menu_element_startpopup' );
								$submenu = "1";
							}	
							if ( $trustee['submenu'] ) {
								$T->Show( 'submenu' );
							}
						}
					}
									
					if (($submenu != "0_") && ($trustee['element'])) {
						$T->Show( 'menu_element_endpopup' );
						$T->Show( 'menu_element_end');
					}
					else {
						if ( $trustee['element'] ) {					
							$T->Show( 'menu_element_item' );				
						}
					}


				}
			}
			if ( ($element != "0_") && ($trustee['header']) ) {
				$T->Show( 'menu_header_endpopup' );
			}
			if ( $trustee['header'] ) {
				$T->Show( 'menu_header_end' );
			}
		}
	}
	
	$T->Show('end_menu');
 
}
  
// show_menu() -------------------------------------------------------------- 
 

 
 ?>