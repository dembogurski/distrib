<?php

/** Y_Engine.class.php		Class for Engine Objects
 *  ================================================
 *
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	May, 30 of 2005
 *
 */

 
define ( 'TEXT_', 		1  );
define ( 'SELECT_LIST_',2  );
define ( 'VISIBLE_', 	4  );
define ( 'REQUIRED_',	8  ); 
define ( 'EDITABLE_',	16 );
define ( 'EXTERN_', 	32 );
define ( 'FOCUSED_',	64 );
define ( 'NODB_',		128); 
 
class Y_Engine {

	var $element;				// Elements list 
	var $def_element;			// Definitions Element list
//	var $form_def;
	var $formtype;
	var $alias;
	var $file;
	var $doc;
	var $help;
	var $def_form;  			// True if is a definition formulary
	var $def_mul;				// Is a multiple definition form
	var $engine;				// If is a engine form
 	
	
	/** Constructor
	 *  ===========
	 */
 
 	function Y_Engine ()	{
		$this->element = array();

	} // Constructor --------------------------------------------------------
 
 
	/** Add		Add a new engine element
	 *  ===============================
	 *
	 * @parameter	$obj	Element to charge in a object
	 *
	 */
	function Add ( $obj )	{
//print_r($obj);
//die();
		$key = array_keys( $obj );
		$this->element[ $obj[ 'F_NAME_' ] ] = array();
		for ( $i=0; $i < count ($obj); $i++ ) {
			$this->element[$obj['F_NAME_']] [$key[$i]]=$obj[$key[$i]];
		}
//print_r($this);
//die();	
	
						
		// If no have specification of trustees
		if ( empty($this->element[ $obj[ 'F_NAME_' ]] [ 'G_SHOW_' ])) {
			// Original trustee to show element
			$this->element[ $obj[ 'F_NAME_' ]] [ 'G_SHOW_' ] = 1;
		}

	
						
	} // Add() --------------------------------------------------------------

	
	

	/** Add_Def		Add a new engine definition element
	 *  ===============================================
	 *
	 * @parameter	$obj	Element to charge in a object
	 *
	 */
	function Add_Def ( $obj )	{
		$key = array_keys( $obj );
		$this->def_element[ $obj[ 'F_NAME_' ] ] = array();
		for ( $i=0; $i < count ($obj); $i++ ) {
			$this->def_element[$obj['F_NAME_']] [$key[$i]]=$obj[$key[$i]];
		}
		
		// If no have specification of trustees
		if ( empty($this->def_element[ $obj[ 'F_NAME_' ]] [ 'G_SHOW_' ])) {
			// Original trustee to show element
			$this->def_element[ $obj[ 'F_NAME_' ]] [ 'G_SHOW_' ] = 1;
		}
						
	} // Add_Def() ---------------------------------------------------------

		
	

	/** Get		Return a property of an element
	 * 	=======================================
	 *
	 * @parameter	$name	Name of element
	 * @parameter	$prop	Property to return
	 *
 	 */
	 
	function Get ( $name, $prop ) {
		return ( $this->element[ $name ] [ $prop ] );
	} // Get() --------------------------------------------------------------

	 

	/** Set		Set a property of an element
	 * 	====================================
	 *
	 * @parameter	$name	Name of element
	 * @parameter	$prop	Property to set 
	 *
 	 */
	 
	function Set ( $name, $prop ) {
		$this->element[ $name ] = $prop;
	} // Set() --------------------------------------------------------------
	 
	
	
	/** Get_Def		Return a property of an definition element
	 * 	======================================================
	 *
	 * @parameter	$name	Name of definition element
	 * @parameter	$prop	Property to return
	 *
 	 */
	 
	function Get_Def ( $name, $prop ) {
		return ( $this->def_element[ $name ] [ $prop ] );
	} // Get_Def() ----------------------------------------------------------

	 

	/** Set_Def		Set a property of an definition element
	 * 	===================================================
	 *
	 * @parameter	$name	Name of definition element
	 * @parameter	$prop	Property to set 
	 *
 	 */
	 
	function Set_Def ( $name, $prop ) {
		$this->def_element[ $name ] = $prop;
	} // Set_Def() ----------------------------------------------------------
	 


	
	/** SetName		Set a name of object
	 * 	====================================
	 *
	 * @parameter	$name	Name of object
	 *
 	 */
	 
	function SetName ( $name ) {
		$this->name = $name;
	} // SetName() -----------------------------------------------------------

	
		
	/** GetName		Get a name of object
	 * 	====================================
	 *
 	 */
	 
	function GetName () {
		return $this->name;
	} // SetName() -----------------------------------------------------------
	
	
	/** SetAlias		Set a name of object
	 * 	====================================
	 *
	 * @parameter	$name	Name of object
	 *
 	 */
	 
	function SetAlias ( $alias ) {
		$this->alias = $alias;
	} // SetName() -----------------------------------------------------------
	 

	
	/** GetAlias		Get a alias of object
	 * 	=====================================
	 *
 	 */
	 
	function GetAlias () {
		return $this->alias;
	} // SetAlias() -----------------------------------------------------------
 

	/** SetFile		Set a file or table of object
	 * 	=========================================
	 *
	 * @parameter	$file	File or Table of object
	 *
 	 */
	 
