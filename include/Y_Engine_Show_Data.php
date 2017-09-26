<?php
		
	global $DB, $T, $TF, $Global;
	$TF->Set( 'title', $object);
	$TF->Set( 'formtitle', $object);
	$Global['page'] ++;	

		
	if ( $Global['oper'] == INSERT_ ) {
		$TF->Set( 'title', "Insertando " . $this->alias );
		$TF->Set( 'formtitle', "Insertando " . $this->alias );
	}
	if( $Global['print'] ){
		$T->Set('title', $this->alias);
		$T->Show( 'header');
	}

	$TF->Show('start_form');				 

	$Obj = new Y_Engine();	
	$def_file = "engine/".$Global['lang']."/def." . 
	$Global['link'] . ".php";
	require( $def_file );

		
	// Define a readonly attribute	
	if ( $Global['oper'] == SHOW_ ) {
		$TF->Set( 'readonly', 'readonly="true"' );
		$readonly = true;
	}
	else {
		$TF->Set( 'readonly', ''  );
		$readonly = false;
	}

	
	// new motor -----------------------------------------------------------
	
	defineMotor();
	$key = array_keys( $Obj->element );
	for( $i=0; $i< count( $key ); $i++ ) {
		$varMotor = array();		
		$element = $key[$i];
		$varMotor['count'] = $i;
		$tag = array_keys( $Obj->element[$element] );
		for ( $cnt=0; $cnt< count($tag); $cnt++ ){
			$varMotor[$tag[$cnt]] = $Obj->Get( $element, $tag[$cnt] );
		}
		$varMotor['F_VALUE_'] = 
					$this->Get( $object, $varMotor['F_NAME_'] );
		callMotor( $varMotor );
	}
	startMotor();

	// new motor -----------------------------------------------------------
	

	$TF->Show('end_form');

	
	
?>






