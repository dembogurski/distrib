<?php

/** Report prg file (porc_cont_cred) 
 *  
 *  Dynamically created by ycube plus RAD
 *  
 *  USE THIS FILE TO PERSONALIZE A PROGRAM SIDE OF YOUR REPORT
 *  ==========================================================
 */  

 /**
// ATTENTION: CANCEL THIS BLOCK TO EDIT A FILE 
$T = new Y_Template( $file_tpl ); 
// Superior Variables
$T->Set( 'sup_c_lock', 'true');
$T->Set( 'sup_c_busc', 'supe');
$T->Set( 'sup_c_cli_cod', '1045');
$T->Set( 'sup_desde', '2015-01-13');
$T->Set( 'sup_hasta', '2016-07-13');
$T->Set( 'sup_tipo', 'Porcentaje Contado Vs Credito');
$T->Set( 'sup_estado', '%');
$T->Set( 'sup_vp', 'Vista Previa');
$T->Set( 'sup_rep', '');
$T->Set( 'sup_rep_p', '');

*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT c.cli_nombre AS Cliente, DATE_FORMAT(f_fecha, "%d-%m-%Y") AS Fecha, SUM(IF(f_cob_efectivo IS NOT NULL,f_cob_efectivo,0)) AS Contado,SUM(IF(c_monto_ref IS NOT NULL,c_monto_ref,0)) AS Financiado  FROM factura_venta f INNER JOIN clientes c ON f.f_cli_cod = c.cli_id LEFT JOIN cuotas ct ON f.f_nro = ct.c_fact WHERE f.f_estado = "Cerrada" and f.f_fecha between '2015-01-13' and '2016-07-13' and c.cli_id like '1045'  GROUP BY Cliente, Fecha ORDER BY  cli_id asc, f_fecha asc";

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

$desde = date("d-m-Y", strtotime($sup['desde']));
$T->Set( 'desde', $desde );
$hasta = date("d-m-Y", strtotime($sup['hasta']));
$T->Set( 'hasta', $hasta );

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
$total0_Contado = 0;
$total0_Financiado = 0;

//Define a Subtotal Variables
$subtotal0_Contado = 0;
$subtotal0_Financiado = 0;
$TOTAL = 0;
$TOTAL_GENERAL = 0;


//Define a Old Values Variables
$old['Cliente'] = '';
$old['Fecha'] = '';
$old['Contado'] = '';
$old['Financiado'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['Cliente'] = $Q0->Record['Cliente'];
    $el['Fecha'] = $Q0->Record['Fecha'];
    $el['Contado'] = $Q0->Record['Contado'];
    $el['Financiado'] = $Q0->Record['Financiado'];
    
    $hash = md5($el['Cliente']);
    
    if( $el['Cliente']!=$old['Cliente']&&$old['Cliente']!='' ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_Contado = 0;
        $subtotal0_Financiado = 0;
        $TOTAL = 0;
    }

    // Preparing a template variables
    $T->Set('query0_Cliente', $el['Cliente']);
    $T->Set('query0_Fecha', $el['Fecha']);
    $T->Set('query0_Contado', number_format($el['Contado'],2,',','.'));
    $T->Set('query0_Financiado', number_format($el['Financiado'],2,',','.'));
    $T->Set('hash', $hash);

    // Calculating a total
    $total0_Contado += 0 + $el['Contado'];
    $total0_Financiado += 0 + $el['Financiado'];

    // Calculating a subtotal
    $subtotal0_Contado += 0 + $el['Contado'];
    $subtotal0_Financiado += 0 + $el['Financiado'];
    $TOTAL = $subtotal0_Contado + $subtotal0_Financiado;
    $TOTAL_GENERAL += 0 + $el['Contado'] + $el['Financiado'];

    $T->Show('query0_data_row');
    // Show Subtotal
    $T->Set('subtotal0_Contado', number_format($subtotal0_Contado,2,',','.'));
    $T->Set('subtotal0_Financiado', number_format($subtotal0_Financiado,2,',','.'));
    $T->Set('subtotal0', number_format($TOTAL,2,',','.'));
    
    $T->Set('porc_Contado', number_format(($subtotal0_Contado * 100) /  $TOTAL ,1,',','.'));
    $T->Set('porc_Financiado', number_format(($subtotal0_Financiado * 100) /  $TOTAL ,1,',','.'));
    
    //Actualize Old Values Variables
    $old['Cliente'] = $el['Cliente'];
    $old['Fecha'] = $el['Fecha'];
    $old['Contado'] = $el['Contado'];
    $old['Financiado'] = $el['Financiado'];
    $firstRow=false;

}

$endConsult = true;
if( $el['Cliente']!=$old['Cliente'] ){
    $T->Show('query0_subtotal_row');
}
// Show total
$T->Set('total0_Contado', number_format($total0_Contado,2,',','.'));
$T->Set('total0_Financiado', number_format($total0_Financiado,2,',','.'));

if( endConsult ){
    $T->Show('query0_subtotal_row');
    $T->Set('total0', number_format($TOTAL_GENERAL,2,',','.'));
    $T->Set('porc_total_Contado', number_format(($total0_Contado * 100) /  $TOTAL_GENERAL ,1,',','.'));
    $T->Set('porc_total_Financiado', number_format(($total0_Financiado * 100) /  $TOTAL_GENERAL ,1,',','.'));
    $T->Show('query0_total_row');
}
$T->Show('end_query0');				// Ends a Table 

?>
