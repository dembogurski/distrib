<?php

/** Report prg file (caja) 
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
  $T->Set( 'sup_f_nro', '8');
  $T->Set( 'sup_f_usuario', 'Developer');
  $T->Set( 'sup_f_fecha', '2014-10-07');
  $T->Set( 'sup_f_b_cli', '');
  $T->Set( 'sup_f_cli_cod', '10');
  $T->Set( 'sup_f_cli_nombre', 'DOGLAS ANTONIO DEMBOGURSKI FEIX');
  $T->Set( 'sup_f_cat', '4');
  $T->Set( 'sup_f_edit_cli', '');
  $T->Set( 'sup_f_cli_form', '');
  $T->Set( 'sup_f_estado', 'Abierta');
  $T->Set( 'sup_f_caja', '');
  $T->Set( 'sup_f_gen', 'No');
  $T->Set( 'sup_f_set_change', '');
  $T->Set( 'sup_f_det', '');
  $T->Set( 'sup_f_limit', '15');
  $T->Set( 'sup_f_doclick', 'true');
  $T->Set( 'sup_f_open_sub', '');

 */
// ------------------------------------------
// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT f_nro AS Nro,DATE_FORMAT(f_fecha,"%d-%m-%Y") AS Fecha, f_usuario AS Usuario, cli_tipo_doc AS TipoDoc, cli_ci AS Doc, cli_nombre AS Cliente,SUM(d_subtotal) AS TOTAL FROM factura_venta f, clientes c, fact_vent_det d WHERE f.f_nro = d.d_fact AND f.f_cli_cod = c.cli_id AND  f_nro = '8'GROUP BY f_nro ";
 
require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company ); 

$T->Set('time', daytime());
$T->Set('user', $Global['username']);

$factura = $sup['f_nro'];


$project = $Global['project'];
$path = "project/$project/reports/config/imprimir_factura.php";

$T->Set('imprimir_factura', $path);


$db = new Y_DB();
$db->Database = $Global['project'];
$db2 = new Y_DB();
$db2->Database = $Global['project'];

$user = $sup['f_usuario'];

$db->Query("SELECT cj_ref,local as suc FROM p_users p, caja c WHERE NAME = '$user' AND LOCAL = c.cj_suc AND c.cj_estado = 'Abierta' ORDER BY c.id DESC LIMIT 1");
if ($db->NumRows() > 0) {
    $db->NextRecord();
    $cj_ref = $db->Record['cj_ref'];
    $suc = $db->Record['suc'];
    $T->Set('caja_ref', $cj_ref);
    $T->Set('suc', $suc);
} else {
    echo "No hay caja Abierta para esta Sucursal, Debe abrir una, dirijase al Menu Caja-->Apertura y Cierre";
    die();
}

$firstRow = true;
$Q0 = $DB;
$Q0->Query($query0);
$T->Show('general_header');
if (!$Q0->NumRows()) {
    $T->Show("error");
    die();
}
// Starting a HTML
// Principal Header
$T->Show('start_query0');   // Start a Table 
//$T->Show('header0');    // Show Header
//Define a  variable
$endConsult = false;
//Define a Total Variables
//Define a Subtotal Variables
//Define a Old Values Variables
$old['Nro'] = '';
$old['Fecha'] = '';
$old['Usuario'] = '';
$old['TipoDoc'] = '';
$old['Doc'] = '';
$old['Cliente'] = '';
$old['TOTAL'] = '';

