
<?php

/** Y_Table.class.php		Class for Tables Objects
 *  ================================================
 *
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	July, 27 of 2005
 *
 */

 
class Y_Table {
 
	var $name;				// Name of table
	var $index;				// Index(es) of table
	var $field;				// Field list 
	
 	
	
	/** Constructor
	 *  ===========
	 */
 
 	function Y_Table ()	{
		$this->field = array( 
						'id'	=>	array (
										'F_NAME_'	=>  "id",
										'F_TYPE_'	=>	"INT UNSIGNED",
										'F_NULL_'	=>	"NOT NULL",
										'F_KEY_'	=> 	"PRI",
										'F_DEFAULT_'=>	"NULL",
										'F_EXTRA_'	=>	"AUTO_INCREMENT"
									)
		 				);
//	echo "table:struct:" ;
//	print_r($this);
	} // Constructor --------------------------------------------------------
 
 
	/** Add		Add a new table element
	 *  ===============================
	 *
	 * @parameter 	$field		Field to charge in a object
	 *
	 */
	function Add ( $field )	{
		
		$key = array_keys( $field );
		$this->field[ $field[ 'F_NAME_' ] ] = array();
		for ( $i=0; $i < count ($field); $i++ ) {
			$this->field[$field['F_NAME_']] [$key[$i]]=$field[$key[$i]];
		}
//print_r($this);
//die();	
	
	
						
	} // Add() --------------------------------------------------------------

	
 } // Y_Table.class ---------------------------------------------------------