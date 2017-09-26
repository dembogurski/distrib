<?php
/** project/delavictoria/reports/rep.recup_compras.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "recup_compras";
$Obj->alias = "Reporte de Recuperacion de Compras";
$Obj->ndoc = "Reporte de Recuperacion de Compras";
$Obj->help = "Reporte de Recuperacion de Compras";
$Obj->query = "'SELECT c_ref AS Ref,DATE_FORMAT(c_fecha,|{%d-%m-%Y}|) AS Fecha,DATE_FORMAT(c_fecha_fac,|{%d-%m-%Y}|) AS FechaFactura,prov_nombre AS Proveedor,c_factura AS Factura,c_moneda AS Moneda,c_cotiz AS Cotiz,c_valor_total AS ValorTotal,c_porc_rec AS Rec,c_estado AS Estado  FROM factura_compra c, proveedores p WHERE c.c_prov = p.prov_cod    AND c_fecha BETWEEN '+el['desde']+' AND '+el['hasta']+' '";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "1";
$Obj->pre_sub = "";
$Obj->cond_sub = "endConsult";
$Obj->subtotal = "ValorTotal";
$Obj->dec_sub = "2";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "";
$Obj->query_end = "";
?>