	function SetFile ( $file ) {
		$this->file = $file;
	} // SetTable() ----------------------------------------------------------


	/** GetFile		Get a file or table of object
	 * 	=========================================
	 *
	 *
 	 */
	 
	function GetFile () {
		return $this->file;
	} // SetTable() ----------------------------------------------------------

	
	
	
	
	
	/** Make Report		Make e report
	 * 	==================================
 	 */
	 	
	function makeReport () {

		require_once("include/Y_Engine_Make_Report.php");
	
	} // makeReport() ------------------------------------------------------
	 
	
	
	/** Browse_Data		Browse a data form
	 * 	==================================
 	 */
	 	
	function Browse_Data () {

		require_once("include/Y_Engine_Browse_Data.php");
	
	} // Browse_Data() ------------------------------------------------------
	 
	

	
	/** Browse_DB		Browse a DB object
	 * 	==================================
	 */
	 	
	function Browse_DB () {
		
		require_once("include/Y_Engine_Browse_DB.php");
	
	} // Browse_DB() ------------------------------------------------------
	 
	
	
	
	/** Browse_DB_Form		Browse a DB form
	 * 	====================================
	 *
	 *
 	 */
	 	
	function Browse_DB_Form () {
		
		require_once("include/Y_Engine_Browse_DB_Form.php");
	
	} // Browse_DB_Form() ---------------------------------------------------
	 
	
		
	

	/** Browse_Def		Browse a definition form
	 * 	========================================
	 *
	 *
 	 */
	 	
	function Browse_Def() {
		
		require_once("include/Y_Engine_Browse_Def.php");
	
	} // Browse_Def() --------------------------------------------------------

	
	
	
		
	/** Show_Prop		Show a propiety of an object from a data form
	 * 	=============================================================
	 *
	 * @parameters		$object		Name of selected object
 	 */
	 	
	function Show_Prop ( $object ) {
	
		require_once("include/Y_Engine_Show_Prop.php");
	
	} // Show_Prop() --------------------------------------------------------
	

	
	
	
	
	
	/** Show_Data		Show a selected object from a data form
	 * 	=======================================================
	 *
	 * @parameters		$object		Name of selected object
 	 */
	 	
	function Show_Data ( $object ) {

		require_once("include/Y_Engine_Show_Data.php");
	
	} // Show_Data() --------------------------------------------------------
	
	
	
	
	/** Show_Data_DB		Show a selected object from a data form
	 * 	=======================================================
	 *
	 * @parameters		$object		Name of selected object
 	 */
	 	
	function Show_Data_DB ( $object ) {

		require_once("include/Y_Engine_Show_Data_DB.php");
	
	} // Show_Data_DB() -----------------------------------------------------
	
	
	
	
	/** Show_DB		Show a selected object from a DB form
	 * 	=================================================
	 *
	 * @parameters		$object		Name of selected object
 	 */
	 	
	function Show_DB ( $object ) {
	
		require_once("include/Y_Engine_Show_DB.php");
	
	} // Show_DB() --------------------------------------------------------


	
	/** Delete_Data		Delete a selected object from a data form
	 * 	=======================================================
	 *
	 * @parameters		$object		Name of selected object to delete
	 * @parameters 		$file		File to write 	 
 	 */
	 	
	function Delete_Data ( $file, $object ) {
	
		global $Global;

		$this->element [$object] [ F_NAME_ ] = "__DeleteD__";
		$this->Write_Data_Form( $file );
		audit_log ( $Global['username'], 'Delete_Data ' . $object, 'OK','' );
	
	
	} // Delete_Data() ------------------------------------------------------

	
	/** Delete_DB_el		Delete a selected object from a DB Form
	 * 	=======================================================
	 *
	 * @parameters		$object		Name of selected object to delete
	 * @parameters 		$file		File to write 	 
 	 */
	 	
	function Delete_DB_el ( $file, $object ) {
	
		global $Global;

		$this->element [$object] [ F_NAME_ ] = "__DeleteD__";
		$this->Write_DB_Form_el( $file );
		
		audit_log ( $Global['username'], 'Delete_DB_el ' . $object, 'OK','' );
	
	
	} // Delete_DB_el() -----------------------------------------------------

	
	
	
	/** Delete_DB_form		Delete a selected DB Form
	 * 	=======================================================
	 *
	 * @parameters 		$file		File to delete 	 
 	 */
	 	
	function Delete_DB_form ( $file ) {
	
		if ( !unlink( $file ) ) {
			alert( "Error al borrar el archivo $file");
			audit_log ( $Global['username'], 'Delete_DB_Form ' . $file, 'NO','' );
		}
		else{
			audit_log ( $Global['username'], 'Delete_DB_Form ' . $file, 'OK','' );
		}
	
	} // Delete_DB_form() ---------------------------------------------------

	
	
	/** Delete_Data_form		Delete a selected  data Form
	 * 	=======================================================
	 *
	 * @parameters 		$file		File to delete 	 
 	 */
	 	
