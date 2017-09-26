<?php


/** plus_doc_advanced.php		Makes a Data Dictionary
 *  ==========================================================
 *
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	January, 02 of 2007
 *
 */
 
Global $Global, $DB;




require('pdf/fpdf.php');

class PDF extends FPDF {
	//Cabecera de página
	function Header()
	{
    	$this->Image('./images/ycube_logo_1.png',10,8,20);
    	$this->SetFont('Arial','I',16);
    	$this->Cell(80);
    	$this->Cell(30,10,$this->head_1,0,1,'C');
    	$this->SetFont('Times','I',10);
    	$this->Cell(80,10,"ycube RAD plus",0,0);
    	$this->SetFont('Arial','UB',18);
    	$this->Cell(30,10,$this->head_2,0,1,'C');
   		$this->Cell(0,5,'','B',1,'C');
    	$this->Ln(20);
	}

	function Footer()
	{
   		$this->SetY(-15);
  	  	$this->SetFont('Arial','I',8);
    	$this->Cell(25,10,daytime() ,0,0,'J');
    	$this->Cell(40,10,'User: '.$this->username ,0,0,'J');
    	$this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'R');
	}
}


// Load a menu Object
$Obj = new Y_Engine();
$file = "project/" . $Global['project'] . "/data.menu__.base.php";
include ( $file );

$pdf=new PDF('P','mm','A4','Diccionario de Datos',
		$Obj->alias );
$pdf->username = $Global['username'];


//--------------------
$pdf->SetLeftMargin(10);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Ln(70);
$pdf->SetFont('Arial','B',30);
$pdf->Cell(0,10,"Proyecto: ". $Global['project'],0,1,'C');	
$pdf->Ln(30);
$pdf->SetFont('Times','BU',40);
$pdf->Cell(0,10,"DICCIONARIO DE DATOS",0,1,'C');		
$pdf->ln(5);

//----------------------


$pdf->SetLeftMargin(10);
$pdf->AliasNbPages();

$pdf->SetFillColor(200,220,255);


// Formularios
// =========================================================================
$pdf->AddPage();

/*
$pdf->SetFont('Times','UB',14);
$pdf->Cell(0,10,"3 - Llamadas a Formularios",0,1,'',1);	
$pdf->ln(15);
	
*/


// Read a directory of formularies	
$directory = "project/" . $project;
$dir = opendir ( "$directory" );
while( $filename = readdir ( $dir ) ) {
	$temp = explode( ".", $filename );
	if( $temp[0] == "db" ) {
		manualShowForm( $filename );
	}
}

$pdf->Output();










/**	printTrustee	Print a trustee groups of a object
 *	========================================================================
 *
 */

function printTrustee( $trustee ){

	Global $Global, $DB, $pdf;
	$pdf->SetFont('Times','',12);
	$tr = '';

	for ( $i=1; $i <= 30; $i++ ) {
		if ( ($trustee & ( pow( 2, $i-1 )) ) > 0 ) {
			$DB->Query( 'SELECT name FROM p_groups WHERE id='.$i );
			while( $DB->NextRecord() ) {
				if( $tr != '' ){
					$tr .=',';
				}
				$tr .= $DB->Record['name'];
			}
		}
	}	

	$pdf->Cell(0,5,'Trustee:      '.$tr, 0,1 );
	$pdf->SetFont('Times','',12);		
}// printTrustee() ---------------------------------------------------------


/**	printTrusteeField	Print a trustee groups of a object
 *	========================================================================
 *
 */

function printTrusteeField( $trustee ){

	Global $Global, $DB, $pdf;
	$tr = '';

	for ( $i=1; $i <= 30; $i++ ) {
		if ( ($trustee & ( pow( 2, $i-1 )) ) > 0 ) {
			$DB->Query( 'SELECT name FROM p_groups WHERE id='.$i );
			while( $DB->NextRecord() ) {
				if( $tr != '' ){
					$tr .=',';
				}
				$tr .= $DB->Record['name'];
			}
		}
	}	
	return( $tr );
}// printTrusteeField() ---------------------------------------------------------




