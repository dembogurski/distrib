<?php
/** project/delavictoria/reports/rep.caja.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "caja";
$Obj->alias = "Caja";
$Obj->ndoc = "Caja";
$Obj->help = "Caja";
$Obj->query = "'SELECT f_nro AS Nro,DATE_FORMAT(f_fecha,|{%d-%m-%Y}|) AS Fecha, f_usuario AS Usuario, cli_tipo_doc AS TipoDoc, cli_ci AS Doc, cli_nombre AS Cliente,SUM(d_subtotal) AS TOTAL FROM factura_venta f, clientes c, fact_vent_det d WHERE f.f_nro = d.d_fact AND f.f_cli_cod = c.cli_id AND  f_nro = '+el['f_nro']+'GROUP BY f_nro '";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "";
$Obj->pre_sub = "";
$Obj->cond_sub = "";
$Obj->subtotal = "";
$Obj->dec_sub = "";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "";
$Obj->query_end = "";
?>
