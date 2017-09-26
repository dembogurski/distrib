<?php


/** plus_doc_user.php		Makes a User Manual
 *  ===========================================
 *
 * @author	Sergio A. Pohlmann <sergio@ycube.net>
 * @date	August, 20 of 2005
 *
 */
 
 
Global $Global, $DB; 




require('pdf/fpdf.php');

  

class PDF extends FPDF {
	//Cabecera de pagina
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

$pdf=new PDF('P','mm','A4','Manual del Usuario - ' . $Global['username'],
		$Obj->alias );
$pdf->username = $Global['username'];


//--------------------
$pdf->SetLeftMargin(10);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->Ln(50);
$pdf->SetFont('Arial','B',30);
$pdf->Cell(0,10,"Proyecto: ". $Global['project'],0,1,'C');	
$pdf->Ln(30);
$pdf->SetFont('Times','B',40);
$pdf->Cell(0,10,"MANUAL DEL USUARIO",0,1,'C');		
$pdf->Ln(30);
$pdf->SetFont('Times','BIU',20);
$pdf->Cell(0,10,'Exclusivo para el usuario: '.$Global['username'],0,1,'C');		
$pdf->Ln(10);

//----------------------


$pdf->SetLeftMargin(10);
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Times','B',16);
$pdf->Cell(0,10,"Manual del Usuario - " . $Global[ 'project' ] ." - " . $Obj->alias,0,1);	
$pdf->Ln(10);


// Introduccion
// =========================================================================
$pdf->SetFont('Times','UB',14);
$pdf->Cell(0,10,"1 - Introducción",0,1);	
$pdf->Ln(10);

$pdf->SetFont('Times','',12);
$pdf->Cell(10);
$pdf->Write(10,'Ese manual explica el uso del sistema ');	
$pdf->SetFont('Times','B',12);
$pdf->Write(10,$Global['project']);	
$pdf->SetFont('Times','',12);
$pdf->Write(10,', dentro de los permisos de uso para el usuario ');	
$pdf->SetFont('Times','B',12);
$pdf->Write(10,$Global['username'].'.');	
$pdf->Ln(10);
$pdf->SetFont('Times','',12);
$pdf->Cell(10);
$pdf->Write(10,'Está dividido en las secciones:');	
$pdf->Ln(10);
$pdf->SetFont('Times','B',12);
$pdf->Cell(10);
$pdf->Cell(60,10,"1 - Introducción",0,0);	
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,"La presente sección.",0,1);
$pdf->SetFont('Times','B',12);
$pdf->Cell(10);
$pdf->Cell(60,10,"2 - Menus",0,0);	
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,"Una relación de todos los menus a los cuales el usuario puede acceder.",0,1);
$pdf->SetFont('Times','B',12);
$pdf->Cell(10);
$pdf->Cell(60,10,"3 - Llamadas a Formularios",0,0);	
$pdf->SetFont('Times','',12);
$pdf->SetLeftMargin(80);
$pdf->Write(10,"Todas las llamadas a los formularios del sistema, con los ".
				"respectivos campos, su significado,".
				" forma de rellenar los datos solicitados etc. Observe que el sistema de reportes está " .
				"incluido en el mismo sistema de formularios, de forma que esa misma sección ".
				"también le aclarará cuando puedas acceder a un reporte específico desde un campo.");
$pdf->SetLeftMargin(10);
$pdf->Ln(10);
$pdf->SetFont('Times','B',12);
$pdf->Cell(10);
$pdf->Cell(60,10,"4 - Observaciones",0,0);	
$pdf->SetFont('Times','',12);
$pdf->Cell(0,10,"Observaciones en cuánto a la validez de los datos de ese manual.",0,1);

