<?php


/** plus_doc_advanced.php		Makes a advanced documentation
 *  ==========================================================
 *
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	August, 20 of 2005
 *
 */
 
Global $Global, $DB;




require('pdf/fpdf.php');

ob_end_clean();    header("Content-Encoding: None", true);

class PDF extends FPDF {
	//Cabecera de p‡gina
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

$pdf=new PDF('P','mm','A4','Documentación Oficial - Detallada',
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
$pdf->Cell(0,10,"DOCUMENTACIÓN OFICIAL",0,1,'C');		
$pdf->ln(5);

//----------------------


$pdf->SetLeftMargin(10);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(200,220,255);
//
//$pdf->SetFont('Times','B',16);
//$pdf->Cell(0,10,"Documentación Oficial - Proyecto " . $Global['project'],0,1);	
//$pdf->ln(5);
//

// Introduccion
// =========================================================================
$pdf->SetFont('Times','UB',14);
$pdf->Cell(0,10,"1 - Introducción",0,1,'',1);	
$pdf->ln(5);

$pdf->SetFont('Times','',12);
$pdf->Cell(10);
$pdf->Write(5,'Documentación referente al sistema ');	
$pdf->SetFont('Times','B',12);
$pdf->Write(5,$Global['project']);	

$pdf->Ln(20);
$pdf->SetFont('Times','',12);
$pdf->Cell(10);
$pdf->Write(5,'Está dividido en las secciones:');	
$pdf->ln(15);
$pdf->SetFont('Times','B',12);
$pdf->Cell(10);
$pdf->Cell(60,15,"1 - Introducción",0,0);	
$pdf->SetFont('Times','',12);
$pdf->Cell(0,15,"La presente sección.",0,1);
$pdf->SetFont('Times','B',12);
$pdf->Cell(10);
$pdf->Cell(60,15,"2 - Menus",0,0);	
$pdf->SetFont('Times','',12);
$pdf->Cell(0,15,"Descripción de todos los menus del sistema.",0,1);
$pdf->SetFont('Times','B',12);
$pdf->Cell(10);
$pdf->Cell(60,5,"3 - Llamadas a Formularios",0,0);	
$pdf->SetFont('Times','',12);
$pdf->SetLeftMargin(80);
$pdf->Write(5,"Todas las llamadas a los formularios del sistema, con los ".
				"respectivos campos, su significado,".
				" forma de rellenar los datos solicitados etc. Observe que el sistema de reportes está " .
				"incluido en el mismo sistema de formularios, de forma que esa misma sección ".
				"también aportará datos a cerca de reportes específicos accedidos desde un campo.".
				"Lo mismo pasa en relación a los procedimientos disparados por botones de ".
				"procedimientos.");
$pdf->SetLeftMargin(10);
$pdf->ln(15);
$pdf->SetFont('Times','B',12);
$pdf->Cell(10);
$pdf->Cell(60,5,"4 - Procedimientos almacenados",0,0);	
$pdf->SetFont('Times','',12);
$pdf->SetLeftMargin(80);
$pdf->Write(5,"Relación descriptiva de los procedimientos almacenados del sistema. ".
			"Los procedimientos almacenados son exclusivos a la Base de Datos utilizada ".
			"en el proyecto pero, con conocimientos de SQL, se los puede fácilmente ".
			"portar para otras Bases de Datos." );
$pdf->SetLeftMargin(10);
$pdf->ln(15);
$pdf->SetFont('Times','B',12);
$pdf->Cell(10);
$pdf->Cell(60,5,"5 - Observaciones",0,0);	
$pdf->SetFont('Times','',12);
$pdf->Cell(0,5,"Observaciones en cuánto a la validez de los datos de ese manual.",0,1);

// Menus
// =========================================================================
$pdf->AddPage();
$pdf->SetFont('Times','UB',14);
$pdf->Cell(0,10,"2 - Menus",0,1,'',1);	
$pdf->ln(5);

$file = "engine/".$Global['lang']."/data.devmenu__.php";
include ( $file );
$header = array();
$menu	= array();
$submenu= array();

	
$key = array_keys( $Obj->element );
for( $i=0; $i< count( $key ); $i++ ) {
	if ( $Obj->element[ $key[$i] ] [ F_TYPE_ ] == "header" ) {
		array_push( $header, 
			array( 
				'name' 	=>  $Obj->element[ $key[$i] ] [ F_NAME_ ],
				'alias' =>  $Obj->element[ $key[$i] ] [ F_ALIAS_ ],
				'help' 	=>  $Obj->element[ $key[$i] ] [ F_HELP_ ],
				'doc' 	=>  $Obj->element[ $key[$i] ] [ F_DOC_ ],
				'table' =>  $Obj->element[ $key[$i] ] [ R_TABLE_ ],
				'link' 	=>  $Obj->element[ $key[$i] ] [ F_LINK_ ],
				'oper' 	=>  $Obj->element[ $key[$i] ] [ F_OPER_ ],
				'nodoc'	=>  $Obj->element[ $key[$i] ] [ F_NODOC_ ],
				'show' 	=>  $Obj->element[ $key[$i] ] [ G_SHOW_ ]
			));	
	}
	if ( $Obj->element[ $key[$i] ] [ F_TYPE_ ] == "menu" ) {
		array_push( $menu, 
			array( 
				'name' 	=>  $Obj->element[ $key[$i] ] [ F_NAME_ ],
				'alias' =>  $Obj->element[ $key[$i] ] [ F_ALIAS_ ],
				'help' 	=>  $Obj->element[ $key[$i] ] [ F_HELP_ ],
				'doc' 	=>  $Obj->element[ $key[$i] ] [ F_DOC_ ],
				'table' =>  $Obj->element[ $key[$i] ] [ R_TABLE_ ],
				'oper' 	=>  $Obj->element[ $key[$i] ] [ F_OPER_ ],
				'link' 	=>  $Obj->element[ $key[$i] ] [ F_LINK_ ],
				'nodoc'	=>  $Obj->element[ $key[$i] ] [ F_NODOC_ ],
				'show' 	=>  $Obj->element[ $key[$i] ] [ G_SHOW_ ]
			));	
	}
	if ( $Obj->element[ $key[$i] ] [ F_TYPE_ ] == "submenu" ) {
		array_push( $submenu, 
			array( 
				'name' 	=>  $Obj->element[ $key[$i] ] [ F_NAME_ ],
				'alias' =>  $Obj->element[ $key[$i] ] [ F_ALIAS_ ],
				'help' 	=>  $Obj->element[ $key[$i] ] [ F_HELP_ ],
				'doc' 	=>  $Obj->element[ $key[$i] ] [ F_DOC_ ],
				'table' =>  $Obj->element[ $key[$i] ] [ R_TABLE_ ],
				'oper' 	=>  $Obj->element[ $key[$i] ] [ F_OPER_ ],
				'link' 	=>  $Obj->element[ $key[$i] ] [ F_LINK_ ],
				'nodoc'	=>  $Obj->element[ $key[$i] ] [ F_NODOC_ ],
				'show' 	=>  $Obj->element[ $key[$i] ] [ G_SHOW_ ]
			));	
	}
}
		
// Print a menu struct

$pdf->SetFont('Times','',12);
$pdf->Cell(10);
$pdf->Write(5,'Estructura de los menus:');	
$pdf->ln(5);

$key_header = array_keys( $header );
for( $i=0; $i<count($header) ; $i++){
	$header_alias 	= $header[$key_header[$i]]['alias'];
	$header_name  	= $header[$key_header[$i]]['name'];
	$header_help  	= $header[$key_header[$i]]['help'];
	$trustee		= $header[$key_header[$i]]['show'];
	$nodoc			= $header[$key_header[$i]]['nodoc'];
	$oper			= $header[$key_header[$i]]['oper'];
	$link			= $header[$key_header[$i]]['link'];
	if( (check_trustee($trustee))	&&
		($nodoc=='')				){
		$pdf->ln(5);
		$pdf->Cell(10);
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(60,5,$header_alias, 0,0 );
		$pdf->Cell(0,5,$header_help, 0,1 );
		$pdf->SetFont('Times','',12);
		if( $oper != '' ){
			$pdf->Cell(70);
			$pdf->SetFont('Times','',12);
			$pdf->Cell(0,5,'Operación: '.$oper, 0,1 );
			$pdf->SetFont('Times','',12);		
		}
		if( $link != '' ){
			$pdf->Cell(70);
			$pdf->SetFont('Times','',12);
			$pdf->Cell(0,5,'Link:          '.$link, 0,1 );
			$pdf->SetFont('Times','',12);		
		}
		$pdf->Cell(70);
		printTrustee($trustee);
		$pdf->ln(5);
	}

	$key_menu = array_keys($menu);
	for( $count_menu=0; $count_menu<count($menu);$count_menu++){
		$menu_alias = $menu[$key_menu[$count_menu]]['alias'];
		$menu_name  = $menu[$key_menu[$count_menu]]['name'];
		$menu_help  = $menu[$key_menu[$count_menu]]['help'];
		$trustee	= $menu[$key_menu[$count_menu]]['show'];
		$nodoc		= $menu[$key_menu[$count_menu]]['nodoc'];
		$oper		= $menu[$key_menu[$count_menu]]['oper'];
		$link		= $menu[$key_menu[$count_menu]]['link'];

		if( ($menu[$key_menu[$count_menu]]['table'] == $header_name)	&&
			(check_trustee( $trustee )) 								&&
			($nodoc=='')												){

			$pdf->Cell(20);
			$pdf->Cell(60,5,$menu_alias, 0,0 );
			$pdf->Cell(0,5,$menu_help, 0,1 );
			if( $oper != '' ){
				$pdf->Cell(80);
				$pdf->SetFont('Times','',12);
				$pdf->Cell(0,5,'Operación: '.$oper, 0,1 );
				$pdf->SetFont('Times','',12);		
			}
			if( $link != '' ){
				$pdf->Cell(80);
				$pdf->SetFont('Times','',12);
				$pdf->Cell(0,5,'Link:          '.$link, 0,1 );
				$pdf->SetFont('Times','',12);		
			}
			$pdf->Cell(80);
			printTrustee($trustee);
			$pdf->ln(5);
			$key_submenu = array_keys($submenu);
			for( $count_submenu=0; $count_submenu<count($submenu);
				$count_submenu++){
				$submenu_alias	= $submenu[$key_submenu[$count_submenu]]['alias'];
				$submenu_name	= $submenu[$key_submenu[$count_submenu]]['name'];
				$submenu_help	= $submenu[$key_submenu[$count_submenu]]['help'];
				$trustee		= $submenu[$key_submenu[$count_submenu]]['show'];
				$nodoc			= $submenu[$key_submenu[$count_submenu]]['nodoc'];
				$link			= $submenu[$key_submenu[$count_submenu]]['link'];
				if( ( $submenu[$key_submenu[$count_submenu]]['table'] == $menu_name )	&&
					(check_trustee( $trustee ))											&&
					($nodoc=='')														){
					$pdf->Cell(30);
					$pdf->Cell(60,5,$submenu_alias, 0,0 );
					$pdf->Cell(0,5,$submenu_help, 0,1 );
					if( $oper != '' ){
						$pdf->Cell(90);
						$pdf->SetFont('Times','',12);
						$pdf->Cell(0,5,'Operación: '.$oper, 0,1 );
						$pdf->SetFont('Times','',12);		
					}
					if( $link != '' ){
						$pdf->Cell(90);
						$pdf->SetFont('Times','',12);
						$pdf->Cell(0,5,'Link:          '.$link, 0,1 );
						$pdf->SetFont('Times','',12);		
					}
					$pdf->Cell(90);
					printTrustee($trustee);
					$pdf->ln(5);
				}	
			}
		}	
	}
}		


// Formularios
// =========================================================================
$pdf->AddPage();
$pdf->SetFont('Times','UB',14);
$pdf->Cell(0,10,"3 - Llamadas a Formularios",0,1,'',1);	
$pdf->ln(15);
$pdf->SetFont('Times','',12);
$pdf->SetLeftMargin(15);
$pdf->Write(15,'Descripción detallada de cada una de las '.
				'llamadas a los formularios del sistema, así como las '.
				'llamadas a rutinas especiales (si hubieren).');	
$pdf->Write(15,'Para cada formulario, habrá (entre paréntesis) la '.
				'descripción de como se puede acceder al mismo, seguido de '.
				'la descripción del formulario en sí, con sus campos.');
$pdf->ln(15);
$pdf->Write(15, 'Dando secuencia, una descripción de cada uno de los campos, '.
				'sus exigencias de rellenado, fuentes de datos, etc. '.
				'Los campos condicionales siempre estarán '.
				'con una observación que resaltará su situación y la condición .'.
				'para su existéncia o visibilidad.'  );	
$pdf->ln(15);
$pdf->Write(15, 'Además, como el control de acceso del sistema es '.
				'controlado a nivel del usuario, y de sus derechos de acceso, '.
				'todos los campos trarám el grupo que lle puede acceder, y '.
				'el grupo que lle puede efectuar modificaciones. ');	
$pdf->ln(15);
		
// Print a Formularys Structure
$key_header = array_keys( $header );
for( $i=0; $i<count($header) ; $i++){
	$header_alias 	= $header[$key_header[$i]]['alias'];
	$header_name  	= $header[$key_header[$i]]['name'];
	$header_help  	= $header[$key_header[$i]]['help'];
	$header_link  	= $header[$key_header[$i]]['link'];
	$trustee		= $header[$key_header[$i]]['show'];
	$nodoc			= $header[$key_header[$i]]['nodoc'];
	if( ( !empty( $header_link ))	&&
		( check_trustee($trustee))	&&
		($nodoc=='')				){
		$seq = $header_alias;
		manualShowForm( $header_alias, $header_help, $header_link, $seq );
	}
	$key_menu = array_keys($menu);
	for( $count_menu=0; $count_menu<count($menu);$count_menu++){
		$menu_alias = $menu[$key_menu[$count_menu]]['alias'];
		$menu_name  = $menu[$key_menu[$count_menu]]['name'];
		$menu_help  = $menu[$key_menu[$count_menu]]['help'];
		$menu_link  = $menu[$key_menu[$count_menu]]['link'];
		$trustee	= $menu[$key_menu[$count_menu]]['show'];
		$nodoc		= $menu[$key_menu[$count_menu]]['nodoc'];

		if( ($menu[$key_menu[$count_menu]]['table'] == $header_name)	&&
			(check_trustee( $trustee )) 								){
			if( ( !empty( $menu_link ) ) 	&&
				($nodoc=='')				){
				$seq = $header_alias . ' -> ' . $menu_alias;
				manualShowForm( $menu_alias, $menu_help, $menu_link, $seq );
			}
			$key_submenu = array_keys($submenu);
			for( $count_submenu=0; $count_submenu<count($submenu);
				$count_submenu++){
				$submenu_alias	= $submenu[$key_submenu[$count_submenu]]['alias'];
				$submenu_name	= $submenu[$key_submenu[$count_submenu]]['name'];
				$submenu_help	= $submenu[$key_submenu[$count_submenu]]['help'];
				$submenu_link	= $submenu[$key_submenu[$count_submenu]]['link'];
				$trustee		= $submenu[$key_submenu[$count_submenu]]['show'];
				$nodoc			= $submenu[$key_submenu[$count_submenu]]['nodoc'];
				if( ( $submenu[$key_submenu[$count_submenu]]['table'] == $menu_name )	&&
					( !empty( $submenu_link ))											&&
					(check_trustee( $trustee ))											&&
					($nodoc=='') 														){
					$seq = $header_alias . ' -> ' . $menu_alias . ' -> ' . 
					$submenu_alias;
					manualShowForm( $submenu_alias, $submenu_help, $submenu_link, $seq );
				}	
			}
		}	
	}
}		



// Procedimientos Almacenados
// =========================================================================
$pdf->AddPage();
$pdf->SetFont('Times','UB',14);
$pdf->Cell(0,10,"4 - Procedimientos Almacenados",0,1,'',1);	
$pdf->ln(15);
$pdf->SetFont('Times','',12);
$pdf->SetLeftMargin(15);









// Observaciones
// =========================================================================
$pdf->AddPage();
$pdf->SetFont('Times','UB',14);
$pdf->Cell(0,10,"5 - Observaciones",0,1,'',1);	
$pdf->ln(15);
$pdf->SetFont('Times','',12);
$pdf->SetLeftMargin(15);
$pdf->Write(15,'Acuerdese de que la presente documentación es generada '.
				'dinámicamente cuándo se la solicita. Nunca está pre-'.
				'determinada, sino es generada en el momento en que un '.
				'usuario con trustee Developer solicita.');	
$pdf->ln(15);
$pdf->Write(15, 'El usuario con trustee Developer '.
				'puede introducir nuevos módulos, reglas, '.
				'modificaciones, o cambios a cerca de los derechos de acceso '.
				'de cada usuario en cualquier momento, conforme sus necesidades.' );	
$pdf->ln(15);
$pdf->Write(15, 'Eso quiere decir que la documentación generada estará actualizada '.
				'solamente mientras el sistema no sufra ningún cambio. Si el '.
				'sistema ha sufrido algún cambio y tiene usted la versión '. 
				'impresa de la presente documentación, el ideal es imprimir '.
				'nueva documentación, para mantenerse con la versión actualizada.' );	
$pdf->ln(15);
$pdf->Write(15, 'Por seguridad, el sistema imprime la fecha e hora de la impresión '.
				'en la esquina inferior izquierda del manual. Usted puede utilizar '.
				'esa información como referencia. ');	
$pdf->ln(15);

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
 * @param $alias	The Formulary alias name
 * @param $help		The help text 
 * @param $link		File linked with these form
 * @param $seq		Menu sequence to show this form
 *
 */
 
function manualShowForm( $alias, $help, $link, $seq ) {
	global $Global, $DB, $pdf;

	$pdf->AddPage();
	$pdf->SetLeftMargin(10);
	$pdf->SetFont('Times','UB',14);
	$pdf->Cell(0,10,'Formulario '.$alias, 0,1,'',1 );
	$pdf->SetFont('Times','',10);
	$pdf->Cell(80);
	$pdf->Cell(15,5,"Menu:", 0,0);
	$pdf->SetFont('Times','I',10);
	$pdf->Cell(0,5,"($seq)", 0,1);
	$pdf->SetLeftMargin(20);
	$pdf->SetFont('Times','B',14);
	$pdf->Cell(0,10,$help, 0,1 );
	$pdf->SetFont('Times','',12);
	$pdf->SetLeftMargin(10);

	// Load a Form Object
	$Obj = new Y_Engine();
	$file = "project/" . $Global['project'] . "/".$link.'.php';
	if( !file_exists( $file )){
		$file = "engine/".$Global['lang']."/".$link.'.php';
	}
	if( file_exists( $file )){
		include ( $file );
	}
	else{
		return;
	}
	$pdf->SetLeftMargin(20);
	$pdf->Cell(0,1,'',0,1);	
/*
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(25,10,'Formulario', 0,0 );
	$pdf->SetFont('Times','',12);
	$pdf->Cell(0,10,$Obj->alias . ' ('.$Obj->doc . ')', 0,1 );
*/
	$pdf->SetFont('Times','',12);
	$pdf->Write(5,'Tabla: ');
	$pdf->SetFont('Times','B',12);
	$pdf->Write(5,$Obj->File );
//	$pdf->ln(5);
	$pdf->SetFont('Times','I',12);
	$pdf->Write(5,' - '.$Obj->help);
	$pdf->ln(10);
	
	// NoEdit
	if( $Obj->NoEdit != '' ){
		$pdf->Cell(0,10,'Ese formulario está bloqueado (no permite inserciones de datos).', 0,1 );
	}
	
	
	// Field List
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(25,5,'Campos:', 0,0 );
	$pdf->SetFont('Times','I',10);
	$pdf->Cell(25,5,'(campos obligatorios marcados con asterisco "*" y nombre real '.
					'entre parentesis)', 0,1 );
	$key = array_keys( $Obj->element );
	for( $i=0; $i< count( $key ); $i++ ) {
		$var = array();		
		$element = $key[$i];
		$var['count'] = $i;
		$tag = array_keys( $Obj->element[$element] );
		for ( $cnt=0; $cnt< count($tag); $cnt++ ){
			$var[$tag[$cnt]] = $Obj->Get( $element, $tag[$cnt] );
		}
		if( !trustee( $var['G_SHOW_'] ) ) {
			continue;
		}
		$pdf->SetFont('Times','B',12);
		if( $var['F_REQUIRED_'] != '' ){
			$required = '*';
		}
		else{
			$required = '';
		}
		$pdf->Cell(10,5, $required,0,0,'R');
		$pdf->Cell(40,5,$var['F_ALIAS_'], 0,0 );
		$pdf->Cell(30,5,"(".$var['F_NAME_'].")", 0,0 );
		$pdf->SetFont('Times','',12);
		$pdf->Cell(40,5,$var['F_HELP_'], 0,1 );
//		$varMotor['F_VALUE_'] = 
//					$this->Get( $object, $varMotor['F_NAME_'] );
	}	
	$pdf->ln(5);
//	$pdf->SetFont('Times','',12);
//	$pdf->Write(5,'Tabla en la Base de Datos: ');
	$pdf->SetFont('Times','B',12);
//	$pdf->Write(5,$Obj->File );
//	$pdf->ln(5);
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
	$pdf->ln(5);
	
	
	
	
} // manualShowForm() ------------------------------------------------------

?>