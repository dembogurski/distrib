<?php
$Obj->name = "rep_ventas";
$Obj->alias = "Reporte de Ventas";
$Obj->help = "Reporte de Ventas";
$Obj->copy_from = "";
$Obj->Inheritance = "";
$Obj->File = "tmp";
$Obj->Filter = "";
$Obj->Sort = "";
$Obj->p_insert = "";
$Obj->p_change = "";
$Obj->p_delete = "";
$Obj->Zebra = "white,lightblue";
$Obj->Noedit = "";
$Obj->NoInsert = "";
$Obj->Limit = "";
$Obj->Add(
    array(
        F_NAME_ => "suc",
        F_ALIAS_ => "Sucursal",
        F_HELP_ => "Sucursal",
        F_TYPE_ => "select_list",
        F_RELTABLE_ => "empresas",
        F_SHOWFIELD_ => "emp_cod,emp_nombre",
        F_FILTER_ => "'true order by emp_cod asc'",
        F_NODB_ => "1",
        F_ORD_ => "10",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "tipo",
        F_ALIAS_ => "Tipo de Reporte",
        F_HELP_ => "Tipo de Reporte",
        F_TYPE_ => "select_list",
        F_OPTIONS_ => "Margen detallado de Ventas,Facturas Impresas,Lista de Precios",  
        F_NODB_ => "1",
        F_ORD_ => "12",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "desde",
        F_ALIAS_ => "Fecha desde",
        F_HELP_ => "Fecha desde",
        F_TYPE_ => "date",
        F_NODB_ => "1",
        F_ORD_ => "40",
        V_DEFAULT_ => "thisDate_",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

$Obj->Add(
    array(
        F_NAME_ => "hasta",
        F_ALIAS_ => "Fecha hasta",
        F_HELP_ => "Fecha hasta",
        F_TYPE_ => "date",
        F_NODB_ => "1",
        F_ORD_ => "50",
        V_DEFAULT_ => "thisDate_",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));

		

$Obj->Add(
    array(
        F_NAME_ => "rep0",
        F_ALIAS_ => "Margen detallado x Ventas",
        F_HELP_ => "Margen detallado x Ventas",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.margen_detallad",
        F_NODB_ => "1",
        F_ORD_ => "100",
        F_INLINE_ => "1",
        C_VIEW_ => "tipo.get()=='Margen detallado de Ventas'",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));
		
$Obj->Add(
    array(
        F_NAME_ => "rep2",
        F_ALIAS_ => "Facturas Impresas",
        F_HELP_ => "Facturas Impresas",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.facturas_impres",
        F_NODB_ => "1",
        F_ORD_ => "100",
        F_INLINE_ => "1",
        C_VIEW_ => "tipo.get()=='Facturas Impresas'",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));		
		
		 
		
$Obj->Add(
    array(
        F_NAME_ => "articulo",
        F_ALIAS_ => "Articulo",
        F_HELP_ => "Codigo",
        F_TYPE_ => "text", 
		C_VIEW_ => "tipo.get()=='Lista de Precios'",
        F_LENGTH_ => "30",
        F_ORD_ => "110",         
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));	

	 
 $Obj->Add(
    array(
        F_NAME_ => "rep3",
        F_ALIAS_ => "Lista de Precios",
        F_HELP_ => "Lista de Precios",
        F_TYPE_ => "report",
        F_REPORT_ => "rep.lista_precios",
        F_NODB_ => "1",
		F_INLINE_ => "1",
        F_ORD_ => "120",         
        C_VIEW_ => "tipo.get()=='Lista de Precios'",
        G_SHOW_ => "2",
        G_CHANGE_ => "2"));		
 
	
		

$Obj->Add(
    array(
        F_NAME_ => "__lock",
        F_ALIAS_ => "Bloquea el boton Insert/Accept",
        F_HELP_ => "Bloquea el boton Insert/Accept",
        F_TYPE_ => "formula",
        F_NODB_ => "1",
        F_ORD_ => "200",
        C_VIEW_ => "false",
        F_FORMULA_ => "disableAcceptButton() ",
        G_SHOW_ => "64",
        G_CHANGE_ => "64"));

?>
