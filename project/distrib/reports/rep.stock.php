<?php
/** project/delavictoria/reports/rep.stock_sgtc.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "stock_sgtc";
$Obj->alias = "Reporte de Stock General";
$Obj->ndoc = "Reporte de Stock General";
$Obj->help = "Reporte de Stock General";
$Obj->query = "'SELECT a.codigo as Codigo,a.p_descrip as Descripcion,p_costo_prom as CostoPromedio,p_um as UM,suc,cantidad as Cantidad, cantidad * p_costo_prom AS Valor FROM articulos a, stock s WHERE a.codigo = s.codigo AND a.codigo LIKE '+el['d_codigo']+' AND cantidad > '+el['p_cant']+'  GROUP BY codigo,suc ORDER BY codigo ASC '";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "1";
$Obj->pre_sub = "";
$Obj->cond_sub = "endConsult";
$Obj->subtotal = "Cantidad,Valor";
$Obj->dec_sub = "2";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "";
$Obj->query_end = "";
?>
