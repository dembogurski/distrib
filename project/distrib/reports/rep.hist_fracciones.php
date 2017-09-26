<?php
/** project/delavictoria/reports/rep.hist_fracciones.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "hist_fracciones";
$Obj->alias = "Historial de Fraccionamientos";
$Obj->ndoc = "Historial de Fraccionamientos";
$Obj->help = "Historial de Fraccionamientos";
$Obj->query = "'SELECT p.p_cod AS Codigo, p_padre AS Padre,s.s_nombre AS Sector,g.g_nombre AS Grupo, t.t_nombre AS Tipo,c.color AS Color,    p_um AS UM,p_cant_compra AS CantFrac,p_cant AS Stock,p_estado AS Estado      FROM   productos p,sector s,grupo g,tipo t,colores c      WHERE c.c_cod=p_color AND t.t_cod=p_tipo AND g.g_cod=p_grupo AND s.s_cod=p_sector AND p_padre = '+el['p_cod']+'  '";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "";
$Obj->pre_sub = "";
$Obj->cond_sub = "endConsult";
$Obj->subtotal = "CantFrac";
$Obj->dec_sub = "2";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "2";
$Obj->query_end = "";
?>
