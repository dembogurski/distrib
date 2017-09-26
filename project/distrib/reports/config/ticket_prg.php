<?php

/** Report prg file (ticket) 
 *  
 *  Dynamically created by ycube plus RAD
 *  
 *  USE THIS FILE TO PERSONALIZE A PROGRAM SIDE OF YOUR REPORT
 *  ==========================================================
 */  
/*
// ATTENTION: CANCEL THIS BLOCK TO EDIT A FILE 
$T = new Y_Template( $file_tpl ); 
// Superior Variables
$T->Set( 'sup_f_lock', 'true');
$T->Set( 'sup_f_tipo_doc', '3');
$T->Set( 'sup_f_nro', '61');
$T->Set( 'sup_f_usuario', 'Developer');
$T->Set( 'sup_f_fecha', '2017-05-25');
$T->Set( 'sup_f_b_cli', '');
$T->Set( 'sup_f_cli_cod', '1');
$T->Set( 'sup_f_cli_nombre', 'ANONIMO');
$T->Set( 'sup_f_cat', '1');
$T->Set( 'sup_f_edit_cli', '');
$T->Set( 'sup_f_cli_form', '');
$T->Set( 'sup_f_estado', 'Abierta');
$T->Set( 'sup_f_ticket', '');
$T->Set( 'sup_f_caja', '');
$T->Set( 'sup_f_enviar_caja', 'false');
$T->Set( 'sup_f_presupuesto', '');
$T->Set( 'sup_f_motivo_anul', '');
$T->Set( 'sup_f_gen', 'No');
$T->Set( 'sup_f_set_change', '');
$T->Set( 'sup_f_det', '');
$T->Set( 'sup_f_limit', '15');
$T->Set( 'sup_f_doclick', 'true');
$T->Set( 'sup_f_open_sub', '');
$T->Set( 'sup_f_cob_efectivo', '0.00');
$T->Set( 'sup_f_conv_cod', '0');
$T->Set( 'sup_f_monto_conv', '0.00');
$T->Set( 'sup_f_moneda', '');
$T->Set( 'sup_f_fact_cont', '0');
$T->Set( 'sup_f_lock_anul', 'true');
$T->Set( 'sup_f_voucher', '');
$T->Set( 'sup_f_suc', '01');
$T->Set( 'sup_f_cant_filas', '3');
$T->Set( 'sup_f_enable_delete', 'true');
$T->Set( 'sup_f_cerrar', '');
$T->Set( 'sup_f_tipo', 'Contado');
// ------------------------------------------
*/
// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT d_codigo,d_descrip,d_cant,d_um,d_subtotal FROM fact_vent_det WHERE d_fact = '61' ";

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

$cliente = $sup['f_cli_nombre'];
$date = date("d-m-Y");

$factura = $sup['f_nro'];


$firstRow=true;
$Q0 = $DB;
$Q0->Query( $query0 );

$endConsult = false;

$old['d_codigo'] = '';
$old['d_descrip'] = '';
$old['d_cant'] = '';
$old['d_um'] = '';
$old['d_subtotal'] = '';
$old['d_precio'] = '';



//+---------------- Cabecera --------------------+//
 
$add = $add."+---------- Comercial Ocampos ---------+\n<br>";

$add = $add. "Nro: $factura    Fecha: $date  \n<br>"; 
 
$add = $add."Cliente:  $cliente\n<br>"; 

$add = $add."+----------------".date("H:i:s")."--------------+\n<br>";
$add = $add."|(No valido como comprobante de  venta)|\n<br>"; 
$add = $add."+--------------------------------------+\n<br>";

//+---------------- Cabecera --------------------+//


//+----------------- Detalle --------------------+//

$add = $add."#- Cant.|U.M.|Descrip|Precio|Subtotal\n<br>";
 
$n = 1; 
$TOTAL = 0;


// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $codigo = $Q0->Record['d_codigo'];
    $cant = str_pad(number_format($Q0->Record['d_cant'],2,",","."),3,".");
    
    $precio = str_pad(number_format($Q0->Record['d_precio'],0,",","."),18,".");
    
    $um = str_pad(ucfirst( strtolower( $Q0->Record['d_um'])),5); 
    $subt = $Q0->Record['d_subtotal'];
    $subtotal = str_pad(number_format($subt,0,",",".")  ,30,".",STR_PAD_LEFT); 
		 
    
    $descrip =   "  ".$Q0->Record['d_descrip'];
	
    $add.="$n-  ".$cant." ".$um." ".$descrip."\n<br>";
    $add.="...    ".$precio."           ".$subtotal."\n<br>";
	
   
    
    //Actualize Old Values Variables
    $old['d_codigo'] = $codigo;
    $old['d_descrip'] = $descrip;
    $old['d_cant'] = $cant;
    $old['d_um'] = $um;
    $old['d_subtotal'] = $subtotal;
    $firstRow=false;
    $n++;
	$TOTAL +=0 + $subt;
}

$TOTAL =  str_pad(number_format($TOTAL,0,",","."),30,"_",STR_PAD_LEFT); ;

$add.="\n<br>TOTAL Gs.$TOTAL#\n<br>";


$add.="\n<br>\n<br>\n<br>\n<br>.";
echo $add;

$add = str_replace("<br>","",$add);


$T->Set("content",$add);
$T->Show('submit');	

$endConsult = true;
 
?>
