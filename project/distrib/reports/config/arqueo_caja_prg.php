<?php

/** Report prg file (arqueo_caja) 
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
$T->Set( 'sup_desde', '2009-10-20');
$T->Set( 'sup_hasta', '2014-12-29');
$T->Set( 'sup_vp', 'Vista Previa');
$T->Set( 'sup_rep', '');
$T->Set( 'sup_arqueo_caja', '');
$T->Set( 'sup___lock', 'true');

*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT m_cod AS Moneda FROM caja_monedas ORDER BY m_ref DESC";

require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company );

$fecha = $sup['desde'];
$suc = $sup['suc'];

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

$db = new Y_DB();
$db->Database =   $Global['project'];

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
$old['Moneda'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['Moneda'] = $Q0->Record['Moneda'];

    // Preparing a template variables
    $T->Set('query0_Moneda', $el['Moneda']);
    
    $moneda = $el['Moneda'];
    
    $mon_img = strtolower(substr($moneda,0,1))."s.png";
    
    
    $sql = "SELECT __moneda,  SUM(IF( cjc_tipo ='E',monto,0) - IF( cjc_tipo ='S',monto,0)) AS E_S  FROM caja cj, caja_mov m , caja_con c	
    WHERE cj.cj_ref = m.cj_ref AND  m.concepto = c.cjc_cod AND cj.cj_suc  = '$suc' AND __date = '$fecha'  AND __moneda = '$moneda' ";

    $db->Query($sql);
    
    if($db->NumRows() > 0){
        $db->NextRecord();
        $E_S = $db->Record['E_S'];
        
        $T->Set('img_moneda',$mon_img);
        
        if($E_S != null){
           $T->Set('total_Moneda', number_format($E_S, 2, ',', '.'));   
        }else{
           $T->Set('total_Moneda', "0,00");  
        }
    }  
    $T->Show('query0_data_row');
    // Show Subtotal
    if( true ){
       // $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
    }
    
    //Actualize Old Values Variables
    $old['Moneda'] = $el['Moneda'];
    $firstRow=false;

}
 $T->Show('query0_total_row');
 $T->Show('end_query0');	
 // Buscar Cheques

$db->Query("SELECT c.id as id,chq_ref, chq_num  ,b.b_nombre AS banco, chq_benef,DATE_FORMAT(c.chq_fecha_pag,'%d-%m-%Y') AS fecha_pago, chq_valor,
        chq_moneda,chq_moneda_ref, chq_estado 
        FROM bcos_cheq_ter c , bcos b WHERE c.chq_bco = b.b_cod and chq_fecha_ins = '$fecha' and chq_trans = 1");

        $total_cheques = 0;
        if($db->NumRows()>0){
            $chqs = "<div> Cheques Registrados </div>"
                    ."<table class='cheques' border='1' cellspacing='0' cellpadding='0' style='width:100%'>";
            $chqs.="<tr><th>Factura</th>  <th>N&deg; Cheque</th> <th>Banco</th> <th>Beneficiario</th> <th>Fecha Pago</th> <th>Valor</th> <th>Moneda</th> <th>Valor Ref.</th><th>Estado</th> </tr>";

            while ($db->NextRecord()) {
                $id = $db->Record['id'];
                $chq_ref = $db->Record['chq_ref'];
                $chq_num = $db->Record['chq_num'];
                $banco = $db->Record['banco'];
                $chq_benef = $db->Record['chq_benef'];
                $fecha_pago = $db->Record['fecha_pago'];
                $chq_valor = number_format($db->Record['chq_valor'], 2, ',', '.');   
                $chq_moneda = $db->Record['chq_moneda'];
                $chq_moneda_ref = $db->Record['chq_moneda_ref']; 
                $chq_estado = $db->Record['chq_estado'];
                $total_cheques +=0+$chq_moneda_ref;
                $chq_moneda_ref =  number_format($chq_moneda_ref, 0, ',', '.'); 
                $total_chqs_moneda_ref =  number_format($total_cheques, 0, ',', '.'); 
                $chqs.="<tr> <td class='item'>$chq_ref</td><td class='item'>$chq_num</td> <td>$banco</td> <td>$chq_benef</td> <td  class='itemc'>$fecha_pago</td> <td class='num'>$chq_valor</td> <td class='itemc'>$chq_moneda</td> <td class='num'>$chq_moneda_ref</td> <td class='itemc'>$chq_estado</td>    </tr>";
            }
             $chqs.="</table>";
        }  
        echo $chqs;    
 
			// Ends a Table 
$db->Query("SELECT f_nro AS Factura,conv_tipo AS Tipo,conv_nombre AS Tarjeta,DATE_FORMAT( f_fecha,'%d-%m-%Y' ) AS Fecha_Fact ,DATE_FORMAT( DATE_ADD( f_fecha,INTERVAL 9 DAY),'%d-%m-%Y') AS Fecha_Acr,f_monto_conv AS Valor,
 ROUND(f_monto_conv - ((f_monto_conv * conv_porc) / 100),2) AS Valor_Acr 
 FROM factura_venta f, convenios c   WHERE f.f_conv_cod = c.conv_cod AND f_fecha = '$fecha' AND f_estado ='Cerrada'
 AND f_monto_conv > 0 ");

        $total_tarjetas = 0;
        $total_tarjetas_acr = 0;
        if($db->NumRows()>0){
            $tarjetas = "<div> Cobros con Tarjetas </div>"
                    . " <table class='cheques' border='1' cellspacing='0' cellpadding='0' style='width:100%'>";
            $tarjetas.="<tr><th>Factura</th>  <th>Tipo</th> <th>Tarjeta</th> <th>Fecha</th> <th>Fecha Acreditaci&oacute;n</th> <th>Valor</th> <th>Valor Acreditar</th> </tr>";
            while ($db->NextRecord()) {
                //$id = $db->Record['id'];
                $factura = $db->Record['Factura'];
                $tipo = $db->Record['Tipo'];
                $tarjeta = $db->Record['Tarjeta'];
                $fecha_fact = $db->Record['Fecha_Fact'];
                $fecha_pago = $db->Record['Fecha_Acr'];
                $valor = number_format($db->Record['Valor'], 2, ',', '.');   
                $valor_acr  = number_format($db->Record['Valor_Acr'], 2, ',', '.');   
                $total_tarjetas +=0+$db->Record['Valor']; 
                $total_tarjetas_acr +=0+$db->Record['Valor_Acr']; 
                $tarjetas.="<tr> <td class='item'>$factura</td><td class='item'>$tipo</td> <td class='item'>$tarjeta</td> <td class='itemc'>$fecha_fact</td> <td  class='itemc'>$fecha_pago</td>   <td class='num'>$valor</td> <td class='num'>$valor_acr</td>     </tr>";
            }
            $tarjetas.="<tr> <td class='item' colspan='5' style='text-align:right'><b>Totales&nbsp;</b></td> <td class='num'><b>".number_format($total_tarjetas, 2, ',', '.')."</b></td><td class='num'><b>".number_format($total_tarjetas_acr, 2, ',', '.')."</b></td></tr>";
            $tarjetas.=" </table>";
            echo $tarjetas;
        }          

?>
