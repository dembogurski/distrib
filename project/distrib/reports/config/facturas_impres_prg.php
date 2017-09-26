<?php

/** Report prg file (facturas_impres) 
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
$T->Set( 'sup_tipo', 'Facturas Impresas');
$T->Set( 'sup_desde', '2014-07-03');
$T->Set( 'sup_hasta', '2017-07-03');
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

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT f.f_nro AS Interno,cl.cli_nombre AS Cliente,cl.cli_ci AS RUC,c.f_pdv AS P_Exp,LPAD(c.f_nro,6,"0") AS Factura,f.f_tipo as Tipo,c.f_total AS Total FROM factura_venta f, fact_cont c, clientes cl WHERE f.f_nro = c.f_ref AND f.f_cli_cod = cl.cli_id AND f.f_estado = "Cerrada" AND c.f_estado = "Cerrada" AND f.f_fecha BETWEEN '2014-07-03' AND '2017-07-03' ";
require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company ); 

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
$subtotal0_Total = 0;


//Define a Old Values Variables
$old['Interno'] = '';
$old['Cliente'] = '';
$old['RUC'] = '';
$old['P_Exp'] = '';
$old['Factura'] = '';
$old['Tipo'] = '';
$old['Total'] = '';
$old['Fecha'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['Interno'] = $Q0->Record['Interno'];
    $el['Cliente'] = $Q0->Record['Cliente'];
    $el['RUC'] = $Q0->Record['RUC'];
    $el['P_Exp'] = $Q0->Record['P_Exp'];
    $el['Factura'] = $Q0->Record['Factura'];
    $el['Tipo'] = $Q0->Record['Tipo'];
    $el['Total'] = $Q0->Record['Total'];
    $el['Fecha'] = $Q0->Record['Fecha'];

    // Preparing a template variables
    $T->Set('query0_Interno', $el['Interno']);
    $T->Set('query0_Cliente', $el['Cliente']);
    $T->Set('query0_RUC', $el['RUC']);
    $T->Set('query0_P_Exp', $el['P_Exp']);
    $T->Set('query0_Factura', $el['Factura']);
    $T->Set('query0_Tipo', $el['Tipo']);
    $T->Set('query0_Fecha', $el['Fecha']);
    $T->Set('query0_Total', number_format($el['Total'],0,',','.'));

    // Calculating a total

    // Calculating a subtotal
    $subtotal0_Total += 0 + $el['Total'];

    $T->Show('query0_data_row');
    // Show Subtotal
    $T->Set('subtotal0_Total', number_format($subtotal0_Total,0,',','.'));
    if( $endConsult ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_Total = 0;
    }
    
    //Actualize Old Values Variables
    $old['Interno'] = $el['Interno'];
    $old['Cliente'] = $el['Cliente'];
    $old['RUC'] = $el['RUC'];
    $old['P_Exp'] = $el['P_Exp'];
    $old['Factura'] = $el['Factura'];
    $old['Tipo'] = $el['Tipo'];
    $old['Total'] = $el['Total'];
    $old['Fecha'] = $el['Fecha'];
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
