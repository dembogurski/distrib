<?php

/*
  ----------------------------------------------------------
 | functions.php		functions of system					|
 |----------------------------------------------------------|
 |															| 
 | @author		Sergio A. Pohlmann <sergio@ycube.net>		|
 | @date		May, 28 of 2005								|
 | @copyright	ycube.net									|
 |															|
  ----------------------------------------------------------
 
*/ 
 


function audit_log( $user, $action, $status, $obs )
{
	global $DB,$Global;
	
	if( $Global['newdb'] == 1 ){
		return;
	}
	$temp   = time();
	$year   = strftime( "%y", $temp );
	$month  = strftime( "%m", $temp );
	$day    = strftime( "%d", $temp );
	$hour   = strftime( "%H", $temp );
	$minute = strftime( "%M", $temp );
	$second = strftime( "%S", $temp );

	$obs = preg_replace("/'/", " ", $obs );
	$obs = preg_replace("/\"/", " ", $obs );

	$DB->Query( "INSERT INTO p_log ( id, year, month, day, hour, " .
				"minute, second, user, action, status, obs ) " .
				"VALUES ( null, \"$year\", \"$month\", \"$day\", " .
				"\"$hour\", \"$minute\", \"$second\", " .
				"\"$user\", \"$action\", \"$status\", " .
				"\"$obs\" ) ; " );
} // ------------------------------------------------------------------------

function fprint( $text ) {
		 echo $text . "<BR />\n";
}

/** daytime			Returns a actual Day and Time
 *	=============================================
 */
function daytime() {
	$temp   = time();
	$year   = strftime( "%y", $temp );
	$month  = strftime( "%m", $temp );
	$day    = strftime( "%d", $temp );
	$hour   = strftime( "%H", $temp );
	$minute = strftime( "%M", $temp );
	$second = strftime( "%S", $temp );
	return ( $day. "/". $month. "/".$year."-".$hour.":".$minute );
} // daytime() -------------------------------------------------------------



/** set_session 	Prepare a new session to an user
 *	================================================
 *
 *	@global		Global['user']
 *	@global		Global['username']
 *	@global		Global['project'] 
 *
 *	@returns		A encripted number of the new session
 *
 */
  
 
function set_session()
{
	global $DB, $Global;
	
	$user	= $Global['user'];
	$project= $Global['project'];
	$temp   = time();
	$connect= strftime("%H", $temp) . ":";	
	$connect.=strftime("%M", $temp) . ":";
	$connect.=strftime("%S", $temp) ;
	$day    = strftime( "%d", $temp );
	$ip = getenv( 'REMOTE_ADDR' );
	$serial = addslashes( md5( $ip . microtime() ) );

//	echo "user: " . $user . "\n";
//	echo "ser : " . $serial . "\n";
	
	$trustee = trustee();
	$DB->Query( 'SELECT name FROM p_users WHERE id="' . $user . '";' );
	$DB->NextRecord();
	if ( empty( $DB->Record ) ) {
		echo "USER ID ERROR (setsession())!";
		die();
	}
	$username = $DB->Record['name'];   	// Name of the user 
//	$DB->Query( "SELECT ip,connect from p_session " .
//				"WHERE ip='" . $ip . "';)";
//	$DB->NextRecord();
//	if( empty( $DB->Record ) ){
	$DB->Query( "INSERT INTO p_session ( id, user, ip, day, serial, " .
				"name, project, transp1, transp2, trustee ) " .
				"VALUES ( null, \"$user\", \"$ip\", \"$day\", " .
				"\"$serial\", \"$username\", \"$project\", " .
				"null, null, \"$trustee\"); " );
//	}
				
	// Delete a old regs	
	if ( $day > 5 ) {
		$query = "DELETE FROM p_session WHERE day < " .	($day-1) . ";" ;
		$DB->Query( $query );
	}
	else {
		$query = "DELETE FROM p_session WHERE day > " .	$day . ";" ;
		$DB->Query( $query );
	}			
				
	return( $serial );
} // set_session() ----------------------------------------------------------
 

