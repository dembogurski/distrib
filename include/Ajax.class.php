
<?php

/**
 * 
 * RPC calls
 * Doglas A. Dembogurski Feix
 */
require_once("Y_DB.class.php");
$Global['project'] = 'distrib';
class Ajax {

    function __construct() {
        
        $action = $_REQUEST['action'];
        switch ($action) {
            case 'get_cotiz_venta': $this->obtenerCambioVenta();
                break;
	    case 'get_cotiz_compra': $this->obtenerCambioCompra();
                break;	
            case 'cerrar_venta': $this->cerrarVenta();
                break;
            case 'save_margins': $this->saveMargin();
                break; 
            case 'get_cheque_terceros_ui': $this->getChequeTercerosUI();
                break; 
            case 'registrar_cheque': $this->registrarCheque();
                break;  
            case 'eliminar_cheque': $this->eliminarCheque();
                break;   
            case 'get_recepcion_ui': $this->getRecepcionUpdateUI();
                break;
            case 'get_grupos': $this->getGrupos();
                break;
            case 'get_tipos': $this->geTipos();
                break;
            case 'get_colores': $this->getColores();
                break;
            case 'actualizar_descripcion': $this->actualizarDescripcion();
                break;  
            case 'actualizar_precios': $this->actualizarPrecios();
                break; 
            case 'generar_cuotas': $this->generarCuotas();
                break; 
            case 'eliminar_cuotas': $this->eliminarCuotas();
                break;
            case 'extense': $this->extense();
                break;
            case 'cambiar_vencimiento_cuota': $this->cambiarVencimientoCuota();
                break;
            case 'guardar_precio': $this->guardarPrecio();
                break;
            case 'get_facturas_contables': $this->getFacturasContables();
                break;
            
            default : $this->error($action);
        }
    }

