<?php
/** project/delavictoria/reports/rep.comport_cli.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "comport_cli";
$Obj->alias = "Reporte de Comportamiento de Cliente";
$Obj->ndoc = "Reporte de Comportamiento de Cliente";
$Obj->help = "Reporte de Comportamiento de Cliente";
$Obj->query = "'SELECT CONCAT(p.codigo,|{-}|,p_descrip) AS Articulo, SUM(IF(d_precio BETWEEN 0 AND 30000,d_subtotal,0)) AS 0_30 ,SUM(IF(d_precio BETWEEN 30001 AND 60000,d_subtotal,0)) AS 30_60 ,SUM(IF(d_precio BETWEEN 60001 AND 90000,d_subtotal,0)) AS 60_90 , SUM(IF(d_precio BETWEEN 90001 AND 120000,d_subtotal,0)) AS 90_120 , SUM(IF(d_precio BETWEEN 120001 AND 150000,d_subtotal,0)) AS 120_150 , SUM(IF(d_precio BETWEEN 150001 AND 200000,d_subtotal,0)) AS 150_200 , SUM(IF(d_precio BETWEEN 200001 AND 250000,d_subtotal,0)) AS 200_250 , SUM(IF(d_precio BETWEEN 250001 AND 300000,d_subtotal,0)) AS 250_300 , SUM(IF(d_precio BETWEEN 300001 AND 100000000,d_subtotal,0)) AS 300_INFINITO FROM factura_venta f, fact_vent_det d, articulos p   WHERE    f.f_nro = d.d_fact AND d.d_codigo = p.codigo AND f.f_estado = |{Cerrada}|  AND f.f_cli_cod = '+el['f_cli_cod']+'  AND f.f_fecha BETWEEN '+el['desde']+' AND '+el['hasta']+' GROUP BY Articulo'";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "";
$Obj->pre_sub = "";
$Obj->cond_sub = "endConsult";
$Obj->subtotal = "0_30,30_60,60_90,90_120,120_150,150_200,200_250,250_300,300_INFINITO";
$Obj->dec_sub = "0";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "";
$Obj->query_end = "";
?>