// Menus
// =========================================================================
$pdf->AddPage();
$pdf->SetFont('Times','UB',14);
$pdf->Cell(0,10,"2 - Menus",0,1);	
$pdf->Ln(10);

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
				'link' 	=>  $Obj->element[ $key[$i] ] [ F_LINK_ ],
				'nodoc'	=>  $Obj->element[ $key[$i] ] [ F_NODOC_ ],
				'show' 	=>  $Obj->element[ $key[$i] ] [ G_SHOW_ ]
			));	
	}
}
		
// Print a menu struct

$pdf->SetFont('Times','',12);
$pdf->Cell(10);
$pdf->Write(10,'Los menus estan estructurados de la siguiente forma:');	
$pdf->Ln(10);

$key_header = array_keys( $header );
for( $i=0; $i<count($header) ; $i++){
	$header_alias 	= $header[$key_header[$i]]['alias'];
	$header_name  	= $header[$key_header[$i]]['name'];
	$header_help  	= $header[$key_header[$i]]['help'];
	$trustee		= $header[$key_header[$i]]['show'];
	$nodoc			= $header[$key_header[$i]]['nodoc'];
	if( (check_trustee($trustee))	&&
		($nodoc=='')				){
		$pdf->Ln(10);
		$pdf->Cell(10);
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(60,10,$header_alias, 0,0 );
		$pdf->Cell(0,10,$header_help, 0,1 );
		$pdf->SetFont('Times','',12);
	}

	$key_menu = array_keys($menu);
	for( $count_menu=0; $count_menu<count($menu);$count_menu++){
		$menu_alias = $menu[$key_menu[$count_menu]]['alias'];
		$menu_name  = $menu[$key_menu[$count_menu]]['name'];
		$menu_help  = $menu[$key_menu[$count_menu]]['help'];
		$trustee	= $menu[$key_menu[$count_menu]]['show'];
		$nodoc		= $menu[$key_menu[$count_menu]]['nodoc'];

		if( ($menu[$key_menu[$count_menu]]['table'] == $header_name)	&&
			(check_trustee( $trustee )) 								&&
			($nodoc=='')												){

			$pdf->Cell(20);
			$pdf->Cell(60,10,$menu_alias, 0,0 );
			$pdf->Cell(0,10,$menu_help, 0,1 );
		
			$key_submenu = array_keys($submenu);
			for( $count_submenu=0; $count_submenu<count($submenu);
				$count_submenu++){
				$submenu_alias	= $submenu[$key_submenu[$count_submenu]]['alias'];
				$submenu_name	= $submenu[$key_submenu[$count_submenu]]['name'];
				$submenu_help	= $submenu[$key_submenu[$count_submenu]]['help'];
				$trustee		= $submenu[$key_submenu[$count_submenu]]['show'];
				$nodoc			= $submenu[$key_submenu[$count_submenu]]['nodoc'];
				if( ( $submenu[$key_submenu[$count_submenu]]['table'] == $menu_name )	&&
					(check_trustee( $trustee ))											&&
					($nodoc=='')														){
					$pdf->Cell(30);
					$pdf->Cell(60,10,$submenu_alias, 0,0 );
					$pdf->Cell(0,10,$submenu_help, 0,1 );
				}	
			}
		}	
	}
}		


// Formularios
// =========================================================================
$pdf->AddPage();
$pdf->SetFont('Times','UB',14);
$pdf->Cell(0,10,"3 - Llamadas a Formularios",0,1);	
$pdf->Ln(10);
$pdf->SetFont('Times','',12);
$pdf->SetLeftMargin(15);
$pdf->Write(10,'En esa sección veremos la explicación de cada una de las '.
				'llamadas a los formularios del sistema, así como las '.
				'llamadas a rutinas especiales (si hubieren).');	
$pdf->Write(10,'Para cada formulario, habrá (entre paréntesis) la '.
				'descripción de como se puede acceder al mismo, seguido de '.
				'la descripción del formulario en sí, con sus campos.');
