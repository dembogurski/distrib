<?php

/** Report prg file (hist_vent_cod) 
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
$T->Set( 'sup_p_cod', '1156');
$T->Set( 'sup_p_descri', 'GOLD-ACCESORIOS-PIEDRAS-GRIS');
$T->Set( 'sup_p_ump', 'UNID');
$T->Set( 'sup_p_cant_c', '66.00');
$T->Set( 'sup_p_stock', '66.00');
$T->Set( 'sup_p_compra', '25042.74');
$T->Set( 'sup_p_valmin', '40068.38');
$T->Set( 'sup___lock', 'true');
$T->Set( 'sup_p_hist_ventas', '');
*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT f_nro AS Ref,f.f_fact_cont AS Factura,f_cat AS Cat,DATE_FORMAT(f_fecha,"%d-%m-%Y") AS Fecha,f_usuario AS Usuario,     f.f_tipo AS Tipo,c.cli_ci AS RUC,c.cli_nombre AS Cliente,d.d_cant_v AS CantV,d.d_um AS UM,d.d_precio AS PrecioV      FROM  factura_venta f, clientes c , fact_vent_det d WHERE f.f_nro = d.d_fact AND f.f_cli_cod = c.cli_id AND d.d_codigo = '1156'";

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
$subtotal0_CantV = 0;


//Define a Old Values Variables
$old['Ref'] = '';
$old['Factura'] = '';
$old['Cat'] = '';
$old['Fecha'] = '';
$old['Usuario'] = '';
$old['Tipo'] = '';
$old['RUC'] = '';
$old['Cliente'] = '';
$old['CantV'] = '';
$old['UM'] = '';
$old['PrecioV'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['Ref'] = $Q0->Record['Ref'];
    $el['Factura'] = $Q0->Record['Factura'];
    $el['Cat'] = $Q0->Record['Cat'];
    $el['Fecha'] = $Q0->Record['Fecha'];
    $el['Usuario'] = $Q0->Record['Usuario'];
    $el['Tipo'] = $Q0->Record['Tipo'];
    $el['RUC'] = $Q0->Record['RUC'];
    $el['Cliente'] = $Q0->Record['Cliente'];
    $el['CantV'] = $Q0->Record['CantV'];
    $el['UM'] = $Q0->Record['UM'];
    $el['PrecioV'] = $Q0->Record['PrecioV'];

    // Preparing a template variables
    $T->Set('query0_Ref', $el['Ref']);
    $T->Set('query0_Factura', $el['Factura']);
    $T->Set('query0_Cat', $el['Cat']);
    $T->Set('query0_Fecha', $el['Fecha']);
    $T->Set('query0_Usuario', $el['Usuario']);
    $T->Set('query0_Tipo', $el['Tipo']);
    $T->Set('query0_RUC', $el['RUC']);
    $T->Set('query0_Cliente', $el['Cliente']);
    $T->Set('query0_CantV', number_format($el['CantV'],2,',','.'));
    $T->Set('query0_UM', $el['UM']);
    $T->Set('query0_PrecioV', number_format($el['PrecioV'],2,',','.'));

    // Calculating a total

    // Calculating a subtotal
    $subtotal0_CantV += 0 + $el['CantV'];

    $T->Show('query0_data_row');
    // Show Subtotal
    $T->Set('subtotal0_CantV', number_format($subtotal0_CantV,2,',','.'));
    if( $endConsult ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_CantV = 0;
    }
    
    //Actualize Old Values Variables
    $old['Ref'] = $el['Ref'];
    $old['Factura'] = $el['Factura'];
    $old['Cat'] = $el['Cat'];
    $old['Fecha'] = $el['Fecha'];
    $old['Usuario'] = $el['Usuario'];
    $old['Tipo'] = $el['Tipo'];
    $old['RUC'] = $el['RUC'];
    $old['Cliente'] = $el['Cliente'];
    $old['CantV'] = $el['CantV'];
    $old['UM'] = $el['UM'];
    $old['PrecioV'] = $el['PrecioV'];
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
