<!-- 
    Report Template File (ventas_credito)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval -->
       <link rel="stylesheet" type="text/css" href="templates/reports.css" /> 
	<treset_page>
<!-- end:   general_header -->


<!-- begin: start_query0 -->
<table style="text-align: left; width: 99%;border-collapse: collapse;border: solid gray 1px" border="1" cellpadding="0" cellspacing="0">
    <tbody>
 
<tr> <td colspan="50"> 
	<table style="text-align: left; width: 100%;border-collapse: collapse" border="1"
	 cellpadding="0" cellspacing="0">
	  <tbody>
		<tr>
		  <td style="width: 20%;height:40px;"> </td>
		  <td style="text-align: center;width: 60%;">
			<b>{company}</b></td>
		  <td style="text-align: right;">
			<tpage><b>Pag: </b></tpage></td>
		</tr>
		<tr>
		  <td  style="width: 20%;">
			<small><small>ycube plus RAD [1.2.31]</small></small>
		  </td>
		  <td style="text-align: center;"><big
			style="font-weight: bold;"><big>Ventas a Credito</big></td>
		  <td style="text-align: right;">
			<small><small>{user} - {time}</small></small>
		  </td>
		</tr>
	  </tbody>
	</table> 
</td></tr>
<!-- end:   start_query0 -->

<!-- begin: header0 -->
    <tr>
        <th>Ref</th>
        <th>Factura</th>
        <th>N&deg; Cuota</th> 
        <th>Fecha</th>
        <th >Valor</th>
        <th>Vencimiento</th>
        <th>Entrega</th>
        <th>Saldo</th>
        <th>Estado</th>
        <th colspan="6" style="background-color: lightgrey">Detalle de Amortizaciones</th>
    </tr>
 
 
<!-- end:   header0 -->

<!-- begin: cliente -->
 <tr>
     <td class="item" colspan="9" style="background-color: lightgray"><b>RUC:</b> {query0_Ruc}&nbsp;&nbsp;<b>Cliente:</b>&nbsp;{query0_Cliente}</td> 
     <td colspan="6"></td>
 </td>           
<!-- end:   cliente -->

<!-- begin: query0_data_row -->
        
         <tr>
            <td class="itemc">{query0_Ref}</td>
            <td class="itemc">{query0_Factura}</td>
            <td class="itemc">{query0_Nro_Cuota}</td> 
            <td class="itemc">{query0_Fecha}</td>
            <td class="num">{query0_ValorCuota}</td>
            <td class="itemc">{query0_Vencimiento}</td>
            <td class="num">{query0_Entrega}</td>
            <td class="num">{query0_Saldo}</td>
            <td class="itemc">{query0_Estado}</td>
            <th>Fecha</th>
            <th>Forma</th>
            <th>Complemento</th>
            <th>Saldo Ant.</th>
            <th>Monto</th>
            <th>Saldo</th>             
         </tr>
<!-- end:    query0_data_row -->
<!-- begin: amort -->
        <tr>
            <td colspan="9" style="border: solid white 0px"></td>
            <td class="itemc">{fecha}</td>
            <td class="item">{comp}</td>
            <td class="item">{compl}</td>
            <td class="num">{saldo_ant}</td>            
            <td class="num">{monto}</td>
            <td class="num">{saldo}</td>             
        </tr>
<!-- end:    amort -->
<!-- begin: query0_subtotal_row -->
        <tr>
            <td></td>
            <td></td>             
            <td></td>
            <td></td>
            <td class="num"><b>{subtotal0_ValorCuota}</b></td>
            <td></td>
            <td class="num"><b>{subtotal0_Entrega}</b></td>
            <td class="num"><b>{subtotal0_Saldo}</b></td>
            <td></td>
        </tr>
<!-- end:    query0_subtotal_row -->
<!-- begin: end_query0 -->
    </tbody>
</table>
<!-- end:   end_query0 -->

