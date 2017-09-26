<?php

/** Report prg file (mov_caja) 
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
$T->Set( 'sup_nro_caja', '3');
$T->Set( 'sup_desde', '2009-10-10');
$T->Set( 'sup_hasta', '2009-10-16');
$T->Set( 'sup_rep', '');
$T->Set( 'sup___lock', 'true');*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "select id as ID, DATE_FORMAT( __date,"%d-%m-%Y")   as FECHA,__user as USUARIO,__moneda as MONEDA, __cotiz AS COTIZ, monto as MONTO,concepto as CONCOPTO, compl as COMPLEMENTO, entrada_ref as E_REF, salida_ref as S_REF from caja_mov where cj_ref_chi = '3' and __date BETWEEN '2009-10-10' and '2009-10-16' order by id asc ";
require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company );

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

$desde = $sup['desde'];
$hasta = $sup['hasta'];
$data_ini = substr($sup['desde'],8,2).'-'.substr($sup['desde'],5,2).'-'.substr($sup['desde'],0,4);
$data_fin = substr($sup['hasta'],8,2).'-'.substr($sup['hasta'],5,2).'-'.substr($sup['hasta'],0,4);
$T->Set('desde',$data_ini);
$T->Set('hasta',$data_fin);

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
$subtotal0_E_REF = 0;
$subtotal0_S_REF = 0;


//Define a Old Values Variables
$old['ID'] = '';
$old['FECHA'] = '';
$old['USUARIO'] = '';
$old['MONEDA'] = '';
$old['COTIZ'] = '';
$old['MONTO'] = '';
$old['CONCOPTO'] = '';
$old['COMPLEMENTO'] = '';
$old['E_REF'] = '';
$old['S_REF'] = '';

$SALDO = 0;


$id = 0;

// Making a rows of consult
while( $Q0->NextRecord() ){
    $id++;
    // Define a elements
    $el['ID'] = $Q0->Record['ID'];
    $el['FECHA'] = $Q0->Record['FECHA'];
    $el['USUARIO'] = $Q0->Record['USUARIO'];
    $el['MONEDA'] = $Q0->Record['MONEDA'];
    $el['COTIZ'] = $Q0->Record['COTIZ'];
    $el['MONTO'] = $Q0->Record['MONTO'];
    $el['CONCOPTO'] = $Q0->Record['CONCOPTO'];
    $el['COMPLEMENTO'] = $Q0->Record['COMPLEMENTO'];
    $el['E_REF'] = $Q0->Record['E_REF'];
    $el['S_REF'] = $Q0->Record['S_REF'];

    // Preparing a template variables
    $T->Set('query0_ID', $id);
    $T->Set('query0_FECHA', $el['FECHA']);
    $T->Set('query0_USUARIO', $el['USUARIO']);
    $T->Set('query0_MONEDA', $el['MONEDA']);
    $T->Set('query0_COTIZ', $el['COTIZ']);
    $T->Set('query0_MONTO',number_format( $el['MONTO'],0,',','.'));  
    $T->Set('query0_CONCOPTO', $el['CONCOPTO']);
    $T->Set('query0_COMPLEMENTO', $el['COMPLEMENTO']);
    $T->Set('query0_E_REF', number_format($el['E_REF'],0,',','.'));  
    $T->Set('query0_S_REF', number_format($el['S_REF'],0,',','.'));  
	$T->Set('S_M', number_format($el['E_REF'] - $el['S_REF']  + $SALDO, 0,',','.'));  
    $SALDO =  $el['E_REF'] - $el['S_REF']  + $SALDO;
    // Calculating a total

    // Calculating a subtotal
    $subtotal0_E_REF += 0 + $el['E_REF'];
    $subtotal0_S_REF += 0 + $el['S_REF'];
    
    $dif =  $subtotal0_E_REF   -  $subtotal0_S_REF;

    $zebra = $id % 2;
    $T->Set('fondo',"zebra$zebra");

    $T->Show('query0_data_row');
    // Show Subtotal
    $T->Set('subtotal0_E_REF', number_format($subtotal0_E_REF,0,',','.'));
    $T->Set('subtotal0_S_REF', number_format($subtotal0_S_REF,0,',','.'));
    $T->Set('dif', number_format($dif ,0,',','.')) ;
    if( $endConsult ){
      
    
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_E_REF = 0;
        $subtotal0_S_REF = 0;
    }
    
    //Actualize Old Values Variables
    $old['ID'] = $el['ID'];
    $old['FECHA'] = $el['FECHA'];
    $old['USUARIO'] = $el['USUARIO'];
    $old['MONEDA'] = $el['MONEDA'];
    $old['COTIZ'] = $el['COTIZ'];
    $old['MONTO'] = $el['MONTO'];
    $old['CONCOPTO'] = $el['CONCOPTO'];
    $old['COMPLEMENTO'] = $el['COMPLEMENTO'];
    $old['E_REF'] = $el['E_REF'];
    $old['S_REF'] = $el['S_REF'];
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

if( $sup['vp'] === 'Imprimir'){
   echo "<script> self:print()  </script>";
}

?>