/** start_session 	Read data of a session 
 *	================================================
 *
 *	@global		Global['user']
 *	@global		Global['username']
 *	@global		Global['project'] 
 *	@global		Global['ip']
 *	@global		Global['trustee']
 *	@global		Global['transp1']
 *	@global		Global['transp2']
 *
 */

 
function start_session( $session, $version )
{
	$temp = explode( "|", $version );
	$Global['version'] 	= $temp[0];
	$Global['user']		= $temp[1];
	$Global['username'] = $temp[2];
	$Global['trustee']	= $temp[3];
	if( $temp[4] =='' ){
		$Global['lang']='es';
	}
	else{
		$Global['lang']		= $temp[4];
	}
	$Global['session']	= $session;
	$Global['ip']		= getenv( 'REMOTE_ADDR' );

	// Force a $Global['trustee'] to be a number 
	$Global['trustee'] += 0;

	return $Global;

} // start_session() --------------------------------------------------------



 
 
/** trustee 	Return a complete user trustee
 *	==========================================
 *
 *	@global		Global['user']
 *
 */
 
function trustee() 
{
	global $DB, $Global;
	
	$user = $Global['user'];
	$complete_trustee=0;
	
	$DB->Query( 'SELECT * FROM p_users WHERE id="' . $user . '";' );
	$DB->NextRecord();
	
	if ( empty( $DB->Record ) ) {
		echo "USER ID ERROR! (trustee())";
		die();
	}
	
		
		
	$t_user = $DB->Record['trustee'];   	// Original Trustee 
	
	// Makes an group array
	$t_user_array = array();
	for ( $i=1; $i <= 30; $i++ ) {
		if ( ($t_user & ( pow( 2, $i-1 )) ) > 0 ) {
			array_push( $t_user_array, ($i) );
		}
	}	

//echo "t_user -> " . $t_user_array . "<br /> \n";
	$DB->Query( 'SELECT * FROM p_groups;' );
	while ( $DB->NextRecord() ) {
		if( in_array( $DB->Record['id'], $t_user_array) ) {
			$t_group = $DB->Record['trustee' ];   	// Original Group Trustee
//echo "db -> $t_group <br /> \n";
			$complete_trustee = $complete_trustee | 
								pow( 2, ($DB->Record['id'] -1 )); 
			$complete_trustee = $complete_trustee | $t_group;
//echo "Complete -> $complete_trustee <br />\n";
		}
	}
//die();
	return $complete_trustee;
} // trustee() -------------------------------------------------------------- 






/** check_trustee		Return The Trustee relation between user and group
 *	======================================================================
 *
 * @parameter	$group	Group to compare trustee
 *
 * @returns		true	if user have a trustee to a refered group
 * @returns		false	if user no have a trustee
 *
 */
 
function check_trustee( $group ) {

	global $Global;
		
	if ( (($Global[ 'trustee' ] & $group) > 0) ||
	     (($Global[ 'trustee' ] & 1) > 0)) {
		return true;
	}
	else {
		return false;
	}
} // check_trustee() --------------------------------------------------------


function alert ( $text ) {
	echo "<script>\n ";
	echo "    alert( " . '"' . $text . '"' . " );\n";
	echo "    top.opener.alert( " . '"' . $text . '"' . " );\n";
	echo "</script>\n";
}




/**	proc_menu_link		Link files to a menu operation
 *	==================================================
 */

function proc_menu_link ( $options ) {

	global $Global;

	$directory = "./project/" . $Global['project'];
	$dir = opendir ( "$directory" );
	while( $filename = readdir ( $dir ) ) {
		$tmp = explode( ".", $filename );
		if ( $tmp[0] == "db" ) {
			array_push( $options, $tmp[0] . "." . $tmp[1] );			
		}
	}
	
	return $options;

} // proc_menu_link() -------------------------------------------------------


/**	proc_report_link		Link reports to a menu operation
 *	========================================================================
 */