	function Delete_Data_form ( $file ) {
	
		if ( strpos( $file, "data.menu") ) {
			sayerror ( "No me hagas esooooooo!!! Soy el menu principal!" );
			return;
		}
		
		if ( !unlink( $file ) ) {
			alert( "Error al borrar el archivo $file");
			audit_log ( $Global['username'], 'Delete_Data_Form ' . $file, 'NO','' );
		}
		else{
			audit_log ( $Global['username'], 'Delete_Data_Form ' . $file, 'OK','' );	
		}
	
	} // Delete_Data_form() ------------------------------------------------

	
	
	/** Delete_DB		Delete a selected object from a db form
	 * 	=======================================================
	 *
	 * @parameters		$object		id of selected object to delete
 	 */
	 	
	function Delete_DB ( $object ) {
	
		global $DB, $Global;
		
		$table = $this->File;
		// Prepare data to log system
		$query="SELECT * FROM " . $this->File . " WHERE id=" . $object . ";";
		$DB->Query( $query );
		$DB->NextRecord();

		$procName = $DB->Record['name'];	// name if is a procedure
		$procType = $DB->Record['type'];	// type if is a procedure
		
		$obs = '';
		for( $i=0; $i<count($DB->Record)/2; $i++ ){
			if( $i>0 ){
				$obs .= ",'" . $DB->Record[$i] . "'";
			}
			else{
				$obs .= "'" . $DB->Record[$i] ."'";
			}
		}

		// Check if a Procedure TABLE
		if( $table == "p_proc" ){
			if( $procType == "PROCEDURE") {
				$this->deleteProcedure( $procName );
			}
			else{
				$this->deleteFunction( $procName );
			}
		}

// #155 Integrity Referencial Version of Delete
		$this->Delete_Integrity( $this->File, "id=\"".$object."\"" );


	} // Delete_DB() --------------------------------------------------------

	
	
	/**
	 * Delete_Integrity	Delete a record checking a Referencial Integrity
	 * 
	 * @param $table		Name of a table to delete field
	 * @param $condition	Condition to delete
	 */

	
	function Delete_Integrity( $table, $condition){
		global $DB, $Global;
		
		// Referencial Integrity Check
		
		// Check if exist a dependency of this table
		$DBI = new Y_DB();
		$DBI->Database = $Global['project'];
		$DBI->Query("SELECT * from p_ref_int WHERE _ref_table=\"".$table."\"" );
		$refer = false;
		while( $DBI->NextRecord() ){
			if( !empty( $DBI->Record['_ref_field'] )	){
				$ref_field = $DBI->Record['_ref_field'];				
				$dep_table = $DBI->Record['_dep_table'];
				$dep_field = $DBI->Record['_dep_field'];
				// Read a reference data
				$DBS = new Y_DB();
				$DBS->Database = $Global['project'];
				$DBS->Query("SELECT * from ".$table." WHERE ".$condition );
				$DBS->NextRecord();
				$field = $DBS->Record[$ref_field];
				// Read a dependent data
				$DBS->Query("SELECT ".$dep_field." from ".$dep_table." WHERE ".
							$dep_field."=\"".$field."\"" );
				$DBS->NextRecord();
				if( !empty( $DBS->Record[$dep_field] )){
					$refer=true;
				}
			}
		}

		if( !$refer ){
			$Global['SQL_Status'] = "OK";
			$query="DELETE FROM " . $table . " WHERE " . $condition . ";";
			$DBI->Query( $query );
			audit_log ( $Global['username'], '(' . $this->File .
			 			') DELETE', $Global['SQL_Status'], $obs );
		}
		else {
			$DBI->Query("_REF_INT_");
			$DBI->NextRecord();
		}
		
		return;


/* OLD in # 12

		// Referencial Integrity Check
		$DBR = $DB;
		$DBR->Query("SELECT * from p_integr WHERE prim_table=\"".$table."\"" );
		
		$refer = false;
		$result = array();
		while( $DBR->NextRecord()){
			if( !empty( $DBR->Record )){
				array_push($result,array('prim_field'	=> $DBR->Record['prim_field'],
										'prim_table' 	=> $DBR->Record['prim_table'],
										'sec_field'  	=> $DBR->Record['sec_field'],
										'sec_table'  	=> $DBR->Record['sec_table'],
										'operation'  	=> $DBR->Record['operation']));
			}
		}
// #### 4 The primary and secondari data is swapped (Yes, I'm a fool!)	
		for($count=0; $count<count($result); $count++){
			$prim_field = $result[$count]['prim_field'];
			$prim_table = $result[$count]['prim_table'];
			$sec_field  = $result[$count]['sec_field'];
			$sec_table  = $result[$count]['sec_table'];
			$operation = $result[$count]['operation'];
			$DB->Query("SELECT ".$prim_field." ". 
						"FROM "  .$prim_table." ".
						"WHERE ".$condition)." LIMIT 1;";
			$DB->NextRecord();
			if( !empty($DB->Record )){
				$key = $DB->Record[$prim_field];
				$DB->Query("SELECT " . $sec_field ." ".
							"FROM " . $sec_table . " ".
							"WHERE ". $sec_field."=\"". $key."\" LIMIT 1;" );
				$DB->NextRecord();
				if( !empty($DB->Record)){
					if( $operation=="restrict"){
						$refer=true;
echo "<script>parent.alert('error')</script>" ;
						$DB->Halt("Integridad (".$prim_table.".".$prim_field."=".
						$key." existe en ".$sec_table.".".$sec_field. ")");
						$refer=true;
						break;
					}
					$refer=true;
				}
			}
		}
		
		
		if( !$refer ){
			$Global['SQL_Status'] = "OK";
			$query="DELETE FROM " . $table . " WHERE " . $condition . ";";
			$DBR->Query( $query );
			audit_log ( $Global['username'], '(' . $this->File .
			 			') DELETE', $Global['SQL_Status'], $obs );
		}
		
		return;

*/

		
	} // Delete_Integrity() ------------------------------------------------
	
	
	
	
	
