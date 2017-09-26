<!-- 
    Report Template File (recup_compras)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval -->
       <link rel="stylesheet" type="text/css" href="templates/reports.css" /> 
	<treset_page>
<!-- end:   general_header -->


<!-- begin: start_query0 -->
<table style="text-align: left; width: 99%;border-collapse: collapse;border-color: #999999;" border="1" cellpadding="0" cellspacing="0">
    <tbody>
 
<tr> <td colspan="50"> 
	<table style="text-align: left; width: 100%;" border="1"
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
			style="font-weight: bold;"><big>Reporte de Recuperacion de Compras</big></td>
		  <td style="text-align: right;">
			<small><small>{user} - {time}</small></small>
		  </td>
		</tr>
	  </tbody>
	</table> 
</td></tr>
 
<!-- end:   start_query0 -->

<!-- begin: header0 -->
<tr style="background-color: lightgray">
        <th>Ref</th>
        <th>Fecha</th>
        <th>FechaFactura</th>
        <th colspan="2">Proveedor</th>
        <th>Factura</th>
        <th>Moneda</th>
        <th>Cotiz</th>
        <th>ValorTotal</th>
        <th>% Rec.</th>
        <th>Estado</th> 
    </tr>

 <!-- end:   header0 -->

<!-- begin: query0_data_row -->
         <tr>
            <td class="item">{query0_Ref}</td>
            <td class="itemc">{query0_Fecha}</td>
            <td class="itemc">{query0_FechaFactura}</td>
            <td class="item" colspan="2">{query0_Proveedor}</td>
            <td class="item">{query0_Factura}</td>
            <td class="itemc">{query0_Moneda}</td>
            <td class="num">{query0_Cotiz}</td>
            <td class="num">{query0_ValorTotal}</td>
            <td class="num">{query0_Rec}</td>
            <td class="itemc">{query0_Estado}</td>
         </tr>
<!-- end:    query0_data_row -->
<!-- begin: query0_total_row -->
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
<!-- end:    query0_total_row -->
<!-- begin: query0_subtotal_row -->
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>{subtotal0_ValorTotal}</b></td>
            <td></td>
            <td></td>
        </tr>
<!-- end:    query0_subtotal_row -->
<!-- begin: end_query0 -->
    </tbody>
</table>
<!-- end:   end_query0 -->

