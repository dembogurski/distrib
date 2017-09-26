<?php

/** Report prg file (stock_x_suc) 
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
$T->Set( 'sup_p_costo_prom', '9333.33');
$T->Set( 'sup_p_valmin', '11199.99');
$T->Set( 'sup_p_stock', '26.00');
$T->Set( 'sup_p_estado', 'Liberado');
$T->Set( 'sup_p_set_precios', '');
$T->Set( 'sup_p_cantidades', '');
$T->Set( 'sup_p_listas', '');
$T->Set( 'sup_p_cants', '');
$T->Set( 'sup_p_lock', 'true');
$T->Set( 'sup_f_open_sub', '');
$T->Set( 'sup_f_upper', '');
$T->Set( 'sup_f_doclick', 'true');
$T->Set( 'sup_f_lockum', '');

*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT s.codigo as Codigo,a.p_descrip as Descrip, a.p_um as UM,suc as Suc,cantidad as Cantidad FROM articulos a,stock s WHERE a.codigo  = s.codigo AND s.codigo = 'A00026'  GROUP BY suc";

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company );

$firstRow=true;
$Q0 = $DB;
$Q0->Query( $query0 );

$db = new Y_DB();

// Starting a HTML
$T->Show('general_header');			// Principal Header
$T->Show('start_query0');			// Start a Table 
$T->Show('header0');				// Show Header

//Define a  variable
$endConsult = false;
//Define a Total Variables

//Define a Subtotal Variables


//Define a Old Values Variables
$old['Codigo'] = '';
$old['Descrip'] = '';
$old['UM'] = '';
$old['Suc'] = '';
$old['Cantidad'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['Codigo'] = $Q0->Record['Codigo'];
    $el['Descrip'] = $Q0->Record['Descrip'];
    $el['UM'] = $Q0->Record['UM'];
    $el['Suc'] = $Q0->Record['Suc'];
    $el['Cantidad'] = $Q0->Record['Cantidad'];
    
    $um = $el['UM'];
    
    $um_option = "";
    
    $db->Query("SELECT u_cod,u_mult FROM um WHERE u_cod = '$um' OR u_ref = '$um' ORDER BY u_prior ASC ");
    while($db->NextRecord()){
        $u_cod = $db->Record['u_cod'];
        $u_mult = $db->Record['u_mult'];
        $um_option .= "<option value='$u_mult'>$u_cod</option>";
    }
    // Preparing a template variables
    $T->Set('query0_Codigo', $el['Codigo']);
    $T->Set('query0_Descrip', $el['Descrip']);
    $T->Set('query0_UM', $um_option);
    $T->Set('query0_Suc', $el['Suc']);
    $T->Set('query0_Cantidad', $el['Cantidad']);

    // Calculating a total

    // Calculating a subtotal

    $T->Show('query0_data_row');
    // Show Subtotal
    if( true ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
    }
    
    //Actualize Old Values Variables
    $old['Codigo'] = $el['Codigo'];
    $old['Descrip'] = $el['Descrip'];
    $old['UM'] = $el['UM'];
    $old['Suc'] = $el['Suc'];
    $old['Cantidad'] = $el['Cantidad'];
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
