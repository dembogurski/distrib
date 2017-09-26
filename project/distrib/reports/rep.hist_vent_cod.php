<?php
/** project/delavictoria/reports/rep.hist_vent_cod.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "hist_vent_cod";
$Obj->alias = "Historial de Ventas x Codigo";
$Obj->ndoc = "Historial de Ventas x Codigo";
$Obj->help = "Historial de Ventas x Codigo";
$Obj->query = "'SELECT f_nro AS Ref,f.f_fact_cont AS Factura,f_cat AS Cat,DATE_FORMAT(f_fecha,|{%d-%m-%Y}|) AS Fecha,f_usuario AS Usuario,     f.f_tipo AS Tipo,c.cli_ci AS RUC,c.cli_nombre AS Cliente,d.d_cant_v AS CantV,d.d_um AS UM,d.d_precio AS PrecioV      FROM  factura_venta f, clientes c , fact_vent_det d WHERE f.f_nro = d.d_fact AND f.f_estado = |{Cerrada}| AND f.f_cli_cod = c.cli_id AND d.d_codigo = '+el[p_cod]+''";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "1";
$Obj->pre_sub = "";
$Obj->cond_sub = "endConsult";
$Obj->subtotal = "CantV";
$Obj->dec_sub = "2";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "";
$Obj->query_end = "";
?>
