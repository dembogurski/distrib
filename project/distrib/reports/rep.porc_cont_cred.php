<?php
/** project/delavictoria/reports/rep.porc_cont_cred.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "porc_cont_cred";
$Obj->alias = "Ventas Contado vs Credito";
$Obj->ndoc = "Ventas Contado vs Credito";
$Obj->help = "Ventas Contado vs Credito";
$Obj->query = "'SELECT c.cli_nombre AS Cliente, DATE_FORMAT(f_fecha, |{%d-%m-%Y}|) AS Fecha, SUM(IF(f_cob_efectivo IS NOT NULL,f_cob_efectivo,0)) AS Contado,SUM(IF(c_monto_ref IS NOT NULL,c_monto_ref,0)) AS Financiado  FROM factura_venta f INNER JOIN clientes c ON f.f_cli_cod = c.cli_id LEFT JOIN cuotas ct ON f.f_nro = ct.c_fact WHERE f.f_estado = |{Cerrada}| and f.f_fecha between '+el['desde']+' and '+el['hasta']+' and c.cli_id like '+el['c_cli_cod']+'  GROUP BY Cliente, Fecha ORDER BY  cli_id asc, f_fecha asc'";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "1";
$Obj->pre_sub = "1";
$Obj->cond_sub = "el['Cliente']!=old['Cliente']";
$Obj->subtotal = "Contado,Financiado";
$Obj->dec_sub = "2";
$Obj->cond_tot = "endConsult";
$Obj->total = "Contado,Financiado";
$Obj->dec_tot = "2";
$Obj->query_end = "";
?>