$pdf->Ln(10);
$pdf->Write(10, 'Dando secuencia, una descripción de cada uno de los campos, '.
				'sus exigencias de rellenado, fuentes de datos, etc. Acuerdese '.
				'de que muchos campos son condicionales, es decir: solo están ' .
				'visibles si se cumplen determinadas condiciones. Asi, es normal ' .
				'que no veas todos los campos listados en la descripción. ' .
				'Para facilitar, los campos condicionales siempre estarán '.
				'con una observación que resaltará su situación.'  );	
$pdf->Ln(10);
$pdf->Write(10, 'Además, el control de acceso del sistema es rigurosamente '.
				'controlado a nivel del usuario, y de sus derechos de acceso. '.
				'Eso significa que los campos de un formulario, que están '.
				'presentes para usted, podrán no ser visibles para su compañero. '.
				'La recíproca es verdadera: No todos los campos (así como menus '.
				'y formularios) son visibles para usted. Cada campo, formulario '.
				'o menu tiene una determinada exigencia de usuario, para que '.
				'pueda ser visto o accesado. Si un usuario no tiene permiso ' .
				'para acceder a un menu, formulario o campo del sistema, el '.
				'sistema siquiera le presentará dicho objeto.');	
$pdf->Ln(10);
$pdf->Write(10, 'Si usted desea más informacione a cerca de su nivel de acceso, '.
				'solicite a su superior, o a su administrador de sistema. El '.
				'Administrador de sistema, o desarrollador, es normalmente la '.
				'persona que aplica las reglas de niveles de acceso por usuario, '.
				'obviamente obedecendo a la indicación de los encargados de cada '.
				'área de la empresa.' );	
$pdf->Ln(10);
		
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

// Observaciones
// =========================================================================
$pdf->AddPage();
$pdf->SetFont('Times','UB',14);
$pdf->Cell(0,10,"4 - Observaciones",0,1);	
$pdf->Ln(10);
$pdf->SetFont('Times','',12);
$pdf->SetLeftMargin(15);
$pdf->Write(10,'Acuerdese de que la presente documentación es generada '.
				'dinámicamente cuándo se la solicita. Nunca está pre-'.
				'determinada, sino es generada en el momento en que el '.
				'usuario solicita la opción correspondiente en el menu.');	
$pdf->Ln(10);
$pdf->Write(10, 'El Developer (el usuario responsable por el mantenimiento '.
				'de su sistema, puede introducir nuevos módulos, reglas, '.
				'modificaciones, o cambios a cerca de los derechos de acceso '.
				'de cada usuario en cualquier momento, conforme sus necesidades.' );	
$pdf->Ln(10);
$pdf->Write(10, 'Eso quiere decir que la documentación generada estará actualizada '.
				'solamente mientras el sistema no sufra ningún cambio. Si el '.
				'sistema sufre un cambio que se refleje en su trabajo, y tiene '. 
				'usted una versión impresa del manual, el ideal es imprimir un '.
				'nuevo manual, para mantenerse con la versión actualizada.' );	
$pdf->Ln(10);
$pdf->Write(10, 'Por seguridad, el sistema imprime la fecha e hora de la impresión '.
				'en la esquina inferior izquierda del manual. Usted puede utilizar '.
				'esa información como referencia. En caso de dudas, consulte con su '.
				'superior o con el usuario Developer del sistema.');	
$pdf->Ln(10);

