<?php

/** Report prg file (comport_cli) 
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
$T->Set( 'sup_f_b_cli', 'supe');
$T->Set( 'sup_f_cli_cod', '1045');
$T->Set( 'sup_desde', '2014-01-01');
$T->Set( 'sup_hasta', '2016-02-11');
$T->Set( 'sup_f_rep', '');
*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT CONCAT(g_nombre,"-",t_nombre) AS Articulo, SUM(IF(d_precio BETWEEN 0 AND 30000,d_subtotal,0)) AS 0_30 ,SUM(IF(d_precio BETWEEN 30001 AND 60000,d_subtotal,0)) AS  30_60 ,SUM(IF(d_precio BETWEEN 60001 AND 90000,d_subtotal,0)) AS  60_90 ,        SUM(IF(d_precio BETWEEN 90001 AND 120000,d_subtotal,0)) AS  90_120 ,        SUM(IF(d_precio BETWEEN 120001 AND 150000,d_subtotal,0)) AS  120_150 ,        SUM(IF(d_precio BETWEEN 150001 AND 200000,d_subtotal,0)) AS  150_200 ,        SUM(IF(d_precio BETWEEN 200001 AND 250000,d_subtotal,0)) AS  200_250 ,        SUM(IF(d_precio BETWEEN 250001 AND 300000,d_subtotal,0)) AS  250_300 ,   SUM(IF(d_precio BETWEEN 300001 AND 100000000,d_subtotal,0)) AS  300_INFINITO  FROM  factura_venta f, fact_vent_det d, productos p,sector s, grupo g,tipo t WHERE p.p_sector = s.s_cod AND f.f_nro = d.d_fact AND d.d_codigo = p.p_cod AND p.p_grupo = g.g_cod AND p.p_tipo = t.t_cod  AND f.f_estado = "Cerrada"  AND f.f_cli_cod = '1045'  AND f.f_fecha BETWEEN '2014-01-01' AND '2016-02-11' GROUP BY Articulo";

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

$desde = date_create($sup['desde']);
$desde = date_format($desde,"d-m-Y");

$hasta = date_create($sup['hasta']);
$hasta = date_format($hasta,"d-m-Y");

$T->Set('desde', $desde);
$T->Set('hasta', $hasta);

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
$subtotal0_0_30 = 0;
$subtotal0_30_60 = 0;
$subtotal0_60_90 = 0;
$subtotal0_90_120 = 0;
$subtotal0_120_150 = 0;
$subtotal0_150_200 = 0;
$subtotal0_200_250 = 0;
$subtotal0_250_300 = 0;
$subtotal0_300_INFINITO = 0;


//Define a Old Values Variables
$old['Articulo'] = '';
$old['0_30'] = '';
$old['30_60'] = '';
$old['60_90'] = '';
$old['90_120'] = '';
$old['120_150'] = '';
$old['150_200'] = '';
$old['200_250'] = '';
$old['250_300'] = '';
$old['300_INFINITO'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['Articulo'] = $Q0->Record['Articulo'];
    $el['0_30'] = $Q0->Record['0_30'];
    $el['30_60'] = $Q0->Record['30_60'];
    $el['60_90'] = $Q0->Record['60_90'];
    $el['90_120'] = $Q0->Record['90_120'];
    $el['120_150'] = $Q0->Record['120_150'];
    $el['150_200'] = $Q0->Record['150_200'];
    $el['200_250'] = $Q0->Record['200_250'];
    $el['250_300'] = $Q0->Record['250_300'];
    $el['300_INFINITO'] = $Q0->Record['300_INFINITO'];

    // Preparing a template variables
    $T->Set('query0_Articulo', $el['Articulo']);
    $T->Set('query0_0_30', number_format($el['0_30'],0,',','.'));
    $T->Set('query0_30_60', number_format($el['30_60'],0,',','.'));
    $T->Set('query0_60_90', number_format($el['60_90'],0,',','.'));
    $T->Set('query0_90_120', number_format($el['90_120'],0,',','.'));
    $T->Set('query0_120_150', number_format($el['120_150'],0,',','.'));
    $T->Set('query0_150_200', number_format($el['150_200'],0,',','.'));
    $T->Set('query0_200_250', number_format($el['200_250'],0,',','.'));
    $T->Set('query0_250_300', number_format($el['250_300'],0,',','.'));
    $T->Set('query0_300_INFINITO', number_format($el['300_INFINITO'],0,',','.'));

    // Calculating a total

    // Calculating a subtotal
    $subtotal0_0_30 += 0 + $el['0_30'];
    $subtotal0_30_60 += 0 + $el['30_60'];
    $subtotal0_60_90 += 0 + $el['60_90'];
    $subtotal0_90_120 += 0 + $el['90_120'];
    $subtotal0_120_150 += 0 + $el['120_150'];
    $subtotal0_150_200 += 0 + $el['150_200'];
    $subtotal0_200_250 += 0 + $el['200_250'];
    $subtotal0_250_300 += 0 + $el['250_300'];
    $subtotal0_300_INFINITO += 0 + $el['300_INFINITO'];

    $T->Show('query0_data_row');
    // Show Subtotal
    $T->Set('subtotal0_0_30', number_format($subtotal0_0_30,0,',','.'));
    $T->Set('subtotal0_30_60', number_format($subtotal0_30_60,0,',','.'));
    $T->Set('subtotal0_60_90', number_format($subtotal0_60_90,0,',','.'));
    $T->Set('subtotal0_90_120', number_format($subtotal0_90_120,0,',','.'));
    $T->Set('subtotal0_120_150', number_format($subtotal0_120_150,0,',','.'));
    $T->Set('subtotal0_150_200', number_format($subtotal0_150_200,0,',','.'));
    $T->Set('subtotal0_200_250', number_format($subtotal0_200_250,0,',','.'));
    $T->Set('subtotal0_250_300', number_format($subtotal0_250_300,0,',','.'));
    $T->Set('subtotal0_300_INFINITO', number_format($subtotal0_300_INFINITO,0,',','.'));
    if( $endConsult ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_0_30 = 0;
        $subtotal0_30_60 = 0;
        $subtotal0_60_90 = 0;
        $subtotal0_90_120 = 0;
        $subtotal0_120_150 = 0;
        $subtotal0_150_200 = 0;
        $subtotal0_200_250 = 0;
        $subtotal0_250_300 = 0;
        $subtotal0_300_INFINITO = 0;
    }
    
    //Actualize Old Values Variables
    $old['Articulo'] = $el['Articulo'];
    $old['0_30'] = $el['0_30'];
    $old['30_60'] = $el['30_60'];
    $old['60_90'] = $el['60_90'];
    $old['90_120'] = $el['90_120'];
    $old['120_150'] = $el['120_150'];
    $old['150_200'] = $el['150_200'];
    $old['200_250'] = $el['200_250'];
    $old['250_300'] = $el['250_300'];
    $old['300_INFINITO'] = $el['300_INFINITO'];
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
