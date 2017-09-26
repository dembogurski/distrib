<?php

require_once '../../../../include/Y_Template.class.php';
require_once '../../../../include/Y_DB.class.php';
require_once '../../../../include/functions.php';
$t = new Y_Template("imprimir_factura_tpl.php");

$factura = $_REQUEST['factura'];
$tipo = $_REQUEST['tipo'];
$punto_exp = $_REQUEST['punto_exp'];
$factura_legal = $_REQUEST['factura_legal'];
$porc = $_REQUEST['porc']; 
$suc = $_REQUEST['suc'];

$total_factura = 0;
$first_render = true;

if(!isset($_REQUEST['porc'])){
    $porc = 100;
}

if($tipo == "Credito"){
   $t->Set("contado","&nbsp;&nbsp;&nbsp;&nbsp;");
   $t->Set("credito","&nbsp;X&nbsp;");
}else{
   $t->Set("contado","&nbsp;X&nbsp;");
   $t->Set("credito","&nbsp;&nbsp;&nbsp;&nbsp;");
}

$db = new Y_DB();

require_once("../../../../include/Config.class.php");

$c = new Config();
$dbname = $c->getDBName();

$Global['project'] = $dbname;

$db->Database = $dbname;

// Buscar limite de items por Factura    
$db->Query("SELECT valor AS limite_items_x_venta FROM parametros WHERE clave = 'limite_items_x_venta'");
$db->NextRecord();
$limite_items_x_venta = $db->Record['limite_items_x_venta'];


// En Español la Fecha
$db->Query("SET lc_time_names = 'es_PY';");
// Datos de la Cabecera de Factura y el Cliente
$sql_cli ="SELECT DATE_FORMAT(CURRENT_DATE,'%d de %M de %Y') AS fecha,DATE_FORMAT(f_fecha,'%d de %M de %Y') AS fecha_facura,c.cli_tipo_doc AS tipo_doc,c.cli_ci AS doc, UPPER(c.cli_nombre) AS cliente, f_usuario as usuario
    FROM factura_venta f, clientes c WHERE f.f_cli_cod = c.cli_id AND f_nro = $factura";
$db->Query($sql_cli);

if($db->NumRows()==0){
   echo "Error: ".__file__."  ".__line__."<br> $sql_cli"; die();
}	
$db->NextRecord();

$fecha = $db->Record['fecha'];
$tipo_doc = $db->Record['tipo_doc'];
$doc = $db->Record['doc'];
$cliente = $db->Record['cliente'];
$usuario = $db->Record['usuario'];



$master = array();

$sql_det = "select d_codigo,d_descrip,d_cant_v,d_cant,d_um,d_precio ,d_subtotal,d_imp from fact_vent_det where d_fact = $factura";
$db->Query($sql_det);

if($db->NumRows()==0){
   echo "Error: ".__file__."  ".__line__."<br> $sql_det"; die();
}

$i = 0;
while ($db->NextRecord()) {
    $codigo = $db->Record['d_codigo'];
    $descri = $db->Record['d_descrip'];
    $cant_v = $db->Record['d_cant'];
    $precio = ($db->Record['d_precio'] * $porc) / 100;
    $sub_tot = ($db->Record['d_subtotal']* $porc) / 100;
    $um = $db->Record['d_um'];
    $imp = $db->Record['d_imp'];
    $master[$i] = array($codigo, $descri, $cant_v, $precio, $sub_tot,$um,$imp);
    $i++;
}


$t->Show("general_header");

$db->Query("SELECT clave,valor FROM parametros WHERE clave LIKE 'factura_margen%'");
$margenes = '';

while ($db->NextRecord()) {
    $clave = $db->Record['clave'];
    $valor = $db->Record['valor'];
    $margenes.=" $valor" . "px";
}
$t->Set("margenes", $margenes);

$t->Show("start_marco");

$t->Set('cliente', $cliente);
$t->Set('tipo_doc', $tipo_doc);
$t->Set('doc', $doc);
$t->Set('fecha', $fecha);
$t->Set('ref', $factura);
$t->Set('vendedor', $usuario);

$db->Query("SELECT valor as intervalo FROM parametros WHERE clave LIKE 'factura_interval_dup'");
$db->NextRecord(); 
$intervalo = $db->Record['intervalo'];
$t->Set('intervalo', $intervalo);

