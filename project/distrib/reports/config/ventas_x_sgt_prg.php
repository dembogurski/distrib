<?php

/** Report prg file (ventas_x_sgt) 
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
$T->Set( 'sup_suc', '01');
$T->Set( 'sup_tipo', 'Ventas por Articulos');
$T->Set( 'sup_desde', '2012-09-15');
$T->Set( 'sup_hasta', '2015-09-15');
$T->Set( 'sup_rep0', '');
$T->Set( 'sup_codigo', '%');
$T->Set( 'sup_p_sector', '4');
$T->Set( 'sup_p_grupo', '12');
$T->Set( 'sup_p_tipo', '%');
$T->Set( 'sup_p_descri', '%');
$T->Set( 'sup_rep1', '');
$T->Set( 'sup___lock', 'true');
*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT p.p_cod AS Codigo, s.s_nombre AS Sector, g.g_nombre AS Grupo, t.t_nombre AS Tipo, p_descri AS Descrip,  d.d_cant_v AS CantVendida, d.d_precio AS PrecioVenta,d.d_subtotal AS Subtotal FROM productos p, factura_venta f, fact_vent_det d,sector s, grupo g, tipo t  WHERE p.p_cod like '%' and f.f_nro = d.d_fact AND p.p_cod = d.d_codigo AND p.p_sector = s.s_cod AND p.p_grupo = g.g_cod AND p.p_tipo = t.t_cod AND f.f_fecha BETWEEN '2012-09-15' AND '2015-09-15' AND p.p_sector = '4' AND p.p_grupo LIKE '12' AND p.p_tipo LIKE '%'  AND p.p_descri LIKE '%' AND f.f_suc LIKE '01'  ";

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company );
 
$suc = $sup['suc'];
$desde = $sup['desde'];
$hasta = $sup['hasta'];
$codigo = $sup['codigo'];
$sector = $sup['p_sector'];
$grupo = $sup['p_grupo'];
$tipo = $sup['p_tipo'];
$descrip = $sup['p_descri'];


if($codigo != "%" && $codigo != "" ){
    
    $query0 = "SELECT p.p_cod AS Codigo,f.f_nro as Factura,date_format(f.f_fecha,'%d-%m-%Y') as Fecha, s.s_nombre AS Sector, g.g_nombre AS Grupo, t.t_nombre AS Tipo, p_descri AS Descrip,  "
        . "d.d_cant_v AS CantVendida, d.d_precio AS PrecioVenta,d.d_subtotal AS Subtotal FROM productos p, factura_venta f, "
        . "fact_vent_det d,sector s, grupo g, tipo t  WHERE p.p_cod like '$codigo' and f.f_nro = d.d_fact AND p.p_cod = d.d_codigo"
        . " AND p.p_sector = s.s_cod AND p.p_grupo = g.g_cod AND p.p_tipo = t.t_cod AND f.f_fecha BETWEEN "
        . "'$desde' AND '$hasta'";
}else{
    $query0 = "SELECT p.p_cod AS Codigo,f.f_nro as Factura,date_format(f.f_fecha,'%d-%m-%Y') as Fecha, s.s_nombre AS Sector, g.g_nombre AS Grupo, t.t_nombre AS Tipo, p_descri AS Descrip,  "
        . "d.d_cant_v AS CantVendida, d.d_precio AS PrecioVenta,d.d_subtotal AS Subtotal FROM productos p, factura_venta f, "
        . "fact_vent_det d,sector s, grupo g, tipo t  WHERE f.f_nro = d.d_fact AND p.p_cod = d.d_codigo"
        . " AND p.p_sector = s.s_cod AND p.p_grupo = g.g_cod AND p.p_tipo = t.t_cod AND f.f_fecha BETWEEN "
        . "'$desde' AND '$hasta' AND p.p_sector = '$sector' AND p.p_grupo LIKE '$grupo' AND p.p_tipo LIKE '$tipo'  "
        . "AND p.p_descri LIKE '$descrip' AND f.f_suc LIKE '$suc'  ";
}

//echo $query0;

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
$subtotal0_CantVendida = 0;
$subtotal0_PrecioVenta = 0;
$subtotal0_Subtotal = 0;


//Define a Old Values Variables
$old['Codigo'] = '';
$old['Factura'] = '';
$old['Fecha'] = '';
$old['Sector'] = '';
$old['Grupo'] = '';
$old['Tipo'] = '';
$old['Descrip'] = '';
$old['CantVendida'] = '';
$old['PrecioVenta'] = '';
$old['Subtotal'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['Codigo'] = $Q0->Record['Codigo'];
    $el['Factura'] = $Q0->Record['Factura'];
    $el['Fecha'] = $Q0->Record['Fecha'];
    $el['Sector'] = $Q0->Record['Sector'];
    $el['Grupo'] = $Q0->Record['Grupo'];
    $el['Tipo'] = $Q0->Record['Tipo'];
    $el['Descrip'] = $Q0->Record['Descrip'];
    $el['CantVendida'] = $Q0->Record['CantVendida'];
    $el['PrecioVenta'] = $Q0->Record['PrecioVenta'];
    $el['Subtotal'] = $Q0->Record['Subtotal'];

    // Preparing a template variables
    $T->Set('query0_Codigo', $el['Codigo']); 
    $T->Set('query0_Fecha', $el['Fecha']);
    $T->Set('query0_Factura', $el['Factura']);
    $T->Set('query0_Sector', $el['Sector']);
    $T->Set('query0_Grupo', $el['Grupo']);
    $T->Set('query0_Tipo', $el['Tipo']);
    $T->Set('query0_Descrip', $el['Descrip']);
    $T->Set('query0_CantVendida', number_format($el['CantVendida'],2,',','.'));
    $T->Set('query0_PrecioVenta', number_format($el['PrecioVenta'],0,',','.'));
    $T->Set('query0_Subtotal', number_format($el['Subtotal'],0,',','.'));

    // Calculating a total

    // Calculating a subtotal
    $subtotal0_CantVendida += 0 + $el['CantVendida'];
    $subtotal0_PrecioVenta += 0 + $el['PrecioVenta'];
    $subtotal0_Subtotal += 0 + $el['Subtotal'];

    $T->Show('query0_data_row');
    // Show Subtotal
    $T->Set('subtotal0_CantVendida', number_format($subtotal0_CantVendida,2,',','.'));
    $T->Set('subtotal0_PrecioVenta', number_format($subtotal0_PrecioVenta,2,',','.'));
    $T->Set('subtotal0_Subtotal', number_format($subtotal0_Subtotal,2,',','.'));
    if( $endConsult ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_CantVendida = 0;
        $subtotal0_PrecioVenta = 0;
        $subtotal0_Subtotal = 0;
    }
    
    //Actualize Old Values Variables
    $old['Codigo'] = $el['Codigo'];
    $old['Factura'] = $el['Factura'];
    $old['Fecha'] = $el['Fecha'];
    $old['Sector'] = $el['Sector'];
    $old['Grupo'] = $el['Grupo'];
    $old['Tipo'] = $el['Tipo'];
    $old['Descrip'] = $el['Descrip'];
    $old['CantVendida'] = $el['CantVendida'];
    $old['PrecioVenta'] = $el['PrecioVenta'];
    $old['Subtotal'] = $el['Subtotal'];
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
