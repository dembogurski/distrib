<?php

/** Report prg file (recup_compras) 
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
$T->Set( 'sup_desde', '2014-01-01');
$T->Set( 'sup_hasta', '2015-06-01');
$T->Set( 'sup_rep_recup', '');

*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:
//$query0 = "SELECT c_ref AS Ref,DATE_FORMAT(c_fecha,"%d-%m-%Y") AS Fecha,DATE_FORMAT(c_fecha_fac,"%d-%m-%Y") AS FechaFactura,prov_nombre AS Proveedor,c_factura AS Factura,c_moneda AS Moneda,c_cotiz AS Cotiz,c_valor_total AS ValorTotal,c_porc_rec AS Rec,c_estado AS Estado  FROM factura_compra c, proveedores p WHERE c.c_prov = p.prov_cod    AND c_fecha BETWEEN '2014-01-01' AND '2015-06-01' ";
require_once("include/Config.class.php");
$c = new Config();
$company = $c->getCompany();
$T->Set( 'company', $company );

$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

$database = $c->getDBName();

$db = new Y_DB();
$db->Database = $database;

$db2 = new Y_DB();
$db2->Database = $database;

$firstRow=true;
$Q0 = $DB;
$Q0->Query( $query0 );

// Starting a HTML
$T->Show('general_header');			// Principal Header
$T->Show('start_query0');			// Start a Table 
//$T->Show('header0');				// Show Header

//Define a  variable
$endConsult = false;
//Define a Total Variables

//Define a Subtotal Variables
$subtotal0_ValorTotal = 0;


//Define a Old Values Variables
$old['Ref'] = '';
$old['Fecha'] = '';
$old['FechaFactura'] = '';
$old['Proveedor'] = '';
$old['Factura'] = '';
$old['Moneda'] = '';
$old['Cotiz'] = '';
$old['ValorTotal'] = '';
$old['Rec'] = '';
$old['Estado'] = '';

// Making a rows of consult
while( $Q0->NextRecord() ){
    $T->Show('header0');	
    // Define a elements
    $el['Ref'] = $Q0->Record['Ref'];
    $el['Fecha'] = $Q0->Record['Fecha'];
    $el['FechaFactura'] = $Q0->Record['FechaFactura'];
    $el['Proveedor'] = $Q0->Record['Proveedor'];
    $el['Factura'] = $Q0->Record['Factura'];
    $el['Moneda'] = $Q0->Record['Moneda'];
    $el['Cotiz'] = $Q0->Record['Cotiz'];
    $el['ValorTotal'] = $Q0->Record['ValorTotal'];
    $el['Rec'] = $Q0->Record['Rec'];
    $el['Estado'] = $Q0->Record['Estado'];

    // Preparing a template variables
    $T->Set('query0_Ref', $el['Ref']);
    $T->Set('query0_Fecha', $el['Fecha']);
    $T->Set('query0_FechaFactura', $el['FechaFactura']);
    $T->Set('query0_Proveedor', $el['Proveedor']);
    $T->Set('query0_Factura', $el['Factura']);
    $T->Set('query0_Moneda', $el['Moneda']);
    $T->Set('query0_Cotiz', $el['Cotiz']);
    $T->Set('query0_ValorTotal', number_format($el['ValorTotal'],0,',','.'));
    $T->Set('query0_Rec', $el['Rec']);
    $T->Set('query0_Estado', $el['Estado']);
    
    $ref = $el['Ref'];
     

    // Calculating a total

    // Calculating a subtotal
    $subtotal0_ValorTotal += 0 + $el['ValorTotal'];

    $T->Show('query0_data_row');
    // Show Subtotal
    $T->Set('subtotal0_ValorTotal', number_format($subtotal0_ValorTotal,2,',','.'));
    
    $compras = "SELECT p_cod_art AS codigo, p.p_descri, p_um AS UM,SUM(p_cant_um) AS CantCompra,  SUM(p_cant_compra * p_compra) AS Valor FROM   fact_comp_det p WHERE p_ref = $ref  GROUP BY codigo";
    $db->Query($compras);
    
    $cant_total_compra = 0;
    $valor_total_compra = 0;
    $cant_total_vendida = 0;
    $valor_total_vendido=0;
    
    
    if($db->NumRows()>0){
        echo "<tr><th>Codigo</th>  <th>Descripcion</th>  <th>UM</th> <th>Cant. Compra</th> <th>Valor Compra</th> <th>Cant. Vend</th> <th>Valor Venta</th> <th>%Rec.UM</th> <th>%Valor Rec</th> </tr>";
        while($db->NextRecord()){
           $codigo = $db->Record['codigo'];
           $p_descri = $db->Record['p_descri'];           
           $um = $db->Record['UM'];            
           
           $cc = $db->Record['CantCompra'];
           $valor = $db->Record['Valor'];
           
           $cant_total_compra+=0+$cc;
           $valor_total_compra+=0+$valor;
           
          /* if($ref == 43 ){
             echo "SELECT SUM(d_cant_v) AS CantV,SUM(d_subtotal) AS ValV FROM fact_vent_det d, productos p 
              WHERE p.p_cod = d.d_codigo AND p.p_ref = $ref AND p.p_sector = $s AND p.p_grupo = $g AND p.p_tipo = $t AND p.p_color = $clr <br> ";
           }*/
           $db2->Query("SELECT SUM(d_cant_v) AS CantV,SUM(d_subtotal) AS ValV FROM fact_vent_det d, fact_comp_det p 
            WHERE p.p_cod = d.d_codigo AND p.p_ref = $ref AND p.p_cod_art = d.d_codigo AND p.p_cod_art = '$codigo'"); 
           
           $cantv = 0;$valv = 0; 
           if($db2->NumRows()>0){
              $db2->NextRecord(); 
              $cantv = $db2->Record['CantV']; 
              $valv = $db2->Record['ValV']; 
              if($cantv == null){ $cantv = 0; }
              if($valv == null){ $valv = 0; }              
             
           }else{
               $cantv = 0; $porc_rec_um = 0;
               $valv = 0;  $porc_rec_val = 0;
           }  
           $cant_total_vendida +=0+$cantv;
           $valor_total_vendido+=0+$valv;
           
            $porc_rec_um =  number_format( ($cantv * 100) /  $cc,2,',','.');
            $porc_rec_val = number_format( ($valv * 100) / $valor,2,',','.');
            
            
            echo "<tr><td class='item'>$codigo</td>   <td class='item'>$p_descri</td>   <td class='itemc'>$um</td>   <td class='num'> ".number_format( $cc,2,',','.')."</td>   <td class='num'>".number_format( $valor,2,',','.')."</td>   <td class='num'>".number_format( $cantv,2,',','.')."  </td>   <td class='num'> ".number_format( $valv,2,',','.')."</td>   <td class='num'>$porc_rec_um%</td> <td class='num'>$porc_rec_val%</td>    </tr>";
        }
        
        $porc_total_rec_um =  number_format( ($cant_total_vendida * 100) /  $cant_total_compra,2,',','.');
        $porc_total_rec_val = number_format( ($valor_total_vendido * 100) / $valor_total_compra,2,',','.');
        
        echo "<tr style='font-weight:bolder;font-size:14px'><td colspan='3'> </td>        <td class='num'> ".number_format( $cant_total_compra,2,',','.')."</td>   <td class='num'>".number_format( $valor_total_compra,2,',','.')."</td>   <td class='num'>".number_format( $cant_total_vendida,2,',','.')."  </td>   <td class='num'> ".number_format( $valor_total_vendido,2,',','.')."</td>   <td class='num'>$porc_total_rec_um%</td> <td class='num'>$porc_total_rec_val%</td>    </tr>";
        echo "<tr><td colspan='11'>&nbsp;</td></tr>";
        
    }    
    
    
    if( $endConsult ){
        $T->Show('query0_subtotal_row');
        //Reset a Subtotal Variables
        $subtotal0_ValorTotal = 0;
    }
    
    //Actualize Old Values Variables
    $old['Ref'] = $el['Ref'];
    $old['Fecha'] = $el['Fecha'];
    $old['FechaFactura'] = $el['FechaFactura'];
    $old['Proveedor'] = $el['Proveedor'];
    $old['Factura'] = $el['Factura'];
    $old['Moneda'] = $el['Moneda'];
    $old['Cotiz'] = $el['Cotiz'];
    $old['ValorTotal'] = $el['ValorTotal'];
    $old['Rec'] = $el['Rec'];
    $old['Estado'] = $el['Estado'];
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