function proc_report_link ( $options ) {

	global $Global;

	$directory = "./project/" . $Global['project'] . "/reports";
	$dir = opendir ( "$directory" );
	while( $filename = readdir ( $dir ) ) {
		$tmp = explode( ".", $filename );
		if ( $tmp[0] == "rep" ) {
			array_push( $options, $tmp[0] . "." . $tmp[1] );			
		}
	}
	
	return $options;

} // proc_report_link() ----------------------------------------------------



/*																			
	defineMotor		Define a variables to call a new javascript motor		
	======================================================================*/
	
function defineMotor() {

	global $Global,$TF, $T, $DB;
	if( $Global['print'] ){
		$T->Show('start_list');
		return;
	}
	echo "<script>\n";
//echo "document.onload=alert('hola');";



	// Procedures and constants Definition
	
	// prepare a Date field to a now() function
	$temp   = time();
	$year   = strftime( "%Y", $temp );
	$month  = strftime( "%m", $temp );
	$day    = strftime( "%d", $temp );
	echo 'const thisDate_ = "' . $day . "-" . $month . "-" . $year . 
		'";'."\n";  
	echo "document.onfocus=reload_ ;\n";
	echo "document.onkeydown=onKey;\n";
	echo "document.onUnload=goBack;\n";
	echo "const p_user_= '" . $Global['username'] . "';\n";
	$Global['proc_insert'] = trim($Global['proc_insert'],"\x00..\x1F");
	echo 'const PROC_INSERT_= "' . $Global['proc_insert'] . '"' . ";\n";
	$Global['proc_change'] = trim($Global['proc_change'],"\x00..\x1F");
	echo 'const PROC_CHANGE_= "' . $Global['proc_change'] . '"' . ";\n";
	$Global['proc_insert'] = trim($Global['proc_delete'],"\x00..\x1F");
	echo 'const PROC_DELETE_= "' . $Global['proc_delete'] . '"' . ";\n";
	echo "function startPage(){\n";
	echo "    operation  = " . $Global['oper'] .";\n" ;
	echo "    xOper      = " . $Global['oper'] .";\n" ;
	
// ##### 14	
	echo "    GenData    = '" . $DB->GenData .  "';\n" ;

	if ( $Global['acceptMode'] != $Global['oper'] ) {
		echo "    acceptMode = " . $Global['acceptMode'] .";\n" ;
	}
	else {
		echo "    acceptMode = -1;\n" ;
	}
	
// ##### 9 - Trustee correcion	
	echo "    _trustee    = " . $Global['trustee']. ";\n";
// OLD in 9	echo "var trustee    = " . $Global['trustee']. ";\n";


	echo "    formTitle  = \"" . $TF->title . "\";\n";
	if ( !empty ( $Global['send'] ) ) {
		echo "    subform = '" . $Global['send'] ."';\n" ;
	}
	else {
		echo "    subform = -1;\n";
	}
	echo "    startScreen = 0;\n";
//print_r($Global);	
	echo "    localTable = '".$Global['localTable']."';\n";

	//																{ #76 
	if( ! empty( $Global['sup'] ) ) {
		$tmp = explode(',',$Global['sup']);
		for( $i=0; $i<count($tmp); $i+=2 ) {
			if( $tmp[$i] != "_0_" ) {
			
// ##### 19			
//old				echo "sup['" . $tmp[$i] . "'] = '" . $tmp[$i+1] . "';\n";
				echo "    sup['" . $tmp[$i] . "'] = '" . 
				str_replace ("wWx", ",",$tmp[$i+1]) . "';\n";
// ##### 19

			}
		}
		//echo $tmp . "\n";
	} 	
	//																} #76 
	
	
// # 168
// # 168 end 

} // defineMotor() ---------------------------------------------------------

/*																			
	callMotor		Makes a call to new javascript motor					
	======================================================================*/
	
