<?php
/**
* ----------------------------------------------------------
* | Config  Class - Gurski IDE		|
* |-----------------------------------------------------------|
* |															|
* | @authors	Doglas A. Dembogurski <dembogurski@gmail.com>	|
* | @date		Jul, 12 of 2009		     						|
* | Gurski IDE Configuration File 							|
* |															|
*  ----------------------------------------------------------

* Copyright (c) 2009 Doglas A. Dembogurski <dembogurski@gmail.com>

* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.

* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.

* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*
*/
 

class Config {

    const LOG_FILE        = "logs/logs.log";
    const SQL_LOG_FILE    = "logs/sql.log";
    const ERROR_LOG_FILE  = "logs/error.log";
    const REPOSITORY_PATH = "/var/local/repos";  // Linux MacOSx
    const REPOSITORY_PATH_WIN = "C:/repos";          // Windows
    const WORKING_COPY_PATH = "../projects";     // for SVN any OS

    // Database configuration
    const DB_HOST        = "localhost";		// Hostname
	const DB_NAME        = "distrib";		// Database
    const DB_USER        = "plus";			// User
	const DB_PASSW       = "case";
    const DB_GENERICDB   = "plus_data";
	const COMPANY        = "Comercial Ocampos";
	
    const MAIN_DOMAIN    = "http://localhost/";		// Hostname
   
    function __construct(){}

    public function getLogFile(){
        return self::LOG_FILE;
    }
    public function getSQLLogFile(){
        return self::SQL_LOG_FILE;
    }
    public function getErrorLogFile(){
        return self::ERROR_LOG_FILE;
    } 

    public function getDBHost(){
        return self::DB_HOST;
    }
    public function getDBName(){
        return self::DB_NAME;
    }
    public function getDBUser(){
        return self::DB_USER;
    }
    public function getDBPassw(){
        return self::DB_PASSW;
    }
    public function getGenericDB(){
        return self::DB_PASSW;
    }
    public function getUsersPath(){
        return self::USERS_PATH;
    }
    public function getApacheUser(){
        return self::APACHE_USER;
    }
    public function getMainDomain(){
        return self::MAIN_DOMAIN;
    }
	public function getCompany(){
        return self::COMPANY;
    }


     
}
?>