$pdf->Output();

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
	$pdf->Cell(70,10,'Formulario '.$alias, 0,1 );
	$pdf->SetFont('Times','',10);
	$pdf->Cell(60);
	$pdf->Cell(25,10,"Acceder por", 0,0 );
	$pdf->SetFont('Times','I',10);
	$pdf->Cell(0,10,"($seq)", 0,1 );
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
//		$pdf->SetFont('Times','B',18);
//		$pdf->Cell(70,10,'Caso especial ('.$file.')', 0,1 );
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
	$pdf->SetFont('Times','I',12);
	$pdf->Cell(0,10,$Obj->help, 0,1 );
	
	// NoEdit
	if( $Obj->NoEdit != '' ){
		$pdf->Cell(0,10,'Ese formulario está bloqueado (no permite inserciones de datos).', 0,1 );
	}
	
	
	// Field List
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(25,10,'Campos:', 0,0 );
	$pdf->SetFont('Times','I',10);
	$pdf->Cell(25,10,'(campos obligatorios marcados con asterisco "*")', 0,1 );
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
		$pdf->Cell(25,10, $required,0,0,'R');
		$pdf->Cell(40,10,$var['F_ALIAS_'], 0,0 );
		$pdf->SetFont('Times','',12);
		$pdf->Cell(40,10,$var['F_HELP_'], 0,1 );