	/** Change_Data		Change a selected object from a data form
	 * 	=======================================================
	 *
	 * @parameters		$object		Name of selected object to delete
	 * @parameters 		$file		File to write 
	 * @parameters		$pass		Passed variables in a string
 	 */
	 	
	function Change_Data ( $file, $object, $pass ) {
	
		global $Global;

		$array = explode( ",", $pass);
		
		for ( $i=0; $i<count($array); $i+=2){
			$name = $array[$i];
			
	
			$cont = convertChar( $array[$i+1] );		

//			$cont = $array[$i+1];
			if( $name != "_0_" ) {
				$this->element[$object][$name] = $cont;
			}
		}
//		$var = str_replace( "wWx", ",", $pass);
		$this->Write_Data_Form( $file );
	
	
	} // Change_Data() ------------------------------------------------------

	
	
	/** Write_Data_Form		write a data form
	 * 	=======================================================
	 *
	 * @parameters	$file	File to write
 	 */
	 	
	function Write_Data_Form ( $file ) {
	
		global $Global;

		$Obj = new Y_Engine();	
		$def_file = "engine/".$Global['lang']."/def." . 
		$Global['link'] . ".php";
		require( $def_file );
		
		if ( $handler = fopen( $file, "w")) {
		
		fputs($handler,  "<?php\n" );
		
		fputs($handler,  "/** " . $Global['full_link'] . ".php	" );	
		fputs($handler,  $this->doc . "    ( data_form )\n" );		
		fputs($handler,  " * \n" );	
		fputs($handler,  " * @author 	ycube RAD Plus " );
		fputs($handler,  "( automatically Generated ) \n" );	
		fputs($handler,  " * \n" );	
		fputs($handler,  " */ \n\n" );	
		
		// Writes a main properties
		$key = array_keys( $Obj->def_element );	
		for( $i=0; $i< count( $key); $i++ ) {
			$main = "\$Obj->". $key[$i] . " = " ;
			$main .= '"' . clearEnter($this->$key[$i]) . '"' . ";\n";
			fputs($handler,  $main );
		}
			$keydef = array_keys( $Obj->element );	
			$key = array_keys( $this->element );
			
			for( $i=0; $i< count( $key ); $i++ ) {
				$element = $key[$i];
				if( ($this->Get( $element, F_NAME_ ) != "__DeleteD__" ) ) {
					fputs($handler,  "\$Obj->Add(\n" );
					fputs($handler, "    array(\n"  );
					for( $x=0; $x< count( $keydef ); $x++ ) {					
						$index = $keydef[$x];
						$el  = '"' . 
						clearEnter($this->Get($element,$index)).'"';

						if ( $x< count( $keydef ) -1  ) {
							$el .= ",\n";
						}
						
						fputs($handler, "        " . $index . " => " . $el  );
						
					}
					fputs( $handler, "));\n\n"   );
				}		
			} 
			
			fputs($handler,  "?>\n" );
		}	
		else {
			sayerror( "error in fputs" );
		}
	
	} // Write_Data_Form() --------------------------------------------------


	
	
	/** Change_DB_Form		Change a selected object from a DB form
	 * 	===========================================================
	 *
	 * @param		$object		Name of selected object to delete
	 * @param 		$file		File to write 
	 * @param		$pass		Passed variables in a string
 	 */
	 	
	function Change_DB_form ( $file, $object, $pass ) {
	
		global $Global;
		$object = "header_";
		$array = explode( ",", $pass);
		for ( $i=0; $i<count($array); $i+=2){
			$name = $array[$i];
			
			$cont = convertChar( $array[$i+1] );		
			
			if( $name != "_0_" ) {
				$this->element[$object][$name] = $cont;
			}
		}
		$file .= ".php";
		$this->Write_DB_Form( $file );

		audit_log ( $Global['username'], 'CHANGE_DB_Form ' . $pass, 'OK','' );
	
	
	} // Change_DB_form() ------------------------------------------------------

	
	/** Change_DB_Form_el		Change a selected element from a DB form
	 * 	===========================================================
	 *
	 * @param		$object		Name of selected object to delete
	 * @param 		$file		File to write 
	 * @param		$pass		Passed variables in a string
 	 */
	 	
	function Change_DB_form_el ( $file, $object, $pass ) {
	
		global $Global;

// print_r($object);		
//		$object = "header_";
		$array = explode( ",", $pass);
		for ( $i=0; $i<count($array); $i+=2){
			$name = $array[$i];
			
			$cont = convertChar( $array[$i+1] );		

			if( $name != "_0_" ) {
				$this->element[$object][$name] = $cont;
			}
		}
		$file .= $this->element['header_']['name'] . ".php";
		$this->Write_DB_Form_el( $file );
		
		audit_log ( $Global['username'], 'CHANGE_DB_FORM_EL ' . $pass, 'OK','' );
	
	
	
	
	
	
	
	} // Change_DB_form_el() ---------------------------------------------------

	
	/** Change_DB_Form_el_2		Change a selected element from a DB form
	 * 	===========================================================
	 *
	 * @param		$object		Name of selected object to delete
	 * @param 		$file		File to write 
	 * @param		$pass		Passed variables in a string
 	 */
	 	