function callMotor( $var ) {
	global $Global, $T;
//print_r( $var );
//die();
	if ( $var['P_PROC_'] == "menu_link" ) {
		$temp = array();
		$temp[0] = "";
		$var['F_OPTIONS_'] = implode(proc_menu_link( $temp ),",");
	}

	if ( $var['P_PROC_'] == "report_link" ) {
		$temp = array();
		$temp[0] = "";
		$var['F_OPTIONS_'] = implode(proc_report_link( $temp ),",");
	}

	// Relations
	if ( $var['F_RELATION_'] != "" ){
		$var['C_CHANGE_'] 	= "1==0";
		$var['F_NODB_'] 	= "1";
		$var['F_QUERY_'] 	= "'SELECT ".$var['F_SHOWFIELD_']." FROM ".
			$var['F_RELTABLE_']." WHERE ".$var['F_RELFIELD_']."='+el['".
			$var['F_LOCALFIELD_']."'].getStr();";
		$var['F_QUERY_REF_']= "(el['".$var['F_LOCALFIELD_']."'].hasChanged())||".
		"((operation!=INSERT_)&&(el['".$var['F_NAME_']."'].firstSQL));";
	}


	$key = array_keys($var);
	for( $i=0; $i< count($key); $i++ ){
		$var[$key[$i]] = htmlspecialchars($var[$key[$i]]);
	}
	
	if( $Global['print'] ){
		if( $var['F_TYPE_'] == "subform" ){
			return;
		}
		$T->Show('start_list_cell');
		$T->Set('style', 'style="width: 10%;"');
		$T->Set('data', $var['F_ALIAS_']);
		$T->Show('list_cell');
		$T->Set('style', 'style="font-weight:bold"');
		$T->Set('data', $var['F_VALUE_']);
		$T->Show('list_cell');
		$T->Show('stop_list_cell');
		return;
	}
	// # 158
	$var['F_VALUE_'] = preg_replace("/\n/", "__CR__", $var['F_VALUE_']);
	$var['F_VALUE_'] = preg_replace("/\r/", " ", $var['F_VALUE_']);
	$var['F_VALUE_'] = preg_replace("/&quot;/", "\\\"", $var['F_VALUE_']);
	echo "    el['" . $var['F_NAME_'] . "'] = new form_engine(" . 

		$var['count'] 		. ',"' .
		$var['F_NAME_'] 	. '","' .
		$var['F_ALIAS_'] 	. '","' .
		$var['F_VALUE_'] 	. '","' .
		$var['F_HELP_'] 	. '","' .
		$var['F_TYPE_'] 	. '","' .
		$var['F_OPTIONS_'] 	. '","' .
		$var['F_LENGTH_'] 	. '","' .
		$var['F_DEC_'] 		. '","' .
		$var['C_SHOW_'] 	. '","' .
		$var['C_VIEW_'] 	. '","' .
		$var['C_CHANGE_'] 	. '","' .
		$var['C_DEL_'] 		. '","' .
		$var['G_SHOW_'] 	. '","' .
		$var['G_CHANGE_'] 	. '","' .
		$var['F_NODB_'] 	. '","' .
		$var['F_INLINE_'] 	. '","' .
		$var['F_REQUIRED_'] . '","' .
		$var['P_PROC_'] 	. '","' .
		$var['F_RELTABLE_'] . '","' .
		$var['F_SHOWFIELD_']. '","' .
		$var['F_PREVAL_'] 	. '","' .
		$var['V_DEFAULT_'] 	. '","' .
		$var['F_POSVAL_'] 	. '","' .
		$var['F_MESSAGE_'] 	. '","' .
		$var['F_LINK_'] 	. '","' .
		$var['F_SEND_'] 	. '","' .
		$var['F_FORMULA_'] 	. '","' .
		$var['F_QUERY_'] 	. '","' .
		$var['F_QUERY_REF_'] 	. '","' .
		$var['F_FILTER_'] 	. '","' .
		$var['F_AUTONUM_'] 	. '","' .
		$var['F_DSL_'] 		. '","' .
		$var['F_REPORT_']	. '","' .
		$var['F_MULTI_'] . '");'."\n" ;
		
// ##### 4
	// New variable compatibility system
	if( $var['F_NAME_'] != 'operation' ){
		echo   "    " .  $var['F_NAME_'] . " = el['" .  $var['F_NAME_'] . "'];\n";
	}
// ##### 4

} // callMotor() -----------------------------------------------------------
 