//		$varMotor['F_VALUE_'] = 
//					$this->Get( $object, $varMotor['F_NAME_'] );
	}	
	$pdf->ln(10);
	$pdf->SetFont('Times','B',12);
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
			( $var['C_SHOW_'] == '1==0' )		||
			( $var['C_VIEW_'] == '1==0' ) 		){
			continue;
		}
		$pdf->SetFont('Times','B',12);
		$pdf->Cell(5);		
		$pdf->Cell(40,10,$var['F_ALIAS_'], 0,0 );
		$pdf->SetFont('Times','I',12);
		$pdf->Cell(40,10,'('.$var['F_HELP_'].')', 0,1 );
		$pdf->Cell(10);		
		$pdf->SetFont('Times','',12);
		$pdf->Cell(20,10,'Tipo', 0,0 );
		if(	( $var['F_REQUIRED_'] != '' )	&&
			( $var['F_AUTONUM_'] == "" )	){
			$required = ' - Es obligatorio rellenar ese campo';
		}
		else{
			$required = '';
		}
		if( $var['F_TYPE_']=='text'){
			$pdf->Cell(0,10,'Texto ' . $required, 0,1 );
			if( $var['F_LENGTH_'] != "" ){
				$pdf->Cell(30);		
				$pdf->Cell(0,10,'Tamaño máximo de '.$var['F_LENGTH_'].' caracteres', 0,1 );
			}
			if( $var['F_DEC_'] != "" ){
				$pdf->Cell(30);		
				$pdf->Cell(0,10,'Número de decimales: '.$var['F_DEC_'], 0,1 );
				$pdf->Cell(30);		
				$pdf->Cell(0,10,'Solo acepta números', 0,1 );
			}
			if( $var['F_QUERY_'] != "" ){
				$pdf->Cell(30);		
				$pdf->Cell(0,10,'Trae datos de una consulta a la base de datos', 0,1 );
			}
			if( $var['F_AUTONUM_'] != "" ){
				$pdf->Cell(30);		
				$pdf->Cell(0,10,'No permite alteraciones, pues su contenido es autonumerico', 0,1 );
			}
		}
		if( $var['F_TYPE_']=='date'){
			$pdf->Cell(0,10,'Fecha ' . $required, 0,1 );
			$pdf->Cell(30);		
			$pdf->Cell(0,10,'Solo acepta números y el símbolo de guión (-)', 0,1 );
			$pdf->Cell(30);		
			$pdf->Cell(0,10,'Las fechas deben tener el formato dd-mm-aaaa', 0,1 );
		}
		if( ( $var['F_TYPE_']=='select_list')			||
			( $var['F_TYPE_']=='dynamic_select_list')	){
			$pdf->Cell(0,10,'Caja de selección ' . $required, 0,1 );
			$pdf->Cell(30);		
			$pdf->Cell(0,10,'Permite seleccionar:', 0,1 );
        	if( $var['F_OPTIONS_'] != '' ){
				$options = explode( ',', $var['F_OPTIONS_'] );
				$pdf->SetFont('Times','B',12);
				for( $n=0; $n<count($options); $n++ ){
					if( $options[$n] =="" ){
						if( $required=='' ){
							$pdf->Cell(40);		
							$pdf->Cell(0,10,'[Ningún contenido]',0,1);
						}
					}
					else{
						$pdf->Cell(40);		
						$pdf->Cell(0,10,$options[$n],0,1);
					}
				}
				$pdf->SetFont('Times','',12);
	        	if( $var['F_RELTABLE_'] != '' ){
					$pdf->Cell(30);		
					$pdf->Cell(0,10,'Además de permitir elegir: ',0,1 );
				}		
			}		
        	if( $var['F_RELTABLE_'] != '' ){
				$pdf->Cell(40);		
				$pdf->SetFont('Times','B',12);
				$pdf->Cell(0,10,'[Uno de los datos ya registrados de la tabla '.
				$var['F_RELTABLE_'].']', 0,1 );
				$pdf->SetFont('Times','',12);
			}		
		}
		if( $var['F_TYPE_']=='dynamic_select_list'){
			$pdf->Cell(30);		
			$pdf->Cell(0,10,'Ese campo contiene un filtro especial para selecciones dinámicas', 0,1 );
		}
		
		if( $var['F_TYPE_']=='subform'){
			$pdf->Cell(0,10,'Subformulario ', 0,1 );
			$pdf->Cell(30);		
			$pdf->Cell(0,10,'Abre un espacio para la visualización de otro formulario', 0,1 );
		}
		if( $var['F_TYPE_']=='report'){
			$pdf->Cell(0,10,'Botón de Reporte ', 0,1 );
			$pdf->Cell(30);		
			$pdf->Cell(0,10,'Cuándo recibe un "click" con el mouse, accede al reporte relacionado', 0,1 );
		}
		if( $var['F_TYPE_']=='proc'){
			$pdf->Cell(0,10,'Botón de procedimiento ', 0,1 );
			$pdf->Cell(30);		
			$pdf->Cell(0,10,'Cuándo recibe un "click" con el mouse, ejecuta el procedimiento', 0,1 );
		}
		if( $var['F_TYPE_']=='formula'){
			$pdf->Cell(0,10,'Fórmula ', 0,1 );
			$pdf->Cell(30);		
			$pdf->Cell(0,10,'Presenta el resultado de una fórmula predeterminada', 0,1 );
		}
		if( $var['F_UNIQ_']!=''){
			$pdf->Cell(30);		
			$pdf->Cell(0,10,'Campo único - No permite existencia duplicada en la Base de Datos', 0,1 );
		}
		
		if( !check_trustee( $var['G_CHANGE_'] ) ) {
			$pdf->Cell(10);		
			$pdf->Cell(20,10,'Restricción: El usuario '.$Global['username'].' no tiene permiso para '.
			'alterar el contenido de ese campo', 0,1 );
		}
		if( ( $var['C_VIEW_'] !="" ) 	|| 
			( $var['C_SHOW_'] !="" )	){
			$pdf->Cell(10);		
			$pdf->Cell(20,10,'Visibilidad: Campo con visibilidad condicional. ', 0,1 );
			$pdf->Cell(10);		
			$pdf->Cell(20,10,'                    podrá no ser visible a ese'.
			' usuario en determinadas condiciones', 0,1 );
		}
		$pdf->ln(10);

	}	
	$pdf->ln(10);
	

	
	
	
/*	
	//		manualShowField( $var );
	
	
	

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
		$var['F_REQUIRED_'] . '","' .
		$var['P_PROC_'] 	. '","' .
		$var['F_RELTABLE_'] . '","' .
		$var['F_SHOWFIELD_']. '","' .
		$var['F_PREVAL_'] 	. '","' .
		$var['V_DEFAULT_'] 	. '","' .
		$var['F_POSVAL_'] 	. '","' .
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
	
*/	


	
	
	
} // manualShowForm() ------------------------------------------------------

?>