$t->Set('id_nombre', "primer_nombre");  $t->Set('id_doc', "primer_ci");  $t->Set('id_fecha', "primer_fecha");  
renderizar($t, $master, $limite_items_x_venta);
$t->Show("intervalo");
$t->Set('id_nombre', "segundo_nombre"); $t->Set('id_doc', "segundo_ci");  $t->Set('id_fecha', "segunda_fecha");
$first_render = false;
renderizar($t, $master, $limite_items_x_venta);

 


function renderizar($t, $master, $limite_items_x_venta) {
    $t->Show("cabecera");
    $t->Show("cabecera_detalle");
    
    $T_IVA_EXE =0;
    $T_IVA_5 =0;
    $T_IVA_10 =0;
    
    
    $contador = 0;
    $TOTAL = 0;
    
     
    foreach ($master as $arr) {
        global $total_factura,$first_render;
        
        $codigo = $arr[0];
        $descrip = $arr[1];
        $cant = $arr[2];
        $precio_venta = $arr[3];
        $subtotal = $arr[4];
        $um = $arr[5];
        $imp = $arr[6];
        
        $t->Set('codigo', $codigo);
        $t->Set('cantidad', $cant." ".$um);
        $t->Set('descrip', $descrip);
        $t->Set('precio', number_format($precio_venta, 0, ',', '.'));
        $t->Set('subtotal_IVA_EXE', "/");
        $t->Set('subtotal_IVA_5', "/");
        $t->Set('subtotal_IVA_10', "/");
        $t->Set('iva_5_align', "center");
        $t->Set('iva_10_align', "center");
        
        if($imp == "IVA_EXE"){
            $T_IVA_EXE +=0 +$subtotal;
            $t->Set('subtotal_IVA_EXE', number_format($subtotal, 0, ',', '.'));
        }elseif($imp == "IVA_5"){
            $T_IVA_5 +=0 +$subtotal;
            $t->Set('subtotal_IVA_5', number_format($subtotal, 0, ',', '.'));
            $t->Set('iva_5_align', "right");
        }elseif($imp == "IVA_10"){
            $T_IVA_10 +=0 +$subtotal;
            $t->Set('subtotal_IVA_10', number_format($subtotal, 0, ',', '.'));
            $t->Set('iva_10_align', "right");
        }
        
        $TOTAL += 0 + $subtotal;
        if($first_render){
           $total_factura += 0 + $subtotal;
        }
        //echo $total_factura."<br>";
        $t->Show("detalle");
        $contador++;
    }
      
    for ($i = $contador; $i < $limite_items_x_venta; $i++) {
        $t->Show("detalle_vacio");
    }

    $redondeado = number_format($TOTAL, 0, ',', '');
    $monto_en_letras = extense($redondeado);
    $IVA_10 = round($T_IVA_10 / 11);
    $IVA_5 = round($T_IVA_5 / 21);
    
    $t->Set('iva_10', number_format($IVA_10, 0, ',', '.'));
    $t->Set('iva_5', number_format($IVA_5, 0, ',', '.'));
    $TOTAL_IVA = $IVA_10 + $IVA_5;
    $t->Set('total_letras', $monto_en_letras);
    $t->Set('total_iva', number_format($TOTAL_IVA, 0, ',', '.'));
    
    
    $t->Set('totalexe', number_format($T_IVA_EXE, 0, ',', '.'));
    $t->Set('total10', number_format($T_IVA_10, 0, ',', '.'));
    $t->Set('total5', number_format($T_IVA_5, 0, ',', '.'));
    
    $t->Set('total', number_format($TOTAL, 0, ',', '.'));
    $t->Show("pie_detalle");
}
global $total_factura;    
 
$t->Show("end_marco");

//Anulo impresiones anteriores
$db->Query("UPDATE fact_cont SET  f_estado = 'Anulada',f_mot_anul = 'Anulada por Reimpresion sobre $factura'  WHERE f_ref = $factura"); // Anulo si ya tiene impresa 

// Actualizar con los nuevos datos
$db->Query("UPDATE factura_venta set f_p_exp = '$punto_exp', f_fact_cont = $factura_legal, f_tipo = '$tipo' where f_nro = $factura");
$db->Query("UPDATE fact_cont SET f_ref = '$factura', f_estado = 'Cerrada', f_tipo = '$tipo', f_total = $total_factura,f_fecha = current_date WHERE f_pdv = '$punto_exp' AND f_nro = $factura_legal and f_suc = '$suc'");

?>
