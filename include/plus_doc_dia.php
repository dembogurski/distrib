<?php


/** plus_doc_dia.php		Makes a DIA Compatible file 
 *  ======================================================
 *
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	October, 31 of 2005
 *
 */
 
//Global $Global, $DB, $T;

$project = $HTTP_GET_VARS[project];

// Load a Engine class
include_once ( "../include/Y_Engine.class.php" );

$file = "../project/" . $project . "/diagram.dia";
if ( $handler = fopen( $file, "w")) {


	dia_Start();
	dia_Grid();

	$leftPos = 1;					// Left Position of object
	$topPos  = 1;					// Top Position
	$nConn=0;						// Number of connections
	$lineNumber=0;
	// Read a formularies	
	$directory = "../project/" . $project;
	$dir = opendir ( "$directory" );
	while( $filename = readdir ( $dir ) ) {
		$temp = explode( ".", $filename );
		if( $temp[0] == "db" ) {
			$Obj = "";
			$Obj = new Y_Engine();		// Creating a new object
			include ( "../project/" . $project . "/" . $filename );

			$table = $Obj->name;
			
			dia_Class( $table );
				
			$position = 2;			// Source position of lines
			
			$tsCount = 0;			// Numbers of selection list Single tables
			$tsName = array();
			$tsList = array();
			$key = array_keys( $Obj->element );
			for ( $i=0; $i< count( $key ); $i++ ) {
				$element = $key[$i];
				$field = $Obj->Get( $element, F_NAME_ ) ;
				$type  = $Obj->Get( $element, F_TYPE_ ) ;
				$length  = $Obj->Get( $element, F_LENGTH_ ) ;
				$reltable= $Obj->Get( $element, F_RELTABLE_ ) ;
				$options = $Obj->Get( $element, F_OPTIONS_ ) ;
				$query   = $Obj->Get( $element, F_QUERY_ ) ;
				$temp	 = explode(".",$Obj->Get( $element, F_LINK_ )) ;
				$link 	 = $temp[1];
				
				// Relations
				if( ($type == 'select_list' ) 	||
					($type == 'dynamic_select_list' )){
					if( !empty( $options ) ) {
						$list = $options;
						$selectlist = "{".$table ."+". $field."}";
						$tsCount++;
						$tsName[$tsCount] = $selectlist;
						$tsList[$tsCount] = $list;
						//dia_SelectList( $selectlist, $list );
						$nConn++;
						$position++;
						$line[$nConn]['source'] = $table;
						$line[$nConn]['sourcepos']= $i*2+9; // $position
						$line[$nConn]['dest']   = $selectlist;
						$line[$nConn]['start']	= 20;
						$line[$nConn]['end']	= 2;
					}
					if( !empty( $reltable ) ) {
						$nConn++;
						$position++;
						$line[$nConn]['start']	= 20;
						$line[$nConn]['end']	= 2;
						if( !empty( $options ) ) {
							$line[$nConn]['source'] = $selectlist;
							$line[$nConn]['sourcepos']= 4;
							$line[$nConn]['start']	= 2;
						}
						else{
							$line[$nConn]['source'] = $table;
							$line[$nConn]['sourcepos']= $i*2+8; //$position;
						}
						$line[$nConn]['dest']   = $reltable;
					}
				}
				if( $type == 'subform' ){
					$nConn++;
					$position++;
					$line[$nConn]['source'] = $table;
					$line[$nConn]['sourcepos']= $i*2+9; // $position
					$line[$nConn]['dest']   = $link;
					$line[$nConn]['start']	= 13;
					$line[$nConn]['end']	= 20;
				}
				if( !empty( $query ) ) {
					$type .= " (SQL)";
				}
				dia_Field( $field, $type, $length );
			}	
		
			
			dia_EndClass();
			
			for( $i=1; $i<=$tsCount; $i++ ) {
				dia_Class( $tsName[$i] );
				$list = explode( ",", $tsList[$i] );
				for( $b=0; $b<count($list); $b++ ) {
					dia_Field( $list[$b], "", "" );
				}
				dia_EndClass();
			}
			
						
		
		}

	}


	for( $i=1; $i<= $nConn; $i++ ) {
		dia_ConnectionLine( $line[$i] );
	}
	
	
	dia_End();

	
	echo "<html><script>\n";
	echo '	window.location.href="' . $file .  '"' . "\n";
	echo "</script></html>\n";

}
else{
	echo ( 'ERROR' );
	die();
}