	function Change_DB_form_el_2 ( $file, $object, $pass ) {
	
		global $Global, $DB;

		$object = "header_";
		$array = explode( ",", $pass);
		for ( $i=0; $i<count($array); $i+=2){
			$name = $array[$i];
			
			$cont = convertChar( $array[$i+1] );		


			if( $name != "_0_" ) {
				$this->$name = $cont;
			}
		}
	

	
		$file .= $this->element['header_']['name'] . ".php";
		$this->Write_DB_Form_el( $file );

		audit_log ( $Global['username'], 'CHANGE_DB_FORM_EL ' . $pass, 'OK','' );
	
	
	
	} // Change_DB_form_el_2() ---------------------------------------------------

	
	
	
	
	
	/** Write_DB_Form		write a DB form
	 * 	=======================================================
	 *
	 * @param	$file	File to write
 	 */
	 	
	function Write_DB_Form ( $file ) {
	
		global $Global;

		$Obj = new Y_Engine();	

		$tmp = explode( "__", $Global['link']);
		$def_file = "engine/".$Global['lang']."/def." . $tmp[0]. "__.php";
		require( $def_file );
		$copy_from="";
				
		if ( $handler = fopen( $file, "w")) {
		
			fputs($handler,  "<?php\n" );
		
			fputs($handler,  "/** " . $file );	
			fputs($handler,  $this->doc . "    ( db_form )\n" );		
			fputs($handler,  " * \n" );	
			fputs($handler,  " * @author 	ycube RAD Plus " );
			fputs($handler,  "( automatically Generated ) \n" );	
			fputs($handler,  " * \n" );	
			fputs($handler,  " */ \n\n" );	
		
			// Writes a main properties
			$key = array_keys( $this->element ['header_']);	
			for( $i=0; $i< count( $key); $i++ ) {
				$main = "\$Obj->". $key[$i] . " = " ;
				$main .= '"' . 
					clearEnter($this->element['header_'][$key[$i]]). 
					'"' . ";\n";
// ##### 20			
				if( $key[$i] != "copy_from" ){
					fputs($handler,  $main );
				}
				else{
					$copy_from=$this->element['header_'][$key[$i]];
				}
	// ##### 20


//				fputs($handler,  $main );
			}


//			fputs($handler,  $copy_from );

			if( !empty($copy_from) ){
				$copy_from = "project/".$Global['project']."/".$copy_from.".php";
				$arr=file( $copy_from );
				$c = 0;
				while ( $c<= count($arr) ) {
					$word = explode (" ", $arr[$c]);
					$word[0] = chop( $word[0] );
					if( ( $word[0] != "?>" ) 			&&
						( $word[0] != "<?php" ) 		&&
						( $word[0] != "\$Obj->name" ) 	&&
						( $word[0] != "\$Obj->alias" ) &&
						( $word[0] != "\$Obj->help" ) 	){
						fputs( $handler, $arr[$c] );
//						fputs( $handler, "[".$word[0]."]\n" );
					}
					$c++;
				}
			}
			
// ##### 20

			fputs($handler,  "?>\n" );
		}	
		else {
			sayerror( "error in fputs" );
		}
		
		
		fclose( $handler );
		
	
	} // Write_DB_Form() --------------------------------------------------

	
	
	
	
	/** Write_DB_Form_el		write a DB form element
	 * 	=======================================================
	 *
	 * @param	$file	File to write
 	 */
	 	
