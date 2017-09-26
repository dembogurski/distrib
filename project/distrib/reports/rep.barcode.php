<?php
$Obj->name = "barcode";
$Obj->alias = "Impresion de Codigos de Barras";
$Obj->ndoc = "Impresion de Codigos de Barras";
$Obj->help = "Impresion de Codigos de Barras";
$Obj->query = "'SELECT p_cod AS codigo,p_precio_1 AS precio,s.s_nombre AS sector,g.g_nombre AS grupo,t.t_nombre AS tipo,c.color AS color FROM productos p, sector s, grupo g, tipo t, colores c WHERE p_ref = '+el['c_ref']+' AND p.p_sector = s.s_cod AND p.p_grupo = g.g_cod AND p.p_tipo = t.t_cod AND p.p_color = c.c_cod and p_cod like |{%}|'";
$Obj->del_tpl = "";
$Obj->del_prg = "";
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