function dia_Start() {
	global $handler;
	// Start diagram
	fputs($handler, '<?xml version="1.0" encoding="ISO-8859-1"?> ' . "\n" );
/*	fputs($handler, '<?xml version="1.0" encoding="UTF-8"?> ' . "\n" );
*/
	fputs($handler, '<dia:diagram xmlns:dia="http://www.lysator.liu.se/~alla/dia/"> ' . "\n" );
	fputs($handler, '  <dia:diagramdata> ' . "\n" );
	fputs($handler, '    <dia:attribute name="background"> ' . "\n" );
	fputs($handler, '      <dia:color val="#ffffff"/> ' . "\n" );
	fputs($handler, '    </dia:attribute> ' . "\n" );
	fputs($handler, '    <dia:attribute name="pagebreak"> ' . "\n" );
	fputs($handler, '      <dia:color val="#000099"/> ' . "\n" );
	fputs($handler, '    </dia:attribute> ' . "\n" );
	fputs($handler, '    <dia:attribute name="paper"> ' . "\n" );
	fputs($handler, '      <dia:composite type="paper"> ' . "\n" );
	fputs($handler, '        <dia:attribute name="name"> ' . "\n" );
	fputs($handler, '          <dia:string>#A4#</dia:string> ' . "\n" );
	fputs($handler, '        </dia:attribute> ' . "\n" );
	fputs($handler, '        <dia:attribute name="tmargin"> ' . "\n" );
	fputs($handler, '          <dia:real val="2.8222"/> ' . "\n" );
	fputs($handler, '        </dia:attribute> ' . "\n" );
	fputs($handler, '        <dia:attribute name="bmargin"> ' . "\n" );
	fputs($handler, '          <dia:real val="2.8222"/> ' . "\n" );
	fputs($handler, '        </dia:attribute> ' . "\n" );
	fputs($handler, '        <dia:attribute name="lmargin"> ' . "\n" );
	fputs($handler, '          <dia:real val="2.8222"/> ' . "\n" );
	fputs($handler, '        </dia:attribute> ' . "\n" );
	fputs($handler, '        <dia:attribute name="rmargin"> ' . "\n" );
	fputs($handler, '          <dia:real val="2.8222"/> ' . "\n" );
	fputs($handler, '        </dia:attribute> ' . "\n" );
	fputs($handler, '        <dia:attribute name="is_portrait"> ' . "\n" );
	fputs($handler, '          <dia:boolean val="true"/> ' . "\n" );
	fputs($handler, '        </dia:attribute> ' . "\n" );
	fputs($handler, '        <dia:attribute name="scaling"> ' . "\n" );
	fputs($handler, '          <dia:real val="1"/> ' . "\n" );
	fputs($handler, '        </dia:attribute> ' . "\n" );
	fputs($handler, '        <dia:attribute name="fitto"> ' . "\n" );
	fputs($handler, '          <dia:boolean val="false"/> ' . "\n" );
	fputs($handler, '        </dia:attribute> ' . "\n" );
	fputs($handler, '      </dia:composite> ' . "\n" );
	fputs($handler, '    </dia:attribute> ' . "\n" );
} // dia_Start() -----------------------------------------------------------

function dia_Grid() {
	global $handler;
	// Grid
	fputs($handler, '    <dia:attribute name="grid"> ' . "\n" );
	fputs($handler, '      <dia:composite type="grid"> ' . "\n" );
	fputs($handler, '        <dia:attribute name="width_x"> ' . "\n" );
	fputs($handler, '          <dia:real val="1"/> ' . "\n" );
	fputs($handler, '        </dia:attribute> ' . "\n" );
	fputs($handler, '        <dia:attribute name="width_y"> ' . "\n" );
	fputs($handler, '          <dia:real val="1"/> ' . "\n" );
	fputs($handler, '        </dia:attribute> ' . "\n" );
	fputs($handler, '        <dia:attribute name="visible_x"> ' . "\n" );
	fputs($handler, '          <dia:int val="1"/> ' . "\n" );
	fputs($handler, '        </dia:attribute> ' . "\n" );
	fputs($handler, '        <dia:attribute name="visible_y"> ' . "\n" );
	fputs($handler, '          <dia:int val="1"/> ' . "\n" );
	fputs($handler, '        </dia:attribute> ' . "\n" );
	fputs($handler, '        <dia:composite type="color"/> ' . "\n" );
	fputs($handler, '      </dia:composite> ' . "\n" );
	fputs($handler, '    </dia:attribute> ' . "\n" );
	
	// Color and guides
	fputs($handler, '    <dia:attribute name="color"> ' . "\n" );
	fputs($handler, '      <dia:color val="#d8e5e5"/> ' . "\n" );
	fputs($handler, '    </dia:attribute> ' . "\n" );
	fputs($handler, '    <dia:attribute name="guides"> ' . "\n" );
	fputs($handler, '      <dia:composite type="guides"> ' . "\n" );
	fputs($handler, '        <dia:attribute name="hguides"/> ' . "\n" );
	fputs($handler, '        <dia:attribute name="vguides"/> ' . "\n" );
	fputs($handler, '      </dia:composite> ' . "\n" );
	fputs($handler, '    </dia:attribute> ' . "\n" );
	fputs($handler, '  </dia:diagramdata> ' . "\n" );
	
	fputs($handler, '  <dia:layer name="Fondo" visible="true"> ' . "\n" );

} //dia_Grid() ---------------------------------------------------------------


