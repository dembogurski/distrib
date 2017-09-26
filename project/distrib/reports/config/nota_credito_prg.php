<?php

/** Report prg file (nota_credito) 
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
$T->Set( 'sup_n_lock', 'true');
$T->Set( 'sup_n_nro', '17');
$T->Set( 'sup_n_usuario', 'Developer');
$T->Set( 'sup_n_fecha', '2015-11-06');
$T->Set( 'sup_n_b_cli', 'liz ca');
$T->Set( 'sup_n_cli_cod', '24');
$T->Set( 'sup_n_cli_nombre', 'LIZ CARMEN DOMINGA VELAZQUEZ DENIS');
$T->Set( 'sup_n_cat', '1');
$T->Set( 'sup_n_edit_cli', '');
$T->Set( 'sup_n_cli_form', '');
$T->Set( 'sup_n_estado', 'Cerrada');
$T->Set( 'sup_n_imprimir', '');
$T->Set( 'sup_n_factura', '24');
$T->Set( 'sup_n_gen', 'Si');
$T->Set( 'sup_n_set_change', '4');
$T->Set( 'sup_n_det', '');
$T->Set( 'sup_n_limit', '15');
$T->Set( 'sup_n_doclick', 'true');
$T->Set( 'sup_n_open_sub', '');
$T->Set( 'sup_n_cob_efectivo', '0.00');
$T->Set( 'sup_n_conv_cod', '0');
$T->Set( 'sup_n_monto_conv', '0.00');
$T->Set( 'sup_n_moneda', '');
$T->Set( 'sup_n_fact_cont', '0');
$T->Set( 'sup_n_lock_anul', 'true');
$T->Set( 'sup_n_voucher', '');
$T->Set( 'sup_n_suc', '');
$T->Set( 'sup_n_cant_filas', '0');
$T->Set( 'sup_n_enable_delete', 'true');
$T->Set( 'sup_n_tipo', 'Contado');

*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "select d_fact as Factura,d_codigo as Codigo,d_descrip as Descrip,d_cant_dv as Cantidad,d_precio as Precio,d_subtotal as SubTotal  FROM nota_credito_det where d_fact = '17'";
$Q0 = $DB;
$fecha = substr($sup['n_fecha'],8,2).'-'.substr($sup['n_fecha'],5,2).'-'.substr($sup['n_fecha'],0,4);
 
require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company ); 
 
$T->Set('fecha',$fecha);

$cli_cod = $sup['n_cli_cod'];
$Q0->Query( "SELECT cli_ci AS RUC FROM clientes WHERE cli_id = '$cli_cod'" ); 
$Q0->NextRecord();
$ruc = $Q0->Record['RUC'];
$T->Set( 'ruc', $ruc );

$nro_nota = $sup['n_nro'];

$Q0->Query( "SELECT n_estado AS Estado FROM nota_credito WHERE n_nro = $nro_nota" ); 
$Q0->NextRecord();
$estado = $Q0->Record['Estado'];
if($estado == 'Abierta'){ // Sumar al Stock 
   $Q0->Query( " UPDATE nota_credito_det d, productos p SET p_cant = p_cant + d_cant_dv WHERE d.d_codigo = p.p_cod AND d.d_fact =  $nro_nota" ); 
   $Q0->Query( " UPDATE nota_credito set n_estado = 'Cerrada' WHERE n_nro = $nro_nota");
}

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

$firstRow=true;

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
$old['Factura'] = '';
$old['Codigo'] = '';
$old['Descrip'] = '';
$old['Cantidad'] = '';
$old['Precio'] = '';
$old['SubTotal'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['Factura'] = $Q0->Record['Factura'];
    $el['Codigo'] = $Q0->Record['Codigo'];
    $el['Descrip'] = $Q0->Record['Descrip'];
    $el['Cantidad'] = $Q0->Record['Cantidad'];
    $el['Precio'] = $Q0->Record['Precio'];
    $el['SubTotal'] = $Q0->Record['SubTotal'];

    // Preparing a template variables
    $T->Set('query0_Factura', $el['Factura']);
    $T->Set('query0_Codigo', $el['Codigo']);
    $T->Set('query0_Descrip', $el['Descrip']);
    $T->Set('query0_Cantidad', $el['Cantidad']);
    $T->Set('query0_Precio', $el['Precio']);
    $T->Set('query0_SubTotal', number_format($el['SubTotal'],0,',','.'));

    // Calculating a total

    // Calculating a subtotal
    $subtotal0_SubTotal += 0 + $el['SubTotal'];

    $T->Show('query0_data_row');
    // Show Subtotal
    $T->Set('subtotal0_SubTotal', number_format($subtotal0_SubTotal,0,',','.'));
    if( $endConsult ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_SubTotal = 0;
    }
    
    //Actualize Old Values Variables
    $old['Factura'] = $el['Factura'];
    $old['Codigo'] = $el['Codigo'];
    $old['Descrip'] = $el['Descrip'];
    $old['Cantidad'] = $el['Cantidad'];
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

?>
