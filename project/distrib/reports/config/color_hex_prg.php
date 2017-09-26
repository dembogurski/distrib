<?php

/** Report prg file (color_hex) 
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
$T->Set( 'sup_c_cod', '10');
$T->Set( 'sup_color', 'Amarillo 3');
$T->Set( 'sup_hex', 'CDCD00');
$T->Set( 'sup_gen_code', '');
*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "select 1 as hexa";

require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company );

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


//Define a Old Values Variables
$old['hexa'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['hexa'] = $Q0->Record['hexa'];

    // Preparing a template variables
    $T->Set('query0_hexa', $el['hexa']);

    // Calculating a total

    // Calculating a subtotal

    $T->Show('query0_data_row');
    // Show Subtotal
    if( true ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
    }
    
    //Actualize Old Values Variables
    $old['hexa'] = $el['hexa'];
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
