<?php
/** project/delavictoria/reports/rep.ventas_credito.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "ventas_credito";
$Obj->alias = "Ventas a Credito";
$Obj->ndoc = "Ventas a Credito";
$Obj->help = "Ventas a Credito";
$Obj->query = "'SELECT f_nro AS Ref,f_fact_cont AS Factura,c_nro_cuota AS Nro_Cuota,b.cli_ci AS Ruc, b.cli_nombre AS Cliente,DATE_FORMAT(f_fecha,|{%d-%m-%Y}|) AS Fecha,c_monto_ref AS ValorCuota,  DATE_FORMAT(c_venc,|{%d-%m-%Y}|) AS Vencimiento,c_entrega AS Entrega,c_saldo AS Saldo,c_estado AS Estado     FROM factura_venta f, cuotas c, clientes b WHERE f.f_nro = c.c_fact AND f.f_cli_cod = b.cli_id  AND f.f_cli_cod LIKE '+el['c_cli_cod']+'  AND c_venc BETWEEN '+el[desde]+' AND '+el[hasta]+' and c.c_estado LIKE '+el[estado]+'   AND f.f_estado = |{Cerrada}| ORDER BY Ref ASC ,c_nro_cuota ASC '";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "1";
$Obj->pre_sub = "";
$Obj->cond_sub = "endConsult";
$Obj->subtotal = "ValorCuota,Entrega,Saldo";
$Obj->dec_sub = "2";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "";
$Obj->query_end = "";
?>
