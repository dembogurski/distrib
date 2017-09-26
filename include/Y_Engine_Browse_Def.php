<?php
	
	global $DB, $T, $TF, $Global;
		
	$Global['page'] ++;				

	if( $Global['print'] ){
		$T->Set( 'title', $this->alias );
		$T->Show( 'header' );
	}
		
	// Check if is a db or data form
	$tmp = explode( ".", $this->file);
	$formType = $tmp[0];

// ##### 23
	if ( $formType == "db" ) {
		$TF->Set('command','onselect="callNew(15,'."'". 
		 		$Global[ 'session']."'".','."'".$Global['project']. 
		 		"',"."this.selectedItem.id" . ",'" . $Global['page'] .
				"'". ')"');
	}
	else {
		if ( $formType == "rep" ) {
			$TF->Set('command','onselect="callNew(15,'."'". 
			 		$Global[ 'session']."'".','."'".$Global['project']. 
			 		"',"."this.selectedItem.id" . ",'" . $Global['page'] .
					"'". ')"');
		}
		else{
			$TF->Set('command','onselect="callNew(1,'."'". 
				 		$Global[ 'session']."'".','."'".$Global['project']. 
				 		"',"."this.selectedItem.id" . ",'" . $Global['page'] .
						"'". ')"');
		}
	}
/* OLD	
	if ( $formType == "db" ) {
		$TF->Set('command','onselect="callNew(15,'."'". 
		 		$Global[ 'session']."'".','."'".$Global['project']. 
		 		"',"."this.selectedItem.id" . "," . $Global['page'] .
				 ')"');
	}
	else {
		if ( $formType == "rep" ) {
			$TF->Set('command','onselect="callNew(15,'."'". 
			 		$Global[ 'session']."'".','."'".$Global['project']. 
			 		"',"."this.selectedItem.id" . "," . $Global['page'] .
					 ')"');
		}
		else{
			$TF->Set('command','onselect="callNew(1,'."'". 
				 		$Global[ 'session']."'".','."'".$Global['project']. 
				 		"',"."this.selectedItem.id" . "," . $Global['page'] .
						 ')"');
		}
	}
*/
// ##### 23
		
	$TF->Set( 'title', $this->alias );
	$TF->Show('start_list');

	// Checking elements to list	
	$to_list=1;
	$list_name = array();
	$list_alias = array();		
	$list_help = array();
	$list_alias[0] = "Identif";
	$list_help[0]  = "Identif";
	$list_type = array();
	$query="";
	$key = array_keys( $this->def_element );
	for( $i=0; $i< count( $key ); $i++ ) {
		$element = $key[$i];

		$alias[ $element ] 		= $this->Get_Def( $element, F_ALIAS_ ) ;
		$name[ $element ] 		= $this->Get_Def( $element, F_NAME_ ) ;
		$help[ $element ] 		= $this->Get_Def( $element, F_HELP_ ) ;
		$trust_show[ $element ]	= $this->Get_Def( $element, G_SHOW_ ) ;
		$length[ $element ] 	= $this->Get_Def( $element, F_LENGTH_ ) ;
		$type[ $element ] 		= $this->Get_Def( $element, F_TYPE_ ) ;
		$brow[ $element ] 		= $this->Get_Def( $element, F_BROW_ ) ;
		
				
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
	}
		
	// Prepare to read a directory
	$form = $this->file;
	
	$is_empty = true;
	if ( ! empty ( $form )) {
		$directory = "./project/" . $Global['project'];
		if ( $formType == "rep" ) {
			$directory .='/reports';
		}
		$dir = opendir ( "$directory" );
		$TF->Show( 'start_list_head' );
		for ( $i=0; $i < $to_list; $i++ ) {
			$TF->Set ( 'data', $list_alias[$i] );
			$TF->Set ( 'help', $list_help[$i] );
			$TF->Show( 'list_head');
		}
		$TF->Show( 'stop_list_head');
	
		$TF->Show( 'start_list_col' );
		for ( $i=0; $i < $to_list; $i++ ) {
			$TF->Show( 'list_col');
		}
		$TF->Show( 'stop_list_col');
	
		$Obj = new Y_Engine();		// Creating a new object
		while( $filename = readdir ( $dir ) ) {
			if ( (strpos ( " " . $filename, $form )) == 1 ) {
				$req_file= $directory . "/" . $filename;
				include( $req_file );
				$is_empty = false;
				$file_orig = str_replace( ".php", "", $filename ); 
				
				$TF->Set ( 'id', trim($file_orig) );
				$TF->Show( 'start_list_cell' );
				$TF->Set ( 'data', $filename );	
				$TF->Show( 'list_cell');						
				for ( $i=1; $i < $to_list; $i++ ) {
					$TF->Set ('data', $Obj->$list_name[$i] );	
					$TF->Show( 'list_cell');				
				}
			
				$TF->Show( 'stop_list_cell');
			}
		}
	}
	else {
		$T->Set(  'error', "Not Defined Form ( Browse_Def )");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}
	
	$TF->Show('end_list');
	
	$TF->Show('hbox_start');
	
	// Make a Back Button	
	$TF->Set('name', "Volver" );
	$TF->Set('help', 'Cerrar la vista actual');
	$TF->Show('close_button');
		
	// Make a Insert Button	
	if ( ($this->def_mul) || ( $is_empty ) ) {

// ##### 23
		$TF->Set('command','onclick="callNew(' . INS_DATA_ . ','."'". 
		 		$Global[ 'session']."'".','."'".$Global['project']. 
		 		"','". $Global['full_link'] . "','" . $Global['page'] .
				"',0" . ')"');
/*
		$TF->Set('command','onclick="callNew(' . INS_DATA_ . ','."'". 
		 		$Global[ 'session']."'".','."'".$Global['project']. 
		 		"','". $Global['full_link'] . "'," . $Global['page'] .
				','."0" . ')"');
*/
// ##### 23
			
			
		$TF->Set('name', "Insertar" );
		$TF->Set('help', 'Insertar nuevo elemento');
		$TF->Show('insert_button');
	}
	
	$TF->Show('hbox_stop');


?>
