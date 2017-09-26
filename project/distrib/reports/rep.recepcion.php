<?php
/** project/delavictoria/reports/rep.recepcion.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "recepcion";
$Obj->alias = "Recepcion de Mercaderias";
$Obj->ndoc = "Recepcion de Mercaderias";
$Obj->help = "Recepcion de Mercaderias";
$Obj->query = "'SELECT p.id AS ID,pr.prov_nombre AS Proveedor,p_st AS StoreNum,p.p_cod AS Codigo, s.s_nombre AS Sector,g.g_nombre AS Grupo,t.t_nombre AS Tipo,c.color AS Color,  p_um AS Um,p_cant_compra AS Cant_Compra,p_cant AS Cant_Stock, p_descri AS Descrip,p_ancho AS Ancho, p_estado AS Estado, p_valmin,p_precio_1,p_precio_2,p_precio_3,p_precio_4   FROM factura_compra f, proveedores pr, productos p, sector s, grupo g,tipo t, colores c   WHERE f.c_ref = p.p_ref AND f.c_estado = |{Abierta}| AND f.c_prov = pr.prov_cod    AND p.p_sector = s.s_cod AND p.p_grupo = g.g_cod AND p.p_tipo = t.t_cod AND p.p_color = c.c_cod  AND   prov_nombre like concat('+el['prov']+',|{%}|) and p_st LIKE '+el['st']+' and p_estado LIKE '+el['estado']+'   ORDER BY p_st ASC, p_sector,p_grupo,p_tipo,p_color,p_descri'";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "1";
$Obj->pre_sub = "";
$Obj->cond_sub = "endConsult";
$Obj->subtotal = "Cant_Compra,Cant_Stock";
$Obj->dec_sub = "2";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "";
$Obj->query_end = "";
?>
