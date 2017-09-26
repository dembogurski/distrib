<?php
$Obj->name = "nota_credito";
$Obj->alias = "Nota de Credito";
$Obj->ndoc = "Nota de Credito";
$Obj->help = "Nota de Credito";
$Obj->query = "'select d_fact as Factura,d_codigo as Codigo,d_descrip as Descrip,d_cant_dv as Cantidad,d_precio as Precio,d_subtotal as SubTotal  FROM nota_credito_det where d_fact = '+el['n_nro']+''";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "1";
$Obj->pre_sub = "";
$Obj->cond_sub = "endConsult";
$Obj->subtotal = "SubTotal";
$Obj->dec_sub = "0";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "";
$Obj->query_end = "";
?>
