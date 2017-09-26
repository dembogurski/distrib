<?php
/** project/distrib/reports/rep.facturas_impres.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "facturas_impres";
$Obj->alias = "Facturas Impresas";
$Obj->ndoc = "Facturas Impresas";
$Obj->help = "Facturas Impresas";
$Obj->query = "'SELECT f.f_nro AS Interno,date_format(c.f_fecha,|{%d-%m-%Y}|) as Fecha, cl.cli_nombre AS Cliente,cl.cli_ci AS RUC,c.f_pdv AS P_Exp,LPAD(c.f_nro,6,|{0}|) AS Factura,f.f_tipo as Tipo,c.f_total AS Total FROM factura_venta f, fact_cont c, clientes cl WHERE f.f_nro = c.f_ref AND f.f_cli_cod = cl.cli_id AND f.f_estado = |{Cerrada}| AND c.f_estado = |{Cerrada}| AND f.f_fecha BETWEEN '+el['desde']+' AND '+el['hasta']+' order by f.f_fecha asc '";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "";
$Obj->pre_sub = "";
$Obj->cond_sub = "endConsult";
$Obj->subtotal = "Total";
$Obj->dec_sub = "0";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "";
$Obj->query_end = "";
?>
