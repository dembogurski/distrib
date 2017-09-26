<?php

/** Report prg file (margen_detallad) 
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
$T->Set( 'sup_suc', '01');
$T->Set( 'sup_desde', '2014-01-23');
$T->Set( 'sup_hasta', '2015-01-23');
$T->Set( 'sup_rep0', '');
$T->Set( 'sup___lock', 'true');
*/
// ------------------------------------------
require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company );

$desde = $sup['desde'];
$hasta = $sup['hasta'];
$um = $sup['umv'];

// THIS IS YOUR FIRST QUERY:
$query0 = "SELECT f_nro AS Factura, d.d_codigo AS Codigo,d.d_descrip as Descrip, 
        ROUND((p_compra * 100) / (100 + c_porc_rec) ,2) AS   P_Compra,
        ROUND(p_compra,2) AS   P_CompraCR,
        d_cant_v AS Cant_Vendida,
        ROUND( (p_compra * 100) / (100 + c_porc_rec) * d_cant_v,2) AS Costo,
        ROUND( p_compra * d_cant_v,2) AS CostoCR,
        d.d_subtotal AS SubTotal,
        ROUND(d_subtotal - ( (p_compra * 100) / (100 + c_porc_rec) * d_cant_v),2) AS Margen, 
        ROUND(d_subtotal - (p_compra * d_cant_v),2) AS MargenCR
         
	FROM factura_venta f, fact_vent_det d, factura_compra c, fact_comp_det fd WHERE  f.f_nro  = d.d_fact AND d.d_codigo = fd.p_cod_art
        AND  c.c_ref = fd.p_ref AND f.f_estado = 'Cerrada'  
	AND f.f_fecha BETWEEN '$desde' AND '$hasta' ";

//echo $query0;

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
$subtotal0_Costo = 0;
$subtotal0_SubTotal = 0;
$subtotal0_Margen = 0;

$subtotal0_CostoCR = 0; 
$subtotal0_MargenCR = 0;


//Define a Old Values Variables
$old['Factura'] = '';
$old['Codigo'] = '';
$old['Descrip'] = '';
 
$old['P_Compra'] = '';
$old['P_CompraCR'] = '';
$old['Cant_Vendida'] = '';
$old['Costo'] = '';
$old['CostoCR'] = '';
$old['SubTotal'] = '';
$old['Margen'] = '';
$old['MargenCR'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['Factura'] = $Q0->Record['Factura'];
    $el['Codigo'] = $Q0->Record['Codigo'];
    $el['Descrip'] = $Q0->Record['Descrip'];
    $el['Grupo'] = $Q0->Record['Grupo'];
    $el['Tipo'] = $Q0->Record['Tipo'];
    $el['Color'] = $Q0->Record['Color'];
    $el['P_Compra'] = $Q0->Record['P_Compra'];
    $el['P_CompraCR'] = $Q0->Record['P_CompraCR'];
    $el['Cant_Vendida'] = $Q0->Record['Cant_Vendida'];
    $el['Costo'] = $Q0->Record['Costo'];
    $el['CostoCR'] = $Q0->Record['CostoCR'];
    $el['SubTotal'] = $Q0->Record['SubTotal'];
    $el['Margen'] = $Q0->Record['Margen'];
    $el['MargenCR'] = $Q0->Record['MargenCR'];

    // Preparing a template variables
    $T->Set('query0_Factura', $el['Factura']);
    $T->Set('query0_Codigo', $el['Codigo']);
    $T->Set('query0_Descrip', $el['Descrip']);     
    $T->Set('query0_P_Compra', number_format($el['P_Compra'],0,',','.'));  
    $T->Set('query0_P_CompraCR', number_format($el['P_CompraCR'],0,',','.'));  
    $T->Set('query0_Cant_Vendida', $el['Cant_Vendida']);
    $T->Set('query0_Costo', number_format($el['Costo'],0,',','.'));
    $T->Set('query0_CostoCR', number_format($el['CostoCR'],0,',','.'));
    $T->Set('query0_SubTotal', number_format($el['SubTotal'],0,',','.'));
    $T->Set('query0_Margen', number_format($el['Margen'],0,',','.'));
    $T->Set('query0_MargenCR', number_format($el['MargenCR'],0,',','.'));

    // Calculating a total

    // Calculating a subtotal
    $subtotal0_Costo += 0 + $el['Costo'];
    $subtotal0_SubTotal += 0 + $el['SubTotal'];
    $subtotal0_Margen += 0 + $el['Margen'];
    $subtotal0_CostoCR += 0 + $el['CostoCR'];    
    $subtotal0_MargenCR += 0 + $el['MargenCR'];

    $T->Show('query0_data_row');
    // Show Subtotal
    $T->Set('subtotal0_Costo', number_format($subtotal0_Costo,0,',','.'));
    $T->Set('subtotal0_SubTotal', number_format($subtotal0_SubTotal,0,',','.'));
    $T->Set('subtotal0_Margen', number_format($subtotal0_Margen,0,',','.'));
    
    $T->Set('subtotal0_CostoCR', number_format($subtotal0_CostoCR,0,',','.'));
    $T->Set('subtotal0_MargenCR', number_format($subtotal0_MargenCR,0,',','.'));
    
    if( $endConsult ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_Costo = 0;
        $subtotal0_SubTotal = 0;
        $subtotal0_Margen = 0;
    }
    
    //Actualize Old Values Variables
    $old['Factura'] = $el['Factura'];
    $old['Codigo'] = $el['Codigo'];
    $old['Descrip'] = $el['Descrip'];    
    $old['P_Compra'] = $el['P_Compra'];
    $old['P_CompraCR'] = $el['P_CompraCR'];
    $old['Cant_Vendida'] = $el['Cant_Vendida'];
    $old['Costo'] = $el['Costo'];
    $old['CostoCR'] = $el['CostoCR'];
    $old['SubTotal'] = $el['SubTotal'];
    $old['Margen'] = $el['Margen'];
    $old['MargenCR'] = $el['MargenCR'];
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