/*																			
	startMotor		makes a last call to start a new motor					
	======================================================================*/
	
function startMotor() {
	global $Global, $T;
	if( $Global['print'] ){
		$T->Show('end_list');
		return;
	}
	
	
	echo "    showAll();\n";
	echo "}\n";
	echo "startPage();\n";
	
	
	echo "</script>\n";
} // startMotor() ---------------------------------------------------------



/*																			
	backButton		makes a back Button										
	======================================================================*/
function backButton() {
	global $TF, $Global;
	include_once("include/".$Global['lang']."/functions_lang.php");
	$TF->Set('name', MSG_GOBACK_ );
	$TF->Set('help', HLP_GOBACK_);
	$TF->Show('close_button');
} // backButton() ----------------------------------------------------------


/*																			
	enableChangeButton		makes a Button	to enable Changes				
	======================================================================*/
function enableChangeButton( $hidden = 0 ) {
	global $TF,$Global;
	include_once("include/".$Global['lang']."/functions_lang.php");
	$TF->Set('command','onclick="enableChange()"');
	$TF->Set('name', MSG_CHANGE_ );
	$TF->Set('help', HLP_CHANGE_);
	if( $hidden == 0 ){
		$TF->Set( 'hidden','');
	}
	else {
		$TF->Set('hidden','hidden="true"');
	}
	$TF->Show('enableChange');
} // enableChangeButton() --------------------------------------------------

/*																			
	insertButton		makes a Button	to insert data						
	======================================================================*/
function insertButton( $command ) {
	global $TF, $Global;
	include_once("include/".$Global['lang']."/functions_lang.php");
	$TF->Set('command',$command);		
	$TF->Set('name', MSG_INSERT_ );
	$TF->Set('help', HLP_INSERT_);
	$TF->Show('insert_button');
} // insertButton() --------------------------------------------------------

/*																			
	insConsButton		makes a Button	to insert data in a consult					
	======================================================================*/
function insConsButton( $command ) {
	global $TF, $Global;
	include_once("include/".$Global['lang']."/functions_lang.php");
	$TF->Set('command',$command);		
	$TF->Set('name', MSG_INSERT_ );
	$TF->Set('help', HLP_INSERT_);
	$TF->Show('ins_cons_button');
} // insertButton() --------------------------------------------------------

/*																			
	consultButton		makes a Button	to consult data						
	======================================================================*/
function consultButton( $command ) {
	global $TF, $Global;
	include_once("include/".$Global['lang']."/functions_lang.php");
	$TF->Set('command',$command);		
	$TF->Set('name', MSG_CONSULT_ );
	$TF->Set('help', HLP_CONSULT_ );
	$TF->Show('insert_button');
} // consultButton() -------------------------------------------------------


/*																			
	nextButton		makes a Button	to next data page						
	======================================================================*/
function nextButton( $command ) {
	global $TF, $Global;
	include_once("include/".$Global['lang']."/functions_lang.php");
	$TF->Set('command',$command);		
	$TF->Set('name', MSG_NEXT_ );
	$TF->Set('help', HLP_NEXT_ );
	$TF->Show('next_button');
} // nextButton() ----------------------------------------------------------

/*																			
	previousButton		makes a Button	to previos data page						
	======================================================================*/
function previousButton( $command ) {
	global $TF, $Global;
	include_once("include/".$Global['lang']."/functions_lang.php");
	$TF->Set('command',$command);		
	$TF->Set('name', MSG_PREVIOUS_ );
	$TF->Set('help', HLP_PREVIOUS_ );
	$TF->Show('previous_button');
} // previousButton() ------------------------------------------------------





/*																			
	propertyButton		makes a Button	to property control					
	======================================================================*/
function propertyButton( $command ) {
	global $TF, $Global;
	include_once("include/".$Global['lang']."/functions_lang.php");
	$TF->Set('command',$command);
	$TF->Set('name', MSG_PROPERTIES_ );
	$TF->Set('help', HLP_PROPERTIES_);
	$TF->Show('property_button');
} // propertyButton() ------------------------------------------------------


