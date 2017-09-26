<?php

/** Report prg file (stock) 
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
$T->Set( 'sup_p_lock', 'true');
$T->Set( 'sup_d_buscar', 'ar');
$T->Set( 'sup_d_codigo', '%');
$T->Set( 'sup_p_cant', '8');
$T->Set( 'sup_p_rep', '');
*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT a.codigo as Codigo,a.p_descrip as Descripcion,p_costo_prom as CostoPromedio,p_um as UM,suc,cantidad as Cantidad, cantidad * p_costo_prom AS Valor FROM articulos a, stock s WHERE a.codigo = s.codigo AND a.codigo LIKE '%' AND cantidad > '8'  GROUP BY codigo,suc ORDER BY codigo ASC ";

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company );

$firstRow=true;
$Q0 = $DB;

// Corregir el Stock antes de generar el Reporte
$Q0->Query("SELECT corr_stock()");

        
$Q0->Query( $query0 );

// Starting a HTML
$T->Show('general_header');			// Principal Header
$T->Show('start_query0');			// Start a Table 
$T->Show('header0');				// Show Header

//Define a  variable
$endConsult = false;
//Define a Total Variables

//Define a Subtotal Variables
$subtotal0_Cantidad = 0;
$subtotal0_Valor = 0;


//Define a Old Values Variables
$old['Codigo'] = '';
$old['Descripcion'] = '';
$old['CostoPromedio'] = '';
$old['UM'] = '';
$old['suc'] = '';
$old['Cantidad'] = '';
$old['Valor'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['Codigo'] = $Q0->Record['Codigo'];
    $el['Descripcion'] = $Q0->Record['Descripcion'];
    $el['CostoPromedio'] = $Q0->Record['CostoPromedio'];
    $el['UM'] = $Q0->Record['UM'];
    $el['suc'] = $Q0->Record['suc'];
    $el['Cantidad'] = $Q0->Record['Cantidad'];
    $el['Valor'] = $Q0->Record['Valor'];

    // Preparing a template variables
    $T->Set('query0_Codigo', $el['Codigo']);
    $T->Set('query0_Descripcion', $el['Descripcion']);
    $T->Set('query0_CostoPromedio', $el['CostoPromedio']);
    $T->Set('query0_UM', $el['UM']);
    $T->Set('query0_suc', $el['suc']);
    $T->Set('query0_Cantidad', number_format($el['Cantidad'],0,',','.'));
    $T->Set('query0_Valor', number_format($el['Valor'],0,',','.'));

    // Calculating a total

    // Calculating a subtotal
    $subtotal0_Cantidad += 0 + $el['Cantidad'];
    $subtotal0_Valor += 0 + $el['Valor'];

    $T->Show('query0_data_row');
    // Show Subtotal
    $T->Set('subtotal0_Cantidad', number_format($subtotal0_Cantidad,2,',','.'));
    $T->Set('subtotal0_Valor', number_format($subtotal0_Valor,2,',','.'));
    if( $endConsult ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_Cantidad = 0;
        $subtotal0_Valor = 0;
    }
    
    //Actualize Old Values Variables
    $old['Codigo'] = $el['Codigo'];
    $old['Descripcion'] = $el['Descripcion'];
    $old['CostoPromedio'] = $el['CostoPromedio'];
    $old['UM'] = $el['UM'];
    $old['suc'] = $el['suc'];
    $old['Cantidad'] = $el['Cantidad'];
    $old['Valor'] = $el['Valor'];
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
