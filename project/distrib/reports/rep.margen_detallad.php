<?php
/** project/delavictoria/reports/rep.margen_detallad.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "margen_detallad";
$Obj->alias = "Margen Detallado Sobre Ventas";
$Obj->ndoc = "Margen Detallado Sobre Ventas";
$Obj->help = "Margen Detallado Sobre Ventas";
$Obj->query = "'SELECT f_nro AS Factura,d.d_codigo AS Codigo,d.d_descrip , ROUND(p_compra - (p_compra *  c_porc_rec / 100),2) AS   P_Compra,d_cant_v AS Cant_Vendida,ROUND( (p_compra - (p_compra *  c_porc_rec / 100) ) * d_cant_v,2) AS Costo, d.d_subtotal AS SubTotal,ROUND(d_subtotal - ((p_compra - (p_compra *  c_porc_rec / 100) ) * d_cant_v),2) AS Margen FROM factura_venta f, fact_vent_det d, factura_compra c, fact_comp_det fd WHERE  f.f_nro  = d.d_fact AND d.d_codigo = fd.p_cod_art AND  c.c_ref = fd.p_ref AND f.f_estado = |{Cerrada}|  AND f.f_fecha BETWEEN '+el[desde]+' AND '+el[hasta]+' '";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "1";
$Obj->pre_sub = "";
$Obj->cond_sub = "endConsult";
$Obj->subtotal = "Costo,SubTotal,Margen";
$Obj->dec_sub = "2";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "";
$Obj->query_end = "";
?>
