<?php
	
	
	global $DB, $T, $TF, $Global;
	$TF->Set( 'title', $object);
	$TF->Set( 'formtitle', $object);
	$Global['page'] ++;	
		
	if ( $Global['oper'] == INS_DATA_ ) {
		$TF->Set( 'formtitle', "Insertando " . $this->alias );
	}

	if( $Global['print'] ){
		$T->Set('title', $this->alias);
		$T->Show( 'header');
	}
		
	$TF->Show('start_form');				 
	
	$Obj = new Y_Engine();	
	
	// FORCED DEF_FILE
	$tmp = explode('.',$Global['full_link']);
	if( ( $tmp[0] == 'rep' )	||
		( $tmp[1] == 'rep__' )	){
		$formType = 'rep';
	}
	if( $formType == 'rep' ){
		$def_file = "engine/".$Global['lang']."/def.rep__.php";
	}
	else{ 
		$def_file = "engine/".$Global['lang']."/def.form__.php"; 
	}
	require( $def_file );

	
	// new motor -----------------------------------------------------------
	
	defineMotor();
	$key = array_keys( $Obj->def_element );
	for( $i=0; $i< count( $key ); $i++ ) {
		$varMotor = array();		
		$element = $key[$i];
		$varMotor['count'] = $i;
		$tag = array_keys( $Obj->def_element[$element] );
		for ( $cnt=0; $cnt< count($tag); $cnt++ ){
			$varMotor[$tag[$cnt]] = $Obj->Get_Def( $element, $tag[$cnt] );
		}
		
		if ( $Global['oper'] == VIEW_DATA_ ) {
			$varMotor['F_VALUE_'] = $this->$varMotor['F_NAME_'];
		}
		else{
			$varMotor['F_VALUE_'] = 
					$Obj->Get_Def( $object, $varMotor['F_NAME_'] );		
		}
		callMotor( $varMotor );
	}
	startMotor();

	// new motor -----------------------------------------------------------
	
	
	$TF->Show('end_form');
	


?>