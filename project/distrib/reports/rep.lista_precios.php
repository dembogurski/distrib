<?php
$Obj->name = "lista_precios";
$Obj->alias = "Lista de Precios";
$Obj->ndoc = "Lista de Precios";
$Obj->help = "Lista de Precios";
$Obj->query = "'SELECT a.codigo AS Codigo,a.p_descrip AS Descripcion,SUM(IF(num = 1,precio_unit,0)) AS Precio1, SUM(IF(num = 2,precio_unit,0)) AS Precio2,SUM(IF(num = 3,precio_unit,0)) AS Precio3,SUM(IF(num = 4,precio_unit,0)) AS Precio4  FROM articulos a, lista_precios l  WHERE a.codigo = l.codigo and a.p_descrip like concat(|{%}|,'+el['articulo']+',|{%}|) GROUP BY a.codigo ORDER BY a.p_descrip ASC '";
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
