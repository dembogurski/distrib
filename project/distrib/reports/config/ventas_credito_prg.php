<?php

/** Report prg file (ventas_credito) 
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
$T->Set( 'sup_c_lock', 'true');
$T->Set( 'sup_c_busc', '%');
$T->Set( 'sup_c_cli_cod', '%');
$T->Set( 'sup_desde', '2014-06-23');
$T->Set( 'sup_hasta', '2016-06-23');
$T->Set( 'sup_estado', 'Pendiente');
$T->Set( 'sup_vp', 'Vista Previa');
$T->Set( 'sup_rep', '');
*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT f_nro AS Ref,f_fact_cont AS Factura,c_nro_cuota AS Nro_Cuota,b.cli_ci AS Ruc, b.cli_nombre AS Cliente,DATE_FORMAT(f_fecha,"%d-%m-%Y") AS Fecha,c_monto_ref AS ValorCuota,  DATE_FORMAT(c_venc,"%d-%m-%Y") AS Vencimiento,c_entrega AS Entrega,c_saldo AS Saldo,c_estado AS Estado     FROM factura_venta f, cuotas c, clientes b WHERE f.f_nro = c.c_fact AND f.f_cli_cod = b.cli_id  AND f.f_cli_cod LIKE '%'  AND c_venc BETWEEN '2014-06-23' AND '2016-06-23' and c.c_estado LIKE 'Pendiente'   AND f.f_estado = "Cerrada" ORDER BY Ref ASC ,c_nro_cuota ASC ";
$db = new Y_DB();
$Global['project'] = 'distrib';
$db->Database =   $Global['project'];
       
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
			// Show Header

//Define a  variable
$endConsult = false;
//Define a Total Variables

//Define a Subtotal Variables
$subtotal0_ValorCuota = 0;
$subtotal0_Entrega = 0;
$subtotal0_Saldo = 0;


//Define a Old Values Variables
$old['Ref'] = '';
$old['Factura'] = '';
$old['Nro_Cuota'] = '';
$old['Ruc'] = '';
$old['Cliente'] = '';
$old['Fecha'] = '';
$old['ValorCuota'] = '';
$old['Vencimiento'] = '';
$old['Entrega'] = '';
$old['Saldo'] = '';
$old['Estado'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['Ref'] = $Q0->Record['Ref'];
    $el['Factura'] = $Q0->Record['Factura'];
    $el['Nro_Cuota'] = $Q0->Record['Nro_Cuota'];
    $el['Ruc'] = $Q0->Record['Ruc'];
    $el['Cliente'] = $Q0->Record['Cliente'];
    $el['Fecha'] = $Q0->Record['Fecha'];
    $el['ValorCuota'] = $Q0->Record['ValorCuota'];
    $el['Vencimiento'] = $Q0->Record['Vencimiento'];
    $el['Entrega'] = $Q0->Record['Entrega'];
    $el['Saldo'] = $Q0->Record['Saldo'];
    $el['Estado'] = $Q0->Record['Estado'];
    
    $ref = $el['Ref'];
    $cuota = $el['Nro_Cuota'];
    
    if($old['Ruc']  != $el['Ruc']){
        $T->Set('query0_Ruc', $el['Ruc']);
        $T->Set('query0_Cliente', $el['Cliente']);
        $T->Show('cliente');
        $T->Show('header0');	
    }else{
        $T->Set('query0_Ruc', "");
        $T->Set('query0_Cliente', "");
    }
    // Preparing a template variables
    $T->Set('query0_Ref', $el['Ref']);
    $T->Set('query0_Factura', $el['Factura']);
    $T->Set('query0_Nro_Cuota', $el['Nro_Cuota']); 
    $T->Set('query0_Fecha', $el['Fecha']);
    $T->Set('query0_ValorCuota', number_format($el['ValorCuota'],0,',','.'));
    $T->Set('query0_Vencimiento', $el['Vencimiento']);
    $T->Set('query0_Entrega', number_format($el['Entrega'],0,',','.'));
    $T->Set('query0_Saldo', number_format($el['Saldo'],0,',','.'));
    $T->Set('query0_Estado', $el['Estado']);

    // Calculating a total

    // Calculating a subtotal
    $subtotal0_ValorCuota += 0 + $el['ValorCuota'];
    $subtotal0_Entrega += 0 + $el['Entrega'];
    $subtotal0_Saldo += 0 + $el['Saldo'];

    $T->Show('query0_data_row');
    
    $db->Query("SELECT  DATE_FORMAT(a_fecha,'%d-%m-%Y') AS fecha,a_comp,a_compl,a_saldo_ant,a_monto,a_saldo
    FROM amortizaciones WHERE a_fact = $ref AND a_cuota  = $cuota");
    
    while($db->NextRecord()){
        $a_fecha = $db->Record['fecha'];   
        $a_comp = $db->Record['a_comp'];   
        $a_compl = $db->Record['a_compl'];   
        $a_saldo_ant = $db->Record['a_saldo_ant'];   
        $a_monto = $db->Record['a_monto'];   
        $a_saldo = $db->Record['a_saldo']; 
        $T->Set('fecha', $a_fecha);
        $T->Set('comp', $a_comp);
        $T->Set('compl', $a_compl);
        $T->Set('saldo_ant', number_format($a_saldo_ant,0,',','.'));
        $T->Set('monto',number_format($a_monto,0,',','.'));
        $T->Set('saldo',number_format($a_saldo,0,',','.'));
        $T->Show('amort');
    }
            
    // Show Subtotal
    $T->Set('subtotal0_ValorCuota', number_format($subtotal0_ValorCuota,0,',','.'));
    $T->Set('subtotal0_Entrega', number_format($subtotal0_Entrega,0,',','.'));
    $T->Set('subtotal0_Saldo', number_format($subtotal0_Saldo,0,',','.'));
    if( $endConsult ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_ValorCuota = 0;
        $subtotal0_Entrega = 0;
        $subtotal0_Saldo = 0;
    }
    
    //Actualize Old Values Variables
    $old['Ref'] = $el['Ref'];
    $old['Factura'] = $el['Factura'];
    $old['Nro_Cuota'] = $el['Nro_Cuota'];
    $old['Ruc'] = $el['Ruc'];
    $old['Cliente'] = $el['Cliente'];
    $old['Fecha'] = $el['Fecha'];
    $old['ValorCuota'] = $el['ValorCuota'];
    $old['Vencimiento'] = $el['Vencimiento'];
    $old['Entrega'] = $el['Entrega'];
    $old['Saldo'] = $el['Saldo'];
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
