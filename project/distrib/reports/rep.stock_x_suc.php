<?php
/** project/distrib/reports/rep.stock_x_suc.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "stock_x_suc";
$Obj->alias = "Cantidades";
$Obj->ndoc = "Cantidades";
$Obj->help = "Cantidades";
$Obj->query = "'SELECT s.id AS id,s.codigo as Codigo,a.p_descrip as Descrip, a.p_um as UM,suc as Suc,cantidad as Cantidad FROM articulos a,stock s WHERE a.codigo  = s.codigo AND s.codigo = '+el[codigo]+'  GROUP BY suc'";
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
