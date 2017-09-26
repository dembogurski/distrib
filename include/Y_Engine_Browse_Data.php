<?php
	global $DB, $T, $TF, $Global;
	$TF->Set( 'title', "Data Form " . $this->alias );
	$Global['page'] ++;	
	if( $Global['print'] ){
		$T->Set( 'title', $this->doc );
		$T->Show( 'header' );
	}

// ##### 23
	$TF->Set('command','onselect="callNew(' . SHOW_ . ','."'". 
	 		$Global[ 'session']."'".','."'".$Global['project']. 
	 		"','". $Global['full_link'] . "','" . $Global['page'] .
			"',"."this.selectedItem.id" . ')"');
/*OLD	$TF->Set('command','onselect="callNew(' . SHOW_ . ','."'". 
	 		$Global[ 'session']."'".','."'".$Global['project']. 
	 		"','". $Global['full_link'] . "'," . $Global['page'] .
			','."this.selectedItem.id" . ')"');
*/
// ##### 23

/*
	$TF->Set('command','onselect="callNew(' . SHOW_ . ','."'". 
	 		$Global[ 'session']."'".','."'".$Global['project']. 
	 		"','". $Global['full_link'] . "'," . $Global['page'] .
			','."this.selectedItem.id" . ')"');
*/
	$TF->Show('start_list');				 
						 
						 
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
		$brow[ $element ] 		= $this->Get( $element, F_BROW_ ) ;
		
		
		
				
		// Input text
		// ==========
		if ( $type[$element] == "text" ) {
			if ( (check_trustee( $trust_show [$element] )) &&
				 ( !empty( $brow[$element] ) ) ) {
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
		if ( $type[$element] == "select_list" ) {
			if ( (check_trustee( $trust_show [$element] )) &&
				 ( !empty( $brow[$element] ) ) ) {
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
		$def_file = "engine/".$Global['lang']."/def." . 
					$Global['link'] . ".php";
		require( $def_file );
		$key_header = array_keys( $Obj->element );
		$header_list=0;
		$TF->Show( 'start_list_head' );
		for( $i=0; $i< count( $key_header ); $i++ ) {
			$element = $key_header[$i];
			$alias[ $element ] 		= $Obj->Get( $element, F_ALIAS_ ) ;
			$name[ $element ] 		= $Obj->Get( $element, F_NAME_ ) ;
			$help[ $element ] 		= $Obj->Get( $element, F_HELP_ ) ;
			$trust_show[ $element ]	= $Obj->Get( $element, G_SHOW_ ) ;
			$header_list++;
			$TF->Set ( 'data', $alias[$element] );
			$TF->Set ( 'help', $help[$element] );
			$TF->Show( 'list_head');
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
			for ( $b=0; $b < $header_list; $b++ ) {
				$namelist= $this->Get($key[$i],$key_header[$b]);
				$TF->Set ( 'data', $namelist );
				$TF->Set ( 'id', $this->Get($key[$i], F_NAME_ ) );
				if ( ! $f_list ) {
					$TF->Show( 'start_list_cell' );	
					$f_list = true;
				}					
				$TF->Show( 'list_cell');
			}
			$TF->Show( 'stop_list_cell');
		}
			
	}
			
	
	$TF->Show('end_list');

?>