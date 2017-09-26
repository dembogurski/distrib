<?php
	global $DB, $TF, $Global;

	// Check a config directory
	$dir = "project/".$Global['project']."/reports/config";
	if( !file_exists( $dir )){
		mkdir( $dir );
	}
	
	// Define a Superior Values
	$tmp = explode( ",", $Global['sup'] );
	for( $i=0; $i<count($tmp); $i+=2){
		if( $tmp[$i] !="_0_" ){
			$vars = "\$sup['" . $tmp[$i] . "']=\"" . $tmp[$i +1 ]."\";";
			eval( $vars );
		}
	}

	// Define if is to create prg file
	$file = $dir . "/" . $Global['link'] . "_prg.php"; 
	$create_prg = false;
	$file_prg = $file;


	if( $this->del_prg != "" ){
		unlink( $file );
	}

	// Header of a PRG file
	// =====================
	if( !file_exists($file) ){
		$create_prg = true;
		// Writing a new file
		if( $h_prg = fopen( $file, "w")) {
			fputs($h_prg,  "<?php\n\n" );
			fputs($h_prg,  "/** Report prg file (".$Global['link'].") \n" );
			fputs($h_prg,  " *  \n" );
			fputs($h_prg,  " *  Dynamically created by ycube plus RAD\n" );
			fputs($h_prg,  " *  \n" );
			fputs($h_prg,  " *  USE THIS FILE TO PERSONALIZE A PROGRAM SIDE OF YOUR REPORT\n" );
			fputs($h_prg,  " *  ==========================================================\n" );
			fputs($h_prg,  " */  \n\n" );			
		}
		else {
			echo "<br /><br />Error creating prg file(makereport)<br /> ";
			echo "File: $file <br />";
		}
	
	}

	// Define if is to create a tpl file
	$file = $dir . '/' . $Global['link']. "_tpl.php"; 
	$create_tpl = false;
	$file_tpl = $file;


	if( $this->del_tpl != "" ){
		unlink( $file );
	}


	// Header of a TPL file
	// ====================
	if( !file_exists($file_tpl) ){
		$create_tpl = true;
		// Writing a new file
		if( $h_tpl = fopen( $file, "w")) {
			fputs($h_tpl,  "<!-- \n" .
				"    Report Template File (".$Global['link'].")\n\n" );
			fputs($h_tpl,  "    ####################################################\n" );
			fputs($h_tpl,  "    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT\n" );
			fputs($h_tpl,  "    ####################################################\n" );
			fputs($h_tpl,  "-->\n\n" );

		}
		else {
			echo "<br /><br />Error creating tpl file(makereport)<br /> ";
			echo "File: $file <br />";
		}
	}
	
	

	// Includes
	$T = new Y_Template( $file_tpl );
		

//-----------------------------------------------------------------------
   	// Define a Superior Values and $el[] values
   	// Superior values as only to retroactive compatibility
   	// The better solution is use a $el[]  definition
	$keys = array_keys( $sup );
	for( $i=0; $i<count($keys); $i++){
		// $sup_ values
		$sup[$keys[$i]] = str_replace ("wWx", ",", $sup[$keys[$i]] );
		$toeval = "\$sup_".$keys[$i]."='".$sup[$keys[$i]]."';";
		eval( $toeval );
		// $el[] values
		$el[$keys[$i]] = "'".$sup[$keys[$i]]."'";
		 $T->Set('sup_'.$keys[$i],$sup[ $keys[$i] ]);
//echo $keys[$i] ."-".$el[$keys[$i]]."\n";
	}
	
	// Define variables used in a forms
	$temp   = time();
	$year   = strftime( "%y", $temp );
	$month  = strftime( "%m", $temp );
	$day    = strftime( "%d", $temp );
	$hour   = strftime( "%H", $temp );
	$minute = strftime( "%M", $temp );
	$second = strftime( "%S", $temp );
	
	$p_user = $Global['username'];
	$p_user_ = "'".$p_user."'";
	$thisDate = $day.'-'.$month.'-'.year;
	$thisDate_ = "'".$thisDate."'";
	$thisTime = $hour.':'.$minute;
	$thisTime_= "'".$thisTime."'";
	
	// Replacing a variables to correct format ( with $ )
	$quotes = '"';
	$this->query = str_replace     ("p_user", "\$p_user", $this->query );
	$this->query = str_replace     ("thisDate", "\$thisDate", $this->query );
	$this->query = str_replace     ("thisTime", "\$thisTime", $this->query );
	$this->query = str_replace     ("'.sup_", "'.\$sup_", $this->query );
	$this->query = str_replace     ("el[", "\$el[", $this->query );
	$this->query = str_replace     ("|{", $quotes, $this->query );
	$this->query = str_replace     ("}|", $quotes, $this->query );
	$this->query = str_replace     ("+", ".", $this->query );
	$this->query= str_replace ("like ''", "LIKE '%'", $this->query );
	$this->query= str_replace ("LIKE ''", "LIKE '%'", $this->query );

	$this->query_end = str_replace ("p_user", "\$p_user", $this->query_end );
	$this->query_end = str_replace ("thisDate", "\$thisDate", $this->query_end );
	$this->query_end = str_replace ("thisTime", "\$thisTime", $this->query_end );
	$this->query_end = str_replace ("'.sup_", "'.\$sup_", $this->query_end );
	$this->query_end = str_replace ("el[", "\$el[", $this->query_end );
	$this->query_end = str_replace ("|{", $quotes, $this->query_end );
	$this->query_end = str_replace ("}|", $quotes, $this->query_end );
	$this->query_end = str_replace ("+", ".", $this->query_end );
	
	
	
	
