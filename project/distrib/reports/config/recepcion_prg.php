<?php

/** Report prg file (recepcion) 
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
$T->Set( 'sup___lock', 'true');
$T->Set( 'sup_st', 'SV%');
$T->Set( 'sup_rep', '');

*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT p.id AS ID,pr.prov_nombre AS Proveedor,p_st AS StoreNum,p.p_cod AS Codigo, s.s_nombre AS Sector,g.g_nombre AS Grupo,t.t_nombre AS Tipo,c.color AS Color,  p_um AS Um,p_cant_compra AS Cant_Compra,p_cant AS Cant_Stock, p_descri AS Descrip,p_ancho AS Ancho, p_estado AS Estado, p_valmin,p_precio_1,p_precio_2,p_precio_3,p_precio_4   FROM factura_compra f, proveedores pr, productos p, sector s, grupo g,tipo t, colores c   WHERE f.c_ref = p.p_ref AND f.c_estado = "Abierta" AND f.c_prov = pr.prov_cod    AND p.p_sector = s.s_cod AND p.p_grupo = g.g_cod AND p.p_tipo = t.t_cod AND p.p_color = c.c_cod  AND p_st LIKE 'SV%'  ORDER BY p_st ASC, p_sector,p_grupo,p_tipo,p_color,p_descri";
require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company );

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

$firstRow=true;
$Q0 = $DB;

//echo $query0;

$Q0->Query( $query0 );

// Starting a HTML
$T->Show('general_header');			// Principal Header
$T->Show('start_query0');			// Start a Table 
$T->Show('header0');				// Show Header

//Define a  variable
$endConsult = false;
//Define a Total Variables

//Define a Subtotal Variables
$subtotal0_Cant_Compra = 0;
$subtotal0_Cant_Stock = 0;


//Define a Old Values Variables
$old['ID'] = '';
$old['Proveedor'] = '';
$old['StoreNum'] = '';
$old['Codigo'] = '';
$old['Sector'] = '';
$old['Grupo'] = '';
$old['Tipo'] = '';
$old['Color'] = '';
$old['Um'] = '';
$old['Cant_Compra'] = '';
$old['Cant_Stock'] = '';
$old['Descrip'] = '';
$old['Ancho'] = '';
$old['Estado'] = '';
$old['p_valmin'] = '';
$old['p_precio_1'] = '';
$old['p_precio_2'] = '';
$old['p_precio_3'] = '';
$old['p_precio_4'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['ID'] = $Q0->Record['ID'];
    $el['Proveedor'] = $Q0->Record['Proveedor'];
    $el['StoreNum'] = $Q0->Record['StoreNum'];
    $el['Codigo'] = $Q0->Record['Codigo'];
    $el['Sector'] = $Q0->Record['Sector'];
    $el['Grupo'] = $Q0->Record['Grupo'];
    $el['Tipo'] = $Q0->Record['Tipo'];
    $el['Color'] = $Q0->Record['Color'];
    $el['Um'] = $Q0->Record['Um'];
    $el['Cant_Compra'] = $Q0->Record['Cant_Compra'];
    $el['Cant_Stock'] = $Q0->Record['Cant_Stock'];
    $el['Descrip'] = $Q0->Record['Descrip'];
    $el['Ancho'] = $Q0->Record['Ancho'];
    $el['Estado'] = $Q0->Record['Estado'];
    $el['p_valmin'] = $Q0->Record['p_valmin'];
    $el['p_precio_1'] = $Q0->Record['p_precio_1'];
    $el['p_precio_2'] = $Q0->Record['p_precio_2'];
    $el['p_precio_3'] = $Q0->Record['p_precio_3'];
    $el['p_precio_4'] = $Q0->Record['p_precio_4'];

    // Preparing a template variables
    $T->Set('query0_ID', $el['ID']);
    $T->Set('query0_Proveedor', $el['Proveedor']);
    $T->Set('query0_StoreNum', $el['StoreNum']);
    $T->Set('query0_Codigo', $el['Codigo']);
    $T->Set('query0_Sector', $el['Sector']);
    $T->Set('query0_Grupo', $el['Grupo']);
    $T->Set('query0_Tipo', $el['Tipo']);
    $T->Set('query0_Color', $el['Color']);
    $T->Set('query0_Um', $el['Um']);
    $T->Set('query0_Cant_Compra', number_format($el['Cant_Compra'],0,',','.'));
    $T->Set('query0_Cant_Stock', number_format($el['Cant_Stock'],0,',','.'));
    $T->Set('query0_Descrip', $el['Descrip']);
    $T->Set('query0_Ancho', $el['Ancho']);
    $T->Set('query0_Estado', $el['Estado']);
    $T->Set('query0_p_valmin', $el['p_valmin']);
    $T->Set('query0_p_precio_1', $el['p_precio_1']);
    $T->Set('query0_p_precio_2', $el['p_precio_2']);
    $T->Set('query0_p_precio_3', $el['p_precio_3']);
    $T->Set('query0_p_precio_4', $el['p_precio_4']);

    // Calculating a total

    // Calculating a subtotal
    $subtotal0_Cant_Compra += 0 + $el['Cant_Compra'];
    $subtotal0_Cant_Stock += 0 + $el['Cant_Stock'];

    $T->Show('query0_data_row');
    // Show Subtotal
    $T->Set('subtotal0_Cant_Compra', number_format($subtotal0_Cant_Compra,2,',','.'));
    $T->Set('subtotal0_Cant_Stock', number_format($subtotal0_Cant_Stock,2,',','.'));
    if( $endConsult ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_Cant_Compra = 0;
        $subtotal0_Cant_Stock = 0;
    }
    
    //Actualize Old Values Variables
    $old['ID'] = $el['ID'];
    $old['Proveedor'] = $el['Proveedor'];
    $old['StoreNum'] = $el['StoreNum'];
    $old['Codigo'] = $el['Codigo'];
    $old['Sector'] = $el['Sector'];
    $old['Grupo'] = $el['Grupo'];
    $old['Tipo'] = $el['Tipo'];
    $old['Color'] = $el['Color'];
    $old['Um'] = $el['Um'];
    $old['Cant_Compra'] = $el['Cant_Compra'];
    $old['Cant_Stock'] = $el['Cant_Stock'];
    $old['Descrip'] = $el['Descrip'];
    $old['Ancho'] = $el['Ancho'];
    $old['Estado'] = $el['Estado'];
    $old['p_valmin'] = $el['p_valmin'];
    $old['p_precio_1'] = $el['p_precio_1'];
    $old['p_precio_2'] = $el['p_precio_2'];
    $old['p_precio_3'] = $el['p_precio_3'];
    $old['p_precio_4'] = $el['p_precio_4'];
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