function dia_Class( $name ) {
	global $handler, $leftPos, $topPos;
	$leftPos++;
	$topPos++;
	
	// CLASS
	fputs($handler, '    <dia:object type="UML - Class" version="0" id="' .
		$name . '"> ' . "\n" );
	fputs($handler, '      <dia:attribute name="obj_pos"> ' . "\n" );
	fputs($handler, '        <dia:point val="' . $topPos .',' . $leftPos .
		'"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="obj_bb"> ' . "\n" );
	fputs($handler, '        <dia:rectangle val="' . $topPos .',' . $leftPos .
		';13.45,5.9"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="elem_corner"> ' . "\n" );
	fputs($handler, '        <dia:point val="' . $topPos .',' . $leftPos .
		'"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="elem_width"> ' . "\n" );
	fputs($handler, '        <dia:real val="11.45"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="elem_height"> ' . "\n" );
	fputs($handler, '        <dia:real val="3.6"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	
	fputs($handler, '      <dia:attribute name="name"> ' . "\n" );
	fputs($handler, '        <dia:string>#' . $name . '#</dia:string> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="stereotype"> ' . "\n" );
	fputs($handler, '        <dia:string>##</dia:string> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="comment"> ' . "\n" );
	fputs($handler, '        <dia:string>##</dia:string> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="abstract"> ' . "\n" );
	fputs($handler, '        <dia:boolean val="false"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="suppress_attributes"> ' . "\n" );
	fputs($handler, '        <dia:boolean val="false"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="suppress_operations"> ' . "\n" );
	fputs($handler, '        <dia:boolean val="false"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="visible_attributes"> ' . "\n" );
	fputs($handler, '        <dia:boolean val="true"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="visible_operations"> ' . "\n" );
	fputs($handler, '        <dia:boolean val="false"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="visible_comments"> ' . "\n" );
	fputs($handler, '        <dia:boolean val="false"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="foreground_color"> ' . "\n" );
	fputs($handler, '        <dia:color val="#000000"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="background_color"> ' . "\n" );
	fputs($handler, '        <dia:color val="#ffffff"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="normal_font"> ' . "\n" );
	fputs($handler, '        <dia:font family="monospace" style="0" name="Courier"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="abstract_font"> ' . "\n" );
	fputs($handler, '        <dia:font family="monospace" style="88" name="Courier"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="polymorphic_font"> ' . "\n" );
	fputs($handler, '        <dia:font family="monospace" style="8" name="Courier"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="classname_font"> ' . "\n" );
	fputs($handler, '        <dia:font family="sans" style="80" name="Helvetica"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="abstract_classname_font"> ' . "\n" );
	fputs($handler, '        <dia:font family="sans" style="88" name="Helvetica"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="comment_font"> ' . "\n" );
	fputs($handler, '        <dia:font family="sans" style="8" name="Helvetica"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="font_height"> ' . "\n" );
	fputs($handler, '        <dia:real val="0.8"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="polymorphic_font_height"> ' . "\n" );
	fputs($handler, '        <dia:real val="0.8"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="abstract_font_height"> ' . "\n" );
	fputs($handler, '        <dia:real val="0.8"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="classname_font_height"> ' . "\n" );
	fputs($handler, '        <dia:real val="1"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="abstract_classname_font_height"> ' . "\n" );
	fputs($handler, '        <dia:real val="1"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="comment_font_height"> ' . "\n" );
	fputs($handler, '        <dia:real val="1"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	
	// ATTRIBUTES OF CLASS
	fputs($handler, '      <dia:attribute name="attributes"> ' . "\n" );

} // dia_Class() -----------------------------------------------------------


function dia_Field( $name, $type, $length ) {
	global $handler;
	// LIST OF ATTRIBUTES
	fputs($handler, '        <dia:composite type="umlattribute"> ' . "\n" );
	fputs($handler, '          <dia:attribute name="name"> ' . 
					'<dia:string>#' . $name . '#</dia:string> ' .
					'</dia:attribute> ' . "\n" );
	fputs($handler, '          <dia:attribute name="type"> ' .
					'<dia:string>#' . $type . '#</dia:string> ' .
					'</dia:attribute> ' . "\n" );
	fputs($handler, '          <dia:attribute name="value"> ' .
					'<dia:string>#' . $length . '#</dia:string> ' .
					'</dia:attribute> ' . "\n" );
	fputs($handler, '          <dia:attribute name="comment"> ' .
					'<dia:string>##</dia:string> ' .
					'</dia:attribute> ' . "\n" );
	fputs($handler, '          <dia:attribute name="visibility"> ' .
					'<dia:enum val="3"/> ' .
					'</dia:attribute> ' . "\n" );
	fputs($handler, '        </dia:composite> ' . "\n" );

} // dia_Field() -----------------------------------------------------------


function dia_EndClass() {
	
	global $handler;
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '    </dia:object> ' . "\n" );
} // dia_End_Class() -------------------------------------------------------

function dia_EndSubform() {
	
	global $handler;
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="operations"/> ' . "\n" );
	fputs($handler, '      <dia:attribute name="template"> ' . "\n" );
	fputs($handler, '        <dia:boolean val="false"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '    </dia:object> ' . "\n" );
} // dia_End_Class() -------------------------------------------------------


function dia_ConnectionLine( $line ) {

	global $handler, $lineNumber;
	$lineNumber++;
	$source = $line['source'];
	$dest	= $line['dest'];
	$sourcepos = $line['sourcepos'];
	$startLine = $line['start'];
	$endLine   = $line['end'];
	
	if( $startLine == 0 ) {
		$startLine = 13;
	}
	
	if( $endLine ==  0 ) {
		$endLine==13;
	}
	
	
	// CONNECTION LINE
	fputs($handler, '    <dia:object type="Standard - ZigZagLine" version="0" id="'.
	$lineNumber . '"> ' . "\n" );
	fputs($handler, '      <dia:attribute name="obj_pos"> ' . "\n" );
	fputs($handler, '        <dia:point val="7.675,5.85"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="obj_bb"> ' . "\n" );
	fputs($handler, '        <dia:rectangle val="6.875,5.8;11.25,17.6"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="orth_points"> ' . "\n" );
	fputs($handler, '        <dia:point val="7.675,5.85"/> ' . "\n" );
	fputs($handler, '        <dia:point val="7.675,11.7"/> ' . "\n" );
	fputs($handler, '        <dia:point val="10.45,11.7"/> ' . "\n" );
	fputs($handler, '        <dia:point val="10.45,17.55"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="orth_orient"> ' . "\n" );
	fputs($handler, '        <dia:enum val="1"/> ' . "\n" );
	fputs($handler, '        <dia:enum val="0"/> ' . "\n" );
	fputs($handler, '        <dia:enum val="1"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="start_arrow"> ' . "\n" );
	fputs($handler, '        <dia:enum val="'.$startLine.'"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="start_arrow_length"> ' . "\n" );
	fputs($handler, '        <dia:real val="0.8"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="start_arrow_width"> ' . "\n" );
	fputs($handler, '        <dia:real val="0.8"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="end_arrow"> ' . "\n" );
	fputs($handler, '        <dia:enum val="'.$endLine.'"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="end_arrow_length"> ' . "\n" );
	fputs($handler, '        <dia:real val="0.8"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:attribute name="end_arrow_width"> ' . "\n" );
	fputs($handler, '        <dia:real val="0.8"/> ' . "\n" );
	fputs($handler, '      </dia:attribute> ' . "\n" );
	fputs($handler, '      <dia:connections> ' . "\n" );
	fputs($handler, '        <dia:connection handle="0" to="'.$source.
		'" connection="'. $sourcepos .'"/> ' . "\n" );
	fputs($handler, '        <dia:connection handle="1" to="'.$dest.
		'" connection="1"/> ' . "\n" );
	fputs($handler, '      </dia:connections> ' . "\n" );
	fputs($handler, '    </dia:object> ' . "\n" );
		
} // dia_ConecctionLine() --------------------------------------------------


function dia_End() {
	global $handler;
	
	fputs($handler, '  </dia:layer> ' . "\n" );
	fputs($handler, '</dia:diagram> ' . "\n" );
} // dia_End() -------------------------------------------------------------

?> 