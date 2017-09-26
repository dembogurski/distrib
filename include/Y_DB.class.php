<?php

/*
  ---------------------------------------------------------
 | Y_DB.class.php    Class for Data Base abtration         |
 |---------------------------------------------------------|
 | @author   Sergio A. Pohlmann <spohlmann@softhome.net>   |
 | @date     february, 26 of 2003                          |
 |---------------------------------------------------------|
 | Instance variables:                                     |
 | -------------------                                     |
 |  $this->  |
 |                                                         |
 | Instance Methods:                                       |
 | -----------------                                       |
 | Set ( string $var, any $value )                         |
 |          Attrib a $value to a $var                      |
 | Show ( string $ident )                                  |
 |          Prints in HTML the "ident" block               |
 |                                                         |
 | Internal Methods:                                       |
 | -----------------                                       |
 | Y_Template ( $file )                                    |
 |          A constructor of the class                     |
  ---------------------------------------------------------

  ---------------------------------------------------------
 | Note:                                                   |
 |       - This class file only determine a type of DB     |
 |         used (in a $DBtype variable), to load  this     |
 |         with "include", and a specifical methods is     |
 |         in the included file.                           |
 |                                                         |
 |       - In the constructor,  is defined a conection     |
 |         data, like a host, database, user               |
 |                                                         |
  ---------------------------------------------------------


*/



include_once ( "Y_DB_MySQL.class.php" );
include_once ( "Config.class.php" );


	
/*    ATTENTION: CHANGE HERE THE CLASS EXTEND NAME
      ========================================================== ***

      Is valid:

      Y_DB_MySQL        for MySQL engine
      Y_DB_Oracle       Not implemented
      Y_DB_MSSQL        Not implemented
      Y_DB_Postgres     Not implemented
	
*/

class Y_DB extends Y_DB_MySQL {

    /**
     *  Constructor
     *  ===========
     */

    function Y_DB (){
	       /*  $this->Host     = "localhost";		// Hostname
	         $this->Database = "plus";			// Database
	         $this->GenData  = "plus_data";		// Generic Database // ##### 14
	         $this->User     = "plus";			// User
	         $this->Password = "case";			// Passwd*/
		$c = new Config();

        $this->Host     = $c->getDBHost();		// Hostname
        $this->Database = $c->getDBName();		// Database
        $this->User     = $c->getDBUser();		// User
        $this->Password = $c->getDBPassw();		// Passwd
        $this->GenData  = $c->getGenericDB;		// Generic Database // ##### 14			 
			 
	         $this->Link_ID  = 0;				// Connect Status
	         $this->ID_Query = 0; 				// Query Status
	         $this->Record   = array();			// Query Result
	         $this->Row;					    // Row number
	         $this->Status	 = "ER";			// Status of Query
	         $this->Errno    = 0;				// Error number
	         $this->Error    = "";				// Error name
// ##### 16			
			if( file_exists( "config/db_log" ) ){
				$this->MakeLog=true;
			}
			else{
				$this->MakeLog=false;
			}
// ##### 16    

    }
    // end constructor Y_DB() ................................................

}
// end Y_DB ..................................................................


?>