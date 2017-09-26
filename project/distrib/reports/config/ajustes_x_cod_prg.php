<?php

/** Report prg file (ajustes_x_cod) 
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
$T->Set( 'sup_p_cod', '1363');
$T->Set( 'sup_p_descri', 'SILVER-TUL-LISO-BLANCO');
$T->Set( 'sup_p_ump', 'MTS');
$T->Set( 'sup_p_cant_c', '27.00');
$T->Set( 'sup_p_stock', '27.00');
$T->Set( 'sup_p_compra', '15579.30');
$T->Set( 'sup_p_valmin', '24926.88');
$T->Set( 'sup___lock', 'true');
$T->Set( 'sup_p_hist_ventas', '');
$T->Set( 'sup_p_ajustes', '');
*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT aj_prod AS Codigo,DATE_FORMAT( aj_fecha,"%d-%m-%Y") AS Fecha,aj_hora AS Hora, aj_usuario AS Usuario, aj_oper AS Oper,aj_signo AS Signo,aj_inicial AS Inicial,  IF(aj_signo != "-",aj_ajuste,0) AS Aj_Positivo,IF(aj_signo = "-",aj_ajuste,0) AS Aj_Negativo, aj_final AS Final,  aj_motivo AS Motivo  FROM ajustes WHERE aj_prod = '1363'";

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
$subtotal0_Aj_Positivo = 0;
$subtotal0_Aj_Negativo = 0;


//Define a Old Values Variables
$old['Codigo'] = '';
$old['Fecha'] = '';
$old['Hora'] = '';
$old['Usuario'] = '';
$old['Oper'] = '';
$old['Signo'] = '';
$old['Inicial'] = '';
$old['Aj_Positivo'] = '';
$old['Aj_Negativo'] = '';
$old['Final'] = '';
$old['Motivo'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['Codigo'] = $Q0->Record['Codigo'];
    $el['Fecha'] = $Q0->Record['Fecha'];
    $el['Hora'] = $Q0->Record['Hora'];
    $el['Usuario'] = $Q0->Record['Usuario'];
    $el['Oper'] = $Q0->Record['Oper'];
    $el['Signo'] = $Q0->Record['Signo'];
    $el['Inicial'] = $Q0->Record['Inicial'];
    $el['Aj_Positivo'] = $Q0->Record['Aj_Positivo'];
    $el['Aj_Negativo'] = $Q0->Record['Aj_Negativo'];
    $el['Final'] = $Q0->Record['Final'];
    $el['Motivo'] = $Q0->Record['Motivo'];

    // Preparing a template variables
    $T->Set('query0_Codigo', $el['Codigo']);
    $T->Set('query0_Fecha', $el['Fecha']);
    $T->Set('query0_Hora', $el['Hora']);
    $T->Set('query0_Usuario', $el['Usuario']);
    $T->Set('query0_Oper', $el['Oper']);
    $T->Set('query0_Signo', $el['Signo']);
    $T->Set('query0_Inicial', $el['Inicial']);
    $T->Set('query0_Aj_Positivo', number_format($el['Aj_Positivo'],2,',','.'));
    $T->Set('query0_Aj_Negativo', number_format($el['Aj_Negativo'],2,',','.'));
    $T->Set('query0_Final', $el['Final']);
    $T->Set('query0_Motivo', $el['Motivo']);

    // Calculating a total

    // Calculating a subtotal
    $subtotal0_Aj_Positivo += 0 + $el['Aj_Positivo'];
    $subtotal0_Aj_Negativo += 0 + $el['Aj_Negativo'];

    $T->Show('query0_data_row');
    // Show Subtotal
    $T->Set('subtotal0_Aj_Positivo', number_format($subtotal0_Aj_Positivo,2,',','.'));
    $T->Set('subtotal0_Aj_Negativo', number_format($subtotal0_Aj_Negativo,2,',','.'));
    if( $endConsult ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_Aj_Positivo = 0;
        $subtotal0_Aj_Negativo = 0;
    }
    
    //Actualize Old Values Variables
    $old['Codigo'] = $el['Codigo'];
    $old['Fecha'] = $el['Fecha'];
    $old['Hora'] = $el['Hora'];
    $old['Usuario'] = $el['Usuario'];
    $old['Oper'] = $el['Oper'];
    $old['Signo'] = $el['Signo'];
    $old['Inicial'] = $el['Inicial'];
    $old['Aj_Positivo'] = $el['Aj_Positivo'];
    $old['Aj_Negativo'] = $el['Aj_Negativo'];
    $old['Final'] = $el['Final'];
    $old['Motivo'] = $el['Motivo'];
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
