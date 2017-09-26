<!-- 
    Report Template File (presupuesto)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval -->
       <link rel="stylesheet" type="text/css" href="templates/reports.css" /> 
	<treset_page>
            <style>
                .tit{
                    font-weight: bolder;
                    font-size: 14px;
                }
                .cli{ 
                    font-size: 13px;
                }
            </style>            
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
		  <td style="width: 20%;height:40px;text-align: center;">{company}</td>
		  <td style="text-align: center;width: 60%;">
                      <b><big><big>Presupuesto</big></big></b><br>
                      (No V&aacute;lido como comprobante de Venta)
                  </td>
		  <td style="text-align: center;">
			<big><big> <b>N&deg;: &nbsp; {sup_f_nro}</b> </big></big> </td>
		</tr>
		<tr>
		 
                    <td style="text-align: left;;padding:4" colspan="2"> 
                      <table style="width: 100%"  border="0" cellpadding="0" cellspacing="0">
                          <tr>
                          <tr> <td class="tit">Fecha:</td> <td class="cli"> {fecha}</td>  </tr>
                              <tr> 
                                  <td class="tit">Cliente:</td> <td  class="cli">  {sup_f_cli_nombre}</td>
                              </tr>
                          </tr> 
                      </table>  
                  </td>
		  <td style="text-align: center;">
                      <small><small>{user} - {time}</small></small><br>
                        <small><small>ycube plus RAD [1.2.31]</small></small>
		  </td>
		</tr>
	  </tbody>
	</table> 
</td></tr>
<!-- end:   start_query0 -->

<!-- begin: header0 -->
    <tr>
        <th>Nro</th>
        <th>Codigo</th>
        <th>Descrip</th>
        <th>Cant</th>
        <th>Um</th>
        <th>CantV</th>
        <th>Precio</th>
        <th>SubTotal</th>
    </tr>
</thead>
<tfoot>
    <tr><td colspan="8" style="text-align: center"> Presupuesto v&aacute;lido por 10 d&iacute;as a partir de la fecha de Expedici&oacute;n  </td></tr>
</tfoot>
<!-- end:   header0 -->

<!-- begin: query0_data_row -->
         <tr>
            <td class="itemc">{query0_Nro}</td>
            <td class="item">{query0_Codigo}</td>
            <td class="item">{query0_Descrip}</td>
            <td class="num">{query0_Cant}</td>
            <td class="itemc">{query0_Um}</td>
            <td class="num">{query0_CantV}</td>
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
             
            <td colspan="2" style="text-align: right;"><b>Total Gs: &nbsp; &nbsp;{subtotal0_SubTotal}&nbsp;~ </b></td>
        </tr>
<!-- end:    query0_subtotal_row -->
<!-- begin: end_query0 -->
    </tbody>
</table>
<!-- end:   end_query0 -->