/*																			
	acceptChangeButton		makes a Button to accept changes				
	======================================================================*/
function acceptChangeButton( $command ) {
	global $TF, $Global;
	include_once("include/".$Global['lang']."/functions_lang.php");
	$TF->Set( 'command', $command );
	$TF->Set('name', MSG_ACCEPT_ );
	$TF->Set('help', HLP_ACCEPT_ );
	$TF->Show('accept_button');
} // acceptChangeButton() --------------------------------------------------


/*																			
	deleteButton		makes a delete Button								
	======================================================================*/
	
function deleteButton( $command ) {
	global $TF, $Global;
	include_once("include/".$Global['lang']."/functions_lang.php");
	$TF->Set( 'command',$command );
	$TF->Set('name', MSG_DELETE_ );
	$TF->Set('help', HLP_DELETE_ );
	$TF->Show('delete_button');
} // deleteButton() ----------------------------------------------------------


/*																			
	convertChar		converts a special chars + , \							
	======================================================================*/
	
function convertChar( $chars ) {
	$tmp = str_replace( "wWx", ",", $chars);
	$tmp = str_replace( "wWz", "+", $tmp);
	$tmp = str_replace( "wWw", "\\\\\\", $tmp);
//	echo $tmp . "<br /> ". htmlspecialchars( $tmp )."<br /><br /> ";	
	return ( $tmp );
} // convertChar() ---------------------------------------------------------



/*																			
	includeJs		Include a specific Javascript code						
	======================================================================*/
	
function includeJs( $code ) {
	global $Global;
	if( $Global['print']){
		return;
	}
	// Language Control
	if($Global['lang']==''){
		$Global['lang']="en";
	}
	if ( file_exists( "./include/" .$Global['lang']."/". $code ) ){
		echo '<script src="./include/' .$Global['lang'].'/'. $code . 
			'" type="application/x-javascript" encoding="ISO-8859-1"/>';
	}
	echo '<script src="./include/' . $code . 
		 '" type="application/x-javascript" encoding="ISO-8859-1">';
	echo "</script>\n";
} // includeJs() -----------------------------------------------------------


/**
 *	clearEnter		Remove a CR of string
 *	========================================================================
 */

function clearEnter( $string ){
	$tmp = $string;
// ##### 21 - New format to a data elements
	$tmp = str_replace ("_.", "el['",$tmp );
	$tmp = str_replace ("._get", "'].get()",$tmp );
	$tmp = str_replace ("._val", "'].getVal()",$tmp );
	$tmp = str_replace ("._str", "'].getStr()",$tmp );
	$tmp = str_replace ("._chg", "'].hasChanged()",$tmp );
	$tmp = str_replace ("._", "']",$tmp );
// ##### 21

	$tmp = str_replace ("\r", "",$tmp );
	$tmp = str_replace ("\n", "",$tmp );
	$tmp = str_replace ("\t", "",$tmp );
	return trim($tmp, "\x00..\x1F");
}// clearEnter() -----------------------------------------------------------


/**	extense		Return a extense of a number or a value
 *	========================================================================
 *	
 *	@param	$value	A value to convert
 *	@param	$type 	1 if is a monetary format / 0 if is a single number
 * 	@param	$upper 	1 to uppercase / 0 to lowercase
 *
 */
