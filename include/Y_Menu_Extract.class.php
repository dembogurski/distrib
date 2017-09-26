<?php

/** Y_Menu_Extract.class.php	Class to Extract and return a String of an existing menus  																	
 * 
 * @author	Doglas Antonio Dembogurski Feix <douglas@ycube.net>
 * @date	Oct, 21 of 2007  
 * 
 * 
 * 
 * Example of a new  SelectList :
 * _______________________
 * |				   \/| 	
 * |_______Headers_______|
 * |					 |
 * |mnt					 |
 * |banks				 | 	
 * |_______Menus_______  |
 * |					 |
 * |client				 |
 * |users				 |
 * |_______SubMenus______|
 * |					 |
 * |good_clients		 |
 * -----------------------	
 */


class Y_Menu_Extract {
   
   var $menu_list = "";		
   
   var $header = array(); /*Arrays to show in order*/
   var $menu	= array();
   var $submenu= array();	
   
   function Y_Menu_Extract(){
   		Global $Global;
   		
   	 	// Load a menu Object
		$Obj = new Y_Engine();
		$file = "project/" . $Global['project'] . "/data.menu__.base.php";
 	
		if(file_exists($file)){
		   include ( $file );
		} 
		
		$key = array_keys( $Obj->element );
		for( $i=0; $i< count( $key ); $i++ ) {
			if ( $Obj->element[ $key[$i] ] [ F_TYPE_ ] == "header" ) {
			   array_push( $this->header, $Obj->element[ $key[$i] ] [ F_NAME_ ]);  			       
			}
			if ( $Obj->element[ $key[$i] ] [ F_TYPE_ ] == "menu" ) {
			   array_push($this->menu, $Obj->element[ $key[$i] ] [ F_NAME_ ]);  			     
			}

// ##### 20 
// Killed to aviod show a submenus to link
/* 
			
			if ( $Obj->element[ $key[$i] ] [ F_TYPE_ ] == "submenu" ) {
			   array_push( $this->submenu, $Obj->element[ $key[$i] ] [ F_NAME_ ]);  			     
			}			
*/
// ##### 20 end
		}
		
		
   }
   
   /**
    * Return a String of a menus in a pattern  "<_______Headers_______>, <F_NAME_>, <F_NAME_>,
    * 										    <_______Menus_______">, <F_NAME_>, <F_NAME_> ";
    *
    * @return style  "_______Headers_______,mnt,div,_______Menus_______,users, clients, etc,etc  ";    
    */
   
   function getMenuList(){  	 
   	     	  
 	  $this->menu_list = $this->menu_list.", _______Headers_______";
 
	  for( $i=0; $i<count($this->header); $i++){
   	    $this->menu_list = $this->menu_list.",".$this->header[$i];
	  }  
	  
   	  $this->menu_list = $this->menu_list.", ______Menus_______";
 
	  for( $i=0; $i<count($this->menu); $i++){
   	    $this->menu_list = $this->menu_list.",".$this->menu[$i];
	  } 	  

// ##### 20 
// Killed to aviod show a submenus to link
/* 
   	  $this->menu_list = $this->menu_list.", ______SubMenus_______";
 
	  for( $i=0; $i<count($this->submenu); $i++){
   	    $this->menu_list = $this->menu_list.",".$this->submenu[$i];
	  } 	  
*/
// ##### 20 end
	   return $this->menu_list; 
   }
}

?>

