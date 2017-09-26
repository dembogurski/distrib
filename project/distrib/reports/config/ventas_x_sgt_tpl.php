<!-- 
    Report Template File (ventas_x_sgt)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval -->
       <link rel="stylesheet" type="text/css" href="templates/reports.css" /> 
	<treset_page>
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
			<b>{company}</br></td>
		  <td style="text-align: right;">
			<tpage><b>Pag: </b></tpage></td>
		</tr>
		<tr>
		  <td  style="width: 20%;">
			<small><small>ycube plus RAD [1.2.31]</small></small>
		  </td>
		  <td style="text-align: center;"><big
			style="font-weight: bold;"><big>Ventas por Codigo o (Sector Grupo y Tipo)</big></td>
		  <td style="text-align: right;">
			<small><small>{user} - {time}</small></small>
		  </td>
		</tr>
	  </tbody>
	</table><hr />
</td></tr>
<!-- end:   start_query0 -->

<!-- begin: header0 -->
    <tr>
        <th>Codigo</th>
        <th>Factura</th>
        <th>Fecha</th>
        <th>Sector</th>
        <th>Grupo</th>
        <th>Tipo</th>
        <th>Descrip</th>
        <th style="text-align: right;">CantVendida</th>
        <th style="text-align: right;">PrecioVenta</th>
        <th style="text-align: right;">Subtotal</th>
    </tr>
</thead>
<tfoot>
	<tr><td colspan="50"><hr /></td></tr>
</tfoot>
<!-- end:   header0 -->

<!-- begin: query0_data_row -->
         <tr>
            <td class="itemc">{query0_Codigo}</td>
            <td class="itemc">{query0_Factura}</td>
            <td class="itemc">{query0_Fecha}</td>
            <td class="itemc">{query0_Sector}</td>
            <td class="itemc">{query0_Grupo}</td>
            <td class="itemc">{query0_Tipo}</td>
            <td class="itemc">{query0_Descrip}</td>
            <td class="num">{query0_CantVendida}</td>
            <td class="num">{query0_PrecioVenta}</td>
            <td class="num">{query0_Subtotal}</td>
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
            <td style="text-align: right;"><b>{subtotal0_CantVendida}</b></td>
            <td style="text-align: right;"><b>{subtotal0_PrecioVenta}</b></td>
            <td style="text-align: right;"><b>{subtotal0_Subtotal}</b></td>
        </tr>
<!-- end:    query0_subtotal_row -->
<!-- begin: end_query0 -->
    </tbody>
</table>
<!-- end:   end_query0 -->

