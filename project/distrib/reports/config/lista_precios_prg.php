<?php

/** Report prg file (lista_precios) 
 *  
 *  Dynamically created by ycube plus RAD
 *  
 *  USE THIS FILE TO PERSONALIZE A PROGRAM SIDE OF YOUR REPORT
 *  ==========================================================
 */  

// ATTENTION: CANCEL THIS BLOCK TO EDIT A FILE 
/*
$T = new Y_Template( $file_tpl ); 
// Superior Variables
$T->Set( 'sup_suc', '');
$T->Set( 'sup_tipo', 'Lista de Precios');
$T->Set( 'sup_desde', '2017-07-17');
$T->Set( 'sup_hasta', '2017-07-17');
$T->Set( 'sup_rep0', '');
$T->Set( 'sup_rep2', '');
$T->Set( 'sup_codigo', '');
$T->Set( 'sup_p_sector', '');
$T->Set( 'sup_p_grupo', '');
$T->Set( 'sup_p_tipo', '');
$T->Set( 'sup_p_descri', '');
$T->Set( 'sup_rep1', '');
$T->Set( 'sup___lock', 'true');
*/
// ------------------------------------------

require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company );

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT a.codigo AS Codigo,a.p_descrip AS Descripcion,SUM(IF(num = 1,precio_unit,0)) AS Precio1, SUM(IF(num = 2,precio_unit,0)) AS Precio2,SUM(IF(num = 3,precio_unit,0)) AS Precio3,SUM(IF(num = 4,precio_unit,0)) AS Precio4  FROM articulos a, lista_precios l  WHERE a.codigo = l.codigo GROUP BY a.codigo ORDER BY a.p_descrip ASC ";

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

$firstRow=true;
$Q0 = $DB;
$Q0->Query( $query0 );

// Starting a HTML
$T->Show('general_header');			// Principal Header
$T->Show('start_query0');			// Start a Table 
$T->Show('header0');				// Show Header

//Define a  variable
$endConsult = false;
//Define a Total Variables

//Define a Subtotal Variables


//Define a Old Values Variables
$old['Codigo'] = '';
$old['Descripcion'] = '';
$old['Precio1'] = '';
$old['Precio2'] = '';
$old['Precio3'] = '';
$old['Precio4'] = '';

$i = 0;
// Making a rows of consult
while( $Q0->NextRecord() ){
    $i++;
    // Define a elements
    $el['Codigo'] = $Q0->Record['Codigo'];
    $el['Descripcion'] = $Q0->Record['Descripcion'];
    $el['Precio1'] = $Q0->Record['Precio1'];
    $el['Precio2'] = $Q0->Record['Precio2'];
    $el['Precio3'] = $Q0->Record['Precio3'];
    $el['Precio4'] = $Q0->Record['Precio4'];

    // Preparing a template variables
    $T->Set('query0_Codigo', $el['Codigo']);
    $T->Set('query0_Descripcion', $el['Descripcion']);
    $T->Set('query0_Precio1', $el['Precio1']);
    $T->Set('query0_Precio2', $el['Precio2']);
    $T->Set('query0_Precio3', $el['Precio3']);
    $T->Set('query0_Precio4', $el['Precio4']);

    // Calculating a total

    // Calculating a subtotal

    $T->Show('query0_data_row');
    // Show Subtotal
    if( true ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
    }
    
    //Actualize Old Values Variables
    $old['Codigo'] = $el['Codigo'];
    $old['Descripcion'] = $el['Descripcion'];
    $old['Precio1'] = $el['Precio1'];
    $old['Precio2'] = $el['Precio2'];
    $old['Precio3'] = $el['Precio3'];
    $old['Precio4'] = $el['Precio4'];
    $firstRow=false;

}

$endConsult = true;
if( true ){
	$T->Set('cant', $i);
    $T->Show('query0_subtotal_row');
}
// Show total
if( true ){
    $T->Show('query0_total_row');
}
$T->Show('end_query0');				// Ends a Table 

?>
