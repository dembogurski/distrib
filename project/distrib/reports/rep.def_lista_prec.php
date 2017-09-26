<?php
/** project/distrib/reports/rep.def_lista_prec.php    ( db_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Obj->name = "def_lista_prec";
$Obj->alias = "Definicion de Precios";
$Obj->ndoc = "Definicion de Lista de Precios";
$Obj->help = "Definicion de Lista de Precios";
$Obj->query = "'SELECT codigo,num,precio_unit, p.valor FROM lista_precios l, parametros p WHERE CONCAT(|{margen_}|,l.num) = p.clave AND codigo = '+el[codigo]+' '";
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
