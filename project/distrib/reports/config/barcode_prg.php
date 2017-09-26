<?php

/** Report prg file (barcode) 
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
$T->Set( 'sup_c_ref', '13');
$T->Set( 'sup_c_bloq_ins', '');
$T->Set( 'sup_c_empr', '00');
$T->Set( 'sup_c_prov', '2');
$T->Set( 'sup_c_prov_nombre', 'EL TIJERAZO S.A.');
$T->Set( 'sup_c_fecha', '2014-08-26');
$T->Set( 'sup_c_fecha_fac', '2014-08-26');
$T->Set( 'sup_c_factura', '2');
$T->Set( 'sup_c_moneda', 'G$');
$T->Set( 'sup_c_cotiz', '1');
$T->Set( 'sup_c_fn', '200000.00');
$T->Set( 'sup_c_otros', '30000.00');
$T->Set( 'sup_c_valor_total', '2500000.00');
$T->Set( 'sup_c_porc_rec', '9.20');
$T->Set( 'sup_c_tipo', 'Contado');
$T->Set( 'sup_c_aut_gen', 'No');
$T->Set( 'sup_c_gen', '');
$T->Set( 'sup_c_change', '');
$T->Set( 'sup_c_estado', 'Abierta');
$T->Set( 'sup_c_barcode', '');
$T->Set( 'sup_c_print', '');
$T->Set( 'sup___msg', '');
$T->Set( 'sup_c_compras_det', '');
$T->Set( 'sup___disableDel', '');

*/
// ------------------------------------------

// THIS IS YOUR FIRST QUERY:

// Para imprimir con window.open desde cualquier ubicacion
require_once("include/Config.class.php");

$c = new Config();
$dbname = $c->getDBName();

$Global['project'] = $dbname;

$lote = $_REQUEST['lote'];
$dir = ""; 
if(isset($lote)){  
    chdir("../../../../");
    $dir = "../../../../"; 
    require_once("barcodegen/RadPlusBarcode.php");   
    require_once("include/Y_DB.class.php");
    require_once("include/Y_Template.class.php");   
    $T = new Y_Template( "project/mv/reports/config/barcode_tpl.php" ); 
}else{
    require_once("barcodegen/RadPlusBarcodeNoFont.php");
}

//$T->Set( 'time', daytime() );
$T->Set( 'user', $Global['username'] );

$db = new Y_DB();
$db->Database = $Global['project'];
// Get Parameters
$db->Query("SELECT clave,valor FROM   parametros WHERE clave LIKE 'code_%'");
while($db->NextRecord()){
    $clave = $db->Record['clave'];
    $valor = $db->Record['valor']; 
    $T->Set( $clave ,$valor );
}

$firstRow=true;
$Q0 = new Y_DB();
$Q0->Database = $Global['project'];
 

$ref = $sup['c_ref'];
$codigo = $sup['c_codigo'];
 

if(!isset($codigo)){
 

	if($sup['p_estado']=='Activo'){ // Esto es cuando esta cargando se puede imprimir el ultimo codigo 
	 
            $ref = $sup['p_ref'];    
			  
            $db->Query("SELECT p_cod from productos where p_ref = '$ref' order by id desc limit 1");
	        if($db->NumRows()>0){
                $db->NextRecord();
                $codigo = $db->Record['p_cod']; // Buscar el Ultimo
            }
	}else{ 
	  
	   $codigo = '%';
	}   
}
 
$query0 = "SELECT p_cod AS codigo,p_precio_1 AS precio, p_um  as um, LOWER(s.s_nombre) AS sector,LOWER(g.g_nombre) AS grupo,LOWER(t.t_nombre) AS tipo,LOWER(c.color) AS color, p_ancho, p_descri,p_cant,p_st FROM productos p, sector s, grupo g, tipo t, colores c WHERE p_ref = $ref AND p.p_sector = s.s_cod AND p.p_grupo = g.g_cod AND p.p_tipo = t.t_cod AND p.p_color = c.c_cod and p_cod like '$codigo'";
 //echo $query0;