//print_r($this);
//echo "query{{{".$this->query."}}}<BR>";
//echo "query_end{{{".$this->query_end."}}}<BR>";
//echo '>>1<BR>';	
	$Qc = 0;							// Query counter
	eval( "\$qry=$this->query;");		// A evaluated query
//echo '>>2<BR>';	
	$qry = str_replace ("like ''", "LIKE '%'", $qry );
	$qry = str_replace ("LIKE ''", "LIKE '%'", $qry );
//echo '>>3<BR>';	

//OLD	eval( "\$query".$Qc."=\"$qry\";" );			// Same query to program
	eval( "\$query".$Qc."=\"\$qry\";" );			// Same query to program
//	eval( "\$query".$Qc."=$this->query;" );			// Same query to program
//echo '['.$Query0.']<BR>';

/*OLD
//	eval( "\$query".$Qc."=\"$qry\";" );			// Same query to program
	eval( "\$query".$Qc."=$this->query;" );			// Same query to program
*/


//echo '>>4<BR>';
	if( $this->query_end != "" ){
		eval( "\$qry_end=$this->query_end;");		// A final query
		$qry_end = str_replace ("like ''", "LIKE '%'", $qry_end );
		$qry_end = str_replace ("LIKE ''", "LIKE '%'", $qry_end );
	}
