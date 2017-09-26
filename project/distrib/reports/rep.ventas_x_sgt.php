<?php
/** project/delavictoria/reports/rep.ventas_x_sgt.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "ventas_x_sgt";
$Obj->alias = "Ventas por Sector Grupo y Tipo";
$Obj->ndoc = "Ventas por Sector Grupo y Tipo";
$Obj->help = "Ventas por Sector Grupo y Tipo";
$Obj->query = "'SELECT p.p_cod AS Codigo, s.s_nombre AS Sector, g.g_nombre AS Grupo, t.t_nombre AS Tipo, p_descri AS Descrip,  d.d_cant_v AS CantVendida, d.d_precio AS PrecioVenta,d.d_subtotal AS Subtotal FROM productos p, factura_venta f, fact_vent_det d,sector s, grupo g, tipo t  WHERE p.p_cod like '+el['codigo']+' and f.f_nro = d.d_fact AND p.p_cod = d.d_codigo AND p.p_sector = s.s_cod AND p.p_grupo = g.g_cod AND p.p_tipo = t.t_cod AND f.f_fecha BETWEEN '+el['desde']+' AND '+el['hasta']+' AND p.p_sector = '+el['p_sector']+' AND p.p_grupo LIKE '+el['p_grupo']+' AND p.p_tipo LIKE '+el['p_tipo']+'  AND p.p_descri LIKE '+el['p_descri']+' AND f.f_suc LIKE '+el['suc']+'  '";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "";
$Obj->pre_sub = "";
$Obj->cond_sub = "endConsult";
$Obj->subtotal = "CantVendida,PrecioVenta,Subtotal";
$Obj->dec_sub = "2";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "";
$Obj->query_end = "";
?>