/**	manualShowForm	Show a Formulary structure
 *	========================================================================
 *
 * @author Sergio A. Pohlmann <sergio@ycube.net>
 *
 * @param $link		File linked with these form
 *
 */
 
function manualShowForm( $link ) {
	global $Global, $DB, $pdf;

	// Load a Form Object
	$Obj = new Y_Engine();
	$file = "project/" . $Global['project'] . "/".$link;
	if( !file_exists( $file )){
		$file = "engine/".$Global['lang']."/".$link;
	}
	if( file_exists( $file )){
		include ( $file );
	}
	else{
		return;
	}
	
//	$pdf->AddPage();
	$pdf->SetLeftMargin(10);
	$pdf->SetFont('Times','',12);
	$pdf->Cell(30,10,'Formulario: ', 'LTB',0,'',1 );
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(0,10,$Obj->name. ' - '. $Obj->help, 'TBR',1,'',1 );
	
	$pdf->SetFont('Times','',10);
	$pdf->Cell(30,5,'Tabla: ', 'L',0,'',0 );
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(70,5,$Obj->File, 0,0,'',0 );
	if( $Obj->Noedit != '' ){
		$pdf->Cell(0,5,'Bloqueado para edición', 'R',1,'',0 );
	}
	else{
		$pdf->Cell(0,5,'Editable', 'R',1,'',0 );
	}
	$pdf->SetFont('Times','',10);
	$pdf->Cell(30,5,'Filtro: ', 'L',0,'',0 );
	if( $Obj->Filter !='' ){
		$pdf->MultiCell(0,5,$Obj->Filter, 'R',1,'',0 );
	}
	else{
		$pdf->Cell(0,5,'Ninguno', 'R',1,'',0 );
	}
	$pdf->Cell(30,5,'Ordenación: ', 'L',0,'',0 );
	if( $Obj->Sort !='' ){
		$pdf->MultiCell(0,5,$Obj->Sort, 'R',1,'',0 );
	}
	else{
		$pdf->Cell(0,5,'Orden de entrada', 'R',1,'',0 );
	}
	$pdf->Cell(30,5,'Paginación: ', 'L',0,'',0 );
	if( $Obj->Limit !='' ){
		$pdf->Cell(0,5,$Obj->Limit.
		' registros por pantalla (definido por Developer)', 'R',1,'',0 );
	}
	else{
		$pdf->Cell(0,5,'Por defecto (26 líneas por pantalla)', 'R',1,'',0 );
	}
	$pdf->Cell(30,5,'Proc. Insert: ', 'L',0,'',0 );
	if( $Obj->p_insert !='' ){
		$pdf->MultiCell(0,5,$Obj->p_insert, 'R',1,'',0 );
	}
	else{
		$pdf->Cell(0,5,'Ninguna', 'R',1,'',0 );
	}
	$pdf->Cell(30,5,'Proc. Change: ', 'L',0,'',0 );
	if( $Obj->p_change !='' ){
		$pdf->MultiCell(0,5,$Obj->p_change, 'R',1,'',0 );
	}
	else{
		$pdf->Cell(0,5,'Ninguna', 'R',1,'',0 );
	}
	$pdf->Cell(30,5,'Proc. Delete: ', 'L',0,'',0 );
	if( $Obj->p_delete !='' ){
		$pdf->MultiCell(0,5,$Obj->p_delete, 'R',1,'',0 );
	}
	else{
		$pdf->Cell(0,5,'Ninguna', 'R',1,'',0 );
	}

//	$pdf->SetLeftMargin(20);
//	$pdf->ln(10);
	

	
	// Field List
//	$pdf->SetFont('Courier','B',12);
//	$pdf->Cell(25,5,'Campos:', 0,0 );
//	$pdf->SetFont('Courier','I',10);
//	$pdf->Cell(25,5,'(campos obligatorios marcados con asterisco "*")', 0,1 );
	$key = array_keys( $Obj->element );
	$pdf->SetFont('Courier','B',8);		
	$h1='     Uniq                                                    Autonum';
	$h2='   Ord |                                                   Mult |Qry';
	$h3='Req |  | Nombre            Alias                  Tipo Tamaño | | | ';
	$h1.='                Listable               ';
	$h2.='                    | BD  Extras    Grupos ';
	$h3.='Relacion/Link       | |  D E S C P Show Chg';
	$pdf->Cell(0,5, $h1,'LTR',1);
	$pdf->Cell(0,5, $h2,'LR',1);
	$pdf->Cell(0,5, $h3,'LBR',1);
	$pdf->SetFont('Courier','',8);		

	for( $i=0; $i< count( $key ); $i++ ) {
		$var = array();		
		$element = $key[$i];
		$var['count'] = $i;
		$tag = array_keys( $Obj->element[$element] );
		for ( $cnt=0; $cnt< count($tag); $cnt++ ){
			$var[$tag[$cnt]] = $Obj->Get( $element, $tag[$cnt] );
		}
		
		if( $var['F_REQUIRED_'] != '' ){
			$required = '*';
		}
		else{
			$required = '';
		}
		$pdf->Cell(3,5, $required,'LB',0,'R');
		$pdf->Cell(8,5,$var['F_ORD_'], 'B',0,'R' );
		if( $var['F_UNIQ_']!=''){
			$pdf->Cell(4,5,'*', 'B',0,'R' );
		}
		else{
			$pdf->Cell(4,5,'','B',0,'R' );
		}
		$pdf->Cell(30,5,$var['F_NAME_'], 'B',0 );
		$pdf->Cell(40,5,$var['F_ALIAS_'], 'B',0 );
		
		if( $var['F_TYPE_']=='text' ){
			$pdf->Cell(10,5,'Text','B',0 );
		}
		if( $var['F_TYPE_']=='select_list' ){
			$pdf->Cell(10,5,'SList','B',0 );
		}
		if( $var['F_TYPE_']=='dynamic_select_list' ){
			$pdf->Cell(10,5,'DSL', 'B',0 );
		}
		if( $var['F_TYPE_']=='subform' ){
			$pdf->Cell(10,5,'Subf', 'B',0 );
		}
		if( $var['F_TYPE_']=='formula' ){
			$pdf->Cell(10,5,'Frml', 'B',0 );
		}
		if( $var['F_TYPE_']=='date' ){
			$pdf->Cell(10,5,'Date', 'B',0 );
		}
		if( $var['F_TYPE_']=='report' ){
			$pdf->Cell(10,5,'Rep', 'B',0 );
		}
		if( $var['F_TYPE_']=='proc' ){
			$pdf->Cell(10,5,'Proc', 'B',0 );
		}
		$pdf->Cell(2,5,'(', 'B',0,'R' );
		$pdf->Cell(4,5,$var['F_LENGTH_'], 'B',0,'R' );
		if( $var['F_DEC_']!='' ){
			$pdf->Cell(5,5,','.$var['F_DEC_'].')', 'B',0,'R' );
		}
		else{
			$pdf->Cell(5,5,')', 'B',0 );
		}
		
		if( $var['F_MULTI_']!='' ){
			$pdf->Cell(2,5,'+', 'B',0 );
		}
		else{
			$pdf->Cell(2,5,'', 'B',0 );
		}
		if( $var['F_AUTONUM_']!='' ){
			$pdf->Cell(3,5,'*', 'B',0 );
		}
		else{
			$pdf->Cell(3,5,'', 'B',0 );
		}
		if( $var['F_MAKE_QUERY_']!='' ){
			$pdf->Cell(5,5,'x', 'B',0 );
		}
		else{
			$pdf->Cell(5,5,'', 'B',0 );
		}
		$reltable='';
		if( $var['F_RELTABLE_']!='' ){
			$reltable = $var['F_RELTABLE_'];
		}
		else{
			if( $var['F_LINK_']!='' ){
				$reltable = $var['F_LINK_'];
			}
		}
		$pdf->Cell(32,5,$reltable, 'B',0 );
		if( $var['F_BROW_']!='' ){
			$pdf->Cell(5,5,'*', 'B',0,'R' );
		}
		else{
			$pdf->Cell(5,5,'', 'B',0,'R' );
		}
		if( $var['F_NODB_']!='' ){
			$pdf->Cell(3,5,'', 'B',0,'R' );
		}
		else{
			$pdf->Cell(3,5,'x', 'B',0,'R' );
		}
		if( $var['V_DEFAULT_']!='' ){
			$pdf->Cell(5,5,'D', 'B',0,'R' );
		}
		else{
			$pdf->Cell(5,5,'', 'B',0,'R' );
		}
		if( $var['C_SHOW_']!='' ){
			$pdf->Cell(3,5,'E', 'B',0,'R' );
		}
		else{
			$pdf->Cell(3,5,'', 'B',0,'R' );
		}
		if( $var['C_VIEW_']!='' ){
			$pdf->Cell(4,5,'S', 'B',0,'R' );
		}
		else{
			$pdf->Cell(4,5,'', 'B',0,'R' );
		}
		if( $var['C_CHANGE_']!='' ){
			$pdf->Cell(3,5,'C', 'B',0,'R' );
		}
		else{
			$pdf->Cell(3,5,'', 'B',0,'R' );
		}
		if( $var['F_POSVAL_']!='' ){
			$pdf->Cell(3,5,'P', 'B',0,'R' );
		}
		else{
			$pdf->Cell(3,5,'', 'B',0,'R' );
		}
		$pdf->Cell(8,5,$var['G_SHOW_'], 'B',0,'R' );
		$pdf->Cell(8,5,$var['G_CHANGE_'], 'BR',1,'R' );
		
		
		
//		$pdf->Cell(40,5,'+', 0,1 );

//		$pdf->SetFont('Times','',12);
//		$pdf->Cell(40,5,$var['F_HELP_'], 0,1 );
//		$varMotor['F_VALUE_'] = 
//					$this->Get( $object, $varMotor['F_NAME_'] );
	}	
	$pdf->ln(5);
//	$pdf->SetFont('Times','',12);
//	$pdf->Write(5,'Tabla en la Base de Datos: ');
	$pdf->SetFont('Times','B',12);
//	$pdf->Write(5,$Obj->File );
//	$pdf->ln(5);



/*
	$pdf->Cell(25,10,'Descripción detallada de los Campos:', 0,1 );
	$key = array_keys( $Obj->element );
	for( $i=0; $i< count( $key ); $i++ ) {
		$var = array();		
		$element = $key[$i];
		$var['count'] = $i;
		$tag = array_keys( $Obj->element[$element] );
		for ( $cnt=0; $cnt< count($tag); $cnt++ ){
			$var[$tag[$cnt]] = $Obj->Get( $element, $tag[$cnt] );
		}
		if( ( !trustee( $var['G_SHOW_'] ) ) 	||
			( $var['C_SHOW_'] == '1==0' )		){
			continue;
		}
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(5);		
		$pdf->Cell(40,5,$var['F_ALIAS_'], 0,0,'',1);
		$pdf->SetFont('Times','I',12);
		$pdf->Cell(0,5,'('.$var['F_HELP_'].')', 0,1,'',1 );
		$pdf->Cell(10);		
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(40,5,'('.$var['F_NAME_'].')', 0,1 );
		$pdf->SetFont('Times','',12);
		$pdf->Cell(10);		
		$pdf->SetFont('Times','',12);
		$pdf->Cell(40,5,'Tipo', 0,0 );
		if(	( $var['F_REQUIRED_'] != '' )	&&
			( $var['F_AUTONUM_'] == "" )	){
			$required = ' - Requerido';
		}
		else{
			$required = '';
		}
		if( $var['F_TYPE_']=='text'){
			$pdf->Cell(0,5,'text ' . $required, 0,1 );
			if( $var['F_LENGTH_'] != "" ){
				$pdf->Cell(50);		
				$pdf->Cell(0,5,'Tamaño máximo de '.$var['F_LENGTH_'].' caracteres', 0,1 );
			}
			if( $var['F_DEC_'] != "" ){
				$pdf->Cell(50);		
				$pdf->Cell(0,5,'Número de decimales: '.$var['F_DEC_'], 0,1 );
				$pdf->Cell(50);		
				$pdf->Cell(0,5,'Solo acepta números', 0,1 );
			}
			if( $var['F_QUERY_'] != "" ){
				$pdf->Cell(50);		
				$pdf->Cell(0,5,'Utiliza la Query:', 0,1 );
				$pdf->SetLeftMargin(70);
				$pdf->SetFont('Times','B',12);
				$pdf->Cell(5);		
				$pdf->Write(5, $var['F_QUERY_']);
				$pdf->ln(5);
				$pdf->SetFont('Times','',12);
				$pdf->SetLeftMargin(70);
				$pdf->Write(5, 'Dependiente de la condición:');
				$pdf->ln(5);
				$pdf->SetFont('Times','B',12);
				$pdf->Cell(5);		
				$pdf->Write(5, $var['F_QUERY_REF_']);
				$pdf->SetLeftMargin(20);
				$pdf->ln(5);
			}
			if( $var['F_AUTONUM_'] != "" ){
				$pdf->Cell(50);		
				$pdf->Cell(0,5,'Autonumerico', 0,1 );
			}
		}
		if( $var['F_TYPE_']=='date'){
			$pdf->Cell(0,5,'date ' . $required, 0,1 );
			$pdf->Cell(40);		
			$pdf->Cell(0,5,'Solo acepta números y el símbolo de guión (-)', 0,1 );
			$pdf->Cell(40);		
			$pdf->Cell(0,5,'Las fechas deben tener el formato dd-mm-aaaa', 0,1 );
		}
		if( $var['F_TYPE_']=='select_list' ){
			$pdf->Cell(0,5,'select_list ' . $required, 0,1 );
			$pdf->Cell(50);		
			$pdf->Cell(0,5,'Permite seleccionar:', 0,1 );
        	if( $var['F_OPTIONS_'] != '' ){
				$options = explode( ',', $var['F_OPTIONS_'] );
				$pdf->SetFont('Times','B',12);
				for( $n=0; $n<count($options); $n++ ){
					if( $options[$n] =="" ){
						if( $required=='' ){
							$pdf->Cell(55);		
							$pdf->Cell(0,5,'[Ningún contenido]',0,1);
						}
					}
					else{
						$pdf->Cell(55);		
						$pdf->Cell(0,5,$options[$n],0,1);
					}
				}
				$pdf->SetFont('Times','',12);
	        	if( $var['F_RELTABLE_'] != '' ){
					$pdf->Cell(50);		
					$pdf->Cell(0,5,'Además de permitir elegir: ',0,1 );
				}		
			}		
        	if( $var['F_RELTABLE_'] != '' ){
				$pdf->Cell(55);		
				$pdf->SetFont('Times','B',12);
				$pdf->Cell(0,5,'[Uno de los datos ya registrados de la tabla '.
				$var['F_RELTABLE_'].']', 0,1 );
				$pdf->SetFont('Times','',12);
			}		
        	if( $var['F_SHOWFIELD_'] != '' ){
				$pdf->Cell(50);		
				$pdf->SetFont('Times','',12);
				$pdf->Cell(0,5,'Muestra campo: '.
				$var['F_SHOWFIELD_'], 0,1 );
				$pdf->SetFont('Times','',12);
			}		
		}
		if( $var['F_TYPE_']=='dynamic_select_list'){
			$pdf->Cell(0,5,'dynamic_select_list ' . $required, 0,1 );
			$pdf->Cell(50);		
			$pdf->Cell(0,5,'Permite seleccionar:', 0,1 );
        	if( $var['F_OPTIONS_'] != '' ){
				$options = explode( ',', $var['F_OPTIONS_'] );
				$pdf->SetFont('Times','B',12);
				for( $n=0; $n<count($options); $n++ ){
					if( $options[$n] =="" ){
						if( $required=='' ){
							$pdf->Cell(55);		
							$pdf->Cell(0,5,'[Ningún contenido]',0,1);
						}
					}
					else{
						$pdf->Cell(55);		
						$pdf->Cell(0,5,$options[$n],0,1);
					}
				}
				$pdf->SetFont('Times','',12);
	        	if( $var['F_RELTABLE_'] != '' ){
					$pdf->Cell(50);		
					$pdf->Cell(0,5,'Además de permitir elegir: ',0,1 );
				}		
			}		
        	if( $var['F_RELTABLE_'] != '' ){
				$pdf->Cell(55);		
				$pdf->SetFont('Times','B',12);
				$pdf->Cell(0,5,'[Uno de los datos ya registrados de la tabla '.
				$var['F_RELTABLE_'].']', 0,1 );
				$pdf->SetFont('Times','',12);
			}		
        	if( $var['F_SHOWFIELD_'] != '' ){
				$pdf->Cell(50);		
				$pdf->SetFont('Times','',12);
				$pdf->Cell(0,5,'Muestra campo: '.
				$var['F_SHOWFIELD_'], 0,1 );
				$pdf->SetFont('Times','',12);
			}		
			$pdf->Cell(50);		
			$pdf->Cell(15,5,'Filtro:', 0,0 );
			$pdf->Cell(15,5,$var['F_FILTER_'], 0,1 );
		}
		
		if( $var['F_TYPE_']=='subform'){
			$pdf->Cell(0,5,'subform ', 0,1 );
			$pdf->Cell(50);		
			$pdf->Cell(0,5,'Llama al subformulario:', 0,1 );
			$pdf->SetLeftMargin(75);
			$pdf->SetFont('Times','B',12);
			$pdf->Write(5, $var['F_LINK_']);
			$pdf->SetLeftMargin(10);
			$pdf->ln(5);
			$pdf->Cell(60);		
			$pdf->SetFont('Times','',12);
			$pdf->Cell(0,5,'Con la condición:', 0,1 );
			$pdf->SetLeftMargin(75);
			$pdf->SetFont('Times','B',12);
			$pdf->Write(5, $var['F_OPTIONS_']);
			$pdf->SetLeftMargin(10);
			$pdf->ln(5);
			$pdf->Cell(60);		
			$pdf->SetFont('Times','',12);
			$pdf->Cell(0,5,'Enviando:', 0,1 );
			$pdf->SetLeftMargin(75);
			$pdf->SetFont('Times','B',12);
			$pdf->Write(5, $var['F_SEND_']);
			$pdf->SetLeftMargin(20);
			$pdf->ln(5);
		}
		if( $var['F_TYPE_']=='report'){
			$pdf->Cell(0,5,'Botón de Reporte ', 0,1 );
			$pdf->Cell(50);		
			$pdf->Cell(0,5,'Llama al Reporte:', 0,1 );
			$pdf->SetLeftMargin(75);
			$pdf->SetFont('Times','B',12);
			$pdf->Write(5, $var['F_REPORT_']);
			$pdf->SetLeftMargin(20);
			$pdf->ln(5);
		}
		if( $var['F_TYPE_']=='proc'){
			$pdf->Cell(0,5,'Botón de procedimiento ', 0,1 );
			$pdf->Cell(50);		
			$pdf->Cell(0,5,'Llama al Procedimiento:', 0,1 );
			$pdf->SetLeftMargin(75);
			$pdf->SetFont('Times','B',12);
			$pdf->Write(5, $var['F_QUERY_']);
			$pdf->SetLeftMargin(20);
			$pdf->ln(5);
		}
		if( $var['F_TYPE_']=='formula'){
			$pdf->Cell(0,5,'Fórmula ', 0,1 );
			$pdf->Cell(50);		
			$pdf->Cell(0,5,'Resultado de la fórmula:', 0,1 );
			$pdf->SetLeftMargin(75);
			$pdf->SetFont('Times','B',12);
			$pdf->Write(5, $var['F_FORMULA_']);
			$pdf->SetLeftMargin(20);
			$pdf->ln(5);
		}
		if( $var['F_UNIQ_']!=''){
			$pdf->Cell(50);		
			$pdf->Cell(0,5,'Campo único - No permite existencia duplicada '.
			'en la Base de Datos', 0,1 );
		}
		if( $var['F_NODB_']!=''){
			$pdf->Cell(50);		
			$pdf->SetFont('Times','',12);
			$pdf->Cell(0,5,'Campo NODB - Ignorado por la Base de Datos', 0,1 );
		}
		
//		if( !check_trustee( $var['G_CHANGE_'] ) ) {
//			$pdf->Cell(10);		
//			$pdf->Cell(20,5,'Restricción: El usuario '.$Global['username'].' no tiene permiso para '.
//			'alterar el contenido de ese campo', 0,1 );
//		}
		if( ( $var['C_VIEW_'] !="" ) 	|| 
			( $var['C_SHOW_'] !="" )	|| 
			( $var['C_CHANGE_'] !="" )	|| 
			( $var['C_DEL_'] !="" )	){
			$pdf->Cell(10);		
			$pdf->SetFont('Times','',12);
			$pdf->Cell(20,5,'Condiciones', 0,1 );
			
			if( $var['C_SHOW_'] !="" ){
				$pdf->SetFont('Times','',12);
				$pdf->Cell(15);		
				$pdf->Cell(45,5,'Existencia', 0,0 );
				$pdf->SetFont('Times','',12);
	//			$pdf->SetLeftMargin(50);
				$pdf->SetFont('Times','B',12);
				$pdf->Write(5, $var['C_SHOW_']);
	//			$pdf->SetLeftMargin(10);
				$pdf->ln(5);
			}
			if( $var['C_VIEW_'] !="" ){
				$pdf->SetFont('Times','',12);
				$pdf->Cell(15);		
				$pdf->Cell(45,5,'Visibilidad', 0,0 );
				$pdf->SetFont('Times','',12);
	//			$pdf->SetLeftMargin(50);
				$pdf->SetFont('Times','B',12);
				$pdf->Write(5, $var['C_VIEW_']);
	//	//		$pdf->SetLeftMargin(10);
				$pdf->ln(5);
			}
			if( $var['C_CHANGE_'] !="" ){
				$pdf->SetFont('Times','',12);
				$pdf->Cell(15);		
				$pdf->Cell(45,5,'Cambios', 0,0 );
				$pdf->SetFont('Times','',12);
//				$pdf->SetLeftMargin(50);
				$pdf->SetFont('Times','B',12);
				$pdf->Write(5, $var['C_CHANGE_']);
//				$pdf->SetLeftMargin(10);
				$pdf->ln(5);
			}
			if( $var['C_DEL_'] !="" ){
				$pdf->SetFont('Times','',12);
				$pdf->Cell(15);		
				$pdf->Cell(45,5,'Existencia', 0,0 );
				$pdf->SetFont('Times','',12);
//				$pdf->SetLeftMargin(50);
				$pdf->SetFont('Times','B',12);
				$pdf->Write(5, $var['C_DEL_']);
//				$pdf->SetLeftMargin(10);
				$pdf->ln(5);
			}

			$pdf->SetFont('Times','',12);

		}
		$pdf->Cell(10);		
		$pdf->SetFont('Times','',12);
		$pdf->Cell(20,5,'Trustees', 0,1 );
		
		$pdf->SetFont('Times','',12);
		$pdf->Cell(15);		
		$pdf->Cell(35,5,'Visualización', 0,0 );
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(0,5, printTrusteeField($var['G_SHOW_']),0,1);
		
		$pdf->SetFont('Times','',12);
		$pdf->Cell(15);		
		$pdf->Cell(35,5,'Cambios', 0,0 );
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(0,5, printTrusteeField($var['G_CHANGE_']),0,1);
			
		$pdf->ln(5);

	}	
	
*/	
	$pdf->ln(5);


	
	
	
} // manualShowForm() ------------------------------------------------------

?>