	function Write_DB_Form_el ( $file ) {
	
		global $Global, $DB;

		$Obj = new Y_Engine();	
		$tmp = explode( "__", $Global['link']);
		$formType = $tmp[0];
		$tmp = explode( '.', $Global['full_link'] );
		$formType = $tmp[0];
		
		// FORCED DEF_FILE
		if( $formType == 'rep' ){
			$def_file = "engine/".$Global['lang']."/def.rep__.php";
		} else{
			$def_file = "engine/".$Global['lang']."/def.form__.php";
		}
		require( $def_file );


		// Table control
		require_once( "Y_Table.class.php" );
		$Table = new Y_Table();
		$Table->name = $this->File;
		$tmp = explode ( "__" , $Table->name ) ;
		$tmp = explode ( "." , $tmp[0] );
		$tableName= "project/" . $Global['project'] .
					'/table.' . $tmp[0] . "__.php"; 
		if ( file_exists( $tablename ) ) {
			include ( $tablename );
		}

		
		if ( $handler = fopen( $file, "w")) {
			fputs($handler,  "<?php\n" );


			// Writes a main properties
			$key = array_keys( $Obj->def_element);	
			for( $i=0; $i< count( $key); $i++ ) {
			
			

				$main = "\$Obj->". $key[$i] . " = " ;
				$main .= '"' . clearEnter($this->$key[$i]).'"'.";\n";

				fputs($handler,  $main );
			}
			
			
			
			
			//														{ #85 
	
			$keydef = array_keys( $Obj->element );	
			$key = array_keys( $this->element );
			$sortCounter = 0;
			$lastCounter = 0;
			for( $i=0; $i< count( $key ); $i++ ) {
				$element = $key[$i];
				if (($this->Get( $element, F_NAME_ ) != "__DeleteD__") &&
					($this->Get( $element, F_NAME_ ) != "")) {
					
					$indexSort = $this->Get( $element, F_ORD_ );
					$indexSort += 0;
					 
// ##### 19										
					if ( $indexSort == 0 ) { 
						$indexSort = $lastCounter + 10;
					}
					$lastCounter = $indexSort;
					$this->element[$element] [F_ORD_]=$indexSort;
					$indexSort *= 50; // #89;
					$indexSort += $sortCounter + 10000;
					$sortCounter++;
					$sort[$indexSort] = "\$Obj->Add(\n" . "    array(\n";
					
					$objName=$this->Get($element, F_NAME_ );
					if( $this->Get( $element, F_TYPE_ )=='db_filled' ){
						$this->element[$objName] [F_TYPE_]='formula';
						$this->element[$objName] [F_FORMULA_]="db('".$objName."')";

					}

					for( $x=0; $x< count( $keydef ); $x++ ) {					
						$index = $keydef[$x];
						if ( $this->Get( $element, $index ) != "" ){
							$write = true;
						} else {
							$write = false;
						}
						$el  = '"' . 
						clearEnter( $this->Get( $element, $index )) .
						'"';
						if ( $x< count( $keydef ) -1  ) {
							$el .= ",\n";
						}
						
						if( $write ){
							$sort[$indexSort] .=  "        " .$index ." => ".$el;
						}
					}
					
					// A field in a Table
					$T_Field 	= $this->Get( $element, F_NAME_ );
					$Type 	= $this->Get( $element, F_TYPE_ );
					$Length	= $this->Get( $element, F_LENGTH_ );
					$Dec	= $this->Get( $element, F_DEC_ );
					if ( $Length <1 ) {
						$Length = 60;
					}
					if ( $Type == "" ) {
						$Type = "text";
					}
					if( ( $Type == "text" ) 	||
						( $Type == "formula" )	){
						if( $Dec == "" ){
							$Type = "varchar(" . $Length . ")";
						}
						if( $Dec == '0' ){
							$Type = "INT";
						}
						if( $Dec > 0 ){
							$Type = "DOUBLE(" . $Length . "," . $Dec . ")";
						}		
					}
					if( ( $Type == "select_list" )			||
						( $Type == "dynamic_select_list" ) 	){
						$Type = "varchar(" . $Length . ")";
					}
					if ( $Type == "int" ) {
						$Type = "INT UNSIGNED";
					}
					$T_Type 	= $Type;
					
					
					$T_Null 	= $this->Get( $element, F_NULL_ );
					$T_Key 		= $this->Get( $element, F_KEY_ );
					$T_Default 	= $this->Get( $element, F_DEFAULT_ );
					$T_Extra 	= $this->Get( $element, F_EXTRA_ );
					$T_NODB 	= $this->Get( $element, F_NODB_ );
					$T_UNIQ		= $this->Get( $element, F_UNIQ_ );
					if( ( $Type == "subform" )	||
						( $Type == "report" )	||
						( $Type == "proc" )		){
						$T_NODB = '1';
					}
					if ( !empty( $T_UNIQ ) ) {
						$T_UNIQ = "UNIQUE";
					}
					
					$Table->Add( array(
									'F_NAME_'	=> $T_Field,
									'F_TYPE_'	=> $T_Type,
									'F_NULL_'	=> $T_Null,
									'F_KEY_'	=> $T_Key,
									'F_DEFAULT_'=> $T_Default,
									'F_EXTRA_'	=> $T_Extra	,
									'F_NODB_'	=> $T_NODB,	
									'F_UNIQ_'	=> $T_UNIQ	
								));
					

					
					$sort[$indexSort] .= "));\n\n" ;
					
				}
				
			} 
			
			ksort( $sort);
			
// 		
			// Writing a sorted list of fields
			$key = array_keys( $sort );
			for( $i=0; $i< count( $key ); $i++ ) {
				$element = $key[$i];
				fputs( $handler, $sort[$element]  );
			} 
		
			fputs($handler,  "?>\n" );
		
		}	
		
		//															} #85 
	
		
		else {
			echo( "error in DB_Form puts:Write_DB_Form_el($file)" );
			die();
		}

		if( $formType == 'rep' ){
			return;
		}
		
		// Writing a Table file
		if ( $handler = fopen( $tableName, "w")) {
		
			fputs($handler,  "<?php\n" );
		
			fputs($handler,  "/** " . $Global['project'] . "/table." );	
			fputs($handler,  $Table->name . "__.php   ( table_form )\n" );
			fputs($handler,  " * \n" );	
			fputs($handler,  " * @author 	ycube RAD Plus " );
			fputs($handler,  "( automatically Generated ) \n" );	
			fputs($handler,  " * \n" );	
			fputs($handler,  " */ \n\n" );	
				
			// Writes a main properties
			fputs( $handler, "\$Table->name  = " . '"' .
							$Table->name .'";' . "\n" );
			fputs( $handler, "\$Table->index = " . '"' .
							$Table->index .'";' . "\n\n" );
			
			$key = array_keys( $Table->field );	
			for( $i=0; $i< count( $key ); $i++ ) {
				$element = $key[$i];
				$name = $Table->field[$element][F_NAME_];
				if ( $name != "__DeleteD__" ) {
					fputs($handler,  "\$Table->Add(\n" );
					fputs($handler, "    array(\n"  );
					$keydef = array_keys( $Table->field[$name] );
					for( $x=0; $x< count( $keydef ); $x++ ) {					
						$index = $keydef[$x];
						$el  = '"' . $Table->field[$name][$index] .'"';
						if ( $x< count( $keydef ) -1  ) {
							$el .= ",\n";
						}
						fputs($handler, "        " . $index . " => " . $el  );
						
					}
					fputs( $handler, "));\n\n"   );
				}
				
			} 
			
			fputs($handler,  "?>\n" );
	

			// actualizeTables
			// Creating and updating a database
			$qry='CREATE TABLE IF NOT EXISTS ' . $Table->name . ' ( ' . 
			'id 		INT 	UNSIGNED AUTO_INCREMENT '. 
			'NOT NULL UNIQUE ) TYPE=INNODB;';


			$DB->Query( $qry );
			$DB->Query( "DESCRIBE " . $Table->name );
			$DB->NextRecord();
			if ( empty( $DB->Record ) ) {
				echo( "Query error in Table:Write_DB_Form_el ($Table->name)" );
				die();
			}
			$exist = array();
			$index = array();
			while ( $DB->NextRecord() ) {
				$field = $DB->Record['Field'];
				array_push( $exist, $field );
				$index[$field] = $DB->Record['Key'];
			}

			$qry = '';
			$key = array_keys( $Table->field );	
			for( $i=1; $i< count( $key ); $i++ ) {
				$field = $key[$i];
				$name=$Table->field[$key[$i]]['F_NAME_'];
				
				if ( $Table->field[$field]['F_NODB_'] == '' ) {			
				
					if( !empty( $qry ) ){
						$qry .= ", ";
					}
					// Change a field
					if ( (in_array( $name, $exist )) || ($name == "id")) {
						$qry .=	" MODIFY ".$name . " " . 
							$Table->field[$field]['F_TYPE_'] .
							" " . $Table->field[$field]['F_EXTRA_'] .
							" " . $Table->field[$field]['F_NULL_'] .
							" " . $Table->field[$field]['F_UNIQ_'];
					}
					// Create a field
					else {
						$qry .= " ADD ".$name . " " . 
							$Table->field[$field]['F_TYPE_'] . 
							" " . $Table->field[$field]['F_EXTRA_'] .
							" " . $Table->field[$field]['F_NULL_'].
							" " . $Table->field[$field]['F_UNIQ_'];
					}				
				}
			}
			if( !empty( $qry ) ){
				$qry="ALTER IGNORE TABLE " . $Table->name .
					$qry;
				$DB->Query( $qry );
			}


			// Cleaning Bad Indexes
			$DB->Query("SHOW INDEX FROM ".$Table->name );
			$delIndex = array();
			$delCount = 0;
			$delete= false;
			$lastColumn = array();
			while( $DB->NextRecord() ){
				$nIndex = $DB->Record['Key_name'];
				$column = $DB->Record['Column_name'];
				if( in_array( $column, $lastColumn ) ){

					$delIndex[$delCount]= "DROP INDEX " . $nIndex .
								" ON " . $Table->name .";";
					$delCount++;
					$delete = true;
				}
				array_push( $lastColumn, $column );
			}
			if( $delete ){
				echo $delIndex[0] ."\n";
				for( $x=0; $x < $delCount; $x++ ){
					$DB->Query( $delIndex[$x] );
				}
			}
	
// ##### 1.2.32	
		if( @unlink($tableName) ){
			// Ok! it's good
		}
		else{
			// MMMM! Sure is Windows, yet!!!
		}
	
// OLD in 1.2.32			unlink($tableName);



		}	
		else {
//			sayerror( "error in Table:Write_DB_Form_el()" );
			echo( "error in Table:Write_DB_Form_el($tableName)\n" );
			die();
		}
	
	} // Write_DB_Form_el() -----------------------------------------------

	
	
	
	
	
	
	
		
	
	/** Insert_DB		write a new object into a db form
	 * 	=================================================
	 *
	 * @param		$pass	Passed variables
	 */
	 	
