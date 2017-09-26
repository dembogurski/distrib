<!-- 
    Report Template File (ajustes_x_cod)

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
			style="font-weight: bold;"><big>Ajustes x Codigo</big></td>
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
        <th>Fecha</th>
        <th>Hora</th>
        <th>Usuario</th>
        <th>Oper</th>
        <th>Signo</th>
        <th>Inicial</th>
        <th style="text-align: right;">Aj_Positivo</th>
        <th style="text-align: right;">Aj_Negativo</th>
        <th>Final</th>
        <th>Motivo</th>
    </tr>
</thead>
<tfoot>
	<tr><td colspan="50"><hr /></td></tr>
</tfoot>
<!-- end:   header0 -->

<!-- begin: query0_data_row -->
         <tr>
            <td class="item">{query0_Codigo}</td>
            <td class="itemc">{query0_Fecha}</td>
            <td class="itemc">{query0_Hora}</td>
            <td class="itemc">{query0_Usuario}</td>
            <td class="item">{query0_Oper}</td>
            <td class="itemc">{query0_Signo}</td>
            <td class="num">{query0_Inicial}</td>
            <td class="num">{query0_Aj_Positivo}</td>
            <td class="num">{query0_Aj_Negativo}</td>
            <td class="num">{query0_Final}</td>
            <td class="item">{query0_Motivo}</td>
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
            <td></td>
            <td></td>
            <td style="text-align: right;font-size: 13"><b>{subtotal0_Aj_Positivo}</b></td>
            <td style="text-align: right;font-size: 13"><b>{subtotal0_Aj_Negativo}</b></td>
            <td></td>
            <td></td>
        </tr>
<!-- end:    query0_subtotal_row -->
<!-- begin: end_query0 -->
    </tbody>
</table>
<!-- end:   end_query0 -->