    function error($action) {
        echo 'ERROR!!! La accion ' . $action . ' ha producido un error pongase en contacto con el administrador!!!';
    }

    
function  getFacturasContables(){
    $suc = $_POST['suc'];
    $punto_expedicion = $_POST['punto_expedicion'];
    $sql = "SELECT LPAD(f_nro,7,'0')  AS nro_mostrar, f_nro as factura FROM fact_cont	WHERE f_suc = '$suc' AND f_estado = 'Disponible' AND f_pdv = '$punto_expedicion'";
    echo json_encode($this->getResultArray($sql)); 
}
function  guardarPrecio(){   
    
    $db = new Y_DB();
    $db->Database =   $Global['project'];   
    $codigo = $_POST['codigo'];
    $precio = $_POST['precio'];
    $lista = $_POST['lista'];
    
    $sql = "UPDATE lista_precios SET precio_unit = $precio WHERE codigo = '$codigo' AND num = $lista;";
    $db->Query($sql);
    echo "Ok";
}   
function getResultArray($sql) {
    $db = new Y_DB();
    $db->Database =   $Global['project'];   
    $array = array();
    $db->Query($sql);
    while ($db->NextRecord()) {
        array_push($array, $db->Record);
    }
    return $array;
}
function cambiarVencimientoCuota(){
    $factura = $_POST['factura'];
    $cuota = $_POST['cuota'];
    $v = $_POST['vencimiento'];
    $dd = substr($v,0,2);
    $mm = substr($v,3,2);
    $yyyy = substr($v,6,4);
    $db = new Y_DB();
    $db->Database =   $Global['project'];  
    $db->Query("update cuotas set c_venc = '$yyyy-$mm-$dd' where c_fact = $factura and c_nro_cuota = $cuota");
    echo "Fecha de Vencimiento actualizada a $v";
}
function extense(){
   require_once("functions.php");
   $monto =  $_POST['monto'];
   $monto_en_letras = extense($monto,"",$type);
   echo trim($monto_en_letras);
}

function generarCuotas() {

    $factura = $_POST['factura'];
    $monto = $_POST['monto'];
    if ($monto > 0) { // Solo si el monto es > 0
        $moneda = $_POST['moneda'];
        $cuotas = $_POST['cuotas'];
        $cotiz = $_POST['cotiz'];
        $suc = $_POST['suc'];    
            
        $monto_ref = $monto * $cotiz;  //Monto total en Gs sin el interes
        $db = new Y_DB();
        $db->Database =   $Global['project'];   
        $db->Query("delete from cuotas where c_fact = $factura");
        for ($i = 1; $i <= $cuotas; $i++) {
            $db->Query("INSERT INTO cuotas(c_fact, c_nro_cuota, c_moneda, c_monto, c_cotiz, c_monto_ref, c_venc,c_saldo,c_suc, c_estado)
            VALUES ($factura, $i, '$moneda',$monto, $cotiz, $monto_ref, DATE_ADD(CURRENT_DATE,INTERVAL 30 * $i DAY),$monto,'$suc', 'Pendiente');");
        }
    }
    $sql = "select c_fact, c_nro_cuota, c_monto_ref,c_moneda,  date_format(c_venc,'%d/%m/%Y') as venc , c_estado from cuotas where c_fact = $factura;";
            
    echo json_encode($this->getResultArray($sql));
}

    function eliminarCuotas() {
        $factura = $_POST['factura'];
        $db = new Y_DB();
        $db->Database =   $Global['project'];   
        $db->Query("delete from cuotas where c_fact = $factura");
        echo "Ok";
    }        
    function actualizarPrecios(){
        $valmin =  $_REQUEST['valmin']; 
        $p1 =  $_REQUEST['p1']; 
        $p2 =  $_REQUEST['p2']; 
        $p3 =  $_REQUEST['p3'];
        $p4 =  $_REQUEST['p4'];
        $ids =  $_REQUEST['ids']; 
      
        $db = new Y_DB();
        $db->Database =   $Global['project'];   
            
        $tags = explode(',',$ids);
            
        foreach($tags as $id) {    
            if($id != "-1"){
                $sql = "update productos set p_valmin = $valmin,p_precio_1 = $p1,p_precio_2 = $p2,p_precio_3 = $p3, p_precio_4 = $p4,p_estado = 'Activo' where id = $id;";
            
                $db->Query($sql);
            }
        } 
        echo "Ok";
    }
    function actualizarDescripcion(){
        $sector =  $_REQUEST['sector']; 
        $grupo=  $_REQUEST['grupo']; 
        $tipo =  $_REQUEST['tipo']; 
        $color =  $_REQUEST['color']; 
        $ancho =  $_REQUEST['ancho']; 
        $ids =  $_REQUEST['ids']; 
        $db = new Y_DB();
        $db->Database =   $Global['project'];   
            
        $tags = explode(',',$ids);
            
        foreach($tags as $id) {    
            if($id != "-1"){
                $sql = "update productos set p_sector = $sector,p_grupo = $grupo,p_tipo = $tipo,p_color = $color,p_ancho = $ancho, p_estado = 'Activo' where id = $id;";
                //echo $sql."<br>";
                $db->Query($sql);
            }
        } 
        echo "Ok";
    }
    
    
    function getGrupos(){
        $db = new Y_DB();
        $db->Database =   $Global['project'];        
        $id_sector = $_REQUEST['id_sector'];
        // Grupo
        $db->Query("SELECT g_cod,g_nombre AS grupo FROM grupo g, grupos_x_sector gs WHERE   g.g_cod = gs.gc_cod AND gs.s_cod = $id_sector");
            
            
        while($db->NextRecord()){
            $g_cod = $db->Record['g_cod'];
            $grupo = $db->Record['grupo']; 
            echo "<option value='$g_cod'>$grupo</option>";
        } 
    }

    function geTipos(){
        $db = new Y_DB();
        $db->Database =   $Global['project'];        
        $id_grupo = $_REQUEST['id_grupo'];
        // Grupo
        $db->Query("SELECT t_cod,t_nombre AS tipo FROM tipo t, tipos_x_grupo tg  WHERE t.t_cod = tg.g_cod  AND tg.g_cod =   $id_grupo");
            
        while($db->NextRecord()){
            $t_cod = $db->Record['t_cod'];
            $tipo = $db->Record['tipo']; 
            echo "<option value='$t_cod'>$tipo</option>";
        }
    } 
    function getColores(){
        $db = new Y_DB();
        $db->Database =   $Global['project'];        
        $color = $_REQUEST['color']; 
        $db->Query(" SELECT c_cod,color,hex FROM colores WHERE color LIKE '$color%'"); 
            
        while($db->NextRecord()){
            $c_cod = $db->Record['c_cod'];
            $color = $db->Record['color']; 
            $hex = $db->Record['hex']; 
            echo "<option style='background:#$hex' value='$c_cod'>$color</option>";
        } 
        
    }    
    function getRecepcionUpdateUI(){
        $db = new Y_DB();
        $db->Database =   $Global['project'];
        
        $id = $_REQUEST['id'];
        // Extrar Sector Grupo y Tipo y color de este ID 
        $db->Query("SELECT p_sector,  s.s_nombre AS Sector,p_grupo, g.g_nombre AS Grupo,p_tipo, t.t_nombre AS Tipo,p_color, c.color AS Color, c.hex as hex,p_ancho 
        FROM productos p, sector s, grupo g,tipo t, colores c  WHERE p.p_sector = s.s_cod AND p.p_grupo = g.g_cod AND p.p_tipo = t.t_cod 
        AND p.p_color = c.c_cod  
        AND p.id = $id");
        $db->NextRecord();
        $s_cod = $db->Record['p_sector'];
        $sector = $db->Record['Sector'];
            
        
        $g_cod = $db->Record['p_grupo'];
        $grupo = $db->Record['Grupo'];
        
        $t_cod = $db->Record['p_tipo'];
        $tipo = $db->Record['Tipo'];
        
        $c_cod = $db->Record['p_color'];
        $color = $db->Record['Color'];
        $color_hex = $db->Record['hex'];
        
        $ancho = $db->Record['p_ancho'];
        
        echo '<div style="width:99%;height:20px;border:solid gray 1px;margin-bottom:4px"><label>Actualizar datos</label></div>';    
        
        // Sector
        $db->Query("SELECT s_cod,s_nombre AS sector FROM sector");
        echo '<label> Sector: </label><select id="sector" onchange="getGrupos()">';
        echo "<option value='$s_cod'>$sector</option>";
        while($db->NextRecord()){
            $s_cod = $db->Record['s_cod'];
            $sector = $db->Record['sector']; 
            echo "<option value='$s_cod'>$sector</option>";
        }
        echo '</select>';
        
        // Grupo
        $db->Query("SELECT g_cod,g_nombre AS grupo FROM grupo g, grupos_x_sector gs WHERE   g.g_cod = gs.gc_cod AND gs.s_cod = $s_cod");
        echo '<label> Grupo: </label><select id="grupo" onchange="getTipos()">';
        echo "<option value='$g_cod'>$grupo</option>";
        while($db->NextRecord()){
            $g_cod = $db->Record['g_cod'];
            $grupo = $db->Record['grupo']; 
            echo "<option value='$g_cod'>$grupo</option>";
        }
        echo '</select>';
        
        // Tipo
        // Grupo
        $db->Query("SELECT t_cod,t_nombre AS tipo FROM tipo t, tipos_x_grupo tg  WHERE t.t_cod = tg.g_cod  AND tg.g_cod =   $g_cod");
        echo '<label> Tipo: </label><select id="tipo">';
        echo "<option value='$t_cod'>$tipo</option>";
        while($db->NextRecord()){
            $t_cod = $db->Record['t_cod'];
            $tipo = $db->Record['tipo']; 
            echo "<option value='$t_cod'>$tipo</option>";
        }
        echo '</select>&nbsp;&nbsp;<span id="msg"></span><br><br>';
        
        echo '<label> Ancho: </label><input size="8" style="text-align:right" type="text" id="ancho" value="'.$ancho.'">';
        // Colores
        echo '<label> Color: </label><input type="text" id="buscar_color" onchange="getColores()" value="">';
        echo '<select id="colores">';
        echo "<option value='$c_cod'>$color</option>";
        echo '</select> &nbsp;&nbsp; <input type="button" value="Actualizar Descripciones" onclick="actualizarDatos()">';
        
        // Precios
        echo '<div style="width:99%;height:20px;border:solid gray 1px;margin-bottom:4px;margin-top:4px;"><label>Actualizar Precios</label></div>';
        echo '<div style="float:left;width:26%"> <table border="1" cellspacing="2" cellpadding="0">';
        echo '<tr><th colspan="2" style="background:lightgray">Precios </th></tr>';
        echo '<tr><td><label> Valor Minimo:   </label></td></td><input class="num" type="text" id="valmin" value="" maxlength="10" size="10"></td></tr>';
        echo '<tr><td><label> Precio Venta 1: </label></td></td><input class="num" type="text" id="p1" value="" maxlength="10" size="10"></td></tr>';
        echo '<tr><td><label> Precio Venta 2: </label></td></td><input class="num" type="text" id="p2" value="" maxlength="10" size="10"></td></tr>';
        echo '<tr><td><label> Precio Venta 3: </label></td></td><input class="num" type="text" id="p3" value="" maxlength="10" size="10"></td></tr>';
        echo '<tr><td><label> Precio Venta 4: </label></td></td><input class="num" type="text" id="p4" value="" maxlength="10" size="10"></td></tr>';
        echo '<tr><td colspan="2" style="text-align:center"><input type="button" value="Actualizar Precios" onclick="actualizarPrecios()"></td></tr>';
        echo '</table></div><div style="float:right;width:72%;height:80px"> <br><input type="button" value="Imprimir Codigos Seleccionados" onclick="imprimir()"> </div>';
        
        echo '<div style="text-align:center">'
        . '<input type="button" value="Cerrar" onclick="cerrarPopup()">'
        . '</div>';
        
    }
    function eliminarCheque(){
       $db = new Y_DB();
       $db->Database =   $Global['project'];
       $id = $_REQUEST['id'];
       $factura = $_REQUEST['nro_factura'];
       $db->Query("DELETE FROM bcos_cheq_ter WHERE id = $id;");
       $this->mostrarChequesCaja($factura);
    }
    function registrarCheque(){
       $db = new Y_DB();
       $db->Database =   $Global['project'];
       $suc = $_REQUEST['suc'];
       $factura = $_REQUEST['nro_factura'];
       $benef   = $_REQUEST['benef'];  
       $banco = $_REQUEST['banco'];  
       $cta = $_REQUEST['cuenta'];  
       $nro_cheque = $_REQUEST['nro_cheque'];  
       $fecha_pago = $_REQUEST['fecha_pago'];  
            
       list($dia, $mes, $anio) = split('[/.-]', $fecha_pago);
       $fecha_pago_eng = "$anio-$mes-$dia";
       $fecha_emision = $_REQUEST['fecha_emision']; 
       list($dia, $mes, $anio) = split('[/.-]', $fecha_emision);
       $fecha_emis_eng = "$anio-$mes-$dia"; 
       $valor =    str_replace(".","",  $_REQUEST['valor']); 
       $valor =    str_replace(",",".",  $valor); 
       $db->Query("INSERT INTO  bcos_cheq_ter(chq_ref,chq_bco,chq_cta,chq_num,chq_benef,chq_fecha_emis,chq_fecha_pag,chq_valor,chq_moneda,chq_cotiz,chq_moneda_ref,chq_suc,chq_estado,chq_mot_anul,chq_fecha_ins,chq_trans,chq_saldo)
       VALUES('$factura','$banco','$cta','$nro_cheque','$benef','$fecha_emis_eng','$fecha_pago_eng',$valor,'G$',1,$valor,'$suc','Pendiente','',CURRENT_DATE,'1',$valor);");
            
       $this->mostrarChequesCaja($factura);
    }
    function mostrarChequesCaja($factura){
       $db = new Y_DB();
       $db->Database =   $Global['project'];
        // Mostrar Cheques
        $db->Query("SELECT c.id as id, chq_num  ,b.b_nombre AS banco, chq_benef,DATE_FORMAT(c.chq_fecha_pag,'%d-%m-%Y') AS fecha_pago, chq_valor,
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
                $chqs.="<tr> <td class='itemc'>$chq_num</td> <td>$banco</td> <td>$chq_benef</td> <td  class='itemc'>$fecha_pago</td> <td class='num'>$chq_valor</td> <td class='itemc'>$chq_moneda</td> <td class='num'>$chq_moneda_ref</td> <td class='itemc'>$chq_estado</td><td class='itemc'><img style='cursor:pointer' src='images/trash.png' onclick='delChq($id)'></td>  </tr>";
            }
            $chqs.="<tr> <td class='item' colspan='6'><img title='Agregar Cheque' src='images/add.png' style='cursor:pointer' onclick='addCheque()'></td> <td class='num' ><input class='input_mini num' size='12' readonly style='font-weight:bolder;font-size:14px;padding:0px;border:0px' id='total_cheques' type='text' value='$total_chqs_moneda_ref'> </td><td>&nbsp;</td></tr>";
            $chqs.="</table>";
        }else{
           $chqs = "<img src='images/add.png' title='Agregar Cheque' style='cursor:pointer' onclick='addCheque()' > <input type='hidden' id='total_cheques' value='0'>"; 
        }  
        echo $chqs;       
    }
    function getChequeTercerosUI(){
       $db = new Y_DB();
       $db->Database =   $Global['project'];
       $db->Query("SELECT b_cod, b_nombre FROM bcos ORDER BY b_nombre ASC");
       $bancos = '<select id="bancos" class="input_mini" style="width:260px">';
       while($db->NextRecord()){
           $bcod = $db->Record['b_cod'];
           $banco = $db->Record['b_nombre']; 
           $bancos.="<option value='$bcod' >$banco</option>";
       }
       $bancos.="</select>";
        
       $ui = '<form id="formID" class="formular" method="post" action="">'
               . '<table style="text-align: left; width: 100%;" border="0" cellpadding="0" cellspacing="0">'
               . '<tr><th colspan="2" style="text-align:center;border:solid gray 1px;background:rgb(240,240,240)">Datos del Cheque</th></tr>'
               . '<tr><th class="label_mini">Beneficiario:</th><td><input id="benef" class="input_mini" type="text" size="46" maxlength="60"> </td></tr>'
               . '<tr><th class="label_mini">Banco:</th><td>'.$bancos.'</td></tr>'
               . '<tr><th class="label_mini">Cuenta N&deg;:</th><td><input id="cuenta" class="input_mini" type="text"> </td></tr>'
               . '<tr><th class="label_mini">N&deg; Cheque:</th><td><input id="nro_cheque" class="input_mini" type="text"> </td></tr>'
               . '<tr><th class="label_mini">Fecha de Emision:</th><td><input id="fecha_emision" value="__/__/____" class="input_mini  fechas" maxlength="10" size="10" type="text"> </td></tr>'
               . '<tr><th class="label_mini">Fecha de Pago:</th><td><input id="fecha_pago" value="__/__/____" class="input_mini  fechas" maxlength="10" size="10" type="text"> </td></tr>'
               . '<tr><th class="label_mini">Valor en Gs:</th><td><input id="valor" class="input_mini numeric" size="16" style="text-align:right"  type="text"> </td></tr>'
               . '<tr><td colspan="2" style="text-align:center">  <input type="button" value="Cancelar" onclick="cerrarPopup()"> <input id="aceptar" type="button" value="Aceptar" disabled onclick="guardarCheque()"> </td></tr>'
               . '</table>'
               . '</form>';
            
       echo $ui;
    }
    function saveMargin(){
       $db = new Y_DB();
       $db->Database =   $Global['project'];
       $key = $_REQUEST['key'];
       $value = $_REQUEST['value'];
       $db->Query("UPDATE parametros SET valor = $value WHERE clave = '$key';");
       echo "UPDATE parametros SET valor = $value WHERE clave = '$key'";
    }
    function cerrarVenta(){
       $db = new Y_DB();
       $db->Database =   $Global['project'];
       $usuario = $_REQUEST['usuario'];
       $nro_factura = $_REQUEST['nro_factura'];
       $cj_ref = $_REQUEST['cj_ref'];
       $efectivo = $_REQUEST['efectivo'];
       $moneda = $_REQUEST['moneda'];  
       $cotiz = $_REQUEST['cotiz'];
       $tarjeta = $_REQUEST['tarjeta'];
       $voucher = $_REQUEST['voucher']; 
       $conv = $_REQUEST['conv_cod'];  
       $vuelto = $_REQUEST['vuelto'];  
       $tipo = $_REQUEST['tipo'];  
       
       $efectivo_ref = $efectivo * $cotiz;
       
       $sqlf = "SELECT cerrar_venta($nro_factura,$efectivo_ref,'$moneda',$cotiz,'$voucher',$conv,$tarjeta,'$tipo')";
       $db->Query($sqlf);
       
       if($efectivo > 0){
          $db->Query("SELECT caja_ins_aciento($cj_ref,CURRENT_DATE,'$usuario',$efectivo,'$moneda',$cotiz,'E',3,'Factura Nro: $nro_factura','$nro_factura')"); 
       }
       if($vuelto > 0){
          $db->Query("SELECT caja_ins_aciento($cj_ref,CURRENT_DATE,'$usuario',$vuelto,'G$',1,'S',4,'Vuelto Factura Nro: $nro_factura','$nro_factura')");  
       }
       
       // Log
       $desc = fopen( "../log/plus_sql.log", "a" );            
       $time  = date("[d.m.Y H:i]");
       fputs( $desc, $time." (Sistema) >Efectivo: $efectivo| Cotiz:  $cotiz". $sqlf . "\n" );
       fclose( $desc );
       
       echo "Ok";
       
    }
    function obtenerCambioVenta(){
        $moneda = $_REQUEST['moneda']; 
        $db = new Y_DB();
		$db->Database =   $Global['project'];
        $db->Query("select obtener_cambio_venta('$moneda') as cotiz");
        if($db->NumRows()>0){
           $db->NextRecord();
           $cotiz = $db->Record['cotiz'];
           echo $cotiz;
        }else{
            echo "1";
        }
    }  
    function obtenerCambioCompra(){
        $moneda = $_REQUEST['moneda']; 
        $db = new Y_DB();
		$db->Database =   $Global['project'];
        $db->Query("select obtener_cambio('$moneda') as cotiz");
        if($db->NumRows()>0){
           $db->NextRecord();
           $cotiz = $db->Record['cotiz'];
           echo $cotiz;
        }else{
            echo "1";
        }
    }	
            
}

new Ajax();
?>



 



