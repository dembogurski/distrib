<!-- 
    Report Template File (mov_caja)

    ####################################################
    USE THIS FILE TO PERSONALIZE A VISUAL OF YOUR REPORT
    ####################################################
-->

<!-- begin: general_header noeval -->
	<treset_page>

    <style>
    .zebra0{
       background:#E8E8E8;
    }
    .zebra1{
       background:white;
    }
    .num{
       text-align:right;
    }
    </style>
<!-- end:   general_header -->


<!-- begin: start_query0 -->
<table style="text-align: left; width: 100%;" border="1" cellpadding="0" cellspacing="0">
    <tbody>
    <thead>
<tr> <td colspan="50"> 
	<table style="text-align: left; width: 100%;" border="1" 	 cellpadding="0" cellspacing="0">
	  <tbody>
		<tr>
		  <td> &nbsp; *</td>
		  <td style="text-align: center;height:56px;"  > <big>  <big>Reporte de Movimientos de Caja</big></big> </td>
		  <td style="text-align: right;">  <tpage><b>Pag: </b></tpage></td>
		</tr>
 
 		<tr> 
		  <td> <small><small>ycube plus RAD [1.2.31]</small></small>  </td>
          <td style="text-align: center;"> <b>Periodo: {desde} - {hasta} </b> </td>  
		  <td style="text-align: right;"> <small><small>{user} - {time}</small></small> </td>
		</tr>
		
	  </tbody>
	</table><br>
</td></tr>
<!-- end:   start_query0 -->

<!-- begin: header0 -->
    <tr style="font-size:13px;">
        <th align="center">ID</th>
        <th align="center">FECHA</th>
        <th>USUARIO</th>
        <th align="center">MONEDA</th>
        <th align="center">COTIZ</th>
        <th align="center">MONTO</th>
        <th>&nbsp;CONCOPTO</th>
        <th>&nbsp;COMPLEMENTO</th>
        <th style="text-align: right;">ENT_G$</th>
        <th style="text-align: right;">SAL_G$</th>
	<!--	<th style="text-align: right;">SALDO</th> -->
    </tr>
</thead>
<tfoot>
	<tr><td colspan="50"><hr /></td></tr>
</tfoot>
<!-- end:   header0 -->

<!-- begin: query0_data_row -->
        <tr class="{fondo}" style="font-size:12px;">
            <td align="center">{query0_ID}</td>
            <td align="center">{query0_FECHA}</td>
            <td> &nbsp;{query0_USUARIO}</td>
            <td align="center">{query0_MONEDA}&nbsp;&nbsp;</td>
            <td class="num">{query0_COTIZ}</td>
            <td class="num">{query0_MONTO}&nbsp;&nbsp;</td>
            <td>&nbsp;{query0_CONCOPTO}</td>
            <td>&nbsp;{query0_COMPLEMENTO}</td>
            <td class="num">{query0_E_REF}</td>
            <td class="num">{query0_S_REF}</td>
		   <!-- <td style="text-align: right;">{S_M}</td> -->
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
           <td style="text-align: right;"><b>Totales:</b></td>
            <td style="text-align: right;"><b>{subtotal0_E_REF}</b></td>
            <td style="text-align: right;"><b>{subtotal0_S_REF}</b></td>
			 
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            
            <td style="text-align: right;"><b>Saldo:</b></td>
	  
            <td colspan='2' style="text-align: right;"><b>{dif}</b></td> 
			<td></td>
        </tr>	
<!-- end:    query0_subtotal_row -->
<!-- begin: end_query0 -->
    </tbody>
</table>
<!-- end:   end_query0 -->

