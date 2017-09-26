<!-- 
    Report Template File (margen_detallad)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval -->
       <link rel="stylesheet" type="text/css" href="templates/reports.css" /> 
	<treset_page>
            <style>
                .recargo{
                    background-color: #DED5F2;
                }
                .sin_rec{
                    background-color: #D2E5F3;
                }
            </style>
<!-- end:   general_header -->


<!-- begin: start_query0 -->
<table style="text-align: left; width: 99%;" border="1" cellpadding="0" cellspacing="0">
    <tbody>
    <thead>
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
			style="font-weight: bold;"><big>Margen Detallado Sobre Ventas</big></td>
		  <td style="text-align: right;">
			<small><small>{user} - {time}</small></small>
		  </td>
		</tr>
                <tr><td colspan="3"><b>Periodo:</b>{sup_desde}<->{sup_hasta} &nbsp;&nbsp;&nbsp; <b>Unidad de Medida de Venta:</b> {sup_umv}</td></tr>
	  </tbody>
	</table><hr />
</td></tr>
<!-- end:   start_query0 -->

<!-- begin: header0 -->
<tr class="titulo">
        <th>Factura</th>
        <th>Codigo</th>
        <th>Descripcion</th>       
        <th>P.Compra S/R</th>
        <th>Cant_Vendida</th>
        <th>Costo S/R</th>
        <th>SubTotal</th>
        <th>Margen S/R</th>
        <th>P.Compra C/R</th>
        <th>Costo C/R</th>
        <th>Margen C/R</th>
    </tr>
</thead>
<tfoot>
	<tr><td colspan="50"><hr /></td></tr>
</tfoot>
<!-- end:   header0 -->

<!-- begin: query0_data_row -->
         <tr>
            <td class="item">{query0_Factura}</td>
            <td class="item">{query0_Codigo}</td>
            <td class="item">{query0_Descrip}</td>            
            <td class="num sin_rec">{query0_P_Compra}</td>
            <td class="num">{query0_Cant_Vendida}</td>
            <td class="num sin_rec">{query0_Costo}</td>
            <td class="num">{query0_SubTotal}</td>
            <td class="num sin_rec">{query0_Margen}</td>
            <td class="num recargo">{query0_P_CompraCR}</td>
            <td class="num recargo">{query0_CostoCR}</td>
            <td class="num recargo">{query0_MargenCR}</td>
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
            <td style="text-align: right;"><b>{subtotal0_Costo}</b></td>
            <td style="text-align: right;"><b>{subtotal0_SubTotal}</b></td>
            <td style="text-align: right;"><b>{subtotal0_Margen}</b></td>
            <td></td>
            <td style="text-align: right;"><b>{subtotal0_CostoCR}</b></td>
            <td style="text-align: right;"><b>{subtotal0_MargenCR}</b></td>
        </tr>
<!-- end:    query0_subtotal_row -->
<!-- begin: end_query0 -->
    </tbody>
</table>
<!-- end:   end_query0 -->

