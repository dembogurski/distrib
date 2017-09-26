<?php
	global $DB, $T, $TF, $Global;
	$TF->Set( 'title', $this->alias );
	$Global['page'] ++;	

	echo "<!-- Browse_DB -->\n";
// ##### 24 - clearEnter to a Superior variable
	echo "<script>var Superior=\"" . clearEnter($Global['sup']).
	"\"</script>\n";			
//	echo "<script>var Superior=\"" . $Global['sup']."\"</script>\n";			
// ##### 24 end
	
	$TF->Set('command','onselect="callNew(' . SHOW_ . ','."'". 
	 		$Global[ 'session']."'".','."'".$Global['project']. 
	 		"','". $Global['full_link'] . "','" . $Global['page'] .
			"',"."this.selectedItem.id" . ",'" . $Global['subform'] .
					"',Superior"  . ')"');

	if( $Global['print'] ){
		$T->Set( 'title', $this->doc );
		$T->Show( 'header' );
	}
		
	$TF->Show('start_list');

	// Checking elements to list	
	$to_list=0;
	$list_name = array();
	$list_alias = array();
	$list_help  = array();
	$list_type = array();
	$query="";
	$key = array_keys( $this->element );
	
// ##### 21 - Zebra Browse efect
	if( !empty( $this->Zebra ) ){
		$zebra = explode(",",$this->Zebra);
		$zebra_flag = 1;
	}
	else{
		$zebra = false;
	}
// ##### 21
	
	if( $Global['filter'] != '' ){
		$this->Filter = $Global['filter'];
		$this->Filter = str_replace("|{",'"',$this->Filter);
		$this->Filter = str_replace("}|",'"',$this->Filter);
	}
	$this->Filter = str_replace("thisDate_",$thisDate_,$this->Filter);
	$this->Filter = str_replace(" id ",' '.$this->File.'.id ',$this->Filter);
	$this->Filter = str_replace("SQLDate_",$SQLDate_,$this->Filter);
	$this->Filter = str_replace ("p_user_", '"'. $Global['username'].
					'"', $this->Filter );
	if ( ! empty( $this->Filter ) ) {
	
// ##### 17 Filter corrections	
		$filter = stripslashes($this->Filter);
// OLD in 17		$filter = " WHERE " . stripslashes($this->Filter);
// ##### 17 end 


// ##### 13 ORDER BY in filter
		if( strpos( $filter, "ORDER BY") > 0 ) {
			$this->Sort = '';
		}


// ##### 13 END
		
		
	}
	else{
		$filter = "";
	}
//die();

