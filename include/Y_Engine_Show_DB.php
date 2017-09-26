<?php
	
	global $DB, $T, $TF, $Global;
	$TF->Set( 'title', $object);
	$TF->Set( 'formtitle', $object);
	$Global['page'] ++;	
		
	if ( $Global['oper'] == INSERT_ ) {
		$TF->Set( 'formtitle', "Insertando " . $this->alias);
		$TF->Set( 'title', "Insertando " . $this->alias);
	}
	else {
		$TF->Set( 'formtitle', $this->alias);
		$TF->Set( 'title', $this->alias);
	}	
	if( $Global['print'] ){
		$T->Set('title', $this->alias);
		$T->Show( 'header');
	}








	$TF->Show('start_form');				 

	// new motor -----------------------------------------------------------
	
	defineMotor();
	$key = array_keys( $this->element );
	
//echo "// antes do autonum"	;
	for( $i=0; $i< count( $key ); $i++ ) {
		$varMotor = array();		
		$element = $key[$i];
		$varMotor['count'] = $i;
		$tag = array_keys( $this->element[$element] );
		for ( $cnt=0; $cnt< count($tag); $cnt++ ){
			$varMotor[$tag[$cnt]] = $this->Get( $element, $tag[$cnt] );
		}
		if( ( $Global['oper'] == INSERT_ ) &&
			( !empty($varMotor['F_AUTONUM_'])) ){
				
			$DB->Query('CREATE TABLE IF NOT EXISTS __autonum__ ( ' . 
		 	'id 		INT 	UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY, ' .
			'name		VARCHAR(50), ' .
		 	'value		VARCHAR(20) ) TYPE=INNODB;');
				
				
			$autoValue=$varMotor['V_DEFAULT_'];
			$autoName =$varMotor['F_NAME_'];
			$DB->Query('SELECT value FROM __autonum__ WHERE name='.
				"'" . $autoName . "'");
			$DB->NextRecord();
			if( empty( $DB->Record )){
				$qry='INSERT INTO __autonum__ (id,name,value) values ' .
					"(null, '".$autoName."','".$autoValue."');";
				$DB->Query($qry);
			}
		}
		callMotor( $varMotor );
	}
	startMotor();

	$TF->Show('end_form');

?>
