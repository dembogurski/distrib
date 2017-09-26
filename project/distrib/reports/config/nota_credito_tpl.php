<!-- 
    Report Template File (nota_credito)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval -->
       <link rel="stylesheet" type="text/css" href="templates/reports.css" /> 
	<treset_page>
<!-- end:   general_header -->


<!-- begin: start_query0 -->
<table style="text-align: left; width: 100%;" border="1" cellpadding="0" cellspacing="0">
    <tbody>
    <thead>
<tr> <td colspan="50"> 
	<table style="text-align: left; width: 100%;" border="1"
	 cellpadding="0" cellspacing="0">
	  <tbody>
		<tr>
		  <td style="width: 20%;height:40px;">*</td>
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
			style="font-weight: bold;"><big>Nota de Credito</big></td>
		  <td style="text-align: right;">
			<small><small>{user} - {time}</small></small>
		  </td>
		</tr>
                <tr>
                    <td colspan="3" >
                        <table style="width: 100%" border="0">
                            <tr>
                              <td>CI/RUC:</td><td class="item">{ruc}</td>
                              <td>Fecha:</td><td class="itemc">{fecha}</td>
                            </tr>
                            <tr>
                              <td>Cliente:</td><td class="item">{sup_n_cli_nombre}</td>
                              
                            </tr>
                        </table>                        
                    </td>
                </tr>
	  </tbody>
	</table> 
</td></tr>
<!-- end:   start_query0 -->

<!-- begin: header0 -->
    <tr>
        <th>Factura N&deg;</th>
        <th>Codigo</th>
        <th>Descrip</th>
        <th>Cantidad</th>
        <th>Precio</th>
        <th style="text-align: right;">SubTotal</th>
    </tr>
</thead>
<tfoot>
	 
</tfoot>
<!-- end:   header0 -->

<!-- begin: query0_data_row -->
         <tr>
            <td class="item">{query0_Factura}</td>
            <td class="item">{query0_Codigo}</td>
            <td class="item">{query0_Descrip}</td>
            <td class="num">{query0_Cantidad}</td>
            <td class="num">{query0_Precio}</td>
            <td class="num">{query0_SubTotal}</td>
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
        </tr>
<!-- end:    query0_total_row -->
<!-- begin: query0_subtotal_row -->
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td style="text-align: right;padding-right:  2px"><b>Gs&nbsp;{subtotal0_SubTotal}</b></td>
        </tr>
<!-- end:    query0_subtotal_row -->
<!-- begin: end_query0 -->
    </tbody>
</table>
<br><br><br><br>
<div style="text-align: center;">Firma:___________________________</div>
<!-- end:   end_query0 -->

