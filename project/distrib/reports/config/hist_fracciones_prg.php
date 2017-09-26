<?php

/** Report prg file (hist_fracciones) 
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
$T->Set( 'sup_p_cod', '349');
$T->Set( 'sup_p_descri', 'GOLD-TUL-BORDADO-FUXIA');
$T->Set( 'sup_p_ump', 'MTS');
$T->Set( 'sup_p_cant_c', '20.15');
$T->Set( 'sup_p_stock', '6.75');
$T->Set( 'sup_p_compra', '156582.77');
$T->Set( 'sup_p_valmin', '250532.43');
$T->Set( 'sup___lock', 'true');
$T->Set( 'sup_p_hist_ventas', '');
$T->Set( 'sup_p_ajustes', '');
$T->Set( 'sup_p_hist_fraccion', '');
*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT p.p_cod AS Codigo, p_padre AS Padre,s.s_nombre AS Sector,g.g_nombre AS Grupo, t.t_nombre AS Tipo,c.color AS Color,    p_um AS UM,p_cant_compra AS CantFrac,p_cant AS Stock,p_estado AS Estado      FROM   productos p,sector s,grupo g,tipo t,colores c      WHERE c.c_cod=p_color AND t.t_cod=p_tipo AND g.g_cod=p_grupo AND s.s_cod=p_sector AND p_padre = '349'  ";

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
$subtotal0_CantFrac = 0;


//Define a Old Values Variables
$old['Codigo'] = '';
$old['Padre'] = '';
$old['Sector'] = '';
$old['Grupo'] = '';
$old['Tipo'] = '';
$old['Color'] = '';
$old['UM'] = '';
$old['CantFrac'] = '';
$old['Stock'] = '';
$old['Estado'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['Codigo'] = $Q0->Record['Codigo'];
    $el['Padre'] = $Q0->Record['Padre'];
    $el['Sector'] = $Q0->Record['Sector'];
    $el['Grupo'] = $Q0->Record['Grupo'];
    $el['Tipo'] = $Q0->Record['Tipo'];
    $el['Color'] = $Q0->Record['Color'];
    $el['UM'] = $Q0->Record['UM'];
    $el['CantFrac'] = $Q0->Record['CantFrac'];
    $el['Stock'] = $Q0->Record['Stock'];
    $el['Estado'] = $Q0->Record['Estado'];

    // Preparing a template variables
    $T->Set('query0_Codigo', $el['Codigo']);
    $T->Set('query0_Padre', $el['Padre']);
    $T->Set('query0_Sector', $el['Sector']);
    $T->Set('query0_Grupo', $el['Grupo']);
    $T->Set('query0_Tipo', $el['Tipo']);
    $T->Set('query0_Color', $el['Color']);
    $T->Set('query0_UM', $el['UM']);
    $T->Set('query0_CantFrac', number_format($el['CantFrac'],2,',','.'));
    $T->Set('query0_Stock', $el['Stock']);
    $T->Set('query0_Estado', $el['Estado']);

    // Calculating a total

    // Calculating a subtotal
    $subtotal0_CantFrac += 0 + $el['CantFrac'];

    $T->Show('query0_data_row');
    // Show Subtotal
    $T->Set('subtotal0_CantFrac', number_format($subtotal0_CantFrac,2,',','.'));
    if( $endConsult ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_CantFrac = 0;
    }
    
    //Actualize Old Values Variables
    $old['Codigo'] = $el['Codigo'];
    $old['Padre'] = $el['Padre'];
    $old['Sector'] = $el['Sector'];
    $old['Grupo'] = $el['Grupo'];
    $old['Tipo'] = $el['Tipo'];
    $old['Color'] = $el['Color'];
    $old['UM'] = $el['UM'];
    $old['CantFrac'] = $el['CantFrac'];
    $old['Stock'] = $el['Stock'];
    $old['Estado'] = $el['Estado'];
    $firstRow=false;

}

$endConsult = true;
if( $endConsult ){
    $T->Show('query0_subtotal_row');
}
// Show total
if( true ){
    $T->Show('query0_total_row');
}
$T->Show('end_query0');				// Ends a Table 

?>
