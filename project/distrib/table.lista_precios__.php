<?php
/** distrib/table.lista_precios__.php   ( table_form )
 * 
 * @author 	ycube RAD Plus ( automatically Generated ) 
 * 
 */ 

$Table->name  = "lista_precios";
$Table->index = "";

$Table->Add(
    array(
        F_NAME_ => "id",
        F_TYPE_ => "INT UNSIGNED",
        F_NULL_ => "NOT NULL",
        F_KEY_ => "PRI",
        F_DEFAULT_ => "NULL",
        F_EXTRA_ => "AUTO_INCREMENT"));

$Table->Add(
    array(
        F_NAME_ => "codigo",
        F_TYPE_ => "varchar(20)",
        F_NULL_ => "",
        F_KEY_ => "",
        F_DEFAULT_ => "",
        F_EXTRA_ => "",
        F_NODB_ => "",
        F_UNIQ_ => ""));

$Table->Add(
    array(
        F_NAME_ => "num",
        F_TYPE_ => "INT",
        F_NULL_ => "",
        F_KEY_ => "",
        F_DEFAULT_ => "",
        F_EXTRA_ => "",
        F_NODB_ => "",
        F_UNIQ_ => ""));

$Table->Add(
    array(
        F_NAME_ => "precio_unit",
        F_TYPE_ => "DOUBLE(16,2)",
        F_NULL_ => "",
        F_KEY_ => "",
        F_DEFAULT_ => "",
        F_EXTRA_ => "",
        F_NODB_ => "",
        F_UNIQ_ => ""));

$Table->Add(
    array(
        F_NAME_ => "__lock",
        F_TYPE_ => "varchar(60)",
        F_NULL_ => "",
        F_KEY_ => "",
        F_DEFAULT_ => "",
        F_EXTRA_ => "",
        F_NODB_ => "1",
        F_UNIQ_ => ""));

?>
