<?php
		
	global $DB, $T, $TF, $Global;
	$TF->Set( 'title', $object);
	$TF->Set( 'formtitle', $object);
	$Global['page'] ++;	

		
	if( ( $Global['oper'] == INSERT_ ) 		||
		( $Global['oper'] == INSERT_ELEM_ )	){
		$TF->Set( 'title', "Insertando en " . $this->alias );
		$TF->Set( 'formtitle', "Insertando en " . $this->alias );
	}
	if( $Global['print'] ){
		$T->Set('title', $this->alias);
		$T->Show( 'header');
	}

	$TF->Show('start_form');				 
		
	$Obj = new Y_Engine();	

	$tmp = explode('.',$Global['full_link']);
	$formType = $tmp[0];
	
	// FORCED DEF_FILE
	if( $formType == 'rep' ){	
		$def_file = "engine/".$Global['lang']."/def.rep__.php";
	} else {
		$def_file = "engine/".$Global['lang']."/def.form__.php";
	}
	require( $def_file );


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