// Solo para imprimir por Lotes cambio la consulta forma de recibir lote=true&codigos=545,555,555,55
 
if($lote){
    $codigos = $_REQUEST['codigos'];
    $query0 = "SELECT p_cod AS codigo,p_precio_1 AS precio, p_um  as um, LOWER(s.s_nombre) AS sector,LOWER(g.g_nombre) AS grupo,LOWER(t.t_nombre) AS tipo,LOWER(c.color) AS color, p_ancho, p_descri,p_cant,p_st FROM productos p, sector s, grupo g, tipo t, colores c WHERE  p.p_sector = s.s_cod AND p.p_grupo = g.g_cod AND p.p_tipo = t.t_cod AND p.p_color = c.c_cod and p_cod in ($codigos)";
    // echo $query0;
}
 

$Q0->Query( $query0 );

// Starting a HTML
$T->Show('general_header');			// Principal Header
$T->Show('start_query0');			// Start a Table 
$T->Show('header0');				// Show Header

 
$endConsult = false;
 
$old['codigo'] = '';
$old['precio'] = '';
$old['sector'] = '';
$old['grupo'] = '';
$old['tipo'] = '';
$old['color'] = '';
$old['um'] = '';  
$old['p_ancho'] = ''; 
$old['p_descri'] = ''; 
$old['p_cant'] = '';  
$old['p_st'] = '';  
  
// Making a rows of consult
while( $Q0->NextRecord() ){

    // Define a elements
    $el['codigo'] = $Q0->Record['codigo'];
    $el['precio'] = $Q0->Record['precio'];
    $el['sector'] = $Q0->Record['sector'];
    $el['grupo'] = $Q0->Record['grupo'];
    $el['tipo'] = $Q0->Record['tipo'];
    $el['color'] = $Q0->Record['color'];
    $el['um'] = $Q0->Record['um'];
    $el['p_ancho'] = $Q0->Record['p_ancho'];
    $el['p_descri'] = $Q0->Record['p_descri'];
    $el['p_cant'] = $Q0->Record['p_cant'];
    $el['p_st'] = $Q0->Record['p_st'];
    
    // Preparing a template variables
    $T->Set('query0_codigo', $el['codigo']);
    $T->Set('query0_precio',  number_format($el['precio'],0,',','.'));   
    $T->Set('query0_sector', $el['sector']);
    $T->Set('query0_grupo', $el['grupo']);
    $T->Set('query0_tipo', $el['tipo']);
    $T->Set('query0_color', $el['color']);
    $T->Set('stock', $el['p_cant'] );
    $T->Set('p_st', $el['p_st']);
    
    $p_st = $el['p_st'];
    
    $um = ucfirst( strtolower ( $el['um'] )) ;
    
    
    if($um ==='Mts'){
       $T->Set('ancho',"Ancho: ". $el['p_ancho']); 
       $T->Set('um', $um);
    }else{
        $T->Set('ancho','UM:');
        $T->Set('um', $um);
    }
    
    $descrip =  $el['grupo'].'-'.$el['tipo'].'-'.$el['color'].'<br>'.$el['p_descri'].' <b>ST:&nbsp;</b>'.$p_st.' _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _';
    $T->Set('descrip',substr($descrip, 0,60));
     
    $filename = new RadPlusBarcode();
    
    
    $code = $filename->parseCode($el['codigo']);   
    $T->Set('codigo_barras', $dir.$code);
    
    
    $T->Show('query0_data_row');
     
  
    //Actualize Old Values Variables
    $old['codigo'] = $el['codigo'];
    $old['precio'] = $el['precio'];
    $old['sector'] = $el['sector'];
    $old['grupo'] = $el['grupo'];
    $old['tipo'] = $el['tipo'];
    $old['color'] = $el['color'];
    $old['p_ancho'] = $el['p_ancho'];
    $old['um'] = $el['um'];
    $old['p_cant'] = $el['p_cant'];
    $old['p_st'] = $el['p_st'];
    $firstRow=false;

}

$endConsult = true;
 
$T->Show('end_query0');				// Ends a Table 

?>