//echo "-->".$qry."}}}<BR>";
//echo "{{{".$this->qry."}}}<BR>";


	if( $create_prg || $create_tpl ){
   	 	// Define a Superior Values
		$putprg = "// ATTENTION: CANCEL THIS BLOCK TO EDIT A FILE \n" ;
		$putprg .= "\$T = new Y_Template( \$file_tpl ); \n" ;
		$putprg .= "// Superior Variables\n";
//print_r($sup);		
		$keys = array_keys( $sup );
		for( $i=0; $i<count($keys); $i++){
			 $putprg .= "\$T"."->Set( 'sup_" .$keys[$i] ."', '" . 
			 $sup[ $keys[$i] ]. "');\n";			 	 
		}
		$putprg .= "// ------------------------------------------\n";
		$putprg .= "\n";
		$t = '    ';
		$putprg .= "// THIS IS YOUR FIRST QUERY:\n" .
			"//\$query$Qc = \"$qry\";\n\n" ;

	
		// A main header
		$puttpl = "".

// ##### 12
			"<!-- begin: general_header noeval -->\n".
                        "       <link rel=\"stylesheet\" type=\"text/css\" href=\"templates/reports.css\" /> \n".
			"	<treset_page>\n".
			"<!-- end:   general_header -->\n\n" ;

/* OLD
			"<!-- begin: general_header -->\n".
			"<table style=\"text-align: left; width: 100%;\" ".
			"border=\"0\" cellpadding=\"0\" cellspacing=\"2\">\n".
			"	<tbody>\n" .
			"		<tr>\n".
			"			<td style=\"width: 184px;\">ycube plus RAD" .
						" [". $Global['version']."]</td>\n" .
			"			<td colspan=\"1\" rowspan=\"2\"" .
						"style=\"width: 335px; text-align: center;\">".
						"<big style=\"font-weight: bold;\">" .
						"<big>". $this->alias ."</big></td>\n" .
			"			<td style=\"width: 138px; text-align: right;\">".
						"{time}</td>\n" .
			"		</tr>\n" .
			"		<tr>\n" .
			"			<td>{HTML_name}</td>\n" .
			"			<td style=\"text-align: right;\">{user}</td>\n" .
			"		</tr>\n" .
			"		<tr align=\"center\">\n" .
			"			<td colspan=\"3\" rowspan=\"1\" " .
						"style=\"width: 184px;\"></td>\n" .
			"		</tr>\n" .
			"	</tbody>\n" .
			"</table><hr />\n".
			"<!-- end:   general_header -->\n\n" ;
*/			
// ##### 12
		if( $create_tpl ){
			fputs($h_tpl,$puttpl);
		}
		$user = $Global['username'];
		$putprg .= 	"\$T"."->Set( 'time', daytime() );\n".
					"\$T"."->Set( 'user', \$Global['username'] );\n";

		if( $create_prg ){
			fputs($h_prg,$putprg);
		}
		
		
		// first part of report
                
                // Changes by Douglas
                /*$proyect_to_upper = $Global['project'];
                $letra0 = strtoupper(substr($proyect_to_upper, 0, 1));
                $letras1_n = substr($proyect_to_upper, 1, 60);
                $proyect_to_upper = $letra0.$letras1_n; */
		
		// Starts a table to query
		$puttpl = "\n" .
		"<!-- begin: start_query$Qc -->\n" .
		"<table style=\"text-align: left; width: 99%;\" border=\"1\"" .
		" cellpadding=\"0\" cellspacing=\"0\">\n".
		$t."<tbody>\n" .		
// ##### 12		
			$t."<thead>\n" .
		
		"<tr> <td colspan=\"50\"> \n".
		"	<table style=\"text-align: left; width: 100%;\" border=\"1\"\n".
		"	 cellpadding=\"0\" cellspacing=\"0\">\n".
		"	  <tbody>\n".
		"		<tr>\n".
		"		  <td style=\"width: 20%;height:40px;\"> </td>\n".
		"		  <td style=\"text-align: center;width: 60%;\">\n".
		"			<b>". 
		$Global['project']."</b></td>\n".
		"		  <td style=\"text-align: right;\">\n".
		"			<tpage><b>Pag: </b></tpage></td>\n".
		"		</tr>\n".
		"		<tr>\n".
		"		  <td  style=\"width: 20%;\">\n".
		"			<small><small>ycube plus RAD [". 
		$Global['version']."]</small></small>\n".
		"		  </td>\n".
		"		  <td style=\"text-align: center;\"><big\n".
		"			style=\"font-weight: bold;\"><big>". $this->alias .
		"</big></td>\n".
		"		  <td style=\"text-align: right;\">\n".
		"			<small><small>{user} - {time}</small></small>\n".
		"		  </td>\n".
		"		</tr>\n".
		"	  </tbody>\n".
		"	</table><hr />\n".
		"</td></tr>\n".
			
// ##### 12			

		"<!-- end:   start_query$Qc -->\n\n" ;
		if( $create_tpl ){
			fputs($h_tpl,$puttpl);
		}

		$putprg = "\n".
		"\$firstRow=true;\n".
		"\$Q$Qc = \$DB;\n" .
		"\$Q$Qc"."->Query( \$query$Qc );\n\n" .
		"// Starting a HTML\n" .
		"\$T"."->Show('general_header');			// Principal Header\n".		
		"\$T"."->Show('start_query$Qc');			// Start a Table \n" ;



		// Making a header to table
		// ========================
		$putprg .= "\$T"."->Show('header$Qc');				// Show Header\n";		
		$puttpl = 	"<!-- begin: header$Qc -->\n" .
					$t."<tr>\n";
		if( strpos( strtoupper($qry), "LIMIT" ) <1 ){
			$qry .= " LIMIT 1";
		}
		$DB->Query($qry);
//echo $qry;
		if( $DB->NextRecord() ){
			$keys = array_keys( $DB->Record );
//print_r($DB->Records);			
			// Making a headers os table
			for( $i=1; $i<count($keys);$i+=2){
				// If this column has total or a subtotal
				if( (strpos( " ".$this->total,$keys[$i]) >0 ) 	||
					(strpos( " ".$this->subtotal,$keys[$i]) >0 )){
					$puttpl .= $t.$t."<th style=\"text-align: right;\">" . 
						$keys[$i] . "</th>\n";
				} else {
					$puttpl .= $t.$t."<th>" . $keys[$i] . "</th>\n";
				}
			}
			
			// Prepare a $endConsult variable
			$putprg .= "\n//Define a $endConsult variable\n";
			$putprg .= "\$endConsult = false;";
			
			// Prepare total variables
			$putprg .= "\n//Define a Total Variables\n";
			for( $i=1; $i<count($keys);$i+=2){
				if( strpos( " ".$this->total,$keys[$i]) >0 ){
					$putprg .= "\$total$Qc"."_$keys[$i] = 0;\n"; 
				}
			}
			// Prepare Subtotal variables
			$putprg .= "\n//Define a Subtotal Variables\n";
			for( $i=1; $i<count($keys);$i+=2){
				if( strpos( " ".$this->subtotal,$keys[$i]) >0 ){
					$putprg .= "\$subtotal$Qc"."_$keys[$i] = 0;\n"; 
				}
			}
			$putprg .= "\n";
			// Prepare Old Values variables
			$putprg .= "\n//Define a Old Values Variables\n";
			for( $i=1; $i<count($keys);$i+=2){
				$putprg .= "\$old['".$keys[$i]."'] = '';\n"; 
			}
			$putprg .= "\n";

		}	
		$puttpl .= $t."</tr>\n".
		
		
// ##### 12		
				"</thead>\n".
				"<tfoot>\n".
				"	<tr><td colspan=\"50\"><hr /></td></tr>\n".
				"</tfoot>\n".
// ##### 12				
				"<!-- end:   header$Qc -->\n\n";
		if( $create_tpl ){
			fputs($h_tpl,$puttpl);
		}
		
		
		// Making a rows of data
		// ---------------------
		$putprg .= "// Making a rows of consult\n";
		$putprg .= "while( \$Q$Qc"."->NextRecord() ){\n" ;
		if( $create_prg ){
			fputs($h_prg,$putprg);
		}
		$putprg = "";

		// Definine a elements
		$putprg .= "\n".$t."// Define a elements\n";
		for( $i=1; $i<count($keys);$i+=2){
			$putprg .= $t."\$el['".$keys[$i]."'] = \$Q$Qc"."->Record['".
					$keys[$i]."'];\n";
		}

		// Showing a SubTotal row ( PREVALIDATED )
		// ---------------------------------------
		if( $this->pre_sub!='' ){
			$condition = $this->cond_sub;
			$condition = str_replace ("el['", "\$el['", $condition );
			$condition = str_replace ("old['", "\$old['", $condition );
			$condition = str_replace (".get()", 	"", $condition );
			$condition = str_replace (".getVal()", 	"", $condition );
			$condition = str_replace (".getDate()", "", $condition );
			$condition = str_replace ("endConsult", "\$endConsult", $condition );
			$condition = str_replace ("firstRow", "\$firstRow", $condition );
			if( $condition=="" ){
				$condition = "true";
			}
			$putprg .= $t."if( $condition ){\n";
			$putprg .= 	$t.$t."\$T"."->Show('query$Qc"."_subtotal_row');\n" ;
	
			// Reset Subtotal variables
			$putprg .= $t.$t."//Reset a Subtotal Variables\n";
			for( $i=1; $i<count($keys);$i+=2){
				if( strpos( " ".$this->subtotal,$keys[$i]) >0 ){
					$putprg .= $t.$t."\$subtotal$Qc"."_$keys[$i] = 0;\n"; 
				}
			}
			$putprg .= $t."}\n";
		}
		
		
		
		
		$puttpl = "<!-- begin: query$Qc"."_data_row -->\n" .
				$t.$t." <tr>\n" ;
/* OLD				
				$t.$t."<tr>\n" ;
*/
// ##### 12
		
		//Preparing a template variables
		$putprg .= "\n$t// Preparing a template variables\n";
		for( $i=1; $i<count($keys);$i+=2){

			// If this column has a total or subtotal
			if( (strpos( " ".$this->total,$keys[$i]) >0 )		||
				(strpos( " ".$this->subtotal,$keys[$i]) >0 )	){
				$putprg .= $t."\$T"."->Set('query$Qc"."_".$keys[$i].
				"', number_format(\$el['".$keys[$i]."']".
				",". ($this->dec_tot +=0)  .",',','.'));\n" ;
				$puttpl .= $t.$t.$t.
					"<td style=\"text-align: right;\">{query$Qc"."_".
					$keys[$i]."}"."</td>\n" ;
			} 	
			else {
				$putprg .= $t."\$T"."->Set('query$Qc"."_".$keys[$i].
						"', \$el['".$keys[$i]."']);\n" ;
				$puttpl .= $t.$t.$t."<td>{query$Qc"."_".$keys[$i]."}"."</td>\n" ;
			}
		}
		
		//Calculating a total
		$putprg .= "\n$t// Calculating a total\n" ;
		for( $i=1; $i<count($keys);$i+=2){
			if( strpos( " ".$this->total,$keys[$i]) >0 ){
				$putprg .= $t."\$total$Qc"."_$keys[$i] += 0 + ".
				"\$el['".$keys[$i]."'];\n";  
			} 	
		}		
		
		//Calculating a subtotal
		$putprg .= "\n$t// Calculating a subtotal\n" ;
		for( $i=1; $i<count($keys);$i+=2){
			if( strpos( " ".$this->subtotal,$keys[$i]) >0 ){
				$putprg .= $t."\$subtotal$Qc"."_$keys[$i] += 0 + ".
				"\$el['".$keys[$i]."'];\n"; 
			} 	
		}
		
		$putprg .= "\n".$t."\$T"."->Show('query$Qc"."_data_row');\n" ;
		$puttpl .= $t.$t." </tr>\n" .
/* OLD		$puttpl .= $t.$t."</tr>\n" .
*/
// ##### 12
				"<!-- end:    query$Qc"."_data_row -->\n" ;
				

		
		// Defining a subtotal
		// ----------------
		$putprg .= $t."// Show Subtotal\n";
		for( $i=1; $i<count($keys);$i+=2){
			if( strpos( " ".$this->subtotal,$keys[$i]) >0 ){
				$putprg .= $t."\$T"."->Set('subtotal$Qc"."_".$keys[$i].
				"', number_format("."\$subtotal$Qc"."_".$keys[$i].
				",". ($this->dec_sub + 0)  .",',','.'));\n" ;
			}
		}	

		
		// Showing a SubTotal row ( NOT PREVALIDADTED )
		// --------------------------------------------
		if( $this->pre_sub=='' ){
			$condition = $this->cond_sub;
			$condition = str_replace ("el['", "\$el['", $condition );
			$condition = str_replace ("old['", "\$old['", $condition );
			$condition = str_replace (".get()", 	"", $condition );
			$condition = str_replace (".getVal()", 	"", $condition );
			$condition = str_replace (".getDate()", "", $condition );
			$condition = str_replace ("endConsult", "\$endConsult", $condition );
			$condition = str_replace ("firstRow", "\$firstRow", $condition );
			if( $condition=="" ){
				$condition = "true";
			}
			$putprg .= $t."if( $condition ){\n";
			$putprg .= 	$t.$t."\$T"."->Show('query$Qc"."_subtotal_row');\n" ;
	
			// Reset Subtotal variables
			$putprg .= $t.$t."//Reset a Subtotal Variables\n";
			for( $i=1; $i<count($keys);$i+=2){
				if( strpos( " ".$this->subtotal,$keys[$i]) >0 ){
					$putprg .= $t.$t."\$subtotal$Qc"."_$keys[$i] = 0;\n"; 
				}
			}
			$putprg .= $t."}\n";
		}

		
		// Actualize Old Values variables
		$putprg .= $t."\n$t//Actualize Old Values Variables\n";
		for( $i=1; $i<count($keys);$i+=2){
			$putprg .= $t."\$old['".$keys[$i]."'] = " .
					    "\$el['".$keys[$i]."'];\n"; 
		}


// ##### 10
		$putprg .=$t."\$firstRow=false;\n";
// ##### 10


		$putprg .= "\n";
				
				
				
				
		$putprg .= "}\n\n" ;		// while end
		$putprg .= "\$endConsult = true;\n";


		
		// Showing a SubTotal row
		// ----------------------
		$condition = $this->cond_sub;
		$condition = str_replace ("el['", "\$el['", $condition );
		$condition = str_replace ("old['", "\$old['", $condition );
		$condition = str_replace (".get()", 	"", $condition );
		$condition = str_replace (".getVal()", 	"", $condition );
		$condition = str_replace (".getStr()", 	"", $condition );
		$condition = str_replace (".getDate()", "", $condition );
		$condition = str_replace ("endConsult", "\$endConsult", $condition );
		$condition = str_replace ("firstRow", "\$firstRow", $condition );
		if( $condition=="" ){
			$condition = "true";
		}
		$putprg .= "if( $condition ){\n";
		$putprg .= 	$t."\$T"."->Show('query$Qc"."_subtotal_row');\n" ;
		$putprg .= "}\n";
		
		
		
		
		// Defining a total
		// ----------------
		$putprg .= "// Show total\n";
		for( $i=1; $i<count($keys);$i+=2){
			if( strpos( " ".$this->total,$keys[$i]) >0 ){
				$putprg .= "\$T"."->Set('total$Qc"."_".$keys[$i].
				"', number_format("."\$total$Qc"."_".$keys[$i].
				",". ($this->dec_tot + 0)  .",',','.'));\n" ;
			}
		}	
		
		// Showing a Total row
		// -------------------
		$condition = $this->cond_tot;
		$condition = str_replace ("old['", "\$old['", $condition );
		$condition = str_replace ("el['", "\$el['", $condition );
		$condition = str_replace (".get()", 	"", $condition );
		$condition = str_replace (".getVal()", 	"", $condition );
		$condition = str_replace (".getDate()", "", $condition );
		if( $condition=="" ){
			$condition = "true";
		}
		$putprg .= "if( $condition ){\n";
		$putprg .= 	$t."\$T"."->Show('query$Qc"."_total_row');\n" ;
		$putprg .= "}\n";
		
		$putprg .=	"\$T"."->Show('end_query$Qc');				// Ends a Table \n\n" ;
		if( $create_prg ){
			fputs($h_prg,$putprg);
		}
		
		$puttpl .= "<!-- begin: query$Qc"."_total_row -->\n" .
				$t.$t."<tr>\n" ;
		for( $i=1; $i<count($keys);$i+=2){
			if( strpos( " ".$this->total,$keys[$i]) >0 ){
				$puttpl .= $t.$t.$t."<td style=\"text-align: right;\">".
					"<b>{total$Qc"."_".$keys[$i]."}"."</b></td>\n" ;
			} else {
				$puttpl .= $t.$t.$t."<td></td>\n" ;
			}
		}
		$puttpl .= $t.$t."</tr>\n" .
		"<!-- end:    query$Qc"."_total_row -->\n" ;

		// Subtotal rows
		$puttpl .= "<!-- begin: query$Qc"."_subtotal_row -->\n" .
				$t.$t."<tr>\n" ;
		for( $i=1; $i<count($keys);$i+=2){
			if( strpos( " ".$this->subtotal,$keys[$i]) >0 ){
				$puttpl .= $t.$t.$t."<td style=\"text-align: right;\">".
					"<b>{subtotal$Qc"."_".$keys[$i]."}"."</b></td>\n" ;
			} else {
				$puttpl .= $t.$t.$t."<td></td>\n" ;
			}
		}
		$puttpl .= $t.$t."</tr>\n" .
		"<!-- end:    query$Qc"."_subtotal_row -->\n" ;
		

		
		$putprg = "";
		
		
		// Ends a table of query
		// ---------------------

		$putprg .= "?".">\n";
		$puttpl .=  "<!-- begin: end_query$Qc -->\n" .
					$t."</tbody>\n" .
					"</table>\n" .
//					"<script>self.print();self.close();</script>\n" .
					"<!-- end:   end_query$Qc -->\n" .
					"\n";		
					
					
		if( $create_tpl ){
			fputs($h_tpl,$puttpl);
		}
		if( $create_prg ){
			fputs($h_prg,$putprg);
		}
	}	
	

	
	// Show the report
	// ---------------
	
//		echo 'HHH';
	
	// LOOK THIS ========================
//	chmod( $file_prg, 0666 );
//	chmod( $file_tpl, 0666 );		
	include_once( $file_prg );
//	require( $file_prg );
	
// # 165	
		// Final Procedure
	if( $this->query_end != "" ){
		$DB->Query( $qry_end);
	}
// # 165 end 		


?>