// Making a rows of consult
while ($Q0->NextRecord()) {

    // Define a elements
    $el['Nro'] = $Q0->Record['Nro'];
    $el['Fecha'] = $Q0->Record['Fecha'];
    $el['Usuario'] = $Q0->Record['Usuario'];
    $el['TipoDoc'] = $Q0->Record['TipoDoc'];
    $el['Doc'] = $Q0->Record['Doc'];
    $el['Cliente'] = $Q0->Record['Cliente'];
    $el['TOTAL'] = $Q0->Record['TOTAL'];

    // Preparing a template variables
    $T->Set('query0_Nro', $el['Nro']);
    $T->Set('query0_Fecha', $el['Fecha']);
    $T->Set('query0_Usuario', $el['Usuario']);
    $T->Set('query0_TipoDoc', $el['TipoDoc']);
    $T->Set('query0_Doc', $el['Doc']);
    $T->Set('query0_Cliente', $el['Cliente']);
    $T->Set('query0_TOTAL', number_format($el['TOTAL'], 2, ',', '.'));

    $TOTAL_GS = $el['TOTAL'];
    
    $db->Query("SELECT m_cod,m_descri FROM caja_monedas ORDER BY m_ref DESC ");
    $monedas = "<select id='monedas' onchange='cotiz()' >";
    while ($db->NextRecord()) {
        $cod = $db->Record['m_cod'];
        $mon = $db->Record['m_descri'];
        $monedas.="<option value='$cod'>$mon</option>";
        // Muestro el total en otras monedas
        $db2->Query("SELECT ROUND($TOTAL_GS / obtener_cambio('$cod') ,2) as total_moneda ");
        $db2->NextRecord();
        $total_moneda = $db2->Record['total_moneda'];
        $s = str_replace("$","s",$cod); 
        $T->Set("total_$s", number_format($total_moneda, 2, ',', '.'));  
    }
    $monedas.="</select>";
    $T->Set('monedas', $monedas);


    $db->Query("SELECT conv_cod,conv_nombre FROM convenios ORDER BY conv_cod asc ");
    $convenios = "<select id='convenios' style='font-size:14px;width:150px;display:none'  >";
    while ($db->NextRecord()) {
        $cod = $db->Record['conv_cod'];
        $conv = $db->Record['conv_nombre'];
        $convenios.="<option value='$cod'>$conv</option>";
    }
    $convenios.="</select>";
    $T->Set('convenios', $convenios);

    //$T->Show('query0_data_row');
    
    // Mostrar Cheques
    $db->Query("SELECT chq_num ,c.id as id ,b.b_nombre AS banco, chq_benef,DATE_FORMAT(c.chq_fecha_pag,'%d-%m-%Y') AS fecha_pago, chq_valor,
    chq_moneda,chq_moneda_ref, chq_estado 
    FROM bcos_cheq_ter c , bcos b WHERE c.chq_bco = b.b_cod and chq_ref =  $factura and chq_trans = 1");
    
    $total_cheques = 0;
    if($db->NumRows()>0){
        $chqs = "<table class='cheques' border='1' cellspacing='0' cellpadding='0' style='width:100%'>";
        $chqs.="<tr><th>N&deg;</th> <th>Banco</th> <th>Beneficiario</th> <th>Fecha Pago</th> <th>Valor</th> <th>Moneda</th> <th>Valor Ref.</th><th>Estado</th><th>x</th></tr>";
    
        while ($db->NextRecord()) {
            $id = $db->Record['id'];
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
            $chqs.="<tr> <td class='itemc'>$chq_num</td> <td>$banco</td> <td>$chq_benef</td> <td  class='itemc'>$fecha_pago</td> <td class='num'>$chq_valor</td> <td class='itemc'>$chq_moneda</td> <td class='num'>$chq_moneda_ref</td> <td class='itemc'>$chq_estado</td> <td class='itemc'><img style='cursor:pointer' src='images/trash.png' onclick='delChq($id)'></td> </tr>";
        }
        $chqs.="<tr> <td class='item' colspan='6'><img title='Agregar Cheque' src='images/add.png' style='cursor:pointer' onclick='addCheque()'></td> <td class='num' ><input class='input_mini num' size='12' readonly style='font-weight:bolder;font-size:14px;padding:0px;border:0px' id='total_cheques' type='text' value='$total_chqs_moneda_ref'> </td><td>&nbsp;</td></tr>";
        $chqs.="</table>";
    }else{
       $chqs = "<img src='images/add.png' title='Agregar Cheque' style='cursor:pointer' onclick='addCheque()'> <input type='hidden' id='total_cheques' value='0'>"; 
    }
   
    $T->Set('cheques', $chqs);
    //Actualize Old Values Variables
    $old['Nro'] = $el['Nro'];
    $old['Fecha'] = $el['Fecha'];
    $old['Usuario'] = $el['Usuario'];
    $old['TipoDoc'] = $el['TipoDoc'];
    $old['Doc'] = $el['Doc'];
    $old['Cliente'] = $el['Cliente'];
    $old['TOTAL'] = $el['TOTAL'];
    $firstRow = false;
}

$endConsult = true;
if (true) {
    $T->Show('query0_subtotal_row');
}
// Show total
if (true) {
    $T->Show('query0_total_row');
}
$T->Show('end_query0');    // Ends a Table 
?>
