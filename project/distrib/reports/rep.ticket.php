<?php
/** project/distrib/reports/rep.ticket.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "ticket";
$Obj->alias = "Ticket de Venta";
$Obj->ndoc = "Ticket de Venta";
$Obj->help = "Ticket de Venta";
$Obj->query = "'SELECT d_codigo,d_descrip,d_precio,d_cant,d_um,d_subtotal FROM fact_vent_det WHERE d_fact = '+el['f_nro']+' ' ";
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
