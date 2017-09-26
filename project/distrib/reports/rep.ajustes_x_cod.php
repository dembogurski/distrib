<?php
$Obj->name = "ajustes_x_cod";
$Obj->alias = "Ajustes x Codigo";
$Obj->ndoc = "Ajustes x Codigo";
$Obj->help = "Ajustes x Codigo";
$Obj->query = "'SELECT aj_prod AS Codigo,DATE_FORMAT( aj_fecha,|{%d-%m-%Y}|) AS Fecha,aj_hora AS Hora, aj_usuario AS Usuario, aj_oper AS Oper,aj_signo AS Signo,aj_inicial AS Inicial,  IF(aj_signo != |{-}|,aj_ajuste,0) AS Aj_Positivo,IF(aj_signo = |{-}|,aj_ajuste,0) AS Aj_Negativo, aj_final AS Final,  aj_motivo AS Motivo  FROM ajustes WHERE aj_prod = '+el[p_cod]+''";
$Obj->del_prg = "";
$Obj->del_tpl = "";
$Obj->tot = "1";
$Obj->pre_sub = "";
$Obj->cond_sub = "endConsult";
$Obj->subtotal = "Aj_Positivo,Aj_Negativo";
$Obj->dec_sub = "2";
$Obj->cond_tot = "";
$Obj->total = "";
$Obj->dec_tot = "";
$Obj->query_end = "";
?>
