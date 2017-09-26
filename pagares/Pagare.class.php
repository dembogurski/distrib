<?php

/**
 * Description of Pagare
 * @author Ing.Douglas
 * @date 27/04/2015
 */
 
require_once("../include/Y_Template.class.php");
require_once("../include/Y_DB.class.php"); 
require_once("../include/functions.php");

class Pagare {
    
   function __construct() {
 
        $T = new Y_Template("Pagare.html");       

        $T->Set( 'time', date("m-d-Y h:i") );
        $T->Set( 'user', $_REQUEST['usuario'] );
        $T->Set( 'papar_size', $_REQUEST['papar_size'] );
        
        $project= $_REQUEST['project'];
        
        $REF = $_REQUEST['factura'];
        $T->Set( 'factura', $REF );

        $PG_NRO = $_REQUEST['nro_pg'];
        $T->Set( 'pg_nro', $PG_NRO );

        $Q = new Y_DB(); 
        $Q->Database =   $project;   
        $Q->Query("SELECT count(c_nro_cuota) as cant FROM cuotas c WHERE c_fact = $REF LIMIT 1");
        $Q->NextRecord();
        $BARRA = $Q->Record['cant'];
        $T->Set('barra',$BARRA);

        $Q0 = new Y_DB();
        $Q0->Database =   $project;   
        $query0 = "SELECT c_fact AS REF,c_nro_cuota AS NRO, c_monto_ref AS MONTO, c_moneda AS MONEDA,m_descri as NOMBRE_MONEDA, DATE_FORMAT(c_venc,'%d') AS DIA_VENC, DATE_FORMAT(c_venc,'%m') AS MES_VENC,DATE_FORMAT(c_venc,'%Y') AS ANIO_VENC "
                . "FROM cuotas c, caja_monedas m WHERE c.c_moneda = m.m_cod AND c_fact = '$REF'  AND c_nro_cuota = '$PG_NRO' ";

        $Q0->Query( $query0 );

        // Starting a HTML
        $T->Show('general_header');			// Principal Header
        $T->Show('start_query0');			// Start a Table 
        $T->Show('header0');				// Show Header

        $dia_hoy = date("d");
        $este_mes = date("m");
        $este_anio = date("Y");

        $SUC = $_REQUEST['suc'];
         

        $DENOMINACION = 'Irmo Ocampos';


        $id = $_REQUEST['id_cliente'];

        $ms =  new Y_DB();
        $ms->Database =   $project; 

        $ms->Query("SELECT cli_ci, cli_nombre,cli_tel,cli_dir,cli_ciudad FROM clientes WHERE cli_id = '$id' ");
        $ms->NextRecord();
        $RUC = $ms->Record['cli_ci'];
        $CLIENTE = $ms->Record['cli_nombre'];
        $TEL = $ms->Record['cli_tel'];
        
        
        $DIR = $ms->Record['cli_dir'];
        $CIUDAD = $ms->Record['cli_ciudad'];

        $doc =  str_replace("*","",$RUC);	

        $T->Set('ci',$doc);
        $T->Set('cliente',$CLIENTE);
        $T->Set('tel',$TEL);
        $T->Set('dir',$DIR);
        $T->Set('ciudad',$CIUDAD); 
        $Q->Query("SELECT emp_dir, emp_ciudad FROM empresas WHERE emp_cod = '$SUC' limit 1");
        $Q->NextRecord();
        $CIU = $Q->Record['emp_ciudad'];
        $EMP_DIR = $Q->Record['emp_dir'];

        //$CIU = "Encarnaci&oacute;n";
        $T->Set('emp_ciu',$CIU);

        $EMP_DIR = str_replace("é","&eacute;",$EMP_DIR);
        $EMP_DIR = str_replace("ñ","&ntilde;",$EMP_DIR);

        $T->Set('emp_dir',$EMP_DIR);


        //echo "$dia_hoy    $este_mes    $este_anio";

        //Define a  variable
        $endConsult = false;
        //Define a Total Variables

        //Define a Subtotal Variables


        //Define a Old Values Variables
        $old['REF'] = '';
        $old['NRO'] = '';
        $old['MONTO'] = '';
        $old['DIA_VENC'] = '';
        $old['MES_VENC'] = '';
        $old['ANIO_VENC'] = '';
        $old['MONEDA'] = '';  
        $old['NOMBRE_MONEDA'] = '';
        // Making a rows of consult
        while( $Q0->NextRecord() ){

            // Define a elements
            $el['REF'] = $Q0->Record['REF'];
            $el['NRO'] = $Q0->Record['NRO'];
            $el['MONTO'] = $Q0->Record['MONTO'];
            $el['DIA_VENC'] = $Q0->Record['DIA_VENC'];
            $el['MES_VENC'] = $Q0->Record['MES_VENC'];
            $el['ANIO_VENC'] = $Q0->Record['ANIO_VENC'];
            $el['MONEDA'] = str_replace("$","s",$Q0->Record['MONEDA']); 
            $el['NOMBRE_MONEDA'] = $Q0->Record['NOMBRE_MONEDA'];
            
            // Preparing a template variables
            $T->Set('query0_REF', $el['REF']);
            $T->Set('query0_NRO', $el['NRO']);
            
            $T->Set('query0_DIA_VENC', $el['DIA_VENC']);
            $T->Set('query0_MES_VENC',$el['MES_VENC'] );
            $T->Set('query0_ANIO_VENC', $el['ANIO_VENC']);
            $T->Set('MONEDA', $el['MONEDA']);
            $T->Set('NOMBRE_MONEDA', $el['NOMBRE_MONEDA']);
            $type = 0;
            if($el['MONEDA']!="G$"){
               $type = 1; 
               $T->Set('query0_MONTO', number_format($el['MONTO'],2,',','.'));
            }else{
               $T->Set('query0_MONTO', number_format($el['MONTO'],0,',','.'));
            }

            $meses = array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio",
                           "08"=>"Agosto","09"=>"Setiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre"); 

            $T->Set('query0_MES_VENC_LETRAS',$meses[$el['MES_VENC']]);
            $T->Set('dia_hoy',$dia_hoy);
            $T->Set('este_anio',$este_anio);
            $T->Set('este_mes',$meses[$este_mes]);
            $T->Set('denominacion',$DENOMINACION);
            
             
           
            $monto_en_letras = extense($el['MONTO'],$el['NOMBRE_MONEDA'],$type);
            $T->Set('monto_en_letras',$monto_en_letras);

            $T->Show('query0_data_row');

            $old['REF'] = $el['REF'];
            $old['NRO'] = $el['NRO'];
            $old['MONTO'] = $el['MONTO'];
            $old['DIA_VENC'] = $el['DIA_VENC'];
            $old['MES_VENC'] = $el['MES_VENC'];
            $old['ANIO_VENC'] = $el['ANIO_VENC']; 
            $old['MONEDA'] = $el['MONEDA'];
            $old['NOMBRE_MONEDA'] = $el['NOMBRE_MONEDA'];
      
}

 
if( true ){
    $T->Show('query0_subtotal_row');
}
// Show total
if( true ){
    $T->Show('query0_total_row');
}
$T->Show('end_query0'); 
   }
}
new Pagare();
?>