//print_r( $this);	
	for( $i=0; $i< count( $key ); $i++ ) {
		$element = $key[$i];
		$alias[ $element ] 		= $this->Get( $element, F_ALIAS_ ) ;
		$name[ $element ] 		= $this->Get( $element, F_NAME_ ) ;
		$help[ $element ] 		= $this->Get( $element, F_HELP_ ) ;
		$trust_show[ $element ]	= $this->Get( $element, G_SHOW_ ) ;
		$length[ $element ] 	= $this->Get( $element, F_LENGTH_ ) ;
		$type[ $element ] 		= $this->Get( $element, F_TYPE_ ) ;
		$brow[ $element ] 		= $this->Get( $element, F_BROW_ ) ;
		$totalizar[ $element ]	= $this->Get( $element, F_TOTAL_ ) ;
		$dec[ $element ]		= $this->Get( $element, F_DEC_ ) ;	// #87


##### 13 Relationship
		$relation[ $element ]		= $this->Get( $element, F_RELATION_ ) ;	
		$relTable[ $element ]		= $this->Get( $element, F_RELTABLE_ ) ;	
		$showField[ $element ]		= $this->Get( $element, F_SHOWFIELD_ ) ;
		$relField[ $element ]		= $this->Get( $element, F_RELFIELD_ ) ;
		$localField[ $element ]		= $this->Get( $element, F_LOCALFIELD_ ) ;
		$relFilter = "";
#####		


		if ( $brow[$element] ) {	
			// Input text
			// Internal Procedure
			// ==================
			
			if (    ($type[$element] == "text" ) || 
					($type[$element] == "INT_PROC" ) || 
					($type[$element] == "formula" ) || 
					($type[$element] == "date" ) || 
					($type[$element] == "dynamic_select_list" ) || 
					($type[$element] == "select_list" )) {
				if ( check_trustee( $trust_show [$element] ) ) {
					$list_name[ $to_list ]  = $name[$element];
					$list_alias[ $to_list ] = $alias[$element];
					$list_type[ $to_list ]  = $type[$element];
					$list_help[ $to_list ]  = $help[$element];
					$to_list++;
					if( $relation[$element] =='' ) {
						if ( ! empty( $query ) ) {
							$query .= ",";
						}
						else {
							$query = $this->File.".id,";
						}
						$query .= $name[$element];
					} 
					else {
						if ( ! empty( $query ) ) {
							$query .= ",";
						}
						else {
							$query = $this->File.".id,";
						}
						$query .= $relTable[$element].
						".".$showField[$element]. " AS ".$name[$element];
						
						if( strpos( $otherFile, $relTable[$element])==0){
							$otherFile.=",". $relTable[$element];
						}

						if( empty( $filter )) {
							$filter=" WHERE ".$relTable[$element].
							".".$relField[$element]."=".
							$localField[$element];
						}
						else {
							$tempFilter=$relTable[$element].
							".".$relField[$element]."=".
							$localField[$element];
							if( strpos( $filter, $tempFilter)==0) {
//								$filter.=" AND ".$tempFilter;
								$filter=$tempFilter." AND ".$filter;
							}
						}
					}
				}
			}
		}
	}
		
	if ( ! empty ( $query )) {
		// prepare a Date field to a now() function
		$temp   = time();
		$year   = strftime( "%Y", $temp );
		$month  = strftime( "%m", $temp );
		$day    = strftime( "%d", $temp );
		$thisDate_ = '"' . $day . "-" . $month . "-" . $year . '"';  
		$SQLDate_  = '"' . $year . "-" . $month . "-" . $day . '"';  		
		
		if ( ! empty( $this->Sort ) ) {
			$sort = " ORDER BY " . stripslashes($this->Sort);
		}
		else{
			$sort = "";
		}
		
		// Page broser control (pgc)
		$temp = explode( ',', $Global['pgc']);
		$start_browse = $temp[0]+0;
		if( $this->Limit != "" ){
			$limit_browse = $this->Limit;	
		}
		else{
			$limit_browse = $temp[1]+0;	
		}
				
		if( $Global['print'] ){
			$limit=' ';
		}
		else{
			$limit = ' LIMIT '.$start_browse.','.$limit_browse.' ';
		}

// ##### 17 Filter corrections
		if( strpos( $filter, "WHERE") >0 ) {
			//
		}
		else{
			if( !empty( $filter ) ){
				$filter = " WHERE ". $filter;
			}
		}
// #### 17 end 	
		$query = "SELECT " . $query . " FROM " . $this->File .
				$otherFile . 
				$filter. $sort . $limit . ";";
		$TF->Show( 'start_list_head' );
		for ( $i=0; $i < $to_list; $i++ ) {
			$dec_ = $dec[ $list_name[$i] ];
			if( $dec_ != "" ) {
				$TF->Set ('align',"style='text-align: right'");	
			}
			else {
				$TF->Set ('align','') ;	
			}
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
		$DB->Query( $query );
		$havetotal = false;

		$Global['numRows'] = $DB->NumRows();
		while( $DB->NextRecord() ) {
			$TF->Set ( 'id',  $DB->Record[id] );			
			
			
// ##### 21 - Zebra
			if( !$zebra ){						
				$TF->Show( 'start_list_cell' );
			}
			else{
			    $zebra_flag = $zebra_flag ^ 1;
				$TF->Set( 'zebra_color', $zebra[ $zebra_flag ] );
				$TF->Show( 'start_zebra' );
			}
			
			for ( $i=0; $i < $to_list; $i++ ) {	
				$value = $DB->Record[$list_name[$i]];

				// Decimal control
				$dec_ = $dec[ $list_name[$i] ];
				if( $dec_ != "" ) {
					$TF->Set ('align',"style='text-align: right'");	
					$TF->Set ('data', number_format($value,$dec_,',','.') );	
				}
				else {
					$TF->Set ('align','') ;	
					
					// Date format control
					
					if( ( substr( $value, 4,1 ) == '-' ) 	&&
						( substr( $value, 7,1 ) == '-' )	&&
						( strlen( $value ) == 10 ) 			){
						$temp_value = substr( $value, 8,2);
						$temp_value .= '-' . substr( $value, 5,2);
						$temp_value .= '-' . substr( $value, 0,4);
						$value = $temp_value;
					}
					
					
					$TF->Set ('data', $value );	
				}

				$TF->Show( 'list_cell');
				
				if( $totalizar[ $list_name[$i] ] == 1 ) {
					$total[ $list_name[$i] ] += $value ;
					$havetotal=true;
				}
			}
	
			$TF->Show( 'stop_list_cell'); 
		}
		
		// totalizar
		if( $havetotal ) {
			$TF->Show( 'start_tot_cell' );
			for ( $i=0; $i < $to_list; $i++ ) {	
				$value = $total[$list_name[$i]];
				
				//													{ #87 
				// Decimal control
				$dec_ = $dec[ $list_name[$i] ];
				if( $dec_ != "" ) {
					$TF->Set ('data', number_format($value,$dec_,',','.') );	
				}
				else {
					$TF->Set ('data', $value );	
				}
				//													} #87 

				$TF->Show( 'tot_cell');
			}
			$TF->Show( 'stop_list_cell'); 
		}
	
	}
	

	else {
		$T->Set(  'error', "NO QUERY ( Browse_DB )");
		$T->Show( 'error' );
		$T->Show( 'end_xul' );
		die();
	}
			
	$TF->Show('end_list');

?>