	function Insert_DB ( $pass ) {
	
		global $DB, $Global;
		
		$variables= "";
		$contents = "";
		$array = explode( ",", $pass);
		$nameField = ''; 	// To determine a name if is a procedure
		for ( $i=0; $i<count($array); $i+=2){
			$name = $array[$i];
			$cont = convertChar( $array[$i+1] );		
// #151
			if( $array[$i+1]=="_INSERT_AUTONUM_"){
				
				$query = "SELECT value FROM __autonum__ WHERE name='" . $name . "';";
				$DB->query( $query );
				$autoValue = 0;
				
				$DB->NextRecord();
				
				if( !empty( $DB->Record )) {
					$autoValue = $DB->Record['value'];
				}
				$autoValue ++;
				$query = "UPDATE __autonum__ SET value='" . $autoValue .
						"' WHERE name='" . $name . "'";
				$DB->Query( $query );
				$cont = $autoValue;
			}

// # 158
			if( $name == 'name' ){
				$nameField = $cont;
			}
	
//			echo $name."=".$cont."<br>";
			if( $name != "_0_" ) {
				$element[$name] = $cont;
				if ( empty( $variables ) ) {	
					$variables = "id";
					$contents  = "null";
				}
				$variables .= ",";
				$variables .= $name;
				$contents  .= ",";
				$contents  .= '"' . $cont . '"' ;
// old in 149				$contents  .= "'" . $cont . "'" ;
			}
		}
//		$var = str_replace( "§", ",", $pass);
		$query = "INSERT INTO " . $this->File . " (" . $variables . ") " .
				"VALUES( " . $contents . " );";
		$Global['SQL_Status'] = "OK";
		$DB->Query( $query );

		audit_log ( $Global['username'], '('. $this->File . 
			') INSERT ', $Global['SQL_Status'], $contents );


		// Check if a Procedure TABLE
		if( $this->File == "p_proc" ){
			$this->prepareProcedure( $nameField );
		}



	} // Insert_DB() --------------------------------------------------------

	
	
		
	/** Change_DB		change a object into a db form
	 * 	==============================================
	 *
	 * @param		$id		Id of a record to change
	 * @param		$pass	Passed variables
	 */
	 	
