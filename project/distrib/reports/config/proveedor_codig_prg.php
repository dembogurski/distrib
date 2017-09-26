<?php

/** Report prg file (proveedor_codig) 
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
$T->Set( 'sup_p_cod', '368');
$T->Set( 'sup_p_descri', 'GOLD-TUL-BORDADO-MARFIL 1');
$T->Set( 'sup_p_ump', 'MTS');
$T->Set( 'sup_p_cant_c', '13.20');
$T->Set( 'sup_p_stock', '9.20');
$T->Set( 'sup_p_compra', '96750.92');
$T->Set( 'sup_p_valmin', '154801.47');
$T->Set( 'sup___lock', 'true');
$T->Set( 'sup_p_hist_ventas', '');
$T->Set( 'sup_p_ajustes', '');
$T->Set( 'sup_p_hist_fraccion', '');
$T->Set( 'sup_p_prov', '');
$T->Set( 'sup_p_ventas', '2.00');
$T->Set( 'sup_p_fracs', '');
$T->Set( 'sup_p_aj_pos', '');
$T->Set( 'sup_p_aj_neg', '');
$T->Set( 'sup_p_stock_calc', '11.2');
$T->Set( 'sup_p_update', 'false');
*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT p_cod AS Codigo,p_padre as CodPadre,prov_cod AS CodProv, pr.prov_nombre AS Proveedor,p.p_st AS StoreNumber_SV,pr.prov_ciudad AS Ciudad,prov_dir AS Dir,DATE_FORMAT(c.c_fecha,"%d-%m-%Y") AS FechaGen,DATE_FORMAT(c.c_fecha_fac,"%d-%m-%Y") AS FechaFactura, p.p_cant_compra AS CantCompra FROM factura_compra c, productos p, proveedores pr WHERE c.c_ref = p.p_ref AND c.c_prov = pr.prov_cod AND p.p_cod =  '368'";

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company );

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
$old['CodPadre'] = '';
$old['CodProv'] = '';
$old['Proveedor'] = '';
$old['StoreNumber_SV'] = '';
$old['Ciudad'] = '';
$old['Dir'] = '';
$old['FechaGen'] = '';
$old['FechaFactura'] = '';
$old['CantCompra'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['Codigo'] = $Q0->Record['Codigo'];
    $el['CodPadre'] = $Q0->Record['CodPadre'];
    $el['CodProv'] = $Q0->Record['CodProv'];
    $el['Proveedor'] = $Q0->Record['Proveedor'];
    $el['StoreNumber_SV'] = $Q0->Record['StoreNumber_SV'];
    $el['Ciudad'] = $Q0->Record['Ciudad'];
    $el['Dir'] = $Q0->Record['Dir'];
    $el['FechaGen'] = $Q0->Record['FechaGen'];
    $el['FechaFactura'] = $Q0->Record['FechaFactura'];
    $el['CantCompra'] = $Q0->Record['CantCompra'];

    // Preparing a template variables
    $T->Set('query0_Codigo', $el['Codigo']);
    $T->Set('query0_CodPadre', $el['CodPadre']);
    $T->Set('query0_CodProv', $el['CodProv']);
    $T->Set('query0_Proveedor', $el['Proveedor']);
    $T->Set('query0_StoreNumber_SV', $el['StoreNumber_SV']);
    $T->Set('query0_Ciudad', $el['Ciudad']);
    $T->Set('query0_Dir', $el['Dir']);
    $T->Set('query0_FechaGen', $el['FechaGen']);
    $T->Set('query0_FechaFactura', $el['FechaFactura']);
    $T->Set('query0_CantCompra', $el['CantCompra']);

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
    $old['CodPadre'] = $el['CodPadre'];
    $old['CodProv'] = $el['CodProv'];
    $old['Proveedor'] = $el['Proveedor'];
    $old['StoreNumber_SV'] = $el['StoreNumber_SV'];
    $old['Ciudad'] = $el['Ciudad'];
    $old['Dir'] = $el['Dir'];
    $old['FechaGen'] = $el['FechaGen'];
    $old['FechaFactura'] = $el['FechaFactura'];
    $old['CantCompra'] = $el['CantCompra'];
    $firstRow=false;

}

$endConsult = true;
if( true ){
    $T->Show('query0_subtotal_row');
}
// Show total
if( true ){
    $T->Show('query0_total_row');
}
$T->Show('end_query0');				// Ends a Table 

?>
