<?php

/** Report prg file (presupuesto) 
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
$T->Set( 'sup_f_lock', 'true');
$T->Set( 'sup_f_nro', '8');
$T->Set( 'sup_f_usuario', 'Developer');
$T->Set( 'sup_f_fecha', '2014-10-07');
$T->Set( 'sup_f_b_cli', '');
$T->Set( 'sup_f_cli_cod', '10');
$T->Set( 'sup_f_cli_nombre', 'DOGLAS ANTONIO DEMBOGURSKI FEIX');
$T->Set( 'sup_f_cat', '4');
$T->Set( 'sup_f_edit_cli', '');
$T->Set( 'sup_f_cli_form', '');
$T->Set( 'sup_f_estado', 'Abierta');
$T->Set( 'sup_f_caja', '');
$T->Set( 'sup_f_presupuesto', '');
$T->Set( 'sup_f_gen', 'No');
$T->Set( 'sup_f_set_change', '');
$T->Set( 'sup_f_det', '');
$T->Set( 'sup_f_limit', '15');
$T->Set( 'sup_f_doclick', 'true');
$T->Set( 'sup_f_open_sub', '');
$T->Set( 'sup_f_cob_efectivo', '0.00');
$T->Set( 'sup_f_conv_cod', '0');
$T->Set( 'sup_f_monto_conv', '0.00');

*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT " " AS Nro,d_codigo AS Codigo,d_descrip AS Descrip,d_cant AS Cant,d_um AS Um,d_cant_v AS CantV,d_precio AS Precio,d_subtotal AS SubTotal  FROM fact_vent_det WHERE d_fact = '8' ";
require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company );

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

$fecha = date("d-m-Y");
$T->Set( 'fecha', $fecha );

$f_nro = $sup['f_nro'];
$db = new Y_DB();
$db->Database = $Global['project'];

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
$subtotal0_SubTotal = 0;


//Define a Old Values Variables
$old['Nro'] = '';
$old['Codigo'] = '';
$old['Descrip'] = '';
$old['Cant'] = '';
$old['Um'] = '';
$old['CantV'] = '';
$old['Precio'] = '';
$old['SubTotal'] = '';

$i = 0;
// Making a rows of consult
while( $Q0->NextRecord() ){
    $i++;
    // Define a elements
    $el['Nro'] = $Q0->Record['Nro'];
    $el['Codigo'] = $Q0->Record['Codigo'];
    $el['Descrip'] = $Q0->Record['Descrip'];
    $el['Cant'] = $Q0->Record['Cant'];
    $el['Um'] = $Q0->Record['Um'];
    $el['CantV'] = $Q0->Record['CantV'];
    $el['Precio'] = $Q0->Record['Precio'];
    $el['SubTotal'] = $Q0->Record['SubTotal'];

    // Preparing a template variables
    $T->Set('query0_Nro',$i); 
    $T->Set('query0_Codigo', $el['Codigo']);
    $T->Set('query0_Descrip', $el['Descrip']);
    $T->Set('query0_Cant', $el['Cant']);
    $T->Set('query0_Um', $el['Um']);
    $T->Set('query0_CantV', $el['CantV']);
    $T->Set('query0_Precio', $el['Precio']);
    $T->Set('query0_SubTotal', number_format($el['SubTotal'],0,',','.'));

    // Calculating a total

    // Calculating a subtotal
    $subtotal0_SubTotal += 0 + $el['SubTotal'];

    $T->Show('query0_data_row');
    // Show Subtotal
    $T->Set('subtotal0_SubTotal', number_format($subtotal0_SubTotal,2,',','.'));
    if( $endConsult ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_SubTotal = 0;
    }
    
    //Actualize Old Values Variables
    $old['Nro'] = $el['Nro'];
    $old['Codigo'] = $el['Codigo'];
    $old['Descrip'] = $el['Descrip'];
    $old['Cant'] = $el['Cant'];
    $old['Um'] = $el['Um'];
    $old['CantV'] = $el['CantV'];
    $old['Precio'] = $el['Precio'];
    $old['SubTotal'] = $el['SubTotal'];
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


$db->Query("update factura_venta set f_estado = 'Presupuesto' where f_nro = $f_nro;");

?>
