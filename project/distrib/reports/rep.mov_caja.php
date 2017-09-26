<?php
$Obj->name = "mov_caja";
$Obj->alias = "Reporte de Movimientos de Caja";
$Obj->ndoc = "Reporte de Movimientos de Caja";
$Obj->help = "Reporte de Movimientos de Caja";
$Obj->query = "'select m.id as ID, DATE_FORMAT( __date,|{%d-%m-%Y}|)   as FECHA,__user as USUARIO,__moneda as MONEDA, __cotiz AS COTIZ, monto as MONTO,cjc_descri as CONCOPTO, compl as COMPLEMENTO, entrada_ref as E_REF, salida_ref as S_REF from caja cj, caja_mov m, caja_con c  where cj.cj_ref = m.cj_ref and  m.concepto = c.cjc_cod and cj.cj_suc  = '+el['suc']+' and __date BETWEEN '+el['desde']+' and '+el['hasta']+' order by id asc '";
$Obj->del_tpl = "";
$Obj->del_prg = "";
$Obj->tot = "1";
$Obj->pre_sub = "";
$Obj->cond_sub = "endConsult";
$Obj->subtotal = "E_REF,S_REF";
$Obj->dec_sub = "0";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "";
$Obj->query_end = "";
?>


