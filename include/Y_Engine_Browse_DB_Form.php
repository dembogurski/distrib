<?php

	global $DB, $T, $TF, $Global;
	$temp = explode('.',$Global['full_link']);
	$formType = $temp[0];
	if( $formType == 'rep' ){
		$TF->Set( 'title', "Reporte " . $this->alias );
	}else{		
		$TF->Set( 'title', "Formulario " . $this->alias );
	}
	$Global['page'] ++;	

	if( $Global['print'] ){
		$T->Set( 'title', $this->alias );
		$T->Show( 'header' );
	}

// ##### 23
	$TF->Set('command','onselect="callNew(' . EDIT_SHOW_ . ','."'". 
	 		$Global[ 'session']."'".','."'".$Global['project']. 
	 		"','". $Global['full_link'] . "','" . $Global['page'] .
			"',"."this.selectedItem.id" . ')"');
/*	$TF->Set('command','onselect="callNew(' . EDIT_SHOW_ . ','."'". 
	 		$Global[ 'session']."'".','."'".$Global['project']. 
	 		"','". $Global['full_link'] . "'," . $Global['page'] .
			','."this.selectedItem.id" . ')"');
*/
// ##### 23
			
	$TF->Show('start_list');	
						 
//print_r($this);						 
	// Checking elements to list	
	$to_list=0;
	$list_name = array();
	$list_alias = array();
	$list_help  = array();
	$list_type = array();
	$query="";
	$key = array_keys( $this->element );
	for( $i=0; $i< count( $key ); $i++ ) {
		$element = $key[$i];
		$alias[ $element ] 		= $this->Get( $element, F_ALIAS_ ) ;
		$name[ $element ] 		= $this->Get( $element, F_NAME_ ) ;
		$help[ $element ] 		= $this->Get( $element, F_HELP_ ) ;
		$trust_show[ $element ]	= $this->Get( $element, G_SHOW_ ) ;
		$length[ $element ] 	= $this->Get( $element, F_LENGTH_ ) ;
		$type[ $element ] 		= $this->Get( $element, F_TYPE_ ) ;
		
		
		
				
		// Input text
		// ==========
		if( ( $type[$element] == "text" ) 	||
			( $formType == 'rep' )			||
			( $type[$element] == 'proc' )			||
			( $type[$element] == "report" )	){
			if ( check_trustee( $trust_show [$element] ) ) {
				$list_name[ $to_list ]  = $name[$element];
				$list_alias[ $to_list ] = $alias[$element];
				$list_type[ $to_list ]  = $type[$element];
				$list_help[ $to_list ]  = $help[$element];
				$to_list++;
				if ( ! empty( $query ) ) {
					$query .= ",";
				}
				$query .= $name[$element];
			}
		}
				
		// 															{ #90
		// Date		
		// =========
		if ( $type[$element] == "date" ) {
			if ( check_trustee( $trust_show [$element] ) ) {
				$list_name[ $to_list ]  = $name[$element];
				$list_alias[ $to_list ] = $alias[$element];
				$list_type[ $to_list ]  = $type[$element];
				$list_help[ $to_list ]  = $help[$element];
				$to_list++;
				if ( ! empty( $query ) ) {
					$query .= ",";
				}
				$query .= $name[$element];
			}
		}
		//															} #90
				
		// Input text
		// ==========
		if ( $type[$element] == "formula" ) {
			if ( check_trustee( $trust_show [$element] ) ) {
				$list_name[ $to_list ]  = $name[$element];
				$list_alias[ $to_list ] = $alias[$element];
				$list_type[ $to_list ]  = $type[$element];
				$list_help[ $to_list ]  = $help[$element];
				$to_list++;
				if ( ! empty( $query ) ) {
					$query .= ",";
				}
				$query .= $name[$element];
			}
		}
		
		// Sub Formulary
		// =============
		if ( $type[$element] == "subform" ) {
			if ( check_trustee( $trust_show [$element] ) ) {
				$list_name[ $to_list ]  = $name[$element];
				$list_alias[ $to_list ] = $alias[$element];
				$list_type[ $to_list ]  = $type[$element];
				$list_help[ $to_list ]  = $help[$element];
				$to_list++;
				if ( ! empty( $query ) ) {
					$query .= ",";
				}
				$query .= $name[$element];
			}
		}
		
		// Select_list
		// ==========
		if( ( $type[$element] == "select_list" )		||
			( $type[$element] == "dynamic_select_list" )){
			if ( check_trustee( $trust_show [$element] ) ) {
				$list_name[ $to_list ]  = $name[$element];
				$list_alias[ $to_list ] = $alias[$element];
				$list_type[ $to_list ]  = $type[$element];
				$list_help[ $to_list ]  = $help[$element];
				$to_list++;
				if ( ! empty( $query ) ) {
					$query .= ",";
				}
				$query .= $name[$element];
			}
		}

		
		// Menu system
		// ==========
		if ( ($type[$element] == "header") ||
			 ($type[$element] == "menu")   ||
			 ($type[$element] == "submenu")   ) {
			if ( check_trustee( $trust_show [$element] ) ) {
				$list_name[ $to_list ]  = $name[$element];
				$list_alias[ $to_list ] = $alias[$element];
				$list_type[ $to_list ]  = $type[$element];
				$list_help[ $to_list ]  = $help[$element];
				$to_list++;
				if ( ! empty( $query ) ) {
					$query .= ",";
				}
				$query .= $name[$element];
			}
		}
		
	}
	if ( ! empty ( $query )) {
	
				
		$Obj = new Y_Engine();	
		$def_file = "engine/".$Global['lang']."/def." .	$Global['link'];
		$temp_def = explode ( "__", $def_file );
		$def_file = $temp_def[0] . "__.php";			
		
		// DEFINITION FILE
		if( $formType == 'rep' ){		
			$def_file = "engine/".$Global['lang']."/def.rep__.php";
		} else {
			$def_file = "engine/".$Global['lang']."/def.form__.php";
		}
					
//print_r($Global);					
//echo $def_file;
//die(); 
					
		require( $def_file );
		$key_header = array_keys( $Obj->element );
		$header_list=0;
		$total_list=0;
		
		
		$TF->Show( 'start_list_head' );
		for( $i=0; $i< count( $key_header ); $i++ ) {
			$element = $key_header[$i];
			$alias[ $element ] 		= $Obj->Get( $element, F_ALIAS_ ) ;
			$name[ $element ] 		= $Obj->Get( $element, F_NAME_ ) ;
			$help[ $element ] 		= $Obj->Get( $element, F_HELP_ ) ;
			$trust_show[ $element ]	= $Obj->Get( $element, G_SHOW_ ) ;
			$brow[ $element ]		= $Obj->Get( $element, F_BROW_ ) ;
			$total_list++;
			
			if ($brow[ $element]) {
				$TF->Set ( 'data', $alias[$element] );
				$TF->Set ( 'help', $help[$element] );
				$TF->Show( 'list_head');
				$header_list++;

			}
			else {
				$key_header[$i] = "";
			}
		
		}
		$TF->Show( 'stop_list_head');
	
		$TF->Show( 'start_list_col' );
		for ( $i=0; $i < $header_list; $i++ ) {
			$TF->Show( 'list_col');
		}
		$TF->Show( 'stop_list_col');
			
			

		// Show cells
		for ( $i=0; $i < $to_list; $i++ ) {
			$f_list=false;
			for ( $b=0; $b < $total_list; $b++ ) {
				$namelist= $this->Get($key[$i],$key_header[$b]);
				
				if ( $key_header[$b] !="" ) {
					$TF->Set ( 'data', $namelist );
					$TF->Set ( 'id', $this->Get($key[$i], F_NAME_ ) );
					if ( ! $f_list ) {
						$TF->Show( 'start_list_cell' );	
						$f_list = true;
					}	
									
					$TF->Show( 'list_cell');
				
				}
				
			}
			$TF->Show( 'stop_list_cell');
		}
			
	}
			
	
	$TF->Show('end_list');

?>