function extense( $value=0, $type=0, $upper=1 ){

	$value = strval( $value );
	$value = str_replace (',','', $value);

	if( strpos($value,".")<1 ){
		$value .='.';
	}

	// If type is a single number
	if( $type == 0 ){
		$pos	= strpos($value,".");
		$value	= substr($value,0,$pos);
		$sing	= array("","", "mil", "millon"  , "mil millon"  , "billon"  );
		$plural = array("","", "mil", "millones", "mil millones", "billones");
	}
	// If type is a value number (monetary)
	else{
		$sing	= array("centavo" , "Guarani"  , "mil",   "millon"  , 
						"mil millon"  , "billon"   );
		$plural = array("centavos", "Guaranies", "mil", "millones", 
						"mil millones", "billones" );
	}

	// Arrays to a number values
	// Hundreds
	$hund 	= array("", "cien", "doscientos", "trescientos", "cuatrocientos",
			"quinientos", "seiscientos", "setecientos", "ochocientos",
			"novecientos");
	// Decens
	$dec 	= array("", "diez", "veinte", "treinta", "cuarenta", "cincuenta",
			"sesenta", "setenta", "ochenta", "noventa");
	// Decens less than a twelve
	$dec2	= array("diez", "once", "doce", "trece", "catorce", "quince",
			"dieciseis", "diecisiete", "dieciocho", "diecinueve");
	// Units
	$units 	= array("", "uno", "dos", "tres", "cuatro", "cinco", "seis",
			"siete", "ocho", "nueve");
			
	$z = 0;
	$ret = '';
	
	// Separate in points format ###.###.###.##
    $value = number_format($value, 2, ".", ".");			
	
    $int = explode(".", $value);
    for($i=0;$i<count($int);$i++){
        for($ii=strlen($int[$i]);$ii<3;$ii++){
            $int[$i] = "0".$int[$i];
		}
	}
			
	$fim = count($int) - ($int[count($int)-1] > 0 ? 1 : 2);
	for ($i=0;$i<count($int);$i++) {
		$value = $int[$i];
		
		// Spanish Version
		$rc = (($value > 100) && ($value < 200)) ? "ciento" : $hund[$value[0]];
		$rd = ($value[1] < 2) ? "" : $dec[$value[1]];
		$ru = ($value > 0) ? (($value[1] == 1) ? $dec2[$value[2]] : $units[$value[2]]) : "";
		$r = $rc.(($rc && ($rd || $ru)) ? "  " : "").$rd.(($rd &&
			$ru) ? " y " : "").$ru;
		$t = count($int)-1-$i;
		$r .= $r ? " ".($value > 1 ? $plural[$t] : $sing[$t]) : "";
		if ($value == "000")$z++; elseif ($z > 0) $z--;
		if (($t==1) && ($z>0) && ($int[0] > 0)) $r .= (($z>1) ? 
			" de " : "").$plural[$t];
		if ($r) $ret = $ret . ((($i > 0) && ($i <= $fim) &&
			($int[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? "  " : "  ") : " ") . $r;

		/* Portuguese Version
		$rc = (($value > 100) && ($value < 200)) ? "cento" : $hund[$value[0]];
		$rd = ($value[1] < 2) ? "" : $dec[$value[1]];
		$ru = ($value > 0) ? (($value[1] == 1) ? $dec2[$value[2]] : $units[$value[2]]) : "";
		$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd &&
			$ru) ? " e " : "").$ru;
		$t = count($int)-1-$i;
		$r .= $r ? " ".($value > 1 ? $plural[$t] : $sing[$t]) : "";
		if ($value == "000")$z++; elseif ($z > 0) $z--;
		if (($t==1) && ($z>0) && ($int[0] > 0)) $r .= (($z>1) ? 
			" de " : "").$plural[$t];
		if ($r) $ret = $ret . ((($i > 0) && ($i <= $fim) &&
			($int[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? " e " : " e ") : " ") . $r;
		*/

	}
		
	if( $upper==1 ){
		$ret = strtoupper($ret);
	}
	
	/*Line added by Douglas to change uno millon by un millon*/
	
	$correction0 = str_replace("uno millon", "un millon", $ret);
	$correction1 = str_replace("UNO MILLON", "UN MILLON", $correction0);		 

    return ($correction1);

} // extense() -------------------------------------------------------------



/** extDate		Returns a date in a extense format
 *	========================================================================
 *
 * @param	$date 	A date to convert 
 *
 */

function extDate( $date ){
	$Amonth = array( 'enero','febrero','marzo','abril','mayo','junio',
			'julio','agosto','setiembre','octubre','noviembre','diciembre');
	$month = substr( $date,5,2 )-1;
	return( substr( $date, 8,2) . ' de ' . $Amonth[ $month ] . ' de ' .
		substr( $date, 0,4 ) );
			
} // extenseDate() ---------------------------------------------------------

?>