	function Change_DB ( $id, $pass) {
	
		global $DB, $Global;
		$Global['SQL_Status'] = "OK";
		
		$array = explode( ",", $pass);
		$changed = explode( ",", $pass );
		$contents = "";
		for( $i=1; $i<count($changed)-1; $i+=2 ) {
			if( $i>"1" ){
				$contents .= ",'" . $changed[$i] . "'";
			}
			else{
				$contents .= "'" . $changed[$i] . "'"; 
			}
		}
		
		
// # 162		
		$nameField = ''; 	// To determine a name if is a procedure
		$query = '';
		for ( $i=0; $i<count($array); $i+=2){
			$name = $array[$i];
			if ( $name == "password" ){
				$cont = crypt ( $array[$i+1], 1 );
			}
			else {
				$cont = convertChar( $array[$i+1] );		
			}
			if( $name != "_0_" ){
				if( $query!='' ){
					$query .= ',';
				}
				$query .= $name . "=\"" . $cont . "\"";
				// # 158
				if( $name == 'name' ){
					$nameField = $cont;
				}
			}
		}
		if( $query!='' ){
			$DB->Query( "UPDATE " . $this->File . " SET " . $query . 
						" WHERE id=" . $id . ";" );
		}
// # 162


		// Check if a Procedure TABLE
		if( $this->File == "p_proc" ){
			$this->prepareProcedure( $nameField );
		}

		audit_log ( $Global['username'], '('. $this->File . 
				') CHANGE #' . $id , $Global['SQL_Status'], $contents );
	
	} // Change_DB() --------------------------------------------------------



	/** prepareProcedure	Prepare a Stored Procedure or function
	 *	====================================================================
	 *
	 */
	function prepareProcedure( $procName ) { 
		global $DB, $Global;

		$Proc = new Y_DB();
		
		// Atribute a database
		$Proc->Database = $Global['project'];
		
		$Proc->Query( 'SELECT * FROM p_proc WHERE name="'.$procName.'";');

		$Proc->NextRecord();

		$procName 		= $Proc->Record['name'];
		$procType 		= $Proc->Record['type'];
		$procParameters = $Proc->Record['parameters'];
		$procReturns 	= $Proc->Record['returns'];
		$procBody 		= $Proc->Record['body'];





		if( $procType == "PROCEDURE" ){
			$Proc->Query ( "DROP PROCEDURE IF EXISTS ".$procName .";");
			$query = "CREATE PROCEDURE ". $procName ."(" . $procParameters .")";
		}
		else{
			$Proc->Query ( "DROP FUNCTION IF EXISTS ".$procName .";");
			$query = "CREATE FUNCTION ". $procName ."(" . $procParameters .
			") RETURNS ".$procReturns." DETERMINISTIC ";
		}
		$query .= $procBody;
		$Proc->Query ( $query );
	
	} // prepareProcedure() ------------------------------------------------



	/** deleteProcedure	Delete a Stored Procedure
	 *	====================================================================
	 *
	 */
	function deleteProcedure( $procName ) { 
		global $DB, $Global;

		$Proc = new Y_DB();
		// Atribute a database
		$Proc->Database = $Global['project'];
		
		$Proc->Query ( "DROP PROCEDURE IF EXISTS ".$procName .";");
	
	} // deleteProcedure() -------------------------------------------------

	/** deleteFunction	Delete a Stored function
	 *	====================================================================
	 *
	 */
	function deleteFunction( $funcName ) { 
		global $DB, $Global;

		$Proc = new Y_DB();
		// Atribute a database
		$Proc->Database = $Global['project'];
		$Proc->Query ( "DROP FUNCTION IF EXISTS ".$funcName .";");
	
	} // deleteFunction() --------------------------------------------------

} // Y_Engine class ---------------------------------------------------------
?>