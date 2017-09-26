<?php

/** Report prg file (def_lista_prec) 
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
$T->Set( 'sup_codigo', 'A00026');
$T->Set( 'sup_p_barcode', '');
$T->Set( 'sup_p_sector', '');
$T->Set( 'sup_p_grupo', '');
$T->Set( 'sup_p_tipo', '');
$T->Set( 'sup_p_sectorn', '__NO DATA__');
$T->Set( 'sup_p_grupon', '__NO DATA__');
$T->Set( 'sup_p_tipon', '__NO DATA__');
$T->Set( 'sup_p_descrip', 'SABONETE NATURA HOMEN 3 UNID');
$T->Set( 'sup_p_um', 'UNID');
$T->Set( 'sup_p_costo_prom', '0.00');
$T->Set( 'sup_p_valmin', '0.00');
$T->Set( 'sup_p_stock', '0.00');
$T->Set( 'sup_p_estado', 'Liberado');
$T->Set( 'sup_p_set_precios', '');
$T->Set( 'sup_p_listas', '');
$T->Set( 'sup_p_cants', '');
$T->Set( 'sup_p_lock', 'true');
$T->Set( 'sup_f_open_sub', '');
$T->Set( 'sup_f_open_sub_st', '');
$T->Set( 'sup_f_doclick', 'true');
$T->Set( 'sup_f_upper', '');
*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT codigo,num,precio_unit FROM lista_precios WHERE codigo = 'A00026' ";

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

$firstRow=true;
$Q0 = $DB;

$codigo = $sup['codigo'];

$Q0->Query("SELECT calc_precio_promedio('$codigo') AS COSTO_PROMEDIO,valor AS PORC_VALMIN FROM parametros WHERE clave = 'porc_val_min'");
$Q0->NextRecord();

$COSTO_PROMEDIO =  $Q0->Record['COSTO_PROMEDIO'];
$PORC_VALMIN =  $Q0->Record['PORC_VALMIN'];

$T->Set( 'COSTO_PROMEDIO',number_format($COSTO_PROMEDIO,2,',','.') );  
$T->Set( 'PORC_VALMIN',number_format($COSTO_PROMEDIO + (( $COSTO_PROMEDIO * $PORC_VALMIN) / 100)   ,2,',','.') );  

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
$old['codigo'] = '';
$old['num'] = '';
$old['precio_unit'] = '';
$old['valor'] = '';


// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['codigo'] = $Q0->Record['codigo'];
    $el['num'] = $Q0->Record['num'];
    $el['precio_unit'] = $Q0->Record['precio_unit'];
    $el['valor'] = $Q0->Record['valor'];

    // Preparing a template variables
    $T->Set('query0_codigo', $el['codigo']);
    $T->Set('query0_num', $el['num']);
    $T->Set('query0_precio_unit', $el['precio_unit']);
    $T->Set('query0_valor', $el['valor']);

    // Calculating a total

    // Calculating a subtotal

    $T->Show('query0_data_row');
    // Show Subtotal
    if( true ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
    }
    
    //Actualize Old Values Variables
    $old['codigo'] = $el['codigo'];
    $old['num'] = $el['num'];
    $old['precio_unit'] = $el['precio_unit'];
    $old['valor'] = $el['valor'];
    $firstRow=false;

}

$endConsult = true;
 
$T->Show('end_query0');				// Ends a Table 

?>
