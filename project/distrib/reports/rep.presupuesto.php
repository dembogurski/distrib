<?php
$Obj->name = "presupuesto";
$Obj->alias = "Presupuesto";
$Obj->ndoc = "Presupuesto de Venta";
$Obj->help = "Presupuesto de Venta";
$Obj->query = "'SELECT |{ }| AS Nro,d_codigo AS Codigo,d_descrip AS Descrip,d_cant AS Cant,d_um AS Um,d_cant_v AS CantV,d_precio AS Precio,d_subtotal AS SubTotal  FROM fact_vent_det WHERE d_fact = '+el['f_nro']+' '";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "1";
$Obj->pre_sub = "";
$Obj->cond_sub = "endConsult";
$Obj->subtotal = "SubTotal ";
$Obj->dec_sub = "2";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "";
$Obj->query_end = "";
?>
