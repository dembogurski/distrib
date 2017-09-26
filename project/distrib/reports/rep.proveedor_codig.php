<?php
/** project/delavictoria/reports/rep.proveedor_codig.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "proveedor_codig";
$Obj->alias = "Proveedor de Articulo";
$Obj->ndoc = "Proveedor de Articulo";
$Obj->help = "Proveedor de Articulo";
$Obj->query = "'SELECT p_cod AS Codigo,p_padre as CodPadre,prov_cod AS CodProv, pr.prov_nombre AS Proveedor,p.p_st AS StoreNumber_SV,pr.prov_ciudad AS Ciudad,prov_dir AS Dir,DATE_FORMAT(c.c_fecha,|{%d-%m-%Y}|) AS FechaGen,DATE_FORMAT(c.c_fecha_fac,|{%d-%m-%Y}|) AS FechaFactura, p.p_cant_compra AS CantCompra FROM factura_compra c, productos p, proveedores pr WHERE c.c_ref = p.p_ref AND c.c_prov = pr.prov_cod AND p.p_cod =  '+el['p_cod']+''";
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
